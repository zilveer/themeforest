<?php
global $options_data, $post;
global $wp_query;
$revAliases = '';
if(class_exists('RevSlider')){
    $slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) { 
		$revAliases .= $revSlider->getAlias().', '; 
	}
}
$page_shop = '';
if(isset($wp_query->queried_object->ID)) {$postid=$wp_query->queried_object->ID;} else {$postid='';}
if($postid == '' && class_exists('WooCommerce')) {$postid = woocommerce_get_page_id('shop');} 
if(isset($post) && $postid == '') {$postid = $post->ID;}

if (get_post_meta( $postid, 'richer_revolutionslider', true ) != '' && get_post_meta( $postid, 'richer_revolutionslider', true ) != '0' && get_post_meta( $postid, 'richer_revolutionslider', true ) != 'No Slider') { 
		$revAlias = get_post_meta( $postid, 'richer_revolutionslider', true );
		$aliasCheck = strpos($revAliases, $revAlias);
		if(class_exists('RevSlider') && $aliasCheck !== false){ putRevSlider(get_post_meta( $postid, 'richer_revolutionslider', true )); }
}
if (class_exists('WooCommerce')) {
	if(is_shop()){
		$page_shop=true;
	} else {
		$page_shop=false;
	}
}
 /* end slidertype = revslider */ 
	//Title Bar
	 ?>
	 	<?php if ($options_data['switch_titlebar'] != 1 && (get_post_meta( $postid, 'richer_titlebar', true ) != 'titlebar' || get_post_meta( $postid, 'richer_titlebar', true ) != 'featuredimage')) { ?>
				<div id="no-title"></div> 
		<?php } elseif (get_post_meta( $postid, 'richer_titlebar', true ) == 'notitlebar') { ?>
				<div id="no-title"></div> 
		<?php } elseif ( get_post_meta( $postid, 'richer_titlebar', true ) == 'featuredimage' ) { 

			$titlebar_title = get_post_meta( $postid, 'richer_title', true );
			$images = rwmb_meta( 'richer_bg_image', 'type=image', $postid);
			foreach ( $images as $image )
			{
				$src = $image['full_url'];
				break;
			}
			if(!isset($src)) $src = '';
			if(get_post_meta( $postid, 'richer_title_aligment', true ) == 'right'){
				$title_pos = 'text-align:right;';
				$crumbs_pos = 'text-align:left;';
				$first_col ='span7 fright';
				$second_col ='span5 fleft';
			} else if(get_post_meta( $postid, 'richer_title_aligment', true ) == 'center'){
				$title_pos = 'text-align:center;';
				$crumbs_pos = 'text-align:center;';
				$first_col ='span12';
				$second_col ='span12';
			} else if(get_post_meta( $postid, 'richer_title_aligment', true ) == 'left_crumbs'){
				$title_pos = 'text-align:left;';
				$crumbs_pos = 'text-align:left;';
				$first_col ='span12';
				$second_col ='span12';
			}	else if(get_post_meta( $postid, 'richer_title_aligment', true ) == 'right_crumbs'){
				$title_pos = 'text-align:right;';
				$crumbs_pos = 'text-align:right;';
				$first_col ='span12';
				$second_col ='span12';
			} else {
				$title_pos = '';
				$first_col ='span7';
				$second_col = 'span5';
				$crumbs_pos = '';
			}
			if(get_post_meta( $postid, 'richer_bg_fullscreen', true ) != 0){
				$bg_size = 'background-size: cover;';
			} else {
				$bg_size = '';
			}
			if(get_post_meta( $postid, 'richer_bg_fixed_titlebar', true ) != 0){
				$bg_fixed = 'background-attachment: fixed;';
			} else {
				$bg_fixed = '';
			}
			$padding_style = '';
			$outter_padding = get_post_meta( $postid, 'richer_titlebar_outer_padding', true);
			if(strpos($outter_padding, '|')){
				$outter_padding = !empty($outter_padding) ? explode("|", trim($outter_padding)) : array();
				$padding_style = 'padding:'.$outter_padding[0].'px 0 '.$outter_padding[1].'px;';
			} elseif($outter_padding != '') {
				$padding_style = 'padding:'.$outter_padding.'px 0';
			}
			$padding_style2 = '';
			$inner_padding = get_post_meta( $postid, 'richer_titlebar_inner_padding', true);
			if(strpos($inner_padding, '|')){
				$outter_padding = !empty($inner_padding) ? explode("|", trim($inner_padding)) : array();
				$padding_style2 = 'padding:'.$inner_padding[0].'px 0 '.$inner_padding[1].'px;';
			} elseif($inner_padding != '') {
				$padding_style2 = 'padding:'.$inner_padding.'px 0';
			}
			$fancy_titlebar_style = '<style>
			#alt-title {
				border-color:'.get_post_meta( $postid, 'richer_border_color', true).';
				'.$padding_style.';
				background-color:'.get_post_meta( $postid, 'richer_bg_color', true ).';
				background-repeat:'.get_post_meta( $postid, 'richer_bg_repeat', true ).'; 
				background-image: url('.$src.');'.$bg_size.$bg_fixed.'background-position:'.get_post_meta( $postid, 'richer_bg_position_x', true ).' '.get_post_meta( $postid, 'richer_bg_position_y', true ).';
			}
			#alt-title .grid {
			background:rgba('.HexToRGB(get_post_meta( $postid, 'richer_bg_color', true )).','.get_post_meta( $postid, 'richer_bg_opacity', true ).');
			'.$padding_style2.';}
			#alt-title h1 {color:'.get_post_meta( $postid, 'richer_title_color', true ).'; '.$title_pos.'}
			#alt-title h1 span {background-color:'.get_post_meta( $postid, 'richer_title_bg_color', true ).';}
			#alt-title h2 {color:'.get_post_meta( $postid, 'richer_subtitle_color', true ).'; '.$title_pos.'}
			#alt-title h2 span {background-color:'.get_post_meta( $postid, 'richer_subtitle_bg_color', true ).';}
			#alt-title #breadcrumbs, #alt-title #breadcrumbs a {color:'.get_post_meta( $postid, 'richer_subtitle_color', true ).'; '.$crumbs_pos.'}
			#alt-title #breadcrumbs #crumbs {background-color:'.get_post_meta( $postid, 'richer_subtitle_bg_color', true ).';}
			</style>';
			echo $fancy_titlebar_style;
		?>
		
			<div id="alt-title">
				<div class="grid">
					<div class="container">
						<div class="<?php echo $first_col; ?>">
							<?php if($titlebar_title != '') {?>
							<h1><span><?php echo $titlebar_title; ?></span></h1>
							<?php } /* If this is a category archive */ else if (is_category()) { ?>
								<h1><span><?php _e('Category Archive for :', 'richer') ?> &#8216;<?php single_cat_title(); ?>&#8217; </span></h1>
								
							<?php /* If this is a tag archive */ } elseif( class_exists('WooCommerce') && is_product_category() ) { ?>
								<h1><?php _e('Product Category :', 'richer') ?> <?php single_cat_title(); ?></h1>

							<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
								<h1><span><?php _e('Posts Tagged', 'richer') ?> &#8216;<?php single_tag_title(); ?>&#8217;</span></h1>

							<?php /* If this is a search page */ } elseif( is_search() ) { ?>
								<h1><span><?php echo "".$wp_query->found_posts." ".__('search results for', 'richer').": \"".esc_attr( get_search_query() )."\""; ?></span></h1>

							<?php /* If this is a daily archive */ } elseif (is_day() || is_month() || is_year()) { ?>
								<h1><span><?php _e('Archive for', 'richer') ?> <?php the_time(get_option('date_format')); ?></span></h1>

							<?php /* If this is an author archive */ } elseif (is_author()) { ?>
								<h1><span><?php _e('Author Archive', 'richer') ?></span></h1>

							<?php /* If this is a shop page */ } elseif ($page_shop==true) { ?>
								<h1><span><?php _e('Shop', 'richer') ?></span></h1>

							<?php /* If this is a 404 page */ } elseif (is_404()) { ?>
								<h1><span><?php _e('Error 404', 'richer') ?></span></h1>
								
							<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
								<h1><span><?php _e('Blog Archives', 'richer') ?></span></h1>
							<?php /* If this is a blog */ } elseif(is_home()) {?>
							<h1><span><?php echo apply_filters('richer_text_translate', 'text_blogtitle', $options_data['text_blogtitle']); ?></span></h1>
							<?php }	else {?>
							<h1><span><?php the_title(); ?></span></h1>
							<?php }
							if(get_post_meta( $postid, 'richer_subtitle', true ) != ''){
								echo "<h2><span>".get_post_meta( $postid, 'richer_subtitle', true )."</span></h2>";
							}
							?>

						</div>
						<div class="<?php echo $second_col; ?>">
							<?php if(get_post_meta( $postid, 'richer_crumbs_check', true ) != 0) { ?>
									<div id="breadcrumbs">
										<?php  richer_breadcrumbs(); ?>
									</div>
								<?php }?>
						</div>
					</div>
				</div>
			</div>
					
		<?php } else {

			if($options_data['titlebar_alignment'] == 'right'){
				$first_col ='span7 fright';
				$second_col ='span5 fleft';
			} else if($options_data['titlebar_alignment'] == 'center'){
				$first_col ='span12';
				$second_col ='span12';
			} else {
				$first_col ='span7';
				$second_col = 'span5';
			}?>
	
			<div id="title">
				<div class="inner">
					<div class="container">
						<div class="<?php echo $first_col; ?>">
							<?php /* If this is a category archive */ if (is_category()) { ?>
								<h1><?php _e('Category Archive for :', 'richer') ?> &#8216;<?php single_cat_title(); ?>&#8217; </h1>

							<?php /* If this is a tag archive */ } elseif( class_exists('WooCommerce') && is_product_category() ) { ?>
								<h1><?php _e('Product Category :', 'richer') ?> <?php single_cat_title(); ?></h1>

							<?php /* If this is a search page */ } elseif( is_tag() ) { ?>
								<h1><?php _e('Posts Tagged', 'richer') ?> &#8216;<?php single_tag_title(); ?>&#8217;</h1>

							<?php /* If this is a search page */ } elseif( is_search() ) { ?>
								<h1><?php echo "".$wp_query->found_posts." ".__('search results for', 'richer').": \"".esc_attr( get_search_query() )."\""; ?></h1>

							<?php /* If this is a daily archive */ } elseif (is_day() || is_month() || is_year()) { ?>
								<h1><span><?php _e('Archive for', 'richer') ?> <?php the_time(get_option('date_format')); ?></span></h1>

							<?php /* If this is an author archive */ } elseif (is_author()) { ?>
								<h1><?php _e('Author Archive', 'richer') ?></h1>
							<?php /* If this is a 404 page */ } elseif (is_404()) { ?>
								<h1><?php _e('Error 404', 'richer') ?></h1>

							<?php /* If this is a shop page */ } elseif ($page_shop == true) { ?>
								<h1><?php if($options_data['text_shoptitle'] !='') {echo apply_filters('richer_text_translate', 'text_shoptitle', $options_data['text_shoptitle']); } else {_e('Shop', 'richer');} ?></h1>

							<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
								<h1><?php _e('Blog Archives', 'richer') ?></h1>
							<?php /* If this is a blog */ } elseif(is_home()) {?>
							<h1><?php echo apply_filters('richer_text_translate', 'text_blogtitle', $options_data['text_blogtitle']); ?></h1>
							<?php } else {?>
							<h1><?php the_title(); ?></h1>
							<?php }?>
						</div>
						<div class="<?php echo $second_col; ?>">
							<?php if($options_data['check_breadcrumbs'] != 0) { ?>
								<div id="breadcrumbs">
									<?php  richer_breadcrumbs(); ?>
								</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
					
		<?php } ?>

