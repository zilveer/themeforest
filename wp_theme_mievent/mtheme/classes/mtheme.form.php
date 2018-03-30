<?php
/**
 * Mtheme Form
 *
 * Handles custom forms
 *
 * @class MthemeForm
 * @author Mtheme
 */
 
class MthemeForm {

	/** @var array Contains module data. */
	public static $data;

	/**
	 * Adds actions and filters
     *
     * @access public
     * @return void
     */
	public static function init() {
	
		//refresh data
		self::refresh();
		
		//add field action
		add_action('wp_ajax_mtheme_form_add', array(__CLASS__, 'addField'));
		
		//submit form action
		add_action('wp_ajax_mtheme_form_submit', array(__CLASS__, 'submitData'));
		add_action('wp_ajax_nopriv_mtheme_form_submit', array(__CLASS__, 'submitData'));
		//notify form action
		add_action('wp_ajax_mtheme_notify_submit', array(__CLASS__, 'submitNofifyForm'));
		add_action('wp_ajax_nopriv_mtheme_notify_submit', array(__CLASS__, 'submitNofifyForm'));
	}
	
	/**
	 * Refreshes module data
     *
     * @access public
     * @return void
     */
	public static function refresh() {
		self::$data=(array)MthemeCore::getOption(__CLASS__);
	}
	
	/**
	 * Renders module settings
     *
     * @access public
	 * @param string $slug
     * @return string
     */
	public static function renderSettings($slug) {
		global $post;
		$out='';		

		if($slug!='section') {
			$out.=MthemeInterface::renderOption(array(
				'id' => __CLASS__.'['.$slug.'][message]',
				'name' => __('Form Submit Success Message', 'mtheme'),
				'type' => 'textarea',
				'description' => __('Enter message to show when email is successfully sent', 'mtheme'),
				'value' => isset(self::$data[$slug]['message'])?self::$data[$slug]['message']:'',
			));
			$out.=MthemeInterface::renderOption(array(
				'id' => __CLASS__.'['.$slug.'][btitle]',
				'name' => __('Form Submit Button Heading', 'mtheme'),
				'type' => 'text',
				'description' => __('Enter Form Submit Button Heading', 'mtheme'),
				'value' => isset(self::$data[$slug]['btitle'])?self::$data[$slug]['btitle']:'',
			));
			$out.=MthemeInterface::renderOption(array(
				'id' => __CLASS__.'['.$slug.'][captcha]',
				'name' => __('Enable Captcha Protection', 'mtheme'),
				'type' => 'checkbox',
				'value' => isset(self::$data[$slug]['captcha'])?self::$data[$slug]['captcha']:'',
			));
			$out.=MthemeInterface::renderOption(array(
				'name' => __('Form Fields', 'mtheme'),
				'type' => 'title',
			));			
		}else{
			$out.=MthemeInterface::renderOption(array(
				'name' => __('Home Sections', 'mtheme'),
				'type' => 'heading',
			));
		}
		if(self::isActive($slug)) {			
			foreach(self::$data[$slug]['fields'] as $ID=>$field) {				
				$field['form']=$slug;
				$field['id']=$ID;
				$out.=self::renderField($field);
			}
		} else {
			$out.=self::renderField(array(
				'id' => uniqid(),
				'name' => '',
				'type' => 'string',
				'form' => $slug,
			));
		}
		
		return $out;
	}
	
	/**
	 * Saves module options
     *
     * @access public
	 * @param array $data
     * @return void
     */
	public static function saveOptions($data) {
		if(is_array($data)) {
			foreach($data as $slug => $form) {
				if(isset($form['fields']) && is_array($form['fields'])) {
					foreach($form['fields'] as $field) {
						$ID=mtheme_sanitize_key($field['name']);
						if(isset($field['name']) && !empty($field['name'])) {
							mtheme_add_string($ID, 'name', $field['name']);
						}
						
						if(isset($field['options']) && !empty($field['options'])) {
							mtheme_add_string($ID, 'options', $field['options']);
						}
					}
				}
			
				if(isset($form['message']) && !empty($form['message'])) {
					mtheme_add_string($slug, 'message', $form['message']);
				}
			}
		}
	}
	
	/**
	 * Renders module data
     *
     * @access public
	 * @param string $slug
	 * @param array $optionst
	 * @param array $values
     * @return void
     */
	public static function renderData($slug, $options=array(), $values=array()) {
		$options=wp_parse_args($options, array(
			'edit' => true,
			'before_title' => '',
			'after_title' => '',
			'before_content' => '',
			'after_content' => '',			
		));
		
		$out='';
		$counter=0;
		
		if(self::isActive($slug)) {
			foreach(self::$data[$slug]['fields'] as $field) {
				$ID=mtheme_sanitize_key($field['name']);
				$field['name']=mtheme_get_string($ID, 'name', $field['name']);
				$counter++;
				
				if($options['edit']) {
					$args=array(
						'id' => $ID,
						'type' => $field['type'],
						'value' => mtheme_value($values, $ID),
						'wrap' => false,
					);

					if($field['type']=='textarea') {
						$out.='<div class="clear"></div>';
					} else {
						$out.='<div class="sixcol column ';
					
						if($counter%2==0) {
							$out.='last">';
						} else {
							$out.='">';
						}
					}
					
					if($field['type']=='select') {
						$field['options']=mtheme_get_string($ID, 'options', $field['options']);
						$args['options']=array_merge(array('0' => $field['name']), explode(',', $field['options']));
						$out.='<div class="select-field">';
					} else {
						$optional=mtheme_get_string($ID, 'options', $field['options']);
						if($optional == 'req')
						{
							$args['attributes']=array('placeholder' => $field['name'].'*');
						}
						else
						{
							$args['attributes']=array('placeholder' => $field['name']);
						}
						
						$out.='<div class="field-wrapper">';
					}
					
					if(in_array($field['type'], array('email'))) {
						$args['type']='text';
					}
					
					$out.=MthemeInterface::renderOption($args);
					
					$out.='</div>';
					if($field['type']!='textarea') {
						$out.='</div>';
						if($counter%2==0) {
							$out.='<div class="clear"></div>';
						}
					}
				} else if(isset($values[$ID])) {
					$out.=$options['before_title'].$field['name'].$options['after_title'].$options['before_content'];
					
					if($field['type']=='select') {
						$field['options']=mtheme_get_string($ID, 'options', $field['options']);
						$items=array_merge(array('0' => '&ndash;'), explode(',', $field['options']));							
						if(isset($items[$values[$ID]])) {
							$values[$ID]=$items[$values[$ID]];
						}
					}
					
					if(empty($values[$ID])) {
						$values[$ID]='&ndash;';
					}
				
					$out.=$values[$ID];
					
					$out.=$options['after_content'];
				}
			}
			
			if($options['edit'] && isset(self::$data[$slug]['captcha'])) {
				$out.='<div class="clear"></div>';
				$out.='<div class="form-captcha clearfix">';
				$out.='<img src="'.MTHEME_URI.'assets/images/captcha/captcha.php" alt="" />';
				$out.='<input type="text" name="captcha" id="captcha" size="6" value="" placeholder="'.__('Code', 'mtheme').'" /></div>';
			}
		}
		
		echo mtheme_html($out);
	}
	
	/**
	 * Renders contact form data
     *
     * @access public
	 * @param string $slug
	 * @param array $optionst
	 * @param array $values
     * @return void
     */
	public static function renderContactForm($slug,$btitle,$secondary_color,$options=array(),$values=array()) {
		$options=wp_parse_args($options, array(
			'edit' => true,
			'before_title' => '',
			'after_title' => '',
			'before_content' => '',
			'after_content' => '',			
		));
		
		$out='';
		
		if(self::isActive($slug)) {
			foreach(self::$data[$slug]['fields'] as $field) {
			
				$ID=mtheme_sanitize_key($field['name']);				
				$field['name']=mtheme_get_string($ID, 'name', $field['name']);
				$field['options']=mtheme_get_string($ID, 'options', $field['options']);
			
				$option=array(
					'id' => $ID,
					'name' => $field['name'],
					'type' => $field['type'],
					'label' => $field['label'],
					'value' => mtheme_value($values, $ID),
					'options' => $field['options']
				);
					
				/*var_dump($option);*/
				switch($option['type']) {		
					//text field
					case 'text':
						$out.=$option['label']." ";
						$out.='<input type="text" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$option['value'].'" placeholder="'.$option['options'].'" data-subline="'.$option['options'].'"/>';
					break;
					
					//email field
					case 'email':
						$out.=$option['label']." ";
						$out.='<input type="text" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$option['value'].'" placeholder="'.$option['options'].'" data-subline="'.$option['options'].'" onkeypress="return isNumberKey(event)" />';
					break;
					//number field
					case 'number':
						$out.=$option['label']." ";
						$out.='<input type="text" maxlength="12" placeholder="'.$option['options'].'" id="'.$option['id'].'" name="'.$option['id'].'" value="'.$option['value'].'" data-subline="'.$option['options'].'" onkeypress="return isNumberKey(event)" />';
					break;
					//message field
					
					case 'textarea':
						if(empty($option['value']))
						{
							$option['value']=" ".$option['options'];
						}
						$out.=$option['label'];
						$out.='<textarea id="'.$option['id'].'" name="'.$option['id'].'">'.$option['value'].'</textarea>';
					break;
					
					
					/*custom dropdown*/
					case 'select':		
						$option['options']= explode(',', $option['options']);
						
						$out.=$option['label']." ";
						$out.='<select id="'.$option['id'].'" name="'.$option['id'].'">';
						
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
				}
			}
			
			if($options['edit'] && isset(self::$data[$slug]['captcha'])) {
				$out.='<div class="clear"></div>';
				$out.='<div class="form-captcha clearfix">';
				$out.='<div class="captcha-left"><img src="'.MTHEME_URI.'assets/images/captcha/captcha.php" alt="" /></div>';
				$out.='<div class="captcha-right"><input type="text" name="captcha" id="captcha" size="6" value="" placeholder="'.__(' Code', 'mtheme').'" /></div></div>';
			}
			$out.='<div class="clear"></div>';
			if(isset($btitle) && !empty($btitle)) {
				$out.='<div class="nl-submit-wrap"><button class="nl-submit submit-button btn-effect" type="submit" style="background: none repeat scroll 0 0 '.esc_attr($secondary_color).';">'.esc_attr($btitle).'</button></div>';
			} else if(isset(self::$data[$slug]['btitle']) && !empty(self::$data[$slug]['btitle'])) {
				$out.='<div class="nl-submit-wrap"><button class="nl-submit submit-button btn-effect" type="submit" style="background: none repeat scroll 0 0 '.esc_attr($secondary_color).';">'.esc_attr(self::$data[$slug]['btitle']).'</button></div>';
			}
			else{
				$out.='<div class="nl-submit-wrap"><button class="nl-submit submit-button btn-effect" type="submit" style="background: none repeat scroll 0 0 '.esc_attr($secondary_color).';">Submit</button></div>';
			}
			
			
		}
		
		echo mtheme_html($out);
	}
	
	/**
	 * Adds new field
     *
     * @access public
     * @return void
     */
	public static function addField() {
		$slug=sanitize_text_field($_POST['value']);
		$out=self::renderField(array(
			'id' => uniqid(),
			'name' => '',
			'type' => 'string',
			'form' => $slug,
		));
		
		echo mtheme_html($out);		
		die();
	}
	
	/**
	 * Renders field option
     *
     * @access public
	 * @param array $field
     * @return string
     */
	public static function renderField($field) {
		$out='<div class="mtheme-form-item mtheme-option" id="'.$field['form'].'_'.$field['id'].'">';
		$out.='<a href="#" class="mtheme-button mtheme-remove-button mtheme-trigger" title="'.__('Remove', 'mtheme').'" data-action="mtheme_form_remove" data-element="'.$field['form'].'_'.$field['id'].'"></a>';
		
		$out.=MthemeInterface::renderOption(array(
			'id' => $field['form'].'_'.$field['id'].'_value',
			'type' => 'hidden',
			'value' => $field['form'],
			'wrap' => false,
			'after' => '<a href="#" class="mtheme-button mtheme-add-button mtheme-trigger" title="'.__('Add', 'mtheme').'" data-action="mtheme_form_add" data-element="'.$field['form'].'_'.$field['id'].'" data-value="'.$field['form'].'_'.$field['id'].'_value"></a>',				
		));
		
		if($field['form']=='section') {
			
			$out.=MthemeInterface::renderOption(array(
				'name' => __('Menu link type', 'mtheme'),
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][name]',
				'type' => 'select',
				'options' => array(
					'internal' => __('Menu Link - Internal', 'mtheme'),
					'external' => __('Menu Link - External', 'mtheme'),
				),
				'attributes' => array('placeholder' => __('Section link type', 'mtheme')),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['name'])?self::$data[$field['form']]['fields'][$field['id']]['name']:'',
				'wrap' => true,
				'group' => 'multiple',
			));
			$out.=MthemeInterface::renderOption(array(
				'name' => __('Menu Heading', 'mtheme'),
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][menu_heading]',
				'type' => 'text',
				'attributes' => array('placeholder' => __('Menu Heading', 'mtheme')),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['menu_heading'])?mtheme_stripslashes(self::$data[$field['form']]['fields'][$field['id']]['menu_heading']):'',
				'wrap' => true,
				'group' => 'multiple',
				'description' => 'If Menu heading is empty, only section has to added in the page',
			));
			$out.=MthemeInterface::renderOption(array(
				'name' => __('External menu link', 'mtheme'),
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][external_link]',
				'type' => 'text',
				'attributes' => array('placeholder' => __('External menu link', 'mtheme')),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['external_link'])?self::$data[$field['form']]['fields'][$field['id']]['external_link']:'',
				'wrap' => true,
				'group' => 'multiple',				
				'description' => 'Please enter external link. Only menu link has get display',
			));
			$out.=MthemeInterface::renderOption(array(
				'name' => __('Internal Section Content', 'mtheme'),
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][content]',
				'type' => 'textarea',
				'attributes' => array('placeholder' => __('Section Content', 'mtheme')),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['content'])?self::$data[$field['form']]['fields'][$field['id']]['content']:'',
				'wrap' => true,
				'group' => 'multiple',
				'description' => 'Please enter section shortcodes.',
			));
			
		}
		else{
			$out.=MthemeInterface::renderOption(array(
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][name]',
				'type' => 'text',
				'attributes' => array('placeholder' => __('Field Name', 'mtheme')),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['name'])?mtheme_stripslashes(self::$data[$field['form']]['fields'][$field['id']]['name']):'',
				'wrap' => false,
			));

			$out.=MthemeInterface::renderOption(array(
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][label]',
				'type' => 'text',
				'attributes' => array('placeholder' => __('Field label', 'mtheme')),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['label'])?mtheme_stripslashes(self::$data[$field['form']]['fields'][$field['id']]['label']):'',
				'wrap' => false,
			));
			
			$out.=MthemeInterface::renderOption(array(
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][type]',
				'type' => 'select',
				'options' => array(
					'text' => __('String', 'mtheme'),
					'number' => __('Number', 'mtheme'),
					'email' => __('Email', 'mtheme'),
					'select' => __('Select', 'mtheme'),
				),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['type'])?self::$data[$field['form']]['fields'][$field['id']]['type']:'',
				'wrap' => false,
			));
			$out.=MthemeInterface::renderOption(array(
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][required]',
				'type' => 'select',
				'options' => array(
					'yes' => __('Required', 'mtheme'),
					'no' => __('Not Required', 'mtheme')
				),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['required'])?self::$data[$field['form']]['fields'][$field['id']]['required']:'',
				'wrap' => false,
			));
			$out.=MthemeInterface::renderOption(array(
				'id' => __CLASS__.'['.$field['form'].'][fields]['.$field['id'].'][options]',
				'type' => 'text',
				'attributes' => array('placeholder' => __('Placeholder or options for select-field', 'mtheme')),
				'value' => isset(self::$data[$field['form']]['fields'][$field['id']]['options'])?self::$data[$field['form']]['fields'][$field['id']]['options']:'',
				'wrap' => false,
			));
		}		
		
		
		$out.='</div>';
		
		return $out;
	}
	
	/**
	 * Submits Notify form
     *
     * @access public
     * @return void
     */
	public static function submitNofifyForm() {
		
		parse_str($_POST['data'], $data);		
		$email=$data['email'];
		/*var_dump($data);die();*/
		
		if(isset($email)) {			
			
			if(empty($email)){
				MthemeInterface::$messages[]=__('Your e-mail address is incorrect.', 'mtheme');
			}
			else if(!is_email($email)) 
			{
				MthemeInterface::$messages[]=__('You have entered an invalid email address', 'mtheme');
			}
			
			if(!empty(MthemeInterface::$messages)) {
				MthemeInterface::renderMessages();
			} else {
				$admin_email=MthemeCore::getOption('notify_admin_email');
				if(empty($admin_email))
				$admin_email=get_option('admin_email');
				$subject=__('Subsciption', 'mtheme');			
				$message='Dear Admin,<br/>Email: '.$email;
								
				if(mtheme_mail($admin_email, $subject, $message)) {
					/*MthemeInterface::$messages[]='Your message has been sent.';*/
				}
				else{
					/*MthemeInterface::$messages[]="Email could not send.";*/
				}

				/*MailChimp*/
				$API_KEY = MthemeCore::getOption("api_key","cb6a20c0676b26b78e8f18f047b619a2-us8");
				$LIST_ID =  MthemeCore::getOption("list_id","6ffa2b9330");
				
				if(empty($API_KEY) && empty($LIST_ID))
				{
					MthemeInterface::$messages[]="Oops. Looks like something went wrong. Please try again later.";
					MthemeInterface::renderMessages();
				}
				else{
					$MailChimp = new MthemeMailchimp($API_KEY);			
					$result = $MailChimp->call('lists/subscribe', array(
						'id'                => $LIST_ID,
						'email'             => array('email'=>$email),
						'double_optin'      => false,
						'update_existing'   => true,
						'replace_interests' => false,
						'send_welcome'      => false,
					));
					if(isset($result["email"]) && $result["email"] == $email) {     
						MthemeInterface::$messages[]='Congrats! You are in list.';
						MthemeInterface::renderMessages(true);
					} else {					
						MthemeInterface::$messages[]="Oops. Looks like something went wrong. Please try again later.";
						MthemeInterface::renderMessages();
					}
				}
				/*MailChimp*/
			}
			
		}
		
		die();
	}
	
	/**
	 * Submits form data
     *
     * @access public
     * @return void
     */
	public static function getFormData($slug='section') {
		self::refresh();
				
		if(isset($slug) && self::isActive($slug)) {			
			return self::$data[$slug];
		}
		
		return false;
	}
	/**
	 * Submits form data
     *
     * @access public
     * @return void
     */
	public static function submitData() {
		self::refresh();
		parse_str($_POST['data'], $data);		
		
		/*var_dump($data);die();*/
		
		if(isset($data['slug']) && self::isActive($data['slug'])) {			
			
			foreach(self::$data[$data['slug']]['fields'] as $field) {
				$ID=mtheme_sanitize_key($field['name']);
				$field['name']=mtheme_get_string($ID, 'name', $field['name']);
				$field['optional']=mtheme_get_string($ID, 'options', $field['options']);
				
				if(empty($data[$ID]) && $field['required']=='yes' && $field['type']!='select') {
					MthemeInterface::$messages[]=$field['name'].' '.__('is required', 'mtheme');
				} else {
					if($field['type']=='number' && !is_numeric($data[$ID])) {
						MthemeInterface::$messages[]=$field['name'].' '.__('can only contain numbers', 'mtheme');
					}
					
					if($field['type']=='email' && !is_email($data[$ID])) {
						MthemeInterface::$messages[]=__('You have entered an invalid email address', 'mtheme');
					}
				}
			}
			
			if(isset(self::$data[$data['slug']]['captcha'])) {
				session_start();
				$posted_code=md5($data['captcha']);
				$session_code=$_SESSION['captcha'];
				
				if($session_code!= $posted_code) {
					MthemeInterface::$messages[]=__('The verification code is incorrect', 'mtheme');
				}
			}
			
			if(!empty(MthemeInterface::$messages)) {
				MthemeInterface::renderMessages();
			} else {
				$admin_email=MthemeCore::getOption('reg_admin_email');
				if(empty($admin_email))
				$admin_email=get_option('admin_email');
				$subject=__('Contact', 'mtheme');			
				$message='Dear Admin,<br/>';
				
				foreach(self::$data[$data['slug']]['fields'] as $field) {
					$ID=mtheme_sanitize_key($field['name']);
					$field['name']=mtheme_get_string($ID, 'name', $field['name']);
					
					if($field['type']=='select') {
						$field['options']=mtheme_get_string($ID, 'options', $field['options']);
						$items=explode(',', $field['options']);
						if(isset($items[$data[$ID]-1])) {
							$data[$ID]=$items[$data[$ID]-1];
						} else {
							$data[$ID]='&ndash;';
						}
					}
				
					$message.=$field['name'].': '.$data[$ID].'<br />';
				}
		
				
				if(mtheme_mail($admin_email, $subject, $message) && isset(self::$data[$data['slug']]['message'])) {
					$message=mtheme_get_string($data['slug'], 'message', self::$data[$data['slug']]['message']);
					if(empty($message))
					{
						MthemeInterface::$messages[]='Your message has been sent.';
					}
					else{
						MthemeInterface::$messages[]=$message;
					}
					MthemeInterface::renderMessages(true);
				}
				else{
					MthemeInterface::$messages[]="Email could not send.";
					MthemeInterface::renderMessages();
				}					
			}
			
		}
		
		die();
	}
	
	/**
	 * Checks form activity
     *
     * @access public
	 * @param string $slug
     * @return bool
     */
	public static function isActive($slug) {
		if(isset(self::$data[$slug]['fields']) && !empty(self::$data[$slug]['fields'])) {
			$field=reset(self::$data[$slug]['fields']);
			if(!empty($field['name'])) {	
				return true;
			}
		}
		
		return false;
	}
}