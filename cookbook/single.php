<?php get_header(); ?>

<?php 

    // GET CMB DATA
    $cmb_single_style = get_post_meta( $post->ID, 'cmb_single_style', true);

    if ($cmb_single_style == "multi" || $cmb_single_style == "multi_sidebar") {

        get_template_part('inc/templates/template_single_multi');   

    } else {

        get_template_part('inc/templates/template_single');     

    }

?>


    	
<?php get_footer(); ?>