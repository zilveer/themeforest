<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>

<div id="qode_shortcode_form_wrapper">
    <form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
        <div class="input">
            <label>Number Of Steps</label>
            <select name="number_of_steps" id="number_of_steps">
                <option value="">Default</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div class="input">
            <label>Background Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input type="text" name="background_color" id="background_color" value="" size="10" maxlength="10" />
        </div>
        <div class="input">
            <label>Number Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input type="text" name="number_color" id="number_color" value="" size="10" maxlength="10" />
        </div>
        <div class="input">
            <label>Title Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input type="text" name="title_color" id="title_color" value="" size="10" maxlength="10" />
        </div>
        <div class="input">
            <label>Title Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input type="text" name="circle_wrapper_border_color" id="circle_wrapper_border_color" value="" size="10" maxlength="10" />
        </div>

        <!-- First step input fieds -->
        <div class="input">
            <label>Title 1</label>
            <input name="title_1" id="title_1" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Number 1</label>
            <input name="step_number_1" id="step_number_1" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Description 1</label>
            <textarea name="step_description_1" id="step_description_1" value="" maxlength="12" size="12" ></textarea>
        </div>
        <div class="input">
            <label>Step Link 1</label>
            <input name="step_link_1" id="step_link_1" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Link Target 1</label>
            <select name="step_link_target_1" id="step_link_target_1">
                <option value="_blank">Blank</option>
                <option value="_self">Self</option>
                <option value="_parent">Parent</option>
                <option value="_top">Top</option>
            </select>
        </div>

        <!-- Second step input fieds -->
        <div class="input">
            <label>Title 2</label>
            <input name="title_2" id="title_2" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Number 2</label>
            <input name="step_number_2" id="step_number_2" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Description 2</label>
            <textarea name="step_description_2" id="step_description_2" value="" maxlength="12" size="12" ></textarea>
        </div>
        <div class="input">
            <label>Step Link 2</label>
            <input name="step_link_2" id="step_link_2" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Link Target 2</label>
            <select name="step_link_target_2" id="step_link_target_2">
                <option value="_blank">Blank</option>
                <option value="_self">Self</option>
                <option value="_parent">Parent</option>
                <option value="_top">Top</option>
            </select>
        </div>

        <!-- Third step input fieds -->
        <div class="input">
            <label>Title 3</label>
            <input name="title_3" id="title_3" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Number 3</label>
            <input name="step_number_3" id="step_number_3" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Description 3</label>
            <textarea name="step_description_3" id="step_description_3" value="" maxlength="12" size="12" ></textarea>
        </div>
        <div class="input">
            <label>Step Link 3</label>
            <input name="step_link_3" id="step_link_3" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Link Target 3</label>
            <select name="step_link_target_3" id="step_link_target_3">
                <option value="_blank">Blank</option>
                <option value="_self">Self</option>
                <option value="_parent">Parent</option>
                <option value="_top">Top</option>
            </select>
        </div>

        <!-- Fourth step input fieds -->
        <div class="input">
            <label>Title 4</label>
            <input name="title_4" id="title_4" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Number 4</label>
            <input name="step_number_4" id="step_number_4" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Description 4</label>
            <textarea name="step_description_4" id="step_description_4" value="" maxlength="12" size="12" ></textarea>
        </div>
        <div class="input">
            <label>Step Link 4</label>
            <input name="step_link_4" id="step_link_4" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Step Link Target 4</label>
            <select name="step_link_target_4" id="step_link_target_4">
                <option value="_self">Self</option>
                <option value="_blank">Blank</option>
                <option value="_parent">Parent</option>
                <option value="_top">Top</option>
            </select>
        </div>

        <div class="input">
            <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
        </div>
    </form>
</div>