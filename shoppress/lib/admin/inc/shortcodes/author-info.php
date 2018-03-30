<?php

if ( ! function_exists( 'gp_author_info_panel' ) ) {
	function gp_author_info_panel($atts, $content = null) {

		$out = "";	
		$out .=
	
		'<div class="author-info">'.
	
			get_avatar(get_the_author_meta('ID'), 50).'
	
			<div class="author-meta">
		
				<div class="author-meta-top">
				
					<div class="author-name">'.__('By', 'gp_lang').' <a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a></div>
			
				</div>
			
				<div class="author-desc">'.get_the_author_meta('description').'</div>
		
			</div>
		
		</div>
		';
				
	   return $out;
   
	}
}
add_shortcode("author", "gp_author_info_panel");

?>