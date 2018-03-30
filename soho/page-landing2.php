<?php
/*
Template Name: Landing Striped 
*/
if ( !post_password_required() ) {
get_header('none');
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
		    
    if (isset($gt3_theme_pagebuilder['strips']) && is_array($gt3_theme_pagebuilder['strips'])) {
        $strip_width = 50;
	?>
        <div class="strip-landing" data-width="<?php echo $strip_width; ?>" data-count="<?php echo count($gt3_theme_pagebuilder["strips"]); ?>">
            <?php foreach ($gt3_theme_pagebuilder['strips'] as $stripid => $stripdata) {
                if (!isset($stripdata['opacity']) || $stripdata['opacity'] == '') {
                    $opacity = '1';
                } else {
                    $opacity = $stripdata['opacity'];
                }
                ?>
            <div class="strip-item" data-href="<?php echo $stripdata['link']; ?>" style="background-image:url(<?php echo $stripdata['bgimage']; ?>); width:<?php echo $strip_width; ?>%;">
                <div class="strip-fadder" style="background:rgba(<?php echo gt3_HexToRGB($stripdata['fcolor']) ?>, <?php echo $opacity; ?>)"></div>
                <div class="strip-text">
                    <?php 
						if (isset($stripdata['image']) && $stripdata['image'] !== '') {
					?>
					<img class="strip_img" alt="<?php echo $stripdata['striptitle1']; ?>" src="<?php echo $stripdata['image']; ?>"/>	
					<?php }	
						if (isset($stripdata['striptitle1']) && $stripdata['striptitle1'] !== '') {
					?>
                    <h1 class="strip-title"><?php echo $stripdata['striptitle1']; ?></h1>
                    <?php 
						}
						if (isset($stripdata['striptitle1']) && $stripdata['striptitle2'] !== '') {
					?>
                    	<h6 class="strip_span"><?php echo $stripdata['striptitle2']; ?></h6>
                    <?php 
						}
					?>

                </div>
                <a href="<?php echo $stripdata['link']; ?>" class="strip_link"></a>
            </div>
            <?php }?>
        </div>
        <a href="<?php echo $gt3_theme_pagebuilder['landing']['url']; ?>" class="landing_logo landing_logo2 <?php echo $logo_type; ?>" style="background:#<?php echo $logo_color; ?>"><img src="<?php gt3_the_theme_option("logo_landing"); ?>" alt=""  width="<?php gt3_the_theme_option("landing_logo_standart_width"); ?>" height="<?php gt3_the_theme_option("landing_logo_standart_height"); ?>" class="logo_def"><img src="<?php gt3_the_theme_option("logo_landing_retina"); ?>" alt="" width="<?php gt3_the_theme_option("landing_logo_standart_width"); ?>" height="<?php gt3_the_theme_option("landing_logo_standart_height"); ?>" class="logo_retina"></a>
        <script>
            jQuery(document).ready(function($) {
				strip_setup();
				if (jQuery('.landing_logo').find('img').height() > jQuery('.landing_logo').find('img').width()) {
					set_a_size = jQuery('.landing_logo').find('img').height();
				} else {
					set_a_size = jQuery('.landing_logo').find('img').width();
					jQuery('.landing_logo').find('img').css('margin-top', (set_a_size - jQuery('.landing_logo').find('img').height())/2+'px');
				}
				jQuery('.landing_logo').css({'margin-top' : '-'+(set_a_size/2+52)+'px', 'margin-left' : '-'+(set_a_size/2+52)+'px'}).width(set_a_size).height(set_a_size);
            });	
			jQuery(window).resize(function(){
				strip_setup();
				setTimeout("strip_setup()",500);
				setTimeout("strip_setup()",1000);
			});
			function strip_setup() {				
				jQuery('.strip-text').each(function(){
					jQuery(this).css('margin-top', -1 * jQuery(this).height()/2);
					jQuery(this).css('margin-left', -1 * jQuery(this).width()/2);
				});
			}
        </script>
    <?php } ?> 
<?php
get_footer('none'); 
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