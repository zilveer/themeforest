<?php if(!empty($view_params['content'])) { ?>
<div class="item-content">
  <span><?php echo wpb_js_remove_wpautop($view_params['content'], true); ?></span>
</div>
<?php }