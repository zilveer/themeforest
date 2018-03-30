<?php
/*
Plugin Name: Goodlayers News Widget
Plugin URI: http://goodlayers.com/
Description: Goodlayers News Widget that grab the latest post, popular post and latest comment.
Author: Goodlayers
Version: 1
Author URI: http://goodlayers.com/
*/

add_action( 'widgets_init', 'goodlayers_news_widget_init' );

function goodlayers_news_widget_init(){
	register_widget('Goodlayers_news_widget');      
}


class Goodlayers_news_widget extends WP_Widget {  

	// Initialize the widget
    function Goodlayers_news_widget() {
        parent::__construct('goodlayers-news-widget', __('Tab Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('A widget that show lastest posts, popular post and latest comments', 'gdl_back_office')));  
    }  
	
	// Output of the widget
	function widget($args, $instance) {  
		global $wpdb;
	
		extract( $args );
		
		$avatar_size = 50;
		$img_size = '50x50';
		$title = apply_filters( 'widget_title', $instance['title'] );
		$num_fetch = apply_filters( 'widget_num_fetch', $instance['num_fetch'] );
		$category = apply_filters( 'widget_category', $instance['category'] );
		if($category == "All"){ $category = ''; }
		
		echo '<div class="sidebar-news-tab-widget">';

		echo $before_widget;
		
			// Widget Title
			if ( isset($title) && !empty($title) ) { 
				echo $before_title . $title . $after_title; 
			}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
				echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
			}
			
			// Widget Content
			//echo '<div class="bkp-frame-wrapper">';
			//echo '<div class="bkp-frame p0">';
			
			$query_arrays = array(
				array('id'=>'gdl-widget-latest-post', 'title'=> __('Recent','gdl_front_end'), 'type'=>'post',
					'condition'=>'showposts=' . $num_fetch . '&category_name=' . $category),
				array('id'=>'gdl-widget-popular-post', 'title'=> __('Popular','gdl_front_end'), 'type'=>'post',
					'condition'=>'showposts=' . $num_fetch . '&category_name=' . $category . '&orderby=comment_count'),	
				array('id'=>'gdl-widget-latest-comment', 'title'=> __('Comments','gdl_front_end'), 'type'=>'comment' )
			);
			echo '<div id="gdl-widget-tab">';
			
			// Tab header
			$current_tab = ' active ';
			echo '<div id="gdl-widget-tab-header">';		
			foreach( $query_arrays as $query_array ){
				echo '<div class="gdl-widget-tab-header-item gdl-tab-divider ' . $current_tab . '">';
				echo '<a data-id="' . $query_array['id'] . '">';
				echo $query_array['title'];
				echo '</a>';
				echo '</div>';
				
				$current_tab = '';
			}
			echo '<div class="gdl-widget-tab-header-item-last gdl-tab-divider"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';
			
			// Tab content
			$current_tab = ' active ';
			echo '<div id="gdl-widget-tab-content">';
			foreach( $query_arrays as $query_array ){
			
				if( $query_array['type'] == 'post'){
				
					$custom_posts = get_posts($query_array['condition']); 
					
					echo '<div class="news-widget-tab ' . $current_tab . '" id="' . $query_array['id'] . '">';
					
					foreach( $custom_posts as $custom_post ){
						?>
						<div class="news-widget-item">
							<?php
								$thumbnail_id = get_post_thumbnail_id( $custom_post->ID );				
								$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $img_size );	
								$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
								if( !empty($thumbnail) ){
									echo '<div class="news-widget-thumbnail">';
									echo '<a href="' . get_permalink( $custom_post->ID ) . '">';
									echo '<img src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>';
									echo '</a>';
									echo '</div>';
								}
							?>
							<div class="news-widget-context">
								<div class="news-widget-title no-cufon">
									<a href="<?php echo get_permalink( $custom_post->ID ); ?>"> 
										<?php echo $custom_post->post_title; ?> 
									</a>
								</div>
								<div class="news-widget-date post-info-color">
									<?php echo get_the_time('d M Y', $custom_post->ID); ?>
								</div>				
								<div class="news-widget-comment post-info-color">
									<?php 
										$comment_num = get_comments_number( $custom_post->ID );	
										if( $comment_num <= 1 ){
											echo ', ' . $comment_num . __(' Comment','gdl_front_end');
										}else{
											echo ', ' . $comment_num . __(' Comments','gdl_front_end');
										}
									?>
								</div>
							</div>
							<div class="clear"></div>
						</div> <!-- news widget item -->
						<?php
					}
					
					echo '</div>'; // news-widget-tab
				
				}else if( $query_array['type'] == 'comment'){
				
					$posts_in_cat = get_post_title_id($category);
					
					$comment_sql = "SELECT * FROM " . $wpdb->comments;
					$comment_sql = $comment_sql . " WHERE comment_post_ID in (" . implode( ',' , $posts_in_cat ) . ")";
					$comment_sql = $comment_sql . " AND comment_approved = 1";
					$comment_sql = $comment_sql . " ORDER BY comment_date DESC LIMIT " . $num_fetch . ';';
					
					$custom_comments = $wpdb->get_results( $comment_sql );
					
					echo '<div class="news-widget-tab ' . $current_tab . '" id="' . $query_array['id'] . '">';
					foreach( $custom_comments as $custom_comment ){ 
					
						$comment_permalink = get_permalink( $custom_comment->comment_post_ID ) . '#comment-' . $custom_comment->comment_ID;
						?>
						<div class="news-widget-item">
							<div class="news-widget-avatar">
								<a href="<?php echo $comment_permalink; ?>">
									<?php echo get_avatar( $custom_comment->user_id, $avatar_size ); ?>
								</a>
							</div>
							<div class="news-widget-context">
								<div class="news-widget-content">
									<a href="<?php echo $comment_permalink; ?>"> 
										<?php 
											echo $custom_comment->comment_author . ' : ';
											echo substr( $custom_comment->comment_content, 0, 45 ); 
											if( strlen( $custom_comment->comment_content ) > 45 ){
												echo '...';
											}
										?>
									</a>
								</div>
								<div class="news-widget-date post-info-color">
									<?php echo date('d M Y', strtotime($custom_comment->comment_date)); ?>
								</div>
							</div>
							<div class="clear"></div>
						</div> <!-- news widget item -->	
						<?php
					}
					echo '</div>'; // news-widget-tab
				}
				
				$current_tab = '';
			}
			echo '<div class="clear"></div>';
			echo '</div>'; // gdl-widget-tab-content
		
			echo '</div>'; // gdl-widget-tab
			
			//echo '</div>'; // bkp-frame
			//echo '</div>'; // bkp-frame-wrapper
			?>
			<script>
				jQuery(document).ready(function(){
					var widget_tab = jQuery('#gdl-widget-tab');
					widget_tab.find('#gdl-widget-tab-header a').click(function(){
						var tab_id = '#' + jQuery(this).attr('data-id');
						jQuery(this).parents('.gdl-widget-tab-header-item').each(function(){
							jQuery(this).addClass('active');
							jQuery(this).siblings().removeClass('active');
						});
						jQuery(this).parents('#gdl-widget-tab-header').siblings('#gdl-widget-tab-content').children(tab_id).each(function(){
							jQuery(this).siblings().css('display','none');
							jQuery(this).addClass('active');
							jQuery(this).siblings().removeClass('active');
							jQuery(this).fadeIn();
						
						});

					});		
					widget_tab.find('#gdl-widget-tab-content').children().each(function(){
						if(jQuery(this).hasClass('active')){
							jQuery(this).css('display','block');
						}else{
							jQuery(this).css('display','none');
						}
					});		
				});		
			</script>			
			<?php
			
		echo $after_widget;		
		
		echo '</div>'; //sidebar-news-tab-widget
    }  	
	
	// Widget Form
	function form($instance) {  
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$num_fetch = esc_attr( $instance[ 'num_fetch' ] );
			$category = esc_attr( $instance[ 'category' ] );
		} else {
			$title = '';
			$num_fetch = '3';
			$category = '';
		}
		
		?>
		<!-- Title --> 
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		
		<!-- Num Fetch --> 
		<p>
			<label for="<?php echo $this->get_field_id('num_fetch'); ?>"><?php _e( 'Num Fetch :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('num_fetch'); ?>" name="<?php echo $this->get_field_name('num_fetch'); ?>" type="text" value="<?php echo $num_fetch; ?>" />
		</p>			
		
		<!-- Post Category --> 
		<?php $category_lists = get_category_list('category'); ?>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e( 'Category :', 'gdl_back_office' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" >
				<?php 
					foreach( $category_lists as $category_list ){
						$selected = ( $category == $category_list )? 'selected': '';
						echo '<option ' . $selected . '>' . $category_list . '</option>';
					}
				?>
			</select>
		</p>		
		<?php 
    }  
	
	// Update the widget
	function update($new_instance, $old_instance) {  
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['num_fetch'] = strip_tags($new_instance['num_fetch']);
		$instance['category'] = strip_tags($new_instance['category']);
		return $instance;
    }  
	
}  

?>