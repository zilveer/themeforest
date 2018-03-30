<?php
/**
 * Template Name: Portfolio Page Template
 */


// Custom Gallery shortcode output
function pt_portfolio_gallery( $blank = NULL, $attr ) {
  global $post;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'medium',
        'include'    => '',
        'exclude'    => '',
        'link'       => ''
    ), $attr, 'gallery'));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $icontag = tag_escape($icontag);
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) )
        $itemtag = 'dl';
    if ( ! isset( $valid_tags[ $captiontag ] ) )
        $captiontag = 'dd';
    if ( ! isset( $valid_tags[ $icontag ] ) )
        $icontag = 'dt';

    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "portfolio-gallery";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = "
        <style type='text/css'>
            #{$selector} .gallery-item {
                float: {$float};
                width: {$itemwidth}%;
            }
            /* see gallery_shortcode() in wp-includes/media.php */
        </style>";
    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' data-isotope='container' data-isotope-layout='masonry' data-isotope-elements='gallery-item' class='pt-gallery gallery'>";

    // Get isotope filters
    $filters = array();

    foreach ( $attachments as $id => $attachment ) {
        if ( !empty($attachment->portfolio_filter) ) {
            $filters = array_merge($filters, explode(',' ,$attachment->portfolio_filter));
        }
    }

    $filters_cleared = array();

    foreach($filters as $filter){
        array_push($filters_cleared, trim($filter));
    }

    $filters = array_unique($filters_cleared);

    $output_filters = '';

    if (!empty($filters)) {

        $output_filters = '<div class="portfolio-filters-wrapper"><label for="pt-filters">'.__('Sort Portfolio: ', 'plumtree').'</label>';

        $output_filters .= '<select id="pt-filters" name="pt-filters" class="filters-group" data-isotope="filters"><option value="">'.__('All', 'plumtree').'</option>';

        foreach($filters as $filter){
            $output_filters .= '<option value="'.esc_attr(strtolower($filter)).'">'.esc_html($filter).'</option>';
        }

        $output_filters .= '</select></div>';

    }

    $output = apply_filters( 'gallery_style', /*$gallery_style . "\n\t\t" .*/ $output_filters . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        if ( ! empty( $link ) && 'file' === $link )
            $image_output = wp_get_attachment_link( $id, $size, false, false );
        elseif ( ! empty( $link ) && 'none' === $link )
            $image_output = wp_get_attachment_image( $id, $size, false );
        else
            $image_output = wp_get_attachment_link( $id, $size, true, false );

        $image_meta  = wp_get_attachment_metadata( $id );

        // Adding special isotope attr
        $special_filters = get_post_meta( $id, 'portfolio_filter', true );

        $attr = '';

        if( ! empty( $special_filters ) ) {
            $arr = explode( ",", $special_filters);

            $special_filter_cleared = array();

            foreach($arr as $special_filter){
                array_push($special_filter_cleared, trim($special_filter));
            }

            $special_filters = implode(" ", $special_filter_cleared);

            $attr = strtolower( $special_filters );
        }

        /* Add responsive bootstrap classes */
        $classes = '';

        switch ($columns) {
            case '2':
                $classes = ' col-md-6 col-sm-12 col-xs-12';
            break;
            case '3':
                $classes = ' col-md-4 col-sm-6 col-xs-12';
            break;
            case '4':
                $classes = ' col-lg-3 col-md-4 col-sm-6 col-xs-12';
            break;
            case '6':
                $classes = ' col-lg-2 col-md-4 col-sm-6 col-xs-12';
            break;
        }

        $orientation = '';
        if ( isset( $image_meta['height'], $image_meta['width'] ) )
            $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

        $output .= "<{$itemtag} class='gallery-item ". esc_attr($attr) . esc_attr($classes) ."'>";
        $output .= "
            <{$icontag} class='gallery-icon {$orientation}'>
                $image_output
                <a class='quick-view' href='".esc_url($attachment->guid)."' title='".__('Quick View', 'plumtree')."' rel='nofollow' data-magnific='link' data-effect='mfp-zoom-in'><i class='fa fa-search'></i></a>
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_title) ) {
            $output .= "
                <{$captiontag} class='portfolio-item-description'>
                <h3>" . wptexturize($attachment->post_title) . "</h3>";
                if ( !empty($attachment->post_content) ) {
                    $output .= "<div>" . wptexturize($attachment->post_content) . "</div>";
                }
                $output .= '<div class="buttons-wrapper">';
                $output .= '<div class="comments-qty"><i class="fa fa-comments"></i>('.$attachment->comment_count.')</div>';
                if (function_exists('pt_output_likes_counter')) {
                    $output .= pt_output_likes_counter($attachment->ID);
                }
                $output .= '<div class="link-to-post"><a rel="bookmark" href="'.esc_url(get_permalink($attachment->ID)).'" title="'.__( 'Click to learn more', 'plumtree').'"><i class="fa fa-chevron-right"></i></a></div>';
                $output .= '</div>';

            $output .= "</{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '<br style="clear: both" />';
    }

    $output .= "
            <br style='clear: both;' />
        </div>\n";

    return $output;

}
add_filter( 'post_gallery', 'pt_portfolio_gallery', 10, 2);
?>

<?php get_header(); ?>

    <main class="site-content<?php if (function_exists('pt_main_content_class')) pt_main_content_class(); ?>" itemscope="itemscope" itemprop="mainContentOfPage"><!-- Main content -->

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php endif; ?>

    </main><!-- end of Main content -->

    <?php get_sidebar(); ?>

<?php get_footer(); ?>
