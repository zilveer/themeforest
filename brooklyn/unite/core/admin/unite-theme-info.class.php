<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

class UT_Theme_Info {
    
    /**
     * Theme Info option key, and sidebar admin page slug
     * @var string
     */
    private $key = 'unite-theme-info';
    
    /**
     * Theme Info Title
     * @var string
     */
    protected $title = '';
    
    /**
     * Theme Info
     * @var string
     */
    protected $theme_info = ''; 
    
    /**
     * Configuration Strings
     * @var string
     */
     
    private $memory         = false;  
    private $post_max_size  = false; 
    private $max_input_vars = false;
    private $max_execution  = false;
    private $memory_limit   = false;          
    private $knowledgebase  = '';
    
    /**
     * Configuration Loop
     * @var string
     */
    private $current_config = array();    
    
    /**
     * Dashboard Notification
     * @var string
     */
    protected $daboard_notification = false; 
        
    /**
     * Constructor
     * @since     1.0.0
     * @version   1.0.0
     */
    public function __construct() {
        
        $this->title          = esc_html__( 'Theme Health', 'unite-admin' );
        
        /* theme info */
        $this->theme_info     = wp_get_theme();
        
        /* knowledgebase */
        $this->knowledgebase  = esc_url( 'http://knowledgebase.unitedthemes.com/' );
        
        /* run hooks */
        $this->hooks();
            
    }
    
    /**
     * Initiate our hooks
     * @since     1.0.0
     * @version   1.0.0
     */
    public function hooks() {
        
        /* add menu item */
        add_action( 'admin_menu' , array( $this , 'add_menu_item' ) );
        
        /* check configuration settings */
        add_action( 'init', array ($this, 'get_memory_limit') );
        add_action( 'init', array ($this, 'get_post_max_size') );
        add_action( 'init', array ($this, 'get_max_input_vars') );
        add_action( 'init', array ($this, 'get_max_execution_time') );
        
        /* add dashbaord notification */
        add_action( 'admin_notices', array ($this, 'dashboard_notification') );        
        add_action( 'wp_ajax_hide_health_notification', array($this, 'hide_dashboard_notification') );
                   
    }
    
    /**
     * Add to menu
     * @since     1.0.0
     * @version   1.0.0
     */
    public function add_menu_item() {
        
        $this->options_page = add_submenu_page('unite-welcome-page', $this->title, $this->title, 'manage_options', $this->key, array( $this , 'admin_page_display' ) );
        
    }
    
    /**
     * Assign Memory Limit
     * @since     1.0.0
     * @version   1.0.0
     */        
    function get_memory_limit() {
        
        $this->memory_limit = (int) ini_get('memory_limit');
        
        if( $this->memory_limit ) {
            
            /* title */    
            $this->current_config['memory_limit']['title']= esc_html__( 'Memory Limit:', 'unite-admin' );
            
            /* recommended value */
            $this->current_config['memory_limit']['recommended']= esc_html__( '64', 'unite-admin' );
            
            /* badge */
            if( $this->memory_limit < 64 ) {
                
                $this->current_config['memory_limit']['badge'] = $this->create_status_icon('y');
                $this->current_config['memory_limit']['info']  = sprintf( esc_html__( 'We recommend setting the memory limit at least to 64MB.', 'unite-admin' ), $this->memory_limit );
                
                /* knowledgebase article */
                $this->current_config['memory_limit']['artricle']  = 'how-to-increase-the-memory-limit-in-wordpress';
                
                /* show notification */
                $this->daboard_notification = true;
                
            } else {
                
                $this->current_config['memory_limit']['badge'] = $this->create_status_icon('g');
                $this->current_config['memory_limit']['info']  = $this->memory_limit . esc_html__( 'MB', 'unite-admin' );
            
            }
               
        }      
        
    }
    
    /**
     * Post Max Size
     * @since     1.0.0
     * @version   1.0.0
     */ 
    function get_post_max_size() {
        
        $this->post_max_size = (int) ini_get('post_max_size'); 
        
        if( $this->post_max_size ) {
            
            /* title */    
            $this->current_config['post_max_size']['title']= esc_html__( 'Post Max Size:', 'unite-admin' );
            
            /* recommended value */
            $this->current_config['post_max_size']['recommended']= esc_html__( '8', 'unite-admin' );
            
            /* badge */
            if( $this->post_max_size < 8 ) {
                
                $this->current_config['post_max_size']['badge'] = $this->create_status_icon('r');
                $this->current_config['post_max_size']['info']  = sprintf( esc_html__( '%s MB. We recommend setting post_max_size at least to 8MB or higher. Otherwise uploading file onto your server such as large images is not possible.', 'unite-admin' ), $this->post_max_size );    
                
                /* knowledgebase article */
                $this->current_config['post_max_size']['artricle']  = 'how-to-increase-the-maximum-file-upload-size-in-wordpress';
                
                /* show notification */
                $this->daboard_notification = true; 
            
            } else {
                
                $this->current_config['post_max_size']['badge'] = $this->create_status_icon('g');
                $this->current_config['post_max_size']['info']  = $this->post_max_size . esc_html__( 'MB', 'unite-admin' );
                
            }
        
        }
        
    }
    
    /**
     * Max Input Vars
     * @since     1.0.0
     * @version   1.0.0
     */     
    function get_max_input_vars() {
        
        $this->max_input_vars = (int) ini_get('max_input_vars');
        
        if( $this->max_input_vars ) {
            
            /* title */    
            $this->current_config['max_input_vars']['title']= esc_html__( 'Max Input Vars:', 'unite-admin' );
            
            /* recommended value */
            $this->current_config['max_input_vars']['recommended']= esc_html__( '3000', 'unite-admin' );
            
            if ( $this->max_input_vars < 3000 && $this->max_input_vars >= 2000 ) {
                
                $this->current_config['max_input_vars']['badge'] = $this->create_status_icon('y');
                $this->current_config['max_input_vars']['info']  = sprintf( esc_html__( '%s Max input vars limitation will truncate POST data such as menus. While 2000 is decent we still recommend to set it to at least 3000.', 'unite-admin' ), $this->max_input_vars );
                
                /* knowledgebase article */
                $this->current_config['post_max_size']['artricle']  = 'how-to-increase-the-max-input-vars-in-wordpress';
                
                /* show notification */
                $this->daboard_notification = true;
                
            } elseif( $this->max_input_vars < 2000 && $this->max_input_vars >= 1000 ) {     
                
                $this->current_config['max_input_vars']['badge'] = $this->create_status_icon('r');
                $this->current_config['max_input_vars']['info']  = sprintf( esc_html__( '%s Max input vars limitation will truncate POST data such as menus. Please set it at least to 3000.', 'unite-admin' ), $this->max_input_vars );
                
                /* knowledgebase article */
                $this->current_config['post_max_size']['artricle']  = 'how-to-increase-the-max-input-vars-in-wordpress';
                
                /* show notification */
                $this->daboard_notification = true;
                
            } else {
            
                $this->current_config['max_input_vars']['badge'] = $this->create_status_icon('g');
                $this->current_config['max_input_vars']['info']  = $this->max_input_vars;            
            
            }
        
        }        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Check Memory Usage
     * @since     1.0.0
     * @version   1.0.0
     */        
    function get_memory_usage() {
        
        $this->memory['usage'] = function_exists( 'memory_get_usage' ) ? round( memory_get_usage() / 1024 / 1024, 2 ) : 0;
        
        if ( !empty( $this->memory['usage'] ) && $this->memory_limit ) {
        
            $this->memory['percent'] = round ($this->memory['usage'] / $this->memory['limit'] * 100, 0);
            $this->memory['color'] = 'font-weight:bold; color:#8DB255;';
            
            $this->memory['color'] = ( $this->memory['percent'] > 75 ) ? 'font-weight:bold; color:#f39c12;' : $this->memory['color'];
            $this->memory['color'] = ( $this->memory['percent'] > 90 ) ? 'font-weight:bold; color:#c0392b;' : $this->memory['color'];
            
        }        
    }
    
   
    
    
    
    /**
     * Max Execution Time
     * @since     1.0.0
     * @version   1.0.0
     */     
    function get_max_execution_time() {
        
        $this->max_execution = (int) ini_get('max_execution_time');
        
        if( $this->max_execution <= 60 ) {
            
            /* show notification */
            $this->daboard_notification = true;    
        
        }        
        
    }
    
    /**
     * Create Status Icon
     * @since     1.0.0
     * @version   1.0.0
     */    
    function create_status_icon( $status ) {
        
        switch( $status ) {
            
            /* green */
            case 'g' : return '<span class="unite-tooltip"><a title="' . esc_html__( 'System check passed!', 'unite-admin' ) . '" class="unite-tooltip-green tooltipstered" href="#"><i class="fa fa-check"></i></a></span>';
            break;
            
            /* yellow */
            case 'y' : return '<span class="unite-tooltip"><a title="' . esc_html__( 'System check not passed! We recommmend to adjust this value.', 'unite-admin' ) . '" class="unite-tooltip-yellow tooltipstered" href="#"><i class="fa fa-info"></i></a></span>';
            break;
            
            /* red */
            case 'r' : return '<span class="unite-tooltip"><a title="' . esc_html__( 'System check not passed! Some parts of your website may not work as intended. We highly recommmend to adjust this value.', 'unite-admin' ) . '" class="unite-tooltip-red tooltipstered" href="#"><i class="fa fa-times"></i></a></span>';
            break;
        
        }       
    
    }
    
    /**
     * Create Status Fix Icon
     * @since     1.0.0
     * @version   1.0.0
     */    
    function create_status_fix_icon( $article ) {
        
        return '<span class="unite-tooltip"><a title="' . esc_html__( 'Learn how to fix it.', 'unite-admin' ) . '" class="unite-tooltip-blue tooltipstered" target="_blank" href="' . $this->knowledgebase . $article . '"><i class="fa fa-medkit"></i></a></span>';
    
    }
    
    /**
     * Dashboard Notification
     * @since     1.0.0
     * @version   1.0.0
     */     
    function dashboard_notification() {
        
        if( $this->daboard_notification && !get_option('hide_unite_health_dashboard_notification') ) {
        
            $class = 'notice notice-warning is-dismissible unite-health-status';
            $message = esc_html__( 'Please check theme health status page. Your action may be required.', 'unite-admin' );
            $link = '<a href="' . get_admin_url() . 'admin.php?page=unite-theme-info">' . esc_html__( 'View Health Status', 'unite-admin' ) . '</a>';
            
            printf( '<div class="%1$s"><p>%2$s %3$s</p></div>', $class, $message, $link ); 
        
        }
        
    }
        
    /**
     * Hide Dashboard Notification
     * @since     1.0.0
     * @version   1.0.0
     */      
    function hide_dashboard_notification() {
        
        update_option( 'hide_unite_health_dashboard_notification', 1 );
    
    }
    
    /**
     * Show Dashboard Notification
     * @since     1.0.0
     * @version   1.0.0
     */      
    function show_dashboard_notification() {
    
        update_option( 'hide_unite_health_dashboard_notification', 0 );            
    
    }

    /**
     * Admin page markup
     * @since    1.0
     * @version  1.0.0
     */
    public function admin_page_display() { ?>
                
        <!-- Start UT-Backend-Wrap -->
        <div id="ut-theme-info" class="ut-admin-wrap clearfix">
                            
            <div class="ut-backend-top-bar clearfix">
                
                <a class="ut-backend-logo hide-on-tablet hide-on-mobile" href="<?php echo get_admin_url(); ?>admin.php?page=unite-welcome-page" title="UnitedThemes">
                    <img src="<?php echo FW_WEB_ROOT . '/core/admin/assets/img/ut_logo_white.png'; ?>" alt="United Themes" />
                </a>
                
                <h2>
                    <?php esc_html_e( 'Theme Health', 'unite-admin' ); ?>                    
                </h2>
                
                <span class="hide-on-tablet hide-on-mobile">by United Themes - Framework Version: <?php echo UT_VERSION; ?></span>
                
            </div>
            <!-- Close UT-Backend-Topbar -->
            
            <!-- Start UT-Admin-Main -->                
            <div class="ut-admin-main">                        
                    
                <!-- Start UT-Admin-Header -->
                <header class="ut-admin-header clearfix">
                    
                    <h3 class="ut-admin-header-title">
                        <?php esc_html_e( 'About this Installation', 'unite-admin' ); ?>
                    </h3>
                    
                </header>
                <!-- Cose UT-Admin-Header -->
                 
                <div class="ut-admin-panel-group ut-show">
                    
                    <section class="ut-admin-panel">
                        
                        <header class="ut-admin-panel-header clearfix">
                            
                            <h4><?php esc_html_e( 'Theme Config', 'unite-admin' ); ?></h4>
                            
                        </header>
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <table class="form-table">
                                
                                <tbody>
                                
                                    <tr valign="top">
                                        <th scope="row"><?php esc_html_e( 'WordPress Version:', 'unite-admin' ); ?></th>
                                        <td><?php echo get_bloginfo('version'); ?></td>
                                    </tr>
                                    
                                    <tr valign="top">
                                        <th scope="row"><?php esc_html_e( 'URL:', 'unite-admin' ); ?></th>
                                        <td><?php echo site_url(); ?></td>
                                    </tr>
                                    
                                    <tr valign="top">
                                        <th scope="row"><?php esc_html_e( 'Installed Theme:', 'unite-admin' ); ?></th>
                                        <td><?php echo $this->theme_info->get( 'Name' ); ?></td>
                                    </tr>
                                    
                                    <tr valign="top">
                                        <th scope="row"><?php esc_html_e( 'Theme Version:', 'unite-admin' ); ?></th>
                                        <td><?php echo $this->theme_info->get( 'Version' ); ?></td>
                                    </tr>
                                    
                                    <tr valign="top">
                                        <th scope="row"><?php esc_html_e( 'Framework Version:', 'unite-admin' ); ?></th>
                                        <td><?php echo UT_VERSION; ?></td>
                                    </tr>
                                    
                                    <tr valign="top">
                                        <th scope="row"><?php esc_html_e( 'PHP Version:', 'unite-admin' ); ?></th>
                                        <td><?php echo phpversion(); ?></td>
                                    </tr>
                                
                                </tbody>
                                
                            </table>
                            
                        </div>
                        
                    </section>
                    
                    <section class="ut-admin-panel">
                        
                        <header class="ut-admin-panel-header clearfix">
                            
                            <h4><?php esc_html_e( 'PHP Config', 'unite-admin' ); ?></h4>
                            
                        </header>
                                                    
                        <div class="ut-admin-panel-content clearfix">
                                
                            <table class="form-table ut-compare-table">
                        
                                <tbody>
                                    
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="ut-config-head-title"><?php esc_html_e( 'current', 'unite' ); ?></th>
                                            <th class="ut-config-head-title"><?php esc_html_e( 'recommended', 'unite' ); ?></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>                                    
                                            
                                    <?php foreach( $this->current_config as $key => $config ) : ?>
                                                                            
                                        <tr valign="top">
                                            
                                            <th scope="row" class="ut-config-title-column"><?php echo $config['title']; ?></th>
                                            
                                            <td class="ut-config-value-column"><?php echo $this->$key; ?></td>
                                            <td class="ut-config-value-column"><?php echo $config['recommended']; ?></td>
                                            
                                            <td class="ut-config-info-column"><?php echo $config['badge']; ?></td>
                                            <td class="ut-config-info-column"><?php echo !empty( $config['artricle'] ) ? $this->create_status_fix_icon( $config['artricle'] ) : ''; ?></td>
                                            
                                            <td></td>
                                            
                                        </tr>
                                    
                                    <?php endforeach; ?>                                 
                                
                                </tbody>
                                                                
                            </table> 
                                
                         </div>
                    
                    </section>     
                            
                    <section class="ut-admin-panel">
                        
                        <header class="ut-admin-panel-header clearfix">
                            
                            <h4><?php esc_html_e( 'Plugin Information', 'unite-admin' ); ?></h4>
                            
                        </header> 
                        
                        <div class="ut-admin-panel-content clearfix">
                                
                            <?php if( is_array( get_option( 'active_plugins' ) ) ) : ?>
                            
                            <table class="form-table">
                                
                                <tbody> 
                                    <tr valign="top">
                                        
                                        <th scope="row" style="border-bottom:0px;"><?php esc_html_e( 'Installed Plugins:', 'unite-admin' ); ?></th>
                                        <td style="border-bottom:0px;">
                                        
                                        <ul>
                                            <?php foreach(get_option( 'active_plugins' ) as $plugin) {
                                                echo '<li>'.$plugin.'</li>';
                                            } ?>
                                        </ul>
                                        
                                        </td>
                                    </tr>
                                    
                                </tbody>                                                                
                            </table>  
                             
                            <?php endif; ?>
                        
                        </div>
                    
                    </section>                    
                
                </div>
                
            </div>                
            <!-- Close UT-Admin-Main -->
        
        </div>
        <!-- Close UT-Backend-Wrap -->            
    
    <?php }
    
    
}

/* get it started */
if( apply_filters( 'ut_show_theme_info', false ) ) {
    
    new UT_Theme_Info();    
    
}
    
