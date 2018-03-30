<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/** ---------------------------------------------------------------------------
 * Import Demo Data
 * @author SeventhQueen
 * @version 1.0
 * ---------------------------------------------------------------------------- */
class kleoImport {

	public $error	= '';
	public $slug	= 'kleo_import';
	
	/** ---------------------------------------------------------------------------
	 * Constructor
	 * ---------------------------------------------------------------------------- */
	function __construct() {
		add_action( 'admin_menu', array( &$this, 'init' ) );
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Add theme Page
	 * ---------------------------------------------------------------------------- */
	function init() {
		add_theme_page(
			esc_html__( 'Theme Demo Data', 'buddyapp' ),
			esc_html__( 'Theme Demo Data', 'buddyapp' ),
			'edit_theme_options',
			$this->slug,
			array( &$this, 'import' )
		);
		wp_enqueue_script( 'kleo.import', KLEO_LIB_URI . '/importer/import.js', false, time(), true );

	}
	
	
	/** ---------------------------------------------------------------------------
	 * Import | Content
	 * ---------------------------------------------------------------------------- */
	function import_content( $file = 'all.xml.gz' ){
		$import = new SQ_Import();
		$xml = KLEO_LIB_DIR . '/importer/demo/'. $file;
		
		$import->fetch_attachments = ( $_POST && array_key_exists('attachments', $_POST) && $_POST['attachments'] ) ? true : false;
		
		ob_start();
		$import->import( $xml );	
		ob_end_clean();
	}

	/** ---------------------------------------------------------------------------
	 * Import | Menu - Locations 
	 * ---------------------------------------------------------------------------- */
	function import_menu_location(){

		$data = array(
            'primary' => 'side',
            'top-left' => 'header-icons',
        );
		$menus = wp_get_nav_menus();

		foreach( $data as $key => $val ){
			foreach( $menus as $menu ){
				if( $menu->slug == $val ){
					$data[$key] = absint( $menu->term_id );
				}
			}
		}
		set_theme_mod( 'nav_menu_locations', $data );
	}
	

	
	/** ---------------------------------------------------------------------------
	 * Import | Widgets
	 * ---------------------------------------------------------------------------- */
	function import_widget(){

        //add any extra sidebars
        $sidebars_file_path 	= KLEO_LIB_URI . '/importer/demo/sidebar_data.txt';
        $sidebars_file_data 	= wp_remote_get( $sidebars_file_path );
        $sidebars_data 		= unserialize( $sidebars_file_data['body'] );
        $old_sidebars = get_option( 'sbg_sidebars' );
        if ( !empty( $old_sidebars ) ) {
            $sidebars_data = array_merge( $sidebars_data, $old_sidebars );
        }
        update_option( 'sbg_sidebars', $sidebars_data );

        //widgets
        $file_path 	= KLEO_LIB_URI . '/importer/demo/widget_data.json';
        $file_data 	= wp_remote_get( $file_path );
        $data 		= $file_data['body'];
		$this->import_widget_data( $data );
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Import
	 * ---------------------------------------------------------------------------- */
	function import(){

		global $wpdb;

		$importer_not_active = '<div class="error settings-error">' .
				'<p><strong>In order to use our 1 Click install please go to Plugins page and ' .
				'<a href="'. admin_url('plugin-install.php?tab=search&s=wordpress+importer') .'">install WordPress Importer</a>.' .
				'</strong></p>' .
				'</div>';

		if( array_key_exists( 'kleo_import_nonce',$_POST ) ) {
			if ( wp_verify_nonce( $_POST['kleo_import_nonce'], basename(__FILE__) ) ){
	
				// Importer classes
				if( ! defined( 'WP_LOAD_IMPORTERS' ) ) define( 'WP_LOAD_IMPORTERS', true );

				require_once KLEO_LIB_DIR . '/importer/sq-import.php';
				
				if( class_exists( 'WP_Importer' ) && class_exists( 'SQ_Import' ) ) {
					
					switch( $_POST['import'] ) {
						
						case 'all':
							// Full Demo Data ---------------------------------
							$this->import_content();
							$this->import_menu_location();
							$this->import_widget();

							// set home & blog page
							$home = get_page_by_title( 'Dashboard' );
							$blog = get_page_by_title( 'News' );
							if( $home->ID && $blog->ID ) {
								update_option('show_on_front', 'page');
								update_option('page_on_front', $home->ID); // Front Page
								update_option('page_for_posts', $blog->ID); // Blog Page
							}
							break;

                        case 'content':
							if( $_POST['content'] ){
								$_POST['content'] = htmlspecialchars( stripslashes( $_POST['content'] ) );
								$file = 'content/'. $_POST['content'] .'.xml.gz';
								$this->import_content( $file );

                                if ( $_POST['content'] == 'pages' ) {
                                    // set home & blog page
                                    $home = get_page_by_title( 'Dashboard' );
                                    $blog = get_page_by_title( 'News' );
                                    if( $home->ID && $blog->ID ) {
                                        update_option('show_on_front', 'page');
                                        update_option('page_on_front', $home->ID); // Front Page
                                        update_option('page_for_posts', $blog->ID); // Blog Page
                                    }
                                }

							} else {
								$this->import_content();
							}
							break;
							
						case 'page':
							// page ---------------------------------------
							$_POST['page'] = htmlspecialchars( stripslashes( $_POST['page'] ) );
							$file = 'pages/'. $_POST['page'] .'.xml.gz';
							$this->import_content( $file );
							break;
							
						case 'menu':
							// Menu -------------------------------------------
							$this->import_content( 'menu.xml.gz' );
							$this->import_menu_location();
							break;

						case 'widgets':
							// Widgets ----------------------------------------
							$this->import_widget();
							break;

                        default:
							// Empty select.import
							$this->error = esc_html__('Please select data to import.','buddyapp');
							break;
					}
					
					// message box
					if( $this->error ){
						echo '<div class="error settings-error">';
							echo '<p><strong>'. $this->error .'</strong></p>';
						echo '</div>';
					} else {
						echo '<div class="updated settings-error">';
							echo '<p><strong>'. esc_html__('Import successful. Have fun!','buddyapp') .'</strong></p>';
						echo '</div>';
					}

				} else {
					echo $importer_not_active;
				}
	
			}
		}

		?>
		<div id="kleo-wrapper" class="kleo-import wrap">
		
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<?php
			if ( ! is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ) {
				echo $importer_not_active;
				return;
			}
			?>

            <h3 style="margin-bottom: 0;">Please read:</h3>
            <p>
                - Don't do the import twice since <strong>it will duplicate all your content</strong>.<br>
                - Importing Widgets will remove any existing widgets assigned to your sidebars.<br>
                - Importing All the demo content will take some time so be patient. A better option is to import by content type or just what pages you need.<br>
                - <strong>Not all images are imported</strong> so you need to add your own.
            </p>

	
			<form action="<?php echo admin_url( 'themes.php?page=' . $this->slug . '&import' );?>" method="post">
				
				<input type="hidden" name="kleo_import_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
				
				<table class="form-table">
				
					<tr class="row-import">
						<th scope="row">
							<label for="import">Import</label>
						</th>
						<td>
							<select name="import" class="import">
								<option value="">-- Select --</option>
								<option data-attach="yes" value="all">All content</option>
                                <option value="content">By content type</option>
								<option value="page">Specific Page</option>
								<option value="widgets">Widgets</option>
                                <option value="menu">Menu</option>
							</select>
						</td>
					</tr>
					
					<tr class="row-content hide hidden">
						<th scope="row">
							<label for="content">Content</label>
						</th>
						<td>
							<select name="content">
								<option value="">-- All --</option>
								<option value="pages">Pages</option>
								<option value="posts">Posts</option>
								<option value="to-do">To-do</option>
								<option value="cf7">Contact Forms</option>
								<option value="kb">Knowledge base</option>
								<option value="events">Events</option>
								<option value="charts">Charts</option>
							</select>
						</td>
					</tr>
					
					<tr class="row-homepage hide hidden">
						<th scope="row">
							<label for="page">Homepage</label>
						</th>
						<td>
							<select name="page">
								<option value="dashboard">Dashboard</option>
								<option value="home-shop" data-attach="yes">Home Shop</option>
								<option value="login">Login Page</option>
								<option value="kb">Knowledge Base</option>
								<option value="my-tasks">My Tasks</option>
								<option value="manage-tasks">Manage Tasks</option>
								<option value="submit-report">Submit Report</option>

							</select>
						</td>
					</tr>
					
					<tr class="row-attachments hide hidden">
						<th scope="row">Attachments</th>
						<td>
							<fieldset>
								<label for="attachments"><input type="checkbox" value="1" id="attachments" name="attachments">Import attachments</label>
								<p class="description">Download all attachments from the demo may take a while. Please be patient.</p>
							</fieldset>
						</td>
					</tr>
				
				</table>
	
				<input type="submit" name="submit" class="button button-primary" value="Import demo data" />
					
			</form>
	
		</div>	
		<?php	
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Parse JSON import file
     * @param $json_data
	 * http://wordpress.org/plugins/widget-settings-importexport/
	 * ---------------------------------------------------------------------------- */
	function import_widget_data( $json_data ) {

		$json_data 		= json_decode( $json_data, true );
		$sidebar_data 	= $json_data[0];
		$widget_data 	= $json_data[1];
 		//print_r($sidebar_data);exit;
	
		// prepare widgets table
		$widgets = array();
		foreach( $widget_data as $k_w => $widget_type ){
			if( $k_w ){
				$widgets[ $k_w ] = array();
				foreach( $widget_type as $k_wt => $widget ){
					if( is_int( $k_wt ) ) $widgets[$k_w][$k_wt] = 1;
				}
			}
		}
// 		print_r($widgets);

		// sidebars
		foreach ( $sidebar_data as $title => $sidebar ) {
			$count = count( $sidebar );
			for ( $i = 0; $i < $count; $i++ ) {
				$widget = array( );
				$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
				$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
				if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
					unset( $sidebar_data[$title][$i] );
				}
			}
			$sidebar_data[$title] = array_values( $sidebar_data[$title] );
		}
	
		// widgets
		foreach ( $widgets as $widget_title => $widget_value ) {
			foreach ( $widget_value as $widget_key => $widget_value ) {
				$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
			}
		}
// 		print_r($sidebar_data);
		
		$sidebar_data = array( array_filter( $sidebar_data ), $widgets );
		$this->parse_import_data( $sidebar_data );
	}
	
	/** ---------------------------------------------------------------------------
	 * Import widgets
	 * http://wordpress.org/plugins/widget-settings-importexport/
	 * ---------------------------------------------------------------------------- */
	function parse_import_data( $import_array ) {
		$sidebars_data 		= $import_array[0];
		$widget_data 		= $import_array[1];

        $current_sidebars 	= get_option( 'sidebars_widgets' );
		$new_widgets 		= array( );

// 		print_r($sidebars_data);
// 		print_r($current_sidebars);

        foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

            $current_sidebars[$import_sidebar] = array();

            foreach ( $import_widgets as $import_widget ) :
                //if the sidebar exists
                if ( isset( $current_sidebars[$import_sidebar] ) ) :

                    $title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
                    $index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
                    $current_widget_data = get_option( 'widget_' . $title );
                    $new_widget_name = self::get_new_widget_name( $title, $index );
                    $new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );
                    if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
                        while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
                            $new_index++;
                        }
                    }
                    $current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
                    if ( array_key_exists( $title, $new_widgets ) ) {
                        $new_widgets[$title][$new_index] = $widget_data[$title][$index];
                        $multiwidget = $new_widgets[$title]['_multiwidget'];
                        unset( $new_widgets[$title]['_multiwidget'] );
                        $new_widgets[$title]['_multiwidget'] = $multiwidget;
                    } else {
                        $current_widget_data[$new_index] = $widget_data[$title][$index];
                        $current_multiwidget = isset( $current_widget_data['_multiwidget'] ) ? $current_widget_data['_multiwidget'] : '' ;
                        $new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
                        $multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
                        unset( $current_widget_data['_multiwidget'] );
                        $current_widget_data['_multiwidget'] = $multiwidget;
                        $new_widgets[$title] = $current_widget_data;
                    }
                endif;
            endforeach;
        endforeach;
        if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
            update_option( 'sidebars_widgets', $current_sidebars );
            foreach ( $new_widgets as $title => $content ) {
                $content = apply_filters( 'widget_data_import', $content, $title );
                update_option( 'widget_' . $title, $content );
            }
            return true;
        }
        return false;
	}
	
	
	/** ---------------------------------------------------------------------------
	 * Get new widget name
	 * http://wordpress.org/plugins/widget-settings-importexport/
	 * ---------------------------------------------------------------------------- */
	function get_new_widget_name( $widget_name, $widget_index ) {
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}
	
}

$kleo_import = new kleoImport;