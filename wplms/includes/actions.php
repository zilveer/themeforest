<?php
/**
 * Action functions for WPLMS
 *
 * @author      VibeThemes
 * @category    Admin
 * @package     Initialization
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;


class WPLMS_Actions{

    public static $instance;
    
    public static function init(){

        if ( is_null( self::$instance ) )
            self::$instance = new WPLMS_Actions();

        return self::$instance;
    }

    private function __construct(){
    	
		add_action('init',array($this,'wplms_removeHeadLinks'));

		add_action('wp_head',array($this,'include_child_theme_styling'));

		add_action('template_redirect',array($this,'site_lock'),1);

		add_action( 'wp_ajax_reset_googlewebfonts',array($this,'reset_googlewebfonts' ));
          
		add_action( 'wp_ajax_import_data',array($this,'import_data' ));
		add_action('wplms_be_instructor_button',array($this,'wplms_be_instructor_button'));

		add_action( 'pre_get_posts', array($this,'course_search_results' ));

		add_action(	'template_redirect',array($this,'vibe_check_access_check'));
		add_action( 'template_redirect', array($this,'vibe_check_course_archive' ));
		add_action( 'template_redirect', array($this,'vibe_product_woocommerce_direct_checkout' ));
		add_action('woocommerce_order_item_name',array($this,'vibe_view_woocommerce_order_course_details'),2,100);
		
		add_action('woocommerce_share',array($this,'wplms_social_buttons_on_product'),1000);
		add_action('bp_core_activated_user',array($this,'vibe_redirect_after_registration'),99,3);

		add_Action('init',array($this,'wplms_course_yoast_Seo_fix'));

		// Course Actions 
		add_action('wplms_course_unit_meta',array($this,'vibe_custom_print_button'));
		add_action('wplms_course_start_after_time',array($this,'wplms_course_progressbar'),1,2);
		add_action('wp_ajax_record_course_progress',array($this,'wplms_course_progress_record'));

		/*=== Profile Layout 3 === */
		add_action('bp_before_member_body',array($this,'member_layout_3_before_item_tabs'));
		add_action('wplms_after_single_item_list_tabs',array($this,'member_layout_3_after_item_tabs'));
		add_action('bp_after_member_body',array($this,'member_layout_3_end_body'));

		add_action('wplms_before_single_group_item_list_tabs',array($this,'group_layout_3_before_item_tabs'));
		add_action('wplms_after_single_group_item_list_tabs',array($this,'group_layout_3_after_item_tabs'));
		add_action('bp_after_group_body',array($this,'group_layout_3_end_body'));

		if(class_exists('WPLMS_tips') && method_exists('WPLMS_tips', 'init')){
			$tips = WPLMS_tips::init(); // Use instead of get_option to avoid unnecessary sql call
			if(!empty($tips->settings) && !empty($tips->settings['woocommerce_account'])){
				/* ==== WooCommerce MY Orders ==== */
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  || (function_exists('is_plugin_active') && is_plugin_active( 'woocommerce/woocommerce.php'))) {
					add_action( 'bp_setup_nav', array($this,'woo_setup_nav' ));
					add_action( 'bp_init', array($this, 'woo_save_account_details' ) ,999);
					add_action('woocommerce_save_account_details',array($this,'woo_myaccount_page'));
					//Remove WooCommerce wrappers
					remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
					remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
				}

				if ( in_array( 'paid-memberships-pro/paid-memberships-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  || (function_exists('is_plugin_active') && is_plugin_active( 'paid-memberships-pro/paid-memberships-pro.php'))) {
					add_action( 'bp_setup_nav', array($this,'pmpro_setup_nav' ));
				}
			}
		}
 
		add_action( 'course-cat_add_form_fields', array( $this, 'add_category_fields' ));
		add_action( 'course-cat_edit_form_fields', array( $this, 'edit_category_fields' ));
		add_action( 'created_term', array($this,'save_category_meta'), 10, 2 );
		add_action( 'edited_term', array($this,'save_category_meta'), 10, 2 );
		//Transparent Header
		add_action('wp_head',array($this,'transparent_header_title_background'),99);
		
		add_action('wplms_certificate_before_full_content',array($this,'transparent_header_fix'));
		add_action('wplms_before_start_course_content',array($this,'transparent_header_fix'));

		// RESTRICT ACCESS
		add_action('wplms_before_members_directory',array($this,'wplms_before_members_directory'));
		add_action('wplms_before_activity_directory',array($this,'wplms_before_activity_directory'));
		add_action('wplms_before_groups_directory',array($this,'wplms_before_groups_directory'));
		add_action('wplms_before_member_profile',array($this,'wplms_before_member_profile'));

		//Profile settings radio button fix
		add_action('bp_activity_screen_notification_settings',array($this,'wrap_radio'));

		// My Courses search and filter : Also check filter.php function 
		add_action('bp_before_member_course_content',array($this,'mycourses_search'));

		add_action('wplms_before_single_course',array($this,'check_404_in_course'));

		
    }
	

	function check_404_in_course(){
	 	if(is_404()){
	   		$error404 = vibe_get_option('error404');
	   		if(isset($error404)){
	       		$page_id=  intval($error404);
	       		wp_redirect( get_permalink( $page_id ),301); 
	       		exit;
	   		}
	 	}
	}    
    function mycourses_search(){
    	if ( bp_is_current_action( BP_COURSE_RESULTS_SLUG ) || bp_is_current_action( BP_COURSE_STATS_SLUG )/* || bp_is_current_action('instructor-courses')*/)
    		return;
    	?>
    	<div class="item-list-tabs" id="subnav" role="navigation">
		<ul>
			<?php do_action( 'bp_course_directory_course_types' ); ?>
			<li>
				<div class="dir-search" role="search">
					<?php bp_directory_course_search_form(); ?>
				</div><!-- #group-dir-search -->
			</li>
			<li class="switch_view">
				<div class="grid_list_wrapper">
					<a id="list_view" class="active"><i class="icon-list-1"></i></a>
					<a id="grid_view"><i class="icon-grid"></i></a>
				</div>
			</li>
			<li id="course-order-select" class="last filter">

				<label for="course-order-by"><?php _e( 'Order By:', 'vibe' ); ?></label>
				<select id="course-order-by">
					<?php
					?>
					<option value=""><?php _e( 'Select Order', 'vibe' ); ?></option>
					<?php
						if(bp_is_current_action('instructor-courses')){
							?>
							<option value="draft"><?php _e( 'Draft courses', 'vibe' ); ?></option>
							<option value="pending"><?php _e( 'Submitted for Approval', 'vibe' ); ?></option>
							<option value="published"><?php _e( 'Published Courses', 'vibe' ); ?></option>
							<?php
						}else{
							?>
							<option value="pursuing"><?php _ex( 'Pursuing courses','Course Status filter in Profile My courses section', 'vibe' ); ?></option>
							<option value="finished"><?php _ex( 'Finished Courses','Course Status filter in Profile My courses section','vibe' ); ?></option>
							<option value="active"><?php _ex( 'Active courses','Course Status filter in Profile My courses section','vibe' ); ?></option>
							<option value="expired"><?php _ex( 'Expired courses','Course Status filter in Profile My courses section','vibe' ); ?></option>
							<?php
						}
					?>
					<option value="newest"><?php _ex( 'Newly Published','filter in Profile My courses section','vibe' ); ?></option>
					<option value="alphabetical"><?php _ex( 'Alphabetical','filter in Profile My courses section', 'vibe' ); ?></option>
					<option value="start_date"><?php _ex( 'Start Date','filter in Profile My courses section', 'vibe' ); ?></option>
					<?php do_action( 'bp_course_directory_order_options' ); ?>
				</select>
			</li>
		</ul>
	</div>
    	<?php
    }
    function wrap_radio(){
    	?>
    	<script>
    		jQuery(document).ready(function($){
    			$('td.yes,td.no').each(function(){
    				var html = $(this).html();
    				$(this).html('<div class="radio">'+html+'</div>');
    			});
    		});
    	</script>
    	<?php
    }
    /*
    CSS BACKGROUND WHICH APPLIES WHEN TRANSPARENT HEADER IS ENABLED
     */
    function transparent_header_title_background(){ 
    	$header_style =  vibe_get_customizer('header_style');

    	if($header_style == 'transparent'){ 
	    	if(is_page() || is_single() || (function_exists('bp_is_directory') &&  bp_is_directory()) || (function_exists('bp_current_component') &&  bp_current_component()) || is_archive() || is_search()){ 
	    		global $post;

	    		if(!is_archive() || bp_is_directory()){
	    			$title_bg = get_post_meta($post->ID,'vibe_title_bg',true);	
	    		}
	    		
	    		if(is_numeric($title_bg)){
    				$bg = wp_get_attachment_image_src($title_bg,'full');
    				
    				if(!empty($bg) && !empty($bg[0]))
    					$title_bg = $bg[0];
    			}	

    			if(empty($title_bg) || strlen($title_bg) < 5 ){
	    			$title_bg = vibe_get_option('title_bg');
	    			if(empty($title_bg)){
	    				$title_bg = VIBE_URL.'/assets/images/title_bg.jpg';
	    			}
	    		}

				if(!empty($title_bg)){
	    		?>
	    		<style>.course_header,.group_header{background:url(<?php echo $title_bg; ?>) !important;}#title{background:url(<?php echo $title_bg; ?>) !important;padding-bottom:30px !important; background-size: cover;}
	    		#title.dark h1,#title.dark h5,#title.dark a:not(.button),#title.dark,#title.dark #item-admins h3,#item-header.dark #item-header-content .breadcrumbs li+li:before,#title.dark .breadcrumbs li+li:before,.group_header.dark div#item-header-content,.group_header.dark #item-header-content h3 a,.bbpress.dark .bbp-breadcrumb .bbp-breadcrumb-sep:after,#item-header.dark #item-admins h3,#item-header.dark #item-admins h5,#item-header.dark #item-admins h3 a,#item-header.dark #item-admins h5 a,
	    		#item-header.dark #item-header-content a,#item-header.dark #item-header-content{color:#222 !important;}
	    		#title.light h1,#title.light h5,#title.light a:not(.button),#title.light,#title.light #item-admins h3,#item-header.light #item-header-content .breadcrumbs li+li:before,#item-header.light #item-admins h3,#item-header.light #item-admins h5,#item-header.light #item-admins h3 a,#item-header.light #item-admins h5 a,#title.light .breadcrumbs li+li:before,.group_header.light div#item-header-content,.group_header.light #item-header-content h3 a,.bbpress.light .bbp-breadcrumb .bbp-breadcrumb-sep:after,#item-header.light #item-header-content a,#item-header.light #item-header-content{color:#fff !important;}.bp-user div#global .pusher .member_header div#item-header{background:url(<?php echo $title_bg; ?>);}.group_header #item-header{background-color:transparent !important;}</style>
	    		<?php
	    		}
	    	}
    	}

		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    }

    function transparent_header_fix(){
    	$header_style =  vibe_get_customizer('header_style');

    	if($header_style == 'transparent'){ 
    		?>
    		<section id="title"></section>
    		<?php
    	}
    }
    function include_child_theme_styling(){
    	if (get_template_directory() !== get_stylesheet_directory()) {
	      	wp_enqueue_style('wplms_child_theme_style',get_stylesheet_uri(),'wplms-style');
	    }
    }


    function site_lock(){
    	$site_lock = vibe_get_option('site_lock');
    	$register_page_id = vibe_get_directory_page('register');
    	$activate_page_id = vibe_get_directory_page('activate');
    	$exlusions = apply_filters('wplms_site_lock_exclusions',array($register_page_id,$activate_page_id));
    	global $post;
    	if(!empty($site_lock) && !is_user_logged_in() && !is_front_page() && !in_Array($post->ID,$exlusions) && (bp_current_component()!='activate')){
    		wp_redirect( home_url() );
        	exit();
    	}
    }
    
	function wplms_removeHeadLinks(){
	  $xmlrpc = vibe_get_option('xmlrpc');
	  if(isset($xmlrpc) && $xmlrpc){
	    remove_action('wp_head', 'rsd_link');
	    remove_action('wp_head', 'wlwmanifest_link'); 
	    add_filter('xmlrpc_enabled','__return_false');
	  }
	}

	function reset_googlewebfonts(){ 
      	echo "reselecting..";
      	$r = get_option('google_webfonts');
      	if(isset($r)){
          	delete_option('google_webfonts');
      	}
	  	die();
	}

	function import_data(){
		if(!current_user_can('manage_options'))
  			die();

		$name = stripslashes($_POST['name']);
		$code = base64_decode(trim($_POST['code'])); 
		if(is_string($code))
    		$code = unserialize ($code);
		
		$value = get_option($name);
		if(isset($value)){
      		update_option($name,$code);
		}else{
			echo "Error, Option does not exist !";
		}
		die();
	}

	function wplms_course_yoast_Seo_fix(){
		if(function_exists('wpseo_frontend_head_init')){
			add_action( 'template_redirect', 'wpseo_frontend_head_init', 1);
		}
	}

	function wplms_be_instructor_button(){
		$teacher_form = vibe_get_option('teacher_form');

		if(isset($teacher_form) && is_numeric($teacher_form)){
			echo '<a href="'.(isset($teacher_form)?get_permalink($teacher_form):'#').'" class="button create-group-button full">'. __( 'Become an Instructor', 'vibe' ).'</a>';  
		}
	}

	function course_search_results($query){

	  if(!$query->is_search() && !$query->is_main_query())
	    return $query;

	  if(isset($_GET['course-cat']))
	      $course_cat = $_GET['course-cat'];

	  if(isset($_GET['instructor']))
	      $instructor = $_GET['instructor'];  

	  if ( function_exists('get_coauthors')) {
	    if(isset($instructor) && $instructor !='*' && $instructor !='' && is_numeric($instructor)){
	      $instructor_name = strtolower(get_the_author_meta('user_login',$instructor)); 
	      $query->set('author_name', $instructor_name);
	    }
	  }else{
	    if(isset($instructor) && $instructor !='*' && $instructor !=''){
	      $query->set('author', $instructor);
	    }
	  }

	  if(isset($course_cat) && $course_cat !='*' && $course_cat !=''){
	    $query->set('course-cat', $course_cat);
	  }
	  return $query;
	}


	function vibe_check_access_check(){ 

	    if(!is_singular(array('unit','question')))
	      return;

	    $flag=0;
	    global $post;

		$free=get_post_meta(get_the_ID(),'vibe_free',true);
   		if(vibe_validate($free) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && is_user_logged_in())){
	        	$flag=0;
	        	return;
	    }else
	    	$flag = 1;

	    if(current_user_can('edit_posts')){
	        $flag=0;
	        $instructor_privacy = vibe_get_option('instructor_content_privacy');
	        $user_id=get_current_user_id();
	        if(isset($instructor_privacy) && $instructor_privacy && !current_user_can('manage_options')){
	            if($user_id != $post->post_author)
	              $flag=1;
	        }
	    }

	    if($post->post_type == 'unit'){
	      	$post_type = __('UNITS','vibe');
	    }else if($post->post_type == 'question'){
	      	$post_type = __('QUESTIONS','vibe');
	    }

	    $message = sprintf(__('DIRECT ACCESS TO %s IS NOT ALLOWED','vibe'),$post_type);
	    $flag = apply_filters('wplms_direct_access_to'.$post->post_type,$flag,$post);
	    if($flag){
	        wp_die($message,$message,array('back_link'=>true));
	    }
	}

	
	function vibe_check_course_archive(){

	    if(is_post_type_archive('course') && !is_search()){
	        $pages=get_site_option('bp-pages');
	        if(is_array($pages) && isset($pages['course'])){
	          $all_courses = get_permalink($pages['course']);
	          wp_redirect($all_courses);
	          exit();
	        }
	    }
	}

	// Course functions
	function vibe_custom_print_button(){
		$print_html='<a href="#" class="print_unit"><i class="icon-printer-1"></i></a>';
		echo apply_filters('wplms_unit_print_button',$print_html);  
	}


	function wplms_course_progressbar($course_id,$unit_id){
	    $user_id=get_current_user_id();
	    $course_progressbar = vibe_get_option('course_progressbar');
	    if(!isset($course_progressbar) || !$course_progressbar)
	       return;

	    
	    $percentage = bp_course_get_user_progress($user_id,$course_id);

	    $units = array();
	    if(function_exists('bp_course_get_curriculum_units'))
	    	$units = bp_course_get_curriculum_units($course_id);

	    $total_units = count($units);
	    if(empty($total_units))
	    	$total_units = 1;
	   	if(empty($percentage)){
   			$percentage = 0;
	  	}
	    
	    if($percentage > 100)
	      $percentage= 100;

	    $unit_increase = round(((1/$total_units)*100),2);

	    echo '<div class="progress course_progressbar" data-increase-unit="'.$unit_increase.'" data-value="'.$percentage.'">
	             <div class="bar animate cssanim stretchRight load" style="width: '.$percentage.'%;"><span>'.$percentage.'%</span></div>
	           </div>';

	}


	function wplms_course_progress_record(){
	    $course_id = $_POST['course_id'];
	    if ( !isset($_POST['security']) || !wp_verify_nonce($_POST['security'],'security') || !is_numeric($course_id) ){
	       _e('Security check Failed. Contact Administrator.','vibe');
	       die();
	    }
	    $course_progress = $_POST['progress'];
	    $user_id = get_current_user_id();
	    $progress='progress'.$course_id;
	    update_user_meta($user_id,$progress,$course_progress);
	    die();
	}
	// END course Functions		
	function vibe_product_woocommerce_direct_checkout(){

	  	if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) || (function_exists('is_plugin_active') && is_plugin_active( 'woocommerce/woocommerce.php'))){
	        $check=vibe_get_option('direct_checkout');
	        $check =intval($check);
	    	if(isset($check) &&  $check == 2){
	      		if( is_single() && get_post_type() == 'product' && isset($_GET['redirect'])){
	          		global $woocommerce;
	          		$found = false;
	          		$product_id = get_the_ID();
	          		$courses = vibe_sanitize(get_post_meta(get_the_ID(),'vibe_courses',false));
	          		if(isset($courses) && is_array($courses) && count($courses)){
	            		if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
	              			foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
	                			$_product = $values['data'];
	                			if ( $_product->id == $product_id )
	                  				$found = true;
	              			}
	              			// if product not found, add it
	              			if ( ! $found )
	                			WC()->cart->add_to_cart( $product_id );
	                		$checkout_url = $woocommerce->cart->get_checkout_url();
	                		wp_redirect( $checkout_url);  
        				}else{
	              			// if no products in cart, add it
	              			WC()->cart->add_to_cart( $product_id );
	              			$checkout_url = $woocommerce->cart->get_checkout_url();
	              			wp_redirect( $checkout_url);  
	            		}
	            		exit();
	          		}
	      		}
	    	}
	    	if(isset($check) &&  $check == 3){ 
	      		if( is_single() && get_post_type() == 'product' && isset($_GET['redirect'])){ 
	          		global $woocommerce; 
	          		$found = false;
	          		$product_id = get_the_ID();
	          		$courses = vibe_sanitize(get_post_meta(get_the_ID(),'vibe_courses',false));
	          
	          		if(isset($courses) && is_array($courses) && count($courses)){
	            		if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
	              			foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
	                		$_product = $values['data'];
	                			if ( $_product->id == $product_id )
	                  				$found = true;
	              			}
	              			// if product not found, add it
	              			if ( ! $found )
	                			WC()->cart->add_to_cart( $product_id );
	                		$cart_url = $woocommerce->cart->get_cart_url(); 
	                		wp_redirect( $cart_url); 
	            		}else{
			              	WC()->cart->add_to_cart( $product_id );
			              	$cart_url = $woocommerce->cart->get_cart_url(); 
			              	wp_redirect( $cart_url);
	            		}
	            		exit();
	          		}
	      		}
	    	}
	  	} // End if WooCommerce Installed
	}

	function vibe_view_woocommerce_order_course_details($html, $item ){
		 
	  	$product_id=$item['item_meta']['_product_id'][0];
	  	if(isset($product_id) && is_numeric($product_id)){
	      	$courses = get_post_meta($product_id,'vibe_courses',true);
	      	if(!empty($courses) && is_Array($courses)){
		        $html .= ' [ <i>'.__('COURSE : ','vibe');
	        	foreach($courses as $course){ 
	          		if(is_numeric($course)){ 
	           			$html .= '<a href="'.get_permalink($course).'"><strong><i>'.get_post_field('post_title',$course).'</i></strong></a> ';
	          		}
	        	}
	        	$html .=' </i> ]';
	      	}
	  	}
	  	return $html;

	}
	
	function wplms_social_buttons_on_product(){
	    echo do_shortcode('[social_buttons]');
	}


	function vibe_redirect_after_registration($user_id, $key, $user){
		
		$bp = buddypress();
		
		$bp->activation_complete = true;

		if(current_user_can('manage_options'))
			return;

		//do not redirect if doing ajax - @Buddydev - Brajesh Singh.
		if ( defined('DOING_AJAX') ) {
			return ;
		}

	    if ( is_multisite() )
	      $hashed_key = wp_hash( $key );
	    else
	      $hashed_key = wp_hash( $user_id );

	    if ( file_exists( BP_AVATAR_UPLOAD_PATH . '/avatars/signups/' . $hashed_key ) )
	      @rename( BP_AVATAR_UPLOAD_PATH . '/avatars/signups/' . $hashed_key, BP_AVATAR_UPLOAD_PATH . '/avatars/' . $user_id );

	     
	    
	    $pageid=vibe_get_option('activation_redirect');
	    if(empty($pageid)){
	   	  wp_set_auth_cookie( $user_id, true, false );
	      bp_core_add_message( __( 'Your account is now active!', 'vibe' ) );
	      bp_core_redirect( apply_filters ( 'wplms_registeration_redirect_url', bp_core_get_user_domain( $user_id ), $user_id ) );      
	    }else{
	    	wp_set_auth_cookie( $user_id, true, false );	
	      	$link = get_permalink($pageid);
	      	bp_core_redirect( apply_filters ( 'wplms_registeration_redirect_url',$link, $user_id ) );      
	    }
	}

	/*=== Layout 3 ===*/
	function member_layout_3_before_item_tabs(){
		$layout = vibe_get_customizer('profile_layout');
		if($layout != 'p3')
			return;
		?>
			<div class="row">
				<div class="col-md-3">
		<?php
	}

	function member_layout_3_after_item_tabs(){
		$layout = vibe_get_customizer('profile_layout');
		if($layout != 'p3')
			return;
		?>
			</div>
			<div class="col-md-9">
		<?php
	}

	function member_layout_3_end_body(){
		$layout = vibe_get_customizer('profile_layout');
		if($layout != 'p3')
			return;
		?>
			</div>
		</div>
		<?php
	}

	function group_layout_3_before_item_tabs(){
		$layout = vibe_get_customizer('group_layout');
		if($layout != 'g3')
			return;
		?>
			<div class="row">
				<div class="col-md-3">
		<?php
	}
	function group_layout_3_after_item_tabs(){
		$layout = vibe_get_customizer('group_layout');
		if($layout != 'g3')
			return;
		?>
			</div>
			<div class="col-md-9">
		<?php
	}

	function group_layout_3_end_body(){
		$layout = vibe_get_customizer('profile_layout');
		if($layout != 'p3')
			return;
		?>
			</div>
		</div>
		<?php
	}


	function woo_setup_nav(){
		global $bp;
		$myaccount_pid = get_option('woocommerce_myaccount_page_id');

		if(is_numeric($myaccount_pid)){
			$slug = get_post_field('post_name',$myaccount_pid);
			bp_core_new_nav_item( array( 
	            'name' => __('My Orders', 'vibe' ), 
	            'slug' => $slug , 
	            'position' => 99,
	            'screen_function' => array($this,'woo_myaccount'), 
	            'default_subnav_slug' => '',
	            'show_for_displayed_user' => bp_is_my_profile(),
	            'default_subnav_slug'=> $slug
	      	) );


			$link = trailingslashit( bp_loggedin_user_domain() . $slug );

			bp_core_new_subnav_item( array(
				'name'            => __('My Orders', 'vibe' ), 
				'slug'            => $slug,
				'parent_slug'     => $slug,
				'parent_url'      => $link,
				'position'        => 10,
				'item_css_id'     => 'nav-' . $slug,
				'screen_function' => array( $this, 'woo_myaccount' ),
				'user_has_access' => bp_is_my_profile(),
				'no_access_url'   => home_url(),
			) );
			
			$endpoints = array(
				'edit-account' => get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' ),
			);

			$i=20;
			foreach($endpoints as $key => $endpoint){
				switch ( $endpoint ) {
					case 'edit-account' :
						$title = __( 'Edit Account Details', 'vibe' );
					break;
					default :
						$title = __( 'My Orders', 'vibe' );
					break;
				}
				$function = str_replace('-','_',$key);
				
				bp_core_new_subnav_item( array(
					'name'            => $title,
					'slug'            => $key,
					'parent_slug'     => $slug,
					'parent_url'      => $link,
					'position'        => $i,
					'item_css_id'     => 'nav-' . $key,
					'screen_function' => array( $this, $function ),
					'user_has_access' => bp_is_my_profile(),
					'no_access_url'   => home_url(),
				) );
				$i = $i+10;
			}
		}
	}
	function woo_myaccount() {

		if(!is_user_logged_in() || !function_exists('bp_is_my_profile') || !bp_is_my_profile())
			wp_redirect(home_url());

		$this->myaccount_pid = get_option('woocommerce_myaccount_page_id');
		add_action('bp_template_title',array($this,'woo_myaccount_title'));
		add_action('bp_template_content',array($this,'woo_myaccount_content'));
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );		
		exit;
	}
	
	function edit_account(){
		if(!is_user_logged_in() || !function_exists('bp_is_my_profile') || !bp_is_my_profile())
			wp_redirect(home_url());

		add_query_arg($bp->current_action);
		
		if(empty($this->myaccount_pid))
			$this->myaccount_pid = get_option('woocommerce_myaccount_page_id');


		add_action('bp_template_title',array($this,'woo_myaccount_edit_title'));
		add_action('bp_template_content',array($this,'woo_myaccount_edit_content'));
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
		exit;
	}

	function woo_myaccount_title(){
		echo '<h2>'.get_the_title($this->myaccount_pid).'</h2>';
	}

	function woo_myaccount_edit_title(){
		echo '<h2>'.__( 'Edit Account Details', 'vibe' ).'</h2>';
	}

	function woo_myaccount_content(){
		echo apply_filters('the_content',get_post_field('post_content',$this->myaccount_pid));
	}

	function woo_myaccount_edit_content(){
		ob_start();
		wc_get_template( 'myaccount/form-edit-account.php', array( 'user' => get_user_by( 'id', get_current_user_id() ) ) );
		$content = ob_get_clean();
		echo apply_filters('the_content',$content);
	}
	function woo_save_account_details(){
		if(isset($_POST)){
			WC_Form_Handler::save_account_details();
		}
	}

	function woo_myaccount_page(){
		$myaccount_pid = get_option('woocommerce_myaccount_page_id');
		if(is_numeric($myaccount_pid)){
			$slug = get_post_field('post_name',$myaccount_pid);
			$link = trailingslashit( bp_loggedin_user_domain() . $slug );
			wp_redirect($link);
			exit();
		}
	}

	/* === PMPRO ===== */
	function pmpro_setup_nav(){
		global $bp;
		if(empty($this->pmpro_account_pid))
			$this->pmpro_account_pid = get_option('pmpro_account_page_id');

		if(is_numeric($this->pmpro_account_pid)){
			$slug = get_post_field('post_name',$this->pmpro_account_pid);
			bp_core_new_nav_item( array( 
	            'name' => __('My Memberships', 'vibe' ), 
	            'slug' => $slug , 
	            'position' => 99,
	            'screen_function' => array($this,'pmpro_myaccount'), 
	            'default_subnav_slug' => '',
	            'show_for_displayed_user' => bp_is_my_profile(),
	            'default_subnav_slug'=> $slug
	      	) );


			$link = trailingslashit( bp_loggedin_user_domain() . $slug );

			bp_core_new_subnav_item( array(
				'name'            => __('My Memberships', 'vibe' ), 
				'slug'            => $slug,
				'parent_slug'     => $slug,
				'parent_url'      => $link,
				'position'        => 10,
				'item_css_id'     => 'nav-' . $slug,
				'screen_function' => array( $this, 'pmpro_myaccount' ),
				'user_has_access' => bp_is_my_profile(),
				'no_access_url'   => home_url(),
			) );
		}
	}
	function pmpro_myaccount() {

		if(!is_user_logged_in() || !function_exists('bp_is_my_profile') || !bp_is_my_profile())
			wp_redirect(home_url());
		
		if(empty($this->pmpro_account_pid))
			$this->pmpro_account_pid = get_option('pmpro_account_page_id');

		add_action('bp_template_title',array($this,'pmpro_myaccount_title'));
		add_action('bp_template_content',array($this,'pmpro_myaccount_content'));
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );		
		exit;
	}

	function pmpro_myaccount_title(){
		echo '<h2>'.get_the_title($this->pmpro_account_pid).'</h2>';
	}

	function pmpro_myaccount_content(){
		echo apply_filters('the_content',get_post_field('post_content',$this->pmpro_account_pid));
	}



    /*
    *	Add Course Category Featured thubmanils
    *	Use WP 4.4 Term meta for storing information
    * 	@reference : WooCommerce (GPLv2)
    */
    function add_category_fields(){
    	
    	$default = vibe_get_option('default_avatar');

    	?>
    	<div class="form-field">
    	<label><?php _e( 'Display Order', 'vibe' ); ?></label>
    	<input type="number" name="course_cat_order" id="course_cat_order" value="" />
    	</div>
    	<div class="form-field">
			<label><?php _e( 'Thumbnail', 'vibe' ); ?></label>
			<div id="course_cat_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $default ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="course_cat_thumbnail_id" name="course_cat_thumbnail_id" />
				<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'vibe' ); ?></button>
				<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'vibe' ); ?></button>
			</div>
			<script type="text/javascript">
				if ( ! jQuery( '#course_cat_thumbnail_id' ).val() ) {
					jQuery( '.remove_image_button' ).hide();
				}
				// Uploading files
				var file_frame;

				jQuery( document ).on( 'click', '.upload_image_button', function( event ) {
					event.preventDefault();
					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( "Choose an image", "vibe" ); ?>',
						button: {
							text: '<?php _e( "Use image", "vibe" ); ?>'
						},
						multiple: false
					});
					file_frame.on( 'select', function() {
						var attachment = file_frame.state().get( 'selection' ).first().toJSON();
						jQuery( '#course_cat_thumbnail_id' ).val( attachment.id );
						jQuery( '#course_cat_thumbnail' ).find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );
						jQuery( '.remove_image_button' ).show();
					});
					file_frame.open();
				});

				jQuery( document ).on( 'click', '.remove_image_button', function() {
					jQuery( '#course_cat_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( $default ); ?>' );
					jQuery( '#course_cat_thumbnail_id' ).val( '' );
					jQuery( '.remove_image_button' ).hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</div>
		<?php
    }
    /*
    *	Edit Course Category Featured thubmanils
    *	Use WP 4.4 Term meta for storing information
    * 	@reference : WooCommerce (GPLv2)
    */
    function edit_category_fields($term){


    	$thumbnail_id = absint( get_term_meta( $term->term_id, 'course_cat_thumbnail_id', true ) );
    	$order = get_term_meta( $term->term_id, 'course_cat_order', true ); 
		if ( $thumbnail_id ) {
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		} else {
			$default = vibe_get_option('default_avatar');
			$image = $default;
		}

    	?>
    	<tr class="form-field">
    		<th scope="row" valign="top"><label><?php _e( 'Display Order', 'vibe' ); ?></label></th>
			<td><input type="number" name="course_cat_order" id="course_cat_order" value="<?php echo (empty($order)?0:$order); ?>" /></td>
    	</tr>
    	<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e( 'Thumbnail', 'vibe' ); ?></label></th>
			<td>
				<div id="course_cat_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="course_cat_thumbnail_id" name="course_cat_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
					<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'vibe' ); ?></button>
					<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'vibe' ); ?></button>
				</div>
				<script type="text/javascript">

					// Only show the "remove image" button when needed
					if ( '0' === jQuery( '#course_cat_thumbnail_id' ).val() ) {
						jQuery( '.remove_image_button' ).hide();
					}

					// Uploading files
					var file_frame;

					jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}

						// Create the media frame.
						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php _e( "Choose an image", "vibe" ); ?>',
							button: {
								text: '<?php _e( "Use image", "vibe" ); ?>'
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							var attachment = file_frame.state().get( 'selection' ).first().toJSON();

							jQuery( '#course_cat_thumbnail_id' ).val( attachment.id );
							jQuery( '#course_cat_thumbnail' ).find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );
							jQuery( '.remove_image_button' ).show();
						});

						// Finally, open the modal.
						file_frame.open();
					});

					jQuery( document ).on( 'click', '.remove_image_button', function() {
						jQuery( '#course_cat_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( $image ); ?>' );
						jQuery( '#course_cat_thumbnail_id' ).val( '' );
						jQuery( '.remove_image_button' ).hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
    }


	function save_category_meta( $term_id, $tt_id ){
		global $wpdb;
	    if( isset( $_POST['course_cat_thumbnail_id'] )){
	        $thumb_id = intval( $_POST['course_cat_thumbnail_id'] );
	        update_term_meta( $term_id, 'course_cat_thumbnail_id', $thumb_id );
	    }
	    if( isset( $_POST['course_cat_order'] ) &&is_numeric($_POST['course_cat_order'])){
	        update_term_meta( $term_id, 'course_cat_order', $_POST['course_cat_order'] );
	        $wpdb->update($wpdb->terms, array('term_group' => $_POST['course_cat_order']), array('term_id'=>$term_id));
	    }
	}

	/*
	RESTRICTI DIRECTORY & PROFILE ACCESS
	*/

	function wplms_before_members_directory(){

	  $flag=1;
	  $members_view=vibe_get_option('members_view');

	  if(isset($members_view) && $members_view){
	    $flag=0;
	    switch($members_view){
	      case 1:
	        if(is_user_logged_in())$flag=1;
	      break;
	      case 2:
	        if(current_user_can('edit_posts'))$flag=1;
	      break;
	      case 3:
	        if(current_user_can('manage_options'))$flag=1;
	      break;
	    }
	  }

	  if(!$flag){
	    $id=vibe_get_option('members_redirect');
	    if(isset($id))
	      wp_redirect(get_permalink($id));
	  	else
	  		wp_redirect(home_url());
	    exit();
	  }
	}

	function wplms_before_activity_directory(){
		$flag=1;
		$activity_view=vibe_get_option('activity_view');

	  	if(isset($activity_view) && $activity_view){
		    $flag=0;
		    switch($activity_view){
		      case 1:
		        if(is_user_logged_in())$flag=1;
		      break;
		      case 2:
		        if(current_user_can('edit_posts'))$flag=1;
		      break;
		      case 3:
		        if(current_user_can('manage_options'))$flag=1;
		      break;
		    }
	  	}

	  	if(!$flag){
		    $id=vibe_get_option('activity_redirect');
		    if(isset($id)){
		      wp_redirect(get_permalink($id));
		    }else{
		    	wp_redirect(home_url());
		    }
		    exit();
	  	}
	}

	function wplms_before_groups_directory(){
		$flag=1;
		$group_view=vibe_get_option('group_view');

	  	if(isset($group_view) && $group_view){
		    $flag=0;
		    switch($group_view){
		      case 1:
		        if(is_user_logged_in())$flag=1;
		      break;
		      case 2:
		        if(current_user_can('edit_posts'))$flag=1;
		      break;
		      case 3:
		        if(current_user_can('manage_options'))$flag=1;
		      break;
		    }
	  	}

	  	if(!$flag){
		    $id=vibe_get_option('group_redirect');
		    if(isset($id)){
		      wp_redirect(get_permalink($id));
		    }else{
		    	wp_redirect(home_url());
		    }
		    exit();
	  	}
	}

	function wplms_before_member_profile(){

	  $flag=1;
	  $members_view=vibe_get_option('single_member_view');

	  if(isset($members_view) && $members_view){
	    $flag=0;
	    switch($members_view){
	      case 1:
	        if(is_user_logged_in())$flag=1;
	      break;
	      case 2:
	        if(current_user_can('edit_posts'))$flag=1;
	      break;
	      case 3:
	        if(current_user_can('manage_options'))$flag=1;
	      break;
	    }
	  }

	  if(!$flag && !bp_is_my_profile()){
	    $id=vibe_get_option('members_redirect');
	    if(isset($id))
	      wp_redirect(get_permalink($id));
	    exit();
	  }
	}
}

WPLMS_Actions::init();