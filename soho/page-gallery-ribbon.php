<?php 
/*
Template Name: Gallery - Ribbon
*/
if ( !post_password_required() ) {
get_header('fullscreen');
the_post();

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();
wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
wp_enqueue_script('gt3_swipe_js', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);
$all_likes = gt3pb_get_option("likes");
$post_views = (get_post_meta(get_the_ID(), "post_views", true) > 0 ? get_post_meta(get_the_ID(), "post_views", true) : "0");
update_post_meta(get_the_ID(), "post_views", (int)$post_views + 1);
?>
    <div class="fullscreen-gallery hided">
		<?php 
            $compile_slides = "";
        ?>
        <?php
        if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {        
			$imgi = 1;
            foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitle = ' : '.$image['title']['value'];} else {$photoTitle = " ";}
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoAlt = $image['title']['value'];} else {$photoAlt = " ";}
				if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {$photoCaption  = $image['caption']['value'];} else {$photoCaption = " ";}				
				$photoCaption = "";
				$photoAlt = get_post_meta($image['attach_id'], '_wp_attachment_image_alt', true);			
				$compile_slides .= "<li data-count='".$imgi."' data-title='". $photoTitle ."' data-caption='". $photoCaption ."' class='slide".$imgi."'><div class='slide_wrapper'><img src='" . aq_resize(wp_get_attachment_url($image['attach_id']), null, "910", true, true, true) . "' alt='" . $photoAlt ."'/></div></li>";
				$imgi++;
				?>   
				<?php }
	        }?>
            
            <div class="ribbon_wrapper">
                <div class="ribbon_list_wrapper">
                    <ul class="ribbon_list">
                        <?php echo $compile_slides; ?>
                    </ul>
                </div>
            </div>
            <div class="fs_controls slider_info">
                <div class="share_block">
                    <a href="<?php echo esc_js("javascript:void(0)");?>" class="share_toggle"><?php echo __('Share', 'theme_localization'); ?></a>
                    <div class="share_box">
                        <a target="_blank"
                           href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                           class="share_facebook"><i
                                class="stand_icon icon-facebook-square"></i></a>
                        <a target="_blank"
                           href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : gt3_get_theme_option("logo"); ?>"
                           class="share_pinterest"><i class="stand_icon icon-pinterest"></i></a>                                                            
                        <a target="_blank"
                           href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                           class="share_tweet"><i class="stand_icon icon-twitter"></i></a>
                        <a target="_blank"
                           href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                           class="share_gplus"><i class="icon-google-plus-square"></i></a>
                    </div>
                </div>
                <div class="title_wrapper"><h1 class="fs_title"><?php echo the_title() ?><span class="slide_title"></span></h1><span class="fs_descr"></span></div>
                <div class="fs_controls_append ribbon_panel">
	                <a href="<?php echo esc_js("javascript:void(0)");?>" class="btn_prev fs_slider_prev"></a>
                    <a href="<?php echo esc_js("javascript:void(0)");?>" class="btn_next fs_slider_next"></a>
                    <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
                </div>
            </div>
            <!-- .fullscreen_content_wrapper -->            
   	</div>
    <script>
		var demension = 0;
		jQuery(document).ready(function($){
			jQuery('.custom_bg').remove();
			jQuery('.btn_prev').click(function(){
				prev_slide();
			});
			jQuery('.btn_next').click(function(){
				next_slide();
			});
			if (window_w > 760 && window_w < 1025) {
				jQuery('.ribbon_list img').on("swipeleft",function(){
					next_slide();
				});
				jQuery('.ribbon_list img').on("swiperight",function(){
					prev_slide();
				});
				jQuery('#ribbon_swipe').on("swipeleft",function(){
					next_slide();
				});
				jQuery('#ribbon_swipe').on("swiperight",function(){
					prev_slide();
				});
			}
			
			jQuery(document.documentElement).keyup(function (event) {
				if ((event.keyCode == 37) || (event.keyCode == 40)) {
					prev_slide();
				} else if ((event.keyCode == 39) || (event.keyCode == 38)) {
					next_slide();
				}
			});

			jQuery('.share_toggle').click(function(){
				jQuery('.share_block').toggleClass('show_share');
			});			
			
			jQuery('.slide1').addClass('currentStep');
			jQuery('.slide_title').text(jQuery('.currentStep').attr('data-title'));
			jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));			
			ribbon_setup();			
			setTimeout("ribbon_setup()",700);			
		});	
		jQuery(window).resize(function($){
			ribbon_setup();
			setTimeout("ribbon_setup()",500);
			setTimeout("ribbon_setup()",1000);			
		});	
		jQuery(window).load(function($){
			ribbon_setup();
			setTimeout("ribbon_setup()",350);
			setTimeout("ribbon_setup()",700);
		});	
		
		function ribbon_setup() {	
			if (window_w > 760) {
				if (jQuery('#wpadminbar').size() > 0) {
					setHeight = window_h - header.height() - jQuery('#wpadminbar').height() - 15;
					setHeight2 = window_h - header.height() - jQuery('#wpadminbar').height() - jQuery('.slider_info').height() - 30;
					setTop = header.height() + jQuery('#wpadminbar').height();
				} else {
					setHeight = window_h - header.height() - 15;
					setHeight2 = window_h - header.height() - jQuery('.slider_info').height() - 30;				
					setTop = header.height();
				}

				jQuery('.currentStep').removeClass('currentStep');
				jQuery('.slide1').addClass('currentStep');
				jQuery('.num_current').text('1');
				
				jQuery('.num_all').text(jQuery('.ribbon_list li').size());
				jQuery('.ribbon_wrapper').height(setHeight2).css('top', setTop+15);
				jQuery('.ribbon_list .slide_wrapper').height(setHeight2);
				jQuery('.ribbon_list').height(setHeight2).width(15).css({'left' : 0});
				jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
				jQuery('.ribbon_list').find('li').each(function(){
					jQuery('.ribbon_list').width(jQuery('.ribbon_list').width()+jQuery(this).width());
					jQuery(this).attr('data-offset',jQuery(this).offset().left);
					jQuery(this).width(jQuery(this).find('img').width()+parseInt(jQuery(this).find('.slide_wrapper').css('margin-left')));
				});
				max_step = -1*(jQuery('.ribbon_list').width()-window_w);
			} else {
				jQuery('.ribbon_list').css('padding-top', jQuery('.slider_info').height());
			}
		}
		function prev_slide() {
			current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
			current_slide--;
			if (current_slide < 1) {
				current_slide = jQuery('.ribbon_list').find('li').size();
			}
			jQuery('.currentStep').removeClass('currentStep');
			jQuery('.num_current').text(current_slide);
			jQuery('.slide'+current_slide).addClass('currentStep');
			jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
			if (-1*jQuery('.slide'+current_slide).attr('data-offset') > max_step) {
				jQuery('.ribbon_list').css('left', -1*jQuery('.slide'+current_slide).attr('data-offset')+demension);
			} else {
				jQuery('.ribbon_list').css('left', max_step-demension);
			}
			jQuery('.slide_title').text(jQuery('.currentStep').attr('data-title'));
		}
		function next_slide() {			
			current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
			current_slide++;
			if (current_slide > jQuery('.ribbon_list').find('li').size()) {
				current_slide = 1
			}
			jQuery('.currentStep').removeClass('currentStep');
			jQuery('.num_current').text(current_slide);
			jQuery('.slide'+current_slide).addClass('currentStep');
			//jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
			if (-1*jQuery('.slide'+current_slide).attr('data-offset') > max_step) {
				jQuery('.ribbon_list').css('left', -1*jQuery('.slide'+current_slide).attr('data-offset')+demension);
			} else {
				jQuery('.ribbon_list').css('left', max_step-demension);
			}
			jQuery('.slide_title').text(jQuery('.currentStep').attr('data-title'));
		}
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