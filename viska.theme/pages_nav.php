<?php
    $args = array(
        'before'           => '<p>' . __( 'Pages:',LANGUAGE ),
        'after'            => '</p>',
        'link_before'      => '',
        'link_after'       => '',
        'next_or_number'   => 'number',
        'separator'        => ' ',
        'nextpagelink'     => __( 'Next page',LANGUAGE ),
        'previouspagelink' => __( 'Previous page',LANGUAGE ),
        'pagelink'         => '%',
        'echo'             => 1
    );
    wp_link_pages($args);
?>
<?php 


        global $wp_query;
        $big = 999999999; // need an unlikely integer

        $args = array(

            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),

            'format'       => '&page=%#%',

            'total'        => $wp_query->max_num_pages,

            'current'      => $paged,

            'show_all'     => false,

            'end_size'     => 3,

            'mid_size'     => 3,

            'prev_next'    => True,

            'prev_text'    => __('<i class="fa fa-angle-left"></i>',LANGUAGE),

            'next_text'    => __('<i class="fa fa-angle-right"></i>',LANGUAGE),

            'type'         => 'list',

            'add_args'     => '',

            'add_fragment' => '',

            'before_page_number' => '',

            'after_page_number' => ''

        );
        
        echo paginate_links_custom( $args );
        

?>
<?php
    function paginate_links_custom( $args = '' ) {
    $defaults = array(
        'base' => '%_%', // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
        'format' => '?page=%#%', // ?page=%#% : %#% is replaced by the page number
        'total' => 1,
        'current' => 0,
        'show_all' => false,
        'prev_next' => true,
        'prev_text' => __('&laquo; Previous',LANGUAGE),
        'next_text' => __('Next &raquo;',LANGUAGE),
        'end_size' => 1,
        'mid_size' => 2,
        'type' => 'plain',
        'add_args' => false, // array of query args to add
        'add_fragment' => '',
        'before_page_number' => '',
        'after_page_number' => ''
    );

    $args = wp_parse_args( $args, $defaults );
    extract($args, EXTR_SKIP);

    // Who knows what else people pass in $args
    $total = (int) $total;
    if ( $total < 2 )
        return;
    $current  = (int) $current;
    $end_size = 0  < (int) $end_size ? (int) $end_size : 1; // Out of bounds?  Make it the default.
    $mid_size = 0 <= (int) $mid_size ? (int) $mid_size : 2;
    $add_args = is_array($add_args) ? $add_args : false;
    $r = '';
    $page_links = array();
    $n = 0;
    $dots = false;

    if ( $prev_next && $current && 1 < $current ) :
        $link = str_replace('%_%', 2 == $current ? '' : $format, $base);
        $link = str_replace('%#%', $current - 1, $link);
        if ( $add_args )
            $link = add_query_arg( $add_args, $link );
        $link .= $add_fragment;

        /**
         * Filter the paginated links for the given archive pages.
         *
         * @since 3.0.0
         *
         * @param string $link The paginated link URL.
         */
        $page_links[] = '<a class="" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $prev_text . '</a>';
    endif;
    for ( $n = 1; $n <= $total; $n++ ) :
        if ( $n == $current ) :
            $page_links[] = "<li class='page-numbers current-page'><a href=''>" . $before_page_number . number_format_i18n( $n ) . $after_page_number . "</a>";
            $dots = true;
        else :
            if ( $show_all || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                $link = str_replace('%_%', 1 == $n ? '' : $format, $base);
                $link = str_replace('%#%', $n, $link);
                if ( $add_args )
                    $link = add_query_arg( $add_args, $link );
                $link .= $add_fragment;

                /** This filter is documented in wp-includes/general-template.php */
                $page_links[] = "<a class='page-numbers' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $before_page_number . number_format_i18n( $n ) . $after_page_number . "</a>";
                $dots = true;
            elseif ( $dots && !$show_all ) :
                $page_links[] = '<span class="page-numbers dots">' . __( '&hellip;',LANGUAGE ) . '</span>';
                $dots = false;
            endif;
        endif;
    endfor;
    if ( $prev_next && $current && ( $current < $total || -1 == $total ) ) :
        $link = str_replace('%_%', $format, $base);
        $link = str_replace('%#%', $current + 1, $link);
        if ( $add_args )
            $link = add_query_arg( $add_args, $link );
        $link .= $add_fragment;

        /** This filter is documented in wp-includes/general-template.php */
        $page_links[] = '<a class="" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $next_text . '</a>';
    endif;
    switch ( $type ) :
        case 'array' :
            return $page_links;
            break;
        case 'list' :
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= join("</li>\n\t<li>", $page_links);
            $r .= "</li>\n</ul>\n";
            break;
        default :
            $r = join("\n", $page_links);
            break;
    endswitch;
    return $r;
}
?>