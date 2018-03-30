<?php

function heap_custom_backgrounds_support(){

	$background_args = array(
		'default-color'          => '1a1717',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);

	add_theme_support( 'custom-background', $background_args );
}

function heap_prepare_password_for_custom_post_types(){

	global $heap_private_post;
	$heap_private_post = heap_is_password_protected();

}

add_action('wp', 'heap_prepare_password_for_custom_post_types');

// Add "Next page" button to TinyMCE
function add_next_page_button( $mce_buttons ) {
	$pos = array_search( 'wp_more', $mce_buttons, true );
	if ( $pos !== false ) {
		$tmp_buttons = array_slice( $mce_buttons, 0, $pos+1 );
		$tmp_buttons[] = 'wp_page';
		$mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos+1 ) );
	}
	return $mce_buttons;
}
add_filter( 'mce_buttons', 'add_next_page_button' );

// Customize the "wp_link_pages()" to be able to display both numbers and prev/next links
function add_next_and_number( $args ) {
	if ( $args['next_or_number'] == 'next_and_number' ) {
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';
		$prev = '';
		$next = '';
		if ( $multipage and $more ) {
			$i = $page-1;
			if ( $i and $more ) {
				$prev .= _wp_link_page( $i );
				$prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
				$prev = apply_filters( 'wp_link_pages_link', $prev, 'prev' );
			}
			$i = $page+1;
			if ( $i <= $numpages and $more ) {
				$next .= _wp_link_page( $i );
				$next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
				$next = apply_filters( 'wp_link_pages_link', $next, 'next' );
			}
		}
		$args['before'] = $args['before'] . $prev;
		$args['after'] = $next . $args['after'];
	}
	return $args;
}
add_filter( 'wp_link_pages_args', 'add_next_and_number' );

add_action( 'print_media_templates', 'heap_custom_style_for_mediabox' );

function heap_custom_style_for_mediabox() { ?>
	<style>
		.media-sidebar {
			width: 400px;
		}
			.media-sidebar .field p.desc {
				color:#666;
				font-size:11px;
				margin-top:3px;
			}
			.media-sidebar .field p.help {
				display:none;
			}

			/*
			 * Options Specific Rules
			 */
			.media-sidebar .setting[data-setting="description"] textarea {
				min-height:100px;
			}
			.media-sidebar table.compat-attachment-fields input[type=checkbox], .media-sidebar table.compat-attachment-fields input[type=checkbox] {
				margin:0 6px 0 0;
			}

			table.compat-attachment-fields {
				margin-top:12px;
			}

			.media-sidebar tr.compat-field-video_autoplay {
				margin:-12px 0 0 0;
			}
			.media-sidebar tr.compat-field-video_autoplay th.label {
				opacity:0;
			}

			.media-sidebar tr.compat-field-external_url {

			}
		.attachments-browser .attachments, .attachments-browser .uploader-inline,
		.attachments-browser .media-toolbar {
			right:433px;
		}
		.compat-item .field {
			width:65%;
		}
	</style>
<?php
}