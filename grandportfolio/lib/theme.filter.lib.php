<?php
// A callback function to add a custom field to our "gallery categories" taxonomy
function grandportfolio_gallerycat_taxonomy_custom_fields($tag) {

   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="gallerycat_template"><?php esc_html_e('Gallery Category Page Template', 'grandportfolio-translation'); ?></label>
	</th>
	<td>
		<select name="gallerycat_template" id="gallerycat_template">
			<?php
				//Get all gallery archive templates
				$tg_gallery_archive_templates = array(
					'gallery-archive-fullscreen' => 'Fullscreen',
					'gallery-archive-split-screen' => 'Split Screen',
					'gallery-archive-2-contained' => '2 Columns Contained', 
					'gallery-archive-3-contained' => '3 Columns Contained',
					'gallery-archive-4-contained' => '4 Columns Contained',
					'gallery-archive-2-wide' => '2 Columns Wide',
					'gallery-archive-3-wide' => '3 Columns Wide',
					'gallery-archive-4-wide' => '4 Columns Wide',
					'gallery-archive-parallax' => 'Parallax',
				);
				
				foreach($tg_gallery_archive_templates as $key => $tg_gallery_archive_template)
				{
			?>
			<option value="<?php echo esc_attr($key); ?>" <?php if($term_meta['gallerycat_template']==$key) { ?>selected<?php } ?>><?php echo esc_html($tg_gallery_archive_template); ?></option>
			<?php
				}
			?>
		</select>
		<br />
		<span class="description"><?php esc_html_e('Select page template for this gallery category', 'grandportfolio-translation'); ?></span>
	</td>
</tr>

<?php
}

// A callback function to save our extra taxonomy field(s)
function grandportfolio_save_gallerycat_custom_fields( $term_id ) {
    if ( isset( $_POST['gallerycat_template'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );

        if ( isset( $_POST['gallerycat_template'] ) ){
            $term_meta['gallerycat_template'] = $_POST['gallerycat_template'];
        }
        
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}

// Add the fields to the "gallery categories" taxonomy, using our callback function
add_action( 'gallerycat_edit_form_fields', 'grandportfolio_gallerycat_taxonomy_custom_fields', 10, 2 );

// Save the changes made on the "presenters" taxonomy, using our callback function
add_action( 'edited_gallerycat', 'grandportfolio_save_gallerycat_custom_fields', 10, 2 );


// A callback function to add a custom field to our "gallery categories" taxonomy
function grandportfolio_portfoliosets_taxonomy_custom_fields($tag) {

   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="portfoliosets_template"><?php esc_html_e('Portfolio Category Page Template', 'grandportfolio-translation'); ?></label>
	</th>
	<td>
		<select name="portfoliosets_template" id="portfoliosets_template">
			<?php
				//Get all gallery archive templates
				$tg_gallery_archive_templates = array(
					'portfolio-fullscreen' => 'Fullscreen',
					'portfolio-parallax' => 'Parallax',
					'portfolio-2-contained' => '2 Columns Contained',
					'portfolio-3-contained' => '3 Columns Contained',
					'portfolio-4-contained' => '4 Columns Contained',
					'portfolio-2-contained-classic' => '2 Columns Classic',
					'portfolio-3-contained-classic' => '3 Columns Classic',
					'portfolio-4-contained-classic' => '4 Columns Classic',
					'portfolio-2-contained-masonry-classic' => '2 Columns Masonry Classic',
					'portfolio-2-wide' => '2 Columns Wide',
					'portfolio-3-wide' => '3 Columns Wide',
					'portfolio-4-wide' => '4 Columns Wide',
					'portfolio-5-wide' => '5 Columns Wide',
					'portfolio-2-wide-classic' => '2 Columns Wide Classic',
					'portfolio-3-wide-classic' => '3 Columns Wide Classic',
					'portfolio-4-wide-classic' => '4 Columns Wide Classic',
					'portfolio-3-wide-masonry' => 'Masonry',
					'portfolio-split-screen' => 'Split Screen',
					'portfolio-split-screen-wide' => 'Split Screen Wide',
					'portfolio-split-screen-masonry' => 'Split Screen Masonry',
				);
				
				foreach($tg_gallery_archive_templates as $key => $tg_gallery_archive_template)
				{
			?>
			<option value="<?php echo esc_attr($key); ?>" <?php if($term_meta['portfoliosets_template']==$key) { ?>selected<?php } ?>><?php echo esc_html($tg_gallery_archive_template); ?></option>
			<?php
				}
			?>
		</select>
		<br />
		<span class="description"><?php esc_html_e('Select page template for this gallery category', 'grandportfolio-translation'); ?></span>
	</td>
</tr>
<tr class="form-field">
	<th scope="row" valign="top">
		<label for="portfoliosets_custom_url"><?php esc_html_e('Custom URL', 'grandportfolio-translation'); ?> (<?php esc_html_e('Optional', 'grandportfolio-translation'); ?>)</label>
	</th>
	<td>
		<input name="portfoliosets_custom_url" id="portfoliosets_custom_url" value="<?php if(isset($term_meta['portfoliosets_custom_url'])) { echo esc_attr($term_meta['portfoliosets_custom_url']); } ?>" size="40"/>
		<br />
		<span class="description"><?php esc_html_e('Enter custom portfolio URL for this portfolio category. It will replace default portfolio category URL', 'grandportfolio-translation'); ?></span>
	</td>
</tr>

<?php
}

// A callback function to save our extra taxonomy field(s)
function grandportfolio_save_portfoliosets_custom_fields( $term_id ) {
    if ( isset( $_POST['portfoliosets_template'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );

        if ( isset( $_POST['portfoliosets_template'] ) ){
            $term_meta['portfoliosets_template'] = $_POST['portfoliosets_template'];
        }
        
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
    
    if ( isset( $_POST['portfoliosets_custom_url'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );

        if ( isset( $_POST['portfoliosets_custom_url'] ) ){
            $term_meta['portfoliosets_custom_url'] = $_POST['portfoliosets_custom_url'];
        }
        
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}

// Add the fields to the "portfolio categories" taxonomy, using our callback function
add_action( 'portfoliosets_edit_form_fields', 'grandportfolio_portfoliosets_taxonomy_custom_fields', 10, 2 );

// Save the changes made on the "presenters" taxonomy, using our callback function
add_action( 'edited_portfoliosets', 'grandportfolio_save_portfoliosets_custom_fields', 10, 2 );


function grandportfolio_tag_cloud_filter($args = array()) {
   $args['smallest'] = 13;
   $args['largest'] = 13;
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'grandportfolio_tag_cloud_filter', 90);

//Control post excerpt length
function grandportfolio_custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'grandportfolio_custom_excerpt_length', 200 );

//Customise Widget Title Code
add_filter( 'dynamic_sidebar_params', 'grandportfolio_wrap_widget_titles', 1 );
function grandportfolio_wrap_widget_titles( array $params ) 
{
	$widget =& $params[0];
	$widget['before_title'] = '<h2 class="widgettitle"><span>';
	$widget['after_title'] = '</span></h2>';
	
	return $params;
}

/**
 * Change default fields, add placeholder and change type attributes.
 *
 * @param  array $fields
 * @return array
 */
add_filter( 'comment_form_default_fields', 'grandportfolio_comment_placeholders' );
 
function grandportfolio_comment_placeholders( $fields )
{
    $fields['author'] = str_replace('<input', '<input placeholder="'. esc_html__('Name', 'grandportfolio-translation'). '*"',$fields['author']);
    $fields['email'] = str_replace('<input id="email" name="email" type="text"', '<input type="email" placeholder="'.esc_html__('Email', 'grandportfolio-translation').'*"  id="email" name="email"',$fields['email']);
    $fields['url'] = str_replace('<input id="url" name="url" type="text"', '<input placeholder="'.esc_html__('Website', 'grandportfolio-translation').'" id="url" name="url" type="url"',$fields['url']);

    return $fields;
}

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

//Add upload form to page
if (is_admin()) {
  $current_admin_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);

  if ($current_admin_page == 'post' || $current_admin_page == 'post-new')
  {
 
    /** Need to force the form to have the correct enctype. */
    function grandportfolio_add_post_enctype() {
      echo "<script type=\"text/javascript\">
        jQuery(document).ready(function(){
        jQuery('#post').attr('enctype','multipart/form-data');
        jQuery('#post').attr('encoding', 'multipart/form-data');
        });
        </script>";
    }
 
    add_action('admin_head', 'grandportfolio_add_post_enctype');
  }
}

// remove version query string from scripts and stylesheets
function grandportfolio_remove_script_styles_version( $src ){
    return remove_query_arg( 'ver', $src );
}
add_filter( 'script_loader_src', 'grandportfolio_remove_script_styles_version' );
add_filter( 'style_loader_src', 'grandportfolio_remove_script_styles_version' );


function grandportfolio_theme_queue_js(){
  if (!is_admin()){
    if (!is_page() AND is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
  }
}
add_action('get_header', 'grandportfolio_theme_queue_js');


/**
* Add Photographer Name and URL fields to media uploader
*/
 
function phorography_attachment_field_credit ($form_fields, $post) {
	$form_fields['grandportfolio-purchase-url'] = array(
		'label' => esc_html__('Purchase URL', 'grandportfolio-translation'),
		'input' => 'text',
		'value' => esc_url(get_post_meta( $post->ID, 'grandportfolio_purchase_url', true )),
	);

	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'phorography_attachment_field_credit', 10, 2 );

/**
* Save values of Photographer Name and URL in media uploader
*/

function phorography_attachment_field_credit_save ($post, $attachment) {
	if( isset( $attachment['grandportfolio-purchase-url'] ) )
update_post_meta( $post['ID'], 'grandportfolio_purchase_url', esc_url( $attachment['grandportfolio-purchase-url'] ) );

	return $post;
}

add_filter( 'attachment_fields_to_save', 'phorography_attachment_field_credit_save', 10, 2 );

add_action( 'add_meta_boxes', array ( 'Grandportfolio_Richtext_Excerpt', 'switch_boxes' ) );

function grandportfolio_add_meta_tags() {
    $post = grandportfolio_get_wp_post();
    
    echo '<meta charset="'.get_bloginfo( 'charset' ).'" />';
    
    //Check if responsive layout is enabled
    $tg_mobile_responsive = kirki_get_option('tg_mobile_responsive');
	
	if(!empty($tg_mobile_responsive))
	{
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
	}
	
	//meta for phone number link on mobile
	echo '<meta name="format-detection" content="telephone=no">';
    
    //check if single post then add meta description and keywords
    if (is_single()) 
    {
        //Prepare data for Facebook opengraph sharing
        if(has_post_thumbnail(get_the_ID(), 'grandportfolio-blog'))
		{
		    $image_id = get_post_thumbnail_id(get_the_ID());
		    $fb_thumb = wp_get_attachment_image_src($image_id, 'grandportfolio-blog', true);
		}
	
		if(isset($fb_thumb[0]) && !empty($fb_thumb[0]))
		{
			$post_content = get_post_field('post_excerpt', $post->ID);
			
			echo '<meta property="og:type" content="article" />';
			echo '<meta property="og:image" content="'.esc_url($fb_thumb[0]).'"/>';
			echo '<meta property="og:title" content="'.esc_attr(get_the_title()).'"/>';
			echo '<meta property="og:url" content="'.esc_url(get_permalink($post->ID)).'"/>';
			echo '<meta property="og:description" content="'.esc_attr(strip_tags($post_content)).'"/>';
		}
    }
}
add_action( 'wp_head', 'grandportfolio_add_meta_tags' , 2 );


/**
 * Replaces the default excerpt editor with TinyMCE.
 */
class Grandportfolio_Richtext_Excerpt
{
    /**
     * Replaces the meta boxes.
     *
     * @return void
     */
    public static function switch_boxes()
    {
        if ( ! post_type_supports( $GLOBALS['post']->post_type, 'excerpt' ) )
        {
            return;
        }

        remove_meta_box(
            'postexcerpt' // ID
        ,   ''            // Screen, empty to support all post types
        ,   'normal'      // Context
        );

        add_meta_box(
            'postexcerpt2'     // Reusing just 'postexcerpt' doesn't work.
        ,   esc_html__('Excerpt', 'grandportfolio-translation' )    // Title
        ,   array ( __CLASS__, 'show' ) // Display function
        ,   null              // Screen, we use all screens with meta boxes.
        ,   'normal'          // Context
        ,   'core'            // Priority
        );
    }

    /**
     * Output for the meta box.
     *
     * @param  object $post
     * @return void
     */
    public static function show( $post )
    {
    ?>
        <label class="screen-reader-text" for="excerpt"><?php
        esc_html_e('Excerpt', 'grandportfolio-translation' )
        ?></label>
        <?php
        // We use the default name, 'excerpt', so we don’t have to care about
        // saving, other filters etc.
        wp_editor(
            self::unescape( $post->post_excerpt ),
            'excerpt',
            array (
            'textarea_rows' => 15
        ,   'media_buttons' => FALSE
        ,   'teeny'         => TRUE
        ,   'tinymce'       => TRUE
            )
        );
    }

    /**
     * The excerpt is escaped usually. This breaks the HTML editor.
     *
     * @param  string $str
     * @return string
     */
    public static function unescape( $str )
    {
        return str_replace(
            array ( '&lt;', '&gt;', '&quot;', '&amp;', '&nbsp;', '&amp;nbsp;' )
        ,   array ( '<',    '>',    '"',      '&',     ' ', ' ' )
        ,   $str
        );
    }
}

/**
 * Add menu description
 */
 
class Grandportfolio_Menu_With_Description extends Walker_Nav_Menu 
{
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<div class="menu-description">' . $item->description . '</div>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

/* Pagination fix for custom loops on pages */
add_filter('redirect_canonical','custom_disable_redirect_canonical');
function custom_disable_redirect_canonical($redirect_url) {if (is_paged() && is_singular()) $redirect_url = false; return $redirect_url; }
?>