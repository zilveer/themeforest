<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/** 
 * Demo Importer Config File
 *
 * @since     1.0.0
 * @version   1.0.0
 */

if ( !class_exists( 'Unite_Theme_Demo_Importer' ) ) {
    
    class Unite_Theme_Demo_Importer extends Unite_Demo_Importer {
        
        /**
         * Copy of the object for easy reference.
         * @since     1.0.0
         * @version   1.0.0
         */

		private static $instance;        
        
        /**
		 * Set name of the theme default sidebar
		 *
         * sidebar will be reseted when using importer
         *
		 * @since1.0.0
		 * @var string
		 */
        public $theme_default_sidebar_id = 'blog-widget-area';
        
        /**
         * Constructor
         * @since     1.0.0
         * @version   1.0.0
         */
        public function __construct() {
                        
            self::$instance = $this;
			parent::__construct();
        
        }
        
        public function import_demo_navigations() {
            
            /* name of navigation */
			$main_menu   = get_term_by( 'name', 'All Pages', 'nav_menu' );

			set_theme_mod( 
                
                'nav_menu_locations', array(
				    'primary'        => $main_menu->term_id,
				)
                
			);

			$this->imported['menus'] = true;

		}
        
        public function available_demos() {
            
            return array(
                'classic' => array(
                    'name'   => 'Classic',
                    'link'   => '',
                    'images' => false
                ),
       
            );
        
        }
        
        
    }
    
    /* get it started */
    if( apply_filters( 'ut_show_demo_importer', true ) ) {    
        
        new Unite_Theme_Demo_Importer;

    }

}