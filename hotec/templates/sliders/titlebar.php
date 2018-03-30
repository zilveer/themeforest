<?php 
  $data['img'] =  trim($data['img']);
  
  if($data['img']==''  && $data['desc']==''  &&  $data['title']==''){
     $data['title'] =  st_get_setting('titlebar_title','');;
     $data['desc'] =  st_get_setting('titlebar_desc','');;
     $data['img'] =   st_get_setting('titlebar_img','');;
  }  
  
  if($data['img']==''){
    $data['img'] =ST_THEME_URL.'/assets/images/titlebar-bg.jpg';
  }

?>

<div style="background:url('<?php  echo esc_attr($data['img']); ?>') no-repeat top center;" class="titlebar-outer-wrapper">
    <div class="container">
        <div class="row">
            <div class="twelve columns b0">
            <?php if($data['title']!="" || $data['desc']!=''): ?>
                <div class="titlebar-title">
                  <?php if($data['title']!=""): ?>
                    <h1><?php echo esc_html($data['title']); ?></h1>
                    <?php endif; ?>
                      <?php if($data['desc']!=""): ?>
                    <div class="titlebar-decs"><?php echo esc_html($data['desc']); ?></div>
                      <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>