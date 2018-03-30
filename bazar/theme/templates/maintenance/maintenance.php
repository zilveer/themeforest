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

//Add body classes
$body_classes = 'no_js maintenance';
if( ( yit_get_option( 'responsive-enabled' ) && !$GLOBALS['is_IE'] ) || ( yit_get_option( 'responsive-enabled' ) && yit_ie_version() >= 9 ) ) {
    $body_classes .= ' responsive';
}

$body_classes .= ' ' . yit_get_option( 'layout-type' );
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7"  class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8"  class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9"  class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"<?php language_attributes() ?>>
<![endif]-->

<!-- This doesn't work but i prefer to leave it here... maybe in the future the MS will support it... i hope... -->
<!--[if IE 10]>
<html id="ie10"  class="ie"<?php language_attributes() ?>>
<![endif]-->


<!--[if !IE]>
<html <?php language_attributes() ?>>
<![endif]-->

<!-- START HEAD -->
<head>
    <?php do_action( 'yit_head' ) ?> 
    <?php wp_head() ?>
    
    <style type="text/css">
    	body {
			background: <?php echo $background['color'] ?> <?php if($background['image']): ?>url('<?php echo $background['image'] ?>') <?php echo $background['repeat'] ?> <?php echo $background['position'] ?> <?php echo $background['attachment'] ?><?php endif ?>;
    	}
    	
    	#maintenance_container {
    		margin: 0 auto;
    		margin-top: 10%;
    		width: <?php echo $container['width'] ?>px;
    		height: <?php echo $container['height'] ?>px;
    		<?php if($container['color']): ?>background-color: <?php echo $container['color'] ?><?php endif ?>;
    		padding: 5px;
    	}
    	
    	.inner_border_gray { padding: 2px; border: 1px solid #ddd }
    	.inner_border_orange { border: 1px solid #f1c070; height: <?php echo $container['height'] - 7 ?>px; }
    	
    	#maintenance_logo {
    		margin-top: 37px;
    		text-align: center;
	    	<?php if( $logo['color'] ): ?>background: <?php echo $logo['color'] ?><?php endif ?>
    	}

		#maintenance_message {
			padding: 20px 42px;
		}
		
		#maintenance_newsletter {
			margin-top: 65px;
		}
		
		#maintenance_newsletter .newsletter-section {
			width: 460px;
			margin: 0 auto;
		}
		
		#maintenance_newsletter .newsletter-section li { float: left; }
		
		#maintenance_newsletter .newsletter-section input.text-field {
			width: 289px;
			background: transparent;
			background-image: url('<?php echo get_template_directory_uri() ?>/images/icons/mail_maintenance.png');
			background-repeat: no-repeat;
			background-position: 10px center;
			border: 1px solid #d1d1cf;
			padding: 5px 0;
			padding-left: 51px;
			
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
			box-shadow: none;
			
			-moz-border-radius: 0;
			-webkit-border-radius: 0;
			border-radius: 0;
		}
		
		#maintenance_newsletter .newsletter-section label {
			top: 17px;
			left: 44px;
		}
		
		#maintenance_newsletter .newsletter-section input.submit-field {
			background: <?php echo $newsletter['submit']['color'] ?>;
						
			border: none;
			margin-top: 2px;
			padding: 10px 15px;
			height: 43px;
		}
		
		#maintenance_newsletter .newsletter-section input.submit-field:hover {
			background: <?php echo $newsletter['submit']['hover'] ?>;
		}
		
		
		@media (min-width: 768px) and (max-width: 979px) {  
			#maintenance_container { width: 90% }
		}
		
		@media (max-width: 767px) {  
			#maintenance_container { width: 90% }
			#maintenance_message { padding: 10px 12px }
			#maintenance_newsletter { margin-top: 15px; }
			#maintenance_newsletter .newsletter-section li { float: none; text-align: center; display: inline-block; width: 100% }
			#maintenance_newsletter .newsletter-section label { left: 158px; }
			#maintenance_newsletter .newsletter-section input.text-field { width: 177px; margin-left: 0; }
			#maintenance_newsletter .newsletter-section input.submit-field { float: none; display: inline-block; }
		}

		@media (max-width: 480px) {
			#maintenance_newsletter .newsletter-section label { left: 124px; }
		}

		@media (max-width: 320px) {
			#maintenance_newsletter .newsletter-section li { margin: 0; padding: 0 }
			#maintenance_newsletter .newsletter-section label { left: 52px; }
		}
		

    	<?php echo $custom ?>
    </style>
</head>
<!-- END HEAD -->
<!-- START BODY -->
<body <?php body_class( $body_classes ) ?>>
	<div id="maintenance_container">
		<div class="inner_border_gray">
			<div class="inner_border_orange">
				<?php if( $logo['image'] ): ?>
				<div id="maintenance_logo">
					<img src="<?php echo $logo['image'] ?>" alt="<?php bloginfo() ?>" />
				</div>
				<?php endif ?>
				
				<?php if( $message ): ?>
				<div id="maintenance_message">
					<?php echo $message ?>
				</div>
				<?php endif ?>
				
				<?php if( $newsletter['enabled'] ): ?>
				<div id="maintenance_newsletter">
					<?php echo do_shortcode('[newsletter_form]'); ?>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
	
	<?php wp_footer() ?>
</body>
</html>