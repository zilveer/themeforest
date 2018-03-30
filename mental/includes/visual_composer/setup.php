<?php

vc_add_shortcode_param( 'attach_video', 'vcm_attach_video_form_field', get_template_directory_uri() . '/assets/js/vc_extend/video_loader.js' );

function vcm_fieldAttachedImages( $images = array() ) {
	$output = '';

	foreach ( $images as $image ) {
		if ( is_numeric( $image ) ) {
			$thumb_src = wp_get_attachment_url( $image );
			//$thumb_src = isset( $thumb_src[0] ) ? $thumb_src[0] : '';
		} else {
			$thumb_src = $image;
		}

		if ( $thumb_src ) {
			$output .= '
			<li class="added" title="' . $thumb_src . '">
				<a href="#" class="vc_icon-remove" title="' . __( 'Remove', 'mental' ) . '"></a>
			</li>';
		}
	}

	return $output;
}

function vcm_attach_video_form_field( $settings, $value, $tag ) {
	$output = '<style type="text/css">
            .gallery_widget_attached_videos li{
                background: rgba(0, 0, 0, 0) url("' . get_template_directory_uri() . '/assets/img/video.png") no-repeat scroll center center !important;
            }
            .gallery_widget_attached_videos .vc_icon-remove{
                background: rgba(0, 0, 0, 0) url("' . get_template_directory_uri() . '/assets/img/remove.png") no-repeat scroll center center;
                display: block;
                height: 16px;
                left: 50%;
                position: absolute;
                top: 50%;
                transform: translate(-50%, -50%);
                width: 16px;
            }
            .gallery_widget_add_video{
                background: #f5f5f5 url("' . get_template_directory_uri() . '/assets/img/add.png") no-repeat scroll center center;
                border: 1px solid #dfdfdf;
                color: #f5f5f5;
                display: block;
                float: left;
                font-size: 0;
                height: 80px;
                margin-top: 0;
                width: 80px;
            }
        </style>';
	$param_value = $value;
	$output .= '<input type="hidden" class="wpb_vc_param_value gallery_widget_attached_images_ids '
	           . $settings['param_name'] . ' '
	           . $settings['type'] . '" name="' . $settings['param_name'] . '" value="' . $value . '"/>';
	$output .= '<div class="gallery_widget_attached_images gallery_widget_attached_videos">';
	$output .= '<ul class="gallery_widget_attached_images_list">';
	$output .= ( '' !== $param_value ) ? vcm_fieldAttachedImages( explode( ',', $value ) ) : '';
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '<div class="gallery_widget_site_images">';
	$output .= '</div>';
	$output .= '<a class="gallery_widget_add_video" href="#" use-single="true" title="'
	           . __( 'Choose video', 'mental' ) . '">' . __( 'Choose video', 'mental' ) . '</a>'; //class: button
	return $output;
}