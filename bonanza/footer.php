<?php global $theme_options; ?>

</div> <!--  end .main-content  --> 

</div> <!-- .wrap-inside -->
</div> <!-- .wrapper -->
<div id="footer-wrap-outer" class="primary-color">
	<div id="footer">
	
	    <div id="footer-inside" class="container">
			<?php if(is_active_sidebar('footer-sidebar')) { ?>
		        <div id="footer-widgets">
		    	    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
		    	    <?php endif; ?>	
    	    
				</div> <!--  end #footer-widgets  -->
			<?php } ?> 
		</div> <!--  end #footer-inside  -->
	 
	    <div class="clear"></div>

				
	<span class="bottom-border"></span>		
	</div> <!--  end #footer  -->
</div> <!--  end #footer-wrap-outer  -->

<div id="bottom-info-wrapper">
	<div id="bottom-info" class="container">
	
		<div id="copyright" ><a href="http://www.ufothemes.com">Premium Wordpress Themes</a> by UFO Themes</div>

		<?php if ( ! empty( $theme_options['payment_visa'] ) || ! empty( $theme_options['payment_mastercard'] ) || ! empty( $theme_options['payment_amex'] ) || ! empty( $theme_options['payment_paypal'] ) || ! empty( $theme_options['payment_checks'] ) ) { ?>  
			<div id="weaccept-wrap">
				<div id="accepted">

					<?php if( ! empty( $theme_options['payment_visa'] )  ) { ?>  
			    			<div class="visa"></div>
					<?php } ?>
					<?php if( ! empty( $theme_options['payment_mastercard'] )  ) { ?>  
			    			<div class="mastercard"></div>
					<?php } ?>
					<?php if( ! empty( $theme_options['payment_amex'] )  ) { ?>  
			    			<div class="amex"></div>
					<?php } ?>
					<?php if( ! empty( $theme_options['payment_paypal'] )  ) { ?>  
			    			<div class="paypal"></div>
					<?php } ?>
					<?php if( ! empty( $theme_options['payment_checks'] )  ) { ?>  
			    			<div class="checks"></div>
					<?php } ?>
				</div>

			</div>
		<?php } ?>

	</div> <!-- bottom info -->
</div> <!-- #bottom-info-wrapper-->

<?php wp_footer(); ?>
 
</body>
</html>