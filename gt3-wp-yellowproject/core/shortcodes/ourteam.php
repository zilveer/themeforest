<?php

class ourteam {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_ourteam")) {
			function shortcode_ourteam($atts, $content = null)
			{

				global $gt3_pbconfig;
				$compile = '';

				extract(shortcode_atts(array(
					'heading_size' => $gt3_pbconfig['default_heading_in_module'],
					'heading_color' => '',
					'heading_text' => '',
					'posts_per_line' => '2',
					'number_of_workers' => '12',
				), $atts));

				#heading
				if (strlen($heading_color) > 0) {
					$custom_color = "color:#{$heading_color};";
				}
				if (strlen($heading_text) > 0) {
					$compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
				}

				$compile .= '
			
				
        <div class="team_slider">
            <div class="carouselslider teamslider items' . $posts_per_line . '" data-count="' . $posts_per_line . '">
            	<ul class="item_list">';

				$wp_query = null;
				$wp_query = new WP_Query();
				$args = array(
					'post_type' => 'team',
					'posts_per_page' => $number_of_workers,
				);


				$wp_query->query($args);
				while ($wp_query->have_posts()) : $wp_query->the_post();

					$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');


					$compile .= '
					<li>
                        <div class="item">
                            <div class="img_block">';
					if (has_post_thumbnail()) {
						$compile .= '<img src="' . aq_resize($featured_image[0], 270, 213, true, true, true) . '" alt="' . get_the_title() . '" />';
					} else {
						$compile .= '<img src="' . IMGURL . '/core/team-unknown.jpg" alt="' . get_the_title() . '" />';
					}

					$compile .= '    <div class="carousel_wrapper"></div>
			                </div>
                            <div class="carousel_title">
                                <h4>' . get_the_title() . '</h4>
								<div class="op">' . get_post_meta(get_the_ID(), "teams_position", true) . '</div>
                            </div>
                            <div class="carousel_desc">
								<div class="exc">' . get_the_excerpt() . '</div>
								';

					$twitter_link = get_post_meta(get_the_ID(), "twitter_link", true);
					$LinkedIn_link = get_post_meta(get_the_ID(), "LinkedIn_link", true);
					$facebook_link = get_post_meta(get_the_ID(), "facebook_link", true);
					$DeviantArt = get_post_meta(get_the_ID(), "DeviantArt", true);
					$vimeo_link = get_post_meta(get_the_ID(), "vimeo_link", true);
					$flickr_link = get_post_meta(get_the_ID(), "flickr_link", true);
					$tumblr_link = get_post_meta(get_the_ID(), "tumblr_link", true);
					$member_email = get_post_meta(get_the_ID(), "member_email", true);
					$linkedin_link = get_post_meta(get_the_ID(), "linkedin_link", true);

					if (strlen($twitter_link) > 0 || strlen($LinkedIn_link) > 0 || strlen($facebook_link) > 0 || strlen($DeviantArt) > 0 || strlen($vimeo_link) > 0 || strlen($flickr_link) > 0 || strlen($tumblr_link) > 0 || strlen($linkedin_link) > 0 || strlen($member_email) > 0) {
						$compile .= '<div class="smallproflinks">';
					}

					if (strlen($facebook_link) > 0) {
						$compile .= '<a target="_blank" href="' . $facebook_link . '" class="facebook_link tiptip" title="Facebook"></a>';
					}
					if (strlen($flickr_link) > 0) {
						$compile .= '<a target="_blank" href="' . $flickr_link . '" class="flickr_link tiptip" title="Flickr"></a>';
					}
					if (strlen($twitter_link) > 0) {
						$compile .= '<a target="_blank" href="' . $twitter_link . '" class="twitter_link tiptip" title="Twitter"></a>';
					}
					if (strlen($LinkedIn_link) > 0) {
						$compile .= '<a target="_blank" href="' . $LinkedIn_link . '" class="LinkedIn_link tiptip" title="LinkedIn"></a>';
					}
					if (strlen($DeviantArt) > 0) {
						$compile .= '<a target="_blank" href="' . $DeviantArt . '" class="DeviantArt tiptip" title="DeviantArt"></a>';
					}
					if (strlen($vimeo_link) > 0) {
						$compile .= '<a target="_blank" href="' . $vimeo_link . '" class="vimeo_link tiptip" title="Vimeo"></a>';
					}
					if (strlen($tumblr_link) > 0) {
						$compile .= '<a target="_blank" href="' . $tumblr_link . '" class="tumbler_link tiptip" title="Tumblr"></a>';
					}
					if (strlen($linkedin_link) > 0) {
						$compile .= '<a target="_blank" href="' . $linkedin_link . '" class="linkedin_link tiptip" title="LinkedIn"></a>';
					}
					if (strlen($member_email) > 0) {
						$compile .= '<a target="_blank" href="mailto:' . $member_email . '" class="member_email tiptip" title="Email"></a>';
					}


					if (strlen($twitter_link) > 0 || strlen($LinkedIn_link) > 0 || strlen($facebook_link) > 0 || strlen($DeviantArt) > 0 || strlen($vimeo_link) > 0 || strlen($flickr_link) > 0 || strlen($tumblr_link) > 0 || strlen($linkedin_link) > 0 || strlen($member_email) > 0) {
						$compile .= '</div>';
					}

					$compile .= '
							</div>
                        </div>
                    </li>  
				';

				endwhile;

				$compile .= '</ul>
             </div>
             <div class="clear"></div>
        </div>  
        <div class="clear"></div>    
        
    <!--//our team-->
				
				
			';

				return $compile;

			}
		}
		add_shortcode($shortcodeName, 'shortcode_ourteam');
	}
}




#Shortcode name
$shortcodeName="ourteam";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
<div style='float:left;clear:both;line-height:27px;'>Title:</div> <input style='width:230px;text-align:left;float:right;' value='' type='text' class='".$shortcodeName."_title' name='".$shortcodeName."_title'>
<div style='float:left;clear:both;line-height:27px;'>Number:</div> <input style='width:40px;text-align:left;' value='' type='text' class='".$shortcodeName."_number' name='".$shortcodeName."_number'>
<div style='clear:both;'></div>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		var title = jQuery('.".$shortcodeName."_title').val();
		var number = jQuery('.".$shortcodeName."_number').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." title=\"'+title+'\" number=\"'+number+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$shortcode_ourteam = new ourteam();
$shortcode_ourteam->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['ourteam'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>