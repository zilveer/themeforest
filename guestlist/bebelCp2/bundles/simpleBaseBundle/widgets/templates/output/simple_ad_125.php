<div class="simple_widget_ad_125_container">
  <h2><?php echo $values['title'] ?></h2>
  <ul>
    <?php for($i=1;$i<5;$i++):?>
      <?php if($values['image_'.$i] != ''): ?>
        <li><a href="<?php echo $values['link_'.$i] ?>"><img src="<?php echo $values['image_'.$i] ?>" alt="ad place <?php echo $i ?>" /></a></li>
      <?php endif ?>
    <?php endfor; ?>
  </ul>
  <br class="clear" />
</div>