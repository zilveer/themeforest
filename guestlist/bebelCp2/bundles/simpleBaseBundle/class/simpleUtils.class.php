<?php

class simpleUtils
{
  
  /**
   * a list of all the supported currencies (we do only support express
   * checkout, that is why we only support these.
   * 
   * @see https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_currency_codes
   * @var currencies 
   * 
   * @return array
   */
  public static function getCurrencies()
  {
    return  array(
		'AUD'	=> 'Australian Dollar',
		'CAD'	=> 'Canadian Dollar',
		'CZK'	=> 'Czech Koruna',
		'DKK'	=> 'Danish Krone',
		'EUR'	=> 'Euro',
		'HUF'	=> 'Hungarian Forint',
		'JPY'	=> 'Japanese Yen',
		'NOK'	=> 'Norwegian Krone',
		'NZD'	=> 'New Zealand Dollar',
		'PLN'	=> 'Polish Zloty',
		'GBP'	=> 'Pound Sterling',
		'SGD'	=> 'Singapore Dollar',
		'SEK'	=> 'Swedish Krona',
		'CHF'	=> 'Swiss Franc',
		'USD'	=> 'U.S. Dollar'
	);
  }
  
  public static function renameCurrency($currencyShort)
  {
      $currencies = self::getCurrencies();
      
      
      if(isset($currencies[strtoupper($currencyShort)]))
      {
          return $currencies[strtoupper($currencyShort)];
      }
      return false;
  }

  /**
   * Returns a list of all existing icons.
   * TODO: enhance to automatic scan of folders
   *
   * @return array
   */
  public static function getIconList()
  {
    return array(
      'cloud' => 'Cloud',
      'globe' => 'Globe',
      'heart' => 'Heart',
      'lock' => 'Lock',
      'mail' => 'Mail',
      'movie' => 'Movie',
      'pen' => 'Pen',
      'picture' => 'Picture',
      'screen' => 'Screen',
      'star' => 'Star',
      'user' => 'User',
      'weather' => 'Weather',
      'pen_crossed' => 'Crossed Pen'
    );
  }
  
  /**
   * Returns a list of all existing icons.
   * TODO: enhance to automatic scan of folders
   *
   * @return array
   */
  public static function getDualContentIconList()
  {
    return array(
      'gear' => 'Gear',
      'globe' => 'Globe',
      'heart' => 'Heart',
      'home' => 'Home',
      'lock' => 'Lock',
      'magnifier' => 'Magnifier',
      'money' => 'Money',
      'people' => 'People',
      'photo' => 'Photo',
      'recycle' => 'Recycle',
      'save' => 'Save',
      'smile' => 'Smile',
      'success' => 'Success',
      'trash' => 'Trash',
      'valet' => 'Valet'
    );
  }
  
  /**
   * Returns a list of all existing social icons.
   * TODO: enhance to automatic scan of folders
   *
   * @return array
   */
  public function getSocialIconList()
  {
    return array(
        'digg', 'facebook', 'flickr', 'linkedin', 'rss', 'stumbleupon', 'tumblr', 'twitter', 'vimeo', 'youtube'
    );
  }  

    /**
   * Gets a list of terms for the quicksand filter method
   *
   * @param string $taxonomy
   * @return string
   */
  public static function getQuicksandTermsList($taxonomy)
  {

    $settings = BebelSingleton::getInstance('BebelSettings');
    $terms = get_terms($taxonomy);

    $li = '<li><a href="#" class="quicksand_filter" data-value="all">'._x('All', $settings->getPrefix()).'</a></li>';
    foreach($terms as $term) {
      $li .= '<li><a href="#" class="quicksand_filter" data-value="'.$term->slug.'">'.$term->name.'</a></li>';
    }
    return $li;
  }
  
  
  public static function getStartpageEvent()
  {
      $args = array( 'post_type' => $bSettings->getPrefix().'_event', 'posts_per_page' => 999 );
      $loop = new WP_Query( $args );
  }

  /**
   * Returns a string with a list of all slider images of a given post.
   *
   * @param integer $post_id
   * @return string
   */
  public static function getAllSliderImages($post_id, $size = 'non-full')
  {
 
    
    $image_list = array();
    $images = '';
    $style = '';

    // first step: get post image

    if(has_post_thumbnail($post_id))
    {
      $image_list[] = get_post_thumbnail_id($post_id);
    }    

    for($i=0;$i<4;$i++)
    {
      $image = BebelUtils::getCustomMeta('slider_image_'.$i, false, $post_id);

      if($image)
      {
        $image = BebelUtils::getImageIdByUrl($image, $post_id);
        $image_list[] = $image;
      }
    }

    // no image found, return false
    if(count($image_list) == 0)
    {
      return false;
    }


    // kick double keys, for instance if the post thumbnail was also used as a slider image
    $image_list = array_unique($image_list);
    $i = 0;
    foreach($image_list as $image)
    {
      
      $link = wp_get_attachment_image_src($image, 'full');
      if($i == 0)
      {
          $images .= "{image : '".$link[0]."'}";
      }else {
          $images .= ",\n{image : '".$link[0]."'}";
      }
      $i++;
      
    }

    return $images;
    
  }

  public static function displayComments($comment, $args, $depth)
  {

    $bSettings = BebelSingleton::getInstance('BebelSettings');
    $GLOBALS['comment'] = $comment;

    include(TEMPLATEPATH.'/templates/comments/comment.php');

  }

  public static function getBaseTemplateRaw($string)
  {

    $template = basename($string);
    $template = explode('.', $template);
    return $template[0];

  }

  public static function getSearchForm()
  {
    $bSettings = BebelSingleton::getInstance('BebelSettings');
    include_once(TEMPLATEPATH.'/templates/wordpress/searchform.php');
  }


  /**
   * Courtesy to kriesi: http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
   * enhanced by bebel
   *
   * @param int $pages
   * @param int $paged
   * @param int $display_range
   * @param string $css_class
   * @param string $active_class
   * @return string
   */
  public static function getNumberedPagination($pages, $paged, $display_range, $css_class, $active_class) {

    $show_items = $display_range * 2 + 1;


    if(empty($paged)) $paged = 1;
    //else $paged = $paged -1;
    if(!$pages) $pages = 1;

    // more than one page required, right?
    if($pages > 1) {
      $li = '';
      if($paged > 2 && ($paged == $display_range + 1) && $show_items < $pages) {
        $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';
      }
      if($paged > 1 && $show_items < $pages) {
        $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;</a></li>';
      }

      // loop all the pages
      for($i = 1; $i<=$pages;$i++) {
        // if page is not next arrow and if page is not last arrow
        if(!($i >= $paged+$display_range+1 || $i <= $paged-$display_range-1) || $pages <= $show_items ) {
          if($i == $paged) {
            $li .= '<li class="'.$active_class.'">'.$i.'</li>';
          }else {
            $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
          }
        }
      }

      if($paged < $pages && $show_items < $pages) {
        $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link($paged + 1).'">&rsaquo;</a></li>';
      }
      if($paged < $pages-1 && $paged + $display_range-1 < $pages && $show_items < $pages) {
        $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
      }

      return $li;
    }
  }

  /**
   * A very simple method to get the mainpage's sidebar top margin.
   * It changes everytime a setting is disabled or enabled.
   *
   * @return string
   */
  public static function getMainpageSidebarTopMargin()
  {
    $bSettings = BebelSingleton::getInstance('BebelSettings');
    
    if($bSettings->get('mainpage_slider_enable') == 'on') {
      $sidebar_top = 30;
    }else {
      $sidebar_top = 20;
    }
    if($bSettings->get('twitter_enable') == 'on')
    {
      $sidebar_top = $sidebar_top + 70;
    }

    $sidebar_top = '-'.$sidebar_top.'px';

    return $sidebar_top;
  }

  public static function renderCssFromPost($post_id)
  {
    $return = '';
    $css = BebelUtils::getCustomMeta('css', false, $post_id);
    if($css)
    {
      $return = '<style type="text/css">';
      $return .= $css;
      $return .= '</style>';
    }

    return $return;
  }
  
  /*
   * Resize images dynamically using wp built in functions
   * Victor Teixeira
   *
   * php 5.2+
   *
   * Exemplo de uso:
   * 
   * <?php 
   * $thumb = get_post_thumbnail_id(); 
   * $image = vt_resize( $thumb, '', 140, 110, true );
   * ?>
   * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
   *
   * @param int $attach_id
   * @param string $img_url
   * @param int $width
   * @param int $height
   * @param bool $crop
   * @return array
   */
   public static  function vtResizeImageDynamically( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

        // this is an attachment, so we have the ID
        if ( $attach_id ) {

            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
            $file_path = get_attached_file( $attach_id );

        // this is not an attachment, let's use the image url
        } else if ( $img_url ) {

            $file_path = parse_url( $img_url );
            $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

            // Look for Multisite Path
            if(file_exists($file_path) === false){
                global $blog_id;
                $file_path = parse_url( $img_url );
                if (preg_match("/files/", $file_path['path'])) {
                    $path = explode('/',$file_path['path']);
                    foreach($path as $k=>$v){
                        if($v == 'files'){
                            $path[$k-1] = 'wp-content/blogs.dir/'.$blog_id;
                        }
                    }
                    $path = implode('/',$path);
                }
                $file_path = $_SERVER['DOCUMENT_ROOT'].$path;
            }
            //$file_path = ltrim( $file_path['path'], '/' );
            //$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

            $orig_size = getimagesize( $file_path );

            $image_src[0] = $img_url;
            $image_src[1] = $orig_size[0];
            $image_src[2] = $orig_size[1];
        }

        $file_info = pathinfo( $file_path );

        // check if file exists
        $base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
        if ( !file_exists($base_file) )
         return;

        $extension = '.'. $file_info['extension'];

        // the image path without the extension
        $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

        $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

        // checking if the file size is larger than the target size
        // if it is smaller or the same size, stop right here and return
        if ( $image_src[1] > $width ) {

            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
            if ( file_exists( $cropped_img_path ) ) {

                $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

                $vt_image = array (
                    'url' => $cropped_img_url,
                    'width' => $width,
                    'height' => $height
                );

                return $vt_image;
            }

            // $crop = false or no height set
            if ( $crop == false OR !$height ) {

                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
                $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;

                // checking if the file already exists
                if ( file_exists( $resized_img_path ) ) {

                    $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

                    $vt_image = array (
                        'url' => $resized_img_url,
                        'width' => $proportional_size[0],
                        'height' => $proportional_size[1]
                    );

                    return $vt_image;
                }
            }

            // check if image width is smaller than set width
            $img_size = getimagesize( $file_path );
            if ( $img_size[0] <= $width ) $width = $img_size[0];

            // Check if GD Library installed
            if (!function_exists ('imagecreatetruecolor')) {
                echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
                return;
            }

            // no cache files - let's finally resize it
            $new_img_path = image_resize( $file_path, $width, $height, $crop );			
            $new_img_size = getimagesize( $new_img_path );
            $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

            // resized output
            $vt_image = array (
                'url' => $new_img,
                'width' => $new_img_size[0],
                'height' => $new_img_size[1]
            );

            return $vt_image;
        }

        // default output - without resizing
        $vt_image = array (
            'url' => $image_src[0],
            'width' => $width,
            'height' => $height
        );

        return $vt_image;
    }
    
    
    public static function getCommentsLink($id, $bSettings)
    {
        if(comments_open())
        {
           $comments_count = get_comments_number($id);

           switch($comments_count)
           {
               case 0:
                   $comments_link = __('No Comments', $bSettings->getPrefix());
                   break;
               case 1:
                   $comments_link = __('One Comment', $bSettings->getPrefix());
                   break;
               default:
                   $comments_link = __(sprintf('%d Comments', $comments_count), $bSettings->getPrefix());
                   break;
           }
        }else {
            $comments_link = __('Comments Closed', $bSettings->getPrefix());
        }
        
        return $comments_link;
    }

}