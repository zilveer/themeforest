<?php

/**
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo check permition for dynamic file 
 * @since FN
 */

class fwWritepanelsDataPrinter {

    private $data = null;
    private $post_id = null;

    public function setData($data, $post_id) {
        $this->data = $data;
        $this->post_id = $post_id;
    }

    private function _printHiddenIndicator() {
        echo '<input type="hidden" name="fw_metabox_indicator" value="true">';
    }

    public function printData() {
        $this->_printHiddenIndicator();
        $data = $this->data;

        foreach ($data as $one_option) {
            $function_name = 'printType' . $one_option['type'];
            call_user_func(array($this, $function_name), array($one_option));
        }
    }

    public function printTypeTemplateStart($one_option) {
        $one_option = $one_option[0];
        echo '<div class="template_specific_holder template_' . $one_option['id'] . '">';
    }

    public function printTypeTemplateEnd($one_option) {
        echo '</div>';
    }

    private function printOneRating($one_option, $id) {
        echo '<div class="one_post_rating">';
        echo '<input type="text" name="" value="kokot">';
        echo '<select id="type">';

        echo '</select>';
        echo '<input type="text" id="score">';
        echo '<input type="text" id="voted">';
        echo '<div class="remove">';
        echo 'X';
        echo '</div>';
        echo '</div>';
    }

    private function _getMultiId($name, $id1, $id2 = null) {
        ( $id2 != null ) ? $newName = $name . '[' . $id1 . ']' . '[' . $id2 . ']' : $newName = $name . '[' . $id1 . ']';
        return $newName;
    }

    private function _printRating($id, $rating, $one_option) {
        if (is_object($rating))
            $rating = get_object_vars($rating);
        if ($rating == null) {
            $rating = array();
            $rating['name'] = '';
            $rating['type'] = '';
            $rating['score'] = '';
            $rating['voted'] = '';
        }
                
        $check = '';
        $class_user = '';
        
        if ($rating['useredit'] == '1') {
            $class_user = " user_rating";
        }
        echo '<div class="one_post_rating'.$class_user.'">';
        echo '<div style="display:none;" class="actual_option_id">' . $one_option['id'] . '</div>';
        echo '<div style="display:none;" class="actual_id">' . $id . '</div>';
        echo '<input placeholder="Rating name" type="text" value="' . $rating['name'] . '" data-name="name" name="' . $this->_getMultiId($one_option['id'], $id, 'name') . '" id="' . $this->_getMultiId($one_option['id'], $id, 'name') . '" >';

        echo '<input class="own_rating" placeholder="Own rating" class="jw-rating-admin-score" type="text" value="' . $rating['score'] . '" data-name="score" name="' . $this->_getMultiId($one_option['id'], $id, 'score') . '" id="' . $this->_getMultiId($one_option['id'], $id, 'score') . '" >';
        echo '<input class="voted" placeholder="Count voted" type="text" value="' . $rating['voted'] . '" data-name="voted" name="' . $this->_getMultiId($one_option['id'], $id, 'voted') . '" id="' . $this->_getMultiId($one_option['id'], $id, 'voted') . '" >';
        
        if ($rating['useredit'] == '1') {
            //$check = 'checked="checked"';
            echo "User Ratings";
            echo '<input '.$check.' type="hidden" class="check_user_edit" value="1" data-name="useredit" name="' . $this->_getMultiId($one_option['id'], $id, 'useredit') . '" id="' . $this->_getMultiId($one_option['id'], $id, 'useredit') . '" >';
        }
        /*
        echo '<input '.$check.' type="checkbox" class="check_user_edit" value="1" data-name="useredit" name="' . $this->_getMultiId($one_option['id'], $id, 'useredit') . '" id="' . $this->_getMultiId($one_option['id'], $id, 'useredit') . '" >User editable';
        */
        echo '<span title="Delete" class="remove"></span>';
        echo '</div>';
    }

    public function printTypeRating($one_option) {
        $one_option = $one_option[0];
        $rm = ratingManager::getInstance();
        //$ratings = get_post_meta( $this->post_id, $one_option['id']);
        $ratings = $rm->getRatings($this->post_id);
        ?>
        <div class="post_settings_item rating_setting">
            <h4 class="post_settings_name"><?php echo $one_option['title']; ?></h4>
            <div class="post_settings_description"><?php echo $one_option['description']; ?></div>
            <div class="clear"> </div>
            <?php
            if (empty($ratings)) {
                $this->_printRating(0, null, $one_option);
            } else {
                foreach ($ratings as $id => $rating) {
                    $this->_printRating($id, $rating, $one_option);
                }
            }
            ?>



            <div class="button tagadd add_new_rating" style="width:80px;">
                Add

            </div>			


        </div>
        <?php
    }

    public function printTypeCheck($one_option) {
        $one_option = $one_option[0];
        $checked = 'checked="checked"';

        $value = get_post_meta($this->post_id, $one_option['id'], true);
        if ($value === '')
            $value = $one_option['std'];

        if ($value != 1)
            $checked = '';
        ?>
        <div class="post_settings_item">

            <h4 class="post_settings_name"><?php echo $one_option['title']; ?></h4>
            <div class="post_settings_description"><?php echo $one_option['description']; ?></div>
            <div class="clear"> </div>
            <label for="<?php echo $one_option['id']; ?>">
                <input type="checkbox" name="<?php echo $one_option['id']; ?>" id="<?php echo $one_option['id']; ?>" <?php echo $checked; ?> class="checkbox"><?php echo $one_option['title']; ?>
            </label>
        </div>
        <?php
    }

    public function printTypeMultiText($one_option) {
        $one_option = $one_option[0];


        $values = get_post_meta($this->post_id, $one_option['id']);
        ?>
        <div class="post_settings_item">
            <h4 class="post_settings_name"><?php echo $one_option['title']; ?></h4>
            <div class="post_settings_description"><?php echo $one_option['description']; ?></div>
            <div class="clear"> </div>
            <?php
            $lastId = 0;
            if (!empty($values)) {
                foreach ($values as $id => $value) {
                    echo '<div class="input-holder">';
                    echo '<input data-id="' . $id . '" type="text" name="' . $one_option['id'] . '[' . $id . ']" id="' . $one_option['id'] . '" value="' . $value . '">';
                    echo '<div class="remove">Delete</div>';
                    echo '</div>';
                    $lastId = $id;
                }
            } else {
                $id = 0;
                $value = '';
                echo '<div class="input-holder">';
                echo '<input data-id="' . $id . '" type="text" name="' . $one_option['id'] . '[' . $id . ']" id="' . $one_option['id'] . '" value="' . $value . '">';
                echo '<div class="remove">Delete</div>';
                echo '</div>';
            }
            ?>
            <div class="button tagadd add_new_input" style="width:80px;">
                Add
                <div class="info_holder" style="display:none;">
                    <div class="option_name"><?php echo $one_option['id']; ?></div>
                </div>
            </div>
        </div>
        <?php
    }

    public function printTypeTextarea($one_option) {
        $one_option = $one_option[0];
        $value = get_post_meta($this->post_id, $one_option['id'], true);

        if ($value == '')
            $value = $one_option['std'];
        ?>
        <div class="post_settings_item">
            <h4 class="post_settings_name"><?php echo $one_option['title']; ?></h4>
            <div class="post_settings_description"><?php echo $one_option['description']; ?></div>
            <div class="clear"> </div>
            <textarea name="<?php echo $one_option['id']; ?>" id="<?php echo $one_option['id']; ?>"><?php echo $value; ?></textarea>
        </div>
        <?php
    }
    
    public function printTypeText($one_option) {
        $one_option = $one_option[0];
        $value = get_post_meta($this->post_id, $one_option['id'], true);

        if ($value == '')
            $value = $one_option['std'];
        ?>
        <div class="post_settings_item">
            <h4 class="post_settings_name"><?php echo $one_option['title']; ?></h4>
            <div class="post_settings_description"><?php echo $one_option['description']; ?></div>
            <div class="clear"> </div>
            <input type="text" name="<?php echo $one_option['id']; ?>" id="<?php echo $one_option['id']; ?>" value="<?php echo $value; ?>">
        </div>
        <?php
    }

    public function printTypeSelect($one_option) {

        $one_option = $one_option[0];

        $value = get_post_meta($this->post_id, $one_option['id'], true);

        if ($value == '')
            $value = $one_option['std'];
        ?>
        <div class="post_settings_item">
            <h4 class="post_settings_name"><?php echo $one_option['title']; ?></h4>
            <div class="post_settings_description"><?php echo $one_option['description']; ?></div>
            <div class="clear"> </div>
            <select name="<?php echo $one_option['id']; ?>" id="<?php echo $one_option['id']; ?>" value="<?php echo $value; ?>">
                <?php
                foreach ($one_option['values'] as $one_value) {
                    $selected = '';
                    if ($one_value['id'] == $value)
                        $selected = 'selected="selected"';
                    echo '<option ' . $selected . ' value="' . $one_value['id'] . '">' . $one_value['name'] . '</value>';
                }
                ?>
            </select>
        </div>
        <?php
    }

    public function printTypeSelectsidebar($one_option) {

        $one_option = $one_option[0];

        $value = get_post_meta($this->post_id, $one_option['id'], true);

        if ($value == '')
            $value = $one_option['std'];
        ?>
        <div class="post_settings_item select_sidebar">
            <h4 class="post_settings_name"><?php echo $one_option['title']; ?></h4>
            <div class="post_settings_description"><?php echo $one_option['description']; ?></div>
            <div class="clear"> </div>
            <select name="<?php echo $one_option['id']; ?>" id="<?php echo $one_option['id']; ?>" value="<?php echo $value; ?>">
                <?php
                foreach ($one_option['values'] as $one_value) {
                    $selected = '';
                    if ($one_value['id'] == $value)
                        $selected = 'selected="selected"';
                    echo '<option ' . $selected . ' value="' . $one_value['id'] . '">' . $one_value['name'] . '</value>';
                }
                ?>
            </select>
            <?php echo '<a href="' . get_template_directory_uri() . '/framework/backend/sidebars/view.php?sidebar_manager_lightbox=1&TB_iframe=1" media-upload-link="slide-1" class="thickbox btn_add button button_secondary">Add / Edit</a>'; ?>
        </div>
        <?php
    }
    
    

}