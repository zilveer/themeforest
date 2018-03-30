<?php
/* ---------------------------------------------------------------------------
 * Hook of Top
 * --------------------------------------------------------------------------- */
function veda_hook_top() {
	if( veda_option( 'pageoptions','enable-top-hook' ) ) :
		echo '<!-- veda_hook_top -->';
			$hook = stripslashes(htmlspecialchars_decode(veda_option('pageoptions','top-hook'),ENT_QUOTES));
			$hook = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "$1", $hook);
			if (!empty($hook))
				echo DTCoreShortcodesDefination::dtShortcodeHelper( $hook );
		echo '<!-- veda_hook_top -->';
	endif;	
}
add_action( 'veda_hook_top', 'veda_hook_top' );


/* ---------------------------------------------------------------------------
 * Hook of Content before
 * --------------------------------------------------------------------------- */
function veda_hook_content_before() {
	if( veda_option( 'pageoptions','enable-content-before-hook' ) ) :
		echo '<!-- veda_hook_content_before -->';
			$hook = stripslashes(htmlspecialchars_decode(veda_option('pageoptions','content-before-hook'),ENT_QUOTES));
			$hook = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "$1", $hook);
			if (!empty($hook))
				echo DTCoreShortcodesDefination::dtShortcodeHelper( $hook );
		echo '<!-- veda_hook_content_before -->';
	endif;
}
add_action( 'veda_hook_content_before', 'veda_hook_content_before' );


/* ---------------------------------------------------------------------------
 * Hook of Content after
 * --------------------------------------------------------------------------- */
function veda_hook_content_after() {
	if( veda_option( 'pageoptions','enable-content-after-hook' ) ) :
		echo '<!-- veda_hook_content_after -->';
			$hook = stripslashes(htmlspecialchars_decode(veda_option('pageoptions','content-after-hook'),ENT_QUOTES));
			$hook = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "$1", $hook);
			if (!empty($hook))
				echo DTCoreShortcodesDefination::dtShortcodeHelper( $hook );
		echo '<!-- veda_hook_content_after -->';
	endif;
}
add_action( 'veda_hook_content_after', 'veda_hook_content_after' );


/* ---------------------------------------------------------------------------
 * Hook of Bottom
 * --------------------------------------------------------------------------- */
function veda_hook_bottom() {
	if( veda_option( 'pageoptions','enable-bottom-hook' ) ) :
		echo '<!-- veda_hook_bottom -->';
			$hook = stripslashes(htmlspecialchars_decode(veda_option('pageoptions','bottom-hook'),ENT_QUOTES));
			$hook = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "$1", $hook);
			if (!empty($hook))
				echo DTCoreShortcodesDefination::dtShortcodeHelper( $hook );
		echo '<!-- veda_hook_bottom -->';
	endif;
}
add_action( 'veda_hook_bottom', 'veda_hook_bottom' );?>