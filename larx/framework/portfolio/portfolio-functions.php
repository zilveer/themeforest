<?php

//
// Portfolio Post Type
//

add_action('init', 'th_portfolio_register');  

function th_portfolio_register() {
    $args = array(
        'label' => __('Portfolio', 'larx'),
		'menu_icon' => 'dashicons-id',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'supports' => array('title','editor','thumbnail')
       );  

    register_post_type( 'portfolio' , $args );
    
    register_taxonomy(
    	"project-type", 
    	array("portfolio"), 
    	array(
    		"hierarchical" => true, 
    		"context" => "normal", 
    		'show_ui' => true,
    		"label" => "Portfolio Categories", 
    		"singular_label" => "Portfolio Category", 
    		"rewrite" => true
    	)
    );
}

//
// New Columns
//

add_filter( 'manage_edit-portfolio_columns', 'th_portfolio_columns_settings' ) ;

function th_portfolio_columns_settings( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Title', 'larx'),
		'category' => __( 'Category', 'larx'),
		'date' => __('Date', 'larx'),
		'thumbnail' => ''	
	);

	return $columns;
}

add_action( 'manage_portfolio_posts_custom_column', 'th_portfolio_columns_content', 10, 2 );

function th_portfolio_columns_content( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'category' :

			$taxonomy = "project-type";
			$post_type = get_post_type($post_id);
			$terms = get_the_terms($post_id, $taxonomy);
		 
			if ( !empty($terms) ) {
				foreach ( $terms as $term )
					$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
				echo join( ', ', $post_terms );
			}
			else echo '<i>No categories.</i>';

			break;

		/* If displaying the 'genre' column. */
		case 'thumbnail' :

			the_post_thumbnail('thumbnail', array('class' => 'column-img'));

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}
	/**************************************/




function isAssoc($arr)
{
    return array_keys($arr) !== range(0, count($arr) - 1);
}

function th_create_dropdown($name,$elements,$current_value,$folds = NULL) {

    $folds_class = $selected = '';
    if($folds) $folds_class = ' portfolios';
    echo '<select id="nnn" name="'.$name.'" class="select'.$folds_class.'">';

    if(isAssoc($elements)) {

        foreach($elements as $title => $key) {

            if($key == $current_value) $selected = 'selected';

            echo '<option value="'.$key.'"'.$selected.'>'.$title.'</option>';

            $selected = '';
        }

    } else {

        foreach($elements as $key) {

            if($key == $current_value) $selected = 'selected';

            echo '<option value="'.$key.'"'.$selected.'>'.$key.'</option>';

            $selected = '';
        }

    }

    echo '</select>';

}

/*********************************************/

//Add Custom Fields

add_action("admin_init", "th_portfolio_extra_settings1");   

function th_portfolio_extra_settings1(){
    add_meta_box("portfolio_extra_settings1", "Portfolio Description", "th_portfolio_extra_settings_config1", "portfolio", "normal", "high");
}   

function th_portfolio_extra_settings_config1(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
        $project_desc = '';
		if(isset($custom["project_desc"][0])) $project_desc = $custom["project_desc"][0];
        $project_client = '';
        if(isset($custom["project_client"][0])) $project_client = $custom["project_client"][0];
        $project_website = '';
        if(isset($custom["project_website"][0])) $project_website = $custom["project_website"][0];

?>

	<div class="metabox-options form-table fullwidth-metabox">

			<div class="metabox-option">
				<h6><?php esc_html_e('Project date', 'larx') ?>:</h6>
                <input type="text" name="project_desc" value="<?php echo esc_attr($project_desc); ?>">
                <p class="description"><?php echo esc_html_e('If is not single page you can add here some additional description of your project. By default is a date.', 'larx') ?></p>
			</div>

            <div class="metabox-option project_client">
                <h6><?php esc_html_e('Client', 'larx') ?>:</h6>
                <input type="text" name="project_client" value="<?php echo esc_attr($project_client); ?>">
                <p class="description"><?php echo esc_html_e('Add here company or name of your client. (Only if single page is enabled)', 'larx') ?></p>
            </div>

            <div class="metabox-option project_website">
                <h6><?php esc_html_e('Website', 'larx') ?>:</h6>
                <input type="text" name="project_website" value="<?php echo esc_attr($project_website); ?>">
                <p class="description"><?php echo esc_html_e('Add here company website or link to project. (Only if single page is enabled)', 'larx') ?></p>
            </div>
			
	</div>
	
<?php	
}

add_action("admin_init", "th_portfolio_extra_settings");   

function th_portfolio_extra_settings(){
    add_meta_box("portfolio_extra_settings", "Portfolio Post Settings", "th_portfolio_extra_settings_config", "portfolio", "normal", "high");
}   

function th_portfolio_extra_settings_config(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
        $link_type = $name = $url = $portf_thumbnail = '';
		
		if (isset($custom["url"][0])) {
			$url = sanitize_text_field($custom["url"][0]);
		}
		if (isset($custom["name"][0])) {
			$name = sanitize_text_field($custom["name"][0]);
		}

		if(isset($custom["link_type"][0])) $link_type = $custom["link_type"][0];
        if(isset($custom["name"][0])) $name;
        if(isset($custom["url"][0])) $url;
        if(isset($custom["portf_thumbnail"][0])) $portf_thumbnail = $custom["portf_thumbnail"][0];

?>

	<div class="metabox-options form-table fullwidth-metabox">

		<div class="metabox-option">
			<h6><?php _e('Thumbnail Link Type', 'larx') ?>:</h6>

            <?php

            $link_type_arr = array('Default - Is opening in a Lightbox' => 'default', 'Video Link - Is opening a Video in a Lightbox' => 'direct', 'External Link - Opens a Custom Link' => 'external', 'Single Page - Opens a progect page' => 'single_page');

            th_create_dropdown('link_type',$link_type_arr,$link_type, true);

            ?>

            <p class="description"><?php echo esc_html_e('Choose what thumbnail does.', 'larx') ?></p>
        </div>

            <div class="metabox-option video-link">
                <h6><?php esc_html_e('Video link', 'larx') ?>:</h6>
                <input type="text" name="name" value="<?php echo esc_attr($name); ?>">
                <p class="description"><?php echo esc_html_e('You can set the thumbnail to open a video from third-party websites(Vimeo, YouTube) in an URL. Ex: http://www.youtube.com/watch?v=y6Sxv-sUYtM', 'larx') ?></p>
            </div>


            <div class="metabox-option ext-link">
                <h6><?php esc_html_e('External link', 'larx') ?>:</h6>
                <input type="text" name="url" value="<?php echo esc_attr($url); ?>">
                <p class="description"><?php echo esc_html_e('You can set the thumbnail to open a custom link.', 'larx') ?></p>
            </div>

        <div class="metabox-option">
            <h6><?php esc_html_e('Thumbnail Type', 'larx') ?>:</h6>
            <span>
				<input id="portf_thumbnail_1" type="radio" class="img-radio portfolio-small" name="portf_thumbnail" checked="checked" value="portfolio-small" <?php checked( $portf_thumbnail, 'portfolio-small' ); ?> >
				<div class="radio-label"><?php echo esc_html_e('Small Thumbnail', 'larx') ?></div>
				<img src="<?php echo get_template_directory_uri() ?>/framework/theme-options/assets/images/portfolio-small.png" id="small" class="of-radio-img" onclick="document.getElementById(&quot;portf_thumbnail_1&quot;).checked = true;" title="Small Thumbnail">
            </span>

            <span>
				<input id="portf_thumbnail_2" type="radio" class="img-radio half-vertical" name="portf_thumbnail" value="half-vertical" <?php checked( $portf_thumbnail, 'half-vertical' ); ?> >
                <div class="radio-label">Half Vertical</div>
				<img src="<?php echo get_template_directory_uri() ?>/framework/theme-options/assets/images/half-vertical.png" id="vertical" class="of-radio-img" onclick="document.getElementById(&quot;portf_thumbnail_2&quot;).checked = true;" title="Half Vertical">
                <div class="meta-desc-field"><p class="description"><?php echo esc_html_e('Working with the Portfolio Grid layout option.', 'larx') ?></p></div>
            </span>

        </div>

	</div>

<?php

}

// Save Custom Fields
	
add_action('save_post', 'th_save_portfolio_post_settings'); 

function th_save_portfolio_post_settings(){
    global $post;  

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}else{
		if (isset($_POST["project_desc"])) {	
			$project_desc = sanitize_text_field($_POST["project_desc"]);
		}
        if (isset($_POST["project_client"])) {
            $project_client = sanitize_text_field($_POST["project_client"]);
        }
        if (isset($_POST["project_website"])) {
            $project_website = sanitize_text_field($_POST["project_website"]);
        }
	
        if(isset($_POST["portf_thumbnail"])) update_post_meta($post->ID, "portf_thumbnail", $_POST["portf_thumbnail"]);
		if(isset($_POST["link_type"])) update_post_meta($post->ID, "link_type", $_POST["link_type"]);
		if(isset($_POST["gallery_images"])) update_post_meta($post->ID, "gallery_images", $_POST["gallery_images"]);
		if(isset($_POST["project_desc"])) update_post_meta($post->ID, "project_desc", $project_desc);
        if(isset($_POST["project_client"])) update_post_meta($post->ID, "project_client", $project_client);
        if(isset($_POST["project_website"])) update_post_meta($post->ID, "project_website", $project_website);
    }

}