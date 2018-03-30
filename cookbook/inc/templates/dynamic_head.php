	<!-- NATIVE HEADER STUFF -->

	<?php $canon_options = get_option('canon_options'); ?>
	<?php $canon_options_frame = get_option('canon_options_frame'); ?>
	<?php $canon_options_appearance = get_option('canon_options_appearance'); ?>

		<?php if ($canon_options['hide_theme_meta_description'] != 'checked') { printf("<meta name='description' content='%s'>", esc_attr(get_bloginfo('description'))); } ?>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- FAVICON -->

		<link rel="shortcut icon" href="<?php if (empty($canon_options['favicon_url'])) {echo get_template_directory_uri() . "/img/favicon.ico";} else {echo esc_url($canon_options['favicon_url']);} ?>" />

		
	<!-- USER FONTS -->

		<?php if (isset($canon_options_appearance['font_main'][0])) { if ($canon_options_appearance['font_main'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_main']); } ?>
		<?php if (isset($canon_options_appearance['font_headings'][0])) { if ($canon_options_appearance['font_headings'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_headings']); } ?>
		<?php if (isset($canon_options_appearance['font_nav'][0])) { if ($canon_options_appearance['font_nav'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_nav']); } ?>
		<?php if (isset($canon_options_appearance['font_headings_meta'][0])) { if ($canon_options_appearance['font_headings_meta'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_headings_meta']); } ?>
		<?php if (isset($canon_options_appearance['font_bold'][0])) { if ($canon_options_appearance['font_bold'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_bold']); } ?>
		<?php if (isset($canon_options_appearance['font_italic'][0])) { if ($canon_options_appearance['font_italic'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_italic']); } ?>
		<?php if (isset($canon_options_appearance['font_strong'][0])) { if ($canon_options_appearance['font_strong'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_strong']); } ?>
		<?php if (isset($canon_options_appearance['font_logo'][0])) { if ($canon_options_appearance['font_logo'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_logo']); } ?>

	<!-- OPEN GRAPH -->

		<?php 

			if ($canon_options['hide_theme_og'] != "checked" && $post) {

				printf('<meta property="og:type" content="article" />');
				printf('<meta property="og:url" content="http://%s"/>', $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
				printf('<meta property="og:site_name" content="%s" />', esc_attr(get_bloginfo('name')));

				$og_title = (mb_get_page_type() == 'single') ? $post->post_title : get_bloginfo('name');
				printf('<meta property="og:title" content="%s" />', esc_attr($og_title));

				$og_description = (!empty($post->post_content)) ? mb_make_excerpt($post->post_content, 350, true) : get_bloginfo('description');
				printf('<meta property="og:description" content="%s" />', esc_attr($og_description));

				if (empty($canon_options_frame['logo_url'])) { $canon_options_frame['logo_url'] = get_template_directory_uri() . "/img/logo@2x.png"; }
				$og_img_src = (wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')) ? wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full') : array($canon_options_frame['logo_url']);
				printf('<meta property="og:image" content="%s" />', esc_url($og_img_src[0]));

			}

		?>