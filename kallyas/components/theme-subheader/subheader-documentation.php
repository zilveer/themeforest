<?php if(! defined('ABSPATH')){ return; }

$style = 'style="';
// @since 3.6.9
// Check if there is provided a custom height
if ( $saved_height = zget_option( 'def_header_custom_height', 'general_options' ) ) {
    $height = absint( $saved_height );
    $style .= "min-height: {$height}px; height:{$height}px;";
}
$style .= '"';
/*
 * DOCUMENTATION PAGES
 */
$headerClass =
    'uh_' . zget_option( 'zn_doc_header_style', 'documentation_options', false, 'zn_def_header_style' );
if ( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    if ( $term && isset( $term->term_id ) ) {
        $opt = get_option( 'wpk_zn_select_custom_header_' . $term->term_id );
        if ( !empty( $opt ) ) {
            $headerClass = 'uh_' . $opt;
        }
    }
}
?>
<div id="page_header" class="page-subheader <?php echo $headerClass; ?> zn_documentation_page" <?php echo $style; ?>>
    <div class="bgback"></div>
    <div class="th-sparkles"></div>

    <div class="ph-content-wrap">
        <div class="ph-content-v-center">
            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="zn_doc_search">
                                <form method="get" action="<?php echo home_url(); ?>">
                                    <input type="text" value="" name="s" id="s" placeholder="<?php _e( "Search the Documentation", 'zn_framework' ); ?>"/>
                                    <input type="submit" id="searchsubmit" class="btn" value="<?php _e( 'Search', 'zn_framework' ); ?>"/>
                                    <input type="hidden" name="post_type" value="documentation"/>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
    <div class="zn_header_bottom_style"></div>
</div><!-- end page-subheader -->
