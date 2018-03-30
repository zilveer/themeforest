<?php
/**
 * Single post page
 *
 * @package BuildPress
 */

get_header();

$sidebar = get_field( 'sidebar' );

if ( ! $sidebar ) {
	$sidebar = 'left';
}

get_template_part( 'part-main-title' );
get_template_part( 'part-breadcrumbs' );

?>
<div class="master-container">
	<div class="container">
		<div class="row">
			<main class="col-xs-12<?php echo 'left' === $sidebar ? '  col-md-9  col-md-push-3' : ''; echo 'right' === $sidebar ? '  col-md-9' : ''; ?>" role="main">

				<?php
					while ( have_posts() ) :
						the_post();
				?>

				<article <?php post_class( 'post-inner' ); ?>>
					<?php if( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) ); ?>
						</a>
					<?php endif; ?>
					<div class="meta-data">
						<time datetime="<?php the_time( 'c' ); ?>" class="published  meta-data__date"><?php echo get_the_date(); ?></time>
						<time class="hidden  updated"><?php the_modified_date(); ?></time>
						<span class="vcard  author">
							<span class="meta-data__author"><?php _e( 'By' , 'buildpress_wp'); ?> <span class="fn"><?php the_author(); ?></span></span>
						</span>
						<?php if( has_category() ) { ?><span class="meta-data__categories"><?php _e( '' , 'buildpress_wp'); ?> <?php the_category(' &bull; '); ?></span><?php } ?>
						<?php if( has_tag() ) { ?><span class="meta-data__tags"><?php _e( '' , 'buildpress_wp'); ?> <?php the_tags( '', ' &bull; ' ); ?></span><?php } ?>
						<span class="meta-data__comments"><a href="<?php comments_link(); ?>"><?php buildpress_pretty_comments_number(); ?></a></span>
					</div>
					<h1 class="entry-title  hentry__title"><?php echo get_the_title(); ?></h1>
					<div class="entry-content  hentry__content">
						<?php the_content(); ?>
					</div>
					<?php if ( strlen( get_the_title() ) < 1 ) : ?>
						<a href="<?php the_permalink(); ?>"><?php _e( 'Link to this post' , 'buildpress_wp'); ?></a>
					<?php endif; ?>
					<div class="clearfix"></div>

					<!-- Multi Page in One Post -->
					<?php
						$args = array(
							'before'      => '<div class="multi-page  clearfix">' . /* translators: after that comes pagination like 1, 2, 3 ... 10 */ __( 'Pages:' , 'buildpress_wp') . ' &nbsp; ',
							'after'       => '</div>',
							'link_before' => '<span class="btn  btn-primary">',
							'link_after'  => '</span>',
							'echo'        => 1
						);
						wp_link_pages( $args );
					?>
					<?php comments_template( '', true ); ?>
				</article>

				<?php
					endwhile;
				?>
			</main>

			<?php if ( 'none' !== $sidebar ) : ?>
				<div class="col-xs-12  col-md-3<?php echo 'left' === $sidebar ? '  col-md-pull-9' : ''; ?>">
					<div class="sidebar" role="complementary">
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>

<?php get_footer(); ?>