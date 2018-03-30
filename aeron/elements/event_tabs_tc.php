<?php

/*********** Shortcode: Event Tabs ************************************************************/

if( in_array('the-events-calendar/the-events-calendar.php', get_option('active_plugins')) ){
	$tcvpb_elements['event_tabs_tc'] = array(
		'name' => esc_html__('Event Tabs', 'ABdev_aeron' ),
		'type' => 'block',
		'icon' => 'pi-tab',
		'category' =>  esc_html__('Content', 'ABdev_aeron'),
		'child' => 'event_tab_tc',
		'child_button' => esc_html__('New Tab', 'ABdev_aeron'),
		'child_title' => esc_html__('Tab no.', 'ABdev_aeron'),
		'attributes' => array(
			'selected' => array(
				'description' => esc_html__('Selected Tab', 'ABdev_aeron'),
				'info' => esc_html__('Initially selected tab, order number', 'ABdev_aeron'),
				'default' => '1',
			),
			'effect' => array(
				'default' => '',
				'description' => esc_html__('Transition Effect', 'ABdev_aeron'),
				'type' => 'select',
				'values' => array(
					'' => esc_html__('None', 'ABdev_aeron'),
					'slide' => esc_html__('Slide', 'ABdev_aeron'),
					'fade' => esc_html__('Fade', 'ABdev_aeron'),
				),
				'tab' => esc_html__('Settings', 'ABdev_aeron'),
			),
			'break_point' => array(
				'description' => esc_html__('Break Point', 'ABdev_aeron'),
				'info' => esc_html__('Width in px. Below this width tabs will be stacked on each other.', 'ABdev_aeron'),
				'tab' => esc_html__('Settings', 'ABdev_aeron'),
				'divider' => 'true',
			),
			'file' => array(
				'description' => esc_html__('Downloadable File', 'ABdev_aeron'),
				'type' => 'image',
				'tab' => esc_html__('Settings', 'ABdev_aeron'),
			),
			'file_text' => array(
				'description' => esc_html__('Text', 'ABdev_aeron'),
				'info' => esc_html__('This text will be shown as link for downloadable file.', 'ABdev_aeron'),
				'tab' => esc_html__('Settings', 'ABdev_aeron'),
			),
			'file_icon' => array(
				'description' => esc_html__('Icon', 'ABdev_aeron'),
				'info' => esc_html__('This icon will be shown next to upper text.', 'ABdev_aeron'),
				'type' => 'icon',
				'tab' => esc_html__('Settings', 'ABdev_aeron'),
			),
			'id' => array(
				'description' => esc_html__('ID', 'ABdev_aeron'),
				'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
				'tab' => esc_html__('Advanced', 'ABdev_aeron'),
			),	
			'class' => array(
				'description' => esc_html__('Class', 'ABdev_aeron'),
				'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
				'tab' => esc_html__('Advanced', 'ABdev_aeron'),
			),
		)
	);
	function tcvpb_event_tabs_tc_shortcode( $attributes, $content = null ) {
		global $tabs_navigation,$tabs_content,$tabs_counter,$tabs_selected;
		extract(shortcode_atts(tcvpb_extract_attributes('event_tabs_tc'), $attributes));
		static $i = 0;
	    $i++;

	    $tabs_counter = $i;

	    $tabs_selected = $selected;
	    
		$id_out = ($id!='') ? 'id='.$id.'' : '';

		$file_icon = ($file_icon!='') ? '<i class="'.esc_attr($file_icon).'"></i>' : '';
		
		do_shortcode($content);

		$return = '
			<div '.esc_attr($id_out).' class="tcvpb-event-tabs tcvpb-event-tabs-horizontal tcvpb-event-tabs-position-top '.esc_attr($class).'" data-selected="'.esc_attr($selected).'" role="tabpane'.$i.'" data-break_point="'.esc_attr($break_point).'" data-effect="'.esc_attr($effect).'">
				<ul class="nav nav-tabs tab-helper-reset tab-helper-clearfix" role="tablist">
					'.$tabs_navigation.'
					<li class="tcvpb_event_download_file"><a href="'.esc_url($file).'" target="_blank">'.esc_html($file_text).$file_icon.'</a></li>
				</ul>
				<div class="tab-content">
				'.$tabs_content.'
				</div>
			</div>';

		$tabs_navigation = $tabs_content = '';

		return $return;
	}

	// Output Event Categories
	$terms = get_terms('tribe_events_cat');
	$count = count($terms);
	$cat_out = '';
	if ( $count > 0 ){
	    foreach ( $terms as $term ) {
	      $cat_out[$term->slug] = $term->name;
	    }
	}
		
	$tcvpb_elements['event_tab_tc'] = array(
		'name' => esc_html__('Tab', 'ABdev_aeron' ),
		'type' => 'child',
		'attributes' => array(
			'title' => array(
				'description' => esc_html__('Tab Title', 'ABdev_aeron'),
			),
			'event_category' => array(
				'type' => 'select',
				'description' => esc_html__('Event Category', 'ABdev_aeron'),
				'values' => $cat_out,
			),
		),
	);
	function tcvpb_event_tab_tc_shortcode( $attributes ) {
		extract(shortcode_atts(tcvpb_extract_attributes('event_tab_tc'), $attributes));

		static $tab_count = 0;
		static $tabs_counter_static=0;
		global $tabs_navigation,$tabs_content,$tabs_counter,$tabs_selected;

		$args = array(
			'post_type' => 'tribe_events',
			'tribe_events_cat' => $event_category,
		);
		$post = new WP_Query( $args );
		$events = '';
		if ($post->have_posts()){
			while ($post->have_posts()){
				$post->the_post();
				$venue_details = tribe_get_venue_details();
				$events.= '
					<div class="tcvpb_event_image_container" style="background-image: url('.get_the_post_thumbnail_url().'); background-size: cover; background-position: 50% 0px; background-repeat: no-repeat;">
						<a class="overlay" href="'.get_permalink().'"></a>
					</div>
					<div class="tcvpb_event_content">
						<h1><a href="'.get_permalink().'">'.get_the_title().'</a></h1>
						<p>'.get_the_content().'</p>
						<div class="tcvpb_event_content_meta_info">';
							$events.= (tribe_get_start_date()!='' || tribe_get_end_date()!='') ? '<div><i class="ci_icon-time"></i>' . tribe_get_start_date( $event = null, $display_time = true, $date_format = 'H:i', $timezone = null ) . ' - ' . tribe_get_end_date( $event = null, $display_time = true, $date_format = 'H:i', $timezone = null ) . '</div>' : '';
							$events.= (tribe_get_venue()!='') ? '<div><i class="ci_icon-border_all"></i>' . tribe_get_venue() . '</div>' : '';
							$events.= (tribe_get_organizer()!='') ? '<div><i class="ci_icon-mic"></i>' . tribe_get_organizer() . '</div>' : '';
							$events.= ' <div class="tcvpb_event_content_meta_share">
											<div class="tcvpb_event_content_meta_share_icons">
												<a class="tcvpb_eventshare_facebook" href="'.esc_url('https://www.facebook.com/sharer/sharer.php?u='.get_permalink() ).'" target="_blank"><i class="ci_icon-facebook"></i></a>
												<a class="tcvpb_eventshare_googleplus" href="'.esc_url('https://plus.google.com/share?url='.get_permalink()).'" target="_blank"><i class="ci_icon-googleplus"></i></a>
												<a class="tcvpb_eventshare_twitter" href="'.esc_url('https://twitter.com/home?status='.urlencode(__('Check this ', 'astir')).get_permalink()).'" target="_blank"><i class="ci_icon-twitter"></i></a>
												<a class="tcvpb_eventshare_linkedin" href="'.esc_url('https://www.linkedin.com/shareArticle?mini=true&amp;title='.urlencode(the_title('', '' , false)).'&amp;url='.get_permalink() ).'" target="_blank"><i class="ci_icon-linkedin"></i></a>
											</div>
											<i class="ci_icon-share"></i>
										</div>';
						$events.= '</div>
					</div>
				';
			}
		}

		$active_class = false;
		if($tabs_counter!=$tabs_counter_static){
			$tabs_counter_static = $tabs_counter;
			$tab_count = 0;
		}
	    $tab_count++;
		if($tabs_selected==$tab_count){
			$active_class = true;
		}

		
		$tabs_navigation.='<li role="presentation"'.(($active_class)?' class="active"':'').'><a class="tcvpb-event-tabs-tab" data-href="#tab-'.$tabs_counter.'-'.$tab_count.'" aria-controls="tab-'.$tabs_counter.'-'.$tab_count.'" role="tab" data-toggle="tab">' . $title . '</a></li>';
		$tabs_content.='
			<div id="tab-'.$tabs_counter.'-'.$tab_count.'" class="tab-pane'.(($active_class)?' active_pane':'').'" role="tabpanel">
				'.$events.'
			</div>';
		
		$return = '';
		return $return;
	}


}
