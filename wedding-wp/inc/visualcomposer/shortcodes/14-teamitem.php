<?php
class WPBakeryShortCode_team_item extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
		extract(shortcode_atts(array(
			'img'=>'',
			'name' => '',
			'title' =>'',
			'text'=>'',	
			), $atts));	
			if(is_numeric($img)){
				$img = wp_get_attachment_url( $img );
			}
			$desc = (!empty($text))? '<p>'. $text .'</p>' : '';
			$out = '<li><figure>';
			$out .= '<img class="team-img" src="'. $img .'" alt="">';
			$out .= '<figcaption class="team-cap"><h3>'. $name .'</h3>';
			$out .= '<h4>'. $title .'</h4>'.$desc.'</figcaption></figure></li>';				
		return $out;
	}
}
vc_map( array(
        "name" =>"Webnus Team Item",
        "base" => "team_item",
		"description" => "Team slider",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_ourteam",
        "content_element" => true,
   		"as_child" => array('only' => 'team_slider'), // Use only|except 
        'params'=>array(		
						array(
								'type' => 'attach_image',
								'heading' => __( 'Team Image', 'WEBNUS_TEXT_DOMAIN' ),
								'param_name' => 'img',
								'value'=>'',
								'description' => __( 'Team member image', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
								'type' => 'textfield',
								'heading' => __( 'Team Memeber Name', 'WEBNUS_TEXT_DOMAIN' ),
								'param_name' => 'name',
								'value'=>'',
								'description' => __( 'Team member name', 'WEBNUS_TEXT_DOMAIN')
						),

						array(
								'type' => 'textfield',
								'heading' => __( 'Team Memeber Title', 'WEBNUS_TEXT_DOMAIN' ),
								'param_name' => 'title',
								'value'=>'',
								'description' => __( 'Team member title', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
								'type' => 'textarea',
								'heading' => __( 'Team Memeber Description Text', 'WEBNUS_TEXT_DOMAIN' ),
								'param_name' => 'text',
								'value'=>'',
								'description' => __( 'Team member description text', 'WEBNUS_TEXT_DOMAIN')
						),
					),     
		) );
?>