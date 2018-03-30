<!-- OPTIONS CALL HERE TO USE IN REST OF DOCUMENT -->
	<?php 
		$inspire_options = get_option('inspire_options');
		$inspire_options_appearance = get_option('inspire_options_appearance');

		$og_img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

	 ?>

<!-- NATIVE HEADER STUFF -->

	<link rel="shortcut icon" href="<?php if (empty($inspire_options['favicon_url'])) {echo get_template_directory_uri() . "/images/default_favicon.ico";} else {echo $inspire_options['favicon_url'];} ?>" />

<!-- OPEN GRAPH -->

	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>"/>
	<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />

	<?php 
		if (mb_get_page_type() == 'single') {
		?>
			<meta property="og:title" content="<?php echo $post->post_title; ?>" />
		<?php	
		} else {
		?>
			<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
		<?php		
		}
	?>

	<?php 
		if (!empty($post->post_content)) {
		?>
			<meta property="og:description" content="<?php echo mb_make_excerpt($post->post_content, 350, true); ?>"/>
		<?php	
		} else {
		?>
			<meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" />
		<?php		
		}
	?>

	<?php 
		if (!empty($og_img_src)) {
		?>
			<meta property="og:image" content="<?php echo $og_img_src[0]; ?>" />
		<?php	
		} else {
		?>
			<meta property="og:image" content="<?php if (isset($inspire_options['logo_url'])) echo $inspire_options['logo_url']; ?>" />
		<?php		
		}
	?>

<!-- USER FONTS -->

	<?php if ($inspire_options_appearance['font_main'][0] != "inspire_default") echo mb_get_google_webfonts_link($inspire_options_appearance['font_main']); ?>
	<?php if ($inspire_options_appearance['font_secondary'][0] != "inspire_default") echo mb_get_google_webfonts_link($inspire_options_appearance['font_secondary']); ?>

<!-- DYNAMIC CSS -->

<style type="text/css">

	/* BACKGROUND */
	
	body {
		background:<?php echo $inspire_options_appearance['color_bg'] ?> <?php if (isset($inspire_options_appearance['bg_url'])) echo "url(". $inspire_options_appearance['bg_url'] .")"; ?> fixed;
	}
	
	/* FONTS */
		
		body, .widget .widget-item h3 a {
			font-family:"Droid Sans";
			<?php if ($inspire_options_appearance['font_main'][0] != 'inspire_default') echo 'font-family: "' . $inspire_options_appearance['font_main'][0] . '";'; ?>
		}
		
		h1,h2,h3,h4,h5,h6 { 
			font-family:"Francois One";
			<?php if ($inspire_options_appearance['font_secondary'][0] != 'inspire_default') echo 'font-family: "' . $inspire_options_appearance['font_secondary'][0] . '";'; ?>
		}
		
	/* HEADER HEIGHT */
		
		#header { 
			height:<?php echo $inspire_options['header_height']; ?>px;
		}
		
	/* MAIN COLOR */
		
		#header .menu li.current-menu-item  a, #header .menu li.current_page_item  a, #header .menu li a:hover {
			border-bottom: 3px solid <?php echo $inspire_options_appearance['color_main']; ?>; 
		}
		
		a:hover, #header .menu li ul li a:hover, .item:hover > div > h2 > a, .item .item-descrip h2 a:hover, .widget .widget-item:hover > h3 > a, .post .post-entry .tags a:hover, .post .post-entry a, #wp-calendar tbody td a {
			color: <?php echo $inspire_options_appearance['color_main']; ?>; 
		}
		
		.item.archive .item-descrip a.readmore:hover, .flexslider ul.slides li .slider-text a h1 { 
			background: <?php echo $inspire_options_appearance['color_main']; ?>; 
		}
		
	/* GRAYSCALE */

		<?php
			if ($inspire_options_appearance['grayscale'] == "grayscale") {
			?>

				.item .item-thumb a img, .item .item-thumb img, .comment .avatar img, .widget .widget-item img, .widget img.widget-img, #footer_hidden img, .widget .grid_view img, .flexslider ul.slides li img {
					filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 3.5+, IE10 */
					filter: gray; /* IE6-9 */
					-webkit-filter: grayscale(100%); /* Google Chrome & Webkit Nightlies */
					-o-transition:.4s;
					-ms-transition:.4s;
					-moz-transition:.4s;
					-webkit-transition:.4s;
					transition:.4s; 
					
				}
				
				.item:hover > .item-thumb > a img, .item:hover > .item-thumb img, .comment:hover > .avatar > img, .widget .widget-item:hover > a > img, .widget img.widget-img:hover, #footer_hidden img:hover, .widget .grid_view img:hover, .flexslider ul.slides li:hover > a > img, .flexslider.flexslider_single ul.slides li a img {
					filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
					-webkit-filter: grayscale(0%);
					-o-transition:.4s;
					-ms-transition:.4s;
					-moz-transition:.4s;
					-webkit-transition:.4s;
					transition:.4s;
				}

			<?php		
			}
		?>
		
	/* GRAYSCALE REVERSE */
	
		<?php
			if ($inspire_options_appearance['grayscale'] == "grayscale_reverse") {
			?>

				.item .item-thumb a img, .item .item-thumb img, .comment .avatar img, .widget .widget-item img, .widget img.widget-img, #footer_hidden img, .widget .grid_view img, .flexslider ul.slides li a img {
					filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
					-webkit-filter: grayscale(0%);
					-o-transition:.4s;
					-ms-transition:.4s;
					-moz-transition:.4s;
					-webkit-transition:.4s;
					transition:.4s;
				}
						
				.item:hover > .item-thumb > a img, .item:hover > .item-thumb > img, .comment:hover > .avatar > img, .widget .widget-item:hover > a > img, .widget img.widget-img:hover, #footer_hidden img:hover, .widget .grid_view img:hover, .flexslider ul.slides li:hover > a > img {
					filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 3.5+, IE10 */
					filter: gray; /* IE6-9 */
					-webkit-filter: grayscale(100%); /* Google Chrome & Webkit Nightlies */
					-o-transition:.4s;
					-ms-transition:.4s;
					-moz-transition:.4s;
					-webkit-transition:.4s;
					transition:.4s; 		
				}
	
			<?php		
			}
		?>
	
	
		
	/* HEADER ELEMENTS*/

		#logo {
			top: <?php echo $inspire_options['pos_logo_top']; ?>px;
			left: <?php echo $inspire_options['pos_logo_left']; ?>px;
		}

		.menu {
			top: <?php echo $inspire_options['pos_nav_top']; ?>px;
			right: <?php echo $inspire_options['pos_nav_right']; ?>px;
		}

	/* BACKGROUND */

		<?php
			
			if (isset($inspire_options_appearance['bg_link'])) {
				if (!empty($inspire_options_appearance['bg_link'])) {
				?>
						
					body {
						cursor: pointer;
					}
					body div {
							cursor: auto;	
					}

				<?php	
				}
					
			}
		
		?>







	</style>

<!--[if IE]>
	<style type="text/css">
		.item a img {
			margin-bottom:-5px;
		}
	</style>
<![endif]-->