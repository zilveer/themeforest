<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(dirname(__FILE__).'/widget.php');

class dfd_recent_posts extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_recent_posts';
	protected $widget_name = 'Widget: Recent Posts';
	
	protected $options;
	
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
		$this->widget_params = array(
			'description' => __('Advanced recent posts widget.', 'dfd')
		);
		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => __('Title', 'dfd'), 
				'input'=>'text', 
				'filters'=>'widget_title', 
				'on_update'=>'esc_attr',
			),
			array(
				'limit', 'int', 5, 
				'label' => __('Limit', 'dfd'), 
				'input'=>'select', 
				'values' => array('range', 'from'=>1, 'to'=>20),
			),
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
				'radius', 'text', '', 
				'label' => __('Border radius in px', 'dfd'), 
				'input'=>'text', 
			),
			array(
				'cat', 'text', '', 
				'label' => __('Limit to category', 'dfd'), 
				'input'=>'wp_dropdown_categories',
			),
		);
		
        parent::__construct();
    }

    /**
     * Display widget
     */
    function widget( $args, $instance ) {
        extract( $args );
		$this->setInstances($instance, 'filter');
		
        echo $before_widget;

		$title = $this->getInstance('title');
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
		}

		$query = new WP_Query(array(
			'posts_per_page' => $this->getInstance('limit'),
			'category_name' => $this->getInstance('cat'),
		));
		
		$author = $this->getInstance('author');
		$date = $this->getInstance('date');
		$comments = $this->getInstance('comments');
		$border_radius_thumb = $this->getInstance('radius');
		
		$border_radius_thumb_style = '';
		if ($border_radius_thumb != '') {
			$border_radius_thumb_style = 'style="border-radius: '.esc_attr($border_radius_thumb).'px;"';
		}
		?>

        <div class="recent-posts-list <?php echo $comments ? 'comments-enabled' : '' ?>">
		<?php
		
	    if ($query->have_posts()) {
			while($query->have_posts()) :
				$query->the_post();
			?>
            <div class="post-list-item clearfix">

				<div class="entry-thumb entry-thumb-hover" <?php echo $border_radius_thumb_style; ?>>
					<?php get_template_part('templates/thumbnail/post', 'widget'); ?>
					<?php if ($comments) { ?>
						<div class="post-comments-wrap">
							<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
						</div>
					<?php } ?>
				</div>

				<div class="entry-content-wrap">
					<div class="box-name">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dfd' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</div>

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
			endwhile; wp_reset_postdata();
		} ?>

        </div>

    <?php

        echo $after_widget;
    }

}
