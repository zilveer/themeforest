<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

//if( ! yit_get_option('show-topbar') ) return;
?>  

<?php if( yit_get_option('topbar') ): ?>
<!-- START TOP BAR -->
<div id="topbar" <?php if( !yit_get_option('responsive-topbar') ) echo 'class="hidden-phone"' ?>>
	<div class="container">
		<div class="row">
			<div class="span12">
				<div id="topbar-left"><?php get_sidebar( 'topbarleft' ) ?></div>
				<div id="topbar-right"><?php get_sidebar( 'topbarright' ) ?></div>
			</div>
		</div>

		<div class="border"></div>
		<div class="border"></div>
		<div class="border"></div>
		<div class="border borderstrong"></div>
	</div>
</div>


<script>
jQuery(function($){
	var twitterSlider = function(){
		$('#topbar .last-tweets ul').addClass('slides');
		$('#topbar .last-tweets').flexslider({
			animation: "fade",
			slideshowSpeed: 5 * 1000,
			animationDuration: 700,
			directionNav: false,
			controlNav: false,
			keyboardNav: false
		});
	};
	$('#topbar .last-tweets > div').bind('tweetable_loaded', function(){
		twitterSlider();
	});
}); 
</script>

<!-- END TOP BAR -->
<?php endif ?>
