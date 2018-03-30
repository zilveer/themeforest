<?php
 if(empty($data['slider_items']['images'])){
        return '';
    }
    
    $images = $data['slider_items']['images'];
    $metas = $data['slider_items']['meta'];
    $id =  'slider-'.uniqid();
    if(isset($data['class'])  && $data['class']!=''){
        $data['class'] = ' '.trim($data['class']);
    }else{
        $data['class'] ='';
    }
    
    if(isset($data['slider_full_with'])  && $data['slider_full_with']==1){
        
    }
 
    ?>
 
    <div id="<?php echo $id; ?>" class="<?php echo !($is_top_slider) ? 'inside-post-slider ' : ''; ?> flexslider <?php echo $data['class']; ?>">
        <ul class="slides">
            <?php
            foreach($images as $n=> $img_id){
                $col = array();
               // $col['img'] = $img_id;
                $meta  = $metas[$n];
                $attachment=wp_get_attachment_image_src($img_id, $img_size);
                
                $item = '<li> %1$s </li>';
                $img = sprintf('<img src="%1$s" alt="" />',$attachment[0]);
                if($meta['url']!=''){
                        $img ='<a href="'.$meta['url'].'">'.$img.'</a></h3>';
                }
                
                $caption ='';
              
              if(isset($settings['show_caption'])  && strtolower($settings['show_caption'])=='no'){
                
              }else{
                 if($meta['title']!='' || $meta['caption']!='' ){
                    if($meta['url']!=''){
                        $title ='<h1><a href="'.$meta['url'].'">'.esc_html($meta['title']).'</a></h1>';
                    }else{
                         $title = '<h1>'.esc_html($meta['title']).'</h1>';
                    }
                  if($meta['caption']!=''){
                     $caption = '
                        <div class="flex-caption-wrapper">
                         <div class="top-flex-caption">
                            <div class="flex-caption-text">
                                    '.$title.'
                                   <p>'.esc_html($meta['caption']).'</p>
                                </div>
                          </div>
                        </div>';
                  }

                }
                 
              }
               $item = sprintf($item, $img.$caption); 
               echo  apply_filters('st_slider_item',$item,$img_id,$meta);    
            }
            ?>
        </ul>
    </div><!-- inside-post-slider -->
<?php 