<?php

/*
 * author: wiloke
 * author uri: wiloke.com
 * date: 04/25/2014
 * dae: 11:30 am
 */


define('WO_THEMENAME', '');

class AWEWidgets extends AweFramework
{
    const AWEW_WIDGETS = 'awew-widgets';



    public $widgets_options = array();

    public $aDefaults = array('sharing_button' => 0, 'flickr' => 0, 'twitter' => 0, 'social_links' => 0, 'ads' => 0, 'contact_form' => 0, 'contact_info' => 0, 'sound_clound' => 0, 'mailchimp' => 0, 'embed_video' => 0, 'audiopost' => 0, 'dribbble' => 0, 'map' => 0, 'accordion' => 0, 'like_box' => 0, 'megaslider' => 0, 'megafullslider' => 0, 'do_shortcode' => 0, 'contact_info' => 1, 'social_networks' => 1, 'tabs' => 1, 'info_box' => 1, 'skills' => 1, 'advanced_menu' => 1, 'feedburner'=>1, 'counter'=>1, 'author'=>1, 'author_post'=>1);
    
    // if you want to kill a widget, very easy, just  put that key to this array above
    protected $KillIt = array('counter');

    public $aWidgetValues;

    public function __construct()
    {
        $default_configs = apply_filters("config_widgets",array());
        $this->aDefaults = array_merge($this->aDefaults,$default_configs);

        $hide_widgets = apply_filters("hide_widgets",array());
        $this->KillIt = array_merge($this->KillIt,$hide_widgets);
        add_action('admin_enqueue_scripts', array($this, 'wo_widget_enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'wo_enqueue_scripts'));
        $this->widget_refresh_options();
        add_action('admin_menu', array($this, 'register_widgets_menu'));


        add_action('admin_notices', array(&$this, 'display_global_messages'), 9999);

        /*===== Register Widget ===*/
        add_action('widgets_init', array($this, 'awew_register_widget_sidebar'));

        add_action('wp_ajax_toggle-widget', array($this, 'wo_save_toggle_widgets'));

        add_action('wp_ajax_reset-widgets', array($this, 'wo_reset_widgets'));
    }

    public function wo_reset_widgets()
    {

        update_option(self::AWEW_WIDGETS, array('widgets'=>$this->aDefaults));
        echo json_encode(array("talk"=>true, "comments"=>"grt! i'm very satisfied"));
        die();
    }

    public function wo_save_toggle_widgets()
    {
        parse_str(stripslashes($_POST['data']), $aData);

        if ($aData)
        {
            update_option(self::AWEW_WIDGETS, $aData);
            echo json_encode(array("talk"=>true, "comments"=>"grt! i'm very satisfied"));
        }else{
            echo json_encode(array("talk"=>false, "comments"=>"shit! i'm not pleased ")); 
        }

        die();
    }


    public function wo_widget_enqueue_scripts()
    {
        global $pagenow;
        if ( $pagenow == 'admin.php' && $_GET['page'] ==  'AWE-Widgets' )
        {
            wp_enqueue_script('togglewidget-scripts', AWE_JS_URL. 'jquery.toggle-widgets.js', array("jquery"), null, false);
            // wp_enqueue_script('wo-search-scripts', AWE_JS_URL. 'jquery.wo-search.js', array("jquery"), null, false);
        }

        if ($pagenow == 'widgets.php')
        {
           // wp_enqueue_script('ma-scripts', AWE_JS_URL. 'theme.js', array("jquery"), null, false);
            wp_enqueue_script('ma-widget-script', AWE_JS_URL . 'jquery.widget.js', array("jquery", "wp-color-picker"), null, false);
        }
    }

    public function wo_enqueue_scripts()
    {
        wp_register_script('awe-jquery-flickrfeed', AWE_FE_JS  . 'jflickrfeed.min.js', array('jquery'));
        wp_enqueue_script('awe-jquery-flickrfeed');
        wp_enqueue_script('awe-wo-widget');
    }

    /* Register widget sidebar */
    public function awew_register_widget_sidebar()
    {
        if (isset($this->aWidgetValues) && !empty($this->aWidgetValues)) 
        {
            foreach ($this->aWidgetValues as $k => $v) 
            {
                if (!empty($v) ) :

                    $className = __CLASS__ . '_' . ucfirst($k);
                    if (class_exists($className)) 
                    {
                        register_widget($className);
                    }

                endif;

            }
        }
    }

    public function register_widgets_menu()
    {
        add_submenu_page('AWE-Framework', 'Widgets Settings', 'Widgets', 'manage_options', 'AWE-Widgets', array($this, 'widgets_settings'));

    }

    public function widgets_settings()
    {
        include('widgets_tpl.php');
    }


    /*
     * save options
     */
    public function widget_refresh_options()
    {

        $aWidgets = get_option(self::AWEW_WIDGETS);

        if (!$aWidgets) 
        {
            update_option(self::AWEW_WIDGETS, array('widgets'=>$this->aDefaults));
            $aWidgets = get_option(self::AWEW_WIDGETS);

        }

        $this->aWidgetValues = $aWidgets['widgets'];

    }

}


class AWEWidgets_Feedburner extends WP_Widget
{
    public function __construct() 
    {
        $widget_ops = array( 'classname' => 'widget-feedburner' , 'description' => 'Subscribe to feedburner via email' );
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget-feedburner' );
        $this->WP_Widget( 'widget-feedburner', WO_THEMENAME .' - Feedburner Widget ', $widget_ops, $control_ops );
    }
    
    public function widget( $args, $instance ) 
    {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );
        if( function_exists('icl_t') )  $text_code = icl_t( theme_name , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
        $feedburner = $instance['feedburner'];
        
        echo $before_widget;
        echo $before_title;
        echo $title ; 
        echo $after_title;
        echo '<div class="widget-feedburner-counter">
        <p>'.do_shortcode( $text_code ).'</p>' ; ?>
        <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
            <input class="feedburner-email" type="text" name="email" value="<?php _e( 'Enter your e-mail address' , LANGUAGE) ; ?>" onfocus="if (this.value == '<?php _e( 'Enter your e-mail address' , LANGUAGE) ; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Enter your e-mail address' , LANGUAGE) ; ?>';}">
            <input type="hidden" value="<?php echo $feedburner ; ?>" name="uri">
            <input type="hidden" name="loc" value="en_US">          
            <input class="feedburner-subscribe" type="submit" name="submit" value="<?php _e( 'Subscribe' , LANGUAGE) ; ?>"> 
        </form>
        </div>
        <?php
        echo $after_widget;         
    }

    public function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['text_code'] = $new_instance['text_code'] ;
        $instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
        
        if (function_exists('icl_register_string')) {
            icl_register_string( theme_name , 'widget_content_'.$this->id, $new_instance['text_code'] );
        }

        return $instance;
    }

    public function form( $instance ) 
    {
        $defaults = array( 'title' =>__( 'FeedBurner Widget' , LANGUAGE) , 'text_code' => __( 'Subscribe to our email newsletter.' , LANGUAGE) );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'text_code' ); ?>">Text above Email Input Field : <small>( support : Html & Shortcodes )</small> </label>
            <textarea rows="5" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php echo $instance['text_code']; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'feedburner' ); ?>">Feedburner ID : </label>
            <input id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" value="<?php echo $instance['feedburner']; ?>" class="widefat" type="text" />
        </p>


    <?php
    }
}




class AWEWidgets_Author_post extends WP_Widget
{
    public function __construct() 
    {
        $widget_ops = array( 'classname' => 'widget_author_posts'  );
        $this->WP_Widget( 'author_post_widget',WO_THEMENAME .' - Posts By Post Author', $widget_ops );
    }

    public function widget( $args, $instance ) 
    {
        extract( $args );
        wp_reset_query();
        if ( is_single() ) :
        
            $no_of_posts = $instance['no_of_posts'];
            $see_all = $instance['see_all'];
            
            $orig_post = $post;
            $authorID = get_the_author_meta( 'ID' );
            $args=array('author' => $authorID , 'post__not_in' => array($post->ID), 'posts_per_page'=> $no_of_posts, 'no_found_rows' => 1 );
            $my_query = new wp_query( $args );
            if( $my_query->have_posts() ) :
            echo $before_widget; 
                echo $before_title;
                printf( __( 'By %s', LANGUAGE ), get_the_author() );
            echo $after_title; ?>
            <ul>
            <?php while( $my_query->have_posts() ) { $my_query->the_post();?>
                <li><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
            <?php } ?>
            </ul>
            <?php if($see_all) : ?>
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php _e('All' , LANGUAGE) ?> (<?php echo count_user_posts($authorID) ?>)</a>
            <?php endif; ?>

            <?php
            $post = $orig_post; wp_reset_query();
            echo $after_widget;
        endif;
        endif;

    }
    
    public function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['title'] = ' ';
        $instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
        $instance['see_all'] = strip_tags( $new_instance['see_all'] );
        return $instance;
    }

    public function form( $instance ) 
    {
        $defaults = array( 'no_of_posts' => '5' , 'see_all' => 'true' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        ?>
        
        <p><em style="color:red;">This Widget appears in single post only .</em></p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>">
                <input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
            Number of posts to show</label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'see_all' ); ?>">
            <input id="<?php echo $this->get_field_id( 'see_all' ); ?>" name="<?php echo $this->get_field_name( 'see_all' ); ?>" value="true" <?php if( $instance['see_all'] ) echo 'checked="checked"'; ?> type="checkbox" />
            Display ( see all ) link</label>
        </p>

    <?php
    }
}

class AWEWidgets_Author extends WP_Widget
{
    public function __construct() 
    {
        $widget_ops = array( 'classname' => 'widget_author' );
        $this->WP_Widget( 'author_widget',WO_THEMENAME .' - Post Author', $widget_ops );
    }

    public function widget( $args, $instance ) 
    {
        extract( $args );
        if ( is_single() ) :
        
        wp_reset_query();
        
        $avatar = $instance['avatar'];
        $social = $instance['social'];
        
        echo $before_widget;
        echo $before_title;
        printf( __( 'About %s', LANGUAGE ), get_the_author() );
        echo $after_title; 
        
        tie_author_box( $avatar , $social );
        
        echo $after_widget;
        endif;
    }
    
    
    public function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['title'] = ' ';
        $instance['avatar'] = strip_tags( $new_instance['avatar'] );
        $instance['social'] = strip_tags( $new_instance['social'] );
        return $instance;
    }

    public function form( $instance ) 
    {
        $defaults = array( 'avatar' => 'true' , 'social' => 'true' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        ?>
        
        <p><em style="color:red;">This Widget appears in single post only .</em></p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'avatar' ); ?>">
            <input id="<?php echo $this->get_field_id( 'avatar' ); ?>" name="<?php echo $this->get_field_name( 'avatar' ); ?>" value="true" <?php if( $instance['avatar'] ) echo 'checked="checked"'; ?> type="checkbox" />
            Display author's avatar</label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'social' ); ?>">
            <input id="<?php echo $this->get_field_id( 'social' ); ?>" name="<?php echo $this->get_field_name( 'social' ); ?>" value="true" <?php if( $instance['social'] ) echo 'checked="checked"'; ?> type="checkbox" />
            Display Social icons</label>
        </p>

    <?php
    }
}


class AWEWidgets_Mailchimp extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname'=>'awew_mailchimp');
        parent::__construct('awew_mailchimp', WO_THEMENAME.' Mailchimp', $args);
    }

    public function form($instance)
    {   
        $instance = wp_parse_args($instance, array('title' => 'Mailchimp', 'action' => ''));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title") ?>">Title</label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name("title") ?>"
                   id="<?php echo $this->get_field_id("title") ?>" value="<?php echo $instance['title'] ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("action") ?>">Action</label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name("action") ?>"
                   id="<?php echo $this->get_field_id("action") ?>" value="<?php echo esc_url($instance['action']); ?>"/>
            <span class="help">How to get mailchimp?</span>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        foreach ($new_instance as $key => $value) 
        {
            $instance[$key] = strip_tags($value);
        }
        return $instance;
    }

    public function widget($instance, $atts)
    {

    }

}

class AWEWidgets_Advanced_menu extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_advanced_menu', 'description' => __('Use this widget to add one of your custom menus as a widget', LANGUAGE));
        parent::__construct('awew_advanced_menu', WO_THEMENAME . ' Advanced Menu', $args);
    }

    public function form($instance)
    {
            $instance = wp_parse_args($instance, array('title' => 'Advanced Menu', 'custom_widget_class' => '', 'select_menu' => '', 'show_as_dropdown' => '', 'starting_depth' => 0, 'total_menu_display' => -1, 'filter_selection_from' => 'display_all', 'container' => 'div', 'menu_class' => 'menu', 'before_link' => '', 'after_link' => '', 'before_text' => '', 'after_text' => '', 'color' => '', 'bg' => '', 'border_radius' => '', 'font_family' => ''));

            $menus = get_terms('nav_menu', array('hide_empty' => false));

            if (!$menus)
            {
                echo '<p>' . sprintf(__('No menu have been created yet. <a href="%s">Create some</a>', LANGUAGE), admin_url('nav-menus.php')) . '</p>';
                return;
            }
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>"
                       value="<?php echo $instance['title'] ?>"/>
            </p>
            <p>
                <label
                    for="<?php echo $this->get_field_id('custom_widget_class') ?>"><?php _e('Custom Widget Class', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('custom_widget_class') ?>"
                       value="<?php echo $instance['custom_widget_class'] ?>"/>
            </p>
            <p>
                <label
                    for="<?php echo $this->get_field_id('select_menu') ?>"><?php _e('Select Menu', LANGUAGE) ?></label>
                <select id="<?php echo $this->get_field_id('select_menu'); ?>" name="<?php echo $this->get_field_name('select_menu'); ?>">
                    <?php
                    foreach ($menus as $menu) :
                        $selected = $instance['select_menu'] == $menu->term_id ? ' selected="selected"' : '';
                        echo '<option' . $selected . ' value="' . $menu->term_id . '">' . $menu->name . '</option>';
                    endforeach;
                    ?>
                </select>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id("show_as_dropdown") ?>"><?php _e('Show as dropdown', LANGUAGE) ?></label>
                <input type="checkbox" name="<?php echo $this->get_field_name("show_as_dropdown") ?>" <?php echo !empty($instance['show_as_dropdown']) ? 'checked' : ''; ?>/>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id('starting_depth') ?>"><?php _e('Starting Depth', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('starting_depth') ?>"
                       value="<?php echo $instance['starting_depth'] ?>"/>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id('total_menu_display') ?>"><?php _e('Total Menu Display', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('total_menu_display') ?>"
                       value="<?php echo $instance['total_menu_display'] ?>"/>
                <code class="description"><?php _e('Enter -1 to as unlimited', LANGUAGE) ?></code>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id('filter_selection_from'); ?>"><?php _e('Filter selection from:', LANGUAGE); ?></label>
                <select name="<?php echo $this->get_field_name('filter_selection_from'); ?>"
                        id="<?php echo $this->get_field_id('filter_selection_from'); ?>" class="widefat">
                    <option value="0"<?php selected($only_related, 0); ?>><?php _e('Display all', LANGUAGE); ?></option>
                    <?php
                    $menu_id = ($instance['select_menu']) ? $instance['select_menu'] : $menus[0]->term_id;
                    $menu_items = wp_get_nav_menu_items($menu_id);
                    foreach ($menu_items as $menu_item) {
                        echo '<option value="' . $menu_item->ID . '"' . selected($instance['filter_selection_from'], $menu_item->ID) . '>' . $menu_item->title . '</option>';
                    }
                    ?>
                </select>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id('container') ?>"><?php _e('Container', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('container') ?>"
                       value="<?php echo $instance['container'] ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('menu_class') ?>"><?php _e('Menu Class', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('menu_class') ?>"
                       value="<?php echo $instance['menu_class'] ?>"/>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id('before_link') ?>"><?php _e('Before Link', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('before_link') ?>"
                       value="<?php echo $instance['before_link'] ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('after_link') ?>"><?php _e('After Link', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('after_link') ?>"
                       value="<?php echo $instance['after_link'] ?>"/>
            </p>
            <p>
                <label
                    for="<?php echo $this->get_field_id('before_text') ?>"><?php _e('Before Text', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('before_text') ?>"
                       value="<?php echo $instance['before_text'] ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('after_text') ?>"><?php _e('After Text', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('after_text') ?>"
                       value="<?php echo $instance['after_text'] ?>"/>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id('border_radius') ?>"><?php _e('Border Radius', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('border_radius') ?>"
                       value="<?php echo $instance['border_radius'] ?>"/>
            </p>


            <p  class="widget-colorpicker">
                <label for="<?php echo $this->get_field_id('color') ?>"><?php _e('Color', LANGUAGE) ?></label>
                <input type="text" class="widefat  wo-color-picker" name="<?php echo $this->get_field_name('color') ?>"
                       value="<?php echo $instance['color'] ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('bg') ?>"><?php _e('Background ', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('bg') ?>"
                       value="<?php echo $instance['bg'] ?>"/>
            </p>
            <p>
                <label
                    for="<?php echo $this->get_field_id('font_family') ?>"><?php _e('Font Family ', LANGUAGE) ?></label>
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('font_family') ?>"
                       value="<?php echo $instance['font_family'] ?>"/>
            </p>
        <?php
        }

        public function widget($atts, $instance)
        {

        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            foreach ($new_instance as $k => $v)
            {
                $instance[$k] = $v;
            }

            if (array_key_exists('show_as_dropdown', $new_instance))
            {
                $check = array('show_as_dropdown'=>1);
            }else{
                $check = array('show_as_dropdown'=>0);
            }

            $instance = array_merge($instance, $check);

            ?>


            <?php

            return $instance;

        }


}


class  AWEWidgets_Skills extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_skills', 'description' => '');
        parent::__construct('awew_skills', WO_THEMENAME.' Skills', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => 'Our Skills', 'skills' => array(''), 'percent' => array()));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title") ?>"><?php _e('Title', LANGUAGE) ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id("title") ?>"
                   name="<?php echo $this->get_field_name("title") ?>" value="<?php echo $instance['title'] ?>">
        </p>

        <div class="form-group">
            <?php
            $i = 0;
            foreach ($instance['skills'] as $k => $v) :
                $i++;
                ?>
                <p>
                    <label
                        for="<?php echo $this->get_field_id("skills") . '_' . $i; ?>"><?php _e('Skills', LANGUAGE) ?></label>
                    <input type="text" id="<?php echo $this->get_field_id("skills") . '_' . $i; ?>" class="widefat"
                           name="<?php echo $this->get_field_name("skills") . '[]'; ?>" value="<?php echo $v ?>"
                </p>
                <p>
                    <label
                        for="<?php echo $this->get_field_id("percent") . '_' . $i; ?>"><?php _e('Percent', LANGUAGE) ?></label>
                    <input type="text" id="<?php echo $this->get_field_id("percent") . '_' . $i; ?>" class="widefat"
                           name="<?php echo $this->get_field_name("percent") . '[]'; ?>"
                           value="<?php echo $instance['percent'][$k] ?>">
                </p>
            <?php endforeach; ?>
        </div>

        <div class="alignright wo-wrapclone">
            <input type="submit" class="button button-primary wo-addmore right " value="Add"/>
        </div>
        <div class="clear"></div>
    <?php
    }


    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($new_instance as $k => $v) {
            $instance[$k] = $v;
        }

        return $instance;
    }

    public function widget($atts, $instance)
    {

    }
}


class  AWEWidgets_Info_box extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_info_box', 'description' => '');
        parent::__construct('awew_infox_box', WO_THEMENAME.' Info Box', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => 'Info Box', 'info_content' => '', 'button_name' => 'Button', 'link_to' => ''));

        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title") ?>"><?php _e('Info Box', LANGUAGE) ?></label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name("title") ?>"
                   id="<?php echo $this->get_field_id("title") ?>" value="<?php echo $instance['title'] ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("info_content") ?>"><?php _e('Info Content', LANGUAGE) ?></label>
            <textarea class="widefat"
                      name="<?php echo $this->get_field_name("info_content") ?>"><?php echo $instance['info_content'] ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("link_to") ?>"><?php _e('Link To', LANGUAGE) ?></label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name("link_to") ?>"
                   id="<?php echo $this->get_field_id("link_to") ?>"
                   value="<?php echo esc_url($instance['link_to']) ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("button_name") ?>"><?php _e('Button Name', LANGUAGE) ?></label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name("button_name") ?>"
                   id="<?php echo $this->get_field_id("button_name") ?>"
                   value="<?php echo $instance['button_name'] ?>"/>
        </p>
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($new_instance as $k => $v) {
            $instance[$k] = strip_tags($v);
        }

        return $instance;
    }

    public function widget($atts, $instance)
    {

    }

}


class AWEWidgets_Tabs extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_tabs', 'description' => 'Create tabs is very easy');

        parent::__construct('awew_tabs', WO_THEMENAME.' Tabs', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => 'Tabs', 'tab_name' => array('Tab1'), 'tab_content' => array('')));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title") ?>"><?php _e('Title', LANGUAGE) ?></label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name("title") ?>"
                   id="<?php echo $this->get_field_id("title") ?>" value="<?php echo $instance['title'] ?>"/>
        </p>

        <p>
        <div class="form-group">
            <?php
            foreach ($instance['tab_name'] as $k => $v) :
                ?>
                <div class="effect-toggle toggle">
                    <div style="#fb6e50" class="toggle-wrap">
                        <h3 data-effect="blind"><?php echo !empty($v) ? $v : 'No Title'; ?></h3>
                        <b class="cross1"></b><b class="cross2"></b>
                    </div>
                    <div class="content-toggle">
                        <p>
                            <input type="text" class="widefat tab-title"
                                   name="<?php echo $this->get_field_name("tab_name") . '[]'; ?>"
                                   value="<?php echo $v ?>" placeholder="Tab Name"/>
                        </p>

                        <p>
                            <textarea placeholder="Content"
                                      name="<?php echo $this->get_field_name('tab_content') . '[]' ?>"
                                      class="tab-content"><?php echo $instance['tab_content'][$k] ?></textarea>
                        </p>
                    </div>
                </div>



            <?php
            endforeach;
            ?>
            <div class="alignright wo-wrapclone">
                <input type="submit" class="button button-primary wo-addmore right " value="Add"/>
            </div>
        </div>
        <div class="clear"></div>
        </p>

    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($new_instance as $k => $v) {

            if (!is_array($v)) {
                $instance[$k] = strip_tags($v);
            } else {
                foreach ($v as $ka => $va) {
                    $instance[$k][$ka] = strip_tags($va);
                }
            }
        }

        return $instance;
    }

    public function widget($atts, $instance)
    {

    }


}


class AWEWidgets_Social_networks extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_social_networks', 'description' => '');
        parent::__construct('awew_social_networks', WO_THEMENAME.' Social Networks', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => 'Social Networks', 'social_links' => array(''), 'social_icons' => array('fa fa-refresh')));

        ?>
        <p>
        <div class="form-group choose-icon">
            <h4 class="md-row-title"><?php _e('Input Social', LANGUAGE) ?></h4>
            <?php

            foreach ($instance['social_links'] as $k => $v) :
                ?>
                <div class="input-social left">
                    <input type="text" class="big" placeholder="<?php _e('Insert Social Link', LANGUAGE) ?>"
                           value="<?php echo esc_url($v); ?>"
                           name="<?php echo $this->get_field_name('social_links') . '[]'; ?>">
                    <a class="available-panel thickbox" href="#TB_inline?width=650&height=550&inlineId=awew-popup-it"><i
                            class="mdicon <?php echo $instance['social_icons'][$k] ?>"></i></a>
                    <input type="hidden" name="<?php echo $this->get_field_name('social_icons') . '[]' ?>"
                           value="<?php echo $instance['social_icons'][$k] ?>"/>
                </div>
            <?php
            endforeach;
            ?>

            <div class="alignright wo-wrapclone">
                <input type="submit" class="button button-primary wo-addmore right " value="Add"/>

            </div>
        </div><!-- input social -->
        <div class="clear" style="margin-botton:10px"></div>
        </p>
    <?php
    }

    public function widget($atts, $instance)
    {

    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($new_instance as $k => $v) {
            $instance[$k] = $v;
        }

        return $instance;

    }

}


class AWEWidgets_Contact_info extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_contact_info', 'description' => '');
        parent::__construct('awew_contact_info', WO_THEMENAME.' Contact Info', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => 'Contact Info', 'address' => '', 'phone' => '', 'fax' => '', 'email' => '', 'website_url' => ''));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('title') ?>"
                   id="<?php echo $this->get_field_id("title") ?>" value="<?php echo $instance['title'] ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('address') ?>"><?php _e('Address', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('address') ?>"
                   id="<?php echo $this->get_field_id("address") ?>" value="<?php echo $instance['address'] ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('phone') ?>"><?php _e('Phone', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('phone') ?>"
                   id="<?php echo $this->get_field_id("phone") ?>" value="<?php echo $instance['phone'] ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('fax') ?>"><?php _e('Fax', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('fax') ?>"
                   id="<?php echo $this->get_field_id("fax") ?>" value="<?php echo $instance['fax'] ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email') ?>"><?php _e('Email', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('email') ?>"
                   id="<?php echo $this->get_field_id("email") ?>" value="<?php echo $instance['email'] ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('website_url') ?>"><?php _e('Website Url', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('website_url') ?>"
                   id="<?php echo $this->get_field_id("website_url") ?>"
                   value="<?php echo esc_url($instance['website_url']) ?>"/>
        </p>
    <?php
    }

    public function  update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($new_instance as $k => $v) {
            $instance[$k] = strip_tags($new_instance[$k]);
        }

        return $instance;
    }

    public function widget($att, $instance)
    {

    }
}


class AWEWidgets_Do_shortcode extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_do_shortcode', 'description' => __('Enter Shortcode you want to use this here', LANGUAGE));
        parent::__construct('awew_do_shortcode', WO_THEMENAME.' Do Shortcode', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('awew_do_shortcode' => ''));
        if (!empty($instance['awew_do_shortcode'])) {
            $re = str_replace(",", "\n", $instance['awew_do_shortcode']);

        } else {
            $re = $instance['awew_do_shortcode'];
        }
        ?>
        <p>
            <label
                for="<?php echo $this->get_field_id('awew_do_shortcode') ?>"><?php _e('Do shortcode', LANGUAGE) ?></label>
            <textarea name="<?php echo $this->get_field_name('awew_do_shortcode') ?>"><?php echo $re ?></textarea>
        <p class="description"><?php _e('Enter each shortcode on the line', LANGUAGE) ?></p>
        </p>
    <?php
    }

    public function instance($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['awew_do_shortcode'] = isset($new_instance['awew_do_shortcode']) && !empty($instance['awew_do_shortcode']) ? str_replace("\n", ",", $new_instance['awew_do_shortcode']) : "";

        return $instance;
    }

    public function widget($atts, $instance)
    {

    }
}


class AWEWidgets_Megafullslider extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_megafullslider', 'description' => 'Very easy to create a slider');
        parent:: __construct('megafw_megafullslider', WO_THEMENAME.' MegaFullSlider', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('choose_megafullslider' => ''));

        # check plugin is activated

        if (!is_plugin_active('mega-full-slider/mega-full-slider.php')) {
            _e('Note: To use widget, you need MegaFullSlider  plugin installed ', LANGUAGE);
        } else {
            $getPages = get_posts(array('post_type' => 'mega-full-slider', 'posts-per-page' => -1, 'post_status' => 'publish'));

            $megaslider = admin_url('edit.php') . '?post_type=mega-full-slider';
            if (empty($getPages)) {
                echo __('Create a', LANGUAGE) . ' <a href="' . $megaslider . '" target="_blank">Megaslider</a>';
            } else {
                ?>
                <p>
                    <label
                        for="<?php echo $this->get_field_id("choose_megafullslider"); ?>"><?php _e("Choose Slider", LANGUAGE) ?></label>
                    <select name="<?php echo $this->get_field_name("choose_megafullslider"); ?>"
                            id="<?php echo $this->get_field_id("choose_megafullslider"); ?>">
                        <?php
                        foreach ($getPages as $post) : setup_postdata($post);

                            ?>
                            <option
                                value="<?php echo $post->ID ?>" <?php selected($instance['choose_megafullslider'], $post->ID) ?>><?php echo $post->post_title; ?></option>
                        <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </select>
                </p>
            <?php
            }

        }
    }

    public function update($new_instance, $old_instance)
    {

    }

    public function widget($atts, $instance)
    {

    }

}


class AWEWidgets_Megaslider extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_megaslider', 'description' => '');
        parent::__construct('awew_megaslider', WO_THEMENAME.' Megaslider', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('choose_megaslider' => ''));

        # check plugin is activated

        if (!is_plugin_active('mega-slider/mega-slider.php')) {
            _e('Note: To use widget, you need Megaslider  plugin installed ', LANGUAGE);
        } else {
            $getPages = get_posts(array('post_type' => 'mega-slider'));

            $megaslider = admin_url('edit.php') . '?post_type=mega-slider';
            if (empty($getPages)) {
                echo __('Create a', LANGUAGE) . ' <a href="' . $megaslider . '" target="_blank">Megaslider</a>';
            } else {
                ?>
                <p>
                    <label
                        for="<?php echo $this->get_field_id("choose_megaslider"); ?>"><?php _e("Choose Slider", LANGUAGE) ?></label>
                    <select name="<?php echo $this->get_field_name("choose_megaslider"); ?>"
                            id="<?php echo $this->get_field_id("choose_megaslider"); ?>">
                        <?php
                        foreach ($getPages as $post) : setup_postdata($post);

                            ?>
                            <option
                                value="<?php echo $post->ID ?>" <?php selected($instance['choose_megaslider'], $post->ID) ?>><?php echo $post->post_title; ?></option>
                        <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </select>
                </p>
            <?php
            }

        }
    }

    public function update($new_instance, $old_instance)
    {

    }

    public function widget($atts, $instance)
    {

    }

}


class AWEWidgets_Map extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_map', 'description' => '');
        parent::__construct('awew_map', WO_THEMENAME.' Map', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => 'Google Map', 'Latlng' => '', 'mapProp_zoom' => 5, 'mapTypeId' => 'ROADMAP', 'position' => 'myCenter', 'animation' => 'bounce', 'mapInfoWindow_infowindow' => 'Wiloke, Hello World!'));

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('title') ?>"
                   id="<?php echo $this->get_field_id("title") ?>" value="<?php echo $instance['title'] ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('latlng') ?>"><?php _e('LatLng', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('latlng') ?>"
                   id="<?php echo $this->get_field_id("latlng") ?>" value="<?php echo $instance['latlng'] ?>"/>
        </p>
        <p>
            <input class="widefat" type="checkbox" name="<?php echo $this->get_field_name('mapProp') ?>"
                   id="<?php echo $this->get_field_id("mapProp") ?>" <?php checked($instance['mapProp'], 1) ?>
                   data-toggle="setting-mapProp"/>
            <label for="<?php echo $this->get_field_id('mapProp') ?>"><?php _e('Map Prop', LANGUAGE) ?></label>
        </p>
        <p class="setting-mapProp">
            <label for="<?php echo $this->get_field_id('mapProp_zoom') ?>"><?php _e('Zoom', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('mapProp_zoom') ?>"
                   id="<?php echo $this->get_field_id("mapProp_zoom") ?>" <?php echo($instance['mapProp_zoom']); ?> />
        </p>
        <p class="setting-mapProp">
            <label for="<?php echo $this->get_field_id('mapTypeId') ?>"><?php _e('Map Type', LANGUAGE) ?></label>
            <select name="<?php echo $this->get_field_name("mapTypeId") ?>">
                <option value="ROADMAP" <?php selected($instance['mapTypeId'], 'ROADMAP') ?>>ROADMAP</option>
                <option value="SATELLITE" <?php selected($instance['mapTypeId'], 'SATELLITE') ?>>SATELLITE</option>
                <option value="HYBRID" <?php selected($instance['mapTypeId'], 'HYBRID') ?>>HYBRID</option>
                <option value="TERRAIN" <?php selected($instance['mapTypeId'], 'TERRAIN') ?>>TERRAIN</option>
            </select>
        </p>

        <p>
            <input class="widefat" type="checkbox" name="<?php echo $this->get_field_name('mapMarker') ?>"
                   id="<?php echo $this->get_field_id("mapMarker") ?>" <?php checked($instance['mapMarker'], 1) ?>
                   data-toggle="setting-mapMarker"/>
            <label for="<?php echo $this->get_field_id('mapMarker') ?>"><?php _e('Map Marker', LANGUAGE) ?></label>
        </p>
        <p class="setting-mapMarker">
            <label
                for="<?php echo $this->get_field_id('mapMarker_animation') ?>"><?php _e('Animation', LANGUAGE) ?></label>
            <select name="<?php echo $this->get_field_name("mapMarker_animation") ?>">
                <option value="bounce" <?php selected($instance['mapMarker_animation'], 'bounce') ?>>Bounce</option>
                <option value="drop" <?php selected($instance['mapMarker_animation'], 'drop') ?>>Drop</option>
            </select>
        </p>

        <p>
            <input class="widefat" type="checkbox" name="<?php echo $this->get_field_name('mapInfoWindow') ?>"
                   id="<?php echo $this->get_field_id("mapInfoWindow") ?>" <?php checked($instance['mapInfoWindow'], 1) ?>
                   data-toggle="setting-mapInfoWindow"/>
            <label for="<?php echo $this->get_field_id('mapInfoWindow') ?>"><?php _e('Info Window', LANGUAGE) ?></label>
        </p>
        <p class="setting-mapInfoWindow">
            <label
                for="<?php echo $this->get_field_id("mapInfoWindow_infowindow") ?>"><?php _e("Info Window", LANGUAGE) ?></label>
            <textarea name="<?php echo $this->get_field_name("mapInfoWindow_infowindow") ?>"
                      class="widefat"><?php echo $instance['mapInfoWindow_infowindow'] ?></textarea>
        </p>
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'] ? strip_tags($new_instance['title']) : '';
        $instance['latlng'] = $new_instance['latlng'] ? strip_tags($new_instance['latlng']) : '';
        $instance['mapProp'] = $new_instance['mapProp'] ? 1 : 0;
        $instance['mapProp_zoom'] = $new_instance['mapProp_zoom'] ? $new_instance['mapProp_zoom'] : '';
        $instance['mapTypeId'] = $new_instance['mapTypeId'] ? $new_instance['mapTypeId'] : 'ROADMAP';
        $instance['mapMarker'] = $new_instance['mapMarker'] ? 1 : 0;
        $instance['mapMarker_animation'] = $new_instance['mapMarker_animation'] ? $new_instance['mapMarker_animation'] : 'bounce';
        $instance['mapInfoWindow'] = $new_instance['mapInfoWindow'] ? 1 : 0;
        $instance['mapInfoWindow_infowindow'] = $new_instance['mapInfoWindow_infowindow'] ? strip_tags($new_instance['mapInfoWindow_infowindow']) : '';

        return $instance;
    }

    public function widget($atts, $instance)
    {

    }


}


class AWEWidgets_Like_box extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_likbox', 'description' => '');
        parent::__construct('awew_likebox', WO_THEMENAME.' Like Box', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => __('Find us on Facebook', LANGUAGE), 'color_scheme' => 'light', 'page_url' => 'https://www.facebook.com/FacebookDevelopers'));

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('title') ?>"
                   id="<?php echo $this->get_field_id("title") ?>" value="<?php echo $instance['title'] ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('page_url') ?>"><?php _e('Page URL', LANGUAGE) ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('page_url') ?>"
                   id="<?php echo $this->get_field_id("page_url") ?>" value="<?php echo $instance['page_url'] ?>"/>
        </p>

        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('show_profile_of_friends') ?>"
                   id="<?php echo $this->get_field_id("show_profile_of_friends") ?>"  <?php checked($instance['show_profile_of_friends'], 1) ?>/>
            <label
                for="<?php echo $this->get_field_id('show_profile_of_friends') ?>"><?php _e("Show Friends's Faces", LANGUAGE) ?></label>
        </p>

        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('show_header') ?>"
                   id="<?php echo $this->get_field_id("show_header") ?>"   <?php checked($instance['show_header'], 1) ?>/>
            <label for="<?php echo $this->get_field_id('show_header') ?>"><?php _e('Show Header', LANGUAGE) ?></label>
        </p>

        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('show_border') ?>"
                   id="<?php echo $this->get_field_id("show_border") ?>" <?php checked($instance['show_border'], 1) ?>/>
            <label for="<?php echo $this->get_field_id('show_border') ?>"><?php _e('Show Border', LANGUAGE) ?></label>
        </p>

        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('show_posts') ?>"
                   id="<?php echo $this->get_field_id("show_posts") ?>" <?php checked($instance['show_posts'], 1) ?>/>
            <label for="<?php echo $this->get_field_id('show_posts') ?>"><?php _e('Show Posts', LANGUAGE) ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('color_scheme') ?>"><?php _e('Color Scheme', LANGUAGE) ?></label>
            <select id="<?php echo $this->get_field_id('color_scheme') ?>"
                    name="<?php echo $this->get_field_name("color_scheme") ?>">
                <option
                    value="light" <?php selected($instance['color_scheme'], 'light') ?>><?php _e('Light', LANGUAGE) ?></option>
                <option
                    value="dark" <?php selected($instance['color_scheme'], 'dark') ?>><?php _e('Dark', LANGUAGE) ?></option>
            </select>
        </p>


    <?php
    }


    public function widget($atts, $instance)
    {

    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'] ? ($new_instance['title']) : '';
        $instance['page_url'] = $new_instance['page_url'] ? esc_url($new_instance['page_url']) : '';
        $instance['show_profile_of_friends'] = $new_instance['show_profile_of_friends'] ? 1 : 0;
        $instance['show_posts'] = $new_instance['show_posts'] ? 1 : 0;
        $instance['show_border'] = $new_instance['show_border'] ? 1 : 0;
        $instance['show_header'] = $new_instance['show_header'] ? 1 : 0;
        $instance['color_scheme'] = $new_instance['color_scheme'] ? $new_instance['color_scheme'] : 'light';

        return $instance;

    }

}


class AWEWidgets_Contact_form extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_contact_form', 'description' => 'Contact Form');
        parent::__construct('awew_contact_form', WO_THEMENAME.' CONTACT FORM', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('choose_contact_form' => ''));

        # check plugin is activated

        if (!is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
            _e('Note: To use widget, you need CONTACT FORM plugin installed ', LANGUAGE);
        } else {
            $getPages = get_posts(array('post_type' => 'wpcf7_contact_form'));
            $contactform = admin_url('admin.php') . '?page=wpcf7';
            if (empty($getPages)) {
                echo __('Create a', LANGUAGE) . ' <a href="' . $contactform . '" target="_blank">Contact Form</a>';
            } else {
                ?>
                <p>
                    <label
                        for="<?php echo $this->get_field_id("choose_contact_form"); ?>"><?php _e("Choose Contact Form", LANGUAGE) ?></label>
                    <select name="<?php echo $this->get_field_name("choose_contact_form"); ?>"
                            id="<?php echo $this->get_field_id("choose_contact_form"); ?>">
                        <?php
                        foreach ($getPages as $post) : setup_postdata($post);

                            ?>
                            <option
                                value="<?php echo $post->ID ?>" <?php selected($instance['choose_contact_form'], $post->ID) ?>><?php echo $post->post_title; ?></option>
                        <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </select>
                </p>
            <?php
            }

        }
    }

    public function widget($atts, $instance)
    {

    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($new_instance as $k => $v) {
            $instance[$k] = (int)$v;
        }

        return $instance;
    }

}


class AWEWidgets_Ads extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_ads', 'description' => '');

        parent::__construct('awew_ads', WO_THEMENAME.' ADS', $args);
    }

    public function form($instance)
    {

        $instance = wp_parse_args($instance, array('image_ads' => '', 'ads_link' => ''));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id("image_ads") ?>"><?php _e('Ads Image', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("image_ads") ?>"
                   id="<?php echo $this->get_field_id("image_ads") ?>" class="widefat input-bgcolor image-url"
                   value="<?php echo ltrim($instance['image_ads']) ?>">
            <input class="md-button upload-img" type="button" value="<?php _e('Upload', LANGUAGE) ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("ads_link") ?>"><?php _e('Ads Link', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("ads_link") ?>"
                   id="<?php echo $this->get_field_id("ads_link") ?>" class="widefat"
                   value="<?php echo ltrim($instance['ads_link']) ?>">
        </p>
    <?php
    }

    public function widget($atts, $instance)
    {

    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($new_instance as $k => $v) {
            $instance[$k] = esc_url($v);
        }

        return $instance;

    }

}


class AWEWidgets_Twitter extends WP_Widget
{
    public function __construct()
    {
        $args = array('classname' => 'awew_twitter', 'description' => __('Get latest tweets your twitter',LANGUAGE));

        parent::__construct('awew_twitter', WO_THEMENAME.' LATEST TWEETS', $args);
    }

    public function widget($atts, $instance)
    {
        ?>

    <?php
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => 'Latest Tweets', 'username' => '', 'loading_text' => __('Loading Twitter Feed...', LANGUAGE), 'count' => 4, 'app_consumer_key' => '', 'app_consumer_secret' => '', 'app_access_token' => '', 'app_access_token_secret' => ''));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title") ?>"><?php _e('Title', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("title") ?>"
                   id="<?php echo $this->get_field_id("title") ?>" class="widefat"
                   value="<?php echo ltrim($instance['title']) ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("username") ?>"><?php _e('User Name', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("username") ?>"
                   id="<?php echo $this->get_field_id("username") ?>" class="widefat"
                   value="<?php echo ltrim($instance['username']) ?>"
                   placeholder="<?php _e('Your App User name (required)', LANGUAGE) ?>">
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id("loading_text") ?>"><?php _e(' Loading Text', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("loading_text") ?>"
                   id="<?php echo $this->get_field_id("loading_text") ?>" class="widefat"
                   value="<?php echo ltrim($instance['loading_text']) ?>"
                   placeholder="<?php _e('Loading Twitter Feed ...', LANGUAGE) ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id("count") ?>"><?php _e(' Count ', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("count") ?>"
                   id="<?php echo $this->get_field_id("count") ?>" class="widefat"
                   value="<?php echo (int)$instance['count'] ?>" placeholder="<?php _e('Number  Tweets', LANGUAGE) ?>">
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id("app_consumer_key") ?>"><?php _e(' App Consumer Key', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("app_consumer_key") ?>"
                   id="<?php echo $this->get_field_id("app_consumer_key") ?>" class="widefat"
                   value="<?php echo ltrim($instance['app_consumer_key']) ?>"
                   placeholder="<?php _e('Your Twitter App Consumer Key (required)', LANGUAGE) ?>"
                   title="<?php _e('Your Twitter App Consumer Key (required)', LANGUAGE) ?>">
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id("app_consumer_secret") ?>"><?php _e(' App Consumer Secret', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("app_consumer_secret") ?>"
                   id="<?php echo $this->get_field_id("app_consumer_secret") ?>" class="widefat"
                   value="<?php echo ltrim($instance['app_consumer_secret']) ?>"
                   placeholder="<?php _e('Your Twitter App Consumer Secret (required)', LANGUAGE) ?>"
                   title="<?php _e('Your Twitter App Consumer Secret (required)', LANGUAGE) ?>">
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id("app_access_token") ?>"><?php _e(' App Access Token ', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("app_access_token") ?>"
                   id="<?php echo $this->get_field_id("app_access_token") ?>" class="widefat"
                   value="<?php echo ltrim($instance['app_access_token']) ?>"
                   placeholder="<?php _e('Your Twitter App Access Token (required)', LANGUAGE) ?>"
                   title="<?php _e('Your Twitter App Access Token (required)', LANGUAGE) ?>">
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id("app_access_token_secret") ?>"><?php _e(' App Access Token Secret', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("app_access_token_secret") ?>"
                   id="<?php echo $this->get_field_id("app_access_token_secret") ?>" class="widefat"
                   value="<?php echo ltrim($instance['app_access_token_secret']) ?>"
                   placeholder="<?php _e('Your Twitter App Access Token Secret (required)', LANGUAGE) ?>"
                   title="<?php _e('Your Twitter App Access Token Secret (required)', LANGUAGE) ?>">
        </p>


    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($new_instance as $k => $v) {
            $instance[$k] = strip_tags($v);
        }

        return $instance;

    }
}


class AWEWidgets_Flickr extends WP_Widget
{

    public function  __construct()
    {
        $args = array('classname' => 'awew_flickr', 'description' => __('Allow you to display your Flickr\'s photosets', LANGUAGE));
        parent::__construct('awew_flickr', WO_THEMENAME . 'Flickr', $args);
    }

    public function form($instance)
    {
        $instance = wp_parse_args($instance, array('title' => 'Flickr', 'id' => '', 'limit' => 6));

        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title") ?>"><?php _e('Title', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("title") ?>"
                   id="<?php echo $this->get_field_id("title") ?>" class="widefat"
                   value="<?php echo $instance['title'] ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("id") ?>"><?php _e('Id', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("id") ?>"
                   id="<?php echo $this->get_field_id("id") ?>" class="widefat"
                   value="<?php echo $instance['id'] ?>"
                   placeholder="<?php _e('required', LANGUAGE) ?>">
            <span><a href="http://idgettr.com/" target="_blank">Find the Flickr Id number</a></span>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("limit") ?>"><?php _e('Limit', LANGUAGE) ?></label>
            <input type="text" name="<?php echo $this->get_field_name("limit") ?>"
                   id="<?php echo $this->get_field_id("limit") ?>" class="widefat"
                   value="<?php echo $instance['limit'] ?>">
        </p>
    <?php
    }

    public function update($newInstance, $oldInstance)
    {
        $instance = $oldInstance;

        foreach ($newInstance as $k => $v) {
            if ($k == 'limit') {
                $instance[$k] = (int)$v;
            } else {
                $instance[$k] = strip_tags($v);
            }
        }

        return $instance;
    }

    public function widget($atts,$instance)
    {
        extract($atts, EXTR_SKIP);

        $title = isset($instance['title']) ? apply_filters("widget-title", $instance['title']) : "";
        $id = isset($instance['id']) ? strip_tags($instance['id']) : "";
        $limit = isset($instance['limit']) ? strip_tags($instance['limit']) : 8;
        $output = "";
        $output .= $before_widget;
        if(!empty($title))
            $output .= $before_title.$title.$after_title;
         // $output.='<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$instance['count'].'&amp;display='.$instance['order'].'&amp;size=s&amp;layout=x&amp;source=user;user='.$instance['flickrid'].'"></script>';
        $output .= "<ul id='awe-flickr-widget' class='thumbs flickr-content'>";
        $output .= '</ul>';
        $output .='<script type="text/javascript">';
            $output .= 'jQuery(document).ready(function($){';
                $output .= '$("#awe-flickr-widget").jflickrfeed({';
                    $output .= 'limit: ' . $limit . ',';
                    $output .= 'qstrings: {';
                        $output .= "id: '".$id."',";
                    $output .= '},';
                    $output .= 'itemTemplate: \'<li class="transition"><a href={{link}}" title="{{title}}"><img alt="{{title}}" src="{{image_s}}" /></a></li>\'';
                $output .= '})';
            $output .= '})';
        $output .= '</script>';
        $output .= $after_widget;

        echo $output;
    }   
}

