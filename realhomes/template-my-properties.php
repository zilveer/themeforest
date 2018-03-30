<?php
/*
*  Template Name: My Properties Template
*/

get_header();
?>

    <!-- Page Head -->
    <?php get_template_part("banners/default_page_banner"); ?>

    <!-- Content -->
    <div class="container contents single my-properties">
        <div class="row">
            <div class="span12 main-wrap">

                <?php
                if( isset($_GET['deleted']) && ( intval($_GET['deleted']) == 1 ) ){
                    alert( __('Success:','framework'),__('Property removed.','framework') );
                } else if ( isset( $_GET['property-added'] ) && ( $_GET['property-added'] == true ) ) {
                    alert( __('Success:','framework'),__('Property Submitted.','framework') );
                } else if ( isset( $_GET['property-updated'] ) && ( $_GET['property-updated'] == true ) ) {
                    alert( __('Success:','framework'),__('Property Updated.','framework') );
                }

                global $post;
                $title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
                if( $title_display != 'hide' ){
                    ?>
                    <h3><span><?php the_title(); ?></span></h3>
                    <?php
                }
                ?>

                <!-- Main Content -->
                <div class="main">

                    <?php
                    if(is_user_logged_in()){

                        // Get User Id
                        global $current_user;
                        get_currentuserinfo();

                        global $paged;

                        // My properties arguments
                        $my_props_args = array(
                            'post_type' => 'property',
                            'posts_per_page' => 10,
                            'paged' => $paged,
                            'post_status' => array( 'pending', 'draft', 'publish', 'future' ),
                            'author' => $current_user->ID
                        );

                        $my_properties_query = new WP_Query( $my_props_args );
                        if ( $my_properties_query->have_posts() ) :

                            /* Get Payment Related Options before while loop */
                            $payments_enabled   = get_option( 'theme_enable_paypal' );
                            $paypal_ipn_url     = get_option( 'theme_paypal_ipn_url' );
                            $paypal_merchant_id = get_option( 'theme_paypal_merchant_id' );
                            $enable_sandbox     = get_option( 'theme_enable_sandbox' );
                            $payment_amount     = get_option( 'theme_payment_amount' );
                            $currency_code      = get_option( 'theme_currency_code' );

                            while ( $my_properties_query->have_posts() ) :

                                $my_properties_query->the_post();

                                ?>
                                <div class="my-property clearfix">

                                    <div class="property-thumb cell">
                                        <?php
                                        if(has_post_thumbnail($post->ID)){
                                            the_post_thumbnail( 'property-thumb-image' );
                                        }else{
                                            inspiry_image_placeholder( 'property-thumb-image' );
                                        }
                                        ?>
                                    </div>

                                    <div class="property-title cell">
                                        <h5><?php the_title(); ?></h5>
                                    </div>

                                    <div class="property-date cell">
                                        <h5><i class="fa fa-calendar"></i>&nbsp;<?php _e('Posted on :','framework');?>&nbsp;<?php the_time("d F 'y"); ?></h5>
                                    </div>

                                    <div class="property-publish-status cell">
                                        <h5><?php echo get_post_status(); ?></h5>
                                    </div>

                                    <div class="property-controls">
                                        <?php
                                        /* Edit Post Link */
                                        $submit_url = get_option('theme_submit_url');
                                        if( ! empty( $submit_url ) ) {
                                            $edit_link = esc_url( add_query_arg( 'edit_property', $post->ID , $submit_url ) );
                                            ?><a href="<?php echo $edit_link; ?>"><i class="fa fa-pencil"></i></a><?php
                                        }

                                        /* Preview Post Link */
                                        if ( current_user_can( 'edit_posts' ) ) {
                                            $preview_link = set_url_scheme( get_permalink( $post->ID ) );
                                            $preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
                                            if ( ! empty( $preview_link ) ) {
                                                ?><a target="_blank" href="<?php echo $preview_link; ?>"><i class="fa fa-eye"></i></a><?php
                                            }
                                        }

                                        /* Delete Post Link Bypassing Trash */
                                        if ( current_user_can('delete_posts') ) {
                                            $delete_post_link = get_delete_post_link( $post->ID, '', true );
                                            if ( ! empty( $delete_post_link ) ) {
                                                ?><a href="<?php echo $delete_post_link; ?>"><i class="fa fa-times"></i></a><?php
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div class="property-payment cell">
                                        <?php
                                        $payment_status = get_post_meta( $post->ID, 'payment_status', true );

                                        if ( $payment_status == "Completed" ) {
                                            echo '<h5>';
                                            _e('Payment Completed','framework');
                                            echo '</h5>';
                                        } else {

                                            if ( class_exists( 'AngellEYE_Paypal_Ipn_For_Wordpress' ) ) {

                                                if( ( $payments_enabled == "true" )
                                                    && ( !empty( $paypal_ipn_url ) )
                                                    && ( !empty( $paypal_merchant_id ) )
                                                    && ( !empty( $currency_code ) )
                                                    && ( !empty( $payment_amount ) ) ) {

                                                    $paypal_button_script = get_template_directory_uri() . "/js/paypal-button.min.js";
                                                    ?>
                                                    <script src= "<?php echo esc_url( add_query_arg( array( 'merchant' => $paypal_merchant_id ), $paypal_button_script ) ); ?>"
                                                            <?php if ( $enable_sandbox == "true" ) { ?>data-env="sandbox"<?php } ?>
                                                            data-callback="<?php echo esc_url_raw( $paypal_ipn_url ); ?>"
                                                            data-tax="0"
                                                            data-shipping="0"
                                                            data-currency="<?php echo esc_attr( $currency_code ); ?>"
                                                            data-amount="<?php echo esc_attr( $payment_amount ); ?>"
                                                            data-quantity="1"
                                                            data-name="<?php the_title(); ?>"
                                                            data-number="<?php the_ID(); ?>"
                                                            data-button="buynow"
                                                        ></script>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>

                                </div>
                                <?php

                            endwhile;

                            wp_reset_postdata();

                        else:
                            alert( __('Note:','framework'), __('No Properties Found!','framework') );
                        endif;

                        theme_pagination( $my_properties_query->max_num_pages);

                    }else{
                        alert( __('Login Required:','framework'),__('Please, Login to view your properties!','framework') );
                    }

                    ?>

                </div><!-- End Main Content -->

            </div> <!-- End span12 -->

        </div><!-- End contents row -->

    </div><!-- End Content -->

<?php get_footer(); ?>