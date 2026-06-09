<?php
// ===== Step 1: Include DB =====
require_once '../config/db.php';
$db = new database(); // DB object

// ===== Step 2: Get Type (for filtering) =====
$type = $_GET['type'] ?? '';
$cond = '';

// Map GET type to actual tour_type values from popup form
$tourTypes = [
    'wildlife'           => 'Wildlife',
    'hill_stations'      => 'Hill Stations',
    'pilgrimage'         => 'Pilgrimage',
    'heritage'           => 'Heritage',
    'beach'              => 'Beach',
    'honeymoon'          => 'Honeymoon',
    'yoga_wellness'      => 'Yoga & Wellness',
    'adventure_trekking' => 'Adventure & Trekking',
    'international'      => 'International'
];

if(isset($tourTypes[$type])){
    $cond = "tour_type='".$tourTypes[$type]."'";
}

// ===== Step 3: Fetch Enquiries =====
$enquiries = $db->select_data('enquiries', $cond);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enquiries List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 20px;
        }

        /* Logo */
        .logo-container img {
            height: 60px;
            transition: transform 0.2s;
        }
        .logo-container img:hover {
            transform: scale(1.05);
        }

        h2 {
            color: #006a72;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #006a72;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }

        tbody tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        tbody tr:hover {
            background-color: #d9f0f0;
        }

        td {
            font-size: 13px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #888;
        }
    </style>
</head>
<body>

    <!-- Logo Section -->
    <div class="logo-container">
        <a href="index.php">
            <img src="../assets/images/main-logo.webp" alt="Admin Logo">
        </a>
    </div>

    <h2>Enquiries List<?php if($type && isset($tourTypes[$type])) echo " - ".$tourTypes[$type]; ?></h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Destination</th>
                <th>Travel Date</th>
                <th>Travelers</th>
                <th>Tour Type</th>
                <th>Message</th>
                <!--<th>Submitted At</th>-->
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($enquiries)): ?>
                <?php foreach($enquiries as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['destination']) ?></td>
                        <td><?= htmlspecialchars($row['travel_date']) ?></td>
                        <td><?= htmlspecialchars($row['travelers']) ?></td>
                        <td><?= htmlspecialchars($row['tour_type']) ?></td>
                        <td><?= htmlspecialchars($row['message']) ?></td>
                        <!--<td><?= htmlspecialchars($row['created_at']) ?></td>-->
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="no-data">No enquiries found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>