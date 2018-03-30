<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 28/07/16
 * Time: 3:08 PM
 */
class Houzez_Compare_Properties {

    /*
     * Constructor
     * */
    public function __construct() {

        // Check if disabled on mobile devices
        /*$disable_mobile = 'yes';
        if( $disable_mobile == 'yes' && wp_is_mobile() ) return;*/

        add_action( 'init', array( &$this, 'houzez_open_session' ), 1 );
        add_action( 'wp_logout', array( &$this, 'houzez_close_session' ) );

        add_action( 'houzez_show_compare', array( &$this, 'output_compare_basket' ), 5 );

        // AJAX functions
        add_action( 'wp_ajax_houzez_compare_add_property', array( $this, 'houzez_compare_add_property' ) );
        add_action( 'wp_ajax_nopriv_houzez_compare_add_property', array( $this, 'houzez_compare_add_property' ) );
        add_action( 'wp_ajax_houzez_compare_update_basket', array( $this, 'update_compare_basket' ) );
        add_action( 'wp_ajax_nopriv_houzez_compare_update_basket', array( $this, 'update_compare_basket' ) );


    } // End Construct



    /*
     * add property to basket
     * */
    function houzez_compare_add_property() {

        $property_id = (int) $_POST[ 'prop_id' ];
        $max_items = 4; //(int) houzez_option('');
        $current_number = ( isset( $_SESSION[ 'houzez_compare_properties' ] ) && is_array( $_SESSION[ 'houzez_compare_properties' ] ) ) ? count( $_SESSION[ 'houzez_compare_properties' ] ) : 0;

        if( is_array( $_SESSION[ 'houzez_compare_properties' ] ) && in_array( $property_id, $_SESSION[ 'houzez_compare_properties' ] ) )
            unset( $_SESSION[ 'houzez_compare_properties' ][ array_search( $property_id, $_SESSION[ 'houzez_compare_properties' ] ) ] );
        elseif( $current_number < $max_items ) {

            $_SESSION[ 'houzez_compare_properties' ][] = $property_id;
        }

        $_SESSION[ 'houzez_compare_properties' ] = array_unique( $_SESSION[ 'houzez_compare_properties' ] );
        //print_r($_SESSION[ 'houzez_compare_properties' ]); //die;

        die();
    }


    /*
     * Open new session for compare properties
     * */
    function houzez_open_session() {

        if( !session_id() ) {
            // open session to begin storing comparable products
            session_start();
            if( !isset( $_SESSION[ 'houzez_compare_starttime' ] ) ) $_SESSION[ 'houzez_compare_starttime' ] = time();
            if( !isset( $_SESSION[ 'houzez_compare_properties' ] ) ) $_SESSION[ 'houzez_compare_properties' ] = array();
        }
        if( isset( $_SESSION[ 'houzez_compare_starttime' ] ) ) {
            //if session has been alive for more than 24 hours, empty compare basket
            if( (int) $_SESSION[ 'houzez_compare_starttime' ] > time() + 86400 ){
                unset( $_SESSION[ 'houzez_compare_properties' ] );
            }
        }

    }

    function output_compare_basket() {

        $max_set = 4;//(int) houzez_option();
        $current = 0;
        if (isset($_SESSION['houzez_compare_properties'])) {
            $current = count($_SESSION['houzez_compare_properties']);
        }
        ?>

        <div id="compare-properties-basket">
        <?php if (isset($_SESSION['houzez_compare_properties']) && count($_SESSION['houzez_compare_properties'])): ?>
                <div class="compare-panel-body">
                    <div class="compare-thumb-main row">

                        <?php foreach( $_SESSION[ 'houzez_compare_properties' ] as $key ) : ?>
                            <?php if( $key != 0 ) : ?>

                                <figure class="compare-thumb compare-property" property-id="<?php echo $key; ?>"">
                                    <?php echo get_the_post_thumbnail( (double) $key, 'houzez-widget-prop', array( 'class' => 'compare-property-img' ) ); ?>
                                    <button class="btn-trash compare-property-remove"><i class="fa fa-trash"></i></button>
                                </figure>

                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if( $current < $max_set ) : ?>
                            <?php for( $i = $current; $i < $max_set; $i++ ) : ?>
                                <figure class="compare-thumb">
                                    <div class="thumb-inner-empty"></div>
                                </figure>
                            <?php endfor; ?>
                        <?php endif; ?>

                    </div>
                    <button type="button" class="btn btn-primary btn-block compare-properties-button basket"><?php esc_html_e( 'Compare', 'houzez' ); ?></button>
                </div>
                <button class="btn btn-primary panel-btn"><i class="fa fa-angle-left"></i></button>
        <?php endif; ?>
        </div>
<?php
    }

    /**
     * Update the preview box after an item is added / removed
     */
    function update_compare_basket() {

        $this->output_compare_basket();
        die();
    }


    /*
     * Close session for compare properties
     * */
    function houzez_close_session() {

        if( isset( $_SESSION ) )
            session_destroy();

    }


} // End Class
return new Houzez_Compare_Properties();