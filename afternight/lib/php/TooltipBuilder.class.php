<?php
	class TooltipBuilder{
		public $scriptdata = array();
		public $places = array();
		function __construct(){
            $this -> scriptdata = array();
            $this -> scriptdata[ 'home_url' ] = get_home_url();
            $this -> scriptdata[ 'translations' ] = array();
            $this -> scriptdata[ 'translations' ][ 'addmore' ] = __( 'Add new tooltip to', 'cosmotheme' );
            $this -> scriptdata[ 'translations' ][ 'frontpage' ] = __( 'Frontpage', 'cosmotheme' );
		}
		function render_backend(){
            if( !( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'tooltips' ) ){
                return '';
            }
			$this -> load_places();
			wp_enqueue_style( 'tooltipsbuilder' , get_template_directory_uri() . '/lib/css/tooltipsbuilder.css' );
            wp_enqueue_script( 'scrollto' , get_template_directory_uri() . '/js/jquery.scrollTo-1.4.2-min.js', array( 'jquery' ) );
			wp_enqueue_script( 'tooltipsbuilder' , get_template_directory_uri() . '/lib/js/tooltipsbuilder.js' , array( 'jquery-ui-sortable', 'jquery-ui-draggable', 'scrollto' ) );
			wp_localize_script( 'tooltipsbuilder' , 'TooltipBuilder' , $this -> scriptdata );
			include get_template_directory() . '/lib/templates/tooltipbuilder.php';
		}
		function render_frontend(){
            if( is_front_page() || is_home() ){
                $place = 'frontpage';
            }else if( is_singular() ){
                global $post;
                $place = $post -> ID;
            }else{
                return '';
            }

            $options = get_option( 'tooltips' );
            if( is_array( $options ) && isset( $options[ 'places' ] ) && is_array( $places = $options[ 'places' ] ) ){
                if( isset( $places[ $place ] ) ){
                    $tooltip_place = new TooltipPlace( $places[ $place ] );
                    $tooltip_place -> render_frontend();
                }
            }
		}
		function __toString(){
			ob_start();
			if( is_admin() ){
				$this -> render_backend();
			}else{
				$this -> render_frontend();
			}
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		}

		function load_places(){
            $options = get_option( 'tooltips' );
			if( is_array( $options ) && isset( $options[ 'places' ] ) && is_array( $places = $options[ 'places' ] ) ){
                foreach( $places as $place => $data ){
                    if( $place != '_place_' && isset( $data[ 'elements' ] ) && is_array( $data[ 'elements' ] ) && count( $data[ 'elements' ] ) ){
                        array_push( $this -> places, new TooltipPlace( $data ) );
                    }
                }
			}
		}

        function list_posts(){
            $posts = get_posts( array( 'numberposts' => 100 ) );
            if( !is_wp_error( $posts ) && is_array( $posts ) && count( $posts ) ){
                echo '<p>' . __( 'Here are the latest posts. Pick one or use the searchbar above', 'cosmotheme' ) . '</p>';
                foreach( $posts as $post ){
                ?>
                    <label class="taxonomy">
                        <?php echo $post -> post_title;?>
                        <input name="fly-left[pages]" type="radio" value="<?php echo $post -> ID;?>">
                        <a href="<?php echo get_permalink( $post -> ID );?>"></a>
                    </label>
                <?php
                }
            }else{
                echo '<p>' . __( 'There are no pages' , 'cosmotheme' ) . '</p>';
            }
        }

        function list_pages(){
            $pages = get_pages();
            if( !is_wp_error( $pages ) && is_array( $pages ) && count( $pages ) ){
                foreach( $pages as $page ){
                ?>
                    <label class="taxonomy">
                        <?php echo $page -> post_title;?>
                        <input name="fly-left[pages]" type="radio" value="<?php echo $page -> ID;?>">
                        <a href="<?php echo get_permalink( $page -> ID );?>"></a>
                    </label>
                <?php
                }
            }else{
                echo '<p>' . __( 'There are no pages' , 'cosmotheme' ) . '</p>';
            }
        }
	}
?>