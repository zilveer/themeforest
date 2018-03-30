<?php

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

// Don't duplicate me!
if ( ! class_exists('Redux_Options_group') ) {

	class Redux_Options_group extends Redux_Options
	{

		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */

		function __construct ( $field = array(), $value = '', $parent )
		{
			parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);

			$this->field  = $field;
			$this->value  = $value;
			$this->parent = $parent;
		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */

		function render ()
		{
			$options = $this->field['options'];

			if ( ! isset($options['fields']) || ! is_array($options['fields']) ) return;

			$x = 0;
			$groups = $this->value;
			$group_key  = $options['group']['title_key'];
			$group_name = $options['group']['name'];

			ksort($groups);

			echo '<div class="redux-group">';
			echo '<ul class="redux-groups-accordion">';

			foreach ( $groups as $g_id => $group )
			{

				if ( isset( $group[ $group_key ] ) && ! empty( $group[ $group_key ] ) )
					$group_title = $group[ $group_key ];
				else
					$group_title = __('New', Redux_TEXT_DOMAIN) . ' ' . $group_name;

				$g_int = filter_var($g_id, FILTER_SANITIZE_NUMBER_INT);

				# According content open
				echo '<li class="redux-groups-accordion-group">';
				echo '<h3 class="redux-groups-heading"><span class="redux-groups-title">' . $group_title . '</span></h3>';
				echo '<div class="redux-groups-body">';

				echo '<input type="hidden" class="group-sort" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $g_id . '][order_no]" id="' . $this->field['id'] . '-order_no_' . $x . '" value="' . $group['order_no'] . '" />';

				echo '<table style="margin-top: 0;" class="redux-groups-accordion redux-group form-table no-border">';

				foreach ( $options['fields'] as $field )
				{
					# We will enqueue all CSS/JS for sub fields if it wasn't enqueued
					$this->enqueue_dependencies( $field['type'] );

					echo '<tr><td>';

					if ( ! empty($field['title']) )
						echo '<h4>' . $field['title'] . '</h4>';

					if ( ! empty($field['sub_desc']) )
						echo '<span class="description">' . $field['sub_desc'] . '</span>';

					if ( isset( $group[ $field['id'] ] ) )
						$value = empty($group[ $field['id'] ]) ? '' : $group[ $field['id'] ];
					else
						$value = empty($this->parent->options[ $field['id'] ][$x]) ? '' : $this->parent->options[ $field['id'] ][$x];

					ob_start();
					$this->_field_input($field, $value);
					$content = ob_get_contents();

					# Adding sorting number to the name of each fields in group
					$name = $this->args['opt_name'] . '[' . $field['id'] . ']';
					$content = str_replace($name, $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $g_id . '][' . $field['id'] . ']', $content);

					# We should add $sort to id to fix problem with select field
					$content = str_replace(' id="' . $field['id'] . '-select"', ' id="' . $field['id'] . '-select-' . $x . '"', $content);

					# If this is the "Group Key", mark it as so to rewrite panel title
					if ( $field['id'] === $group_key )
						$content = str_replace(' id="', 'data-is-group-title id="', $content);

					$_field = apply_filters('redux-opts-support-group', $content, $field, $x);
					ob_end_clean();
					echo $_field;

					echo '</td></tr>';
				}
				echo '</table>';
				echo '<a href="javascript:void(0);" class="button deletion redux-groups-remove">' . __('Delete', Redux_TEXT_DOMAIN) . ' ' . $group_name . '</a>';
				echo '</div>';
				echo '</li>';

				$x++;
			}

			echo '</ul>';
			echo '<a href="javascript:void(0);" data-next-id="" class="button redux-groups-add button-primary" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $group_key . '][]">' . __('Add', Redux_TEXT_DOMAIN) . ' ' . $group_name . '</a><br/>';
			echo '</div>';

		}

		function _field_input ( $field, $v = "" )
		{
			if ( isset($field['callback']) && function_exists($field['callback']) )
			{
				$value = $this->get($field['id'], '');
				do_action('redux-opts-before-field-' . $this->args['opt_name'], $field, $value);
				call_user_func($field['callback'], $field, $value);
				do_action('redux-opts-after-field-' . $this->args['opt_name'], $field, $value);
				return;
			}

			if ( isset($field['type']) )
			{
				$field_class = 'Redux_Options_' . $field['type'];

				if ( ! class_exists($field_class) ) {
					$class_file = apply_filters('redux-opts-typeclass-load', $this->dir . 'fields/' . $field['type'] . '/field_' . $field['type'] . '.php', $field_class);
					if ( $class_file )
						require_once($class_file);
				}

				if ( class_exists($field_class) ) {
					if ( $v != "" ) {
						$value = $v;
					} else {
						$value = $this->get($field['id'], '');
					}

					do_action('redux-opts-before-field-' . $this->args['opt_name'], $field, $value);
					$render = new $field_class($field, $value, $this);
					$render->render();
					do_action('redux-opts-after-field-' . $this->args['opt_name'], $field, $value);
				}
			}
		}

		function support_multi ($content, $field, $sort)
		{
			//convert name
			$name = $this->parent->args['opt_name'] . '[' . $field['id'] . ']';
			$content = str_replace($name, $name . '[' . $sort . ']', $content);
			//we should add $sort to id to fix problem with select field
			$content = str_replace(' id="'.$field['id'].'-select"', ' id="'.$field['id'].'-select-'.$sort.'"', $content);
			return $content;
		}


		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */

		function enqueue ()
		{
			wp_enqueue_script(
				'redux-field-group-js',
				Redux_OPTIONS_URL . 'fields/group/group.js',
				array('jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'wp-color-picker'),
				time(),
				true
			);

			wp_enqueue_style(
				'redux-field-group-css',
				Redux_OPTIONS_URL . 'fields/group/group.css',
				time(),
				true
			);
		}

		function enqueue_dependencies ($field_type)
		{
			$field_class = 'Redux_Options_' . $field_type;

			if ( ! class_exists($field_class) )
			{
				$class_file = apply_filters('redux-opts-typeclass-load', Redux_OPTIONS_DIR . 'fields/' . $field_type . '/field_' . $field_type . '.php', $field_class);

				if ( $class_file )
					require_once( $class_file );
			}

			if ( class_exists($field_class) && method_exists($field_class, 'enqueue') ) {
				$enqueue = new $field_class('', '', $this);
				$enqueue->enqueue();
			}
		}

	}

}
