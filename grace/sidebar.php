<?php
/**
 * The Sidebar containing the primary blog sidebar
 *
 * @package WordPress
 * @subpackage grace
 */
 
wp_reset_postdata();

global $post;
if (isset($post)) $postID = $post->ID;

do_action('st_before_sidebar');

$is_church = is_singular(TB_CHURCH_CPT);
$is_event = is_singular(TB_EVENT_CPT);
$is_priest = is_singular(TB_PRIEST_CPT);
$is_sermon = is_singular(TB_SERMON_CPT);

if (isset($postID)) $postCustom = get_post_custom($postID);

if (isset($postCustom['_wp_page_template'][0])) {
	$template = $postCustom['_wp_page_template'][0];
} else {
	$template = FALSE;
}

if (isset($postCustom['_tb_sidebar_choice'][0])) {
	$sidebar = $postCustom['_tb_sidebar_choice'][0];
} else {
	$sidebar = FALSE;
}

$themeOptions = of_get_all_options();

if (is_post_type_archive(TB_SERMON_CPT) || is_tax(TB_SERMON_TAX_TOPIC) || is_tax(TB_SERMON_TAX_SCRIPTURE) || is_tax(TB_SERMON_TAX_OCCASION) || ($template == 'page-sermons.php' && !$sidebar)) {
	$sidebar = isset($themeOptions['default_sidebar_sermon']) ? $themeOptions['default_sidebar_sermon'] : FALSE;
}

if (is_post_type_archive(TB_CHURCH_CPT) || ($template == 'page-churches.php' && !$sidebar)) {
	$sidebar = isset($themeOptions['default_sidebar_church']) ? $themeOptions['default_sidebar_church'] : FALSE;
}

if (is_post_type_archive(TB_PRIEST_CPT) || ($template == 'page-priests.php' && !$sidebar) || ($is_priest && !$sidebar)) {
	$sidebar = isset($themeOptions['default_sidebar_priest']) ? $themeOptions['default_sidebar_priest'] : FALSE;
}

if (is_post_type_archive(TB_EVENT_CPT) || ($template == 'page-events.php' && !$sidebar) || ($template == 'page-events-past.php' && !$sidebar) || ($template == 'page-events-all.php' && !$sidebar) || is_tax(TB_EVENT_TAX)) {
	$sidebar = isset($themeOptions['default_sidebar_event']) ? $themeOptions['default_sidebar_event'] : FALSE;
}

$nosidebar = 0;
if (($is_church || $is_event || $is_sermon) && !$sidebar) $nosidebar = 1;
if (!is_active_sidebar($sidebar)) $sidebar = 'default';


// CHURCH
if ($is_church) {
	$serviceTimes = isset($postCustom['_tb_service_times'][0]) ? $postCustom['_tb_service_times'][0] : FALSE;
	$address = isset($postCustom['_tb_address'][0]) ? $postCustom['_tb_address'][0] : FALSE;
	$phone = isset($postCustom['_tb_phone'][0]) ? $postCustom['_tb_phone'][0] : FALSE;
	$mobile = isset($postCustom['_tb_mobile'][0]) ? $postCustom['_tb_mobile'][0] : FALSE;
	$email = isset($postCustom['_tb_email'][0]) ? $postCustom['_tb_email'][0] : FALSE;
	$twitter = isset($postCustom['_tb_twitter'][0]) ? $postCustom['_tb_twitter'][0] : FALSE;
	$facebook = isset($postCustom['_tb_facebook'][0]) ? $postCustom['_tb_facebook'][0] : FALSE;
	
	$showSidebarEcho = '';

	if ($serviceTimes) {
		$showSidebarEcho .= '<li class="widget-container widget_text">';
		$showSidebarEcho .= '<h3 class="widget-title">' . __('Service Times', 'grace') . '</h3>';
		$showSidebarEcho .= '<div class="textwidget">';
		$showSidebarEcho .= apply_filters('the_content', $serviceTimes);
		$showSidebarEcho .= '</div>';
		$showSidebarEcho .= '</li>';
	}

	if ($address) {
		$showSidebarEcho .= '<li class="widget-container widget_text">';
		$showSidebarEcho .= '<h3 class="widget-title">' . __('Address', 'grace') . '</h3>';
		$showSidebarEcho .= '<div class="textwidget">';
		$showSidebarEcho .= "<span aria-hidden='true' class='icon-home'></span> $address";
		$showSidebarEcho .= '</div>';
		$showSidebarEcho .= '</li>';
	}

	$phones = array();

	if ($phone) {
		$phones[] = "<li><span aria-hidden='true' class='icon-phone'></span> $phone</li>";
	}

	if ($mobile) {
		$phones[] = "<li><span aria-hidden='true' class='icon-phone'></span> $mobile</li>";
	}

	if ($email) {
		$phones[] = "<li class='fulldp'><span aria-hidden='true' class='icon-mail'></span> <a href='mailto:'" . $email . '">' . $email . '</a> <a href="mailto:' . $email . '" class="fulld">' . $email . '</a></li>';
	}

	if (count($phones)) {
		$showSidebarEcho .= '<li class="widget-container widget_text">';
		$showSidebarEcho .= '<h3 class="widget-title">' . __('Contact Us', 'grace') . '</h3>';
		$showSidebarEcho .= '<ul>';
		$showSidebarEcho .= implode($phones);
		$showSidebarEcho .= '</ul>';
		$showSidebarEcho .= '</li>';
	}

	$contactInfos = array();						

	if ($twitter) $contactInfos[] = tb_social_button($twitter, 'twitter');
	if ($facebook) $contactInfos[] = tb_social_button($facebook, 'facebook');

	if (count($contactInfos)) {
		$showSidebarEcho .= '<li class="widget-container widget_text">';
		$showSidebarEcho .= '<h3 class="widget-title">' . __('Get Connected', 'grace') . '</h3>';
		$showSidebarEcho .= '<div>';
		$showSidebarEcho .= implode('', $contactInfos);
		$showSidebarEcho .= '</div>';
		$showSidebarEcho .= '</li>';
	}
	
	if ($showSidebarEcho) echo "<ul>$showSidebarEcho</ul>";
}

// EVENT
if ($is_event) {
	$venue = (isset($postCustom['_tb_venue'][0])) ? $postCustom['_tb_venue'][0] : FALSE;
	$address = (isset($postCustom['_tb_address'][0])) ? $postCustom['_tb_address'][0] : FALSE;
	$location = (isset($postCustom['_tb_location'][0])) ? $postCustom['_tb_location'][0] : FALSE;
	$phone = (isset($postCustom['_tb_phone'][0])) ? $postCustom['_tb_phone'][0] : FALSE;

	$startDate = (isset($postCustom['_tb_start_date'][0])) ? $postCustom['_tb_start_date'][0] : FALSE;
	$startTime = (isset($postCustom['_tb_start_time'][0])) ? $postCustom['_tb_start_time'][0] : FALSE;
	
	$attendURL = (isset($postCustom['_tb_atend_url'][0])) ? $postCustom['_tb_atend_url'][0] : FALSE;
	$attendButton = (isset($postCustom['_tb_atend_button'][0])) ? $postCustom['_tb_atend_button'][0] : FALSE;
	
	$eventSidebar = array();
	
	if ($location) $eventSidebar[] = "<span aria-hidden='true' class='icon-home'></span> $location";
	if ($venue) $eventSidebar[] = "<span aria-hidden='true' class='icon-flag'></span> $venue";
	if ($address) $eventSidebar[] = "<span aria-hidden='true' class='icon-flag'></span> $address";
	if ($phone) $eventSidebar[] = "<span aria-hidden='true' class='icon-phone'></span> $phone";
	
	if ($startDate) $eventSidebar[] = "<span aria-hidden='true' class='icon-calendar'></span> " . date_i18n(get_option('date_format'), $startDate);
	if ($startTime) $eventSidebar[] = "<span aria-hidden='true' class='icon-time'></span> $startTime";
	
	if (count($eventSidebar)) {
		$showSidebarEcho = '<ul>';
		$showSidebarEcho .= '<li class="widget-container widget_text">';
		$showSidebarEcho .= '<h3 class="widget-title">' . __('Event Details', 'grace') . '</h3>';
		$showSidebarEcho .= '<ul>';

		foreach ($eventSidebar as $eventSidebarLine) {
			$showSidebarEcho .= "<li>$eventSidebarLine</li>";
		}
	
	
		if ($attendURL && $attendButton) {
			$url = esc_url($attendURL);
			
			$buttonColor = (isset($postCustom['_tb_button_color'][0])) ? $postCustom['_tb_button_color'][0] : 'white';
			
			$buttonTarget = (isset($postCustom['_tb_button_target'][0])) ? $postCustom['_tb_button_target'][0] : '_blank';
			
			$button = "[button size='small' link='$url' align='center' color='$buttonColor' target='$buttonTarget']$attendButton" . '[/button]';
			
			$showSidebarEcho .= '<li class="nobckg">' . do_shortcode($button) . '</li>';
		}
	
		$showSidebarEcho .= '</ul>';
		$showSidebarEcho .= '</li>';
		$showSidebarEcho .= '</ul>';
		
		echo $showSidebarEcho;
	}
}

// SERMON
if ($is_sermon) {
	$video = isset($postCustom['_tb_video'][0]) ? $postCustom['_tb_video'][0] : FALSE;
	$mp3 = isset($postCustom['_tb_mp3'][0]) ? $postCustom['_tb_mp3'][0] : FALSE;
	$pdf = isset($postCustom['_tb_pdf'][0]) ? $postCustom['_tb_pdf'][0] : FALSE;
	
	$sermonSidebar = array();
	
	if ($video) {
		$sermonSidebar[] = "<a href='$video' class='icon video'>" . __('Play Video', 'grace') . '</a>' . "<a href='$video' class='fulld iframe' rel='prettyPhoto'>" . __('Play Video', 'grace') . '</a>';
	}
	
	if ($mp3) {
		$listenAudio = $themeOptions['_tb_listen_audio'];
		if ($listenAudio) {
			$listenAudioURL = get_permalink($listenAudio);
			$mp3iframe = $listenAudioURL . '?pid=' . $postID . '&iframe=true&width=290&height=90';
			$sermonSidebar[] = "<a href='$mp3iframe' class='icon listen iframe map_excluded' rel='prettyPhoto'>" . __('Play Audio', 'grace') . '</a>';	
		}
		
		$sermonSidebar[] = "<a href='$mp3' class='icon download map_excluded'>" . __('Download Audio', 'grace') . '</a>';
	}
	
	if ($pdf) {
		$sermonSidebar[] = "<a href='$pdf' class='icon pdf'>" . __('Download PDF', 'grace') . '</a>';
	}
	
	if (count($sermonSidebar)) {
		$showSidebarEcho = '<ul>';
		$showSidebarEcho .= '<li class="widget-container widget_sermon_menu">';
		$showSidebarEcho .= '<h3 class="widget-title">' . __('Sermon Details', 'grace') . '</h3>';
		$showSidebarEcho .= '<ul>';

		foreach ($sermonSidebar as $sermonSidebarLine) {
			$showSidebarEcho .= "<li class='fulldp'>$sermonSidebarLine</li>";
		}
	
		$showSidebarEcho .= '</ul>';
		$showSidebarEcho .= '</li>';
		$showSidebarEcho .= '</ul>';
		
		echo $showSidebarEcho;
	}
}

// SERMON CATEGORIES
if (is_tax(TB_SERMON_TAX_TOPIC) || is_tax(TB_SERMON_TAX_SCRIPTURE) || is_tax(TB_SERMON_TAX_OCCASION) || $template == 'page-sermons.php') {
	
	
	$staxonomies = array(TB_SERMON_TAX_TOPIC, TB_SERMON_TAX_SCRIPTURE, TB_SERMON_TAX_OCCASION);
	foreach ($staxonomies as $stax) {
		unset($sermonSidebar);
		$sermonSidebar = array();
		
		unset($sterms);
		$sterms = get_terms($stax);
		
		unset($count);
		$count = count($sterms);
		
		if ($count > 0) {
			$showSidebarEcho = '<ul>';
			$showSidebarEcho .= '<li class="widget-container widget_categories">';
			
			$the_tax = get_taxonomy( $stax );			
			
			$showSidebarEcho .= '<h3 class="widget-title">' . $the_tax->labels->name . '</h3>';
			$showSidebarEcho .= '<ul>';

			foreach ($sterms as $sterm) {
				$sermonSidebar[] = '<a href="' . get_term_link($sterm->slug, $stax) . '" title="' . sprintf(__('View all post filed under %s', 'grace'), $sterm->name) . '">' . $sterm->name . '</a>';
			}

			foreach ($sermonSidebar as $sermonSidebarLine) {
				$showSidebarEcho .= "<li>$sermonSidebarLine</li>";
			}
		
			$showSidebarEcho .= '</ul>';
			$showSidebarEcho .= '</li>';
			$showSidebarEcho .= '</ul>';

			echo $showSidebarEcho;

		}
	
	}
}

?>

<?php
	if ( is_active_sidebar( $sidebar ) && !$nosidebar ) : ?>
	<ul>
		<?php dynamic_sidebar( $sidebar ); ?>
	</ul>
<?php endif; ?>



<?php do_action('st_after_sidebar');?>