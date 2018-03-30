<?php
$box_name = 'homeslider';
$images = array();
$options = get_post_meta( $post->ID, 'dt_'.$box_name.'_options', true );
$show_index = 'show_'. $box_name. '_'. $options['show'];
$arr = isset( $options[ $show_index ] ) ? $options[ $show_index ] : null;
$args = array(
	'post_type' 		=> 'attachment', 
	'post_mime_type'	=> 'image',
	'post_status' 		=> 'inherit',
	'orderby'			=> 'menu_order',
	'order'				=> 'ASC',
	'posts_per_page'	=> -1
);
$query_str = sprintf( 'SELECT ID FROM %s WHERE post_type="%s" AND post_status="publish"', $wpdb->posts, 'main_slider' );
if ( is_array($arr) ) {
	$query_str .= ' AND ID';
	if ( 'except' == $options['show'] ) {
		$query_str .= ' NOT';
	}
	$query_str .= sprintf( ' IN(%s)', implode( ',', $arr ) );
}
$query_str .= ' ORDER BY post_date DESC';

// send query to filter
dt_parent_where_query( $query_str );

add_filter( 'posts_where' , 'dt_posts_parents_where' );
$slides = new Wp_Query( $args );
remove_filter( 'posts_where' , 'dt_posts_parents_where' );

// process images
foreach( $slides->posts as $slide ) {
	$image = wp_get_attachment_image_src($slide->ID, 'full');

  $tmp_src = dt_clean_thumb_url($image[0]);
  $small_image = esc_attr(get_template_directory_uri()."/thumb.php?src={$tmp_src}&w=102&h=62zc=1");
	
	$images[] = array(
        "orig_image"		=> $image,
        "small_image"		=> esc_attr($small_image)
    );
}
?>


<!-- For the greate [justice] example -->
<script type="text/javascript">
	slideshow_timeout_sec = <?php echo $options['dt_interval'] ? intval($options['dt_interval']) : 'false'; ?>;
</script>

<ul id="big-image">
<?php
   $reverse = $images;
   $reverse = array_reverse($reverse);
   foreach ($reverse as $image)
   {
   ?>
      <li><img src="<?php echo $image['orig_image'][0]; ?>" alt="<?php echo $image['orig_image'][1]; ?>|<?php echo $image['orig_image'][2]; ?>" title="" /></li>
   <?php
   }
?>
</ul>

<?php if( !$options['dt_hide_over_mask'] ): ?>
<div id="big-mask-sl"></div>
<?php endif; ?>

<div id="big-mask-sl_b"></div>

<div id="slider">
  <div>
    <ul>
      <?php
         foreach ($images as $image)
         {
         ?>
            <li><a href="#"><img src="<?php echo $image['small_image']; ?>" width="102" height="62" alt="" /><i></i></a></li>
         <?php
         }
      ?>
    </ul>
  </div>
</div>

<div id="slider_controls">
  <div>
    <ul>
      <li><a href="#"><img src="<?php echo $images[0]['small_image']; ?>" alt="" width="102" height="62" /></a></li>
    </ul>
    <a href="#" id="control_play"></a>
    <a href="#" id="control_pause"></a>
    <a href="#" id="control_f"></a>
    <a href="#" id="control_b"></a>
  </div>
</div>