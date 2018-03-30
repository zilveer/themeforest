<?php

/*	Locate Template
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_locate_template') ) {

	function mad_locate_template( $template_name, $template_path = '', $default_path = ''  ) {
		if ( ! $template_path ) {
			$template_path = apply_filters( 'mad_template_path', 'templates/' );
		}

		if ( ! $default_path ) {
			$default_path = MAD_INCLUDES_PATH . 'templates/';
		}

		// Look within passed path within the theme - this is priority.
		$template = locate_template(
			array(
				trailingslashit( $template_path ) . $template_name,
				$template_name
			)
		);

		// Get default template/
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		// Return what we found.
		return apply_filters( 'mad_locate_template', $template, $template_name, $template_path );
	}
}

/*	Get Template
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_get_template') ) {

	function mad_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

		$located = mad_locate_template( $template_name, $template_path, $default_path );

		if (empty( $located )) { return; }

		if ($args && is_array( $args )) { extract ( $args ); }

		include( $located );
	}
}

/*	Post Content
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_post_content_truncate')) {

	function mad_post_content_truncate($string, $limit, $break = ".", $pad = "...") {
		if (strlen($string) <= $limit) { return $string; }

		if (false !== ($breakpoint = strpos($string, $break, $limit))) {
			if ($breakpoint < strlen($string) - 1) {
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}
		if (!$breakpoint && strlen(strip_tags($string)) == strlen($string)) {
			$string = substr($string, 0, $limit) . $pad;
		}
		return $string;
	}
}

/*	Blog Post Meta
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_blog_post_meta') ) {

	function mad_blog_post_meta($id = 0, $entry = array()) {
		$comments_count = get_comments_number($id);

		if (!empty($entry)) {
			$comments_count = $entry->comment_count;
		}

		$link = get_permalink($id);

		ob_start(); ?>

		<div class="post-meta">

			<?php if (is_single()): ?>

				<?php if (mad_custom_get_option('blog-single-meta-date')): ?>
					<div><?php echo get_the_time(get_option('date_format'), $id); ?></div>
				<?php endif; ?>

				<?php if (mad_custom_get_option('blog-single-meta-comment')): ?>
					<?php if ($comments_count != "0" || comments_open($id)): ?>
						<?php
							$link_to = $comments_count === "0" ? "#respond" : "#comments";
							$text = $comments_count === "1" ? __('Comment', 'flatastic') : __('Comments', 'flatastic');
						?>
						<a href="<?php echo esc_url($link . $link_to); ?>">
							<?php echo esc_html($comments_count); ?> <?php echo esc_html($text); ?>
						</a>, <?php _e('on', 'flatastic') ?>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (mad_custom_get_option('blog-single-meta-category')): ?>
					<?php echo get_the_category_list(", ", '', $id) . ','; ?>
				<?php endif; ?>

				<?php if (mad_custom_get_option('blog-single-meta-author')): ?>
					<?php _e('by', 'flatastic') ?> <?php echo the_author_posts_link(); ?>
				<?php endif; ?>

			<?php else: ?>

				<?php if (mad_custom_get_option('blog-listing-meta-date')): ?>
					<span class="entry-date"><?php echo get_the_time(get_option('date_format'), $id); ?></span>
				<?php endif; ?>

				<?php if (mad_custom_get_option('blog-listing-meta-comment')): ?>
					<?php if ($comments_count != "0" || comments_open($id)): ?>
						<?php
						$link_to = $comments_count === "0" ? "#respond" : "#comments";
						$text = $comments_count === "1" ? __('Comment', 'flatastic') : __('Comments', 'flatastic');
						?>
						<a href="<?php echo esc_url($link . $link_to) ?>">
							<?php echo esc_html($comments_count) ?> <?php echo esc_html($text) ?>,
						</a> <?php _e('on', 'flatastic') ?>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (mad_custom_get_option('blog-listing-meta-category')): ?>
					<?php echo get_the_category_list(", ", '', $id) . ','; ?>
				<?php endif; ?>

				<?php if (mad_custom_get_option('blog-listing-meta-author')): ?>
					<?php _e('by', 'flatastic') ?>	<?php echo the_author_posts_link(); ?>
				<?php endif; ?>

			<?php endif; ?>

		</div><!--/ .post-meta-->

		<?php return ob_get_clean();
	}
}

/* 	Regex
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_regex')) {

	/*
	*	Regex for url: http://mathiasbynens.be/demo/url-regex
	*/
	function mad_regex($string, $pattern = false, $start = "^", $end = "") {
		if (!$pattern) return false;

		if ($pattern == "url") {
			$pattern = "!$start((https?|ftp)://(-\.)?([^\s/?\.#-]+\.?)+(/[^\s]*)?)$end!";
		} else if ($pattern == "mail") {
			$pattern = "!$start\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$end!";
		} else if ($pattern == "image") {
			$pattern = "!$start(https?(?://([^/?#]*))?([^?#]*?\.(?:jpg|gif|png)))$end!";
		} else if ($pattern == "mp4") {
			$pattern = "!$start(https?(?://([^/?#]*))?([^?#]*?\.(?:mp4)))$end!";
		} else if (strpos($pattern,"<") === 0) {
			$pattern = str_replace('<',"",$pattern);
			$pattern = str_replace('>',"",$pattern);

			if (strpos($pattern,"/") !== 0) { $close = "\/>"; $pattern = str_replace('/',"",$pattern); }
			$pattern = trim($pattern);
			if (!isset($close)) $close = "<\/".$pattern.">";

			$pattern = "!$start\<$pattern.+?$close!";
		}

		preg_match($pattern, $string, $result);

		if (empty($result[0])) {
			return false;
		} else {
			return $result;
		}
	}
}

/*	Tag Archive Page
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_tag_archive_page')) {

	function mad_tag_archive_page($query) {
		$post_types = get_post_types();

		if (is_category() || is_tag()) {
			if (!is_admin() && $query->is_main_query()) {

				$post_type = get_query_var(get_post_type());

				if ($post_type) {
					$post_type = $post_type;
				} else {
					$post_type = $post_types;
				}
				$query->set('post_type', $post_type);
			}
		}
		return $query;
	}
	add_filter('pre_get_posts', 'mad_tag_archive_page');
}

/*	Add Thumbnail Size
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_add_thumbnail_size')) {

	function mad_add_thumbnail_size($themeImgSizes) {
		if (function_exists('add_theme_support')) {
			foreach ($themeImgSizes as $size_name => $size) {
				if (!isset($themeImgSizes[$size_name]['crop'])) {
					$themeImgSizes[$size_name]['crop'] = true;
				}
				add_image_size($size_name,
					$themeImgSizes[$size_name]['width'],
					$themeImgSizes[$size_name]['height'],
					$themeImgSizes[$size_name]['crop']
				);
			}
		}
	}
}

/* 	Filter Hook for Comments
/* --------------------------------------------------------------------- */

if ( !function_exists('mad_output_comments')) {

	function mad_output_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php echo comment_ID() ?>">

			<div class="comment-wrap clearfix">

				<div class="gravatar"><?php echo get_avatar($comment, 70); ?></div>

				<div class="comment-content-wrap">

					<div class="comment-title">

						<b><a href="#"><?php echo get_comment_author_link() ?></a></b> - <?php comment_date('Y-m-d H:i') ?>

						<?php echo get_comment_reply_link(array_merge(
							array('reply_text' => __('Quote', 'flatastic')),
							array('depth' => $depth, 'max_depth' => $args['max_depth'])
						));
						?>

					</div><!--/ .comment-title-->

					<div class="comment"><?php comment_text(); ?></div>

				</div><!--/ .comment-content-wrap-->

			</div><!--/ .comment-wrap-->

		</li>

	<?php
	}
}

/* 	Filter Hooks for Respond
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_comments_form_hook')) {

	function mad_comments_form_hook ($defaults) {
		$commenter = wp_get_current_commenter();

		$req = get_option('require_name_email');
		$mad_req = ($req ? " (required)" : '');
		$mad_reg_email = ($req ? " (required, but will not display)" : '');

		$defaults['fields']['author'] = '
		<p class="comment-form-author"> '.
			'<label for="author">' . __( 'Name', 'flatastic' ) . ( $req ? $mad_req : '' ) . '</label> '.
			'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $mad_req . ' placeholder="Name *" />'.
			'</p>';

		$defaults['fields']['email'] = '
		<p class="comment-form-email"> '.
			'<label for="email">' . __( 'Email', 'flatastic' ) . ( $req ? $mad_reg_email : '' ) . '</label> '.
			'<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $mad_req . ' placeholder="Email *" />'.
			'</p>';

		$defaults['comment_notes_before'] = '';
		$defaults['comment_notes_after'] = '';

		$defaults['cancel_reply_link'] = ' - ' . __('Cancel quote', 'flatastic');
		$defaults['label_submit'] = __('Submit', 'flatastic');

		return $defaults;
	}
	add_filter('comment_form_defaults', 'mad_comments_form_hook');
}

/*	Analytics Tracking Code
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_get_tracking_code') ) {

	function mad_get_tracking_code() {
		global $mad_config;

		$mad_config['analytics_code'] = mad_custom_get_option('analytics');
		if (empty($mad_config['analytics_code'])) return;

		if (strpos($mad_config['analytics_code'],'UA-') === 0) {
			$mad_config['analytics_code'] = "
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', '". $mad_config['analytics_code'] ."', 'auto');
				ga('send', 'pageview');
			</script>";
		}
		add_action('wp_head', 'mad_print_tracking_code');
	}

	add_action('init', 'mad_get_tracking_code');

	function mad_print_tracking_code() {
		global $mad_config;
		if (!empty($mad_config['analytics_code'])) {
			echo $mad_config['analytics_code'];
		}
	}

}

/*	Gallery Shortcode
/* ---------------------------------------------------------------------- */

if ( !function_exists('mad_gallery_shortcode') ) {

	function mad_gallery_shortcode($atts) {
		$output = $jackbox = $ids = $post_id = $image_size = '';
		$zoom_image = mad_custom_get_option('zoom_image', '');

		extract(shortcode_atts(array(
			'ids'     => '',
			'width'   => '',
			'height'  => '',
			'image_size' => '',
			'post_id' => ''
		), $atts));

		$attachments = get_posts(array(
			'include' => $ids,
			'orderby' => 'post__in',
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image'
		));

		if (!empty($attachments) && is_array($attachments)) {
			$output .= "<div class='post-slider entry-media image-overlay'>";
			foreach ($attachments as $attachment) {
				if (is_single()) {
					$permalink = MAD_HELPER::get_post_attachment_image($attachment->ID, '');
					$jackbox = 'jackbox';
				} else {
					$permalink = get_permalink($post_id);
				}
				$output .= "<div class='item'>";
					$output .= '<a data-group="entry-'. esc_attr($post_id) .'" class="single-image '. esc_attr($jackbox) .' ' . esc_attr($zoom_image) . '" href="'. esc_url($permalink) .'">';
						$output .= MAD_HELPER::get_the_thumbnail($attachment->ID, $image_size, array( 'class' => 'tr_all_long_hover') );
					$output .= '</a>';
				$output .= "</div>";
			}
			$output .= "</div>";
			return $output;
		}
	}
	add_shortcode('mad_gallery', 'mad_gallery_shortcode');
}

/*	Post ID
/* ---------------------------------------------------------------------- */

if (!function_exists( 'mad_post_id' )) {

	function mad_post_id() {
		global $post, $mad_config;
		$post_id = 0;
		if (isset( $post->ID )) {
			$post_id = $post->ID;
			$mad_config['post_id'] = $post_id;
		} else {
			return get_the_ID();
		}
		return $post_id;
	}
}

/*	Body Background
/* ---------------------------------------------------------------------- */

if (!function_exists( 'mad_body_background' )) {

	function mad_body_background() {
		$post_id = mad_post_id();

		$color = rwmb_meta('mad_bg_color', '', $post_id);
		$image = rwmb_meta('mad_bg_image', '', $post_id);

		if (!empty($image) && $image > 0) {
			$image = wp_get_attachment_image_src($image, '');
			if (is_array($image) && isset($image[0])) {
				$image = $image[0];
			}
		}

		$image_repeat     = rwmb_meta('mad_bg_image_repeat', '', $post_id);
		$image_position   = rwmb_meta('mad_bg_image_position', '', $post_id);
		$image_attachment = rwmb_meta('mad_bg_image_attachment', '', $post_id);

		$css = array();

		if (!empty( $image ) && !empty( $image_attachment )) { $css[] = "background-attachment: $image_attachment;"; }
		if (!empty( $image ) && !empty( $image_position ))   { $css[] = "background-position: $image_position;"; }
		if (!empty( $image ) && !empty( $image_repeat ))     { $css[] = "background-repeat: $image_repeat;"; }

		if (!empty( $color ))                     			 { $css[] = "background-color: $color;"; }
		if (!empty( $image ) && $image != 'none') 			 { $css[] = "background-image: url('$image');"; }

		if (empty( $css )) return;
		?>
		<style type="text/css">body { <?php echo implode( ' ', $css ) ?> } </style>

	<?php
	}

	add_filter('wp_head', 'mad_body_background');
}

/*	Title
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_title')) {
	function mad_title($args = false, $id = false) {

		if (!$id) $id = mad_post_id();

		$defaults = array(
			'title' 	  => get_the_title($id),
			'subtitle'    => "",
			'output_html' => "<div class='extra-heading {class}'><{heading} class='extra-title'>{title}</{heading}>{additions}</div>",
			'class'		  => '',
			'heading'	  => 'h2',
			'additions'	  => ""
		);

		$args = wp_parse_args($args, $defaults);
		extract($args, EXTR_SKIP);

		if (!empty($subtitle)) {
			$class .= ' with-subtitle';
			$additions .= "<div class='title-meta'>" . do_shortcode(wpautop($subtitle)) . "</div>";
		}

		$output_html = str_replace('{class}', $class, $output_html);
		$output_html = str_replace('{heading}', $heading, $output_html);
		$output_html = str_replace('{title}', $title, $output_html);
		$output_html = str_replace('{additions}', $additions, $output_html);
		return $output_html;
	}
}

/*	Which Archive
/* ---------------------------------------------------------------------- */

if (!function_exists('mad_which_archive')) {

	function mad_which_archive() {

		ob_start(); ?>

		<?php if (is_category()): ?>

			<?php echo __('Archive for category', 'flatastic') . " " . single_cat_title('', false); ?>

		<?php elseif (is_day()): ?>

			<?php echo __('Archive for date', 'flatastic') . " " . get_the_time( __('F jS, Y', 'flatastic')); ?>

		<?php elseif (is_month()): ?>

			<?php echo __('Archive for month', 'flatastic') . " " . get_the_time( __('F, Y', 'flatastic')); ?>

		<?php elseif (is_year()): ?>

			<?php echo __('Archive for year', 'flatastic') . " " . get_the_time( __('Y', 'flatastic')); ?>

		<?php elseif (is_search()): global $wp_query; ?>

			<?php if (!empty($wp_query->found_posts)): ?>

				<?php if ($wp_query->found_posts > 1): ?>

					<?php echo __('Search results for:', 'flatastic')." " . esc_attr(get_search_query()) . " (". $wp_query->found_posts .")"; ?>

				<?php else: ?>

					<?php echo __('Search result for:', 'flatastic')." " . esc_attr(get_search_query()) . " (". $wp_query->found_posts .")"; ?>

				<?php endif; ?>

			<?php else: ?>

				<?php if (!empty($_GET['s'])): ?>

					<?php echo __('Search results for:', 'flatastic') . " " . esc_attr(get_search_query()); ?>

				<?php else: ?>

					<?php echo __('To search the site please enter a valid term', 'flatastic'); ?>

				<?php endif; ?>

			<?php endif; ?>

		<?php elseif (is_author()): ?>

			<?php $auth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author')); ?>

			<?php if (isset($auth->nickname) && isset($auth->ID)): ?>

				<?php $name = $auth->nickname; ?>

				<?php echo __('Author Archive', 'flatastic'); ?>
				<?php echo __('for:', 'flatastic') . " " . $name; ?>

			<?php endif; ?>

		<?php elseif (is_tag()): ?>

			<?php echo __('Tag archive for', 'flatastic') . " " . single_tag_title('', false); ?>

			<?php
				$term_description = term_description();
				if ( ! empty( $term_description ) ) {
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				}
			?>

		<?php elseif (is_tax()): ?>

			<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>

			<?php if (mad_is_product_tag()): ?>
				<?php echo __('Products by', 'flatastic') . ' "' . $term->name . '" tag'; ?>
			<?php elseif(mad_is_product_category()): ?>
				<?php echo __('Archive for category', 'flatastic') . " " . single_cat_title('', false); ?>
			<?php else: ?>
				<?php echo __('Archive for', 'flatastic') . " " . $term->name; ?>
			<?php endif; ?>

		<?php else: ?>

			<?php if (is_post_type_archive( 'product' )): ?>
				<?php echo __('Product Archive', 'flatastic'); ?>
			<?php elseif(is_post_type_archive()): ?>
				<?php $post_type = get_post_type_object( get_post_type() ); ?>
				<?php echo __('Archive', 'flatastic') . ' ' . strtolower($post_type->label); ?>
			<?php else: ?>
				<?php echo __('Archive', 'flatastic'); ?>
			<?php endif; ?>

		<?php endif; ?>

		<?php return ob_get_clean();
	}
}


/*	Search Form
/* ---------------------------------------------------------------------- */

if (!function_exists('flatastic_search_form')) {

	function flatastic_search_form() {

		MAD_BASE_FUNCTIONS::enqueue_script('chosen-drop-down');
		MAD_BASE_FUNCTIONS::enqueue_style('chosen-drop-down');

		ob_start();

		$search_type = mad_custom_get_option('search-type', 'product');

		if (isset($search_type) && $search_type === 'product' && defined('YITH_WCAS' )) {
			echo do_shortcode('[yith_woocommerce_ajax_search]');
			return;
		}

		?>

		<form action="<?php echo home_url('/'); ?>" method="get" class="clearfix search_form">

			<input type="search"
				   value="<?php echo get_search_query() ?>"
				   name="s" id="s" autocomplete="off"
				   class="alignleft"
				   placeholder="<?php echo esc_html__('Search&hellip;', 'flatastic'); ?>" />

			<?php if (isset($search_type) && ($search_type === 'post')) : ?>

				<div class="search_category alignleft">

					<?php
					$args = array(
						'show_option_all' => esc_html__( 'All Categories', 'flatastic' ),
						'hierarchical' => 1,
						'class' => 'cat',
						'echo' => 0,
						'value_field' => 'slug',
						'selected' => 1
					);

					if ($search_type === 'product' && class_exists('WooCommerce')) {
						$args['taxonomy'] = 'product_cat';
						$args['name'] = 'product_cat';
					}

					$html =	wp_dropdown_categories($args);
					echo str_replace( '&nbsp;', '', $html );
					?>

				</div><!--/ .search_category-->

			<?php endif; ?>

			<button type="submit" class="button_blue def_icon_btn alignleft"></button>
			<input type="hidden" name="post_type" value="<?php echo esc_attr($search_type) ?>" />

		</form>

		<?php return ob_get_clean();
	}
}