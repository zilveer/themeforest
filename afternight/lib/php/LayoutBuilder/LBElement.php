<?php
class LBElement{
    private $words_full_width = array( 0 => 'twelve', 1 => 'twelve', 2 => 'six', 3 => 'four', 4 => 'three', 5 => 'three', 6 => 'two', 7 => 'two', 8 => 'one', 9 => 'one', 10 => 'one', 11 => 'one', 12 => 'one' );
    function columns_arabic_to_word( $arabic ){
        return $this -> words_full_width[ $arabic ];
    }

    function __construct( $data ){
        $this -> columns = 3;
        $this -> element_columns = 12;
        $this -> id = '__element__';
        $this -> name = __( 'New element' , 'cosmotheme' );
        $this -> type = 'empty';
        $this -> id = '_id_';
        $this -> view = 'list_view';
        $this -> categories = array();
        $this -> eventcategories = array();
        $this -> tags = array();
        $this -> portfolios = array();
        $this -> boxes = array();
        $this -> teams = array();
        $this -> banners = array();
        $this -> page = -1;
        $this -> post = -1;
        $this -> carousel = 'no';
        $this -> pagination = 'no';
        $this -> load_more = 'no';
        $this -> tabber = 'no';
        $this -> numberposts = 12;
        $this -> text = '';
        $this -> filter = 'no';
        $this -> sidebar = '';
        $this -> show_title = 'yes';
        $this -> is_ajax = false;
        $this -> is_last = false;
        $this -> list_view_thumb_size = 'large_thumb';
        $this -> behaviour = 'none';
        $this -> orderby = 'date';
        $this -> order = 'desc';
        $this -> template = 'front_page';
        $this -> postID = 0;
        $this -> pageID = 0;
        $this -> eventID = 0;
        $this -> show_grid_view_excerpt = 'yes';
        $this -> show_grid_view_meta = 'yes';
        $this -> sidebar_class = '';
        $this -> list_view_excerpt = 'excerpt';
        $this -> testimonials = array();
        $this -> enb_masonry = 'no';
        $this -> remove_gutter = 'no';
        $this -> enb_hide_excerpt = 'no';
        $this -> delimiter_type = 'white_space';
        $this -> delimiter_margin = 'margin_30px';
        $this -> delimiter_text_color = '#000000';
        $this -> text_align = 'left';

        if ((int) get_query_var('paged') > 0) {
            $this -> paged = get_query_var('paged');
        } else {
            if ((int) get_query_var('page') > 0) {
                $this -> paged = get_query_var('page');
            } else {
                $this -> paged = 1;
            }
        }
            
        foreach( $data as $identifier => $value ){
            $this ->{ $identifier } = $value;
        }

        if( 'carousel' == $this -> behaviour ){
            $this -> carousel = 'yes';
        }else if( 'pagination' == $this -> behaviour ){
            $this -> pagination = 'yes';
        }else if( 'load_more' == $this -> behaviour ){
            $this -> load_more = 'yes';
        }else if( 'tabber' == $this -> behaviour ){
            $this -> tabber = 'yes';
        }else if( 'filters' == $this -> behaviour ){
            $this -> filter = 'yes';
        }
    }

    function get_prefix(){
        return $this -> row -> get_prefix() . "[_elements][$this->id]";
    }

    function render_backend(){
        if( $this -> row -> is_additional ){
            include get_template_directory() . '/lib/templates/layoutadditionalelement.php';
        }else{
            include get_template_directory() . '/lib/templates/layoutelement.php';
        }
    }

    function render_frontend(){
        $this -> is_fullwidth = ( 12 == $this -> element_columns ) && !( $this -> row -> template -> layout_has_sidebars );
        $type = $this -> type;
        if($this -> type == 'textelement') {
            $text_class = 'textelement';
        }else{ $text_class= ''; }
        if ($this -> type == 'textelement') {
            if ($this -> text_align == 'left') {
                $text_align_class = 'align-left';
            }elseif ($this -> text_align == 'center'){
                $text_align_class = 'align-center';
            }elseif ($this -> text_align == 'right'){
                $text_align_class = 'align-right';
            }
        }else { $text_align_class = ''; }
        echo '<div class="' . $text_class . ' ' . $text_align_class . ' ' . LBRenderable::$words[ $this -> element_columns ] . ' columns">';
            if ($this -> behaviour == 'tabber') {
                echo self::render_tabber();
            }else if( $this -> row -> is_additional ){
                $this -> show_title = false;
                global $wp_query;
                if( $this -> row -> template -> callback ){
                    call_user_func( $this -> row -> template -> callback, $this );
                }else if( ( is_search() || is_archive() || is_home() )  ){
                    $this -> restore_query();
                    $this -> render_frontend_posts( $wp_query -> posts );
                }else if( is_single() && 'portfolio' == get_post_type() ){
                    global $post;
                    $post_meta = meta::get_meta( $post -> ID, 'settings' );

                    global $portfolio_display;
                    
                    if(isset($post_meta['portfolio_display'])){
                        $portfolio_display = $post_meta['portfolio_display'];
                    }else{
                        $portfolio_display = options::get_value(  'blog_post' , 'portfolio_display' );
                    }  
                    if($portfolio_display == 'landscape' ){
                        get_template_part('single-content-portfolio');      
                    }else{
                        get_template_part('single-content-portfolio-portrait');   
                    }
                }else if( is_singular() ){
                    get_template_part('single-content');
                }
            }else{
                
                if(isset($_GET['fp_element'])){ 
                    /*we have 'fp_element' in the URL when visiting a certain page from a element that has pagination enabled */
                    if($_GET['fp_element'] == $this->id){ /*if we have 'fp_element' in the URL then we want to display only this element*/
                        call_user_func( array ( $this, "render_frontend_$type" ) );        
                    }
                }else{ /*else display all the elements*/
                    call_user_func( array ( $this, "render_frontend_$type" ) );    
                }
                
            }
            wp_reset_query();
        echo '</div>';
    }

    /*Tabber element are available only for tags and categories*/
    function render_tabber(){ 
        if($this -> show_title == 'yes' ){ ?>
            <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
        <?php } 
        echo '<div class="row element tabment-view">';
        if( $this -> type == 'tag' && is_array( $this -> tags ) && count( $this -> tags ) ){
            $tags = array();
            echo '<div class="twelve columns">';
            echo '<div class="tabment">';
            echo '<ul class="tabment-tabs">';
            foreach( $this -> tags as $index => $term_id ){
                $tag = get_tag( $term_id );
                if ($index == 0) { $class = 'class="active"'; } else { $class = ''; }
                echo '<li><a '. $class .' href="#'. $tag -> slug .'">'. $tag -> name .'</a></li>';
            }
            echo '</ul>'; 
            echo '</div>';
            echo '</div>'; 
            echo '<div class="twelve columns">';
            echo '<div class="tabment-container">';
            echo '<ul class="tabment-tabs-container">';
            foreach( $this -> tags as $index => $term_id ){
                $tag = get_tag( $term_id );
                if ($index != 0) { $class = 'hidden'; } else { $class = ''; }
                echo '<li id="'. $tag -> slug .'" class="tab_menu_content tabs-container ' . $class . '">';
                global $wp_query;
                $wp_query = new WP_Query( $this -> decorate_query(
                        array(
                            'tag' => $tag -> slug,
                            'post_status' => 'publish',
                            'posts_per_page' => $this -> numberposts,
                            'paged' => $this -> paged
                        )
                    )
                );
                $this -> render_frontend_posts( $wp_query -> posts ); 

                echo '</li>';
            }
            echo '</ul>'; 
            echo '</div>';
            echo '</div>';  

        } elseif( $this -> type == 'category' && is_array( $this -> categories ) && count( $this -> categories ) ){
            $categories = array();
            echo '<div class="twelve columns">';
            echo '<div class="tabment">';
            echo '<ul class="tabment-tabs">';
            

            foreach( $this -> categories as $index => $term_id1 ){
                $cat = get_category( $term_id1 );
                if ($index == 0) { $class = 'class="active"'; } else { $class = ''; }
                echo '<li><a '. $class .' href="#'. $cat -> slug .'">'. $cat -> name .'</a></li>';
            }
            echo '</ul>'; 
            echo '</div>';
            echo '</div>'; 
            echo '<div class="twelve columns">';
            echo '<div class="tabment-container">';
            echo '<ul class="tabment-tabs-container">';
            foreach( $this -> categories as $index => $term_id1 ){
                $cat = get_category( $term_id1 );
                if ($index != 0) { $class = 'hidden'; } else { $class = ''; }
                echo '<li id="'. $cat -> slug .'" class="tab_menu_content tabs-container ' . $class . '">';
                global $wp_query;
                $wp_query = new WP_Query( $this -> decorate_query(
                        array(
                            'cat' => $term_id1,
                            'post_status' => 'publish',
                            'posts_per_page' => $this -> numberposts,
                            'paged' => $this -> paged
                        )
                    )
                );
                $this -> render_frontend_posts( $wp_query -> posts ); 
                               
                echo '</li>';
            }
            echo '</ul>'; 
            echo '</div>';
            echo '</div>';         
        }elseif($this -> type == 'portfolio' && is_array($this -> portfolios) && count($this -> portfolios) ){
            echo '<div class="twelve columns">';
            echo '<div class="tabment">';
            echo '<ul class="tabment-tabs">';
            

            foreach( $this -> portfolios as $index => $term_id1 ){
                $cat = get_term( $term_id1, 'portfolio-category' );
                if ($index == 0) { $class = 'class="active"'; } else { $class = ''; }
                echo '<li><a '. $class .' href="#'. $cat -> slug .'">'. $cat -> name .'</a></li>';
            }
            echo '</ul>'; 
            echo '</div>';
            echo '</div>'; 
            echo '<div class="twelve columns">';
            echo '<div class="tabment-container">';
            echo '<ul class="tabment-tabs-container">';
            
            $portfolios = array();
            foreach( $this -> portfolios as $index => $term_id1 ){
                $term = get_term( $term_id1, 'portfolio-category' );
                if( is_wp_error(( $portfolios ) ) ){
                    continue;
                }
                $portfolios = $term -> slug;

                if ($index != 0) { $class = 'hidden'; } else { $class = ''; }
                echo '<li id="'. $term -> slug .'" class="tab_menu_content tabs-container ' . $class . '">';
                global $wp_query;
                $wp_query = new WP_Query( $this -> decorate_query(
                    array(
                        'portfolio-category' => $portfolios,
                        'post_status' => 'publish',
                        'posts_per_page' => $this -> numberposts,
                        'post_type' => 'portfolio',
                        'fp_element' => $this -> id,
                        'paged' => $this -> paged
                    )
                )
            );
            $this -> render_frontend_posts( $wp_query -> posts );
                               
                echo '</li>';
            }
            echo '</ul>'; 
            echo '</div>';
            echo '</div>';         
        }elseif($this -> type == 'eventcategory' && is_array($this -> eventcategories) && count($this -> eventcategories) ){
            echo '<div class="twelve columns">';
            echo '<div class="tabment">';
            echo '<ul class="tabment-tabs">';
            

            foreach( $this -> eventcategories as $index => $term_id1 ){
                $cat = get_term( $term_id1, 'event-category' );
                if ($index == 0) { $class = 'class="active"'; } else { $class = ''; }
                echo '<li><a '. $class .' href="#'. $cat -> slug .'">'. $cat -> name .'</a></li>';
            }
            echo '</ul>'; 
            echo '</div>';
            echo '</div>'; 
            echo '<div class="twelve columns">';
            echo '<div class="tabment-container">';
            echo '<ul class="tabment-tabs-container">';
            
            $events = array();
            foreach( $this -> eventcategories as $index => $term_id1 ){
                $term = get_term( $term_id1, 'event-category' );
                if( is_wp_error(( $events ) ) ){
                    continue;
                }
                $events = $term -> slug;

                if ($index != 0) { $class = 'hidden'; } else { $class = ''; }
                echo '<li id="'. $term -> slug .'" class="tab_menu_content tabs-container ' . $class . '">';
                global $wp_query;
                $wp_query = new WP_Query( $this -> decorate_query(
                    array(
                        'event-category' => $events,
                        'post_status' => 'publish',
                        'posts_per_page' => $this -> numberposts,
                        'post_type' => 'event',
                        'fp_element' => $this -> id,
                        'paged' => $this -> paged
                    )
                )
            );
            $this -> render_frontend_posts( $wp_query -> posts );
                               
                echo '</li>';
            }
            echo '</ul>'; 
            echo '</div>';
            echo '</div>';         
        }

        echo '</div>';
    }

    function restore_query(){
        global $wp_query;
        $wpargs = $wp_query -> query;
        if( $this -> row -> is_additional && isset( $_POST[ 'wpargs' ] ) && is_array( $restoreargs = $_POST[ 'wpargs' ] ) ){
            foreach( $restoreargs as $label => $value ){
                $wpargs[ $label ] = $value;
            }
        }
        $wpargs[ 'paged' ] = $this -> paged;
        $wpargs[ 'posts_per_page' ] = $this -> numberposts;
        $wp_query = new WP_Query( $wpargs );
    }

    function print_taxonomy_inputs( $box_class, $taxonomies ){
        ?>
            <div class="select-box <?php echo $box_class;?> hidden">
                <?php
                    foreach( $taxonomies as $ID ){
                    ?>
                        <input type="checkbox" name="<?php echo $this -> get_prefix();?>[<?php echo $box_class;?>][]" value="<?php echo $ID;?>" checked="checked">
                    <?php
                    }
                ?>
            </div>
        <?php
    }

    function decorate_wp_query_with_order( $query ){
        if( 'date' == $this -> orderby ){
            $query[ 'orderby' ] = 'date';
        }else if( 'comment_count' == $this -> orderby ){
            $query[ 'orderby' ] = 'comment_count';
        }else if( 'views' == $this -> orderby ){
            $query[ 'meta_key' ] = 'nr_views';
            $query[ 'orderby' ] = 'meta_value_num';
        }else if( 'likes' == $this -> orderby ){
            $query[ 'meta_key' ] = 'nr_like';
            $query[ 'orderby' ] = 'meta_value_num';
        }else if( 'hot_date' == $this -> orderby ){
            $query[ 'meta_key' ] = 'hot_date';
            $query[ 'orderby' ] = 'meta_value_num';
        }

        $query[ 'order' ] = $this -> order;
        return $query;
    }

    function decorate_query( $query ){
        $query[ 'fp_template' ] = $this -> row -> template -> id;
        $query[ 'fp_row' ] = $this -> row -> id;
        $query[ 'fp_element' ] = $this -> id;
        if( 'yes' == $this -> pagination || 'yes' == $this -> load_more ){
            $query[ 'paged' ] = $this -> paged;
        }

        if( 'date' == $this -> orderby ){
            $query[ 'orderby' ] = 'date';
        }else if( 'rand' == $this -> orderby ){
            $query[ 'orderby' ] = 'rand';
        }else if( 'comment_count' == $this -> orderby ){
            $query[ 'orderby' ] = 'comment_count';
        }else if( 'views' == $this -> orderby ){
            $query[ 'meta_key' ] = 'nr_views';
            $query[ 'orderby' ] = 'meta_value_num';
        }else if( 'likes' == $this -> orderby ){
            $query[ 'meta_key' ] = 'nr_like';
            $query[ 'orderby' ] = 'meta_value_num';
        }else if( 'hot_date' == $this -> orderby ){
            $query[ 'meta_key' ] = 'hot_date';
            $query[ 'orderby' ] = 'meta_value_num';
        }else if('start_date' == $this -> orderby){
            $query[ 'meta_key' ] = 'start_date_time';
            $query[ 'orderby' ] = 'meta_value_num';
        }

        $query[ 'order' ] = $this -> order;
        return $query;
    }

    function render_frontend_delimiter(){ 
        if ($this -> delimiter_type == 'pointed') {
            $rgb_color = $this->delimiter_text_color;            
            $delimiter_border = "border-top: 1px dotted $rgb_color;";
        }elseif ($this -> delimiter_type == 'doublepointed') {
            $rgb_color = $this->delimiter_text_color; 
            $delimiter_border = "border-top: 1px dotted $rgb_color; border-bottom: 1px dotted $rgb_color;";
        }elseif ($this -> delimiter_type == 'line') {
            $rgb_color = $this->delimiter_text_color; 
            $delimiter_border = "border-top: 1px solid $rgb_color;";
        }elseif ($this -> delimiter_type == 'doubleline') {
            $rgb_color = $this->delimiter_text_color; 
            $delimiter_border = "border-top: 1px solid $rgb_color; border-bottom: 1px solid $rgb_color;";
        }else{
            $delimiter_border = "";
        }
        echo '<div style="'.$delimiter_border.'" class="delimiter-type '.$this -> delimiter_type . ' ' . $this -> delimiter_margin .' "></div>';
    }

    function render_frontend_empty(){
        echo " ";
    }

    function render_frontend_latest(){/*LATEST POSTS*/
        global $wp_query;
        $query_options = array(
            'post_status' => 'publish',
            'post_type' => 'post',
            'posts_per_page' => $this -> numberposts
        );

        $query_options = $this -> decorate_query( $query_options );
        $wp_query = new WP_Query( $query_options );

        $this -> render_frontend_posts( $wp_query -> posts );
    }
    
    function render_frontend_latest_events(){/*LATEST events*/
        global $wp_query;
        $query_options = array(
            'post_status' => 'publish',
            'post_type' => 'event',
            'posts_per_page' => $this -> numberposts
        );

        $query_options = $this -> decorate_query( $query_options );
        $wp_query = new WP_Query( $query_options );

        $this -> render_frontend_posts( $wp_query -> posts );
    }
    
    function render_frontend_textelement(){
        if($this -> show_title == 'yes'){ ?>
        <div class=" carousel-title" >
            <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
        </div>
        <?php }
        echo do_shortcode($this -> text); 
    }

    function render_frontend_featured(){  /*FEATURED POSTS*/
        global $wp_query;
        $query_options = array(
            'post_type' => array( 'post', 'portfolio'),
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $this -> numberposts,
            'meta_query' => array(
                array(
                    'key' => 'nr_like',
                    'value' => trim(options::get_value('likes', 'min_likes') ),
                    'compare' => '>=',
                    'type' => 'numeric',
                )
            )
        );

        $query_options = $this -> decorate_query( $query_options );
        $wp_query = new WP_Query( $query_options );

        $this -> render_frontend_posts( $wp_query -> posts );
    }

    function render_frontend_posts_grid_view_thumbnails_carousel( $posts ){
        $rnd = mt_rand(0,300);
        echo '<div class="thumb-view row ">';
        if($this -> show_title == 'yes'){ ?>
        <div class=" carousel-title" >
            <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
        </div>
        <?php }
        echo '<div class="carousel-wrapper" >';

        echo '<ul class="carousel-nav">';
        echo '<li class="carousel-nav-left">&larr;</li>';
        echo '<li class="carousel-nav-right">&rarr;</li>';
        echo '</ul>'; 
        echo '<div class="carousel-container">';
        foreach( $posts as $post ){
            echo '<div class="'.$this -> columns_arabic_to_word( $this -> columns ).' columns" >';
            post::grid_view_thumbnails($post, '', '', $filter_type = '', $taxonomy = 'category', $element_type = 'article');
            echo '</div>';
 
        }
        echo '</div>';
        echo '</div>';
        echo '</div>'; 
        
    }

    function render_frontend_posts_grid_view_carousel( $posts ){
        $rnd = mt_rand(0,300);
        
        echo '<div class="row grid-view ">';
        if($this -> show_title == 'yes'){ ?>
            <div class="carousel-title">
                <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
            </div>
        <?php } 
        
        echo '<div class="carousel-wrapper" >';

        echo '<ul class="carousel-nav">';
        echo '<li class="carousel-nav-left">&larr;</li>';
        echo '<li class="carousel-nav-right">&rarr;</li>';
        echo '</ul>'; 
        echo '<div class="carousel-container">';
        foreach( $posts as $post ){
            
            $show_excerpt = ( $this -> show_grid_view_excerpt == 'yes' );
            $show_meta = ( $this -> show_grid_view_meta == 'yes' );

            echo '<div class="'.$this -> columns_arabic_to_word( $this -> columns ).' columns">';
            
            call_user_func( array( 'post', $this -> view ), $post, '', '', $show_excerpt, $show_meta,$element_type = 'article',$is_masonry = false, $is_carousel = true);
            echo '</div>'; 
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';        
    }

    function render_frontend_posts_grid_view_thumbnails( $posts ){
        $filter_type_rand = mt_rand(1,3000); /* generate a random number to have distinct data-value for filters */

        $taxonomy = 'category';
        switch ($this -> type) {
            case 'tag':
                $tags = array();
                foreach( $this -> tags as $term_id ){
                    $tags[] = $term_id ;

                }

                $term_ids = $tags;
                $taxonomy = 'post_tag';
                break;
            case 'portfolio':
                $term_ids = $this -> portfolios;
                $taxonomy = 'portfolio-category';
                break;
            case 'eventcategory':
                $term_ids = $this -> eventcategories;
                $taxonomy = 'event-category';
                break;                
            case 'category':
                /*category*/
                $term_ids = $this -> categories;
                $taxonomy = 'category';
                break;

            default:
                break;
        }

        /*define nr_columns var for functions.js*/
        wp_localize_script( 'functions', 'Masonry', array(
            'nr_columns'          => $this -> columns
            )
        );

        if($this -> enb_masonry == 'yes'){
            $is_masonry = true;
            $masonry_class = 'masonry';
        }else{  
            $masonry_class = '';
            $is_masonry = false;
        }

        if(!($this ->  is_ajax)){
            
            echo '<div class="row thumb-view ">';
            echo '<div class="twelve columns">';


            $filter_class = '';

            if($this -> show_title == 'yes' && $this -> tabber != 'yes'){
                $title = '<h2 class="content-title filter"><span>'. $this -> name.'</span></h2>';

            }else{

                $title = '';
            }

            if($this -> load_more == 'no' && $this -> pagination == 'no' && $this -> carousel == 'no' && $this -> tabber == 'no'){


                if(isset($term_ids) && isset($taxonomy) && ( $this -> filter == 'yes' ) ){
                    $filters_container = get_filters( $term_ids, $taxonomy, $filter_type = $filter_type_rand, $title );
                }



                if(isset($filters_container) && strlen($filters_container)){
                    $filter_class = 'filter-on';

                    echo $filters_container;
                    echo '<div class="clear"></div>';

                }else if($this -> show_title == 'yes' && $this -> tabber != 'yes'){
                    echo '<h2 class="content-title"><span>'.$this -> name.'</span></h2>';
                    echo '<div class="clear"></div>';
                }
            }else if($this -> show_title == 'yes' && $this -> tabber != 'yes'){
                echo '<h2 class="content-title"><span>'.$this -> name.'</span></h2>';

                echo '<div class="clear"></div>';
            }

            $ul_id = mt_rand(1,9999);
            if( $this -> remove_gutter == 'yes'){
                $gutter_class = ' no_gutter ';
            }else{
                $gutter_class = '';
            }
            echo '<div class=" row  '.$gutter_class.$filter_class.' '.$masonry_class.' thumbs-list image-grid " id="ul-'.$ul_id.'" >';
        }   /*EOF if(!$this ->  is_ajax)*/

        $counter = 1;

        foreach( $posts as $post ){
            $additional_class = '';
            if( ($counter % $this -> columns) == 1 ){
                $additional_class = 'first-elem';

            }
            if(($this ->  is_ajax)){ $additional_class .= ' hidden ';}

            call_user_func( array( 'post', $this -> view ), $post, $this -> columns_arabic_to_word( $this -> columns ) . ' columns', $additional_class, $filter_type = $filter_type_rand, $taxonomy, $element_type = 'article', $is_masonry = $is_masonry );
            $counter++;
        }

        if(!($this ->  is_ajax)){

            echo '</div>';

            echo '</div>';
            echo '</div>';
            if($this -> load_more == 'yes' && 'no' == $this -> pagination){
                $load_more_btn = sprintf(__( '...', 'cosmotheme' ), '<span>','</span>');
                $view = 'grid_view_thumbnails';

                $template_id = $this -> row -> template -> id;
                $row_id = $this -> row -> id;
                $element_id = $this -> id;
                ?>
            <div class="row ">
                <div class="twelve columns">
                    <div id="fountainG" class="ajax-ul-<?php echo $ul_id; ?>">
                        <div id="fountainG_1" class="fountainG"></div>
                        <div id="fountainG_2" class="fountainG"></div>
                        <div id="fountainG_3" class="fountainG"></div>
                        <div id="fountainG_4" class="fountainG"></div>
                        <div id="fountainG_5" class="fountainG"></div>
                        <div id="fountainG_6" class="fountainG"></div>
                        <div id="fountainG_7" class="fountainG"></div>
                        <div id="fountainG_8" class="fountainG"></div>
                    </div>                
                </div>
            </div>
            <?php 
            global $wp_query;
            $posts_per_page_dem = $wp_query -> query;
            $posts_per_page = $posts_per_page_dem ['posts_per_page'];
            $post_count = $wp_query -> found_posts;
            if($posts_per_page < $post_count ){
                    ?>
                    <div class="row ">
                        <div class="twelve columns">
                            <div class="load-more" container_id="ul-<?php echo $ul_id; ?>" current_page="1" onclick="load_more(jQuery(this),'<?php echo $view; ?>','<?php echo $this -> type; ?>','<?php echo $element_id; ?>','<?php echo $row_id; ?>', '<?php echo $template_id; ?>');">
                                <?php echo $load_more_btn; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }

        }   /*EOF if(!$this ->  is_ajax)*/
    }

    function render_frontend_posts_box_view_thumbs($posts){

        echo '<div class="row box-view ">';

        if( 'yes' == $this -> show_title ){
            echo '<div class="twelve column">';
            echo '<h2 class="content-title"><span>' . $this -> name . '</span></h2>';
            echo '</div>';
        }

        $counter = 1;

        foreach( $posts as $post ){
            $additional_class = '';
            if( ($counter % $this -> columns) == 1 ){
                $additional_class = ' first-elem ';
            }

            call_user_func( array( 'post', $this -> view ), $post, $this -> columns_arabic_to_word( $this -> columns ) . ' columns', $additional_class );
            
            $counter ++;
        }
        echo '</div>';
    }

    function render_frontend_posts_timeline_view( $posts, $timeline_elem_class = ' timeline-view-right-elem ' ){

        if(!($this ->  is_ajax)){
            echo '<div class=" row timeline-view thumb-view ">';
            if( 'yes' == $this -> show_title && $this -> tabber != 'yes'){
                echo '<div class="twelve columns"><h2 class="content-title"><span>' . $this -> name . '</span></h2></div>';
            }
            echo '<div class="twelve columns">';
            $ul_id = mt_rand(1,9999);
            echo '<div class="row" id="div-'.$ul_id.'">';
            
            echo '<div class="center-separator"></div>';
            
        }

        if( $this ->  is_ajax && isset($this -> timeline_class ) && strlen(trim($this -> timeline_class))){ /* if is ajax and the timeline class is defined */
            /*set previous timeline class to the last timeleine ement class available on the page*/
            /*we do this to have the correct alignement after load more is clicked*/
            $timeline_elem_class = $this -> timeline_class; 
        }

        foreach( $posts as $post ){
            if( trim($timeline_elem_class) == 'timeline-view-right-elem'){ /*check previous element class*/
                $timeline_elem_class = ' timeline-view-left-elem ';                
            }else{
                $timeline_elem_class = ' timeline-view-right-elem ';                
            }           

            post::timeline_view( $post, $timeline_elem_class);
        }
            echo '</div>';
        if(!($this ->  is_ajax)){
            echo '</div>';
            echo '</div>';
            if($this -> load_more == 'yes'  && 'no' == $this -> pagination){
                $load_more_btn = sprintf(__( '...', 'cosmotheme' ), '<span>','</span>');
                $view = 'timeline_view';
                $template_id = $this -> row -> template -> id;
                $row_id = $this -> row -> id;
                $element_id = $this -> id;
                ?>
            <div class="row ">
                <div class="twelve columns">
                    <div id="fountainG" class="ajax-div-<?php echo $ul_id; ?>">
                        <div id="fountainG_1" class="fountainG"></div>
                        <div id="fountainG_2" class="fountainG"></div>
                        <div id="fountainG_3" class="fountainG"></div>
                        <div id="fountainG_4" class="fountainG"></div>
                        <div id="fountainG_5" class="fountainG"></div>
                        <div id="fountainG_6" class="fountainG"></div>
                        <div id="fountainG_7" class="fountainG"></div>
                        <div id="fountainG_8" class="fountainG"></div>
                    </div>                
                </div>
            </div>                
                <div class="twelve columns">
                    <div class="load-more" container_id="div-<?php echo $ul_id; ?>" current_page="1" onclick="load_more(jQuery(this),'<?php echo $view; ?>','<?php echo $this -> type; ?>','<?php echo $element_id; ?>','<?php echo $row_id; ?>', '<?php echo $template_id; ?>');">
                        <?php echo $load_more_btn; ?>
                    </div>
                </div>
            <?php

            }
        }
    }

/*    function render_frontend_posts_news_view( $posts ){
        if(!($this ->  is_ajax)){
            $ul_id = mt_rand(1,9999);
            echo '<div class="row news-view element">';
            echo '<div class="twelve columns">';

            if($this -> show_title == 'yes' && $this -> tabber != 'yes'){ ?>
            <h3 class="content-title"><span><?php echo $this -> name; ?></span></h3>
            <?php }


        }
        if(count($posts)){
            if(!($this ->  is_ajax)){
                echo '<article class=" '.$this -> list_view_thumb_size.'">';
                echo '<div class="row">';
            }
            $count = 1;
            $need_closing = false;
            foreach( $posts as $post ){
                $additional_hidden_class_for_load_more = '';
                if( $this -> is_ajax ){
                    $additional_hidden_class_for_load_more = 'hidden';
                }
                if($count == 1 && !($this ->  is_ajax)){
                    post::news_view($post, $this -> template, $additional_hidden_class_for_load_more,$list_view_thumbs_size = $this -> list_view_thumb_size,$show_full_content = false, $hide_excerpt = false, $show_resized_image = false);
                } else {
                    if($count == 2 && !($this ->  is_ajax)){
                        if('full_width_thumb_news' == $this -> list_view_thumb_size){
                            $more_titles_width = ' five ';
                        }else{
                            $more_titles_width = ' twelve ';
                        }
                
                        echo '<div class="'.$more_titles_width.' columns">';
                        echo '<div class="more-titles">';
                        echo '<ul id="div-'.$ul_id.'">';
                        $need_closing = true;
                    }
                    post::news_view_title_list( $post );
                }
                $count++;
            }
            if($need_closing == true){
                echo '</ul>';
                echo '</div>';
                echo '</div>';
            }   

            

            if(!($this ->  is_ajax)){
                echo '</div>';
                echo '</article>';                
                echo '</div>';
                echo '</div>';

                if($this -> load_more == 'yes'  && 'no' == $this -> pagination){
                    $load_more_btn = sprintf(__( 'Load %s more %s ', 'cosmotheme' ), '<span>','</span>');
                    $view = 'news_view';
                    $template_id = $this -> row -> template -> id;
                    $row_id = $this -> row -> id;
                    $element_id = $this -> id;
                    ?>
                <div class="ajax-div-<?php echo $ul_id; ?> ajax-loader" style="display:none"></div>
                <div class="row ">
                    <div class="twelve columns">
                        <div class="load-more" container_id="div-<?php echo $ul_id; ?>" current_page="1" onclick="load_more(jQuery(this),'<?php echo $view; ?>','<?php echo $this -> type; ?>','<?php echo $element_id; ?>','<?php echo $row_id; ?>', '<?php echo $template_id; ?>');">
                            <?php echo $load_more_btn; ?>
                        </div>
                    </div>
                </div>
                <?php
                }
            }            
        }/*EOF if count($posts)*/
    //}*/
    function render_frontend_posts_grid_view( $posts ){
        if(!($this ->  is_ajax)){
            echo '<div class="row grid-view element">';
            echo '  <div class="twelve columns">';
            if($this -> show_title == 'yes' && $this -> tabber != 'yes'){ ?>
            <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
            <?php }

            $ul_id = mt_rand(1,9999);
            $masonry = ( 'yes' == $this -> enb_masonry ) ? ' masonry' : '';
            echo '<div class="row' . $masonry . '" id="ul-'.$ul_id.'">';

        } /*EOF if(!$this ->  is_ajax)*/

        $counter = 1;
        /*define nr_columns var for functions.js*/
        wp_localize_script( 'functions', 'Masonry', array(
            'nr_columns'          => $this -> columns
            )
        );
        foreach( $posts as $post ){
            $additional_class = '';

            if( ($counter % $this -> columns) == 1 ){
                $additional_class = 'first-elem';
            }
            if( $this -> is_ajax ){
                //$additional_class .= ' hidden';
            }

            if($this -> show_grid_view_excerpt == 'yes'){
                $show_excerpt = true;
            }else{
                $show_excerpt = false;
            }

            if($this -> show_grid_view_meta == 'yes'){
                $show_meta = true;
            }else{
                $show_meta = false;
            }

            if($this -> enb_masonry == 'yes'){
                $is_masonry = true;
            }else{  
                $is_masonry = false;
            }
            if( ($counter % $this -> columns) == 1 && $counter != 1 && $this -> enb_masonry != 'yes'){
                echo '<div class="clear"></div>';
            }            call_user_func( array( 'post', $this -> view ), $post, $this -> columns_arabic_to_word( $this -> columns ) . ' columns', $additional_class, $show_excerpt, $show_meta, $element_type = 'article', $is_masonry = $is_masonry );

            $counter ++;
        }

        if(!($this ->  is_ajax)){

            echo '</div>';

            if($this -> load_more == 'yes'  && 'no' == $this -> pagination){
                $load_more_btn = sprintf(__( '...', 'cosmotheme' ), '<span>','</span>');
                $view = 'grid_view';
                $template_id = $this -> row -> template -> id;
                $row_id = $this -> row -> id;
                $element_id = $this -> id;
                ?>
            <div class="row ">
                <div class="twelve columns">
                    <div id="fountainG" class="ajax-ul-<?php echo $ul_id; ?>">
                        <div id="fountainG_1" class="fountainG"></div>
                        <div id="fountainG_2" class="fountainG"></div>
                        <div id="fountainG_3" class="fountainG"></div>
                        <div id="fountainG_4" class="fountainG"></div>
                        <div id="fountainG_5" class="fountainG"></div>
                        <div id="fountainG_6" class="fountainG"></div>
                        <div id="fountainG_7" class="fountainG"></div>
                        <div id="fountainG_8" class="fountainG"></div>
                    </div>                
                </div>
            </div>                    
            <div class="row ">
                <div class="twelve columns">
                    <div class="load-more" container_id="ul-<?php echo $ul_id; ?>" current_page="1" onclick="load_more(jQuery(this),'<?php echo $view; ?>','<?php echo $this -> type; ?>','<?php echo $element_id; ?>','<?php echo $row_id; ?>', '<?php echo $template_id; ?>');">
                        <?php echo $load_more_btn; ?>
                    </div>
                </div>
            </div>
            <?php

            }
            echo '    </div>'; // EOF twelve columns
            echo '</div>';  // EOF class="row grid-view element"
        } /*EOF if(!$this ->  is_ajax)*/
    }

    function render_frontend_posts_list_view( $posts ){
        if(!($this ->  is_ajax)){
            $ul_id = mt_rand(1,9999);
            echo '<div class="row list-view " id="div-'.$ul_id.'">';

            if($this -> show_title == 'yes' && $this -> tabber != 'yes'){ ?>
            <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
            <?php }


        }
        foreach( $posts as $post ){
            $additional_hidden_class_for_load_more = 'element';
            if( $this -> is_ajax ){
                $additional_hidden_class_for_load_more = 'element hidden';
            }

            if($this -> list_view_excerpt == 'excerpt'){$show_full_content = false;}else{$show_full_content = true;}
            if($this -> enb_hide_excerpt == 'yes'){$hide_excerpt = true;}else{$hide_excerpt = false;}

            call_user_func( array( 'post', $this -> view ), $post, $this -> template, $additional_hidden_class_for_load_more, $this -> list_view_thumb_size, $show_full_content, $hide_excerpt );
        }

        if(!($this ->  is_ajax)){
            echo '</div>';

            if($this -> load_more == 'yes'  && 'no' == $this -> pagination){
                $load_more_btn = sprintf(__( '...', 'cosmotheme' ), '<span>','</span>');
                $view = 'list_view';
                $template_id = $this -> row -> template -> id;
                $row_id = $this -> row -> id;
                $element_id = $this -> id;
                ?>
            <div class="row ">
                <div class="twelve columns">
                    <div id="fountainG" class="ajax-div-<?php echo $ul_id; ?>">
                        <div id="fountainG_1" class="fountainG"></div>
                        <div id="fountainG_2" class="fountainG"></div>
                        <div id="fountainG_3" class="fountainG"></div>
                        <div id="fountainG_4" class="fountainG"></div>
                        <div id="fountainG_5" class="fountainG"></div>
                        <div id="fountainG_6" class="fountainG"></div>
                        <div id="fountainG_7" class="fountainG"></div>
                        <div id="fountainG_8" class="fountainG"></div>
                    </div>                
                </div>
            </div>                    
            <div class="row ">
                <div class="twelve columns">
                    <div class="load-more" container_id="div-<?php echo $ul_id; ?>" current_page="1" onclick="load_more(jQuery(this),'<?php echo $view; ?>','<?php echo $this -> type; ?>','<?php echo $element_id; ?>','<?php echo $row_id; ?>', '<?php echo $template_id; ?>');">
                        <?php echo $load_more_btn; ?>
                    </div>
                </div>
            </div>
            <?php
            }
        }
    }

    /*Below are the methods that will initialize each content type on front page*/
    /*==========================================================================*/
    /****************************************************************************/

    function no_posts_found(){
        ?>
    <div class="no-posts-found">
        <?php echo __( 'No posts found' , 'cosmotheme' );?>
    </div>
    <?php
    }

    function render_frontend_category(){  /*CATEGORIES*/
        global $wp_query;
        if( is_array( $this -> categories ) && count( $this -> categories ) ){
            $categories = implode( ',', $this -> categories );
            $wp_query = new WP_Query( $this -> decorate_query(
                    array(
                        'cat' => $categories,
                        'post_status' => 'publish',
                        'posts_per_page' => $this -> numberposts,
                        'paged' => $this -> paged
                    )
                )
            );
            $this -> render_frontend_posts( $wp_query -> posts );
        }else{
            $this -> no_posts_found();
        }
    }

    function render_frontend_eventcategory(){
        
        global $wp_query;
        if( is_array( $this -> eventcategories ) && count( $this -> eventcategories ) ){
            
            $wp_query = new WP_Query( $this -> decorate_query(
                    array(
                        'post_type' => 'event',
                        'post_status' => 'publish',
                        'tax_query' => array(
                                array(
                                    'taxonomy' => 'event-category',
                                    'field' => 'id',
                                    'terms' => $this -> eventcategories,
                                    'operator' => 'IN'
                                )
                            ),
                        'posts_per_page' => $this -> numberposts,
                        'paged' => $this -> paged
                    )
                )
            );
            $this -> render_frontend_posts( $wp_query -> posts );
        }else{
            $this -> no_posts_found();
        }
    }

    function render_frontend_tag(){     /*TAGS*/
        if( is_array( $this -> tags ) && count( $this -> tags ) ){
            $tags = array();
            foreach( $this -> tags as $term_id ){
                $tag = get_tag( $term_id );
                $tags[] = $tag -> slug;
            }
            $tags = implode( ',', $tags );
            global $wp_query;
            $wp_query = new WP_Query( $this -> decorate_query(
                    array(
                        'tag' => $tags,
                        'post_status' => 'publish',
                        'posts_per_page' => $this -> numberposts,
                        'paged' => $this -> paged
                    )
                )
            );
            $this -> render_frontend_posts( $wp_query -> posts );
        }else{
            $this -> no_posts_found();
        }
    }

    function render_frontend_portfolio(){ /*PORTFOLIOS*/
        if( is_array( $this -> portfolios ) && count( $this -> portfolios ) ){
            $portfolios = array();
            foreach( $this -> portfolios as $term_id ){
                $term = get_term( $term_id, 'portfolio-category' );
                if( is_wp_error(( $portfolios ) ) ){
                    continue;
                }
                $portfolios[] = $term -> slug;
            }
            $portfolios = implode( ',', $portfolios );
            global $wp_query;
            $wp_query = new WP_Query( $this -> decorate_query(
                    array(
                        'portfolio-category' => $portfolios,
                        'post_status' => 'publish',
                        'posts_per_page' => $this -> numberposts,
                        'post_type' => 'portfolio',
                        'fp_element' => $this -> id,
                        'paged' => $this -> paged
                    )
                )
            );
            $this -> render_frontend_posts( $wp_query -> posts );
        }else{
            $this -> no_posts_found();
        }
    }
    
    function render_frontend_testimonials(){
        if( $this -> show_title == 'yes'){
            echo '<h2 class="content-title"><span>' . $this -> name . '</span></h2><div class="clear no-margin"></div>';
        }
        get_testimonials($get_testimonials = $this -> testimonials);
    }

    function render_frontend_banners(){
        global $wp_query;
        $wp_query = new WP_Query( $this -> decorate_query(
                array(
                    'post__in' => $this -> banners,
                    'post_status' => 'publish',
                    'post_type' => 'banner',
                    'fp_element' => $this -> id
                )
            )
        );

        $this -> view = 'banner_view';
        $this -> behaviour = 'none';
        $this -> carousel = 'no';
        $this -> pagination = 'no';
        $this -> load_more = 'no';
        $this -> tabber = 'no';
        $this -> filter = 'no';
        $this -> render_frontend_posts( $wp_query -> posts ); 
        wp_reset_query(); /*reset the query to not affect the elament that follows*/
    }

    function render_frontend_boxes(){
        $boxes = array();
        foreach( $this -> boxes as $term_id ){
            $term = get_term( $term_id, 'box-sets' );
            if( is_wp_error(( $boxes ) ) ){
                continue;
            }
            $boxes[] = $term -> slug;
        }
        $boxes = implode( ',', $boxes );
        global $wp_query;
        $wp_query = new WP_Query( $this -> decorate_query(
                array(
                    'box-sets' => $boxes,
                    'post_status' => 'publish',
                    'posts_per_page' => $this -> numberposts,
                    'post_type' => 'box',
                    'fp_element' => $this -> id,
                    'paged' => $this -> paged
                )
            )
        );

        /* TO DO: assure boxes' front-end rendering */
        $this -> view = 'box_view';
        $this -> behaviour = 'none';
        $this -> carousel = 'no';
        $this -> pagination = 'no';
        $this -> load_more = 'no';
        $this -> tabber = 'no';
        $this -> filter = 'no';
        $this -> render_frontend_posts( $wp_query -> posts );
        wp_reset_query(); /*reset the query to not affect the elament that follows*/
    }

    function render_frontend_teams(){
        $teams = array();
        foreach( $this -> teams as $term_id ){
            $term = get_term( $term_id, 'team-group' );
            if( is_wp_error(( $teams ) ) ){
                continue;
            }
            $teams[] = $term -> slug;
        }
        $teams = implode( ',', $teams );
        global $wp_query;
        $wp_query = new WP_Query( $this -> decorate_query(
                array(
                    'team-group' => $teams,
                    'post_status' => 'publish',
                    'posts_per_page' => $this -> numberposts,
                    'post_type' => 'team',
                    'fp_element' => $this -> id,
                    'paged' => $this -> paged
                )
            )
        );

        $options = array(
            'columns' => $this -> columns_arabic_to_word( $this -> columns ),
        );

        $columns_used = 0;
        $display_title = ( 'yes' == $this -> show_title );

        foreach( $wp_query -> posts as $post ){
            if( 0 == $columns_used ){
                echo '<div class="row team-view ">';
                if( $display_title ){
                    echo '<div class="twelve columns">';
                    echo '<h2 class="content-title"><span>' . $this -> name . '</span></h2><div class="clear no-margin"></div>';
                    echo '</div>';
                    $display_title = false;
                }
            }

            post::render_team( $post, $options, 0 == $columns_used );
            $columns_used++;

            if( $this -> columns <= $columns_used ){
                $columns_used = 0;
                echo '</div>';
            }
        }

        if( $columns_used > 0 ){
            echo '</div>';
        }
    }

    function render_frontend_page(){       /*PAGES*/
        global $wp_query;
        if(isset($this -> pageID) && $this -> pageID != 0){
            $wp_query = new WP_Query(array( 'page_id' => $this -> pageID ) );
        
            if(count($wp_query -> posts)){
                the_post();
                global $post;
                $post = $wp_query -> posts[0];
                if( $this -> show_title == 'yes'){ ?>
                <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
                <?php }
                get_template_part('single-content');
            }
            wp_reset_query();
        }
    }

    function render_frontend_post(){        /*POSTS*/
        global $wp_query;
        $wp_query = new WP_Query(array( 'post__in' => array($this -> postID) ) );
        global $post;
        if(isset($wp_query -> posts[0])) {
            $post = $wp_query -> posts[0];
        }else{
            $post = '';
        }
        if(count($wp_query -> posts)){
            the_post();
            if($this -> show_title == 'yes'){ ?>
            <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
            <?php }
            get_template_part('single-content');
        }
        wp_reset_query();
    }

    function render_frontend_event(){        /*outputs the event on the page*/
        global $wp_query;
        $wp_query = new WP_Query(array( 'post__in' => array($this -> eventID), 'post_type' => 'event' ) );
        global $post;
        if(isset($wp_query -> posts[0])) {
            $post = $wp_query -> posts[0];
        }else{
            $post = '';
        }
        if(count($wp_query -> posts)){
            the_post();
            if($this -> show_title == 'yes'){ ?>
            <h2 class="content-title"><span><?php echo $this -> name; ?></span></h2>
            <?php }
            get_template_part('single-content');
        }
        wp_reset_query();
    }

    function render_frontend_widget_zone(){     /*WIDGETS*/
        if($this -> show_title == 'yes'){ ?>
        <div class="row ">
            <div class="twelve columns ">
                <h3 class="content-title"><span><?php echo $this -> name; ?></span></h3>
            </div>
        </div>
        <?php }
        
        dynamic_sidebar( $this -> sidebar );
        
    }

    function render_frontend_posts( $posts ){
        $pagination_allowed = true;
        if( 'grid_view_thumbnails' == $this -> view ){
            if($this -> carousel == 'yes'){
                $this -> render_frontend_posts_grid_view_thumbnails_carousel( $posts );
                $pagination_allowed = false;
            }else{
                $this -> render_frontend_posts_grid_view_thumbnails( $posts );
            }
        }else if( 'grid_view' == $this -> view ){
            if($this -> carousel == 'yes'){
                $this -> render_frontend_posts_grid_view_carousel( $posts );
                $pagination_allowed = false;
            }else{
                $this -> render_frontend_posts_grid_view( $posts );
            }
        }else if( 'list_view' == $this -> view ){
            $this -> render_frontend_posts_list_view( $posts );
        }else if( 'box_view' == $this -> view ){
            $this -> render_frontend_posts_box_view_thumbs( $posts, $this -> show_title, $this -> name );
        }else if( 'timeline_view' == $this -> view ){
            $this -> render_frontend_posts_timeline_view( $posts);
        }/*else if('news_view' == $this -> view){
            $this -> render_frontend_posts_news_view( $posts );
        } */       else{
            foreach( $posts as $post ){
                call_user_func( array( 'post', $this -> view ), $post );
            }
        }

        if( 'yes' == $this -> pagination  && $pagination_allowed){
            get_template_part( 'pagination' );
        }
    }
}
?>