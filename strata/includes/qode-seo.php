<?php

if(!function_exists('qode_header_meta')) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function qode_header_meta() {
		global $qode_options_theme13;

		if(isset($qode_options_theme13['disable_qode_seo']) && $qode_options_theme13['disable_qode_seo'] == 'no') {

			$seo_description = get_post_meta(qode_get_page_id(), "qode_seo_description", true);
			$seo_keywords = get_post_meta(qode_get_page_id(), "qode_seo_keywords", true);
			?>

			<?php if($seo_description) { ?>
				<meta name="description" content="<?php echo $seo_description; ?>">
			<?php } else if($qode_options_theme13['meta_description']){ ?>
				<meta name="description" content="<?php echo $qode_options_theme13['meta_description'] ?>">
			<?php } ?>

			<?php if($seo_keywords) { ?>
				<meta name="keywords" content="<?php echo $seo_keywords; ?>">
			<?php } else if($qode_options_theme13['meta_keywords']){ ?>
				<meta name="keywords" content="<?php echo $qode_options_theme13['meta_keywords'] ?>">
			<?php }
		}

	}

	add_action('qode_header_meta', 'qode_header_meta');
}

if(!function_exists('qode_wp_title')) {
	/**
	 * Function that sets page's title. Hooks to wp_title filter
	 * @param $title string current page title
	 * @param $sep string title separator
	 * @return string changed title text if SEO plugins aren't installed
	 *
	 * @since 5.0
	 * @version 0.3
	 */
	function qode_wp_title($title, $sep) {
		global $qode_options_theme13;

		//is SEO plugin installed?
		if(qode_seo_plugin_installed()) {
			//don't do anything, seo plugin will take care of it
		} else {
			//get current post id
			$id = qode_get_page_id();

			$sep = ' | ';
			$title_prefix = get_bloginfo('name');
			$title_suffix = '';

			//set unchanged title variable so we can use it later
			$unchanged_title = $title;

			//is qode seo enabled?
			if(isset($qode_options_theme13['disable_qode_seo']) && $qode_options_theme13['disable_qode_seo'] !== 'yes') {
				//get current post seo title
				$seo_title = get_post_meta($id, "qode_seo_title", true);

				//is current post seo title set?
				if($seo_title !== '') {
					$title_suffix = $seo_title;
				}
			}

			//title suffix is empty, which means that it wasn't set by qode seo
			if(empty($title_suffix)) {
				//if current page is front page append site description, else take original title string
				$title_suffix = is_front_page() ? get_bloginfo('description') : $unchanged_title;
			}

			//concatenate title string
			$title  = $title_prefix.$sep.$title_suffix;

			//return generated title string
			return $title;
		}
	}

	add_filter('wp_title', 'qode_wp_title', 10, 2);
}

if(!function_exists('qode_ajax_meta')) {
	/**
	 * Function that echoes meta data for ajax
	 *
	 * @since 5.0
	 * @version 0.2
	 */
	function qode_ajax_meta() {
		global $qode_options_theme13;

		$seo_description = get_post_meta(qode_get_page_id(), "qode_seo_description", true);
		$seo_keywords = get_post_meta(qode_get_page_id(), "qode_seo_keywords", true);
		?>

		<div class="seo_title"><?php wp_title(''); ?></div>

		<?php if($seo_description !== ''){ ?>
			<div class="seo_description"><?php echo $seo_description; ?></div>
		<?php } else if($qode_options_theme13['meta_description']){?>
			<div class="seo_description"><?php echo $qode_options_theme13['meta_description']; ?></div>
		<?php } ?>
		<?php if($seo_keywords !== ''){ ?>
			<div class="seo_keywords"><?php echo $seo_keywords; ?></div>
		<?php }else if($qode_options_theme13['meta_keywords']){?>
			<div class="seo_keywords"><?php echo $qode_options_theme13['meta_keywords']; ?></div>
		<?php }
	}

	add_action('qode_ajax_meta', 'qode_ajax_meta');
}

if(!function_exists('qode_seo_plugin_installed')) {
	/**
	 * Function that checks if popular seo plugins are installed
	 * @return bool
	 */
	function qode_seo_plugin_installed() {
		//is YOAST installed?
		if(defined('WPSEO_VERSION')) {
			return true;
		}

		return false;
	}
}