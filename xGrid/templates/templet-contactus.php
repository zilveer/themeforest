<?php
//Template Name: Contact
get_header();
global $bd_data;

$googlemapsshow             = $bd_data['gmap_show'];
$googlemaps_embed           = $bd_data['gmap_embed'];

/* Sidebar */
if(get_post_meta($post->ID, 'bd_full_width', true)){
    $post_full      = ' post_full_width';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'left'){
    $post_po        = ' post_sidebar_left';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'right'){
    $post_po        = ' post_sidebar_right';
}

$bd_criteria_display = get_post_meta(get_the_ID(), 'bd_criteria_display', true);

?>

    <div class="bd-container page-contactus-ajax <?php echo $post_po; echo $post_full; ?>">
        <div class="bd-main">

            <div class="blog-v1">
                <article>

                    <div class="post-header">
                        <h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
                    </div>

                    <div class="entry entry-content the-content-class">
                        <?php if( $googlemapsshow ){ ?>
                            <div class="page-contactus-ajax-maps">
                                <?php echo stripcslashes( $googlemaps_embed ); ?>
                            </div>
                        <?php } ?>

                        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                            <?php
                                the_content();
                                wp_link_pages();
                            ?>
                        <?php endwhile; ?>

                        <div class="form-box" id="contcatus">
                            <div class="clear form-box-label">
                                <label for="fullname">
                                    <input name="fullname" placeholder="<?php _e('Name (required)','bd')?>" class="input-text" id="fullname" type="text" value="" />
                                </label>

                                <label for="email">
                                    <input name="email" placeholder="<?php _e('E-Mail (required)','bd')?>" class="input-text" id="email" type="text" value="" />
                                </label>

                                <label for="website">
                                    <input class="input-text" placeholder="<?php _e('Subject','bd')?>" name="website" id="website" type="text" value="" />
                                </label>
                            </div>

                            <label for="message">
                                <textarea class="input-text" placeholder="<?php _e('Message','bd')?>" id="message" name="message" cols="39" rows="4"></textarea>
                            </label>

                            <label>
                                <input type="submit" class="btn" id="send_msg" value="<?php _e('Send Message','bd')?>" />
                            </label>

                            <div id="response"></div>
                            <div class="fix"></div>
                            <div class="contact_msg" id="contact_msg"> </div>
                            <?php bd_contact_js(); ?>
                        </div>
                    </div>
                </article>
            </div>

        </div><!-- .bd-main-->

        <?php get_sidebar(); ?>
    </div><!-- .bd-container -->

<?php get_footer(); ?>