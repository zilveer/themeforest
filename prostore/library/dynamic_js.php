<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/dynamic_js.php
 * @file	 	1.0
 */
?>
<?php

	add_action('custom_head_scripts', 'custom_theme_scripts',5);

	if ( ! function_exists( 'custom_theme_scripts' ) ) {
		function custom_theme_scripts() {
			global $data, $prefix;
		?>

		<?php
			$shopbase = array("one"=>"1","two"=>"2","three"=>"3","four"=>"4","five"=>"5","six"=>"6");
			$shopgrid = $data[$prefix."woocommerce_layout_itemrow"];
			foreach($shopgrid as $key => $value) {
				if($value == "") $shopgrid[$key] = $shopbase[$key];
			}
			$shopgrid = array_values($shopgrid);

			$blogbase = array("one"=>"1","two"=>"2","three"=>"3","four"=>"4","five"=>"5","six"=>"6");
			$bloggrid = $data[$prefix."default_masonry_itemrow"];
			foreach($bloggrid as $key => $value) {
				if($value == "") $bloggrid[$key] = $blogbase[$key];
			}
			$bloggrid = array_values($bloggrid);

			$portfoliobase = array("one"=>"1","two"=>"2","three"=>"3","four"=>"4","five"=>"5","six"=>"6");
			$portfoliogrid = $data[$prefix."default_portf_masonry_itemrow"];
			foreach($portfoliogrid as $key => $value) {
				if($value == "") $portfoliogrid[$key] = $portfoliobase[$key];
			}
			$portfoliogrid = array_values($portfoliogrid);
		?>
		<script type="text/javascript">
			/* <![CDATA[ */
			var themejs_a = new Array();
				themejs_a['templateUrl'] = "<?php echo get_template_directory_uri(); ?>";
				themejs_a['preload'] = "<?php echo ($data[$prefix.'optimize_preload']!='1' ? 'true' : 'false'); ?>";
				themejs_a['idle'] = "<?php echo ($data[$prefix.'optimize_idle']!='1' ? 'true' : 'false'); ?>";
				themejs_a['autosize'] = "<?php echo ($data[$prefix.'optimize_autosize']!='1' ? 'true' : 'false'); ?>";
				themejs_a['md5'] = "<?php echo ($data[$prefix.'optimize_md5']!='1' ? 'true' : 'false'); ?>";
				themejs_a['fittext'] = "<?php echo ($data[$prefix.'optimize_fittext']!='1' ? 'true' : 'false'); ?>";
				themejs_a['gmap'] = "<?php echo ($data[$prefix.'optimize_gmap']!='1' ? 'true' : 'false'); ?>";
				themejs_a['zoom'] = "<?php echo ($data[$prefix.'optimize_zoom']!='1' ? 'true' : 'false'); ?>";
				themejs_a['magellan'] = "<?php echo ($data[$prefix.'optimize_fmagellan']!='1' ? 'true' : 'false'); ?>";
				themejs_a['tooltip'] = "<?php echo ($data[$prefix.'optimize_ftooltip']!='1' ? 'true' : 'false'); ?>";
				themejs_a['SsidebarT'] = "<?php echo ($data[$prefix.'woocommerce_layout_sidebar_toggle']=='1' ? 'true' : 'false'); ?>";
				themejs_a['shopgrid'] = new Array( <?php for ($i=0;$i<=5;$i++) {echo '"'.$shopgrid[$i].'"';
				if($i<5) echo ','; } ?> );
				themejs_a['bloggrid'] = new Array( <?php for ($i=0;$i<=5;$i++) {echo '"'.$bloggrid[$i].'"';
				if($i<5) echo ','; } ?> );
				themejs_a['portfoliogrid'] = new Array( <?php for ($i=0;$i<=5;$i++) {echo '"'.$portfoliogrid[$i].'"';
				if($i<5) echo ','; } ?> );
				themejs_a['shopoverlay'] = <?php echo (($data[$prefix.'woocommerce_product_overlay']=='1' || $data[$prefix.'woocommerce_responsive_overlay']=='1') ? 'true' : 'false'); ?>;
				themejs_a['shopSWT'] = "<?php echo ($data[$prefix."woocommerce_layout_sidebar_widgets_toggle"]=='1' ? 'true' : 'false'); ?>";
				themejs_a['themeSWT'] = "<?php echo ($data[$prefix."responsive_widget_toggle"]=='1' ? 'true' : 'false'); ?>";
			/* ]] */
		</script>

		<?php
			if($data[$prefix.'optimize_gmap']!="1" && is_page_template('template-contact.php')) {
		?>
				<script type="text/javascript">
			/* <![CDATA[ */
					var script = '<script type="text/javascript" src="http://google-maps-' +
			          'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
			      	if (document.location.search.indexOf('compiled') !== -1) {
			        	script += '-compiled';
			      	}
			      	script += '.js"><' + '/script>';
			      	document.write(script);

			      	var sites = [
			      		<?php
			      			$i=1;
			      			while ($i<=5) {
			      				if(!isset($data[$prefix.'contact_gmap'.$i.'_lon'])) $data[$prefix.'contact_gmap'.$i.'_lon'] = '';
			      				if(!isset($data[$prefix.'contact_gmap'.$i.'_lat'])) $data[$prefix.'contact_gmap'.$i.'_lat'] = '';
			      				if(!isset($data[$prefix.'contact_gmap'.$i.'_text'])) $data[$prefix.'contact_gmap'.$i.'_text'] = '';
			      				$lon = $data[$prefix.'contact_gmap'.$i.'_lon'];
			      				$lat = $data[$prefix.'contact_gmap'.$i.'_lat'];
			      				$text = $data[$prefix.'contact_gmap'.$i.'_text'];

			      				if($lon!="" && $lat!="") {
			      					if($i>1) {
			      						echo ',';
			      					}
			      					echo "['', ".$lat.", ".$lon.", ".$i.", '<div class=phoneytext>".$text."</div>']";
			      				}
				      			$i++;
			      			}
			      		?>
					];
					var gmapPin = '<?php echo get_stylesheet_directory_uri() . '/img/map_pins/'; ?>pin_<?php echo $data[$prefix."map_pin"]; ?>.png';
					var gmapCenterLat = '<?php echo $data[$prefix."contact_gmapc_lat"]; ?>';
					var gmapCenterLon = '<?php echo $data[$prefix."contact_gmapc_lon"]; ?>';
					var gmapZoom = <?php echo $data[$prefix."contact_gmap_zoom"]; ?>;
				/* ]] */
				</script>
		<?php
			}

		}

	}

	add_action('custom_foot', 'custom_theme_scripts_add',10);

	if ( ! function_exists( 'custom_theme_scripts_add' ) ) {
		function custom_theme_scripts_add() {
			global $data, $prefix;

			if($data[$prefix.'home_slider']=="1" && (is_home() || is_front_page())) {
		?>
				<script type="text/javascript">
				/* Homepage main slider */
				/* <![CDATA[ */
					jQuery(window).load(function() {
						jQuery('#home_slider').imagesLoaded(function(){
							jQuery("#home_slider").fitVids().flexslider({
								animation: '<?php if($data[$prefix.'home_slider_settings_2']!="swing") { echo "slide"; } else { echo ($data[$prefix.'home_slider_settings_1']!='' ? $data[$prefix.'home_slider_settings_1'] : 'slide'); } ?>',
								easing : '<?php echo ($data[$prefix.'home_slider_settings_2']!='' ? $data[$prefix.'home_slider_settings_2'] : 'swing'); ?>',
								direction : '<?php echo ($data[$prefix.'home_slider_settings_3']!='' ? $data[$prefix.'home_slider_settings_3'] : 'horizontal'); ?>',
								animationLoop : <?php echo ($data[$prefix.'home_slider_settings_18']=='1' ? 'true' : 'false'); ?>,
								smoothHeight : <?php echo ($data[$prefix.'home_slider_settings_4']=='1' ? 'true' : 'false'); ?>,
								startAt : <?php echo ($data[$prefix.'home_slider_settings_5']!='' ? $data[$prefix.'home_slider_settings_5'] : 0); ?>,
								slideshow : <?php echo ($data[$prefix.'home_slider_settings_6']=='1' ? 'true' : 'false'); ?>,
								slideshowSpeed : <?php echo ($data[$prefix.'home_slider_settings_7']!='' ? $data[$prefix.'home_slider_settings_7'] : 7000); ?>,
								animationSpeed : <?php echo ($data[$prefix.'home_slider_settings_8']!='' ? $data[$prefix.'home_slider_settings_8'] : 600); ?>,
								initDelay : <?php echo ($data[$prefix.'home_slider_settings_9']!='' ? $data[$prefix.'home_slider_settings_9'] : 0); ?>,
								randomize : <?php echo ($data[$prefix.'home_slider_settings_10']=='1' ? 'true' : 'false'); ?>,

								pauseOnAction : true,
								pauseOnHover : <?php echo ($data[$prefix.'home_slider_settings_11']=='1' ? 'true' : 'false'); ?>,
								useCSS : false,
								video : true,

								directional : <?php echo ($data[$prefix.'home_slider_settings_12']=='1' ? 'true' : 'false'); ?>,
								controlNav : <?php echo ($data[$prefix.'home_slider_settings_13']=='1' ? 'true' : 'false'); ?>,
								pausePlay : <?php echo ($data[$prefix.'home_slider_settings_14']=='1' ? 'true' : 'false'); ?>,

								touch : <?php echo ($data[$prefix.'home_slider_settings_15']=='1' ? 'true' : 'false'); ?>,
								mousewheel : <?php echo ($data[$prefix.'home_slider_settings_16']=='1' ? 'true' : 'false'); ?>,
								keyboard : <?php echo ($data[$prefix.'home_slider_settings_17']=='1' ? 'true' : 'false'); ?>,

								pauseText : '<em class="icon-pause"></em>',
								playText : '<em class="icon-play"></em>',

				                before: function(slider){
				                	jQuery('iframe.vimeo').each(function(){
				                		var temp = jQuery(this).attr('id');
				                		var player = document.getElementById(temp);
					                    Froogaloop(player).api('pause');
				                	});
				                }
							});
						});
					});
				/* ]] */
				</script>
		<?php
			}

		}

	}