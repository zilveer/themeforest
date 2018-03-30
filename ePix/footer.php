<?php 

/* ------------------------------------
:: HIDE CONTENT END
------------------------------------ */

	global $NV_hidecontent; 
	
	if( $NV_hidecontent != "yes" )
	{
		echo "\n" . '</div><!-- / row -->';
		echo "\n" . '<div class="clear"></div>';
		echo "\n" . '</div><!-- /content-wrapper -->';
	
	
	/* ------------------------------------
	:: PAGE VARIABLES
	------------------------------------ */
	
		require NV_FILES ."/inc/page-constants.php"; // Page Constants
	
	/* ------------------------------------
	:: TWITTER
	------------------------------------ */
	
		if( $NV_twitter == "pagebot" && get_post_meta( $post->ID, '_cmb_twitter', true ) != 'disable' )
		{ 
			global $NV_frame_footer;
			
			echo "\n" . '<div class="row">';
			echo "\n\t" . '<div class="twitter-wrap skinset-main nv-skin bottom '. $NV_frame_footer .'">';
			require NV_FILES .'/inc/twitter.php'; // Call Twitter Template
			echo "\n\t" . '</div>';
			echo "\n" . '</div>';
		}
	
	/* ------------------------------------
	:: EXIT TEXT
	------------------------------------ */
	
		global $NV_frame_footer, $NV_disablefooter;
		
		
		if( $NV_disablefooter != 'yes' && of_get_option('mainfooter') != 'disable' ) : ?>
		
		<footer id="footer-wrap" class="row">
			<div id="footer" class="clearfix skinset-footer row nv-skin <?php echo $NV_frame_footer; ?>">
				<div class="footer-inner-wrap">
                <div class="row content">
					<?php
					
					$get_footer_num = ( of_get_option('footer_columns_num') !='' ) ? of_get_option('footer_columns_num') : '4'; // If not set, default to 4 columns
					
					$NV_footercolumns_text=numberToWords($get_footer_num ); // convert number to word
					
					$i=1;
					
					while( $i <= $get_footer_num )
					{ 
						if ( is_active_sidebar('footer'.$i) )
						{ ?>
						<div class="block columns <?php echo $NV_footercolumns_text."_column "; if($i == $get_footer_num) { echo "last"; } ?>">
						
							<ul>
								<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Column '.$i)) : endif; ?>
							</ul>
						
						</div>
						<?php 
						}
						
						$i++;	
					} 
					
					// Check for enabled lower footer
					if( of_get_option('lowerfooter')!="disable" )
					{
						$lower_left  = ( of_get_option('lowfooterleft') !='' )  ? of_get_option('lowfooterleft')  : '&copy; '. date("Y") .' '. get_option("blogname");
						$lower_right = ( of_get_option('lowfooterright') !='' ) ? of_get_option('lowfooterright') : 'Powered by <a href="http://acoda.com/epix" title="ePix WordPress Photography Theme" target="_blank">ePix</a>';
						 
					?>
					<div class="clear"></div>
					<div class="lowerfooter-wrap clearfix">
						<div class="lowerfooter columns twelve">
							<div class="lowfooterleft"><?php echo do_shortcode( $lower_left ); ?></div>
							<div class="lowfooterright"><?php echo do_shortcode( $lower_right ); ?></div>
						</div><!-- / lowerfooter -->		
					</div><!-- / lowerfooter-wrap -->
					<?php } ?>
				</div><!-- / row -->  
              </div><!-- / row -->                
			</div><!-- / footer -->
		</footer><!-- / footer-wrap -->
		
		<?php 
		
		endif; // disable footer 

		echo '<div class="autototop"><a href="#"><i class="fa fa-chevron-up fa-lg"></i></a></div>';
		echo '</div><!-- /main-wrap -->';	
	
	} // hide main content	?>


    <!-- I would like to give a great thankyou to WordPress for their amazing platform -->
    <!-- Theme Design by ACODA - http://acoda.com -->

<?php if( of_get_option('footer_javascript') !='' ) echo of_get_option('footer_javascript'); ?>
</div><!-- /site-inwrap --> 
</div><!-- /primary-wrapper -->

<?php wp_footer(); ?>

</body>
</html>