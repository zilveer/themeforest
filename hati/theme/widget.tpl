
<?php foreach($this->fields as $id => $field): ?>

  <p>
    <label for="<?php echo $field['fid'] ?>">
      <?php echo $field['label'] ?>:
    </label>

    <?php if (isset($field['vars'])): ?>

      <?php if (is_array($field['vars'])): ?>

      <select class="widefat" id="<?php echo $field['fid'] ?>" name="<?php echo $field['fname'] ?>">
        <?php foreach($field['vars'] as $var): ?>
            <option <?php if ($var == $field['val']) echo 'selected="selected"' ?>><?php echo $var ?></option>
        <?php endforeach; ?>
      </select>
      
      <?php elseif ($field['vars'] == 'textarea'): ?>

      <textarea style="height:180px" class="widefat" id="<?php echo $field['fid'] ?>" name="<?php echo $field['fname'] ?>"><?php echo $field['val'] ?></textarea>

      <?php elseif ($field['vars'] == 'checkbox'): ?>
      
      <input style="margin:4px" class="checkbox" type="checkbox" id="<?php echo $field['fid'] ?>" name="<?php echo $field['fname'] ?>" <?php if ($field['val']) echo 'checked="checked"' ?>>

      <?php endif; ?>

    <?php else: ?>

      <input type="text" class="widefat" id="<?php echo $field['fid'] ?>" name="<?php echo $field['fname'] ?>" value="<?php echo $field['val'] ?>" />

    <?php endif; ?>
  </p>

<?php endforeach; ?>