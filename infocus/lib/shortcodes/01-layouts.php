<?php
/**
 *
 */
class mysiteLayouts {
	
	/**
	 *
	 */
	function one_half_layout ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Two Column Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_half_layout',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_half',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_half_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_third_layout ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Three Column Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_third_layout',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_third',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_third',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_third_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_fourth_layout ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Four Column Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_fourth_layout',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fourth column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_fifth_layout ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Five Column Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_fifth_layout',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fifth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fifth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fifth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fourth column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fifth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fifth column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fifth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_sixth_layout ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Six Column Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_sixth_layout',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fourth column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fifth column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your sixth column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_third_two_third ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Third - Two Third', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_third_two_third',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_third',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'two_third_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function two_third_one_third ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Two Third - One Third', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'two_third_one_third',
				'options' => array(
					array(
						'name' => __('Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'two_third',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __('Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_third_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_fourth_three_fourth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Fourth - Three Fourth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_fourth_three_fourth',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'three_fourth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function three_fourth_one_fourth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Three Fourth - One Fourth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'three_fourth_one_fourth',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'three_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_fourth_one_fourth_one_half ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Fourth - One Fourth - One Half', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_fourth_one_fourth_one_half',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_half_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_fourth_one_half_one_fourth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Fourth - One Half - One Fourth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_fourth_one_half_one_fourth',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your  second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_half',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_half_one_fourth_one_fourth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Half - One Fourth - One Fourth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_half_one_fourth_one_fourth',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_half',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fourth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function four_fifth_one_fifth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Four Fifth - One Fifth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'four_fifth_one_fifth',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'four_fifth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fifth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_fifth_four_fifth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Fifth - Four Fifth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_fifth_four_fifth',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_fifth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'four_fifth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function two_fifth_three_fifth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Two Fifth - Three Fifth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'two_fifth_three_fifth',
				'options' => array(
					array(
						'name' => __('Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'two_fifth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'three_fifth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_sixth_five_sixth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Sixth - Five Sixth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_sixth_five_sixth',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'five_sixth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function five_sixth_one_sixth ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Five Sixth - One Sixth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'five_sixth_one_sixth',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'five_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __('Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function one_sixth_one_sixth_one_sixth_one_half ( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'One Sixth - One Sixth - One Sixth - One Half', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'one_sixth_one_sixth_one_sixth_one_half',
				'options' => array(
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your first column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your second column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your third column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_sixth',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __('Column Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content for your fourth column.  Shortcodes are accepted here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'value' => 'one_half_last',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
	}
	
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Column Layouts', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of layout you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'layouts',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>