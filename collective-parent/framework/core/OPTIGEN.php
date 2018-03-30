<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Generate html for input types (only for backend)
 */
class TF_OPTIGEN extends TF_TFUSE
{
    public $_the_class_name = 'OPTIGEN';

    function __construct()
    {
        parent::__construct();
    }

    function _auto($opts)
    {
        if (isset($opts['type']))
            return $this->{$opts['type']}($opts);
        else
            die(__('Option type not set in OPTIGEN.', 'tfuse'));
    }

    /**
     * Simple input text
     */
    function text($opts)
    {
        if (!empty($opts['stepper'])) {
            wp_enqueue_script('jquery');

            if (!$this->include->type_is_registered('stepper_js')) {
                $this->include->register_type('stepper_js', TFUSE . '/static/javascript');
                $this->include->js('jquery.fs.stepper.min', 'stepper_js', 'tf_head', 10, '0.9.8');
                $this->include->js('tfuse_stepper', 'stepper_js', 'tf_head', 10, '1.1');
                $this->include->register_type('stepper_css', TFUSE . '/static/css');
                $this->include->css('jquery.fs.stepper', 'stepper_css', 'tf_head', '1.0');
            }

            $stepper_class = ' tfuse-stepper ';
        }

        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();
            $opts['properties'] = $this->strip_props($opts['properties']);

            # set some defaults
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';
            $opts['properties']['class'] .= ' tfuse_option'. (isset($stepper_class) ? $stepper_class : '');
            #end set defaults

            $propstr = $this->propstr($opts['properties']);
        }

        $output = '<input '. $propstr .' name="'. esc_attr($opts['id']) .'" id="'. esc_attr($opts['id']) .'" type="text" value="'. esc_attr($opts['value']) .'" />';

        return $output;
    }

    /**
     * Simple input password text
     */
    function password($opts)
    {
        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();
            $opts['properties'] = $this->strip_props($opts['properties']);

            # set some defaults
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';
            $opts['properties']['class'] .= ' tfuse_option'. (isset($stepper_class) ? $stepper_class : '');
            #end set defaults

            $propstr = $this->propstr($opts['properties']);
        }

        $output = '<input '. $propstr .' name="'. esc_attr($opts['id']) .'" id="'. esc_attr($opts['id']) .'" type="password" value="'. esc_attr($opts['value']) .'" />';

        return $output;
    }

    function addable($opts)
    {
        $output = '<input type="hidden" name="' . esc_attr($opts['id']) . '" id="' . esc_attr($opts['id']) . '" value="' . esc_attr($opts['value']) . '"/>';

        foreach ($opts['options'] as $option) {
            $output .= '' . $this->_auto($option);
        }

        return $output;
    }

    /**
     * Raw html with no value
     */
    function raw($opts)
    {
        $value  = isset($opts['value']) ? esc_attr($opts['value']) : '';
        $output = '<input name="' . esc_attr($opts['id']) . '" type="hidden" value="' . $value . '"/>';
        $output.= '<span class="raw_option" id="'. $opts['id'] .'">'. $opts['html'] .'</span>';

        return $output;
    }

    function colorpicker($opts)
    {
        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();

            # set some defaults
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';
            $opts['properties']['class'].=' tf_color_select tfuse_option';
            #end set defaults

            $opts['properties'] = $this->strip_props($opts['properties']);
            $propstr = $this->propstr($opts['properties']);
        }

        $output = '<input '. $propstr .' name="'. esc_attr($opts['id']) .'" id="'. esc_attr($opts['id']) .'" type="text" value="'. esc_attr($opts['value']) .'" />';

        return $output;
    }

    function textarray($opts)
    {
        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();

            # set some defaults
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';
            $opts['properties']['class'].=' tfuse_option';
            #end set defaults

            $opts['properties'] = $this->strip_props($opts['properties']);
            $propstr = $this->propstr($opts['properties']);
        }

        $output = '<input '. $propstr .' name="'. esc_attr($opts['id']) .'[]" id="'. esc_attr($opts['id']) .'_w" type="text" value="'. esc_attr($opts['value'][0]) .'" />';
        $output .= ' X <input '. $propstr .' name="'. esc_attr($opts['id']) .'[]" id="'. esc_attr($opts['id']) .'_h" type="text" value="'. esc_attr($opts['value'][1]) .'" />';

        return $output;
    }

    /**
     * Simple textarea
     */
    function textarea($opts)
    {
        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();

            $opts['properties'] = $this->strip_props($opts['properties']);

            # assign some default properties, if not implicitely set
            if (!isset($opts['properties']['cols']))
                $opts['properties']['cols'] = 5;
            if (!isset($opts['properties']['rows']))
                $opts['properties']['rows'] = 8;
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';

            $opts['properties']['class'].=' tfuse_option';

            $propstr = $this->propstr($opts['properties']);
        }

        $output = '<textarea '. $propstr .' name="'. $opts['id'] .'" id="'. $opts['id'] .'">'. esc_attr($opts['value']) .'</textarea>';

        return $output;
    }

    /**
     * Checkbox as Yes/No image
     */
    function checkbox($opts)
    {
        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();

            $opts['properties'] = $this->strip_props($opts['properties']);

            #set some default values
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';

            $opts['properties']['class'].=' single_checkbox tfuse_option';

            $propstr = $this->propstr($opts['properties']);
        }

        $checked = (isset($opts['value']) && $opts['value'] == 'true') ? 'checked="checked"' : '';
        $on = $checked ? ' on' : '';

        if(!isset($opts['disabled']))
            $opts['disabled'] = 'false';

        $disabled = ($opts['disabled'] == 'true') ? ' disabled' : '';
        $output = '<input type="hidden" '. ($opts['value']=='true' ? 'hiddenname' : 'name') .'="'. $opts['id'] .'" value="false" class="checkbox_default_hidden_value" />';
        $output .= '<input '. $propstr .' type="checkbox" name="'. $opts['id'] .'" id="'. $opts['id'] .'" value="true" '. $checked .' />';

        if ($disabled)
            $output = '<input type="hidden" name="'. $opts['id'] .'" value="'. (in_array($opts['value'], array('true','false')) ? $opts['value'] : 'false') .'" />';

        $output.= '<label class="tf_checkbox_switch'. $on . $disabled .'" for="'. $opts['id'] .'"></label>';

        return $output;
    }

    function radio($opts)
    {
        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();
            $opts['properties'] = $this->strip_props($opts['properties']);
            #set some default values
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';
            $opts['properties']['class'].=' tfuse_option checkbox ' . $opts['id'];
            $propstr = $this->propstr($opts['properties']);
        }

        $output = '';
        foreach ($opts['options'] as $key => $option) {
            if ($key === 0)
                continue;

            $checked = ($opts['value'] === (string) $key) ? 'checked="checked"' : '';

            $output .=
                '<div class="multicheckbox">'.
                    '<label>'.
                        '<input '. $propstr .' type="radio" name="'. $opts['id'] .'"  value="'. $key .'" '. $checked .' />'.
                            $option .
                    '</label>'.
                '</div>';
        }

        return $output;
    }

    /**
     * Simple select
     */
    function select($opts)
    {
        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();

            $opts['properties'] = $this->strip_props($opts['properties']);

            #set some default values
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';
            $opts['properties']['class'].=' tfuse_option';
            #end set defaults

            $propstr = $this->propstr($opts['properties']);
        }

        $output = '<select '. $propstr .' name="'. esc_attr($opts['id']) .'" id="'. esc_attr($opts['id']) .'">';

        if (!empty($opts['options'])) {
            foreach ($opts['options'] as $key => $option) {
                if (is_array($option) && isset($option['label'])) { // optgroup
                    $output .= '<optgroup label="'. esc_attr($option['label']) .'">';

                    foreach ($option['options'] as $_key => $_option) {
                        $selected = ($opts['value'] == $_key) ? ' selected="selected"' : '';

                        $output .= '<option'. $selected .' value="'. esc_attr($_key) .'">';
                        $output .= $_option;
                        $output .= '</option>';
                    }

                    $output .= '</optgroup>';
                } else { // simple option
                    $selected = ($opts['value'] == $key) ? ' selected="selected"' : '';

                    $output .= '<option'. $selected .' value="'. esc_attr($key) .'">';
                    $output .= $option;
                    $output .= '</option>';
                }
            }
        }

        $output .= '</select>';

        return $output;
    }

    function styles()
    {
        $styles = array();

        foreach (glob(get_template_directory() . '/styles/*.css') as $style) {
            $style = basename($style);
            $styles[$style] = $style;
        }

        return $styles;
    }

    function category_template()
    {
        $templates = array();

        foreach (glob(TEMPLATE_CAT . '/*.php') as $template) {
            $templates[$template] = $template;
        }

        return $templates;
    }

    function single_template()
    {
        $templates = array();

        foreach (glob(TEMPLATE_POST . '/*.php') as $template) {
            $templates[$template] = $template;
        }

        return $templates;
    }

    function categories($args = array())
    {
        if (!isset($args['hide_empty']))
            $args['hide_empty'] = 0;

        $tfuse_categories = array();
        $tfuse_categories[0] = __('Select a category:', 'tfuse');
        $tfuse_categories_obj = get_categories($args);

        if (is_array($tfuse_categories_obj)) {
            foreach ($tfuse_categories_obj as $tfuse_cat) {
                $tfuse_categories[$tfuse_cat->cat_ID] = $tfuse_cat->cat_name;
            }
        }

        return $tfuse_categories;
    }

    function tf_dropdown_categories($opts)
    {
        if (isset($opts['options']))
            $args = $opts['options'];
        $args['echo'] = 0;

        if (!isset($args['selected']))
            $args['selected'] = $opts['value'];

        if (!isset($args['show_option_none']))
            $args['show_option_none'] = __('Select a category:', 'tfuse');

        if (!isset($args['name']))
            $args['name'] = $opts['id'];

        if (!isset($args['id']))
            $args['id'] = $opts['id'];

        if (!isset($args['hide_empty']))
            $args['hide_empty'] = 0;

        if (!isset($args['hierarchical']))
            $args['hierarchical'] = 1;

        $tfuse_categories = wp_dropdown_categories($args);

        return $tfuse_categories;
    }

    function pages($args = array())
    {
        if ($args == '')
            $args = 'sort_column=post_parent,menu_order';
        $tfuse_pages = array();
        $tfuse_pages[0] = __('Select a page:', 'tfuse');
        $tfuse_pages_obj = get_pages($args);

        if (is_array($tfuse_pages_obj)) {
            foreach ($tfuse_pages_obj as $tfuse_page) {
                $tfuse_pages[$tfuse_page->ID] = $tfuse_page->post_title;
            }
        }

        return $tfuse_pages;
    }

    function dropdown_pages($opts)
    {
        if (isset($opts['options']))
            $args = $opts['options'];
        $args ['echo'] = 0;

        if (!isset($args['selected']))
            $args['selected'] = $opts['value'];

        if (!isset($args['show_option_none']))
            $args['show_option_none'] = __('Select a page:', 'tfuse');

        if (!isset($args['name']))
            $args['name'] = $opts['id'];

        if (!isset($args['id']))
            $args['id'] = $opts['id'];

        if (!isset($args['hide_empty']))
            $args['hide_empty'] = 0;

        $tfuse_categories = wp_dropdown_pages($args);

        return $tfuse_categories;
    }

    function posts($args = array(), $title = 'Select a post:')
    {
        if ($args == '')
            $args = 'numberposts=-1';
        $tfuse_posts = array();
        $tfuse_posts[0] = __($title, 'tfuse');
        $tfuse_posts_obj = get_posts($args);

        if (is_array($tfuse_posts_obj)) {
            foreach ($tfuse_posts_obj as $tfuse_post) {
                $tfuse_posts[$tfuse_post->ID] = $tfuse_post->post_title;
            }
        }

        return $tfuse_posts;
    }

    function tags($args = array('get' => 'all'))
    {
        if (!isset($args ['get']))
            $args['get'] = 'all';

        $post_txt = 'posts';
        $images_txt = 'with images';

        if (isset($args['short'])) {
            $post_txt = $images_txt = '';
        }

        $all_post_tags = get_terms('post_tag', $args);
        $tfuse_tags [0] = __('Select a tag:', 'tfuse');

        if (isset($args['count_images']) or isset($args['count_posts'])) {
            //get nr of posts with images for each tag
            $posts_images_tag = array();
            foreach ($all_post_tags as $post_tags) {
                $counttagposts = get_posts('tag=' . $post_tags->slug);
                $i = 0;

                //The Loop
                foreach ($counttagposts as $post) {
                    setup_postdata($post);
                    $key = $args['imgsource'];
                    $this->load->helper('GET_IMAGE');
                    $im = new TF_GET_IMAGE;
                    $im = $im->id($post->ID)->key($key)->from_src()->get_src();
                    if ($im != '')
                        $i++;
                }

                $posts_images_tag[$post_tags->slug] = $i; //nr of posts with images for this tag

                $tfuse_tags[$post_tags->slug] = $post_tags->name . ' (' . $post_tags->count . " $post_txt/" . $posts_images_tag [$post_tags->slug] . " $images_txt)";
            }
        } //end count images
        else {
            //get nr of posts with images for each tag
            foreach ($all_post_tags as $post_tags) {
                $tfuse_tags[$post_tags->slug] = $post_tags->name;
            }
        }

        return $tfuse_tags;
    }

    /**
     * Input text with search auto complete, under it a list of added elements
     */
    function multi($opts)
    {
        $subtypes   = array_map('trim', (array)explode(',', $opts['subtype']));
        $tmp = $subtypes;
        $first_type = array_shift($tmp);
        unset($tmp);

        if (taxonomy_exists($first_type))
            $type = 'taxonomy';
        elseif (post_type_exists($first_type))
            $type = 'post';

        $saved_data         = trim( ( isset($opts['value']) && $opts['value'] ) ? $opts['value'] : '');
        $saved_data_array   = array_map('trim', (array)explode(',', $saved_data));

        $valid_data     = array();
        $errors_found   = false;
        $output_values  = '';
        if ($saved_data) {
            if ($type == 'taxonomy') {
                foreach ($saved_data_array as $sid) {
                    $term = null;
                    foreach($subtypes as $key=>$subtype){
                        if(false !== ($term = get_term($sid, $subtype))){
                            break;
                        } else {
                            unset($saved_data_array[$key]);
                            continue;
                        }
                    }
                    if($term !== null)
                        $valid_data[$sid] = $sid;
                    else
                        $errors_found = true;

                    $output_values .= '<span><a rel="' . $sid . '" title="' . __('Remove', 'tfuse') . '" class="remove_multi_items ntdelbutton">x</a>&nbsp ' . ($term !== null ? $term->name : '<i style="color:#999;font-style:normal;">(no term_id='.$sid.' in '.$subtype.')</i>') . '</span>';
                }
            } elseif ($type == 'post') {
                foreach ($saved_data_array as $sid) {

                    $valid_data[$sid] = $sid;

                    $output_values .= '<span><a rel="' . $sid . '" title="' . __('Remove', 'tfuse') . '" class="remove_multi_items ntdelbutton">x</a>&nbsp ' . get_the_title($sid) . '</span>';
                }
            }
        }

        $output = '<div class="multiple_box">';
        $output .= '<input type="hidden" name="' . $opts['id'] . '" id="' . $opts['id'] . '" class="' . $opts['id'] . ' tfuse_option" value="' . implode(',', array_map('esc_attr', $valid_data) ) . '" />';
        $output .= '<input type="text" id="' . $opts['id'] . '_entries" name="' . $opts['id'] . '_entries" class="tfuse_suggest_input tfuse_' . $type . '_type tfuse_input_help_text" rel="' . esc_attr($opts['subtype']) . '" value="' . esc_attr( __('Type here to search', 'tfuse') ) . '" />';

        $output .= '<div id="' . $opts['id'] . '_titles" class="multiple_box_selected_titles tagchecklist">';
        $output .= '<span style="display:none;"><a rel="0" title="' . __('Remove', 'tfuse') . '" class="remove_multi_items ntdelbutton">x</a>&nbsp </span>';

        $output  .= $output_values;

        $output .= '</div>';
        if ($errors_found)
            $output .= '<div style="padding-top:10px;"><i style="color:#999;">'.__('Tip: Save options to get rid of invalid ids', 'tfuse').'</i></div>';
        $output .= '</div>';

        return $output;
    }

    function boxes($opts)
    {
        $output = '';
        for ($i = 1; $i <= $opts['count']; $i++) {

            $divider = ( array_key_exists('divider', $opts) && $opts['divider'] === TRUE ) ? ' divider' : '';
            $output .= '<div class="option option-' . $opts['type'] . '">';
            $output .= '<div class="option-inner">';
            $output .= '<label class="titledesc">' . $opts['name'] . ' ' . $i . '</label>';
            $output .= '<div class="formcontainer">';

            $output .= '<div class="how_to_populate">';

            //select box
            $output .= '<select name="' . $opts['id'] . $i . '" class="postform selector tfuse_option">';
            $output .= '<option value="">' . __('HTML (simple placeholder text gets applied)', 'tfuse') . '</option>';

            $s1 = $s2 = $s3 = '';
            $box_type = isset($opts['value'][$opts['id'] . $i]) ? $opts['value'][$opts['id'] . $i] : '';
            if ($box_type == 'post')
                $s1 = 'selected="selected"';
            if ($box_type == 'page')
                $s2 = 'selected="selected"';
            if ($box_type == 'widget')
                $s3 = 'selected="selected"';

            $output .= '<option ' . $s1 . ' value="post">Post</option>';
            $output .= '<option ' . $s2 . ' value="page">Page</option>';
            $output .= '<option ' . $s3 . ' value="widget">Widget</option>';

            $output .= '</select><br/>';

            //categories
            $s1 = $s2 = $s3 = '';
            if ($box_type != 'post')
                $s1 = 'hidden';

            $output .= '<span class="selected_post ' . $s1 . '">';

            $params['id'] = $opts['id'] . $i . '_post';
            $params['subtype'] = apply_filters('tfuse_form_boxes_categories_subtype', 'category');
            if (isset($opts['value'][$params['id']]))
                $params['value'] = $opts['value'][$params['id']];
            $output .= $this->multi($params);

            $output .= '<br/></span>';

            //pages
            if ($box_type != "page")
                $s2 = "hidden";
            $output .= '<span class="selected_page ' . $s2 . '">';

            $params['id'] = $opts['id'] . $i . '_page';
            $params['subtype'] = apply_filters('tfuse_form_boxes_pages_subtype', 'page');
            if (isset($opts['value'][$params['id']]))
                $params['value'] = $opts['value'][$params['id']];
            $output .= $this->multi($params);

            $output .= '<br/></span>';

            //widgets
            if ($box_type != 'widget')
                $s3 = 'hidden';

            $output .= '<span class="selected_widget ' . $s3 . '">';
            $output .= sprintf(__('Please save this page, then head over to the %s widget page %s and add widgets to the %s Widget Area', 'tfuse') . '"</a>', '<a href="widgets.php">', '</a>', '<a href="widgets.php">"' . $opts['name'] . ' ' . $i . ' ');
            $output .= '</span></div><br/><br/>';
            $output .= '</div>';
            $output .= '<div class="desc">' . $opts['desc'] . ' ' . $i . '</div>';
            $output .= '<div class="clear"></div>';
            $output .= '</div></div>';
            $output .= '<div class="clear' . $divider . '"></div>' . "\n";
        }

        return $output;
    }

    /**
     * Like radio input but with images as options
     */
    function images($opts)
    {
        $i = 0;
        $output = '';

        foreach ($opts['options'] as $key => $option) {
            $i++;
            $checked = $selected = '';

            if (empty($opts['value']) && $i == 1) {
                $checked = ' checked="checked"';
                $selected = 'tfuse-meta-radio-img-selected';
            } elseif ($opts['value'] == $key) {
                $checked = ' checked="checked"';
                $selected = 'tfuse-meta-radio-img-selected';
            }

            $output .= '<div class="tfuse-meta-radio-img-box">';
            $output .= '<div class="tfuse-meta-radio-img-label">';
            $output .= '<input type="radio" id="tfuse-meta-radio-img-' . $opts['id'] . $i . '" class="checkbox tfuse-meta-radio-img-radio tfuse_option" value="' . esc_attr($key) . '" name="' . esc_attr($opts['id']) . '" ' . $checked . ' />';
            $output .= '&nbsp;' . esc_html($key) . '<div class="tfuse_spacer"></div>';
            $output .= '</div>';
            $output .= '<div class="thumb_radio_over ' . $selected . '" title="' . esc_attr($option[1]) . '"></div><img title="' . esc_attr($option[1]) . '" src="' . esc_url($option[0]) . '" alt="" class="tfuse-meta-radio-img-img" optval="' . esc_attr($key) . '" />';
            $output .= '</div>';
        }

        return $output;
    }

    /**
     * Simple hidden input
     */
    function hidden($opts)
    {
        $output = '<input type="hidden" id="'.$opts['id'].'" name="'.$opts['id'].'" value="'.$opts['value'].'" />';

        return $output;
    }

    function upload($opts)
    {
        global $post;

        wp_enqueue_script('media-upload');

        $id     = $opts['id'];
        $type   = $opts['type'];
        $upload = isset($opts['value']) ? esc_attr($opts['value']) : '';

        # properties
        {
            if (!isset($opts['properties']))
                $opts['properties'] = array();

            $opts['properties'] = $this->strip_props($opts['properties']);

            # assign some default properties
            if (!isset($opts['properties']['class']))
                $opts['properties']['class'] = '';

            $opts['properties']['class'] = ' upload-input-text tfuse_option';

            $propstr = $this->propstr($opts['properties']);
        }

        $media      = (!empty($opts['media']) ) ? $opts['media'] : 'image';
        $post_type  = ($media == 'image') ? 'tfuse_gallery_group_post' : 'tfuse_download_group_post';
        $group      = (!empty($post->ID)) ? $post->ID: $post_type($id);
        $val        = (!empty($upload) && $type == 'upload' ) ? $upload : '';
        $post_class = (isset($post))?$post->post_type  :'';

        $output  = '<input '. $propstr .' name="'. $id .'" id="'. $id .'" type="text" value="'. esc_attr($val) .'" rel="'. $media .'" />';
        $output .= '<div class="upload_button_div"><a href="#" class="button upload_button '. $post_class .'" id="'. $id .'_button" rel="'. $group .'">'. __('Upload', 'tfuse') .'</a> </div>';

        return $output;
    }

    function multi_upload($opts)
    {
        global $post;

        wp_enqueue_script('media-upload');

        $id         = $opts['id'];
        $media      = (!empty($opts['media']) ) ? $opts['media'] : 'image';
        $post_type  = ($media == 'image') ? 'tfuse_gallery_group_post' : 'tfuse_download_group_post';

        if(!isset($post->ID)){
            $post_id = $post_type($id);
        } else {
            $_token  = $id .'_'. $post->ID;
            $post_id = ($flag = check_if_tfuse_group_post_exists($_token, $post_type)) ? $flag : $post->ID;
        }

        $num_images = 0;
        if(!isset($post->ID) || $post->ID != $post_id){
            $images = get_children('post_type=attachment&post_parent='. $post_id);
            $num_images = count($images);
        }

        $files_name = isset($opts['files_name']) ? $opts['files_name'] : __('Images', 'tfuse');
        $texts = array(
            'single'   => sprintf(__('Upload %s', 'tfuse'),   $files_name),
            'multiple' => sprintf(__('Add/Edit %s', 'tfuse'), $files_name)
        );
        $button_text = $texts[ $num_images ? 'multiple' : 'single'];

        $tab = $num_images ? 'gallery' : 'type';
        $post_class  = isset($post) ? $post->post_type : '';

        $output =
            '<div class="upload_button_div" data-text-single="'. esc_attr($texts['single']) .'" data-text-multiple="'. esc_attr($texts['multiple']) .'">'.
                '<span class="attachment_num">'.
                    $num_images.
                '</span> '.
                sprintf(__('%s Uploaded', 'tfuse'), $files_name).
                ' <a tab="'. $tab .'" href="#" class="multi_upload button upload_button '. $post_class .'" id="'. $id .'_button" rel="'. $post_id .'">'.
                    $button_text.
                '</a>'.
            '</div>';

        return $output;
    }

    /**
     * Popup to upload multiple images and save them am array
     * (better that multi_upload: does not spam database with many posts. It creates to, but remove them after popup is closed)
     */
    function multi_upload2($opts)
    {
        wp_enqueue_script('media-upload');

        $value = empty($opts['value']) || !is_array($opts['value']) ? array() : $opts['value']; // images
        $count = count($value);
        $tab   = $count ? 'gallery' : 'type'; // what tab to show to user when it opens popup

        $files_name = isset($opts['files_name']) ? $opts['files_name'] : __('Images', 'tfuse');
        $texts = array(
            'single'   => sprintf(__('Upload %s', 'tfuse'),   $files_name),
            'multiple' => sprintf(__('Add/Edit %s', 'tfuse'), $files_name)
        );
        $button_text = $texts[ $count ? 'multiple' : 'single'];

        $output  =
            '<div class="multi_upload2_button_div" data-text-single="'. esc_attr($texts['single']) .'" data-text-multiple="'. esc_attr($texts['multiple']) .'">'.
                '<span class="attachment_num">'. $count .'</span> '.
                __('Uploaded', 'tfuse').
                ' <a data-tab="'. $tab .'" href="#" class="multi_upload2_button button" data-id="'. esc_attr($opts['id']) .'">'.
                    $button_text.
                '</a>'.
                '<a href="#" class="multi_upload2_clear_restore">'.
                    '<span class="tf-cl" style="display:none">'. __('Clear', 'tfuse') .'</span>'.
                    '<span class="tf-re" style="display:none">'. __('Restore', 'tfuse') .'</span>'.
                '</a>'.
            '</div>'.
            '<input type="hidden" class="tfuse_multi_upload2_input" id="'. esc_attr($opts['id']) .'" name="'. esc_attr($opts['id']) .'" value="'. esc_attr(json_encode($value)) .'" />';

        return $output;
    }

    function callback($opts)
    {
        return $this->callbacks->execute($opts);
    }

    function strip_props($arr)
    {
        if (array_key_exists('type', $arr))
            unset($arr['type']);
        if (array_key_exists('value', $arr))
            unset($arr['value']);
        if (array_key_exists('id', $arr))
            unset($arr['id']);
        if (array_key_exists('name', $arr))
            unset($arr['name']);
        if (array_key_exists('checked', $arr))
            unset($arr['checked']);

        return $arr;
    }

    function propstr($arr)
    {
        $out = '';
        foreach ($arr as $name => $value) {
            $out.=' ' . $name . '="' . esc_attr($value) . '" ';
        }
        return $out;
    }

    function captcha($opts)
    {
        if (!isset($opts['properties']))
            $opts['properties'] = array();
        $opts['properties']['class'] = 'tfuse_captcha_input';

        $class  = $opts['properties']['class'];
        $class .= ' tfuse_captcha_reload';

        $out    = '<img  src="'. TFUSE_EXT_URI .'/'. strtolower($opts['_class_name']) .'/library/'. $opts['file_name'] .'" class="tfuse_captcha_img" >';
        $out   .= '<input type="button" class="'. $class .'" style="border:1px solid;"/>';
        $out   .= $this->text($opts);

        return $out;
    }

    function button($opts)
    {
        if (isset($opts['properties'])) {
            $propstr = $this->propstr($opts['properties']);
        } else {
            $propstr = '';
        }

        $out = '<input '. $propstr .' type="'. $opts['subtype'] .'" id="'. $opts['id'] .'" name="'. $opts['name'] .'" value="'. $opts['value'] .'"/>';

        return $out;
    }

    function delete_row($opts)
    {
        return '<div class="'. $opts['class'] .'"></div>';
    }

    function selectable_code($opts)
    {
        $opts['properties']['class'] = isset($opts['properties']['class'])?$opts['properties']['class'].' tfuse_selectable_code':'tfuse_selectable_code';
        $propstr = $this->propstr($opts['properties']);

        $output ='<span class="raw_option" id="'. $opts['id'] .'"><code '. $propstr .'>'. $opts['value'] .'</code></span>';

        return $output;
    }

    function datepicker($opts)
    {
        $pluginfolder = home_url() . '/wp-includes/js/jquery/ui';

        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-datepicker', $pluginfolder . '/jquery.ui.datepicker.min.js', array('jquery', 'jquery-ui-core') );
        if (!$this->include->type_is_registered('datepicker_framework_js')) {
            $this->include->register_type('datepicker_framework_js', TFUSE . '/static/javascript');
            $this->include->js('datepicker', 'datepicker_framework_js','tf_footer',11);
            $this->include->register_type('datepicker_framework_css', TFUSE . '/static/css');
            $this->include->css('datepicker', 'datepicker_framework_css');
            $this->include->js('popbox.min', 'datepicker_framework_js','tf_footer',10);
        }

        $inp_class = (isset($opts['properties']['class'])) ? $opts['properties']['class'] : '';
        $inp_class .= (!isset($opts['popbox']) || count($opts['popbox']) == 0)? ' tfuse_datepicker' : ' tfuse_dates_holder';
        $opts['properties']['class'] = $inp_class;

        $out  = '<div class="tf_datepicker_holder">';
        $out .= ((isset($opts['inp_name']) && trim($opts['inp_name']) != '')? '<label class="titledesc">'.$opts['inp_name'].':</label>':''). $this->text($opts);

        if (isset($opts['popbox']) && count($opts['popbox']) > 0) {
            $out .=
                '<div class="popbox tfuse_datepicker_popbox '.((isset($opts['properties']['minDateCurrent']) && ($opts['properties']['minDateCurrent'] == null || $opts['properties']['minDateCurrent'] == false))?'':'minDateCurrent').'">'.
                    '<a class="open" href="#"><div class="open_button"></div></a>'.
                    '<div class="collapse">'.
                        '<div class="box">'.
                            '<div class="arrow"></div>'.
                            '<div class="arrow-border"></div>'.
                            '<div class="box_content">';

            foreach ($opts['popbox'] as $key => $pop_inp) {
                if (!in_array(trim($key),array('with_datepickers','dependancy'))) {
                    $class = (isset($pop_inp['properties']['class'])) ? $pop_inp['properties']['class'] : '';
                    $class .= (in_array($pop_inp['id'],$opts['popbox']['with_datepickers']))?' tfuse_datepicker':'';
                    if(isset($opts['popbox']['dependancy']) && count($opts['popbox']['dependancy']) > 0){
                        foreach($opts['popbox']['dependancy'] as $Dkey => $value)
                            if(trim($value) == trim($pop_inp['id']))
                                $class .= ' '.$Dkey;
                    }
                    $pop_inp['properties']['class'] = $class;
                    $out .= '<label for="'.$pop_inp['id'].'">'.$pop_inp['name'].':</label>'.$this->$pop_inp['type']($pop_inp);
                }
            }

            $out .=
                            '</div>'.
                            '<a href="#" class="close">close</a>'.
                            '<a href="#" class="excludedate_ok">Ok</a>'.
                        '</div>'.
                    '</div>'.
                '</div>';
        }

        $out .= '</div>';

        return $out;
    }

    function selectsearch($opts)
    {
        //FULL ARRAY WITH OPTIONS
        /*array(
            'name'          =>'the label for selectsearch',
            'desc'          => 'description of selectsearch',
            'id'            => 'unique id if is not set post_name index this value goes to name ',
            'options'       => array("ro"=>"Romanian","ru"=>"Russian"), //'array of options
            'groups'        => true, //show optgroups from entire array
            'type'          => 'selectsearch', // Type of optigen selectsearch
            'allow_single_deselect' => true, // true or false value,show close btn when select one item ,only for single search
            'value'         => array('RO','RU')|'RO', //array of indexes or simple name for multi or single selectseach
            'multiple'      =>'true', //true or false ,what type of selectseach will be multiple or single
            'properties'    => array('class'=>array('firstclass', 'secondclass'),'style'=>array('width' => '170px')),
            'show_groups'   => true //true or false value ,show groups control or not ,only for multiple selectseach
            'toggle_btn'    => true, //true or false ,enable toggle btn
            'toggle_btn_text' => array('show','hide'),//default toggle text at the button
            'toggle_container_text' => array('single'=>'Selected %%number%%  country',
                                            'multiple'=>'Selected %%number%% countries'),//toggle container text
            'enable_add' => 'saveShippingClass',//calback javascript function to add btn bind event
        );*/
        wp_enqueue_script('jquery');
        if (!$this->include->type_is_registered('chosen_js')) {
            $this->include->register_type('chosen_js', TFUSE . '/static/javascript');
            $this->include->js('chosen.jquery.min', 'chosen_js', 'tf_head', 10, '0.9.8');
            $this->include->js('chosen_tfuse', 'chosen_js', 'tf_head', 10, '1.2');
            $this->include->register_type('chosen_css', TFUSE . '/static/css');
            $this->include->css('chosen', 'chosen_css', 'tf_head', '0.2');
            $this->include->css('chosen_ext', 'chosen_css', 'tf_head', '1.0', '', array());
        }

        $class = '';
        $style = '';
        $groups = array();
        if (isset($opts['properties']) && count($opts['properties']) > 0) {
            if (isset($opts['properties']['class'])) {
                if (!is_array($opts['properties']['class']))
                    $opts['properties']['class'] = array($opts['properties']['class']);
                $class = implode(' ', $opts['properties']['class']);
            }
            if (isset($opts['properties']['style']) and is_array($opts['properties']['style']) and count($opts['properties']['style']) > 0) {
                $styles = array();
                foreach ($opts['properties']['style'] as $q => $v)
                    $styles[] = $q . ': ' . $v;
                $style = 'style="' . implode('; ', $styles) . '"';
            }
        }
        $ignored_items = empty($opts['ignored_items'])?'':'data-ignored-items="'.$opts['ignored_items'].'"';
        $callback = empty($opts['enable_add']) ? '' : 'data-callback="' . $opts['enable_add'] . '"';
        $callback_delete_btn = empty($opts['enable_delete']) ? '' : 'data-callback-delete-btn="' . $opts['enable_delete'] . '"';
        $default_toggle_text = array('single' => __('Selected %%number%%  item', 'tfuse'), 'multiple' => __('Selected %%number%% items', 'tfuse'));
        $toggle_btn = empty($opts['toggle_btn']) ? '' : 'data-toggle-btn="' . $opts['toggle_btn'] . '"';
        $multiple = empty($opts['multiple']) ? false : true;
        $allow_single_deselect = $multiple ? 'false' : (empty($opts['allow_single_deselect']) ? 'false' : 'true');
        $input_value = empty($opts['value']) ? '' : $opts['value'];
        $name = $opts['id'];
        $def_text = empty($opts['def_text']) ? $opts['name'] : $opts['def_text'];
        $show_groups = empty($opts['show_groups']) ? false : true;
        $out = '<input type="hidden"  name="' . $name . '" id="' . esc_attr($name) . '" value="' . $input_value . '" />';
        $out .= '<select single-deselect="' . $allow_single_deselect . '" data-placeholder="' . $def_text . '" ' . ($multiple ? 'multiple' : '') . ' class="tfuse_option tfuse-select' . ((isset($opts['deselect']) && $opts['deselect'] === true) ? '-deselect' : '') . ' ' . ((isset($class)) ? $class : '') . ' ' . ((isset($opts['right']) and $opts['right'] == true) ? 'chzn-rtl' : '') . '" ' . ((isset($style)) ? $style : '') . ' ' . ((isset($opts['properties']['other'])) ? $opts['properties']['other'] : '') . ' ' . $callback . '  ' .$ignored_items. '  ' . $toggle_btn . '  ' . $callback_delete_btn . '>' . "\n";
        $out .= '<option value=""></option>' . "\n";

        $value = array();

        if (isset($opts['value'])) {
            $value = explode(',', $opts['value']);
        }

        if (isset($opts['options']) and count($opts['options']) > 0)
            if (isset($opts['groups']) and $opts['groups'] === true) {
                foreach ($opts['options'] as $q => $v) {
                    if (!is_array($v)) {
                        $out .= '<option value="' . $q . '" ' . (count($value) > 0 && in_array($q, $value) ? 'selected' : '') . '>' . $v . '</option>' . "\n";
                    } else {
                        $temp = strtolower(str_replace(" ", "_", $v['title']));
                        $groups[] = $temp;

                        $out .= '<optgroup data-placeholder="' . $temp . '" label="' . $v['title'] . '">' . "\n";

                        if (count($v) > 0)
                            foreach ($v['value'] as $qq => $vv)
                                $out .= '<option value="' . $qq . '" ' . (count($value) > 0 && in_array($qq, $value) ? 'selected' : '') . '>' . $vv . '</option>' . "\n";
                        $out .= '</optgroup>' . "\n";
                    }
                }
            } else {
                if (is_array($opts['options']))
                    foreach ($opts['options'] as $q => $v)
                        $out .= '<option value="' . $q . '" ' . (count($value) > 0 && in_array($q, $value) ? 'selected' : '') . '>' . $v . '</option>' . "\n";
            }

        $out .= '</select>' . "\n";

        //Show links for optgroup and load js for this

        if ($show_groups and $multiple) {
            $str = '';
            if (!empty($opts['toggle_btn'])) {
                $str .= "<div class='tf_selectsearch_control_show_hide' style=' width:275px; display:block;'><span class ='tf-toggle-text-container' ><span class='tf-selectseach-toggle-txt-single '>" .
                    implode('</span><span class="tf-selectseach-toggle-txt-multiple" >',
                        (empty($opts['toggle_container_text']) ? $default_toggle_text : $opts['toggle_container_text'])) .
                    "</span></span><a href='#' class='tf_selectsearch_toggle_a add button'><span class='toggle_btn_on'>" .
                    implode('</span><span class="toggle_btn_off">',
                        array_slice((empty($opts['toggle_btn_text']) ? array(__('show', 'tfuse'), __('hide', 'tfuse')) : $opts['toggle_btn_text']), 0, 2)) .
                    "</span></a></div>";
            }
            $str .= '<div class="tf_multicontrol_selectsearch">' . "\n";
            $str .= '<div class="tf_groups_controls">' . "\n";
            $str .= '<a href="" class="tf_selectsearch_control_all">All</a>' . "\n";

            foreach ($groups as $group)
                $str .= '<a href="" class="tf-groups-links" data-placeholder="' . $group . '">' . ucwords(str_replace('_', ' ', $group)) . '</a>' . "\n";

            $str .= '<a href="" class="tf_selectsearch_control_none">None</a>' . "\n";
            $str .= '</div>' . "\n";
            $str .= '<div class="tf_search_dpdw">' . "\n";
            $str .= $out;
            $str .= '</div>' . "\n";
            $str .= '<div class="clear"></div></div>' . "\n";

        }

        return isset($str) ? $str : $out;
    }

    /**
     * Google Maps input
     */
    function maps($opts)
    {
        wp_enqueue_script('jquery');

        $uniqId = 'tfgmaps-'.md5(mt_rand(1, 1000).'-'.mt_rand(1, 1000).'-'.time());
        $tmp    = (array)explode(':', $opts['value']);

        $x      = ( is_numeric( ($x = (string)(@$tmp[0])) ) ? $x : '');
        $y      = ( is_numeric( ($y = (string)( !empty($tmp[1]) ? @$tmp[1] : '')) ) ? $y : '');

        if(trim($x) && trim($y)){
            $value = $x.':'.$y;
        } else {
            $value = $x = $y = '';
        }

        $output = '';
        $output .= '<input id="'.esc_attr($opts['id']).'" name="'.esc_attr($opts['id']).'" type="hidden" value="' . esc_attr($value) . '" class="tf-optigen-input-maps '.$uniqId.'" />';
        $output .= '<div><input id="'.esc_attr($opts['id']).'_x" type="text" value="' . esc_attr($x) . '" /></div>';
        $output .= '<div><input id="'.esc_attr($opts['id']).'_y" type="text" value="' . esc_attr($y) . '" /></div>';
        $output .=        '<div id="'.esc_attr($opts['id']).'_map" class="tf-optigen-input-maps-div' . (@$opts['desc'] ? '' : ' tf-optigen-input-maps-div-big') . '" ></div>';

        $output .= '<script type="text/javascript" id="optigen-maps-'.$opts['id'].'">';
        $output .= 'jQuery(document).ready(function($){';
        $output .= 'tf_init_google_maps_input("input.'.$uniqId.'");';
        $output .= 'jQuery("script#optigen-maps-'.$opts['id'].'").remove();';
        $output .= '});';
        $output .= '</script>';

        return $output;
    }

    function multiple_input($opts)
    {
        if (!$this->include->type_is_registered('multiple_input_css')) {
            $this->include->register_type('multiple_input_css', TFUSE . '/static/css');
            $this->include->css('multi_input', 'multiple_input_css', 'tf_head', '0.9.8');
            $this->include->register_type('multi_input_js', TFUSE . '/static/javascript');
            $this->include->js('multi_input', 'multi_input_js', 'tf_head', 10, '0.9.8');
        }

        /*$opts=array(
            'name'=>'Default name',                                     //label for this optigen element
            'desc'=>'Description',                                      //Descriptiom
            'post_name'=>'minput[]',                                    //value that goes to name of input or textarea
            'class'=>array('tf_minput'),                                //array of clases for wrap div of optigen element
            'value'=>array('first value','second value','third value'), //values to inputs
            'id'=>'wrap_input',                                         //id for div that wrap this optigen element
            'input_classes'=>array('input_class'),                      //clases for each row that wrap inputs
            'type'=>'multiple_input',                                   //type of optigen
            'subtype'=>'textarea'                                       // textarea | text
        );*/

        // $post_name = empty($opts['post_name'])  ? 'tfminput[]' : $opts['post_name'];
        $class  = empty($opts['class']) ? '' : implode(' ',$opts['class']);
        $value  = empty($opts['value']) ? array('') : $opts['value'];
        $id     = empty($opts['id']) ? 'tf_multi_input_name' : $opts['id'];
        $input_class = empty($opts['input_classes']) ? '': implode(" ",$opts['input_classes']);
        $subtype     = empty($opts['subtype']) ? 'text': $opts['subtype'];

        if($subtype == 'text')
            $template ='<input type="text" name="{name}" value="{value}"  class="tfuse_option"/>';
        elseif($subtype == 'textarea')
            $template = '<textarea  name="{name}" class="tfuse_option" >{value}</textarea>';

        $patterns = array('{name}', '{value}');
        $out = '<div class="'.$class.'" id="'.$id.'" >'."\n";
        $out.= '<div class="tf_opt_multiple_content">';
        foreach ($value as $key => $val) {
            $out.= '<div class="tf_opt_multiple_input_row '.$input_class.' ">'."\n";
            $out.= str_replace($patterns,array($id.'[]',$val),$template);
            $out.= ($key==0) ? '' : '<a href="" class="tf_opt_multiple_remove_btn"></a>'."\n";
            $out.= '</div>'."\n";
        }

        $out.= '</div>';
        $out.= '<div class="clear"></div>';
        $out.= '<a href="" class="tf_opt_multiple_add_btn"></a>';
        $out.= '<div class="clear"></div>';
        $out.= '</div>';

        return $out;

    }

    /**
     * Table with columns and optigen inputs in it. And you can add or remove rows
     */
    function table($opts)
    {
        if (!$this->include->type_is_registered('tfuse_render_table_js')) {
            $this->include->register_type('tfuse_render_table_js', TFUSE . '/static/javascript');
            $this->include->register_type('tfuse_render_table_css', TFUSE . '/static/css');
            $this->include->css('tip-twitter','tfuse_render_table_css');
            $this->include->js('jquery.poshytip','tfuse_render_table_js');
            $this->include->js('tfuse_render_table', 'tfuse_render_table_js', 'tf_head', 10, '0.2');
        }

        $str = '<table class="tfuse-optigen-table '. (isset($opts['class']) ? $opts['class'] : '') .'" id="'.$opts['id'].'" style="'. (isset($opts['style']) ? $opts['style'] : '') .'">';

        $str.= '<thead>';
        foreach ($opts['columns'] as $th)
            $str.= '<th class="'.$th['id'].'">'. (isset($th['name']) ? $th['name'] : '') .(empty($th['desc'])? ' ' :' <a href="#" class="tfuse-tip-twitter" title="'.addslashes(isset($th['desc']) ? $th['desc'] : '').'" style="cursor:help">[?]</a>'). '</th>';
        $str.= '</thead>';

        /**
         * Rows with already saved data
         */
        {
            $str.= '<tbody class="btq_first_body">';
            foreach ($opts['value'] as $value) {
                $str.= '<tr>';
                foreach ($opts['columns'] as $td) {
                    $str.= '<td style="overflow:visible" data-id="'.$td['id'].'" data-type="'.$td['type'].'">';
                    if (method_exists($this->optigen, $td['type'])) {
                        $str.= $this->optigen->{$td['type']}(array_merge($td, array('value' => $value[$td['id']])));
                    } else {
                        trigger_error('Method '.$td['type'].' does no exists in OPTIGEN', E_USER_ERROR);
                    }

                    $str.= '</td>';
                }
                $str.= '</tr>';
            }
            $str.= '</tbody>';
        }

        /**
         * Default add row (when click on "Add row")
         */
        {
            $str.= '<tbody class="btq_last_body">';
            $str.= '<tr style="display:none" class="default-value-row">';
            foreach ($opts['columns'] as $key => $td) {
                $str.= '<td style="overflow:visible" data-id="'.$td['id'].'" data-type="'.$td['type'].'">';
                if (method_exists($this->optigen, $td['type'])) {
                    $str.= $this->optigen->{$td['type']}(array_merge($td, array(
                        'value' => isset($opts['default_add_value']) && isset($opts['default_add_value'][$td['id']]) ? $opts['default_add_value'][$td['id']] : ''
                    )));
                } else {
                    trigger_error('Method '.$td['type'].' does not exists in OPTIGEN', E_USER_ERROR);
                }
                $str.= '</td>';
            }
            $str.= '</tr>';
            $str.= '</tbody>';
        }

        $str.= '<tfoot>';
        foreach ($opts['columns'] as $th)
            $str.= '<th >'. (isset($th['name']) ? $th['name'] : '') .'</th>';
        $str.= '</tfoot>';

        $str.= '</table>';

        $str.= '<input type="hidden" name="'.$opts['id'].'"/>';

        $str.= '<script type="text/javascript" id="optigen-table-'.$opts['id'].'">';
        $str.= 'jQuery(document).ready(function(){';
        $str.= 'jQuery("#'.$opts['id'].'").tfuseMakeTable(); });';
        // remove scripts from html inside headings
        //// because they are cloned when dragged/moved and all scripts inside them will run again
        $str.= 'jQuery("script#optigen-table-'.$opts['id'].'").remove();';
        $str.= '</script>';

        return $str;
    }

    /**
     * Like 'table' input, but rows as divs
     */
    function div_table($opts)
    {
        if (!$this->include->type_is_registered('tfuse_div_table_js')) {
            $this->include->register_type('tfuse_div_table_js', TFUSE . '/static/javascript');
            $this->include->js('tfuse_div_table', 'tfuse_div_table_js', 'tf_head', 10, '0.9.8');
        }

        $str = '<div class="tfuse-optigen-div-table '. (isset($opts['class']) ? $opts['class'] : '') .'" id="'.$opts['id'].'" style="'. (isset($opts['style']) ? $opts['style'] : '') .'" >'."\n";
        $str.= '<div class="div-table-first-body">';

        foreach ($opts['value'] as $value) {
            $str.= '<div class="div-table-tr">';
            $str.= '<div class="div-table-td div-table-delete-checkbox-row"><input type="checkbox"/></div>'."\n";

            foreach ($opts['columns'] as $key => $td) {
                $str.= '<div class="div-table-td"  data-id="'.$td['id'].'" data-type="'.$td['type'].'">';
                $str.= $this->interface->meta_box_row_template(array_merge($td, array('value' => $value[$td['id']])));
                $str.= '<div style="clear:both"></div></div>'."\n";
            }

            $str.= '<div style="clear:both"></div></div>'."\n";
        }

        $str.= '<div style="clear:both"></div></div>'."\n";
        $str.= '<div class="div-table-last-body">';

        if(!empty($opts['default_value'])){
            $str.= '<div class="div-table-tr default-value-row" style="display:none">';
            $str.= '<div class="div-table-td div-table-delete-checkbox-row"><input type="checkbox"/></div>'."\n";
            foreach ($opts['columns'] as $key => $td) {
                $str.= '<div class="div-table-td" data-id="'.$td['id'].'" data-type="'.$td['type'].'">';
                $str.= $this->interface->meta_box_row_template(array_merge($td, array('value' => $opts['default_value'][$td['id']])));
                $str.= '<div style="clear:both"></div></div>'."\n";
            }
            $str.= '<div style="clear:both"></div></div>'."\n";
        }

        $str.= '<a class="add button btq_shopping_add_row" href="#">'
            .(empty($opts['btn_labels'][0]) ? 'Add Row' : $opts['btn_labels'][0])
            .'</a><a class="add button btq_shopping_delete_rows" href="#">'
            .(empty($opts['btn_labels'][1]) ? 'Delete Row' : $opts['btn_labels'][1])
            .'</a>';
        $str.= '<div style="clear:both"></div></div>'."\n";
        $str.= '<input type="hidden" name="'.$opts['id'].'"/>';
        $str.= '<div style="clear:both"></div></div>'."\n";
        $str.= '<script type="text/javascript" id="optigen-div_table-'.$opts['id'].'">';
        $str.= 'jQuery(document).ready(function(){';
        $str.= 'jQuery("#'.$opts['id'].'").tfuseMakeDivTable();';
        // remove scripts from html inside headings
        //// because they are cloned when dragged/moved and all scripts inside them will run again
        $str.= 'jQuery("script#optigen-div_table-'.$opts['id'].'").remove();';
        $str.= '});';
        $str.= '</script>';

        return $str;
    }

    /**
     * Typography
     */
    function typography($opts)
    {
        $output  = '';

        $stored = $opts['value'];
        $value = $opts;

        /* Font Size */
        $val = $stored['size'];

        if ( $stored['unit'] == 'px' ) {
            $show_px = '';
            $show_em = ' style="display:none" ';
            $name_px = ' name="'. esc_attr( $value['id'].'[]') . '" ';
            $name_em = '';
        } else if ( $stored['unit'] == 'em' ) {
            $show_em = '';
            $show_px = 'style="display:none"';
            $name_em = ' name="'. esc_attr( $value['id'].'[]') . '" ';
            $name_px = '';
        } else {
            $show_px = '';
            $show_em = ' style="display:none" ';
            $name_px = ' name="'. esc_attr( $value['id'].'[]') . '" ';
            $name_em = '';
        }
        $output .= '<select class="tfuse_option tf_typography_px" id="'. esc_attr( $value['id'].'_px') . '" '. $name_px . $show_px .'>';
        for ( $i = 9; $i < 71; $i++ ) {
            if( $val == strval( $i ) ) { $active = 'selected="selected"'; } else { $active = ''; }
            $output .= '<option value="'. esc_attr( $i ) .'" ' . $active . '>'. esc_html( $i ) .'</option>'; }
        $output .= '</select>';

        $output .= '<select class="tfuse_option tf_typography_em" id="'. esc_attr( $value['id'].'_em' ) . '" '. $name_em . $show_em.'>';
        $em = 0.5;
        for ( $i = 0; $i < 39; $i++ ) {
            if ( $i <= 24 )   // up to 2.0em in 0.1 increments
                $em = $em + 0.1;
            elseif ( $i >= 14 && $i <= 24 )  // Above 2.0em to 3.0em in 0.2 increments
                $em = $em + 0.2;
            elseif ( $i >= 24 )  // Above 3.0em in 0.5 increments
                $em = $em + 0.5;
            if( $val == strval( $em ) ) { $active = 'selected="selected"'; } else { $active = ''; }

            $output .= '<option value="'. esc_attr( $em ) .'" ' . $active . '>'. esc_html( $em ) .'</option>'; }
        $output .= '</select>';

        /* Font Unit */
        $val = 'px';
        if ( $stored['unit'] != '' ) { $val = $stored['unit']; }
        $em = ''; $px = '';
        if( $val == 'em' ) { $em = 'selected="selected"'; }
        if( $val == 'px' ) { $px = 'selected="selected"'; }
        $output .= '<select class="tfuse_option tf_typography_unit" name="'. esc_attr( $value['id'] ) .'[]" id="'. esc_attr( $value['id'].'_unit' ) . '">';
        $output .= '<option value="px" '. $px .'">px</option>';
        $output .= '<option value="em" '. $em .'>em</option>';
        $output .= '</select>';

        /* Font Face */
        $val = $stored['face'];

        $font01 = '';
        $font02 = '';
        $font03 = '';
        $font04 = '';
        $font05 = '';
        $font06 = '';
        $font07 = '';
        $font08 = '';
        $font09 = '';
        $font10 = '';
        $font11 = '';
        $font12 = '';
        $font13 = '';
        $font14 = '';
        $font15 = '';
        $font16 = '';
        $font17 = '';

        if ( strpos( $val, 'Arial, sans-serif' ) !== false ) { $font01 = 'selected="selected"'; }
        if ( strpos( $val, 'Verdana, Geneva' ) !== false ) { $font02 = 'selected="selected"'; }
        if ( strpos( $val, 'Trebuchet' ) !== false ) { $font03 = 'selected="selected"'; }
        if ( strpos( $val, 'Georgia' ) !== false ) { $font04 = 'selected="selected"'; }
        if ( strpos( $val, 'Times New Roman' ) !== false ) { $font05 = 'selected="selected"'; }
        if ( strpos( $val, 'Tahoma, Geneva' ) !== false ) { $font06 = 'selected="selected"'; }
        if ( strpos( $val, 'Palatino' ) !== false ) { $font07 = 'selected="selected"'; }
        if ( strpos( $val, 'Helvetica' ) !== false ) { $font08 = 'selected="selected"'; }
        if ( strpos( $val, 'Calibri' ) !== false ) { $font09 = 'selected="selected"'; }
        if ( strpos( $val, 'Myriad' ) !== false ) { $font10 = 'selected="selected"'; }
        if ( strpos( $val, 'Lucida' ) !== false ) { $font11 = 'selected="selected"'; }
        if ( strpos( $val, 'Arial Black' ) !== false ) { $font12 = 'selected="selected"'; }
        if ( strpos( $val, 'Gill' ) !== false ) { $font13 = 'selected="selected"'; }
        if ( strpos( $val, 'Geneva, Tahoma' ) !== false ) { $font14 = 'selected="selected"'; }
        if ( strpos( $val, 'Impact' ) !== false ) { $font15 = 'selected="selected"'; }
        if ( strpos( $val, 'Courier' ) !== false ) { $font16 = 'selected="selected"'; }
        if ( strpos( $val, 'Century Gothic' ) !== false ) { $font17 = 'selected="selected"'; }

        $output .= '<select class="tfuse_option tf_typography_face" name="'. esc_attr( $value['id'].'[]' ) . '" id="'. esc_attr( $value['id'].'_face') . '">';
        $output .= '<option value="Arial, sans-serif" '. $font01 .'>Arial</option>';
        $output .= '<option value="Verdana, Geneva, sans-serif" '. $font02 .'>Verdana</option>';
        $output .= '<option value="&quot;Trebuchet MS&quot;, Tahoma, sans-serif"'. $font03 .'>Trebuchet</option>';
        $output .= '<option value="Georgia, serif" '. $font04 .'>Georgia</option>';
        $output .= '<option value="&quot;Times New Roman&quot;, serif"'. $font05 .'>Times New Roman</option>';
        $output .= '<option value="Tahoma, Geneva, Verdana, sans-serif"'. $font06 .'>Tahoma</option>';
        $output .= '<option value="Palatino, &quot;Palatino Linotype&quot;, serif"'. $font07 .'>Palatino</option>';
        $output .= '<option value="&quot;Helvetica Neue&quot;, Helvetica, sans-serif" '. $font08 .'>Helvetica*</option>';
        $output .= '<option value="Calibri, Candara, Segoe, Optima, sans-serif"'. $font09 .'>Calibri*</option>';
        $output .= '<option value="&quot;Myriad Pro&quot;, Myriad, sans-serif"'. $font10 .'>Myriad Pro*</option>';
        $output .= '<option value="&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, &quot;Lucida Sans&quot;, sans-serif"'. $font11 .'>Lucida</option>';
        $output .= '<option value="&quot;Arial Black&quot;, sans-serif" '. $font12 .'>Arial Black</option>';
        $output .= '<option value="&quot;Gill Sans&quot;, &quot;Gill Sans MT&quot;, Calibri, sans-serif" '. $font13 .'>Gill Sans*</option>';
        $output .= '<option value="Geneva, Tahoma, Verdana, sans-serif" '. $font14 .'>Geneva*</option>';
        $output .= '<option value="Impact, Charcoal, sans-serif" '. $font15 .'>Impact</option>';
        $output .= '<option value="Courier, &quot;Courier New&quot;, monospace" '. $font16 .'>Courier</option>';
        $output .= '<option value="&quot;Century Gothic&quot;, sans-serif" '. $font17 .'>Century Gothic</option>';

        // Google webfonts
        global $google_fonts;

        sort( $google_fonts );

        $output .= '<optgroup label="Google Fonts">';
            foreach ( $google_fonts as $key => $gfont ) :
                $font[$key] = '';
                if ( $val == $gfont['name'] ) { $font[$key] = 'selected="selected"'; }
                $name = $gfont['name'];
                $output .= '<option value="'.esc_attr( $name ).'" '. $font[$key] .'>'.esc_html( $name ).'</option>';

            endforeach;
        $output .= '</optgroup>';

        $output .= '</select>';

        /* Font Weight */
        $val = $stored['style'];
        $thin = ''; $thinitalic = ''; $normal = ''; $italic = ''; $bold = ''; $bolditalic = '';
        if( $val == '300' ) { $thin = 'selected="selected"'; }
        if( $val == '300 italic' ) { $thinitalic = 'selected="selected"'; }
        if( $val == 'normal' ) { $normal = 'selected="selected"'; }
        if( $val == 'italic' ) { $italic = 'selected="selected"'; }
        if( $val == 'bold' ) { $bold = 'selected="selected"'; }
        if( $val == 'bold italic' ) { $bolditalic = 'selected="selected"'; }

        $output .= '<select class="tfuse_option tf_typography_style" name="'. esc_attr( $value['id'].'[]' ) . '" id="'. esc_attr( $value['id'].'_style' ) . '">';
        $output .= '<option value="300" '. $thin .'>Thin</option>';
        $output .= '<option value="300 italic" '. $thinitalic .'>Thin/Italic</option>';
        $output .= '<option value="normal" '. $normal .'>Normal</option>';
        $output .= '<option value="italic" '. $italic .'>Italic</option>';
        $output .= '<option value="bold" '. $bold .'>Bold</option>';
        $output .= '<option value="bold italic" '. $bolditalic .'>Bold/Italic</option>';
        $output .= '</select>';

        $output .= '<input class="tf_color_select tfuse_option tf_typography_color" name="'. esc_attr($opts['id']) .'[]" id="'. esc_attr($opts['id']) .'_color" type="text" value="'. esc_attr($stored['color']) .'" />';

        return $output;
    }
}
