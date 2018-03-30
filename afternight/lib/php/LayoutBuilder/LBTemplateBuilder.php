<?php
    class LBTemplateBuilder extends  LBRenderable{
        public $scriptdata = array();

        function __construct(){
            $this -> templates = array();
            $this -> last_selected = '';
            $this -> scriptdata[ 'columns' ][ 'classes' ] = implode( ' ', LBRenderable::$words );
            $this -> scriptdata[ 'columns' ][ 'arr' ] = LBRenderable::$words;
            $this -> scriptdata[ 'translations' ][ 'cannot_add_columns' ] = __( 'Cannot add more columns', 'cosmotheme' );
            $this -> scriptdata[ 'first_template' ] = '';
            $this -> scriptdata[ 'translations' ][ 'add_element' ] = __( 'New element' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'showing' ] = __( 'Showing' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'widgets' ] = __( 'widgets' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'page' ] = __( 'page' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'post' ] = __( 'post' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'posts' ] = __( 'posts' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'from' ] = __( 'from' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'categories' ] = __( 'categories' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'category' ] = __( 'category' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'please' ] = __( 'Nothing to show. Please select some' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'in' ] = __( 'in' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'with' ] = __( 'with' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'carousel' ] = __( 'carousel' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'tag' ] = __( 'tag' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'tags' ] = __( 'tags' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'pagination' ] = __( 'pagination' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'load_more' ] = __( 'load more' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'gallery' ] = __( 'gallery' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'featured' ] = __( 'featured' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'portfolio' ] = __( 'portfolio' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'portfolios' ] = __( 'portfolios' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'latest' ] = __( 'latest' , 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'box' ] = __( 'box', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'boxes' ] = __( 'boxes', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'boxset' ] = __( 'box set', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'boxsets' ] = __( 'box sets', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'all' ] = __( 'all', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'team' ] = __( 'team', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'teams' ] = __( 'teams', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'group' ] = __( 'group', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'groups' ] = __( 'groups', 'cosmotheme' );
        }

        function render(){
            if( is_admin() ){
                $this -> render_backend();
            }
        }

        function render_backend(){
            $this -> load_all();
            wp_enqueue_style( 'layout-builder-css', get_template_directory_uri() . '/lib/css/layoutbuilder.css' );
            wp_enqueue_script( 'layout-builder-js', get_template_directory_uri() . '/lib/js/layoutbuilder.js', array( 'jquery-ui-sortable', 'jquery-ui-draggable' ) );
            wp_localize_script( 'layout-builder-js', 'TemplateBuilder', $this -> scriptdata );
            include get_template_directory() . '/lib/templates/layoutbuilder.php';
        }

        function get_prefix(){
            return 'templates';
        }

        function load_all(){
            $rawdata = get_option( $this -> get_prefix() );
            if( !is_array( $rawdata ) ){
                $rawdata = array();
            }
            $this -> cache( $rawdata );
            foreach( $rawdata as $index => $data ){
                if( is_array( $data ) ){
                    $template = new LBTemplate( $data );
                    $template -> builder =& $this;
                    if( '__template__' != $template -> id ){
                        $this -> templates[] = $template;
                        if( !strlen( $this -> scriptdata[ 'first_template' ] )  ){
                            $this -> scriptdata[ 'first_template' ] = $template -> id;
                        }
                    }
                }else if( 'last_selected' == $index ){
                    $this -> last_selected = $data;
                }
            }
        }

        function cache( $rawdata ){
            foreach( $rawdata as $data ){
                if(isset($data['id'])){
                    update_option( $this -> get_prefix() . '_' . $data[ 'id' ], $data );
                }
            }
        }

        function list_singulars( $singulars, $name_sg, $name_pl, $inputName ){
            if( !is_wp_error( $singulars ) && is_array( $singulars ) && count( $singulars ) ){
                echo '<p>' . sprintf(__( 'Here are the latest %s. Pick one or use the searchbar above.', 'cosmotheme' ), $name_pl) . '</p>';

                $val = array_keys($singulars);
                $last_key = end($val);

                foreach( $singulars as $key => $singular ){
                    $k = $key + 1;
                    if ($k % 7 == 1) {
                        echo '<div class="left_container">';
                    }
                    ?>
                        <label class="choose-one" data-id="<?php echo $singular -> ID;?>">
                            <input type="radio" name="<?php echo $this -> get_prefix();?>[__template__][_rows][__row__][_elements][_id_][<?php echo $inputName;?>]" value="<?php echo $singular -> ID;?>">
                            <?php echo $singular -> post_title;?>
                        </label>
                    <?php
                    if ($k % 7 == 0 && $key != $last_key) {
                        echo '</div>';
                    }
                    if ($key == $last_key) {
                        echo '</div>';
                    }   
                }
            }else{
                echo '<p>' . __( 'There are no', 'cosmotheme' ) . ' ' . $name_pl . '</p>';
            }
        }

        function list_header_singulars( $singulars, $name_sg, $name_pl, $inputName ){
            if( !is_wp_error( $singulars ) && is_array( $singulars ) && count( $singulars ) ){
                echo '<p>' . sprintf(__( 'Here are the latest %s. Pick one or use the searchbar above.', 'cosmotheme' ), $name_pl) . '</p>';
                $val = array_keys($singulars);
                $last_key = end($val);
                foreach( $singulars as $key => $singular ){
                    $k = $key + 1;
                    if ($k % 7 == 1) {
                        echo '<div class="left_container">';
                    }
                    ?>
                <label class="choose-one" data-id="<?php echo $singular -> ID;?>">
                    <input type="radio" name="<?php echo $this -> get_prefix();?>[__template__][_header_rows][__row__][_elements][_id_][<?php echo $inputName;?>]" value="<?php echo $singular -> ID;?>">
                    <?php echo $singular -> post_title;?>
                </label>
                <?php
                    if ($k % 7 == 0 && $key != $last_key) {
                        echo '</div>';
                    }
                    if ($key == $last_key) {
                        echo '</div>';
                    }  
                }
            }else{
                echo '<p>' . __( 'There are no', 'cosmotheme' ) . ' ' . $name_pl . '</p>';
            }
        }

        function choose_many_singulars( $singulars, $name_sg, $name_pl, $inputName ){
            if( !is_wp_error( $singulars ) && is_array( $singulars ) && count( $singulars ) ){
                echo '<p>' . sprintf(__( 'Here are the latest %s. Pick one or use the searchbar above.', 'cosmotheme' ), $name_pl) . '</p>';
                $val = array_keys($singulars);
                $last_key = end($val);
                foreach( $singulars as $key => $singular ){
                    $k = $key + 1;
                    if ($k % 7 == 1) {
                        echo '<div class="left_container">';
                    }
                    $this -> choose_many_label( $singular -> post_title, $singular -> ID, $inputName );
                    if ($k % 7 == 0 && $key != $last_key) {
                        echo '</div>';
                    }
                    if ($key == $last_key) {
                        echo '</div>';
                    }  
                }
            }else{
                echo '<p>' . __( 'There are no', 'cosmotheme' ) . ' ' . $name_pl . '</p>';
            }
        }

        function list_posts(){
            $posts = get_posts( array( 'numberposts' => 100 ) );
            $this -> list_singulars( $posts, __( 'post', 'cosmotheme' ), __( 'posts', 'cosmotheme' ), 'postID' );
        }

        function list_events(){
            $posts = get_posts( array( 'numberposts' => 100, 'post_type' => 'event' ) );
            $this -> list_singulars( $posts, __( 'event', 'cosmotheme' ), __( 'events', 'cosmotheme' ), 'eventID' );
        }

        function list_pages(){
            $pages = get_pages();
            $this -> list_singulars( $pages, __( 'page', 'cosmotheme' ), __( 'posts', 'cosmotheme' ), 'pageID' );
        }

        function list_sidebars(){
            global $wp_registered_sidebars;
            $last_key = count($wp_registered_sidebars);
            $key = 0;
            foreach( $wp_registered_sidebars as $sidebar ){
                
                $k = $key + 1;
                if ($k % 7 == 1) {
                    echo '<div class="left_container">';
                }
                ?>
                    <label class="choose-one" data-id="<?php echo $sidebar[ 'id' ];?>">
                        <input type="radio" name="<?php echo $this -> get_prefix();?>[__template__][_rows][__row__][_elements][_id_][sidebar]" value="<?php echo $sidebar[ 'id' ];?>">
                        <?php echo $sidebar[ 'name' ];?>
                    </label>
                <?php
                if ($k % 7 == 0 && $k != $last_key) {
                    echo '</div>';
                }
                if ($k == $last_key) {
                    echo '</div>';
                }  
                $key++; 
            }
        }

        function list_terms( $terms, $name_sg, $name_pl, $inputName ){
            if( !is_wp_error( $terms ) && is_array( $terms ) && count( $terms ) ){

                $val = array_keys($terms);
                $last_key = end($val);
                foreach( $terms as $key => $term ){
                    $k = $key + 1;
                    if ($k % 7 == 1) {
                        echo '<div class="left_container">';
                    }
                    $this -> choose_many_label( $term -> name, $term -> term_id, $inputName );
                    if ($k % 7 == 0 && $key != $last_key) {
                        echo '</div>';
                    }
                    if ($key == $last_key) {
                        echo '</div>';
                    }                    
                }
            }else{
                echo '<p>' . __( 'There are no non-empty' , 'cosmotheme' ) . ' ' .  $name_pl .  '</p>';
            }
        }

        function list_tags(){
            $tags = get_tags( array( 'hide_empty' => false ) );
            $this -> list_terms( $tags, __( 'tag', 'cosmotheme' ), __( 'tags', 'cosmotheme' ), 'tags' );
        }

        function list_portfolios(){
            $portfolios = get_terms( 'portfolio-category', array( 'hide_empty' => false ) );
            $this -> list_terms( $portfolios, __( 'portfolio', 'cosmotheme' ), __( 'portfolios', 'cosmotheme' ), 'portfolios' );
        }
        
        function list_boxes(){
            $boxes = get_terms( 'box-sets', array( 'hide_empty' => false ) );
            $this -> list_terms( $boxes, __( 'box', 'cosmotheme' ), __( 'boxes', 'cosmotheme' ), 'boxes' );
        }

        function list_teams(){
            $teams = get_terms( 'team-group', array( 'hide_empty' => false ) );
            $this -> list_terms( $teams, __( 'team', 'cosmotheme' ), __( 'teams', 'cosmotheme' ), 'teams' );
        }

        function list_banners(){
            $banners = get_posts( array( 'post_type' => 'banner', 'numberposts' => -1 ) );
            $this -> choose_many_singulars( $banners, __( 'banner', 'cosmotheme' ), __( 'banners', 'cosmotheme' ), 'banners' );
        }

        function list_testimonials(){
            $testimonials = get_posts( array( 'post_type' => 'testimonial', 'numberposts' => -1) );
            $this -> choose_many_singulars( $testimonials, __( 'testimonial', 'cosmotheme' ), __( 'testimonials', 'cosmotheme' ), 'testimonials' );
        }

        function list_categories(){
            $categories = get_categories( array( 'hide_empty' => false ) );
            if( !is_wp_error( $categories ) && is_array( $categories ) && count( $categories ) ){
                $val = array_keys($categories);
                $last_key = end($val);
                foreach( $categories as $key => $category ){
                    $k = $key + 1;
                    if ($k % 7 == 1) {
                        echo '<div class="left_container">';
                    }
                    $this -> choose_many_label( $category -> cat_name, $category -> cat_ID, 'categories' );
                    if ($k % 7 == 0 && $key != $last_key) {
                        echo '</div>';
                    }
                    if ($key == $last_key) {
                        echo '</div>';
                    }
                }         
            }else{

            }
        }

        function list_event_categories(){
            $event_categories = get_terms( 'event-category', array( 'hide_empty' => false ) );
            $this -> list_terms( $event_categories, __( 'category', 'cosmotheme' ), __( 'categories', 'cosmotheme' ), 'eventcategories' );
            
        }

        function choose_many_label( $label, $id, $name ){
            ?>
                <label class="choose-many" data-id="<?php echo $id;?>">
                    <input type="checkbox" name="<?php echo $this -> get_prefix();?>[__template__][_rows][__row__][_elements][_id_][<?php echo $name;?>][]" value="<?php echo $id;?>">
                    <?php echo $label;?>
                </label>
            <?php
        }
    }