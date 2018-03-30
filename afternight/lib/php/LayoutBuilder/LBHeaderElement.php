<?php
class LBHeaderElement extends LBElement{
    private $words_full_width = array( 0 => 'twelve', 1 => 'twelve', 2 => 'six', 3 => 'four', 4 => 'three', 5 => 'three', 6 => 'two', 7 => 'two', 8 => 'one', 9 => 'one', 10 => 'one', 11 => 'one', 12 => 'one' );
    function columns_arabic_to_word( $arabic ){
        return $this -> words_full_width[ $arabic ];
    }

    function __construct( $data ){
        parent::__construct( $data );
        $this -> element_columns = 12;
        $this -> id = '_id_';
        $this -> name = __( 'New element' , 'cosmotheme' );
        $this -> type = 'empty';
        $this -> show_title = 'no';
        $this -> main_menustyles = 'default';
        $this -> popular_tags_period = '7';
        $this -> popular_tags_criteria = 'most_used_tags';
        $this -> number_tags = 6;
        $this -> popular_tags_label = __('Popular tags','cosmotheme');
        $this -> text_align = 'left';
        
        foreach( $data as $identifier => $value ){
            $this ->{ $identifier } = $value;
        }
    }

    function get_prefix(){
        return $this -> row -> get_prefix() . "[_elements][$this->id]";
    }

    function render_backend(){
        include get_template_directory() . '/lib/templates/headerelement.php';
    }

    function render_frontend(){
        //$this -> is_fullwidth = ( 12 == $this -> element_columns ) && !( $this -> row -> template -> layout_has_sidebars );
        if ($this -> type == 'textelement' || $this -> type == 'menu' || $this -> type == 'top_menu' || $this -> type == 'socialicons' || $this -> type == 'searchbar' || $this -> type == 'logo' ) {
            if ($this -> text_align == 'left') {
                $text_align_class = 'align-left';
            }elseif ($this -> text_align == 'center'){
                $text_align_class = 'align-center';
            }elseif ($this -> text_align == 'right'){
                $text_align_class = 'align-right';
            }
        }else { $text_align_class = ''; }        
        $type = $this -> type;
        
        echo '<div class="' . $this -> type . ' ' . $text_align_class . ' ' . LBRenderable::$words[ $this -> element_columns ] . ' columns">';
            call_user_func( array ( $this, "render_frontend_$type" ) );
        echo '</div>';
        
        if ($this->type == 'menu' && options::logic( 'styling' , 'show_sticky_menu' )) {
            echo '<div class="no-padding">';
            echo '<div class="sticky-menu-container">';
            echo '<div class="sticky-content">';
            $this -> render_frontend_menu($is_stiky = true);
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
    }

    function render_frontend_popular_tags(){
        /* Defaults
        $this -> popular_tags_period = '7';
        $this -> number_tags = 6;
        $this -> popular_tags_label = __('In the news','cosmotheme');
        $this -> popular_tags_criteria = 'most_used_tags';  //or tags_in_popular_posts
        */

        

        $GLOBALS['nr_days'] = $this -> popular_tags_period;    
        $tags_in = array();
            
        if($this -> popular_tags_criteria ==  'tags_in_popular_posts' &&  function_exists( 'stats_get_csv' )  ){
            /* in this case we will get posts ordered by  'nr_views' meta*/

            $args = array('posts_per_page' => -1, 'post_status' => 'publish','meta_key' => 'nr_views','orderby' => 'meta_value_num' ,'order' => 'DESC');
            add_filter( 'posts_where', array('LBHeaderElement',"filter_where_last_x_days") );

            $wp_query = new WP_Query( $args );

            /* remove filter where*/
            remove_filter( 'posts_where', array('LBHeaderElement',"filter_where_last_x_days") );
           
            if(isset( $wp_query -> posts) && count($wp_query->posts) ){
                foreach ($wp_query -> posts as $post) {
                    if(sizeof($tags_in) >= $this -> number_tags ) {break;}

                    $tags = wp_get_post_terms($post -> ID, 'post_tag');

                    foreach ($tags as $tag) {
                        if(sizeof($tags_in) >= $this -> number_tags ) {break;}

                        if(!in_array($tag -> term_id, $tags_in)){
                            $tags_in[] = $tag -> term_id;     
                        }  
                    }    
                    
                }
            }

        }else{ /*$this -> popular_tags_criteria == 'most_used_tags'*/
            /*we will get posts from the specified period of time*/
            
            $args = array('posts_per_page' => -1, 'post_status' => 'publish');
            
            add_filter( 'posts_where', array('LBHeaderElement',"filter_where_last_x_days") );

            $wp_query = new WP_Query( $args );

            /* remove filter where*/
            remove_filter( 'posts_where', array('LBHeaderElement',"filter_where_last_x_days") );
            
            if(isset( $wp_query -> posts) && count($wp_query->posts) ){
                foreach ($wp_query -> posts as $post) {
                    $tags = wp_get_post_terms($post -> ID, 'post_tag');

                    foreach ($tags as $tag) {
                        if(!in_array($tag -> term_id, $tags_in)){
                            $tags_in[] = $tag -> term_id;     
                        }  
                    }    
                    
                }
            }

        }    

        $include_tags = implode( ',', $tags_in);
        $tags_found = get_tags( array('orderby' => 'count', 'order' => 'DESC','number' => $this -> number_tags, 'include' => $include_tags) );


        if(sizeof($tags_found)){
        ?>
            <div class="popular-tags">
                <?php echo $this -> popular_tags_label; ?>
                <ul>
                    <?php foreach ($tags_found as $tag) { ?> 
                        <li><a href="<?php echo get_tag_link($tag -> term_id); ?>"><?php echo $tag -> name; ?></a></li>
                    <?php } ?>
                    
                </ul>
            </div>
        <?php
        } /*EOF if*/
    }

    function render_frontend_logo(){
        if( 'image' == options::get_value( 'styling' , 'logo_type' ) ){
            $this -> src = strlen( trim( options::get_value( 'styling' , 'logo_url' ) ) ) ? options::get_value( 'styling' , 'logo_url' ) : get_template_directory_uri() . '/images/logo.png';
            ?>
            <a href="<?php echo home_url();?>">
                <img src="<?php echo $this -> src;?>" alt="" />
            </a>
            <?php
        }else{
            ?>
            <a href="<?php echo home_url();?>">    
                <h1 >
                    <span ><?php echo get_bloginfo( 'name' );?></span>
                    
                </h1>
                <?php if (options::logic( 'styling' , 'enb_site_description' )) { ?>
                    <span><?php echo get_bloginfo( 'description' );?></span>
                <?php } else {} ?>
            </a>    
            <?php
        }
    }

    function render_frontend_menu($is_stiky = false){

        if($is_stiky){
            $prepend_id = '_stiky';
        }else{
            $prepend_id = '';
        }
        
        if($this->main_menustyles == 'vertical'){
            $columns_class = $this -> columns_arabic_to_word( $this -> columns ).' columns'; 
        }else{
            $columns_class = '';
        }
        echo menu( 'header_menu' , array(
            'container'       => 'nav',
            'container_class' => 'main-menu',
            'number-items' => $this -> numberposts,
            'current-class' => 'selected',
            'type' => 'category',
            'class' => 'sf-menu',
            'menu_id' => 'main-menu'.$prepend_id,
            'menu_style' =>  $this -> main_menustyles,
            'nr_columns' =>  $columns_class
        ));
    }

    function render_frontend_top_menu(){
        if($this->main_menustyles == 'vertical'){
            $columns_class = $this -> columns_arabic_to_word( $this -> columns ).' columns'; 
        }else{
            $columns_class = '';
        }
        echo menu( 'top_menu' , array(
            'container'       => 'nav',
            'container_class' => 'top-menu',   
            'number-items' => $this -> numberposts,
            'current-class' => 'active',
            'type' => 'category',
            'class' => 'sf-menu top-menu',
            'menu_id' => 'nav-menu-top',
            'menu_style' =>  $this -> main_menustyles,
            'nr_columns' =>  $columns_class
        ));
    }

    function get_menu_item_from_option( $class, $label, $tab, $option_name, $icon_class ){
        $page_id = (int) options::get_value( $tab , $option_name );
        if( $page_id > 0 ){
            return $this -> get_menu_item( $class, get_page_link( $page_id ), $label, $icon_class );
        }
    }

    function get_menu_item( $class, $url, $label, $icon_class ){
        return <<<endhtml
                <li class="$class">
                	<a href="$url">
                        <i class="$icon_class"></i>
                		$label
                	</a>
            	</li>
endhtml;
    }

    static function render_frontend_breadcrumbs(){
        dimox_breadcrumbs();
    }

    function render_frontend_textelement(){
        echo do_shortcode($this -> text); 
    }

    function render_frontend_socialicons(){
        $this->get_social_icons();
    }

    function render_frontend_login(){
        if( is_user_logged_in() ){
            global $wp_version;
            $role = array(
                10 => __( 'Administrator' , 'cosmotheme' ) ,
                7 => __( 'Editor' , 'cosmotheme' ) ,
                2 => __( 'Author' , 'cosmotheme' ) ,
                1 => __( 'Contributor' , 'cosmotheme'  ) ,
                0 => __( 'Subscriber' , 'cosmotheme' ),
                '' => __( 'Subscriber' , 'cosmotheme' )
            );
            $u_id = get_current_user_id();
            $picture = facebook::picture();
            if( strlen( $picture ) && get_user_meta( $u_id , 'custom_avatar' , true ) == ''){
                $facebook_id = facebook::id();
                $this -> avatar_link = "http://facebook.com/profile.php?id=$facebook_id";
                $this -> avatar = '<img src="' . $picture . '" width="32" width="32" />';
            }else{
                $this -> avatar_link = get_author_posts_url( $u_id );
                $this -> avatar = cosmo_avatar( $u_id , 32 , $default = DEFAULT_AVATAR_LOGIN );
            }

            $user = (array)get_userdata( $u_id );
            if($wp_version < 3.3){
                if( !isset( $user['user_level'] ) ){
                    $user['user_level'] = '';
                }
                $this -> user_login = $user['user_login'];
                $this -> user_role = $role[ $user['user_level'] ];
            }else{
                if(isset($user['roles'][0])){
                    $user['user_level'] =   $user['roles'][0];
                }else $user['user_level']=__( 'Subscriber' , 'cosmotheme' );
                $this -> user_login = $user['data']->display_name;
                $this -> user_role = $user['user_level'];
            }

            $this -> user_id = $u_id;
            $this -> author_url = get_author_posts_url( $u_id );
            $url = home_url();
            $like = array( 'fp_type' => "like" );
            if(is_numeric(options::get_value( 'general' , 'my_liked_posts' ))){
                $this -> url_like = get_permalink(options::get_value( 'general' , 'my_liked_posts' ));
            }else{
                $this -> url_like = '';
            }

            ?>
                <div class="cosmo-icons i-b header-user-menu">
                    <ul class="mobile-login-menu">
                        <li class="signin no_description">
                            <a href="<?php echo $this -> avatar_link;?>" class="header-signin">
                                <i class="icon-author"></i>
                                <?php echo $this -> user_login;?>
                                <dd>+</dd>
                            </a>
                            <ul class="login-menus">
                                <?php
                                echo $this -> get_menu_item_from_option( 'my-settings', __( 'My settings' , 'cosmotheme' ), 'general' , 'user_profile_page', 'icon-settings' );
                                if( post::get_my_posts( $this -> user_id ) ){
                                    echo $this -> get_menu_item( 'my-profile', $this -> author_url, __( 'My profile' , 'cosmotheme' ), 'icon-author' );
                                }
                                echo $this -> get_menu_item_from_option( 'my-posts', __( 'My added posts' , 'cosmotheme' ), 'general' , 'my_posts_page', 'icon-edit' );
                                if( options::logic( 'likes' , 'enb_likes' ) && strlen($this -> url_like)  ){
                                    echo $this -> get_menu_item( 'my-likes' , $this -> url_like, __( 'My liked posts' , 'cosmotheme' ), 'icon-like' );
                                }
                                echo $this -> get_menu_item_from_option( 'my-add', __( 'Add post' , 'cosmotheme' ), 'upload' , 'post_item_page', 'icon-add' );
                                echo $this -> get_menu_item( 'my-logout', wp_logout_url( curPageURL() ), __( 'Log out' , 'cosmotheme' ), 'icon-logout' );
                                ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php
        }else{
        ?>
            <div class="header-signin-container header-user-menu">
                <a href="javascript:void(0)" class="header-signin" onclick="get_login_box(''); "><i class="icon-author"></i> <?php _e( 'sign in' , 'cosmotheme' );?></a>
            </div>
        <?php
        }
    }
    function render_frontend_searchbar(){
        ?>
        <div class="search-btn-container">
            <a href="javascript:void(0)" class="search-btn"><i class="icon-search"></i></a>
        </div>
        <?php

    }

    function get_social_icons(){
    ?>    
        <ul class="cosmo-social">
    <?php        
        $fb_id = options::get_value( 'social' , 'facebook' );
        if( strlen( trim( $fb_id ) ) ){
            ?>
            <li><a href="<?php echo 'http://facebook.com/people/@/'  . $fb_id ; ?>" target="_blank" class="fb hover-menu"><i class="icon-facebook"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'twitter' ) ) ){
            ?>
            <li><a href="http://twitter.com/<?php echo options::get_value( 'social' , 'twitter' ) ?>" target="_blank" class="twitter hover-menu"><i class="icon-twitter"></i></a></li>
            <?php
        }
        ?>
        <?php
        if( strlen( options::get_value( 'social' , 'gplus' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'gplus' ) ?>" target="_blank" class="gplus hover-menu"><i class="icon-gplus"></i></a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'yahoo' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'yahoo' ) ?>" target="_blank" class="yahoo hover-menu"><i class="icon-yahoo"></i></a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'dribbble' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'dribbble' ) ?>" target="_blank" class="dribbble hover-menu"><i class="icon-dribbble"></i></a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'linkedin' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'linkedin' ) ?>" target="_blank" class="linkedin hover-menu"><i class="icon-linkedin"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'vimeo' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'vimeo' ) ?>" target="_blank" class="vimeo hover-menu"><i class="icon-vimeo"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'youtube' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'youtube' ) ?>" target="_blank" class="yt hover-menu"><i class="icon-youtube"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'tumblr' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'tumblr' ) ?>" target="_blank" class="tumblr hover-menu"><i class="icon-tumblr"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'delicious' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'delicious' ) ?>" target="_blank" class="delicious hover-menu"><i class="icon-delicious"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'flickr' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'flickr' ) ?>" target="_blank" class="flickr hover-menu"><i class="icon-flickr"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'instagram' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'instagram' ) ?>" target="_blank" class="instagram hover-menu"><i class="icon-instagram"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'pinterest' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'pinterest' ) ?>" target="_blank" class="pinterest hover-menu"><i class="icon-pinterest"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'skype' ) ) ){
            ?>
            <li><a href="skype:<?php echo options::get_value( 'social' , 'skype' ) ?>?call" target="_blank" class="skype hover-menu"><i class="icon-skype"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'email' ) ) ){
            ?>
            <li><a href="mailto:<?php echo options::get_value( 'social' , 'email' ); ?>" target="_blank" class="email hover-menu"><i class="icon-email"></i></a></li>
            <?php
        }

        if( options::logic( 'social' , 'rss' ) ){
            ?>
            <li><a href="<?php bloginfo('rss2_url'); ?>" class="rss hover-menu"><i class="icon-rss"></i></a></li>
            <?php
        }
        ?>    
            </ul>
        <?php
        
    }

    /*retrieves posts from last x days*/
    function filter_where_last_x_days($where = '', $days = 7 ){
        $days = $GLOBALS['nr_days']; /*use the global variable that is set before the filter*/
        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "'";  
        return $where;
    }

    /*retrieves posts from last x hours*/
    function filter_where_last_x_hours($where = '', $hours = 7 ){
        $hours = options::get_value( 'blog_post' , 'breaking_news_expiration_time' );
        $where .= " AND post_date > '" . date('Y-m-d h:i', strtotime('-'.$hours.' hours')) . "'";  
        return $where;
    }
}
?>