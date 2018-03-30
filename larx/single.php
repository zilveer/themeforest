<?php
$post_sidebar_layout=get_post_meta(get_the_ID(), '_cmb_post_sidebar_layout', true);
$sidebar_position = "right";
if($post_sidebar_layout == 'default'){
    $sidebar_position=th_theme_data('home_sidebar_position','right');
}elseif($post_sidebar_layout == 'fullwidth'){
    $sidebar_position = 'no';
}elseif($post_sidebar_layout == 'sidebar_left'){
    $sidebar_position = 'left';
}elseif($post_sidebar_layout == 'sidebar_right'){
    $sidebar_position = 'right';
}
if($sidebar_position == "no"){
	$page_class="col-lg-12 col-md-12";
}else{
	$page_class="col-lg-9";
}
if($sidebar_position == "left"){
	$page_class .=' pull-right';
}
?>
						
<?php get_header(); ?>
<section class="i-blog-section-inner">
	<div class="container">
		<div class="row">
		
			<div class="<?php echo esc_attr($page_class); ?>">
				
				<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
				<div class="i-blog-title">
					<h1><?php the_title()?></h1>
				</div>				
				
				<div>
					<?php while(have_posts()) : the_post(); ?>
			
						<div <?php post_class()?> >
							<?php
							get_template_part( 'content', get_post_format() );
							wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
							<p class="post-tags">
								<span><?php esc_html_e('Categories:', 'larx'); ?> </span><?php the_category(', '); ?>
							</p>
							<?php th_blog_post_tags(); ?> 
                            <?php if (th_theme_data('switch_social_share') == 1){ ?>
                                <div class="share-options">                                    
                                    <h6><?php esc_html_e("Share this post: ", 'larx'); ?></h6>
                                    <a href="" class="twitter-sharer" onClick="<?php echo esc_js('twitterSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a>
                                    <a href="" class="facebook-sharer" onClick="<?php echo esc_js('facebookSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a>
                                    <a href="" class="pinterest-sharer" onClick="<?php echo esc_js('pinterestSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-stack-1x fa-inverse"></i></span></a>
                                    <a href="" class="google-sharer" onClick="<?php echo esc_js('googleSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a>
                                    <a href="" class="delicious-sharer" onClick="<?php echo esc_js('deliciousSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-share fa-stack-1x fa-inverse"></i></span></a>
                                    <a href="" class="linkedin-sharer" onClick="<?php echo esc_js('linkedinSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a>
                                </div>                               
                            <?php } ?>
                            <?php if (th_theme_data('switch_about_author') == 1){ ?>
                                <div class="blog-author">
                                    <hr>
                                    <h3><?php echo __('About the Author', 'larx')?></h3>
                                    <div class="author-img">
                                        <?php echo get_avatar(get_the_author_meta('ID'),'130')?>
                                    </div>
                                    <p><?php the_author_meta('description'); ?>
                                        <?php echo get_user_meta(get_the_author_meta('ID'),'job',true)?>
                                    </p>
                                    <p>
										<?php if($th_facebook_id=get_user_meta(get_the_author_meta('ID'),'facebook_url',true)):?>
											<a href="<?php echo esc_url($th_facebook_id); ?>"><i class="fa  fa-facebook-square fa-2x"></i></a>
										<?php endif;?>
										<?php if($th_twitter_id=get_user_meta(get_the_author_meta('ID'),'twitter_url',true)):?>
											<a href="<?php echo esc_url($th_twitter_id); ?>"><i class="fa  fa-twitter-square fa-2x"></i></a>
										<?php endif;?>
										<?php if($th_google_id=get_user_meta(get_the_author_meta('ID'),'google_plus_url',true)):?>
											<a href="<?php echo esc_url($th_google_id); ?>"><i class="fa  fa-google-plus-square fa-2x" ></i></a>
										<?php endif;?>
                                    </p>
                                    <div class="clear"></div>
                                    <hr>
                                </div>
                            <?php } ?>
                            							
							<?php comments_template(); ?> 
							<?php if (th_theme_data('switch_next_prev') == 1){ ?>
								<div class="pager">
									<?php
									echo previous_post_link('%link','<button type="button" class="btn gold-btn" style="float:left"><i class="fa fa-arrow-left"></i> '.esc_html_x('Older', 'older', 'larx').'</button>');
									echo next_post_link('%link','<button type="button" class="btn gold-btn" style="float:right">'.esc_html_x('Newer', 'newer', 'larx').' <i class="fa fa-arrow-right"></i></button>');
									?>
								</div>
							<?php } ?>
							
						</div><!-- single-post-wrapper -->
						
					<?php endwhile; ?>
				</div>
			
			</div>
			
			<?php if($sidebar_position!="no"){ ?>
				<div id="sidebar" class="col-lg-3">
					<?php get_sidebar(); ?>
				</div><!-- end sidebar -->
			<?php } ?>
							
		</div>
	</div>
</section>
<?php get_footer(); ?>