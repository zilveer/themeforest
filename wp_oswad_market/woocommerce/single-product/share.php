<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php
	global $post,$smof_data;
?>
<?php do_action('woocommerce_share'); // Sharing plugins can hook into here ?>
<div class="social_sharing">
	<div class="social-des">
		<h6 class="title-social"><?php echo $_sharing_title = sprintf( __( '%s','wpdance' ), stripslashes(esc_attr($smof_data['wd_prod_share_title'])) ) ;?></h6>
		<!--<p class="content-social-des"><?php //echo stripslashes(htmlspecialchars_decode($single_prod_datas["sharing_intro"]));?></p>-->
	</div>
	
	<div class="social_icon">	
		<div>
			<a href="mailto:?subject=I%20wanted%20you%20to%20see%20this%20site&amp;body=Check%20out%20this%20site%20<?php echo site_url(); ?>" title="Share by Email">
				<img alt="mail" title="mail" src="http://demo.wpdance.com/imgs/wp_TechGoStore/mail.png"/>
			</a>
		</div>
		<!--<div>
			<a class="wd_print" href="javascript:window.print()" rel="nofollow">Print This!</a>
		</div>-->
		<div class="facebook">
			<!--<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="<?php //the_permalink();?>" data-send="false" data-layout="button" data-width="150" data-show-faces="true"></div>-->
			<a name="fb_share" class="fb-like" type="button" href="http://www.facebook.com/sharer.php">Share</a>
			<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>

		</div>			
			
		<!-- Place this render call where appropriate -->
		<script type="text/javascript">
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
		
		<div class="twitter">
			<a href="<?php echo "https://twitter.com/share"; ?>" class="twitter-share-button" data-count="none"></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
			
		<div class="gplus">				                
			<script  type="text/javascript"  src="https://apis.google.com/js/plusone.js"></script>
			<g:plusone size="medium"></g:plusone>
		</div>
		
		<?php 
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id,'full', true);
		?>
		<div>
			<a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $image_url[0];?>&amp;" data-pin-do="buttonPin" data-pin-config="none">
				<img alt="pinterest" src="//assets.pinterest.com/images/pidgets/pin_it_button.png" />
			</a>
			<script type="text/javascript">
				(function(d){
				  var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
				  p.type = 'text/javascript';
				  p.async = true;
				  p.src = '//assets.pinterest.com/js/pinit.js';
				  f.parentNode.insertBefore(p, f);
				}(document));
			</script>
		</div>
		
		<?php //echo stripslashes(htmlspecialchars_decode($smof_data["wd_prod_share_code"]));?>
		
	</div>              
</div>