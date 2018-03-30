<?php
/******************************************************** 
COUPONXL Categories Widget
********************************************************/
class Couponxl_Category extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_categories', __('CouponXL Category','couponxl'), array('description' =>__('CouponXL Category Widget','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		include( locate_template( 'includes/search-args.php' ) );

		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$icons = empty( $instance['icons'] ) ? '' : $instance['icons'];
		$categories = empty( $instance['categories'] ) ? array() : $instance['categories'];
		$theme_usage = couponxl_get_option( 'theme_usage' );
		echo $before_widget.$before_title.$title.$after_title;
			$args = array(
				'hide_empty' => false
			);
			if( empty( $categories ) ){
				$args['parent'] = 0;
				$offer_cats = get_terms( 'offer_cat', $args );
			}
			else{
				foreach( $categories as $category ){
					$offer_cats[] = get_term_by( 'slug', $category, 'offer_cat' );
				}

				usort( $offer_cats, "couponxl_organized_sort_name_asc" );
			}
			?>

			<?php if( $theme_usage == 'all' ): ?>
				<ul class="list-unstyled list-inline offer-type-filter">
					<li>
						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array(), array( 'offer_type' ) ) ) ?>" class="<?php echo empty( $offer_type ) ? 'active' : '' ?>"><?php _e( 'All', 'couponxl' ) ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'offer_type' => 'deal' )  ) ) ?>" class="<?php echo $offer_type == 'deal' ? 'active' : '' ?>"><?php _e( 'Deals', 'couponxl' ) ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'offer_type' => 'coupon' ) ) ) ?>" class="<?php echo $offer_type == 'coupon' ? 'active' : '' ?>"><?php _e( 'Coupons', 'couponxl' ) ?></a>
					</li>
				</ul>
			<?php endif; ?>

			<?php
			if( !empty( $offer_cats ) ){
				?>
				<ul class="list-unstyled offer-cat-filter">
					<?php
					foreach( $offer_cats as $offer_cat_item ){
						if( !empty( $offer_cat_item ) && !is_wp_error( $offer_cat_item ) ):
							?>
							<li>
								<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'offer_cat' => $offer_cat_item->slug ) ) ) ?>">
									<?php if( !empty( $icons ) && $icons == 'yes' ): ?>
										<?php
										$term_meta = get_option( "taxonomy_$offer_cat_item->term_id" );
										$icon = !empty( $term_meta['category_icon'] ) ? $term_meta['category_icon'] : '';
										if( !empty( $icon ) ):
										?>
											<i class="fa fa-<?php echo esc_attr( $icon ) ?>"></i>
										<?php endif; ?>
									<?php endif; ?>
									<?php echo $offer_cat_item->name; ?>
								</a>
							</li>
							<?php
						endif;
					}
					?>
					<li>
						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array(), array( 'offer_cat', 'coupon' ) ) ) ?>">
							<?php _e( 'All Categories', 'couponxl' ); ?>
							<i class="fa fa-arrow-circle-o-right"></i>
						</a>
					</li>
				</ul>
				<?php
			}
		echo $after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'icons' => 'yes', 'categories' => array() ) );
		
		$title = esc_attr( $instance['title'] );
		$icons = esc_attr( $instance['icons'] );
		$categories = (array)$instance['categories'];

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';

		echo '<p><label for="'.esc_attr($this->get_field_id('icons')).'">'.__( 'Show icons:', 'couponxl' ).'</label>';
		echo '<select id="'.esc_attr($this->get_field_id('icons')).'" name="'.esc_attr($this->get_field_name('icons')).'" class="widefat">';
			echo '<option value="yes" '.( $icons == 'yes' ? 'selected="selected"' : '' ).'>'.__( 'Yes', 'couponxl' ).'</a>';
			echo '<option value="no" '.( $icons == 'no' ? 'selected="selected"' : '' ).'>'.__( 'No', 'couponxl' ).'</a>';
		echo '</select>';

		echo '<p><label for="'.esc_attr($this->get_field_id('categories')).'">'.__( 'Categories:', 'couponxl' ).'</label>';
		echo '<select style="min-height: 200px" style="min-height: 200px" id="'.esc_attr($this->get_field_id('categories')).'" name="'.esc_attr($this->get_field_name('categories')).'[]" class="widefat" multiple>';
			$terms = couponxl_get_organized( 'offer_cat' );
			if( !empty( $terms ) ){
				foreach( $terms as $key => $term ){
					couponxl_display_indent_select_tree( $term, $categories, 0 );
				}
			}
		echo '</select>';	
		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['icons'] = $new_instance['icons'];
		return $instance;	
	}	
}

/********************************************************
COUPONXL Locations Widget
********************************************************/
class Couponxl_Locations extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_locations', __('CouponXL Locations','couponxl'), array('description' =>__('CouponXL Locations Widget','couponxl') ));
	}
	public function widget( $args, $instance ) {
		include( locate_template( 'includes/search-args.php' ) );
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];

		$args = array();
		if( !empty( $location ) ){
			$term = get_term_by( 'slug', $location, 'location' );
			$args = array(
				'parent' => $term->term_id
			);
		}
		$locations = get_terms( 'location', $args );

		echo $before_widget.$before_title.$title.$after_title.'<div class="white-block-content">';

		if( !empty( $locations ) ){
			echo '<ul class="list-unstyled">';
			foreach( $locations as $location ){
				?>
				<li>
					<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'location' => $location->slug ), array( 'all' ) ) ) ?>">
						<?php echo $location->name; ?>
						<span class="pull-right">+</span>
					</a>
				</li>
				<?php
			}
			echo '</ul>';
		}
		echo '</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		
		$title = esc_attr( $instance['title'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;	
	}	
}

/********************************************************
COUPONXL Popular Stores
********************************************************/
class Couponxl_Popular_Stores extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_popular_stores', __('CouponXL Sidebar Popular Stores','couponxl'), array('description' =>__('CouponXL Popular Stores Widget For Sidebar Only','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$count = empty( $instance['count'] ) ? 6 : $instance['count'];
		$popular_stores = couponxl_popular_stores( $count );

		echo $before_widget.$before_title.$title.$after_title.'<div class="white-block-content">';
		if( !empty( $popular_stores ) ){
			echo '<ul class="list-unstyled list-inline">';
			foreach( $popular_stores as $store ){
				?>
				<li>
					<a href="<?php echo get_permalink( $store->ID ) ?>">
						<?php echo couponxl_store_logo( $store->ID ); ?>
					</a>
				</li>
				<?php
			}
			echo '</ul>';
			echo '<div>
				<a href="'.( esc_url( couponxl_get_permalink_by_tpl( 'page-tpl_all_stores' ) ) ).'">
					'.__( 'All Stores', 'couponxl' ).'
					<i class="fa fa-arrow-circle-o-right"></i>
				</a>
			</div>';			
		}
		echo '</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$count = esc_attr( $instance['count'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		

		echo '<p><label for="'.esc_attr($this->get_field_id('count')).'">'.__( 'Count:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('count')).'"  name="'.esc_attr($this->get_field_name('count')).'" value="'.esc_attr( $count ).'"></p>';				
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		return $instance;	
	}	
}

/********************************************************
COUPONXL Custom Stores
********************************************************/
class Couponxl_Custom_Stores extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_custom_stores', __('CouponXL Custom Stores','couponxl'), array('description' =>__('CouponXL Custom Stores Widget','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$items = empty( $instance['items'] ) ? '' : $instance['items'];
		$items = explode( ",", $items );

		echo $before_widget.$before_title.$title.$after_title.'<div class="white-block-content">';
		if( !empty( $items ) ){
			echo '<ul class="list-unstyled list-inline">';
			foreach( $items as $item ){
				?>
				<li>
					<a href="<?php echo get_permalink( $item ) ?>">
						<?php echo couponxl_store_logo( $item ); ?>
					</a>
				</li>
				<?php
			}
			echo '</ul>';
			echo '<div>
				<a href="'.( esc_url( couponxl_get_permalink_by_tpl( 'page-tpl_all_stores' ) ) ).'">
					'.__( 'All Stores', 'couponxl' ).'
					<i class="fa fa-arrow-circle-o-right"></i>
				</a>
			</div>';			
		}		
		echo '</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'items' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$items = esc_attr( $instance['items'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		

		echo '<p><label for="'.esc_attr($this->get_field_id('items')).'">'.__( 'Items (comma separated):', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('items')).'"  name="'.esc_attr($this->get_field_name('items')).'" value="'.esc_attr( $items ).'"></p>';				
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = strip_tags( $new_instance['items'] );
		return $instance;	
	}	
}

/********************************************************
COUPONXL Latest Posts + Comments
********************************************************/
class Couponxl_Latest_Posts_Comments extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_latest_posts_comments', __('CouponXL Latest Posts And Comments','couponxl'), array('description' =>__('CouponXL Latest Posts And Comments Widget','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$count = empty( $instance['count'] ) ? '' : $instance['count'];
		$tabs = empty( $instance['tabs'] ) ? array() : (array)$instance['tabs'];

		$rand = couponxl_confirm_hash( 5 );
		$navigation = '';
		$panels = '';
		$active = false;

		if( in_array( 'latest', $tabs ) ){
			$navigation .= '<li role="presentation" class="active">
				<a href="#latest_'.$rand.'" aria-controls="home" role="tab" data-toggle="tab">'.__( 'Latest', 'couponxl' ).'</a>
			</li>';
			$recent_posts = wp_get_recent_posts( array( 'numberposts' => $count, 'post_status' => 'publish' ), OBJECT );
			$panels .= '<div role="tabpanel" class="tab-pane active" id="latest_'.$rand.'"><ul class="list-unstyled">';
			if( !empty( $recent_posts ) ){
				foreach( $recent_posts as $post ){
					$panels .= '<li><a href="'.get_permalink( $post->ID ).'">'.get_the_title( $post->ID ).'</a><p class="green-text">'.get_the_time( get_option( 'date_format' ), $post ).'</p></li>';
				}
			}
			$panels .= '</ul></div>';
			$active = true;
		}
		if( in_array( 'comments', $tabs ) ){
			$navigation .= '<li role="presentation" class="'.( $active == false ? 'active' : '' ).'">
				<a href="#comments_'.$rand.'" aria-controls="profile" role="tab" data-toggle="tab">'.__( 'Comments', 'couponxl' ).'</a>
			</li>';
			$comments = get_comments(
				array(
					'status' => 'approve',
					'number' => $count,
				)
			);
			$panels .= '<div role="tabpanel" class="tab-pane '.( $active == false ? 'active' : '' ).'" id="comments_'.$rand.'"><ul class="list-unstyled">';
			if( !empty( $comments ) ){
				foreach( $comments as $comment ){
					$comment_content  = $comment->comment_content;
					if( strlen( $comment_content ) > 45){
						$comment_content = substr( $comment_content, 0, 45 ).'...';
					}
					$panels .= '<li><a href="'.get_permalink( $comment->comment_post_ID  ).'">'.$comment_content.'</a><p class="green-text">'.$comment->comment_author.' '.human_time_diff( strtotime( $comment->comment_date ), current_time( 'timestamp' ) ).'</p></li>';
				}
			}
			
			$panels .= '</ul></div>';
		}

		echo $before_widget.$before_title.$title.$after_title.'<div class="white-block-content">';
		echo '<div role="tabpanel">

				<ul class="nav nav-tabs" role="tablist">
					'.$navigation.'
				</ul>

				<div class="tab-content">
					'.$panels.'
				</div>

			</div>';
		echo '</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '', 'tabs' => array() ) );
		
		$title = esc_attr( $instance['title'] );
		$count = esc_attr( $instance['count'] );
		
		$tabs = (array)$instance['tabs'];

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		

		echo '<p><label for="'.esc_attr($this->get_field_id('count')).'">'.__( 'Number Of Posts And Comments:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('count')).'"  name="'.esc_attr($this->get_field_name('count')).'" value="'.esc_attr( $count ).'"></p>';				

		echo '<p><label for="'.esc_attr($this->get_field_id('tabs')).'">'.__( 'Show Tabs:', 'couponxl' ).'</label>';
		echo '<select style="min-height: 200px" class="widefat" name="'.esc_attr($this->get_field_name('tabs')).'[]" id="'.esc_attr($this->get_field_id('tabs')).'" multiple="multiple">';
			echo '<option value="latest" '.( in_array( 'latest', $tabs ) ? 'selected="selected"' : '' ).'>'.__( 'Latest', 'couponxl' ).'</option>';
			echo '<option value="comments" '.( in_array( 'comments', $tabs ) ? 'selected="selected"' : '' ).'>'.__( 'Comments', 'couponxl' ).'</option>';
		echo '</select>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['tabs'] = $new_instance['tabs'];
		return $instance;
	}	
}

/********************************************************
COUPONXL Popular Posts Widget
********************************************************/
class Couponxl_Latest_Posts extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_latest_posts', __('CouponXL Latest Posts','couponxl'), array('description' =>__('CouponXL Latest Posts Widget','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$count = empty( $instance['count'] ) ? '' : $instance['count'];
		
		$recent_posts = wp_get_recent_posts( array( 'numberposts' => $count, 'post_status' => 'publish' ), OBJECT );

		echo $before_widget.$before_title.$title.$after_title.'<div class="white-block-content">';
		if( !empty( $recent_posts ) ){
			echo '<ul class="list-unstyled">';
			foreach( $recent_posts as $post ){
				?>
				<li>
					<?php if( has_post_thumbnail( $post->ID ) ): ?>
						<a href="<?php echo get_permalink( $post->ID ); ?>">
							<?php echo get_the_post_thumbnail( $post->ID, 'medium', array( 'class' => 'img-responsive' ) ) ?>
						</a>
					<?php endif; ?>
					<a href="<?php echo get_permalink( $post->ID ) ?>">
						<?php echo get_the_title( $post->ID ); ?>
					</a>
					<p class="green-text">
						<?php echo get_the_time( get_option( 'date_format' ), $post ); ?>
					</p>
				</li>
				<?php
			}
			echo '</ul>';
		}
		echo '</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$count = esc_attr( $instance['count'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		

		echo '<p><label for="'.esc_attr($this->get_field_id('count')).'">'.__( 'Count:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('count')).'"  name="'.esc_attr($this->get_field_name('count')).'" value="'.esc_attr( $count ).'"></p>';				
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		return $instance;	
	}	
}

/********************************************************
COUPONXL Custom Locations Widget
********************************************************/
class Couponxl_Custom_Locations extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_custom_locations', __('CouponXL Custom Locations','couponxl'), array('description' =>__('CouponXL Custom Locations Widget','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$locations = empty( $instance['locations'] ) ? array() : $instance['locations'];
		$columns = empty( $instance['columns'] ) ? '' : $instance['columns'];
		$rnd = couponxl_random_string();
		echo $before_widget.$before_title.$title.$after_title.'<div class="white-block-content">';

		if( !empty( $locations ) ){
			$style = '<style>
			.list_'.$rnd.'{
				columns: '.$columns.';
				-moz-columns: '.$columns.';
				-webkit-columns: '.$columns.';
				-ms-columns: '.$columns.';
				-o-columns: '.$columns.';
			}
			</style>';
			echo couponxl_shortcode_style( $style ).'<ul class="list-unstyled list_'.$rnd.'">';
			foreach( $locations as $location_id ){
				$location = get_term_by( 'slug', $location_id, 'location' );
				if( !empty( $location ) ){
					?>
					<li>
						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'location' => $location->slug ), array( 'all' ) ) ) ?>">
							<?php echo $location->name; ?>
						</a>
					</li>
					<?php
				}
			}
			?>
			<li>
				<a href="<?php echo esc_url( $permalink ) ?>">
					<?php _e( 'All Cities', 'couponxl' ) ?>
				</a>
			</li>			
			<?php
			echo '</ul>';
		}
		echo '</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'locations' => array(), 'columns' => '1' ) );
		
		$title = esc_attr( $instance['title'] );
		$locations = (array)$instance['locations'];
		$columns = esc_attr( $instance['columns'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		

		echo '<p><label for="'.esc_attr($this->get_field_id('locations')).'">'.__( 'Locations:', 'couponxl' ).'</label>';
		echo '<select style="min-height: 200px" class="widefat" id="'.esc_attr($this->get_field_id('locations')).'"  name="'.esc_attr($this->get_field_name('locations')).'[]" multiple="multiple">';
			$terms = couponxl_get_organized( 'location' );
			if( !empty( $terms ) ){
				foreach( $terms as $key => $term ){
					couponxl_display_indent_select_tree( $term, $locations, 0 );
				}
			}
		echo '</select>';

		echo '<p><label for="'.esc_attr($this->get_field_id('columns')).'">'.__( 'Columns:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('columns')).'"  name="'.esc_attr($this->get_field_name('columns')).'" value="'.esc_attr( $columns ).'"></p>';		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['locations'] = $new_instance['locations'];
		$instance['columns'] = strip_tags( $new_instance['columns'] );
		return $instance;	
	}	
}


/********************************************************
COUPONXL Custom Menu Widget
********************************************************/
class Couponxl_Custom_Menu extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_custom_menu', __('CouponXL Footer Custom Menu','couponxl'), array('description' =>__('CouponXL Custom Menu Widget For The Footer Only','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$menu = empty( $instance['menu'] ) ? '' : $instance['menu'];
		$columns = empty( $instance['columns'] ) ? '' : $instance['columns'];
		$rnd = couponxl_random_string();

		$menu = wp_get_nav_menu_items( $menu );
		echo $before_widget.$before_title.$title.$after_title.'<div class="white-block-content">';

		if( !empty( $menu ) ){
			$style = '<style>
			.list_'.$rnd.'{
				columns: '.$columns.';
				-moz-columns: '.$columns.';
				-webkit-columns: '.$columns.';
				-ms-columns: '.$columns.';
				-o-columns: '.$columns.';
			}
			</style>';
			echo couponxl_shortcode_style( $style ).'<ul class="list-unstyled list_'.$rnd.'">';
			foreach( $menu as $menu_item ){
				?>
				<li>
					<a href="<?php echo esc_url( $menu_item->url ); ?>">
						<?php echo $menu_item->title; ?>
					</a>
				</li>
				<?php
			}
			echo '</ul>';
		}
		echo '</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'menu' => '', 'columns' => '1' ) );
		
		$title = esc_attr( $instance['title'] );
		$menu = $instance['menu'];
		$columns = esc_attr( $instance['columns'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		

		echo '<p><label for="'.esc_attr($this->get_field_id('menu')).'">'.__( 'Menu:', 'couponxl' ).'</label>';
		echo '<select class="widefat" id="'.esc_attr($this->get_field_id('menu')).'"  name="'.esc_attr($this->get_field_name('menu')).'"">';
			$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
			if( !empty( $menus ) ){
				foreach( $menus as $menu_item ){
					echo '<option value="'.$menu_item->term_id.'" '.( $menu_item->term_id == $menu ? 'selected="selected"' : '' ).'>'.$menu_item->name.'</option>';
				}
			}
		echo '</select>';

		echo '<p><label for="'.esc_attr($this->get_field_id('columns')).'">'.__( 'Columns:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('columns')).'"  name="'.esc_attr($this->get_field_name('columns')).'" value="'.esc_attr( $columns ).'"></p>';		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['menu'] = $new_instance['menu'];
		$instance['columns'] = strip_tags( $new_instance['columns'] );
		return $instance;	
	}	
}

/********************************************************
COUPONXL Custom Menu Widget Two
********************************************************/
class Couponxl_Custom_Menu_Two extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_custom_menu_two', __('CouponXL Sidebar Custom Menu Two','couponxl'), array('description' =>__('CouponXL Custom Menu Widget Two For Sidebar Only','couponxl') ));
	}
	public function widget( $args, $instance ) {
		include( locate_template( 'includes/widget-walker.php' ) );
		extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];

		echo $before_widget;
		if( !empty( $title ) ){
			echo $before_title.$title.$after_title;
		}
		echo '<div class="white-block-content">';

		$locations = get_nav_menu_locations();
		$has_nav = isset( $locations[ 'widget-navigation' ] ) ? true : false;

        if ( $has_nav ) {
            wp_nav_menu( array(
                'theme_location'    => 'widget-navigation',
                'menu_class'        => 'clearfix',
                'container'         => false,
                'echo'              => true,
                'items_wrap'        => '<ul class="list-unstyled %2$s">%3$s</ul>',
                'depth'             => 10,
                'walker'            => new couponxl_widget_walker,
            ) );
        }
		echo '</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		
		$title = esc_attr( $instance['title'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;	
	}	
}

/******************************************************** 
CouponXL Tweets
********************************************************/
class CouponXL_Tweets extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_tweets', 'CouponXL Tweets', array( 'description' => "CouponXL Tweets Widget" ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Latest Tweets', 'couponxl' ) : $instance['title'], $instance, $this->id_base);
		$count = esc_attr( $instance['count'] );
		
		$list = '';
		
		$tweets = couponxl_return_tweets( $count );
		if( !empty( $tweets['error'] ) ){
			$list = '<li class="api_error">API Is Not Set</li>';
		}
		else{
			if( !empty( $tweets ) && empty( $tweets['errors'] ) ){
				$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
				$twitter_username = couponxl_get_option( 'twitter-username' );
				foreach( $tweets as $tweet ){
					$text = $tweet['text'];
					if( preg_match( $reg_exUrl, $text, $url ) ) {
					       $text =  preg_replace( $reg_exUrl, '<a href="'.$url[0].'">'.$url[0].'</a> ', $text );
					}
					$list .= '
						<li>
							<div class="tweet-bird">
								<i class="fa fa-twitter"></i>
							</div>
							<p>'.$text.'</p>
							<ul class="list-unstyled list-inline tweet-meta">
								<li>
									<a href="http://twitter.com/'.$twitter_username.'/status/'.$tweet['id_str'].'" target="_blank">
										<i class="fa fa-reply"></i>
									</a>
								</li>
								<li>
									<a href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'" target="_blank">
										<i class="fa fa-retweet"></i>
									</a>
								</li>
								<li>
									<p>'.human_time_diff( strtotime( $tweet['created_at'] ), current_time( 'timestamp' ) ).' '.__( 'ago', 'couponxl' ).'</p>
								</li>
							</ul>
						</li>';
					
				}
			}
		}
		echo $before_widget.$before_title.$title.$after_title.'
				<div class="news twitter">
					<ul class="list-unstyled">
						'.$list.'
					</ul>
				</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 1 ) );
		$title = esc_attr( $instance['title'] );
		$count = esc_attr( $instance['count'] );

		echo '<p><label for="'.($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input class="widefat" id="'.($this->get_field_id('title')).'"  name="'.($this->get_field_name('title')).'" type="text" value="'.esc_attr( $title ).'" /></p>';		
		
		echo '<p><label for="'.($this->get_field_id('count')).'">'.__( 'Count:', 'couponxl' ).'</label>';
		echo '<input class="widefat" id="'.($this->get_field_id('count')).'"  name="'.($this->get_field_name('count')).'" type="text" value="'.esc_attr( $count ).'" /></p>';

	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;	
	}	
}
/********************************************************
CuponXL Shortcode Text
********************************************************/
class CouponXL_Shortcode_Text extends WP_Widget{
	function __construct() {
		parent::__construct('widget_shortcode', __('CouponXL Shortcode Text','couponxl'), array('description' =>__('Text widget which can render shortcode.','couponxl') ));
	}

	function widget($args, $instance) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$instance['text'] = $instance['text'];

		echo $args['before_widget'];
		
		if ( !empty($instance['title']) ){
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		echo do_shortcode( $instance['text'] );
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['text'] = $new_instance['text'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$text = isset( $instance['text'] ) ? $instance['text'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'couponxl') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="shortcode-select"><?php _e('Shortcode:', 'couponxl') ?></label>
			<select id="shortcode-select" name="shortcode-select" class="shortcode-add">
				<option value=""><?php _e( '-Select-', 'couponxl' ) ?></option>
				<option value="accordion"><?php _e( 'Accordion', 'couponxl' ) ?></option>
				<option value="box"><?php _e( 'Box', 'couponxl' ) ?></option>
				<option value="button"><?php _e( 'Button', 'couponxl' ) ?></option>
				<option value="content"><?php _e( 'Content', 'couponxl' ) ?></option>
				<option value="featured_stores"><?php _e( 'Featured Stores', 'couponxl' ) ?></option>
				<option value="sidebar"><?php _e( 'Sidebar', 'couponxl' ) ?></option>
				<option value="slider"><?php _e( 'Slider', 'couponxl' ) ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('text') ); ?>"><?php _e('Text:', 'couponxl') ?></label>
			<textarea type="text" class="widefat shortcode-input" id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text') ); ?>" ><?php echo esc_textarea( $text ); ?></textarea>
		</p>
		<?php
	}
}
/********************************************************
CuponXL Categories List Widgets
********************************************************/
class CouponXL_Mega_Menu_Categories_List extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_mega_menu_categories_list', __('CouponXL Mega Menu Categories List','couponxl'), array('description' =>__('CouponXL Mega Menu Categories List','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);


		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$offer_cats_widget = empty( $instance['offer_cats'] ) ? array() : $instance['offer_cats'];
		$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );

		echo $before_widget;
			if( !empty( $title ) ){
				echo $before_title.$title.$after_title;
			}		
			echo '<ul class="list-unstyled">';
				if( !empty( $offer_cats_widget ) ){
					foreach( $offer_cats_widget as $offer_cat_item ){
						$term = get_term_by( 'slug', $offer_cat_item, 'offer_cat' );
						echo '<li><a href="'.( couponxl_append_query_string( $permalink, array( 'offer_cat' => $offer_cat_item ), array( 'all' ) ) ).'">'.$term->name.' <span class="badge">'.$term->count.'</span></a></li>';
					}
				}
			echo '</ul>';
		echo $after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'offer_cats' => array() ) );
		
		$title = esc_attr( $instance['title'] );
		$offer_cats_widget = (array)$instance['offer_cats'];

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';

		echo '<p><label for="'.esc_attr($this->get_field_id('offer_cats')).'">'.__( 'Categories:', 'couponxl' ).'</label>';
		echo '<select style="min-height: 200px" id="'.esc_attr($this->get_field_id('offer_cats')).'" name="'.esc_attr($this->get_field_name('offer_cats')).'[]" class="widefat" multiple>';
			$terms = couponxl_get_organized( 'offer_cat' );
			if( !empty( $terms ) ){
				foreach( $terms as $key => $term ){
					couponxl_display_indent_select_tree( $term, $offer_cats_widget, 0 );
				}
			}
		echo '</select>';
		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['offer_cats'] = $new_instance['offer_cats'];
		return $instance;	
	}	
}

/********************************************************
CuponXL Locations List Widgets
********************************************************/
class CouponXL_Mega_Menu_Locations_List extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_mega_menu_locations_list', __('CouponXL Mega Menu Locations List','couponxl'), array('description' =>__('CouponXL Mega Menu Locations List','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );

		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$locations = empty( $instance['locations'] ) ? array() : $instance['locations'];
		
		echo $before_widget;
			if( !empty( $title ) ){
				echo $before_title.$title.$after_title;
			}
			echo '<ul class="list-unstyled">';
				if( !empty( $locations ) ){
					foreach( $locations as $location ){
						$term = get_term_by( 'slug', $location, 'location' );
						echo '<li><a href="'.( couponxl_append_query_string( $permalink, array( 'location' => $location ), array( 'all' ) ) ).'">'.$term->name.' <span class="badge">'.$term->count.'</span></a></li>';
					}
				}
			echo '</ul>';			
		echo $after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'locations' => array() ) );
		
		$title = esc_attr( $instance['title'] );
		$locations = (array)$instance['locations'];

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';

		echo '<p><label for="'.esc_attr($this->get_field_id('locations')).'">'.__( 'Categories:', 'couponxl' ).'</label>';
		echo '<select style="min-height: 200px" id="'.esc_attr($this->get_field_id('locations')).'" name="'.esc_attr($this->get_field_name('locations')).'[]" class="widefat" multiple>';
			$terms = couponxl_get_organized( 'location' );
			if( !empty( $terms ) ){
				foreach( $terms as $key => $term ){
					couponxl_display_indent_select_tree( $term, $locations, 0 );
				}
			}
		echo '</select>';
		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['locations'] = $new_instance['locations'];
		return $instance;	
	}	
}

/********************************************************
CuponXL Custom list
********************************************************/
class CouponXL_Mega_Menu_Custom_List extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_mega_menu_custom_list', __('CouponXL Mega Menu Custom List','couponxl'), array('description' =>__('CouponXL Mega Menu Custom List','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);


		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$content = empty( $instance['content'] ) ? '' : $instance['content'];
		
		echo $before_widget;
			if( !empty( $title ) ){
				echo $before_title.$title.$after_title;
			}		
			echo $content;
		echo $after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'content' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$content = esc_attr( $instance['content'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';

		echo '<p><label for="'.esc_attr($this->get_field_id('content')).'">'.__( 'Content:', 'couponxl' ).'</label>';
		echo '<textarea class="widefat" id="'.esc_attr($this->get_field_id('content')).'"  name="'.esc_attr($this->get_field_name('content')).'">'.$content.'</textarea></p>';		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['content'] = $new_instance['content'];
		return $instance;	
	}	
}

/********************************************************
CuponXL Mega Menu Images
********************************************************/
class CouponXL_Mega_Menu_Images extends WP_Widget {
	public function __construct() {
		parent::__construct('couponxl_mega_menu_images', __('CouponXL Mega Menu Images','couponxl'), array( 'description' => __('CouponXL Mega Menu Images','couponxl') ));
	}
	public function widget( $args, $instance ) {
		extract($args);


		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];
		$image = empty( $instance['image'] ) ? '' : $instance['image'];
		
		echo $before_widget.$before_title.$title.$after_title;
			echo '<a href="'.esc_attr( $link ).'"><img src="'.esc_url( $image ).'" alt="" class="img-responsive" /></a>';
		echo $after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'link' => '', 'image' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$link = esc_attr( $instance['link'] );
		$image = esc_attr( $instance['image'] );

		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__( 'Title:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr( $title ).'"></p>';

		echo '<p><label for="'.esc_attr($this->get_field_id('link')).'">'.__( 'Link:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('link')).'"  name="'.esc_attr($this->get_field_name('link')).'" value="'.esc_attr( $link ).'"></p>';

		echo '<p><label for="'.esc_attr($this->get_field_id('image')).'">'.__( 'Image:', 'couponxl' ).'</label>';
		echo '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('image')).'"  name="'.esc_attr($this->get_field_name('image')).'" value="'.esc_attr( $image ).'"></p>';		
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		return $instance;	
	}	
}

/******************************************************** 
CouponXL Subscribe
********************************************************/
class CouponXL_Subscribe extends WP_Widget {	
	public function __construct() {
		parent::__construct('couponxl_subscribe', __('CouponXL Subscribe','couponxl'), array('description' =>__("CouponXL Subscribe Widget","couponxl") ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Subscribe','couponxl') : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget.
				$before_title.$title.$after_title.'
				<div class="form-group">
					<input class="form-control" placeholder="'.esc_attr__( 'Type email and hit enter', 'couponxl' ).'" type="text">
				</div>'.$after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		
		$title = esc_attr( $instance['title'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','couponxl').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr( $title ).'" /></p>';	
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;	
	}	
}

/********************************************************
Add CouponXL Widgets
********************************************************/
function couponxl_widgets_load(){
	register_widget( 'Couponxl_Category' );
	register_widget( 'Couponxl_Locations' );
	register_widget( 'Couponxl_Popular_Stores' );
	register_widget( 'Couponxl_Custom_Stores' );
	register_widget( 'Couponxl_Latest_Posts_Comments' );
	register_widget( 'Couponxl_Latest_Posts' );
	register_widget( 'Couponxl_Custom_Locations' );
	register_widget( 'Couponxl_Custom_Menu' );
	register_widget( 'Couponxl_Custom_Menu_Two' );
	register_widget( 'CouponXL_Tweets' );
	register_widget( 'CouponXL_Shortcode_Text' );
	register_widget( 'CouponXL_Mega_Menu_Categories_List' );
	register_widget( 'CouponXL_Mega_Menu_Locations_List' );
	register_widget( 'CouponXL_Mega_Menu_Custom_List' );
	register_widget( 'CouponXL_Mega_Menu_Images' );
	register_widget( 'CouponXL_Subscribe' );
}
add_action( 'widgets_init', 'couponxl_widgets_load' );
?>