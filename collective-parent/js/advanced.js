
jQuery(window).load(function() {
    // for hide options on click on image of slide
    var options = new Array();
    jQuery('#slider_frames li').live('click', function(){
        options['slide_type_slide'] = jQuery('#slide_type_slide').val();
        tfuse_toggle_options2(options);
    });
    function tfuse_toggle_options2(options)
    {
        if(options['slide_type_slide']=='video'){
            jQuery('.slide_src,.slide_button_text2,.slide_button_link2,.slide_list,.slide_gallery').hide();
            jQuery('.slide_subtitle,.slide_video_frame,.slide_button_text,.slide_button_link').show();
            jQuery('.slide_gallery,.slide_list').next().hide();
            jQuery('.slide_src').next().show();
        }
        else if(options['slide_type_slide']=='bg_list'){
            jQuery('.slide_video_frame,.slide_src,.slide_button_text2,.slide_button_link2,.slide_list,.slide_gallery,.slide_subtitle').hide();
            jQuery('.slide_list,.slide_button_text,.slide_button_link').show();
            jQuery('.slide_src').next().hide();
            jQuery('.slide_list').next().show();
        }
        else if(options['slide_type_slide']=='center_img'){
            jQuery('.slide_video_frame,.slide_gallery,.slide_button_text2,.slide_button_link2').hide();
            jQuery('.slide_subtitle,.slide_src,.slide_list,.slide_button_text,.slide_button_link').show();
            jQuery('.slide_src,.slide_list').next().show();
        }
        else if(options['slide_type_slide']=='img_2buttons'){
            jQuery('.slide_video_frame,.slide_gallery,.slide_list').hide();
            jQuery('.slide_button_text2,.slide_button_link2,.slide_button_text,.slide_button_link,.slide_subtitle,.slide_src').show();
            jQuery('.slide_list').next().hide();
            jQuery('.slide_src').next().show();
        }
        else if(options['slide_type_slide']=='gallery'){
            jQuery('.slide_video_frame,.slide_src,.slide_button_text2,.slide_button_link2,.slide_list').hide();
            jQuery('.slide_gallery,.slide_subtitle,.slide_button_text,.slide_button_link').show();
            jQuery('.slide_src').next().hide();
            jQuery('.slide_list').next().show();
        }
        else{
            jQuery('.slide_subtitle,.slide_gallery,.slide_video_frame,.slide_button_text2,.slide_button_link2,.slide_button_text,.slide_button_link').hide();
            jQuery('.slide_src,.slide_list').show();
            jQuery('.slide_list').next().hide();
            jQuery('.slide_src').next().show();
        }
    }
});

jQuery(document).ready(function() {
    var $ = jQuery;

    // hide options of select for type fullslider
    jQuery('.over_thumb ').bind('click', function(){
        window.setTimeout(function(){
            var sel = jQuery('#slider_design_type').val();
            if(sel == 'image_video'){
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');
            }
            else{
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option><option value="categories">Automatically, fetch images from categories</option><option value="posts">Automatically, fetch images from posts</option>');
            }
        },12);
    });

    // general banners (framework)
    from_general = jQuery('#collective_top_ads_space');
    if(from_general.is(':checked'))
        jQuery('.collective_top_ads_image,.collective_top_ads_url,.collective_top_ads_adsense').show();
    else
        jQuery('.collective_top_ads_image,.collective_top_ads_url,.collective_top_ads_adsense').hide();

    from_general.live('change',function () {
        if(jQuery(this).is(':checked')){
            jQuery('.collective_top_ads_image,.collective_top_ads_url,.collective_top_ads_adsense').show();
        }
        else{
            jQuery('.collective_top_ads_image,.collective_top_ads_url,.collective_top_ads_adsense').hide();
        }
    });

    from_general2 = jQuery('#collective_content_ads_space');
    if(from_general2.is(':checked'))
        jQuery('.collective_hook_image_admin,.collective_hook_url_admin,.collectivee_hook_adsense_admin').show();
    else
        jQuery('.collectiveeee_hook_image_admin,.collective_hook_url_admin,.collective_hook_adsense_admin').hide();

    from_general2.live('change',function () {
        if(jQuery(this).is(':checked')){
            jQuery('.collective_hook_image_admin,.collective_hook_url_admin,.collective_hook_adsense_admin').show();
        }
        else{
            jQuery('.collective_hook_image_admin,.collective_hook_url_admin,.collective_hook_adsense_admin').hide();
        }
    });

    var options = new Array();

    options['posts_select_type'] = jQuery('#posts_select_type').val();
    jQuery('#posts_select_type').bind('change', function() {
        options['posts_select_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['slide_type_slide'] = jQuery('#slide_type_slide').val();
    jQuery('#slide_type_slide').bind('change', function() {
        options['slide_type_slide'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_page_title'] = jQuery('#collective_page_title').val();
    jQuery('#collective_page_title').bind('change', function() {
        options['collective_page_title'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_footer_element'] = jQuery('#collective_footer_element').val();
    jQuery('#collective_footer_element').bind('change', function() {
        options['collective_footer_element'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_header_element'] = jQuery('#collective_header_element').val();
    jQuery('#collective_header_element').bind('change', function() {
        options['collective_header_element'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_post_type'] = jQuery('#collective_post_type').val();
    jQuery('#collective_post_type').bind('change', function() {
        options['collective_post_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_footer_element_cat'] = jQuery('#collective_footer_element_cat').val();
    jQuery('#collective_footer_element_cat').bind('change', function() {
        options['collective_footer_element_cat'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_header_element_cat'] = jQuery('#collective_header_element_cat').val();
    jQuery('#collective_header_element_cat').bind('change', function() {
        options['collective_header_element_cat'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_top_ad_space'] = jQuery('#collective_top_ad_space').val();
    jQuery('#collective_top_ad_space').bind('change', function() {
        options['collective_top_ad_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_bfcontent_ads_space'] = jQuery('#collective_bfcontent_ads_space').val();
    jQuery('#collective_bfcontent_ads_space').bind('change', function() {
        options['collective_bfcontent_ads_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_hook_space'] = jQuery('#collective_hook_space').val();
    jQuery('#collective_hook_space').bind('change', function() {
        options['collective_hook_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_bfcontent_type'] = jQuery('#collective_bfcontent_type').val();
    jQuery('#collective_bfcontent_type').bind('change', function() {
        options['collective_bfcontent_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_bfcontent_number'] = jQuery('#collective_bfcontent_number').val();
    jQuery('#collective_bfcontent_number').bind('change', function() {
        options['collective_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_blog_top_ad_space'] = jQuery('#collective_blog_top_ad_space').val();
    jQuery('#collective_blog_top_ad_space').bind('change', function() {
        options['collective_blog_top_ad_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_blog_hook_space'] = jQuery('#collective_blog_hook_space').val();
    jQuery('#collective_blog_hook_space').bind('change', function() {
        options['collective_blog_hook_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_blog_bfcontent_ads_space'] = jQuery('#collective_blog_bfcontent_ads_space').val();
    jQuery('#collective_blog_bfcontent_ads_space').bind('change', function() {
        options['collective_blog_bfcontent_ads_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_blog_bfcontent_type'] = jQuery('#collective_blog_bfcontent_type').val();
    jQuery('#collective_blog_bfcontent_type').bind('change', function() {
        options['collective_blog_bfcontent_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_blog_bfcontent_number'] = jQuery('#collective_blog_bfcontent_number').val();
    jQuery('#collective_blog_bfcontent_number').bind('change', function() {
        options['collective_blog_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_page_title_blog'] = jQuery('#collective_page_title_blog').val();
    jQuery('#collective_page_title_blog').bind('change', function() {
        options['collective_page_title_blog'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_footer_element_blog'] = jQuery('#collective_footer_element_blog').val();
    jQuery('#collective_footer_element_blog').bind('change', function() {
        options['collective_footer_element_blog'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_header_element_blog'] = jQuery('#collective_header_element_blog').val();
    jQuery('#collective_header_element_blog').bind('change', function() {
        options['collective_header_element_blog'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_blogpage_category'] = jQuery('#collective_blogpage_category').val();
    jQuery('#collective_blogpage_category').bind('change', function() {
        options['collective_blogpage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_homepage_category'] = jQuery('#collective_homepage_category').val();
    jQuery('#collective_homepage_category').bind('change', function() {
        options['collective_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_home_top_ad_space'] = jQuery('#collective_home_top_ad_space').val();
    jQuery('#collective_home_top_ad_space').bind('change', function() {
        options['collective_home_top_ad_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_home_hook_space'] = jQuery('#collective_home_hook_space').val();
    jQuery('#collective_home_hook_space').bind('change', function() {
        options['collective_home_hook_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_home_bfcontent_ads_space'] = jQuery('#collective_home_bfcontent_ads_space').val();
    jQuery('#collective_home_bfcontent_ads_space').bind('change', function() {
        options['collective_home_bfcontent_ads_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_home_bfcontent_type'] = jQuery('#collective_home_bfcontent_type').val();
    jQuery('#collective_home_bfcontent_type').bind('change', function() {
        options['collective_home_bfcontent_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_home_bfcontent_number'] = jQuery('#collective_home_bfcontent_number').val();
    jQuery('#collective_home_bfcontent_number').bind('change', function() {
        options['collective_home_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_bfcontent_type1'] = jQuery('#collective_bfcontent_type1').val();
    jQuery('#collective_bfcontent_type1').bind('change', function() {
        options['collective_bfcontent_type1'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_logo_type'] = jQuery('#collective_logo_type').val();
    jQuery('#collective_logo_type').bind('change', function() {
        options['collective_logo_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_page_title_all'] = jQuery('#collective_page_title_all').val();
    jQuery('#collective_page_title_all').bind('change', function() {
        options['collective_page_title_all'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_header_element_port_archive'] = jQuery('#collective_header_element_port_archive').val();
    jQuery('#collective_header_element_port_archive').bind('change', function() {
        options['collective_header_element_port_archive'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_footer_element_port_archive'] = jQuery('#collective_footer_element_port_archive').val();
    jQuery('#collective_footer_element_port_archive').bind('change', function() {
        options['collective_footer_element_port_archive'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_page_title_search'] = jQuery('#collective_page_title_search').val();
    jQuery('#collective_page_title_search').bind('change', function() {
        options['collective_page_title_search'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_header_element_search'] = jQuery('#collective_header_element_search').val();
    jQuery('#collective_header_element_search').bind('change', function() {
        options['collective_header_element_search'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_footer_element_search'] = jQuery('#collective_footer_element_search').val();
    jQuery('#collective_footer_element_search').bind('change', function() {
        options['collective_footer_element_search'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_page_title_404'] = jQuery('#collective_page_title_404').val();
    jQuery('#collective_page_title_404').bind('change', function() {
        options['collective_page_title_404'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_header_element_404'] = jQuery('#collective_header_element_404').val();
    jQuery('#collective_header_element_404').bind('change', function() {
        options['collective_header_element_404'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_footer_element_404'] = jQuery('#collective_footer_element_404').val();
    jQuery('#collective_footer_element_404').bind('change', function() {
        options['collective_footer_element_404'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_page_title_tag'] = jQuery('#collective_page_title_tag').val();
    jQuery('#collective_page_title_tag').bind('change', function() {
        options['collective_page_title_tag'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_header_element_tag'] = jQuery('#collective_header_element_tag').val();
    jQuery('#collective_header_element_tag').bind('change', function() {
        options['collective_header_element_tag'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_footer_element_tag'] = jQuery('#collective_footer_element_tag').val();
    jQuery('#collective_footer_element_tag').bind('change', function() {
        options['collective_footer_element_tag'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_page_title_archive'] = jQuery('#collective_page_title_archive').val();
    jQuery('#collective_page_title_archive').bind('change', function() {
        options['collective_page_title_archive'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_header_element_archive'] = jQuery('#collective_header_element_archive').val();
    jQuery('#collective_header_element_archive').bind('change', function() {
        options['collective_header_element_archive'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['collective_footer_element_archive'] = jQuery('#collective_footer_element_archive').val();
    jQuery('#collective_footer_element_archive').bind('change', function() {
        options['collective_footer_element_archive'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {
        if(options['collective_logo_type']=='image'){
            jQuery('.collective_logo').show();
            jQuery('.collective_text_logo').hide();
        }
        else{
            jQuery('.collective_logo').hide();
            jQuery('.collective_text_logo').show();
        }

        // slider options of post,categories,tags
        if(options['posts_select_type'] =='categories'){
            jQuery('#posts_select_portf_entries').parent().parent().parent().parent().hide();
            jQuery('#posts_select_cat_entries').parent().parent().parent().parent().show();
        }
        else{
            jQuery('#posts_select_portf_entries').parent().parent().parent().parent().show();
            jQuery('#posts_select_cat_entries').parent().parent().parent().parent().hide();
        }
        // slider options hide
        if(options['slide_type_slide']=='video'){
            jQuery('.slide_src,.slide_button_text2,.slide_button_link2,.slide_list,.slide_gallery').hide();
            jQuery('.slide_subtitle,.slide_video_frame,.slide_button_text,.slide_button_link').show();
            jQuery('.slide_gallery,.slide_list').next().hide();
            jQuery('.slide_src').next().show();
        }
        else if(options['slide_type_slide']=='bg_list'){
            jQuery('.slide_video_frame,.slide_src,.slide_button_text2,.slide_button_link2,.slide_list,.slide_gallery,.slide_subtitle').hide();
            jQuery('.slide_list,.slide_button_text,.slide_button_link').show();
            jQuery('.slide_src').next().hide();
            jQuery('.slide_list').next().show();
        }
        else if(options['slide_type_slide']=='center_img'){
            jQuery('.slide_video_frame,.slide_gallery,.slide_button_text2,.slide_button_link2').hide();
            jQuery('.slide_subtitle,.slide_src,.slide_list,.slide_button_text,.slide_button_link').show();
            jQuery('.slide_src,.slide_list').next().show();
        }
        else if(options['slide_type_slide']=='img_2buttons'){
            jQuery('.slide_video_frame,.slide_gallery,.slide_list').hide();
            jQuery('.slide_button_text2,.slide_button_link2,.slide_button_text,.slide_button_link,.slide_subtitle,.slide_src').show();
            jQuery('.slide_list').next().hide();
            jQuery('.slide_src').next().show();
        }
        else if(options['slide_type_slide']=='gallery'){
            jQuery('.slide_video_frame,.slide_src,.slide_button_text2,.slide_button_link2,.slide_list').hide();
            jQuery('.slide_gallery,.slide_subtitle,.slide_button_text,.slide_button_link').show();
            jQuery('.slide_src').next().hide();
            jQuery('.slide_list').next().show();
        }
        else{
            jQuery('.slide_subtitle,.slide_gallery,.slide_video_frame,.slide_button_text2,.slide_button_link2,.slide_button_text,.slide_button_link').hide();
            jQuery('.slide_src,.slide_list').show();
            jQuery('.slide_list').next().hide();
            jQuery('.slide_src').next().show();
        }
        // custom title in post,page,categories
        if(options['collective_page_title']=='custom_title'){
            jQuery('.collective_custom_title,.collective_custom_subtitle,.collective_subtitle_alignment').show();
            jQuery('#collective_custom_title,#collective_custom_subtitle,#collective_subtitle_alignment').parent().parent('.form-field').show();
        }
        else{
            jQuery('.collective_custom_title,.collective_custom_subtitle,.collective_subtitle_alignment').hide();
            jQuery('#collective_custom_title,#collective_custom_subtitle,#collective_subtitle_alignment').parent().parent('.form-field').hide();
        }
        // custom title blog
        if(options['collective_page_title_blog']=='custom_title')
            jQuery('.collective_custom_title_blog,.collective_custom_subtitle_blog,.collective_subtitle_alignment_blog').show();
        else
            jQuery('.collective_custom_title_blog,.collective_custom_subtitle_blog,.collective_subtitle_alignment_blog').hide();
        // slider footer
        if(options['collective_footer_element']=='slider')
            jQuery('.collective_select_slider_footer').show();
        else
            jQuery('.collective_select_slider_footer').hide();

        if(options['collective_footer_element_cat']=='slider')
            jQuery('#collective_select_slider_footer_cat').parent().parent('.form-field').show();
        else
            jQuery('#collective_select_slider_footer_cat').parent().parent('.form-field').hide();

        // post/page header options
        if(options['collective_header_element']=='image'){
            jQuery('.collective_header_image').show();
            jQuery('.collective_page_map,.collective_map_text,.collective_map_zoom,.collective_select_slider_after_header,.collective_select_slider').hide();
        }
        else if(options['collective_header_element']=='slider'){
            jQuery('.collective_select_slider').show();
            jQuery('.collective_page_map,.collective_map_text,.collective_map_zoom,.collective_select_slider_after_header,.collective_header_image').hide();
        }
        else if(options['collective_header_element']=='full_slider'){
            jQuery('.collective_select_slider_after_header').show();
            jQuery('.collective_page_map,.collective_map_text,.collective_map_zoom,.collective_select_slider,.collective_header_image').hide();
        }
        else if(options['collective_header_element']=='map'){
            jQuery('.collective_page_map,.collective_map_text,.collective_map_zoom').show();
            jQuery('.collective_select_slider_after_header,.collective_select_slider,.collective_header_image').hide();
        }
        else
            jQuery('.collective_page_map,.collective_map_text,.collective_map_zoom,.collective_select_slider_after_header,.collective_select_slider,.collective_header_image').hide();
        // category header option
        if(options['collective_header_element_cat']=='image'){
            jQuery('#collective_header_image_cat').parent().parent().parent().parent().parent().parent('.form-field').show();
            jQuery('#collective_page_map_cat_x').parent().parent().parent('.form-field').hide();
            jQuery('#collective_select_slider_cat,#collective_select_slider_after_header_cat,#collective_map_text_cat,#collective_map_zoom_cat').parent().parent('.form-field').hide();
        }
        else if(options['collective_header_element_cat']=='slider'){
            jQuery('#collective_header_image_cat').parent().parent().parent().parent().parent().parent('.form-field').hide();
            jQuery('#collective_page_map_cat_x').parent().parent().parent('.form-field').hide();
            jQuery('#collective_map_text_cat,#collective_map_zoom_cat,#collective_select_slider_after_header_cat').parent().parent('.form-field').hide();
            jQuery('#collective_select_slider_cat').parent().parent('.form-field').show();
        }
        else if(options['collective_header_element_cat']=='full_slider'){
            jQuery('#collective_header_image_cat').parent().parent().parent().parent().parent().parent('.form-field').hide();
            jQuery('#collective_page_map_cat_x').parent().parent().parent('.form-field').hide();
            jQuery('#collective_map_text_cat,#collective_map_zoom_cat,#collective_select_slider_cat').parent().parent('.form-field').hide();
            jQuery('#collective_select_slider_after_header_cat').parent().parent('.form-field').show();
        }
        else if(options['collective_header_element_cat']=='map'){
            jQuery('#collective_header_image_cat').parent().parent().parent().parent().parent().parent('.form-field').hide();
            jQuery('#collective_page_map_cat_x').parent().parent().parent('.form-field').show();
            jQuery('#collective_map_text_cat,#collective_map_zoom_cat').parent().parent('.form-field').show();
            jQuery('#collective_select_slider_cat,#collective_select_slider_after_header_cat').parent().parent('.form-field').hide();
        }
        else{
            jQuery('#collective_header_image_cat').parent().parent().parent().parent().parent().parent('.form-field').hide();
            jQuery('#collective_page_map_cat_x').parent().parent().parent('.form-field').hide();
            jQuery('#collective_select_slider_cat,#collective_select_slider_after_header_cat,#collective_map_text_cat,#collective_map_zoom_cat').parent().parent('.form-field').hide();
        }
        // post type
        if(options['collective_post_type']=='gallery'){
            jQuery('.collective_post_gallery').show();
            jQuery('.collective_single_image,.collective_single_img_dimensions,.collective_thumbnail_image,.collective_thumbnail_dimensions,.collective_video_link,.collective_video_dimensions').hide();
            jQuery('.collective_single_img_dimensions,.collective_thumbnail_dimensions').next().hide();
        }
        else{
            jQuery('.collective_post_gallery').hide();
            jQuery('.collective_single_image,.collective_single_img_dimensions,.collective_thumbnail_image,.collective_thumbnail_dimensions,.collective_video_link,.collective_video_dimensions').show();
            jQuery('.collective_single_img_dimensions,.collective_thumbnail_dimensions').next().show();
        }

        // general banners (fuse framework)
        jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7,.collective_bfcontent_ads_adsense7').hide();
        // hide number and type for single and page
        jQuery('.collective_bfcontent_type,.collective_bfcontent_number').hide();

        if(options['collective_bfcontent_type1']=='image'){
            // collective_bfcontent_type1 --- is for general banners (last tab in fuse framework)
            jQuery('.collective_bfcontent_type,.collective_bfcontent_number').show();
            if(options['collective_bfcontent_number']=='one'){
                jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1').show();
            }
            else if(options['collective_bfcontent_number']=='two'){
                jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2').show();
            }
            else if(options['collective_bfcontent_number']=='three'){
                jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3').show();
            }
            else if(options['collective_bfcontent_number']=='four'){
                jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4').show();
            }
            else if(options['collective_bfcontent_number']=='five'){
                jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5').show();
            }
            else if(options['collective_bfcontent_number']=='six'){
                jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6').show();
            }
            else if(options['collective_bfcontent_number']=='seven'){
                jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7').show();
            }
        }
        else if(options['collective_bfcontent_type1']=='adsense'){
            jQuery('.collective_bfcontent_type,.collective_bfcontent_number').show();
            if(options['collective_bfcontent_number']=='one'){
                jQuery('.collective_bfcontent_ads_adsense1').show();
            }
            else if(options['collective_bfcontent_number']=='two'){
                jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2').show();
            }
            else if(options['collective_bfcontent_number']=='three'){
                jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3').show();
            }
            else if(options['collective_bfcontent_number']=='four'){
                jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_adsense4').show();
            }
            else if(options['collective_bfcontent_number']=='five'){
                jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_adsense5').show();
            }
            else if(options['collective_bfcontent_number']=='six'){
                jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_adsense6').show();
            }
            else if(options['collective_bfcontent_number']=='seven'){
                jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_adsense7').show();
            }
        }
        //


        if(options['collective_bfcontent_ads_space']=='true')
        {
            jQuery('.collective_bfcontent_type,.collective_bfcontent_number').show();
            if(options['collective_bfcontent_type']=='image'){
                if(options['collective_bfcontent_number']=='one'){
                    jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1').show();
                }
                else if(options['collective_bfcontent_number']=='two'){
                    jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2').show();
                }
                else if(options['collective_bfcontent_number']=='three'){
                    jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3').show();
                }
                else if(options['collective_bfcontent_number']=='four'){
                    jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4').show();
                }
                else if(options['collective_bfcontent_number']=='five'){
                    jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5').show();
                }
                else if(options['collective_bfcontent_number']=='six'){
                    jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6').show();
                }
                else if(options['collective_bfcontent_number']=='seven'){
                    jQuery('.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7').show();
                }
            }
            else if(options['collective_bfcontent_type']=='adsense'){
                if(options['collective_bfcontent_number']=='one'){
                    jQuery('.collective_bfcontent_ads_adsense1').show();
                }
                else if(options['collective_bfcontent_number']=='two'){
                    jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2').show();
                }
                else if(options['collective_bfcontent_number']=='three'){
                    jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3').show();
                }
                else if(options['collective_bfcontent_number']=='four'){
                    jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_adsense4').show();
                }
                else if(options['collective_bfcontent_number']=='five'){
                    jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_adsense5').show();
                }
                else if(options['collective_bfcontent_number']=='six'){
                    jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_adsense6').show();
                }
                else if(options['collective_bfcontent_number']=='seven'){
                    jQuery('.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_adsense7').show();
                }
            }
        }

        // single page, post
        if(options['collective_top_ad_space']=='true')
            jQuery('.collective_top_ad_image,.collective_top_ad_url,.collective_top_ad_adsense').show();
        else
            jQuery('.collective_top_ad_image,.collective_top_ad_url,.collective_top_ad_adsense').hide();

        if(options['collective_hook_space']=='true')
            jQuery('.collective_hook_image,.collective_hook_url,.collective_hook_adsense').show();
        else
            jQuery('.collective_hook_image,.collective_hook_url,.collective_hook_adsense').hide();


        if(options['collective_homepage_category']=='specific'){
            jQuery('.collective_categories_select_tax,.collective_home_page,.collective_use_page_options,.collective_portfolio_column,.collective_show_filter').hide();
            jQuery('.collective_categories_select_categ').show();
            jQuery('#collective_page_title,#collective_header_element,#collective_home_top_ad_space,#collective_background_image').closest('.postbox').show();
        }
        else if(options['collective_homepage_category']=='specific_tax'){
            jQuery('.collective_home_page,.collective_use_page_options,.collective_categories_select_categ').hide();
            jQuery('.collective_categories_select_tax,.collective_portfolio_column,.collective_show_filter').show();
            jQuery('#collective_page_title,#collective_header_element,#collective_home_top_ad_space,#collective_background_image').closest('.postbox').show();
        }
        else if(options['collective_homepage_category']=='all_tax'){
            jQuery('.collective_categories_select_tax,.collective_home_page,.collective_use_page_options,.collective_categories_select_categ').hide();
            jQuery('.collective_portfolio_column,.collective_show_filter').show();
            jQuery('#collective_page_title,#collective_header_element,#collective_home_top_ad_space,#collective_background_image').closest('.postbox').show();
        }
        else if(options['collective_homepage_category']=='page'){
            jQuery('.collective_home_page,.collective_use_page_options').show();
            jQuery('.collective_categories_select_tax,.collective_categories_select_categ,.collective_portfolio_column,.collective_show_filter').hide();

            if(jQuery('#collective_use_page_options').is(':checked')) jQuery('#collective_page_title,#collective_header_element,#collective_home_top_ad_space,#collective_background_image').closest('.postbox').hide();
            jQuery('#collective_use_page_options').live('change',function () {
                if(jQuery(this).is(':checked'))
                    jQuery('#collective_page_title,#collective_header_element,#collective_home_top_ad_space,#collective_background_image').closest('.postbox').hide();
                else
                    jQuery('#collective_page_title,#collective_header_element,#collective_home_top_ad_space,#collective_background_image').closest('.postbox').show();
            });
        }
        else{
            jQuery('.collective_categories_select_tax,.collective_home_page,.collective_use_page_options,.collective_categories_select_categ,.collective_portfolio_column,.collective_show_filter').hide();
            jQuery('#collective_page_title,#collective_header_element,#collective_blog_top_ad_space,#collective_background_image').closest('.postbox').show();
        }

        if(options['collective_blogpage_category']=='specific'){
            jQuery('.collective_categories_select_categ_blog').show();
            jQuery('.collective_categories_select_tax_blog,.collective_portfolio_column_blog,.collective_show_filter_blog').hide();
        }
        else if(options['collective_blogpage_category']=='specific_tax'){
            jQuery('.collective_categories_select_tax_blog,.collective_portfolio_column_blog,.collective_show_filter_blog').show();
            jQuery('.collective_categories_select_categ_blog').hide();
        }
        else if(options['collective_blogpage_category']=='all_tax'){
            jQuery('.collective_portfolio_column_blog,.collective_show_filter_blog').show();
            jQuery('.collective_categories_select_categ_blog,.collective_categories_select_tax_blog').hide();
        }
        else{
            jQuery('.collective_categories_select_categ_blog,.collective_categories_select_tax_blog,.collective_portfolio_column_blog,.collective_show_filter_blog').hide();
        }

        // blog
        if(options['collective_header_element_blog'] == 'image'){
            jQuery('.collective_header_image_blog,.collective_header_title_blog').show();
            jQuery('.collective_select_slider_after_header_blog,.collective_select_slider_blog,.collective_page_map_blog,.collective_map_text_blog,.collective_map_zoom_blog').hide();
        }
        else if(options['collective_header_element_blog']=='slider'){
            jQuery('.collective_select_slider_blog').show();
            jQuery('.collective_select_slider_after_header_blog,.collective_header_image_blog,.collective_header_title_blog,.collective_page_map_blog,.collective_map_text_blog,.collective_map_zoom_blog').hide();
        }
        else if(options['collective_header_element_blog']=='full_slider'){
            jQuery('.collective_select_slider_after_header_blog').show();
            jQuery('.collective_select_slider_blog,.collective_header_image_blog,.collective_header_title_blog,.collective_page_map_blog,.collective_map_text_blog,.collective_map_zoom_blog').hide();
        }
        else if(options['collective_header_element_blog']=='map'){
            jQuery('.collective_page_map_blog,.collective_map_text_blog,.collective_map_zoom_blog').show();
            jQuery('.collective_select_slider_after_header_blog,.collective_header_image_blog,.collective_header_title_blog,.collective_select_slider_blog').hide();
        }
        else{
            jQuery('.collective_select_slider_after_header_blog,.collective_header_image_blog,.collective_header_title_blog,.collective_select_slider_blog,.collective_page_map_blog,.collective_map_text_blog,.collective_map_zoom_blog').hide();
        }
        if(options['collective_footer_element_blog']=='slider')
            jQuery('.collective_select_slider_footer_blog').show();
        else
            jQuery('.collective_select_slider_footer_blog').hide();
        // end blog


        // homepage banners ...
        if(options['collective_home_top_ad_space']=='true')
            jQuery('.collective_home_top_ad_image,.collective_home_top_ad_url,.collective_home_top_ad_adsense').show();
        else
            jQuery('.collective_home_top_ad_image,.collective_home_top_ad_url,.collective_home_top_ad_adsense').hide();

        if(options['collective_home_hook_space']=='true')
            jQuery('.collective_home_hook_image,.collective_home_hook_url,.collective_home_hook_adsense').show();
        else
            jQuery('.collective_home_hook_image,.collective_home_hook_url,.collective_home_hook_adsense').hide();

        jQuery('.collective_home_bfcontent_type,.collective_home_bfcontent_number,.collective_home_bfcontent_ads_image1,.collective_home_bfcontent_ads_url1,.collective_home_bfcontent_ads_adsense1,.collective_home_bfcontent_ads_image2,.collective_home_bfcontent_ads_url2,.collective_home_bfcontent_ads_adsense2,.collective_home_bfcontent_ads_image3,.collective_home_bfcontent_ads_url3,.collective_home_bfcontent_ads_adsense3,.collective_home_bfcontent_ads_image4,.collective_home_bfcontent_ads_url4,.collective_home_bfcontent_ads_adsense4,.collective_home_bfcontent_ads_image5,.collective_home_bfcontent_ads_url5,.collective_home_bfcontent_ads_adsense5,.collective_home_bfcontent_ads_image6,.collective_home_bfcontent_ads_url6,.collective_home_bfcontent_ads_adsense6,.collective_home_bfcontent_ads_image7,.collective_home_bfcontent_ads_url7,.collective_home_bfcontent_ads_adsense7').hide();
        if(options['collective_home_bfcontent_ads_space']=='true'){
            jQuery('.collective_home_bfcontent_type,.collective_home_bfcontent_number').show();
            if(options['collective_home_bfcontent_type']=='image'){
                if(options['collective_home_bfcontent_number']=='one'){
                    jQuery('.collective_home_bfcontent_ads_image1,.collective_home_bfcontent_ads_url1').show();
                }
                else if(options['collective_home_bfcontent_number']=='two'){
                    jQuery('.collective_home_bfcontent_ads_image1,.collective_home_bfcontent_ads_url1,.collective_home_bfcontent_ads_image2,.collective_home_bfcontent_ads_url2').show();
                }
                else if(options['collective_home_bfcontent_number']=='three'){
                    jQuery('.collective_home_bfcontent_ads_image1,.collective_home_bfcontent_ads_url1,.collective_home_bfcontent_ads_image2,.collective_home_bfcontent_ads_url2,.collective_home_bfcontent_ads_image3,.collective_home_bfcontent_ads_url3').show();
                }
                else if(options['collective_home_bfcontent_number']=='four'){
                    jQuery('.collective_home_bfcontent_ads_image1,.collective_home_bfcontent_ads_url1,.collective_home_bfcontent_ads_image2,.collective_home_bfcontent_ads_url2,.collective_home_bfcontent_ads_image3,.collective_home_bfcontent_ads_url3,.collective_home_bfcontent_ads_image4,.collective_home_bfcontent_ads_url4').show();
                }
                else if(options['collective_home_bfcontent_number']=='five'){
                    jQuery('.collective_home_bfcontent_ads_image1,.collective_home_bfcontent_ads_url1,.collective_home_bfcontent_ads_image2,.collective_home_bfcontent_ads_url2,.collective_home_bfcontent_ads_image3,.collective_home_bfcontent_ads_url3,.collective_home_bfcontent_ads_image4,.collective_home_bfcontent_ads_url4,.collective_home_bfcontent_ads_image5,.collective_home_bfcontent_ads_url5').show();
                }
                else if(options['collective_home_bfcontent_number']=='six'){
                    jQuery('.collective_home_bfcontent_ads_image1,.collective_home_bfcontent_ads_url1,.collective_home_bfcontent_ads_image2,.collective_home_bfcontent_ads_url2,.collective_home_bfcontent_ads_image3,.collective_home_bfcontent_ads_url3,.collective_home_bfcontent_ads_image4,.collective_home_bfcontent_ads_url4,.collective_home_bfcontent_ads_image5,.collective_home_bfcontent_ads_url5,.collective_home_bfcontent_ads_image6,.collective_home_bfcontent_ads_url6').show();
                }
                else if(options['collective_home_bfcontent_number']=='seven'){
                    jQuery('.collective_home_bfcontent_ads_image1,.collective_home_bfcontent_ads_url1,.collective_home_bfcontent_ads_image2,.collective_home_bfcontent_ads_url2,.collective_home_bfcontent_ads_image3,.collective_home_bfcontent_ads_url3,.collective_home_bfcontent_ads_image4,.collective_home_bfcontent_ads_url4,.collective_home_bfcontent_ads_image5,.collective_home_bfcontent_ads_url5,.collective_home_bfcontent_ads_image6,.collective_home_bfcontent_ads_url6,.collective_home_bfcontent_ads_image7,.collective_home_bfcontent_ads_url7').show();
                }
            }
            else{
                if(options['collective_home_bfcontent_number']=='one'){
                    jQuery('.collective_home_bfcontent_ads_adsense1').show();
                }
                else if(options['collective_home_bfcontent_number']=='two'){
                    jQuery('.collective_home_bfcontent_ads_adsense1,.collective_home_bfcontent_ads_adsense2').show();
                }
                else if(options['collective_home_bfcontent_number']=='three'){
                    jQuery('.collective_home_bfcontent_ads_adsense1,.collective_home_bfcontent_ads_adsense2,.collective_home_bfcontent_ads_adsense3').show();
                }
                else if(options['collective_home_bfcontent_number']=='four'){
                    jQuery('.collective_home_bfcontent_ads_adsense1,.collective_home_bfcontent_ads_adsense2,.collective_home_bfcontent_ads_adsense3,.collective_home_bfcontent_ads_adsense4').show();
                }
                else if(options['collective_home_bfcontent_number']=='five'){
                    jQuery('.collective_home_bfcontent_ads_adsense1,.collective_home_bfcontent_ads_adsense2,.collective_home_bfcontent_ads_adsense3,.collective_home_bfcontent_ads_adsense4,.collective_home_bfcontent_ads_adsense5').show();
                }
                else if(options['collective_home_bfcontent_number']=='six'){
                    jQuery('.collective_home_bfcontent_ads_adsense1,.collective_home_bfcontent_ads_adsense2,.collective_home_bfcontent_ads_adsense3,.collective_home_bfcontent_ads_adsense4,.collective_home_bfcontent_ads_adsense5,.collective_home_bfcontent_ads_adsense6').show();
                }
                else if(options['collective_home_bfcontent_number']=='seven'){
                    jQuery('.collective_home_bfcontent_ads_adsense1,.collective_home_bfcontent_ads_adsense2,.collective_home_bfcontent_ads_adsense3,.collective_home_bfcontent_ads_adsense4,.collective_home_bfcontent_ads_adsense5,.collective_home_bfcontent_ads_adsense6,.collective_home_bfcontent_ads_adsense7').show();
                }
            }
        }
        // end homepage

        // blog page
        if(options['collective_blog_top_ad_space']=='true')
            jQuery('.collective_blog_top_ad_image,.collective_blog_top_ad_url,.collective_blog_top_ad_adsense').show();
        else
            jQuery('.collective_blog_top_ad_image,.collective_blog_top_ad_url,.collective_blog_top_ad_adsense').hide();

        if(options['collective_blog_hook_space']=='true')
            jQuery('.collective_blog_hook_image,.collective_blog_hook_url,.collective_blog_hook_adsense').show();
        else
            jQuery('.collective_blog_hook_image,.collective_blog_hook_url,.collective_blog_hook_adsense').hide();

        jQuery('.collective_blog_bfcontent_type,.collective_blog_bfcontent_number,.collective_blog_bfcontent_ads_image1,.collective_blog_bfcontent_ads_url1,.collective_blog_bfcontent_ads_adsense1,.collective_blog_bfcontent_ads_image2,.collective_blog_bfcontent_ads_url2,.collective_blog_bfcontent_ads_adsense2,.collective_blog_bfcontent_ads_image3,.collective_blog_bfcontent_ads_url3,.collective_blog_bfcontent_ads_adsense3,.collective_blog_bfcontent_ads_image4,.collective_blog_bfcontent_ads_url4,.collective_blog_bfcontent_ads_adsense4,.collective_blog_bfcontent_ads_image5,.collective_blog_bfcontent_ads_url5,.collective_blog_bfcontent_ads_adsense5,.collective_blog_bfcontent_ads_image6,.collective_blog_bfcontent_ads_url6,.collective_blog_bfcontent_ads_adsense6,.collective_blog_bfcontent_ads_image7,.collective_blog_bfcontent_ads_url7,.collective_blog_bfcontent_ads_adsense7').hide();
        if(options['collective_blog_bfcontent_ads_space']=='true'){
            jQuery('.collective_blog_bfcontent_type,.collective_blog_bfcontent_number').show();
            if(options['collective_blog_bfcontent_type']=='image'){
                if(options['collective_blog_bfcontent_number']=='one'){
                    jQuery('.collective_blog_bfcontent_ads_image1,.collective_blog_bfcontent_ads_url1').show();
                }
                else if(options['collective_blog_bfcontent_number']=='two'){
                    jQuery('.collective_blog_bfcontent_ads_image1,.collective_blog_bfcontent_ads_url1,.collective_blog_bfcontent_ads_image2,.collective_blog_bfcontent_ads_url2').show();
                }
                else if(options['collective_blog_bfcontent_number']=='three'){
                    jQuery('.collective_blog_bfcontent_ads_image1,.collective_blog_bfcontent_ads_url1,.collective_blog_bfcontent_ads_image2,.collective_blog_bfcontent_ads_url2,.collective_blog_bfcontent_ads_image3,.collective_blog_bfcontent_ads_url3').show();
                }
                else if(options['collective_blog_bfcontent_number']=='four'){
                    jQuery('.collective_blog_bfcontent_ads_image1,.collective_blog_bfcontent_ads_url1,.collective_blog_bfcontent_ads_image2,.collective_blog_bfcontent_ads_url2,.collective_blog_bfcontent_ads_image3,.collective_blog_bfcontent_ads_url3,.collective_blog_bfcontent_ads_image4,.collective_blog_bfcontent_ads_url4').show();
                }
                else if(options['collective_blog_bfcontent_number']=='five'){
                    jQuery('.collective_blog_bfcontent_ads_image1,.collective_blog_bfcontent_ads_url1,.collective_blog_bfcontent_ads_image2,.collective_blog_bfcontent_ads_url2,.collective_blog_bfcontent_ads_image3,.collective_blog_bfcontent_ads_url3,.collective_blog_bfcontent_ads_image4,.collective_blog_bfcontent_ads_url4,.collective_blog_bfcontent_ads_image5,.collective_blog_bfcontent_ads_url5').show();
                }
                else if(options['collective_blog_bfcontent_number']=='six'){
                    jQuery('.collective_blog_bfcontent_ads_image1,.collective_blog_bfcontent_ads_url1,.collective_blog_bfcontent_ads_image2,.collective_blog_bfcontent_ads_url2,.collective_blog_bfcontent_ads_image3,.collective_blog_bfcontent_ads_url3,.collective_blog_bfcontent_ads_image4,.collective_blog_bfcontent_ads_url4,.collective_blog_bfcontent_ads_image5,.collective_blog_bfcontent_ads_url5,.collective_blog_bfcontent_ads_image6,.collective_blog_bfcontent_ads_url6').show();
                }
                else if(options['collective_blog_bfcontent_number']=='seven'){
                    jQuery('.collective_blog_bfcontent_ads_image1,.collective_blog_bfcontent_ads_url1,.collective_blog_bfcontent_ads_image2,.collective_blog_bfcontent_ads_url2,.collective_blog_bfcontent_ads_image3,.collective_blog_bfcontent_ads_url3,.collective_blog_bfcontent_ads_image4,.collective_blog_bfcontent_ads_url4,.collective_blog_bfcontent_ads_image5,.collective_blog_bfcontent_ads_url5,.collective_blog_bfcontent_ads_image6,.collective_blog_bfcontent_ads_url6,.collective_blog_bfcontent_ads_image7,.collective_blog_bfcontent_ads_url7').show();
                }
            }
            else{
                if(options['collective_blog_bfcontent_number']=='one'){
                    jQuery('.collective_blog_bfcontent_ads_adsense1').show();
                }
                else if(options['collective_blog_bfcontent_number']=='two'){
                    jQuery('.collective_blog_bfcontent_ads_adsense1,.collective_blog_bfcontent_ads_adsense2').show();
                }
                else if(options['collective_blog_bfcontent_number']=='three'){
                    jQuery('.collective_blog_bfcontent_ads_adsense1,.collective_blog_bfcontent_ads_adsense2,.collective_blog_bfcontent_ads_adsense3').show();
                }
                else if(options['collective_blog_bfcontent_number']=='four'){
                    jQuery('.collective_blog_bfcontent_ads_adsense1,.collective_blog_bfcontent_ads_adsense2,.collective_blog_bfcontent_ads_adsense3,.collective_blog_bfcontent_ads_adsense4').show();
                }
                else if(options['collective_blog_bfcontent_number']=='five'){
                    jQuery('.collective_blog_bfcontent_ads_adsense1,.collective_blog_bfcontent_ads_adsense2,.collective_blog_bfcontent_ads_adsense3,.collective_blog_bfcontent_ads_adsense4,.collective_blog_bfcontent_ads_adsense5').show();
                }
                else if(options['collective_blog_bfcontent_number']=='six'){
                    jQuery('.collective_blog_bfcontent_ads_adsense1,.collective_blog_bfcontent_ads_adsense2,.collective_blog_bfcontent_ads_adsense3,.collective_blog_bfcontent_ads_adsense4,.collective_blog_bfcontent_ads_adsense5,.collective_blog_bfcontent_ads_adsense6').show();
                }
                else if(options['collective_blog_bfcontent_number']=='seven'){
                    jQuery('.collective_blog_bfcontent_ads_adsense1,.collective_blog_bfcontent_ads_adsense2,.collective_blog_bfcontent_ads_adsense3,.collective_blog_bfcontent_ads_adsense4,.collective_blog_bfcontent_ads_adsense5,.collective_blog_bfcontent_ads_adsense6,.collective_blog_bfcontent_ads_adsense7').show();
                }
            }
        }
        // end blog page


        // for categories and taxonomies
        if(options['collective_top_ad_space']=='true')
            jQuery('#collective_top_ad_image,#collective_top_ad_url,#collective_top_ad_adsense').parents('.tfuse-tax-form-field').show();
        else
            jQuery('#collective_top_ad_image,#collective_top_ad_url,#collective_top_ad_adsense').parents('.tfuse-tax-form-field').hide();

        if(options['collective_hook_space']=='true')
            jQuery('#collective_hook_image,#collective_hook_url,#collective_hook_adsense').parents('.tfuse-tax-form-field').show();
        else
            jQuery('#collective_hook_image,#collective_hook_url,#collective_hook_adsense').parents('.tfuse-tax-form-field').hide();

        jQuery('#collective_bfcontent_type,#collective_bfcontent_number,#collective_bfcontent_ads_image1,#collective_bfcontent_ads_url1,#collective_bfcontent_ads_adsense1,#collective_bfcontent_ads_image2,#collective_bfcontent_ads_url2,#collective_bfcontent_ads_adsense2,#collective_bfcontent_ads_image3,#collective_bfcontent_ads_url3,#collective_bfcontent_ads_adsense3,#collective_bfcontent_ads_image4,#collective_bfcontent_ads_url4,#collective_bfcontent_ads_adsense4,#collective_bfcontent_ads_image5,#collective_bfcontent_ads_url5,#collective_bfcontent_ads_adsense5,#collective_bfcontent_ads_image6,#collective_bfcontent_ads_url6,#collective_bfcontent_ads_adsense6,#collective_bfcontent_ads_image7,#collective_bfcontent_ads_url7,#collective_bfcontent_ads_adsense7').parents('.tfuse-tax-form-field').hide();
        if(options['collective_bfcontent_ads_space']=='true')
        {
            jQuery('#collective_bfcontent_type,#collective_bfcontent_number').parents('.tfuse-tax-form-field').show();
            if(options['collective_bfcontent_type1']=='image' || options['collective_bfcontent_type']=='image'){
                if(options['collective_bfcontent_number']=='one'){
                    jQuery('#collective_bfcontent_ads_image1,#collective_bfcontent_ads_url1').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='two'){
                    jQuery('#collective_bfcontent_ads_image1,#collective_bfcontent_ads_url1,#collective_bfcontent_ads_image2,#collective_bfcontent_ads_url2').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='three'){
                    jQuery('#collective_bfcontent_ads_image1,#collective_bfcontent_ads_url1,#collective_bfcontent_ads_image2,#collective_bfcontent_ads_url2,#collective_bfcontent_ads_image3,#collective_bfcontent_ads_url3').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='four'){
                    jQuery('#collective_bfcontent_ads_image1,#collective_bfcontent_ads_url1,#collective_bfcontent_ads_image2,#collective_bfcontent_ads_url2,#collective_bfcontent_ads_image3,#collective_bfcontent_ads_url3,#collective_bfcontent_ads_image4,#collective_bfcontent_ads_url4').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='five'){
                    jQuery('#collective_bfcontent_ads_image1,#collective_bfcontent_ads_url1,#collective_bfcontent_ads_image2,#collective_bfcontent_ads_url2,#collective_bfcontent_ads_image3,#collective_bfcontent_ads_url3,#collective_bfcontent_ads_image4,#collective_bfcontent_ads_url4,#collective_bfcontent_ads_image5,#collective_bfcontent_ads_url5').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='six'){
                    jQuery('#collective_bfcontent_ads_image1,#collective_bfcontent_ads_url1,#collective_bfcontent_ads_image2,#collective_bfcontent_ads_url2,#collective_bfcontent_ads_image3,#collective_bfcontent_ads_url3,#collective_bfcontent_ads_image4,#collective_bfcontent_ads_url4,#collective_bfcontent_ads_image5,#collective_bfcontent_ads_url5,#collective_bfcontent_ads_image6,#collective_bfcontent_ads_url6').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='seven'){
                    jQuery('#collective_bfcontent_ads_image1,#collective_bfcontent_ads_url1,#collective_bfcontent_ads_image2,#collective_bfcontent_ads_url2,#collective_bfcontent_ads_image3,#collective_bfcontent_ads_url3,#collective_bfcontent_ads_image4,#collective_bfcontent_ads_url4,#collective_bfcontent_ads_image5,#collective_bfcontent_ads_url5,#collective_bfcontent_ads_image6,#collective_bfcontent_ads_url6,#collective_bfcontent_ads_image7,#collective_bfcontent_ads_url7').parents('.tfuse-tax-form-field').show();
                }
            }
            else{
                if(options['collective_bfcontent_number']=='one'){
                    jQuery('#collective_bfcontent_ads_adsense1').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='two'){
                    jQuery('#collective_bfcontent_ads_adsense1,#collective_bfcontent_ads_adsense2').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='three'){
                    jQuery('#collective_bfcontent_ads_adsense1,#collective_bfcontent_ads_adsense2,#collective_bfcontent_ads_adsense3').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='four'){
                    jQuery('#collective_bfcontent_ads_adsense1,#collective_bfcontent_ads_adsense2,#collective_bfcontent_ads_adsense3,#collective_bfcontent_ads_adsense4').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='five'){
                    jQuery('#collective_bfcontent_ads_adsense1,#collective_bfcontent_ads_adsense2,#collective_bfcontent_ads_adsense3,#collective_bfcontent_ads_adsense4,#collective_bfcontent_ads_adsense5').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='six'){
                    jQuery('#collective_bfcontent_ads_adsense1,#collective_bfcontent_ads_adsense2,#collective_bfcontent_ads_adsense3,#collective_bfcontent_ads_adsense4,#collective_bfcontent_ads_adsense5,#collective_bfcontent_ads_adsense6').parents('.tfuse-tax-form-field').show();
                }
                else if(options['collective_bfcontent_number']=='seven'){
                    jQuery('#collective_bfcontent_ads_adsense1,#collective_bfcontent_ads_adsense2,#collective_bfcontent_ads_adsense3,#collective_bfcontent_ads_adsense4,#collective_bfcontent_ads_adsense5,#collective_bfcontent_ads_adsense6,#collective_bfcontent_ads_adsense7').parents('.tfuse-tax-form-field').show();
                }
            }
        }

        // page elements - collective archives
        if(options['collective_page_title_all']=='custom_title')
            jQuery('.collective_custom_title_all,.collective_custom_subtitle_all,.collective_subtitle_alignment_all').show();
        else
            jQuery('.collective_custom_title_all,.collective_custom_subtitle_all,.collective_subtitle_alignment_all').hide();

        if(options['collective_header_element_port_archive']=='image'){
            jQuery('.collective_header_image_port_archive').show();
            jQuery('.collective_select_slider_port_archive,.collective_select_slider_after_header_port_archive,.collective_page_map_port_archive,.collective_map_text_port_archive,.collective_map_zoom_port_archive').hide();
        }
        else if(options['collective_header_element_port_archive']=='slider'){
            jQuery('.collective_select_slider_port_archive').show();
            jQuery('.collective_header_image_port_archive,.collective_select_slider_after_header_port_archive,.collective_page_map_port_archive,.collective_map_text_port_archive,.collective_map_zoom_port_archive').hide();
        }
        else if(options['collective_header_element_port_archive']=='full_slider'){
            jQuery('.collective_select_slider_after_header_port_archive').show();
            jQuery('.collective_header_image_port_archive,.collective_select_slider_port_archive,.collective_page_map_port_archive,.collective_map_text_port_archive,.collective_map_zoom_port_archive').hide();
        }
        else if(options['collective_header_element_port_archive']=='map'){
            jQuery('.collective_page_map_port_archive,.collective_map_text_port_archive,.collective_map_zoom_port_archive').show();
            jQuery('.collective_header_image_port_archive,.collective_select_slider_port_archive,.collective_select_slider_after_header_port_archive').hide();
        }
        else{
            jQuery('.collective_header_image_port_archive,.collective_select_slider_port_archive,.collective_select_slider_after_header_port_archive,.collective_page_map_port_archive,.collective_map_text_port_archive,.collective_map_zoom_port_archive').hide();
        }

        if(options['collective_footer_element_port_archive']=='slider')
            jQuery('.collective_select_slider_footer_port_archive').show();
        else
            jQuery('.collective_select_slider_footer_port_archive').hide();

        // page elements - search
        if(options['collective_page_title_search']=='custom_title')
            jQuery('.collective_custom_title_search,.collective_custom_subtitle_search,.collective_subtitle_alignment_search').show();
        else
            jQuery('.collective_custom_title_search,.collective_custom_subtitle_search,.collective_subtitle_alignment_search').hide();

        if(options['collective_header_element_search']=='image'){
            jQuery('.collective_header_image_search').show();
            jQuery('.collective_select_slider_search,.collective_select_slider_after_header_search,.collective_page_map_search,.collective_map_text_search,.collective_map_zoom_search').hide();
        }
        else if(options['collective_header_element_search']=='slider'){
            jQuery('.collective_select_slider_search').show();
            jQuery('.collective_header_image_search,.collective_select_slider_after_header_search,.collective_page_map_search,.collective_map_text_search,.collective_map_zoom_search').hide();
        }
        else if(options['collective_header_element_search']=='full_slider'){
            jQuery('.collective_select_slider_after_header_search').show();
            jQuery('.collective_header_image_search,.collective_select_slider_search,.collective_page_map_search,.collective_map_text_search,.collective_map_zoom_search').hide();
        }
        else if(options['collective_header_element_search']=='map'){
            jQuery('.collective_page_map_search,.collective_map_text_search,.collective_map_zoom_search').show();
            jQuery('.collective_header_image_search,.collective_select_slider_search,.collective_select_slider_after_header_search').hide();
        }
        else{
            jQuery('.collective_header_image_search,.collective_select_slider_search,.collective_select_slider_after_header_search,.collective_page_map_search,.collective_map_text_search,.collective_map_zoom_search').hide();
        }

        if(options['collective_footer_element_search']=='slider')
            jQuery('.collective_select_slider_footer_search').show();
        else
            jQuery('.collective_select_slider_footer_search').hide();

        // page elements - 404
        if(options['collective_page_title_404']=='custom_title')
            jQuery('.collective_custom_title_404,.collective_custom_subtitle_404,.collective_subtitle_alignment_404').show();
        else
            jQuery('.collective_custom_title_404,.collective_custom_subtitle_404,.collective_subtitle_alignment_404').hide();

        if(options['collective_header_element_404']=='image'){
            jQuery('.collective_header_image_404').show();
            jQuery('.collective_select_slider_404,.collective_select_slider_after_header_404,.collective_page_map_404,.collective_map_text_404,.collective_map_zoom_404').hide();
        }
        else if(options['collective_header_element_404']=='slider'){
            jQuery('.collective_select_slider_404').show();
            jQuery('.collective_header_image_404,.collective_select_slider_after_header_404,.collective_page_map_404,.collective_map_text_404,.collective_map_zoom_404').hide();
        }
        else if(options['collective_header_element_404']=='full_slider'){
            jQuery('.collective_select_slider_after_header_404').show();
            jQuery('.collective_header_image_404,.collective_select_slider_404,.collective_page_map_404,.collective_map_text_404,.collective_map_zoom_404').hide();
        }
        else if(options['collective_header_element_404']=='map'){
            jQuery('.collective_page_map_404,.collective_map_text_404,.collective_map_zoom_404').show();
            jQuery('.collective_header_image_404,.collective_select_slider_404,.collective_select_slider_after_header_404').hide();
        }
        else{
            jQuery('.collective_header_image_404,.collective_select_slider_404,.collective_select_slider_after_header_404,.collective_page_map_404,.collective_map_text_404,.collective_map_zoom_404').hide();
        }

        if(options['collective_footer_element_404']=='slider')
            jQuery('.collective_select_slider_footer_404').show();
        else
            jQuery('.collective_select_slider_footer_404').hide();

        // page elements - tag
        if(options['collective_page_title_tag']=='custom_title')
            jQuery('.collective_custom_title_tag,.collective_custom_subtitle_tag,.collective_subtitle_alignment_tag').show();
        else
            jQuery('.collective_custom_title_tag,.collective_custom_subtitle_tag,.collective_subtitle_alignment_tag').hide();

        if(options['collective_header_element_tag']=='image'){
            jQuery('.collective_header_image_tag').show();
            jQuery('.collective_select_slider_tag,.collective_select_slider_after_header_tag,.collective_page_map_tag,.collective_map_text_tag,.collective_map_zoom_tag').hide();
        }
        else if(options['collective_header_element_tag']=='slider'){
            jQuery('.collective_select_slider_tag').show();
            jQuery('.collective_header_image_tag,.collective_select_slider_after_header_tag,.collective_page_map_tag,.collective_map_text_tag,.collective_map_zoom_tag').hide();
        }
        else if(options['collective_header_element_tag']=='full_slider'){
            jQuery('.collective_select_slider_after_header_tag').show();
            jQuery('.collective_header_image_tag,.collective_select_slider_tag,.collective_page_map_tag,.collective_map_text_tag,.collective_map_zoom_tag').hide();
        }
        else if(options['collective_header_element_tag']=='map'){
            jQuery('.collective_page_map_tag,.collective_map_text_tag,.collective_map_zoom_tag').show();
            jQuery('.collective_header_image_tag,.collective_select_slider_tag,.collective_select_slider_after_header_tag').hide();
        }
        else{
            jQuery('.collective_header_image_tag,.collective_select_slider_tag,.collective_select_slider_after_header_tag,.collective_page_map_tag,.collective_map_text_tag,.collective_map_zoom_tag').hide();
        }

        if(options['collective_footer_element_tag']=='slider')
            jQuery('.collective_select_slider_footer_tag').show();
        else
            jQuery('.collective_select_slider_footer_tag').hide();

        // page elements - archive
        if(options['collective_page_title_archive']=='custom_title')
            jQuery('.collective_custom_title_archive,.collective_custom_subtitle_archive,.collective_subtitle_alignment_archive').show();
        else
            jQuery('.collective_custom_title_archive,.collective_custom_subtitle_archive,.collective_subtitle_alignment_archive').hide();

        if(options['collective_header_element_archive']=='image'){
            jQuery('.collective_header_image_archive').show();
            jQuery('.collective_select_slider_archive,.collective_select_slider_after_header_archive,.collective_page_map_archive,.collective_map_text_archive,.collective_map_zoom_archive').hide();
        }
        else if(options['collective_header_element_archive']=='slider'){
            jQuery('.collective_select_slider_archive').show();
            jQuery('.collective_header_image_archive,.collective_select_slider_after_header_archive,.collective_page_map_archive,.collective_map_text_archive,.collective_map_zoom_archive').hide();
        }
        else if(options['collective_header_element_archive']=='full_slider'){
            jQuery('.collective_select_slider_after_header_archive').show();
            jQuery('.collective_header_image_archive,.collective_select_slider_archive,.collective_page_map_archive,.collective_map_text_archive,.collective_map_zoom_archive').hide();
        }
        else if(options['collective_header_element_archive']=='map'){
            jQuery('.collective_page_map_archive,.collective_map_text_archive,.collective_map_zoom_archive').show();
            jQuery('.collective_header_image_archive,.collective_select_slider_archive,.collective_select_slider_after_header_archive').hide();
        }
        else{
            jQuery('.collective_header_image_archive,.collective_select_slider_archive,.collective_select_slider_after_header_archive,.collective_page_map_archive,.collective_map_text_archive,.collective_map_zoom_archive').hide();
        }

        if(options['collective_footer_element_archive']=='slider')
            jQuery('.collective_select_slider_footer_archive').show();
        else
            jQuery('.collective_select_slider_footer_archive').hide();

    }


    // single post checkbox
    from_category = jQuery('#collective_content_ads_post');
    if(from_category.is(':checked')){
        jQuery('.collective_top_ad_image,.collective_top_ad_url,.collective_top_ad_adsense,.collective_top_ad_space,.collective_hook_space,.collective_hook_image,.collective_hook_url,.collective_hook_adsense,.collective_bfcontent_ads_space,.collective_bfcontent_type,.collective_bfcontent_number,.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7,.collective_bfcontent_ads_adsense7').hide();
        jQuery('.collective_content_ads_post,.collective_top_ad_adsense,.collective_bfcontent_ads_adsense7').next().hide();
    }
    else {
        tfuse_toggle_options(options);
        jQuery('.collective_content_ads_post,.collective_top_ad_adsense,.collective_bfcontent_ads_adsense7').next().show();
    }

    from_category.live('change',function () {
        if(jQuery(this).is(':checked')){
            jQuery('.collective_top_ad_image,.collective_top_ad_url,.collective_top_ad_adsense,.collective_top_ad_space,.collective_hook_space,.collective_hook_image,.collective_hook_url,.collective_hook_adsense,.collective_bfcontent_ads_space,.collective_bfcontent_type,.collective_bfcontent_number,.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7,.collective_bfcontent_ads_adsense7').hide();
            jQuery('.collective_content_ads_post,.collective_top_ad_adsense,.collective_bfcontent_ads_adsense7').next().hide();
        }
        else{
            jQuery('.collective_top_ad_image,.collective_top_ad_url,.collective_top_ad_adsense,.collective_top_ad_space,.collective_hook_space,.collective_hook_image,.collective_hook_url,.collective_hook_adsense,.collective_bfcontent_ads_space,.collective_bfcontent_type,.collective_bfcontent_number,.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7,.collective_bfcontent_ads_adsense7').show();
            tfuse_toggle_options(options);
            jQuery('.collective_content_ads_post,.collective_top_ad_adsense,.collective_bfcontent_ads_adsense7').next().show();
        }
    });

    // general 125 banners checkbox (framework)
    from_general3 = jQuery('#collective_bfc_ads_space');
    if(from_general3.is(':checked')){
        if( adminpage=='toplevel_page_themefuse')tfuse_toggle_options(options);
    }
    else if( adminpage=='toplevel_page_themefuse'){
        jQuery('.collective_bfcontent_type1,.collective_bfcontent_number,.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7,.collective_bfcontent_ads_adsense7').hide();
    }

    from_general3.live('change',function () {
        if(jQuery(this).is(':checked')){
            jQuery('.collective_bfcontent_type1,.collective_bfcontent_number,.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7,.collective_bfcontent_ads_adsense7').show();
            if( adminpage=='toplevel_page_themefuse')tfuse_toggle_options(options);
        }
        else if( adminpage=='toplevel_page_themefuse'){
            jQuery('.collective_bfcontent_type1,.collective_bfcontent_number,.collective_bfcontent_ads_image1,.collective_bfcontent_ads_url1,.collective_bfcontent_ads_adsense1,.collective_bfcontent_ads_image2,.collective_bfcontent_ads_url2,.collective_bfcontent_ads_adsense2,.collective_bfcontent_ads_image3,.collective_bfcontent_ads_url3,.collective_bfcontent_ads_adsense3,.collective_bfcontent_ads_image4,.collective_bfcontent_ads_url4,.collective_bfcontent_ads_adsense4,.collective_bfcontent_ads_image5,.collective_bfcontent_ads_url5,.collective_bfcontent_ads_adsense5,.collective_bfcontent_ads_image6,.collective_bfcontent_ads_url6,.collective_bfcontent_ads_adsense6,.collective_bfcontent_ads_image7,.collective_bfcontent_ads_url7,.collective_bfcontent_ads_adsense7').hide();
        }
    });

});