<?php 
// get the id of the posts page
$st_index_id = get_option('page_for_posts');
$st_page_sidebar_pos = get_post_meta( $st_index_id, '_st_page_sidebar', true );
?>

<?php if ( is_category() ) { ?>

<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php echo get_the_title($st_index_id); ?> > <?php echo single_cat_title( '', false ); ?></h1>
<?php if ( category_description() ) {  ?>
<?php echo category_description(); ?>
<?php } elseif (get_post_meta( $st_index_id, '_st_page_tagline', true )) { ?>
<p><?php echo get_post_meta( $st_index_id, '_st_page_tagline', true ); ?></p>
<?php } ?>
</div>
</div>
<!-- /#page-header -->

<?php } elseif ( is_tag() ) { ?>

<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php echo get_the_title($st_index_id); ?> > <?php __('Archives' , 'framework') ?></h1>
<p><?php
	if ( is_day() ) :
			printf( __( 'Daily Archives for %s', 'framework' ), '<span>' . get_the_date() . '</span>' );
	elseif ( is_month() ) :
			printf( __( 'Monthly Archives for %s', 'framework' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'framework' ) ) . '</span>' );
	elseif ( is_year() ) :
			printf( __( 'Yearly Archives for %s', 'framework' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'framework' ) ) . '</span>' );
	else :
			_e( 'Archives', 'framework' );
	endif;
?></p>
</div>
</div>
<!-- /#page-header -->

<?php } elseif ( is_archive() ) { ?>

<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php echo get_the_title($st_index_id); ?> > <?php echo single_tag_title( '', false ); ?></h1>
<?php if ( tag_description() ) {  ?>
<?php echo tag_description(); ?>
<?php } elseif (get_post_meta( $st_index_id, '_st_page_tagline', true )) { ?>
<p><?php echo get_post_meta( $st_index_id, '_st_page_tagline', true ); ?></p>
<?php } ?>
</div>
</div>
<!-- /#page-header -->

<?php } else { ?>

<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php if (is_search()) {  _e("Search: ", "framework"); } ?><?php echo get_the_title($st_index_id); ?></h1>
<?php if (get_post_meta( $st_index_id, '_st_page_tagline', true )) { ?>
<p><?php echo get_post_meta( $st_index_id, '_st_page_tagline', true ); ?></p>
<?php } ?>
</div>
</div>
<!-- /#page-header -->

<?php } ?>

<?php if (!get_post_meta( $st_index_id, '_st_page_breadcrumbs', true )) { ?>
<!-- #breadcrumbs -->
<div id="page-subnav" class="clearfix">
<div class="ht-container">
<?php st_breadcrumb(); ?>
</div>
</div>
<!-- /#breadcrumbs -->
<?php } ?>