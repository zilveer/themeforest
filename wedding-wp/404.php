<?php
get_header();
GLOBAL $webnus_options;
?>
<section id="hero" class="tbg1">
    <div class="blox dark dark">
      <div class="container alignleft">
        <h1 class="pnf404"><?php _e('404','WEBNUS_TEXT_DOMAIN'); ?></h1>
        <h2 class="pnf404"><?php _e('Page Not Found','WEBNUS_TEXT_DOMAIN'); ?></h2>
        <br>
        <div>
         &nbsp;&nbsp;<?php get_search_form(); ?>
		 
        </div>
        <br class="clear">
        <p>&nbsp;</p>
        <?php echo $webnus_options->webnus_404_text(); ?> 
      </div>
    </div>
</section>

<?php get_footer(); ?>