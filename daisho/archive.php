<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display date archives, tag archives, category archives
 * and author archives. You can create tag.php, category.php and
 * author.php in a Child Theme to overwrite this template.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php if( have_posts() ) { ?>

	<header class="page-header">
		<h1 class="page-title"><?php
			if ( is_author() ) :
				the_post();
				printf( __( 'All posts by %s', 'flowthemes' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
				rewind_posts();
			elseif ( is_tag() ) :
				printf( __( 'Tag Archives: %s', 'flowthemes' ), single_tag_title( '', false ) );
			elseif ( is_category() ) :
				printf( __( 'Category Archives: %s', 'flowthemes' ), single_cat_title( '', false ) );
			elseif ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'flowthemes' ), get_the_date() );
			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'flowthemes' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'flowthemes' ) ) );
			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'flowthemes' ), get_the_date( _x( 'Y', 'yearly archives date format', 'flowthemes' ) ) );
			else :
				_e( 'Archives', 'flowthemes' );
			endif;
		?></h1>
		<?php
		if ( is_category() ) {
			if ( category_description() ) {
				echo '<div class="page-description">' . category_description() . '</div>';
			}
		} else if ( is_tag() ) {
			if ( tag_description() ) {
				echo '<div class="page-description">' . tag_description() . '</div>';
			}
		} ?>
	</header>
	
	<div class="site-content clearfix">
		<div class="content-area" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>

	<?php flow_paging_nav(); ?>

<?php } else { ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php } ?>

<?php get_footer(); ?>