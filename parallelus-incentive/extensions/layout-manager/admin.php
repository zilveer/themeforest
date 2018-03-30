<?php 
global $layouts_manager, $layout_manager_admin, $form_builder;

if (IS_CHILD) {
	$layouts_manager->check_is_header_footer_rendered();
	$this->view('header-footer-error', false, array('header_err'=> $layouts_manager->header_err, 
													'footer_err'=> $layouts_manager->footer_err) );
}

// Beadcrumbs
$navText = array();
switch ($this->navigation) {
	case 'add-layout':
		$navText = array(__( 'Add Layout', 'framework' ));
		break;
	case 'edit-layout':
		$navText = array(__( 'Edit Layout', 'framework' ));
		break;
	case 'headers-list':
	case 'add-header':
	case 'edit-header':
		$navText = array(__( 'Headers', 'framework' ));
		break;
	case 'footers-list':
	case 'add-footer':
	case 'edit-footer':
		$navText = array(__( 'Footers', 'framework' ));
		break;
	case 'edit-options':
		if($_GET['option'] == 'headers')		
			$navText = array(__( 'Headers', 'framework' ));
		if($_GET['option'] == 'footers')		
			$navText = array(__( 'Footers', 'framework' ));
		if($_GET['option'] == 'other-options')		
			$navText = array(__( 'Layout Options', 'framework' ));
		break;
}  
$this->navigation_bar( $navText );

if(!in_array($this->navigation, array('add-layout', 'edit-layout', 'add-header', 'add-footer', 'edit-options'))): ?>
	<h2 class="nav-tab-wrapper tab-controlls" style="padding-top: 9px;">
		<a href="<?php echo $this->self_url(); ?>" class="nav-tab <?php if($this->navigation == '') {echo "nav-tab-active";} ?>"><?php _e('Layouts', 'framework') ?></a>
		<?php if(isset($layouts_manager->layouts_manager_options['settings']['headers']) ): ?>
			<a href="<?php echo $this->self_url('headers-list'); ?>" class="nav-tab <?php if($this->navigation == 'headers-list' || $this->navigation == 'edit-header') {echo "nav-tab-active";} ?>"><?php _e('Headers', 'framework') ?></a>
		<?php endif; ?>	
		<?php if(isset($layouts_manager->layouts_manager_options['settings']['footers']) ): ?>
			<a href="<?php echo $this->self_url('footers-list'); ?>" class="nav-tab <?php if($this->navigation == 'footers-list' || $this->navigation == 'edit-footer') {echo "nav-tab-active";} ?>"><?php _e('Footers', 'framework') ?></a>
		<?php endif; ?>	
		<?php if (IS_CHILD) : ?>
			<a href="<?php echo $this->self_url('settings'); ?>" class="nav-tab <?php if($this->navigation == 'settings') {echo "nav-tab-active";} ?>"><?php _e('Settings', 'framework') ?></a>						
			<?php if(isset($layouts_manager->layouts_manager_options['settings']['headers']) || 
					isset($layouts_manager->layouts_manager_options['settings']['footers']) || 
					isset($layouts_manager->layouts_manager_options['settings']['other-options'])
				): ?>
				<a href="<?php echo $this->self_url('options-list'); ?>" class="nav-tab <?php if($this->navigation == 'options-list') {echo "nav-tab-active";} ?>"><?php _e('Custom Fields', 'framework') ?></a>
			<?php endif; ?>
		<?php endif; ?>
	</h2>
	<?php
endif;

// Set the alias variable
$alias = isset($_REQUEST['alias']) ? $_REQUEST['alias'] : '';
$js_alias = ($alias) ? $alias : 'false';
if($alias != ''){
	$layout = $layouts_manager->get_layout($alias);
}
echo '<script type="text/javascript">layoutAlias = "'. $js_alias .'";</script>';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if($action != ''){
	switch ($action) {	

		case 'update-contexts':{
			$options = isset($_REQUEST['options']) ? $_REQUEST['options'] : '';
			if($options != ''){
				$layouts_manager->update_contexts($options);
			}
		} break; 

		case 'update-header':{
			$title = isset($_REQUEST['header-title']) ? $_REQUEST['header-title'] : '';
			$alias = isset($_REQUEST['old_alias']) ? $_REQUEST['old_alias'] : sanitize_title($_REQUEST['header-title']);			
			
			$custom_options = $form_builder->get_custom_options_vals('layout_header_'.$alias, true);

			if($title != '' && $alias != ''){
				$options = array(
					'title' => $title,
					'alias' => $alias,
					'custom_options' => $custom_options,
				);
				$layouts_manager->update_header($options);
			}
		} break;
		
		case 'delete-header':{
			$alias = isset($_REQUEST['alias']) ? sanitize_title($_REQUEST['alias']) : '';
			if($alias != ''){
				$layouts_manager->delete_header($alias);
			}
		} break;

		case 'delete-layout': {

			$layouts_manager->delete_layout($_REQUEST['alias']);

		} break;

		case 'update-footer':{
			$title = isset($_REQUEST['footer-title']) ? $_REQUEST['footer-title'] : '';
			$alias = isset($_REQUEST['old_alias']) ? $_REQUEST['old_alias'] : sanitize_title($_REQUEST['footer-title']);			
						
			$custom_options = $form_builder->get_custom_options_vals('layout_footer_'.$alias, true);

			if($title != '' && $alias != ''){
				$options = array(
					'title' => $title,
					'alias' => $alias,
					'custom_options' => $custom_options,					
				);
				$layouts_manager->update_footer($options);
			}
		} break;

		case 'delete-footer':{
			$alias = isset($_REQUEST['alias']) ? sanitize_title($_REQUEST['alias']) : '';
			if($alias != ''){
				$layouts_manager->delete_footer($alias);
			}
		} break;

		case 'update-settings':{
			if(!empty($_POST)){
				$layouts_manager->update_layout_settings($_POST);
				$link = home_url().'/wp-admin/themes.php?page=layout-manager&navigation=settings&action=update-settings';
    			$redirect = '<script type="text/javascript">window.location = "'.$link.'";</script>';
    			echo $redirect;
			}
		} break;

		default:{
			// nothing to do
		} break;
	}
}

?>

<div id="poststuff">

<?php

switch ($this->navigation) {
	case 'add-layout':{
		$headers = $layouts_manager->get_headers();
		$footers = $layouts_manager->get_footers();
		$skins   = $layout_manager_admin->get_skin_css();		

		$layout = array(
            'title' => __( 'New Layout', 'framework' ),
            'alias' => 'layout-' . time(),
        );

		require_once('views/add-edit-layout.php');
	} break;

	case 'edit-layout':{	
		
		// TODO: save other options us layout options

		$headers = $layouts_manager->get_headers();
		$footers = $layouts_manager->get_footers();
		$skins   = $layout_manager_admin->get_skin_css();

		$headers = stripslashes_deep($headers);
		$footers = stripslashes_deep($footers);

		require_once('views/add-edit-layout.php');
	} break;

	case 'headers-list':{
		$headers = $layouts_manager->get_headers();
		if(!empty($headers)){
			foreach($headers as $key => $values) {
				$values['title'] = stripslashes($values['title']);
				$headers[$key] = $values;
		    }
		}

		require_once('views/headers-list.php');
	} break;

	case 'add-header':{
		require_once('views/add-edit-header.php');
	} break;

	case 'edit-header':{
		$alias = isset($_REQUEST['alias']) ? $_REQUEST['alias'] : '';
		if($alias != ''){
			$header = $layouts_manager->get_header($alias);
			$header['title'] = stripslashes($header['title']);
		}
		require_once('views/add-edit-header.php');
	} break;

	case 'footers-list':{
		$footers = $layouts_manager->get_footers();
		if(!empty($footers)){
			foreach($footers as $key => $values) {
				$values['title'] = stripslashes($values['title']);
				$footers[$key] = $values;	
			}
		}
		
		require_once('views/footers-list.php');
	} break;	

	case 'add-footer':{
		require_once('views/add-edit-footer.php');
	} break;

	case 'edit-footer':{
		$alias = isset($_REQUEST['alias']) ? $_REQUEST['alias'] : '';
		if($alias != ''){
			$footer = $layouts_manager->get_footer($alias);
			$footer['title'] = stripslashes($footer['title']);
		}
		require_once('views/add-edit-footer.php');
	} break;

	case 'settings':{
		$this->view('settings', false, array('settings' => isset( $layouts_manager->layouts_manager_options['settings'] ) ? $layouts_manager->layouts_manager_options['settings'] : ''));
	} break;

	case 'edit-options':{		
		$this->view('edit-options');
	} break;

	case 'options-list':{
		$this->view('options-list');
	} break;

	default:{ 
		$layouts  = $layouts_manager->get_layouts();
		$contexts = $layouts_manager->get_contexts();
		require_once('views/layouts-list.php');
	}
}  

?>

</div> <!-- / #poststuff -->