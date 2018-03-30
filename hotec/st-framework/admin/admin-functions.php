<?php

class  Smooththemes_tabs_settings{

    var $tabs       = array();
    var $tabs_index = array();
    
    function insert_to_array($index,$value,$input_array ) {
          if (isset($input_array[$index])) {
                $output_array = array($index=>$value);
                foreach($input_array as $k=>$v) {
                  if ($k<$index) {
                    $output_array[$k] = $v;
                  } else {
                    if (isset($output_array[$k]) ) {
                      $output_array[$k+1] = $v;
                    } else {
                      $output_array[$k] = $v;
                    }
                  }
                }
        
          } else {
            $output_array = $input_array;
            $output_array[$index] = $value;
          }
          ksort($output_array);
          return $output_array;
    }
    

    function add_tab($tab_id,$tab_name,$fields=array(),$icon='',$parent=''){
            if(empty($fields)){
                $fields = array();
            }
            $new_tab = array(
                 'tab_id' => $tab_id,
                 'tab_name'=>$tab_name,
                 'icon' =>$icon,
                 'fields'=>$fields,
                 'had_parent'=>0
            );
            
            if(is_array($this->tabs[$tab_id])){
                $this->tabs[$tab_id] = array_merge($this->tabs[$tab_id] , $new_tab);
            }else{
                $this->tabs[$tab_id]=$new_tab;
            }
            
            if($this->tabs[$parent]){
                $this->tabs[$parent]['child'][]= array(
                                            'tab_id' => $tab_id,
                                             'tab_name'=>$tab_name,
                                             'icon' =>$icon
                                        );
                $this->tabs[$tab_id]['had_parent']=1;
            }
            

          return    $this->tabs;
          
    }// add_tab
} // end class : Smooththemes_tabs_settings



class  admin_tabs_display{
    var $code            = '';
    var $name            = ST_SETTINGS_OPTION;
    var $hidden_name_pre ='hidden_'; // hidden name will be $hidden_name_pre.ST_SETTINGS_OPTION
    var $field;
    var $values ;
    var $is_default      = false;
    var $class           ="";
    
    var $units           = array('px'); // '%','pt','em'
    var $style           = array('normal','italic','oblique');
    var $weight          = array('normal','bold');
    var $taxs            = array();
    var $listtaxs        = array();
    
    var $meta_name='';
    var $fonts ;
    
    function __construct($values=array(),$input_name=''){
        if(function_exists('st_google_font_to_options')){
            $this->fonts = array_merge(st_get_normal_fonts(),st_google_font_to_options());
        }
        
        // echo "<br/>".var_dump(st_google_font_to_options())."</br/>";
        
        $this->values = $values;
        if(empty($values)){
            $this->is_default = true;
        }
        if($input_name!=''){
            $this->name = $input_name;
            $this->meta_name = $input_name;
        }
        
    }
    
    // get all Wp taxonomies
    function  taxs(){

           $taxs1 = get_taxonomies( array(
                  'public'   => true,
                  '_builtin' => false 
                 ),'objects');        
             
           $taxs = get_taxonomies( array(
                  'public'   => true,
                  '_builtin' => true 
                ),'objects');   
                
           $taxs = array_merge($taxs,$taxs1);
                
          // echo var_dump($taxs); 
           foreach($taxs as $tax){
            // echo $tax->name."<br/>";
              $elements[$tax->name] = get_categories( array('taxonomy'=>$tax->name,'hide_empty'=>0,'hierarchical'=>1) );
           }
           
         $this->listtaxs = $taxs;  
           
        $this->taxs = $elements;
        
        
    }
    
    // return list task
    function  get_tax($taxonomy = 'category'){
        if(empty($this->taxs)){
            $this->taxs();
        }
        
        return $this->taxs[$taxonomy];     
    }
    
    
    function display_tab_contents($fields=array()){
        $html = '';
    
        foreach($fields as $field){
            $this->display_field($field);
        }
       
    }
    
    
     
    function  display_field($field=array()){
        $this->field =$field;
         
        switch(strtolower($this->field['type'])){
             case 'custom':
             
                $function_name=$this->field['function'];
                 if(function_exists($function_name)){
                     $name =$this->name();
                      $values = $this->values[$this->field['name']];
                      
                      if(empty($values)){
                        $values = $this->field['default'];
                      }
                    
                     
                     echo  '<div class="STpanel-input-box box-function">';
                        echo $this->title();
                        echo '<div class="box-inner">';
                        echo '<div class="pabel-box-function">';
                             call_user_func_array($function_name, array($name, $values));
                        echo '</div>';
                        
                        if($this->field['desc']!=''){
                            echo '<div class="clear"></div>';
                            echo '<div class="STpanel-box-desc-bottom">'.$this->field['desc'].'</div>';
                            echo '<div class="clear"></div>';
                        }
                        echo '</div><!--/box-inner -->';
                        echo '</div><!-- STpanel-input-box -->'."\n";
                     
                     
                     
                 }
                

             break;  
             case 'textarea':
                 $this->textarea();  
             break;  
             case 'editor':
                $this->editor();
              break; 
              case 'upload':
                $this->upload();
              break; 
              case 'select':
                $this->select();
              break; 
               case 'checkbox':
                $this->checkbox();
              break; 
               case 'radio':
                $this->radio();
              break;
               case 'layout':
                $this->layout();
              break; 
              case 'color':
                $this->color();
              break; 
              case 'style':
                $this->style();
              break;
              case 'tax':
                $this->tax();
              break; 
              case 'post':
                $this->post();
              break; 
              case 'combotax':
                $this->combotax();
              break;
              case 'heading':
                $this->heading();
              break;
              case 'gallery':
               $this->gallery();
               break;
               
               case 'ui':
                $this->ui();
               break;
               
              default:
                 $this->text();    
        }
       
    }
    

    
    /**
     * Tạo giá trị mặc định cho input ,...
     * type = 3 stripslashes 0= htmlspecialchars
     * @return
    */
    function  value($html_encode_type=0,$default=false){
        
       if($this->is_default){
            if(!$default){
                $value = $this->field['default'];
            }else{
                $value = $default;
            }
            
        }else{
            $value = $this->values[$this->field['name']];
        }
        
        if($html_encode_type==3){
             return  stripslashes(strval($value));
        }else{
             
             return  htmlspecialchars(stripslashes(strval($value)));
        }
       
    }
    
    
    
    /**
     * Create Box  title with current field
    */

    function title(){
        return '<h2 class="STpanel-box-title">'.htmlspecialchars($this->field['title']).'</h2>';
    }
    
    function heading(){
         echo '<div class="ST-heading">'.$this->title().'</div>';
    }
    
    function  box_content_inner($input){
       echo '<div class="box-inner">';
       if($this->field['desc']!=''){
             echo  '<div class="STpanel-box-inner STpanel-box-'.$this->field['type'].' STpanel-box-inner-width-descs STpanel-box-'.$this->field['type'].'-width-descs">'.$input.'</div>';
             echo  '<div class="STpanel-box-desc">'.$this->field['desc'].'</div>';
              echo '<div class="clear"></div>';
        }else{
             echo '<div class="STpanel-box-inner STpanel-box-'.$this->field['type'].' STpanel-box-'.$this->field['type'].'-no-descs">'.$input.'</div>';
        }
        
         if($this->field['desc_bottom']!=''){
             echo  '<div class="STpanel-box-desc-bottom">'.$this->field['desc_bottom'].'</div>';
         }
        echo '</div><!--/box-innner-->';
    }
    
    
    /**
     * Create input name with current field
    */
    function name($name=''){
        if(trim($name)!=''){
            $name =  trim($name);
        }else{
            $name =  $this->field['name'];
        }
        //return $this->name.'['.$name.']';
        return $this->name.'_'.$name;
    }
    
    
    function text(){
        echo  '<div class="STpanel-input-box box-text">';
         echo  $this->title();
          
         $input = '<input type="text" class="bp-input-text" value="'.$this->value().'" name="'.$this->name().'"/>';
         $this->box_content_inner($input);
         $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
        
       
    }
     
    function textarea(){
        echo  '<div class="STpanel-input-box box-textarea">';
        
        echo $this->title();
         
        $input = '<textarea  class="bp-textarea" name="'.$this->name().'">'.$this->value().'</textarea>';
        $this->box_content_inner($input);
         $this->usage();
        echo '</div><!-- STpanel-input-box -->'."\n";
        
        
    }
    
    /**
     *  array(
            'name'=>'name3',
            'title'=>'editor name title',
            'type' =>'editor',
            'default'=>'<strong>default value</strong>',
            'desc'=>'input descriptions',
            'desc_bottom'=>'input descriptions desc_bottom'
         )
     * 
     */ 
    function editor(){
        
        echo  '<div class="STpanel-input-box box-editor">';
        echo $this->title();
        
        echo '<div class="box-inner">';
        echo '<div class="pabel-box-editor">';
        the_editor($this->value(3),$this->name());
        
        echo '</div>';
        
        if($this->field['desc']!=''){
            echo '<div class="clear"></div>';
            echo '<div class="STpanel-box-desc-bottom">'.$this->field['desc'].'</div>';
            echo '<div class="clear"></div>';
        }
        
      
        echo '</div><!--/box-inner -->';
           $this->usage();
        echo '</div><!-- STpanel-input-box -->'."\n";
        
    }
    
    /**
    *
    * array(
            'name'=>'name33',
            'title'=>'upload name title',
            'type' =>'upload',
            'value_type'=>'text|id'
            'default'=>'default value',
            'desc'=>'input descriptions',
            'desc_bottom'=>'input descriptions desc_bottom'
         ),
         
    */
    function upload(){
        echo  '<div class="STpanel-input-box box-upload">';
         echo  $this->title();
          
         $image = $this->value();
         $image_src = $image_full_src = $image;
         $input_type ='text';
          if(strtolower($this->field['value_type'])=='id'){
            $input_type ='hidden';
            
               
         }
         
         if(is_numeric($image)){
                $image_attributes = wp_get_attachment_image_src( $image ,'medium' ); // returns an array
                $image_src  = $image_attributes[0];
                $image_attributes_full = wp_get_attachment_image_src( $image ,'full' ); // returns an array
                $image_full_src = $image_attributes_full[0];
         }
         
         
         
         
         $id = 'uid-'.uniqid();
         $input = '<input type="'.$input_type.'" value="'.$image.'" id="'.$id.'" class="bp-input-upload" name="'.$this->name().'"/>
         <input class="bp-upload-button button-secondary" for-id="'.$id.'" data-type="'.$input_type.'" type="button" value="'.__('Select Image','smooththemes').'" />';
         $input.='<div style="clear:both"></div>';
         $input.='<div class="STpanel-image-preview" id="preview-'.$id.'" >';
             $input.=(($image!='') ? '<a class="viewfull-image" title="View full image" href="'.$image_full_src.'" target="_blank"><img src="'.$image_src.'" alt=""/></a>' : '' );
            // $input .= (($image!='') ? ''.__('View full image','smooththemes').'</a>' : '');
          $input .='</div>';
          $input.='<a href="#" class="remove_image button-secondary">'.__('Remove','smooththemes').'</a>';
         
         $this->box_content_inner($input);
            $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
        
       
    }
    
    function  options_selected($option_value){
        $code ='';
        if($this->is_default){
            $values = $this->field['default'];
        }else{
            $values = $this->values[$this->field['name']];
           // echo var_dump($values).'<br/>';
        }
        
        if($values==''){
             $values = $this->field['default'];
        }
        
        
        
        if(is_array($values)){
            if(in_array($option_value,$values)){
                $code =' selected="selected" ';
            }
        }else{
            if($option_value==$values){
                  $code = ' selected="selected" ';
            }
        }
        
        return $code;
    }
    
    
    function select(){
        echo  '<div class="STpanel-input-box box-select">';
        echo  $this->title();
        $name =$this->name();
         
        if($this->field['multiple']){
            $input = '<select class="bp-input-select select-multiple chzn-select" multiple="multiple" name="'.$name.'[]">';
        }else{
            $input = '<select class="chzn-select bp-input-select" name="'.$name.'">';
            $input .='<option value="">'.__('Select','smooththemes').'</option>';
            
        }      
         if(!empty($this->field['options'])){
            
            foreach($this->field['options'] as $k =>$o){
                $input.='<option value="'.htmlspecialchars($k).'"'.$this->options_selected($k).'>'.htmlspecialchars($o).'</option>';
            }
             
         }
         
         $input.='</select>';
         $this->box_content_inner($input);
            $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
        
       
    }
    
    /**
     * $name  name of check box
     * $value  value of check box
     */ 
    function  checkbox_checked($name,$key,$value='',$default = false){
        $code ='';
        if($this->is_default){
            if($default==true){  
                $value = $value;
                $code =' checked="checked" ';
            }
            
        }elseif($this->values[$name][$key]!=''){
           //  echo $value.'---'.$this->values[$name]."<br/>";
            
            if($value == $this->values[$name][$key]){
                $code =' checked="checked" ';
             
            }
        }
        return $code;
    }
    
    
    /**
     * array(
            
            'title'=>'Check box title',
            'type' =>'checkbox',
            'name'=>'checkbox',
            'list'=>array(
                
                array('key'=> 'checkbox_name1',  'value'=>'value1' , 'label'=> 'text for checkbox 1', 'default'=>true),
                array('key'=> 'checkbox_name2',  'value'=>'value2' , 'label'=> 'text for checkbox 2'),
                array('key'=> 'checkbox_name3',  'value'=>'value3' , 'label'=> 'text for checkbox 3'),
                array('key'=> 'checkbox_name4',  'value'=>'value4' , 'label'=> 'text for checkbox 4') 
           
            ),
            
            
            'desc'=>'input descriptions',
            'desc_bottom'=>'input descriptions desc_bottom'
         )
     */ 
    function checkbox(){
         echo  '<div class="STpanel-input-box box-checkbox">';
         echo  $this->title();
          $name =  $this->field['name'];
         $input ='';
          foreach($this->field['list'] as $k=> $f){
             $input.='<div class="STpanel-checkbox-div-item">';
             $input.='<label><input value="'.htmlspecialchars($f['value']).'" class="STpanel-checkbox-input" type="checkbox" '.$this->checkbox_checked($name,$f['key'],$f['value'],$f['default']).' name="'.$this->name().'['.$f['key'].']" />'.$f['label'].'</label>';
             $input.='</div>';
          }
         
          $this->box_content_inner($input);
          $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
    }
    
    
    
    /**
     * $name  name of check box
     * $value  value of check box
     */ 
    function  radio_checked($value=''){
        $code =null;
        $this->class='';
        if($this->is_default){
            $cvalue = $this->field['default']; 
        }else{
           $cvalue = $this->values[$this->field['name']];     
        }
        
        if( $cvalue ==''){
            $cvalue = $this->field['default']; 
        }
        
        if($value==$cvalue){
            $code = ' checked="checked" ';
        }
        
        
        return $code;
    }
    
    
    /**
     *  array(
            'name'=>'radio',
            'title'=>'radio name title',
            'type' =>'radio',
            'multiple'=> false,
            
            'options'=>array(
                'key1'=> 'text for key 1', // 'value'=>'label'
                'key2'=> 'text for key 2',
                'key3'=> 'text for key 3',
                'key4'=> 'text for key 4' 
            ),
            
            'default'=>'key1',
            'desc'=>'input descriptions',
            'desc_bottom'=>'input descriptions desc_bottom'
         )
     * 
     */ 
    
    function radio(){
         echo  '<div class="STpanel-input-box box-radio">';
         echo  $this->title();
          // $this->usage();
         $input = '';
            
         foreach($this->field['options'] as $k => $label){
           $input.='<div class="STpanel-radio-div-item">';
             $input.='<label class="layout-radio"><input value="'.htmlspecialchars($k).'" class="STpanel-radio-input" type="radio" '.$this->radio_checked($k).' name="'.$this->name().'" />'.$label.'</label>';
             $input.='</div>';
         }
        
         $this->box_content_inner($input);
            $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
        
       
    }
    /**
     * 
     * array(
            'name'=>'layout',
            'title'=>'layout name title',
            'type' =>'layout',
            'multiple'=> false,
            
            'options'=>array(
                'key1'=> ST_ADMIN_URL.'images/layout/1.png', // value =>image layout
                'key2'=> ST_ADMIN_URL.'images/layout/2.png',
                'key3'=> ST_ADMIN_URL.'images/layout/3.png',
                'key4'=> ST_ADMIN_URL.'images/layout/4.png',
            ),
            
            'default'=>'key3',
            'desc'=>'input descriptions',
            'desc_bottom'=>'input descriptions desc_bottom'
         )
     * 
     */ 
    
    function layout(){
         echo  '<div class="STpanel-input-box box-layout">';
         echo  $this->title();
         
         $input = '';
         $img_attr ='';
         
         if($this->field['size']!=''){
             $img_attr = '  width="'.$this->field['size'].'px" height="'.$this->field['size'].'px" ';
         }
        
         foreach($this->field['options'] as $k => $image){
             $check=$this->radio_checked($k);
             $class="";
             if($check!=''){
                $class="checked";
             }
             
             $input.='<div class="STpanel-layout-div-item">';
             $input.='<label class="layout-label '.(($class!='') ? 'layout-label-'.$class : '' ).'"><input value="'.htmlspecialchars($k).'" class="STpanel-radio-input '.$class.'" type="radio" '.$check.' name="'.$this->name().'" /><img '.$img_attr.' src="'.$image.'" alt =""/></label>';
             $input.='</div>';
         }
         
         
        $input .='<div class="clear"></div>';
         $this->box_content_inner($input);
            $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
    }
    /**
     * 
     * array(
            'name'=>'color',
            'title'=>'color name title',
            'type' =>'color',
            'default'=>'000000',
            'desc'=>'color descriptions',
            'desc_bottom'=>'color descriptions desc bottom'
         )
     * 
     */ 
    function color(){
         echo  '<div class="STpanel-input-box box-color">';
         echo  $this->title();
         
         $value =  $this->value();
         $value = str_replace('#','',$value);
          
         $input = '<div class="colorSelector-wrap"> <div class="colorSelector"><div style="background-color: #'.$value.'"></div></div>';
        
         $input .= '<label><input class="colorSelector-input" name="'.$this->name().'" maxlength="6" size="6" value="'.$value.'" /></label>';
        
         $input.='</div><div class="clear"></div>';
         $this->box_content_inner($input);
            $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
    }
    
    /**
     * array(
            'name'=>'style',
            'title'=>'style name title',
            'type' =>'style',
            'options'=>array(
                'font-family'=>'Arial',
                'color'=>'000000',
                'font-weight' =>'normal',
                'font-style'=>'nomal',
                'line-height'=>'18', // unit px
                'line-height-unit'=>'px',
                'font-size'=>'12',
                'font-size-unit'=>'px',
                'letter-spacing'=>'12',
                'letter-spacing-uni'=>'px'
                
            ),
            'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
         
          //  'desc'=>'color descriptions',
            'desc_bottom'=>'color descriptions desc bottom'
         )
     * 
     */ 
    
    function  style(){
         echo  '<div class="STpanel-input-box box-style">';
         echo  $this->title();
        
         $name =$this->name();
         // echo var_dump($this->values[$this->field['name']])."<br/>";
         
         $values = wp_parse_args( $this->values[$this->field['name']],$this->field['options']);
         
         $current_support = array('font_size','line_height','font_family','color','font_style','font_weight');
         
         $support = $this->field['support'];
         
         if(!isset($support) ||  empty($support)){
            $support= $current_support;
         }
         
         if(!is_array($support)){
            $support =  (array) $support;
         }
         
         foreach($support as  $v){
            if(in_array($v,$current_support)){
                ${'support_'.$v} = true;
            }else{
                ${'support_'.$v} = false;
            }
             
         }
         
         if($support_font_size){
         $input='
         <div class="font-size js-slider-wrap">
             <div class="font-text">Font size: </div>
             <div class="font-size-slide">
                 <div class="js-s-g js-slider"></div>
            </div>
            <div class="font-slide-value">
                 <span class="amount">'.$values['font-size'].'</span>
                 <input type="hidden" value="'.$values['font-size'].'" class="font-size hidden-amount"  name="'.$name.'[font-size]" />
                 <span class="unit">
                   Px <input type="hidden" value="px" class="font-size-unit style-unit"  name="'.$name.'[font-size-unit]" />
                ';
              $input .='   
                 </span>
             </div>
             <div class="clear"></div>
         </div><!-- js-slider-wrap -->'; 
         }
         
         // for line height
         if($support_line_height){
           $input .='
         <div class="line-size js-slider-wrap">
            <div class="font-text">Line Height: </div>
            <div class="font-size-slide">
                 <div class="js-s-g  js-slider"></div>
            </div>
            <div class="font-slide-value">
                <span class="amount">'.$values['line-height'].'</span>
                 <input type="hidden" value="'.$values['line-height'].'" class="line-height hidden-amount"  name="'.$name.'[line-height]" />
                 <span class="unit">
                    Px <input type="hidden" value="px" class="line-height-unit style-unit"  name="'.$name.'[line-height-unit]" />
                </span>
            </div>
            <div class="clear"></div>
         </div>';
         }
         
         // color 
        $input .='<div class="style-inline">';
         if($support_color){
       
         $input .= '
           <div class="colorSelector-txt"> 
                    <label>'.__('Color','smooththemes').'</label>
                    <div class="colorSelector"><div style="background-color: #'.$values['color'].'"></div></div>
                    <input class="font-color" name="'.$name.'[color]" maxlength="6" size="6" value="'.$values['color'].'" />
        
           </div>';
           }
         
        // for google font
        if($support_font_family){
         $input .='<label>'.__('Font family','smooththemes').'</label>
         <select class="font-family chzn-select" name="'.$name.'[font-family]">';
         foreach($this->fonts as $font_name => $font_url){
             
              $font_value =  ($font_url!='') ? $font_url :  $font_name;
            
               $slected ='';
                if($values['font-family']==$font_url || $values['font-family']== $font_value){
                    $slected =' selected ="selected" ';
                }
                
               
             
            $input.='<option '.$slected.' url="'.esc_attr($font_url).'" value="'.esc_attr($font_value).'">'.esc_html($font_name).'</option>';
         }
         $input.='</select>';
         }
         
         // for font style 
         if($support_font_style){
         $input .='<label>'.__('Font style','smooththemes').'</label>';
         $input.='<select class="font-style chzn-select" name="'.$name.'[font-style]">';
         foreach($this->style as $s){
             $slected ='';
                if($values['font-style']==$s){
                    $slected =' selected ="selected" ';
                }
            $input.='<option '.$slected.' value="'.$s.'"  style="font-style: '.$s.';">'.$s.'</option>';
            
         }
         $input.='</select>';
         }
         
         
         // for font Wieght 
         if($support_font_weight){
              $input .='<label>'.__('Font weight','smooththemes').'</label>';
              $input.='<select class="font-weight chzn-select" name="'.$name.'[font-weight]">';
             foreach($this->weight as $s){
                 $slected ='';
                    if($values['font-weight']==$s){
                        $slected =' selected ="selected" ';
                    }
                $input.='<option  '.$slected.'  value="'.$s.'"  style="font-weight: '.$s.';">'.$s.'</option>';
             }
             
             $input.='</select>';
         }
         
         $input .='<div class="clear"></div>';
         $input.='</div><!-- style-inline -->';
         
         if($support_font_family){
             $input.='<h3 class="smtitle">'.__('Font Preview','smooththemes').'</h3>';
             $input .='<div class="previewtxt">'.$this->field['previetxt'].'</div>';
         }
         
         $input.='<div class="clear"></div>';
         
         $this->box_content_inner($input);
         $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
        
    }
    
    
    
    /**
     * array(
            'name'=>'tax',
            'title'=>'tax name title',
            'type' =>'tax',
            'tax' =>'catrgory', // default category
            'multiple'=> false,
            'default'=>3,
            'desc'=>'input descriptions',
            'desc_bottom'=>'input descriptions desc_bottom'
         ),
     * 
     */ 
    
    function tax(){
         echo  '<div class="STpanel-input-box box-select">';
         echo  $this->title();
         $name =$this->name();
         
        if($this->field['multiple']){
             $input = '<select class="bp-input-select select-multiple chzn-select" multiple="multiple" name="'.$name.'[]">';
        }else{
              $input = '<select class="bp-input-select chzn-select" name="'.$name.'">';
              $input .='<option value="">'.__('Select','smooththemes').'</option>';
        }

        $tax = $this->field['tax'];
        if(empty($tax)){
            $tax ='category';
        }
        $options = $this->get_tax($tax);
        // echo var_dump($options);
         if(!empty($options)){
            foreach( $options as $k =>$o){
                $input.='<option value="'.htmlspecialchars($o->term_id).'"'.$this->options_selected($o->term_id).'>'.htmlspecialchars($o->name).'</option>';
            }
         }
         $input.='</select>';
         $this->box_content_inner($input);
         $this->usage();
         echo  '</div><!-- STpanel-input-box -->'."\n";
    }
    
    
    /**
     * array(
            'name'=>'combotax',
            'title'=>'combotax  name title',
            'type' =>'combotax',
            'default'=>3,
            'desc'=>'input descriptions',
            'desc_bottom'=>'input descriptions desc_bottom'
         ),
         use function  get_term_link( $term, $taxonomy );
     */ 
    function combotax(){
         echo  '<div class="STpanel-input-box box-combotax">';
         echo  $this->title();
         $name =$this->name();
          
         $input ='';
         
         $input.='<select class="tax" name="'.$name.'[tax]">';
         foreach($this->listtaxs as $tax){
                 $slected ='';
                    if(1==$t){
                        //$slected =' selected ="selected" ';
                    }
                $input.='<option '.$slected.' value="'.$tax->name.'"  >'.stripslashes($tax->label).'</option>';
                      
            
         }
         
         $input.='</select><!-- tax -->';
         
         
         $input.='<select class="slug" name="'.$name.'[slug]">';
         foreach($this->taxs as $taxtype){
            
            if(!empty($taxtype)){
                foreach($taxtype as $t){

                 $slected ='';
                    if(1==$t){
                        //$slected =' selected ="selected" ';
                    }
                $input.='<option '.$slected.' value="'.$t->slug.'"  >'.stripslashes($t->name).'</option>';
                  }    
            }
         }
         
         $input.='</select>';
         
         
        $this->box_content_inner($input);
        $this->usage();
        echo  '</div><!-- STpanel-input-box -->'."\n";
    }

    function  post(){
        
        $posts = get_posts(array(
            'numberposts'     => 5,
            'offset'          => 0,
            'category'        => '',
            'orderby'         => 'post_date',
            'order'           => 'DESC',
            'include'         => '',
            'exclude'         => '',
            'meta_key'        => '',
            'meta_value'      => '',
            'post_type'       => $this->field['post_type'],
            'post_mime_type'  => '',
            'post_parent'     => '',
            'post_status'     => 'publish' ));
            // echo var_dump($posts);
            
            
             echo  '<div class="STpanel-input-box box-post">';
             echo  $this->title();
             $name =$this->name();
            
            if($this->field['multiple']){
                 $input = '<select class="bp-input-select select-multiple chzn-select" multiple="multiple" name="'.$name.'[]">';
            }else{
                  $input = '<select class="bp-input-select chzn-select" name="'.$name.'">';
                  $input .='<option value="">'.__('Select','smooththemes').'</option>';
            }
    
          
            // echo var_dump($options);
             if(!empty($posts)){
                foreach( $posts as $k =>$p){
                    $input.='<option value="'.htmlspecialchars($p->ID).'"'.$this->options_selected($p->ID).'>'.apply_filters('the_title',$p->post_title).'</option>';
                }
             }
             $input.='</select>';
             $this->box_content_inner($input);
                $this->usage();
             echo  '</div><!-- STpanel-input-box -->'."\n";
            
        
    }
    
    /**
     *  array(
            'name'=>'gallery',
            'title'=>'Gallery',
            'type' =>'gallery',
            'default'=>'default value',
            'image'=>array(1,2,3,4) // ids of media image
         )
     * 
     */ 
    
    function gallery(){
        global $post, $pagenow;
        echo  '<div class="STpanel-input-box  box-text">';
         echo  $this->title();
        $name =$this->name();
        $values = $this->values[$this->field['name']];
        
          $mata_name= $name.'[meta]';
          $uniqid= 'g-'.uniqid();
          
          
          ?>
          
          
          <div class="box-inner st-gallery" id="<?php echo $uniqid; ?>">
          <input class="gallery-name"  type="hidden" value="<?php echo $name.'[images][]'; ?>" />
          <input class="gallery-meta-name"  type="hidden" value="<?php echo $mata_name; ?>" />
          <div class="st-gallery-editct" style="display: none;" id="<?php echo 'modal-'.$uniqid; ?>">
             <div class="st-meta media-item">
                 <input type="hidden" class="for-img-index" value=""/>
                 <input type="hidden" class="galleryid" value="<?php echo $uniqid; ?>" />
                 
                  <table class="slidetoggle ">
                    <tr class="post_title form-required">
            			<th valign="top" class="label" scope="row">
                            <label><span class="alignleft">Title</span></label>
                        </th>
            			<td class="field">
                            <input type="text" class="stn-title" value="" >
                        </td>
            		</tr>
                    
                    <tr class="post_title form-required">
            			<th valign="top" class="label" scope="row">
                            <label><span class="alignleft">Caption</span></label>
                        </th>
            			<td class="field">
                            <textarea class="stn-caption"></textarea>
                        </td>
            		</tr>
                    
                     <tr class="post_title form-required">
            			<th valign="top" class="label" scope="row">
                            <label><span class="alignleft">URL</span></label>
                        
                        </th>
            			<td class="field">
                            <input type="text" class="stn-url" value=""><br />
                            <small>Example: http://goole.com</small>
                        </td>
            		</tr>
                    
                    
                  </table>
                 
                  <button class="button-primary g-save-meta">Save</button>
                  <button class="button-secondary close"  onclick="st_close_lightbox(); return false;">Close</button>
              </div>
          </div><!-- st-gallery-editct -->
          
          <div class="st-iws">
          <ul class="st-img-items images sortable">
           <?php 
           if(empty($values['images'])){
            $values['images'] = array();
           }
           foreach($values['images'] as $k => $img): 
           
           	$attachment=wp_get_attachment_image_src($img, 'st-thumb');
            
            $meta=  $values['meta'][$k];
            
           ?>
            <li>
                <div class="imw">
                    <input type="hidden" name="<?php echo $name.'[images][]'; ?>" value="<?php echo $img; ?>" />
                    <img class="imgid"  src="<?php echo $attachment[0]; ?>"  width="<?php echo $attachment[1]; ?>" height="<?php echo $attachment[2]; ?>" />
                     <a href="#" class="st_edit st_img_tbtn">Edit</a>
                     <a href="#" class="st_delete st_img_tbtn">Del</a>
                     <input type="hidden" class="gtitle" value="<?php echo esc_html($meta['title']); ?>" />
                     <input type="hidden" class="gcaption" value="<?php echo htmlspecialchars($meta['caption']); ?>" />
                     <input type="hidden" class="gurl" value="<?php echo esc_html($meta['url']); ?>" />
                </div>
            </li>
           <?php endforeach; ?> 
            
          </ul>
          <div class="clear"></div>
          </div>
          
          
         <div class="clear"></div>
         <div class="btn-actions">
            <a href="#" class="add_more_image">Add image</a> |  <a href="#" class="close_ajax_images">Close</a>
            
            <div class="clear"></div>
         </div>
         <div class="ajax-media-cont"></div>
         <div class="clear"></div>
         </div><!--box-inner-->
          <?php
          if($this->field['more_actions']!==false and  $this->field['more_actions']!==0){
             do_action('st_option_gallery_settings',$name,$values,$this);
          }
         
          $this->usage();
         echo  '</div><!-- STpanel-gallery-box -->'."\n";
        
       
    }// e dn function glarry
    
    function usage(){
        
        return  false; // dont show
        
         global $post;
          //for post
           $sname = $this->field['type'];
          
            if(intval($post->ID)>0){
                 $key = $this->meta_name.'|'.$this->field['name'];
                 $short_code = "[st-post-meta type=\"{$sname}\" key=\"$key\" id=\"$post->ID\"]";
                 $php_code = '<?php st_get_post_meta('.$post->ID.',"'. $this->meta_name.'","'.$this->field['name'].'"); ?>';
            }else{
                 $short_code = "[st-setting type=\"{$sname}\" key=\"{$this->field['name']}\"]";
                 $php_code = '<?php st_get_setting("'.$this->field['name'].'"); ?>';
            }
          
          ?>
          <div class="usage">
             <div><?php _e('PHP get data','smooththemes'); ?>: <code><?php echo htmlspecialchars($php_code); ?></code></div>
          </div>
          <?php
    }
    
    
    
    /**
     * array(
            'name'=>'unlimit2',
            'title'=>'Unlimit2',
            'type' =>'ui', // tabs, arcodition
            'default'=>array(),
            'desc'=>'',
            'support' =>array()  // default all support
            'desc_bottom'=>''
         )
     */ 
        function ui(){

        global $post, $pagenow;
        echo  '<div class="STpanel-input-box  box-text">';
        echo  $this->title();
        $name =$this->name();
        $values = $this->values[$this->field['name']];
        
        $mata_name= $name.'[meta]';
        $uniqid= 'ui-'.uniqid();
        
        $supports = array('image','content','id' , 'url');
        
       if(!is_array($this->field['support']) or empty($this->field['support'])){
             $this->field['support'] = $supports;
       }else{
            $this->field['support'][] = 'title';
       }
       
       $supports[] ='hook';
       
       foreach($this->field['support'] as $k => $v){
            if(in_array($v,$supports)){
                $current_support[$v] = true;
            }else{
                 $current_support[$v] = false;
            }
       }
       
       $hooks = isset($this->field['hooks']) ?  $this->field['hooks'] : array() ;// array('st_before_sidebar','st_atter_sidebar','st_before_layout', 'st_before_the_content', 'st_after_the_content');
       if(!is_array($hooks)){
            $hooks = (array) $hooks;
       }
          ?>
          <div class="box-inner st-ui" id="<?php echo $uniqid; ?>">
             <input type="hidden" class="st-ui-name" value="<?php echo $name; ?>" />
            <ul class="sortable st-ui-list">
                <?php 
                
                 $n = count($values);
                 for($i=0; $i<$n; $i++){
                    $v =  $values[$i];
                 
                ?>
            
                <li>
                        <div class="st-widget widget closed">	
                        <div title="Click to toggle" class="ui-handlediv"><br></div>
                         <a href="#" class="remove stwrmt button-secondary"><?php _e('Remove','smooththemes'); ?></a>
                        <h3 class="st-hndle "><?php _e('Title:','smooththemes'); ?> <span><?php echo esc_html($v['title']); ?></span>
                            
                        </h3>
                        
                    	<div class="inside">
                    
                        	<div class="widget-content">
                                 <?php // echo var_dump($v); ?>
                        		<p>
                                <label ><?php _e('Title:','smooththemes'); ?></label>
                        		<input type="text" value="<?php echo esc_attr(stripslashes($v['title'])); ?>" name="<?php echo $name."[$i][title]" ?>" class="ui-title" >
                                </p>
                                
                                <?php if($current_support['hook']): ?>
                                 <p><label ><?php _e('Apply to hook','smooththemes'); ?></label>
                                    <select name="<?php echo $name."[$i][hook]" ?>" class="ui-hook">
                                      <option value=""><?php _e('Select','smooththemes'); ?></option>
                                        <?php 
                                        foreach($hooks as $h): 
                                         $selected='';
                                         if($h==$v['hook']){
                                            $selected=' selected="selected" ';
                                         }
                                        ?>
                                        <option  value="<?php echo esc_attr($h); ?>" <?php echo $selected; ?> ><?php echo esc_html($h); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                        		 </p>
                                 <?php endif; ?>
                                
                                <?php if($current_support['image']): ?>
                                <div class="STpanel-box-upload ui-img-w"><label >Image:</label>
                            		<input type="text" value="<?php echo esc_attr($v['img']); ?>" name="<?php echo $name."[$i][img]" ?>" class="ui-img bp-input-upload" >
                                    <input class="bp-upload-button button-secondary" type="button" value="<?php echo __('Select Image','smooththemes'); ?>" />
                                    <a href="#" class="remove_image button-secondary"><?php echo __('Remove','smooththemes'); ?></a>
                                    <div class="clear"></div>
                                </div>
                                <?php endif; ?>
                                
                                 <?php if($current_support['url']): ?>
                                 <p><label >url:</label>
                        		 <input type="text" value="<?php echo esc_attr(stripslashes($v['url'])); ?>" class="ui-url" ></p>
                                 <?php endif; ?>
                                
                                <?php if($current_support['content']): ?>
                        		<textarea  rows="10" name="<?php echo $name."[$i][content]" ?>"  class="ui-cont" ><?php echo esc_attr(stripslashes($v['content'])); ?></textarea>
                                <p><label ><input type="checkbox" name="<?php echo $name."[$i][autop]" ?>" <?php echo ($v['autop']==1) ? 'checked="checked"' : ''; ?> class="ui-autop" value="1" />&nbsp;<?php _e('Automatically add paragraphs','smooththemes'); ?></label></p>
                        	    <div class="widget-description"><?php  _e('Arbitrary text or HTML','smooththemes'); ?></div>
                                <?php endif; ?>
                                
                                <?php if($current_support['id']): ?>
                                 <input type="hidden" class="ui-autoid" name="<?php echo $name."[$i][id]" ?>" value="<?php echo esc_attr($v['id']); ?>" />
                                <?php endif; ?>
                            
                            </div>
                    
                        	<div class="widget-control-actions">
                        		<div class="alignleft">
                            		<a href="#remove" class="remove"><?php _e('Delete','smooththemes'); ?></a> |
                            		<a href="#close" class="close"><?php _e('Close','smooththemes'); ?></a>
                        		</div>
                        		<br class="clear" />
                        	</div>
                    	
                    	</div>
                        
                       	
                        </div>
                
                </li>
                <?php }// ?>
              </ul>  
                
                
                <div class="ui-temp-code" style="display: none;">
          
                        <div class="st-widget widget closed">	
                        <div title="Click to toggle" class="ui-handlediv"><br></div>
                        <a href="#" class="remove stwrmt button-secondary"><?php _e('Remove','smooththemes') ?></a>
                        <h3 class="st-hndle"><?php _e('Title:','smooththemes'); ?><span></span>
                        
                        </h3>
                        
                    	<div class="inside">
                    
                        	<div class="widget-content">
                        		<p><label ><?php _e('Title:','smooththemes'); ?></label>
                        		<input type="text" value="" class="ui-title"  class="widefat">
                                </p>
                                
                                
                                <?php if($current_support['hook']): ?>
                                 <p><label ><?php _e('Apply to hook','smooththemes'); ?></label>
                                    <select name="" class="ui-hook">
                                        <?php  foreach($hooks as $h):  ?>
                                        <option  value="<?php echo esc_attr($h); ?>"  ><?php echo esc_html($h); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                        		 </p>
                                 <?php endif; ?>
                                
                                  <?php if($current_support['image']): ?>
                                <div class="STpanel-box-upload ui-img-w"><label ><?php _e('Image:','smooththemes'); ?></label>
                            		<input type="text" value="" name="" class="ui-img bp-input-upload" >
                                    <input class="bp-upload-button button-secondary" type="button" value="<?php echo __('Select Image','smooththemes'); ?>" />
                                    <a href="#" class="remove_image button-secondary"><?php echo __('Remove','smooththemes'); ?></a>
                                    <div class="clear"></div>
                                </div>
                                 <?php endif; ?>
                                 
                                 <?php if($current_support['url']): ?>
                                 <p><label ><?php _e('url:','smooththemes'); ?></label>
                        		<input type="text" value="" class="ui-url"  class="widefat"></p>
                                 <?php endif; ?>
                                 
                                 
                                <?php if($current_support['content']): ?>
                        		<textarea rows="10" class="ui-cont" class="widefat"></textarea>
                                <p><label ><input type="checkbox" class="ui-autop" value="1" />&nbsp;<?php _e('Automatically add paragraphs','smooththemes'); ?></label></p>
                               	<div class="widget-description"><?php _e('Arbitrary text or HTML','smooththemes'); ?></div>
                                 <?php endif; ?>
                                 
                                 <?php if($current_support['id']): ?>
                                 <input type="hidden" class="ui-autoid" value="" />
                                <?php endif; ?>
                                
                        	</div>
                    
                        	<div class="widget-control-actions">
                        		<div class="alignleft">
                            		<a href="#remove" class="remove">Delete</a> |
                            		<a href="#close" class="close">Close</a>
                        		</div>
                        		<br class="clear" />
                        	</div>
                    	
                    	</div>
                      
                        </div>
                
                </div><!-- ui-temp-code -->
            
            <div class="alignright">
    		  <input type="button" value="Add More" class="button-secondary st-ui-more" />		
            </div>
    		<br class="clear">
             <?php if($this->field['desc']) echo '<div class="desc ui-desc">'.$this->field['desc'].'</div>'; ?>
            <div class="clear"></div>
          </div><!--box-inner-->
         <?php
         $this->usage();
         echo  '</div><!-- STpanel-gallery-box -->'."\n";
        
        
    }// end function ui
    
    
    
}//and class admin_tabs_display

#-----------------------------------------------------------------
# Requied Admin Settings File
#-----------------------------------------------------------------

include(ST_DIR.'/settings/admin-settings.php');
