<?php
add_filter('next_posts_link_attributes', 'add_next_posts_class');
add_filter('previous_posts_link_attributes', 'add_prev_posts_class');

function add_next_posts_class() {
    return 'class="nextposts-link transition"';
}

function add_prev_posts_class() {
    return 'class="prevposts-link transition"';
}
function post_navigation($args=false)
{

    $pre_nex = array(
        'wrap_begin'        =>  '<nav class="post-nav">',
        'wrap_end'          =>  '</nav>',
        'ul_class'          =>  'ul-nav',
        'ul_show'           =>  1,
        'prev_next_class'   =>  'pager',
        'prev_class'        =>  'previous',
        'prev_show'         =>  1,
        'prev_label'        =>  __( 'Prev', LANGUAGE ),
        'next_class'        =>  'next',
        'next_show'         =>  1,
        'next_label'        =>  __( 'Next', LANGUAGE ),
        'li_class'          =>  'li-nav',
        'li_show'           =>  1,
        'a_class'           =>  'pagination',
        'active'            =>  'active',

    );
    $number = array();
    $output = '';
    $type = apply_filters('post_navigation_type','num');
    if($type == 'num'){

        if( is_singular() )
            return;

        global $wp_query;
        //* Stop execution if there's only 1 page
        if( $wp_query->max_num_pages <= 1 )
            return;
        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $max   = intval( $wp_query->max_num_pages );

        //* Add current page to the array
        if ( $paged >= 1 )
            $links[] = $paged;

        //* Add the pages around the current page to the array
        if ( $paged >= 3 ) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if ( ( $paged + 2 ) <= $max ) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }
        $temp = array_merge($pre_nex,$args);

        //* Previous Post Link
        if ( get_previous_posts_link()&& $temp['prev_show']!=0){
            if($temp['li_show']!=0)
                $output .="<{$temp['li_class']} class=\"{$temp['prev_class']}\">".get_previous_posts_link( $temp['prev_label']  )."</{$temp['li_class']}>";
            else
                $output .=get_previous_posts_link( __( 'Prev', LANGUAGE )  );
        }


        //* Link to first page, plus ellipses if necessary
        if ( ! in_array( 1, $links ) ) {

            $class = 1 == $paged ? ' class="'.$temp['active'].'"' : '';
            if($paged==1)
                $a_class= ($temp['a_class']!='')?"class=\"{$temp['a_class']} {$temp['active']}\"":'';
            else
                $a_class= ($temp['a_class']!='')?"class=\"{$temp['a_class']}\" ":'';

            if($temp['li_show']!=0)
                $output .="<{$temp['li_class']}{$class}><a {$a_class}href=\"".esc_url( get_pagenum_link( 1 ) )."\">1</a></{$temp['li_class']}>";
            else
                $output .="<a {$a_class}href=\"".esc_url( get_pagenum_link( 1 ) )."\">1</a>";

            if ( ! in_array( 2, $links ) ){
                if($temp['li_show']!=0)
                    $output .="<{$temp['li_class']}><a {$a_class}href=\"#\">&#x02026;</a></{$temp['li_class']}>";
                else
                    $output .="<a {$a_class}href=\"#\">&#x02026;</a>";
            }

        }
        sort( $links );
        foreach ( (array) $links as $link ) {
            $class = $paged == $link ? ' class="'.$temp['active'].'"' : '';

            if($paged==$link)
                $a_class= ($temp['a_class']!='')?"class=\"{$temp['a_class']} {$temp['active']}\"":'';
            else
                $a_class= ($temp['a_class']!='')?"class=\"{$temp['a_class']}\" ":'';

            if($temp['li_show']!=0)
                $output .= "<{$temp['li_class']} {$class}><a {$a_class}href=\"".esc_url( get_pagenum_link( $link ))."\">{$link}</a></{$temp['li_class']}>";
            else
                $output .= "<a {$a_class}href=\"".esc_url( get_pagenum_link( $link ))."\">{$link}</a>";
        }

        if ( ! in_array( $max, $links ) ) {
            $class = $paged == $max ? ' class="'.$temp['active'].'"' : '';


            if ( ! in_array( $max - 1, $links ) ){
                if($temp['li_show']!=0)
                    $output .=  "<{$temp['li_class']}><a {$a_class}href=\"#\">&#x02026;</a></{$temp['li_class']}>";
                else
                    $output .=  "<a {$a_class}href=\"#\">&#x02026;</a>";
            }

            if($paged==$max)
                $a_class= ($temp['a_class']!='')?"class=\"{$temp['a_class']} {$temp['active']}\"":'';
            else
                $a_class= ($temp['a_class']!='')?"class=\"{$temp['a_class']}\" ":'';


            if($temp['li_show']!=0)
                $output .= "<{$temp['li_class']} {$class}><a {$a_class}href=\"".esc_url( get_pagenum_link( $max ))."\">{$max}</a></{$temp['li_class']}>";
            else
                $output .= "<a {$a_class}href=\"".esc_url( get_pagenum_link( $max ))."\">{$max}</a>";
        }
        if ( get_next_posts_link() && $temp['next_show']!=0){
            if($temp['li_show']!=0)
                $output .="<{$temp['li_class']} class=\"{$temp['next_class']}\">".get_next_posts_link( $temp['next_label'] )."</{$temp['li_class']}>";
            else
                $output .="".get_next_posts_link( __( 'Next', LANGUAGE )  )."";
        }


        if($output){
            if($temp['ul_show']!=0)
                $output = $temp['wrap_begin']."<ul class=\"{$temp['ul_class']}\">".$output."</ul>".$temp['wrap_end'];
            else
                $output = $temp['wrap_begin']."".$output."".$temp['wrap_end'];
        }


    }else{

        $temp = $args?$args:$pre_nex;
        $next =  get_next_posts_link(__('&larr;', LANGUAGE));
        $pre =  get_previous_posts_link(__('&rarr;', LANGUAGE));
//            printf('%1s<%2$s class="%3$s">%4$s</%2$s><%2$s class="%5$s">%6$s</%2$s>%7$s',$temp['wrap_begin'],$temp['li_class'],$temp['pre_class'],$next,$temp['nex_class'],$pre,$temp['wrap_end']);
        $output = "\t".$temp['wrap_begin'];
        if($temp['ul_show']!=0)
            $output.="<ul class=\"{$temp['prev_next_class']}\">";
        if($temp['li_show']!=0){
            $output .= "<{$temp['li_class']} class=\"{$temp['prev_class']}\">".$next."</{$temp['li_class']}>";
            $output .= "<{$temp['li_class']} class=\"{$temp['next_class']}\">".$pre."</{$temp['li_class']}>";
        }else{
            $output .=$next.$pre;
        }

        if($temp['ul_show']!=0)
            $output .= "</ul>";
        $output .= $temp['wrap_end'];
    }
    echo $output;
}


?>