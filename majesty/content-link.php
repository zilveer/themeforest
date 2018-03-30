<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Majesty
 * @since Majesty 1.0
 */
?>
<?php
	global $majesty_options;
	if( is_archive() ) {
		$blog_type 	 = $majesty_options['blog_archive_type'];
	} else {
		$blog_type 	 = $majesty_options['blog_type'];
	}
	$blog_loop   = isset ( $majesty_options['loop_masonry'] ) ? $majesty_options['loop_masonry'] : 0 ;
	$article_css = 'blog_single';
	if( ! is_single() ) {
		$article_css = sama_get_css_for_blog('article');
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $article_css ); ?>>

<?php if ( ! is_single() ) { ?>

		<?php if ( $blog_type == 'blog-list-small-thumb' || $blog_type == 'blog-list-big-thumb' || $blog_type == 'wpdefault' ) { ?>
			<?php
				$css_figure  = sama_get_css_for_blog('thumbnail');
				$css_content = sama_get_css_for_blog('content');
			?>
			<?php if ( has_post_thumbnail() && $blog_type != 'wpdefault' ) { ?>
				<figure class="<?php echo esc_attr( $css_figure ); ?>">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
						<?php
							$thumb_size = sama_get_thumb_size_blog();
							the_post_thumbnail( esc_attr( $thumb_size ), array('class'=>'img-responsive'));
						?>
					</a>
					<figcaption class="text-center">
						<span class="btn btn-gold primary-bg white"><?php sama_output_html5_time_format(); ?></span>
					</figcaption>
				</figure>
			<?php } elseif( has_post_thumbnail() && $blog_type == 'wpdefault' ) { ?>
				<figure class="<?php echo esc_attr( $css_figure ); ?>">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
						<?php
							$thumb_size = sama_get_thumb_size_blog();
							the_post_thumbnail( esc_attr( $thumb_size ), array('class'=>'img-responsive'));
						?>
					</a>
				</figure>
			<?php } ?>
			<div class="<?php echo esc_attr( $css_content ); ?>">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="post-category">
						<i class="fa fa-link"></i>
						<?php the_terms( get_the_ID(), 'category', '', ', ', '' ); ?>
					</div>
					<div class="post-meta">
					  <ul>
						<li><i class="fa fa-user"></i> <?php esc_html_e('By', 'theme-majesty'); ?> <?php the_author_posts_link(); ?></li>
						<li><?php the_tags( '<i class="fa fa-tags"></i> ', ', ', ''); ?></li>
						<li><i class="fa fa-comments"></i> <?php comments_popup_link('0', '1', '%'); ?></li>
						<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
							<li class="sticky-post"><span class="flag-sticky label label-default"><?php esc_html__('Featured', 'theme-majesty'); ?></span></li>
						<?php } ?>
					  </ul>
					</div>

					<div class="entery-content excerpt-content">
						<?php
							if ( $blog_type == 'wpdefault' ) {
								the_content();
							} else {
								the_excerpt();
							}
							
							// Used In Blog List OR Default Wordpress
							sama_read_more_link();
						?>
					</div>
			</div>
			<div class="blog-divider">
				<span></span>
				<i class="icon-home-ico"></i>
				<span></span>
			</div>
		<?php } else { ?>
			<?php
				$masonory_larg = sama_get_masonory_larg_3col();
				$masonory_larg_full_width = sama_get_masonory_larg_fullwidth();
				$masonory_larg_2c = sama_get_masonory_larg_2col();
				if( $blog_type == 'blog-masonry-4-col' && in_array( $blog_loop, $masonory_larg_full_width ) ) { ?>
					<figure class="large">	
				<?php } elseif( $blog_type == 'blog-masonry-3-col' && in_array( $blog_loop, $masonory_larg ) ) { ?>
				<figure class="large">
				<?php } elseif( $blog_type == 'blog-masonry-2-col' && in_array( $blog_loop, $masonory_larg_2c ) ) { ?>
				<figure class="large">
				<?php } elseif( $blog_type == 'blog-masonry-full-width' && in_array( $blog_loop, $masonory_larg_full_width ) ) { ?>
				<figure class="large">
				<?php } else { ?>
				<figure>
				<?php } ?>
			
				<?php
					$thumb_size = sama_get_thumb_size_blog();
					the_post_thumbnail( esc_attr( $thumb_size ), array('class'=>'img-responsive'));
				?>
				<figcaption class="text-center">
					<div class="fig_container">
						<i class="fa fa-link"></i>
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php the_terms( get_the_ID(), 'category', '<p class="post-cats"> ', ', ', '</p>' ); ?>
						<div class="fig_content">
							<?php the_excerpt(); ?>
						</div>
					</div>
					<span class="btn btn-gold primary-bg white"><?php sama_output_html5_time_format(); ?></span>
				</figcaption>
			</figure>
		<?php } ?>

<?php } else { // Display single post ?>
	<?php
		$post_layout = get_post_meta( get_the_ID(), '_sama_post_layout', true );
		if ( $post_layout != 'fullwidth' ) { ?>
			<div class="col-md-12">
	<?php } ?>
	<div class="blog_row">
		
		<header class="entery-header">
			<?php
				if(  sama_get_link_url() ) {
					the_title( sprintf( '<h1 class="single-link"><i class="fa fa-link"></i>&#160;<a href="%s">', esc_url( sama_get_link_url() ) ), '</a></h1>' );
				} else {
					if ( has_post_thumbnail() ) {
			?>
						<figure class="blog-img">
							<?php sama_single_post_thumbnail(); ?>
						</figure>
				<?php } ?>
				<h1><?php the_title(); ?></h1>
			<?php
				}
			?>
			
		</header>
		<div class="post-meta">
			<ul>
				<li><i class="fa fa-calendar"></i> <?php sama_output_html5_time_format(); ?></li>
				<li><i class="fa fa-user"></i> <?php esc_html_e('By', 'theme-majesty'); ?>&#160;<?php the_author_posts_link(); ?></li>
				<?php the_terms( get_the_ID(), 'category', '<li><i class="fa fa-folder-open"></i> ', ', ', '</li>' ); ?>
				<li><i class="fa fa-comments"></i> <?php comments_popup_link('0', '1', '%'); ?></li>
			</ul>
		</div>
			
		<div class="entery-content">
			<?php 
				the_content();
				
				wp_link_pages( array(
					'before'      => '<div class="page-links"><strong class="page-links-title">' . esc_html__( 'Pages:', 'theme-majesty' ) . '</strong>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				));
			?>
		</div>
			
		<footer class="entry-footer">
			<?php edit_post_link( esc_html__( 'Edit', 'theme-majesty' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>
		<?php if ( $post_layout != 'fullwidth' ) { ?>
			</div></div>
		<?php } ?>
		<div class="post-tags-social">
			<?php
				the_tags( '<p>'. esc_html__('Tags', 'theme-majesty') .'</p><ul class="labels"><li><span class="label label-tagged">', '</span></li><li><span class="label label-tagged">', '</span></li></ul>');
				
				if ( $majesty_options['single_display_share_icon'] ) {
					get_template_part('tpl/post-share-icon');
				}
			?>
		</div>
		<div class="clearfix"></div>
		<?php if ( $post_layout == 'fullwidth' ) { ?>
			</div>
		<?php } ?>
<?php } ?>
</article>