<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(dirname(__FILE__).'/widget.php');

class crum_cat_tabs_widget extends SB_WP_Widget {
	
	protected $widget_base_id = 'crum_cat_tabs';
	protected $widget_name = 'Widget: Cat tabs';
	
	protected $options;
	
	function __construct() {
		
		$this->widget_params = array(
			'description' => __('Add tabs widget with the posts of chosen category', 'dfd')
		);
		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => __('Title', 'dfd'), 
				'input'=>'text', 
				'filters'=>'widget_title', 
				'on_update'=>'esc_attr',
			),

			// First column
			array(
				'first_col_title', 'text', '', 
				'label' => __('First col title', 'dfd'), 
				'input'=>'text', 
				'on_update'=>'esc_attr',
			),
			array(
				'first_col_categories', 'text', '', 
				'label' => __('First col categories (slugs)', 'dfd'), 
				'input'=>'text', 
				'on_update'=>'esc_attr',
			),
			array(
				'first_col_num', 'int', 5, 
				'label' => __('First col posts number', 'dfd'), 
				'input'=>'text', 
				'on_update'=>'esc_attr',
			),

			// Second column
			array(
				'second_col_title', 'text', '', 
				'label' => __('Second col title', 'dfd'), 
				'input'=>'text', 
				'on_update'=>'esc_attr',
			),
			array(
				'second_col_categories', 'text', '', 
				'label' => __('Second col categories (slugs)', 'dfd'), 
				'input'=>'text', 
				'on_update'=>'esc_attr',
			),
			array(
				'second_col_num', 'int', 5, 
				'label' => __('Second col posts number', 'dfd'), 
				'input'=>'text',
				'on_update'=>'esc_attr',
			),

			// Third column
			array(
				'third_col_title', 'text', '', 
				'label' => __('Third col title', 'dfd'), 
				'input'=>'text', 
				'on_update'=>'esc_attr',
			),
			array(
				'third_col_categories', 'text', '', 
				'label' => __('Third col categories (slugs)', 'dfd'),
				'input'=>'text', 
				'on_update'=>'esc_attr',
			),
			array(
				'third_col_num', 'int', 5, 
				'label' => __('Third col posts number', 'dfd'), 
				'input'=>'text',
				'on_update'=>'esc_attr',
			),
			// General Settings
			array(
				'date', 'text', '', 
				'label' => __('Display date', 'dfd'), 
				'input'=>'checkbox',
			),
			array(
				'comments', 'text', '', 
				'label' => __('Display comments', 'dfd'), 
				'input'=>'checkbox',
			),
			array(
				'author', 'text','', 
				'label' => __('Display author', 'dfd'), 
				'input'=>'checkbox',
			),
			array(
				'thumb_radius', 'int', 0, 
				'label' => __('Thumb border radius in px:', 'dfd'), 
				'input'=>'text',
				'on_update'=>'esc_attr',
			),
		);
		parent::__construct();
	}
	
	function widget($args, $instance) {
		extract( $args );
		$this->setInstances($instance, 'filter');
		
		$title = $this->getInstance('title');
		
		$uniqid = uniqid();
		
		$first_col_title = $this->getInstance('first_col_title');
		$first_col_categories = $this->getInstance('first_col_categories');
		$first_col_num = $this->getInstance('first_col_num');
		
		$second_col_title = $this->getInstance('second_col_title');
		$second_col_categories = $this->getInstance('second_col_categories');
		$second_col_num = $this->getInstance('second_col_num');
		
		$third_col_title = $this->getInstance('third_col_title');
		$third_col_categories = $this->getInstance('third_col_categories');
		$third_col_num = $this->getInstance('third_col_num');
		
		$author = $this->getInstance('author');
		$date = $this->getInstance('date');
		$comments = $this->getInstance('comments');
		
		$thumb_radius = $this->getInstance('thumb_radius');
		
		echo $before_widget;
		
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
		}
		?>

		<dl class="tabs contained horisontal">
			<dt></dt>
			<dd class="active"><a href="#first-p-tab-<?php echo esc_attr($uniqid); ?>"><?php echo $first_col_title; ?></a></dd>
			<dt></dt>
			<dd><a href="#second-p-tab-<?php echo esc_attr($uniqid); ?>"><?php echo $second_col_title; ?></a></dd>
			<dt></dt>
			<dd><a href="#third-p-tab-<?php echo esc_attr($uniqid); ?>"><?php echo $third_col_title; ?></a></dd>
        </dl>

		<ul class="tabs-content contained recent-posts-list clearfix <?php echo $comments ? 'comments-enabled' : '' ?>">
            <li id="first-p-tab-<?php echo esc_attr($uniqid); ?>Tab" class="active">
                <?php $this->tab_content($first_col_categories, $first_col_num, $thumb_radius, $author, $date, $comments); ?>
            </li>
            <li id="second-p-tab-<?php echo esc_attr($uniqid); ?>Tab">
                <?php $this->tab_content($second_col_categories, $second_col_num, $thumb_radius, $author, $date, $comments); ?>
            </li>
            <li id="third-p-tab-<?php echo esc_attr($uniqid); ?>Tab">
                <?php $this->tab_content($third_col_categories, $third_col_num, $thumb_radius, $author, $date, $comments); ?>
            </li>
        </ul>
		
		<?php
		echo $after_widget;
	}
	
	protected function tab_content($cat = '', $post_count = 5, $thumb_radius = 0, $author = false, $date = true, $comments = true) {
		$query = new WP_Query(array(
			'category_name' => $cat,
			'posts_per_page' => $post_count,
		));
					
		if ($query->have_posts()) {
			while($query->have_posts()) {
				$query->the_post();
				$rounded_style = 'style="border-radius:'.esc_attr($thumb_radius).'px;"';
				?>

				<div class="post-list-item clearfix">
					<div class="entry-thumb" <?php echo $rounded_style; ?>>
						<?php get_template_part('templates/thumbnail/post', 'widget'); ?>
						<?php if ($comments) { ?>
							<div class="post-comments-wrap">
								<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
							</div>
						<?php } ?>
					</div>
					<div class="entry-content-wrap">
						<div class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<?php if ($author || $date) { ?>
							<div class="entry-meta dopinfo">
								<?php
								if ($author) {
									get_template_part('templates/entry-meta/mini', 'author');
									get_template_part('templates/entry-meta/mini', 'delim-blank');
								}

								if ($date) {
									get_template_part('templates/entry-meta/mini', 'date');
								}
								?>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
	}
}