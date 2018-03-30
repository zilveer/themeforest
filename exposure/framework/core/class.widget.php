<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Widget class.
 *
 * This class is entitled to manage a widget.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_Widget') ) {
	class THB_Widget extends WP_Widget {

		/**
		 * The widget class.
		 *
		 * @var array
		 */
		protected $_class = '';

		/**
		 * The widget data.
		 *
		 * @var array
		 */
		protected $_data = array();

		/**
		 * The widget description.
		 *
		 * @var string
		 */
		private $_description = '';

		/**
		 * The widget base shortcode.
		 *
		 * @var string
		 **/
		protected $_shortcode = '';

		/**
		 * The condition under which the widget must be displayed.
		 *
		 * @var boolean
		 **/
		protected $_showCondition = '';

		/**
		 * The optional title link.
		 *
		 * @var string
		 */
		protected $_titleLink = '';

		/**
		 * Constructor
		 *
		 * @param string $name The widget name.
		 * @param string $label The widget label.
		 * @param string $description The widget description.
		 * @param string $shortcode The widget shortcode.
		 */
		public function __construct( $name, $label, $description, $shortcode )
		{
			parent::__construct(
				$name,
				$label,
				array(
					'description' => $description
				)
			);

			$thb_theme = thb_theme();
			$this->_shortcode = $thb_theme->getShortcode($shortcode);
			$this->_description = $description;
		}

		/**
		 * Compose the attributes string of the widget's shortcode.
		 *
		 * @param WP_Widget $instance The widget instance.
		 * @return string
		 */
		private function composeShortcodeAttributes( $instance )
		{
			$atts = '';
			$joined_atts = $instance + $this->_shortcode->getWidgetAttributes();

			foreach( $joined_atts as $k => $v ) {
				$atts .= ' ' . $k . '="' . $v . '"';
			}

			return $atts;
		}

		/**
		 * Extract the widget parameters.
		 *
		 * @param WP_Widget $instance The widget instance.
		 * @return array
		 */
		protected function extractParameters( $instance )
		{
			$instance = wp_parse_args((array) $instance, $this->_shortcode->getWidgetAttributes());

			foreach( $instance as $k => $v ) {
				$instance[$k] = $v; // strip_tags($v);
			}

			return $instance;
		}

		/**
		 * The widget's editing form
		 *
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 * @see WP_Widget::form
		 **/
		public function form( $instance )
		{
			$this->widgetForm( $this->extractParameters($instance) );
		}

		/**
		 * Get the widget shortcode.
		 *
		 * @return THB_Shortcode
		 */
		public function getShortcode()
		{
			return $this->_shortcode;
		}

		/**
		 * Get the widget description.
		 *
		 * @return string
		 */
		public function getDescription()
		{
			return $this->_description;
		}

		/**
		 * The extended widget editing form.
		 *
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 */
		public function widgetForm( $instance ) {}

		/**
		 * Widget form number input field.
		 *
		 * @param string $name  The field name.
		 * @param string $label The field label.
		 * @param string $note The field note.
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 */
		public function formInputNumber( $name, $label, $note='', $instance )
		{
			$value = isset($instance[$name]) ? $instance[$name] : '';
			?>
			<p>
				<label for="<?php echo $this->get_field_id($name); ?>"><?php echo $label; ?></label>
				<input type="number" min="-1" step="1" class="widefat" id="<?php echo $this->get_field_id($name); ?>" name="<?php echo $this->get_field_name($name); ?>" value="<?php echo esc_attr($value); ?>" />
				<?php if( !empty($note) ) : ?>
					<small><?php echo $note; ?></small>
				<?php endif; ?>
			</p>
			<?php
		}

		/**
		 * Widget form select input field.
		 *
		 * @param string $name  The field name.
		 * @param string $label The field label.
		 * @param array $options The field options.
		 * @param string $note The field note.
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 */
		public function formInputSelect( $name, $label, $options=array(), $note='', $instance )
		{
			$value = isset($instance[$name]) ? $instance[$name] : '';
			?>
			<p>
				<label for="<?php echo $this->get_field_id($name); ?>"><?php echo $label; ?></label>
				<select id="<?php echo $this->get_field_id($name); ?>" name="<?php echo $this->get_field_name($name); ?>" class="widefat">
					<?php foreach( $options as $k => $v ) : ?>
						<?php
							$selected = $value == $k ? 'selected' : '';
						?>
						<option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
					<?php endforeach; ?>
				</select>
				<?php if( !empty($note) ) : ?>
					<small><?php echo $note; ?></small>
				<?php endif; ?>
			</p>
			<?php
		}

		/**
		 * Widget form taxonomy select input field.
		 *
		 * @param string $name  The field name.
		 * @param string $label The field label.
		 * @param string $post_type The post type.
		 * @param string $note The field note.
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 */
		public function formInputSelectPosts( $name, $label, $post_type, $note='', $instance )
		{
			$items = get_posts(array(
				'paged' => 1,
				'posts_per_page' => -1,
				'post_type' => $post_type
			));
			$options = array();

			if( count($items) > 0 ) {
				foreach( $items as $item ) {
					$options[$item->ID] = $item->post_title;
				}
			}

			$this->formInputSelect($name, $label, $options, $note, $instance);
		}

		/**
		 * Widget form taxonomy select input field.
		 *
		 * @param string $name  The field name.
		 * @param string $label The field label.
		 * @param string $taxonomy The taxonomy slug.
		 * @param string $note The field note.
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 */
		public function formInputSelectTaxonomy( $name, $label, $taxonomy, $note='', $instance )
		{
			$terms = get_terms($taxonomy);
			$options = array();

			if( count($terms) > 0 ) {
				foreach( $terms as $term ) {
					$options[$term->term_id] = $term->name;
				}
			}

			$this->formInputSelect($name, $label, $options, $note, $instance);
		}

		/**
		 * Widget form YES/NO select input field.
		 *
		 * @param string $name  The field name.
		 * @param string $label The field label.
		 * @param string $note The field note.
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 */
		public function formInputSelectYesNo( $name, $label, $note='', $instance )
		{
			$options = array(
				'0' => __('No', 'thb_text_domain'),
				'1' => __('Yes', 'thb_text_domain')
			);

			$this->formInputSelect($name, $label, $options, $note, $instance);
		}

		/**
		 * Widget form text input field.
		 *
		 * @param string $name The field name.
		 * @param string $label The field label.
		 * @param string $note The field note.
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 */
		public function formInputText( $name, $label, $note='', $instance )
		{
			$value = isset($instance[$name]) ? $instance[$name] : '';
			?>
			<p>
				<label for="<?php echo $this->get_field_id($name); ?>"><?php echo $label; ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id($name); ?>" name="<?php echo $this->get_field_name($name); ?>" type="text" value="<?php echo esc_attr($value); ?>" />
				<?php if( !empty($note) ) : ?>
					<small><?php echo $note; ?></small>
				<?php endif; ?>
			</p>
			<?php
		}

		/**
		 * Widget form textarea input field.
		 *
		 * @param string $name  The field name.
		 * @param string $label The field label.
		 * @param string $note The field note.
		 * @param WP_Widget $instance The widget instance.
		 * @return void
		 */
		public function formInputTextarea( $name, $label, $note='', $instance )
		{
			$value = isset($instance[$name]) ? $instance[$name] : '';
			?>
			<p>
				<label for="<?php echo $this->get_field_id($name); ?>"><?php echo $label; ?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id($name); ?>" name="<?php echo $this->get_field_name($name); ?>"><?php echo esc_attr($value); ?></textarea>
				<?php if( !empty($note) ) : ?>
					<small><?php echo $note; ?></small>
				<?php endif; ?>
			</p>
			<?php
		}

		/**
		 * Set a link for the widget title.
		 *
		 * @param string $link The link URL.
		 * @return void
		 */
		public function setTitleLink( $link )
		{
			$this->_titleLink = $link;
		}

		/**
		 * The widget update function
		 *
		 * @param WP_Widget $new_instance The new instance.
		 * @param WP_Widget $old_instance The old instance.
		 * @return void
		 * @see WP_Widget::update
		 **/
		public function update( $new_instance, $old_instance )
		{
			return $new_instance;
		}

		/**
		 * Displaying the widget
		 *
		 * @return void
		 * @see WP_Widget::widget
		 **/
		public function widget($args, $instance)
		{
			if( $this->_showCondition != '' && call_user_func($this->_showCondition) == false ) {
				return;
			}

			extract($args);

			// Widget class
			if( $this->_class != '' ) {
				$before_widget = str_replace("class=\"widget", "class=\"widget " . $this->_class, $before_widget);
			}

			// Data
			$title = apply_filters('widget_title', $instance['title']);

			// Let's display the widget
			echo $before_widget;

				if( !empty($title) ) {
					echo $before_title;
						if( !empty($this->_titleLink) ) {
							echo '<a href="' . $this->_titleLink . '">';
								echo $title;
							echo '</a>';
						}
						else {
							echo $title;
						}
					echo $after_title;
				}

				$shortcode = '[' . $this->_shortcode->getName() . ' ' . $this->composeShortcodeAttributes($instance) . ' title="" caller="widget"]';
				echo thb_do_shortcode($shortcode);

			echo $after_widget;
		}

	}
}