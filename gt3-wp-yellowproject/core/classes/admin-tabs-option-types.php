<?php

/**
* Option
*/
abstract class Option
{
	public $params = array();
	
	protected $template = '<div class="mix-tab-control tab_{$ID}">
		<label for="{$ID}">{$NAME}</label>
		<div class="input">
			{$INPUT}
			<span class="help-block">{$DESC}</span>
		</div>
	</div>';
	
	protected $vars = array(
		'{$ID}',
		'{$NAME}',
		'{$INPUT}',
		'{$DESC}'
	);
	
	protected $defaults = array(
		'id'      => '',
		'name'    => '',
		'desc'    => '',
		'default' => ''
	);
	
	protected $value = '';
	protected $def_value = '';
	
	public function __construct(Array $params)
	{
		$this->params = array_merge($this->defaults, $params);
		
		$as_array = (isset($params['as_array']))?$params['as_array']:FALSE;
		$this->def_value = (isset($params['default']) && !empty($params['default']))?$params['default']:'';
		if ($as_array) {
			$temp_value = get_theme_option($as_array);
			if (isset($temp_value[$params['id']])) {
				$this->value = $temp_value[$params['id']];
			}else{
				$this->value = $def_value;
			}
		}else{
			$this->value = stripslashes(get_theme_option($params['id'], (isset($params['default']) && !empty($params['default']))?$params['default']:''));
		}
	}
	
	public function render(){
		return str_replace($this->vars, array(
			$this->params['id'],
			$this->params['name'],
			$this->render_control(),
			$this->params['desc']
		), $this->template);
	}
	
	abstract protected function render_control();
}


/**
* Checkbox Option
*/
class CheckboxOption extends Option
{
	protected $template = '<div class="mix-tab-control">
		<div class="input">
			<ul class="inputs-list">
				<li>
					<label>
						{$INPUT}
						<span>{$NAME}</span>
					</label>
				</li>
			</ul>
			<span class="help-block">{$DESC}</span>
		</div>
	</div>';
	
	protected function render_control()
	{
		return '<input type="checkbox" name="'.$this->params['id'].'" id="'.$this->params['id'].'" value="1" '.(!empty($this->value)?'checked="checked"':'').' />';
	}
}

/**
* Color Option
*/
class ColorOption extends Option
{
	protected function render_control()
	{
		/*if (empty($this->value)) {
			$this->value = $this->def_value;
		}*/

        if (empty($this->value) && $this->params['not_empty'] == true) {
            $this->value = $this->def_value;
        }

		return '<div class="color_option_admin"><span class="sharp">#</span><input class="medium cpicker textoption type1" maxlength="25" type="text" name="'.$this->params['id'].'" id="'.$this->params['id'].'" '.(!empty($this->value)?'value="'.htmlspecialchars($this->value).'"':'').' /><input disabled="disabled" type="text" class="textoption type1 cpicker_preview" value=""></div>';
	}
}

/**
* Radio Option
*/
class RadioOption extends Option
{
	protected function render_control()
	{
		$control = '';
		foreach ($this->params['options'] as $ind => $val) {
			$control .= '<input type="radio" name="'.$this->params['id'].'" value="'.$ind.'" '.(($this->value == $ind)?'checked="checked"':'').' /> '.htmlspecialchars($val) .'<br />';
		}
		
		return $control;
	}
}


/**
* Sidebar manager
*/
class SidebarManager extends Option
{
	protected function render_control()
	{
        
        $all_sidebars = get_theme_sidebars_for_admin();
        if (!isset($compile)) {$compile = '';}

        $compile .= '
        <div class="add_new_sidebar">
            <span class="caption">Create sidebar:</span> <input type="text" name="create_new_sidebar" class="create_new_sidebar textoption type3" value="">
            <input type="button" name="create_new_sidebar_btn" class="create_new_sidebar_btn button ok_btn" value="create">
        </div>
        <div class="sidebars_list">';
        
        foreach ($all_sidebars as $key => $value) {
            $compile .= '
            <div class="sidebar_item">
                <input type="hidden" name="theme_sidebars[]" value="'.$value.'">
                <span class="sidebar_name visual_style1">'.$value.'</span>
                <input type="button" class="delete_this_sidebar img_button cross" name="delete_this_sidebar" value="X">
            </div>';
        }
        
        $compile .= "</div>";
		
		return $compile;
	}
}


/**
* Font selector
*/
class FontSelector extends Option
{
	protected function render_control()
	{
        if (!isset($compile)) {$compile = '';}

        $compile .= '
        <div class="fonts_list">';

        $compile .= '<select style="width:300px;" class="xlarge bg_hover1 fontselector" name="'.$this->params['id'].'" id="'.$this->params['id'].'">';
        $i=0;
        foreach ($this->params['options'] as $key => $val) {
            if ($i==0) {
                $compile .= '<option value="'.htmlspecialchars($this->def_value).'" '.(($this->value == $this->def_value)?'selected="selected"':'').'>Default</option>';
                global $gt3_themeconfig;
                if ($gt3_themeconfig['custom_fonts'] == true) {
                    if (is_array($gt3_themeconfig['custom_fonts_array'])) {
                        foreach ($gt3_themeconfig['custom_fonts_array'] as $id => $font) {
                            $compile .= '<option data-local-font="true" value="'.htmlspecialchars($font['font_family']).'" '.(($this->value == $font['font_family'])?'selected="selected"':'').'>'.htmlspecialchars($font['font_family']).'</option>';
                        }
                    }
                }
            }
            $compile .= '<option value="'.htmlspecialchars($val).'" '.(($this->value == $val)?'selected="selected"':'').'>'.htmlspecialchars($val).'</option>';
            $i++;
        }
        $compile .= '</select>';

        $compile .= "</div>";
        $compile .= "<div class='font_preview'>The quick brown fox jumps over the lazy dog</div>";
        $compile .= "<div class='clear'></div>";

        return $compile;
	}
}


/**
* Select Option
*/
class SelectOption extends Option
{
	protected function render_control()
	{
		$control = '<select class="xlarge bg_hover1" name="'.$this->params['id'].'" id="'.$this->params['id'].'">';
		foreach ($this->params['options'] as $val => $name) {
			$control .= '<option value="'.htmlspecialchars($val).'" '.(($this->value == $val)?'selected="selected"':'').'>'.htmlspecialchars($name).'</option>';
		}
		$control .= '</select>';
		
		return $control;
	}
}

/**
* Text Option
*/
class TextOption extends Option
{
	protected function render_control()
	{
	
		if (isset($this->params['not_empty']) && (empty($this->value) && $this->params['not_empty'] == true)) {
			$this->value = $this->def_value;
		}

        if (isset($this->params['width']) && strlen($this->params['width'])>0) {
            $wstyle = " width:".$this->params['width']." !important; ";
        }

        if (isset($this->params['textalign']) && strlen($this->params['textalign'])>0) {
            $textalign = " text-align:".$this->params['textalign']." !important; ";
        }

        if (!isset($wstyle)) {
            $wstyle = '';
        }
        if (!isset($textalign)) {
            $textalign = '';
        }
		
		return '<input class="xxlarge textoption type1" type="text" style="'.$wstyle.$textalign.'" name="'.$this->params['id'].'" id="'.$this->params['id'].'" '.(!empty($this->value)?'value="'.htmlspecialchars($this->value).'"':'').' />';
	}
}


/**
* Textarea Option
*/
class TextareaOption extends Option
{
	protected function render_control()
	{
	
		if (isset($this->params['not_empty']) && (empty($this->value) && $this->params['not_empty'] == true)) {
			$this->value = $this->def_value;
		}
	
		return '<textarea class="xxlarge textareaoption type1" name="'.$this->params['id'].'" id="'.$this->params['id'].'" rows="5">'.(!empty($this->value)?htmlspecialchars($this->value):'').'</textarea>';
	}
}

/**
* Upload Option
*/
class UploadOption extends Option
{
	protected function render_control()
	{
		$control = '<input class="textoption type2" name="'. $this->params['id'] .'" id="' . $this->params['id'] .'_upload" type="text" value="'. esc_url($this->value) .'" />';
		
		$control .= '<div class="up_btns"><span class="button btn_upload_image ok_btn but_'. $this->params['id'] .'" id="'. $this->params['id'] .'">Upload Image</span>';
		
		if(!empty($this->value)) {
			$hide = '';
		}else{
			$hide = 'hide';
		}
		
		$control .= '<span class="button btn_reset_image danger_btn '. $hide.'" id="reset_' . $this->params['id'] .'" title="' . $this->params['id'] . '">Remove</span>
</div><div class="clear"></div>';
		if(!empty($this->value)){
			$control .= '<a class="uploaded-image" href="'. esc_url($this->value) . '" target="_blank"><img class="option-image" id="image_'. $this->params['id'].'" src="'.esc_url($this->value).'" alt="" /></a>';
		}
		
		return $control;
	}
}

/**
* Ajax Button Option
*/
class AjaxButtonOption extends Option
{
	protected function render_control()
	{
		return '<script>
			if (typeof window.ajaxButtonData == "undefined") {
				window.ajaxButtonData = {};
			}
			
			window.ajaxButtonData["'. $this->params['id'] .'"] = '. json_encode($this->params['data']) .'
		</script>
		<a class="btn mix_ajax_button button" data-confirm="'. (empty($this->params['confirm'])?0:1) .'" data-id="'. $this->params['id'] .'">'. $this->params['title'] .'</a>
		<img class="ajax_loader_img" style="display: none;" src="'.get_template_directory_uri().'/core/admin/img/ajax_active.gif" alt="active..." />
		<span></span>';
	}
}




/**
 * mainSlider
 */
class homeAudio extends Option
{
    protected function render_control()
    {

        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');


        $homeAudio = get_theme_option("mainSlider");

        $compile = '<h2 style="text-align:center; margin-top:0;">Home page audio</h2>
				<div class="mainPageSliderItem">
				<input type="button" name="addnewslide" class="button ok_btn addnewslide" value="Add new song">
				<ul class="sortable">';

        if (is_array($homeAudio)) {
            foreach ($homeAudio as $key => $item) {

                $compile .= '

				<li slideid="test_'.$key.'">
					<input class="itemorder" type="hidden" name="mainSlider['.$key.'][itemorder]">
					<div class="thisitem">
						<span class="echotitle">'.stripslashes($homeAudio[$key]['mp3']).'</span>
						<span class="deleteThisSlide"></span>
						<span class="editThisSlide"></span>
						<div class="hiddenArea">
						';
                $compile .= '	<div class="fl">MP3</div>
							<div class="fr">
								<input class="itemImage xxlarge textoption type1" type="text" name="mainSlider['.$key.'][mp3]" value="'.$homeAudio[$key]['mp3'].'"><input type="button" name="upload_image" class="audioUpload button" value="Upload">
							</div>
							<div class="fl" style="clear:both;">OGG</div>
							<div class="fr">
								<input class="itemImage xxlarge textoption type1" type="text" name="mainSlider['.$key.'][ogg]" value="'.$homeAudio[$key]['ogg'].'"><input type="button" name="upload_image" class="audioUpload button" value="Upload">
							</div>
						</div>
					</div>
				</li>


				';
            }
        }



        $compile .= '</ul></div>';

        return $compile;
    }
}


?>