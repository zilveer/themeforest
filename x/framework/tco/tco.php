<?php

// =============================================================================
// TCO.PHP
// -----------------------------------------------------------------------------
// Code commonly used across Themeco products.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Class Definition
//   02. Version
//   03. Boilerplate
//   04. Script & Style Registration
//   06. Helpers
// =============================================================================

// Class Definition
// =============================================================================

if ( ! class_exists( 'TCO_1_0' ) ) :

  class TCO_1_0 {

    // Version
    // ===========================================================================

    const VERSION = '1.0';


    // Boilerplate
    // ===========================================================================

    private static $instance;
    protected $path = '';
    protected $url = '';

    public function __construct( $file ) {
      $this->path = trailingslashit( dirname( $file ) );
      add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), -999 );
      require_once( $this->path( 'class-tco-updates.php' ) );
      require_once( $this->path( 'class-tco-validator.php' ) );
      TCO_Updates::$tco = $this;
      TCO_Validator::$tco = $this;
    }

    public function init( $options ) {
      if ( isset( $options['url'] ) ) {
        $this->url = trailingslashit( $options['url'] );
      }
    }

    public static function instance() {
      if ( ! isset( self::$instance ) ) {
        self::$instance = new self( __FILE__ );
      }
      return self::$instance;
    }

    // Script & Style Registration
    // ===========================================================================

    public function admin_enqueue_scripts() {

      //
      // Register Admin Styles
      //

      wp_register_style( $this->handle( 'admin-css' ), $this->url( 'css/dist/tco.css' ), array(), self::VERSION );


      //
      // Register Admin Scripts
      //

      $handle = $this->handle( 'admin-js' );

      wp_register_script( $handle, $this->url( 'js/dist/admin/tco.js' ), array( 'jquery', 'wp-util' ), self::VERSION, true );

      // Localization will be handled by products, but this will setup fallbacks.
      wp_localize_script( $handle, 'tcoCommon', array(
        'debug' => ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ),
        'logo'  => $this->get_themeco_logo(),
        '_tco_nonce' => wp_create_nonce( 'tco-common' ),
        'strings' => apply_filters( 'tco_localize_' . $handle, array(
            'details' => 'Details',
            'back'    => 'Back',
            'yep'     => 'Yep',
            'nope'    => 'Nope'
          ) )
      ) );

    }


    // Style Registration
    // ===========================================================================

    public function admin_styles() {

    }

    // Helpers
    // ===========================================================================

    //
    // Get a versioned handle that can be used to specify dependencies.
    //

    public function handle( $handle = 'admin-js' ) {
      return 'tco-common-' . $handle . '-' . str_replace( '.', '-', self::VERSION );
    }


    //
    // Get the path to the /tco-common/ folder (optionally add to the path).
    //

    public function path( $more = '' ) {
      return $this->path . $more;
    }


    //
    // Get the URL to the /tco-common/ folder (optionally add to the URL).
    //

    public function url( $more = '' ) {
      return $this->url . $more;
    }


    //
    // Get the update module
    //

    public function updates() {
    	return TCO_Updates::instance();
    }

    //
    // Get current admin color scheme.
    //

    function get_current_admin_color_scheme( $type = 'colors' ) {

      GLOBAL $_wp_admin_css_colors;

      $current_color_scheme = get_user_option( 'admin_color' );
      $admin_colors         = $_wp_admin_css_colors;
      $user_colors          = (array) $admin_colors[$current_color_scheme];

      return ( $type == 'icons' ) ? $user_colors['icon_colors'] : $user_colors['colors'];

    }


    //
    // Admin image.
    //

    public function get_admin_image( $image ) {

      $image = $this->url( 'img/admin/' . $image );

      return $image;

    }

    public function admin_image( $image ) {
      echo $this->get_admin_image( $image );
    }


    //
    // Admin icon.
    //

    public function get_admin_icon( $icon, $class = '', $style = '' ) {

      $href   = $this->url( 'img/admin/icons.svg#' . $icon );
      $class  = ( $class == '' ) ? '' : ' class="' . $class . '"';
      $style  = ( $style == '' ) ? '' : ' style="' . $style . '"';
      $output = '<svg' . $class . $style . '><use xlink:href="' . $href . '"></use></svg>';

      return $output;

    }

    public function admin_icon( $icon, $class = '', $style = '' ) {
      echo $this->get_admin_icon( $icon, $class, $style );
    }


    //
    // Themeco logo.
    //

    public function get_themeco_logo( $class = '', $style = '' ) {

      $class  = ( $class == '' ) ? '' : ' class="' . $class . '"';
      $style  = ( $style == '' ) ? '' : ' style="' . $style . '"';

      $logo = '<svg' . $class . $style . ' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 4320 504" style="enable-background:new 0 0 4320 504;" xml:space="preserve">
                 <polygon points="198,0 0,0 0,108 198,108 198,504 306,504 306,108 504,108 504,0 306,0     "/>
                 <polygon points="1008,198 720,198 720,0 612,0 612,198 612,306 612,504 720,504 720,306 1008,306 1008,504 1116,504 1116,306 1116,198 1116,0 1008,0    "/>
                 <rect x="1224" width="504" height="108"/>
                 <rect x="1224" y="198" width="504" height="108"/>
                 <rect x="1224" y="396" width="504" height="108"/>
                 <polygon points="2214,0 2106,0 1944,0 1836,0 1836,108 1836,504 1944,504 1944,108 2106,108 2106,504 2214,504 2214,108 2376,108 2376,504 2484,504 2484,108 2484,0 2376,0    "/>
                 <rect x="2592" width="504" height="108"/>
                 <rect x="2592" y="198" width="504" height="108"/>
                 <rect x="2592" y="396" width="288" height="108"/>
                 <rect x="2988" y="396" width="108" height="108"/>
                 <polygon points="3204,0 3204,108 3204,396 3204,504 3312,504 3708,504 3708,396 3312,396 3312,108 3708,108 3708,0 3312,0     "/>
                 <path d="M4212,0h-288h-108v108v288v108h108h288h108V396V108V0H4212z M4212,396h-288V108h288V396z"/>
               </svg>';

      return $logo;

    }

    public function themeco_logo( $class = '', $style = '' ) {
      echo $this->get_themeco_logo( $class, $style );
    }


    //
    // X logo.
    //

    public function get_x_logo( $class = '', $style = '' ) {

      $class  = ( $class == '' ) ? '' : ' class="' . $class . '"';
      $style  = ( $style == '' ) ? '' : ' style="' . $style . '"';

      $logo = '<svg' . $class . $style . ' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.8 50.4" style="enable-background:new 0 0 41.8 50.4;" xml:space="preserve">
                 <path d="M36.2,0h4.2v0.1L23.3,24.5l18.5,25.8v0.1h-4.6l-16.3-23l-16.3,23H0v-0.1l18.5-25.8L1.4,0.1V0h4.2l15.3,21.5L36.2,0z"/>
               </svg>';

      return $logo;

    }

    public function x_logo( $class = '', $style = '' ) {
      echo $this->get_x_logo( $class, $style );
    }


    //
    // Cornerstone logo.
    //

    public function get_cornerstone_logo( $class = '', $style = '' ) {

      $class  = ( $class == '' ) ? '' : ' class="' . $class . '"';
      $style  = ( $style == '' ) ? '' : ' style="' . $style . '"';

      $logo = '<svg' . $class . $style . ' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-137 283 336 227" enable-background="new -137 283 336 227" xml:space="preserve">
                 <path fill="#26CABC" d="M86.8,444.8C52.6,464.5,65.3,457.2,31,477c-5.9-3.4-49.9-28.8-55.8-32.2c61.8-35.7,25.9-15,55.8-32.2C49.9,423.5,33.8,414.2,86.8,444.8z"/>
                 <path fill="#22B3A6" d="M86.8,444.8V477c-34.2,19.7-21.5,12.4-55.8,32.2V477C65.2,457.3,52.5,464.6,86.8,444.8z"/>
                 <path fill="#1D968D" d="M31,477v32.2c-5.9-3.4-49.9-28.8-55.8-32.2v-32.2C-18.9,448.2,25.1,473.6,31,477z"/>
                 <path fill="#DF5540" d="M-38.7,436.7L-38.7,436.7v32.2c-54.9-31.7-13.2-7.6-97.6-56.4v-32.1C-135.9,380.7-67.1,420.3-38.7,436.7z"/>
                 <path fill="#FA5745" d="M86.8,316v32.2c-74.9,43.3-33.5,19.4-83.7,48.3l-27.9-16.1C73,324,24.8,351.8,86.8,316z"/>
                 <path fill="#FE7864" d="M31,283.8l-167.3,96.6c0.5,0.3,69.2,40,97.6,56.3l55.8-32.2c-17.7-10.2-8.7-5-41.8-24.1C73,324,24.8,351.8,86.8,316L31,283.8z"/>
                 <path fill="#FE7864" d="M142.5,348.2c-13.4,7.7-83.9,48.4-97.6,56.3l55.8,32.2c29-16.7,94.9-54.8,97.6-56.4C164.1,360.7,176.8,368,142.5,348.2z"/>
                 <path fill="#FA5745" d="M198.3,380.4v32.2c0,0-97.6,56.3-97.6,56.4v-32.2C129.7,420,195.6,382,198.3,380.4z"/>
                 <path fill="#FA5745" d="M17,404.5v16.1c-17.8,10.3-8.8,5.1-41.8,24.1v16.4l-13.6,7.9l-0.3-0.2v-32.2l0,0L17,404.5z"/>
                 <path fill="#DF5540" d="M100.7,436.8V469l-13.9-8.1l0,0v-16.1C59,428.7,59.4,429,45,420.6v-16.1l0,0L100.7,436.8z"/>
               </svg>';

      return $logo;

    }

    public function cornerstone_logo( $class = '', $style = '' ) {
      echo $this->get_cornerstone_logo( $class, $style );
    }

    public function admin_notice( $msg = '', $args = array() ) {

      if ( is_array( $msg ) ) {
        $args = $msg;
      }

      $args = wp_parse_args( $args, array(
        'message'     => is_string( $msg ) ? $msg : '',
        'handle'      => false,
        'echo'        => true,
        'class'       => '',
        'dismissible'  => false,
        'ajax_dismiss' => false
      ) );

      extract( $args );

      $script = '';

      if ( is_string( $ajax_dismiss ) ) {

        if ( ! $handle ) {
          $handle = 'tco_' . uniqid();
        }

        ob_start(); ?>

        <script type="text/javascript">
        jQuery( function( $ ) {
          $('[data-tco-notice="<?php echo $handle; ?>"]').on( 'click', '.notice-dismiss', function(){
            $.post('<?php echo admin_url('admin-ajax.php?action=' . esc_attr( $ajax_dismiss ) ); ?>');
          });
        } );
        </script>
        <?php

        $script = ob_get_clean();

      }

      $class = ( $dismissible ) ? ' ' . $class . ' is-dismissible' : ' ' . $class;

      $logo_svg = $this->get_themeco_logo();
      $logo = "<a class=\"tco-notice-logo\" href=\"https://theme.co/\" target=\"_blank\">{$logo_svg}</a>";

      if ( $handle ) {
      $handle = "data-tco-notice=\"$handle\"";
      }

      $notice = "<div class=\"tco-notice notice {$class}\" {$handle}>{$logo}<p>{$message}</p></div>{$script}";

      if ( $echo ) {
        echo $notice;
      }

      return $notice;

    }

    public function get_site_url() {
      return esc_attr( trailingslashit( network_home_url() ) );
    }

    public function check_ajax_referer( $die = true ) {

      if ( ! isset( $_REQUEST['_tco_nonce'] ) ) {
        return false;
      }

      $check = ( false !== wp_verify_nonce( $_REQUEST['_tco_nonce'], 'tco-common' ) );

      if ( ! $check && $die ) {
        wp_send_json_error();
      }

      return $check;

    }

  }

endif;

