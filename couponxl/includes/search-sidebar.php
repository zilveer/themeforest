<div class="col-md-3">
    <div class="widget white-block widget_couponxl_filter">

        <?php
        $theme_usage = couponxl_get_option( 'theme_usage' );
        if( $theme_usage == 'all' ):
        ?>
            <?php
            $search_page_offer_type_filter_title = couponxl_get_option( 'search_page_offer_type_filter_title' );
            if( !empty( $search_page_offer_type_filter_title ) ):
            ?>
                <div class="widget-title">
                    <h4>
                        <?php echo $search_page_offer_type_filter_title; ?>
                    </h4>
                </div>
            <?php endif; ?>
            <ul class="list-unstyled list-inline offer-type-filter">
                <li>
                    <a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array(), array( 'offer_type' ) ) ) ?>" class="<?php echo empty( $offer_type ) ? 'active' : '' ?>"><?php _e( 'All', 'couponxl' ) ?></a>
                </li>
                <li>
                    <a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'offer_type' => 'deal' ) ) ) ?>" class="<?php echo $offer_type == 'deal' ? 'active' : '' ?>"><?php _e( 'Deals', 'couponxl' ) ?></a>
                </li>
                <li>
                    <a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'offer_type' => 'coupon' ) ) ) ?>" class="<?php echo $offer_type == 'coupon' ? 'active' : '' ?>"><?php _e( 'Coupons', 'couponxl' ) ?></a>
                </li>
            </ul>                        
        <?php
        endif;
        ?>
        <?php
        $search_page_category_filter_title = couponxl_get_option( 'search_page_category_filter_title' );
        if( !empty( $search_page_category_filter_title ) ):
        ?>
            <div class="widget-title">
                <h4>
                    <?php echo $search_page_category_filter_title ?>
                </h4>
            </div>
        <?php endif; ?>
        <ul class="list-unstyled ex_offer_cat">
            <?php
            $zero_args = array(
                'hide_empty' => couponxl_get_option( 'search_include_empty' ) == 'yes' ? false : true,
                'parent' => 0
            );                        
            $search_show_count = couponxl_get_option( 'search_show_count' );
            $search_visible_categories_count = couponxl_get_option( 'search_visible_categories_count' );
            $visible_count = 0;
            ?>
                <li class="<?php echo empty( $offer_cat ) ? 'active current' : '' ?>">
                    <a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array(), array( 'offer_cat', 'coupon' ) ) ) ?>"><?php _e( 'All Categories', 'couponxl' ); ?></a>
                </li>
            <?php
            $offer_cat_term = get_term_by( 'slug', $offer_cat, 'offer_cat' );
            if( !empty( $offer_cat ) && !empty( $offer_cat_term ) ){
                $visible_count = 1;
                $ancestors_array_holder = array();
                $ancestors = get_ancestors( $offer_cat_term->term_id, 'offer_cat' );
                /* show ancestrs and open for each one new ul for its children */
                if( !empty( $ancestors ) ){
                    for( $i=count( $ancestors )-1; $i>=0; $i-- ){
                        $ancestor = get_term_by( 'id', $ancestors[$i], 'offer_cat' );
                        $ancestors_array_holder[] = $ancestor;
                        $count = '';
                        if( $search_show_count == 'yes' ){
                            $count  = couponxl_custom_term_count( $offer_type, $ancestor, 'offer_cat' );
                        }
                        echo '<li class="active"><a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'offer_cat' => $ancestor->slug ) ) ).'">'.$ancestor->name.' '.$count.'</a><ul class="list-unstyled">';
                    }
                }

                $count = '';
                if( $search_show_count == 'yes' ){
                    $count  = couponxl_custom_term_count( $offer_type, $offer_cat_term, 'offer_cat' );
                }
                echo '<li class="active current"><a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'offer_cat' => $offer_cat_term->slug ) ) ).'">'.$offer_cat_term->name.' '.$count.'</a>';

                    $children = get_terms( 'offer_cat',array(
                        'hide_empty' => couponxl_get_option( 'search_include_empty' ),
                        'parent' => $offer_cat_term->term_id
                    ));
                    if( !empty( $children ) ){
                        echo '<ul class="list-unstyled">';
                            foreach( $children as $child ){
                                $count = '';
                                if( $search_show_count == 'yes' ){
                                    $count  = couponxl_custom_term_count( $offer_type, $child, 'offer_cat' );
                                }
                                echo '<li><a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'offer_cat' => $child->slug ) ) ).'">'.$child->name.' '.$count.'</a></li>';
                            }
                        echo '</ul>';
                    }

                echo '</li>';

                for( $i=count( $ancestors_array_holder )-1; $i>=0; $i-- ){
                    $ancestor = $ancestors_array_holder[$i];
                    $children = get_terms( 'offer_cat',array(
                        'hide_empty' => couponxl_get_option( 'search_include_empty' ),
                        'parent' => $ancestor->term_id
                    ));
                    if( !empty( $children ) ){
                        foreach( $children as $child ){
                            if( $child->term_id != $offer_cat_term->term_id ){
                                $count = '';
                                if( $search_show_count == 'yes' ){
                                    $count  = couponxl_custom_term_count( $offer_type, $child, 'offer_cat' );
                                }
                                echo '<li><a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'offer_cat' => $child->slug ) ) ).'">'.$child->name.' '.$count.'</a></li>';
                            }
                        }
                    }
                    echo '</ul></li>';
                }


                if( empty( $ancestors ) ){
                    $zero_args['exclude'] = array( $offer_cat_term->term_id );
                }
                else{
                    $zero_args['exclude'] = array( $ancestors[count($ancestors) - 1] );
                }
            }
            $zero_level_terms = get_terms( 'offer_cat', $zero_args );
            if( !empty( $zero_level_terms ) ){
                foreach( $zero_level_terms as $zero_level_term ){
                    $visible_count++;
                    $count = '';
                    if( $search_show_count == 'yes' ){
                        $count = '<span class="count">0</span>';
                        $count  = couponxl_custom_term_count( $offer_type, $zero_level_term, 'offer_cat' );
                    }
                    echo '<li class="'.( $visible_count > $search_visible_categories_count ? 'hidden' : '' ).'">
                            <a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'offer_cat' => $zero_level_term->slug ) ) ).'">'.$zero_level_term->name.' '.$count.'</a>
                         </li>';
                }
            }
            ?>
        </ul>
        <?php

            if( $visible_count > $search_visible_categories_count ){
                echo '<div class="show-all"><a href="javascript:;" class="expand-filter closed" data-target=".ex_offer_cat" data-less="'.__( '-SHOW LESS CATEGORIES-', 'couponxl' ).'">'.__( '-SHOW ALL CATEGORIES-', 'couponxl' ).'</a></div>';
            }
        ?>

        <?php /* LOCATIONS */  ?>
        <?php
        $search_page_location_filter_title = couponxl_get_option( 'search_page_location_filter_title' );
        if( !empty( $search_page_location_filter_title ) ):
        ?>                    
            <div class="widget-title">
                <h4>
                    <?php echo $search_page_location_filter_title ?>
                </h4>
            </div>
        <?php endif; ?>
        <ul class="list-unstyled ex_location">
            <?php
            $zero_args = array(
                'hide_empty' => couponxl_get_option( 'search_include_empty' ) == 'yes' ? false : true,
                'parent' => 0
            );                        
            $search_show_count = couponxl_get_option( 'search_show_count' );
            $search_visible_locations_count = couponxl_get_option( 'search_visible_locations_count' );
            $visible_count = 0;
            ?>
                <li class="<?php echo empty( $location ) ? 'active current' : '' ?>">
                    <a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array(), array( 'location', 'coupon' ) ) ) ?>"><?php _e( 'All Locations', 'couponxl' ); ?></a>
                </li>
            <?php
            $location_term = get_term_by( 'slug', $location, 'location' );
            if( !empty( $location ) && !empty( $location_term ) ){
                $visible_count = 1;
                $ancestors_array_holder = array();
                $ancestors = get_ancestors( $location_term->term_id, 'location' );
                if( !empty( $ancestors ) ){
                    for( $i=count( $ancestors )-1; $i>=0; $i-- ){
                        $ancestor = get_term_by( 'id', $ancestors[$i], 'location' );
                        $ancestors_array_holder[] = $ancestor;
                        $count = '';
                        if( $search_show_count == 'yes' ){
                            $count  = couponxl_custom_term_count( $offer_type, $ancestor, 'location' );
                        }
                        echo '<li class="active"><a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'location' => $ancestor->slug ) ) ).'">'.$ancestor->name.' '.$count.'</a><ul class="list-unstyled">';
                    }
                }

                $count = '';
                if( $search_show_count == 'yes' ){
                    $count  = couponxl_custom_term_count( $offer_type, $location_term, 'location' );
                }
                echo '<li class="active current"><a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'location' => $location_term->slug ) ) ).'">'.$location_term->name.' '.$count.'</a>';

                $children = get_terms( 'location',array(
                    'hide_empty' => couponxl_get_option( 'search_include_empty' ),
                    'parent' => $location_term->term_id
                ));
                if( !empty( $children ) ){
                    echo '<ul class="list-unstyled">';
                        foreach( $children as $child ){
                            $count = '';
                            if( $search_show_count == 'yes' ){
                                $count  = couponxl_custom_term_count( $offer_type, $child, 'location' );
                            }
                            echo '<li><a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'location' => $child->slug ) ) ).'">'.$child->name.' '.$count.'</a></li>';
                        }
                    echo '</ul>';
                }

                echo '</li>';

                for( $i=count( $ancestors_array_holder )-1; $i>=0; $i-- ){
                    $ancestor = $ancestors_array_holder[$i];
                    $children = get_terms( 'location',array(
                        'hide_empty' => couponxl_get_option( 'search_include_empty' ),
                        'parent' => $ancestor->term_id
                    ));
                    if( !empty( $children ) ){
                        foreach( $children as $child ){
                            if( $child->term_id != $location_term->term_id ){
                                $count = '';
                                if( $search_show_count == 'yes' ){
                                    $count  = couponxl_custom_term_count( $offer_type, $child, 'location' );
                                }
                                echo '<li><a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'location' => $child->slug ) ) ).'">'.$child->name.' '.$count.'</a></li>';
                            }
                        }
                    }
                    echo '</ul></li>';
                }


                if( empty( $ancestors ) ){
                    $zero_args['exclude'] = array( $location_term->term_id );
                }
                else{
                    $zero_args['exclude'] = array( $ancestors[count($ancestors) - 1] );
                }
            }
            $zero_level_terms = get_terms( 'location', $zero_args );
            if( !empty( $zero_level_terms ) ){
                foreach( $zero_level_terms as $zero_level_term ){
                    $visible_count++;
                    $count = '';
                    if( $search_show_count == 'yes' ){
                        $count = '<span class="count">0</span>';
                        $count = couponxl_custom_term_count( $offer_type, $zero_level_term, 'location' );
                    }
                    echo '<li class="'.( $visible_count > $search_visible_locations_count ? 'hidden' : '' ).'">
                            <a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'location' => $zero_level_term->slug ) ) ).'">'.$zero_level_term->name.' '.$count.'</a>
                          </li>';
                }
            }
            ?>
        </ul>
        <?php
            if( $visible_count > $search_visible_locations_count ){
                echo '<div class="show-all"><a href="javascript:;" class="expand-filter closed" data-target=".ex_location" data-less="'.__( '-SHOW LESS LOCATIONS-', 'couponxl' ).'">'.__( '-SHOW ALL LOCATIONS-', 'couponxl' ).'</a></div>';
            }                    
        ?>                   
    </div>
    <?php 
        if ( is_active_sidebar( 'sidebar-search' ) ){
            dynamic_sidebar( 'sidebar-search' );
        }
    ?>
</div>