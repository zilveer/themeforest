<?php
/**
 * The Template for displaying portfolio items.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13;
define( 'A13_WORK_PAGE', true );

the_post();
$is_protected = post_password_required();
if($is_protected){
    define( 'A13_PAGE_PROTECTED', true );
}

get_header();

a13_title_bar();

?>

<article id="content" class="clearfix">

    <div id="col-mask">

    <?php
    //password protected
    if($is_protected){
        echo get_the_password_form();
    }
    //normal
    else{
        $content_position = get_post_meta(get_the_ID(), '_content_position', true); //= left,right or under
        $side_class = $content_position === 'under'? '' : ' content-side';
?>

        <div id="post-<?php the_ID(); ?>" <?php post_class('content-'.$content_position.$side_class); ?>>
            <?php
            //media collection as first element
            if($content_position === 'under'){
                echo a13_make_media_collection();
                a13_cpt_nav();
            }
            ?>
            <div class="work-content">
                <?php if($content_position !== 'under'){ a13_cpt_nav(); } ?>
                <div class="real-content">

                    <?php the_content(); ?>

                    <div class="clear"></div>
                </div>
                <?php a13_work_meta_data(); ?>

            </div>
            <?php
            //work-content is floating so media collection should be second
            if($content_position !== 'under'){
                echo a13_make_media_collection();
            }
            ?>
            <div class="clear"></div>

            <?php a13_similar_posts(); ?>

            <?php
                if($apollo13->get_option('cpt_work', 'comments') == 'on'){
                    comments_template( '', true );
                }
            ?>
        </div>
<?php
    }//end of non password protected
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
