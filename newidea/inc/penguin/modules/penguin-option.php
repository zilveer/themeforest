<?php
/**
	Penguin Framework

	Copyright (c) 2009-2015 ThemeFocus

	@url http://penguin.themefocus.co
	@package Penguin
	@version 4.0
**/

class PenguinOption {
	
	public $menus = array();
	
	public $back_page = '';
	
	public $page_title = '';
	
	public $page_key = '';
	/**
	 *
	 * @$option admin option data
	 */
	function PenguinOption($option){
		
		foreach($option as $item){
			$new_item = new PenguinOptionPage($item);
			array_push($this->menus, $new_item );
		}
		
		if (is_admin() && current_user_can('manage_options')){
			add_action( 'admin_menu' , array( $this , 'penguin_admin_menu'));
			add_action( 'admin_init', array($this , 'register_penguin_settings'));
		}
		add_action('admin_init',array($this , 'penguin_backoptions_after_theme_active'));
		add_action( 'admin_bar_menu', array( $this, "penguin_admin_bar_menu" ), 600);
	}
	
	// add menu,sub for option
	function penguin_admin_menu() {
		$hook;
		foreach($this->menus as $menu){
			if($menu->type == "menu"){
				
				if($menu->backpage){
					$this->back_page = $menu->menu_slug;
				}
				
				$this->page_title = $menu->menu_title;
				$this->page_key = $menu->option_name;
				
				$hook = add_menu_page(
							__($menu->page_title,Penguin::$THEME_NAME),
							__($menu->menu_title,Penguin::$THEME_NAME),
							$menu->capability,
							$menu->menu_slug,
							$menu->fun,
							$menu->icon_url,
							$menu->position); 
			}else if($menu->type == "submenu"){
				/* add submenu page */
				$hook = add_submenu_page(
							$menu->parent_slug,
							__($menu->page_title,Penguin::$THEME_NAME),
							__($menu->menu_title,Penguin::$THEME_NAME),
						 	$menu->capability,
							$menu->menu_slug,
						  	$menu->fun); 
			}
				
			add_action("admin_print_styles-$hook", array($this, 'on_load_styles'));
		}
	}
	
	/**
	 * add admin bar for top area
	 */
	function penguin_admin_bar_menu(){
		global $wp_admin_bar;
		  if ( ! is_super_admin() || ! is_admin_bar_showing() ){
			  return;
		  }
		  
		  foreach($this->menus as $menu){
			if($menu->type == "menu"){
				if($menu->admin_bar){
					$title = __($menu->page_title,Penguin::$THEME_NAME);
					if($menu->icon_url != ""){
						$title = '<img src="'.esc_url($menu->icon_url).'" alt="" style="float:'.(is_rtl() ? 'right' : 'left').';margin: 8px 3px 0;" >'.$title;
					}
					$wp_admin_bar->add_menu(array(
						'id'    => $menu->menu_slug,
						'title' => $title,
						'href'  => home_url('/wp-admin/admin.php?page='.$menu->menu_slug)
					) );
				}
			}
		  }
	}
	
	// back options page when after theme active
	function penguin_backoptions_after_theme_active(){
		global $pagenow;
		if($this->back_page != "" && is_admin() && $pagenow == "themes.php" && isset($_GET['activated'])){
			//setting default options value
			foreach($this->menus as $menu){
				if(isset($menu->default_property) && count($menu->default_property) > 0){
					$options = get_option($menu->option_name);
					if(!$options){
						update_option($menu->option_name,$menu->default_property);
					}
				}
			}
			header('Location: '.admin_url().'admin.php?page='.$this->back_page);
			exit;
		}
	}
	
	// register penguin setting
	function register_penguin_settings() {
		foreach($this->menus as $menu){
			$menu->register_penguin_settings();		
		}
	}
	
	// load page all scripts
	function on_load_styles() {
		$ver = Penguin::$FRAMEWORK_VERSION;
		//get template directory url
		$dir = get_template_directory_uri();
		
		//style
		wp_enqueue_style( 'fontawesome', $dir . '/fontawesome/css/font-awesome.min.css' , array() , $ver );
		wp_enqueue_style( 'colorpick', $dir . Penguin::$FRAMEWORK_PATH . '/style/colorpicker.css' , array() , $ver );
		wp_enqueue_style( 'codemirror',  $dir . Penguin::$FRAMEWORK_PATH . '/style/codemirror.css' , array() , $ver );
		wp_enqueue_style( 'penguin', $dir . Penguin::$FRAMEWORK_PATH . '/style/penguin.css' , array() , $ver );
		if ( is_rtl() ) {
			wp_enqueue_style( 'penguin_rtl', $dir . Penguin::$FRAMEWORK_PATH . '/style/rtl.css' , array() , $ver );
		}
		wp_enqueue_style( 'custom-font', '//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700');
		
		//scripts
		wp_enqueue_script( 'jquery');
		wp_enqueue_media();
		wp_enqueue_script( 'colorpick', $dir . Penguin::$FRAMEWORK_PATH . '/scripts/colorpicker.js' , array('jquery'), $ver, true);
		wp_enqueue_script( 'codemirror', $dir . Penguin::$FRAMEWORK_PATH . '/scripts/codemirror-compressed.js' , array('jquery'), $ver, true);
		wp_enqueue_script( 'jquery.dragsort', $dir . Penguin::$FRAMEWORK_PATH . '/scripts/jquery.dragsort-0.5.1.min.js' , array('jquery'), $ver, true);
		wp_enqueue_script( 'penguin', $dir . Penguin::$FRAMEWORK_PATH . '/scripts/penguin.js' , array('jquery'), $ver, true);
	}
}

class PenguinOptionPage {
	
	public $type; 				// menu type (menu,submenu)
	public $option_name; 		// option name for save data to mysql
	
	public $page_title;			// page title
	public $page_desc;			//page descriptions
	
	public $page_logo;			// page logo
	public $page_logo_url;	// page logo height max 50;
	
	public $menu_title;
	public $capability;
	public $menu_slug;
	public $fun;
	public $icon_url;
	public $position;
	public $parent_slug;
	
	public $pages_type;	// pages type for show content is custom or default
	public $pages;	// when pages_type == "custom" will include .php files, or  pages as array for show
	public $default_property = array();	// default all property for your option
	public $update_opt;
	public $serverlink	='';
	public $pid	='';
	public $notifier = '';
	public $update_history = '';
	public $versionXML = '';
	
	public $admin_bar;
	public $backpage = false;

	function PenguinOptionPage($page_obj = array()) {
		
		$this->type			= 	$page_obj['type'];
		$this->option_name	= 	$page_obj['option_name'];
		$this->page_desc	=   $page_obj['page_desc'];
		
		$this->page_logo	=   $page_obj['page_logo'];
		$this->page_logo_url	= Penguin::check_key_value('page_logo_url' , $page_obj , "");
		
		$this->page_title 	= 	Penguin::check_key_value('page_title' , $page_obj , "Penguin Option");;
		
		$this->menu_title	=	Penguin::check_key_value('menu_title' , $page_obj , "Penguin");
		$this->capability	= 	Penguin::check_key_value('capability' , $page_obj , "manage_options");
		$this->menu_slug	= 	Penguin::check_key_value('menu_slug' , $page_obj , "penguin_options_page");
		$this->fun			= 	Penguin::check_key_value('fun' , $page_obj , array($this , 'show'));
		$this->icon_url		= 	Penguin::check_key_value('icon_url' , $page_obj , "");
		$this->position		= 	Penguin::check_key_value('position' , $page_obj ,'100');
		$this->parent_slug	= 	Penguin::check_key_value('parent_slug' , $page_obj ,'');
		$this->pages_type	= 	Penguin::check_key_value('pages_type' , $page_obj ,'');
		$this->pages		= 	Penguin::check_key_value('pages' , $page_obj ,'');
		$this->serverlink		=	Penguin::check_key_value('link' , $page_obj ,'');
		$this->pid			=	Penguin::check_key_value('pid' , $page_obj ,'');
		$this->notifier		=	Penguin::check_key_value('notifier' , $page_obj ,'');
		$this->update_history		=	Penguin::check_key_value('update_history' , $page_obj ,'');
		$this->update_opt		=	Penguin::check_key_value('update_opt' , $page_obj ,'no');
		$this->admin_bar		=	Penguin::check_key_value('admin_bar' , $page_obj , false);
		$this->backpage			=	Penguin::check_key_value('backpage' , $page_obj , false);
		
		$this->default_property	=	Penguin::check_key_value('pages_default_property' , $page_obj , array());
		
		$this->addOptionProperty();
	}
	
	// if have no option then create it
	function addOptionProperty()
	{
		$option = get_option($this->option_name);
		if($option == null || is_string($option)){
			add_option($this->option_name,$this->default_property);
			if($this->update_opt == 'yes') add_option($this->option_name.'_update',array('update'=>'no','version'=>0));
		}
	}
	
	// register penguin setting for option submit
	function register_penguin_settings() {

		if($this->menu_slug != null) register_setting( $this->menu_slug, $this->option_name, array($this, 'validate_options'));
	}
	
	// refresh option value
	function validate_options($input) {
		
		if($this->update_opt == 'yes'){
			$options_update_name = $this->option_name.'_update';
			
			$options_update = get_option($options_update_name);
			$update_data;
			if(isset($options_update['update'])){
				$update_data = array('update'=>'no','version'=> $options_update['version'] );
			}else{
				$update_data = array('update'=>'no','version'=>0);
			}
			
			update_option($options_update_name,$update_data);
		}

		if(Penguin::check_key_value('resetting_default',$input) == "yes"){
			$this->default_property['resetting_default'] = "yes";
			return $this->default_property;
		}else if(isset($_POST['import_options']) && $_POST['import_options'] != ""){
			// import options data
			$import_data = json_decode(base64_decode($_POST['import_options']), true);
			if(!is_array($import_data)){
				$import_data = unserialize(base64_decode($_POST['import_options']));
			}
			return $import_data;
		}
		return $input;
	}
	
	// start show page
	function show() {
		if($this->pages_type == "custom"){
			if($this->pages != "") {
				include($this->pages);
			}else{
				echo Penguin::$FRAMEWORK_MSG[10];
			}
		} else {
			if($this->pages == null){
				echo Penguin::$FRAMEWORK_MSG[11];
			}else{
				global $penguin_options;
				$penguin_options = get_option($this->option_name);
				$this->showPageHtml();
			}
		}
	}
	
	// show page html code
	function showPageHtml() {
		global $penguin_options;
		$this->getThemeVersion();
		?>
			<div id="penguin-container">
            	<div id="penguin-header">
                	<div class="penguin-logo-container">
                        <div id="penguin-custom-logo">
                            <div>
                                <h3><a title="<?php echo $this->page_title; ?>" <?php echo ($this->page_logo_url != "") ? 'href="'.$this->page_logo_url.'"' : "";?>><?php echo $this->page_title; ?></a></h3>
                                <span><?php echo __($this->page_desc,Penguin::$THEME_NAME); ?></span>
                            </div>
                        </div>
                        <div id="penguin-logo">
                            <a title="<?php echo Penguin::$FRAMEWORK_MSG[3]; ?>" target="_blank" href="http://penguin.themefocus.co"><i class="fa fa-cogs"></i></a>
                            <div>
                                <h3><?php echo Penguin::$FRAMEWORK_MSG[3]; ?></h3>
                                <span><?php echo Penguin::$FRAMEWORK_MSG[4].' '.Penguin::$FRAMEWORK_VERSION; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="penguin-update-container">
                       	<div><span class="fa-stack"><i class="fa fa-bullhorn"></i></span><?php 
							if($this->versionXML != ""){
								$xml = $this->versionXML;
								$theme_data = wp_get_theme();
								if( version_compare($xml->latest, $theme_data['Version'], '>' )){
									echo __("Theme Version ",Penguin::$THEME_NAME).'{ <b>'.$xml->latest.'</b> }'.__(" available for update!",Penguin::$THEME_NAME);
								}else{
									echo __("You are using the latest version of the theme!",Penguin::$THEME_NAME);
								}
							}else{
								echo 'You can <a href="'.$this->update_history.'" target="_blank">click here</a> view theme update history!';
							}
						?>
                        </div>
                    </div>
                </div>
                
            	<div id="penguin-content">
                	<div class="penguin-bg"></div>
                    <div class="penguin-over"><i class="fa fa-refresh fa-spin"></i><h3><?php echo Penguin::$FRAMEWORK_MSG[3].' '.Penguin::$FRAMEWORK_VERSION; ?></h3></div>
                	<div class="penguin-tabs">
                       	<ul class="penguin-tabs-nav">
                        	<?php $this->getPageNav(); ?>
                        </ul>
                    	<div class="penguin-tabs-container">
            			<form id="penguin-options-form" method="post" action="options.php">
						<?php settings_fields( $this->menu_slug ); ?>
                        <?php if(isset($_GET['settings-updated']) && ($_GET['settings-updated'] == 'true')){ ?>
                            <div class="penguin-update-tip">
                                <div class="message">
                                    <div class="green-success-message"><div><i class="fa fa-check fa-lg"></i><?php echo (Penguin::check_key_value('resetting_default',$penguin_options) == "yes") ? __(Penguin::$FRAMEWORK_MSG[5],Penguin::$THEME_NAME) : __(Penguin::$FRAMEWORK_MSG[6],Penguin::$THEME_NAME); ?>
                                    </div></div>
                                    <a class="message-close-button" href="#"><i class="fa fa-times-circle"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                        <a id="penguin-options-save-top" class="penguin-input-button penguin-btn-save penguin-options-save" href="#"><i class="fa fa-cog fa-lg"></i> <?php echo __(Penguin::$FRAMEWORK_MSG[8],Penguin::$THEME_NAME); ?></a>
                        <?php $this->getPageContent(); ?>
                            <div class="penguin-page-end">
                                <div class="penguin-setting-back">
                                    <input id="<?php echo $this->option_name; ?>_resetting_default" name="<?php echo $this->option_name . '[resetting_default]'; ?>" class="penguin-input-checkbox" type="checkbox" value="yes" <?php checked('yes', 'no'); ?> >
                                    <span><?php echo __(Penguin::$FRAMEWORK_MSG[7],Penguin::$THEME_NAME); ?></span>
                                </div>
                                
                                <a id="penguin-options-save" class="penguin-input-button penguin-btn-save penguin-options-save" href="#"><i class="fa fa-cog fa-lg"></i> <?php echo __(Penguin::$FRAMEWORK_MSG[8],Penguin::$THEME_NAME); ?></a>
                                <div class="penguin-setting-tip"><?php echo __(Penguin::$FRAMEWORK_MSG[9],Penguin::$THEME_NAME); ?></div>
                            </div>
                        </form>
                    	</div>
                	</div>
            	</div>
             </div>
		<?php
	}
	
	// show page nav menu 
	function getPageNav() {
		foreach( $this->pages as $page ){
			?>
            <li <?php echo ' class="'.Penguin::check_key_value('class',$page).'" '; ?>><a<?php 
				if(array_key_exists('type',$page) &&  $page['type'] == "link"){
					echo ' data-type="link" href="'.$page['pagecontent'].'" target="_blank"';
				}
			 ?>><i class="fa <?php echo $page['icon']; ?>"></i><span><?php echo __($page['name'],Penguin::$THEME_NAME); ?></span><i class="fa fa-caret-<?php  if ( is_rtl() ) { echo 'left';}else{ echo 'right';}?>"></i></a></li>
            <?php
		}
	}
	
	// page content for options pages
	function getPageContent() {
		global $penguin_options;
		foreach( $this->pages as $page ){
		?>
            <div id="<?php echo "section_".$page['section'] ?>" class="penguin-tabs-content <?php 
				echo (Penguin::check_key_value('type',$page) == "custom" || Penguin::check_key_value('type',$page) == "import" || Penguin::check_key_value('type',$page) == "update") ? " penguin-custom-page" : "";?> "> 
                <h2 class="penguin-page-title"><?php echo __($page['title'],Penguin::$THEME_NAME); ?></h2>
					<?php 
						if(Penguin::check_key_value('type',$page) != ""){
							switch($page['type']){
								case "custom" : 
									if(Penguin::check_key_value('pagecontent',$page) != ""){ include($page['pagecontent']); }
									break;
								case "update" :
										$xml = $this->versionXML;
										if($xml == "") {break;}
										$theme_data = wp_get_theme();
										?>
										<div class="penguin-page-container">
                                        	<div class="penguin-table">
											<?php if( version_compare($xml->latest, $theme_data['Version'], '>' )) : ?>
                                            	<div class="message" style="float: left;width: 100%;margin-bottom: 20px;">
                                                    <div class="orange-caution-message">
                                                        <span class="orange-caution-icon"><h4>You have version <?php echo $theme_data['Version']; ?> installed. You can update to version <?php echo $xml->latest; ?>.</h4></span>
                                                    </div>
                                                </div>
											<?php endif; ?>
											<?php echo $xml->changelog; ?>
                                            </div>
										</div>
										<?php 
									break;
								case "import" :
									?>
                                    <div class="penguin-page-container penguin-import-options">
                                    	<h4 class="penguin-page-content-title"><?php echo __(Penguin::$FRAMEWORK_MSG[13],Penguin::$THEME_NAME); ?></h4>
										<div class="penguin-table">
                                        	<div class="penguin-table-tr">
                                            	<textarea class="penguin-textarea" name="import_options"></textarea>
                                                <a id="penguin-options-import" class="penguin-input-button" href="#"><i class="fa fa-random fa-lg"></i> <?php echo __(Penguin::$FRAMEWORK_MSG[13],Penguin::$THEME_NAME); ?></a>
                                            </div>
                                        </div>
                                     </div>
                                     
                                     <div class="penguin-page-container penguin-import-options">
                                        <h4 class="penguin-page-content-title"><?php echo __(Penguin::$FRAMEWORK_MSG[14],Penguin::$THEME_NAME); ?></h4>
                                        <div class="penguin-table">
                                            <div class="penguin-table-tr">
                                                 <textarea class="penguin-textarea" readonly><?php echo base64_encode(json_encode($penguin_options)) ?></textarea>
                                                 <p><?php echo __(Penguin::$FRAMEWORK_MSG[12],Penguin::$THEME_NAME); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
									break;
							}
							
						} else {
							foreach( $page['elements'] as $item ){
								?>
                                	<?php if(isset($item['enabled-id']) && isset($item['enable-group'])){ ?>
									<div class="penguin-page-container <?php echo $item['enabled-id'].' '.$item['enable-group']; ?>">
                                    <?php }else{ ?>
                                    <div class="penguin-page-container">
                                    <?php } ?>
										
										<h4 class="penguin-page-content-title"><?php echo __($item['title'],Penguin::$THEME_NAME); ?></h4>
										<div class="penguin-table">
										<?php 
											if($item['type'] == 'moreline' && Penguin::check_key_value('moreline',$item) != ''){
												foreach( $item['moreline'] as $subitem ){
													$this->addItemElement($subitem);
												}
											} else {
												$this->addItemElement($item);
											}
										?>       
										</div>      
									</div>
								<?php
							}
						}
                    ?>
            </div>
            <?php
		}
	}
	
	// get theme version
	function getThemeVersion(){
		if($this->notifier == "") return "";
		$theme_version_xml = get_option($this->option_name.'-update-xml-file');
		
		if($theme_version_xml && isset($theme_version_xml['date']) && isset($theme_version_xml['xml'])){
			if(intval(date('U')) - intval($theme_version_xml['date']) <= 14400){
				$this->versionXML = simplexml_load_string($theme_version_xml['xml']); 
				return;
			}
		}
		if( function_exists('simplexml_load_string') && function_exists('file_get_contents') ) {
			$notifier_file_url = $this->notifier;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			$cache = curl_exec( $ch );
			curl_close($ch);
			
			if(!isset($cache) || $cache == ""){ 
				$cache = '<notifier><latest>1.0.0</latest><changelog><![CDATA[<div class="message" style="float: left;width: 100%;margin-bottom: 20px;"><div class="orange-caution-message"><span class="orange-caution-icon"><h4>Load update history files failure.Please try again or check your net connect.</h4><p>You also can check update xml file online <a href="'.$this->update_history.'" target="_blank">'.$notifier_file_url.'</a></p></span></div></div>]]></changelog></notifier>';
			}
			
			$theme_version_xml['date'] = date('U');
			$theme_version_xml['xml'] = $cache;
			
			update_option($this->option_name.'-update-xml-file', $theme_version_xml);
			
			$this->versionXML = simplexml_load_string($cache); 
		}							
	}
	
	// add item for a page
	function addItemElement($item) {
		?>
        	 <?php 
			if(isset($item['enable-element']) && isset($item['enable-id']) && isset($item['enable-group'])){
			?>
            	<div class="penguin-table-tr penguin-enable-element " data-id="<?php echo $item['enable-id'];?>" data-group="<?php echo $item['enable-group'];?>"><div class="penguin-table-title">
            <?php
			}else if(isset($item['enabled-id']) && isset($item['enable-group'])){
			?>
            	<div class="penguin-table-tr <?php echo $item['enabled-id'].' '.$item['enable-group']; ?>"><div class="penguin-table-title"><i class="fa fa-circle-o"></i>
            <?php
			}else{
			?>
            	<div class="penguin-table-tr"><div class="penguin-table-title">
            <?php
			}
			?>
            <?php echo __($item['name'],Penguin::$THEME_NAME);
			if(Penguin::check_key_value('desc',$item) != ""){
			?>
            <div class="penguin-page-content-desc"><?php echo __($item['desc'],Penguin::$THEME_NAME); ?></div>
            <?php } ?>
            </div>
            <div class="penguin-table-content <?php echo isset($item['codetype']) ? "codetype" : "" ; ?>">
            <?php
               	echo Penguin::check_key_value('before',$item);
                switch($item['type'])
                {
                    case "upload":
                        $this->addUploadElement($item);
                        break;
                    case "input":
                        $this->addInputText($item);
                        break;
					case "number":
                        $this->addInputText($item,true);
                        break;
					case "checkbox":
						$this->addCheckbox($item);
						break;
					case "radio":
						$this->addRadio($item);
						break;
					case "radio_custom":
						$this->addRadioCustom($item);
						break;
					case "pi":
						$this->addPenguinImageRadio($item);
						break;
					case "textarea":
						$this->addTextArea($item);
						break;
					case "select":
						$this->addSelect($item);
						break;
					case "color":
						$this->addColor($item);
						break;
					case "pc":
					case "pe":
						$this->addPenguinCheckbox($item);
						break;
					case "drag":
						$this->addPenguinDrag($item);
						break;
					case "custom":
						if(Penguin::check_key_value('pagecontent',$item) != ""){ 
							include($item['pagecontent']);
						}
						break;
                }
                echo Penguin::check_key_value('after',$item);
            ?>
            </div>
            </div>
            <?php
	}
	
	// get current value,if have no will use default value
	function getCurrentValue($item){
		global $penguin_options;
		if(!isset($item['property'])){ return "";}
		
		// check had save into options
		if( isset($penguin_options[$item['property']])){return $penguin_options[$item['property']];}
		
		// get config item default value
		if( isset($item['default'])){return $item['default'];}
		
		// get default property array default value
		if(isset($this->default_property[$item['property']])){return $this->default_property[$item['property']];}
		
		return "";
	}
	
	// add upload type element
	function addUploadElement($item){
		global $penguin_options;
		?>
            <div style="width:100%;float:left;"><input id="<?php echo $this->option_name . $item['property'] ?>" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" value="<?php echo esc_url($this->getCurrentValue($item)); ?>" class="penguin-input-text upload-image-input" type="text">
            <a class="penguin-input-button upload-image-button" href="#"><i class="fa fa-upload fa-lg"></i> <?php echo __(Penguin::$FRAMEWORK_MSG[15],Penguin::$THEME_NAME); ?></a>
            <a class="penguin-input-button remove-image-button" href="#"><i class="fa fa-trash-o fa-lg"></i></a></div>
            <?php if(Penguin::check_key_value('show_thums',$item) == "yes" || Penguin::check_key_value('show_thums',$item) == "") { ?>
                <div class="penguin-preview-image">
                <?php if($this->getCurrentValue($item) != ""){ ?>
                <img class="penguin-preview-image-img" src="<?php echo esc_url($this->getCurrentValue($item)); ?>" alt="image">
                <?php } ?>
                </div>       
            <?php } ?>  
        <?php
	}
	
	// add text type element
	function addInputText($item,$bool = false){
		global $penguin_options;
		?>
			<input id="<?php echo $this->option_name . $item['property']; ?>" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" value="<?php echo esc_html($this->getCurrentValue($item)); ?>" class="penguin-input-text <?php echo $bool ? " penguin-input-text-number" : ""; ?>" type="<?php echo $bool ? "number" : "text"; ?>">
		<?php
	}
	
	// add checkbox type element
	function addCheckbox($item){
		global $penguin_options;
		?>
        	<label class="penguin-checkbox-container"><input id="<?php echo $this->option_name . $item['property']; ?>" name="<?php echo $this->option_name . '[' . $item['property'].']'; ?>" class="penguin-input-checkbox" type="checkbox" value="yes" <?php checked('yes', $this->getCurrentValue($item)); ?> ><?php echo esc_html($item['checkboxtitle']); ?></label>
        <?php
	}
	
	// add radio type element
	function addRadio($item) {
		global $penguin_options;
		$k = 0;
		foreach($item['radios'] as $radio){
			?>
            <label class="penguin-radio"><input type="radio" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" class="penguin-input-radio" value="<?php echo $k; ?>" <?php checked($k, intval($this->getCurrentValue($item))); ?>><?php echo esc_html($radio); ?></label>
			<?php
			$k++;
		}
	}
	
	// add radio type element
	function addRadioCustom($item) {
		global $penguin_options;
		$k = 0;
		foreach($item['radios'] as $radio){
			?>
            <label class="penguin-radio"><input type="radio" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" class="penguin-input-radio" value="<?php echo $k; ?>" <?php checked($k, intval($this->getCurrentValue($item))); ?>><?php echo $radio; ?></label>
			<?php
			$k++;
		}
	}
	
	// add textarea element
	function addTextArea($item) {
		global $penguin_options;
		if(isset($item['codetype'])){
		?>
            <textarea id="<?php echo $this->option_name . '[' . $item['property'] . ']';?>" class="penguin-textarea codemirror-element" data-type="<?php echo $item['codetype']; ?>" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" ><?php 
			if($this->getCurrentValue($item) == ""){
				switch($item['codetype']){
					case 'javascript' : echo '//input your custom javascript code';break;
					case 'css': echo '/*input your custom css code */';break;
				}
			}else{
				echo esc_textarea($this->getCurrentValue($item)); 
			}
			
			?></textarea>
        <?php 
		}else{
		?>
			<textarea class="penguin-textarea" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" ><?php echo esc_textarea($this->getCurrentValue($item)); ?></textarea>
        <?php
		}
	}
	
	// add select type element
	function addSelect($item) {
		global $penguin_options;
		
		?>
        	<select id="<?php echo $item['property']; ?>" name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" class="penguin-select" >
        <?php
			$k = 0;
			if(Penguin::check_key_value('option_array',$item) != ""){
				$array = explode("|",$item['option_array']);
				$item['options'] = array(Penguin::check_key_value('default_option',$item));
				if(count($array) > 0){
					$item['options'] = array_merge($item['options'] ,$array);
					foreach($item['options'] as $option){
						$option = str_replace("+"," ",$option);
					}
				}
			}
			
			foreach($item['options'] as $option){
				if($option == ""){ continue; }
		?>
                <option value="<?php echo $k; ?>" <?php echo intval($this->getCurrentValue($item)) == $k ? " selected='selected'" : " " ?> > <?php echo esc_html(__($option,Penguin::$THEME_NAME )); ?></option>
        <?php
				$k++;
			}
			
		?>
        	</select>
        <?php
		
	}
	
	// add color type element
	function addColor($item) {
		global $penguin_options;
		?>
        <div class="penguin-color-picker"><b style="background-color: #<?php echo $this->getCurrentValue($item); ?>;"></b><span>#<?php echo $this->getCurrentValue($item); ?></span></div>
        <input name="<?php echo $this->option_name . '[' . $item['property'] . ']'; ?>" type="hidden" value="<?php echo esc_attr($this->getCurrentValue($item)); ?>" >
        <?php
	}
	
	// add penguin checkbox type element
	function addPenguinCheckbox($item){
		global $penguin_options;
		?>
        <input type="hidden" id="<?php echo $this->option_name . $item['property']; ?>"  name="<?php echo $this->option_name . '[' . $item['property'].']'; ?>" value="<?php echo ($this->getCurrentValue($item) == "on") ? "on" : "off" ?>" >
        <div class="penguin-checkbox <?php echo ($this->getCurrentValue($item) == "on") ? "select" : "" ?>" data-id="<?php echo $this->option_name . $item['property']; ?>"></div>
        <?php
	}
	
	// add penguin radio type element
	function addPenguinImageRadio($item) {
		global $penguin_options;
		$k = 0;
		?>
        <div class="penguin-image-radios">
        <input type="hidden" id="<?php echo $this->option_name . $item['property']; ?>"  name="<?php echo $this->option_name . '[' . $item['property'].']'; ?>" value="<?php echo esc_attr($this->getCurrentValue($item)); ?>" >
        <?php
		foreach($item['radios'] as $radio){
			echo '<div class="penguin-image-radio '.($k == intval($this->getCurrentValue($item)) ? 'selected' : "").'" data-id="'.$k.'">';
			if(isset($radio[1]) && $radio[1] != ""){
			echo '<img src="'.esc_url($radio[1]).'" alt="">';
			}
			echo '<h5 >'.esc_attr($radio[0]).'</h5>';
			echo '</div>';
			$k++;
		}
		?>
        </div>
		<?php
	}
	
	// add penguin checkbox type element
	function addPenguinDrag($item){
		$current_value = $this->getCurrentValue($item);
		?>
       	<div class="penguin-drag-container">
        	<ul class="penguin-drag-elements">
            	<?php 
				$field_arr = array();
				$count = 0;
				if($current_value != ""){
					$lists = explode("|", $current_value); 
					foreach($lists as $list){
						$element = explode("-",$list); 
						$field_arr[] = array('index'=>$element[0], 'open'=> $element[1], 'name' => $item['fields'][intval($element[0])]['name'] );
						$count++;
					}
				}else{
					$field_arr = $item['fields'];
				}
				
				foreach($field_arr as $field){ 
				?>
            	<li class="penguin-drag-element" data-index="<?php echo $field['index']; ?>">
                	<div class="penguin-drag-btn"><i class="fa fa-bars fa-lg"></i></div>
                    <div class="penguin-drag-content"><?php _e($field['name'],Penguin::$THEME_NAME ); ?></div>
                    
                    <?php
						$count = 0;
						foreach($item['position'] as $position){
					?>
                    <div class="penguin-drag-check-position"><span class="penguin-drag-check <?php echo intval($field['open']) == $count ? "show" : "";?>"><i class="fa fa-check fa-lg"></i></span><?php _e($position,Penguin::$THEME_NAME ); ?></div>
                    <?php 
						$count++;
					} ?>
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" id="<?php echo $this->option_name . $item['property']; ?>"  name="<?php echo $this->option_name . '[' . $item['property'].']'; ?>" value="<?php echo esc_html($current_value); ?>" >
        </div>
        <?php
	}
	
}

?>