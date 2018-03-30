<?php

class PeThemeHeader {

	public function title() {
		global $page, $paged;
		
		wp_title('|',true,'right');

		bloginfo('name');

		if (( is_home() || is_front_page() ) ) {
			$description = get_bloginfo('description','display');
			if ($description) {
				echo " | ".$description;
			}
		}

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 ) {
			echo " | ".sprintf(__('Page %s','Pixelentity Theme/Plugin'),max($paged,$page));
		}		
	}

	public function wp_head() {
		if (is_singular() && get_option('thread_comments')) {
			wp_enqueue_script("comment-reply");
		}
		wp_head();
		do_action("pe_theme_wp_head");
	}
}

?>