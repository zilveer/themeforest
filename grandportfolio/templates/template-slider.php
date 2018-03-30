<?php
	//Check if display slider
	$tg_blog_slider = kirki_get_option('tg_blog_slider');
	if(THEMEDEMO && isset($_GET['slider']))
	{
		$tg_blog_slider = 1;
	}
	
	//Get post featured category
	$args = array( 
		'orderby' => 'date',
		'order' => 'DESC',
		'order' => 'post',
		'suppress_filters' => 0,
	);
	
	//Check if filter slider posts by selected category
	$tg_blog_slider_cat = kirki_get_option('tg_blog_slider_cat');
	if(!empty($tg_blog_slider_cat))
	{
	    $args['cat'] = $tg_blog_slider_cat;
	}
	
	if(!empty($tg_blog_slider) && !is_search() && !is_category() && !is_tag() && !is_archive() && !empty($tg_blog_slider_cat))
	{
		//Check slider post items
		$tg_blog_slider_items = kirki_get_option('tg_blog_slider_items');
		if(!empty($tg_blog_slider_items) && is_numeric($tg_blog_slider_items))
		{
			$args['posts_per_page'] = $tg_blog_slider_items;
		}
		else
		{
			$args['posts_per_page'] = 5;
		}
		
		// the query
		$theme_query = new WP_Query( $args );
		
		wp_enqueue_script("flexslider", get_template_directory_uri()."/js/flexslider/jquery.flexslider-min.js", false, THEMEVERSION, true);
		wp_enqueue_script("grandportfolio-slider-flexslider", get_template_directory_uri()."/js/script/script-slider-flexslider.js", false, THEMEVERSION, true);
?>
	<div id="post_featured_slider" class="slider_wrapper">
		<div class="flexslider" data-height="550">
			<ul class="slides">
	<?php
		//Display slide content
		if ($theme_query->have_posts()) : while ($theme_query->have_posts()) : $theme_query->the_post();
			//Get post featured image
			$slide_ID = get_the_ID();
			$image_url = array();
						
			if(has_post_thumbnail($slide_ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($slide_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
			}
			
			if(isset($image_url[0]) && !empty($image_url[0]))
			{
	?>
			<li>
				<a href="<?php echo get_permalink($slide_ID); ?>">
					<div class="slider_image" style="background-image:url('<?php echo esc_url($image_url[0]); ?>');">
						<div class="slide_post">
							<div class="slide_post_date post_detail"><?php echo date_i18n(THEMEDATEFORMAT, get_the_time('U')); ?></div>
							<h2><?php the_title(); ?></h2>
						</div>
					</div>
				</a>
			</li>
	<?php
			}
			
		endwhile; endif;
	?>
			</ul>
		</div>
	</div>
<?php	
		wp_reset_postdata();
	} //End if display slider
?>