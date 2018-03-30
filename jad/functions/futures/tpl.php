<?php

require_once SG_TEMPLATEPATH . '/functions/futures/core.php';

function sg_the_date()
{
	$the_date = get_the_date('');
	$the_date = apply_filters('the_date', $the_date, '', '', '');
	echo $the_date;
}

function sg_the_tag_list($t = 'post_tag', $c = '', $l = TRUE)
{
	$terms = get_the_terms(NULL, $t);

	if (is_wp_error($terms)) return $terms;
	if (empty($terms)) return false;

	$term_links = array();

	foreach ($terms as $term) {
		$link = get_term_link($term, $t);
		if (is_wp_error($link)) return $link;
		$term_links[] = $l ? '<a href="' . esc_url($link) . '" rel="tag">' . $term->name . '</a>' : $term->name;
	}

	return join($c, $term_links);
}

function sg_the_category($echo = TRUE)
{
	$categories = get_the_terms(NULL, 'category');
	if (! $categories)
		$categories = array();

	$categories = array_values($categories);
	$categories = apply_filters('get_the_categories', $categories);

	if (!empty($categories)) {
		$category = $categories[0];
		$category_link = get_category_link($category->term_id);
		if (!$echo)	return '<a href="' . $category_link . '">' . $category->name . '</a>';
		echo '<a href="' . $category_link . '">' . $category->name . '</a>';
	}
}

function sg_the_portfolio_category($id = false, $echo = TRUE) {
	$categories = get_the_terms($id, 'portfolio_category');
	if (!$categories)
		$categories = array();

	$categories = array_values($categories);
	$cats = array();

	foreach (array_keys($categories) as $key) {
		$cats[] = str_replace(' ', '-', strtolower($categories[$key]->name));
	}

	if (!$echo) return implode(' ', $cats);
	echo implode(' ', $cats);
}

function sg_the_title()
{
	$title = get_the_title();

	if (is_category()) {
		$title = sprintf(__('%s Category', SG_TDN), single_cat_title());
	} elseif (is_day()) {
		$title = sprintf(__('Archive for %s', SG_TDN), get_the_time('d M, Y'));
	} elseif (is_month()) {
		$title = sprintf(__('Archive for %s', SG_TDN), get_the_time('M, Y'));
	} elseif (is_year()) {
		$title = sprintf(__('Archive for %s', SG_TDN), get_the_time('Y'));
	} elseif (is_search()) {
		$title = __('Search Results', SG_TDN);
	} elseif (is_author()) {
		$title = __('Author Archive', SG_TDN);
	} elseif (is_archive()) {
		if (sg_term() == 'portfolio') {
			$title = __('Portfolio Archive', SG_TDN);
		} else {
			$title = __('Blog Archive', SG_TDN);
		}
	} elseif (is_attachment()) {
		$title = __('Attachment', SG_TDN);
	} elseif (is_404()) {
		$title = __('404 - File Not Found', SG_TDN);
	} elseif (is_home()) {
		$title = __('Hello!!!', SG_TDN);
	}

	echo $title;
}

function sg_the_meta_title()
{
	echo '<title>';
		bloginfo('name');
		echo ' :: ';
		sg_the_title();
	echo '</title>';
}

function sg_breadcrumbs()
{
	global $post;
	$sep = '</li><li>';
	$front = get_option('page_on_front');
	$bpages = array();
	$ppages = array();

	echo '<ul class="alignright"><li>';
	echo '<a href="' . home_url() . '">' . __('Home', SG_TDN) . '</a>';

	if (is_page() && $post->post_parent) {
		$anc = get_post_ancestors($post->ID);
		$anc = array_reverse($anc);
		foreach ($anc as $ancestor) {
			if ($ancestor != $front) {
				echo $sep . '<a href="'.get_permalink($ancestor).'">'.get_the_title($ancestor).'</a>';
			}
		}
	}

	if (is_archive() OR is_author() OR is_date() OR is_single()) {
		$get_posts = new WP_Query;
		$pages = $get_posts->query('post_type=page&posts_per_page=-1');
		foreach ($pages as $page) {
			$post_custom = get_post_custom($page->ID);
			if ($post_custom['_wp_page_template'][0] == 'pg-blog.php') {
				$bpages[] = $page->ID;
			}
			if ($post_custom['_wp_page_template'][0] == 'pg-portfolio.php') {
				$ppages[] = $page->ID;
			}
		}
		if (_sg('Post')->getParent() != '#') $bpages[-1] = _sg('Post')->getParent();
		if (_sg('PortfolioPost')->getParent() != '#') $ppages[-1] = _sg('PortfolioPost')->getParent();
	}

	if (sg_term() == 'portfolio') {
		if (isset($ppages[-1])) {
			if ($ppages[-1] != $front) {
				echo $sep . '<a href="'.get_permalink($ppages[-1]).'">'.get_the_title($ppages[-1]).'</a>';
			}
		} else {
			if (isset($ppages[0]) AND $ppages[0] != $front) {
				echo $sep . '<a href="'.get_permalink($ppages[0]).'">'.get_the_title($ppages[0]).'</a>';
			} elseif (isset($bpages[1]) AND $bpages[1] != $front) {
				echo $sep . '<a href="'.get_permalink($ppages[1]).'">'.get_the_title($ppages[1]).'</a>';
			}
		}
	} elseif (is_archive() OR is_author() OR is_date()) {
		if (isset($bpages[-1])) {
			if ($bpages[-1] != $front) {
				echo $sep . '<a href="'.get_permalink($bpages[-1]).'">'.get_the_title($bpages[-1]).'</a>';
			}
		} else {
			if (isset($bpages[0]) AND $bpages[0] != $front) {
				echo $sep . '<a href="'.get_permalink($bpages[0]).'">'.get_the_title($bpages[0]).'</a>';
			} elseif (isset($bpages[1]) AND $bpages[1] != $front) {
				echo $sep . '<a href="'.get_permalink($bpages[1]).'">'.get_the_title($bpages[1]).'</a>';
			}
		}
	}

	if (is_single()) {
		if(get_post_type() == 'post') {
			if (isset($bpages[-1])) {
				if ($bpages[-1] != $front) {
					echo $sep . '<a href="'.get_permalink($bpages[-1]).'">'.get_the_title($bpages[-1]).'</a>';
				}
			} else {
				if (isset($bpages[0]) AND $bpages[0] != $front) {
					echo $sep . '<a href="'.get_permalink($bpages[0]).'">'.get_the_title($bpages[0]).'</a>';
				} elseif (isset($bpages[1]) AND $bpages[1] != $front) {
					echo $sep . '<a href="'.get_permalink($bpages[1]).'">'.get_the_title($bpages[1]).'</a>';
				}
			}
		} elseif (get_post_type() == 'portfolio') {
			if (isset($ppages[-1])) {
				if ($ppages[-1] != $front) {
					echo $sep . '<a href="'.get_permalink($ppages[-1]).'">'.get_the_title($ppages[-1]).'</a>';
				}
			} else {
				if (isset($ppages[0]) AND $ppages[0] != $front) {
					echo $sep . '<a href="'.get_permalink($ppages[0]).'">'.get_the_title($ppages[0]).'</a>';
				} elseif (isset($bpages[1]) AND $bpages[1] != $front) {
					echo $sep . '<a href="'.get_permalink($ppages[1]).'">'.get_the_title($ppages[1]).'</a>';
				}
			}
		}
	}

	echo $sep;
	sg_the_title();
	echo '</li></ul>';
}

function sg_right_sidebar_b()
{
	$opt1 = array(
			'before_widget' => '<div id="dr-categories" class="widget_categories bottom-2_4em">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		);
	$opt2 = array(
			'before_widget' => '<div id="dr-archives" class="widget_archive bottom-2_4em">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		);
	$opt3 = array(
			'before_widget' => '<div id="dr-tag_cloud" class="widget_tag_cloud bottom-2_4em">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		);

	the_widget('WP_Widget_Categories', '', $opt1);
	the_widget('WP_Widget_Archives', '', $opt2);
	the_widget('WP_Widget_Tag_Cloud', '', $opt3);
}

function sg_right_sidebar_p()
{
	$opt1 = array(
			'before_widget' => '<div id="dr-portfolio-categories" class="widget_portfolio_categories bottom-2_4em">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		);
	$opt2 = array(
			'before_widget' => '<div id="dr-portfolio-tag_cloud" class="widget_portfolio_tag_cloud bottom-2_4em">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		);

	the_widget('SG_Widget_Portfolio_Categories', '', $opt1);
	the_widget('SG_Widget_Portfolio_Tag_Cloud', '', $opt2);
}

function sg_right_sidebar()
{
	$opt0 = array(
			'before_widget' => '<div id="dr-search" class="widget_search bottom-2_4em">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		);

	the_widget('WP_Widget_Search', array('title' => __('Search', SG_TDN)), $opt0);
}

function sg_bottom_sidebar()
{
	$opt1 = array(
		'before_widget' => '<div id="df-tag-cloud" class="widget_tag_cloud ef-col ef-gu4 bottom-2_4em">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	);
	$opt2 = array(
		'before_widget' => '<div id="df-sg-flickr" class="widget_flickr ef-col ef-gu4 bottom-2_4em">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	);
	$opt3 = array(
		'before_widget' => '<div id="df-categories" class="widget_categories ef-col ef-gu4 bottom-2_4em">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	);

	$f = _sg('HandF')->getFlickrSettings();

	the_widget('WP_Widget_Tag_Cloud', NULL, $opt1);
	if (!empty($f['flickr_id'])) the_widget('SG_Widget_Flickr', $f, $opt2);
	the_widget('WP_Widget_Categories', NULL, $opt3);
}

function sg_pagination($max)
{
	if ($max > 1) {
		$paged = sg_paged();
?>
	<hr class="ef-blank" />
	<div class="ef-pagination">
		<?php _e('Pages:', SG_TDN); ?>
		<a href="<?php echo get_pagenum_link(); ?>"<?php echo ($paged == 1) ? ' class="page-active"' : '' ?>><span>1</span></a>
		<?php
			echo ($paged > 7) ? '<span><-</span>' : '';
			for ($i = ($paged - 5); $i < ($paged + 6); $i++) {
				if ($i > 1 AND $i < $max) {
		?>
		<a href="<?php echo get_pagenum_link($i); ?>"<?php echo ($paged == $i) ? ' class="page-active"' : '' ?>><span><?php echo $i; ?></span></a>
		<?php
				}
			}
			echo ($paged < ($max - 6)) ? '<span>-></span>' : '';
		?>
		<a href="<?php echo get_pagenum_link($max); ?>"<?php echo ($paged == $max) ? ' class="page-active"' : '' ?>><span><?php echo $max; ?></span></a>
	</div>
<?php
	}
}

function sg_navigation($type = 'yes')
{
?>
	<div class="ef-page-nav">
	<?php
		if ($type == 'title') {
			previous_post_link('<span class="prev-pg">%link</span>');
			echo '&nbsp;';
			next_post_link('<span class="next-pg ml-10">%link</span>');
		} elseif ($type == 'yes') {
			if (sg_get_tpl() == 'post|default') {
				$prev = __('Previous post', SG_TDN);
				$next = __('Next post', SG_TDN);
			} elseif (sg_get_tpl() == 'portfolio|default') {
				$prev = __('Previous work', SG_TDN);
				$next = __('Next work', SG_TDN);
			} else {
				$prev = __('Previous page', SG_TDN);
				$next = __('Next page', SG_TDN);
			}
			previous_post_link('<span class="prev-pg">%link</span>', $prev);
			echo '&nbsp;';
			next_post_link('<span class="next-pg ml-10">%link</span>', $next);
		}
	?>
	</div>
<?php
}

function sg_comments_navigation()
{
	if (!get_option('page_comments')) return;
?>
	<div id="pagination-comments" class="bottom-40">
		<?php previous_comments_link('<span id="first-pg">' . __('<- Older Comments', SG_TDN) . '</span>'); ?>
		<?php next_comments_link('<span id="last-pg">' . __('Newer Comments ->', SG_TDN) . '</span>'); ?>
	</div>
<?php
}

function sg_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	$autor_url = get_comment_author_url();
	$autor_url = empty($autor_url) ? '#comment-' . get_comment_ID() : $autor_url;
	$autor_url = '<a class="ef-avatar alignleft" href="' . $autor_url . '">'. get_avatar($comment, 60) . '</a>';
?>
	<li style="list-style: none;">
		<?php echo $autor_url; ?>
		<div <?php comment_class('post-comm'); ?> id="comment-<?php comment_ID(); ?>">
			<?php edit_comment_link(__('(Edit)', SG_TDN), ' '); ?>
			<div class="auth">
				<strong><?php comment_author_link(); ?></strong>&nbsp;<?php _e('says:', SG_TDN) ?><span><?php printf(__('%1$s at %2$s', SG_TDN), get_comment_date('F d, Y'), get_comment_time()); ?></span>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', SG_TDN); ?></em>
				<?php endif; ?>
			</div>
			<?php comment_text(); ?>
			<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply', SG_TDN), 'login_text' => __('Login to Reply', SG_TDN)))); ?>
		</div>
<?php
}

function sg_comment_form( $args = array(), $post_id = null )
{
	global $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = ! empty( $user->ID ) ? $user->display_name : '';

	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	$aria_req_l = ($req ? '*' : '');
	$fields =  array(
		'author' => '<div><label>' . __('Name', SG_TDN) . $aria_req_l . '</label><div><input id="name" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div></div>',
		'email'  => '<div><label>' . __('E-mail', SG_TDN) . $aria_req_l . '</label><div><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div></div>',
		'url'    => '<div><label>' . __('Website', SG_TDN) . '</label><div><input id="website" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div></div>',
	);

	$required_text = '<span class="alignright">' . __('* required', SG_TDN) . '</span>';
	$defaults = array(
		'fields'               => apply_filters('comment_form_default_fields', $fields),
		'comment_field'        => '<div class="ef-textarea"><label>' . __('Message', SG_TDN) .'</label><div><textarea id="message" name="comment" aria-required="true"></textarea></div></div>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', SG_TDN), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', SG_TDN), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
		'comment_notes_before' => '',
		'comment_notes_after'  => ( $req ? $required_text : '' ),
		'id_form'              => 'ef-reply',
		'id_submit'            => 'send',
		'title_reply'          => __('Leave a reply', SG_TDN),
		'title_reply_to'       => __('Leave a Reply to %s', SG_TDN),
		'cancel_reply_link'    => __('(Cancel reply)', SG_TDN),
		'label_submit'         => __('Send', SG_TDN),
	);

	$args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));

	?>
		<?php if ( comments_open() ) : ?>
			<hr class="bottom-2_4em" />
			<?php do_action('comment_form_before'); ?>
			<div id="respond" class="<?php echo ((is_user_logged_in()) ? ' respond-logged' : ''); ?>">
				<h4 id="reply-title"><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?>: <small><?php cancel_comment_reply_link($args['cancel_reply_link']); ?></small></h4>
				<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action('comment_form_must_log_in_after'); ?>
				<?php else : ?>
					<form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" class="ef-form" id="<?php echo esc_attr($args['id_form']); ?>">
						<?php do_action('comment_form_top'); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity); ?>
							<?php do_action('comment_form_logged_in_after', $commenter, $user_identity); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action('comment_form_before_fields');
							foreach ((array) $args['fields'] as $name => $field) {
								echo apply_filters("comment_form_field_{$name}", $field) . "\n";
							}
							do_action('comment_form_after_fields');
							?>
						<?php endif; ?>
						<?php echo apply_filters('comment_form_field_comment', $args['comment_field']); ?>
						<div class="send-wrap">
							<div class="alignleft">
								<input name="submit" type="submit" class="send" id="<?php echo esc_attr($args['id_submit']); ?>" value="<?php echo esc_attr($args['label_submit']); ?>" />
							</div>
							<?php echo $args['comment_notes_after']; ?>
							<?php comment_id_fields( $post_id ); ?>
						</div>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action('comment_form_after'); ?>
		<?php else : ?>
			<?php do_action('comment_form_comments_closed'); ?>
		<?php endif; ?>
	<?php
}

function sg_header_css()
{
	wp_register_style('reset-style', get_template_directory_uri() . '/css/reset.css', false);
	wp_register_style('theme-style', get_template_directory_uri() . '/css/style.css', false);
	wp_register_style('greed-style', get_template_directory_uri() . '/css/1172_12_40.css', false);
	wp_register_style('layout-style', get_template_directory_uri() . '/css/additional-fluid.css', false);
	wp_register_style('shortcodes', get_template_directory_uri() . '/css/shortcodes.css', false);
	wp_register_style('style', get_stylesheet_uri(), false);

	wp_register_style('flexslider', get_template_directory_uri() . '/js/flexslider/flexslider.css', false);
	wp_register_style('supersized', get_template_directory_uri() . '/js/supersized/css/supersized.css', false);
	wp_register_style('supersized.shutter', get_template_directory_uri() . '/js/supersized/theme/supersized.shutter.css', false);
	wp_register_style('lightweight', get_template_directory_uri() . '/js/view/alt.css', false);
	wp_register_style('fontface', get_template_directory_uri() . '/fontface/stylesheet.css', false);

	wp_enqueue_style('reset-style');
	wp_enqueue_style('theme-style');
	wp_enqueue_style('greed-style');
	wp_enqueue_style('layout-style');
	wp_enqueue_style('shortcodes');

	wp_enqueue_style('flexslider');
	wp_enqueue_style('lightweight');

	if (sg_get_tpl() == 'page|home' AND _sg('Slider')->getSliderType() == 'full' AND _sg('Slider')->getSlidesCount() > 0) {
		wp_enqueue_style('supersized');
		wp_enqueue_style('supersized.shutter');
	}

	if (!_sg('Modules')->enabled('Theme') OR _sg('Theme')->isFontface()) wp_enqueue_style('fontface');

	wp_enqueue_style('style');
}

function sg_header_js()
{
?>
	<script type="text/javascript">
		sg_template_url = "<?php echo get_template_directory_uri(); ?>";
	</script>
<?php
	wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-custom.js', false);
	wp_register_script('jquery.mobilemenu', get_template_directory_uri() . '/js/jquery.mobilemenu.js', false);
	wp_register_script('jquery.fitvids', get_template_directory_uri() . '/js/fitvids/jquery.fitvids.js', false);
	wp_register_script('jquery.isotope', get_template_directory_uri() . '/js/izotope/jquery.isotope.min.js', false);
	wp_register_script('jquery.preloader', get_template_directory_uri() . '/js/jPreloader/jquery.preloader.min.js', false);
	wp_register_script('jquery.flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider.js', false);
	wp_register_script('jquery.tweet', get_template_directory_uri() . '/js/tweet/jquery.tweet.min.js', false);
	wp_register_script('jquery.jflickrfeed', get_template_directory_uri() . '/js/jFlickrfeed/jflickrfeed.min.js', false);
	wp_register_script('jquery.lightweight', get_template_directory_uri() . '/js/view/view.min.js?auto', false);
	wp_register_script('jquery.scrollTo', get_template_directory_uri() . '/js/scrollTo/jquery.scrollTo-min.js', false);
	wp_register_script('css3-mediaqueries', get_template_directory_uri() . '/js/css3-mediaqueries.js', false);
	wp_register_script('sf-hoverIntent', get_template_directory_uri() . '/js/superfish/hoverIntent.js', false);
	wp_register_script('sf-superfish', get_template_directory_uri() . '/js/superfish/superfish.js', false);
	wp_register_script('supersized', get_template_directory_uri() . '/js/supersized/js/supersized.3.2.7.min.js', false);
	wp_register_script('supersized.cshutter', get_template_directory_uri() . '/js/supersized/theme/supersized.cshutter.min.js', false);
	wp_register_script('sg-height', get_template_directory_uri() . '/js/column-height.js', false);
	wp_register_script('sg-maps-api', 'http://maps.google.com/maps/api/js?sensor=false', false);
	wp_register_script('sg-maps-goMap', get_template_directory_uri() . '/js/goMap/goMap-1.3.2.min.js', false);
	wp_register_script('jad-form', get_template_directory_uri() . '/js/jad-form.js', false);
	wp_register_script('sg-custom', get_template_directory_uri() . '/js/custom.js', false);

	wp_enqueue_script('jquery');
	wp_enqueue_script('sg-jquery-ui');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-effects-core');
	wp_enqueue_script('jquery-effects-blind');
	wp_enqueue_script('jquery-effects-fade');
	wp_enqueue_script('jquery-effects-slide');
	wp_enqueue_script('modernizr');
	wp_enqueue_script('jquery.isotope');
	wp_enqueue_script('jquery.mobilemenu');
	wp_enqueue_script('jquery.fitvids');
	wp_enqueue_script('jquery.preloader');
	wp_enqueue_script('jquery.flexslider');
	wp_enqueue_script('jquery.tweet');
	wp_enqueue_script('jquery.jflickrfeed');
	wp_enqueue_script('jquery.lightweight');
	wp_enqueue_script('jquery.scrollTo');
	wp_enqueue_script('css3-mediaqueries');
	wp_enqueue_script('sf-hoverIntent');
	wp_enqueue_script('sf-superfish');
	wp_enqueue_script('sg-height');

	if (sg_get_tpl() == 'page|home' AND _sg('Slider')->getSliderType() == 'full' AND _sg('Slider')->getSlidesCount() > 0) {
		wp_enqueue_script('supersized');
		wp_enqueue_script('supersized.cshutter');
	}

	if (sg_get_tpl() == 'page|contact') {
		wp_enqueue_script('jad-form');
		wp_enqueue_script('sg-maps-api');
		wp_enqueue_script('sg-maps-goMap');
	}

	if (is_singular() AND _sg('Post')->showComments() AND get_option('thread_comments')) {
		wp_enqueue_script('jad-form');
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('sg-custom');

	if (SG_DEMO_MODE) sg_demo_header();
}

function sg_footer_js()
{
	if (SG_DEMO_MODE) sg_demo_body();
}

function sg_header_meta()
{
	if (_sg('Modules')->enabled('SEO')) {
		if (!_sg('SEO')->eTitle()) sg_the_meta_title();
		if (sg_get_tpl() == 'post|default' OR sg_get_tpl() == 'portfolio|default') {
			$pt = array();
			$term = (sg_get_tpl() == 'post|default') ? 'post_tag' : 'portfolio_tag';
			$tags = get_the_terms(NULL, $term);
			if (empty($tags)) $tags = array();

			foreach ($tags as $id => $tag) {
				$pt[] = $tag->name;
			}

			_sg('SEO')->setPostTags($pt);
		}
		_sg('SEO')->eMeta();
	} else {
		sg_the_meta_title();
	}
}