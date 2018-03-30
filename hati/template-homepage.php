<?php

/* Template Name: Homepage */

?>
<?php get_header(); if (have_posts()) the_post(); ?>
<?php

  if (!function_exists('a_get_slides_by_meta')) {
    function a_get_slides_by_meta() {
      
      $slides = array();
      
      $metas = array('_slide_1', '_slide_2', '_slide_3', '_slide_4', '_slide_5', '_slide_6');
      if ( is_page_template('template-homepage.php') )
        $metas = array_slice($metas, 0, 3); // slide 1, 2, 3
      
      foreach($metas as $meta) {
        
        if (! $img = Acorn::getm($meta.'_img') ) continue;
        $h3 = Acorn::getm($meta.'_h3');
        $h2 = Acorn::getm($meta.'_h2');
        $link = Acorn::getm($meta.'_link');
        
        $slides[] = array('img'=>$img,'h2'=>$h2,'h3'=>$h3,'link'=>$link);
      }

      return $slides;
    }
  }

?>
<ol class="slides" data-timeout="<?php Acorn::egetm('Slider Timeout') ?>" data-speed="<?php Acorn::egetm('Slider Speed') ?>">
  
  <?php foreach (a_get_slides_by_meta() as $slide) : if ($img = $slide['img']) : ?>
    
    <?php
      $out = '';
      $tag = 'div';
      $link = '';
      $title =  $slide['h3'];
      $desc =  $slide['h2'];
      
      if ($slide['link']) {
        $tag = 'a';
        $link = " href='{$slide['link']}' title='{$title}'";
      }
      
      $out .= "<li><img src='{$img}' alt=''>";
      if ($title || $desc) {
        $out .= "<{$tag}{$link} class='media-desc desc'>";
        if ($title) $out .= "<h3>{$title}</h3>";
        if ($desc) $out .= "<h2>{$desc}</h2>";
        $out .= "</{$tag}>"; 
      }
      $out .= "</li>";
      
      echo $out;
    ?>
  
  <?php endif; endforeach; ?>
  
</ol>
<!-- /slides-->

<div class="main wrap group">
  <div class="sidewrap group">

  <?php the_content() ?>

  </div>
  <div class="clear fat"></div>
</div>

<?php get_footer() ?>