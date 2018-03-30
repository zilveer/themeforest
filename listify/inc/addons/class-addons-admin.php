<?php
/**
 * Lots borrowed from WooCommerce
 */
class Listify_Admin_Addons {

    public function __construct() {
        if ( apply_filters( 'listify_show_addons_page', true ) ) {
            add_action( 'admin_menu', array( $this, 'addons_menu' ), 1000 );
        }
    }

    public function addons_menu() {
        add_submenu_page( 'edit.php?post_type=job_listing', __( 'Add-ons', 'listify' ),  __( 'Add-ons', 'listify' ) , 'manage_options', 'listify-addons', array( $this, 'output' ) );
    }

    public static function output() {
        if ( false === ( $addons = get_transient( 'listify_addons_data' ) ) ) {

            $addons_json = wp_safe_remote_get( 'https://astoundify.com/wp-json/posts?type=download', array( 'user-agent' => 'Listify Addons Page' ) );

            if ( ! is_wp_error( $addons_json ) ) {
                $addons = json_decode( wp_remote_retrieve_body( $addons_json ) );

                if ( $addons ) {
                    set_transient( 'listify_addons_data', $addons, WEEK_IN_SECONDS );
                }
            }
        }
?>
<style>
.listify_addons_wrap .products {
    overflow: hidden;
}

.listify_addons_wrap .products li {
    float: left;
    margin: 0 1em 1em 0 !important;
    padding: 0;
    vertical-align: top;
    width: 300px;
    min-height: 290px;
}

.listify_addons_wrap .products li .product-inner {
    text-decoration: none;
    color: inherit;
    border: 1px solid #ddd;
    display: block;
    min-height: 220px;
    overflow: hidden;
    background: #f5f5f5;
    box-shadow:
        inset 0 1px 0 rgba(255,255,255,0.2),
        inset 0 -1px 0 rgba(0,0,0,0.1);
}

.listify_addons_wrap .products li h3 {
    margin: 0 !important;
    padding: 20px !important;
    background: #fff;
    line-height: 1.5;
    font-size: 14px;
}

.listify_addons_wrap .products li p {
    padding: 20px !important;
    margin: 0 !important;
    border-top: 1px solid #f1f1f1;
}

.listify_addons_wrap .products li a:hover,
.listify_addons_wrap .products li a:focus {
    background-color: #fff;
}
</style>
<div class="wrap listify listify_addons_wrap">
    <h1>
        <?php _e( 'WP Job Manager - Add-ons for Listify', 'listify' ); ?>
    </h1>

    <?php if ( $addons ) : ?>

    <ul class="products">

        <?php foreach ( $addons as $addon ) : ?>
        <?php if ( $addon->terms->download_category[0]->ID == 3 ) { continue; } ?>
        <li class="product"><div class="product-inner">
            <h3><?php echo esc_attr( $addon->title ); ?></h3>
            <?php echo $addon->excerpt; ?>
            <p><a href="<?php echo esc_url( $addon->link ); ?>" class="button primary"><?php _e( 'More Information', 'marketify' ); ?></a></p>
        </div></li>
        <?php endforeach; ?>

    </ul>

    <?php else : ?>
        <p><?php printf( __( 'Shop for Listify compatible WP Job Manager add-ons <a href="%s">here</a>.', 'listify' ), 'https://astoundify.com/downloads/category/plugins/' ); ?></p>
    <?php endif; ?>
<?php
    }
}

$GLOBALS[ 'listify_addons' ] = new Listify_Admin_Addons();
