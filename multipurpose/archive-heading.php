<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
  <h1><?php single_cat_title(); ?></h1>
<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
  <h1><?php single_tag_title(); ?></h1>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
  <h1><?php echo get_the_time('F jS, Y'); ?></h1>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
  <h1><?php echo get_the_time('F, Y'); ?></h1>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
  <h1><?php echo get_the_time('Y'); ?></h1>
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
  <h1><?php esc_attr_e( 'Author Archive', 'multipurpose' ); ?></h1>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
  <h1><?php esc_attr_e( 'Blog Archives', 'multipurpose' ); ?></h1>
<?php } ?>