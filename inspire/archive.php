<?php get_header(); ?>

		<?php 

			$type = mb_get_page_type(); 
			switch ($type) {
				case 'category':
					$titlebar_description = __('Browsing Category', 'loc_inspire');
					$titlebar_name = single_cat_title('', false);
					break;
				case 'tag':
					$titlebar_description = __('Browsing Tag', 'loc_inspire');
					$titlebar_name = single_tag_title('', false);
					break;
				case 'search':
					$titlebar_description = __('Search Results For', 'loc_inspire');
					$titlebar_name = get_search_query();
					break;
				case 'author':
					$titlebar_description = __('Browsing Author', 'loc_inspire');
					$titlebar_name = get_the_author_meta('display_name',$wp_query->post->post_author);
					break;
				case 'day':
					$titlebar_description = __('Browsing Day', 'loc_inspire');
					$titlebar_name =  get_the_time('d/m/Y');
					break;
				case 'month':
					$titlebar_description = __('Browsing Month', 'loc_inspire');
					$titlebar_name = get_the_time('m/Y');
					break;
				case 'year':
					$titlebar_description = __('Browsing Year', 'loc_inspire');
					$titlebar_name = get_the_time('Y');
					break;
				default:
					$titlebar_description = __('Browsing', 'loc_inspire');
					$titlebar_name = __('Unknown', 'loc_inspire');
					break;
			}

			$inspire_options_hp = get_option('inspire_options_hp');
			
		 ?>
		
		<div id="filter" 
			data-page_type="<?php echo $type; ?>" 
			data-category="<?php echo $titlebar_name; ?>" 
			data-subfilter="<?php _e('Latest', 'loc_inspire'); ?>" 
			data-current_page="1" 
			data-more_posts="true"
			data-search_query="<?php echo get_search_query(); ?>"
			data-author_ID="<?php if ($posts) echo $posts[0]->post_author; ?>"
			data-tag="<?php if (get_queried_object()) echo get_queried_object()->slug; ?>"
			data-status="ready"
		>

			<ul class="archive">
				<li class="browsing"><?php echo $titlebar_description; ?>:</li>
				<li><?php echo $titlebar_name; ?></li>
			</ul>
			
			<ul id="filter_subfilter" class="sort">
				<?php if (isset($inspire_options_hp['subfilter_show_latest'])) {?><li><a href="#"><?php _e('Latest', 'loc_inspire'); ?></a></li><?php ;} ?>
				<?php if (isset($inspire_options_hp['subfilter_show_likes'])) {?><li><a href="#"><?php _e('Likes', 'loc_inspire'); ?></a></li><?php ;} ?>
				<?php if (isset($inspire_options_hp['subfilter_show_comments'])) {?><li><a href="#"><?php _e('Comments', 'loc_inspire'); ?></a></li><?php ;} ?>
				<?php if (isset($inspire_options_hp['subfilter_show_random'])) {?><li><a href="#"><?php _e('Random', 'loc_inspire'); ?></a></li><?php ;} ?>
			</ul>
			
		</div>

		<div id="main">
			
		</div>
		
		<!-- BEGIN LOAD MORE -->
		<div class="load-more">
			<div id="ajax_loading_zone"></div>
			<span class='load_more'><?php _e('Load More', 'loc_inspire'); ?></span>
			<span class='no_more'><?php _e('No More Posts', 'loc_inspire'); ?></span>
		</div>
		<!-- END LOAD MORE -->
			
<?php get_footer(); ?>