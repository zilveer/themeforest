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

?>  

<?php if( yit_get_option('topbar') ): ?>
<!-- START TOP BAR -->
<div id="topbar">
	<div class="container">
		<div class="row">
			<?php get_sidebar( 'header' ) ?>
		</div>
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
<?php endif ?>

