<?php
// &filters=id;id;id;id
$themeOptions = aitOptions()->getOptionsByType('theme');
$advancedFiltersOptions = (object)$themeOptions['itemAdvancedFilters'];

if($advancedFiltersOptions->enabled){
	$filters_avalaible = get_terms('ait-items_filters', array('hide_empty' => false));
	$filters_enabled = array();
	if(isset($_REQUEST['filters']) && !empty($_REQUEST['filters'])){
		$filters_enabled = explode(";",$_REQUEST['filters']);
	}

	if($query->max_num_pages != 1){
		// check if there will be pagination
		$item_query_args = $query->query_vars;	// populate new variable ... dont modify original query
		$item_query_args['nopaging'] = true;
		$item_query = new WP_Query($item_query_args);
	} else {
		$item_query = $query;
	}

	$item_filters = array();
	foreach($item_query->posts as $post){
		$post_meta = get_post_meta( $post->ID, '_ait-item_filters-options');
		if(!empty($post_meta)){
			$post_filters = $post_meta[0]['filters'];
			foreach ($post_filters as $id) {
				$filter = get_term($id, 'ait-items_filters', "OBJECT");
				if(!empty($filter)){
					array_push($item_filters, $filter);
				}
			}
		}
	}
	$unique_filters = array_map("unserialize", array_unique(array_map("serialize", $item_filters)));
	$filters_avalaible = $unique_filters;

	usort($filters_avalaible, function($a, $b){
		return strcmp($a->slug, $b->slug);
	});

	?>
	<?php
		if(is_array($filters_avalaible) && count($filters_avalaible) > 0){
	?>
		<div class="advanced-filters-wrap">
			<div class="advanced-filters-container">
				<div class="content">

							<ul class="advanced-filters columns-<?php echo $advancedFiltersOptions->filterColumns ?>">
								<?php foreach($filters_avalaible as $filter){
									if(!empty($filter)){
										$filter_options = get_option( "ait-items_filters_category_".$filter->term_id );
										$filter_type = isset($filter_options['type']) ? $filter_options['type'] : 'checkbox';
										$is_enabled = in_array($filter->term_id, $filters_enabled);
										$li_class = "";
										$in_checked = "";
										if($is_enabled){
											$li_class = "filter-enabled";
											$in_checked = "checked";
										}

										switch($filter_type){
											case 'checkbox':
												/*$imageClass = !empty($filter_options['icon']) ? 'has-image' : '';*/
												$imageClass = 'has-image';
												$image = !empty($filter_options['icon']) ? '<i class="fa '.$filter_options['icon'].'"></i>' : '<i class="fa fa-dot-circle-o"></i>';
												echo '<li class="filter-container filter-checkbox '.$li_class.' '.$imageClass.' "><input type="checkbox" name="'.$filter->slug.'" value="'.$filter->term_id.'" '.$in_checked.'>'.$image.'<span class="filter-name">'.$filter->name.'</span></li>';
											break;
											default:
												echo '<li class="filter-container filter-unsupported">'.__('Unsupported filter', 'ait-advanced-filters').'</li>';
											break;
										}
									}
								} ?>
							</ul>

				</div>
			</div>
			<div class="advanced-filters-actions">
				<a href="#" class="filter-action-filterme ait-sc-button"><?php _e('Apply Filter', 'ait-advanced-filters') ?></a>
			</div>

			<script type="text/javascript">
			jQuery(document).ready(function(){
				// filter type actions

				// checkbox
				jQuery('.advanced-filters-wrap ul li.filter-checkbox').on('click', function(e){
					jQuery(this).toggleClass('filter-enabled');
					var $input = jQuery(this).find('input');
					if($input.is(':checked')){
						$input.removeAttr('checked');
					} else {
						$input.attr('checked', true);
					}
				});

				// filter submit actions
				jQuery('.advanced-filters-wrap .filter-action-filterme').on('click', function(e){
					e.preventDefault();
					// build new query
					var filterString = "";
					var filterCheck = 0;
					// &filters=id;id;id
					jQuery('.advanced-filters-wrap ul li').each(function(){
						var $input = jQuery(this).find('input');
						if($input.is(':checked')){
							filterString = filterString + $input.val() + " ";
							filterCheck += 1;
						}
					});
					filterString = filterString.trim().replace(new RegExp(' ', 'g'), ";");

					var baseUrl = window.location.protocol+"//"+window.location.host+window.location.pathname;
					var eParams = window.location.search.replace("?", "").split('&');
					var nParams = {};
					jQuery.each(eParams, function(index, value){
						var val = value.split("=");
						if(typeof val[1] == "undefined"){
							nParams[val[0]] = "";
						} else {
							nParams[val[0]] = decodeURIComponent(val[1]);
						}
					});
					var query = jQuery.extend({}, nParams, { filters: filterString });
					if(filterCheck == 0){
						delete query.filters;
					}
					delete query.paged;
					delete query.count;

					// remove empty keys
					jQuery.each(query, function(k, v){
						if(!k){
							delete query[k];
						}
					});

					var queryString = jQuery.param(query);
					window.location.href = baseUrl + "?" + queryString;
				});
			});
			</script>
		</div>
<?php
		}
	}
?>