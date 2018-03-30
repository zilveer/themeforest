<section class="top-bar">
<div class="container">
<?php
	function webnus_topbar($pos){
		$webnus_options = webnus_options();
		$class=($pos=='left')?'lftflot':'rgtflot';
		echo '<div class="top-links '.$class.'">';

		$webnus_options['webnus_topbar_search'] = isset( $webnus_options['webnus_topbar_search'] ) ? $webnus_options['webnus_topbar_search'] : '';
		if($webnus_options['webnus_topbar_search']==$pos){
			echo '<form id="topbar-search" role="search" action="'.esc_url(home_url( '/' )).'" method="get" ><input name="s" type="text" class="search-text-box" ><i class="search-icon fa-search"></i></form>';
		}

		$webnus_options['webnus_topbar_social'] = isset( $webnus_options['webnus_topbar_social'] ) ? $webnus_options['webnus_topbar_social'] : '';
		if ($webnus_options['webnus_topbar_social']==$pos){
			echo '<div class="socialfollow">';
			get_template_part('parts/topbar','social' );
			echo '</div>';
		}

		$webnus_options['webnus_topbar_login'] = isset( $webnus_options['webnus_topbar_login'] ) ? $webnus_options['webnus_topbar_login'] : '';
		$webnus_options['webnus_topbar_login_text'] = isset( $webnus_options['webnus_topbar_login_text'] ) ? $webnus_options['webnus_topbar_login_text'] : '';
		if ($webnus_options['webnus_topbar_login']==$pos){
			$login_text = $webnus_options['webnus_topbar_login_text'];
			if ( is_user_logged_in() ) {
				global $user_identity;
				$login_text = esc_html__('Welcome ','webnus_framework') . esc_html($user_identity);
			}
			echo '<a href="#w-login" class="inlinelb topbar-login" target="_self">'.esc_html($login_text).'</a>
			<div style="display:none"><div id="w-login" class="w-login">';
			webnus_login();
			echo '</div></div>';
		}

		$webnus_options['webnus_topbar_contact'] = isset( $webnus_options['webnus_topbar_contact'] ) ? $webnus_options['webnus_topbar_contact'] : '';
		if($webnus_options['webnus_topbar_contact']==$pos){
			echo'<a class="inlinelb topbar-contact" href="#w-contact" target="_self">'.esc_html__('CONTACT','webnus_framework').'</a>';
		}

		$webnus_options['webnus_topbar_info'] = isset( $webnus_options['webnus_topbar_info'] ) ? $webnus_options['webnus_topbar_info'] : '';
		$webnus_options['webnus_topbar_email'] = isset( $webnus_options['webnus_topbar_email'] ) ? $webnus_options['webnus_topbar_email'] : '';
		$webnus_options['webnus_topbar_phone'] = isset( $webnus_options['webnus_topbar_phone'] ) ? $webnus_options['webnus_topbar_phone'] : '';
		if ($webnus_options['webnus_topbar_info']==$pos){
			echo '<h6><i class="fa-envelope-o"></i><a href="mailto:'. esc_html($webnus_options['webnus_topbar_email']) .'">'. esc_html($webnus_options['webnus_topbar_email']) .'</a></h6> <h6><i class="fa-phone"></i>'. esc_html($webnus_options['webnus_topbar_phone']).'</h6>';
		}

		$webnus_options['webnus_topbar_menu'] = isset( $webnus_options['webnus_topbar_menu'] ) ? $webnus_options['webnus_topbar_menu'] : '';
		$webnus_options['webnus_header_menu_type'] = isset( $webnus_options['webnus_header_menu_type'] ) ? $webnus_options['webnus_header_menu_type'] : '';
		if ($webnus_options['webnus_topbar_menu']==$pos && has_nav_menu('header-top-menu')){
			if($webnus_options['webnus_header_menu_type']==0){
						$menuParameters = array( 'theme_location' => 'header-top-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker());
			}else{
					$menuParameters = array('theme_location' => 'header-top-menu','container' => 'false', 'depth' => '1','menu_id' => 'nav','walker' => new webnus_description_walker());
			}
			echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
		}

		$webnus_options['webnus_topbar_custom'] = isset( $webnus_options['webnus_topbar_custom'] ) ? $webnus_options['webnus_topbar_custom'] : '';
		$webnus_options['webnus_topbar_text'] = isset( $webnus_options['webnus_topbar_text'] ) ? $webnus_options['webnus_topbar_text'] : '';
		if ($webnus_options['webnus_topbar_custom']==$pos){
			echo esc_html($webnus_options['webnus_topbar_text']);
		}

		$webnus_options['webnus_topbar_language'] = isset( $webnus_options['webnus_topbar_language'] ) ? $webnus_options['webnus_topbar_language'] : '';
		if ($webnus_options['webnus_topbar_language']==$pos){
			do_action('icl_language_selector');
		}
		echo'</div>';
	}
	webnus_topbar('left');
	webnus_topbar('right');
?>
</div>
</section>