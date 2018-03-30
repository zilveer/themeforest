<?php 

// Post Meta Fields 
if(!class_exists('OWLAB_POST_META'))
{
	class OWLAB_POST_META {

		/**
		 * [$prefix used prefix for post meta]
		 * @var [var]
		 */
		public $prefix;
		public $fields;
		public $scripts;
		public $styles;
		public $nonce;

		/**
		 * Constructor
		 */
		function __construct($prefix = 'owlab' , $fields , $scripts = '' , $styles = '' , $nonce) {

			/**
			 * [$this->prefix assing prefix for meta fields]
			 * [$this->fields meta fields]
			 * @var [type]
			 */
			$this->prefix = $prefix;
			$this->fields = $fields;
			$this->scripts = $scripts;
			$this->styles = $styles;
			$this->nonce = $nonce;

			
			/**
			 * Adding actions , this will check if $this->fields is array
			 */
			if(is_array($this->fields))
			{

				// register the fields
				add_action('admin_menu', array(&$this , 'register_meta_settings'));

				// save settings action
				add_action('save_post',array(&$this , 'save_meta_fields'));

				// Register Post Meta Scripts and Styles
				add_action('admin_enqueue_scripts', array(&$this , 'register_meta_scripts'));

				// enqueue scripts
				add_action('admin_enqueue_scripts' , array(&$this , 'print_fe_scripts'));	
					
			}
			
		}


		public function print_fe_scripts()
		{
			// enqueue media gallery script
			wp_enqueue_script('media-upload');

			// register custom script
			wp_register_script('owlab_toranj_media_gallery' , get_template_directory_uri() . '/framework/post-meta/post-meta-script.js' , 'jquery');
			wp_enqueue_script('owlab_toranj_media_gallery');
		}


		/**
		 * Register Settings
		 */
		public function register_meta_settings() {

			if(is_array($this->fields['page']))
			{
				foreach ($this->fields['page'] as $page) {
					// print the fields
					add_meta_box(
						$this->fields['id'], 
						$this->fields['title'], 
						array(&$this , 'print_meta_fields'), 
						$page, 
						$this->fields['context'], 
						$this->fields['priority']
					);
				}
						
			}

			else {
				// print the fields
				add_meta_box(
					$this->fields['id'], 
					$this->fields['title'], 
					array(&$this , 'print_meta_fields'), 
					$this->fields['page'], 
					$this->fields['context'], 
					$this->fields['priority']
				);
			}
		}


		/**
		 * Print Fields
		 */
		public function print_meta_fields(){

			global $post;

			echo '<input type="hidden" name="'.$this->nonce.'" value="', wp_create_nonce(basename(__FILE__)), '" />';
     
		    echo '<div class="drop_meta_container">';

			foreach($this->fields['fields'] as $field){
		          
		        $meta = get_post_meta($post->ID, $field['id'], true);

				switch($field['type']){
		               
					case 'text' :
					    $out = '<div class="drop_meta_item">
					            <label for="'.$field['id'].'">'.$field['name'].'</label>
					            <div class="inner_meta">
					            <input type="text" class="meta_field" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />
					            
					            <div class="meta_description"><p>'.$field['desc'].'</p></div>
					            </div><!-- end inner -->
					            </div><!-- end single meta -->';
					            
					    echo $out;
					    
					    break;

					case 'textarea' :
					    $out = '<div class="drop_meta_item">
					            <label for="'.$field['id'].'">'.$field['name'].'</label>
					            <div class="inner_meta">
					            <textarea class="meta_field" id="'.$field['id'].'" name="'.$field['id'].'">'.$meta.'</textarea>
					            <div class="meta_description"><p>'.$field['desc'].'</p></div>
					            </div><!-- end inner -->
					            </div><!-- end single meta -->';
					            
					    echo $out;
					    break;

					case 'select' :
					    $out = '<div class="drop_meta_item">
					            <label for="'.$field['id'].'">'.$field['name'].'</label>
					            <div class="inner_meta">
					            <select id="'.$field['id'].'" name='.$field['id'].'>';
					            	foreach ($field['fields'] as $value) {
					            		if($meta == $value) $out .= '<option selected=selected>'.$value.'</option>';
					            		else $out .= '<option >'.$value.'</option>';
					            	}
					            $out .= '</select>
					            <div class="meta_description"><p>'.$field['desc'].'</p></div>
					            </div><!-- end inner -->
					            </div><!-- end single meta -->';
					            
					    echo $out;
					    break;


					case 'media_gallery' :

							// Media Gallery Code
						 $out = '<div class="drop_meta_item gallery">
					        <label for="'.$field['id'].'">'.$field['name'].'</label>
					        <div class="inner_meta">
					        <!-- images container -->
					        <div class="images-container"></div>
					        <!-- end images container -->

					        <input type="text" class="meta_field media_field_content" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />
					        <input type="button" name="uploader" class="owlab_media_uploader_button button button-primary" value="'.__('Add Images' , 'toranj').'">
					        <div class="meta_description"><p>'.$field['desc'].'</p></div>
					        </div><!-- end inner -->
					        </div><!-- end single meta -->';
					            
					    echo $out;
						break;
		               
		        }// end switch 
		    }// end foreach
		     
		    echo '</div><!-- end meta container --><br />';
		} 


		/**
		 * Save Meta Fields
		 */
		public function save_meta_fields($post_id) {

			global $post_id;

			// verify nonce
			if(isset($_POST[$this->nonce])) {

				if (!wp_verify_nonce($_POST[$this->nonce], basename(__FILE__))) {
		        	return $post_id;
		    	}

			}

		    // check autosave
		    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		        return $post_id;
		    }

		    // check permissions
		    if(!current_user_can('edit_post', $post_id))
		    {
		    	return $post_id;
		    }

		    foreach ($this->fields['fields'] as $single_field) {
		    	$id = $single_field['id'];
		        $old = get_post_meta($post_id, $id, true);


		        if(isset($_POST[$id]))
		        {   

		        	$new = $_POST[$id];
			        
			        if ($new && $new != $old) {
			            update_post_meta($post_id,  $id, $new);
			        } elseif ('' == $new && $old) {
			            delete_post_meta($post_id, $id, $old);
			        }

		    	}

		    }
		}



		/**
		 * Register Meta Scripts And Styles
		 */
		public function register_meta_scripts() {

			
			// check if this is post editing page
			if(strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php')){

				if(is_array($this->styles) && !empty($this->styles))
				{
					foreach ($this->styles as $key => $value) {
						wp_register_style($key , $value);
						wp_enqueue_style($key);
					}
				}

			}

		}


	}
}


/**
 * [$meta_styles the required styles for meta fields]
 * @var $new [instantiate post meta class [prefix , meta fields array , js , css , nonce id] ]
 * @var array
 */
$meta_styles = array(
	'blogget-meta-css' =>  get_template_directory_uri() . '/framework/post-meta/post-meta-styles.css'
);


// post meta fields



/**
 * [$new call the class , blogget is the theme main prefix]
 * [$post_fields , post meta fields]
 * @class owlab_POST_META
 */
$post_fields = array(
    'id' => 'owlab-meta-items',
    'title' => __('Post Settings','toranj'),
    'page' => array('post'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
					array(
			             'id' => 'ogg',
			             'desc' => __('Paste your UTR here , make usre to select the audio post format.','toranj'),
			             'name' => __('HTML5 Audio / Ogg','toranj'),
			             'type' => 'text'
			        ),
			        array(
			             'id' => 'mp3',
			             'desc' => __('Paste your UTR here, make sure to select the audio post format.','toranj'),
			             'name' => __('HTML5 Audio / Mp3','toranj'),
			             'type' => 'text'
			        ),
			        array(
			             'id' => 'video',
			             'desc' => __('Paste your video code here for video post format.','toranj'),
			             'name' => __('Embed Video','toranj'),
			             'type' => 'textarea'
			        ),
			        array(
			             'id' => 'audio',
			             'desc' => __('Insert audio code here for audio post format','toranj'),
			             'name' => __('Embed Audio','toranj'),
			             'type' => 'textarea'
			             ),
			        array(
			             'id' => 'link',
			             'desc' => __('Make sure link post format is selected.','toranj'),
			             'name' => __('Link','toranj'),
			             'type' => 'text'
			        ),
			        array(
			             'id' => 'quote',
			             'desc' => __('Add a quote post , select quote post format .','toranj'),
			             'name' => __('Quote','toranj'),
			             'type' => 'textarea'
			        ),
			        array(
			             'id' => 'quote-author',
			             'desc' => __('the quote author.','toranj'),
			             'name' => __('Quote Author','toranj'),
			             'type' => 'text'
			        ),
			        array(
			             'id' => 'status',
			             'desc' => __('Embed your tweet here.','toranj'),
			             'name' => __('Embed Twitter Status','toranj'),
			             'type' => 'textarea'
			        ),
			        array(
			        	'id' => 'owlab_media_gallery' ,
			        	'desc' => __('Create gallery and upload images by clicking on upload button , For multiple images selection , hold "CTRL (windows) / Command (mac) " button on your keyboard when clicking .' , 'toranj'),
			        	'name' => __('Create Gallery' , 'toranj') ,
			        	'type' => 'media_gallery'
			        )
                         
                )
    );



$new = new OWLAB_POST_META('blogget' , $post_fields , false , $meta_styles , 'blogget_postmeta_nonce');




?>