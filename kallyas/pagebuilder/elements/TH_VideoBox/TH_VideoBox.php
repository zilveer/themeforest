<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Video Box
 Description: Video player or Image triggering a modal window with a Youtube or Vimeo video.
 Class: TH_VideoBox
 Category: content, media
 Keywords: button, modal, player, youtube, vimeo, self hosted, embed, embedded
 Level: 3
*/
/**
 * Class TH_VideoBox
 *
 * Create and display a Video Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_VideoBox extends ZnElements
{
	public static function getName(){
		return __( "Video Box", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$el_type = $this->opt('vb_type','modal');

		$classes=array();
		$classes[] = $uid = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$classes[] = 'el-videobox-Type-'.$el_type;

		echo '<div class="el-videobox '.implode(' ', $classes).'" '.$attributes.'>';

		if($el_type == 'modal'){

			if ( ! empty ( $options['vb_video_image'] ) && ! empty ( $options['vb_video_url'] ) ) {

				echo '<div class="adbox video '.implode(' ', $classes).'" '.$attributes.'>';

					echo '<img class="adbox-img" src="' . $options['vb_video_image'] . '" '.ZngetImageSizesFromUrl($options['vb_video_image'], true).' alt="'. ZngetImageAltFromUrl( $options['vb_video_image'] ) .'" title="'.ZngetImageTitleFromUrl( $options['vb_video_image'] ).'">';

					echo '<div class="video_trigger_wrapper">';
						echo '<div class="adbox_container">';

							echo '<a class="playVideo playvideo-size--'.$this->opt('playsize','md').'" data-lightbox="iframe" href="' . $options['vb_video_url'] . '"></a>';

							if( isset($options['vb_video_title']) && !empty($options['vb_video_title'])  ){
								echo '<h5 class="adbox-title kl-font-alt">' . $options['vb_video_title'] . '</h5>';
							}

						echo '</div>';
					echo '</div>'; // close video_trigger_container
				echo '</div>'; // close adbox
			}
			else {
				if ( ! empty ( $options['vb_video_url'] ) ) {
					if ( ! empty( $options['vb_video_title'] ) ) {
						echo '<h4 class="m_title text-custom" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['vb_video_title'] . '</h4>';
					}
					echo get_video_from_link( $options['vb_video_url'] );
				}
			}
		}
		elseif ($el_type == 'player'){

			$vb_video_source = $this->opt('vb_video_source', 'external');

			$vd_autoplay = $this->opt('source_vd_autoplay', '1');
			$vd_loop = $this->opt('source_vd_loop', '1');
			$vd_controls = $this->opt('source_vd_controls', '1');

			$video_attributes = array(
				'loop' => $vd_loop,
				'autoplay' => $vd_autoplay,
				'controls' => $vd_controls,

				// Youtube Specific
				'yt_modestbranding' => $this->opt('source_vd_modestbranding', '1'),
				'yt_autohide' => $this->opt('source_vd_autohide', '1'),
				'yt_showinfo' => $this->opt('source_vd_showinfo', '0'),
				'yt_rel' => $this->opt('source_vd_rel', '0'),

				// Vimeo Specific
				'vim_title' => $this->opt('source_vd_title', '0'),
				'vim_byline' => $this->opt('source_vd_byline', '0'),
				'vim_portrait' => $this->opt('source_vd_portrait', '1'),
			);

			$external_url = $this->opt('vb_video_url_player','');

			// External embedded video
			if( ( $vb_video_source == 'external_yt' || $vb_video_source == 'external_vim' || $vb_video_source == 'external_other' ) && !empty($external_url)){

				echo '<div class="video-ext-wrapper fitvids-resize-wrapper">'.get_video_from_link( $external_url, '', '425', '240', $video_attributes ) . '</div>';

			}
			elseif( $vb_video_source == 'selfhosted' ) {

				$params = array();

				$vd_mp4 = $this->opt('source_vd_self_mp4','');
				$vd_ogg = $this->opt('source_vd_self_ogg','');
				$vd_webm = $this->opt('source_vd_self_webm','');

				$params[] = !empty($vd_mp4) ? 'mp4="'.$vd_mp4.'"' : '';
				$params[] = !empty($vd_ogg) ? 'ogv="'.$vd_ogg.'"' : '';
				$params[] = !empty($vd_webm) ? 'webm="'.$vd_webm.'"' : '';

				if(!empty($params)) {
					$params[] = 'autoplay="'.$vd_autoplay.'"';
					$params[] = 'loop="'.$vd_loop.'"';
					// $params[] = $vd_controls == 1 ? 'controls="controls"' : '';

					$video_shortcode = '[video '.implode(' ', $params).']';

					// echo '<div class="video-ext-wrapper fitvids-resize-wrapper">';
					echo  $video_shortcode ;
					// echo '</div>';
				}

			}
			elseif( $vb_video_source == 'selfhosted_clean' ) {

				$vd_mp4 = $this->opt('source_vd_self_mp4','');
				$vd_ogg = $this->opt('source_vd_self_ogg','');
				$vd_webm = $this->opt('source_vd_self_webm','');

				echo '<div class="video-ext-wrapper fitvids-resize-wrapper">';

				if( !empty($vd_mp4) || !empty($vd_ogg) || !empty($vd_webm)) {
					echo '<video class="" id="video-'.$uid.'" width="100%" preload="metadata" '.( $vd_autoplay == 1 ? 'autoplay="autoplay"':'' ).' '.( $vd_loop == 1 ? 'loop="loop"':'' ).' '.( $vd_controls == 1 ? 'controls="controls"':'' ).' >';
					if( !empty($vd_mp4) ) {
						echo '<source type="video/mp4" src="'.$vd_mp4.'">';
					}
					if( !empty($vd_webm)) {
						echo '<source type="video/webm" src="'.$vd_webm.'">';
					}
					if( !empty($vd_ogg)) {
						echo '<source type="video/ogg" src="'.$vd_ogg.'">';
					}
					echo '</video>';
				}

				echo '</div>';

			}
		}

		echo '</div>';

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Element behavior", 'zn_framework' ),
						"description" => __( "Select what behavior this element should have, a simple video player or a simple image triggering a modal window with a video.", 'zn_framework' ),
						"id"          => "vb_type",
						"std"         => "modal",
						"options"     => array(
							array(
								'value' => 'modal',
								'name'  => __( 'Circle Play triggering modal window', 'zn_framework' ),
								'desc'  => __( 'This will open a modal window with an embedded video.', 'zn_framework' ),
								'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_VideoBox/img/modal_video.png'
							),
							array(
								'value' => 'player',
								'name'  => __( 'Simple video player', 'zn_framework' ),
								'desc'  => __( 'This will display a simple embedded video player.', 'zn_framework' ),
								'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_VideoBox/img/video_player.png'
							),
						),
						"type"        => "smart_select",
						"class"        => "zn-smartselect--md"
					),

					array (
						"name"        => __( "Video Source Type", 'zn_framework' ),
						"description" => __( "Select the type of video source.", 'zn_framework' ),
						"id"          => "vb_video_source",
						"std"         => "external",
						"type"        => "select",
						"options"		=> array(
							"selfhosted" => "Self hosted video (MediaElement Player)",
							"selfhosted_clean" => "Self hosted video (Clean browser player)",
							"external_yt" => "Youtube",
							"external_vim" => "Vimeo",
							"external_other" => "Other",
						),
						"dependency"  => array( 'element' => 'vb_type' , 'value'=> array('player') ),
					),

					array (
						"name"        => __( "Video URL", 'zn_framework' ),
						"description" => __( "Please enter a link to your desired video ( Youtube, Vimeo or other ).", 'zn_framework' ),
						"id"          => "vb_video_url",
						"std"         => "",
						"type"        => "text",
						"class"		=> "zn_input_xl",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('modal') ),
						),
					),

					array (
						"name"        => __( "Embedded Video URL", 'zn_framework' ),
						"description" => __( "Please enter a link to your desired video ( Youtube, Vimeo or other ).", 'zn_framework' ),
						"id"          => "vb_video_url_player",
						"std"         => "",
						"type"        => "text",
						"class"		=> "zn_input_xl",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_yt', 'external_vim', 'external_other') ),
						),
					),

					array (
						"name"        => __( "Image", 'zn_framework' ),
						"description" => __( "Please select an image that you want to display.If
											 no image is selected, the video will be shown directly.", 'zn_framework' ),
						"id"          => "vb_video_image",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'vb_type' , 'value'=> array('modal') ),
					),

					array (
						"name"        => __( "Play button title", 'zn_framework' ),
						"description" => __( "Please enter a title that will appear over the play icon. This will only be shown if you select an image.", 'zn_framework' ),
						"id"          => "vb_video_title",
						"std"         => "",
						"type"        => "text",
						"class"		=> "zn_input_xl",
						"dependency"  => array( 'element' => 'vb_type' , 'value'=> array('modal') ),
					),

					/* LOCAL VIDEO */
					array(
						'id'          => 'source_vd_self_mp4',
						'name'        => 'Mp4 video source',
						'description' => 'Add the MP4 video source for your local video',
						'type'        => 'media_upload',
						'std'         => '',
						'data'  => array(
							'type' => 'video/mp4',
							'button_title' => 'Add / Change mp4 video',
						),
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('selfhosted','selfhosted_clean') ),
						),
					),

					array(
						'id'          => 'source_vd_self_ogg',
						'name'        => 'Ogg/Ogv video source',
						'description' => 'Add the OGG video source for your local video',
						'type'        => 'media_upload',
						'std'         => '',
						'data'  => array(
							'type' => 'video/ogg',
							'button_title' => 'Add / Change ogg video',
						),
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('selfhosted','selfhosted_clean') ),
						),
					),

					array(
						'id'          => 'source_vd_self_webm',
						'name'        => 'Webm video source',
						'description' => 'Add the WEBM video source for your local video',
						'type'        => 'media_upload',
						'std'         => '',
						'data'  => array(
							'type' => 'video/webm',
							'button_title' => 'Add / Change webm video',
						),
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('selfhosted','selfhosted_clean') ),
						),
					),

					array(
						'id'          => 'source_vd_autoplay',
						'name'        => 'Autoplay video?',
						'description' => 'Enable autoplay for video?',
						'std'         => '1',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('selfhosted','selfhosted_clean', 'external_yt', 'external_vim') ),
						),
					),

					array(
						'id'          => 'source_vd_loop',
						'name'        => 'Loop video?',
						'description' => 'Enable looping the video?',
						'std'         => '1',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('selfhosted','selfhosted_clean', 'external_yt', 'external_vim') ),
						),
					),

					array(
						'id'          => 'source_vd_controls',
						'name'        => 'Video controls',
						'description' => 'Enable video controls?',
						'std'         => '1',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_yt','selfhosted_clean') ),
						),
					),

					/**
					 * Youtube Specific
					 */
					array(
						'id'          => 'source_vd_modestbranding',
						'name'        => 'Youtube Video - Modest branding',
						'description' => 'Display modest branding for Youtube video?',
						'std'         => '1',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_yt') ),
						),
					),

					array(
						'id'          => 'source_vd_autohide',
						'name'        => 'Youtube Video - Autohide branding',
						'description' => 'Autohide branding for Youtube video?',
						'std'         => '1',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_yt') ),
						),
					),
					array(
						'id'          => 'source_vd_showinfo',
						'name'        => 'Youtube Video - Show Info',
						'description' => 'Hide various info for the youtube video?',
						'std'         => '0',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_yt') ),
						),
					),
					array(
						'id'          => 'source_vd_rel',
						'name'        => 'Youtube Video - Hide Related',
						'description' => 'Hide related videos on the video ending?',
						'std'         => '0',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_yt') ),
						),
					),

					/**
					 * Vimeo Specific
					 */
					array(
						'id'          => 'source_vd_title',
						'name'        => 'Vimeo Video - Hide title',
						'description' => 'Hide title for Vimeo video?',
						'std'         => '1',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_vim') ),
						),
					),
					array(
						'id'          => 'source_vd_byline',
						'name'        => 'Vimeo Video - Hide Video uploader',
						'description' => 'Hide video uploader (author) for Vimeo video?',
						'std'         => '1',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_vim') ),
						),
					),
					array(
						'id'          => 'source_vd_portrait',
						'name'        => 'Vimeo Video - Hide Avatar',
						'description' => 'Hide uploader avatar for Vimeo video?',
						'std'         => '1',
						'type'        => 'zn_radio',
						"options"     => array (
							"1" => __( "Yes", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
						"dependency"  => array(
							array( 'element' => 'vb_type' , 'value'=> array('player') ),
							array( 'element' => 'vb_video_source' , 'value'=> array('external_vim') ),
						),
					),

					array (
						"name"        => __( "Play button size", 'zn_framework' ),
						"description" => __( "Select the size of the play button.", 'zn_framework' ),
						"id"          => "playsize",
						"std"         => "md",
						"type"        => "select",
						"options"		=> array(
							"xs" => "Extra Small",
							"sm" => "Small",
							"md" => "Medium",
							"lg" => "Large",
							"xl" => "Extra Large",
						),
						"dependency"  => array( 'element' => 'vb_type' , 'value'=> array('modal') ),
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' .playVideo',
							'val_prepend'  => 'playvideo-size--',
						),
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#flIrJ1rcYlo',
				'docs'    => 'http://support.hogash.com/documentation/video-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
