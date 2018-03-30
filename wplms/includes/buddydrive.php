<?php
/**
 * BUDDYDRIVE Connect for WPLMS
 *
 * @author      VibeThemes
 * @category    Admin
 * @package     Initialization
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class WPLMS_BuddyDrive{

    public static $instance;
    
    public static function init(){

        if ( is_null( self::$instance ) )
            self::$instance = new WPLMS_BuddyDrive();

        return self::$instance;
    }

    private function __construct(){
    	
    	add_action( 'bp_activity_post_form_button',array($this,'buddydrive_activity' ));
		add_action( 'bp_messages_compose_submit_buttons', array($this,'bp_message_compose' ));

    	add_filter('buddydrive_get_sharing_options',array($this,'sharing_options'));

		add_filter('buddydrive_admin_get_item_status',array($this,'privacy_status'));
		add_filter('buddydrive_get_item_privacy',array($this,'get_item_privacy'));
		add_filter('buddydrive_get_row_actions',array($this,'get_row_actions'));
		add_filter('buddydrive_current_user_can_link',array($this,'link_access'));
		add_filter('buddydrive_current_user_can_share',array($this,'can_share_course'));
		add_filter('buddydrive_default_item_privacy',array($this,'course_privacy'));


		add_filter('buddydrive_item_get',array($this,'course_drive_query'));
		add_filter('buddydrive_attachment_script_data',array($this,'script_data'));

		//Drive
		add_action('buddydrive_uploader_custom_fields',array($this,'course_fields'),10,1);
		add_action('buddydrive_save_item',array($this,'save_buddydrive'),10,2);

		add_filter('buddydrive_get_buddyfile_check_for',array($this,'check_for'),10,2);
		add_filter('buddydrive_file_downloader_can_download',array($this,'can_download'),10,2);
		add_action('buddydrive_file_downloaded',array($this,'buddydrive_file_downloaded'),10,1);

		add_filter('wplms_course_nav_menu',array($this,'course_drive_link'));
		
		
		add_action('wp_footer',array($this,'run_folder_javascript'));
		/*===== Permalink Setting === */
        add_action('wplms_course_action_point_permalink_settings',array($this,'permalink_setting'));
        add_filter('wplms_save_vibe_course_permalinks',array($this,'save_permalinks'));
        add_action('init', array($this,'add_endpoints'));
    	add_filter( 'request', array($this,'filter_request' ));
		add_action( 'template_redirect', array($this,'catch_vars' ),9);

		
		/*==== Upload Question type ====*/
		//add_filter('wplms_question_types',array($this,'upload_question_type'));
		//add_action('wplms_generate_question_html',array($this,'upload_question_html'));
		/*==== FRONT END ====*/
		//add_filter('wplms_course_creation_tabs',array($this,'add_drive_access'));
		//
		add_filter( 'buddydrive_use_deprecated_ui', '__return_true' );
    }

    function buddydrive_activity(){
    	if ( function_exists( 'buddydrive_editor' ) ) {
	        buddydrive_editor( 'whats-new' );
	    }
    }

    function bp_message_compose() {
	    if ( bp_is_my_profile() && function_exists( 'buddydrive_editor' ) ) {
	        buddydrive_editor( 'message_content' );
	    }
	}
    function sharing_options($options){
    	$options['course'] = __('My Courses','vibe');
    	return $options;
    }

    function buddydrive_get_usercourses(){
    	$user_id = get_current_user_id();
    	
    	global $wpdb;
    	$courses = array();
    	if(current_user_can('manage_options')){
    		$courses_query = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = 'course' AND post_status = 'publish'");
    		if(!empty($courses_query)){
    			foreach($courses_query as $course_query){
    				$courses[$course_query->ID] = $course_query->post_title;
    			}
    		}
    	}else{
    		if(current_user_can('edit_posts')){
    			$courses_author = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = 'course' AND post_status = 'publish' AND post_author = $user_id");
    			if(!empty($courses_author)){
	    			foreach($courses_author as $course_author){
	    				$courses[$course_author->ID] = $course_author->post_title;
	    			}
	    		}
    		}

    		$courses_query = $query = $wpdb->get_results($wpdb->prepare("
								    SELECT posts.ID as id AND posts.post_title as title
							      	FROM {$wpdb->posts} AS posts
							      	LEFT JOIN {$wpdb->usermeta} AS meta ON posts.ID = meta.meta_key
							      	WHERE   posts.post_type   = %s
							      	AND   posts.post_status   = %s
							      	AND   meta.user_id   = %d
							      	",'course','publish',$user_id));
    		if(!empty($courses_query)){
    			foreach($courses_query as $course_query){
    				$courses[$course_query->id] = $course_query->title;
    			}
    		}
    	}

    	if(empty($courses)){
    		echo '<div class="message">'.__('No course found','vibe').'</div>';
    	}else{
    		if(is_singular('course')){
    			echo '<input id="buddydrive_course" class="buddydrive-customs" type="hidden" name="buddydrive_course" value="'.get_the_ID().'">';
    			die();
    		}
    		?>
    		<label for="buddydrive_course"><?php echo _x('Select a course','Select course in Buddydrive options','vibe'); ?></label>
    		<select id="buddydrive_course" class="buddydrive-customs">
    			<?php foreach($courses as $id => $course){ ?>
    			<option value="<?php echo $id; ?>"><?php echo $course; ?></option>
    			<?php } ?>
    		</select>
    		<?php
    	}
    	die();

    }


	function privacy_status($args){
		if($args[1] == 'course'){
			$args[0] = '<i class="fa fa-tasks"></i>'.__('Course Only','vibe');
		}
		return $args;
	}

	function get_item_privacy($status){
		if($status['privacy'] == 'course'){
			global $buddydrive_template;
			$buddyfile_id = buddydrive_get_item_id();
			$item_privacy_id = !( empty( $buddydrive_template->query->post->post_parent ) ) ? $buddydrive_template->query->post->post_parent : $buddyfile_id ;
			$status['course'] = get_post_meta( $item_privacy_id, 'course', true );
		}
		return $status;
	}

	function get_row_actions($row_actions){
		

		global $buddydrive_template;

		$buddyfile_id = buddydrive_get_item_id();
		$privacy = buddydrive_get_item_privacy();

		if ( $privacy['privacy']  == 'course') {

			if ( buddydrive_current_user_can_link( $privacy ) ){
				$inside_top[]= '<a class="buddydrive-show-link" href="#">' . __( 'Link', 'vibe' ). '</a>';
				$inside_bottom .= '<div class="buddydrive-ra-link hide ba"><input type="text" class="buddydrive-file-input" id="buddydrive-link-' . esc_attr( $buddyfile_id ) . '" value="' . esc_url( buddydrive_get_action_link() ). '"></div>';
			}
			if ( buddydrive_current_user_can_share() && bp_is_active( 'activity' ) && bp_is_active( 'course' ) )
				$inside_top[]= '<a class="buddydrive-course-activity" href="#">' . __( 'Share', 'vibe' ). '</a>';
			if ( buddydrive_current_user_can_remove( $privacy['course'] ) && bp_is_active( 'course') )
				$inside_top[]= '<a class="buddydrive-remove-course" href="#" data-course="'. esc_attr( $privacy['course'] ).'">' . esc_html__( 'Remove', 'vibe' ). '</a>';

		}

		if ( ! empty( $inside_top ) )
			$inside_top = '<div class="buddydrive-action-btn">'. implode( ' | ', $inside_top ).'</div>';

		if ( ! empty( $inside_top ) )
			$row_actions .= '<div class="buddydrive-row-actions">' . $inside_top . $inside_bottom .'</div>';

		return $row_actions;
	}

	function course_privacy(){
		$status = buddydrive_get_item_privacy();

		if ( $status['privacy']  == 'course') {
			if( !empty( $status['course'] ) ){
				$course_id = get_post_meta( buddydrive_get_item_id(), 'course', true );
				if(has_post_thumbnail($course_id)){
					$thumbnail = get_the_post_thumbnail($course_id,array('32','32'));
				}else{
					$thumbnail = '<img src="'.vibe_get_option('default_course_avatar').'" width="32" height="32" />';
				}
				echo '<a href="'.get_permalink($course_id).'" >'.$thumbnail.'</a>';
			}
			else
				_e( 'Course', 'vibe' );
		}
	}


	function link_access($access){

		if ( $privacy['privacy'] == 'course' && bp_is_active('course') && ! empty( $privacy['course'] ) && bp_course_is_member( intval( $privacy['course'] ),bp_loggedin_user_id() ) )
			$can_link = true;

		return $access;
	}

	function can_share_course($r){
		if(is_singular('course'))
			return false;

		return $r;
	}
	function course_drive_query($querystring){
		global $post;
		if($post->post_type == 'course'){
			$querystring['meta_query']= array();
			$querystring['meta_query'][]=array(
				'key'=>'course',
				'value' =>$post->ID,
				'compare'=>'='
				);
		}

		return $querystring;
	}

	function script_data($script_data){
		if(is_singular('course')){
			$script_data['bp_params']['privacy'] = 'course';
			$script_data['bp_params']['customs'] = json_encode(array(array('name'=>'course','val'=>get_the_ID()),array('name'=>'buddydrive_course','val'=>1)));
		}
		return $script_data;
	}

	function course_fields($id = null){

    	global $wpdb;
    	$user_id = get_current_user_id();

    	if(is_singular('course')){
    		$enable = false;
	    	if(!empty($id)){
	    		$enable = get_post_meta($id,'buddydrive_course',true);
	    	}

    		$output = '
    		<div class="checkbox">
				<input type="checkbox" name="buddydrive_course" id="buddydrive_course" class="buddydrive-customs" value="1" '.(($enable)?'checked="checked"':'').' />
				<label for="buddydrive_course" class="hide_parent_next">'.__('Add to Course','vibe').'</label>
			</div>
			<input type="hidden" name="course" class="buddydrive-customs" value="'.get_the_ID().'" />';
    		echo apply_filters( 'buddydrive_single_course_drive', $output );
    		return;
    	}


    	$buddydrive_courses = array();
    	if(current_user_can('manage_options')){
    		$courses_query = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = 'course' AND post_status = 'publish'");
    		if(!empty($courses_query)){
    			foreach($courses_query as $course_query){
    				$buddydrive_courses[$course_query->ID] = $course_query->post_title;
    			}
    		}
    	}else{
    		if(current_user_can('edit_posts')){
    			$courses_author = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = 'course' AND post_status = 'publish' AND post_author = $user_id");
    			if(!empty($courses_author)){
	    			foreach($courses_author as $course_author){
	    				$buddydrive_courses[$course_author->ID] = $course_author->post_title;
	    			}
	    		}
    		}

    		$courses_query = $wpdb->get_results($wpdb->prepare("
								    SELECT posts.ID as id, posts.post_title as title
							      	FROM {$wpdb->posts} AS posts
							      	LEFT JOIN {$wpdb->usermeta} AS meta ON posts.ID = meta.meta_key
							      	WHERE   posts.post_type   = %s
							      	AND   posts.post_status   = %s
							      	AND   meta.user_id   = %d
							      	",'course','publish',$user_id));
    		if(!empty($courses_query)){
    			foreach($courses_query as $course_query){
    				$buddydrive_courses[$course_query->id] = $course_query->title;
    			}
    		}
    	}


    	$enable = false;
    	if(!empty($id)){
    		$enable = get_post_meta($id,'buddydrive_course',true);
    		$selected = get_post_meta($id,'course',true);
    	}
    	global $post;
    	if(is_singular('course')){
    		$enable = 1;
    		$selected = $post->ID;
    	}

		// building the select box
		if ( ! empty( $buddydrive_courses ) && is_array( $buddydrive_courses ) ) {
			
			$output = '<div class="checkbox">
				<input type="checkbox" name="buddydrive_course" id="buddydrive_course" class="buddydrive-customs" value="1" '.(($enable)?'checked="checked"':'').' />
				<label for="buddydrive_course" class="hide_parent_next">'.__('Add to Course','vibe').'</label>
			</div>
			<div '.(($enable)?'':'style="display:none;"').'><strong>'.__('Select Course','vibe').' </strong>
			<select name="course" class="buddydrive-customs">' ;
			foreach ( $buddydrive_courses as $course_id => $course_title ) {
				$output .= '<option value="'.$course_id.'" '. selected( $selected, $course_id, false ) .'>'.$course_title.'</option>';
			}
			$output .= '</select>
			</div>';
			echo '<script>
				jQuery(document).ready(function($){
					$("#buddydrive_course").on("change",function(){
						var $this = $(this);
						if($this.prop("checked")){ 
							$this.parent().next().show(200);
						}else{
							$this.parent().next().hide(200);
						}
					});
				});</script>';
			
		}

		echo apply_filters( 'buddydrive_get_select_user_courses', $output );
	}

	function save_buddydrive($id,$params){

		if(!empty($params['metas']) && !empty($params['metas']->buddydrive_meta)){
			foreach($params['metas']->buddydrive_meta as $meta){
				if(in_array($meta->cname,array('buddydrive_course','course'))){
					update_post_meta($id,$meta->cname,$meta->cvalue);	
				}
			}
		}
		$params = $_POST['bp_params'];
		if(!empty($params['customs'])){
			$customs = json_decode(stripslashes($params['customs']));
			foreach($customs as $custom){
				update_post_meta($id,$custom->name,$custom->val);
			}
		}
	}

	function check_for($check_for,$buddyfile){
		$privacy = get_post_meta( $buddyfile->ID, '_buddydrive_sharing_option', true );
		if($privacy == 'course'){
			$check_for = 'course';
		}
		return $check_for;
	}

	function can_download($can_download,$buddydrive_file){
		
		$user_id = get_current_user_id();
		if($buddydrive_file->check_for == 'course'){
			$course_id = get_post_meta($buddydrive_file->ID,'course',true);
		}

		if ( $buddydrive_file->user_id == bp_loggedin_user_id() || is_super_admin() )
			$can_download = true;
		elseif ( ! bp_is_active( 'course' ) ) {
			bp_core_add_message( __( 'Course component is deactivated, please contact the administrator.', 'vibe' ), 'error' );
			bp_core_redirect( buddydrive_get_root_url() );
			$can_download = false;
		}
		elseif ( bp_course_is_member(  $course_id , bp_loggedin_user_id() ) )
			$can_download = true;
		else {
			$redirect =get_permalink( $course_id );
			bp_core_add_message( __( 'You must be member of the course to download the file', 'vibe' ), 'error' );
			bp_core_redirect( $redirect );
			$can_download = false;
		}

		return $can_download;
	}
	function buddydrive_file_downloaded($buddyfile){
		
		if(!empty($buddyfile->ID)){ 
			
			if($buddyfile->check_for == 'course'){
				if(!is_user_logged_in()){
					wp_die(__('File can not be accessed','vibe'));
				}

				$user_id = get_current_user_id();
				$enable = get_post_meta($buddyfile->ID, 'buddydrive_course', true );
				if(!empty($enable)){
					$course_id = get_post_meta($buddyfile->ID, 'course', true );
					if(!bp_course_is_member($course_id,$user_id)){
						wp_die(__('File can not be accessed','vibe'));
					}
				}				
			}
		}
	}


	/*==== Course Menu ===*/

	function course_drive_link($nav){

		if(empty($this->permalinks))
       		$this->permalinks = get_option( 'vibe_course_permalinks' );
		
        $drive_slug = (isset($this->permalinks['drive_slug']))?$this->permalinks['drive_slug']:'drive';
		$flag = apply_filters('wplms_course_drive_access',1);
		if(!empty($flag)){
			$nav['drive'] = array(
	                    'id' => 'drive',
	                    'label'=>__('Drive ','vibe'),
	                    'action' => $drive_slug,
	                    'can_view' => 1,
	                    'link'=>bp_get_course_permalink(),
	                );
		}
    	return $nav;
	}

	function permalink_setting(){
        if(empty($this->permalinks))
       		$this->permalinks = get_option( 'vibe_course_permalinks' );
       	
        $drive_slug = ($this->permalinks['drive_slug'])?$this->permalinks['drive_slug']:'drive';
        ?>
        <tr>
            <th><label><?php _e('Drive','vibe'); ?></label></th>
            <td>
                <input name="drive_slug" type="text" value="<?php echo esc_attr( $drive_slug ); ?>" class="regular-text code"> <span class="description"><?php _e( 'Course Drive slug', 'vibe' ); ?></span>
            </td>
        </tr>
        <?php
    }

    function save_permalinks($permalinks){
        
        if(!empty($_POST['drive_slug'])){
            $drive_slug = trim( sanitize_text_field( $_POST['drive_slug'] ), '/' );
            $drive_slug = '/' . $drive_slug;
            $permalinks['drive_slug'] = untrailingslashit( $drive_slug );
        }
        return $permalinks;
    }

    function add_endpoints(){
    	if(empty($this->permalinks))
    		$this->permalinks = get_option( 'vibe_course_permalinks' );
        
        $drive_slug = isset($this->permalinks['drive_slug'])?$this->permalinks['drive_slug']:'drive';
        $drive_slug = str_replace('/','',$drive_slug);
        add_rewrite_endpoint($drive_slug, EP_ALL);    
    }

    function filter_request( $vars ){

    	if(empty($this->permalinks))
			$this->permalinks = get_option( 'vibe_course_permalinks' );

		$drive_slug = isset($this->permalinks['drive_slug'])?$this->permalinks['drive_slug']:'drive';
		$drive_slug = str_replace('/','',$drive_slug);
		if(isset( $vars[$drive_slug])){
			$vars[$drive_slug] = true;	
		}
	    return $vars;
	}

	function run_folder_javascript(){
		global $bp;
		if(bp_current_action('drive') || bp_current_component('drive') || (isset($_GET['action']) && $_GET['action'] == 'drive')){
		?>
		<script>
			jQuery(document).ready(function($){
				$('#buddydrive-form-filter li').on('click',function(){
					$('#buddydrive-form-filter li').removeClass('current');
					$(this).addClass('current');
				});
			});
		</script>
		<?php
		}
	}

	function catch_vars(){ 
		global $bp,$wp_query;	
		if(!class_exists('Vibe_CustomTypes_Permalinks'))	
			return;
		
		$permalinks = Vibe_CustomTypes_Permalinks::init();

		if($bp->unfiltered_uri[0] == trim($permalinks->permalinks['course_base'],'/') || $bp->unfiltered_uri[0] == BP_COURSE_SLUG){
				
				$drive_slug = ($this->permalinks['drive_slug'])?$this->permalinks['drive_slug']:'drive';
				$drive_slug = str_replace('/','',$drive_slug);
				
			    if( get_query_var( $drive_slug )){ 
			    	$bp->current_component = BP_COURSE_CPT;
			    	$bp->current_item = get_The_ID();
			        $bp->current_action = 'drive';

			        add_action('bp_course_plugin_template_content',array($this,'course_drive'));
			        do_action('buddydrive_enqueue_scripts');
					vibe_load_template('course/single/plugins');
					exit;
			    }
		}
	}

	function course_drive(){
		?>
		<form action="" method="get" id="buddydrive-form-filter">
			<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
				<ul>

					<?php do_action( 'buddydrive_member_before_toolbar' );?>
						<li class="current">
							<a href="<?php esc_url( buddydrive_component_home_url() );?>" name="home" id="buddydrive-home" data-project="<?php echo esc_attr( $post->id );?>"><?php _e( 'All Files', 'buddydrive');?></a>
						</li>
						<li id="buddydrive-action-new-file">
							<a href="#" id="buddy-new-file" title="<?php _e('New File', 'buddydrive');?>"><?php _e('New File', 'buddydrive');?></a>
						</li>
						<!--li id="buddydrive-action-new-folder">
							<a href="#" id="buddy-new-folder" title="<?php _e('New Folder', 'buddydrive');?>"><?php _e('New Folder', 'buddydrive');?></a>
						</li-->

					<li class="last"><?php esc_html_e( 'Order by:', 'buddydrive' );?>
						<select name="buddydrive_filter" id="buddydrive-filter">
							<option value="title"><?php esc_html_e( 'Name', 'buddydrive' ) ;?></option>
							<option value="modified"><?php esc_html_e( 'Last edit', 'buddydrive' ) ;?></option>
						</select>
					</li>

				</ul>
			</div>	
		</form>

		<div id="buddydrive-forms">

			<div id="buddydrive-file-uploader" class="hide">
				<?php buddydrive_upload_form();?>
			</div>
			<div id="buddydrive-folder-editor" class="hide">
				<?php buddydrive_folder_form()?>
			</div>
			<div id="buddydrive-edit-item" class="hide"></div>

		</div>

		<?php do_action( 'buddydrive_after_member_upload_form' ); ?>
		<?php do_action( 'buddydrive_before_member_body' );?>


				<div class="buddydrive single-project" role="main"> 
								
				<?php do_action( 'buddydrive_before_loop' ); ?>

				<?php if ( buddydrive_has_items( buddydrive_querystring() ) ): ?>

					<?php if ( empty( $_POST['page'] ) && empty( $_POST['folder'] ) ) : ?>

						<table id="buddydrive-dir" class="user-dir">
							<thead>
								<tr><th><?php buddydrive_th_owner_or_cb();?></th><th class="buddydrive-item-name"><?php _e( 'Name', 'buddydrive' );?></th><th class="buddydrive-privacy"><?php _e( 'Privacy', 'buddydrive' );?></th><th class="buddydrive-mime-type"><?php _e( 'Type', 'buddydrive' );?></th><th class="buddydrive-last-edit"><?php _e( 'Last edit', 'buddydrive' );?></th></tr>
							</thead>
							<tbody>
					<?php endif; ?>

					<?php while ( buddydrive_has_items() ) : buddydrive_the_item(); ?>

						<?php  if( empty( $_POST['createdid'] ) ) :?>

						<tr id="item-<?php buddydrive_item_id();?>">

						<?php endif;?>

								<td>
									<?php buddydrive_owner_or_cb();?>
								</td>
								<td>
									<div class="buddydrive-file-content"><?php buddydrive_item_icon();?>&nbsp;<a href="<?php buddydrive_action_link();?>" class="<?php buddydrive_action_link_class();?>" title="<?php esc_attr( buddydrive_item_title() );?>"<?php buddydrive_item_attribute();?>><?php buddydrive_item_title();?></a></div>
									<?php buddydrive_row_actions();?>
								</td>
								<td>
									<?php buddydrive_item_privacy();?>
								</td>
								<td>
									<?php buddydrive_item_mime_type();?>
								</td>
								<td>
									<?php buddydrive_item_date();?>
								</td>

						<?php if( empty( $_POST['createdid'] ) ) :?>

							</tr>

						<?php endif;?>


					<?php endwhile; ?>

					<?php if ( buddydrive_has_more_items() ) : ?>

						<tr>
							<td class="buddydrive-load-more" colspan="5">
								<a href="#more-buddydrive"><?php _e( 'Load More', 'buddydrive' ); ?></a>
							</td>
						</tr>

					<?php endif; ?>

					<?php if ( empty( $_POST['page'] ) && empty( $_POST['folder'] ) ) : ?>
							</tbody>
						</table>

					<?php endif; ?>

				<?php else : ?>

					<?php if ( empty( $_POST['page'] ) && empty( $_POST['folder'] ) ) : ?>
						<table id="buddydrive-dir" class="user-dir">
							<thead>
								<tr><th><?php buddydrive_th_owner_or_cb();?></th><th class="buddydrive-item-name"><?php _e( 'Name', 'buddydrive' );?></th><th class="buddydrive-privacy"><?php _e( 'Privacy', 'buddydrive' );?></th><th class="buddydrive-mime-type"><?php _e( 'Type', 'buddydrive' );?></th><th class="buddydrive-last-edit"><?php _e( 'Last edit', 'buddydrive' );?></th></tr>
							</thead>
							<tbody>
					<?php endif;?>
							<tr id="no-buddyitems">
								<td colspan="5">
									<div id="message" class="info">
										<p><?php printf( __( 'Sorry, there was no %s items found.', 'buddydrive' ), buddydrive_get_name() ); ?></p>
									</div>
								</td>
							</tr>
					<?php if ( empty( $_POST['page'] ) && empty( $_POST['folder'] ) ) : ?>
							</tbody>
						</table>
					<?php endif;?>
					

				<?php endif; ?>

				<?php do_action( 'buddydrive_after_loop' ); ?>

				<?php if ( empty( $_POST['page'] ) && empty( $_POST['folder'] ) ) : ?>

					<form action="" name="buddydrive-loop-form" id="buddydrive-loop-form" method="post">

						<?php wp_nonce_field( 'buddydrive_actions', '_wpnonce_buddydrive_actions' ); ?>

					</form>
				<?php endif;?>
			</div>
		<?php
	}


	function upload_question_type($types){
        $types[] = array( 'label' =>__('Upload type','vibe'),'value'=>'upload');
		return $types;
	}

	function upload_question_html(){
		echo '<div class="essay_text">';
		$this->buddydrive_id = 'question_upload_'.rand(0,999);
    	echo '<textarea id="'.$this->buddydrive_id.'" class="form_field" placeholder="'.__('Type answer','vibe').'"></textarea>';
    	
    	add_action('wp_footer',array($this,'buddydrive_init'));
    	echo '</div>';
	}

	function buddydrive_init(){
		if(function_exists('buddydrive_editor')){
    		buddydrive_editor($this->buddydrive_id);
    	}
	}

	function add_drive_access($settings){
		$drive_access[] = array(
							'label'=> __('Course Drive','vibe' ),
							'text'=>__('Drive Visibility','vibe' ),
							'type'=> 'select',
							'style'=>'',
							'id' => 'vibe_display_course_drive',
							'from'=> 'meta',
							'options'=>array(
								array('value'=>0,'label'=>__('Everyone','vibe')),
								array('value'=>1,'label'=>__('Logged in Users','vibe')),
								array('value'=>2,'label'=>__('Course Users','vibe')),
								array('value'=>3,'label'=>__('Instructors and Admins','vibe')),
							),
							'desc'=> __('Set Course/Drive Visibility','vibe' ),
						);
		$components = $settings['course_components']['fields'];
		array_splice($components,3,0,$drive_access);
	    $settings['course_components']['fields'] = $components;
		return $settings;
	}
}

if ( in_array( 'buddydrive/buddydrive.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	WPLMS_BuddyDrive::init(); 
}

