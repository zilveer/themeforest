<?php
/**
 * Author page
 *
 * @package shift_CV
 */
            global $curauth;
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			if(is_object($curauth)) {
			$curauth_name = $curauth->first_name || $curauth->last_name ? $curauth->first_name . ' ' . $curauth->last_name : $curauth->nickname;
			$mult = min(2, max(1, get_theme_option("retina_ready")));
?>
            <section id="blog_author" class="section blog_section">
				<div id="post_author" class="section_header blog_section_header author">
					<div class="photo"><?php echo str_replace(' photo', '', str_replace(' avatar', '', get_avatar( get_the_author_meta('email', $curauth->ID) , $size=97*$mult ))); ?></div>
					<div class="extra_wrap">
						<h3><span class="about"><?php _e('About', 'wpspace'); ?></span> <?php echo $curauth_name; ?></h3>
						<div class="description">
							<p class="desc"><?php echo nl2br(get_the_author_meta('description', $curauth->ID)); ?></p>
						</div>
					</div>
					</div>
			</section>
<?php } ?>