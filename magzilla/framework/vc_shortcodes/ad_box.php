<?php
/*-----------------------------------------------------------------------------------*/
/*	Ad Box
/*-----------------------------------------------------------------------------------*/

function fav_ad_box( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'ad_spot_id' => ''
    ), $atts ) );
	
	ob_start();

	global $ft_option;

	if ( $ad_spot_id == "custom_ad_1" ) {
		$ad_code = $ft_option['custom_ad1'];

	} elseif ( $ad_spot_id == "custom_ad_2" ) {
		$ad_code = $ft_option['custom_ad2'];

	} elseif ( $ad_spot_id == "custom_ad_3" ) {
		$ad_code = $ft_option['custom_ad3'];

	} else {

		$ad_code = '';
	}
	?>
	
	<div class="ads-module module">
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="favethemes-ads-main text-center">
					<?php echo $ad_code; ?>
				</div><!-- .module-top -->
			</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
		</div><!-- .row -->

	</div><!-- .ad-module -->
    

	<?php 
	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('favethemes-ad-box', 'fav_ad_box');
?>