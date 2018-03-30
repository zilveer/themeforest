jQuery(document).ready(function($) {
    $('.mom_meta_color').wpColorPicker({
        palettes: ['#fff','#000','#78bce7', '#88d46d', '#e7be78', '#e77878', '#e778b9']
    });
    
    
//meta group Expand
$('.mmg-item .mmmg-head').on('click', function(e) {
    if (e.target === this) {
        $(this).next('.mmg-content').slideToggle(250);
        var expand = $(this).find('.edit-ad i');
        if (expand.hasClass('momizat-icon-plus')) {
            expand.removeClass().addClass('momizat-icon-minus');
        } else {
            expand.removeClass().addClass('momizat-icon-plus');
        }
    }
});

$('.mmg-item .mmmg-head .edit-ad').on('click', function(e) {
        e.preventDefault();
        $(this).parent().parent().next('.mmg-content').slideToggle(250);
        var expand = $('i', this);
        if (expand.hasClass('momizat-icon-plus')) {
            expand.removeClass().addClass('momizat-icon-minus');
        } else {
            expand.removeClass().addClass('momizat-icon-plus');
        }
});


// remove previwe image
$('.mom_preview_meta_img').each(function() {
    var img = $(this).parent().find('.mom_preview_meta_input').val();
    $(this).find('img').attr('src', img);
    if(img === '') {
        $(this).find('.mti_remove_img').hide();
    }
});

$('.mti_remove_img').click(function(e) {
    e.preventDefault();
    $(this).parent().find('img').attr('src', '');
    $(this).parent().parent().find('.mom_preview_meta_input').val('');
    $(this).parent().parent().find('.mom_full_meta_input').val('');
    $(this).hide();
});

//date input
$('.mom-metabox-date').datepicker();

//posts extra
    $('#post-formats-select input[name="post_format"]').change( function() {
        var val = $(this).val();
       if ( val === 'gallery') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_slider_meta').fadeIn();
       } else if (val === 'video') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_video_url').fadeIn();
       }  else if (val === 'audio') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_audio_st').fadeIn();
       } else if (val === 'aside') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_aside_st').fadeIn();
       } else if (val === 'status') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_status_st').fadeIn();
       } else if (val === 'link') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_link_st').fadeIn();
       } else if (val === 'chat') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_chat_st').fadeIn();
       } else {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .posts_extra_empty').fadeIn();
       }
       if ( val === 'gallery') {
        $('#mom_gallery_post_setting').fadeIn();
       } else {
        $('#mom_gallery_post_setting').fadeOut();
       }
    });
    var val = $('#post-formats-select input[name="post_format"]:checked').val();
       if ( val === 'gallery') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_slider_meta').fadeIn();
       } else if (val === 'video') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_video_url').fadeIn();
       }  else if (val === 'audio') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_audio_st').fadeIn();
       } else if (val === 'aside') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_aside_st').fadeIn();
       } else if (val === 'status') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_status_st').fadeIn();
       } else if (val === 'link') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_link_st').fadeIn();
       } else if (val === 'chat') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_chat_st').fadeIn();
       } else {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .posts_extra_empty').fadeIn();
       }
       
       if ( val === 'gallery') {
        $('#mom_gallery_post_setting').fadeIn();
       } else {
        $('#mom_gallery_post_setting').fadeOut();
       }


    $('select[name="mom_posts_extra[video_type]"]').change( function() {
        var val = $(this).val();
       if ( val === 'html5') {
        $('.html5_video').fadeIn();
        $('.external_video').fadeOut();
       } else {
        $('.external_video').fadeIn();
        $('.html5_video').fadeOut();
        
       }
    });

    var val_v = $('select[name="mom_posts_extra[video_type]"]').val();
       if ( val_v === 'html5') {
        $('.html5_video').fadeIn();
        $('.external_video').fadeOut();
       } else {
        $('.external_video').fadeIn();
        $('.html5_video').fadeOut();
        
       }
//Audio
    $('select[name="mom_posts_extra[audio_type]"]').change( function() {
        var val = $(this).val();
       if ( val === 'html5') {
        $('.html5_audio').fadeIn();
        $('.external_audio').fadeOut();
       } else {
        $('.external_audio').fadeIn();
        $('.html5_audio').fadeOut();
        
       }
    });

    var val_v = $('select[name="mom_posts_extra[audio_type]"]').val();
       if ( val_v === 'html5') {
        $('.html5_audio').fadeIn();
        $('.external_audio').fadeOut();
       } else {
        $('.external_audio').fadeIn();
        $('.html5_audio').fadeOut();
        
       }


}); 