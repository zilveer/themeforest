<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Metabox {

	private static $_instance = null;
	static protected $_metabox = array(
		'post',
		'page',
		'crazyblog_forms',
		'crazyblog_gallery',
		'recipe'
	);

	static public function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	static public function init() {
		require_once( crazyblog_ROOT . 'core/duffers_panel/panel/bootstrap.php' );
		include_once( crazyblog_ROOT . 'core/duffers_panel/extend/loader.php' );
		require_once( crazyblog_ROOT . 'core/duffers_panel/panel/admin/data_sources.php' );

		foreach ( self::$_metabox as $meta ) {
			include_once crazyblog_ROOT . 'core/application/library/metabox/' . strtolower( $meta ) . '.php';
			$class = 'crazyblog_' . $meta . '_Meta';
			if ( class_exists( $class ) ) {
                            $object = new $class;
                            $get_vars = get_class_vars( get_class( $object ) );
                          
                            $fields = get_class_methods( $class );
                            $template = call_user_func( $class . '::' . $fields['0'] );
                            $options = array();
                            $options = array(
                                    'id' => 'crazyblog_' . strtolower( str_replace( ' ', '_', $meta ) ) . '_meta',
                                    'types' => crazyblog_set( $get_vars, 'type' ),
                                    'title' => crazyblog_set( $get_vars, 'title' ),
                                    'priority' => crazyblog_set( $get_vars, 'priority' ),
                                    'template' => $template,
                            );
                            
                            new VP_Metabox( $options );
			}
		}
	}

}
