<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


class AitGetItemsAjax extends AitFrontendAjax
{

	protected $lastDate       = '';
	protected $dates          = array();
	protected $args           = array();
	protected $lang           = 'en';
	protected $posts_per_page = -1;
	protected $offset         = 0;
	protected $taxQuery       = array();
	protected $order          = 'ASC';
	protected $orderBy        = 'date';
	protected $found_posts    = 0;

	/**
	 * @WpAjax
	 */
	public function retrieve()
	{
		switch ($_POST['type']) {
			case 'sidebarTimelineTemplate':
				$this->lastDate       = $_POST['lastDate'];
				$this->dates          = aitGetAllRecurringDates();
				$this->lang           = $_POST['params']['lang'];
				$this->posts_per_page = $_POST['posts_per_page'];
				$this->offset         = $_POST['offset'];
				$this->found_posts    = $_POST['found_posts'];

				if (empty($this->lastDate) ) {
					$this->lastDate = aitGetNextDate($this->dates);
				}

				$html_data = '';

				$markers = array();

				$count = $this->posts_per_page;


				for ($i=0; $i < $count; $i) {
					if ($this->found_posts == $this->offset) {
						// new date
						$this->lastDate = aitGetNextDate($this->dates, $this->lastDate);
						$header = true;
						$this->offset = 0;
					} elseif($this->found_posts < 0) {
						// is first search
						$header = true;
						$this->offset = 0;
					} else {
						$header = false;
					}

					if (empty($this->lastDate)) {
						break;
					}

					$this->prepareTimelineArgs();


					$eventsQuery = aitGetItems($this->args);

					$events = $this->prepareTimelineEvents($eventsQuery);

					if (sizeof($events) > 0) {
						$markersArray = aitGetEventsMarkers($eventsQuery);
						foreach ($markersArray as $key => $marker) {
							array_push($markers, $marker);
						}

						$html_data .= $this->getSidebarTimelineEventsHtml($events, $header);
					}


					$this->posts_per_page -= sizeof($events);

					$this->offset += sizeof($events);

					$this->found_posts = $eventsQuery->found_posts;

					$i += sizeof($events);

				}

				// check if there will be available event in next call
				$nextAvailableDate = aitGetNextDate($this->dates, $this->lastDate);
				if ($this->found_posts == $this->offset && empty($nextAvailableDate)) {
					$this->lastDate = array();
				}



				$data['lastDate']       = $this->lastDate;
				$data['offset']         = $this->offset;
				$data['request_data']   = $_POST;
				$data['count']          = sizeof($markers);
				$data['found_posts']    = $this->found_posts;
				$data['events_markers'] = $markers;
				break;

			case 'pagedPosts':
				$this->offset         = $_POST['offset'];
				$this->lang           = $_POST['lang'];
				$this->posts_per_page = $_POST['posts_per_page'];
				$this->orderBy        = $_POST['orderby'];
				$this->order          = $_POST['order'];

				if ($_POST['postType'] == 'ait-event-pro') {
					$this->prepareEventArgs();
					$query = aitGetItems($this->args);
					$html_data = $this->preparePagedEvents($query);
				} else {
					$this->prepareItemArgs();
					$query = aitGetItems($this->args);
					$html_data = $this->preparePagedItems($query);
				}
				$data['request_data'] = $_POST;
				break;
			default:
				break;
		}
		$this->sendJson(array(
			'message' => __("Have posts", 'ait'),
			'raw_data' => $data,
			'html_data' => $html_data,
		));

	}



	/**
	 * @WpAjax
	 */
	public function initFilter()
	{
		$html_data = $this->getRelatedEventsCategories($_POST['itemId']);

		$this->sendJson(array(
			'message' => __("Have posts", 'ait'),
			// 'raw_data' => $data,
			'html_data' => $html_data,
		));

	}


	public function prepareEventArgs()
	{

		$metaQuery = array(
			'relation' => 'AND',
			'dates_clause' => array(
				'key'     => 'ait-event-recurring-date',
				'value'   => date('Y-m-d'),
				'compare' => '>',
				'type' => 'date',
			)
		);
		if ($this->orderBy == 'eventDate') {
			$orderBy['dates_clause'] = $this->order;
		}


		$taxQuery = array();

		if (isset($_POST['taxonomy'])) {
			$taxQuery = array(
				array(
					'taxonomy' => $_POST['taxonomy']['taxonomy'],
					'field'    => 'id',
					'terms'    => $_POST['taxonomy']['id']
				)
			);
		}


		if (isset($_POST['itemId'])) {
			$metaQuery['related_clause'] = array(
				'key' => 'ait-event-pro-related-item',
				'value' => $_POST['itemId'],
				'compare' => '=',
			);
		}

		$orderBy[$this->orderBy] = $this->order;

		$this->args = array(
			'post_type'      => $_POST['postType'],
			'post_status'    => 'publish',
			'posts_per_page' => $this->posts_per_page,
			'offset'         => $this->offset,
			'lang'           => $this->lang,
			'tax_query'      => $taxQuery,
			'meta_query'     => $metaQuery,
			'orderby'        => $orderBy,
		);
	}




	public function prepareItemArgs()
	{
		$settings    = aitOptions()->getOptionsByType('theme');
		$settings    = $settings['sorting'];
		$topFeatured = $settings['topFeatured'];

		$metaQuery = array();
		$orderBy   = array();

		if ($topFeatured) {
			$metaQuery = array(
				'relation'        => 'AND',
				'featured_clause' => array(
					'key'     => '_ait-item_item-featured',
					'compare' => 'EXISTS'
				)
			);
			$orderBy['featured_clause'] = 'DESC';
		}

		if ( defined('AIT_REVIEWS_ENABLED') && $this->orderBy == 'date' ) {
			$metaQuery['rating_clause'] = array(
				'key'     => 'rating_mean',
				'compare' => 'EXISTS'
			);
			$orderBy['rating_clause'] = $this->order;
		}

		$orderBy[$this->orderBy] = $this->order;

		$this->args = array(
			'post_type'      => 'ait-item',
			'post_status'    => 'publish',
			'posts_per_page' => $this->posts_per_page,
			'offset'         => $this->offset,
			'lang'           => $this->lang,
			'tax_query'      => array(
				array(
					'taxonomy' => $_POST['taxonomy']['taxonomy'],
					'field'    => 'id',
					'terms'    => $_POST['taxonomy']['id']
				)
			),
			'meta_query' => $metaQuery,
			'orderby'    => $orderBy,
		);
	}



	public function preparePagedEvents($query)
	{
		$result = '';

		foreach (new WpLatteLoopIterator($query) as $event) {
			// $result .= $this->pagedEventTemplate($event);
			$result .= aitRenderLatteTemplate('/portal/parts/event-container.php', array('post' => $event));
		}
		return $result;
	}



	public function preparePagedItems($query)
	{
		$result = '';

		foreach (new WpLatteLoopIterator($query) as $item) {
			$result .= $this->pagedItemTemplate($item);
		}
		return $result;
	}


	public function pagedEventTemplate($post)
	{
		$eventOptions = get_option('ait_events_pro_options', array());
		$noFeatured = $eventOptions['noFeatured'];
		$categories = get_the_terms($post->id, 'events-pro');
		$meta = $post->meta('event-pro-data');

		$nextDates = aitGetNextDate($meta->dates);
		$date_timestamp = strtotime($nextDates['dateFrom']);
		$day = date_i18n('d', $date_timestamp);
		$month = date_i18n('F', $date_timestamp);
		$moreDates = count(aitGetRecurringDates($post)) - 1;

		$imgWidth = 768;
		$imgHeight = 195;
		$imgHeight = ($imgWidth / 4) * 3;
		$result = '
			<div class="event-container">

			<a href="'.$post->permalink.'">
				<div class="item-thumbnail">';
					if ($post->hasImage){
						$result .= '<div class="item-thumbnail-wrap" style="background-image: url(\''.aitResizeImage($post->imageUrl, array('width'=>$imgWidth, 'height'=>$imgHeight, 'crop'=>true)).'\')"></div>';
					} else {
						$result .= '<div class="item-thumbnail-wrap" style="background-image: url(\''.aitResizeImage($noFeatured, array('width'=>$imgWidth, 'height'=>$imgHeight, 'crop'=>true)).'\')"></div>';
					}
				$result .= '</div>

				<div class="entry-date">
					<div class="day">'.$day.'</div>
					<div class="month">'.$month.'</div>';
					if ($moreDates > 0) {
						$result .= '<div class="more">'.$moreDates.'</div>';
					}
				$result .= '</div>

			</a>
			<div class="item-text">
				<div class="item-title"><a href="'.$post->permalink.'"><h3>'.$post->title.'</h3></a></div>
				<div class="item-excerpt"><p class="txtrows-3">'. strip_tags($post->excerpt(200)).'</p></div>

				<div class="item-taxonomy">

					<div class="item-location">';
						foreach ($post->categories('ait-locations') as $loc) {
							$result .= '<a href="'.$loc->url().'" class="location">'.$loc->title.'</a>';
						}
					$result .= '</div>

					<div class="item-categories">';
					aitRenderLatteTemplate('/portal/parts/event-taxonomy.php', array('itemID' => $post->id, 'taxonomy' => 'ait-events-pro', 'onlyParent' => true, 'count' => 3));
					$result .= '</div>

				</div>

			</div>
			<div class="item-more"><a href="'.$post->permalink.'">'.__( 'More info', 'ait').'</a></div>

			</div>';
		return $result;
	}



	public function pagedItemTemplate($post)
	{
		$itemSettings = aitOptions()->getOptionsByType('theme');
		$itemSettings = $itemSettings['item'];
		$noFeatured = $itemSettings['noFeatured'];
		$categories = get_the_terms($post->id, 'ait-items');
		$meta = $post->meta('item-data');

		$dbFeatured = get_post_meta($post->id, '_ait-item_item-featured', true);
		$isFeatured = $dbFeatured != "" ? (bool)$dbFeatured : false;
		$featuredClass = $isFeatured ? ' item-featured ' : '';
		$reviewsClass = defined("AIT_REVIEWS_ENABLED") ? ' reviews-enabled ' : '';
		$imgWidth = 768;
		$imgHeight = 195;
		$imgHeight = ($imgWidth / 4) * 3;
		// $result = '';
		$result = '
			<div class="item-container'.$featuredClass.$reviewsClass .'">

			<a href="'.$post->permalink.'">
				<div class="item-thumbnail">';
					if ($post->hasImage){
						$result .= '<div class="item-thumbnail-wrap" style="background-image: url(\''.aitResizeImage($post->imageUrl, array('width'=>$imgWidth, 'height'=>$imgHeight, 'crop'=>true)).'\')"></div>';
					} else {
						$result .= '<div class="item-thumbnail-wrap" style="background-image: url(\''.aitResizeImage($noFeatured, array('width'=>$imgWidth, 'height'=>$imgHeight, 'crop'=>true)).'\')"></div>';
					}
				$result .= '</div>



			</a>
			<div class="item-text">';
				if (defined('AIT_REVIEWS_ENABLED')) {
				aitRenderLatteTemplate('/portal/parts/carousel-reviews-stars.php', array('item' => $post, 'showCount' => false));
				}
				$result .= '<div class="item-title"><a href="'.$post->permalink.'"><h3>'.$post->title.'</h3></a></div>';


				if (count($categories) > 0){
				$result .= '
					<div class="item-categories">';
					aitRenderLatteTemplate('/portal/parts/item-taxonomy.php', array('itemID' => $post->id, 'taxonomy' => 'ait-items'));
					$result .= '</div>';
				}

				$result .= '<div class="item-excerpt">
					<p class="txtrows-3">';

					if ($post->hasContent){
						$result .= substr(trim(strip_tags($post->content)), 0, 180);
					} else {
						$result .= substr(trim(strip_tags($post->excerpt)), 0, 180);
					}
					$result .= '
					</p>
				</div>

				<div class="item-location"><p>'.$meta->map['address'].'</p></div>

			</div>
			<div class="item-more"><a href="'.$post->permalink.'">'.__( 'More info', 'ait').'</a></div>

			</div>';
		return $result;
	}



	public function prepareTimelineArgs()
	{
		$this->taxQuery = array();
		$metaQuery = array();
		if ($_POST['params']['page'] == 'event') {
			$terms = get_the_terms( $_POST['params']['eventId'], 'ait-events-pro' ) ? get_the_terms( $_POST['params']['eventId'], 'ait-events-pro' ) : array();
			$termsIdList = array();
			foreach ( $terms as $term) {
				array_push($termsIdList, $term->term_taxonomy_id);
			}
			// apply category filters
			if (!empty($_POST['filters']) && !in_array("0", $_POST['filters'])) {
				$termsIdList = $_POST['filters'];
			}
			$taxonomyTerm = array('taxonomy' => 'ait-events-pro', 'field' => 'term_taxonomy_id', 'terms' => $termsIdList, 'operator' => 'IN');
			array_push($this->taxQuery, $taxonomyTerm);

		} elseif($_POST['params']['page'] == 'item') {
			$metaQuery = array(
    			"related_clause" => array(
					"key"     => 'ait-event-pro-related-item',
					"value"   => $_POST['params']['itemId'],
					"compare" => '=',
    			)
    		);
    		// apply category filters
			if (isset($_POST['filters']) && !in_array("0", $_POST['filters'])) {
				$taxonomyTerm = array('taxonomy' => 'ait-events-pro', 'field' => 'term_id', 'terms' => $_POST['filters']);
				array_push($this->taxQuery, $taxonomyTerm);
			}
    		if (isset($_POST['taxonomy']['id']) && !in_array("0", $_POST['taxonomy']['id'])) {
				$taxonomyTerm = array('taxonomy' => $_POST['taxonomy']['taxonomy'], 'field' => 'term_id', 'terms' => $_POST['taxonomy']['id']);
				array_push($this->taxQuery, $taxonomyTerm);
    		}


		} elseif($_POST['params']['page'] == 'taxonomy') {
			$taxonomyTerm = array('taxonomy' => $_POST['params']['taxQuery']['taxonomy'], 'field' => 'term_id', 'terms' => $_POST['params']['taxQuery']['terms']);
			array_push($this->taxQuery, $taxonomyTerm);
			// apply category filters
			if (isset($_POST['filters']) && !in_array("0", $_POST['filters'])) {
				$taxonomyTerm = array('taxonomy' => 'ait-events-pro', 'field' => 'term_id', 'terms' => $_POST['filters']);
				array_push($this->taxQuery, $taxonomyTerm);
			}
		} elseif($_POST['params']['page'] == 'default') {
		}



		$this->args = array(
			"post_type"      => "ait-event-pro",
			'post_status'    => "publish",
			"posts_per_page" => $this->posts_per_page,
			"offset"         => $this->offset,
			"lang"           => $this->lang,
			"tax_query"      => $this->taxQuery,
			"meta_query"     => array(
				"relation"     => 'AND',
				"dates_clause" => array(
					"key"     => 'ait-event-recurring-date',
					"value"   => $this->lastDate,
					"compare" => '=',
					"type"    => 'date'
	    		),
	    	),
			"orderby" => array(
				"dates_clause" => 'ASC'
			),
		);

		array_push($this->args['meta_query'], $metaQuery);




	}



	public function prepareTimelineEvents($query)
	{
		$result = array();

		$eventOptions = get_option('ait_events_pro_options', array());

		foreach (new WpLatteLoopIterator($query) as $event) {
			$imageLink = $event->imageUrl;
	        $imageLink = empty($imageLink) ? $eventOptions['noFeatured'] : $imageLink;
	        $image = aitResizeImage($imageLink, array('width'=>75, 'height'=>75, 'crop'=>true));

			$preparedEvent = array(
				'id' => $event->id,
				'permalink' => $event->permalink,
				'title' => $event->title,
				'excerpt' => strip_tags($event->excerpt),
				'image' => $image,
				'address' => aitEventAddress($event),
			);
			array_push($result, $preparedEvent);
		}
		return $result;
	}



	function getSidebarTimelineEventsHtml($events, $header)
	{
		$result = '';
		if ($header) {
			$result .= $this->timelineDateHeader();
		}
		foreach ($events as $event) {
			$result .= $this->timelineEventsTemplate($event);
		}
		return $result;
	}




	function getHeaderDataByDate()
	{

		$query = aitGetItems($this->args);
		$data['count'] = $query->found_posts;

		$eventOptions = get_option('ait_events_pro_options', array());

		$categories = array();
		if (empty($_POST['taxonomy'])) {
			foreach (new WpLatteLoopIterator($query) as $event) {
				$terms = get_the_terms($event->id, 'ait-events-pro');
				if ($terms) {
					foreach ($terms as $category) {
						if ($category->parent != 0) {
							$category = get_term( $category->parent, 'ait-events-pro' );
						}
						$icons = get_option($category->taxonomy . "_category_" . $category->term_id);
						if (isset($icons['icon']) && $icons['icon'] != "") {
							$iconLink = $icons['icon'];
						} else {
							$iconLink = $eventOptions['categoryDefaultIcon'];
						}
						$categories[$category->term_id] = array(
							'title'      => $category->name,
							'link'       => get_term_link($category->term_id, $category->taxonomy),
							'icon'       => $iconLink,
							'icon_color' => $icons['icon_color']
						);
					}
				}
			}
		}
		$data['categories'] = $categories;

		return $data;
	}




	public function timelineEventsTemplate($event)
	{
		// $result = '';
		$result = '
			<a href="'.$event['permalink'].'" class="item">
				<div class="timeline-point"></div>
				<div class="thumbnail"><img src="'.$event['image'].'">
				</div>
				<div class="item-data">
					<h3>' . $event['title'] . '</h3>
					<div class="description">
						<p class="txtrows-1">' . $event['excerpt'] . '</p>
					</div>
					<div class="location">
						<p>'. $event['address'] .'</p>
					</div>
				</div>
			</a>';
		return $result;
	}


	public function timelineDateHeader()
	{
		$headerData = $this->getHeaderDataByDate($this->lastDate);
		$result = '
			<div class="timeline-header">
				<div class="items-number">'.$headerData['count'].'</div>
				<div class="items-date">'.date_i18n(get_option('date_format'), strtotime($this->lastDate)).'</div>
				<div class="items-categories">';
				foreach ($headerData['categories'] as $key => $category ) {
					$iconColor = !empty($category['icon_color']) ? $category['icon_color'] : "";
					$style = "";
					if (!empty($iconColor)) $style = ' style="background: '.$iconColor.';"';
				$result .= '
					<a href="'.$category['link'].'" class="taxonomy-icon"'.$style.'>
						<img src="'.$category['icon'].'" alt="'.$category['title'].'">
					</a>';
				}
			$result .= '
				</div>
			</div>';
		return $result;
	}



	public function getRelatedEventsCategories($itemId)
	{
		$parents = array();
		$query = aitItemRelatedEvents($itemId);
		foreach (new WpLatteLoopIterator($query) as $event) {
			$terms = get_the_terms($event->id, 'ait-events-pro');
			if ($terms) {
				foreach ($terms as $category) {
					// start from the current term
				    $parent  = get_term_by( 'id', $category->term_id, 'ait-events-pro');
				    // climb up the hierarchy until we reach a term with parent = '0'
				    while ($parent->parent != '0'){
				        $term_id = $parent->parent;

				        $parent  = get_term_by( 'id', $term_id, 'ait-events-pro');
				    }
				    $parents[$parent->term_id] = new WpLatteTaxonomyTermEntity($parent, 'ait-events-pro');
					// $categories = $wp->categories(array('taxonomy' => 'ait-events-pro', 'hide_empty' => 0, 'parent' => $parentCategory))}
				}
			}
		}
		return aitRenderLatteTemplate('/portal/parts/timeline-taxonomy-filter.php', array('categories' => $parents, 'taxonomy' => 'ait-events-pro'));

	}








}
