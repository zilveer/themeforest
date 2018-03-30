<?php /* Plumtree Recent Posts/Products */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'widgets_init', create_function( '', 'register_widget( "pt_recent_post_widget" );' ) );

class pt_recent_post_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'pt_recent_post_widget',
			esc_html__('PT Recent Posts/Products', 'plumtree'),
			array('description' => esc_html__( "Plum Tree special widget. Displaying number of recent posts (or products) on your site.", 'plumtree' ), )
		);
	}

	public function form($instance) {
		$defaults = array(
			'title' => 'Recent Posts',
			'post-quantity' => 5,
			'post-type' => 'post',
			'sort-by' => 'date',
			'sort-order' => false,  // DESC
			'date' => false,
			'comments' => false,
			'category' => '',
			'thumb' => false,
			'excerpt' => false,
			'excerpt-more' => '[...]',
			'price' => false,
			'cats' => false,
			'show_in_menu' => false,
			'cols-qty' => 2,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title: ', 'plumtree' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('post-quantity'); ?>"><?php esc_html_e( 'How many posts to display: ', 'plumtree' ) ?></label>
			<input size="3" id="<?php echo esc_attr( $this->get_field_id('post-quantity') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post-quantity') ); ?>" type="number" value="<?php echo esc_attr( $instance['post-quantity'] ); ?>" />
		</p>
		<p>
      <label for="<?php echo $this->get_field_id('post-type'); ?>"><?php esc_html_e('Show Posts for next Post Type:', 'plumtree');?></label>
      <select class="widefat" id="<?php echo $this->get_field_id('post-type'); ?>" name="<?php echo $this->get_field_name('post-type'); ?>">
        <option value="post" <?php selected( $instance["post-type"], "post" ); ?>><?php esc_html_e( 'Posts', 'plumtree' ) ?></option>
        <option value="product" <?php selected( $instance["post-type"], "product" ); ?>><?php esc_html_e( 'Products', 'plumtree' ) ?></option>
      </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id("sort-by"); ?>"><?php esc_html_e('Sort by:', 'plumtree'); ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id("sort-by"); ?>" name="<?php echo $this->get_field_name("sort-by"); ?>">
        <option value="date" <?php selected( $instance["sort-by"], "date" ); ?>><?php esc_html_e( 'Date', 'plumtree' ) ?></option>
        <option value="title" <?php selected( $instance["sort-by"], "title" ); ?>><?php esc_html_e( 'Title', 'plumtree' ) ?></option>
        <option value="comment_count" <?php selected( $instance["sort-by"], "comment_count" ); ?>><?php esc_html_e( 'Number of comments', 'plumtree' ) ?></option>
				<option value="author" <?php selected( $instance["sort-by"], "author" ); ?>><?php esc_html_e( 'Author', 'plumtree' ) ?></option>
        <option value="rand" <?php selected( $instance["sort-by"], "rand" ); ?>><?php esc_html_e( 'Random', 'plumtree' ) ?></option>
      </select>
    </p>
    <p>
    	<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("sort-order"); ?>" name="<?php echo $this->get_field_name("sort-order"); ?>" <?php checked( (bool) $instance["sort-order"] ); ?> />
      <label for="<?php echo $this->get_field_id("sort-order"); ?>"><?php esc_html_e( 'Reverse sort order (ascending)?', 'plumtree' ); ?></label>
    </p>
    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>"<?php checked( (bool) $instance["date"] ); ?> />
    	<label for="<?php echo $this->get_field_id("date"); ?>"><?php esc_html_e( 'Show publish date?', 'plumtree' ); ?></label>
    </p>
    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("cats"); ?>" name="<?php echo $this->get_field_name("cats"); ?>"<?php checked( (bool) $instance["cats"] ); ?> />
      <label for="<?php echo $this->get_field_id("cats"); ?>"><?php esc_html_e( 'Show list of post/products Categories?', 'plumtree' ); ?></label>
    </p>
    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("comments"); ?>" name="<?php echo $this->get_field_name("comments"); ?>"<?php checked( (bool) $instance["comments"] ); ?> />
      <label for="<?php echo $this->get_field_id("comments"); ?>"><?php esc_html_e( 'Show number of comments/reviews?', 'plumtree' ); ?></label>
    </p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Specify ID of category (categories) to show: ', 'plumtree' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('category') ); ?>" name="<?php echo esc_attr( $this->get_field_name('category') ); ?>" type="text" value="<?php echo esc_attr( $instance['category'] ); ?>" />
		</p>
    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("thumb"); ?>" name="<?php echo $this->get_field_name("thumb"); ?>"<?php checked( (bool) $instance["thumb"] ); ?> />
      <label for="<?php echo $this->get_field_id("thumb"); ?>"><?php esc_html_e( 'Show post/product featured image?', 'plumtree' ); ?></label>
    </p>
    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"] ); ?> />
      <label for="<?php echo $this->get_field_id("excerpt"); ?>"><?php esc_html_e( 'Show post/product excerpt?', 'plumtree' ); ?></label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id("excerpt-more"); ?>"><?php esc_html_e( 'Excerpt read more text:', 'plumtree' ); ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id("excerpt-more"); ?>" name="<?php echo $this->get_field_name("excerpt-more"); ?>" value="<?php echo esc_attr( $instance['excerpt-more'] ); ?>" size="10" />
    </p>
    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("price"); ?>" name="<?php echo $this->get_field_name("price"); ?>"<?php checked( (bool) $instance["price"] ); ?> />
      <label for="<?php echo $this->get_field_id("price"); ?>"><?php esc_html_e( 'Show price? (products only)', 'plumtree' ); ?></label>
    </p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_in_menu"); ?>" name="<?php echo $this->get_field_name("show_in_menu"); ?>"<?php checked( (bool) $instance["show_in_menu"] ); ?> />
			<label for="<?php echo $this->get_field_id("show_in_menu"); ?>"><?php esc_html_e( 'Check if you want to add widget to Max Mega Menu', 'plumtree' ); ?></label>
		</p>
		<p>
      <label for="<?php echo $this->get_field_id("cols-qty"); ?>"><?php esc_html_e('Columns quantity for posts/products in Max Mega Menu:', 'plumtree'); ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id("cols-qty"); ?>" name="<?php echo $this->get_field_name("cols-qty"); ?>">
        <option value="2" <?php selected( $instance["cols-qty"], "2" ); ?>><?php esc_html_e( '2 Columns', 'plumtree' ) ?></option>
        <option value="3" <?php selected( $instance["cols-qty"], "3" ); ?>><?php esc_html_e( '3 Columns', 'plumtree' ) ?></option>
        <option value="4" <?php selected( $instance["cols-qty"], "4" ); ?>><?php esc_html_e( '4 Columns', 'plumtree' ) ?></option>
        <option value="6" <?php selected( $instance["cols-qty"], "6" ); ?>><?php esc_html_e( '6 Columns', 'plumtree' ) ?></option>
      </select>
    </p>
	<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post-quantity'] = intval( $new_instance['post-quantity'] );
		$instance['post-type'] = strip_tags( $new_instance['post-type'] );
		$instance['sort-by'] = strip_tags( $new_instance['sort-by'] );
		$instance['sort-order'] = $new_instance['sort-order'];
		$instance['date'] = $new_instance['date'];
		$instance['comments'] = $new_instance['comments'];
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['thumb'] = $new_instance['thumb'];
		$instance['excerpt'] = $new_instance['excerpt'];
		$instance['excerpt-more'] = strip_tags( $new_instance['excerpt-more'] );
		$instance['price'] = $new_instance['price'];
		$instance['cats'] = $new_instance['cats'];
		$instance['show_in_menu'] = $new_instance['show_in_menu'];
		$instance['cols-qty'] = strip_tags( $new_instance['cols-qty'] );

		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);

		$post_type = ( isset($instance['post-type']) ? $instance['post-type'] : 'post' );

		if ( class_exists('Woocommerce') && $post_type==='product' && (is_shop() || is_product_category() || is_product_tag() ) ) return;

		$title = apply_filters('widget_title', $instance['title'] );
		$post_num = ( isset($instance['post-quantity']) ? $instance['post-quantity'] : 5 );
		$sort_by = ( isset($instance['sort-by']) ? $instance['sort-by'] : 'date' );
		$sort_order = ( isset($instance['sort-order']) ? $instance['sort-order'] : false );
		if ($sort_order) { $order = 'ASC'; } else { $order = 'DESC'; }
		$show_date = ( isset($instance['date']) ? $instance['date'] : false );
		$show_comments = ( isset($instance['comments']) ? $instance['comments'] : false );
		$categories = ( isset($instance['category']) ? $instance['category'] : '' );
		$show_excerpt = ( isset($instance['excerpt']) ? $instance['excerpt'] : false );
		$excerpt_more = ( isset($instance['excerpt-more']) ? $instance['excerpt-more'] : '[...]' );

		$show_thumb = ( isset($instance['thumb']) ? $instance['thumb'] : false );
		$show_price = ( isset($instance['price']) ? $instance['price'] : false );
		$show_cats = ( isset($instance['cats']) ? $instance['cats'] : false );
		$show_in_menu = ( isset($instance['show_in_menu']) ? $instance['show_in_menu'] : false );
		$cols_qty = ( isset($instance['cols-qty']) ? $instance['cols-qty'] : '4' );

    // The Query
    $query_args = array (
      'ignore_sticky_posts' => 1,
			'posts_per_page' => $post_num,
			'orderby' => $sort_by,
			'order' => $order,
			'post_type' => $post_type,
			'post_status' => 'publish',
		);

		if ( $post_type === 'product' && $categories != '') {
			$query_args[] = array (
			'meta_query' => array(
				array(
						'key'           => '_visibility',
						'value'         => array('catalog', 'visible'),
						'compare'       => 'IN'
				)
			),
			'tax_query' => array(
				array(
						'taxonomy'      => 'product_cat',
						'terms'         => $categories,
						'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
				)
			));
		} else {
			$query_args[] = array ('cat' => $categories);
		}

		$the_query = new WP_Query( $query_args );

		// Extra classes if added to mega menu
		$extra_class = $extra_container_class = '';
		$thumb_size = 'pt-sidebar-thumbs';
		if ( $show_in_menu ) {
			$thumb_size = 'thumbnail';
			$extra_container_class = ' row';
			switch ($cols_qty) {
				case '2':
					$extra_class = ' col-xs-12 col-sm-6 col-md-6';
				break;
				case '3':
					$extra_class = ' col-xs-12 col-sm-6 col-md-4';
				break;
				case '4':
					$extra_class = ' col-xs-12 col-sm-6 col-md-3';
				break;
				case '6':
					$extra_class = ' col-xs-12 col-sm-6 col-md-2';
				break;
			}
		}

		echo $before_widget;
		if ($title) { echo $before_title . esc_attr($title) . $after_title; }

		echo '<ul class="recent-post-list'.esc_attr($extra_container_class).'">';
		while ( $the_query->have_posts() ) :
			$the_query->the_post();

			// Frontend Output
			?>
			<li class="recent-post-item<?php echo esc_attr($extra_class); ?>">

				<?php if ( $show_thumb && has_post_thumbnail() ) : ?>
				<div class="thumb-wrapper">
					<a class="recent-posts-img-link" rel="bookmark" href="<?php esc_url(the_permalink()); ?>" title="<?php esc_html_e('View details...', 'plumtree'); ?>">
						<?php the_post_thumbnail($thumb_size); ?>
					</a>
				</div>
				<?php endif; // Post Thumbnail ?>

				<div class="content-wrapper">
					<h4><a href="<?php esc_url(the_permalink()); ?>" class="nav-button" rel="bookmark" title="<?php esc_html_e('View details...', 'plumtree'); ?>"><?php esc_attr(the_title()); ?></a></h4>

					<?php if ($show_date || $show_comments || $show_cats) { ?>

						<div class="recent-posts-entry-meta">
						<?php if ($show_date) { ?>
							<span class="post-date"><?php the_time('F jS, Y'); ?><span class="post-author"> by <?php the_author_posts_link(); ?></span></span>
						<?php } // Post Date & Author

						if ($show_cats && $post_type != 'product') {
							$categories_list = get_the_category_list( __( ', ', 'plumtree' ) );
							if ( $categories_list ) { echo '<div class="post-cats">'.$categories_list.'</div>'; }
						} elseif ($show_cats && $post_type == 'product') {
							$categories = get_the_terms( get_the_ID(), 'product_cat' );
							if ( ! empty( $categories ) ) {
							    $count = count( $categories );
							    $i = 0;
							    $term_list = '<div class="post-cats">';
							    foreach ( $categories as $categorie ) {
							        $i++;
							        $term_list .= '<a href="' . esc_url( get_term_link( $categorie ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all post filed under %s', 'plumtree' ), $categorie->name ) ) . '">' . $categorie->name . '</a>';
							        if ( $count != $i ) {
							            $term_list .= ' &middot; ';
							        }
							        else {
							            $term_list .= '</div>';
							        }
							    }
									unset($categorie);
							    echo $term_list;
							}
						}

						if ($show_comments) { ?>
							<div class="comments-qty"><i class="fa fa-comments-o"></i>
							<?php if ( $post_type === 'product' ) {
								echo '<a href="'.get_the_permalink().'#comment-1">';
								printf( _nx( 'One Review', '%1$s Reviews', get_comments_number(), 'comments title', 'plumtree' ), number_format_i18n( get_comments_number() ) );
								echo "</a>";
							} else { ?>
							<?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off'); } ?>
							</div>
						<?php } // Post Comments ?>
						</div>

					<?php } ?>

					<?php if ($show_excerpt) : ?>
					<div class="recent-posts-entry-content"><?php the_excerpt(); ?>
						<a href="<?php esc_url(the_permalink()); ?>" class="more-link" rel="bookmark" title="<?php esc_html_e('View details...', 'plumtree'); ?>"><?php echo esc_attr($excerpt_more); ?></a>
					</div>
					<?php endif; // Post Content ?>

					<?php
					if ( $show_price && $post_type === 'product' && class_exists('Woocommerce') ) {
						echo '<div class="product-price">';
						woocommerce_template_single_price();
						echo '</div>';
					} ?>
				</div>

			</li>
		<?php
		endwhile;
		echo '</ul>';
		echo $after_widget;
		wp_reset_postdata();
	}
}
?>
