<?php 

	get_header();

	$same_category_navigation = false;
	if ( isset($options['same_category_navigation']) ) {
		$same_category_navigation = $options['same_category_navigation'];
	}
?>

<?php if (have_posts()) : the_post(); ?>
	
	<?php		
		$post_author = get_the_author_link();
		$post_date = get_the_date();
		$post_categories = get_the_term_list( $post->ID, 'jobs-category', '',', ','' )
	?>
	
	<div class="container">
	
		<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
			
			<article <?php post_class('clearfix row'); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
				
			<div class="entry-title" itemprop="name"><?php the_title(); ?></div>
			
				<div class="page-content col-sm-12 clearfix">
					
					<ul class="post-pagination-wrap curved-bar-styling clearfix">
						<li class="prev"><?php next_post_link('%link', __('<i class="ss-navigateleft"></i> <span class="nav-text">%title</span>', 'swiftframework'), $same_category_navigation, '', 'jobs-category'); ?></li>
						<li class="next"><?php previous_post_link('%link', __('<span class="nav-text">%title</span><i class="ss-navigateright"></i>', 'swiftframework'), $same_category_navigation, '', 'jobs-category'); ?></li>
					</ul>
					
					<div class="post-info clearfix">
						<span class="vcard author"><?php echo sprintf(__('Posted by <a href="%2$s" rel="author" itemprop="author" class="fn">%1$s</a> on <span class="date updated">%3$s</span> in %4$s', 'swiftframework'), $post_author, get_author_posts_url(get_the_author_meta( 'ID' )), $post_date, $post_categories); ?></span>
						<?php if ( comments_open() ) { ?>
						<div class="comments-likes">
							<div class="comments-wrapper"><a href="#comments"><i class="ss-chat"></i><span><?php comments_number(__('0 Comments', 'swiftframework'), __('1 Comment', 'swiftframework'), __('% Comments', 'swiftframework')); ?></span></a></div>
						</div>
						<?php } ?>
					</div>
																
					<section class="article-body-wrap">
						<div class="body-text clearfix" itemprop="articleBody">
							<?php the_content(); ?>
						</div>
		
						<div class="link-pages"><?php wp_link_pages(); ?></div>
														
						<div class="tags-link-wrap clearfix">
							<?php if (has_tag()) { ?>
							<div class="tags-wrap"><?php _e("Tags:", "swiftframework"); ?><span class="tags"><?php the_tags(''); ?></span></div>
							<?php } ?>
						</div>
						
						<div class="share-links curved-bar-styling clearfix">
							<div class="share-text"><?php _e("Share this article:", "swiftframework"); ?></div>
							<ul class="social-icons">
								<li class="sf-love">
								<div class="comments-likes">
								<?php if (function_exists( 'lip_love_it_link' )) {
									echo lip_love_it_link(get_the_ID(), '<i class="ss-heart"></i>', '<i class="ss-heart"></i>', false);
								} ?>				
								</div>
								</li>
							    <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="post_share_facebook" onclick="javascript:window.open(this.href,
							      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li>
							    <li class="twitter"><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
							      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" class="product_share_twitter"><i class="fa-twitter"></i><i class="fa-twitter"></i></a></li>   
							    <li class="googleplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
							      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li>
							    <li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php echo get_the_title(); ?>" onclick="javascript:window.open(this.href,
							      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=600');return false;"><i class="fa-pinterest"></i><i class="fa-pinterest"></i></a></li>
								<li class="mail"><a href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php the_permalink(); ?>" class="product_share_email"><i class="ss-mail"></i><i class="ss-mail"></i></a></li>
							    <li class="page-link"><a class="permalink item-link" href="<?php the_permalink(); ?>"><i class="ss-link"></i><i class="ss-link"></i></a></li>
							</ul>						
						</div>					
											
					</section>
						
				</div>
				
			<!-- CLOSE article -->
			</article>
			
		</div>
	
	</div>

<?php endif; ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>