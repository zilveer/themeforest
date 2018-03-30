<?php

// [page_tile]
function flatsome_page_title_shortcode($atts, $content = null) {
  extract(shortcode_atts(array(
     '_id' => 'page-title-'.rand(),
     'style' => 'featured', //blank / simple / featured.
     'title' => '',
     'sub_title' => '',
     'bg' => '',
     'bg_featured' => true,
     'bg_color' => '',
     'bg_overlay' => '',
     'bg_pos' => '',
     'bg_size' => '',
     'divider' => 'true',
     'align' => 'center',
     'height' => '601',
     'parallax' => '',
     'parallax_text' => '',
     'title_size' => 'xxlarge',
     'title_case' => '',
     'title_margin' => '',
  ), $atts));

  $classes = array();
  if($style) $classes[] = $style.'-title';
  if($style == 'featured') $classes[] = 'dark nav-dark';
  if($align) $classes[] = 'text-'.$align;

  // title
  $title_classes = array();
  if($title_case) $title_classes[] = $title_case;
  if($title_size) $title_classes[] = 'is-'.$title_size;

  // Get default page title
  if(!$title) $title = get_the_title();

  // Get featured image
  if($bg_featured) $bg = 'asdf';
  ?>

  <div id="<?php echo $_id; ?>" class="page-title normal-title <?php echo implode(' ', $classes); ?>">

    <?php if($bg || $bg_color) { ?>
    <div class="page-title-bg">
      <div class="title-bg fill bg-fill" 
        data-parallax-container=".page-title" 
        data-parallax-background  
        data-parallax="-<?php echo $parallax; ?>">
      </div>
      <div class="title-overlay fill" style="background-color: rgba(0,0,0,.6)"></div>
    </div>
    <?php } ?>
    <?php if($align == 'center') { ?>
    <div class="page-title-inner container flex-row">
      <div class="title-header <?php echo implode(' ', $title_classes); ?>">
        <h1 class="entry-title mb-0">
          <?php echo $title; ?>
        </h1>
        <small class="page-title-sub">Sub Title</small>
        <div class="is-divider"></div>
        <?php echo $content; ?>
      </div>
    </div><!-- flex-row -->
    <?php } else { ?>
    <div class="page-title-inner container flex-row">
      <div class="title-header flex-col flex-grow <?php echo implode(' ', $title_classes); ?>">
        <h1 class="entry-title mb-0">
          <?php echo $title; ?>
        </h1>
        <small class="page-title-sub">Sub Title</small>
        <div class="is-divider"></div>
      </div>
      <div class="title-content flex-col flex-right">
        <?php echo $content; ?>
      </div>
    </div><!-- flex-row -->
    <?php } ?>
     <?php
      // Get custom CSS
      $args = array(
        'height' => array(
          'selector' => '.flex-row',
          'property' => 'height',
        ),
        'bg' => array(
          'selector' => '.title-bg',
          'property' => 'background-image',
          'size' => $bg_size
        ),
        'bg_overlay' => array(
          'selector' => '.title-overlay',
          'property' => 'background-color',
        ),
        'bg_color' => array(
          'selector' => '',
          'property' => 'background-color',
        ),
        'bg_pos' => array(
          'selector' => '.bg',
          'property' => 'background-position',
        ),
      );
      echo ux_builder_element_style_tag($_id, $args, $atts);
    ?>
  </div><!-- .page-title -->
  <?php
}

add_shortcode("page_title", "flatsome_page_title_shortcode");