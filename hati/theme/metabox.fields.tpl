
<?php if ($this->desc) : ?>

  <p style="padding:10px 0 5px"><?php echo $this->desc ?></p>

<?php endif; ?>

<input type="hidden" name="theme-metabox-nonce" value="<?php echo $this->nonce ?>"/>

<table class="form-table" data-class="<?php echo $this->class ?>">

  <?php foreach($this->fields as $i => $field): extract($field) ?>

    <?php if ($id) $id = sanitize_key($id) ?>

    <?php if ($type != 'button' && $type != 'custom'): ?>

      <?php if (!$this->desc && !$i): ?>
        <tr>
      <?php else: ?>
        </td></tr> <tr style="border-top: solid 1px #eee">
      <?php endif; ?>

      <th style="width:24%">
        <label for="<?php echo $id ?>">
          <strong><?php echo $name ?></strong>
          <span style="display:block; color:#999; margin-top:5px; line-height:17px"><?php echo $desc ?></span>
        </label>
      </th>

    <?php endif; ?>

  <?php switch($type): case 'text': ?>

    <td>
      <input type="text" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $val ?>" style="width:76%; margin-right:18px; float:left" />

  <?php break; case 'color': ?>

    <td>
      <input type="text" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $val ?>" style="width:76%; margin-right:18px; float:left" onkeyup="el=document.getElementById('rt-<?php echo $id ?>');el.style.backgroundColor=this.value" />
      <span id="rt-<?php echo $id ?>" style="display:inline-block; height:22px; width:60px; background:<?php echo $val ?>; border-radius:2px"></span>

  <?php break; case 'custom': ?>

    <input type="hidden" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $val ?>" />

  <?php break; case 'textarea': ?>

    <td>
      <textarea name="<?php echo $id ?>" id="<?php echo $id ?>" rows="3" style="width:100%; margin-right:18px; float:left; resize:vertical"><?php echo $val ?></textarea>

  <?php break; case 'select': ?>

    <td>
      <select name="<?php echo $id ?>" id="<?php echo $id ?>" style="min-width:24%">
      <?php foreach ($opts as $key => $option): ?>
        <option value="<?php if ($key) echo $key ?>" <?php if ($key == $val) echo 'selected="selected"' ?>>
          <?php echo $option ?>
        </option>
      <?php endforeach; ?>
      </select>

  <?php break; case 'button': ?>

    <input type="button" class="button" name="btn_<?php echo $id ?>" id="btn_<?php echo $id ?>" value="<?php echo $val ?>" style="float:left" />

  <?php break; endswitch; endforeach; ?>

  </td></tr>
</table>