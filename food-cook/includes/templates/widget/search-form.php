<?php
/**
 * Search Form Template
 *
 * This template is a customised search form.
 *
 * @package WooFramework
 * @subpackage Template
 */
?>
<?php global $woo_options; ?>

<div class="search_main">
    <form method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" >
        <input type="text" class="field s" name="s" value="<?php _e( 'Search...', 'woothemes' ); ?>" onfocus="if (this.value == '<?php _e( 'Search...', 'woothemes' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Search...', 'woothemes' ); ?>';}" />
        <button type="submit" class="fa fa-search submit"></button>

        <?php if (isset($woo_options['woo_advanced_search']) && $woo_options['woo_advanced_search'] == 'true') : ?>

            <script>
                jQuery(document).ready(function() {
                    jQuery(".too").hide();

                    jQuery('.search_main .linked-more span').addClass('show_hide');

                    jQuery('.show_hide').unbind().click(function(){

                        jQuery(".too").slideToggle(500);

                    });
                });
            </script>

            <p>
                <div class="linked-more">

                    <span style="color:#bf9764;cursor:pointer;"><?php _e('Advanced Search', 'woothemes'); ?></span>

                </div>
            </p>

            <div class="too">
                <input type="checkbox" name="post_type" value="post" /><label>Blog</label>
                <input type="checkbox" name="post_type" value="recipe" /><label>Recipe</label>

                <?php

                if (  is_woocommerce_activated() ) {
                    echo '<input type="checkbox" name="post_type" value="product" /><label>Product</label>';

                    if( isset( $_POST['post_type'] ) && $_POST['post_type'] == 'product' ) {
                        echo '<input type="hidden" name="post_type" value="product" />';
                    }

                }

                if( isset( $_POST['post_type'] ) == 'post' ): ?>

                    <input type="hidden" name="post_type" value="post" />

                <?php endif; ?>

                <?php if( isset( $_POST['post_type'] ) == 'recipe' ): ?>

                   <input type="hidden" name="post_type" value="recipe" />

                <?php endif; ?>
            </div>

        <?php endif;?>

    </form>

<div class="fix"></div>

</div>
