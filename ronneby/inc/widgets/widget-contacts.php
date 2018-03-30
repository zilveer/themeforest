<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class crum_contacts_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'crum_contacts_widget',
            __( 'Widget: Contacts block', 'dfd' ), // Name
            array( 'description' =>  __( 'Displays the author&apos;s contact information&#44; such as address&#44; phone etc&#46;', 'dfd')), 
			array('width' => 500, 'height' => 350)
        );
    }

    /**
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ) {
        extract( $args );
        $title = $instance['title'];
        $text = $instance['text'];
        $enable_soc_icons = $instance['enable_soc_icons'];
		
		global $dfd_ronneby;
		if(isset($dfd_ronneby['soc_icons_hover_style']) && !empty($dfd_ronneby['soc_icons_hover_style'])) {
			$soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['soc_icons_hover_style'];
		} else {
			$soc_icons_hover_style = 'dfd-soc-icons-hover-style-7';
		}
		
        echo $before_widget;

        if ( ! empty( $title ) )

            echo $before_title . $title . $after_title;

            echo $text;

		if($enable_soc_icons) {
			echo '<div class="text-left"><div class="widget soc-icons '.esc_attr($soc_icons_hover_style).'">';
				crum_social_networks(true);
			echo '</div></div>';
		}
		
        echo $after_widget;
    }


    function update($new, $old){
        $new = wp_parse_args($new, array(
            'title' => '',
            'text' => '',
            'enable_soc_icons' => '',
        ));
        return $new;
    }

    function form( $instance ) {
        $instance = wp_parse_args($instance, array(
            'title' => '',
            'text' => '',
            'enable_soc_icons' => '',
        ));
		$checked = false;
		if($instance['enable_soc_icons']) {
			$checked = true;
		}
?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'dfd'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>"/>
    </p>
    <p>
        <textarea class="widefat" rows="20" cols="40" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id('enable_soc_icons')); ?>"><?php _e('Enable social icons:', 'dfd'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('enable_soc_icons')); ?>" name="<?php echo esc_attr($this->get_field_name('enable_soc_icons')); ?>" type="checkbox" <?php if($checked) echo 'checked="checked"'; ?> />
    </p>

    <?php
    }
}


