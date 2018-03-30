<?php thb_sidebar_before(); ?>

<aside class="sidebar <?php echo $sidebar_class; ?>" id="thb-sidebar-<?php echo $sidebar_type; ?>">
	<?php thb_sidebar_start(); ?>
	<?php dynamic_sidebar($sidebar); ?>
	<?php thb_sidebar_end(); ?>
</aside>

<?php thb_sidebar_after(); ?>