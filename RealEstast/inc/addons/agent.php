<?php

class PGL_Addon_Agent {
    static function init() {
        self::register_post_type();
        self::add_actions();
        self::add_filters();
        self::add_shortcodes();
        self::add_image_size();
    }
    static function register_post_type() {
        register_post_type( 'estate_agent', array(
            'labels'       => array(
                'name'          => 'Agents',
                'singular_name' => 'Agent',
                'add_new'       => __( 'Add new agent', PGL ),
                'add_new_item'  => __( 'Add new agent', PGL ),
                'edit_item'     => __( 'Edit agent', PGL ),
                'view_item'     => __( 'View agent', PGL )
            ),
            'public'       => TRUE,
            'show_ui'      => TRUE,
            'hierarchical' => FALSE,
            'supports'     => array(
	            'title',
	            'editor',
	            'thumbnail'
            ),
	        'query_var' => true,
            'has_archive'  => TRUE,
            'rewrite'      => array(
	            'slug' => 'e_agent',
	            'with_front' => false
            ),
            'menu_icon'    => PGL_URI_IMG . 'icon/agent.jpg'
        ) );
    }

    static function add_option_panel() {
        global $pgl_options;
        $section = array(
            'id'         => 'agent',
            'icon'       => 'user',
            'title'      => __( 'Agent settings', PGL ),
            'fields'     => array(
                array(
                    'id'      => 'agent_single_layout',
                    'title'   => __( 'Agent detail layout', PGL ),
                    'type'    => 'select',
                    'options' => PGL_Utilities::list_template_file( 'templates/agent-single' ),
                    'std'     => 'agent-single-full-width'
                ),
                array(
                    'id'      => 'agent_list_layout',
                    'title'   => __( 'Agent listing layout', PGL ),
                    'type'    => 'select',
                    'options' => PGL_Utilities::list_template_file( 'templates/agent-loop' ),
                    'std'     => 'agent-loop-full-width'
                )
            )
        );

        $pgl_options->add_section( $section );
    }

    private static function add_actions() {
        add_action( 'admin_init', array( 'PGL_Addon_Agent', 'add_metabox' ) );
        add_action( 'save_post', array( 'PGL_Addon_Agent', 'save_metabox' ) );
        add_action( 'restrict_manage_posts', array( 'PGL_Addon_Agent', 'agent_restrict_manage_posts' ) );
        //
        add_action( 'manage_estate_agent_posts_custom_column', array( 'PGL_Addon_Agent', '_action_add_agent_columns' ), 50, 2 );
        add_action( 'manage_estate_posts_custom_column', array('PGL_Addon_Agent', '_action_add_agent_columns_to_estate'), 50, 2);
	    //add_action( 'init', 'init_cmb_meta_boxes', 9999 );
        add_action('init', array('PGL_Addon_Agent', 'agent_contact_post'));
    }

    private static function add_filters() {
        add_filter( 'manage_estate_agent_posts_columns', array( 'PGL_Addon_Agent', '_filter_add_agent_image_column' ) );
        add_filter( 'manage_estate_posts_columns', array( 'PGL_Addon_Agent', '_filter_add_agent_column_to_estate' ) );
        add_filter( 'parse_query', array( 'PGL_Addon_Agent', 'agent_restrict' ) );
//        add_filter('posts_join', array('PGL_Addon_Agent', 'estate_join_agent_table'));
	    add_filter( 'cmb_meta_boxes', array( 'PGL_Addon_Agent', '_init_metaboxes' ) );
    }

    private static function add_shortcodes() {
        add_shortcode( 'e_agent', array( 'PGL_Addon_Agent', 'shortcode_agent' ) );
        add_shortcode( 'agent_list', array( 'PGL_Addon_Agent', 'shortcode_agent_listing' ) );
    }

    static function add_image_size() {
        add_image_size( 'estate-agent-square-thumbnail', 180, 180, TRUE );
        add_image_size( 'estate-agent-square-small-thumbnail', 100, 100, TRUE );
    }

    static function agent_restrict_manage_posts() {
        global $typenow;
        if ( ! in_array( $typenow, array( 'estate' ) ) ) {
            return;
        }
        $agents = new WP_Query( array(
            'post_type' => 'estate_agent'
        ) );
        if ( $agents->have_posts() ) {
            echo '<select name="agent_id">';
            echo '<option value="0">Show all agents</option>';
            $selected_id = (isset($_GET['agent_id']) && ! empty($_GET['agent_id']) ? sanitize_key($_GET['agent_id']) : '');
            while ( $agents->have_posts() ) {
                $agents->the_post();
                $the_id = get_the_ID();
                ?>
                <option value="<?php echo $the_id; ?>" <?php if ($the_id == $selected_id) echo 'selected="selected"'; ?>><?php the_title(); ?></option>
            <?php
            }
            echo '</select>';
        }
    }

    /**
     * @param $query WP_Query
     *
     * @return mixed
     */
    static function agent_restrict( $query ) {
        global $typenow;
        global $pagenow;
        if ( $pagenow == 'edit.php' && $typenow == 'estate' && $query->is_main_query() ) {
            if ( isset( $_GET['agent_id'] ) && ! empty( $_GET['agent_id'] ) ) {
                $agent_id = sanitize_key($_GET['agent_id']);
                $query->set('meta_query', array(
                    array(
                        'key'     => 'agent_id',
                        'value'   => $agent_id,
                        'compare' => '='
                    )
                ));
            }
        }
        return $query;
    }
	static function _init_metaboxes( $meta_boxes ) {
		$meta_boxes['agent_metabox'] = array(
			'id' => 'agent_metabox',
			'title' => __('Agent', PGL),
			'pages' => array('estate'), // post type
			'context' => 'side',
			'priority' => 'high',
			'show_names' => false, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Agent', PGL),
					'desc' => __('Select agent', PGL),
					'id' => 'agent_id',
					'type' => 'multicheck',
					'options' => self::get_agent_select_options()
				),
			),
		);
		return $meta_boxes;
	}
    static function add_metabox() {
        add_meta_box( 'agent-more-info', __( 'More information', PGL ), array( 'PGL_Addon_Agent', 'agent_info_metabox' ), 'estate_agent', 'advanced', 'high' );

        //metabox Agent select on Estate edit page
        //add_meta_box( 'estate-agent', __( 'Agent', PGL ), array( 'PGL_Addon_Agent', 'estate_agent_select_box' ), 'estate', 'side', 'core' );
    }

    static function save_metabox() {
        global $post;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post->ID;
        }
        if ( is_null( $post ) )
            return NULL;

        switch ( $post->post_type ) {
            case 'estate':
            {
                update_post_meta( $post->ID, 'agent_id', $_POST['agent_id'] );
                break;
            }

            case 'estate_agent':
            {
                update_post_meta( $post->ID, 'agent_title', sanitize_text_field( $_POST['agent_title'] ) );
                update_post_meta( $post->ID, 'agent_phone', sanitize_text_field( $_POST['agent_phone'] ) );
                update_post_meta( $post->ID, 'agent_email', sanitize_text_field( $_POST['agent_email'] ) );
                break;
            }

            default:
                break;
        }
        return $post->ID;
    }

    static function agent_info_metabox() {
        global $post;
        $title = get_post_meta( $post->ID, 'agent_title', TRUE );
        $phone = get_post_meta( $post->ID, 'agent_phone', TRUE );
        $email = get_post_meta( $post->ID, 'agent_email', TRUE );
        ?>
        <table>
            <tr>
                <td>
                    <label for="agent_title"><?php _e( 'Title', PGL ); ?></label>
                </td>
                <td>
                    <input type="text" name="agent_title" id="agent_title" value="<?php echo esc_attr( $title ); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="agent_phone"><?php _e( 'Phone', PGL ); ?></label>
                </td>
                <td>
                    <input type="text" name="agent_phone" id="agent_phone" value="<?php echo esc_attr( $phone ); ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="agent_email"><?php _e( 'Email', PGL ); ?></label>
                </td>
                <td>
                    <input type="text" name="agent_email" id="agent_email" value="<?php echo esc_attr( $email ); ?>">
                </td>
            </tr>
        </table>
    <?php
    }
    static function agent_contact_post(){
        if (!empty($_POST['nonce_agent_form']))
        {
            if (!wp_verify_nonce($_POST['nonce_agent_form'], 'handle_agent_form'))
            {
                die('You are not authorized to perform this action.');
            } else {
                $error = null;
                if (!empty($_POST['contact_url'])){
                    die('You are not authorized to perform this action.');
                }
                $ctName = $_POST['contact_name'];
                $ctEmail = $_POST['contact_email'];
                $ctMsg = $_POST['contact_message'];
                $agEmail = $_POST['agent_email'];
                if (empty($ctName)){
                    $error = new WP_Error('empty_error', __('Please enter your name.', PGL));
                    wp_die($error->get_error_message(), __('Agent Contact Form Error', PGL));
                }elseif(empty($ctEmail)){
                    $error = new WP_Error('empty_error', __('Please enter your email.', PGL));
                    wp_die($error->get_error_message(), __('Agent Contact Form Error', PGL));
                }elseif(empty($ctMsg)){
                    $error = new WP_Error('empty_error', __('Please enter your message.', PGL));
                    wp_die($error->get_error_message(), __('Agent Contact Form Error', PGL));
                }else{
                    if(!is_email($ctEmail)){
                        $error = new WP_Error('empty_error', __('Please enter a valid email.', PGL));
                        wp_die($error->get_error_message(), __('Agent Contact Form Error', PGL));
                    }
// Email subject and body text
                    add_filter('wp_mail_from',array('PGL_Addon_Agent','mail_from'));
                    add_filter('wp_mail_from_name',array('PGL_Addon_Agent','mail_from_name'));
                    $subject = sprintf(__('Contact message from %s', PGL), $ctName);
// Call the wp_mail function, display message based on the result.
                    if( wp_mail( $agEmail, $subject, $ctMsg ) ) {
                        echo 'The test message was sent. Check your email inbox.';
                    } else {
                        $error = new WP_Error('empty_error', __('Error while trying to send email to agent.', PGL));
                        wp_die($error->get_error_message(), __('Agent Contact Form Error', PGL));
                    }
                }
            }
        }
    }
    static function mail_from() {
        $emailaddress = 'contact@1stwebdesigner.com';
        return $emailaddress;
    }

    static function mail_from_name() {
        $sendername = "1stWebDesigner.com - Dainis";
        return $sendername;
    }

	static function get_agent_select_options(){
		$options = array();
		$agents   = get_posts( array('nopaging' => true, 'post_type' => 'estate_agent' ) );
		foreach ( $agents as $agent ) {
			$options[$agent->ID] = $agent->post_title;
		}
		return $options;
	}
    static function estate_agent_select_box() {
        $agent_id = get_post_meta( get_the_ID(), 'agent_id', TRUE );
        $agents   = get_posts( array('nopaging' => true, 'post_type' => 'estate_agent' ) );
        ?>
        <select name="agent_id" id="agent_id">
	        <option value=""><?php _e('- Select Agent -', PGL);?></option>
            <?php
            foreach ( $agents as $agent ) {
                echo "<option value='{$agent->ID}' " . ( $agent_id == $agent->ID ? 'selected' : '' ) . ">{$agent->post_title}</option>";
            }
            ?>
        </select>
    <?php
    }

    static function _action_add_agent_columns( $col, $id ) {
        switch ( $col ) {
            case 'image':
            {
                echo '<a href="' . get_admin_url( NULL, 'post.php?post=' . $id . '&action=edit' ) . '">' . get_the_post_thumbnail( $id, 'estate-agent-square-small-thumbnail' ) . '</a>';
                break;
            }

            case 'slug':
            {
                $post_data = get_post( $id, ARRAY_A );
                echo $post_data['post_name'];
                break;
            }

            default:
                break;
        }
    }

    static function _action_add_agent_columns_to_estate( $col, $id) {
        switch( $col ) {
            case 'agent':{
                $agent_id = get_post_meta($id, 'agent_id', TRUE);
                if ( $agent_id ) {
                    echo '<a href="'. get_admin_url(NULL, 'post.php?post=' . $agent_id . '&action=edit') .'">'.get_the_title($agent_id).'</a>';
                }
                break;
            }
        }
    }

    static function _filter_add_agent_image_column( $col ) {
        // $spliced = array_splice($col, 1);
        // $col = $col + array('image' => 'Image') + $spliced;
        $col = PGL_Utilities::insert_into_array( 1, array( 'image' => 'Image' ), $col );
        $col = PGL_Utilities::insert_into_array( 3, array( 'slug' => 'Slug' ), $col );
        return $col;
    }

    static function _filter_add_agent_column_to_estate( $col ) {
        $col = PGL_Utilities::insert_into_array(2, array('agent' => 'Agent'), $col);
        return $col;
    }

    static function shortcode_agent( $atts ) {
        extract( shortcode_atts( array(
            'id'           => '',
            'name'         => '',
            'show'         => '',
            'image_size'   => '',
            'full_desc'    => 0
        ), $atts ) );
        /**
         * @var string $id
         * @var string $name
         * @var string $show
         * @var string $image_size
         * @var int    $full_desc
         */

        $agent = NULL;
        if ( $id ) {
            $agent = get_post( $id );
        }
        else if ( $name ) {
            $posts = get_posts( array(
                'name'           => $name,
                'post_type'      => 'estate_agent',
                'posts_per_page' => 1
            ) );
            if ( count( $posts ) ) {
                $agent = $posts[0];
            }
        }

        if ( is_null( $agent ) ) {
            return '';
        }

        if ( ! in_array( $image_size, array( 'square-thumbnail' ) ) ) {
            $image_size = 'square-thumbnail';
        }
	    $link = get_permalink( $agent->ID );
	    $name = $agent->post_name;
        $title = get_post_meta( $agent->ID, 'agent_title', TRUE );
	    $thumb = get_the_post_thumbnail( $agent->ID, 'estate-agent-' . $image_size );
		$excerpt = apply_filters('get_the_excerpt', $agent->post_content);
	    $extra_info = get_agent_extra_info( $agent->ID );
        $html = '';
        $html .= <<<HTML
<div class="ouragents">
	<div class="our-content">
		<div class="block-code">
		    <div class="our-border clearfix">
		        <div class="our-img">
		            <a href="{$link}" title="{$name}">{$thumb}</a>
		        </div>
		        <div class="our-info">
		            <h4>{$title}</h4>
		            <h5 class="name">
		                <a href="{$link}" title="{$name}">
						    {$name}
					    </a>
		            </h5>
		            <p>{$excerpt}</p>
		            <ul class="extra-info">{$extra_info}</ul>
		        </div>
		    </div>
	    </div>
	</div>
</div>
HTML;
        return $html;
    }

    static function shortcode_agent_listing( $atts = array() ) {
        extract( shortcode_atts( array(
            'id'         => '',
            'image_size' => '',
            'excerpt'    => false,
            'count'      => 6
        ), $atts ) );
        /**
         * @var string $id
         * @var int $count
         *
         * @var string $image_size
         */
        if ( $id ) {
            $id = explode( ',', $id );
        }
        $args = array(
            'post_type' => 'estate_agent'
        );
        if ( count( $id ) ) {
            $args['post__in'] = $id;
            $args['orderby'] = 'post__in';
        } else {
            $args['posts_per_page'] = $count;
        }
        if ( ! in_array( $image_size, array( 'square-thumbnail' ) ) ) {
            $image_size = 'square-thumbnail';
        }
        $the_query = new WP_Query( $args );
        $html =
            '<div class="grid_full_width agent-container">
                <div class="agent-view">
                    <div class="container">
                        <div class="ouragents">
                            <ul class="list_agents">';
        while ($the_query->have_posts()) { $the_query->the_post();
            $title = get_post_meta( get_post()->ID, 'agent_title', TRUE );
            $phone = get_post_meta( get_post()->ID, 'agent_phone', TRUE );
            $email = get_post_meta( get_post()->ID, 'agent_email', TRUE );
            $html .=
                '<li>
                    <div class="our-content">
                        <div class="our-border clearfix">
                            <div class="our-img">
                                <a href="' . get_permalink(get_post()->ID) . '" title="'.the_title('','',false).'">' . get_the_post_thumbnail( get_post()->ID, 'estate-agent-' . $image_size ) . '</a>
                            </div>
                            <div class="our-info">
                                <h4>'.$title.'</h4>
                                <h5 class="name">
                                    <a href="' . get_permalink(get_post()->ID) . '" title="'.the_title('','',false).'">
                                    '.the_title('','',false).'
                                    </a>
                                </h5>
                                <p>'. apply_filters('the_excerpt', get_the_excerpt()).'</p>
                                <ul class="extra-info">'.
                                    get_agent_extra_info( get_post()->ID )
                                .'</ul>
                            </div>
                        </div>
                    </div>
                </li>';
        }
        $html .= '</ul>
            </div>
        </div>
    </div>
</div>';
    return $html.wp_reset_query();
    }
}

/**
 * Get extra info from this agent (phone,email)
 *
 * @param int|object $id
 *
 * @return mixed|void
 */
function get_agent_extra_info( $id = 0 ) {
    if ( is_object( $id ) ) {
        $agent = $id;
    }
    else {
        $agent = get_post( $id );
    }
    $html = '';
	$agent_phone = get_post_meta( $agent->ID, 'agent_phone', TRUE );
	$agent_mail = get_post_meta( $agent->ID, 'agent_email', TRUE );
	if(!$agent_phone && !$agent_mail){
		return null;
	}else{
		$html .= '<ul class="extra-info">';
		$html .= $agent_phone ? '<li><span class="icon-space"><i class="fa fa-phone"></i></span>' . $agent_phone . '</li>':'';
		$html .= $agent_mail ? '<li><span class="icon-space"><i class="fa fa-envelope"></i></span><a href="mailto:' . $agent_mail . '">'.$agent_mail.'</a></li>':'';
		$html .= '</ul>';
	}
    return $html;
}

