<?php

if(function_exists('vc_map'))
{
    add_action( 'init', 'plsh_map_to_vc', 999 );
}

//replacement function to allow to use shortcodes without VC
if(!function_exists('vc_map'))
{
    function vc_build_link($url)
    {
        return array('url' => $url);
    }
}

if(!function_exists('sc_mosaic'))
{
	function sc_mosaic( $atts, $content ) {
		ob_start();

		extract( shortcode_atts( array(
			'category' => NULL,
			'tag'   => NULL,
			'page' => 1,
			'max' => 5
		), $atts ) );

		$max = intval($max);
		if($max < 1) $max = 1;

		$args = array(
			'category_name' => $category,
			'tag' => $tag
		);

		$items = plsh_get_post_collection($args, 5, $page);
		if(!empty($items))
		{
			global $post;
			?>
			<!-- Mosaic -->
			<div class="container mosaic" data-category="<?php echo esc_attr($category); ?>" data-tag="<?php echo esc_attr($tag); ?>" data-page="1" data-max="<?php echo esc_attr($max); ?>">
				<?php
					foreach($items as $key => $post)
					{
						setup_postdata($post);                
						if($key == 0) 
						{
							get_template_part('theme/templates/mosaic-item-large');
						} 
						else
						{ 
							get_template_part('theme/templates/mosaic-item-small');
						}
						?>
						<?php
					}
				?>

				<?php 
					$items = plsh_get_post_collection($args, 5, 2);
					if(!empty($items) && $max > 1)
					{
						?>
							<button type="button" class="btn btn-default center-block"><span><?php _e('Load more stories', 'goliath') ?></span></button>
						<?php
					}
				?>
			</div>
			<?php
		}

		?>
		<?php
		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}

if(!function_exists('sc_post_list_1'))
{
	function sc_post_list_1( $atts, $content ) {

		ob_start();
		global $post;

		extract( shortcode_atts( array(
			'title' => __('Latest news', 'goliath'),
			'count' => 4,
			'url'   => '#',
			'category' => NULL,
			'tag'   => NULL,
			'slider_tag'   => NULL,
			'timeout' => 0
		), $atts ) );

		$url_parts = vc_build_link($url);
		$url = $url_parts['url'];


		/* Post list Query */
		$params = array(
			'category_name' => $category,
			'tag' => $tag,
		);

		if($slider_tag)
		{
			$slider_tag_obj = get_term_by('name', $slider_tag, 'post_tag');
		}
		if(!empty($slider_tag_obj))
		{
			$params['tag__not_in'] = $slider_tag_obj->term_id;
		}

		$items = plsh_get_post_collection($params, $count, 1);


		/* Slider item Query */
		$slider_params = array(
			'category_name' => $category,
		);

		if(!empty($slider_tag_obj) && !empty($tag)) //if both slider and regular tag are present
		{
			$tag_obj = get_term_by('name', $tag, 'post_tag');
			if(!empty($tag_obj))
			{
				$slider_params['tag__and'] = array($slider_tag_obj->term_id, $tag_obj->term_id); 
			}
		}
		elseif(!empty($slider_tag)) //if only slider tag
		{
			$slider_params['tag'] = $slider_tag;
		}
		else    //if only regular tag
		{
			$slider_params['tag'] = $tag;
		}
		$slider_items = plsh_get_post_collection($slider_params, 4, 1);


		?>
		<!-- Latest posts -->
		<div class="post-block-1">

			<div class="title-default">
				<a href="<?php echo esc_url($url); ?>" class="active"><?php echo esc_html($title); ?></a>
				<a href="<?php echo esc_url($url); ?>" class="view-all"><?php _e('View all', 'goliath'); ?></a>
			</div>

			<?php
			if(!empty($items))
			{
			?>
			<div class="items">
				<?php
				foreach($items as $post)
				{
					setup_postdata($post);
					get_template_part('theme/templates/post-list-1-item');
				}
				?> 
			</div>
			<?php } ?>


			<?php
			if(!empty($slider_items))
			{
				$unique_slider_id = uniqid();
			?>
			<!-- Slider -->
			<div class="slider">

				<div class="items cycle-slideshow" 
					 data-cycle-swipe="true"
					 data-cycle-swipe-fx="scrollHorz"
					 data-index="1"
					 data-cycle-log="false"
					 data-cycle-fx="scrollHorz"
					 data-cycle-timeout="<?php echo intval($timeout); ?>"
					 data-cycle-speed="500"
					 data-cycle-pager="#<?php echo esc_attr($unique_slider_id); ?>"
					 data-cycle-auto-height="calc"
					 data-cycle-pager-active-class="active"
					 data-cycle-pager-template=""
					 data-cycle-slides="> .post-item"
				>
					<?php
					foreach($slider_items as $post)
					{
						setup_postdata($post);
						get_template_part('theme/templates/post-list-1-slider-item');
					}
					?> 
				</div>

				<div class="thumbs" id="<?php echo esc_attr($unique_slider_id); ?>">
					<?php
					foreach($slider_items as $key => $post)
					{
						setup_postdata($post);
						$class = '';
						$image = plsh_get_thumbnail('post-list-1-slider-item-thumb', true, true);
						echo '<a href="' . get_the_permalink() . '" ' . $class . '><img src="' . $image . '" alt="" /></a>';
					}
					?> 
				</div>

			</div>
			<?php } ?>

		</div>
		<?php
		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}


if(!function_exists('sc_banner300'))
{
	function sc_banner300( $atts, $content ) {
		ob_start();

		extract( shortcode_atts( array(
			'banner' => ''
		), $atts ) );
		?>

		<?php
			if(!empty($banner))
			{
				$banner_parts = explode(',', $banner);
				$rand = rand(0, sizeof($banner_parts)-1);    //banner rotation
				$banner_id = $banner_parts[$rand];                
				$banner_data = plsh_get_banner_by_size_and_slug($banner_id, '300x250');

				if($banner_data) 
				{
				?>
					<div class="banner-300x250">
						<?php if($banner_data['ad_type'] == 'banner') { ?>
								<a href="<?php echo esc_url($banner_data['ad_link']); ?>" target="_blank"><img src="<?php echo esc_url($banner_data['ad_file']); ?>" alt="<?php echo esc_attr($banner_data['ad_title']); ?>"></a>
						<?php } elseif($banner_data['ad_type'] == 'iframe') { ?>
							<iframe class="iframe-300x250" scrolling="no" src="<?php echo esc_url($banner_data['ad_iframe_src']); ?>"></iframe>                        
						<?php } else {
								echo stripslashes($banner_data['googlead_content']);
						} ?>    
					</div>
				<?php
				}
			}

		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}
	
if(!function_exists('sc_banner_four150'))
{
	function sc_banner_four150( $atts, $content ) {
		ob_start();

		extract( shortcode_atts( array(
			'banner' => ''
		), $atts ) );
		?>

		<?php
			if(!empty($banner))
			{
				$banner_parts = explode(',', $banner);
				$rand = rand(0, sizeof($banner_parts)-1);    //banner rotation
				$banner_id = $banner_parts[$rand];                
				$banner_data = plsh_get_banner_by_size_and_slug($banner_id, '150x125');

				if(!empty($banner_data)) 
				{
				?>
					<div class="banner-300x250">
						<?php for($i = 0; $i<4; $i++) {
								$bd = array(
									'ad_type' => $banner_data['ad_type'],
									'ad_title' => $banner_data['ad_title'],
									'googlead_content' => $banner_data['googlead_content:' . $i],
									'ad_link' => $banner_data['ad_link:' . $i],
									'ad_file' => $banner_data['ad_file:' . $i],
									'ad_iframe_src' => (!empty($banner_data['ad_iframe_src:' . $i]) ? $banner_data['ad_iframe_src:' . $i] : '')
								);
								?>
								<div class="banner-150x125">
									<?php if($bd['ad_type'] == 'banner') { ?>
											<a href="<?php echo esc_url($bd['ad_link']); ?>" target="_blank"><img src="<?php echo esc_url($bd['ad_file']); ?>" alt="<?php echo esc_attr($bd['ad_title']); ?>" /></a>
									<?php } elseif($bd['ad_type'] == 'iframe') { ?>
										<iframe class="iframe-150x125" scrolling="no" src="<?php echo esc_url($bd['ad_iframe_src']); ?>"></iframe>
									<?php } else {
											echo stripslashes($bd['googlead_content']);
									} ?>   
								</div>
							<?php } ?>  
					</div>
				<?php
				}
			}

		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}

if(!function_exists('sc_banner468'))
{
	function sc_banner468( $atts, $content ) {
		ob_start();

		extract( shortcode_atts( array(
			 'banner' => ''
		), $atts ) );
		?>
		<?php
			if(!empty($banner))
			{
				$banner_parts = explode(',', $banner);
				$rand = rand(0, sizeof($banner_parts)-1);    //banner rotation
				$banner_id = $banner_parts[$rand];                
				$banner_data = plsh_get_banner_by_size_and_slug($banner_id, '468x60');

				if($banner_data) 
				{
				?>
				<div class="banner-468x60">
					<?php if($banner_data['ad_type'] == 'banner') { ?>
						<a href="<?php echo esc_url($banner_data['ad_link']); ?>" target="_blank"><img src="<?php echo esc_url($banner_data['ad_file']); ?>" alt="<?php echo esc_attr($banner_data['ad_title']); ?>"></a>
					<?php } elseif($banner_data['ad_type'] == 'iframe') { ?>
						<iframe class="iframe-468x60" scrolling="no" src="<?php echo esc_url($banner_data['ad_iframe_src']); ?>"></iframe>
					<?php } else {
						echo stripslashes($banner_data['googlead_content']);
					} ?>
				</div>
				<?php
				}
			}    

		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}
	
if(!function_exists('sc_banner728'))
{
	function sc_banner728( $atts, $content ) {
		ob_start();

		extract( shortcode_atts( array(
			 'banner' => ''
		), $atts ) );
		?>
		<?php
			if(!empty($banner))
			{
				$banner_parts = explode(',', $banner);
				$rand = rand(0, sizeof($banner_parts)-1);    //banner rotation
				$banner_id = $banner_parts[$rand];                
				$banner_data = plsh_get_banner_by_size_and_slug($banner_id, '728x90');

				if($banner_data) 
				{
				?>
				<div class="banner-728x90">
					<?php if($banner_data['ad_type'] == 'banner') { ?>
					<a href="<?php echo esc_url($banner_data['ad_link']); ?>" target="_blank"><img src="<?php echo esc_url($banner_data['ad_file']); ?>" alt="<?php echo esc_attr($banner_data['ad_title']); ?>"></a>
					<?php } elseif($banner_data['ad_type'] == 'iframe') { ?>
						<iframe class="iframe-728x90" scrolling="no" src="<?php echo esc_url($banner_data['ad_iframe_src']); ?>"></iframe>
					<?php } else {
						echo stripslashes($banner_data['googlead_content']);
					} ?>
				</div>
				<?php
				}
			}

		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}

if(!function_exists('sc_slider'))
{
	function sc_slider( $atts, $content ) {
		ob_start();
		global $post;

		extract( shortcode_atts( array(
			'title' => __('Latest news', 'goliath'),
			'count' => 12,
			'url'   => '#',
			'category' => NULL,
			'tag'   => NULL,
			'interval' => 0
		), $atts ) );

		$id = uniqid();
		?>
		<?php
		$url_parts = vc_build_link($url);
		$url = $url_parts['url'];

		if($interval == 0 || !is_numeric($interval)) { $interval = 'false'; }

		/* Post list Query */
		$params = array(
			'category_name' => $category,
			'tag' => $tag,
		);

		$items = plsh_get_post_collection($params, $count, 1);
		?>
		<?php
		if(!empty($items))
		{ 
			$chunks = array_chunk($items, 4);
		?>
			<!-- Slider tabs -->
			<div class="container slider-tabs">

				<div id="carousel-<?php echo esc_attr($id); ?>" class="carousel slide" data-ride="carousel" data-interval="<?php echo esc_attr($interval); ?>">

					<div class="title-default">
						<a href="<?php echo esc_url($url); ?>" class="active"><?php echo esc_html($title); ?></a>
					</div>

					<?php if(count($chunks) > 1) : ?>
						<ol class="carousel-indicators">
							<?php for($i = 0; $i < count($chunks); $i++) { ?>
								<li data-target="#carousel-<?php echo esc_attr($id); ?>" data-slide-to="<?php echo esc_attr($i); ?>" <?php if($i == 0) { echo 'class="active"'; } ?>></li>
							<?php } ?>
						</ol>

						<a class="carousel-control left" href="#carousel-<?php echo esc_attr($id); ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
						<a class="carousel-control right" href="#carousel-<?php echo esc_attr($id); ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
					<?php endif; ?>

					<div class="carousel-inner items">
						<?php
							foreach($chunks as $key => $chunk)
							{
								if(!empty($chunk))
								{
								?>
									<div class="item<?php if($key == 0) { echo ' active'; } ?>">
										<?php
										foreach($chunk as $post)
										{
											setup_postdata($post);
											get_template_part('theme/templates/post-slider-item');
										}
										?>
									</div>
								<?php
								}
							}
						?>
					</div>

				</div>

			</div>
		<?php
		}

		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}

if(!function_exists('sc_post_list_2'))
{
	function sc_post_list_2( $atts, $content ) {
		ob_start();
		global $post;

		extract( shortcode_atts( array(
			'title' => __('Latest news', 'goliath'),
			'count' => 4,
			'url'   => '#',
			'category' => NULL,
			'tag'   => NULL,
		), $atts ) );

		$url_parts = vc_build_link($url);
		$url = $url_parts['url'];

		/* Featured Post Query */
		$params = array(
			'category_name' => $category,
			'tag' => $tag,
			'meta_key' => 'is_featured',
			'meta_value' => 'on'
		);

		$skip_id = array();
		$featured = plsh_get_post_collection($params, 1, 1);
		if(!empty($featured))   //if featured post found, reduce the overal count
		{
			$count--;
			$skip_id[] = $featured[0]->ID;
		}

		/* Post List Query */
		$params = array(
			'category_name' => $category,
			'tag' => $tag,
			'post__not_in' => $skip_id
		);
		$items = plsh_get_post_collection($params, $count, 1);
		$items = array_merge($featured, $items);

		?>

		<!-- Technology -->
		<div class="post-block-2">

			<div class="title-default">
				<a href="<?php echo esc_url($url); ?>" class="active"><?php echo esc_html($title); ?></a>
				<a href="<?php echo esc_url($url); ?>" class="view-all"><?php _e('View all', 'goliath'); ?></a>
			</div>

			<?php
			if(!empty($items))
			{
			?>
			<div class="items">

				<?php
				foreach($items as $key => $post)
				{
					setup_postdata($post);
					if($key == 0)
					{
						get_template_part('theme/templates/post-list-2-item-featured');
					}
					else
					{
						get_template_part('theme/templates/post-list-2-item-regular');
					}
				}
				?>

			</div>
			<?php } ?>
		</div>
		<?php
		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}
	
if(!function_exists('sc_post_list_3'))
{
	function sc_post_list_3( $atts, $content ) {
		ob_start();
		global $post;

		extract( shortcode_atts( array(
			'title' => __('Latest news', 'goliath'),
			'count' => 3,
			'url'   => '#',
			'category' => NULL,
			'tag'   => NULL,
		), $atts ) );

		$url_parts = vc_build_link($url);
		$url = $url_parts['url'];

		/* Post List Query */
		$params = array(
			'category_name' => $category,
			'tag' => $tag,
		);
		$items = plsh_get_post_collection($params, $count, 1);
		?>

		<!-- Fitness -->
		<div class="post-block-3">

			<div class="title-default">
				<a href="<?php echo esc_url($url); ?>" class="active"><?php echo esc_html($title); ?></a>
				<a href="<?php echo esc_url($url); ?>" class="view-all"><?php _e('View all', 'goliath'); ?></a>
			</div>

			<?php
			if(!empty($items))
			{
			?>
			<div class="items">

				<?php
				foreach($items as $key => $post)
				{
					setup_postdata($post);
					get_template_part('theme/templates/post-list-3-item');
				}
				?>

			</div>
			<?php } ?>

		</div>

		<?php
		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}
	
if(!function_exists('sc_latest_galleries'))
{
	function sc_latest_galleries( $atts, $content ) {
		ob_start();
		global $post;

		extract( shortcode_atts( array(
			'title' => __('Latest photo galleries', 'goliath'),
			'count' => 12,
			'interval' => 0
		), $atts ) );

		if($interval == 0 || !is_numeric($interval)) { $interval = 'false'; }

		$id = uniqid();
		$items = plsh_get_post_collection(array(), $count, 1, 'date', 'DESC', 'gallery');

		if(!empty($items))
		{ 
			$chunks = array_chunk($items, 4);
			?>
			<!-- Slider tabs -->
			<div class="container slider-tabs latest-galleries">

				<div id="carousel-<?php echo esc_attr($id); ?>" class="carousel slide" data-ride="carousel" data-interval="<?php echo esc_attr($interval); ?>">

					<div class="title-default">
						<a href="<?php echo esc_url(get_post_type_archive_link('gallery')); ?>" class="active"><?php echo esc_html($title); ?></a>
					</div>

					<?php if(count($chunks) > 1) : ?>
						<ol class="carousel-indicators">
							<?php for($i = 0; $i < count($chunks); $i++) { ?>
								<li data-target="#carousel-<?php echo esc_attr($id); ?>" data-slide-to="<?php echo esc_attr($i) ?>" <?php if($i == 0) { echo 'class="active"'; } ?>></li>
							<?php } ?>
						</ol>

						<a class="carousel-control left" href="#carousel-<?php echo esc_attr($id) ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
						<a class="carousel-control right" href="#carousel-<?php echo esc_attr($id) ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
					<?php endif; ?>

					<div class="carousel-inner items">
						<?php
							foreach($chunks as $key => $chunk)
							{
								if(!empty($chunk))
								{
								?>
									<div class="item<?php if($key == 0) { echo ' active'; } ?>">
										<?php
										foreach($chunk as $post)
										{
											setup_postdata($post);
											get_template_part('theme/templates/gallery-shortcode-item');
										}
										?>
									</div>
								<?php
								}
							}
						?>
					</div>

				</div>

			</div>
		<?php
		}

		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}

if(!function_exists('sc_review_summary'))
{
	function sc_review_summary( $atts, $content ) {
		ob_start();
		global $post;

		extract( shortcode_atts( array(
			'title' => __('Overview', 'goliath'),
			'summary' => '',
			'positives' => '',
			'negatives' => '',
			'tags' => '',
		), $atts ) );

		?>
		<div class="overview" id="<?php echo sanitize_title($title); ?>" data-text-section="true" data-title="<?php echo esc_attr($title); ?>">
			<div class="title-default">
				<a href="#" class="active"><?php echo esc_html($title); ?></a>
			</div>
			<div class="items">

				<?php if($summary != '') { ?>
				<div class="row summary">
					<label><?php _e('Summary', 'goliath'); ?></label>
					<div class="content">
						<?php echo $summary; ?>
					</div>
				</div>
				<?php } ?>

				<?php
				$positives = explode("\n", $positives);
				if(!empty($positives) && strlen(trim($positives[0])) > 0)
				{
				?>
				<div class="row list positives">
					<label><?php _e('Positives', 'goliath'); ?></label>
					<div class="content">
						<?php
							echo '<ul>';
							foreach($positives as $item)
							{
								echo '<li>' . $item . '</li>';
							}
							echo '</ul>';
						?>
					</div>
				</div>
				<?php } ?>

				<?php
				$negatives = explode("\n", $negatives);
				if(!empty($negatives) && strlen(trim($negatives[0])) > 0)
				{
				?>
				<div class="row list negatives">
					<label><?php _e('Negatives', 'goliath'); ?></label>
					<div class="content">
						<?php
							echo '<ul>';
							foreach($negatives as $item)
							{
								echo '<li>' . $item . '</li>';
							}
							echo '</ul>';
						?>
					</div>
				</div>
				<?php } ?>

				<div class="row rating">
					<?php 
						$content = strip_tags($content);
						echo do_shortcode($content); 
					?>
				</div>

			</div>
		</div>

		<?php
		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}


if(!function_exists('sc_review_summary_rating'))
{
	function sc_review_summary_rating($atts, $content) {
		ob_start();
		global $post;

		extract( shortcode_atts( array(
			'title' => '',
			'value' => '1',
			'range' => '5',
		), $atts ) );

		$value = intval($value);
		$range = intval($range);

		if($value <= $range && $value >= 0 && $range > 0)
		{
			$percent = round(($value/$range), 2) * 100;
			if( $percent > 0 && $percent <= 100)
			{
				?>
					<div class="item">
						<label><?php echo esc_html($title); ?></label>
						<div class="content">
							<span><s data-value="<?php echo esc_attr($percent); ?>"></s></span>
							<p><?php echo '<strong>' . esc_html($value) . '</strong> ' . esc_html( __('of', 'goliath') . ' ' . $range); ?></p>
						</div>
					</div>
				<?php
			}
		}
		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}

if(!function_exists('sc_gallery_post_embed'))
{
	function sc_gallery_post_embed($atts, $content) {
		ob_start();
		global $post;
		$original_post_object = $post;  //store post object

		extract( shortcode_atts( array(
			'gallery' => '',
		), $atts ) );
		?>
		<?php

		$post = get_post($gallery);
		if(!empty($post))
		{
			setup_postdata($post);

			if(class_exists('Attachments'))
			{
				$attachments = new Attachments( 'plsh_galleries' );
				if( $attachments->exist() )
				{
					?>
					<div class="gallery-widget">
						<div class="overlay">
							<div class="title">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p>
									<span class="legend-default">
										<?php 
											$date = get_the_date();
											if($date)
											{
												echo '<i class="fa fa-clock-o"></i>' . $date;
											}
										?>
										<i class="fa fa-camera"></i>
										<?php echo esc_html($attachments->total()); ?>
									</span>
								</p>
								<div class="intro">
									<a href="<?php the_permalink(); ?>" class="more-link"><?php _e('View all photos', 'goliath'); ?></a>
								</div>
							</div>
						</div>
						<div class="background">
						<?php
							for( $i = 1; $i <= 5; $i++ )
							{
								$attachment = $attachments->get();
								if($attachment)
								{
									echo $attachments->image( 'gallery-thumb-one-fourth' );
								}
							}
						?>
						</div>
					</div>
					<?php
				}
			}
		}

		$post = $original_post_object; //restore the original post

		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $return;
	}
}


if(!function_exists('sc_text_block_nav'))
{
	function sc_text_block_nav($atts, $content) {
		ob_start();
		global $post;

		extract( shortcode_atts( array(
			'title' => '',
		), $atts ) );
		?>
			<div id="<?php echo sanitize_title($title); ?>" data-text-section="true" data-title="<?php echo esc_attr($title); ?>">
				<?php echo wpautop($content); ?>
			</div>
		<?php

		$return = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return do_shortcode($return);
	}
}
	
if(!function_exists('plsh_map_to_vc'))
{
	function plsh_map_to_vc() {

		//get post categories
		$post_categories = get_terms('category');
		$post_cats = array('' => '');    //blank entry
		$posts_cats_noblank = array();
		foreach($post_categories as $pc)
		{
			$post_cats[$pc->slug] = $pc->slug;
			$posts_cats_noblank[$pc->slug] = $pc->slug;
		}

		//get post tags
		$post_tax_tags = get_terms('post_tag');
		$post_tags = array('' => ''); //blank entry
		foreach($post_tax_tags as $pt)
		{
			$post_tags[$pt->slug] = $pt->slug;
		}

		//banners 150x125
		$banners_150x125_data = plsh_get_active_banners('150x125');
		$banners_150x125 = array();
		foreach($banners_150x125_data as $banner)
		{
			$banners_150x125[$banner['ad_title']] = $banner['ad_slug'];
		}

		//banners 300x250
		$banners_300x250_data = plsh_get_active_banners('300x250');
		$banners_300x250 = array();
		foreach($banners_300x250_data as $banner)
		{
			$banners_300x250[$banner['ad_title']] = $banner['ad_slug'];
		}

		//banners_468x60
		$banners_468x60_data = plsh_get_active_banners('468x60');
		$banners_468x60 = array();
		foreach($banners_468x60_data as $banner)
		{
			$banners_468x60[$banner['ad_title']] = $banner['ad_slug'];
		}

		//banners 728x90
		$banners_728x90_data = plsh_get_active_banners('728x90');
		$banners_728x90 = array();
		foreach($banners_728x90_data as $banner)
		{
			$banners_728x90[$banner['ad_title']] = $banner['ad_slug'];
		}

		//galleries
		$galleries_data = plsh_get_post_collection(array(), 999, 1, 'date', 'DESC', 'gallery');
		$galleries = array();

		foreach($galleries_data as $gallery)
		{
			$galleries[$gallery->post_title] = $gallery->ID;
		}


		//Mosaic
		vc_map( array(
			"name" => __("Mosaic", 'goliath'),
			"description" => __("Full page width element", 'goliath'),
			"base" => "mosaic",
			"class" => "",
			"category" => __('Goliath Hompage Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post category", 'goliath'),
					 "param_name" => "category",
					 "value" => $post_cats,
					 "description" => __("List posts from specific category", 'goliath')
				  ),
				  array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post tag", 'goliath'),
					 "param_name" => "tag",
					 "value" => $post_tags,
					 "description" => __("List posts with specific tag", 'goliath')
				  ),
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Max page count", 'goliath'),
					 "param_name" => "max",
					 "value" => 5,
					 "description" => __("How many times should it be possible to load more stories?", 'goliath')
				  ),
			),
		  )
		);

		vc_map( array(
			"name" => __("Post slider", 'goliath'),
			"description" => __("Full page width element", 'goliath'),
			"base" => "slider",
			"class" => "",
			"category" => __('Goliath Hompage Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Title", 'goliath'),
					 "param_name" => "title",
					 "value" => __("Featured articles", 'goliath'),
					 "description" => __("The title for post slider block", 'goliath')
				),
				array(
					//"type" => "multiple_select",
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __("Post category", 'goliath'),
					"param_name" => "category",
					"value" => $post_cats,
					"description" => __("Categories for the slider", 'goliath')
				),
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post tag", 'goliath'),
					 "param_name" => "tag",
					 "value" => $post_tags,
					 "description" => __("List posts with specific tag", 'goliath')
				),
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Count", 'goliath'),
					 "param_name" => "count",
					 "value" => 12,
					 "description" => __("How many posts should be shown", 'goliath')
				),
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Interval", 'goliath'),
					 "param_name" => "interval",
					 "value" => 0,
					 "description" => __("The amount of miliseconds to delay between advancing the slider. Entering 0 will disable auto advance.", 'goliath')
				),
				array(
					 "type" => "vc_link",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Title link", 'goliath'),
					 "param_name" => "url",
					 "value" => '',
					 "description" => __("Where should the link lead to?", 'goliath')
				),
			)
		  )
		);

		vc_map( array(
			"name" => __("Post List With Slider", 'goliath'),
			"description" => __("2/3 page width element", 'goliath'),
			"base" => "post_list_1",
			"class" => "",
			"category" => __('Goliath Hompage Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Title", 'goliath'),
					 "param_name" => "title",
					 "value" => __("Latest news", 'goliath'),
					 "description" => __("The title for post block", 'goliath')
				),
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Count", 'goliath'),
					 "param_name" => "count",
					 "value" => __(4),
					 "description" => __("How many posts should be shown", 'goliath')
				),
				array(
					 "type" => "vc_link",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("More link", 'goliath'),
					 "param_name" => "url",
					 "value" => '',
					 "description" => __("Where should the your visitors find more posts like this", 'goliath')
				),
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post category (for list)", 'goliath'),
					 "param_name" => "category",
					 "value" => $post_cats,
					 "description" => __("List posts from specific category", 'goliath')
				),
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post tag (for list)", 'goliath'),
					 "param_name" => "tag",
					 "value" => $post_tags,
					 "description" => __("List posts with specific tag", 'goliath')
				),
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post tag (for slider)", 'goliath'),
					 "param_name" => "slider_tag",
					 "value" => $post_tags,
					 "description" => __("Additional tag (posts are selected using the main category/tag above) for items to show in slider. Posts with this tag will appear only in slider.", 'goliath')
				),
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Interval between slides (in miliseconds)", 'goliath'),
					 "param_name" => "timeout",
					 "value" => 0,
					 "description" => __("How many miliseconds (5sec = 5000) should elapse before slide is changed. 0 disables slide auto advance.", 'goliath')
				),
			),
		  )
		);


		vc_map( array(
			"name" => __("Banners 150x125", 'goliath'),
			"base" => "banner150",
			"class" => "",
			"category" => __('Goliath Banners', 'goliath'),
			"params" => array(
				array(
					 "type" => "checkbox",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Banners", 'goliath'),
					 "param_name" => "banner",
					 "value" => $banners_150x125,
					 "description" => __("Display four 150x125px banners. Check more than one to have multiple banners in rotation", 'goliath')
				),
			)   
		  )
		);


		vc_map( array(
			"name" => __("Banner 300x250", 'goliath'),
			"base" => "banner300",
			"class" => "",
			"category" => __('Goliath Banners', 'goliath'),
			"params" => array(
				array(
					 "type" => "checkbox",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Banner", 'goliath'),
					 "param_name" => "banner",
					 "value" => $banners_300x250,
					 "description" => __("Display 300x250px banners.  Check more than one to have multiple banners in rotation", 'goliath')
				),
			)   
		  )
		);

		vc_map( array(
			"name" => __("Banner 468x60", 'goliath'),
			"base" => "banner468",
			"class" => "",
			"category" => __('Goliath Banners', 'goliath'),
			"params" => array(
				array(
					 "type" => "checkbox",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Banner", 'goliath'),
					 "param_name" => "banner",
					 "value" => $banners_468x60,
					 "description" => __("Display 468x60px banners.  Check more than one to have multiple banners in rotation", 'goliath')
				),
			)   
		  )
		);

		vc_map( array(
			"name" => __("Banner 728x90", 'goliath'),
			"base" => "banner728",
			"class" => "",
			"category" => __('Goliath Banners', 'goliath'),
			"params" => array(
				array(
					 "type" => "checkbox",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Banner", 'goliath'),
					 "param_name" => "banner",
					 "value" => $banners_728x90,
					 "description" => __("Display 728x90 banners. Check more than one to have multiple banners in rotation", 'goliath')
				),
			)  
		  )
		);

		vc_map( array(
			"name" => __("Post List With Heading", 'goliath'),
			"description" => __("Liquid width element (best up to 1/2)", 'goliath'),
			"base" => "post_list_2",
			"class" => "",
			"category" => __('Goliath Hompage Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Title", 'goliath'),
					 "param_name" => "title",
					 "value" => __("Latest news", 'goliath'),
					 "description" => __("The title for post block", 'goliath')
				),
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Count", 'goliath'),
					 "param_name" => "count",
					 "value" => __(4),
					 "description" => __("How many posts should be shown", 'goliath')
				),
				array(
					 "type" => "vc_link",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("More link", 'goliath'),
					 "param_name" => "url",
					 "value" => '',
					 "description" => __("Where should the your visitors find more posts like this", 'goliath')
				),
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post category (for list)", 'goliath'),
					 "param_name" => "category",
					 "value" => $post_cats,
					 "description" => __("List posts from specific category", 'goliath')
				),
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post tag (for list)", 'goliath'),
					 "param_name" => "tag",
					 "value" => $post_tags,
					 "description" => __("List posts with specific tag", 'goliath')
				),
			)
		  )
		);

		vc_map( array(
			"name" => __("Horizontal Post List", 'goliath'),
			"description" => __("2/3 page width element", 'goliath'),
			"base" => "post_list_3",
			"class" => "",
			"category" => __('Goliath Hompage Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Title", 'goliath'),
					 "param_name" => "title",
					 "value" => __("Latest news", 'goliath'),
					 "description" => __("The title for post block", 'goliath')
				),
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Count", 'goliath'),
					 "param_name" => "count",
					 "value" => 3,
					 "description" => __("How many posts should be shown", 'goliath')
				),
				array(
					 "type" => "vc_link",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("More link", 'goliath'),
					 "param_name" => "url",
					 "value" => '',
					 "description" => __("Where should the your visitors find more posts like this", 'goliath')
				),
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post category (for list)", 'goliath'),
					 "param_name" => "category",
					 "value" => $post_cats,
					 "description" => __("List posts from specific category", 'goliath')
				),
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Post tag (for list)", 'goliath'),
					 "param_name" => "tag",
					 "value" => $post_tags,
					 "description" => __("List posts with specific tag", 'goliath')
				),
			)
		  )
		); 

		vc_map( array(
			"name" => __("Latest Galleries", 'goliath'),
			"description" => __("Full width element", 'goliath'),
			"base" => "latest_galleries",
			"class" => "",
			"category" => __('Goliath Hompage Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Title", 'goliath'),
					 "param_name" => "title",
					 "value" => __("Latest galleries", 'goliath'),
					 "description" => __("The title for galleries block", 'goliath')
				),
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Count", 'goliath'),
					 "param_name" => "count",
					 "value" => 12,
					 "description" => __("How many posts should be shown", 'goliath')
				),
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Interval", 'goliath'),
					 "param_name" => "interval",
					 "value" => 0,
					 "description" => __("The amount of miliseconds to delay between advancing the slider. Entering 0 will disable auto advance.", 'goliath')
				),
			),      
		  )
		); 


		vc_map( array(
			"name" => __("Review Summary", 'goliath'),
			"base" => "review_summary",
			"class" => "",
			"category" => __('Goliath Post Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Title", 'goliath'),
					 "param_name" => "title",
					 "value" => __("Summary", 'goliath'),
					 "description" => __("Summary for the review", 'goliath')
				),
				array(
					 "type" => "textarea",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Summary", 'goliath'),
					 "param_name" => "summary",
					 "value" => "",
					 "description" => __("Brief summary", 'goliath')
				),
				array(
					 "type" => "textarea",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Positives", 'goliath'),
					 "param_name" => "positives",
					 "value" => "",
					 "description" => __("List of positives. Enter each item in new row.", 'goliath')
				),
				array(
					 "type" => "textarea",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Negatives", 'goliath'),
					 "param_name" => "negatives",
					 "value" => "",
					 "description" => __("List of negatives. Enter each item in new row.", 'goliath')
				),
				array(
					 "type" => "textarea",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Rating", 'goliath'),
					 "param_name" => "content",
					 "value" => "",
					 "description" => __('List of Ratings. Enter them in format like this: [rating title="Design" value="4" range="5"] This will result in "Design" being rated with 4 out of 5', 'goliath')
				), 
			)
		  )
		); 

		vc_map( array(
			"name" => __("Gallery Post Embed", 'goliath'),
			"base" => "gallery_post_embed",
			"class" => "",
			"category" => __('Goliath Post Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Gallery", 'goliath'),
					 "param_name" => "gallery",
					 "value" => $galleries,
					 "description" => __("Select which gallery to embed in the post", 'goliath')
				),
			)
		));


		vc_map( array(
			"name" => __("Text block with navigation", 'goliath'),
			"base" => "text_block_nav",
			"class" => "",
			"category" => __('Goliath Post Blocks', 'goliath'),
			"params" => array(
				array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Section title", 'goliath'),
					 "param_name" => "title",
					 "value" => "",
					 "description" => __("Title that's used in the navigation bar", 'goliath')
				),
				array(
					 "type" => "textarea_html",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Text", 'goliath'),
					 "param_name" => "content",
					 "value" => "",
					 "description" => __('Text content for the section', 'goliath')
				), 
			)
		));
	}
}