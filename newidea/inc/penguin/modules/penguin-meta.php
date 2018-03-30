<?php 
	/**
	Penguin Framework - PenguinMeta
	
	Copyright: (c) 2009-2015 ThemeFocus.

	@url http://penguin.themefocus.co
	@package Penguin
	@version 4.0
**/

class PenguinMeta {
	
	public $metas = array();
	
	/**
	 *  Create PenguinModuleCustomPost 
	 */
	function PenguinMeta($metas){
		
		foreach($metas as $meta){
			array_push($this->metas, new PenguinMetaPage($meta) );
		}
		
		if(count($metas) > 0){
			add_action( 'add_meta_boxes', array($this, 'custom_fields') );
			add_action( 'admin_print_styles-post-new.php', array( $this, 'enqueue' ) );
			add_action( 'admin_print_styles-post.php', array( $this, 'enqueue' ) );
			add_action( 'admin_print_styles-edit.php', array( $this, 'enqueue' ) );
			add_action( 'save_post', array($this,'save_fields' ));
		}
	}
	
	// custom fields
	function custom_fields() {
		foreach($this->metas as $meta){
			add_meta_box($meta->id.'_'.$meta->type, 	
							$meta->title, $meta->callback, 
							$meta->type, $meta->context, 
							$meta->priority);
		}
	}
	
	// enqueue styles and scripts needed for the custom meta.
	function enqueue(){
		global $post_type;
		
		$load_assets = false;
		foreach($this->metas as $meta){
			if($meta->type == $post_type){
				$load_assets = true;
				break;
			}
		}
		
		if(!$load_assets){return;}
		
		$ver = Penguin::$FRAMEWORK_VERSION;
		
		//get template directory url
		$dir = get_template_directory_uri();
		
		//style
		wp_enqueue_style( 'fontawesome', $dir . '/fontawesome/css/font-awesome.min.css' , array() , $ver );
		wp_enqueue_style( 'colorpick', $dir . Penguin::$FRAMEWORK_PATH . '/style/colorpicker.css' , array() , $ver );
		wp_enqueue_style( 'penguin-meta', $dir . Penguin::$FRAMEWORK_PATH . '/style/penguin-meta.css' , array() , $ver );
		if ( is_rtl() ) {
			wp_enqueue_style( 'penguin_rtl', $dir . Penguin::$FRAMEWORK_PATH . '/style/rtl-meta.css' , array() , $ver );
		}
		
		//scripts
		wp_enqueue_script( 'jquery');
		wp_enqueue_media();
		wp_enqueue_script( 'colorpick', $dir . Penguin::$FRAMEWORK_PATH . '/scripts/colorpicker.js' , array('jquery'), $ver, true);
		wp_enqueue_script( 'jquery.dragsort', $dir . Penguin::$FRAMEWORK_PATH . '/scripts/jquery.dragsort-0.5.1.min.js' , array('jquery'), $ver, true);
		wp_enqueue_script( 'penguin-meta', $dir . Penguin::$FRAMEWORK_PATH . '/scripts/penguin-meta.js' , array('jquery'), $ver, true);
	}
	
	//save fields data
	function save_fields($post_id) {
		
		foreach($this->metas as $meta){
			$slug = $meta->type;
			/* check whether anything should be done */
			$_POST += array("{$slug}_edit_nonce" => '');
			if ( $slug != Penguin::check_key_value('post_type',$_POST) ) {
				continue;
			}
			// check use can edit post
			if ( !current_user_can( 'edit_post', $post_id ) ) {
				continue;
			}
			
			foreach($meta->fields as $field){
				switch($field['type']){
					case 'checkbox':
						$value = $_REQUEST[$field['name']];
						if($value != "on"){ $value = "off";}
						update_post_meta($post_id, $field['name'], $value);
						break;
					default:
						if (isset($_REQUEST[$field['name']])) {
							update_post_meta($post_id, $field['name'], $_REQUEST[$field['name']]);
						}
				}
			}
		}
		
	}
}

class PenguinMetaPage {
	
	public $id;
	public $type;
	public $title;
	public $callback;
	public $context;
	public $priority;
	
	public $page_elements;// all elements
	public $fields = array();// for save data
	public $custom_data;
	
	function PenguinMetaPage($page_obj = array()) {
		
		$this->id				=	$page_obj['id'];
		$this->type				=	$page_obj['type'];
		$this->title			=	$page_obj['title'];
		$this->context			= Penguin::check_key_value('context' , $page_obj , 'normal');
		$this->priority			= Penguin::check_key_value('priority' , $page_obj , 'default');
		$this->callback			= Penguin::check_key_value('callback' , $page_obj , array($this , 'show'));
		$this->page_elements	=	Penguin::check_key_value('page_elements' , $page_obj , array());
		
		foreach($this->page_elements as $elements){
			foreach($elements['fields'] as $element){
				array_push($this->fields, array('name'=>$element['name'],'type'=>$element['type']));
			}
		}
		
	}
	
	function show($post){
		
		$this->custom_data = get_post_custom($post->ID);
		?>
        <div class="penguin-meta-container">
        <?php
		if(count($this->page_elements) == 0){
			echo __(Penguin::$FRAMEWORK_MSG[16],Penguin::$THEME_NAME);
		}else if(count($this->page_elements) > 1){
			$this->getPageTabs();
		}
		$this->getPageContent();
		?>
        </div>
        <?php
	}
	
	//show tabs
	function getPageTabs(){
		?>
		<ul class="penguin-meta-tabs">
		  <?php
            foreach($this->page_elements as $elements){
                echo '<li><a href="#'.$elements['id'].'"><i class="fa '.$elements['icon'].'"></i>'.__($elements['title'],Penguin::$THEME_NAME).'</a></li>';
            }
          ?>
		</ul>
        <?php
	}
	
	function getPageContent(){
		foreach($this->page_elements as $elements){
			echo '<div id="'.$elements['id'].'" class="penguin-meta-content">';
			
				foreach($elements['fields'] as $element){
					$template 	= '';
					$postformat = '';
					
					if(isset($element['template'])){
						$template = 'penguin-check';
						$template_list = explode(' ',$element['template']);
						foreach($template_list as $template_item){
							$template .= ' penguin-template-'.$template_item;
						}
					}
					
					if(isset($element['postformat'])){
						$postformat = 'penguin-postformat penguin-postformat-'.$element['postformat'];
					}
					
					
					if(isset($element['enable-element']) && isset($element['enable-id']) && isset($element['enable-group'])){
					?>
						<div class="penguin-meta-element penguin-enable-element <?php echo $template;?> <?php echo $postformat;?>" data-id="<?php echo $element['enable-id'];?>" data-group="<?php echo $element['enable-group'];?>"><div class="penguin-meta-element-title">
                    <?php
					}else if(isset($element['enabled-id']) && isset($element['enable-group'])){
					?>
						<div class="penguin-meta-element <?php echo $element['enabled-id'].' '.$element['enable-group']; ?> <?php echo $template;?> <?php echo $postformat;?>"><div class="penguin-meta-element-title"><i class="fa fa-circle-o"></i>
                    <?php
					}else{
						echo '<div class="penguin-meta-element '.$template.' '.$postformat.'"><div class="penguin-meta-element-title">';
					}
					echo __($element['title'],Penguin::$THEME_NAME);
					if(isset($element['desc']) != ''){
						echo '<div class="penguin-meta-desc-content">'.__($element['desc'],Penguin::$THEME_NAME).'</div>';
					}
					
					echo '</div><div class="penguin-meta-element-content">';
					switch($element['type']){
						case 'color': $this->addColor($element);break;
						case 'select': 
							$this->addSelect($element);break;
						case 'selectname': 
							if($element['options'] == 'wp_registered_sidebars'){
								global $wp_registered_sidebars;
								$sidebars = $wp_registered_sidebars;
								$element['options'] = array();
								if(is_array($sidebars) && !empty($sidebars)){
									foreach($sidebars as $sidebar){
										$element['options'][$sidebar['name']] = $sidebar['name'];
									}
								}
							}
							$this->addSelectName($element);break;
						case 'textarea': $this->addTextArea($element);break;
						case 'upload': $this->addUploadElement($element);break;
						case 'pc': $this->addPenguinCheckbox($element);break;
						case 'radio': $this->addRadio($element);break;
						case 'number': $this->addInputElement($element,true);break;
						case 'custom': $this->addCustomField($element,true);break;
						case 'gallery': $this->addGallery($element,true);break;
						default;
							 $this->addInputElement($element);
					}	
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
		}
	}
	
	//add input element
	function addInputElement($item, $bool = false){
	?>
        <input type="<?php echo $bool ? "number" : "text"; ?>" name="<?php echo $item['name']; ?>" value="<?php echo esc_attr($this->getDefaultData($item)); ?>">
    <?php
	}
	
	// add color type element
	function addColor($item) {
		$current_data = $this->getDefaultData($item);
		if($current_data == ""){$current_data = '333333';}
		?>
        <div class="penguin-color-picker"><b style="background-color: #<?php echo $current_data; ?>"></b><span>#<?php echo $current_data; ?></span></div>
        <input name="<?php echo $item['name']; ?>" type="hidden" value="<?php echo esc_attr($current_data); ?>" >
        <?php
	}
	
	// add select type element
	function addSelect($item) {
		$current_data = $this->getDefaultData($item);
	?>
		<select id="<?php echo $item['name']; ?>" name="<?php echo $item['name']; ?>" class="penguin-select" >
	<?php
		if(Penguin::check_key_value('option_array',$item) != ""){
			$array = explode("|",$item['option_array']);
			$item['options'] = array(Penguin::check_key_value('default_option',$item));
			if(count($array) > 0){
				$item['options'] = array_merge($item['options'] ,$array);
			}
		}
		
		foreach($item['options'] as $key => $option){
			if($option == ""){ continue; }
	?>
			<option value="<?php echo $key; ?>" <?php echo intval($current_data) == $key ? " selected='selected'" : " " ?> > <?php echo esc_html(__($option,Penguin::$THEME_NAME)); ?> </option>
	<?php
		}
		
	?>
		</select>
	<?php
	}
	
	// add select sidebar by nameelement
	function addSelectName($item) {
		$current_data = $this->getDefaultData($item);
	?>
		<select id="<?php echo $item['name']; ?>" name="<?php echo $item['name']; ?>" class="penguin-select" >
	<?php
		foreach($item['options'] as $option){
			if($option == ""){ continue; }
	?>
			<option value="<?php echo esc_attr(__($option,Penguin::$THEME_NAME)); ?>" <?php echo $current_data == $option ? " selected='selected'" : " " ?> > <?php echo esc_html(__($option,Penguin::$THEME_NAME)); ?> </option>
	<?php
		}
	?>
		</select>
	<?php
	}
	
	// add textarea element
	function addTextArea($item) {
		if(isset($item['codetype'])){
	?>
		<textarea class="penguin-meta-textarea penguin-codetype" name="<?php echo$item['name']; ?>" ><?php echo esc_textarea($this->getDefaultData($item)); ?></textarea>
    <?php
		}else{
	?>
    	<textarea class="penguin-meta-textarea" name="<?php echo$item['name']; ?>" ><?php echo esc_textarea($this->getDefaultData($item)); ?></textarea>
    <?php
		}
	}
	
	// add upload type element
	function addUploadElement($item){
		$current_data = $this->getDefaultData($item);
		$img_data = explode('<|>',$current_data);
		$img_url = '';
		if(count($img_data) > 0 && isset($img_data[0])){
			$img_url = $img_data[0];
		}
	?>
        <div>
        	<input id="<?php echo $item['name']; ?>" name="<?php echo $item['name']; ?>" value="<?php echo esc_html($current_data); ?>" class="penguin-input-text upload-image-input no-id" type="text">
        	<a class="penguin-input-button upload-image-button" href="#"><i class="fa fa-upload fa-lg"></i> <?php echo __(Penguin::$FRAMEWORK_MSG[15],Penguin::$THEME_NAME); ?></a>
        	<a class="penguin-input-button remove-image-button" href="#"><i class="fa fa-trash-o fa-lg"></i></a>
        </div>
        <div class="penguin-preview-image">
        <?php if($img_url != ""){ ?>
        	<img class="penguin-preview-image-img" src="<?php echo esc_url($img_url); ?>" alt="image">
        <?php } ?>
        </div>
	<?php
	}
	
	
	
	// add penguin checkbox type element
	function addPenguinCheckbox($item){
		$current_data = $this->getDefaultData($item);
	?>
        <input type="hidden" id="<?php echo $item['name']; ?>" name="<?php echo $item['name']; ?>" value="<?php echo ($current_data == "on") ? "on" : "off" ?>" >
        <div class="penguin-checkbox <?php echo ($current_data == "on") ? "select" : "" ?>" data-id="<?php echo $item['name']; ?>"></div>
    <?php
	}
	
	// add radio type element
	function addRadio($item) {
		$k = 0;
		foreach($item['radios'] as $radio){
			?>
            <label class="penguin-radio"><input type="radio" name="<?php echo $item['name']; ?>" class="penguin-input-radio" value="<?php echo $k; ?>" <?php checked($k, intval($this->getDefaultData($item))); ?>><?php echo esc_html($radio); ?></label>
			<?php
			$k++;
		}
	}
	
	// add custom field element
	function addCustomField($item) {
		$current_data = $this->getDefaultData($item);
		$fields_count	= count($item['fileds']);
		if($fields_count < 2){	
			echo __(Penguin::$FRAMEWORK_MSG[19],Penguin::$THEME_NAME);
			return;	
		}
		
	?>
    	<div class="penguin-custom-fileds <?php echo 'penguin-custom-fileds-count-'.$fields_count; ?>">
        	<div class="penguin-custom-elements">
            	<ul class="penguin-custom-fileds-name">
                <?php
					
					foreach($item['fileds'] as $filed){
						echo '<li class="penguin-custom-element-filed-name"><label>'.$filed.'</label></li>';
					}
           		?>
            	</ul>
                <?php
				$lists = explode("{|}",$current_data);
				if(count($lists) > 0){
				foreach($lists as $list_item){
					if($list_item == "") {continue;}
					$fileds = explode("[|]",$list_item);
				?>
                    <ul class="penguin-custom-element">
                    <?php
						$field_count = 0;
                        foreach($fileds as $field){
							if($field_count >= $fields_count){break;}
                            echo '<li class="penguin-custom-element-filed"><input type="text" value="'.esc_html($field).'"></li>';
							$field_count++;
                        }
						echo '<li class="penguin-custom-element-filed-btn"><a class="penguin-input-button penguin-delete-button" href="#"><i class="fa fa-minus"></i></a></li>';
                    ?>
                    </ul>
                <?php
				}}
				?>
            </div>
        	<div class="penguin-custom-btns">
            	<a class="penguin-input-button penguin-add-button" href="#"><i class="fa fa-plus fa-lg"></i> <?php echo Penguin::$FRAMEWORK_MSG[17]; ?></a>
        		<a class="penguin-input-button penguin-delete-button" href="#"><i class="fa fa-trash-o fa-lg"></i> <?php echo Penguin::$FRAMEWORK_MSG[18]; ?></a>
            </div>
            <textarea class="penguin-custom-fileds-textarea" name="<?php echo$item['name']; ?>"><?php echo esc_textarea($current_data); ?></textarea>
        </div>
    <?php
	}
	
	// add upload type element
	function addGallery($item){
		$current_data = $this->getDefaultData($item);	
	?>
    	<div class="penguin-gallery-container">
        	<ul class="penguin-gallery-elements">
        	<?php 
				$lists = explode("{|}",$current_data); 
				$count = 0;
                foreach($lists as $element){
					if($element == ""){continue;}
					
					$img_data = explode('<|>',$element);
					$img_url = '';
					if(count($img_data) > 0 && isset($img_data[0])){
						$img_url = $img_data[0];
					}
			?>
                <li class="penguin-gallery-element" >
                    <div>
                    	<span class="drag-image-button"><i class="fa fa-bars fa-lg"></i></span>
                        <input id="<?php echo $item['name'].'-'.$count; ?>" readonly="readonly" value="<?php echo esc_html($element); ?>" class="penguin-input-text upload-image-input" type="text">
                        <a class="penguin-input-button upload-image-button" href="#"><i class="fa fa-upload fa-lg"></i></a>
                        <a class="penguin-input-button edit-image-caption" href="#"><i class="fa fa-pencil"></i></a>
                        <a class="penguin-input-button remove-gallery-button" href="#"><i class="fa fa-trash-o fa-lg"></i></a>
                    </div>
                    <div class="penguin-preview-image">
                    <?php if($img_url != ""){ ?>
                        <img class="penguin-preview-image-img" src="<?php echo esc_url($img_url); ?>" alt="image">
                    <?php } ?>
                    </div>
                </li>
            <?php 
					$count++;
				} 
			?>
            </ul>
            
        	<div class="penguin-custom-btns">
            	<a class="penguin-input-button penguin-add-button" href="#"><i class="fa fa-plus fa-lg"></i> <?php echo __(Penguin::$FRAMEWORK_MSG[20],Penguin::$THEME_NAME); ?></a>
        		<a class="penguin-input-button penguin-delete-button" href="#"><i class="fa fa-trash-o fa-lg"></i> <?php echo __(Penguin::$FRAMEWORK_MSG[18],Penguin::$THEME_NAME); ?></a>
            </div>
            <input id="<?php echo$item['name']; ?>" type="hidden" name="<?php echo$item['name']; ?>" value="<?php echo esc_html($current_data); ?>" >
        </div>  
	<?php
	}
	
	//get default custom data value
	function getDefaultData($item){
		$default_data = Penguin::check_key_value($item['name'],$this->custom_data);
		if($default_data != ''){
			return $default_data[0];
		}else if(isset($item['default'])){
			return $item['default'];
		}
		return '';
	}
	
}

?>