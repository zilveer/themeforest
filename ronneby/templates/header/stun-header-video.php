<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$video_enabled = DfdMetaBoxSettings::get('dfd_stun_video_enable');

if($video_enabled != 'enable') return;

$video_style = DfdMetaBoxSettings::get('dfd_stun_video_style');

$video = $full_screen_video_html = '';

if($video_style && !empty($video_style)) {
	$video_type = DfdMetaBoxSettings::get('dfd_stun_video_type');

	$uniqid = uniqid('dfd-stun-bg-video-');
	
	$extra_url_prop = $data_atts = '';
	$loop = $muted = false;

	if(DfdMetaBoxSettings::get('dfd_stun_header_video_loop') == '1')
		$loop = true;

	if(DfdMetaBoxSettings::get('dfd_stun_header_video_mute') == '1')
		$muted = true;

	switch($video_style) {
		case 'self-hosted':
			$self_hosted_mp4 = DfdMetaBoxSettings::get('dfd_stun_header_self_hosted_mp4');
			$self_hosted_webm = DfdMetaBoxSettings::get('dfd_stun_header_self_hosted_webm');

			if ($self_hosted_mp4 != '' || $self_hosted_webm != '') {
				$sound_conrtol_class = 'dfd-icon-volume_off';
				wp_enqueue_script('dfd_zencdn_video_js');
				$poster = (isset($custom_head_img) && !empty($custom_head_img)) ? $custom_head_img : '';
				?>

				<div class="dfd-video-bg dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs">
					<video id="video-post<?php the_ID(); ?>" class="video-js vjs-default-skin" controls
							<?php if($loop) : ?>
								loop="true"
							<?php endif; ?>
							<?php if($muted) :
								$sound_conrtol_class = 'dfd-icon-volume_middle';
								?>
								muted="true"
							<?php endif; ?>
							autoplay="true"
							preload="auto"
							width="100%"
							height="100%"
							poster="<?php echo esc_url($poster) ?>"
							data-setup="{}">

						<?php if ($self_hosted_mp4): ?>
							<source src="<?php echo esc_url($self_hosted_mp4) ?>" type='video/mp4'>
						<?php endif; ?>
						<?php if ($self_hosted_webm): ?>
							<source src="<?php echo esc_url($self_hosted_webm) ?>" type='video/webm'>
						<?php endif; ?>
					</video>
				</div>

				<a href="#" class="dfd-sound-controller mobile-hide <?php echo esc_attr($sound_conrtol_class) ?>"></a>
			<?php
			}
			break;
		case 'youtube':
			$dfd_youtube_video_id = DfdMetaBoxSettings::get('dfd_stun_bg_youtube_id');
			if($dfd_youtube_video_id && !empty($dfd_youtube_video_id)) {
				if($loop) 
					$extra_url_prop .= '&amp;loop=1&amp;playlist='.$dfd_youtube_video_id;
				if($muted) 
					$data_atts .= ' data-muted="1"';
				else
					$data_atts .= ' data-muted="0"';
				$video = '<iframe id="'.esc_attr($uniqid).'" '.$data_atts.' width="100%" height="100%" src="https://www.youtube.com/embed/'.esc_attr($dfd_youtube_video_id).'?wmode=opaque&amp;autoplay=1'.esc_attr($extra_url_prop).'&amp;enablejsapi=1&amp;showinfo=0&amp;controls=0&amp;rel=0" frameborder="0" class="dfd-bg-frame" allowfullscreen></iframe>';
				if($video_type != 'full-screen-video') {
					echo	'<div class="dfd-video-bg dfd-youtube-bg dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs">
								<div class="video-js">'.$video.'</div>
							</div>';
				}
			}
			break;
		case 'vimeo':
			$dfd_vimeo_video_id = DfdMetaBoxSettings::get('dfd_stun_bg_vimeo_id');
			if($dfd_vimeo_video_id && !empty($dfd_vimeo_video_id)) {
				if($loop) 
					$extra_url_prop .= '&amp;loop=1';
				if($muted) 
					$data_atts .= ' data-muted="1"';
				else
					$data_atts .= ' data-muted="0"';
				$video = '<iframe id="'.esc_attr($uniqid).'" '.$data_atts.' src="https://player.vimeo.com/video/'.esc_attr($dfd_vimeo_video_id).'?api=1&amp;portrait=0&amp;rel=0&amp;autoplay=1'.esc_attr($extra_url_prop).'" width="100%" height="100%" frameborder="0" class="dfd-bg-frame"></iframe>';
				if($video_type != 'full-screen-video') {
					echo	'<div class="dfd-video-bg dfd-vimeo-bg dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs">
								<div class="video-js">'.$video.'</div>
							</div>';
				}
			}
			break;
			
	}
	if($video_type == 'full-screen-video' && !empty($video)) {
		wp_enqueue_script( 'video-module-js', get_template_directory_uri() . '/assets/js/crum-video-module.js', array( 'jquery' ), false, true );
		$full_screen_video_html .= '<div id="stun-header-'.esc_attr($uniqid).'" class="dfd-videoplayer style-2 layout-4 text-center">';
			$full_screen_video_html .= '<div class="button-wrap">';
				$full_screen_video_html .= '<div class="dfd-video-button">';
					$full_screen_video_html .= '<span class="mask-for-hover"></span>';
					$full_screen_video_html .= '<span class="play"></span>';
				$full_screen_video_html .= '</div>';
				$full_screen_video_html .= '<a href="#'. esc_attr($uniqid) .'" class="dfd-video-link"></a>';
			$full_screen_video_html .= '</div>';
			$full_screen_video_html .= '<div style="display: none;" id="'. esc_attr($uniqid) .'">';
				$full_screen_video_html .= $video;
			$full_screen_video_html .= '</div>';
		$full_screen_video_html .= '</div>';
		$full_screen_video_html .= '<script type="text/javascript">(function($) {
										$(document).ready(function(){
											DFD_VideoModule.init("'.esc_js($uniqid).'","stun-header-'.esc_js($uniqid).'");
										});
									})(jQuery);</script>';
	}
}
