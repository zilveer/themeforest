<?php

/**
 * frameworkWidget
 *
 * This class extends default WP_Widget class and add an automaticall widget settings form
 * !!! extended class has to have $options variable
 *
 * @author freshface
 */
class Jaw_Default_Widget extends WP_Widget {

    /**
     * this function is updating values, called by wordpress
     */
    function update($new_instance, $old_instance) {
        //save the widget
        foreach ($this->options as $one_option) {
            $key = $one_option['id'];
            if ($one_option['type'] == 'text') {
                $instance[$key] = strip_tags($new_instance[$key]);
            } else if ($one_option['type'] == 'checkbox') {
                $instance[$key] = 0;
                if (!empty($new_instance[$key]))
                    $instance[$key] = 1;
            }
            else if ($one_option['type'] == 'select') {

                $instance[$key] = $new_instance[$key];
            }
        }
        return $instance;
    }

    /**
     * this function is printing wordpress widget forms, called by wordpress
     */
    function form($instance) {

        foreach ($this->options as $one_option) {
            if ($one_option['type'] == 'text') {
                $value = $one_option['default'];
                if (isset($instance[$one_option['id']]))
                    $value = $instance[$one_option['id']];
                echo '<p>';
                echo '<label for="' . $this->get_field_id($one_option['id']) . '">' . $one_option['description'] . '</label><br>';
                echo '<input id="' . $this->get_field_id($one_option['id']) . '" name="' . $this->get_field_name($one_option['id']) . '" type="text" value="' . $value . '">';
                echo '</p>';
            }

            else if ($one_option['type'] == 'checkbox') {
                $value = '';
                if ((!isset($instance[$one_option['id']]) && $one_option['default'] == 1 ) || $instance[$one_option['id']] == 1)
                    $value = 'checked="checked"';
                echo '<p>';
                echo '<label for="' . $this->get_field_id($one_option['id']) . '">' . $one_option['description'] . '</label>';
                echo '<input id="' . $this->get_field_id($one_option['id']) . '" name="' . $this->get_field_name($one_option['id']) . '" type="checkbox" ' . $value . '>';
                echo '</p>';
            }

            else if ($one_option['type'] == 'select') {
                $value = $one_option['default'];
                if (isset($instance[$one_option['id']]))
                    $value = $instance[$one_option['id']];

                echo '<p>';
                echo '<label for="' . $this->get_field_id($one_option['id']) . '">' . $one_option['description'] . '</label><br>';
                echo '<select id="' . $this->get_field_id($one_option['id']) . '" name="' . $this->get_field_name($one_option['id']) . '">';
                foreach ($one_option['values'] as $one_val) {
                    $selected = null;
                    if ($value == $one_val['value'])
                        $selected = 'selected="selected"';

                    $val = 'value="' . $one_val['value'] . '"';

                    echo "<option {$val} {$selected}>";
                    echo $one_val['name'];
                    echo "</option>";
                }

                echo '</select>';
                echo '</p>';
            }
        }
    }

    public function getOptions() {
        return $this->options;
    }

}