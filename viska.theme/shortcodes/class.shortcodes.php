<?php
/**
 * Created by JetBrains PhpStorm.
 * User: duongle
 * Date: 2/7/14
 * Time: 3:41 PM
 * To change this template use File | Settings | File Templates.
 */


Class AWEShortcodes 
{
    const AWEW_SHORTCODES  = "_configs_shortcodes";
    public $shortcodes_options = array();

    // public $aShortcodes = array("carousel"=>1, "tabs"=>1, "accordions"=>1, "toggle"=>1, "content_boxes"=>1, "modal"=>1, "button"=>1, "alert"=>1, "progress_bars"=>1, "circles_bar"=>1, "video"=>1, "tooltip"=>1, "social_icons"=>1, "googlemap"=>1, "dropcaps"=>1, "lists_style"=>1, "mailchimp"=>1);

    public $aKills = array();
    public $aweShortcodes = array();

    public $aGroup = array();

    public function __construct()
    {
       
        // add_action('admin_menu', array($this,'register_shortcodes_menu'));
        add_action('admin_enqueue_scripts', array($this, 'awe_enqueue_scripts'));
        add_action('print_media_templates', array( $this, 'print_media_templates' ) );
        // add_action('wp_ajax_save_shortcodes', array($this, 'awe_save_configs'));
        // add_action('wp_ajax_reset_shortcodes', array($this, 'awe_reset_configs'));
        add_action('admin_head', array($this, 'awe_add_mce_button') );
        add_action('admin_footer', array($this, 'awe_include_shortcode_into_footer'));
        add_action('wp_ajax_shortcode_machine', array($this, "awe_parse_shortcode"));
        add_action('wp_enqueue_scripts', array($this, 'awe_fe_scripts'));

        /*
        *-----------------------------------
            Add shortcodes
        *-----------------------------------
        */
        add_shortcode( 'awe_button', array($this, "awe_create_button_shortcode") );
        //add_shortcode( 'awe_mailchimp', array($this, "awe_create_mailchimp_shortcode"));
        add_shortcode( 'awe_alert', array($this, "awe_create_alerts_shortcode"));
        add_shortcode( 'awe_tabs', array($this, "awe_create_tabs_shortcode") );
        add_shortcode( 'awe_accordion', array($this, "awe_create_accordion_shortcode"));
        add_shortcode( 'awe_dropcap', array($this, "awe_create_dropcap"));
        add_shortcode( 'awe_liststyle', array($this, "awe_create_awe_liststyle"));
        add_shortcode( 'awe_progressbar', array($this, "awe_create_awe_progressbar"));
        add_shortcode( 'awe_video', array($this, "awe_create_video_shortcode"));
        // add_action('init', array($this, 'test'));

        // filter gallery shortcode if user apply awe slider shortcode
        add_filter( 'post_gallery', array($this, 'awe_gallery_shortcode'), 10, 4 );
        add_filter( 'mce_external_plugins', array($this, 'awe_add_tinymce_plugin' ));
        add_filter( 'mce_buttons', array($this, 'awe_register_mce_button' ));
    }   


    public function awe_gallery_shortcode( $output = '', $atts, $content = false, $tag = false )
    {
        $return = $output; // fallback

        // retrieve content of your own gallery function
        $endRes = $this->awe_get_gallery_content( $atts );

        // boolean false = empty, see http://php.net/empty
        if( !empty( $endRes ) ) 
        {
            $return = $endRes;
        }

        return $return;
    }

    public function awe_get_gallery_content($atts)
    {
        // [gallery awe_slider="true" awe_one_slide="false" awe_auto_play="true" ids="182,183,181"]
        $aweID          = isset($atts['ids']) ? $atts['ids'] : '';
        $aweSlider      = isset($atts['awe_slider'])    ? $atts['awe_slider'] : false;
        $aweOnslider    = isset($atts['awe_one_slide']) ? $atts['awe_one_slide'] : false;
        $aweAutoplay    = isset($atts['awe_auto_play']) ? $atts['awe_auto_play'] : false;
        $aweColumns     = isset($atts['columns']) ? $atts['columns'] : 5;

        $slider = "";

        if ($aweSlider)
        {
            $sliderID = uniqid("awe_slider_id_");
            $slider .= '<div id='.$sliderID.' class="owl-carousel owl-theme awe_theme_courousel">';
                if ( isset($aweID) && !empty($aweID) )
                {
                    $parse = explode(",", $aweID);
                    foreach ($parse as $id) :
                        $slider .= '<div class="item awe_item_courousel">'.wp_get_attachment_image($id, 'full', false, array('alt'   => trim(strip_tags( get_post_meta($id, '_wp_attachment_image_alt', true) )),) ).'</div>';
                    endforeach;
                }
            $slider .= '</div>';

            $slider .= '<script type="text/javascript">';
            $slider .= 'jQuery(document).ready(function()
                    {
                        var owl = jQuery("#'.$sliderID.'");
                        owl.owlCarousel({
                            navigation : true,
                            singleItem : '.$aweOnslider.',
                            transitionStyle : "fade",
                            autoPlay: '.$aweAutoplay.',
                            navigationText: ["",""]
                        });

                    })';
            $slider .= '</script>';
        }

        return $slider; 
    }

    public function awe_create_video_shortcode($atts)
    {
        $a = shortcode_atts(array(
            'src'     => '',
        ), $atts);

        $src = preg_replace('/http[^\/]*/', '', $a['src']);
        
        $type = preg_match("/youtube/", $src) ? 'youtube' : 'vimeo';


        if($type=='youtube')
        {
            $videoId =  preg_replace("/(.)*[\?v=]/", "", $src);
           
            $src     =  "//www.youtube.com/embed/".$videoId.'?rel=0"';
        }else{
            // if($video['type']=='vimeo')
            $videoId = explode("/", $src);
            $videoId = end($videoId);
            $src     = '//player.vimeo.com/video/'.$videoId;
        }
       
        

        return  '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="'.$src.'"></iframe></div>';
    }

    public function awe_create_awe_progressbar($atts, $content="")
    {
        $a = shortcode_atts(array(
            'effect'     => '',
        ), $atts);

        $progressbar = "";
        $context     = "";
        $percent     = "";

        if ( !empty($content) )
        {   
            $parse = explode("[/progressbar]", $content); 
            if ( !empty($content) )
            {
                array_pop($parse);
                foreach  ($parse as $item)
                {   
                    


                    preg_match("/context='?\"[^'\"]*/i", $item, $match);



                    if ( isset($match[0]) && !empty($match[0]) )
                    {
                        $parseContext     = explode("=", $match[0]);
                        $context          = str_replace(array('"', "'"), array('', ''), $parseContext[1]);
                    }

                    preg_match("/percent='?\"[^'\"]*/i", $item, $match);
                    if ( isset($match[0]) && !empty($match[0]) )
                    {
                        $parsePercent     = explode("=", $match[0]);
                        $percent          =  str_replace(array('"', "'"), array('', ''), $parsePercent[1]);
                    }

                    if (  ($percent != '') ) :
                        $progressbar .= '<div class="progress">';
                            $progressbar .= '<div class="progress-bar '. $context . ' ' . $a['effect'] .'" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%;">';
                                $progressbar .= '<span class="sr-only">'.$percent.'% Complete</span>';
                            $progressbar .= '</div>';
                        $progressbar .= '</div>';
                    endif;
                }
            }
        }

        return $progressbar;
    }

    public function awe_create_awe_liststyle($atts, $content="")
    {
        $a = shortcode_atts(array(
            'icon'     => '',
            'content'  => '#000',
        ), $atts);

        $fa = !empty($a['icon']) ? '<i class="'.$a['icon'].'"></i>' : '';

        if ( !empty($content) )
        {
            $parse = explode("[/list]", $content);
            $lists = ""; $liststyle="";

            if ( !empty($parse) )
            {
                array_pop($parse);
                foreach  ($parse as $data)
                {
                    $lists .= '<li>' . $fa .  str_replace("[list]", "", $data)  . '</li>';
                }
            }

            $liststyle .= '<ul class="awe_liststyle">';
            $liststyle .= $lists;
            $liststyle .= '</ul>';

            return $liststyle;
        }
    }

    public function awe_create_dropcap($atts)
    {
        $a = shortcode_atts(array(
            'color'     => '#e20000',
            'content'   => 'D',
        ), $atts);

        return '<span  class="awe_dropcap" style="color:    '.$a['color'].'">'.$a['content'].'</span>';
    }

    public function awe_create_accordion_shortcode($atts, $content="")
    {
        if ( !empty($content) )
        {
            $parse = explode("/accordion", $content);
            array_pop($parse);
            $accordion = "";
            $contents   = "";

            if (!empty($parse))
            {


                foreach ($parse as $item)
                {
                    $tabId  = uniqid("awe_accordionid_");
                    $item = preg_replace( array('/&#8221;/', '/&#8243;/'), array('"', '"'), $item);
                    preg_match("/title='?\"[^'\"]*/i", $item, $match);

                    if ( isset($match[0]) && !empty($match[0]) )
                    {
                        $parseTitle = explode("=", $match[0]);
                        $contents      .= '<h3>' . str_replace(array('"', "'"), array('', ''), $parseTitle[1])  . '</h3>';
                    }

                    if (!empty($item))
                    {
                        $conParse = preg_replace("/\[(.)*\]/", "", $item);
                        $conParse = preg_replace("/^\]/", "", $conParse);
                        
                        $contents .= '<div class="awe_accordion_item"><p>' . preg_replace("/\[$/", "", $conParse) . '</p></div>';
                    }
                
                }
            }

            if (  !empty($contents) )
            {
                $accordion   .= '<div class="awe_accordion">';
                    $accordion   .= $contents;
                $accordion   .= '</div>';
            }
            
            return $accordion;  

        }
    }

    public function awe_create_tabs_shortcode($atts, $content="")
    {
        if ( !empty($content) )
        {
            $parse = explode("/subtab", $content);
            array_pop($parse);
            $tabs = "";
            $title      = "";
            $contents   = "";

            if (!empty($parse))
            {


                foreach ($parse as $item)
                {
                    $tabId  = uniqid("awe_tabid_");

                    preg_match("/title='?\"[^'\"]*/i", $item, $match);

                    if ( isset($match[0]) && !empty($match[0]) )
                    {
                        $parseTitle = explode("=", $match[0]);
                        $title      .= '<li><a href="#'.$tabId.'">' . str_replace(array('"', "'"), array('', ''), $parseTitle[1])  . '</a></li>';
                    }

                    if (!empty($item))
                    {
                        $conParse = preg_replace("/\[(.)*\]/", "", $item);
                        $conParse = preg_replace("/^\]/", "", $conParse);
                        
                        $contents .= '<div id="'.$tabId.'"><p>' . preg_replace("/\[$/", "", $conParse) . '</p></div>';
                    }
                
                }
            }

            if ( !empty($title) && !empty($contents) )
            {
                $tabs   .= '<div class="awe_tabs">';
                    $tabs  .= '<ul>' . $title . '</ul>';
                    $tabs   .= $contents;
                $tabs   .= '</div>';
            }
            
            return $tabs;

        }
    }

    public function awe_create_alerts_shortcode($atts)
    {
        $a = shortcode_atts(array(
                'type'      => 'alert-success',
                'content'   => 'Hello! Welcome to AWE Themes.',
            ), $atts);
        return '<div class="alert '.$a['type'].'" role="alert">'.$a['content'].'</div>';
    }

    public function awe_fe_scripts()
    {
        // if(is_single())
        // {
            $url = get_template_directory_uri() .  '/assets_admin/';
            wp_register_style('awe_ui_style', $url . 'css/jquery-ui-1.10.4.css', array(), null);
            wp_enqueue_style('awe_ui_style');
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-accordion');
            wp_register_style('awe_shortcode', $url . 'css/shortcode.css', array(), '3.0.0');
            wp_enqueue_style('awe_shortcode');  
            wp_register_script('awe_shortcodejs', get_template_directory_uri() . '/assets/js/awe.shortcode.js', array(), '1.0');
            wp_enqueue_script('awe_shortcodejs');
        // }
        
    }


    public function awe_create_button_shortcode($atts)
    {
        $a = shortcode_atts(array(
                'size' => 'btn-default',
                'type' => 'btn-default',
                'name' => 'Button',
                'link' => '#'
            ), $atts);

        return '<a  href="'.$a['link'].'" class="awe-button '.$a['type']. ' ' . $a['size'] . ' ">'.$a['name'].'</a>';
    }


    public function print_media_templates()
    {
       
        ?>
        <script type="text/html" id="tmpl-awe-slider">
            <div class="awe-detail-settings">
                <label class="setting alt-text">
                    <span class="awe-lb"><?php _e('Slider',LANGUAGE); ?></span>
                    <input type="checkbox" data-setting="awe_slider" name="awe_slider"/>
                </label>
            </div>
            <div class="awe-detail-settings">
                <label class="setting alt-text">
                    <span class="awe-lb"><?php _e('One Slide',LANGUAGE); ?></span>
                    <input type="checkbox" data-setting="awe_one_slide" name="awe_one_slide"/>
                </label>
            </div>
            <div class="awe-detail-settings">
                <label class="setting alt-text">
                    <span class="awe-lb"><?php _e('Auto Play',LANGUAGE); ?></span>
                    <input type="checkbox" data-setting="awe_auto_play" name="awe_auto_play"/>
                </label>
            </div>
        </script>
        <script type="text/javascript">
        jQuery(document).ready(function()
        {
            _.extend(wp.media.gallery.defaults, 
            {
                awe_slider: 0,
                awe_one_slide: 0, 
                awe_auto_play: 1
            });

            // merge default gallery settings template with yours
            wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend(
            {
                template: function(view)
                {
                    return wp.media.template('gallery-settings')(view) + wp.media.template('awe-slider')(view);
                }
            });
        })
        </script>
        <?php 
    
    }

    public function awe_parse_shortcode()
    {
        if ( !isset($_POST['render']) || empty($_POST['render']) ) die("R U Kidding me! :D");

        $render = ltrim($_POST['render']);


        switch ($render) :

            case 'tabs':
                if ( !isset($_POST['content']) || empty($_POST['content'])) die("Please fill content");
                $li = "";$cont = ""; $createTabs; $createContent;

                $content = $_POST['content'];

                $parse  = explode("\n", $content);

                if (!empty($parse))
                {
                    foreach ($parse as $k => $val)
                    {
                        $val = stripslashes($val);
                        $id = uniqid("awe_tabs_");
                        preg_match("/title=\"[^'\"]*/", $val, $match);
                       
                        if (!empty($match[0]))
                        {
                            $getTitle = explode("=", $match[0]);
                            $getTitle = $getTitle ? $getTitle[1] : '';
                            $getTitle = str_replace("\"", "", $getTitle);

                            $li .= '<li><a href="#'.$id.'">'.$getTitle.'</a></li>';
                        }
                        
                        preg_match("/\][^[]*/", $val, $match1);
                        
                        if (!empty($match1[0]))
                        {
                            $getContent =  str_replace("]", "", $match1[0]);

                            $cont .= '<div id="'.$id.'">'.$getContent.'</div>';
                        }
                    }

                    echo '<div class="awe_tabs">';
                        echo '<ul>';
                            echo $li;
                        echo '</ul>';
                        echo $cont;
                    echo '</div>';   
                   
                }

                break;
            case 'accordion':
                if ( !isset($_POST['content']) || empty($_POST['content'])) die("Please fill content");
                $content = $_POST['content'];
                $li = "";$cont = "";

                $parse  = explode("\n", $content);

                if (!empty($parse))
                {
                    foreach ($parse as $k => $val)
                    {
                        $val = stripslashes($val);
                        $id = uniqid("awe_tabs_");
                        preg_match("/title=\"[^'\"]*/", $val, $match);
                       
                        if (!empty($match[0]))
                        {
                            $getTitle = explode("=", $match[0]);
                            $getTitle = $getTitle ? $getTitle[1] : '';
                            $getTitle = str_replace("\"", "", $getTitle);

                            $li .= '<h3>'.$getTitle.'</h3>';
                        }
                        
                        preg_match("/\][^[]*/", $val, $match1);
                        
                        if (!empty($match1[0]))
                        {
                            $getContent =  str_replace("]", "", $match1[0]);

                            $li .= '<div>'.$getContent.'</div>';
                        }
                    }

                    echo '<div class="awe_accordion">';
                        echo $li;
                        // echo $cont;
                    echo '</div>';   
                   
                }
                break;
                
                case 'liststyle':
                    if ( !isset($_POST['content']) || empty($_POST['content'])) die("Please fill content");
                    $icon = isset($_POST['icon']) && !empty($_POST['icon']) ? '<i class="'.$_POST['icon'].'"></i>' : '';
                    $content = $_POST['content'];
                    $cont = "";

                    $parse  = explode("\n", $content);

                    if (!empty($parse))
                    {
                        foreach ($parse as $k => $val)
                        {
                            $val = stripslashes($val);
                           
                            preg_match("/\][^[]*/", $val, $match);
                            
                            if (!empty($match[0]))
                            {
                                $getContent =  str_replace("]", "", $match[0]);

                                $cont .= '<li>'.$icon.$getContent.'</li>';
                            }
                        }

                        
                        echo $cont;
                    }

                break;

                case 'progressbar':
                    if ( !isset($_POST['content']) || empty($_POST['content'])) die("Please fill content");
                    $li = "";$cont = ""; $createContent="";

                    $content = $_POST['content'];
                    $effect  = isset($_POST['effect']) && !empty($_POST['effect']) ? $_POST['effect'] : '';
                    
                    switch ($effect) 
                    {
                        case 'progress-bar-striped':
                            $effect = "progress-bar-striped";
                            break;
                        case '':
                            $effect = '';
                            break;
                        default:
                            $effect = "progress-bar-striped active";
                            break;
                    }

                    $parse  = explode("\n", $content);

                    if (!empty($parse))
                    {
                        foreach ($parse as $k => $val)
                        {
                            $val = ltrim($val);
                            if ( $val!='' ):
                                $val = stripslashes($val);
                                
                                preg_match("/context=\"[^'\"]*/", $val, $match0);
                               
                                if (!empty($match0[0]))
                                {
                                    $getContext = explode("=", $match0[0]);
                                    $getTitle = $getTitle ? $getTitle[1] : '';
                                    $getContext = str_replace("\"", "", $getContext);
                                }

                                preg_match("/percent=\"[^'\"]*/", $val, $match1);
                               
                                if (!empty($match1[0]))
                                {
                                    $getPercent = explode("=", $match1[0]);
                                    $getTitle = $getTitle ? $getTitle[1] : '';
                                    $getPercent = str_replace("\"", "", $getPercent);
                                }


                                $createContent .= '<div class="progress">';
                                  $createContent .= '<div class="progress-bar '.$getContext.' '.$effect.'" role="progressbar" aria-valuenow="'.$getPercent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$getPercent.'%">';
                                    $createContent .= '<span class="sr-only">'.$getPercent.'% Complete (success)</span>';
                                  $createContent .= '</div>';
                                $createContent .= '</div>';
                            endif;
                        }

                        echo $createContent;
                       
                    }
                break;

        endswitch;

        die();
    }

    public function awe_include_shortcode_into_footer()
    {
        include ('awe.shortcode.php');
        include ('fa-table-list.php');
    }

    /*
     * Register Button
     */
    public function awe_add_mce_button() 
    {
        // check if WYSIWYG is enabled
        
        if ( 'true' == get_user_option( 'rich_editing' ) ) 
        {
            add_filter( 'mce_external_plugins', array($this, 'awe_add_tinymce_plugin' ));
            add_filter( 'mce_buttons', array($this, 'awe_register_mce_button' ));
        }
       
    }

    

    // Declare script for new button
    public function awe_add_tinymce_plugin( $plugin_array ) 
    {
        // $plugin_array['spec']
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        $plugin_array['awe_mce_button'] = get_template_directory_uri() .'/assets_admin/js/awe.shortcodes'.$min.'.js';
        return $plugin_array;
       
    }

    // Register new button in the editor
    public function awe_register_mce_button( $buttons ) 
    {
      
        array_push( $buttons, 'awe_mce_button' );
        return $buttons;
     
    }

   

    public function awe_enqueue_scripts()
    {

        global $pagenow, $typenow;
        $screen = get_current_screen();

        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        if ( $pagenow != 'nav-menus.php' && $screen->base != 'toplevel_page_CouponDay-Option' ) :
            $url = get_template_directory_uri() .  '/assets_admin/';

            wp_dequeue_script('autosave');
            
            wp_enqueue_media();

            
            if ( $typenow != 'mega-slider' ) :
                wp_enqueue_script('jquery-ui-tabs');
            endif;

            wp_enqueue_script('jquery-ui-accordion');
            wp_enqueue_script('jquery-ui-dialog');
          
            wp_register_script('plugin_spectrum', $url . 'js/spectrum'.$min.'.js', array('jquery'), null, true);
            wp_enqueue_script('plugin_spectrum');


            wp_register_style('awe_ui_style', $url . 'css/jquery-ui-1.10.4.css', array(), '1.10.4');
            

            if ( $typenow != 'mega-slider' ) :
                wp_enqueue_style('awe_ui_style');
            endif;

            // Load file shortcode style
            wp_register_style('plugin_shortcode', $url . 'css/shortcode.css', array(), null);
            wp_enqueue_style('plugin_shortcode'); 
            wp_register_style('plugin_setting_shortcode', $url . 'css/setting-shortcode.css', array(), null);
            wp_register_style('plugin_setting_shortcode', $url . 'css/setting-shortcode.css', array(), null);
            wp_enqueue_style('plugin_setting_shortcode'); 



            wp_register_style('plugin_stylefa', $url . 'css/style.fa.css', array(), null);
            wp_enqueue_style('plugin_stylefa'); 
            
           

            wp_register_style('plugin_spectrum', $url . 'css/spectrum.css', array(), null);
            wp_enqueue_style('plugin_spectrum'); 

           //  wp_register_style('awe_plugin_smooth', $url . 'css/jquery-ui-1.10.4.css', array(), '1.10.4');
           // wp_enqueue_style('awe_plugin_smooth');

            wp_register_script('awe_add_video', $url . 'js/awe.add_video'.$min.'.js', array(), null, true);
            wp_enqueue_script('awe_add_video');

            
            wp_register_style('plugin_shortcodes', $url . 'css/shortcode.css', array(), null);
            wp_enqueue_style('plugin_shortcodes'); 

            wp_register_script('awe_blank', $url . 'js/jquery.blank.js', array('jquery'), null, false);
            wp_enqueue_script('awe_blank');



            wp_localize_script('awe_blank', 'AWE_SC_PATH', get_template_directory_uri() . '/shortcodes/');
        endif;   
    }



    public function shortcodes_settings()
    {
        include (  'shortcodes_tpl.php' );

    }
}