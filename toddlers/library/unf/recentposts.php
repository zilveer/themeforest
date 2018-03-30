<?php
/*-----------------------------------------------------------------------------------*/
// GRID IMAGES
/*-----------------------------------------------------------------------------------*/

function unf_thumb_url($text, $size){
global $post;
$imageurl="";

// 1) FEATURED IMAGE
$featuredimg = get_post_thumbnail_id($post->ID);
// Get source for featured image
$img_src = wp_get_attachment_image_src($featuredimg, $size);
// Set $imageurl to Featured Image
$imageurl=$img_src[0];

// 2) First Image
if (!$imageurl) {
// Extract the img-thumbnail from the first attached imaged
$allimages = get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );

foreach ($allimages as $img){
$img_src = wp_get_attachment_image_src($img->ID, $size);
break;
}
// Set $imageurl to first attached image
$imageurl=$img_src[0];
}
// Spit out the image path
return $imageurl;
}

/*-----------------------------------------------------------------------------------*/
// EXCERPT SIZE
/*-----------------------------------------------------------------------------------*/

function unf_excerptlength_grid() {
	$output = substr(get_the_excerpt(), 0,80);
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = $output;
echo wp_kses_post($output) . '<span class="excerptdots">...</span>';
}

/*-----------------------------------------------------------------------------------*/
// RECENT POST WIDGET ADMIN SETTINGS
/*-----------------------------------------------------------------------------------*/

class Unf_Recent_Posts extends WP_Widget
{
function Unf_Recent_Posts()
{
	$widget_ops = array('classname' => 'Unf_Recent_Posts', 'description' => 'Recent posts with images' );
	parent::__construct('Unf_Recent_Posts', 'Toddlers Recent Posts', $widget_ops);
}

function form($instance)
{
	$instance = wp_parse_args( (array) $instance, array( 'number' => '' ) );

	if ( isset( $instance['number'] ) ) {
	$number = $instance[ 'number' ];
	}
	else {
	$number = __( '3', 'toddlers' );
	}


    if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
	}
	else {
	$title = __( 'Recent Posts', 'toddlers' );
	}
	?>
	<p>
		<label for="<?php echo $this->get_field_id('number'); ?>">Number of Posts:
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
		</label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','toddlers' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php
}

function update($new_instance, $old_instance)
{
	$instance = $old_instance;
	$instance['number'] = $new_instance['number'];
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
}

function widget($args, $instance)
{
extract($args, EXTR_SKIP);

$title = isset($instance['title']) ? $instance['title'] : '';
        // CHANGE COLOUR TO PURPLE
        //$before_widget = str_replace('orange', 'purple', $before_widget);
        echo $before_widget;
        echo $title ? ($before_title . $title . $after_title) : '';
$sticky = count(get_option('sticky_posts'));

$number = empty($instance['number']) ? ' ' : apply_filters('widget_number', $instance['number']);

/*-----------------------------------------------------------------------------------*/
// RECENT POST WIDGET
/*-----------------------------------------------------------------------------------*/

$params['showposts']	= $number;
$params['orderby'] 		= 'date';
$params['order']		= 'DESC';
$params['ignore_sticky_posts']		= 1;
$params['tax_query']	= array(
			        array(
			            'taxonomy' => 'post_format',
			            'field' => 'slug',
			            'terms' => array( 'post-format-aside', 'post-format-quote', 'post-format-video', 'post-format-link', 'post-format-chat', 'post-format-image' ),
			            'operator' => 'NOT IN'
			        )
			    );


query_posts($params); while(have_posts()) : the_post(); $post = get_post(get_the_ID()); ?>

<div class="rpost-block">
	<?php if ( stripos($post->post_content,'<img') === false  // if has no image
	&& !has_post_thumbnail() // and no img-thumbnail
	){
	// NO IMAGES
	} else {
	// YES IMAGES
	if (function_exists('unf_thumb_url')) {
		$thumb=unf_thumb_url($post->post_content, 'gridpostimage');
			if ($thumb!='') {?>
			<a href="<?php the_permalink() ?>" style="background-image:url('<?php echo esc_url($thumb); ?>');" class="rpost-postimage"></a>
			<?php }
		} // END THUMB URL
	 } // END IMAGES ?>
	<div class="rpost-text">
		<a href="<?php the_permalink() ?>"><h4 class="rpost-title"><?php the_title(); ?></h4></a>
		<div class="rpost-postmeta">
			<i class="rpost-date icon-clock"></i>
			<?php the_time(get_option('date_format')); ?>
		</div>
		<p class="rpost-excerpt"><?php unf_excerptlength_grid(); ?></p>
	</div>
</div>

<?php endwhile; ?>

<?php wp_reset_query(); ?>
<?php echo $after_widget; }
}
add_action( 'widgets_init', create_function('', 'return register_widget("Unf_Recent_Posts");') );