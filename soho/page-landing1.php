<?php
/*
Template Name: Landing
*/
if ( !post_password_required() ) {
get_header('none')
?>
	<?php $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID()); 
		$logo_color = '151516';
		if (isset($gt3_theme_pagebuilder['landing']['color'])) {
			$logo_color = $gt3_theme_pagebuilder['landing']['color'];
		}
		$logo_type = 'circle';
		if (isset($gt3_theme_pagebuilder['landing']['shape'])) {
			$logo_type = $gt3_theme_pagebuilder['landing']['shape'];
		}		
	?>
    	<style>
			.custom_bg {
				opacity: 0.01;
			}			
		</style>
        <div class="landing_preloader"></div>
        <a href="<?php echo $gt3_theme_pagebuilder['landing']['url']; ?>" class="landing_logo loading type1 <?php echo $logo_type; ?>" style="background:#<?php echo $logo_color; ?>"><img src="<?php gt3_the_theme_option("logo_landing"); ?>" alt=""  width="<?php gt3_the_theme_option("landing_logo_standart_width"); ?>" height="<?php gt3_the_theme_option("landing_logo_standart_height"); ?>" class="logo_def"><img src="<?php gt3_the_theme_option("logo_landing_retina"); ?>" alt="" width="<?php gt3_the_theme_option("landing_logo_standart_width"); ?>" height="<?php gt3_the_theme_option("landing_logo_standart_height"); ?>" class="logo_retina"></a>
        <script>
            jQuery(document).ready(function($) {
				if (jQuery('.landing_logo').find('img').height() > jQuery('.landing_logo').find('img').width()) {
					set_a_size = jQuery('.landing_logo').find('img').height();
				} else {
					set_a_size = jQuery('.landing_logo').find('img').width();
					jQuery('.landing_logo').find('img').css('margin-top', (set_a_size - jQuery('.landing_logo').find('img').height())/2+'px');
				}
				jQuery('.landing_logo').css({'margin-top' : '-'+(set_a_size/2+52)+'px', 'margin-left' : '-'+(set_a_size/2+52)+'px'}).width(set_a_size).height(set_a_size);
				setTimeout("jQuery('.custom_bg').animate({'opacity' : '1'}, 1000)", 500);
				setTimeout('start_preloader()',500);
            });	
			jQuery(window).resize(function(){

			});
			function start_preloader() {
				jQuery('.landing_preloader').animate({'width' : '100%'},<?php echo absint($gt3_theme_pagebuilder['landing']['time']) ?>, function(){
					jQuery('.landing_logo').removeClass('loading');
				});
			}
        </script>
        </script>
<?php get_footer('none'); 
} else {
	get_header('fullscreen');
?>
    <div class="pp_block">
        <h1 class="pp_title"><?php  _e('THIS CONTENT IS', 'theme_localization') ?> <span><?php  _e('PASSWORD PROTECTED', 'theme_localization') ?></span></h1>
        <div class="pp_wrapper">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="global_center_trigger"></div>	
    <script>
		jQuery(document).ready(function(){
			jQuery('.post-password-form').find('label').find('input').attr('placeholder', 'Enter The Password...');
		});
	</script>
<?php 
	get_footer('fullscreen');
} ?>