<?php
	/*
	 * This file will generate 404 error page.
	 */	
get_header(); ?>

<section id="content-holder" class="container-fluid">
  <div class="row-fluid no-sidebar">
    <section class="container">
      <header class="header-style">
        <h2 class="h-style">404 Page</h2>
      </header>
      <div class="widget-bg">
        <article class="error-404">
          <h1><?php echo __('404','cp_front_end'); ?></h1>
          <h3><?php echo __('ooops..... Your are lost','cp_front_end'); ?></h3>
          <p><?php echo __("The page you are looking for seems to be missing.Go back, or return to home page to choose a new direction.",'cp_front_end'); ?></p>
          <a href="<?php echo get_site_url(); ?>"><?php echo __('Back to Home Page','cp_front_end'); ?></a> </article>
      </div>
    </section>
  </div>
</section>
<?php get_footer();?>
