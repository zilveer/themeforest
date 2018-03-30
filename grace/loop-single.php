<?php
/*
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php
				$postID = get_the_ID();
				$postCustom = get_post_custom();
				
				$showFeaturedImage = isset($postCustom['_tb_show_featured'][0]) ? $postCustom['_tb_show_featured'][0] : 'default';				
				if ($showFeaturedImage == 'default' || !$showFeaturedImage) $showFeaturedImage = of_get_option('show_featured_image', 'show');
				
				$showPrevNextPost = of_get_option('show_previous_next_post', 'show');
				
				?>


				<div id="post-<?php echo $postID; ?>" <?php post_class('single'); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<?php if (has_post_thumbnail() && $showFeaturedImage == 'show')	{ ?>
						<?php echo get_the_post_thumbnail($postID, 'full', array('class' => 'imageBorder single-article')); ?>
					<?php } ?>
				
					<div class="entry-meta">
						<?php skeleton_posted_on(); ?>
						<?php skeleton_posted_in(); ?>
					</div><!-- .entry-meta -->
					
					<div class="clear"></div>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'grace' ), 'after' => '</div>' ) ); ?>

						<?php if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>');
						} ?>
					</div><!-- .entry-content -->

					<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'skeleton_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h3><?php $postAuthor = get_the_author(); printf( esc_attr__( 'About %s', 'grace' ),  $postAuthor); ?></h3>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'grace' ), $postAuthor ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
					<?php endif; ?>

					<div class="entry-utility">
						<?php edit_post_link( __( 'Edit this', 'grace' ), '<span class="edit-link button right">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<?php if ($showPrevNextPost == 'show') { ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'grace' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'grace' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->
				<?php } ?>
				

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>