<?php 
	get_header();
?>

<?php 
	extract(etheme_get_page_sidebar());
	$blog_slider = etheme_get_option('blog_slider');
	$postspage_id = get_option('page_for_posts');
?>


<?php if ($page_heading != 'disable' && ($page_slider == 'no_slider' || $page_slider == '')): ?>
	<div class="page-heading bc-type-<?php etheme_option('breadcrumb_type'); ?>">
	<?php et_page_heading(); ?>
<?php endif ?>

<?php if($page_slider != 'no_slider' && $page_slider != ''): ?>
	
	<?php echo do_shortcode('[rev_slider_vc alias="'.$page_slider.'"]'); ?>

<?php endif; ?>


<div class="container">
	<div class="page-content sidebar-position-<?php echo $position; ?> responsive-sidebar-<?php echo $responsive; ?>">
		<div class="row-fluid">
			<?php if($position == 'left'): ?>
				<div class="<?php echo $sidebar_span; ?> sidebar sidebar-left">
					<?php etheme_get_sidebar($sidebarname); ?>
				</div>
			<?php endif; ?>

			<div class="content <?php echo $content_span; ?>">
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>
					<?php
					    $post_format 	= get_post_format();
					    $slider_id 		= rand(100,10000);
					    $post_content 	= get_the_content();
					    $gallery_filter = et_gallery_from_content( $post_content );
					?>
					<article <?php post_class('blog-post post-single'); ?> id="post-<?php the_ID(); ?>" >
					
						<?php 
							$width = etheme_get_option('blog_page_image_width');
							$height = etheme_get_option('blog_page_image_height');
							$crop = etheme_get_option('blog_page_image_cropping');
						?>
						
							
						<?php if($post_format == 'gallery'): ?>
				            <?php if(count($gallery_filter['ids']) > 0): ?>
				                <div class="post-gallery-slider slider_id-<?php echo $slider_id; ?>">
				                    <?php foreach($gallery_filter['ids'] as $attach_id): ?>
				                        <div>
				                            <?php echo wp_get_attachment_image($attach_id, 'large'); ?>
				                        </div>
				                    <?php endforeach; ?>
				                </div>
				    
				                <script type="text/javascript">
				                    <?php et_owl_init( '.slider_id-' . $slider_id, array(
				                    	'has_nav' => '.nav_slider_id-' . $slider_id
				                    ) ); ?>
				                </script>

				                <div class="post-gallery-navigation nav_slider_id-<?php echo $slider_id; ?>">
				                    <?php foreach($gallery_filter['ids'] as $attach_id): ?>
				                        <div>
				                            <?php echo wp_get_attachment_image($attach_id, 'thumbnail'); ?>
				                        </div>
				                    <?php endforeach; ?>
				                </div>

				                <script type="text/javascript">
				                    <?php 
				                    	$sliders_in_view = 3;
				                    	if( count($gallery_filter['ids']) > 3 ) $sliders_in_view = count($gallery_filter['ids']);
				                    	if( $sliders_in_view > 6  ) $sliders_in_view = 6;

				                    	et_owl_init( '.nav_slider_id-' . $slider_id, array(
								            'singleItem' => 'false',
								            'itemsCustom' => '[[0, 2], [479,2], [619,2], [768,' . ($sliders_in_view - 1 ) . '],  [1200, ' . $sliders_in_view . '], [1600, ' . $sliders_in_view . ']]',
								            'nav_for' => '.slider_id-' . $slider_id
				                    	) ); 

			                    	?>
				                </script>
				            <?php endif; ?>
					    
						<?php elseif(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('large'); ?>
						<?php endif; ?>
						

                        <?php if($post_format != 'quote'): ?>
                            <h3 class="post-title entry-title"><?php the_title(); ?></h3>

                        	<?php et_byline(); ?>
                        	
                        <?php endif; ?>

                        <?php if($post_format != 'gallery'): ?>
                            <div class="content-article entry-content">
                                <?php the_content(); ?>
                            </div>
                        <?php elseif($post_format == 'gallery'): ?>
                            <div class="content-article entry-content">
                                <?php echo $gallery_filter['filtered_content']; ?>
                            </div>
                        <?php endif; ?>

						<?php if (has_tag()): ?>
							<p class="tag-container tags"><?php the_tags(); ?></p>
						<?php endif ?>
						<div class="post-navigation">
							<?php wp_link_pages(); ?>
						</div>

						<div class="clear"></div>
					
						<?php if(etheme_get_option('post_share')): ?>
							<div class="row-fluid post-share">
								<div class="span12"><?php echo do_shortcode('[share]'); ?></div>
							</div>
						<?php endif; ?>
						
						<?php if(etheme_get_option('posts_links')): ?>
							<div class="row-fluid post-next-prev">
								<div class="span6"><?php previous_post_link() ?></div>
								<div class="span6 a-right"><?php next_post_link() ?></div>
							</div>
						<?php endif; ?>
					
					</article>

				<?php endwhile; else: ?>

					<h1><?php _e('No posts were found!', ET_DOMAIN) ?></h1>

				<?php endif; ?>

				<?php comments_template('', true); ?>

			</div>

			<?php if($position == 'right'): ?>
				<div class="<?php echo $sidebar_span; ?> sidebar sidebar-right">
					<?php etheme_get_sidebar($sidebarname); ?>
				</div>
			<?php endif; ?>

		</div>

	</div>
</div>
	
<?php
	get_footer();
?>