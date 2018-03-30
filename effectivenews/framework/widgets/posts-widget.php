<?php 

add_action('widgets_init','mom_widget_posts');

function mom_widget_posts() {
	register_widget('mom_widget_posts');
	
	}

class mom_widget_posts extends WP_Widget {
	function mom_widget_posts() {
			
		$widget_ops = array('classname' => 'momizat-posts','description' => __('Widget display Posts order by : Popular, Random, Recent','theme'));
		parent::__construct('momizatPosts',__('Effective - Posts','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$orderby = $instance['orderby'];
		$count = $instance['count'];
		$display = $instance['display'];
		$cats = isset($instance['cats']) ? $instance['cats'] : array();

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
                                   <div class="mom-posts-widget">

		<?php
			global $unique_posts;
			global $do_unique_posts;

			if ($orderby == 'popular') {
				if ($display == 'cats') {
					$catsi = implode(',', $cats);
					$args = array(  "ignore_sticky_posts" => 1, 'posts_per_page' => $count, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts, "orderby" => "comment_count", 'cat' => $catsi);
				} else {
					$args = array (  "ignore_sticky_posts" => 1, 'posts_per_page' => $count, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts, "orderby" => "comment_count"); 
				}
			} elseif ($orderby == 'random') {
				if ($display == 'cats') {
					$catsi = implode(',', $cats);
					$args = array(  "ignore_sticky_posts" => 1, 'posts_per_page' => $count, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts, "orderby" => "rand", 'cat' => $catsi);
				} else {
					$args =  array(  "ignore_sticky_posts" => 1, 'posts_per_page' => $count, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts, "orderby" => "rand"); 
				}
			} else {
				if ($display == 'cats') {
					$catsi = implode(',', $cats);
					$args =  array(  "ignore_sticky_posts" => 1, 'posts_per_page' => $count, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts, 'cat' => $catsi);
				} else {
					$args = array(  "ignore_sticky_posts" => 1, 'posts_per_page' => $count, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts); 
				}
			}
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
			if ($unique_posts) {$do_unique_posts[] = get_the_ID();}
		?>
			<div class="mpw-post">
				<?php
				$is_img = '';
				if (mom_post_image() != false) {
					$is_img = 'has-feature-image';
				?>
			    <div class="post-img main-sidebar-element"><a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide'); ?>" alt="<?php the_title(); ?>"></a></div>
			    <div class="post-img sec-sidebar-element"><a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span></div>
			    <?php } ?>
			   <div class="details <?php echo $is_img; ?>">
			    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			   <div class="mom-post-meta mom-w-meta">
				<span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
			    <?php mom_show_review_score(); ?>
			    </div>
			</div>
			</div> <!--//post-->

			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_query(); ?>
                                    </div>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = $new_instance['count'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['display'] = $new_instance['display'];
		$instance['cats'] = $new_instance['cats'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Recent Posts','theme'), 
			'count' => 5
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$orderby = isset($instance['orderby']) ? $instance['orderby'] : '';
		$display = isset($instance['display']) ? $instance['display'] : '';
		$cats = isset($instance['cats']) ? $instance['cats'] : array();
		$categories = get_categories('hide_empty=0');
	
		?>
	<script>
		jQuery(document).ready(function($) {
			$('#<?php echo $this->get_field_id( 'display' ); ?>').change( function () {
				if ($(this).val() === 'cats') {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeIn();
				} else {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeOut();
				}
				
			});
				if ($('#<?php echo $this->get_field_id( 'display' ); ?>').val() === 'cats') {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeIn();
				} else {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeOut();
				}
		});
	</script>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e('orderby', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
		<option value="recent" <?php selected($orderby, 'recent'); ?>><?php _e('Recent', 'theme'); ?></option>
		<option value="popular" <?php selected($orderby, 'popular'); ?>><?php _e('Popular', 'theme'); ?></option>
		<option value="random" <?php selected($orderby, 'random'); ?>><?php _e('Random', 'theme'); ?></option>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('display', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
		<option value="latest" <?php selected($display, 'latest'); ?>><?php _e('Latest Posts', 'framework'); ?></option>
		<option value="cats" <?php selected($display, 'cats'); ?>><?php _e('Category/s', 'framework'); ?></option>
		</select>
		</p>

		<p class="posts_widget_cats hidden">
		<label for="<?php echo $this->get_field_id( 'cats' ); ?>"><?php _e('Categories', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'cats' ); ?>" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" class="widefat" multiple="multiple">
		<?php foreach ($categories as $cat) { ?>
			<option <?php echo in_array($cat->cat_ID, $cats)? 'selected="selected"':'';?> value="<?php echo $cat->cat_ID; ?>"><?php echo $cat->cat_name; ?></option>
		<?php } ?>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number Of Posts:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" />
		</p>

   <?php 
}

 } //end class