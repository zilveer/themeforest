<?php
/**
 * Custom category field
 * @package van
 */


//add extra fields to category edit form hook
add_action ( 'edit_category_form_fields', 'extra_category_fields');

//add extra fields to category edit form callback function

function extra_category_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id");
?>

<tr class="form-field">
<th scope="row" valign="top"><label for="Cat_meta[headtitle]"><?php _e('Special head title','SimpleKey'); ?></label></th>
<td>
<input type="text" name="Cat_meta[headtitle]" id="Cat_meta[headtitle]" value="<?php echo $cat_meta['headtitle'] ? $cat_meta['headtitle'] : ''; ?>" />
</td>
</tr>
<?php
}
?>
<?php
// save extra category extra fields hook
add_action ( 'edited_category', 'save_extra_category_fileds');
   // save extra category extra fields callback function
function save_extra_category_fileds( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
               $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }
        }

        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}
?>