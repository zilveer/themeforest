<?php
/**
*Template Name: Authors List
*
* @author : VanThemes ( http://www.vanthemes.com )
* @license : GNU General Public License version 2.0
*/
get_header(); 
$van_page_type = van_page_type(); 
?>

<?php van_breadcrumb(); ?>

<div id="main-content" class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">
	
	<div id="single-outer">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array('content','post-inner') ); ?>>
					
					<div class="entry-container">

						<header id="entry-header">
							<h1 class="entry-title">
								<?php the_title(); ?>
							</h1><!-- .entry-title -->
						</header>

						<div class="entry-content">

							<?php if( $post->post_content !="" ) : ?>

								<?php the_content(); ?>

								<?php wp_link_pages(array('before' => '<p><strong>'.__( 'Pages:','van').'</strong> ', 'after' => '</p>')); ?>										
							
								<?php edit_post_link( __( '(Edit)', 'van' ), '<span class="edit-post">', '</span>' ); ?>

							<?php endif; ?>

				
						</div><!-- .entry-content -->
						
					</div><!-- .entry-container -->

				</article>

				<?php 
					$users = get_users('blog_id=1&orderby=post_count&order=DESC');
					foreach ($users as $user) :
				?>

				<div class="author-info  row clearfix author-inlist">

					<div class="author-avatar-container">	
						<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta('user_email' ,$user->ID), 80 ); ?>
						</div>
					</div><!-- .author-avatar-container -->

					<div class="author-desc content">

						<h3 class="row-title"><?php the_author_meta('display_name', $user->ID ); ?></h3>

						<?php if ( get_the_author_meta('description', $user->ID) ): ?>
							<p><?php the_author_meta('description', $user->ID); ?></p>				
						<?php endif; ?>

						<p class="author-links vcard">
							<strong>
								<?php printf( __( 'View all articles by <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>' , 'van' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID', $user->ID ) ) ), esc_attr( sprintf( __( 'View all posts by %s', 'van' ), get_the_author_meta('display_name', $user->ID ) ) ), get_the_author_meta('display_name', $user->ID ) ); ?>
							</strong>
						</p>
						
						<?php if ( get_the_author_meta( 'url',  $user->ID ) ): ?>
							<p class="author-links"><strong><?php _e('Website: ', 'van') ?></strong><a  href="<?php echo esc_url( get_the_author_meta('url',  $user->ID) ); ?>" title="<?php esc_attr( get_the_author_meta('display_name',  $user->ID) ) . ' ' . esc_attr__( "Website", 'van' ); ?>"><?php the_author_meta('url',  $user->ID); ?></a></p>				
						<?php endif; ?>

						<?php van_author_social( $user->ID ); ?>

					</div><!-- .author-desc -->

				</div> <!-- author-info -->

				<?php endforeach; ?>

			<?php endwhile; ?>

		<?php endif;  ?>

		<?php comments_template( '', true ); ?>

	</div> <!-- #single-outer -->

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>