<?php

    /*
    *
    *	Template Function
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_get_template()
    *	sf_get_header_layout()
    *	sf_get_content_view()
    *
    */
	
	
	/* GET LAYOUT TEMPLATE
	================================================== */
    if ( ! function_exists( 'sf_get_template' ) ) {
        function sf_get_template( $template, $type = "" ) {
            get_template_part( 'swift-framework/layout/' . $template, $type );
        }
    }
	
	
	/* GET HEADER LAYOUT
	================================================== */
	if ( ! function_exists( 'sf_get_header_layout' ) ) {
		function sf_get_header_layout( $template, $type = '' ) {
			get_template_part( 'template-parts/header/' . $template, $type );
		}
	}
	
	
	/* GET CONTENT VIEW
	================================================== */
	if ( ! function_exists( 'sf_get_content_view' ) ) {
		function sf_get_content_view( $view, $type = '', $return = false ) {
			if ( $return) {
				ob_start();
			    get_template_part( 'template-parts/content/' . $view, $type );
			    return ob_get_clean();
			} else {
				get_template_part( 'template-parts/content/' . $view, $type );
			}
		}
	}