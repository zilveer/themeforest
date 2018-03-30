<?php

/* Template Name: Contact */

?>
<?php get_header(); if (have_posts()) the_post(); ?>

<div class="media-container fullwrap">
  <div class="fluid-container">
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <div id="map" class="fluid" data-marker="<?php echo A_THEME_URL ?>/img/marker.png" data-lat="<?php Acorn::egetm('_map-lat') ?>" data-long="<?php Acorn::egetm('_map-long') ?>" data-hue="<?php Acorn::eget('text-color') ?>" data-zoom="<?php Acorn::egetm('_map-zoom') ?>" data-style="<?php Acorn::egetm('_map-style') ?>"></div>
  </div>
  <div class="media-desc desc">
    <h3><?php Acorn::egetm('_map-title') ?></h3>
    <h2><?php echo do_shortcode("[breakline]". Acorn::getm('_map-descr') ."[/breakline]") ?></h2>
  </div>
</div>

<div class="main wrap group post">

  <div class="headings">
    <h1><?php the_title() ?></h1>
  </div>
  <!-- /headings-->

  <div class="clear"></div>
  <?php the_content() ?>

</div>

<?php get_footer() ?>