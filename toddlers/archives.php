<?php
/*
Archive
*/
get_header();
global $unf_options;
?>

<div id="content-wrapper" class="row clearfix archive-wrapper">
	<div id="content" class="col-md-8 column">
		<div class="article clearfix">
			<?php if ( is_day() ) : ?>
                <h1 class="page-title"><?php printf( __( 'Daily Archives: <span>%s</span>', 'toddlers' ), get_the_time(get_option('date_format')) ) ?></h1>
<?php elseif ( is_month() ) : ?>
                <h1 class="page-title"><?php printf( __( 'Monthly Archives: <span>%s</span>', 'toddlers' ), get_the_time('F Y') ) ?></h1>
<?php elseif ( is_year() ) : ?>
                <h1 class="page-title"><?php printf( __( 'Yearly Archives: <span>%s</span>', 'toddlers' ), get_the_time('Y') ) ?></h1>
<?php elseif ( isset($_GET['paged']) && (!empty($_GET['paged']) )) : ?>
                <h1 class="page-title"><?php _e( 'Blog Archives', 'toddlers' ) ?></h1>
<?php endif; ?>

			<?php get_template_part( 'loop','compactlist' ); ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>