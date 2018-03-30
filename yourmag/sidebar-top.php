
<?php if (get_option('op_sidebar_style')!== 'Default') { ?>
<?php $sidebar_style = '_' . get_option("op_sidebar_style"); ?> 
<?php } ?>

<div class="sidebar_top<?php echo $sidebar_style ?>">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top-sidebar') ) : ?>
<?php endif; ?> 	
</div>
