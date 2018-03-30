<?php 
/*
Template Name: Home Page
*/
?>
<?php
$customize = get_options();
if($customize == ''){
    global $options_extra;
    $customize = $options_extra;
}
$is_customize_mode =  (has_action( 'customize_controls_init' )) ? true : false;
?>
<?php get_header();?>

<?php get_template_part('section-introduction');?>

<div id="content-sort">
<?php
    if(!empty($customize['sort_section']))
    {
        $sections = explode(',',$customize['sort_section']);
       
        $section_default = array('about','service','funfact','team','skill','portfolio','idea','twitter','pricing','lastedpost','client','testimonial','contact','map');
        if(is_array($sections) && count($sections)>0)
            foreach($sections as $section)
            {
                if($section == 'address'){
                    $section = 'contact';
                }
                if(!in_array($section, $section_default)){
                    do_action('awe_render_custom_section',$section);
                }else{
                    get_template_part("section-{$section}");    
                }
                
            }

    }else{
        get_template_part('section','about');
        get_template_part('section','service');
        get_template_part('section','funfact');
        get_template_part('section','team');
        get_template_part('section','skill');
        get_template_part('section','portfolio');
        get_template_part('section','idea');
        get_template_part('section','twitter');
        get_template_part('section','pricing');
        get_template_part('section','lastedpost');
        get_template_part('section','client');
        get_template_part('section','testimonial');
        get_template_part('section','contact');
        get_template_part('section','map');
    }

?>
</div>

<?php get_footer(); ?>