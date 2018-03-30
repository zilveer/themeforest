<?php

function st_builder_meta_items($name='', $values = array() , $post = false){
  
     $builder_items = get_page_builder_items();
    
        $builder_save = $values['builder'];
        
        if(empty($builder_save) || !is_array($builder_save)){
            $builder_save = array();
        }
        
        $builder_name =$name.'[builder]';
        
        $pd_item_width = array(
                             '1_1'=>0,     '3_4'=>1,
                             '2_3'=>2,   '1_2'=>3,
                             '1_3'=>4,   '1_4'=>5,
                             
                 );
    
       ?>
       <div class="stpb_pd_w">
       
       <?php  
       // do not show page builder items  beacase it can not run in shop pages
       if(strtolower($post->post_type) =='page'  && !(get_option('woocommerce_shop_page_id')==$post->ID && $post->ID>0 && st_is_woocommerce())): 
       ?>
       
       <div class="stbuilder">
             <input type="hidden"  class="builder_pre_name" value="<?php echo $builder_name; ?>" />
            <div class="stbuilder-items">
                <h4 class="sttitle"><?php _e('Add Items','smooththemes'); ?></h4>
                <p class="stdesc" ><?php _e('Click "add" to add item to Canvas','smooththemes'); ?></p>
                <div class="notifications">
                    <span class="n success"><?php _e("Item Added",'smooththemes') ;?></span>
                    <span class="n warning"><?php _e("Item removed",'smooththemes') ;?></span>
                </div>
                <div class="clear"></div>
                <div class="stbuilder-o-items">
                    
                    <?php foreach($builder_items as $function => $item): ?>
                    <div class="bd-item">
                        <div class="add-btn">
                            <span class="n"><?php echo esc_html($item['title']); ?></span>
                            <a href="#" class="act-add"><?php echo _e('Add','smooththemes'); ?></a>
                        </div><!-- add-btn -->
                        
                        <div class="item-js-options">
                      <?php 
                         $w = $item['default_with'];
                         if($w==''){
                            $w='1_1';
                         }
                      ?>
                            
                        <div class="obj-item  col_<?php echo $w; ?>" numc="<?php echo $pd_item_width[$w]; ?>">
                        <div class="obj-item-inner">
                                    <input type="hidden"  class="group-name builder-with"  group-name="[pbwith]" value="<?php echo $w; ?>" />
                                   <?php if(!$item['block']): ?>
                                    <span class="up">+</span>
                                    <span class="down">-</span>
                                    <?php endif; ?>
                                    <span class="with-info"><?php echo str_replace('_','/',$w); ?></span>
                                    <?php if($item['editable']!==false): ?>
                                    <span class="pbedit" title="<?php _e('Click here to edit','smooththemes'); ?>">Edit</span>
                                    <?php endif; ?>
                                    <span class="pbremove" title="<?php _e('Remove','smooththemes'); ?>"></span>
                                    
                                     <div class="t"><div><?php echo esc_html($item['title']); ?></div></div>
                             
                                 <div class="obj-js-edit">
                                    <?php 
                                     if(function_exists($function)){
                                        call_user_func($function, $function);
                                     }
                                    ?>
                                    
                                    <div class="pb-btns">
                                         <input type="button" value="<?php _e('Save','smooththemes'); ?>" class="pbdone pbbtn button-primary" />
                                         <input type="button" value="<?php _e('Cancel','smooththemes'); ?>" class="pbcancel pbbtn button-secondary" />
                                    </div>
                                 </div><!-- obj-js-edit -->
                            </div>
                                
                         </div><!--  /.obj-item  -->

                        </div><!-- item-js-options -->  
                    </div><!-- bd-item -->
                    <?php endforeach; ?>
                    
                    <div class="clear"></div>
                </div><!-- stbuilder-o-items -->
            </div><!-- stbuilder-items -->
            
            <div class="stbuilder-area-wprap">
            <div class="stbuilder-edit-box" style="display: none;">
            
            </div><!-- stbuilder-edit-box --->
            
            <div class="stbuilder-area row-fluid sortable">
                 <?php 
                 foreach($builder_save as $i => $item): 
                 
                 $func = $builder_items[$item['function']];
                     $w = $item['pbwith'];
                     if($w==''){
                        $w='1_1';
                     }
                 ?>
                 
                 <div class="obj-item  col_<?php echo $w; ?>" numc="<?php echo $pd_item_width[$w]; ?>">
                        <div class="obj-item-inner">
                                    <input type="hidden"  class="group-name builder-with"  group-name="[pbwith]" value="<?php echo $w; ?>" />
                                     <?php if(!$func['block']): ?>
                                    <span class="up">+</span>
                                    <span class="down">-</span>
                                    <?php endif; ?>
                                    <span class="with-info"><?php echo str_replace('_','/',$w); ?></span>
                                   <?php if($func['editable']!==false): ?>
                                    <span class="pbedit" title="<?php _e('Click here to edit','smooththemes'); ?>">Edit</span>
                                    <?php endif; ?>
                                    <span class="pbremove" title="<?php _e('Remove','smooththemes'); ?>"></span>
                                     <div class="t"><div><?php echo esc_html($func['title']); ?></div></div>
                             
                                 <div class="obj-js-edit">
                                    <?php 
                                     if(function_exists($item['function'])){
                                             call_user_func($item['function'],$item['function'],$builder_name,$item);
                                        }
                                    ?>
                                    <div class="pb-btns">
                                         <input type="button" value="<?php _e('Save','smooththemes'); ?>" class="pbdone pbbtn button-primary" />
                                         <input type="button" value="<?php _e('Cancel','smooththemes'); ?>" class="pbcancel pbbtn button-secondary" />
                                    </div>
                                 </div><!-- obj-js-edit -->
                            </div>
                                
                    </div><!--  /.obj-item  -->

                  <?php endforeach; ?>
                
            </div><!-- stbuilder-area -->
            </div>
       
       </div><!-- stbuilder -->
       
       <div class="stdive"></div>
       
       <?php endif; ?>
    
    <?php
}


function  st_builder_meta_layout_sidebar($name='', $values = array() , $post = false){
    global $wp_registered_sidebars;
    ?>
    <div class="layout-wrap">
     <div class="layout">
       <h4><?php _e('Layout','smooththemes'); ?></h4>
        <?php
        $layouts = array(
          //  '4'=>  array('title'=>'Three columns, left & right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/3.png'),
            '3'=>  array('title'=>'Two columns, left sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/2.png'),
            '2'=>  array('title'=>'Two columns, right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/1.png'),
            '1'=>  array('title'=>'One column, no sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/0.png')
        );
        
        $layout_name = $name.'[layout]';
        $current_layout =  $values['layout'];
        
        if(empty($current_layout)){
            $values['layout'] = $current_layout = (in_array($post->post_type, array('portfolio'))) ? '1' : st_get_setting("layout",2) ;// default right sidebar
        }
        
         foreach($layouts as $k => $item){
            // $check=$this->radio_checked($k);
             $class="";
             $check = "";
             if($k!='' && $k== $current_layout){
                $class=" label-checked";
                $check ='  checked="checked" ';
             }
             
             $image = $item['img'];
             
             $input.='<div class="stpb-layout-item'.$class.'">';
             $input.='
             <label class="label" title="'.esc_attr($item['title']).'">
                 <input value="'.htmlspecialchars($k).'" class="STpanel-radio-input" type="radio" '.$check.' name="'.$layout_name.'" />
                 <img src="'.$image.'" alt =""/>
             </label>';
             $input.='</div>';
         }
         
          echo $input;
        ?>
        <div class="clear"></div>
       </div><!-- layout -->
       
       <?php 
         // default sidebar 
         $values['left_sidebar'] = ($values['left_sidebar']!='') ? $values['left_sidebar']  : 'sidebar_default_l' ;
         $values['right_sidebar'] = ($values['right_sidebar']!='') ? $values['right_sidebar']  : 'sidebar_default_r' ;
       ?>
       
        <div class="sidebar" <?php echo ($values['layout']!=1) ? '' : ' style="display:none;" '; ?>>
        <h4><?php _e('Sidebar','smooththemes'); ?></h4>
        <span  <?php echo ($values['layout']==3  || $values['layout']==4) ? ' ' : ' style="display:none;" '; ?> class="left_sidebar">
        <span class="chzn-select-lb"><?php _e('Left sidebar','smooththemes'); ?></span>
         <select name="<?php echo $name.'[left_sidebar]'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):
             
             $selected="";
             if($values['left_sidebar']==$sb['id']){
                $selected = ' selected ="selected" ';
             }
             
              ?>
             <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
          </select>
           <div class="clear"></div>
         </span>
          
          
         <span <?php echo ($values['layout']==2  || $values['layout']==4) ? ' ' : ' style="display:none;" '; ?> class="right_sidebar">
         <span class="chzn-select-lb"><?php _e('Right sidebar','smooththemes'); ?></span>
       
         <select name="<?php echo $name.'[right_sidebar]'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):
             
             $selected="";
             if($values['right_sidebar']==$sb['id']){
                $selected = ' selected ="selected" ';
             }
             
              ?>
             <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
         </select>
           <div class="clear"></div>
          </span>
          
             <div class="clear"></div>
        </div><!--  /. sidebar -->
        
      </div>  
        
        
    <?php
}


function st_builder_meta_portfolio($name='', $values = array() , $post = false){
    
    if(!in_array(strtolower($post->post_type),array('portfolio'))){
        return ;
    }
    ?>

       <?php /** ============= Sub layout for portfolio ============= */ ?>
        
         <div class="stdive"></div>
         <?php /*
         <div class="portfolio-layout">
             <h4><?php _e('Portfolio Layout','smooththemes'); ?></h4>
             <?php
               $portfolio_layouts = array('half'=>__('Single portfolio half','smooththemes'),'full'=>'Single portfolio wide');
              ?>
               <select name="<?php echo $name.'[portfolio_layout]'; ?>" class="chzn-select">
                     <?php foreach($portfolio_layouts as $pk=> $pl){ 
                         $selected="";
                         if($values['portfolio_layout']==$pk){
                            $selected = ' selected ="selected" ';
                         }
                        ?>
                     <option value="<?php echo esc_attr($pk); ?>" <?php echo $selected; ?> ><?php echo esc_html($pl); ?></option>
                     <?php } ?>
               </select>
         </div><!-- portfolio-layout -->
         */ ?>
         
         
         <h4><?php _e('Portfolio details','smooththemes'); ?></h4>
          <div class="portfolio-details">
                <p>
                <strong><?php _e('Date','smooththemes'); ?></strong><br />
                 <input type="text" class="regular-text st_datepicker"  name="<?php echo $name.'[portfolio_date]'; ?>" value="<?php echo esc_attr($values['portfolio_date']); ?>" />
                </p>
                
                <p>
                <strong><?php _e('Client','smooththemes'); ?></strong><br />
                 <input type="text" class="regular-text"  name="<?php echo $name.'[portfolio_client]'; ?>" value="<?php echo esc_attr($values['portfolio_client']); ?>" />
                </p>
                
                <p>
                <strong><?php _e('Skills','smooththemes'); ?></strong><br />
                 <input type="text" class="regular-text"  name="<?php echo $name.'[portfolio_skills]'; ?>" value="<?php echo esc_attr($values['portfolio_skills']); ?>" />
                </p>
                
                 <p>
                <strong><?php _e('Website url','smooththemes'); ?></strong><br />
                 <input type="text" class="regular-text"  name="<?php echo $name.'[portfolio_website]'; ?>" value="<?php echo esc_attr($values['portfolio_website']); ?>" />
                </p>
          </div>
         
       <?php /** ============= END Sub layout for portfolio ============= */ ?>
    
    <?php
}


function st_builder_meta_page_title($name='', $values = array() , $post = false){ 
     ?>
      <?php  if(strtolower($post->post_type)=='page'):  ?>
         <div class="stdive"></div>
       <?php
       
        if($no_value){
            $values['show_title'] = 1;
            $values['show_content'] = 1;
        }
        ?>
        <div class="page_options">
        
            <div>
             <h4><?php _e('Show page Title','smooththemes'); ?><small>(<?php _e('Enable title for this page','smooththemes'); ?>)</small></h4>
                <input type="checkbox" class="ibutton" name="<?php echo $name.'[show_title]'; ?>" <?php  echo ($values['show_title'] ==1) ? '  checked="checked" ':''; ?> value="1" />
            </div>
           

        </div>
       <?php endif; ?>
     <?php
    
}

function st_builder_meta_post_type_thumb($name='', $values = array() , $post = false){ 
      
    ?>
      <?php
        if('page'!= strtolower($post->post_type)): 
        if(empty($values['thumbnail_type'])){
            $values['thumbnail_type'] ='image';
        }
        ?>
        <div class="stdive"></div>
          
        <div class="thumbnail">
            <h4><?php _e('Thumbnail','smooththemes'); ?></h4>
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'image' ? '  checked="checked" ':''; ?> value="image" /><?php _e('Image (use featured Image)','smooththemes'); ?></label>
            </p>
            
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'slider' ? '  checked="checked" ':''; ?> value="slider" /><?php _e('Slider','smooththemes'); ?></label>
            </p>
            
            <?php if(!in_array($post->post_type, array('room','gallery'))): ?>
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'video' ? '  checked="checked" ':''; ?> value="video" /><?php _e('Video','smooththemes'); ?></label>
            </p>
            <?php endif; ?>
            
            <?php /*
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'html' ? '  checked="checked" ':''; ?> value="html" /><?php _e('Custom HTML','smooththemes'); ?></label>
            </p>
            */ ?>
            
            <div class="thumbnail_images gallery-builder" <?php  echo ($values['thumbnail_type'] == 'video'  || $values['thumbnail_type'] == 'image' || $values['thumbnail_type'] == 'html' ) ? ' style="display: none" ' : ''; ?>>
                <?php stpb_images($name.'[thumbnails]',$values['thumbnails']); ?>
            </div>
            
            
            
            <div class="thumbnail_video" <?php  echo ($values['thumbnail_type'] == 'video')? '' : ' style="display: none" ' ; ?>>
                <label>
                <strong><?php echo _e("Video URL (Youtube or Vimeo only)",'smooththemes'); ?></strong><br />
                <input type="text" class="regular-text"  name="<?php echo $name.'[video_code]'; ?>" value="<?php echo esc_attr($values['video_code']); ?>" />
                </label>
            </div>
            
            <?php /*
            <div class="thumbnail_html" <?php  echo ($values['thumbnail_type'] == 'html') ? '' :' style="display: none" '; ?>>
                <label>
                <strong><?php echo _e("HTML code)",'smooththemes'); ?></strong><br />
                
                <textarea rows="10" style="width: 60%;" name="<?php echo $name.'[html_code]'; ?>"><?php echo esc_attr($values['html_code']); ?></textarea>
                
                
                </label>
            </div>
            */ ?>
            

        </div>
        <?php endif; ?>
         
    <?php
    
}


function  stpb_select_layout($name, $layout_name,$left_sidebar_name,$right_sidebar_name,$values= array(), $title=''){
      global $wp_registered_sidebars;
      
    ?>
    
    <div class="layout-wrap">
     <div class="layout">
       <h4><?php echo esc_html($title); ?></h4>
        <?php
        $layouts = array(
          //  '4'=>  array('title'=>'Three columns, left & right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/3.png'),
            '3'=>  array('title'=>'Two columns, left sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/2.png'),
            '2'=>  array('title'=>'Two columns, right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/1.png'),
            '1'=>  array('title'=>'One column, no sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/0.png')
        );
        
        $input_layout_name = $name.'['.$layout_name.']';
        $current_layout =  $values[$layout_name];
        
       //  echo var_dump($layout_name);
        
        if(empty($current_layout)){
            $values[$layout_name] = 1; 
        }
        
         foreach($layouts as $k => $item){
            // $check=$this->radio_checked($k);
             $class="";
             $check = "";
             if($k!='' && $k== $current_layout){
                $class=" label-checked";
                $check ='  checked="checked" ';
             }
             
             $image = $item['img'];
             
             $input.='<div class="stpb-layout-item'.$class.'">';
             $input.='
             <label class="label" title="'.esc_attr($item['title']).'">
                 <input value="'.htmlspecialchars($k).'" class="STpanel-radio-input" type="radio" '.$check.' name="'.$input_layout_name.'" />
                 <img src="'.$image.'" alt =""/>
             </label>';
             $input.='</div>';
         }
         
          echo $input;
        ?>
        <div class="clear"></div>
       </div><!-- layout -->
       
       <?php 
         // default sidebar 
         $values[$left_sidebar_name] = ($values[$left_sidebar_name]!='') ? $values[$left_sidebar_name]  : 'sidebar_default_l' ;
         $values[$right_sidebar_name] = ($values[$right_sidebar_name]!='') ? $values[$right_sidebar_name]  : 'shop_right_sidebar' ;
       ?>
       
        <div class="sidebar" <?php echo ($values[$layout_name]!=1) ? '' : ' style="display:none;" '; ?>>
        <h4><?php _e('Sidebar','smooththemes'); ?></h4>
        <span  <?php echo ($values[$layout_name]==3  || $values[$layout_name]==4) ? ' ' : ' style="display:none;" '; ?> class="left_sidebar">
        <span class="chzn-select-lb"><?php _e('Left sidebar','smooththemes'); ?></span>
         <select name="<?php echo $name.'['.$left_sidebar_name.']'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):
             
             $selected="";
             if($values[$left_sidebar_name]==$sb['id']){
                $selected = ' selected ="selected" ';
             }
             
              ?>
             <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
          </select>
           <div class="clear"></div>
         </span>
          
          
         <span <?php echo ($values[$layout_name]==2  || $values[$layout_name]==4) ? ' ' : ' style="display:none;" '; ?> class="right_sidebar">
         <span class="chzn-select-lb"><?php _e('Right sidebar','smooththemes'); ?></span>
       
         <select name="<?php echo $name.'['.$right_sidebar_name.']'; ?>" class="chzn-select">
             <?php
              foreach($wp_registered_sidebars as $sb):
             
             $selected="";
             if($values[$right_sidebar_name]==$sb['id']){
                $selected = ' selected ="selected" ';
             }
             
              ?>
             <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
         </select>
           <div class="clear"></div>
          </span>
          
             <div class="clear"></div>
        </div><!--  /. sidebar -->
      </div>  
    <?php
    
}

function st_builder_meta_shop($name='', $values = array() , $post = false){ 
    
    if(get_option('woocommerce_shop_page_id')!=$post->ID || !$post->ID>0 || !st_is_woocommerce()){
        return;
    }

    ?>
      <?php 
         if($no_value){
            $values['show_product_slider'] = '';
         }
            ?>
            
         <div class="stdive"></div>
         <?php stpb_select_layout($name,'shop_tax_layout','shop_tax_left_sb','shop_tax_right_sb',$values,__('Product Categories/Tags layout','smooththemes')) ?>
            

        <div class="stdive"></div>
         <?php stpb_select_layout($name,'shop_single_layout','shop_single_left_sb','shop_single_right_sb',$values,__('Single product layout','smooththemes')) ?>
            
        
    <?php
}


function st_builder_meta_page_slider($name='', $values = array() , $post = false){ 
      if(!in_array($post->post_type,array('page','event','room','portfolio')) ){
          return ;
      }
      
      if($values['slider_type']==''){
          $values['slider_type'] ='titlebar';
           $values['slider_full_w']  =1 ;
      }


    $layersliders = $revsliders = array();

    $slider_types =  array(
        'layerslider'=>"Layer slider",
        'revslider'=>'Revolution Slider',
        'flexslider'=>'Flex Slider',
        'titlebar'=>'Titlebar',
        'statichtml'=>'HTML code'
    );
    
  ?>
  
      <div class="stdive"></div>
         <?php 
          /// for Layer Slider
           if(function_exists('layerslider_router')){ // if layerSlider installeds
                // Get WPDB Object
                global $wpdb;
                // Get sliders
                $layersliders = $wpdb->get_results( "SELECT * FROM  {$wpdb->prefix}layerslider WHERE flag_hidden = '0' AND flag_deleted = '0'
                ORDER BY date_c ASC " );
            }else{
               unset($slider_types['layerslider']);
           }

            if(class_exists('UniteFunctionsWPRev')){
                $revsliders = $wpdb->get_results( "SELECT `title`, `alias`  FROM {$wpdb->prefix}revslider_sliders ORDER BY `title` ASC " );
            }else{
                unset($slider_types['revslider']);
            }

            ?>
            
             <div class="show_top_slider">
                <h4><?php _e('Show top Element','smooththemes'); ?><small> (<?php _e('Enable top slider, titbar or html code','smooththemes'); ?>)</small></h4>
                <input type="checkbox"  class="show_top_slider_ibutton show_top_slider" name="<?php echo $name.'[show_top_slider]'; ?>" <?php  echo ($values['show_top_slider'] == 1) ? '  checked="checked" ':''; ?> value="1" />
            </div>
            
            <div class="slider-types" <?php echo ($values['show_top_slider']==1) ? '' : ' style="display: none;" '; ?>>
                <h4><?php _e('Element type','smooththemes'); ?></h4>
                <select name="<?php echo $name.'[slider_type]'; ?>"  class="st-slider-type chzn-select" >
                     <?php
                     if($values['slider_type']==''){
                        $values['slider_type'] ='layerslider';
                     }
                      foreach($slider_types as $k=>$s):
                      $selected ='';
                     if($values['slider_type']==$k){
                        $selected = ' selected ="selected" ';
                     }
                    ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html(stripslashes($s)); ?></option>
                     <?php endforeach; ?>
                </select>
            </div>
            
            
             <div class="st-revslider st-slider-data" <?php echo ($values['slider_type']=='revslider' && $values['show_top_slider']==1) ? '' : ' style="display: none;" '; ?>>
             <h4><?php _e('Revolution Slider','smooththemes'); ?></h4>
                <select name="<?php echo $name.'[revslider]'; ?>"  class="chzn-select" >
                <?php foreach($revsliders as $s):
                     $selected="";
                     $k = $s->alias;
                     if($values['revslider']==$k){
                        $selected = ' selected ="selected" ';
                     }
                ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html(stripslashes($s->title)); ?></option>
                     <?php endforeach; ?>
                </select>
                <p><a href="<?php echo admin_url('admin.php?page=revslider'); ?>"><?php _e('Add New Revolution Slider','smooththemes'); ?></a></p>
            </div>
            
            <div class="st-statichtml st-slider-data" <?php echo ($values['slider_type']=='statichtml' && $values['show_top_slider']==1) ? '' : ' style="display: none;" '; ?>>
                 <h4>HTML code</h4>
                 <textarea style="width: 80%;" rows="10" name="<?php echo $name.'[statichtml]'; ?>"><?php echo esc_attr($values['statichtml']); ?></textarea>
            </div>
            
            <div class="st-layerslider st-slider-data" <?php echo ($values['slider_type']=='layerslider' && $values['show_top_slider']==1) ? '' : ' style="display: none;" '; ?>>
             <h4><?php _e('Layer Slider','smooththemes'); ?></h4>
                <select name="<?php echo $name.'[layerslider]'; ?>"  class="chzn-select" >
                <?php foreach($layersliders as $s):
                     $selected="";
                   //  $k = "[layerslider id=\"{$s->id}\"]";
                     $k = $s->id;
                     if($values['layerslider']==$k){
                        $selected = ' selected ="selected" ';
                     }
                ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html(stripslashes($s->name)); ?></option>
                     <?php endforeach; ?>
                </select>
                <p><a href="<?php echo admin_url('dmin.php?page=layerslider'); ?>"><?php _e('Add New Layerslider','smooththemes'); ?></a></p>
            </div>
            
            
            <?php 
              if(!isset($values['slider_data'])  ||  empty($values['slider_data'])){
                $values['slider_data'] = array('cats' => array());
              }
              
              if(!isset($values['slider_data']['cats'])){
                  $values['slider_data']['cats'] = array();
              }
              
              if(!is_array($values['slider_data']['cats'])){
                $values['slider_data']['cats'] = (array) $values['slider_data']['cats'];
              }
              
            ?>
            <div class="st-elasticslideshow st-nivo st-flexslider st-slider-data thumbnail_images gallery-builder " <?php 
            echo ($values['show_top_slider']==1 && isset($values['slider_type']) &&  !in_array($values['slider_type'],array('layerslider','revslider','titlebar', 'statichtml'))  ) ? '' : ' style="display: none;" '; 
            ?>>
                  <?php
                   stpb_images($name.'[slider_items]',$values['slider_items']);
                ?>
            </div>
            
            <div class="st-slider-data st-titlebar" <?php echo ($values['slider_type']=='titlebar' && $values['show_top_slider']==1) ? '' : ' style="display: none;" '; ?>>
                <?php
                  if(!isset($values['titlebar']) || empty($values['titlebar']) ){
                    $values['titlebar'] = array('title'=>'','desc'=>'','img'=>'');
                  }
                 ?>
               <div class="tag_line">
                      <h4><?php echo _e("Titlebar title",'smooththemes'); ?></h4>
                    <label>
                    <input type="text" class="regular-text"  name="<?php echo $name.'[titlebar][title]'; ?>" value="<?php echo esc_attr($values['titlebar']['title']); ?>" />
                    </label>
                </div>
                
                <div class="tag_line">
                      <h4><?php echo _e("Titlebar description",'smooththemes'); ?></h4>
                    <label>
                    <input type="text" class="regular-text"  name="<?php echo $name.'[titlebar][desc]'; ?>" value="<?php echo esc_attr($values['titlebar']['desc']); ?>" />
                    </label>
                </div>
                
              
                 <div class="pb-box-upload ui-img-w item-gr">
                    <h4><?php echo _e("Titlebar background image",'smooththemes'); ?></h4>
            		<input type="text" value="<?php echo esc_attr($values['titlebar']['img']); ?>" name="<?php echo $name.'[titlebar][img]'; ?>" class="group-name pb-input-upload" >
                    <a href="#"  class="pb-upload-button button-secondary"><span></span><?php echo __('Select Image','smooththemes'); ?></a>
                    <a href="#" class="remove_image button-secondary"><span></span><?php echo __('Remove','smooththemes'); ?></a>
                    <div class="clear"></div>
                </div>
           
           </div>  

             <div class="st-elasticslideshow st-titlebar st-nivo st-flexslider st-slider-data thumbnail_images gallery-builder  st-statichtml" <?php 
            echo ($values['show_top_slider']==1 && isset($values['slider_type']) &&  !in_array($values['slider_type'],array('layerslider','revslider'))  ) ? '' : ' style="display: none;" '; 
            ?>>
             <h4><?php _e('Element full with','smooththemes'); ?></h4>
                <input type="checkbox"  class="ibutton" name="<?php echo $name.'[slider_full_w]'; ?>" <?php  echo ($values['slider_full_w'] == 1) ? '  checked="checked" ':''; ?> value="1" />
             </div>
             
           
           
                      
  <?php  
}




add_action('st_builder_items','st_builder_meta_items',10,3);

add_action('st_builder_meta','st_builder_meta_layout_sidebar',10,3);
add_action('st_builder_meta','st_builder_meta_portfolio',11,3);
add_action('st_builder_meta','st_builder_meta_page_title',12,3);
add_action('st_builder_meta','st_builder_meta_post_type_thumb',13,3);
add_action('st_builder_meta','st_builder_meta_shop',14,3);
add_action('st_builder_meta','st_builder_meta_page_slider',15,3);


