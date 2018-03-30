<?php
class pixRecentPosts extends WP_Widget
{
    function pixRecentPosts(){
    $widget_ops = array('class' => 'pix-sliding-news', 'description' => __( "Recent posts with thumbnail and control on the excerpt length") );
    $this->WP_Widget('pixRecentPosts', __('Pixedelic Recent Posts'), $widget_ops, 200);
    }

    function widget($args, $instance){
      extract($args);
	$title = $instance['title'];
	$posts = $instance['posts'];
	$thumbnail = $instance['thumbnail'];
	$category = $instance['category'];
	$excerpt = $instance['excerpt'];
	$button = $instance['button'];

      echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title .'';

	
query_posts('posts_per_page='.$posts.'&cat='.$category); ?>
  	<?php
global $custom_payoff;
 	if (have_posts()) : ?>
		<?php while (have_posts()) : the_post();
$meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
	$the_title = $meta_title['payoff'];
} else {
	$the_title = get_the_title();
}
		 ?>
        					<div class="clear">
                                <h5><a href="<?php echo get_permalink(); ?>"><?php echo $the_title; ?></a></h5>
                                <?php
								if(isset($meta_title['subtitle']) && $meta_title['subtitle']!=''){?>
                                <p class="subtitle"><?php echo $meta_title['subtitle']; ?></p>
								<?php } ?>
                                <div class="entry-widget">
                                <?php
                                    if(has_post_thumbnail() && $thumbnail==true) { ?>
                                        <div class="imgHentry">
                                            <?php the_post_thumbnail('exTh'); ?>
                                            <div class="linkIcon" style="width:50px; height:50px;">
                                                <a href="<?php the_permalink(); ?>" class="goto-icon"></a>
                                            </div>
                                       </div><!-- .imgHentry -->
                                    <?php }
                                    echo custom_the_excerpt($excerpt,$button);
                                    ?>
                                </div><!-- .entry-widget -->
                             </div><!-- .clear -->
        	<?php endwhile; remove_filter('excerpt_length', 'excerpt_recent_posts'); ?>
  	<?php endif; ?>
    <?php wp_reset_query(); ?>

     <?php
		echo $after_widget . '';
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['posts'] = strip_tags(stripslashes($new_instance['posts']));
      $instance['thumbnail'] = isset($new_instance['thumbnail']);
      $instance['category'] = strip_tags(stripslashes($new_instance['category']));
      $instance['excerpt'] = strip_tags(stripslashes($new_instance['excerpt']));
      $instance['button'] = strip_tags(stripslashes($new_instance['button']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'News', 'posts'=>'10', 'thumbnail'=>true, 'category'=>'0', 'excerpt'=>'10', 'button'=>'Read more') );

      $title = htmlspecialchars($instance['title']);
      $posts = htmlspecialchars($instance['posts']);
      $thumbnail = isset($new_instance['thumbnail']);
      $category = htmlspecialchars($instance['category']);
      $excerpt = htmlspecialchars($instance['excerpt']);
      $button = htmlspecialchars($instance['button']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		
		echo '<p><label for="' . $this->get_field_name('category') . '">Include categories</label><input class="widefat" id="' . $this->get_field_name('category') . '" name="' . $this->get_field_name('category') . '" type="text" value="'.$category.'" /></p>';

		?>
       <p><label for="<?php echo $this->get_field_name('thumbnail'); ?>">Show featured image</label>&nbsp;
		<input id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="checkbox" <?php checked(isset($instance['thumbnail']) ? $instance['thumbnail'] : 0); ?> />
   		 </p>

		<?php echo '<p><label for="' . $this->get_field_name('excerpt') . '">How many words to display in the excerpt</label><input class="widefat" id="' . $this->get_field_name('excerpt') . '" name="' . $this->get_field_name('excerpt') . '" type="text" value="'.$excerpt.'" /></p>';

		echo '<p><label for="' . $this->get_field_name('posts') . '">Amount of news</label><input class="widefat" id="' . $this->get_field_name('posts') . '" name="' . $this->get_field_name('posts') . '" type="text" value="'.$posts.'" /></p>';
		
		echo '<p><label for="' . $this->get_field_name('button') . '">Text of the button</label><input class="widefat" id="' . $this->get_field_name('button') . '" name="' . $this->get_field_name('button') . '" type="text" value="'.$button.'" /></p>';

  }

}

  function pixPostsInit() {
  register_widget('pixRecentPosts');
  }
  add_action('widgets_init', 'pixPostsInit');



function get_flickr_images( $id = "", $number = 5, $key = "") {
	require_once(TEMPLATEPATH."/scripts/phpFlickr.php");
	$phpFlickrObj = new phpFlickr($key);
	$user_url = $phpFlickrObj->urls_getUserPhotos($id);
	$photos = $phpFlickrObj->people_getPublicPhotos($id, NULL, NULL, $number);
	return $photos['photos']['photo'];
}


class pixThumbGallery extends WP_Widget
{
	function pixThumbGallery(){
    $widget_ops = array('class' => 'pix-thumb-gallery', 'description' => __( "Create a thumb-gallery from your posts") );
    $this->WP_Widget('pixThumbGallery', __('Pixedelic Thumb Gallery'), $widget_ops, 200);
    }

    function widget($args, $instance){
      extract($args);
	$title = $instance['title'];
	$posts = $instance['posts'];
	$category = $instance['category'];
	$gallery = $instance['gallery'];
	$click = $instance['click'];
	$source = $instance['source'];
	$flickrid = $instance['flickrid'];
	$key = $instance['key'];
	
	
      echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title;

	  if ($source == 'posts') { query_posts('cat='.$category.'&posts_per_page='.$posts); ?>
 	<div class="pix_thumbs">
	<?php if (have_posts()) : ?>
		<?php $i=1; while (have_posts()) : the_post();
	if(has_post_thumbnail()) {
		$image_id = get_post_thumbnail_id();  
		$image_url = wp_get_attachment_image_src($image_id,'full');  
		$image_url = $image_url[0]; 
    if( get_pix_option('pix_timthumb_cache') != '0' ) {
      $timthumb_cache = '_cache';
    } else {
      $timthumb_cache = '';
    }
?>
        <div class="imgHentry<?php if($i % 3 === 0) { ?> marginZero<?php } ?>">
            	<img src="<?php echo pix_switch_timthumb($post, 'th64', '64', '64'); ?>" alt="<?php echo $image['title']; ?>">
            <div class="linkIcon" style="width:64px; height:64px;">
                <a href="<?php if($click == 'colorbox') { echo $image_url; } else { the_permalink(); } ?>" class="<?php if($click == 'colorbox') { echo 'enlarge-icon'; } else { echo 'goto-icon'; } ?>" data-rel="thumbgallery"></a>
            </div>
       </div><!-- .imgHentry -->
<?php $i++; }  ?>
		<?php endwhile; ?>
    </div><!-- .pix_thumbs -->
 	<?php endif; ?>
    <?php wp_reset_query(); 
	
	  } elseif ($source == 'galleries') {
		  if($gallery=='all') {
			  $gallery='';
		  }
		  
		$args=array(
			'gallery'	=> $gallery,
			'post_type' => 'portfolio',
			'posts_per_page' => $posts
	);
	$my_query = null;
	$my_query = new WP_Query($args);  ?>

 	<div class="pix_thumbs">
		<?php $i=1; 
	while ( $my_query->have_posts() ) : $my_query->the_post();
	if(has_post_thumbnail()) {
		$image_id = get_post_thumbnail_id();  
		$image_url = wp_get_attachment_image_src($image_id,'full'); 
		$image_url = $image_url[0]; 
	?>
        <div class="imgHentry<?php if($i % 3 === 0) { ?> marginZero<?php } ?>">
        <?php
			if( get_pix_option('pix_timthumb_cache') != '0' ) {
				$timthumb_cache = '_cache';
			} else {
				$timthumb_cache = '';
			}
		?>
            	<img src="<?php echo pix_switch_timthumb($post, 'th64', '64', '64'); ?>" alt="<?php echo get_post_meta($image_id, '_wp_attachment_image_alt', true); ?>">
            <div class="linkIcon" style="width:64px; height:64px;">
                <a href="<?php if($click == 'colorbox') { echo $image_url; } else { the_permalink(); } ?>" class="<?php if($click == 'colorbox') { echo 'enlarge-icon'; } else { echo 'goto-icon'; } ?>" data-rel="thumbgallery"></a>
            </div>
       </div><!-- .imgHentry -->
<?php $i++; }  ?>


<?php	endwhile; ?>
    </div><!-- .pix_thumbs -->
<?php	wp_reset_query();
	?>
      
      
      
      
	  <?php } else { ?>

    <div class="pix_thumbs">
<?php 

$images = get_flickr_images($flickrid,$posts,$key);
$i=0;
require_once(TEMPLATEPATH."/scripts/phpFlickr.php");
$phpFlickrObj = new phpFlickr($key);
$user_url = $phpFlickrObj->urls_getUserPhotos($flickrid);
foreach( $images as $image ) {
	$i++;
	?>
        <div class="imgHentry<?php if($i % 3 === 0) { ?> marginZero<?php } ?>">
        <?php
			if( get_pix_option('pix_timthumb_cache') != '0' ) {
				$timthumb_cache = '_cache';
			} else {
				$timthumb_cache = '';
			}
		?>
            	<img src="<?php echo get_template_directory_uri(); ?>/scripts/timthumb<?php echo $timthumb_cache; ?>.php?src=<?php echo $phpFlickrObj->buildPhotoURL($image, "thumbnail"); ?>&amp;h=64&amp;w=64" alt="<?php echo $image['title']; ?>">
            <div class="linkIcon" style="width:64px; height:64px;">
                <a href="<?php if($click == 'colorbox') { echo $phpFlickrObj->buildPhotoURL($image, "large"); } else { echo 'http://www.flickr.com/photos/'.$flickrid.'/'.$image['id'].'/in/photostream'; } ?>" class="<?php if($click == 'colorbox') { echo 'enlarge-icon'; } else { echo 'goto-icon'; } ?>" data-rel="flickr"<?php if($click == 'topost') { echo ' target="_blank"'; } ?>></a>
            </div>
       </div><!-- .imgHentry -->
<?php } ?>
    </div><!-- .pix_thumbs -->
    




    <?php }

		echo $after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['posts'] = strip_tags(stripslashes($new_instance['posts']));
      $instance['category'] = strip_tags(stripslashes($new_instance['category']));
      $instance['gallery'] = strip_tags(stripslashes($new_instance['gallery']));
      $instance['click'] = strip_tags(stripslashes($new_instance['click']));
      $instance['source'] = strip_tags(stripslashes($new_instance['source']));
      $instance['flickrid'] = strip_tags(stripslashes($new_instance['flickrid']));
      $instance['key'] = strip_tags(stripslashes($new_instance['key']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'Gallery', 'posts'=>'9', 'category'=>'0', 'gallery'=>'0', 'click'=>'c', 'source'=>'posts', 'source'=>'flickr', 'flickrid'=>'Your Flickr ID', 'key'=>'Flickr API key') );

      $title = htmlspecialchars($instance['title']);
      $posts = htmlspecialchars($instance['posts']);
      $category = htmlspecialchars($instance['category']);
      $gallery = htmlspecialchars($instance['gallery']);
      $click = htmlspecialchars($instance['click']);
      $source = htmlspecialchars($instance['source']);
      $flickrid = htmlspecialchars($instance['flickrid']);
      $key = htmlspecialchars($instance['key']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		
		?>
		<p>
			<label for="<?php echo $this->get_field_name('source'); ?>"> Choose the source for the thumbnails</label>
            	<select id="<?php echo $this->get_field_name('source'); ?>" name="<?php echo $this->get_field_name('source'); ?>" class="widefat toggler">
                	<option value="posts"<?php selected( $instance['source'], 'posts' ); ?>>Posts</option>
                	<option value="galleries"<?php selected( $instance['source'], 'galleries' ); ?>>Galleries</option>
                    <option value="flickr"<?php selected( $instance['source'], 'flickr' ); ?>>Flickr</option>
                </select>
		</p>

       <p class="<?php echo $this->get_field_name('source'); ?> toggle" data-type="posts"><label for="<?php echo $this->get_field_name('category'); ?>">Category <small>(if you previously selected posts)</small></label>     
    	<?php wp_dropdown_categories(array('selected' => $category, 'name' => $this->get_field_name('category'), 'show_option_all'=>'All', 'class'=>'widefat', 'sort_column'=> 'menu_order, post_title'));?>
   		 </p>

       <p class="<?php echo $this->get_field_name('source'); ?> toggle" data-type="galleries"><label for="<?php echo $this->get_field_name('gallery'); ?>">Gallery <small>(if you selected galleries)</small></label>     
    	<?php 
			$terms = get_terms("gallery");
			$count = count($terms);
			if($count > 0){
				echo '<select id="'.$this->get_field_name('gallery').'" name="'.$this->get_field_name('gallery').'" class="widefat">';
				echo '<option value="all"'. selected( $instance['gallery'], 'all' ) .'>All</option>';
				foreach ($terms as $term) {
					echo '<option value="'.$term->slug.'"'. selected( $instance['gallery'], $term->slug ) .'>'.$term->name.'</option>';
				}
				echo "</select>";
			}
		?>
   		 </p>

		<?php echo '<p class="'.$this->get_field_name('source').' toggle" data-type="flickr"><label for="' . $this->get_field_name('flickrid') . '">Flickr ID <small>(if you previously selected Flickr)</small></label><input class="widefat" id="' . $this->get_field_name('flickrid') . '" name="' . $this->get_field_name('flickrid') . '" type="text" value="'.$flickrid.'" /></p>'; ?>

		<?php echo '<p class="'.$this->get_field_name('source').' toggle" data-type="flickr"><label for="' . $this->get_field_name('key') . '">Flickr API key <small>(if you previously selected Flickr: <a href="http://www.flickr.com/services/apps/create/apply" target="_blank">where to get it</a>)</small></label><input class="widefat" id="' . $this->get_field_name('key') . '" name="' . $this->get_field_name('key') . '" type="text" value="'.$key.'" /></p>'; ?>

		<p>
			<label for="<?php echo $this->get_field_name('click'); ?>"> Choose the thumbnails links</label>
            	<select id="<?php echo $this->get_field_name('click'); ?>" name="<?php echo $this->get_field_name('click'); ?>" class="widefat">
                	<option value="colorbox"<?php selected( $instance['click'], 'colorbox' ); ?>>Open with Colorbox</option>
                    <option value="topost"<?php selected( $instance['click'], 'topost' ); ?>>Go to the post or page</option>
                </select>
		</p>

		<?php echo '<p><label for="' . $this->get_field_name('posts') . '">Amount of thumbs</label><input class="widefat" id="' . $this->get_field_name('posts') . '" name="' . $this->get_field_name('posts') . '" type="text" value="'.$posts.'" /></p>';
		

  }

}

  function pixThumbInit() {
  register_widget('pixThumbGallery');
  }
  add_action('widgets_init', 'pixThumbInit');






function pix_recent_comments($amount) {
  $pre_HTML ="";
  $post_HTML ="";
  global $wpdb;
  $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,  comment_author_email, SUBSTRING(comment_content,1,30) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT ".$amount;

  $comments = $wpdb->get_results($sql);
  $output = $pre_HTML;
  foreach ($comments as $comment) {
	$output .= '<div class="comment">';
	$output .= '<span class="vcard">';
	$output .= get_avatar( $comment->comment_author_email, $size = '40' );
	$output .= '</span><!-- .vcard -->';
	$output .= '<span class="text">';
	$output .= '<span class="left_arrow"></span>';
	$output .= strip_tags($comment->comment_author) . __(' on','delight').' <a href="' . get_permalink($comment->ID).'#comment-' . $comment->comment_ID . '" title="'. __('on','delight').' '.$comment->post_title . '">'.get_the_title($comment->ID).'</a><br />';
	$output .= '<span class="comment_text">&ldquo;'.strip_tags($comment->com_excerpt).'&rdquo;</span><!-- .commenttext -->';
	$output .= '</span><!-- .text -->';
	$output .= '</div><!-- .comment -->';
 }
  $output .= $post_HTML;
  echo $output;
}


class pixRecentComments extends WP_Widget
{
    function pixRecentComments(){
    $widget_ops = array('classname' => 'pix-recent-comments', 'description' => __( "Add a fading slide show for recent comments") );
    $this->WP_Widget('pixRecentComments', __('Pixedelic Recent Comments'), $widget_ops, 200);
    }

    function widget($args, $instance){
      extract($args);
	$title = $instance['title'];
	$posts = $instance['posts'];

      echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title. '<div class="pix_side_comments">' ;

        ?>
							<?php pix_recent_comments($posts); ?>

      <?php
		echo '</div><!-- pix_side_comments -->'.$after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['posts'] = strip_tags(stripslashes($new_instance['posts']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'Comments', 'posts'=>'10') );

      $title = htmlspecialchars($instance['title']);
      $posts = htmlspecialchars($instance['posts']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		
		?>

		<?php echo '<p><label for="' . $this->get_field_name('posts') . '">Amount of comments</label><input class="widefat" id="' . $this->get_field_name('posts') . '" name="' . $this->get_field_name('posts') . '" type="text" value="'.$posts.'" /></p>';

  }

}

  function pixSlidCommentInit() {
  register_widget('pixRecentComments');
  }
  add_action('widgets_init', 'pixSlidCommentInit');
  
  
  
  
 function unregister_them() {
unregister_widget( 'WP_Widget_Search' );
}
add_action('widgets_init','unregister_them',10);







class pixContactForm extends WP_Widget
{
	function pixContactForm(){
    $widget_ops = array('class' => 'pix-contact-form', 'description' => __( "Select a form") );
    $this->WP_Widget('pixContactForm', __('Pixedelic Contact Forms'), $widget_ops, 200);
	remove_action('wp_enqueue_scripts', 'remove_datePicker2');
	}


	
    function widget($args, $instance){
      extract($args);
	$title = $instance['title'];
	$form = $instance['form'];
	global $print_datepicker;	
     echo $before_widget;

      if ( $title )
      echo $before_title . $title . $after_title; ?>
      
                <div class="contactForm" id="<?php echo $form; ?>">
                	<?php 
						$i2 = 0;
						$pix_array_your_field = get_pix_option('pix_array_'.$form.'_fields_');
						$pix_array_your_field2 = print_r($pix_array_your_field, true);
						if ( stripos($pix_array_your_field2, '[pix_period') ){
							$print_datepicker = true;
						}
					?>
                    <div class="success" style="display:none">
                    <?php echo get_pix_option('pix_array_'.$form.'_issuccess'); ?> 
                    </div>
                    <div class="unsuccess" style="display:none">
                    <?php echo get_pix_option('pix_array_'.$form.'_unsuccess'); ?> 
                    </div>
                    <form>
                        <fieldset>
                        	<?php 
							while ($i2<count($pix_array_your_field)){
							$field = $pix_array_your_field[$i2][0];
                            echo do_shortcode(add_space_brackets(stripslashes($pix_array_your_field[$i2][$field])));
                            $i2++;
							} ?>
                            <div class="clear"></div>
                            <input type="submit" class="button medium" value="<?php echo get_pix_option('pix_array_'.$form.'_button'); ?>">
                        </fieldset>
                    </form>
                </div><!-- .contactForm -->




    <?php

		echo $after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['form'] = strip_tags(stripslashes($new_instance['form']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=> __('Contact us','delight'), 'form'=>'') );

      $title = htmlspecialchars($instance['title']);
      $form = htmlspecialchars($instance['form']);

		echo '<p><label for="' . $this->get_field_name('title') . '">Title <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		
		?>
		<p>
			<label for="<?php echo $this->get_field_name('form'); ?>">Select a form</label>
            	<select id="<?php echo $this->get_field_name('form'); ?>" name="<?php echo $this->get_field_name('form'); ?>" class="widefat">
                	<?php 
						$i = 0;
						$pix_array_your_forms = get_pix_option('pix_array_your_forms_');
						while($i<count($pix_array_your_forms)){ ?>
                            <option value="<?php echo sanitize_title($pix_array_your_forms[$i]); ?>"<?php selected( $instance['form'], sanitize_title($pix_array_your_forms[$i]) ); ?>><?php echo $pix_array_your_forms[$i]; ?></option>
							<?php $i++;
						} 
					?>

                </select>
		</p>
		<?php 

  }

}

  function pixContactInit() {
	register_widget('pixContactForm');
  }
  add_action('widgets_init', 'pixContactInit');
?>