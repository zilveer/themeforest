<?php
get_header();
$webnus_options = webnus_options();
$webnus_options['webnus_404_text'] = isset( $webnus_options['webnus_404_text'] ) ? $webnus_options['webnus_404_text'] : '';
?>
<section id="hero" class="tbg1">
    <div class="blox dark dark">
      <div class="container alignleft">
        <h1 class="pnf404"><?php esc_html_e('404','webnus_framework'); ?></h1>
        <h2 class="pnf404"><?php esc_html_e('Page Not Found','webnus_framework'); ?></h2>
        <br>
        <div>
         <?php get_search_form(); ?>
       </div>
        <?php echo wp_kses($webnus_options['webnus_404_text'],array('a' => array('href' => array(),'title' => array()),'br' => array(),'em' => array(),'strong' => array())); ?> 
      </div>
    </div>
</section>

<?php get_footer(); ?>