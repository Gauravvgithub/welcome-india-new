<div class="form-group col-md-6">
  <label>Parent Package <span class="text-danger">*</span></label>
  <select class="form-control" name="package_id" id="pkg_for_sub" required>
    <option value="">-- Package Select Karein --</option>
    <?php
    $all_packages = $obj->select_data('packages');
    foreach ($all_packages as $pkg): ?>
      <option value="<?php echo $pkg['id']; ?>">
        <?php echo ucwords(htmlspecialchars($pkg['title'])); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>