<?php
/*
	Template Name: Contact Page
*/
get_header();
the_post();
get_template_part( 'includes/title' );
?>
<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="white-block top-border">
                        <?php
                        $contact_map = couponxl_get_option( 'contact_map' );
                        if( !empty( $contact_map[0] ) ){
                            echo '<div class="contact_map">';
                                foreach( $contact_map as $long_lat ){
                                    echo '<input type="hidden" value="'.esc_attr( $long_lat ).'" class="contact_map_marker">';
                                }
                                $contact_map_scroll_zoom = couponxl_get_option( 'contact_map_scroll_zoom' );
                                if( $contact_map_scroll_zoom == 'yes' ){
                                    echo '<input type="hidden" value="1" class="contact_map_scroll_zoom">';
                                }
                                ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <div id="map" class="embed-responsive-item"></div>
                                </div>                        
                                <?php
                            echo '</div>';
                        }
                        ?>
                    
                    <div class="white-block-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2><?php _e( 'Contact Us', 'couponxl' ) ?></h2>
                                <div class="send_result"></div>
                                <form>
                                    <div class="input-group">
                                      <input type="text" class="form-control" name="name" placeholder="<?php esc_attr_e( 'NAME', 'couponxl' ) ?>">
                                    </div>
                                    <div class="input-group">
                                      <input type="text" class="form-control" name="email" placeholder="<?php esc_attr_e( 'EMAIL', 'couponxl' ) ?>">
                                    </div>
                                    <div class="input-group">
                                      <textarea class="form-control" name="message" placeholder="<?php esc_attr_e( 'MESSAGE', 'couponxl' ) ?>"></textarea>
                                    </div>
                                    <input type="checkbox" name="captcha" id="captcha">
                                    <input type="hidden" name="action" value="contact">
                                    <a class="btn submit-form-contact" href="javascript:;"><?php _e( 'SUBMIT MESSAGE', 'couponxl' ); ?></a>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <div class="page-content clearfix">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>