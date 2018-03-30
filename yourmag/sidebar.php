
<?php if (get_option('op_sidebar_style')!== 'Default') { ?>
<?php $sidebar_style = '_' . get_option("op_sidebar_style"); ?> 
<?php } ?>

<div id="sidebar-right<?php echo $sidebar_style ?>" class="EqHeightDiv">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('right-sidebar') ) : ?>
<?php endif; ?> 	
</div>
