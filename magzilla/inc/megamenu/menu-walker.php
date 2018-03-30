<?php
class favethemes_Walker extends Walker_Nav_Menu {
    protected $mzine_menu_css = array();

    function start_el( &$output, $object, $depth = 0, $args = array(), $id = 0) {
        parent::start_el( $output, $object, $depth, $args );

        
        $fave_menu_type = $object->favemenutype;
        $fave_cat_id = $object->favemegamenu;

        $no_of_posts = $object->nav_no_of_posts;
        $fave_posts = $main_posts = $cat_main = $cat_list = $posts_area = $posts_area_end = NULL;

        $fave_subcategories = get_categories(array('child_of' => $fave_cat_id));

        $sub_cats_array = array();

        foreach ($fave_subcategories as $key => $cat_val ) {
            $sub_cats_array[ $cat_val->name ] = $cat_val->term_id;
        }

        $parant_cat = array($fave_cat_id);
        
        $merge_cat_ids = array_merge($parant_cat, $sub_cats_array );

        if( $fave_menu_type == 3 ) {
            if ( $fave_cat_id != NULL ) {

                $j = 0; 
                foreach ($merge_cat_ids as $fave_cat_id ):
                    
                    $fave_posts = '';
                    $j++;

                    if( $j == 1 ) { $active = 'active in'; $no_of_posts = $no_of_posts; } else { $active = ''; $no_of_posts = 4; }

                $fave_args = array( 'cat' => $fave_cat_id,  'post_type' => 'post',  'post_status' => 'publish',  'posts_per_page' => $no_of_posts,  'ignore_sticky_posts'=> 1);
                $fave_qry_latest = $mzine_img = NULL;
                $fave_qry_latest = new WP_Query($fave_args);
                $i = 1;

                $featured_image = '';

                if( $no_of_posts > 4  || $no_of_posts == '' ) { $css_classes = 'slide'; } else { $css_classes = 'col-xs-3 col-sm-3 col-md-3 col-lg-3'; }

                while ( $fave_qry_latest->have_posts() ) {

                        $fave_qry_latest->the_post();

                        $menu_categories = get_the_category( get_the_ID() );

                        $menu_cats_html = '';

                        if($menu_categories){
                            foreach($menu_categories as $category) {
                                $cat_id = $category->cat_ID;
                                $cat_link = get_category_link( $cat_id );

                                $menu_cats_html .= '<a class="cat-color-'.intval( $cat_id ).'" href="'.esc_url($cat_link).'">'.esc_html($category->name).'</a>';
                            }
                        }

                        if ( 'gallery' == get_post_format() ): // Gallery
                            $article_icon = '<div class="post-type-icon"><i class="fa fa-picture-o"></i></div>';
                        elseif ( 'video' == get_post_format() ): // Video
                            $article_icon = '<div class="post-type-icon"><i class="fa fa-video-camera"></i></div>';
                        elseif ( 'audio' == get_post_format() ): // Audio
                            $article_icon = '<div class="post-type-icon"><i class="fa fa-microphone"></i></div>';
                        elseif ( 'link' == get_post_format() ): // Link
                            $article_icon = '<div class="post-type-icon"><i class="fa fa-link"></i></div>';
                        else: 
                            $article_icon = '';
                        endif;

                        $fave_permalink = get_permalink( get_the_ID() );

                        if( has_post_thumbnail() ) {
                            $thumbnail = fave_featured_image( get_the_ID(), 260, 195, true, true, true );

                            $featured_image = '<div class="featured-image-wrap">
                                '.$article_icon.'
                                <div class="category-label">'.$menu_cats_html.'</div>
                                <a href="'.$fave_permalink.'">
                                    <img class="featured-image lazyOwl" width="260" height="195" src="'.esc_url( $thumbnail ).'" alt="'.get_the_title().'">
                                </a>
                            </div>';
                        }
                        

                        $fave_posts .= '<div class="'.$css_classes.'">
                                                <div class="menu-post">
                                                    '.$featured_image.'
                                                    <article class="post">
                                                        <h2 class="post-title module-small-title"><a href="'.esc_url( $fave_permalink ).'">'.get_the_title().'</a></h2>
                                                    </article>
                                                </div>
                                            </div>';


                        $i++;
                }



                wp_reset_postdata();

                if( $no_of_posts > 4 || $no_of_posts == '' ) { 
                        
                        $rnr_id = fave_unique_key();
                        if ( is_rtl() ) { $magzilla_rtl = 'true'; } else { $magzilla_rtl = 'false'; }
                        ?>

                        <script>
                        jQuery(document).ready(function($) {

                            $('#owl-carousel-menu-<?php echo esc_attr( $rnr_id ); ?>').owlCarousel({
                                rtl: <?php echo $magzilla_rtl; ?>,
                                loop: false,
                                touchDrag: false,

                                responsive:{
                                    0:{
                                        items:2
                                    },
                                    479:{
                                        items:4
                                    },
                                    768:{
                                        items:4
                                    },
                                    980:{
                                        items:4
                                    },
                                    1199:{
                                        items:4
                                    }
                                },

                                //Autoplay
                                autoPlay : false,
                                autoplayHoverPause : true,

                                // Navigation
                                nav : true,
                                navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                                navRewind : true,
                                dots: false,

                                // Responsive
                                responsiveClass:true,
                                responsiveRefreshRate : 200,
                                responsiveBaseElement: window,

                                //Lazy load
                                lazyLoad : true,
                                lazyFollow : true,
                                lazyEffect : "fade",

                            });

                        });

                        </script>

                        <?php
                        $slider_wrap = '<div id="owl-carousel-menu-'.esc_attr( $rnr_id ).'" class="owl-carousel owl-carousel-menu">'; $slider_wrap_end = '</div>';

                    } else { $slider_wrap = $slider_wrap_end = ''; }

                $main_posts .= '<div role="tabpanel" class="tab-pane fade '. esc_attr( $active ).'" id="tab'.esc_attr( $fave_cat_id ).'">
                                    <div class="row-sub-menu">
                                    '.$slider_wrap.'
                                        '.$fave_posts.'
                                    '.$slider_wrap_end.'
                                    </div>
                                </div>';

                endforeach;

            } // End $fave_cat_id = null
        } // End $fave_menu_type == 3

        if ( $fave_posts != NULL ) {


                 if( !empty( $fave_subcategories )) {

                    $posts_area = '<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 mega_menu"><div class="tab-content">'; $posts_area_end = '</div></div>';

                    $fave_cat = $object->favemegamenu;
                    $cat_list .= '<li role="presentation" class="tab-link active">';
                        $cat_list .= '<a href="#tab'.esc_attr( $fave_cat ).'" role="tab" data-toggle="tab" aria-expanded="true">'.__( 'All', 'magzilla' ).'</a>';
                    $cat_list .= '</li>';

                    foreach ( $fave_subcategories as $key => $value ) {
                        $cat_list .= '<li role="presentation" class="tab-link">';
                            $cat_list .= '<a href="#tab'.esc_attr( $value->term_id ).'" role="tab" data-toggle="tab" aria-expanded="false">'.esc_attr( $value->name ).'</a>';
                        $cat_list .= '</li>';
                    } 

                    $cat_main .='<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">';
                        $cat_main .='<ul class="nav menu-tab-nav text-right" role="tablist">';
                            $cat_main .= $cat_list;
                        $cat_main .='</ul>';        
                    $cat_main .='</div>';
                 }

                 $output .= '<ul class="dropdown-menu"><li>
                            <div class="yamm-content">
                                <div class="row">
                                    '.$cat_main.'

                                    
                                    '.$posts_area.'

                                        '. $main_posts .'

                                    '.$posts_area_end.'

                                </div>
                             </div>
                             </li></ul>';
        }


        
    }


    function start_lvl( &$output, $depth=0, $args = array() ) {


        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'dropdown-menu'
            );
        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<ul class="' . esc_attr( $class_names ) . '">' . "\n";
    }

    function end_lvl( &$output, $depth=0, $args = array() ) {


                    $indent = str_repeat("\t", $depth);
                    $output .= "$indent</ul>\n";

    }
}
?>