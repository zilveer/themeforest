
<?php 
	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/shcode.php */
	$box_type = array('default'=>'default','info' => 'info','warning' => 'warning','download' => 'download','error' => 'error','tick' => 'tick','search' => 'demo','comments' => 'comments');
	$box_sizes = array('medium','large');
?>
<div class="standard-generic-field generic-field-type">
    <div class="generic-label"><label for="box_type"><?php _e( 'Type' , 'cosmotheme' ); ?></label></div>
    <div class="generic-field generic-field-select">
        <select id="box_type" class="select_medium">
            <?php
                foreach ($box_type as $key => $type) {
                        
                    echo "<option value='$key'>".$type."</option>";
                }
            ?>
        </select>
    </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-size">
    <div class="generic-label"><label for="box_text_size"><?php _e( 'Size' , 'cosmotheme' ); ?></label></div>
    <div class="generic-field generic-field-select">
        <select id="box_text_size" class="select_medium">
            <?php
                foreach ($box_sizes as $box_size) {
                    echo "<option value='$box_size'>".$box_size."</option>";
                }
            ?>
        </select>
    </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-content">
	<div class="generic-label"><label for="box_content"><?php _e( 'Title' , 'cosmotheme' ); ?></label></div>
	<div class="generic-field generic-field-text"> <input type="text" id="box_title" class="box-text"> </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-content">
	<div class="generic-label"><label for="box_content"><?php _e( 'Content' , 'cosmotheme' ); ?></label></div>
	<div class="generic-field generic-field-text"> <textarea type="text" id="box_content" class="box-text"> </textarea></div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-content">
	<div class="generic-label"><label for="box_content"><?php _e( 'Right Title' , 'cosmotheme' ); ?></label></div>
	<div class="generic-field generic-field-text"> <input type="text" id="box_right_title" class="box-text"> </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-content">
	<div class="generic-label"><label for="box_content"><?php _e( 'Right Description' , 'cosmotheme' ); ?></label></div>
	<div class="generic-field generic-field-text"> <input type="text" id="box_right_description" class="box-text"> </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-content">
	<div class="generic-label"><label for="box_content"><?php _e( 'Box url' , 'cosmotheme' ); ?></label></div>
	<div class="generic-field generic-field-text"> <input type="text" id="box_url" class="box-text"> </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-preview">
    <div class="generic-label"></div>
    <div class="generic-field generic-field-preview">
        <p style="margin-left: 0px;margin-top: 18px;" class="cosmo-box default " id="box_sample"><span class="cosmo-ico"></span>Box content</p>
    </div>
    <div class="clear"></div>
</div>


<div class="standard-generic-field generic-field-button">
    <div class="generic-label"></div>
    <div class="generic-field generic-field-button">
        <a href="javascript:void(0);" onclick="resetBoxSettings();" class="button">Reset</a>
        <input type="button" onclick="insertBox()" id="insert_box_btn" value="Insert infobox" class="button-primary">
    </div>
    <div class="clear"></div>
</div>