<?php $t =& peTheme();?>
<?php $content =& $t->content; ?>
<?php $meta = $t->content->meta(); ?>

<!-- Begin Navigation -->
<nav class="clearfix">

	<!-- Logo -->
    <div class="logo">
        <a id="top" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php $t->image->retina($t->options->get("logo")); ?></a>
        <?php if (defined('ICL_LANGUAGE_CODE')): ?>
		<div class="pe-wpml-lang-selector">
			<?php do_action('icl_language_selector'); ?>
		</div>
	<?php endif; ?>
    </div>

	
	

	<!-- Mobile Nav Button -->
	<button type="button" class="nav-button" data-toggle="collapse" data-target=".nav-content">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <!-- Navigation Links -->
    <div class="navigation">
		<div class="nav-content">
			<?php $t->menu->show("main"); ?>
		</div>
	</div>

</nav>
<!-- End Navigation -->