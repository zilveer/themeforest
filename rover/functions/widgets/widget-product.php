<?php
/*
 * @package by Theme Record
 * @auther: MattMao
*/

class theme_widget_product extends WP_Widget 
{
	public $widget_cssclass;
	public $widget_description;
	public $widget_id;
	public $widget_name;

	#
	#Constructor
	#
	public function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass      = 'widget-product widget-post';
		$this->widget_description   = __('This widget will display a product section.', 'TR');
		$this->widget_id            = THEME_SLUG. '_product';
		$this->widget_name          = sprintf( __( '%1$s %2$s', 'TR' ), THEME_NAME, __( '&raquo; Product', 'TR' ) );

		$widget_ops = array( 
			'classname'   => $this->widget_cssclass, 
			'description' => $this->widget_description 
		);
		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );
	}


	#
	#Form
	#
	function form($instance) 
	{
		$instance = wp_parse_args((array) $instance, array( 
			'title' => 'Products',
			'showposts' => 3,
			'cat' => '',
			'orderby' => 'date'
		));
		$title = strip_tags($instance['title']);
		$showposts = strip_tags($instance['showposts']);
		$cat = strip_tags($instance['cat']);
		$orderby = strip_tags($instance['orderby']);
		?>
		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</div>

		<div class="theme-widget-wrap">
		<label for="<?php echo $this->get_field_id( 'showposts' ); ?>"><?php _e('Showposts:','TR'); ?></label>
		<input  id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" type="text" value="<?php echo esc_attr( $showposts ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Cats:','HK'); ?></label>
			<textarea  id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>"  rows="3"><?php echo esc_attr( $cat ); ?></textarea>
			<p class="theme-description"><?php _e('Category IDs, separated by commas.', 'TR'); ?></p>
		</div>

		<div class="theme-widget-wrap">
		<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e('Orderby:','TR'); ?></label>
		<select name="<?php echo $this->get_field_name('orderby'); ?>">
			<option value="date" <?php selected('date', $orderby); ?>><?php _e('Date','TR'); ?></option>
			<option value="comment_count" <?php selected('comment_count', $orderby); ?>><?php _e('Comment','TR'); ?></option>
			<option value="rand" <?php selected('rand', $orderby); ?>><?php _e('Rand','TR'); ?></option>
		</select>
		</div>
		<?php
	}	


	#
	#Update & save the widget
	#
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;	
		foreach($new_instance as $key=>$value)
		{
			$instance[$key]	= strip_tags($new_instance[$key]);
		}
		return $instance;
	}


	#
	#Prints the widget
	#
	function widget($args, $instance) 
	{
		extract($args, EXTR_SKIP);

		global $post;

		$title = $instance['title'];
		$showposts = $instance['showposts'];
		$cat = $instance['cat'];
		$orderby = $instance['orderby'];
		$post_id = get_the_ID();


		$cat_array = explode(',', $cat);

		if(empty($cat_array[0]))
		{
			$args = array( 
				'post_type' => 'product',
				'posts_per_page' => $showposts,
				'orderby' => $orderby,
				'post__not_in' => array($post_id),
				'post_status' => 'publish', 
				'ignore_sticky_posts' => 1
			);
		}
		else
		{
			$args = array( 
				'posts_per_page' => $showposts,
				'orderby' => $orderby,
				'post__not_in' => array($post_id),
				'tax_query' => array( 
					array( 
						'taxonomy' => 'product-category', 
						'field' => 'id', 
						'terms' => explode(',', $cat), 
						'operator' => 'IN'
					)
				),
				'post_status' => 'publish', 
				'ignore_sticky_posts' => 1
			);
		}
		$query = new WP_Query( $args );
	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title . $title . $after_title; ?>
	<ul>
	<?php
		global $tr_config;
		$currency = $tr_config['currency'];

		while ($query->have_posts()) : $query->the_post();
		$desc = get_the_excerpt();
		$product_price = get_meta_option('product_price');
	?>
	<li class="clearfix">
	<?php if(has_post_thumbnail()) : ?>
	<div class="alignleft post-thumb post-thumb-preload post-thumb-hover">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'TR' ), the_title_attribute( 'echo=0' ) ); ?>" class="loader-icon">
		<?php echo get_featured_image($post_id=NULL, 'widget', 'wp-preload-image', get_the_title()); ?>
		</a>
	</div>
	<?php endif; ?>
	<div class="post-entry">
	<h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php if($product_price) : ?><div class="price meta"><span><?php echo price_currency_symbol($currency); ?></span><?php echo $product_price; ?></div><?php endif; ?>
	</div>
	</li>
	<?php endwhile; wp_reset_postdata(); ?>
	</ul>
	<?php echo $after_widget; ?>
	<?php
	}
}

register_widget( 'theme_widget_product' );
?>