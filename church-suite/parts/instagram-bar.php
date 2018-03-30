<?php
$webnus_options = webnus_options();
$webnus_options['webnus_footer_instagram_username'] = isset( $webnus_options['webnus_footer_instagram_username'] ) ? $webnus_options['webnus_footer_instagram_username'] : '';
$webnus_options['webnus_footer_instagram_access'] = isset( $webnus_options['webnus_footer_instagram_access'] ) ? $webnus_options['webnus_footer_instagram_access'] : '';
$user = $webnus_options['webnus_footer_instagram_username'];
$acess = $webnus_options['webnus_footer_instagram_access'];
?>

<section class="footer-instagram-bar">
	<div class="container"><div class="row">
	<div class="footer-instagram-text"><h6><?php bloginfo('name')?> on Instagram</h6></div>

	</div></div>
		<div class="instagram-feed">
			<?php 
			$base_url =  "https://api.instagram.com/v1/users/search?q=". $user ."&access_token=". $acess ."&count=1&callback=?";
			$raw_content = wp_remote_get(esc_url_raw($base_url));
			if(!is_wp_error($raw_content))
			{
				$raw_content = $raw_content['body'];
				$json_insta = json_decode($raw_content);
				if (isset($json_insta->data[0]))
				{
				   $id = $json_insta->data[0]->id;
				}				
				if(!empty($id))
				{
					$url = "https://api.instagram.com/v1/users/". $id ."/media/recent/?access_token=". $acess ."&count=8&callback=?";
					$raw_content = wp_remote_get(esc_url_raw($url));
					$output = '';
					if(!is_wp_error($raw_content))
					{
						$output .= '<ul>';	
						$raw_content = $raw_content['body'];
						$json_insta = json_decode($raw_content);
						if (isset($json_insta->data[0]))
					{
						foreach($json_insta->data as $data)
						{		
							$output .= '<li><a href="'.esc_url($data->link).'" target="_blank"><img alt="" src="'.esc_url($data->images->low_resolution->url).'"/></a></li>';	
						}
					}
						$output .= '</ul>';	
						echo $output;
					}
				} // end if empty id
			}
			else echo esc_html__('An error has occoured...','webnus_framework');
			?>
			<div class="clear"></div>
		</div>	
</section>