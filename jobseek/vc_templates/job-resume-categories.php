<?php
/*
 * Helpers
 */

function jobseek_partition( $list, $p ) {
    $listlen = count( $list );
    $partlen = floor( $listlen / $p );
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for ($px = 0; $px < $p; $px++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice( $list, $mark, $incr );
        $mark += $incr;
    }
    return $partition;
}


/**
 * Limits number of words from string
 */
if ( ! function_exists( 'jobseek_string_limit_words' ) ) :
    function jobseek_string_limit_words($string, $word_limit) {
        $words = explode(' ', $string, ($word_limit + 1));
        if (count($words) > $word_limit) {
            array_pop($words);
            //add a ... at last article when more than limit word count
            return implode(' ', $words) ;
        } else {
            //otherwise
            return implode(' ', $words);
        }
    }
endif;





// Shortcode prints grid of categories

add_shortcode('jobs_categories', 'jobseek_jobs_categories');

function jobseek_jobs_categories( $atts ) {
    extract(shortcode_atts(array(
        'columns'      => '4',
        'orderby'      => 'count',
        'number'       => '99',
        'hide_empty'   => 0,
        'jobs_counter' => 'no',
        'type'         => 'all',
        'parent_id'    => '',
    ), $atts));

    $output = '';
    
    if( $type == 'all' ) {
     
        $categories = get_terms( array(
            'taxonomy'   => 'job_listing_category',
            'orderby'    => $orderby,
            'hide_empty' => $hide_empty,
            'number'     => $number,
        ) );

        if ( !is_wp_error( $categories ) ) {
            $output .= '<div class="category-groups columns-' . $columns . '">';
            $chunks = jobseek_partition($categories, $columns);
            foreach( $chunks as $chunk ) {
                $output .= '<ul>';
                    foreach ( $chunk as $term ) {
                        $output .= '<li><a href="' . get_term_link( $term ) . '">' . $term->name;
                        if( $jobs_counter == 'yes' ) {
                            $output .= '<span>' . $term->count . '</span>';
                        }
                        $output .= '</a></li>';
                    }
                $output .= '</ul>';
            }
            $output .= '</div>';
        }
    }  

    if( $type == 'only_parents' ) {
    
        $categories = get_terms( array(
            'taxonomy'   => 'job_listing_category',
            'parent'     => 0,
            'orderby'    => $orderby,
            'hide_empty' => $hide_empty,
            'number'     => $number,
        ) );

        if( !is_wp_error( $categories ) ) {
            $output .= '<div class="category-groups columns-' . $columns . '">';
            $chunks = jobseek_partition($categories, $columns);
            foreach ( $chunks as $chunk ) {
                $output .= '<ul>';
                    foreach ( $chunk as $term ) {
                        $output .= '<li><a href="' . get_term_link( $term ) . '">' . $term->name;
                        if( $jobs_counter == 'yes' ) {
                            $output .= '<span>' . $term->count . '</span>';
                        }
                        $output .= '</a></li>';
                    }
                $output .= '</ul>';
            }
            $output .= '</div>';
        }
    }

    if( $type == 'group_by_parents' ) {

        $parents = get_terms( array(
            'taxonomy'   => 'job_listing_category',
            'orderby'    => $orderby,
            'hide_empty' => $hide_empty,
            'number'     => $number,
            'parent'     => 0
        ));

        if ( !is_wp_error( $parents ) ) {
            foreach( $parents as $key => $term ) :
                $subterms = get_terms("job_listing_category", array("orderby" => $orderby, "parent" => $term->term_id, 'hide_empty' => $hide_empty));
                
                $output .= '<div class="category-groups columns-' . $columns . '"><h3><a href="' . get_term_link( $term ) . '">'. $term->name .'</a></h3>';
                
                if( $subterms ) :           
                    $chunks = jobseek_partition($subterms, $columns);
                    foreach ($chunks as $chunk) {
                        $output .= '<ul>';
                            foreach ($chunk as $subterms) {
                               $output .= '<li><a href="' . get_term_link( $subterms ) . '">' . $subterms->name;
                               if($jobs_counter=='yes'){
                                 $output .= '<span>' . $subterms->count . '</span>';
                               }
                               $output .= '</a></li>';
                            }
                        $output .= '</ul>';
                    }
                endif;
                           
                $output .= '</div>';
                
            endforeach;
        }
    }

    if( $type == 'parent' ) {

        if ( !is_wp_error( $categories ) ) {

            $subterms = get_terms( array(
                'taxonomy'   => 'job_listing_category',
                'orderby'    => $orderby,
                'hide_empty' => $hide_empty,
                'number'     => $number,
                'parent'     => $parent_id,
            ));

            $term = get_term( $parent_id, "job_listing_category" );

            if( $subterms ) {
                $output .= '<div class="category-groups columns-' . $columns . '"><h3 class="parent-jobs-category"><a href="' . get_term_link( $term ) . '">'. $term->name .'</a></h3>';
                       
                    $chunks = jobseek_partition($subterms, $columns);

                    foreach ( $chunks as $chunk ) {
                        $output .= '<ul>';
                            foreach ($chunk as $subterms) {
                                $output .= '<li><a href="' . get_term_link( $subterms ) . '">' . $subterms->name;
                                if($jobs_counter=='yes'){
                                   $output .= '<span>' . $subterms->count . '</span>';
                                }
                                $output .= '</a></li>';
                            }
                        $output .= '</ul>';
                    }
                       
                $output .= '</div>';
            }
        }
        
    }

    return $output;
}



add_shortcode('resume_categories', 'jobseek_resumes_categories');

function jobseek_resumes_categories( $atts ) {
    extract(shortcode_atts(array(
        'columns'         => '4',
        'orderby'         => 'count',
        'number'          => '99',
        'hide_empty'      => 0,
        'resumes_counter' => 'no',
        'type'            => 'all',
        'parent_id'       => '',
    ), $atts));

    $output = '';
    
    if( $type == 'all' ) {
     
        $categories = get_terms( array(
            'taxonomy'   => 'resume_category',
            'orderby'    => $orderby,
            'hide_empty' => $hide_empty,
            'number'     => $number,
        ) );

        if ( !is_wp_error( $categories ) ) {
            $output .= '<div class="category-groups columns-' . $columns . '">';
            $chunks = jobseek_partition($categories, $columns);
            foreach ($chunks as $chunk) {
                $output .= '<ul>';
                    foreach ($chunk as $term) {
                       $output .= '<li><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></li>';
                    }
                $output .= '</ul>';
            }
            $output .= '</div>';
        }
    }

    if( $type == 'group_by_parents' ) {

        $parents =  get_terms( array(
            'taxonomy'   => 'resume_category',
            'orderby'    => $orderby,
            'hide_empty' => $hide_empty,
            'number'     => $number,
            'parent'     => 0
        ) );

        if ( !is_wp_error( $parents ) ) {

            foreach( $parents as $key => $term ) {

                $subterms = get_terms( array(
                    'taxonomy'   => 'resume_category',
                    'orderby'    => $orderby,
                    'parent'     => $term->term_id,
                    'hide_empty' => $hide_empty
                ) );

                if( $subterms ) {
                    $output .= '<div class="category-groups columns-' . $columns . '"><h3 class="parent-resumes-category"><a href="' . get_term_link( $term ) . '">'. $term->name .'</a></h3>';
                        $chunks = jobseek_partition($subterms, $columns);
                        foreach( $chunks as $chunk ) {
                            $output .= '<ul>';
                                foreach( $chunk as $subterms ) {
                                   $output .= '<li><a href="' . get_term_link( $subterms ) . '">' . $subterms->name . '</a></li>';
                                }
                            $output .= '</ul>';
                        }
                    $output .= '</div>';
                }
            }
        }
    }

    if( $type == 'parent' ) {

        if ( !is_wp_error( $categories ) ) {

            $subterms = get_terms( array(
                'taxonomy'   => 'resume_category',
                'orderby'    => $orderby,
                'hide_empty' => $hide_empty,
                'number'     => $number,
                'parent'     => $parent_id, 
            ) );

            $term = get_term( $parent_id, 'resume_category' );

            if( $subterms ) {
                $output .= '<div class="category-groups columns-' . $columns . '"><h3 class="parent-resumes-category"><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></h3>';
                    $chunks = jobseek_partition($subterms, $columns);
                    foreach( $chunks as $chunk ) {
                        $output .= '<ul>';
                            foreach( $chunk as $subterms ) {
                               $output .= '<li><a href="' . get_term_link( $subterms ) . '">' . $subterms->name . '</a></li>';
                            }
                        $output .= '</ul>';
                    }
                $output .= '</div>';
            }
         }
        
    }

    return $output;
}

?>