<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Manage the Images in the theme.
 *
 * @since 1.0.0
 */
class YIT_Image {

    /**
     * Active resize on fly
     *
     * @since 1.0.0
     */
    public $is_onfly_active = true;

    /**
     * All images sizes used in the theme
     *
     * @since 1.0.0
     */
    protected $_image_sizes = array();

    /**
     * Active the retina compatibility
     *
     * @since 1.0.0
     */
    public $is_retina_active = false;

    /**
     * Choose to use the class FastImage or not
     *
     * @since 1.0.0
     */
    public $use_fast_image = true;

    /**
     * All images sizes used in the theme
     *
     * @since 1.0.0
     */
    protected $_retinaFileName = "%s@2x%s";

    /**
     * Init of class
     *
     * @since 1.0.0
     */
    public function init() {
        // get setting from theme options
        //$this->is_onfly_active = yit_get_option( 'onfly_resize_active' );

        // deactive if w3tc
        if ( function_exists('w3_instance') ) {
            $config = w3_instance('W3_Config');
            if ( $config->get_boolean('cdn.enabled') ) {
                $this->is_onfly_active = false;
                return;
            }
        }

    	$this->is_retina_active = apply_filters( 'yit_is_retina_active', $this->is_retina_active );
		$this->use_fast_image = apply_filters( 'yit_use_fast_image', $this->use_fast_image );

		// retrocompatibility
		global $wp_version;
		if ( version_compare($wp_version, YIT_MINIMUM_WP_VERSION, '<') ) {
			$this->is_onfly_active = false;
		}

        if ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] == 'w3tc_cdn' ) {
            return;
        }

		// add image size, if above option is true
		add_action( 'after_setup_theme', array( $this, 'add_image_sizes' ) );

		// convert other add_image_sizes from other plugin, to the attribute of the class
		add_action( 'init', array( $this, 'add_other_image_sizes' ) );

        // use yit_image() inside the function get_the_post_thumbnail()
        //add_filter( 'post_thumbnail_html', array( $this, 'convert_get_the_post_thumbnail' ), 10, 5 );

        // use yit_image() inside the function get_the_post_thumbnail()
        add_filter( 'image_downsize', array( $this, 'convert_image_downsize' ), 10, 3 );
    }

    /**
     * Populate image sizes
     *
     * @since 1.0.0
     */
    public function add_image_size( $name, $width, $height, $crop = false ) {
        $this->_image_sizes[$name] = array( 'width' => absint( $width ), 'height' => absint( $height ), 'crop' => (bool) $crop );
    }

    /**
     * Convert other add_image_sizes from other plugin, to the attribute of the class
     *
     * @since 1.0.0
     */
    public function add_other_image_sizes() {
        if ( ! $this->is_onfly_active ) return;

        global $_wp_additional_image_sizes;

        if ( empty( $_wp_additional_image_sizes ) ) return;

        foreach ( $_wp_additional_image_sizes as $size => $the_ ) {
            if ( isset( $this->_image_sizes[$size] ) ) continue;

            $this->add_image_size( $size, $the_['width'], $the_['height'], $the_['crop'] );
            unset( $_wp_additional_image_sizes[$size] );
        }
    }

    /**
     * Add image sizes with the function add_image_size(), if $this->is_onfly_active is false
     *
     * @since 1.0.0
     */
    public function add_image_sizes() {
        if ( $this->is_onfly_active ) return;

        foreach ( $this->_image_sizes as $name => $the_ )
        { add_image_size( $name, $the_['width'], $the_['height'], $the_['crop'] ); }
    }

    /**
     * Get image
     *
     * @since 1.0.0
     */
    public function image( $args = array(), $echo = true ) {
        $defaults = array(
            'id' => null,   // the thumbnail ID
            'post_id' => null,   // the thumbnail ID
            'src' => '',
            'video' => '',
            'default' => '',
            'alt' => '',
            'class' => '',
            'title' => '',
            'size' => '',
            'width' => null,
            'height' => null,
            'crop' => false,
            'image_scan' => false,   // set if get the image from the first image of the post
            'output' => 'img',   // how print: 'a', with anchor; 'img' without anchor; 'url' only url; 'array' array width 'url', 'width' and 'height'
            'link' => '',      // the link of <a> tag. If empty, get from original image url
            'link_class' => '',      // the class of <a> tag
            'link_title' => '',      // the title of <a> tag. If empty, get it from "title" attribute.
            'getimagesize' => false
        );

        extract( wp_parse_args( $args, $defaults ) );

        /* SET VARS FOR OUTPUT */

        // from esplicit thumbnail ID
        if ( ! empty( $id ) ) {
            $image_id = $id;
            $image_url = wp_get_attachment_url( $id );

            // or from SRC
        } elseif ( ! empty( $post_id ) ) {
            $image_id = get_post_thumbnail_id( $post_id );
            $image_url = wp_get_attachment_url( $image_id );

            // or from SRC
        } elseif ( ! empty( $src ) ) {
            $image_id = null;
            $image_url = esc_url( $src );

            // or the post thumbnail
        } elseif ( has_post_thumbnail() ) {
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_url( $image_id );

            // get the image from a video, if defined
        } elseif ( $video ) {
            $image_id = null;
            $image_url = $this->get_video_image( $video );

            // get the first image of the post
        } elseif ( $image_scan ) {
            $image_id = null;
            $image_url = $this->catch_first_image( $post_id );

            // if is an attachment
        } elseif ( is_attachment() ) {
            global $post;
            $image_id = $post->ID;
            $image_url = wp_get_attachment_url( $image_id );

        } else {
            $image_id = null;
            $image_url = null;
        }

        // return null or print default one, if any image is defined
        if ( empty( $image_url ) && empty( $image_id ) ) {

            if ( ! empty( $default ) ) {
                $image_url = $default;
            } else {
                return;
            }

        }

        // remove temporary the https:// prefix if SSL.. it will be added at the end
        $image_url = is_ssl() ? str_replace( 'https:', 'http:', $image_url ) : $image_url;

        // save original image url for the <a> tag
        $full_image_url = $image_url = esc_url( $image_url );

        // detect if the img is external or not
        $uploads_baseurl = str_replace( 'https:', 'http:', YIT_WPCONTENT_URL );
        $site_url = str_replace( 'https:', 'http:', YIT_SITE_URL );
        $is_external = strpos( str_replace( 'https:', 'http:', $image_url ), $uploads_baseurl  ) === false || strpos( str_replace( 'https:', 'http:', $image_url ), $site_url ) === false ? true : false;

        // get the post attachment
        if ( ! empty( $image_id ) ) $attachment = get_post( $image_id );

        // get size from add_image_size
        if ( ! empty( $size ) ) {
            global $_wp_additional_image_sizes, $content_width;

            // if is array, put width and height indivudually
            if ( is_array($size) ) {
                $width = $size[0];
                $height = $size[1];

            } elseif ( isset( $this->_image_sizes[$size] ) ) {
                $width  = $this->_image_sizes[$size]['width'];
                $height = $this->_image_sizes[$size]['height'];
                $crop   = $this->_image_sizes[$size]['crop'];

            } elseif ( isset( $_wp_additional_image_sizes[$size] ) ) {
                $width  = $_wp_additional_image_sizes[$size]['width'];
                $height = $_wp_additional_image_sizes[$size]['height'];
                $crop   = $_wp_additional_image_sizes[$size]['crop'];

                // standard sizes of wordpress

                // thumbnail
            } elseif ( $size == 'thumb' || $size == 'thumbnail' ) {
                $width = intval(get_option('thumbnail_size_w'));
                $height = intval(get_option('thumbnail_size_h'));
                // last chance thumbnail size defaults
                if ( !$width && !$height ) {
                    $width = 128;
                    $height = 96;
                }
                $crop = (bool) get_option('thumbnail_crop');

                // medium
            } elseif ( $size == 'medium' ) {
                $width = intval(get_option('medium_size_w'));
                $height = intval(get_option('medium_size_h'));
                // if no width is set, default to the theme content width if available

                // large
            } elseif ( $size == 'large' ) {
                // We're inserting a large size image into the editor. If it's a really
                // big image we'll scale it down to fit reasonably within the editor
                // itself, and within the theme's content width if it's known. The user
                // can resize it in the editor if they wish.
                $width = intval(get_option('large_size_w'));
                $height = intval(get_option('large_size_h'));
                if ( intval($content_width) > 0 )
                    $width = min( intval($content_width), $width );
            }
        }

        // retina format
        if ( $this->is_retina_active && ! $is_external ) {
            // I check only if empty $image_url, because it's not possible now that both variables are empty.. the process would be stopped before
            if ( empty( $image_url ) && ! empty( $image_id ) ) {
                $image_url = wp_get_attachment_url( $image_id );
            }
            $this->vt_retina_resize( null, $image_url, $width, ! $crop ? 0 : $height, $crop );
        }

        // maybe need resize
        if ( ( !empty( $width ) || !empty( $height ) ) && ! $is_external ) {

            // vt_resize
            if ( $this->is_onfly_active ) {
                $vt_image  = $this->vt_resize( $image_id, $image_url, $width, ! $crop ? 0 : $height, $crop );
                $image_url = $vt_image['url'];
                $width     = $vt_image['width'];
                $height    = $vt_image['height'];

            }

            // no need resize
        } else {}


        /* BEGIN OUTPUT */

        $attr = array();

        // return null, if there isn't $image_url
        if ( empty( $image_url ) ) return;

        // reset https:// removed before
        $image_url = is_ssl() ? str_replace( 'http:', 'https:', $image_url ) : $image_url;

        // prevent different type of values for "echo" argument
        if ( in_array( $echo, array( 'yes', 'true' ) ) ) {
            $echo = true;
        } elseif ( in_array( $echo, array( 'no', 'false' ) ) ) {
            $echo = false;
        }

        // if return only url
        if ( $output == 'url' ) {
            if ( $echo ) echo $image_url;
            return $image_url;

            // if return array
        } elseif ( $output == 'array' ) {
            return array( $image_url, $width, $height );
        }

        if ( ! $this->is_onfly_active && ! empty( $image_id ) ) {
            $size = empty( $size ) ? $size = array( $width, $height ) : $size;
            if ( $output != 'a' ) $class .= ' yit-image';
            $html_image = wp_get_attachment_image( $image_id, $size, false, array(
                'class' => trim( "$class" . ( ! is_array( $size ) && ! empty( $size ) ? " attachment-$size" : '' ) ),
                'alt'   => empty(  $alt  ) ? trim(strip_tags( get_post_meta($image_id, '_wp_attachment_image_alt', true) )) : $alt,
                'title' => empty( $title ) ? $attachment->post_title : $title,
            ) );

        } else {
            $html_image = rtrim("<img");
            if ( $output != 'a' ) $class .= ' yit-image';
            if ( ! is_array( $size ) && ! empty( $size ) ) $class .= " attachment-$size";

            $attr = array(
                'src' => $image_url,
                'alt' => empty(  $alt  ) ? trim(strip_tags( get_post_meta($image_id, '_wp_attachment_image_alt', true) )) : $alt,
                'title' => empty( $title ) && isset( $attachment->post_title ) ? $attachment->post_title : $title,
                'class' => trim($class),
                'width' => $width,
                'height' => $height
            );

            foreach ( $attr as $name => $value ) {
                if ( ! empty( $value ) ) $html_image .= " $name=" . '"' . $value . '"';
            }
            $html_image .= ' />';

        }

        // return only image
        if ( $output == 'img' ) {
            if ( $echo ) echo $html_image;
            return $html_image;

            // return the image wrapper in <a> tag
        } elseif ( $output == 'a' ) {
            $html_link = rtrim("<a");
            $link_class .= ' yit-image';
            $attr = array(
                'href'  => empty( $link ) ? $full_image_url : $link,
                'title' => empty( $link_title ) ? $title : $link_title,
                'class' => trim($link_class)
            );



            foreach ( $attr as $name => $value ) {
                if ( ! empty( $value ) ) $html_link .= " $name=" . '"' . $value . '"';
            }
            $html_link .= '>' . $html_image . '</a>';

            if ( $echo ) echo $html_link;
            return $html_link;
        }
    }

    /**
     * Generate the retina format for the image
     */
    protected function vt_retina_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
        if ( ! $this->is_retina_active ) return;

        return $this->vt_resize( $attach_id, $img_url, $width, $height, $crop, true );
    }

    /*-----------------------------------------------------------------------------------*/
    /* vt_resize - Resize images dynamically using wp built in functions
    /*-----------------------------------------------------------------------------------*/
    /*
     * Resize images dynamically using wp built in functions
     * Victor Teixeira
     *
     * php 5.2+
     *
     * Exemplo de uso:
     *
     * < ?php
     * $thumb = get_post_thumbnail_id();
     * $image = vt_resize( $thumb, '', 140, 110, true );
     * ? >
     * <img src="< ?php echo $image[url]; ? >" width="<?php echo $image[width]; ? >" height="<?php echo $image[height]; ? >" />
     *
     * @param int $attach_id
     * @param string $img_url
     * @param int $width
     * @param int $height
     * @param bool $crop
     * @return array
     */
    protected function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false, $is_retina = false ) {

        // Cast $width and $height to integer
        $width = intval( $width );
        $height = intval( $height );

        // this is an attachment, so we have the ID
        if ( $attach_id ) {
            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
            $file_path = get_attached_file( $attach_id );
            // this is not an attachment, let's use the image url
        } else if ( $img_url ) {
            $uploads_dir = wp_upload_dir();
            if ( strpos( $img_url, YIT_WPCONTENT_URL ) === false ) {
                $file_path = parse_url( esc_url( $img_url ) );
                $file_path = $_SERVER[ 'DOCUMENT_ROOT' ] . $file_path[ 'path' ];
            } else {
                $file_path = str_replace( YIT_WPCONTENT_URL, $uploads_dir[ 'basedir' ], $img_url );
            }

            //$file_path = ltrim( $file_path['path'], '/' );
            //$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

            $orig_size = @getimagesize( $file_path );

            $image_src[0] = $img_url;
            $image_src[1] = $orig_size[0];
            $image_src[2] = $orig_size[1];
        }

        $file_info = pathinfo( $file_path );

        // check if file exists
        if ( !isset( $file_info['dirname'] ) && !isset( $file_info['filename'] ) && !isset( $file_info['extension'] )  )
            return;

        $base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
        if ( !file_exists($base_file) )
            return;

        $extension = '.'. $file_info['extension'];

        // the image path without the extension
        $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

        if ( $is_retina ) {
            $cropped_img_path = sprintf( $this->_retinaFileName, $no_ext_path . '-' . $width . 'x' . $height, $extension );
        } else {
            $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;
        }

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
            if ( $crop == false OR ! $height ) {
                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );

                if ( $is_retina ) {
                    $resized_img_path = sprintf( $this->_retinaFileName, $no_ext_path . '-' . $proportional_size[ 0 ] . 'x' . $proportional_size[ 1 ], $extension );
                } else {
                    $resized_img_path = $no_ext_path . '-' . $proportional_size[ 0 ] . 'x' . $proportional_size[ 1 ] . $extension;
                }

                // checking if the file already exists
                if ( file_exists( $resized_img_path ) ) {
                    $resized_img_url = str_replace( basename( $image_src[ 0 ] ), basename( $resized_img_path ), $image_src[ 0 ] );

                    $vt_image = array(
                        'url' => $resized_img_url,
                        'width' => $proportional_size[ 0 ],
                        'height' => $proportional_size[ 1 ]
                    );
                    return $vt_image;
                }

                $cropped_img_path = $resized_img_path;
            }

            // check if image width is smaller than set width
            $img_size = getimagesize( $file_path );
            if ( $img_size[ 0 ] <= $width ) $width = $img_size[ 0 ];

            // Check if GD Library installed
            if ( ! function_exists( 'imagecreatetruecolor' ) ) {
                echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
                return;
            }

            // make double the sizes if retina
            if ( $is_retina ) {
                $width *= 2;
                $height *= 2;
            }

            // no cache files - let's finally resize it
            if ( function_exists( 'wp_get_image_editor' ) ) {
                $image = wp_get_image_editor( $file_path );
                if ( ! is_wp_error( $image ) ) {
                    $image->resize( $width, $height, $crop );
                    $save_data = $image->save();
                    $new_img_path = ( ! is_wp_error( $save_data ) && isset( $save_data[ 'path' ] ) ) ? $save_data[ 'path' ] : $file_path;
                }
            } else {
                $new_img_path = image_resize( $file_path, $width, $height, $crop );
            }

            // raname if must be retina format
            if ( $is_retina && rename( $new_img_path, $cropped_img_path ) ) {
                $new_img_path = $cropped_img_path;
            }

            $new_img_size = @getimagesize( $new_img_path );
            $new_img = str_replace( basename( $image_src[ 0 ] ), basename( $new_img_path ), $image_src[ 0 ] );

            // resized output
            $vt_image = array(
                'url' => $new_img,
                'width' => $new_img_size[ 0 ],
                'height' => $new_img_size[ 1 ]
            );

            return $vt_image;
        }

        // default output - without resizing
        $vt_image = array(
            'url' => $image_src[ 0 ],
            'width' => $image_src[ 1 ],
            'height' => $image_src[ 2 ]
        );

        return $vt_image;
    }

    /**
     * Use yit_image() in the function get_the_post_thumbnail()
     */
    public function convert_get_the_post_thumbnail( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
        if ( empty( $html ) || ! $this->is_onfly_active ) return $html;

        return @$this->image( "id=$post_thumbnail_id&size=$size&class=$attr[class]&alt=$attr[alt]&title=$attr[title]", false );
    }

    /**
     * Use yit_image() in the function image_downsize()
     */
    public function convert_image_downsize( $out, $id, $size ) {
        if ( ! $this->is_onfly_active || $this->is_onfly_active && $size == 'full' ) return $out;

        $new_image = $this->image( array(
            'id' => $id,
            'size' => $size,
            'output' => 'array'
        ) );

        if ( empty( $new_image ) ) return $out;

        // is_intermediate
        $new_image[] = true;

        return $new_image;
    }

    /* Get thumbnail from Video Embed code */
    public function get_video_image($embed) {

        $video_thumb = '';

        // YouTube - get the video code if this is an embed code (old embed)
        preg_match( '/youtube\.com\/v\/([\w\-]+)/', $embed, $match);

        // YouTube - if old embed returned an empty ID, try capuring the ID from the new iframe embed
        if( !isset($match[1]) )
            preg_match( '/youtube\.com\/embed\/([\w\-]+)/', $embed, $match);

        // YouTube - if it is not an embed code, get the video code from the youtube URL
        if( !isset($match[1]) )
            preg_match( '/v\=(.+)&/',$embed ,$match);

        // YouTube - get the corresponding thumbnail images
        if( isset($match[1]) )
            $video_thumb = "http://img.youtube.com/vi/".$match[1]."/0.jpg";

        // return whichever thumbnail image you would like to retrieve
        return $video_thumb;
    }

    /* Get the first image of the post */
    public function catch_first_image( $post_id = false ) {
        global $post;

        if ( ! $post_id && ! isset( $post->ID ) ) return;

        if ( $post_id != false && $post_id == $post->ID ) {
            $content = $post->post_content;
        } else {
            $content = get_post_field( 'post_content', $post_id );
        }

        if ( is_wp_error( $content ) || empty( $content ) ) return;

        $first_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
        if ( ! isset( $matches[1][0] ) ) return;

        $first_img = $matches[1][0];

        return $first_img;
    }

    /**
     * Populate image sizes
     *
     * @since 1.0.0
     */
    public function get_size( $size ) {
        global $_wp_additional_image_sizes;

        if ( isset( $this->_image_sizes[$size] ) )
            return $this->_image_sizes[$size];
        else if ( isset( $_wp_additional_image_sizes[$size] ) )
            return $_wp_additional_image_sizes[$size];
        else
            return array();
    }

    /**
     * Populate image sizes
     *
     * @since 1.0.0
     */
    public function set_size( $size, $args = array() ) {
        global $_wp_additional_image_sizes;

        if ( isset( $this->_image_sizes[$size] ) )
            $this->_image_sizes[$size] = $args;

        if ( isset( $_wp_additional_image_sizes[$size] ) )
            $_wp_additional_image_sizes[$size] = $args;
    }

    /**
     * Retrieve image size both from local and remote
     *
     * @param $path
     * @return array|bool
     */
    public function getimagesize( $path ) {
        if( filter_var( $path, FILTER_VALIDATE_URL ) ) {
            $replaces = array(
                get_template_directory_uri() => get_template_directory(),
                YIT_WPCONTENT_URL => YIT_WPCONTENT_DIR,
                YIT_SITE_URL . '/' => ABSPATH
            );

            $path = str_replace( array_keys( $replaces ), $replaces, $path );
        }

        if( $this->use_fast_image && filter_var( $path, FILTER_VALIDATE_URL ) ) {
            return $this->getimagesize_remote( $path );
        } elseif( file_exists($path) ) {
            return getimagesize( $path );
        } else {
            return array();
        }
    }

    /**
     * Retrieve image size for remote files
     *
     * @param $image_url
     * @return bool
     */
    public function getimagesize_remote( $image_url ) {
        $handle = fopen( $image_url, 'rb' );
        $contents = '';

        if( $handle ) {
            while( ! feof( $handle ) ) {
                $contents .= fread( $handle, 8192 );
            }
        } else {
            return false;
        }

        fclose ( $handle );

        $image = imagecreatefromstring( $contents );

        if( !$image )
        { return false; }

        $getimagesize = array(
            imagesx( $image ), //width
            imagesy( $image ), //height
            '',                //mimetype
        );

        //HTML attrs
        $getimagesize[] = 'width="' . $getimagesize[0] . '" height="' . $getimagesize[1] . '"';

        imagedestroy( $image );

        return $getimagesize;
    }

}

/**
 * YIT Image function, used to print the html of the image
 *
 * @since 1.0.0
 */
function yit_image( $args = array(), $echo = true ) {
    return yit_get_model( 'image' )->image( $args, $echo );
}

/**
 * Add image sizes with the function add_image_size(), if $this->is_onfly_active is false
 *
 * @since 1.0.0
 */
function yit_add_image_size( $name, $width, $height, $crop = false ) {
    yit_get_model( 'image' )->add_image_size( $name, $width, $height, $crop );
}

/**
 * Retrieve image size
 *
 * @since 1.0.0
 */
function yit_getimagesize( $path ) {
    return yit_get_model( 'image' )->getimagesize( $path );
}