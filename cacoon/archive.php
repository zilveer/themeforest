<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package metcreative
 */

get_header();

?>


<?php if ( have_posts() ) : ?>

<div class="met_content">

	<div class="row-fluid">
		<div class="span12">
			<div class="met_page_header met_bgcolor5 clearfix">
				<h1 class="met_bgcolor met_color2"><?php
					if ( is_category() ) :
						printf( '%s', '<span>' . single_cat_title( '', false ) . '</span>' );

					elseif ( is_tag() ) :
						printf( __( 'Tag: %s', 'metcreative' ), '<span>' . single_tag_title( '', false ) . '</span>' );

					elseif ( is_author() ) :
						the_post();
						printf( __( 'Author: %s', 'metcreative' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
						rewind_posts();

					elseif ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'metcreative' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'metcreative' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'metcreative' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

					elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
						_e( 'Asides', 'metcreative' );

					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						_e( 'Images', 'metcreative');

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						_e( 'Videos', 'metcreative' );

					elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
						_e( 'Quotes', 'metcreative' );

					elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
						_e( 'Links', 'metcreative' );

					else :
						_e( 'Archives', 'metcreative' );

					endif;
					?></h1>
				<h2 class="met_color2"><?php
					if ( is_category() ) :
						// show an optional category description
						$category_description = category_description();
						if ( ! empty( $category_description ) ) :
							echo strip_tags(apply_filters( 'category_archive_meta', $category_description ));
						endif;

					elseif ( is_tag() ) :
						// show an optional tag description
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) ) :
							echo apply_filters( 'tag_archive_meta', $tag_description );
						endif;

					endif;
					?>&nbsp;</h2>
			</div>
		</div>
	</div>

		<div class="row-fluid">
			<div class="span9">
				<div class="met_blog_block">
				<?php
					/* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php metcreative_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'archive' ); ?>

				<?php endif; ?>
				</div>
			</div>


			<div class="span3">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog') ); ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>