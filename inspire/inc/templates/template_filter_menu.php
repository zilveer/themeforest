		<div id="filter" 
			data-page_type="<?php echo mb_get_page_type(); ?>" 
			data-category="<?php _e('Show all', 'loc_inspire'); ?>"
			data-subfilter="<?php _e('Latest', 'loc_inspire'); ?>" 
			data-current_page="1" 
			data-more_posts="true"
			data-search_query="<?php echo get_search_query(); ?>"
			data-author_ID=""
			data-tag=""
			data-status="ready"
		>

			<ul id="filter_category">
			<?php 

				//build include string
				$inspire_options_hp = get_option('inspire_options_hp');
				$include_string = " ";

				if (!empty($inspire_options_hp['cat_ID'])) {
					foreach ($inspire_options_hp["cat_ID"] as $key => $value) {
						$include_string .= 	$key . ",";
					}
					$include_string = substr($include_string,0,strlen($include_string)-1);
				} 

				wp_list_categories(array(
					'show_option_all' => __("Show all", "loc_inspire"),
					'include' => $include_string,
					'title_li' => ""

				)); 
			?>
				<li>
 					<div id="loading-image"><img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif"></div>
				</li>
			</ul>

			<ul id="filter_subfilter" class="sort">
				<?php if (isset($inspire_options_hp['subfilter_show_latest'])) {?><li><a href="#"><?php _e('Latest', 'loc_inspire'); ?></a></li><?php ;} ?>
				<?php if (isset($inspire_options_hp['subfilter_show_likes'])) {?><li><a href="#"><?php _e('Likes', 'loc_inspire'); ?></a></li><?php ;} ?>
				<?php if (isset($inspire_options_hp['subfilter_show_comments'])) {?><li><a href="#"><?php _e('Comments', 'loc_inspire'); ?></a></li><?php ;} ?>
				<?php if (isset($inspire_options_hp['subfilter_show_random'])) {?><li><a href="#"><?php _e('Random', 'loc_inspire'); ?></a></li><?php ;} ?>
			</ul>
			
		</div>
