function custom_generator_services_slider(type,options) {
    shortcode='[services_slider title="'+options['title']+'"]';
    for(i in options.array) {
        shortcode+='[service_slide service="'+options.array[i]['service']+'"]'+options.array[i]['background']+'[/service_slide]';
    }
    shortcode+='[/services_slider]';
    return shortcode;
}

function custom_obtainer_services_slider(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']= opt_get('tf_shc_services_slider_title',cont);
    cont.find('[name="tf_shc_services_slider_service"]').each(function(i) {
        div=jQuery(this).parents('.option');
        service=opt_get(jQuery(this).attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_services_slider_background"]').first().parents('.option');
        background=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_services_slider_background"]').first().attr('name'),div);
        tmp={};
        tmp['service']=service;
        tmp['background']=background;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

function custom_generator_technologies(type,options) {
    shortcode='[technologies title="'+options['title']+'"]';
    for(i in options.array) {
        shortcode+='[technology link="'+options.array[i]['link']+'"]'+options.array[i]['image']+'[/technology]';
    }
    shortcode+='[/technologies]';
    return shortcode;
}

function custom_obtainer_technologies(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']= opt_get('tf_shc_technologies_title',cont);
    cont.find('[name="tf_shc_technologies_image"]').each(function(i) {
        div=jQuery(this).parents('.option');
        image=opt_get(jQuery(this).attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_technologies_link"]').first().parents('.option');
        link=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_technologies_link"]').first().attr('name'),div);
        tmp={};
        tmp['image']=image;
        tmp['link']=link;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

function custom_generator_progressbar(type,options) {
    shortcode='[progressbar title="'+options['title']+'"]';
    for(i in options.array) {
        shortcode+='[bar_tab name="'+options.array[i]['name']+'"]'+options.array[i]['percentage']+'[/bar_tab]';
    }
    shortcode+='[/progressbar]';
    return shortcode;
}

function custom_obtainer_progressbar(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']= opt_get('tf_shc_progressbar_title',cont);
    cont.find('[name="tf_shc_progressbar_name"]').each(function(i) {
        div=jQuery(this).parents('.option');
        name=opt_get(jQuery(this).attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_progressbar_percentage"]').first().parents('.option');
        percentage=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_progressbar_percentage"]').first().attr('name'),div);
        tmp={};
        tmp['name']=name;
        tmp['percentage']=percentage;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

function custom_generator_tabs(type,options) {
    shortcode='[tabs class="'+options['class']+'"]';
    for(i in options.array) {
        shortcode+='[tab title="'+options.array[i]['title']+'"]'+options.array[i]['content']+'[/tab]';
    }
    shortcode+='[/tabs]';
    return shortcode;
}

function custom_obtainer_tabs(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['class']= opt_get('tf_shc_tabs_class',cont);
    cont.find('[name="tf_shc_tabs_title"]').each(function(i) {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().attr('name'),div);
        tmp={};
        tmp['title']=title;
        tmp['content']=content;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

function custom_generator_history(type,options) {
    shortcode='[history title="'+options['title']+'"]';
    for(i in options.array) {
        shortcode+='[history_item name="'+options.array[i]['name']+'" year="'+options.array[i]['year']+'"]'+options.array[i]['content']+'[/history_item]';
    }
    shortcode+='[/history]';
    return shortcode;
}

function custom_obtainer_history(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']= opt_get('tf_shc_history_title',cont);
    cont.find('[name="tf_shc_history_name"]').each(function(i) {
        div=jQuery(this).parents('.option');
        name=opt_get(jQuery(this).attr('name'),div);
        div1=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_history_year"]').first().parents('.option');
        year=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_history_year"]').first().attr('name'),div1);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_history_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_history_content"]').first().attr('name'),div);
        tmp={};
        tmp['name']=name;
        tmp['year']=year;
        tmp['content']=content;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

function custom_generator_accordion(type,options) {
    shortcode='[accordion title="'+options['title']+'"]';
    for(i in options.array) {
        shortcode+='[ac_tab name="'+options.array[i]['name']+'" post="'+options.array[i]['post']+'"]'+options.array[i]['content']+'[/ac_tab]';
    }
    shortcode+='[/accordion]';
    return shortcode;
}

function custom_obtainer_accordion(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']= opt_get('tf_shc_accordion_title',cont);
    cont.find('[name="tf_shc_accordion_name"]').each(function(i) {
        div=jQuery(this).parents('.option');
        name=opt_get(jQuery(this).attr('name'),div);
        div1=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_accordion_post"]').first().parents('.option');
        post=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_accordion_post"]').first().attr('name'),div1);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_accordion_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_accordion_content"]').first().attr('name'),div);
        tmp={};
        tmp['name']=name;
        tmp['post']=post;
        tmp['content']=content;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

jQuery(document).ready(function($) {
    var $=jQuery;

    $('#tf_shc_prettyPhoto_type').live('change',function () {
        val = $(this).val();
        if(val !='image')
            $('.tf_shc_prettyPhoto_thumb').hide();
        else
            $('.tf_shc_prettyPhoto_thumb').show();
    });

    $('#tf_shc_text_styles_type').live('change',function () {
        val = $(this).val();
        if(val !='link')
            $('.tf_shc_text_styles_link,.tf_shc_text_styles_target').hide();
        else
            $('.tf_shc_text_styles_link,.tf_shc_text_styles_target').show();
    });
});
