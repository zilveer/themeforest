<?php
/** Elderberry Controls
  *
  * This file houses the Elderberry Controls class
  *
  * @package Elderberry
  *
  */

/** Elderberry Controls Class
  *
  * This class generates the large group and tab navigation and also
  * all the controls for it. It also controls some control specific
  * things like image upload and image removal.
  *
  */
class EB_Controls  {

	/** Class Constructor
	  *
	  * Builds the required things for the controls to work.
	  * It references the framework, the type of controls needed and the
	  * current screen, adds scripts and styles and hooks into some
	  * WordPress functions.
	  *
	  * The stylehseets will only be included on screens where
	  * option displays are possible.
	  *
	  * @param object $framework The Elderberry framework object
	  * @param string $type The type of item we need controls for
	  * @param string $screen The screen we need the options for
	  *
	  */
	function __construct( $framework, $type, $screen ) {
		$this->type = $type;
		$this->framework = $framework;
		$this->screen = $screen;

  		add_action( 'admin_head', array( $this, 'add_controls_stylesheet' ) );
   		add_action( 'admin_head', array( $this, 'add_controls_scripts' ) );

      	add_action('wp_ajax_action_upload', array( $this, 'action_upload' ) );
      	add_action('wp_ajax_action_remove_image', array( $this, 'action_remove_image' ) );

   		add_action( 'wp_ajax_action_show_controls', array( $this, 'action_show_controls' ) );

	}




	/** Add Stylesheets
	  *
	  * This function adds the necessary stylesheets. It uses the
	  * EB_ADMIN_THEME_URL constant to figure out which theme is
	  * used and includes the appropriate stylesheet from it.
	  *
	  * The stylehseets will only be included on screens where
	  * option displays are possible.
	  *
	  */
	function add_controls_stylesheet() {
		global $current_screen;

		if( in_array( $current_screen->base, $this->screen ) ) {

    		wp_register_style( 'eb-controls', EB_ADMIN_THEME_URL . '/css/eb-controls.css' );
      		wp_register_style( 'eb-product-page-content', EB_ADMIN_THEME_URL . '/css/eb-product-page-content.css' );
      		wp_register_style( 'jquery-ui', EB_ADMIN_THEME_URL . '/css/jquery-ui.css' );

    		wp_enqueue_style( 'eb-product-page-content' );
    		wp_enqueue_style( 'eb-controls' );
    		wp_enqueue_style( 'jquery-ui' );
    	}
	}

	/** Add Scripts
	  *
	  * This function adds the necessary scripts. If we are in a
	  * test environment the full version of the scripts will be
	  * used for easier troubleshooting, otherwise the minified
	  * version will be used.
	  *
	  * The scripts will only be included on screens where
	  * option displays are possible.
	  *
	  */
	function add_controls_scripts() {
		global $current_screen;
		$minified = ( EB_ENVIRONMENT == 'test' ) ? '' : '.min';

		if( in_array( $current_screen->base, $this->screen ) ) {

		    wp_register_script(
		    	'jquery-ui-widget_custom',
		    	EB_URL . '/js/vendor/jquery.ui.widget' . $minified . '.js',
		    	array( 'jquery' )
		    );

	    	wp_register_script(
	    		'jquery-tagsinput',
	    		EB_URL . '/js/vendor/jquery.tagsinput' . $minified . '.js',
	    		array( 'jquery' )
	    	);

	    	wp_register_script(
		    	'jquery-chosen',
		    	EB_URL . '/js/vendor/chosen.jquery' . $minified . '.js',
		    	array( 'jquery' )
	    	);
	    	wp_register_script(
		    	'jquery-fileupload',
		    	EB_URL . '/js/vendor/jquery.fileupload' . $minified . '.js',
		    	array( 'jquery', 'jquery-ui-widget', 'jquery-iframe-transport' )
	    	);
	    	wp_register_script(
		    	'jquery-iframe-transport',
		    	EB_URL . '/js/vendor/jquery.iframe-transport' . $minified . '.js',
		    	array( 'jquery' )
	    	);
	    	wp_register_script(
	    		'jquery-duallistbox',
	    		EB_URL . '/js/vendor/jquery.dualListBox' . $minified . '.js',
	    		array( 'jquery' )
	    	);
	    	wp_register_script(
	    		'jquery-iphone-style-checkboxes',
	    		EB_URL . '/js/vendor/iphone-style-checkboxes' . $minified . '.js',
	    		array( 'jquery' )
	    	);
	    	wp_register_script(
	    		'eb-controls',
	    		EB_URL . '/js/eb-controls' . $minified . '.js',
	    		array( 'jquery', 'jquery-ui-widget_custom', 'jquery-ui-droppable', 'jquery-tagsinput', 'jquery-chosen', 'jquery-fileupload', 'jquery-iframe-transport', 'jquery-duallistbox', 'jquery-iphone-style-checkboxes', 'farbtastic' ) );

	    	wp_register_script(
	    		'eb-product-page-content',
	    		EB_URL . '/js/eb-product-page-content' . $minified . '.js',
	    		array( 'jquery', 'eb-controls' ) );


	    	wp_localize_script(
	    		'eb-controls',
	    		'eb_vars',
	    		array(
	    			'ajaxurl' => admin_url( 'admin-ajax.php' ),
	    			'frameworkurl' => EB_URL
	    		)
	    	);

     		wp_enqueue_script( 'jquery-ui-widget_custom' );
      		wp_enqueue_script( 'jquery-ui-datepicker' );
       		wp_enqueue_script( 'jquery-iphone-style-checkboxes' );
      		wp_enqueue_script( 'jquery-tagsinput' );
     		wp_enqueue_script( 'jquery-fileupload' );
     		wp_enqueue_script( 'farbtastic' );
     		wp_enqueue_script( 'jquery-chosen' );
      		wp_enqueue_script( 'jquery-duallistbox' );
    		wp_enqueue_script( 'eb-controls' );
    		wp_enqueue_script( 'eb-product-page-content' );
    	}
	}



	/** Get Control Value
	  *
	  * Finds the value of a given control item. It calls the
	  * appropriate function dependant on the $type variable.
	  *
	  * @param array $item The details of the item
	  * @param mixed $section The details of the item's containing section
	  *
	  */
	function get_control_value( $item, $section ) {
		global $framework;

		if( $this->type == 'option' ) {
			$value = $this->framework->get_option_value( $item['guid'] );
		}
		elseif( $this->type == 'custom_fields' ) {
			global $post;
			$value = $this->framework->get_custom_field_value( $post, $item['guid'] );
		}
		elseif( $this->type == 'widget' ) {
			$value = $this->framework->get_widget_field_value( $section, $item['id'] );
		}
		else {
			$value = call_user_func( array( $this->framework, 'get_' . $this->type . '_value' ), $item['guid'] );
		}

		$unserialize = @unserialize( $value );
		if( is_array( $unserialize ) ) {
			$value = $unserialize;
		}

		if( is_string( $value ) ) {
			$value = str_replace( '"', '&quot;', $value );
		}

		return $value;
	}

	/***********************************************/
	/*          !Control Section Display           */
	/***********************************************/


	function action_show_controls() {
		global $framework, $post;
		ob_start();
		$post = get_post( $_POST['post_id'] );
		$this->framework->get_all_postmeta();
		$post->page_template = str_replace( '.php', '', $_POST['template'] );
		$this->type = 'custom_fields';
		$args = unserialize( urldecode( $_POST['args'] ) );
		$args['group'] = ( $post->page_template  == 'default' ) ? 'page' : $post->page_template;
		$this->show_controls( $this->framework->defaults['custom_fields'], $args );
		$output = ob_get_clean();
		echo $output;
		die();
	}

	/** Show Controls
	  *
	  * This function handles the generation and display of the
	  * whole controls area. It generates the header, the group
	  * navigation, the footer and through the show_group()
	  * function it also shows the tabs and group controls.
	  *
	  * @param array $options The default options array
	  * @param array $args The arguments for this controls display
	  *
	  * @uses show_controls_header()
	  * @uses show_group_nav()
	  * @uses show_group()
	  * @uses show_controls_footer()
	  *
	  */

	function show_controls( $options, $args = array() ) {
		global $post, $wpdb;

		if( !empty( $post ) ) {
			$this->framework->get_all_postmeta();
		}

		$defaults = array(
			'title' => 'Theme Options'
		);
		$args = wp_parse_args( $args, $defaults );

		$groups_class = 'multiple';
		if( isset( $args['group'] ) ) {
			$groups_class = 'single';
			$options = array( 'groups' => array( $options['groups'][$args['group']] ) );
		}

		$this->show_controls_header( $options, $args );
		$this->show_group_nav( $options, $args );

		echo '<div data-settings="' . urlencode(serialize( $args )) . '" class="groups ' . $groups_class . '">';

		$i=0;
		while( $group = current( $options['groups'] ) ) {
			$group_id = key( $options['groups'] );
			$current = ( $i == 0 ) ? 'current' : '';

			echo '<div class="group ' . $current . '" data-group_id="' . $group_id . '">';
				$this->show_group(  $group['tabs'], $args );
				echo '<div class="clear"></div>';
			echo '</div>';

			$i++;
			next( $options['groups'] );
		}

		echo '</div>';

		$this->show_controls_footer( $options, $args );
	}

	/** Controls Header
	  *
	  * Displays the header section of the controls area.
	  * This includes the icon and title on the left,
	  * the promotional link and the save button on the right.
	  *
	  * @param array $options The default options array
	  * @param array $args The arguments for this controls display
	  *
	  */
	function show_controls_header( $options, $args ) {
		echo '<div class="eb-admin type-' . $this->type . '">';
		echo '<div class="eb-tabbed-settings">';
		echo '<div id="colorpicker" class="farbtastic"></div>';
		echo '<h1 class="eb-admin-title">';
			echo '<span class="eb-icon"></span>';
			echo $args['title'];
		echo '</h1>';

		echo '<div class="eb-save">';
			if( !empty( $this->config['settings_promotion'] ) ) {
				echo $this->config['settings_promotion'];
			}

			if(  $this->type != 'widget' ) {
				echo '<input name="save" type="submit" class="button-primary" id="publish" tabindex="5" accesskey="p" value="Save Changes">';
			}

		echo '</div>';

		echo '<div class="clear"></div>';
	}

	/** Controls Footer
	  *
	  * Displays the footer of the controls area
	  *
	  * @param array $options The default options array
	  * @param array $args The arguments for this controls display
	  *
	  */
	function show_controls_footer( $options, $args ) {
		echo '</div>';
		echo '</div>';
	}


	/** Group Navigation
	  *
	  * Displays the left-hand side group navigation bar
	  *
	  * @param array $options The default options array
	  * @param array $args The arguments for this controls display
	  *
	  */
	function show_group_nav( $options, $args ) {
		if( count( $options['groups'] ) > 1 ) {
			echo '<ul class="group-nav">';
			$i = 0;
			foreach( $options['groups'] as $guid => $group ) {

			$current = ( $i == 0 ) ? 'current' : '';
				echo '<li class="' . $current . '" data-group_id="' . $guid . '"><img src="' . $group['icon'] . '">' . $group['title'] . '</li>';
				$i++;
			}
			echo '</ul>';
		}
	}

	/** Tab Navigation
	  *
	  * Displays the top tab navigation area
	  *
	  * @param array $group The group the tabs are generated for
	  *
	  */
	function show_tab_nav( $group ) {
		echo '<div class="tabs">';

		$i = 0;
		foreach( $group as $guid => $details ) {
			$current = ( $i == 0 ) ? 'current' : '';
			echo '<span class="tab ' . $current . '" data-section_id="' . $guid . '">' . $details['tab_title'] . '</span>';
			$i++;
		}

		echo '</div>';
	}

	/** Show Group
	  *
	  * Displays a group of settings. It firsts generates the tab
	  * navigation, then it generates all pages for these tabs.
	  * All but the initial (current) one should be hidden via
	  * css.
	  *
	  * Inside the tabbed sections it generates all the necessary
	  * controls for the items by calleing the generate_control_[type]
	  * function.
	  *
	  * @param array $group The group the tabs are generated for
	  * @param array $args The arguments for this controls display
	  *
	  * @uses show_tab_nav()
	  * @uses unknown_control()
	  *
	  */
	function show_group( $group, $args ) {

		$this->show_tab_nav( $group );

		echo '<div class="sections">';

		$i = 0;
		foreach( $group as $guid => $section ) {
			$current = ( $i == 0 ) ? 'current' : '';

			echo '<div class="section ' . $current . '" data-section_id="' . $guid . '">';
				echo '<div class="items">';
				foreach( $section['items'] as $item ) {
					$classes = array();
					$classes['nolabel'] = ( !empty( $item['nolabel'] ) AND $item['nolabel'] == true ) ? 'nolabel' : '';
					$classes['nohelp'] = ( !empty( $item['nohelp'] ) AND $item['nohelp'] == true ) ? 'nohelp' : '';
					$classes = implode( ' ', $classes );
					$itemwidth = ( !empty( $item['control']['fullwidth'] ) ) ? 'fullwidth' : '';
					echo '<div class="item ' . $itemwidth . '">';

						if( empty( $item['nolabel'] ) OR $item['nolabel'] != true ) {
							echo '<div class="label">' . $item['label'] . '</div>';
						}
						echo '<div class="control control-' . $item['control']['type'] . ' ' . $classes . '">';
						if( method_exists( $this, 'control_' . $item['control']['type'] ) ) {
							call_user_func( array( $this, 'control_' . $item['control']['type'] ), $item, $section );
						}
						else {
							$this->control_unknown( $item, $group );
						}
						echo '</div>';
						if( empty( $item['nohelp'] ) OR $item['nohelp'] != true ) {
							echo '<div class="help help-icon"><div class="help-content">' . $item['help'] . '</div></div>';
						}
						echo '<div class="clear"></div>';
					echo '</div>';
				}
				echo '</div>';
			echo '</div>';
			$i++;
		}
		echo '</div>';
	}


	/***********************************************/
	/*               !Control Types                */
	/***********************************************/


	/** Unknown Control
	 *
	 * This function is executed when a function for a specified
	 * control type does not exist. It only throws an error if
	 * we are in test mode.
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_unknown( $item, $section ) {
		$message ='
			<p>
				You are using a control which is not defined in a function. Make sure to create the : <strong>generate_control_' . $item['control']['type'] . '()</strong> function			</p>
		';
		$this->framework->fatal_error( $message );
	}


	function control_custom( $item, $section ) {
		$args = ( !empty( $item['control']['function_args'] ) ) ? $item['control']['function_args'] : array();
		if( ! function_exists( $item['control']['function'] ) ) {
			$message ='
				<p>
					You are using a control which is not defined in a function. Make sure to create the : <strong>' . $item['control']['function'] . '() </strong> function
				</p>
			';
			$this->framework->fatal_error( $message );
		}
		call_user_func( $item['control']['function'], $item, $section, $args );
	}


	function control_info( $item, $section ) {
		echo $item['control']['text'];
	}


	/** Custom Field Control
	 *
	 * A control for creating key-value type fields
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_custom_fields( $item, $section ) {
	$current_value = $this->get_control_value( $item, $section );
	if( empty( $current_value ) ) {
		$current_value = array(
			'name' => array( '' ),
			'value' => array( '' ),
		);
	}

	?>
	<div class='control-subgroups'>
	<?php for( $i=0; $i < count( $current_value['name'] ); $i++ ) : ?>
		<div class='custom-fields control-subgroup'>

			<div class='row'>
				<p class='halfwidth'>
					<label><?php echo $item['control']['name'] ?> Name</label>
					<input type='text' name='<?php echo $item['guid'] ?>[name][]' value='<?php echo $current_value['name'][$i] ?>'>
				</p>
				<p class='halfwidth last'>
					<label><?php echo $item['control']['name'] ?> Value</label>
					<input type='text' name='<?php echo $item['guid'] ?>[value][]' value='<?php echo $current_value['value'][$i] ?>'>
				</p>
			</div>

			<div class='text-right'>
				<span class='remove_custom_fields remove_subgroup delete-item'>x <?php echo $item['control']['remove_text'] ?> </span>
			</div>


			<div class='line'></div>

		</div>
	<?php endfor ?>
	</div>

	<span class='add_custom_field add_subgroup button button-primary small'>+ <?php echo $item['control']['button_text'] ?></span>

	<?php
	}





	/** Select Field
	 *
	 * A function for generating select field. Options should be specified
	 * using the $item['control']['options'] member of the array. The initial
	 * items may be specified using the $item['control']['initial'] array.
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_select( $item, $section, $current_value = '' ) {
		if( $current_value == '' ) {
			$current_value = $this->get_control_value( $item, $section );
		}

		$search = ( !empty( $item['control']['search'] ) ) ? '' : 'nosearch';
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		$multiple = ( !empty( $item['control']['multiple'] ) ) ? 'multiple="multiple"' : '';

		$args = ( !empty( $item['control']['function_args'] ) ) ? $item['control']['function_args'] : array();
		$options = $item['control']['options'];

		if( $options == 'function' ) {
			$args = ( !empty( $item['control']['function_args'] ) ) ? $item['control']['function_args'] : array();
			if( is_string( $item['control']['function'] ) ) {
				$options = call_user_func( $item['control']['function'], $args );
			}
			elseif( is_array( $item['control']['function'] ) ) {
				if( $item['control']['function'][0] == 'framework' ) {
					$options = call_user_func( array( $this->framework, $item['control']['function'][1] ), $args );
				}
				else {
					global $$item['control']['function'][0];
					$options = call_user_func( array( $$item['control']['function'][0], $item['control']['function'][1] ), $args );
				}
			}
		}

		?>
		<p class='<?php echo $search ?>'>
			<select class='chosen <?php echo $control_classes ?>' <?php echo $multiple ?> name="<?php echo $item['guid'] ?>">
				<?php

					if( !empty( $item['control']['initial'] ) ) {
						foreach( $item['control']['initial'] as $name => $value ) {
							$selected = ( $current_value == $value ) ? 'selected="selected"' : '';
							echo '<option ' . $selected . ' value="' . $value . '">' . $name . '</option>';
						}
					}

					if( !empty( $options ) ) {
						foreach( $options as $name => $value ) {
							$selected = ( $current_value == $value ) ? 'selected="selected"' : '';
							echo '<option ' . $selected . ' value="' . $value . '">' . $name . '</option>';
						}
					}

				?>
			</select>

			<?php if( !empty( $item['control']['default_label'] ) AND ( $current_value == 'default' OR empty( $current_value ) ) ) : ?>
				<p class='default-label'><?php echo $item['control']['default_label'] ?></p>
			<?php endif ?>

		</p>
		<?php
	}


	/** Layout Field
	 *
	 * A function for generating a layoutselect field. The type should be
	 * specified using the $item['control']['layout_type'] member of the array.
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_layout( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		$multiple = ( !empty( $item['control']['multiple'] ) ) ? 'multiple="multiple"' : '';
		$type = ( empty( $item['control']['layout_type'] ) ) ? 'post' : $item['control']['layout_type'];
		?>
		<p>
			<select class='chosen <?php echo $control_classes ?>' <?php echo $multiple ?> name="<?php echo $item['guid'] ?>">
				<?php
					$layouts = $this->framework->get_layouts_array( $type );
					if( !empty( $layouts ) ) {
						foreach( $layouts as $name => $value ) {
							$selected = ( $current_value == $value ) ? 'selected="selected"' : '';
							echo '<option ' . $selected . ' value="' . $value . '">' . $name . '</option>';
						}
					}

				?>
			</select>
		</p>
		<?php
	}


	/** Dual Boxes
	 *
	 * This control generates two boxes side-by-side which you can use
	 * to add multiple items to an option. It requires the dialboxes
	 * javascript plugin to work properly. Similarly to the select field,
	 * the options should be passed in the $item['control']['options']
	 * array.
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_dualboxes( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		global $post;

		$search = ( !empty( $item['control']['search'] ) ) ? '' : 'nosearch';
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		$multiple = ( !empty( $item['control']['multiple'] ) ) ? 'multiple="multiple"' : '';

		if( $item['control']['options'] == 'function' ) {
			$args = ( !empty( $item['control']['function_args'] ) ) ? $item['control']['function_args'] : array();
			if( is_string( $item['control']['function'] ) ) {
				$item['control']['options'] = call_user_func( $item['control']['function'], $args );
			}
			elseif( is_array( $item['control']['function'] ) ) {
				if( $item['control']['function'][0] == 'framework' ) {
					$item['control']['options'] = call_user_func( array( $this->framework, $item['control']['function'][1] ), $args );
				}
				else {
					global $$item['control']['function'][0];
					$item['control']['options'] = call_user_func( array( $$item['control']['function'][0], $item['control']['function'][1] ), $args );
				}
			}
		}

		$options = array( 'available' => array(), 'selected' => array() );
		foreach( $item['control']['options'] as $name => $value ) {
			if( !empty( $current_value ) AND in_array( $value, $current_value ) ) {
				$options['selected'][$name] = $value;
			}
			else {
				$options['available'][$name] = $value;
			}
		}
	?>
        <div class="rowElem dualBoxes">
			<p class='halfwidth w40'>
                <input type="text" id="box1Filter" class="boxFilter" placeholder="Filter entries..." /><button type="button" id="box1Clear" class="dualBtn fltr">x</button><br />

                <select id="box1View" multiple="multiple" class="multiple" style="height:300px;">
	                <?php foreach( $options['available'] as $name => $value ) : ?>
	                	<option value="<?php echo $value ?>"><?php echo $name ?></option>
	                <?php endforeach ?>
                </select>
                <br/>
                <span id="box1Counter" class="countLabel"></span>

                <div class="displayNone"><select id="box1Storage"></select></div>
            </p>

            <div class="dualControl">
                <button id="to2" type="button" class="dualBtn mr5 mb15">&nbsp;&gt;&nbsp;</button>
                <button id="allTo2" type="button" class="dualBtn">&nbsp;&gt;&gt;&nbsp;</button><br />
                <button id="to1" type="button" class="dualBtn mr5">&nbsp;&lt;&nbsp;</button>
                <button id="allTo1" type="button" class="dualBtn">&nbsp;&lt;&lt;&nbsp;</button>
            </div>

            <p class="halfwidth last w40">
                <input type="text" id="box2Filter" class="boxFilter" placeholder="Filter entries..." /><button type="button" id="box2Clear" class="dualBtn fltr">x</button><br />
                <select id="box2View" name="<?php echo $item['guid'] ?>[]" multiple="multiple" class="multiple" style="height:300px;">
	                <?php foreach( $options['selected'] as $name => $value ) : ?>
	                	<option value="<?php echo $value ?>"><?php echo $name ?></option>
	                <?php endforeach ?>

                </select><br/>
                <span id="box2Counter" class="countLabel"></span>

                <div class="displayNone"><select id="box2Storage"></select></div>
            </p>
            <div class="fix"></div>
       </div>

		<?php
	}

	/** Image Selector
	 *
	 * This control can be used when modifying post meta. It pulls
	 * all the attachments for the current post and enables the user
	 * to select/deselect any image. The selected images are stored as an
	 * array. It requires the eb-controls.js javascript file to work.
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_image_selector( $item, $section ) {
		global $post;
		$current_value = $this->get_control_value( $item, $section );
		$args = array(
			'post_type' => 'attachment',
			'post_status' => 'all',
			'post_parent' => $post->ID,
			'posts_per_page' => -1,
		);
		$images = new WP_Query( $args );
	?>

        <?php
        if( $images->have_posts() ) {
       		echo '<div class="rowElem image-selector">';
        	while( $images->have_posts() ) {
        		$images->the_post();
        		$image = wp_get_attachment_image_src( get_the_ID(), 'eb_thumb' );
        		$selected = ( in_array( get_the_ID(), explode( ',', $current_value ) ) ) ? 'selected' : '';
        		$text = ( $selected == 'selected' ) ? 'deselect' : 'select';
        		echo '
        			<div class="image ' . $selected . '" data-id="' . get_the_ID() . '">
        				<img src="' . $image[0] . '">
        				<div class="select-container"><span class="select"><div class="select-icon"></div> <span class="select-text">click to ' . $text . '</span></span></div>
        			</div>';
        	}

        	echo '<input type="hidden" name="' . $item['guid'] . '" value="' . $current_value . '">';
           	echo '</div>';
        }
        else {
        	echo 'Please upload images to this post. You will be able to select/deselect these images for use here';
        }
        ?>
		<?php
	}

	/** Font Selector
	 *
	 * This control is used to select fonts. It uses the Google Web Fonts
	 * API to work properly, so you must add your Google Web Fonts API
	 * details to the config. See the config file or the config.sample.php
	 * file in the samples directory for details.
	 *
	 * A font name, a font type and a fallback list can be added. To set
	 * the default for each use the $item['control']['defaults'] array,
	 * see the defailts.sample.php file in the samples directory for
	 * details.
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_font( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		?>
		<div class='control-subgroups'>
			<div class='control-subgroup'>
				<p>
					<label>Font Name</label>
					<select class='chosen <?php echo $control_classes ?>' name="<?php echo $item['guid'] ?>[name]">
						<?php

							$fonts = $this->framework->get_fonts_array();
							if( !empty( $fonts ) ) {
								foreach( $fonts as $name => $value ) {
									$selected = ( $current_value['name'] == $value ) ? 'selected="selected"' : '';
									echo '<option ' . $selected . ' value="' . $value . '">' . $name . '</option>';
								}
							}

						?>
					</select>
				</p>
				<p class='nosearch'>
					<?php $types = array( 'Serif', 'Sans-serif', 'Cursive', 'Monotype' ) ?>
					<label>Font Type</label>
					<select class='chosen' name="<?php echo $item['guid'] ?>[type]">
						<?php
							foreach( $types as $type ) :
								$selected = ( $current_value['type'] == $type ) ? 'selected="selected"' : '';
						?>
						<option <?php echo $selected ?> value='<?php echo $type ?>'><?php echo $type ?></option>
						<?php endforeach ?>
					</select>
				</p>
				<p>
					<label>Fallback Fonts</label>
					<input type='text' name="<?php echo $item['guid'] ?>[fallback]" value='<?php echo $current_value['fallback'] ?>'>
				</p>
			</div>
		</div>
		<?php
	}




	/** Checkbox
	 *
	 * Generates a simple checkbox
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_checkbox( $item, $section, $current_value = '' ) {
		if( $current_value == '' ) {
			$current_value = $this->get_control_value( $item, $section );
		}
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		foreach( $item['control']['boxes'] as $name => $value ) {
			$checked = ( $current_value == $value OR ( empty( $current_value ) AND $item['control']['default'] == 'yes' ) ) ? 'checked="checked"' : '';
			?>
			<p>
				<input class='<?php echo $control_classes ?>'  id='<?php echo $section['guid'] . '-' . $item['guid'] ?>' <?php echo $checked ?> type='checkbox' name='<?php echo $item['guid'] ?>' value='<?php echo $value ?>'>
				<?php if( empty( $item['control']['show_label'] ) OR ( !empty( $item['control']['show_label'] ) AND $item['control']['show_label'] == 'yes' ) ) : ?>
					<label for="<?php echo $section['guid'] . '-' . $item['guid'] ?>"><?php echo $name ?></label>
				<?php endif ?>

				<br>
			</p>
			<?php
		}

	}



	/** Radio Button
	 *
	 * Generates a simple radio button
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */
	function control_radio( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		foreach( $item['control']['boxes'] as $name => $value ) {
			$checked = ( $current_value == $value ) ? 'checked="checked"' : '';
			?>
			<p>
				<input class='<?php echo $control_classes ?>'  id='<?php echo $section['guid'] . '-' . $item['guid'] ?>' <?php echo $checked ?> type='radio' name='<?php echo $item['guid'] ?>' value='<?php echo $value ?>'> <label for="<?php echo $section['guid'] . '-' . $item['guid'] ?>"><?php echo $name ?></label> <br>
			</p>
			<?php
		}

	}

	function control_product_page_content( $item, $section ) {
		global $post;

		$current_value = $this->get_control_value( $item, $section );
		if( empty( $current_value ) ){
			$current_value = array(
				0 => array(
					'left' => array(),
					'right' => array()
				)
			);
		}


		$value = serialize( $current_value );
		$value = str_replace( '"', '&quot;', $value );


		$cats = get_terms( 'eb_product_category' );

		if( empty( $cats ) ) {
			echo 'You must add some product categories before creating a product list page';
		}

		else {
			$categories = array();
			foreach( $cats as $key => $cat ) {
				$categories[$cat->term_id] = $cat;
			}

			echo '<input class="structure" type="text" name="' . $item['guid'] . '" value="' . $value . '">';

			echo '<div class="category-data">';
			foreach( $categories as $category ) {
				echo '<div class="category" data-id="'.$category->term_id.'">';
					echo '<div class="category-title">' . $category->name . ' <span class="remove">remove</span></div>';
					echo '<div class="content">';
						$temp_post = $post;
						$args = array(
							'post_type' => 'eb_product',
							'posts_per_page' => 5,
							'tax_query' => array(
								array(
									'taxonomy' => 'eb_product_category',
									'field' => 'id',
									'terms' => $category->term_id
								)
							)
						);
						$products = new WP_Query( $args );
						while( $products->have_posts() ) {
							$products->the_post();
							echo '<div class="product">';
								echo '<div class="image">';
								the_post_thumbnail('eb_thumb');
								echo '</div>';
								echo '<h4 class="title">';
								the_title();
								echo '</h4>';
							echo '</div>';
						}
						$post = $temp_post;

						if( $products->found_posts > 5 ) {
							echo '<div class="more"> ' . ( $products->found_posts - 5 ) . ' more </div>';
						}
					echo '</div>'; // content


				echo '</div>'; // category

			}
			echo '</div>';

			echo '<div class="product-page-pagination">';

			foreach( $current_value as $page => $data ) {
				$current = ( $page == 0 ) ? 'current' : '';
				echo '<span class="page-link ' . $current . '">' . ( $page + 1 ) . '</span> ';
			}
				echo '<span class="add_page">+ new</span>';
				echo '<div class="clear"></div>';
			echo '</div>';

			echo '<div class="new-category-container">';
			echo '<div class="new-category">';
				echo '<select class="chosen chzn-drop-up">';
					echo '<option value="">-- Select a Category --</option>';
					if( !empty( $categories ) ) {
						foreach( $categories as $category ) {
							echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
						}
					}
				echo '</select>';
			echo '</div>';
			echo '</div>';

			echo '<div class="product-page-content">';
				foreach( $current_value as $page => $data ) {
					echo '<div class="page">';
						echo '<div class="delete-page-container"><span class="delete-page">delete page</span></div>';
						echo '<div class="page-side left">';
							echo '<div class="sortable">';
							if( !empty( $data['left'] ) ) {
								foreach( $data['left'] as $term_id ) {
									echo '<div class="category" data-id="' . $term_id . '">';
										echo '<div class="category-title">' . $categories[$term_id]->name . ' <span class="remove">remove</span></div>';
										echo '<div class="content">';
											$temp_post = $post;
											$args = array(
												'post_type' => 'eb_product',
												'posts_per_page' => 5,
												'tax_query' => array(
													array(
														'taxonomy' => 'eb_product_category',
														'field' => 'id',
														'terms' => $term_id
													)
												)
											);
											$products = new WP_Query( $args );
											while( $products->have_posts() ) {
												$products->the_post();
												echo '<div class="product">';
													echo '<div class="image">';
													the_post_thumbnail('eb_thumb');
													echo '</div>';
													echo '<h4 class="title">';
													the_title();
													echo '</h4>';
												echo '</div>';
											}
											$post = $temp_post;

											if( $products->found_posts > 5 ) {
												echo '<div class="more"> ' . ( $products->found_posts - 5 ) . ' more </div>';
											}
										echo '</div>'; // content


									echo '</div>'; // category
								}
							}
							echo '</div>'; // sortable

							echo '<span class="button-primary add">+ add category</span>';

						echo '</div>'; // left


						echo '<div class="page-side right">';
							echo '<div class="sortable">';
							if( !empty( $data['right'] ) ) {
								foreach( $data['right'] as $term_id ) {
									echo '<div class="category" data-id="' . $term_id . '">';
										echo '<div class="category-title">' . $categories[$term_id]->name . ' <span class="remove">remove</span></div>';
										echo '<div class="content">';
											$temp_post = $post;
											$args = array(
												'post_type' => 'eb_product',
												'posts_per_page' => 5,
												'tax_query' => array(
													array(
														'taxonomy' => 'eb_product_category',
														'field' => 'id',
														'terms' => $term_id
													)
												)
											);
											$products = new WP_Query( $args );
											while( $products->have_posts() ) {
												$products->the_post();
												echo '<div class="product">';
													echo '<div class="image">';
													the_post_thumbnail('eb_thumb');
													echo '</div>';
													echo '<h4 class="title">';
													the_title();
													echo '</h4>';
												echo '</div>';
											}
											$post = $temp_post;
											if( $products->found_posts > 5 ) {
												echo '<div class="more"> ' . ( $products->found_posts - 5 ) . ' more </div>';
											}

										echo '</div>';


									echo '</div>';
								}
							}
							echo '</div>'; // sortable
							echo '<span class="button-primary add">+ add category</span>';

						echo '</div>'; // right
						echo '<div class="clear"></div>';
					echo '</div>'; // page
				}
			echo '</div>'; // product-page-content;
		}
	}

	/** Text Input
	 *
	 * Generates a simple text input
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 * @uses get_control_value()
	 *
	 */
	function control_text( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		?>

		<p>
			<input class='<?php echo $control_classes ?>' type='text' name='<?php echo $item['guid'] ?>' value="<?php echo $current_value ?>">
			<?php if( !empty( $item['control']['help'] ) ) : ?>
				<br><small class='inline-help'><?php echo $item['control']['help'] ?> </small>
			<?php endif ?>
		</p>
		<?php

	}

	function control_price( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		$currency_position = $this->framework->options['currency_position'];
		?>

		<p class='price-field'>
			<span class='input'>
			<?php if( $currency_position == 'before' ) : ?>
				<span class='currency-symbol before'><?php echo $this->framework->options['currency_symbol'] ?></span>
			<?php endif ?>
			<input class='amount <?php echo $currency_position ?> <?php echo $control_classes ?>' type='text' name='<?php echo $item['guid'] ?>' value="<?php echo $current_value ?>">

			<?php if( $currency_position == 'after' ) : ?>
				<span class='currency-symbol after'><?php echo $this->framework->options['currency_symbol'] ?></span>
			<?php endif ?>
			</span>
		</p>
		<?php

	}


	/** Textarea
	 *
	 * Generates a simple textarea
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 * @uses get_control_value()
	 *
	 */
	function control_textarea( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		?>
		<p>
			<textarea class='<?php echo $control_classes ?>' name='<?php echo $item['guid'] ?>'><?php echo $current_value ?></textarea>
		</p>
		<?php

	}

	/** Tag Input
	 *
	 * Generates a tag input box. This enables to user to add multiple 'tag-like'
	 * words or phrases into a box. When he presses enter a box will be shown
	 * around the tag, making this very visually distinctive. The tagsinput
	 * javascript plugin must be available for this to work properly
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 * @uses get_control_value()
	 *
	 */
	function control_tagsinput( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		?>
		<p class='tagsinput-container'>
			<input  type='text' class='tagsinput <?php echo $control_classes ?>' name='<?php echo $item['guid'] ?>' value="<?php echo $current_value ?>" placeholder='Add Custom Sidebars' >
		</p>
		<?php

	}

	/** Colorpicker
	 *
	 * Creates a text input field with a colored background, matching the
	 * selected color. When clicked, a colorwheel is displayed. Uses
	 * The built-in colorpicker for WordPress (Farbtastic).
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 * @uses get_control_value()
	 *
	 */

	function control_colorpicker( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		?>
		<p>
			<input type='text' class='color <?php echo $control_classes ?>' id='<?php echo $item['guid'] ?>' name='<?php echo $item['guid'] ?>' value='<?php echo $current_value ?>'>
		</p>
		<?php

	}


	/** Theme Options Reset
	 *
	 * A link to reset the theme options to the default setting
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 */

	function control_reset( $item, $section ) {
		$reset_link = wp_nonce_url( admin_url( 'admin-ajax.php?action=action_reset_options' ) , 'elderberry_reset_options' );
		?>
		<p>
			If you click on the link below all the options will reset to the factory
			default settings. Note that this action can not be reversed, you will need
			to set up your theme options again if you want them to differ from the defaults.
		</p>

		<p>

			<a href="<?php echo $reset_link ?>">Click here to reset theme options</a>
		</p>
		<?php

	}



	/** File Uploader
	 *
	 * Creates a no-hassle upload experience. The user clicks the button,
	 * selects an image and that's it. The image is upoaded to the uplaods
	 * folder and added as an attachment (unattached). Once this happens, the
	 * image is shown via AJAX, and the setting is saved.
	 *
	 * The iframe-transport and fileupload plugins must be available for this
	 * to work properly.
	 *
	 * @param array $item The details of the item
	 * @param mixed $section The details of the item's containing section
	 *
	 * @uses get_control_value()
	 *
	 */
	function control_upload( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		$thumb = (( is_numeric( $current_value ) ) )
			? wp_get_attachment_image_src( $current_value, 'rf_admin_thumb' )
			: array( $current_value );
		$hidden_image = ( empty( $thumb[0] ) ) ? 'hidden' : '';
		$control_classes = ( !empty( $item['control']['classes'] ) ) ? $item['control']['classes'] : '';
		?>
		<div class='upload-container <?php echo $control_classes ?>'>
			<div class='image <?php echo $hidden_image ?>'>
				<img src='<?php echo $thumb[0] ?>'>

				<a href='' data-option='<?php echo $item['guid'] ?>' data-datatype='<?php echo $this->type ?>' class='remove-image'>x remove image</a>

			</div>

			<span class='upload-button button-secondary'>

				<?php
					if( $this->type == 'widget' ) {
						$string = $item['guid'];
						preg_match('/\[([0-9]+)\]/', $string, $matches);
						if( empty( $matches[1] ) ) {
							$upload_id = rand(100,300);
						}
						else {
							$upload_id = $matches[1];
						}
						$pos = strpos( $item['guid'], '[' );
						$upload_name = substr( $item['guid'], 0, $pos ) . '_' . $upload_id;
					}
					else {
						$upload_name = $item['guid'];
					}

				?>

				<input type='file' class='upload' data-datatype='<?php echo $this->type ?>' id='upload-<?php echo $upload_name ?>' name='upload-<?php echo $upload_name ?>' data-hidden_field='<?php echo $item['guid'] ?>' />

				<input type='hidden' name='<?php echo $item['guid'] ?>' value='<?php echo $current_value ?>'>
				+ Upload a File
			</span>

			<div class='loader hidden'></div>

		</div>
		<?php

	}

	function control_page_settings( $item, $section ) {
		$current_value = $this->get_control_value( $item, $section );
		if( empty( $current_value ) ) {
			$current_value = array(
				'sidebar' => '',
				'show_sidebar' => '',
				'sidebar_position' => '',
				'boxed_content' => '',
				'boxed_comments' => '',
				'show_title' => '',
				'show_content' => '',
				'show_breadcrumb' => '',
			);
		}

	?>
		<div class='control-subgroups'>
			<div class='control-subgroup inline-label'>

				<?php if( !empty( $current_value['sidebar'] ) ) : ?>
				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Sidebar to Show</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array(
							'guid' => $item['guid'] . '[sidebar]',
							'control' => array(
								'type' => 'select',
								'options' => $this->framework->get_sidebars_array(),
								'search' => false,
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Default Sidebar to Show',
							'help'  => 'Select which sidebar you would like to show on all pages, except where a different one is specified.'
						);
						$this->control_select( $subitem, $section, $current_value['sidebar'] );
					?>
					</div>
					<div class='clear'></div>
				</div>
				<?php endif ?>

				<?php if( !empty( $current_value['sidebar_position'] ) ) : ?>

				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Sidebar Position</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array(
							'guid' => $item['guid'] . '[sidebar_position]',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Left' => 'left',
									'Right' => 'right',
								),
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'search' => false,
								'default' => 'default',
								'allow_empty' => false
							),
							'label' => 'Default Sidebar Position',
							'help'  => 'Select the default location of the sidebar'
						);
						$this->control_select( $subitem, $section, $current_value['sidebar_position'] );
					?>
					</div>
					<div class='clear'></div>
				</div>
				<?php endif ?>

				<?php if( !empty( $current_value['show_sidebar'] ) ) : ?>
				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Show Sidebar?</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array (
							'guid' => $item['guid'] . '[show_sidebar]',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'default' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show the sidebar by default?',
							'help'  => 'Disable the sidebar, except on pages where otherwise specified '
						);
						$this->control_select( $subitem, $section, $current_value['show_sidebar'] );


					?>
					</div>
					<div class='clear'></div>
				</div>
				<?php endif ?>


				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Show Title?</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array (
							'guid' => $item['guid'] . '[show_title]',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'default' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show page title by default?',
							'help'  => 'Select weather or not you want to show the page title in this page type by default'
						);
						$this->control_select( $subitem, $section, $current_value['show_title'] );


					?>
					</div>
					<div class='clear'></div>
				</div>

				<?php if( !empty( $item['control']['default']['show_content'] ) ) : ?>

				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Show Content?</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array (
							'guid' => $item['guid'] . '[show_content]',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'default' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show page content by default?',
							'help'  => 'Select weather or not you want to show the content of this page by default'
						);
						$this->control_select( $subitem, $section, $current_value['show_content'] );


					?>
					</div>
					<div class='clear'></div>
				</div>

				<?php endif ?>

				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Show Featured Image?</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array (
							'guid' => $item['guid'] . '[show_thumbnail]',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'default' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show featured image by default?',
							'help'  => 'Select weather or not you want to show the featured image of this page by default'
						);
						$this->control_select( $subitem, $section, $current_value['show_thumbnail'] );


					?>
					</div>
					<div class='clear'></div>
				</div>

				<?php if( !empty( $item['control']['default']['boxed_content'] ) ) : ?>
				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Boxed Content?</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array (
							'guid' => $item['guid'] . '[boxed_content]',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'default' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Box content by default?',
							'help'  => 'Select weather or not you want to box the content in this page type by default'
						);
						$this->control_select( $subitem, $section, $current_value['boxed_content'] );


					?>
					</div>
					<div class='clear'></div>
				</div>
				<?php endif ?>
				<?php if( !empty( $item['control']['default']['boxed_comments'] ) ) : ?>
				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Boxed Comments?</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array (
							'guid' => $item['guid'] . '[boxed_comments]',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'default' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Box comments by default?',
							'help'  => 'Select weather or not you want to box the comments in this page type by default'
						);
						$this->control_select( $subitem, $section, $current_value['boxed_comments'] );


					?>
					</div>
					<div class='clear'></div>
				</div>
				<?php endif ?>



				<?php if( !empty( $item['control']['default']['show_breadcrumb'] ) ) : ?>
				<div class='control-subgroup-item-container'>
					<label class='control-subgroup-item-label'>Show Breadcrumb?</label>
					<div class='control-subgroup-item'>
					<?php
						$subitem = array (
							'guid' => $item['guid'] . '[show_breadcrumb]',
							'control' => array(
								'type' => 'select',
								'options' => array(
									'Yes' => 'yes',
									'No' => 'no',
								),
								'initial' => array(
									'-- Global Default --' => 'default',
								),
								'default' => 'default',
								'allow_empty' => false,
							),
							'label' => 'Show breadcrumb by default?',
							'help'  => 'Select weather or not you want to show the breadcrumb in this page type by default'
						);
						$this->control_select( $subitem, $section, $current_value['show_breadcrumb'] );


					?>
					</div>
					<div class='clear'></div>
				</div>
				<?php endif ?>


				<div class='line'></div>

			</div>
		</div>
	<?php
	}

	/***********************************************/
	/*        Image Uploading and Removing         */
	/***********************************************/

	/** File Upload Script
	 *
	 * A file must be passed to this function ( from the
	 * $_FILES array ) and it will be uploaded and added as
	 * an attachment.
	 *
	 * @param array $file The details of the file
	 * @param integer $attach_to The post to attach the image to
	 *
	 * @return integer $attach_id The ID of the uploaded attachment
	 *
	 */
	function upload_file( $file, $attach_to = 0 ) {
		$upload = wp_upload_bits( $file['name'], null, file_get_contents( $file['tmp_name'] ) );
		$wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
		$wp_upload_dir = wp_upload_dir();
		$attachment = array(
			'guid' => $wp_upload_dir['baseurl'] . _wp_relative_upload_path( $upload['file'] ),
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment( $attachment, $upload['file'], $attach_to );

		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		return $attach_id;
	}

	/** Upload User Action
	 *
	 * The upload action initiated by a user via AJAX. The file is
	 * uploaded, it's details retrieved and returned.
	 *
	 */
	function action_upload() {

		$attach_id = $this->upload_file( $_FILES[$_POST['name']] );

		$thumb = wp_get_attachment_image_src( $attach_id, 'rf_admin_thumb' );

		$option_name = str_replace( 'upload-', '', $_POST['name'] );

		$image_data['attachment_id'] = $attach_id;
		$image_data['thumb'] = $thumb[0];
		$image_data['option'] = $option_name;
		$image_data['field'] = $_POST['field'];
		$image_data['datatype'] = $_POST['datatype'];
		$this->framework->update_option( $option_name, $attach_id );

		echo json_encode( $image_data );

		die();
	}

	/** Image Remove Action
	 *
	 * Removes an image by removing it from the theme options
	 *
	 */
	function action_remove_image() {
		$this->framework->delete_option( $_POST['option'] );
		die();
	}




}


?>