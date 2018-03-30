<?php 
$main_class = dh_get_main_class();
$layout = dh_get_theme_option('blogs-style','default');
$pagination = dh_get_theme_option('blogs-pagination','page_num');
$loadmore_text = dh_get_theme_option('blogs-loadmore-text',esc_html__('Load More','jakiro'));
$columns = dh_get_theme_option('blogs-columns',4);
$show_tag = dh_get_theme_option('blogs-show-tag','0') == '1' ? 'yes' : '';
$link_post_title = dh_get_theme_option('blogs-link-post-title','1') == '1' ?  'yes' : '';
$hide_post_title = dh_get_theme_option('blogs-show-post-title','1') == '1' ? '' : 'yes';
$hide_thumbnail = dh_get_theme_option('blogs-show-featured','1') == '1' ? '' : 'yes';

$hide_date = dh_get_theme_option('blogs-show-date','1') == '1' ? '' : 'yes';
$hide_comment = dh_get_theme_option('blogs-show-comment','1') == '1' ? '' : 'yes';
$hide_category = dh_get_theme_option('blogs-show-category','1') == '1' ? '' : 'yes';
$hide_author = dh_get_theme_option('blogs-show-author','1') == '1' ? '' : 'yes';

$hide_readmore = dh_get_theme_option('blogs-show-readmore','1') == '1' ? '':'yes';
$excerpt_length = absint(dh_get_theme_option('blogs-excerpt-length',30));

$show_date = empty($hide_date) ? true : false;
$show_comment = empty($hide_comment) ? true : false;
$show_category = empty($hide_category) ? true : false;
$show_author = empty($hide_author)  ? true : false;
global $wp_query;
if($layout == 'masonry'){
	wp_enqueue_script('vendor-isotope');
}
if($pagination === 'infinite_scroll'){
	wp_enqueue_script('vendor-infinitescroll');
}
?>
<?php get_header() ?>
<div id="main" class="content-container">
	<div class="<?php dh_container_class() ?>">
		<div class="row">
			<?php do_action('dh_left_sidebar')?>
			<?php do_action('dh_left_sidebar_extra')?>
			<div class="<?php echo esc_attr($main_class) ?>" role="main">
				<div class="main-content">
					<?php 
					$itemSelector = '';
					$itemSelector .= (($pagination === 'infinite_scroll') ? '.post.infinite-scroll-item':'');
					$itemSelector .= (($pagination === 'loadmore') ? '.post.loadmore-item':'');
					?>
					<?php if ( have_posts() ) : ?>
						<div data-itemselector="<?php echo esc_attr($itemSelector)  ?>"  class="posts<?php echo (($pagination === 'loadmore') ? ' loadmore':''); ?><?php echo (($pagination === 'infinite_scroll') ? ' infinite-scroll':'') ?><?php echo (($layout === 'masonry') ? ' masonry':'') ?>" data-paginate="<?php echo esc_attr($pagination) ?>" data-layout="<?php echo esc_attr($layout) ?>"<?php echo ($layout === 'masonry') ? ' data-masonry-column="'.$columns.'"':''?>>
							<div class="posts-wrap<?php echo (($pagination === 'loadmore') ? ' loadmore-wrap':'') ?><?php echo (($pagination === 'infinite_scroll') ? ' infinite-scroll-wrap':'') ?><?php echo (($layout === 'masonry') ? ' masonry-wrap':'') ?> posts-layout-<?php echo esc_attr($layout)?><?php if( $layout == 'masonry') echo' row' ?>">
								<?php 
								$post_class = '';
								$post_class .= (($pagination === 'infinite_scroll') ? ' infinite-scroll-item':'');
								$post_class .= (($pagination === 'loadmore') ? ' loadmore-item':'');
								if($layout == 'masonry')
									$post_class.=' masonry-item';
								
								?>
								<?php $i = 0; $w = 0;$k=0;?>
								<?php while (have_posts()): the_post(); global $post; $i++; ?>
									<?php 
									$post_col = '';
									if($layout == 'masonry'):
										if(dh_get_post_meta('masonry_size',$post->ID,'normal') === 'double'):
												$post_col = ' col-md-'.((12/$columns) * 2).' col-sm-6';
										else :
											$post_col = ' col-md-'.(12/$columns).' col-sm-6';
										endif;
									endif;
									if($layout == 'grid'):
										$post_col = ' col-md-'.(12/$columns).' col-sm-6';
									endif;
									?>
									<article id="post-<?php the_ID(); ?>" <?php post_class($post_class.$post_col); ?> itemtype="<?php echo dh_get_protocol() ?>://schema.org/Article" itemscope="">
										<?php if(get_post_format() == 'link'):?>
										<?php $link = dh_get_post_meta('link'); ?>
										<div class="hentry-wrap hentry-wrap-link">
											<div class="entry-content">
												<div class="link-content">
													<?php if($link_post_title === 'yes'):?>
													<a target="_blank" href="<?php echo esc_url($link) ?>">
													<?php endif;?>
														<?php if(empty($hide_post_title)):?>
														<span><?php the_title()?></span>
														<?php endif;?>
														<cite><?php echo esc_url($link) ?></cite>
													<?php if($link_post_title === 'yes'):?>
													</a>
													<?php endif; ?>
												</div>
											</div>
										</div>
										<?php elseif (get_post_format() == 'quote'):?>
										<div class="hentry-wrap hentry-wrap-link">
											<div class="entry-content">
												<div class="quote-content">
													<a href="<?php the_permalink()?>">
														<span>
															<?php echo dh_get_post_meta('quote'); ?>
														</span>
														<cite><?php the_title(); ?></cite>
														<i class="elegant_icon_quotations"></i>
													</a>
												</div>
											</div>
										</div>
										<?php else:?>
										<div class="hentry-wrap">
											<?php 
											$entry_featured_class = '';
											?>
											<?php if(empty($hide_thumbnail)):?>
												<?php dh_post_featured('','',true,false,$entry_featured_class,$layout); ?>
											<?php endif;?>
											<div class="entry-info<?php if(!empty($hide_thumbnail)):?> entry-hide-thumbnail<?php endif;?>">
												<div class="entry-header">
													<?php if(empty($hide_post_title)):?>
													<h2 class="entry-title" data-itemprop="name">
														<?php if($link_post_title === 'yes'):?>
														<a href="<?php the_permalink()?>" title="<?php echo esc_attr(get_the_title())?>">
														<?php endif;?>
															<?php the_title()?>
														<?php if($link_post_title === 'yes'):?>
														</a>
														<?php endif;?>
													</h2>
													<?php endif;?>
													<div class="entry-meta icon-meta text-uppercase">
														<?php 
														dh_post_meta($show_date,$show_comment,$show_category,$show_author,true,'|',null,false); 
														?>
													</div>
												</div>
												<?php if(empty($hide_excerpt) ):?>
													<div class="entry-content">
														<?php 
														$excerpt = $post->post_excerpt;
														if(empty($excerpt))
															$excerpt = $post->post_content;
														
														$excerpt = strip_shortcodes($excerpt);
														$excerpt = wp_trim_words($excerpt,$excerpt_length,'...');
														echo  $excerpt ;
														?>
													</div>
												<?php endif;?>
												<?php if($show_tag === 'yes'):?>
													<div class="entry-footer">
														<?php if(has_tag()):?>
														<div class="entry-tags">
															<?php the_tags('','')?>
														</div>
														<?php endif;?>
													</div>
												<?php endif;?>
												<?php if(empty($hide_readmore)):?>
												<div class="readmore-link">
													<a href="<?php the_permalink()?>"><?php esc_html_e("Continue", 'jakiro');?></a>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<meta content="<?php echo get_the_author()?>" itemprop="author" />
									</article>
								<?php endwhile;?>
							</div>
							<?php if($pagination === 'loadmore' && 1 < $wp_query->max_num_pages ):?>
							<div class="loadmore-action">
								<div class="loadmore-loading"><div class="fade-loading"><i></i><i></i><i></i><i></i></div></div>
								<button type="button" class="btn-loadmore"><?php echo esc_html($loadmore_text) ?></button>
							</div>
							<?php endif;?>
							<?php 
							$paginate_args = array();
							if($pagination === 'infinite_scroll' || $pagination === 'loadmore'){
								$paginate_args = array('show_all'=>true);
							}
							?>
							<?php if($pagination != 'no') dh_paginate_links($paginate_args);?>
						</div>
					<?php else:?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif;?>
					<?php //dh_paginate_links()?>
				</div>
				
			</div>
			<?php do_action('dh_right_sidebar_extra')?>
			<?php do_action('dh_right_sidebar')?>
		</div>
	</div>
</div>
<?php get_footer() ?>