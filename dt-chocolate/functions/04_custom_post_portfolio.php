<?php


if (!class_exists('PostPortfolio')) {

	class PostPortfolio {

      var $defaults = array(
         "post_size"		=> "m",
         "show"				=> "all",
		 "portf_3p"			=>''
      );

		function PostPortfolio($args = array()) {
			$this->register($args);
		}

		function register($args = array()) {
			$defaults = array(
				'label' => 'Portfolio options',
				'id' => 'poatportfolio',
				'post_type' => 'page',
				'priority' => 'low',
			);

         if ( isset($_GET['post']) )
         $this->post_id=$_GET['post'];
         //if (!$this->post_id) $this->post_id=the_ID();

         if (isset($args['post']))
         if ($args['post']) $this->post_id = $args['post'];

			$args = wp_parse_args($args, $defaults);

			// Create and set properties
			foreach($args as $k => $v) {
				$this->$k = $v;
			}

			add_action('add_meta_boxes', array($this, 'add_metabox'));
			add_action('save_post', array($this, 'save_page'));
			
		}
		
		function add_metabox() {   
			add_meta_box("dt_page_box-portfolio", __($this->label), array($this, 'thumbnail_meta_box'), $this->post_type, 'side', $this->priority);
			/*{$this->post_type}-{$this->id}*/
		}

		function thumbnail_meta_box() {
			global $post;
			$thumbnail_id = get_post_meta($post->ID, "{$this->post_type}_{$this->id}_thumbnail_id", true);
			echo $this->post_thumbnail_html($thumbnail_id);
		}

		function add_attachment_field($form_fields, $post) {
		}

		function has_post_thumbnail($post_type, $id, $post_id = null) {
			if (null === $post_id) {
				$post_id = get_the_ID();
			}

			if (!$post_id) {
				return false;
			}

			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}

		function the_post_thumbnail($post_type, $id, $post_id = null, $size = 'post-thumbnail', $attr = '') {
		}

		function get_post_thumbnail_id($post_type, $id, $post_id) {
			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}

		function post_thumbnail_html($thumbnail_id = NULL) {
			global $content_width, $_wp_additional_image_sizes, $post_ID;

         $nonce= wp_create_nonce  ('my-nonce');
         
         $myterms = get_terms('dt_portfolio_cat');
         
         $content='
    
<script src="'.get_template_directory_uri().'/js/admin_gallery.js"></script>
            
<input type="hidden" name="nonce_portf" value='.$nonce.' />

<p>
	<label for="portfolio_postsperpage">
		<input type="text" id="portfolio_postsperpage" name="portf_3p" value="'.$this->get_post_option('portf_3p'). '" size="4"/>
		Posts per page
	</label>
</p>
<p>
Show:<br />

<div class="showhide">
<label><input type="radio" name="show_type_portf" value="all" '.($this->get_post_option('show') == 'all' ? ' checked="checked"' : '').' /> All</label><br />
</div>

<div class="showhide">
<label><input type="radio" name="show_type_portf" value="only" '.($this->get_post_option('show') == 'only' ? ' checked="checked"' : '').' /> Only...</label><br />
<div style="margin-left: 20px; margin-bottom: 8px;" class="list">
   ';
   foreach ($myterms as $term)
   {
      $content .= '<label><input type="checkbox" name="show_portf[only][]" value="'.$term->term_id.'" '.(in_array($term->term_id, explode(",", $this->get_post_option('show_only'))) ? ' checked="checked"' : '').' /> '.$term->name.'</label><br />';
   }
   $content .= '
</div>
</div>

<div class="showhide">
<label><input type="radio" name="show_type_portf" value="except" '.($this->get_post_option('show') == 'except' ? ' checked="checked"' : '').' /> Except...</label><br />
<div style="margin-left: 20px; margin-bottom: 8px;" class="list">
   ';
   foreach ($myterms as $term)
   {
      $content .= '<label><input type="checkbox" name="show_portf[except][]" value="'.$term->term_id.'" '.(in_array($term->term_id, explode(",", $this->get_post_option('show_except'))) ? ' checked="checked"' : '').' /> '.$term->name.'</label><br />';
   }
   $content .= '
</div>
</div>
</p>
            ';

			return $content;
		}
		
		function get_post_option($name)
		{
		   global $post;
         $this->post_id=$post->ID;
		   $v = get_post_meta($this->post_id, '_option2_'.$name, true);
		   if (strlen($v) == 0)
		   {
		      if (!isset($this->defaults[$name])) return "";
		      return $this->defaults[$name];
		   }
		   return $v;
		}

		function set_post_option($name, $val)
		{
		   add_post_meta($this->post_id, '_option2_'.$name, $val, true);
		   update_post_meta($this->post_id, '_option2_'.$name, $val);
		}
		
		function save_page($post_id) {
		
		if (!isset($_POST['nonce_portf'])) return;
		
           if ( !wp_verify_nonce( $_POST['nonce_portf'], 'my-nonce' )) {
             return $post_id;
           }
           
           $this->post_id=$_POST['post_ID'];

           if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
             return $post_id;

           if ( 'page' == $_POST['post_type'] ) {
             if ( !current_user_can( 'edit_page', $post_id ) )
               return $post_id;
           } else {
               return $post_id;  
           }
           
           $this->set_post_option('show', $_POST['show_type_portf']);
           $this->set_post_option('portf_3p', (isset($_POST['portf_3p'])?$_POST['portf_3p']:''));
           
		   if( !isset($_POST['show_portf']) ) {
			return 0;
		   }
		   $_POST['show_portf'] = (array)$_POST['show_portf'];
           foreach (array('only', 'except') as $t)
           {
              $vals = array();
              
			  if( !isset($_POST['show_portf'][$t]) ) {
				continue;
			  }
              $_POST['show_portf'][$t] = (array)$_POST['show_portf'][$t];
              
              foreach ($_POST['show_portf'][$t] as $o)
              {
                 if ($o > 0)
                 {
                    $vals[] = $o;
                 }
              }
              
              $vals = implode(',', $vals);
              $this->set_post_option('show_'.$t, $vals);
           }

           return 1;
		}

	}
}

global $postportfolio;
$postportfolio=new PostPortfolio();

add_action( 'add_meta_boxes', 'dt_portfolio_ct__meta_box' );
add_action( 'save_post', 'dt_portfolio_ct_save' );

function dt_portfolio_ct__meta_box() {
	add_meta_box(
		'dt_page_box-portfolio',
		__( 'Portfolio Options', 'dt' ),
		'dt_portfolio_ct_options',
		'dt_portfolio'
	);
}

function dt_portfolio_ct_options( $post ) {
	// NAME OF THE BOX !
	$box_name = 'portfolio_ct';

	$data = get_post_meta( $post->ID, 'dt_'.$box_name.'_options', true );
	$defaults = array(
		'dt_hide_img'	=>false
	);
	$data = wp_parse_args( $data, $defaults );

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), $box_name.'_noncename' );
	?>
	<p>
		<input type="checkbox" id="dt_hide_img_<?php echo $box_name; ?>" name="dt_hide_img_<?php echo $box_name; ?>"<?php checked($data['dt_hide_img']); ?>/>
		<label for="dt_hide_img_<?php echo $box_name; ?>"><?php _e("hide featured image in details", LANGUAGE_ZONE ); ?></label>
	</p>
	<?php
}

function dt_portfolio_ct_save( $post_id ) {
	// NAME OF THE BOX !
	$box_name = 'portfolio_ct';
	
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !isset( $_POST[$box_name.'_noncename'] ) || !wp_verify_nonce( $_POST[$box_name.'_noncename'], plugin_basename( __FILE__ ) ) )
		return;

	if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	
	// OK, we're authenticated: we need to find and save the data
	$mydata = array();
	$mydata['dt_hide_img'] = isset($_POST['dt_hide_img_'.$box_name]);

	update_post_meta( $post_id, 'dt_'.$box_name.'_options', $mydata );
}