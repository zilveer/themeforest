<?php 

	echo "\n" . '</div><!-- / row -->';

/* ------------------------------------
:: HIDE CONTENT END
------------------------------------ */

	global $NV_hidecontent;
	
	if( $NV_hidecontent != "yes" )
	{
		echo "\n" . '<div class="clear"></div>';
		echo "\n" . '</div><!-- /skinset-main-->';
		echo "\n" . '<div class="clear"></div>';
		echo "\n" . '</div><!-- /content-wrapper -->';
	}

/* ------------------------------------
:: PAGE VARIABLES
------------------------------------ */

	require NV_FILES ."/inc/page-constants.php"; // Page Constants

/* ------------------------------------
:: TWITTER
------------------------------------ */

	if( $NV_twitter=="pagebot" )
	{ 
		global $NV_frame_footer;
		
        echo "\n" . '<div class="row">';
        echo "\n\t" . '<div class="twitter-wrap nv-skin bottom disabled">';
       	require NV_FILES .'/inc/twitter.php'; // Call Twitter Template
        echo "\n\t" . '</div>';
        echo "\n" . '</div>';
	}

/* ------------------------------------
:: GROUP SLIDER
------------------------------------ */

	if( $NV_show_slider == "groupslider" && $NV_groupsliderpos == "below" )
	{
		require NV_FILES ."/inc/gallery-groupslider.php"; // Group Slider Gallery 
	}

/* ------------------------------------
:: GRID
------------------------------------ */
	
	if( $NV_show_slider == "gridgallery" && $NV_groupsliderpos == "below" )
	{
		$masonry 		= ( get_post_meta( $post->ID, '_cmb_gridmasonry', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_gridmasonry', true ) : '';
		$columnpadding  = ( get_post_meta( $post->ID, '_cmb_columnpadding', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_columnpadding', true ) : '';
				
		if( $NV_gridfilter == 'yes' ) $NV_galleryclass = $NV_galleryclass . ' filter';
				
		require_once NV_FILES ."/inc/gallery-grid.php"; // Group Slider Gallery
	}

/* ------------------------------------
:: EXIT TEXT
------------------------------------ */

	global $exittext,$exit_classes,$NV_frame_footer, $NV_disablefooter,$NV_footer_divider,$NV_footer_shadow;
	
	if( !empty( $exittext ) )
	{ 
		if( empty( $exit_classes ) ) $exit_classes='skinset-main'; 
		
		echo "\n" . '<div class="row">';
		echo "\n\t" . '<div class="intro-text skinset-main '. $exit_classes .' '. $NV_frame_footer .' nv-skin">';
		echo "\n\t\t" . '<div>';
		echo do_shortcode( $exittext );
		echo "\n\t\t" . '</div>';
		echo "\n\t\t" . '<div class="clear"></div>';
		echo "\n\t" . '</div>';
		echo "\n" . '</div>';
	}
    
    echo '</div><!-- /wrapper -->';
	
	if( $NV_disablefooter != 'yes' && of_get_option('mainfooter') != 'disable' ) : ?>
    
	<div id="footer-wrap">
    	
        <div id="custom-layer3" class="custom-layer <?php ( !empty( $layer3_fixed ) ? $layer3_fixed : '' ) ?>"><?php if( !empty( $layerset3 ) ) { echo setlayer_html("layer3",$layerset3,$skin); } ?></div>
        <div id="custom-layer4" class="custom-layer <?php ( !empty( $layer4_fixed ) ? $layer4_fixed : '' ) ?>"><?php if( !empty( $layerset4 ) ) { echo setlayer_html("layer4",$layerset4,$skin); } ?></div>

		<?php
		// Shadow
		if( $NV_footer_shadow != 'disable' )
		{
			echo '<div class="shadow bottom custom-layer"></div>';
		} ?>
        
        <div class="wrapper">
            <footer id="footer" class="clearfix row skinset-footer nv-skin <?php echo $NV_frame_footer .' '. $NV_footer_divider; ?>">
                <div class="content">
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
                    } ?>
                </div><!-- / row -->           
            </footer><!-- / footer -->
        </div><!-- / wrapper -->
        <?php
			
		// Check for enabled lower footer
		if( of_get_option('lowerfooter') != "disable" )
		{
			$lower_left  = ( of_get_option('lowfooterleft')  !='' )  ? of_get_option('lowfooterleft')  : '&copy; '. date("Y") .' '. get_option("blogname");
			$lower_right = ( of_get_option('lowfooterright') !='' ) ? of_get_option('lowfooterright') : 'Powered by <a href="http://www.acoda.com" title="DynamiX Business WordPress Theme" target="_blank">DynamiX</a>'; ?>
       
			<div class="lowerfooter-wrap skinset-footer nv-skin clearfix <?php echo $NV_footer_divider; ?>">
            	<div class="wrapper">
                    <div class="lowerfooter">
                        <div class="row">
                            <div class="lowfooterleft columns six"><?php echo do_shortcode( $lower_left ); ?></div>
                            <div class="lowfooterright columns six"><?php echo do_shortcode( $lower_right ); ?></div>
                        </div>
                    </div><!-- / lowerfooter -->	
                </div><!-- / wrapper -->
			</div><!-- / lowerfooter-wrap -->
		<?php 
			
		} ?>        
	</div><!-- / footer-wrap -->
    
	<?php endif; // disable footer ?>
    <div class="autototop"><a href="#"></a></div>

<!-- I would like to give a great thankyou to WordPress for their amazing platform -->
<!-- Theme Design by themeva - http://themeva.com -->

<?php wp_footer();

	if( of_get_option('footer_javascript') !='' ) echo of_get_option('footer_javascript'); ?>
</div>
</div>
</body>
</html>