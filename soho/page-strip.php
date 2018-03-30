<?php
/*
Template Name: Striped Page
*/
if ( !post_password_required() ) {
get_header('none');
?>
    <script>
		jQuery(document).ready(function(){
				jQuery('html').addClass('without_border');
		});
	</script>
	<?php $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
    
    if (isset($gt3_theme_pagebuilder['strips']) && is_array($gt3_theme_pagebuilder['strips'])) {
        $el_count = count($gt3_theme_pagebuilder["strips"]);
        $strip_width = 100/$el_count;
		$strip_height = 100/$el_count;
	?>
        <div class="strip-menu strip-template" data-width="<?php echo $strip_width; ?>" data-count="<?php echo count($gt3_theme_pagebuilder["strips"]); ?>">
            <?php foreach ($gt3_theme_pagebuilder['strips'] as $stripid => $stripdata) {
                if (!isset($stripdata['opacity']) || $stripdata['opacity'] == '') {
                    $opacity = '1';
                } else {
                    $opacity = $stripdata['opacity'];
                }

                if (!isset($stripdata['tcolor']) || $stripdata['tcolor'] == '') {
                    $tcolor = 'ffffff';
                } else {
                    $tcolor = $stripdata['tcolor'];
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
                    <h1 class="strip-title" style="color:#<?php echo $tcolor; ?>"><?php echo $stripdata['striptitle1']; ?></h1>
                    <?php 
						}
					?>

                </div>
                <a href="<?php echo $stripdata['link']; ?>" class="strip_link"></a>
            </div>
            <?php }?>
        </div>
        <script>
            jQuery(document).ready(function($) {
				header.remove();			
				strip_setup();
				setTimeout("strip_setup()",500);
				setTimeout("strip_setup()",1000);
            });	
			jQuery(window).resize(function(){
				strip_setup();
				setTimeout("strip_setup()",500);
				setTimeout("strip_setup()",1000);
			});
			function strip_setup() {				
				jQuery('.strip-text').each(function(){
					jQuery(this).css('margin-top', -1 * jQuery(this).height()/2);
				});
				if (window_w < 760) {
					jQuery('.strip-item').height(window_h/<?php echo $el_count; ?>);
				} else {
					jQuery('.strip-item').height('100%');
				}
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