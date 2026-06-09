<?php

class database
{
  private $db_host = 'localhost';
  private $port = '3306';
  private $db_user = 'root';
  private $db_password = 'Gaurav@920579';
  private $db_name = 'welcome-india-new';
  public $connection;
  public function __construct()
  {
    $this->connect();
  }

  private function connect()
  {
    $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name, $this->port);
    if ($this->connection->connect_error) {
      die("Database connection failed: " . $this->connection->connect_error);
    }
  }

  // Insert data with optional image upload
  public function insert_data($tbl, $param = [], $filesMap = [])
  {
    if (empty($tbl) || !preg_match('/^[a-zA-Z0-9_]+$/', $tbl)) {
      die("Invalid table name.");
    }

    // escape scalar values
    foreach ($param as $key => $value) {
      $param[$key] = $this->connection->real_escape_string($value);
    }

    $uploadDir = "../uploads/";
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $movedFiles = [];   // keep target paths to move after successful insert

    // filesMap = ['image' => 'image', 'gallery_1' => 'gallery_1', ...]
    foreach ($filesMap as $inputName => $columnName) {

      if (!empty($_FILES[$inputName]['name'])) {
        $ext = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
        $uniqueName = uniqid($inputName . '_', true) . '.' . $ext;
        $targetFile = $uploadDir . $uniqueName;

        // set DB value now (escaped)
        $param[$columnName] = $this->connection->real_escape_string($targetFile);

        // remember to actually move it after successful insert
        $movedFiles[] = [
          'tmp'    => $_FILES[$inputName]['tmp_name'],
          'target' => $targetFile
        ];
      } else {
        // make sure column exists in insert (NULL)
        if (!array_key_exists($columnName, $param)) {
          $param[$columnName] = null;
        }
      }
    }

    // build and run query
    $columns = '`' . implode('`,`', array_keys($param)) . '`';
    $values  = "'" . implode("','", array_map([$this->connection, 'real_escape_string'], array_values($param))) . "'";
    $query   = "INSERT INTO `$tbl` ($columns) VALUES ($values)";

    if ($this->connection->query($query)) {
      // now move files
      foreach ($movedFiles as $file) {
        if (!move_uploaded_file($file['tmp'], $file['target'])) {
          die("Error uploading image(s).");
        }
      }
      return true;
    } else {
      die("Query Error: " . $this->connection->error);
    }
  }

  // Update data
  public function update_data($tbl, $param = [], $cond = null, $image_fields = [])
  {
    if (empty($tbl) || !preg_match('/^[a-zA-Z0-9_]+$/', $tbl)) {
      die("Invalid table name.");
    }
    if (empty($cond)) {
      die("Condition is required to update records.");
    }
    if (empty($param) && empty($image_fields)) {
      die("No data to update.");
    }

    $uploadDir = "../uploads/";
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    // --- Normalize $image_fields ---
    // Accept either ['image','gallery_1'] OR ['image' => 'image', 'gallery_first' => 'gallery_1']
    $filesMap = [];
    foreach ($image_fields as $k => $v) {
      if (is_int($k)) {
        // numeric index means same input name == column name
        $filesMap[$v] = $v;
      } else {
        $filesMap[$k] = $v;
      }
    }

    // --- Fetch old image paths once (for deletion later) ---
    $oldRow = [];
    if (!empty($filesMap)) {
      $selectCols = array_values($filesMap);
      $selectColsStr = '`' . implode('`,`', $selectCols) . '`';
      $res = $this->connection->query("SELECT $selectColsStr FROM `$tbl` WHERE $cond LIMIT 1");
      if ($res) {
        $oldRow = $res->fetch_assoc() ?: [];
      }
    }

    $updates   = [];
    $toMove    = []; // files to move after successful UPDATE
    $toDelete  = []; // old files to delete after successful UPDATE

    // --- Normal fields ---
    foreach ($param as $key => $value) {
      $escaped = $this->connection->real_escape_string($value);
      $updates[] = "`$key` = '$escaped'";
    }

    // --- Image fields ---
    foreach ($filesMap as $inputName => $columnName) {
      if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK && !empty($_FILES[$inputName]['name'])) {
        $ext        = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
        $uniqueName = uniqid($columnName . '_', true) . '.' . $ext;
        $targetPath = $uploadDir . $this->connection->real_escape_string($uniqueName);

        // queue column update
        $updates[] = "`$columnName` = '$targetPath'";

        // queue file move
        $toMove[] = [
          'tmp'    => $_FILES[$inputName]['tmp_name'],
          'target' => $targetPath
        ];

        // queue old file delete
        if (!empty($oldRow[$columnName]) && file_exists($oldRow[$columnName])) {
          $toDelete[] = $oldRow[$columnName];
        }
      }
    }

    if (empty($updates)) {
      // nothing to update
      return false;
    }

    $updateString = implode(', ', $updates);
    $query = "UPDATE `$tbl` SET $updateString WHERE $cond";

    if (!$this->connection->query($query)) {
      die("Query failed: " . $this->connection->error);
    }

    // move new files
    foreach ($toMove as $f) {
      if (!move_uploaded_file($f['tmp'], $f['target'])) {
        die("Failed to upload image.");
      }
    }

    // delete old files
    foreach ($toDelete as $old) {
      @unlink($old);
    }

    return $this->connection->affected_rows >= 0;
  }

  // Select data
  public function select_data($tbl, $cond = null)
  {
    // Validate table name
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $tbl)) {
      die("Invalid table name.");
    }

    // Build SQL query
    $sql = "SELECT * FROM `$tbl`";
    if ($cond !== null && is_string($cond) && trim($cond) !== '') {
      $sql .= " WHERE $cond";
    }

    // Execute query
    $result = $this->connection->query($sql);

    // Handle result
    if ($result) {
      return $result->fetch_all(MYSQLI_ASSOC);
    } else {
      die("Query failed: " . $this->connection->error);
    }
  }

  // delete data
  public function delete_data($tbl, $cond = null, $image_fields = [])
  {
    // Validate the table name
    if (empty($tbl) || !preg_match('/^[a-zA-Z0-9_]+$/', $tbl)) {
      die("Invalid table name.");
    }

    // Validate the condition
    if (empty($cond) || !is_string($cond)) {
      die("Condition is required and must be a string.");
    }

    // Handle multiple image deletions
    if (!empty($image_fields)) {
      if (!is_array($image_fields)) {
        $image_fields = [$image_fields]; // Ensure it's an array
      }

      // Build image select query
      $columns = implode(',', array_map(fn($field) => "`$field`", $image_fields));
      $image_query = "SELECT $columns FROM `$tbl` WHERE $cond";
      $result = $this->connection->query($image_query);

      if ($result && ($row = $result->fetch_assoc())) {
        foreach ($image_fields as $field) {
          $image_path = $row[$field] ?? '';
          if (!empty($image_path) && file_exists($image_path)) {
            unlink($image_path); // Delete image file from server
          }
        }
      }
    }

    // Execute the delete query
    $query = "DELETE FROM `$tbl` WHERE $cond";
    if ($this->connection->query($query)) {
      return $this->connection->affected_rows > 0;
    } else {
      die("Delete query failed: " . $this->connection->error);
    }
  }
}
