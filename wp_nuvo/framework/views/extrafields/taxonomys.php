<?php
/*
 * Author : Fox
 * Process : Back end -> Edit Taxonomy
 * Desc : Taxonomy Extra Fields Framework
 */
class CsheroFrameworkTaxonomyExtraFields
{

    function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'loadjs'));

        //add_action('restaurantmenu_category_add_form_fields', array($this, 'extra_restaurantmenu_category_fields'), 10, 2);
        add_action('restaurantmenu_category_edit_form_fields', array($this, 'extra_restaurantmenu_category_fields'));

        //add_action('category_add_form_fields', array($this, 'extra_category_fields'), 10, 2);
        add_action('category_edit_form_fields', array($this, 'extra_category_fields'));

        add_action('created_term', array($this, 'save_extra_category_fileds'), 10, 2);
        add_action('edit_term', array($this, 'save_extra_category_fileds'), 10, 2);
    }
    /* script */
    function loadjs(){
        global $pagenow;
        if(is_admin() && $pagenow == 'edit-tags.php'){
            wp_enqueue_style('font-ionicons', get_template_directory_uri().'/css/ionicons.min.css', array(), '1.5.2');
            wp_enqueue_style('colpick', get_template_directory_uri().'/framework/assets/css/colpick.css');
            wp_enqueue_style('taxonomys', get_template_directory_uri().'/framework/assets/css/taxonomys.css');
            wp_enqueue_media();
            wp_enqueue_script('colpick', get_template_directory_uri().'/framework/assets/js/colpick.js');
            wp_enqueue_script('media-selector', get_template_directory_uri().'/framework/assets/js/media.selector.js');
            wp_enqueue_script('icons-class', get_template_directory_uri().'/framework/assets/js/icons.class.js');
            wp_enqueue_script('taxonomys', get_template_directory_uri().'/framework/assets/js/taxonomys.js');
        }
    }

    /* template */
    public function extra_restaurantmenu_category_fields()
    {
        cs_options(array(
            'id'=>'img',
            'label'=>__('Category Image', 'wp_nuvo'),
            'type' => 'image',
            'desc'=> esc_html__('Select a background image for category', 'wp_nuvo')
        ));
        cs_options(array(
            'id'=>'bg_parallax',
            'label'=>__('Parallax Background Image', 'wp_nuvo'),
            'type'=>'select',
            'options'=>array(
                'yes'=>__('Yes', 'wp_nuvo'),
                'no'=>__('No', 'wp_nuvo')
            )
        ));
        cs_options(array(
            'id'=>'bg_parallax_speed',
            'label'=>'Parallax Speed',
            'type'=>'text',
            'desc'=>__('Default 0.6', 'wp_nuvo')
        ));
    }

    public function extra_category_fields()
    {
        $this->select(array(
            'id' => 'category_layout',
            'label' => esc_html__('Category Layout', 'wp_nuvo'),
            'default' => '',
            'value' => array(
                '' => esc_html__('Default', 'wp_nuvo'),
                'full-fixed' => esc_html__('Full Width', 'wp_nuvo'),
                'left-fixed' => esc_html__('Sidebar Left', 'wp_nuvo'),
                'right-fixed' => esc_html__('Sidebar Right', 'wp_nuvo')
            ),
            'desc' => esc_html__('Select Layout for current Category', 'wp_nuvo')
        ));
    }
    /* fields */
    public function text($options) {
        global $tag;
        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");
        if(!empty($cat_meta[$options['id']])){
            $options['value'] = $cat_meta[$options['id']];
        }
        ob_start();
        ?>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="<?php echo $options['id']; ?>"><?php if(isset($options['label'])){ echo $options['label'];} ?></label></th>
        	<td><input type="text" name="Cat_meta[<?php echo $options['id']; ?>]" id="Cat_meta[<?php echo $options['id']; ?>]" value="<?php echo esc_attr($options['value']); ?>" placeholder="<?php if(isset($options['placeholder'])){ echo esc_attr($options['placeholder']);} ?>"/>
        	<br />
        	<span class="description"><?php if(isset($options['desc'])){ echo esc_attr($options['desc']);} ?></span>
        	</td>
        </tr>
        <?php
        echo ob_get_clean();
    }
    public function color($options) {
        global $tag;

        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");
        if(!empty($cat_meta[$options['id']])){
            $options['value'] = $cat_meta[$options['id']];
        }

        ob_start();
        ?>
            <tr class="form-field">
            	<th scope="row" valign="top"><label for="<?php echo $options['id']; ?>"><?php if(isset($options['label'])){ echo $options['label'];} ?></label></th>
            	<td class="color-field">
            	<input type="text" name="Cat_meta[<?php echo $options['id']; ?>]" id="Cat_meta[<?php echo $options['id']; ?>]" style="border-color: <?php echo $options['value']; ?>;" value="<?php echo esc_attr($options['value']); ?>" placeholder="<?php if(isset($options['placeholder'])){ echo esc_attr($options['placeholder']);} ?>"/>
            	<span class="description"><?php if(isset($options['desc'])){ echo esc_attr($options['desc']);} ?></span>
            	</td>
            </tr>
            <?php
            echo ob_get_clean();
        }
    public function icon($options){
        add_thickbox();
        global $tag;
        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");
        if(!empty($cat_meta[$options['id']])){
            $options['value'] = $cat_meta[$options['id']];
        }
        ob_start();
        ?>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="<?php echo $options['id']; ?>"><?php if(isset($options['label'])){ echo $options['label'];} ?></label></th>
        	<td class="icon-field">
        	   <input type="text" style="width: 160px;" class="thickbox" alt="#TB_inline?height=400&amp;width=500&amp;inlineId=field_icon" title="" name="Cat_meta[<?php echo $options['id']; ?>]" id="Cat_meta[<?php echo $options['id']; ?>]" value="<?php echo esc_attr($options['value']); ?>" placeholder="<?php if(isset($options['placeholder'])){ echo esc_attr($options['placeholder']);} ?>"/>
        	   <i class="<?php echo esc_attr($options['value']); ?>"></i>
        	   <br /><span class="description"><?php if(isset($options['desc'])){ echo esc_attr($options['desc']);} ?></span>
        	</td>
        </tr>
        <?php
        echo ob_get_clean();
    }
    public function select($options)
    {
        global $tag;
        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");
        if(!empty($cat_meta[$options['id']])){
            $options['default'] = $cat_meta[$options['id']];
        }
        ob_start();
        ?>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="<?php echo $options['id']; ?>"><?php if(isset($options['label'])){ echo $options['label'];} ?></label></th>
        	<td><select name="Cat_meta[<?php echo $options['id']; ?>]" id="Cat_meta[<?php echo $options['id']; ?>]">
        	<?php foreach ($options['value'] as $key => $value): ?>
        		<option value="<?php echo $key; ?>" <?php if(isset($options['default']) && $options['default'] == $key){ echo "selected"; } ?>><?php echo esc_attr($value); ?></option>
        	<?php endforeach; ?>
        	</select> <br /> <span class="description"><?php if(isset($options['desc'])){ echo esc_attr($options['desc']);} ?></span>
        	</td>
        </tr>
        <?php
        echo ob_get_clean();
    }
    public function multiple($options) {
        global $tag;
        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");

        $selected = array();
        if(!empty($cat_meta[$options['id']])){
            $selected = explode(',', $cat_meta[$options['id']]);
        }

        ob_start();
        ?>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="<?php echo $options['id']; ?>"><?php if(isset($options['label'])){ echo $options['label'];} ?></label></th>
        	<td>
        	   <div class="multiple-field">
                    <select multiple="multiple">
                	<?php foreach ($options['value'] as $key => $value): ?>
                		<option value="<?php echo $key; ?>" <?php if(in_array($key, $selected)){ echo 'selected="selected"'; } ?>><?php echo esc_attr($value); ?></option>
                	<?php endforeach; ?>
                	</select>
            	    <input type="hidden" name="Cat_meta[<?php echo $options['id']; ?>]" id="Cat_meta[<?php echo $options['id']; ?>]" value="<?php echo  implode(",", $selected); ?>"/>
        	   </div>
        	   <span class="description"><?php if(isset($options['desc'])){ echo esc_attr($options['desc']);} ?></span>
        	</td>
        </tr>
        <?php
        echo ob_get_clean();
    }
    public function editor($options){
        global $tag;
        $content = '';
        if(isset($_POST[$options['id']])){
            $content = urlencode($_POST[$options['id']]);
        }
        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");
        if(!empty($cat_meta[$options['id']])){
            $content = $cat_meta[$options['id']];
        } else {
            $content = $options['value'];
        }

        ob_start();
        ?>
        <tr class="form-field">
        	<th scope="row" valign="top"><label for="<?php echo $options['id']; ?>"><?php if(isset($options['label'])){ echo $options['label'];} ?></label></th>
        	<td>
        	   <div class="editor-field">
                   <?php wp_editor(urldecode($content), 'Cat_meta['.$options['id'].']', array()); ?>
               </div>
        	   <span class="description"><?php if(isset($options['desc'])){ echo esc_attr($options['desc']);} ?></span>
        	</td>
        </tr>
        <?php
        echo ob_get_clean();

    }
    /* images
     * array()
     *
     * */
    public function images($options){
        global $tag;
        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");
        //render type ( single, multiple )
        if(!isset($options['type']) || $options['type'] == ''){
            $options['type'] = 'multiple';
        }
        //render values
        $selected = array();
        if(!empty($cat_meta[$options['id']])){
            $selected = explode(',', $cat_meta[$options['id']]);
        } else {
            if(isset($options['value'])){
                $selected = $options['value'];
            }
        }
        ob_start();
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo $options['id']; ?>"><?php if(isset($options['label'])){ echo $options['label'];} ?></label></th>
            <td class="images-field">
                <ul class="mousefollow-tooltip" style="margin: 0" data-type="<?php echo esc_attr($options['type']); ?>">
                <?php
                foreach ($selected as $value):
                    $attachment_image = wp_get_attachment_image_src($value,'thumbnail');
                    if (count($attachment_image) > 0):?>
                    <li class="items" data-id="<?php echo $value; ?>" style="background-image:url(<?php echo esc_url($attachment_image[0]);?>);background-side:cover;">
                        <i class="edit dashicons dashicons-plus-alt" title="<?php esc_html_e('Replace Image', 'wp_nuvo'); ?>"></i>
                        <i class="remove dashicons dashicons-dismiss" title="<?php esc_html_e('Remove Image', 'wp_nuvo'); ?>"></i>
                    </li>
                <?php endif; endforeach; ?>
                <?php if($options['type'] != 'single'): ?>
                    <li class="items" data-id=""><i class="add dashicons dashicons-plus-alt" title="<?php esc_html_e('Add Image', 'wp_nuvo'); ?>"></i></li>
                <?php elseif(count($selected) == 0): ?>
                    <li class="items" data-id=""><i class="add dashicons dashicons-plus-alt" title="<?php esc_html_e('Add Image', 'wp_nuvo'); ?>"></i></li>
                <?php endif; ?>
                </ul>
                <input type="hidden" name="Cat_meta[<?php echo $options['id']; ?>]" id="Cat_meta[<?php echo $options['id']; ?>]" value="<?php echo  implode(",", $selected); ?>"/>
                <span class="description"><?php if(isset($options['desc'])){ echo esc_attr($options['desc']);} ?></span>
            </td>
        </tr>
        <?php
        echo ob_get_clean();
    }

    /* save custom fileds */
    public function save_extra_category_fileds($term_id)
    {
        if (isset($_POST['Cat_meta'])) {
            $t_id = $term_id;
            $cat_meta = get_option("category_$t_id");
            $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key) {
                if (isset($_POST['Cat_meta'][$key])) {
                    $cat_meta[$key] = $_POST['Cat_meta'][$key];
                }
            }
            // save the option array
            update_option("category_$t_id", $cat_meta);
        }
    }
}
$cs_taxonomy_extrafields = new CsheroFrameworkTaxonomyExtraFields();