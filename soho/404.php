<?php get_header();?>
    <div class="wrapper404">
        <div class="container404">
        	<h1 class="title404"><?php echo __('OOPS!', 'theme_localization'); ?> <span><?php echo __('Not Found!', 'theme_localization'); ?></span></h1>
            <div class="text404"><?php echo __('404 Error. Apologies, but we were unable to find what you were looking for.', 'theme_localization'); ?></div>
            
            <form name="search_field" method="get" action="<?php echo home_url(); ?>" class="search_form search404">
                <input type="text" name="s" value="" class="field_search" placeholder="<?php _e('Search', 'theme_localization'); ?>">
                <a href="<?php echo esc_js("javascript:document.search_field.submit()");?>" class="search_button"><?php _e('Search', 'theme_localization'); ?></a>
            </form>
            <div class="clear"></div>
        </div>        
    </div>
    <script>
		var wrapper404 = jQuery('.wrapper404');
		jQuery(document).ready(function(){
			centerWindow();
			footer.find('.socials').remove();
			footer.find('.phone').empty().addClass('back404').append('<a href="<?php echo esc_js("javascript:history.back()");?>"><i class="icon-angle-left"></i>&nbsp;&nbsp;<?php _e('Go Back', 'theme_localization'); ?></a>');
		});
		jQuery(window).load(function(){
			centerWindow();
		});
		jQuery(window).resize(function(){
			setTimeout('centerWindow()',500);
			setTimeout('centerWindow()',1000);			
		});
		function centerWindow() {
			set404Top = (parseInt(jQuery('.main_wrapper').css('min-height')) - wrapper404.height())/2;
			if (set404Top < 0) set404Top = 0;
			wrapper404.css('padding-top', set404Top +'px');
			console.log(parseInt(jQuery('.main_wrapper').css('min-height')) +'-'+ jQuery('.wrapper404').height());
		}
	</script>
<?php get_footer(); ?>