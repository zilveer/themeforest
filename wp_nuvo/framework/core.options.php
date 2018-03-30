<?php
/*
 * Author : Fox
 * Name : Options control
 * Ver : 1.0.0
 */
global $core_options;

$core_options = new CsCoreControl();

function cs_options($params = array())
{
    global $pagenow, $core_options;

    wp_enqueue_style('taxonomys');
    wp_enqueue_style('posttype');
    
    $tem_div = array('div','span','div');
    $tem_table = array('tr','th','td');
    /* Find Type */
    if (is_admin() && !empty($params['id']) && isset($core_options)) {
        /* Taxonomys */
        if($pagenow == 'edit-tags.php' || $pagenow == 'term.php'){

            global $tag;

            $t_id = $tag->term_id;
            $cat_meta = get_option("category_$t_id");
            // get value
            if(!empty($cat_meta[$params['id']])){
                $params['value'] = $cat_meta[$params['id']];
            }
            // render id
            $params['id'] = "Cat_meta[".$params['id']."]";

            $core_options->taxonomy($params);
        }
        /* Post or Page */
        elseif ($pagenow=='post-new.php' || $pagenow=='post.php'){
            global $post;
            // render id
            $params['id'] = "cs_".$params['id'];
            // get value
            if(get_post_meta($post->ID, $params['id'], true)){
                $params['value'] = get_post_meta($post->ID, $params['id'], true);
            }

            $core_options->metabox($params);
        }
        /* Widgets */
        elseif ($pagenow == 'widgets.php'){
            $core_options->template($params);
        }
        /* Template */
        elseif ($pagenow == 'themes.php'){
            $core_options->widget($params);
        }
    } else {
        esc_html_e('Error', 'wp_nuvo');
    }
    wp_enqueue_script('taxonomys');
}

class CsCoreControl
{

    function __construct()
    {
        add_action('admin_enqueue_scripts', array(
            $this,
            'Scripts'
        ));
        add_action('save_post', array($this, 'save_meta_boxes'));
    }
    /* script */
    function Scripts()
    {
        wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.1.0');
        wp_register_style('font-ionicons', get_template_directory_uri() . '/css/ionicons.min.css', array(), '1.5.2');
        wp_register_style('colpick', get_template_directory_uri() . '/framework/assets/css/colpick.css');
        wp_register_style('taxonomys', get_template_directory_uri() . '/framework/assets/css/taxonomys.css');
        wp_register_style('posttype', get_template_directory_uri().'/framework/assets/css/posttype.css');
        
        wp_register_script('colpick', get_template_directory_uri() . '/framework/assets/js/colpick.js');
        wp_register_script('media-selector', get_template_directory_uri() . '/framework/assets/js/media.selector.js');
        wp_register_script('icons-class', get_template_directory_uri() . '/framework/assets/js/icons.class.js');
        wp_register_script('taxonomys', get_template_directory_uri() . '/framework/assets/js/taxonomys.js');
    }
    private function renderType($params){
        if(isset($params['type'])){
            switch ($params['type']){
                case 'text':
                    return $this->text($params);
                case 'color':
                    return $this->color($params);
                case 'icon':
                    return $this->icon($params);
                case 'image':
                    $params['field'] = 'single';
                    return $this->images($params);
                case 'images':
                    $params['field'] = 'multiple';
                    return $this->images($params);
                case 'textarea':
                    return $this->textarea($params);
                case 'select':
                    return $this->select($params);
                case 'multiple':
                    return $this->multiple($params);
                case 'editor':
                    return $this->editor($params);
            }
        }
    }
    private function text($params)
    {
        ob_start();
        ?>
	    <input type="text"
	    name="<?php echo esc_attr($params['id']); ?>"
		id="<?php echo esc_attr($params['id']); ?>"
		value="<?php if(isset($params['value'])){ echo esc_attr($params['value']);} ?>"
		placeholder="<?php if(isset($params['placeholder'])){ echo esc_attr($params['placeholder']);} ?>" />
        <?php
        return ob_get_clean();
    }
    private function textarea($params)
    {
        ob_start();
        ?>
	    <textarea<?php if(isset($params['rows'])){ echo ' rows="'+$params['rows']+'"'; }if(isset($params['cols'])){ echo ' cols="'+$params['cols']+'"'; } ?>
	    name="<?php echo esc_attr($params['id']); ?>"
		id="<?php echo esc_attr($params['id']); ?>"
		placeholder="<?php if(isset($params['placeholder'])){ echo esc_attr($params['placeholder']);} ?>"><?php if(isset($params['value'])){ echo esc_attr($params['value']);} ?></textarea>
        <?php
        return ob_get_clean();
    }
    private function select($params)
    {
        ob_start();
        ?>
        <select name="<?php echo esc_attr($params['id']); ?>" id="<?php echo esc_attr($params['id']); ?>">
        	<?php foreach ($params['options'] as $key => $option): ?>
        		<option value="<?php echo $key; ?>" <?php if(isset($params['value']) && ($params['value'] == $key)){ echo "selected"; } ?>><?php echo esc_attr($option); ?></option>
        	<?php endforeach; ?>
        </select>
	    <?php
        return ob_get_clean();
    }
    private function multiple($params){
        ob_start();
        $selected = array();
        if(!empty($params['value'])){
            $selected = explode(',', $params['value']);
        }
        ?>
        <div class="multiple-field">
        <select multiple="multiple">
        	<?php foreach ($params['options'] as $key => $option): ?>
        		<option value="<?php echo $key; ?>" <?php if(in_array($key, $selected)){ echo 'selected="selected"'; } ?>><?php echo esc_attr($option); ?></option>
        	<?php endforeach; ?>
        </select>
    	<input type="hidden" name="<?php echo esc_attr($params['id']); ?>" id="<?php echo esc_attr($params['id']); ?>" value="<?php echo implode(",", $selected); ?>"/>
	    </div>
        <?php
        return ob_get_clean();
    }
    private function color($params){
        wp_enqueue_style('colpick');
        wp_enqueue_script('colpick');
        ob_start();
        ?>
        <div class="color-field">
            <input type="text"
            name="<?php echo esc_attr($params['id']); ?>"
            id="<?php echo esc_attr($params['id']); ?>"
            style="width: 160px; border-color: <?php echo esc_attr($params['value']); ?>;"
            value="<?php if(isset($params['value'])){ echo esc_attr($params['value']);} ?>"
            placeholder="<?php if(isset($params['placeholder'])){ echo esc_attr($params['placeholder']);} ?>" />
        </div>
        <?php
        return ob_get_clean();
    }
    private function icon($params){
        add_thickbox();
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('font-ionicons');
        wp_enqueue_script('icons-class');
        ob_start();
        ?>
        <div class="icon-field">
            <input type="text" style="width: 170px;" class="thickbox" alt="#TB_inline?amp;inlineId=field_icon" title=""
            name="<?php echo esc_attr($params['id']); ?>"
            id="<?php echo esc_attr($params['id']); ?>"
            value="<?php if(isset($params['value'])){ echo esc_attr($params['value']);} ?>"
            placeholder="<?php if(isset($params['placeholder'])){ echo esc_attr($params['placeholder']);} ?>" />
            <i class="<?php echo esc_attr($params['value']); ?>"></i>
        </div>
        <?php
        return ob_get_clean();
    }
    private function images($params){
        //render type ( single, multiple )
        wp_enqueue_media();
        wp_enqueue_script('media-selector');
        $selected = array();
        if(!empty($params['value'])){
            $selected = explode(',', $params['value']);
        }
        ob_start();
        ?>
        <div class="images-field">
            <ul data-type="<?php echo esc_attr($params['field']); ?>">
            <?php
            foreach ($selected as $value):
                $attachment_image = wp_get_attachment_image_src($value,'thumbnail');
                if (count($attachment_image) > 0):?>
                <li class="items" data-id="<?php echo $value; ?>" style="background-image:url(<?php echo esc_url($attachment_image[0]);?>);background-side:cover;">
                    <i class="edit dashicons dashicons-plus-alt" title="<?php esc_html_e('Replace Image', 'wp_nuvo'); ?>"></i>
                    <i class="remove dashicons dashicons-dismiss" title="<?php esc_html_e('Remove Image', 'wp_nuvo'); ?>"></i>
                </li>
            <?php endif; endforeach; ?>
            <?php if($params['field'] != 'single'): ?>
                <li class="items" data-id=""><i class="add dashicons dashicons-plus-alt" title="<?php esc_html_e('Add Image', 'wp_nuvo'); ?>"></i></li>
            <?php elseif(count($selected) == 0): ?>
                <li class="items" data-id=""><i class="add dashicons dashicons-plus-alt" title="<?php esc_html_e('Add Image', 'wp_nuvo'); ?>"></i></li>
            <?php endif; ?>
            </ul>
            <input type="hidden" name="<?php echo esc_attr($params['id']); ?>" id="<?php echo esc_attr($params['id']); ?>" value="<?php echo  implode(",", $selected); ?>"/>
        </div>
        <?php
        return ob_get_clean();
    }
    private function editor($params){
        $content = '';
        if(isset($params['value'])){
            $content = $params['value'];
        }
        ob_start();
        ?>
        <div class="editor-field">
           <?php wp_editor(urldecode($content), $params['id'], array()); ?>
        </div>
        <?php
        return ob_get_clean();
    }
    /* Template */
    public function metabox($params){
        ob_start();
        ?>
		<div id="cs_metabox_field_<?php echo $params['id']; ?>" class="cs_metabox_field">
		    <label class="field-title" for="<?php echo $params['id']; ?>"><?php if(isset($params['label'])){ echo $params['label'];} ?></label>
		      <div class="field<?php if(isset($params['class'])){ echo ' class="'.$params['class'].'"'; } ?>">
		          <?php echo $this->renderType($params); ?>
		      </div>
		      <p class="field-desc"><?php if(isset($params['desc'])){ echo esc_attr($params['desc']);} ?></p>
		</div>
        <?php
        echo ob_get_clean();
    }
    public function taxonomy($params){
        ob_start();
        ?>
        <tr class="form-field">
        	<th scope="row" valign="top">
        	   <label class="field-title" for="<?php echo $params['id']; ?>"><?php if(isset($params['label'])){ echo $params['label'];} ?></label>
        	</th>
        	<td<?php if(isset($params['class'])){ echo ' class="'.$params['class'].'"'; } ?>>
               <?php echo $this->renderType($params); ?>
               <br />
        	   <span class="description"><?php if(isset($params['desc'])){ echo esc_attr($params['desc']);} ?></span>
        	</td>
        </tr>
        <?php
        echo ob_get_clean();
    }
    public function template($params){

    }
    public function widget($params){

    }
    /* Save Meta */
    public function save_meta_boxes($post_id)
	{
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		foreach($_POST as $key => $value) {
			if(strstr($key, 'cs_')) {
				update_post_meta($post_id, $key, $value);
			}
		}
	}
}