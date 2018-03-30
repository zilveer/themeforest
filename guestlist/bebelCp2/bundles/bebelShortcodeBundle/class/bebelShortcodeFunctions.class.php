<?php


class bebelShortcodeFunctions
{
  protected $buttons = array();
  
  public function  __construct()
  {
    add_shortcode('clear', array($this, 'clear'));
    add_shortcode('divider', array($this, 'divider'));
    add_shortcode('dropcap', array($this,'dropcap'));
    add_shortcode('dropcap2', array($this, 'dropcap2'));
    add_shortcode('toggle', array($this, 'toggle'));
    add_shortcode('error', array($this, 'error'));
    add_shortcode('warning', array($this, 'warning'));
    add_shortcode('info', array($this, 'info'));
    add_shortcode('download', array($this, 'download'));
    add_shortcode('one_third', array($this, 'one_third'));
    add_shortcode('two_third', array($this, 'two_third'));
    add_shortcode('one_fourth', array($this, 'one_fourth'));
    add_shortcode('three_fourth', array($this, 'three_fourth'));
    add_shortcode('half_left', array($this, 'half_left'));
    add_shortcode('half_right', array($this, 'half_right'));
    /* these have only buttons in the wysiwyg editor */
    add_shortcode('video', array($this, 'bebel_video_advanced'));
    add_shortcode('gallerie', array($this, 'gallery_advanced'));
    add_shortcode('list', array($this, 'bebel_lists_advanced'));
    add_shortcode('button', array($this, 'bebel_buttons_advanced'));
    add_shortcode('audioplay', array($this, 'getAudio'));

    $this->buttons['clear'] = array('Clear Floating', 'clear');
    $this->buttons['divider'] = array('Content Divider', 'divider');
    $this->buttons['dropcap'] = array('Dropcap', 'dropcap');
    $this->buttons['dropcap2'] = array('Dropcap Style 2', 'dropcap2');
    $this->buttons['toggle'] = array('Toggle Shortcode', 'toggle');
    $this->buttons['error'] = array('Error Box', 'error');
    $this->buttons['warning'] = array('Warning box', 'warning');
    $this->buttons['info'] = array('Info Box', 'info');
    $this->buttons['download'] = array('Download', 'download');
    $this->buttons['one_third'] = array('One Third', 'one_third');
    $this->buttons['two_third'] = array('Two Third', 'two_third');
    $this->buttons['one_fourth'] = array('One Fourth', 'one_fourth');
    $this->buttons['three_fourth'] = array('Three Fourth', 'three_fourth');
    $this->buttons['half_left'] = array('Half Left', 'half_left');
    $this->buttons['half_right'] = array('Half Right', 'half_right');
    
  }

  public function getButtons()
  {
    return $this->buttons;
  }


  public function clear($atts, $content = null)
  {
    return '<br class="clear" />';
  }


  public function divider($atts, $content = null)
  {

      return '<p class="shortcode-divider"><a href="#top">top</a></p>';
  }



  public function dropcap($atts, $content = null)
  {
    return do_shortcode('<span class="shortcode-dropcap-0">'.$content.'</span>');
  }



  public function dropcap2($atts, $content = null)
  {
    return do_shortcode('<span class="shortcode-dropcap-2">'.$content.'</span>');
  }




  public function toggle($atts, $content = null)
  {
    extract(shortcode_atts(array(
      "show" => ''
    ), $atts));

    /* generate unique id */
    $id = uniqid();

    $javascript =  '<script type="text/javascript">
                      jQuery(document).ready(function() {
                        jQuery(".'.$id.'").click(function() {
                          if(jQuery(".'.$id.'").hasClass("shortcode-toggle_close")) {
                            jQuery(".'.$id.'").removeClass("shortcode-toggle_close");
                            jQuery(".'.$id.'").addClass("shortcode-toggle");
                          }else if(jQuery(".'.$id.'").hasClass("shortcode-toggle")) {
                            jQuery(".'.$id.'").removeClass("shortcode-toggle");
                            jQuery(".'.$id.'").addClass("shortcode-toggle_close");
                          }
                          jQuery(".'.$id.'_toggle").stop(true, true).slideToggle(400);
                          return false;
                        });
                      });
                    </script>';

    $show_style = ($show == "show") ? 'style="display: block;"' : 'style="display: none;"';
    $toggle_class = ($show == "show") ? ' shortcode-toggle_close' : ' shortcode-toggle';
    return do_shortcode($javascript.'<p class="shortcode-divider shortcode-toggle-p">
                                         <a href="#" class="'.$id.$toggle_class.'"></a>
                                     </p>
                                     <div class="'.$id.'_toggle shortcode-toggle-content" '.$show_style.'>
                                         ' . $content . '
                                     <br class="clear" /></div>
                                     ');
  }



  public function error($atts, $content = null)
  {
    return do_shortcode('<div class="shortcode-error">'.$content.'</div>');
  }



  public function warning($atts, $content = null)
  {
    return do_shortcode('<div class="shortcode-warning">'.$content.'</div>');
  }



  public function info($atts, $content = null)
  {
    return do_shortcode('<div class="shortcode-info">'.$content.'</div>');
  }



  public function download($atts, $content = null)
  {
    extract(shortcode_atts(array(
      "link" => '',
      "smalltext" => ''
    ), $atts));
    return '<div class="downloadBox"><a  href="'.$link.'">'.$content.'</a><br /><span>'.$smalltext.'</a></div>';
  }



  public function one_third($atts, $content = null)
  {
    extract(shortcode_atts(array(
      "align" => ''
    ), $atts));
    $align = $align == '' ? '' : ' justify';
    return do_shortcode('<div class="shortcode-one-third'.$align.'">'.$content.'</div>');
  }



  public function two_third($atts, $content = null)
  {
    extract(shortcode_atts(array(
      "align" => ''
    ), $atts));
    $align = $align == '' ? '' : ' justify';
    return do_shortcode('<div class="shortcode-two-third'.$align.'">'.$content.'</div>');
  }



  public function one_fourth($atts, $content = null)
  {
    extract(shortcode_atts(array(
      "align" => ''
    ), $atts));
    $align = $align == '' ? '' : ' justify';
    return do_shortcode('<div class="shortcode-one-fourth'.$align.'">'.$content.'</div>');
  }



  public function three_fourth($atts, $content = null)
  {
    extract(shortcode_atts(array(
      "align" => ''
    ), $atts));
    $align = $align == '' ? '' : ' justify';
    return do_shortcode('<div class="shortcode-three-fourth'.$align.'">'.$content.'</div>');
  }



  public function half_left($atts, $content = null)
  {
    extract(shortcode_atts(array(
      "align" => ''
    ), $atts));
    $align = $align == '' ? '' : ' justify';
    return do_shortcode('<div class="shortcode-half-left'.$align.'">'.$content.'</div>');
  }



  public function half_right($atts, $content = null)
  {
    extract(shortcode_atts(array(
      "align" => ''
    ), $atts));
    $align = $align == '' ? '' : ' justify';
    return do_shortcode('<div class="shortcode-half-right'.$align.'">'.$content.'</div><br class="clear" />');
  }


  public function gallery_advanced($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'style' => '',
    ), $atts));

    // get gallery
    $gallery = new WP_Query('&pid='.$content);
    if($gallery->have_posts()) {

      $random    = uniqid();

      // check what style it is
      switch($style) {

        case 'image-list':

          $attr = array(
              'size' => 'mini-square',
              'id'   => $random,
          );
          $images = bebelGalleryBundleUtils::getImagesFromPostIdAsLi($content, $attr); // now its an ul.

          $return  = '<div class="bebel-shortcode-gallery-image-list-container">';
          if(!empty($title)) {
            $return .= '<h2>'.$title.'</h2>';
          }
          $return .= '<ul class="bebel_widget_gallery_sidebar glow">';
          $return .=    $images;
          $return .= '</ul><br class="clear" />';
          $return .= '</div><br class="clear" />';

          break;

        case 'bebel-gallery':

          $raw_images   = BebelUtils::getAttachmentsByPostId($content);
          $count_images  = count($raw_images);

          $attr = array(
              'size' => 'big-square',
              'id'   => $random,
          );

          $images_big = bebelGalleryBundleUtils::getImagesFromPostIdAsLi($content, $attr, $raw_images, true); // now its an ul.

          $attr = array(
              'size' => 'mini-square',
              'id'   => $random,
          );
          $images_ul = bebelGalleryBundleUtils::getImagesForGalleryShortcodeNavigation($content, $attr, $raw_images); // now its an ul.

          $return  = '<script type="text/javascript">';
          $return .= '<!--
                        jQuery(document).ready(function() {
                            jQuery("#'.$random.'").btabs({debug: false, autoSlide: true, effect: "fade", count: '.$count_images.',linkActiveStateClass: "bebel-shortcode-gallery-bebel-nav-active", tabNavigationClass : "bebel-shortcode-gallery-bebel-nav"});
                        });
                      -->';
          $return .= '</script>';
          $return .= '<div class="bebel-shortcode-gallery-bebel-container" id="'.$random.'">';
            if(!empty($title)) {
              $return .= '<h2>'.$title.'</h2>';
            }

            
            $return .= '<ul class="bebel-shortcode-gallery-bebel">';
            $return .= $images_big;
            $return .= '</ul>';
            $return .= '<ul class="bebel-shortcode-gallery-bebel-nav glow">';
            $return .= $images_ul;
            $return .= '</ul><br class="clear" />';
          $return .= '</div><br class="clear" />';
          break;
      }

      return $return;
    }


  }

  public function bebel_video_advanced($atts, $content = null) {
    global $sidebar_position;


    extract(shortcode_atts(array(
        'title' => '',
        'style' => 'small_left',
        'hosted' => false
    ), $atts));
    if(empty($content)) {
      return false;
    }
    // get video sizes
    $sizes = bebel_get_video_sizes_by_style($style);
    $post_id = get_the_ID();
    $random_id = uniqid();

    // check if its fullsize.
    if($sizes['template'] == 'full') {
      if($sidebar_position == 'none') {
        $sizes['width'] = 1000;
        $sizes['height'] = 625;
      }else{
        $sizes['width'] = 574;
        $sizes['height'] = 359;
      }
    }

    // if its a self hosted video, prepare player and stuff
    if($hosted) {
      $video  = '<a href="'.$content.'" id="player'.$random_id.'" style="display:block;width:'.$sizes['width'].'px; height:'.$sizes['height'].'px"></a>';
      $video .= '<script language="JavaScript">flowplayer("player'.$random_id.'", "'.get_bloginfo('stylesheet_directory').'/js/flowplayer/flowplayer-3.2.5.swf", { clip: { autoPlay: false, autoBuffering: true }});</script>';
      if(!empty($title)) {
        $title = '    <div class="bebel-shortcode-video-container video-title-hosted">'.$title.'</div>';
      }
    }else {


      // first of all: get the video embed code. thanks wordpress !
      $embed = new WP_Embed();
      $video = $embed->run_shortcode('[embed]'.$content.'[/embed]');
      if(!empty($video)) {
        if(is_array($sizes)) {
          $video = preg_replace('/width=\"(\d)*\"/', 'width="'.$sizes['width'].'"', $video);
          $video = preg_replace('/height=\"(\d)*\"/', 'height="'.$sizes['height'].'"', $video);
          if(!empty($title)) {
            $title = '    <div class="bebel-shortcode-video-container video-title"><a href="'.$content.'">'.$title.'</a></div>';
          }
        }
      }
    }

    if(empty($video)) {
      return false;
    }

    // done. next step: get template to show.
    $return  = '<div class="bebel-shortcode-video-container-'.$sizes['align'].'"><div class="bebel-shortcode-video-container">
                    <div class="'.$sizes['template'].'">';
    $return .=        $video;
    $return .=        $title;
    $return .= '    </div>';
    $return .= '</div></div>';

    return $return;



  }


  public function bebel_lists_advanced($atts, $content = null) {
    global $sidebar_position;


    extract(shortcode_atts(array(
        'style' => 'blue_arrow'
    ), $atts));

    $return  = '<div class="shortcode-list shortcode-list-'.$style.'">';
    $return .= $content;
    $return .= '</div>';

    return $return;



  }


  public function bebel_buttons_advanced($atts, $content = null) {
    global $sidebar_position;
    extract(shortcode_atts(array(
        'style' => 'black',
        'link'  => '#'
    ), $atts));

    if(preg_match('/page\:(\d+)/i', $link, $id) || preg_match('/post\:(\d+)/i', $link, $id)) {
      // get link by page id
      $link = get_permalink($id[1]);
    }

    $return  = '<a href="'.$link.'" class="shortcode-button shortcode-button-'.$style.'">';
    $return .= $content;
    $return .= '</a>';

    return $return;
  }


  public static function getAudio($atts, $content = null) {
    
    $bSettings = BebelSingleton::getInstance('BebelSettings');

    extract(shortcode_atts(array(
        'style' => 'small_left',
        'title' => ''
    ), $atts));
    if(empty($content)) return false;
    $player_id = uniqid();

    if(!empty($title)) {
      $height = 50;
    }else {
      $height = 25;
    }

    $audio_link = '<div class="bebel-shortcode-audio-player" style="height:'.$height.'">
                    <div id="player'.$player_id.'" style="display:block;width:400px;height:25px;"></div>';
    if(!empty($title)) {
      $audio_link .= '<p class="audio-title">'._x('You are listening to:', $bSettings->getPrefix()).' '.html_entity_decode(str_replace("'", '"',$title)).'</p>';
    }
    $audio_link .= '</div>';
    $audio_link .= '<script type="text/javascript">
                      $f("player'.$player_id.'", "'.get_bloginfo('stylesheet_directory').'/bebelCp2/bundles/bebelPortfolioBundle/assets/js/flowplayer/flowplayer-3.2.5.swf", {
                        clip: {
                           autoPlay: false,
                           url: "'.$content.'"
                        },
                        plugins: {
                          controls: {
                            url: "'.get_bloginfo('stylesheet_directory').'/bebelCp2/bundles/bebelPortfolioBundle/assets/js/flowplayer/flowplayer.controls-3.2.3.swf",
                            all: false,
                            play: true,
                            scrubber: true,
                            volume: true,
                            mute: true,
                            time: true,
                            autoHide: false
                          },
                          audio: {
                            url: "'.get_bloginfo('stylesheet_directory').'/bebelCp2/bundles/bebelPortfolioBundle/assets/js/flowplayer/flowplayer.audio-3.2.1.swf"
                          }
                        }

                      });
                    </script>';

    return $audio_link;
  }

}
