<?php
/**
 * The Template for displaying galleries
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13;
define( 'A13_GALLERY_PAGE', true );

if(!defined('A13_CALLED_FROM_FRONT_PAGE')){
    //we already did it front-page.php, so repeating it will cause problems
    the_post();
}
$is_protected = post_password_required();
if($is_protected){
    define( 'A13_PAGE_PROTECTED', true );
}

get_header();

a13_title_bar();

$theme = $apollo13->get_meta('_theme');
$full_width = false;
if($theme === 'bricks'){
    $full_width = $apollo13->get_meta('_full_width') === 'on';
}
?>

<article id="content" class="clearfix<?php echo $full_width ? ' full-width' : ''; ?>">

    <div id="col-mask">

    <?php

    //password protected
    if($is_protected){
        echo get_the_password_form();
    }
    //normal
    else{
        echo a13_make_media_collection();
//        <div id="a13-gallery">
//            <a class="g-link" href="http://wordpress.com/image.jpg">
//                <i>
//                    <img src="thumb.jpg" alt="">
//                </i>
//            </a>
//        </div>

        //shows all meta fields of post in multi dimensional array
//        var_dump($custom = get_post_custom($post->ID));

    } //end of else (password_protected)
?>
    </div>
</article>

<?php
    get_footer();
    /*
            <div id="addthis-toolbox">
            addthis_print_widget( null, null, 'small_toolbox' )
            </div>
    */
    //shows all meta fields of post in multi dimensional array
    //var_dump($custom = get_post_custom($post->ID));
?>
