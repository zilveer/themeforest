function show_hide_boxes(val) {
    switch (val) {
        case 'video':
            jQuery('#post_slides, #post_quote, #post_audio, #post_url').css({'display':'none'})
             jQuery('#post_video').slideDown('normal');
            break;
        case 'audio':
            jQuery('#post_slides, #post_video, #post_quote, #post_url').css({'display':'none'})
             jQuery('#post_audio').slideDown('normal');
            break;
        case 'gallery':
            jQuery('#post_quote, #post_video, #post_audio, #post_url').css({'display':'none'})
            jQuery('#post_slides').slideDown('normal');
            break;
        case 'link':
            jQuery('#post_slides, #post_video, #post_audio, #post_quote').css({'display':'none'})
            jQuery('#post_url').slideDown('normal');
            break;
        case 'quote':
            jQuery('#post_slides, #post_video, #post_audio, #post_url').css({'display':'none'})
            jQuery('#post_quote').slideDown('normal');
            break;
        default:
            jQuery('#post_slides, #post_video, #post_audio, #post_url, #post_quote').css({'display':'none'})
    }
}
function show_hide_title_option(val) {
    switch (val) {
        case 'featuredimage':
             jQuery('#fancy_titlebar_options').slideDown('normal');
            break;
        default:
            jQuery('#fancy_titlebar_options').css({'display':'none'});
            break;
    }
}
function show_hide_portfolio_option(val) {
    switch (val) {
        case 'page-portfolio-col1.php':
        case 'page-portfolio-col2.php':
        case 'page-portfolio-col3.php':
        case 'page-portfolio-col4.php':
        case 'page-portfolio-col3-excerpts.php':
                jQuery('#portfoliosettings').slideDown('normal');
            break;
        default:
            jQuery('#portfoliosettings').css({'display':'none'});
            break;
    }
}
jQuery(document).ready(function(){
    jQuery('#post_slides, #post_video, #post_audio, #post_url, #post_quote').addClass('hide-if-js');
       show_hide_boxes(jQuery('input:radio[name="post_format"]:checked').val());
	jQuery('input:radio[name="post_format"]').change(function(){
	    show_hide_boxes(jQuery(this).val());
	});

    
    if(jQuery("#richer_titlebar").length > 0 ) {
        var e = document.getElementById("richer_titlebar");
        var richer_titlebar_value = e.options[e.selectedIndex].value;
        show_hide_title_option(richer_titlebar_value);
        jQuery('select#richer_titlebar').change(function(){
            show_hide_title_option(jQuery(this).val());
        });
    }
    
    if(jQuery("#page_template").length > 0){
        var d = document.getElementById("page_template");
        var richer_page_template_value = d.options[d.selectedIndex].value;
        show_hide_portfolio_option(richer_page_template_value);
        jQuery('select#page_template').change(function(){
            show_hide_portfolio_option(jQuery(this).val());
        });
    }
});