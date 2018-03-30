<?php
/**
 * Mtheme Interface
 *
 * Renders pages and options
 *
 * @class MthemeInterface
 * @author Mtheme
 */
 
class MthemeInterface {

	/** @var array Contains an array of messages. */
	public static $messages;

	/**
	 * Adds actions and filters
     *
     * @access public
     * @return void
     */
	public static function init() {
	
		//add options page
		add_action('admin_menu', array(__CLASS__,'addPage'));
		
		//render thickbox				
		add_action('admin_init', array(__CLASS__,'renderTB'));
		
		//render embed
		add_filter('embed_oembed_html', array(__CLASS__,'renderEmbed'), 99, 4 );
		
		//render footer				
		add_action('wp_footer', array(__CLASS__,'renderFooter'));
		
		//render comment form
		add_filter('comment_form_defaults', array(__CLASS__,'renderCommentForm'));
		
		//render user toolbar
		add_filter('show_admin_bar', array(__CLASS__,'renderToolbar'));
	}
	
	/**
	 * Renders thickbox page
     *
     * @access public
     * @return void
     */
	public static function renderTB() {
		if(isset($_GET['mtheme_uploader'])) {
			add_filter('media_upload_tabs', array(__CLASS__,'filterTBTabs'));
			add_filter('attachment_fields_to_edit', array(__CLASS__,'renderTBUploader'), 10, 2);
		}
	}	
	
	/**
	 * Filters thickbox tabs
     *
     * @access public
	 * @param array $tabs
     * @return array
     */
	public static function filterTBTabs($tabs) {
		unset($tabs['type_url'], $tabs['gallery']);
    	return $tabs;
	}	
	
	/**
	 * Filters thickbox uploader
     *
     * @access public
	 * @param array $fields
	 * @param object $post
     * @return array
     */
	public static function renderTBUploader($fields, $post) 
	{
		
		//save fields
		$filename=basename($post->guid);
		$attachment_id=$post->ID;
		$attachment['post_title']='';
		$attachment['url']=$fields['image_url']['value'];
		$attachment['post_excerpt']='';
		
		//unset fields
		unset($fields);
		
		//send button
		$send_button="<input type='submit' class='button' name='send[$attachment_id]' value='".__( 'Insert This Item' , 'mtheme' )."' />&nbsp;&nbsp;&nbsp;";
		$send_button.="<input type='radio' checked='checked' value='full' id='image-size-full-$attachment_id' name='attachments[$attachment_id][image-size]' style='display:none;' />";
		$send_button.="<input type='hidden' value='' name='attachments[$attachment_id][post_title]' id='attachments[$attachment_id][post_title]' />";
		$send_button.="<input type='hidden' value='$attachment[url]' class='mtheme_image_url' name='attachments[$attachment_id][url]' id='attachments[$attachment_id][url]' />";
		$send_button.="<input type='hidden' value='' name='attachments[$attachment_id][post_excerpt]' id='attachments[$attachment_id][post_excerpt]' />";
		$fields['buttons']=array( 'tr' => "\t\t<tr class='submit'><td></td><td class='savesend'>$send_button</td></tr>\n" );
		
		return $fields;
	}
	
	/**
	 * Renders embedded video
     *
     * @access public
	 * @param string $html
     * @return string
     */
	public static function renderEmbed($html) {
		return '<div class="embedded-video">'.$html.'</div>';
	}
	
	/**
	 * Filter embedded video
     *
     * @access public
	 * @param string $content
     * @return string
     */
	public static function filterEmbed($url) {
		$html=wp_oembed_get($url[0]);	
		if($html) {
			$html=apply_filters('embed_oembed_html', $html);
		} else {
			$html=$url[0];
		}
		
		return $html;
	}
	
	/**
	 * Adds options page to menu
     *
     * @access public
     * @return void
     */
	public static function addPage() {
		add_theme_page(__('Theme Options','mtheme'), __('Theme Options','mtheme'), 'administrator', 'theme-options', array(__CLASS__,'renderPage'));
	}
	
	/**
	 * Renders options page
     *
     * @access public
     * @return void
     */
	public static function renderPage() {	
		include(MTHEME_PATH.'templates/index.php');		
	}
	
	
	/**
	 * Renders options page menu
     *
     * @access public
     * @return void
     */
	public static function renderMenu() {
		
		$out='<ul>';	
		
		foreach(MthemeCore::$options as $option) {
			if($option['type']=='section') {
				$out.='<li><a href="#'.mtheme_sanitize_key($option['name']).'">'.$option['name'].'</a></li>';
			}			
		}		
		
		$out.='</ul>';
		
		echo mtheme_html($out);	
	}
	
	/**
	 * Renders page sections
     *
     * @access public
     * @return void
     */
	public static function renderSections() {
	
		$first=true;
		$out='';
	
		foreach(MthemeCore::$options as $option) {
			
			if($option['type']=='section') {
				if($first) {
					$first=false;
				} else {
					$out.='</div>';
				}
				
				$out.='<div class="mtheme-section" id="'.mtheme_sanitize_key($option['name']).'"><h2>'.$option['title'].'</h2>';
			} else {
				$option['id']=MTHEME_PREFIX.$option['id'];
				$out.=self::renderOption($option);
			}
		}

		$out.='</div>';
		
		echo mtheme_html($out);		
	}
	
	/**
	 * Renders metabox
     *
     * @access public
     * @return void
     */
	public static function renderMetabox($post, $args)
	{
		//create nonce
		$out='<input type="hidden" name="mtheme_nonce" value="'.wp_create_nonce($post->ID).'" />'; 
		$out.='<table class="mtheme-metabox">';
						
		//render metabox
		foreach(MthemeCore::$components['meta_boxes'] as $meta_box) {
			if($meta_box['id']==$args['args']['ID']) {
				foreach($meta_box['options'] as $option) {
					
					//get option value
					$option['value']=MthemeCore::getPostMeta($post->ID, $post->post_type.'_'.$option['id']);

					//render option
					if($option['type']=='module') {
						$option['wrap']=false;
						$out.=self::renderOption($option);
					}			
					else				  
					{					  
						$option['id']='_'.$post->post_type.'_'.$option['id'];
						if(isset($option['group']) && $option['group']=='group')
						{
							$out.='<tr class="meta-div-group"><th><h4 class="mtheme-meta-title">'.$option['name'].'</h4></th><td>'.self::renderOption($option).'</td></tr>';
						}
						else{
							$out.='<tr><th><h4 class="mtheme-meta-title">'.$option['name'].'</h4></th><td>'.self::renderOption($option).'</td></tr>';
						}
						
											  
					}
				}
			}
		}
		
		$out.='</table>';
		
		echo mtheme_html($out);
	}
	
	/**
	 * Renders taxmeta
     *
     * @access public
     * @return void
     */
	public static function renderTaxmeta($cat_type)
	{
	
		$my_meta = null;
		  
  
		foreach(MthemeCore::$components['texa_meta'] as $meta_box)
		{
			if($cat_type == $meta_box['cat_type']){
			
			$isRepeat = false;
			$config = array(
			
				'pages' => array($meta_box['cat_type']),
				'context' => $meta_box['context'],
				'fields' => array(),
				'local_images' => false
				
			 );
		   
			/*var_dump($config);die();*/

			$my_meta =  new MthemeTexameta($config); 
			
			foreach($meta_box['options'] as $option) {
			
				$repeater_fields[] = null;
				switch($option['type'])
				{
					case 'text':
						$my_meta->addText($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addText($option['prefix'].$option['id'],array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
					case 'textarea':
						$my_meta->addTextarea($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addTextarea($option['prefix'].$option['id'],array('name'=> $option['name']));
							$isRepeat = true;
						}
					break;
					
					case 'checkbox':
						$my_meta->addCheckbox($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addCheckbox($option['prefix'].$option['id'],array('name'=> $option['name']));
							$isRepeat = true;
						}
					break;
					
					case 'select':
						$my_meta->addSelect($option['prefix'].$option['id'],$option['select_options'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addSelect($option['prefix'].$option['id'],$option['select_options'],array('name'=> $option['name']), true);
							$isRepeat = true;
						}
					break;
					
					case 'radio':
						$my_meta->addRadio($option['prefix'].$option['id'],$option['select_options'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addRadio($option['prefix'].$option['id'],$option['select_options'],array('name'=> $option['name']), true);
							$isRepeat = true;
						}
					break;
					
					case 'date':
						$my_meta->addDate($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addDate($option['prefix'].$option['id'],array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
					case 'time':
						$my_meta->addTime($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addTime($option['prefix'].$option['id'],array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
					case 'color':
						$my_meta->addColor($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addColor($option['prefix'].$option['id'],array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
					case 'image':
						$my_meta->addImage($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addImage($option['prefix'].$option['id'],array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
					case 'file':
						$my_meta->addFile($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addFile($option['prefix'].$option['id'],array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
					case 'editor':
						$my_meta->addWysiwyg($option['prefix'].$option['id'],array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addWysiwyg($option['prefix'].$option['id'],array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
					case 'taxonomy':
						$my_meta->addTaxonomy($option['prefix'].$option['id'],array('taxonomy' => 'category'),array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addTaxonomy($option['prefix'].$option['id'],array('taxonomy' => 'category'),array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
					case 'post':
						$my_meta->addPosts($option['prefix'].$option['id'],array('args' => $option['args']),array('name'=> $option['name']));
						if(isset($option['repeat']) && $option['repeat'])
						{
							$repeater_fields[] = $my_meta->addPosts($option['prefix'].$option['id'],array('args' => $option['args']),array('name'=> $option['name']),true);
							$isRepeat = true;
						}
					break;
					
  
				}
				if($isRepeat)
				{
					$my_meta->addRepeaterBlock($option['prefix'].$option['id'],array('inline' => true, 'name' => $option['name'],'fields' => $repeater_fields));
				}
				
			}
			
			
			$my_meta->Finish();
		}
		}
	}
	/**
	 * Renders option
     *
     * @access public
	 * @param array $option
     * @return string
     */
	public static function renderOption($option) {
	
		/*var_dump($option);*/
		
		global $post, $wp_registered_sidebars, $wp_locale;
		$out='';
	
		//option wrapper
		if(!isset($option['wrap']) || $option['wrap']) {
			$parent='';
			if(isset($option['parent'])) {
				$parent='data-parent="'.MTHEME_PREFIX.$option['parent']['id'].'" ';
				$parent.='data-value="'.$option['parent']['value'].'"';
			}
			
			if(isset($option['group']) && $option['group']=='multiple')
			{
				$out.='<div class="mtheme-multiple-option mtheme-'.str_replace('_', '-', $option['type']).'" '.$parent.'>';
			}
			else{
				$out.='<div class="mtheme-option mtheme-'.str_replace('_', '-', $option['type']).'" '.$parent.'>';
			}
			
			
			if(isset($option['name']) && $option['type']!='checkbox') {
				$out.='<h3 class="mtheme-option-title">'.$option['name'].'</h3>';
			}
		}
		
		//option before
		if(isset($option['before'])) {
			$out.=$option['before'];
		}
		
		//option description
		if(isset($option['description'])) {
			$out.='<div class="mtheme-tooltip"><div class="mtheme-tooltip-icon"></div><div class="mtheme-tooltip-text">'.$option['description'].'</div></div>';
		}
		
		//option attributes
		$attributes='';
		if(isset($option['attributes'])) {
			foreach($option['attributes'] as $name=>$value) {
				$attributes.=$name.'="'.$value.'" ';
			}
		}	
		
		//option value		
		if(!isset($option['value'])) {			
			$option['value']='';
			if(isset($option['id'])) {
				$option['value']=mtheme_stripslashes(get_option($option['id']));
				if(($option['value']===false || $option['value']=='') && isset($option['default'])) {
					$option['value']=mtheme_stripslashes($option['default']);
				}
				
			} else if(isset($option['default'])) {
				$option['value']=mtheme_stripslashes($option['default']);				
			}
		}		
		
		
		switch($option['type']) {
		
			//text field
			case 'text':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				$out.='<input type="text" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$option['value'].'" '.$attributes.' />';
			break;
			
			//number field
			case 'number':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				$out.='<input type="text" maxlength="12" onkeypress="return isNumberKey(event)" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$option['value'].'" '.$attributes.' />';
			break;
			
			//date field
			case 'date':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				$out.='<input type="text" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$option['value'].'" class="date-field" '.$attributes.' />';
			break;
			
			//hidden field
			case 'hidden':				
				$out.='<input type="hidden" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$option['value'].'" '.$attributes.' />';
			break;
			
			//icon_picker field
			case 'icon_picker':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
					
				$v="";if( isset( $option['value'] ) && !empty( $option['value'] ) ){ $v=explode('|',$option['value']); $v=$v[0].' '.$v[1]; }
				$out.='<input class="regular-text" type="hidden" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$option['value'].'"/>';
				$out.='<div id="mtheme_icon_picker_'.$option['id'].'" data-target="#'.$option['id'].'" class="button icon-picker '.$v.'" '.$attributes.' ></div>';
			break;
			 
	
			//message field
			case 'textarea':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				$out.='<textarea id="'.$option['id'].'" name="'.$option['id'].'" '.$attributes.'>'.$option['value'].'</textarea>';
			break;
			
			//checkbox
			case 'checkbox':				
				if(isset($option['default']) && empty($option['value']))
				{
					$option['value']=$option['default'];
				}
				/*var_dump($option);*/
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				if(isset($option['defendency-set']))
					$attributes.=' data-defendency="'.$option['defendency-set'].'" ';
					
				$checked='';
				if($option['value']=='true') {
					$checked='checked="checked"';
				}
				
				$out.='<input type="checkbox" id="'.$option['id'].'" name="'.$option['id'].'" value="true" '.$checked.' '.$attributes.' />';
				
				if(isset($option['name'])) {
					$out.='<label for="'.$option['id'].'">'.$option['name'].'</label>';
				}				
			break;
			
			//colorpicker
			case 'color':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				$out.='<input name="'.$option['id'].'" id="'.$option['id'].'" type="text" value="'.$option['value'].'" class="mtheme-colorpicker" '.$attributes.' />';
			break;
			
			//uploader
			case 'uploader':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				$out.='<input name="'.$option['id'].'" id="'.$option['id'].'" type="text" value="'.$option['value'].'" '.$attributes.' />';
				$out.='<a class="button mtheme-upload-button">'.__('Browse','mtheme').'</a>';
			break;
			
			//multiple uploader
			case 'attachments':	
				if(empty($option['value']) || !is_array($option['value'])) {
					$option['value']=array(
						'a'.uniqid() => array(
							'title' => '',
							'url' => '',
							'type' => '',
						),
					);
				}

				$out.='<div class="mtheme-clone-pane"><input type="hidden" id="'.$option['id'].'" name="'.$option['id'].'" value="" />';
				
				foreach($option['value'] as $key => $field) {
					$out.='<div class="mtheme-clone-item" id="'.$option['id'].'_'.$key.'">';
					$out.='<a href="#" class="mtheme-button mtheme-remove-button mtheme-trigger" data-element="'.$option['id'].'_'.$key.'" title="'.__('Remove', 'mtheme').'"></a>';
					$out.='<a href="#" class="mtheme-button mtheme-clone-button mtheme-trigger" data-element="'.$option['id'].'_'.$key.'" data-value="'.$key.'" title="'.__('Add', 'mtheme').'"></a>';
					
					$out.=MthemeInterface::renderOption(array(
						'id' => $option['id'].'['.$key.'][title]',
						'type' => 'text',
						'value' => mtheme_value($field, 'title'),
						'wrap' => false,					
						'attributes' => array(
							'placeholder' => __('Title', 'mtheme'),
						),					
					));
					
					$out.=MthemeInterface::renderOption(array(
						'id' => $option['id'].'['.$key.'][type]',
						'type' => 'select',
						'value' => mtheme_value($field, 'type'),
						'wrap' => false,
						'options' => array(
							'document' => __('Document', 'mtheme'),
							'audio' => __('Audio', 'mtheme'),
							'video' => __('Video', 'mtheme'),
						),
					));
					
					$out.=MthemeInterface::renderOption(array(
						'id' => $option['id'].'['.$key.'][status]',
						'type' => 'select',
						'value' => mtheme_value($field, 'status'),
						'wrap' => false,
						'options' => array(
							'file' => __('File', 'mtheme'),
							'link' => __('Link', 'mtheme'),
						),
					));
					
				
					$out.=MthemeInterface::renderOption(array(
						'id' => $option['id'].'['.$key.'][url]',
						'type' => 'uploader',
						'value' => mtheme_value($field, 'url'),						
						'attributes' => array(
							'placeholder' => 'URL',
						),
					));
					
					$out.='</div>';
				}
				
				$out.='</div>';
			break;
			
			//images selector
			case 'select_image':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				foreach($option['options'] as $name => $src) {
					$out.='<image src="'.$src.'" ';
					
					if($name==$option['value']) {
						$out.='class="current"';
					}
					
					$out.=' data-value="'.$name.'" />';
				}
				
				$out.='<input type="hidden" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$option['value'].'" '.$attributes.' />';
			break;
			
			//custom dropdown
			case 'select':
				if(isset($option['default']) && empty($option['value']))
				{
					$option['value']=$option['default'];
				}
				
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				if(isset($option['defendency-set']))
					$attributes.=' data-defendency="'.$option['defendency-set'].'" ';
					
				$out.='<select id="'.$option['id'].'" name="'.$option['id'].'" '.$attributes.' autocomplete="off">';
				if(isset($option['options'])) {
					foreach($option['options'] as $name=>$title) {
						$selected='';
						if($option['value']!='' && ($name==$option['value'] || (is_array($option['value']) && in_array($name, $option['value'])))) {
							$selected='selected="selected"';
						}
						$out.='<option value="'.$name.'" '.$selected.'>'.$title.'</option>';
					}
				}
				
				$out.='</select>';
			break;
			
			//fonts dropdown
			case 'select_font':
				$options=MthemeCore::$components['fonts'];
				asort($options);
				
				$out.=self::renderOption(array(
					'id' => $option['id'],
					'type' => 'select',
					'wrap' => false,
					'default' => $option['value'],
					'options' => $options,
				));
			break;
			
			//pages dropdown
			case 'select_page':
				$args=array(
					'selected' => $option['value'],
					'echo' => 0,
					'name' => $option['id'],
					'id' => $option['id'],
				);
				
				$out.=wp_dropdown_pages($args);
			break;
			
			//posts dropdown
			case 'select_post':
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				$atts=array(
					'numberposts'=> -1,
					'post_type' => $option['post_type'], 
					'post_status' => array('publish', 'future', 'pending', 'draft'),
					'orderby' => 'title',
					'order' => 'ASC',
				);
				
				if($option['post_type']!='product' && !current_user_can('manage_options')) {
					$atts['author']=get_current_user_id();
				}				
				
				$items=get_posts($atts);
				
				$out.='<select id="'.$option['id'].'" name="'.$option['id'].'" '.$attributes.'>';
				$out.='<option value="0">'.__('None', 'mtheme').'</option>';
				
				foreach($items as $item) {
					$selected='';
					if($item->ID==$option['value']) {
						$selected='selected="selected"';
					}
					
					$out.='<option value="'.$item->ID.'" '.$selected.'>'.$item->post_title.'</option>';
				}
				
				$out.='</select>';
			break;
			
			
			//multiple posts dropdown
			case 'select_multiple_post':
				global $post;				
				
				$data = get_post_meta($post->ID,$option['input_id'],false);
				echo '<div class="custom-mtheme-option">';
				echo '<ul id="'.$option['input_id'].'_items">';
				$c = 0;				
				
				if (!empty($data))
				{
				
					foreach((array)$data as $p )
					{     						
						echo ajax_show_multiple_select($c, $option,$p);  
						$c++;
					}

				}
				
				echo '</ul>';
				
				?>
				<span class="add_<?php echo esc_attr($option['input_id']); ?> button"><?php echo __('Add','mtheme'); ?></span>
				<script>
					var $ =jQuery.noConflict();
					$(document).ready(function() {
						var count = <?php echo esc_attr($c - 1); ?>; 
						$(".add_<?php echo esc_attr($option['input_id']); ?>").click(function() {
						count = count + 1;
						$('#<?php echo esc_attr($option['input_id'].'_items'); ?>').append('<?php echo ajax_show_multiple_select('count',$option); ?>'.replace(/count/g, count));
						return false;
						});
						$(".remove_<?php echo esc_attr($option['input_id']); ?>").live('click', function() {
							$(this).parent().remove();
						});
					});
				</script>
				<style>#<?php echo esc_attr($option['input_id'].'_items'); ?> {list-style: none;}</style>
				<?php
				echo '</div>';
			break;
			
			
			//sidebars dropdown
			case 'select_sidebar':
				$sidebars=array();	
				foreach($wp_registered_sidebars as $sidebar) {
					$sidebars[$sidebar['name']]=$sidebar['name'];
				}
				
				$out.=self::renderOption(array(
					'id' => $option['id'],
					'type' => 'select',
					'wrap' => false,
					'options' => $sidebars,
				));
			break;
			
			//categories dropdown
			case 'select_category':			
				if(isset($option['defendency']))
					$attributes.=' data-defendency-show="'.$option['defendency']['show'].'" data-defendency-set="'.$option['defendency']['base'].'_'.$option['defendency']['id'].'_'.$option['defendency']['value'].'" data-parent="'.$option['defendency']['parent'].'" ';
				$args=array(
					'hide_empty' => 0,
					'echo'=> 0,
					'selected' => $option['value'],
					'show_option_all' => __('None', 'mtheme'),
					'hierarchical' => 0, 
					'name' => $option['id'],
					'id' => $option['id'],
					'depth' => 0,
					'tab_index' => 0,
					'taxonomy' => $option['taxonomy'],
					'hide_if_empty' => false,
				);
				
				if(isset($option['attributes'])) {
					$args['class']=$option['attributes']['class'];
				}
				$out.='<div'.$attributes.'>';
				$out.= wp_dropdown_categories($args);
				$out.='</div>';
			break;
			
			//range slider
			case 'slider':
				$out.='<div class="mtheme-slider-controls"></div><div class="mtheme-slider-value"></div>';
				$out.='<input type="hidden" class="slider-max" value="'.$option['max_value'].'" />';
				$out.='<input type="hidden" class="slider-min" value="'.$option['min_value'].'" />';
				$out.='<input type="hidden" class="slider-unit" value="'.$option['unit'].'" />';
				$out.='<input type="hidden" class="slider-value" name="'.$option['id'].'" id="'.$option['id'].'"  value="'.$option['value'].'" />';
			break;
			
			/*section_menu*/
			case 'section_menu':
				if(empty($option['value']) || !is_array($option['value'])) {
					$option['value']=array(
						's'.uniqid() => array(
							'title' => '',
							'type' => '',
						),
					);
				}

				$out.='<div class="mtheme-clone-pane"><input type="hidden" id="'.$option['id'].'" name="'.$option['id'].'" value="" />';
				
				foreach($option['value'] as $key => $field) {
					$out.='<div class="mtheme-clone-item" id="'.$option['id'].'_'.$key.'">';
					$out.='<a href="#" class="mtheme-button mtheme-remove-button mtheme-trigger" data-element="'.$option['id'].'_'.$key.'" title="'.__('Remove', 'mtheme').'"></a>';
					$out.='<a href="#" class="mtheme-button mtheme-clone-button mtheme-trigger" data-value="'.$key.'" title="'.__('Add', 'mtheme').'"></a>';
					
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Menu link type', 'mtheme'),
						'id' => $option['id'].'['.$key.'][name]',
						'type' => 'select',
						'options' => array(
							'internal' => __('Menu Link - Internal', 'mtheme'),
							'external' => __('Menu Link - External', 'mtheme'),
						),
						'attributes' => array('placeholder' => __('Section link type', 'mtheme')),
						'value' => htmlspecialchars(mtheme_value($field, 'name')),
						'wrap' => true,
						'group' => 'multiple',
						'default' => 'internal'
					));
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Menu Heading', 'mtheme'),
						'id' => $option['id'].'['.$key.'][menu_heading]',
						'type' => 'text',
						'attributes' => array('placeholder' => __('Menu Heading', 'mtheme')),
						'value' => htmlspecialchars(mtheme_value($field, 'menu_heading')),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'If Menu heading is empty, only section has to added in the page',
					));
					$out.=MthemeInterface::renderOption(array(
						'name' => __('External menu link', 'mtheme'),
						'id' => $option['id'].'['.$key.'][external_link]',
						'type' => 'text',
						'attributes' => array('placeholder' => __('External menu link', 'mtheme')),
						'value' => htmlspecialchars(mtheme_value($field, 'external_link')),
						'wrap' => true,
						'group' => 'multiple',				
						'description' => 'Please enter external link. Only menu link has get display',
					));
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Internal Section Content', 'mtheme'),
						'id' => $option['id'].'['.$key.'][content]',
						'type' => 'textarea',
						'attributes' => array('placeholder' => __('Section Content', 'mtheme')),
						'value' => htmlspecialchars(mtheme_value($field, 'content')),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'Please enter section shortcodes.',
					));
					
					
					$out.='</div>';
				}
				
				$out.='</div>';
			break;
			
			/*schedule*/
			case 'schedule':
				if(empty($option['value']) || !is_array($option['value'])) {
					$option['value']=array(
						's'.uniqid() => array(
							'title' => '',
							'type' => '',
						),
					);
				}

				$out.='<div class="mtheme-clone-pane"><input type="hidden" id="'.$option['id'].'" name="'.$option['id'].'" value="" />';
				
				foreach($option['value'] as $key => $field) {
					$out.='<div class="mtheme-clone-item" id="'.$option['id'].'_'.$key.'">';
					$out.='<a href="#" class="mtheme-button mtheme-remove-button mtheme-trigger" data-element="'.$option['id'].'_'.$key.'" title="'.__('Remove', 'mtheme').'"></a>';
					$out.='<a href="#" class="mtheme-button mtheme-clone-button mtheme-trigger" data-value="'.$key.'" title="'.__('Add', 'mtheme').'"></a>';
					
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Accordion Active', 'mtheme'),
						'id' => $option['id'].'['.$key.'][active]',
						'type' => 'select',
						'value' => htmlspecialchars(mtheme_value($field, 'active')),
						'options' => array(
							'no' => __('Accordion Active - NO', 'mtheme'),
							'yes' => __('Accordion Active - Yes', 'mtheme'),
						),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'Is Accordion Active?',
						'default' => 'no'
					));
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Event Title', 'mtheme'),
						'id' => $option['id'].'['.$key.'][title]',
						'type' => 'text',
						'value' => htmlspecialchars(mtheme_value($field, 'title')),
						'wrap' => false,					
						'attributes' => array(
							'placeholder' => __('Event Title', 'mtheme'),
						),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'Please enter Event Title.',
					));
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Event Time', 'mtheme'),
						'id' => $option['id'].'['.$key.'][time]',
						'type' => 'text',
						'value' => htmlspecialchars(mtheme_value($field, 'time')),
						'wrap' => false,					
						'attributes' => array(
							'placeholder' => __('Event Time', 'mtheme'),
						),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'Please enter Event Time.',
					));

					$out.=MthemeInterface::renderOption(array(
						'name' => __('Speaker Name', 'mtheme'),
						'id' => $option['id'].'['.$key.'][speaker]',
						'type' => 'text',
						'value' => htmlspecialchars(mtheme_value($field, 'speaker')),
						'wrap' => false,					
						'attributes' => array(
							'placeholder' => __('Event Speaker Name', 'mtheme'),
						),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'Please enter Event Speaker Name.',
					));
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Speaker Designation', 'mtheme'),
						'id' => $option['id'].'['.$key.'][designation]',
						'type' => 'text',
						'value' => htmlspecialchars(mtheme_value($field, 'designation')),
						'wrap' => false,					
						'attributes' => array(
							'placeholder' => __('Event Speaker Designation', 'mtheme'),
						),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'Please enter Event Speaker Name.',
					));
					
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Event Venue', 'mtheme'),
						'id' => $option['id'].'['.$key.'][venue]',
						'type' => 'text',
						'value' => htmlspecialchars(mtheme_value($field, 'venue')),
						'wrap' => false,					
						'attributes' => array(
							'placeholder' => __('Event Venue', 'mtheme'),
						),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'Please enter Event Venue.',
					));
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('Description', 'mtheme'),
						'id' => $option['id'].'['.$key.'][description]',
						'type' => 'textarea',
						'value' => htmlspecialchars(mtheme_value($field, 'description')),
						'wrap' => false,					
						'attributes' => array(
							'placeholder' => __('Event Description', 'mtheme'),
						),
						'wrap' => true,
						'group' => 'multiple',
						'description' => 'Please enter Event Description.',
					));
					
					
					$out.='</div>';
				}
				
				$out.='</div>';
			break;
			/*external_link*/
			case 'external_link':
				if(empty($option['value']) || !is_array($option['value'])) {
					$option['value']=array(
						'el'.uniqid() => array(
							'title' => '',
							'type' => '',
						),
					);
				}

				$out.='<div class="mtheme-clone-pane"><input type="hidden" id="'.$option['id'].'" name="'.$option['id'].'" value="" />';
				
				foreach($option['value'] as $key => $field) {
					$out.='<div class="mtheme-clone-item" id="'.$option['id'].'_'.$key.'">';
					$out.='<a href="#" class="mtheme-button mtheme-remove-button mtheme-trigger" data-element="'.$option['id'].'_'.$key.'" title="'.__('Remove', 'mtheme').'"></a>';
					$out.='<a href="#" class="mtheme-button mtheme-clone-button mtheme-trigger" data-value="'.$key.'" title="'.__('Add', 'mtheme').'"></a>';
					
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('External Link Title', 'mtheme'),
						'id' => $option['id'].'['.$key.'][el_link_title]',
						'type' => 'text',
						'value' => htmlspecialchars(mtheme_value($field, 'el_link_title')),
						'wrap' => true,
						'attributes' => array(
							'placeholder' => __('External Link Title', 'mtheme'),
						),
						'group' => 'multiple',
						'description' => 'External Link Title'
					));
					
					$out.=MthemeInterface::renderOption(array(
						'name' => __('External Link URL', 'mtheme'),
						'id' => $option['id'].'['.$key.'][el_link_url]',
						'type' => 'text',
						'value' => htmlspecialchars(mtheme_value($field, 'el_link_url')),
						'wrap' => true,
						'attributes' => array(
							'placeholder' => __('External Link URL', 'mtheme'),
						),
						'group' => 'multiple',
						'description' => 'External Link URL'
					));
					
					
					$out.='</div>';
				}
				
				$out.='</div>';
			break;
			//users manager
			case 'users':
				$users=MthemeCore::getUserRelations(0, $post->ID, $post->post_type);
				
				$out.='<div class="mtheme-row clearfix">';
				$out.=wp_dropdown_users(array(
					'echo' => false,
					'exclude' => $users,
					'name' => 'add_user_id',
					'id' => 'add_user_id',
				));
				$out.='<input type="submit" name="add_user" class="button" value="'.__('Add', 'mtheme').'" /></div>';

				
				if(!empty($users)) {
					$out.='<div class="mtheme-row clearfix">';
					$out.=wp_dropdown_users(array(
						'echo' => false,
						'include' => $users,
						'name' => 'remove_user_id',
						'id' => 'remove_user_id',
					));
					$out.='<input type="submit" name="remove_user" class="button" value="'.__('Remove', 'mtheme').'" /></div>';
				}
			break;
			
			//module settings
			case 'module':
				$out.='<div class="'.substr(strtolower(implode('-', preg_split('/(?=[A-Z])/', str_replace(MTHEME_PREFIX, '', $option['id'])))), 1).'">';
				if(isset($option['slug'])) {
					$out.=call_user_func(array(str_replace(MTHEME_PREFIX, '', $option['id']), 'renderSettings'), $option['slug']);
				} else {
					$out.=call_user_func(array(str_replace(MTHEME_PREFIX, '', $option['id']), 'renderSettings'));
				}		
				$out.='</div>';
			break;
		}
		
		//option after
		if(isset($option['after'])) {
			$out.=$option['after'];
		}
		
		//wrap option
		if(!isset($option['wrap']) || $option['wrap']) {
			$out.='</div>';
		}
		
		return $out;
	}
	
	/**
	 * Is site menu has menu items
     *
     * @access public
	 * @param string $slug
     * @return void
     */
	public static function isSiteMenuHasItems($slug) {
		$hasItems=false;
		$locations = get_nav_menu_locations();	
		if( isset($locations[$slug])) {
			$menu=wp_get_nav_menu_object($locations[$slug]);		
				
			if(isset($menu->term_id)) {		
				$menu_items=wp_get_nav_menu_items($menu->term_id);
				
				foreach ((array)$menu_items as $key => $menu_item) {				
								
					$hasItems=true;		
					break;
					
				}	
			}
		}
		return $hasItems;
	}
	
	/**
	 * Renders Site Menu
     *
     * @access public
	 * @param string $slug
     * @return void
     */
	public static function renderSiteMenu($slug) {
		$locations = get_nav_menu_locations();	
		if( isset($locations[$slug])) {
			$menu=wp_get_nav_menu_object($locations[$slug]);
			
			if(isset($menu->term_id)) {		
				$menu_items=wp_get_nav_menu_items($menu->term_id);
				$isFirstMenu=true;
				$parentMenuTemp=0;
				$isSubMenu=false;
				$subMenuC=0;
				$hasChildMenu=false;
				
				$out='<ul class="nav navbar-nav"><li>';
				foreach ((array)$menu_items as $key => $menu_item) {				
								
					$hasChildMenu=MthemeCore::hasPostIdByMetaKeyAndMetaValue('menu_item_menu_item_parent',$menu_item->ID);
					$parentMenu = MthemeCore::getPostMeta($menu_item->ID,'menu_item_menu_item_parent',0);
					if($parentMenu!=0)
					{					
						if($parentMenuTemp!=$parentMenu)
						{
							if($isSubMenu)
							{							
								$subMenuC++;
							}
							
							if($hasChildMenu)
							{
								$out.='<ul class="dropdown-menu level-'.($subMenuC+1).'"><li class="dropdown-submenu">';
							}
							else{
								$out.='<ul class="dropdown-menu level-'.($subMenuC+1).'"><li>';
							}
						}
						else{						
							if($hasChildMenu)
							{
								$out.='</li><li class="dropdown-submenu">';
							}
							else{
								$out.='</li><li>';
							}
						}
						$parentMenuTemp=$parentMenu;
						$isSubMenu=true;
					}				
					else{
						if($isSubMenu)
						{
							while($subMenuC--)
							{
								$out.='</li></ul>';
							}
							$out.='</li></ul></li><li>';
							$isSubMenu=false;
							$subMenuC=0;
						}
						elseif(!$isFirstMenu)
						{
							$out.='</li><li>';
						}
					}
					
					/*var_dump($menu_item);*/
					$class_names='';
					$pageId='';
					global $post;
					if($post) $pageId=$post->ID;
					if($menu_item->object_id==$pageId)$class_names='active ';
					$class_names.=implode( ' ', $menu_item->classes );
					if(!$isSubMenu && $hasChildMenu)
					{
						$out.='<a href="'.$menu_item->url.'" class="'.$class_names.'">'.$menu_item->title.'<span class="caret"></span></a>';
					}else{
						$out.='<a href="'.$menu_item->url.'" class="'.$class_names.'">'.$menu_item->title.'</a>';
					}
					
					$isFirstMenu=false;		
				}
				if($isSubMenu)
				{
					/* last menu is sub menu */
					$out.='</li></ul>';
				}
				$out.='</li></ul>';
				
				echo mtheme_html($out);			
			} else {
				wp_dropdown_pages();
			}
		}
		else
		{
			wp_dropdown_pages();
		}
	}
	
	/**
	 * Renders comment
     *
     * @access public
	 * @param mixed $comment
	 * @param array $args
	 * @param int $depth
     * @return void
     */
	public static function renderComment($comment, $args, $depth=1) {
		$GLOBALS['comment']=$comment;
		$GLOBALS['depth']=$depth;
		get_template_part('content', 'comment');
	}
	
	/**
	 * Renders comment form
     *
     * @access public
	 * @param array $fields
     * @return void
     */
	public static function renderCommentForm($fields) {
		
		$default['logged_in_as']='<div class="formatted-form">';
		$default['comment_notes_before']='<div class="formatted-form">';
		$default['comment_notes_after']='</div>';
		$default['fields']['author']='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-none"><input id="author" name="author" type="text" value="" size="30" placeholder="'.__('Name', 'mtheme').'" /></div>';
		$default['fields']['email']='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-none"><input id="email" name="email" type="text" value="" size="30" placeholder="'.__('Email', 'mtheme').'" /></div>';
		$default['fields']['url']='';
		$default['comment_field']='<div class="field-wrapper"><textarea id="comment" name="comment" cols="45" rows="3" placeholder="'.__('Write your Comment', 'mtheme').'"></textarea></div>';
		$default['label_submit']=__('Submit', 'mtheme');
		
		
		$default['title_reply']='';
		$default['title_reply_to']='';
		$default['cancel_reply_link']='';
		$default['name_submit']='';
		$default['id_form']=$fields['id_form'];		
		$default['id_submit']=$fields['id_submit'];	
		
		
		return $default;
	}
	
	/**
	 * Renders editor
     *
     * @access public
	 * @param string $ID
	 * @param string $content
     * @return void
     */
	public static function renderEditor($ID, $content='') {
		$settings=array(
			'media_buttons'=>false,
			'teeny'=>true,
			'quicktags' => false,
			'textarea_rows' => 10,
			'tinymce' => array(
				'theme_advanced_buttons1' => 'bold,italic,link,undo,redo',
				'theme_advanced_buttons2' => '',
				'theme_advanced_buttons3' => ''
			),
		);
		
		wp_editor($content, $ID, $settings);
	}
	
	/**
	 * Renders pagination
     *
     * @access public
     * @return void
     */
	public static function renderPagination() {		
		global $wp_query;
		
		$args['base']=str_replace(999999999, '%#%', get_pagenum_link(999999999));
		$args['total']=$wp_query->max_num_pages;
		$args['current']=mtheme_paged();

		$args['mid_size']=2;
		$args['end_size']=1;
		$args['prev_text']='<i class="fa fa-angle-left icon-list-item"></i>';
		$args['next_text']='<i class="fa fa-angle-right icon-list-item"></i>';
		
		$out=paginate_links($args);
		if($out!='') {
			$out='<nav class="pagination">'.$out.'</nav>';
		}
		echo mtheme_html($out);
	}
	
	/**
	 * Renders pagination 2
     *
     * @access public
     * @return void
     */
	public static function renderPaginationList() {		
		
		$defaults = array(
			'before'           => '<p>' . __( 'Pages:' , 'mtheme'),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( 'Next page' , 'mtheme' ),
			'previouspagelink' => __( 'Previous page' , 'mtheme' ),
			'pagelink'         => '%',
			'echo'             => 1
		);
 
        wp_link_pages( $defaults );
	}
	/**
	 * Demo purpose
     *
     * @access public
     * @return void
     */
	 
	 public static function isRenderPagination() {		
		return false;
	 }
	 
	 
	/**
	 * Renders page title
     *
     * @access public
     * @return void
     */
	public static function renderPageTitle() {
		global $post;
			
		$out=wp_title('', false);
		
		$seachTerm='';
		if(isset($_GET['s']) && !empty($_GET['s']))
		{
			$seachTerm=$_GET['s'];
		}
		
		if ( is_search() ) {
			$out=__('Search results for ', 'mtheme') . $seachTerm ;
		}else
		if(is_page()) 
		{
			$out=get_the_title($post->ID);
		}else
		if(is_tax()) {
			$out=single_term_title('', false);
		} else if(get_query_var('author')) {
			$out=__('Profile', 'mtheme');
		}

		if(empty($out)) {
			$out=__('Archives', 'mtheme');
		}
		
		echo $out;
	}
	
	/**
	 * Renders footer
     *
     * @access public
     * @return void
     */
	public static function renderFooter() {
		$out='';/*you can add here footer elements*/	
		echo mtheme_html($out);
	}
	
	/**
	 * Renders user toolbar
     *
     * @access public
     * @return bool
     */
	public static function renderToolbar() {
		if(current_user_can('edit_posts') && get_user_option('show_admin_bar_front', get_current_user_id())!='false') {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Renders messages
     *
     * @access public
	 * @param array $messages
	 * @param bool $success
     * @return void
     */
	public static function renderMessages($success=false) {
		$out='';
		$class='error';
		if($success) {
			$class='success';
		}
		
		if(isset(self::$messages)) {
			$out.='<ul class="'.$class.'">';			
			foreach(self::$messages as $message) {
				$out.='<li>'.$message.'</li>';
			}			
			$out.='</ul>';
		}

		echo mtheme_html($out);
	}
}