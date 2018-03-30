<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	
	$ci_defaults['preview_content']     = 'disabled'; //enabled means content, disabled means excerpt
	$ci_defaults['excerpt_length']      = 50;
	$ci_defaults['excerpt_text']        = '[...]';
	$ci_defaults['read_more_text']      = __('Read More &raquo;', 'ci_theme');
	$ci_defaults['excerpt_link_cutoff'] = '';

	if( !function_exists('ci_read_more') ):
	function ci_read_more( $post_id = false, $return = false ) {
		global $post;

		if($post_id===false)
			$post_id = $post->ID;

		$link = sprintf( '<a class="ci-more-link" href="%s"><span>%s</span></a>',
			esc_url( get_permalink( $post_id ) ),
			ci_setting( 'read_more_text' )
		);

		$link = apply_filters( 'ci-read-more-link', $link, ci_setting( 'read_more_text' ), get_permalink( $post_id ) );

		//
		// This is how to set the read more markup of ci_read_more() per theme.
		// You need to do it in one of the theme's file (e.g. in /functions/tabs/), not in here.
		//
		/*
		add_filter( 'ci-read-more-link', 'ci_theme_readmore', 10, 3 );
		if ( ! function_exists( 'ci_theme_readmore' ) ):
		function ci_theme_readmore( $html, $text, $link ) {
			return '<a class="btn" href="' . $link . '">' . $text . '</a>';
		}
		endif;
		*/

		if ( $return === true ) {
			return $link;
		} else {
			// We shouldn't escape $link as it contains the whole <a> element.
			echo $link;
		}
	}
	endif;
	
	// Handle the excerpt.
	add_filter( 'excerpt_length', 'ci_excerpt_length' );
	if ( ! function_exists( 'ci_excerpt_length' ) ):
	function ci_excerpt_length( $length ) {
		return ci_setting( 'excerpt_length' );
	}
	endif;

	add_filter( 'excerpt_more', 'ci_excerpt_more' );
	if ( ! function_exists( 'ci_excerpt_more' ) ):
	function ci_excerpt_more( $more ) {
		return ci_setting( 'excerpt_text' );
	}
	endif;

	add_filter( 'excerpt_more', 'ci_link_excerpt_more', 99 );
	if ( ! function_exists( 'ci_link_excerpt_more' ) ):
	function ci_link_excerpt_more( $more ) {
		$link = ci_setting( 'excerpt_link_cutoff' );
		if ( ! empty( $link ) ) {
			return '<a href="' . esc_url( get_permalink() ) . '">' . $more . "</a>";
		} else {
			return $more;
		}
	}
	endif;

	add_filter( 'the_content_more_link', 'ci_change_read_more', 10, 2 );
	if ( ! function_exists( 'ci_change_read_more' ) ):
	function ci_change_read_more( $more_link, $more_link_text ) {
		return str_replace( $more_link_text, ci_setting( 'read_more_text' ), $more_link );
	}
	endif;

?>
<?php else: ?>
		
	<fieldset id="ci-panel-excerpt" class="set">
		<legend><?php _e('Content Preview', 'ci_theme'); ?></legend>

		<fieldset id="ci-panel-excerpt-preview-content">
			<p class="guide"><?php _e('You can select whether you want the Content or the Excerpt to be displayed on listing pages.', 'ci_theme'); ?></p>
			<label><?php _e('Use the following on listing pages', 'ci_theme'); ?></label>
			<?php
				ci_panel_radio( 'preview_content', 'use_content', 'enabled', __( 'Use the Content', 'ci_theme' ) );
				ci_panel_radio( 'preview_content', 'use_excerpt', 'disabled', __( 'Use the Excerpt', 'ci_theme' ) );
			?>
		</fieldset>

		<fieldset id="ci-panel-excerpt-read-more">
			<p class="guide mt10"><?php _e('You can set what the Read More text will be. This applies to both the Content and the Excerpt.', 'ci_theme'); ?></p>
			<?php ci_panel_input( 'read_more_text', __( 'Read More text', 'ci_theme' ) ); ?>
		</fieldset>

		<fieldset id="ci-panel-excerpt-excerpt-options">
			<p class="guide mt10"><?php _e('You can define how long the Excerpt will be (in words). You can also set the text that appears when the excerpt is auto-generated and is automatically cut-off. These options only apply to the Excerpt.', 'ci_theme'); ?></p>
			<?php
				ci_panel_input( 'excerpt_length', __( 'Excerpt length (in words)', 'ci_theme' ) );
				ci_panel_input( 'excerpt_text', __( 'Excerpt auto cut-off text', 'ci_theme' ) );
				ci_panel_checkbox( 'excerpt_link_cutoff', 'on', __( 'Link cut-off text to permalink', 'ci_theme' ) );
			?>
		</fieldset>
	</fieldset>
		
<?php endif; ?>