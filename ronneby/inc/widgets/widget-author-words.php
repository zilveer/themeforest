<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(dirname(__FILE__).'/widget.php');

class dfd_author_words extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_author';
	protected $widget_name = 'Widget: Words from author';
	
	protected $options;

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
		$this->widget_params = array(
			'description' => __('Last Testimonials', 'dfd'),
		);
		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => __('Title', 'dfd'), 
				'input'=>'text', 
				'filters'=>'widget_title', 
				'on_update'=>'esc_attr',
			),
		);
		
        parent::__construct();
    }
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __('Word from author', '' );
        }
		if ( isset( $instance['soc_icon_hover_style'] ) ) {
            $soc_icon_hover_style = $instance['soc_icon_hover_style'];
        } else {
            $soc_icon_hover_style = 'default';
        }
		
		if(function_exists('dfd_soc_icons_hover_style')) {
			$hover_styles_option = dfd_soc_icons_hover_style();
		} else {
			$hover_styles_option = '';
		}
		
		if (isset($instance['imageUpload'])) {
			$imageUpload = $instance['imageUpload'];
		} else {
			$imageUpload = '';
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'dfd' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php if(!empty($hover_styles_option)) : ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('soc_icon_hover_style')); ?>"><?php _e('Soc icon hover style', 'dfd'); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('soc_icon_hover_style')); ?>" name="<?php echo esc_attr($this->get_field_name('soc_icon_hover_style')); ?>">
				<option class="widefat" value="default" <?php if ($soc_icon_hover_style == 'default') echo 'selected'; ?>><?php _e('Widget default','dfd') ?></option>
				<?php foreach($hover_styles_option as $key => $val) : ?>
					<option class="widefat" value="<?php echo esc_attr($key); ?>" <?php if ($soc_icon_hover_style == $key) echo 'selected'; ?>><?php echo $val ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('imageUpload')); ?>"><?php _e('Header background image:', 'dfd'); ?></label>
			<img src="<?php echo (substr_count(esc_attr( $imageUpload ), 'http://') > 0) ? esc_url( $imageUpload ) : ''; ?>" alt="" class="image_uploaded" style="<?php echo (substr_count(esc_attr( $imageUpload ), 'http://') > 0) ? '' : 'display: none;'; ?> padding: 20px 0; max-width: 100%;" />
			<input id="<?php echo esc_attr($this->get_field_id('imageUpload')); ?>" class="upload_image" type="hidden" name="<?php echo esc_attr($this->get_field_name('imageUpload')); ?>" value="<?php echo esc_url($imageUpload); ?>" /> 
			<input class="upload_image_button button" type="button" value="<?php _e('Upload Image','dfd'); ?>" />
			<?php if(substr_count(esc_attr( $imageUpload ), 'http://') > 0) : ?>
				<input class="remove_image_button button" type="button" value="<?php _e('Remove Image','dfd'); ?>" />
			<?php endif; ?>
		</p>
		<?php endif; ?>
		<?php
	}
	 public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['soc_icon_hover_style'] = $new_instance['soc_icon_hover_style'];
		$instance['imageUpload'] = esc_url($new_instance['imageUpload']);

        return $instance;
    }
    /**
     * Display widget
     */
    function widget( $args, $instance ) {
        extract( $args );
		$this->setInstances($instance, 'filter');
		$soc_icon_hover_style = !empty($instance['soc_icon_hover_style']) ? $instance['soc_icon_hover_style'] : 'dfd-soc-icons-hover-style-13';
		$imageUpload = isset($instance['imageUpload']) && !empty($instance['imageUpload']) ? $instance['imageUpload'] : '';
		
        echo $before_widget;

		$post_type_option = (class_exists('DfdCustomTaxonomies')) ? 'author' : 'dfd-author';
		
		$args = array(
            'posts_per_page' => 1,
			'post_type' => $post_type_option
        );
		
		$the_query = new WP_Query($args);
		
		$soc_networks = array(
			"dfd_author_facebook" => "soc_icon-facebook",
			"dfd_author_twitter" => "soc_icon-twitter-3",
			"dfd_author_google" => "soc_icon-google__x2B_",
			"dfd_author_flickr" => "soc_icon-flickr",
			"dfd_author_linkedin" => "soc_icon-linkedin",
			"dfd_author_vimeo" => "soc_icon-vimeo",
			"dfd_author_instagram" => "soc_icon-instagram",
		);

		$title = $this->getInstance('title');
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
	?>

	<div class="author-box">
		<div class="top-information-author" <?php if(!empty($imageUpload)) : ?> style="background-image: url(<?php echo esc_url($imageUpload) ?>);" <?php endif; ?>>
			<?php
			while ($the_query->have_posts()) : $the_query->the_post();
				$autor = get_post_meta(get_the_ID(), 'dfd_author_name', true);
				$additional = get_post_meta(get_the_ID(), 'dfd_author_subtitle', true);
			?>
			<div class="author-image">
				<?php
					if (has_post_thumbnail()) {
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url($thumb, 'large'); //get img URL

						$article_image = dfd_aq_resize($img_url, 120, 120, true, true, true);
						if(!$article_image) {
							$article_image = $img_url;
						}
						?>
						<img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>

					<?php } else { ?>
						<i class="dfd-icon-user"></i>
					<?php } ?>
			</div>
		</div>
		<div class="heading">
			<?php if(!empty($autor)): ?>
				<h3 class="widget-title"><?php echo $autor; ?></h3>
			<?php endif; ?>

			<?php if(!empty($additional)): ?>
				<div class="subtitle"><?php echo $additional; ?></div>
			<?php endif; ?>
		</div>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
		<?php
			$output = $icon_add_html =  '';
			if($soc_icon_hover_style != 'default') {
				$icon_add_html .= '<span class="line-top-left"></span><span class="line-top-center"></span><span class="line-top-right"></span><span class="line-bottom-left"></span><span class="line-bottom-center"></span><span class="line-bottom-right"></span>';
			}
			foreach($soc_networks as $key => $value) {
				$soc_account = get_post_meta(get_the_ID(), $key, true);
				if(!empty($soc_account)) {
					$output .= '<a href="'.esc_url($soc_account).'" class="'.esc_attr($value).'">'.$icon_add_html.'<i class="'.esc_attr($value).'"></i></a>';
				}
			}
			echo '<div class="widget soc-icons dfd-soc-icons-hover-style-'.esc_attr($soc_icon_hover_style).' clearfix">';
			echo $output;
			echo '</div>';
		?>
	<?php endwhile; ?>
	</div>

	<?php wp_reset_postdata(); ?>

    <?php

        echo $after_widget;
    }

}