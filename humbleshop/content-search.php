<?php
/**
 * @package humbleshop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<h4 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php 
				if ( 'download' == get_post_type() ) :
					echo '<i class="fa fa-shopping-cart"></i>';
				elseif( $post->post_type == 'page' ):
					echo '<i class="fa fa-copy"></i>';
				else :
					if ( has_post_format( 'aside' )) {
					  echo '<i class="fa fa-list"></i>';
					} elseif( has_post_format( 'link' )) {
						echo '<i class="fa fa-chain"></i>';
					} elseif( has_post_format( 'gallery' )) {
						echo '<i class="fa fa-camera"></i>';
					} elseif( has_post_format( 'quote' )) {
						echo '<i class="fa fa-quote-left"></i>';
					} elseif( has_post_format( 'status' )) {
						echo '<i class="fa fa-comment-o"></i>';
					} elseif( has_post_format( 'image' )) {
						echo '<i class="fa fa-picture-o"></i>';
					} elseif( has_post_format( 'audio' )) {
						echo '<i class="fa fa-music"></i>';
					}  elseif( has_post_format( 'video' )) {
						echo '<i class="fa fa-video-camera"></i>';
					} else {
						echo '<i class="fa fa-pencil"></i>';
					}
				endif; 
				?>
				<?php the_title(); ?>
				
				<?php 
				if ( 'download' == get_post_type() ) :
					if(function_exists('edd_price')) : ?>
					<small class="pull-right product-price">
						<?php 
							if(edd_has_variable_prices(get_the_ID())) {
								// if the download has variable prices, show the first one as a starting price
								echo 'From: '; edd_price(get_the_ID());
							} else {
								edd_price(get_the_ID()); 
							}
						?>
					</small><!--end .product-price-->
				<?php endif; endif; ?>
			</a>
		</h4>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
		<?php humbleshop_posted_on(); ?> | 
		<small>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><i class="fa fa-comments-o"></i>	<?php comments_popup_link( __( 'Leave a comment', 'humbleshop' ), __( '1 Comment', 'humbleshop' ), __( '% Comments', 'humbleshop' ) ); ?></span>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'humbleshop' ), '| <span class="edit-link"><i class="fa fa-pencil"></i> ', '</span>' ); ?>
		</small>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content clearfix">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'humbleshop' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links pagination">' . __( 'Pages:', 'humbleshop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content clearfix -->
	<?php endif; ?>
	
</article><!-- #post-## -->