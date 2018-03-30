<?php get_header(); ?>
				
<?php
    $post_style = get_post_meta(get_the_ID(), 'post_style', true );
    if((plsh_gs('post_style') == 'no-sidebar' && $post_style == 'global') || $post_style == 'no-sidebar')
    {
        get_template_part('theme/templates/page-full-width');
    }
    else
    {
        get_template_part('theme/templates/page-regular');
    }
?>
				
<?php get_footer(); ?>