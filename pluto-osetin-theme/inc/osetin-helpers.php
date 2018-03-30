<?php



// Excerpt "more" text settigns
function new_excerpt_more() {
  if(get_post_format(get_the_ID()) == 'link'){
    return '...<div class="read-more-link"><a href="'. get_field( 'external_link' ) . '">' . __('Read More', 'pluto') . '</a></div>';
  }else{
    return '...<div class="read-more-link"><a href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'pluto') . '</a></div>';
  }
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


function os_excerpt($limit = 16, $more = TRUE) {
  if(!$limit){
    $limit = 16;
  }
  if($more){
    return wp_trim_words(get_the_excerpt(), $limit, new_excerpt_more());
  }else{
    return wp_trim_words(get_the_excerpt(), $limit, "");
  }

}

function os_quote_excerpt($limit = 16){
  return wp_trim_words(get_the_excerpt(), $limit, '...<span class="quote-read-more-link">' . __('Read More', 'pluto') . '</span>');
}

function os_facebook_like(){
  ?>
  <iframe src="//www.facebook.com/plugins/like.php?href=<?php urlencode(the_permalink()); ?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=846692988676299" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
  <?php
}

function os_footer(){
  ?>
  <footer class="site-footer" role="contentinfo">
    <div class="site-info">
      <div class="site-footer-i">
        <?php the_field('footer_text', 'option'); ?>
      </div>
    </div>
  </footer>
  <?php
}

function os_the_primary_sidebar($masonry = FALSE){
  $condition = $masonry ? (os_get_show_sidebar_on_masonry() == true) : true;
  if( ( get_field('sidebar_position', 'option') != "none" ) && is_active_sidebar( 'sidebar-1' ) && $condition ){ ?>
    <div class="primary-sidebar-wrapper">
      <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
      </div>
    </div><?php
  }
}

function os_get_content_class($masonry = FALSE){
  $content_class = 'main-content-w';
  return $content_class;
}

function osetin_single_top_social_share(){
  if(get_field('disable_social_share_icons_on_post', 'option') != TRUE): ?>
    <div class="single-post-top-share">
      <i class="fa os-icon-plus share-activator-icon share-activator"></i>
      <span class="share-activator-label share-activator caption"><?php _e("Share", "pluto") ?></span>
      <div class="os_social-head-w"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
    </div>
  <?php endif;
}

function osetin_top_social_share(){
  if(get_field('disable_social_share_icons_on_post', 'option') != TRUE): ?>
    <div class="post-top-share">
      <i class="fa os-icon-plus share-activator-icon share-activator"></i>
      <span class="share-activator-label share-activator caption"><?php _e("Share", "pluto") ?></span>
      <div class="os_social-head-w"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
    </div>
  <?php endif;
}
function osetin_top_social_share_index(){
  if(os_is_post_element_active('social')): ?>
    <?php if(is_rtl()): ?>
      <div class="post-top-share">
        <span class="share-activator-label share-activator caption"><?php _e("Share", "pluto") ?></span>
        <i class="fa os-icon-plus share-activator-icon share-activator"></i>
        <div class="os_social-head-w"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
      </div>
    <?php else: ?>
      <div class="post-top-share">
        <i class="fa os-icon-plus share-activator-icon share-activator"></i>
        <span class="share-activator-label share-activator caption"><?php _e("Share", "pluto") ?></span>
        <div class="os_social-head-w"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
      </div>
    <?php endif; ?>
  <?php endif;
}

function os_is_post_element_active($element){
  $forse_hide_element = 'forse_hide_element_'.$element;
  global $$forse_hide_element;
  if(!isset($$forse_hide_element)) $$forse_hide_element = false;
  if($$forse_hide_element == true) return false;

  if(get_field('hide_from_index_posts', 'options')){
    return !in_array($element, get_field('hide_from_index_posts', 'options'));
  }else{
    return true;
  }
}

// Generate next page link for infinite scroll
function os_get_next_posts_link($os_query){
  $current_page = ( isset($os_query->query['paged']) ) ? $os_query->query['paged'] : 1;
  $next_page = ($current_page < $os_query->max_num_pages) ? $current_page + 1 : false;
  if($next_page){
    return http_build_query(wp_parse_args( array('paged' => $next_page), $os_query->query));
  }else{
    return false;
  }
}

// Loads get_template_part() into variable
function os_load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

function get_current_menu_position()
{
  if(isset($_SESSION['menu_position'])){
    $menu_position = $_SESSION['menu_position'];
  }else{
    $menu_position = get_field('menu_position', 'option');
  }
  return $menu_position;
}


function get_current_menu_style()
{
  if(isset($_SESSION['menu_style'])){
    $menu_style = $_SESSION['menu_style'];
  }else{
    $menu_style = get_field('menu_style', 'option');
  }
  return $menu_style;
}




function os_get_current_color_scheme()
{
  if(isset($_SESSION['color_scheme'])){
    $color_scheme = $_SESSION['color_scheme'];
  }else{
    $color_scheme = get_field('color_scheme', 'option');
  }
  return $color_scheme;
}


function os_get_current_navigation_type()
{
  if(isset($_SESSION['navigation_type'])){
    $navigation_type = $_SESSION['navigation_type'];
  }else{
    $navigation_type = get_field('index_navigation_type', 'option');
  }
  return $navigation_type;
}

function os_get_show_sidebar_on_masonry()
{
  if(isset($_SESSION['show_sidebar_on_masonry'])){
    if($_SESSION['show_sidebar_on_masonry'] == 'yes'){
      $show_sidebar_on_masonry = true;
    }else{
      $show_sidebar_on_masonry = false;
    }
  }else{
    $show_sidebar_on_masonry = get_field('show_sidebar_on_masonry_page', 'option');
  }
  return $show_sidebar_on_masonry;
}

function os_get_use_fixed_height_index_posts()
{
  if(isset($_SESSION['use_fixed_height_index_posts'])){
    if($_SESSION['use_fixed_height_index_posts'] == 'yes'){
      $use_fixed_height_index_posts = true;
    }else{
      $use_fixed_height_index_posts = false;
    }
  }else{

    global $forse_fixed_height;
    if(!isset($forse_fixed_height)) $forse_fixed_height = false;
    if($forse_fixed_height == true){
      $use_fixed_height_index_posts = true;
    }else{
      $use_fixed_height_index_posts = get_field('use_fixed_height_index_posts', 'option');
    }

  }
  return $use_fixed_height_index_posts;
}

function os_get_show_featured_posts_on_index()
{
  if(isset($_SESSION['show_featured_posts_on_index'])){
    if($_SESSION['show_featured_posts_on_index'] == 'yes'){
      $show_featured_posts_on_index = true;
    }else{
      $show_featured_posts_on_index = false;
    }
  }else{
    $show_featured_posts_on_index = get_field('show_featured_posts_on_index', 'option');
  }
  return $show_featured_posts_on_index;
}

function os_get_featured_posts_type_on_index()
{
  if(isset($_SESSION['featured_posts_type_on_index'])){
    $featured_posts_type_on_index = $_SESSION['featured_posts_type_on_index'];
  }else{
    $featured_posts_type_on_index = get_field('featured_posts_type_on_index', 'option');
  }
  return $featured_posts_type_on_index;
}


/**
 * Osetin themes helpers functions
 *
 * @package Jupiter
 *
 */

function osetin_translate_column_width_to_span( $width = '' ){
  switch ( $width ) {
    case "1/12" :
      $column_class = "col-sm-1";
      break;
    case "1/6" :
      $column_class = "col-sm-2";
      break;
    case "1/4" :
      $column_class = "col-sm-3";
      break;
    case "1/3" :
      $column_class = "col-sm-4";
      break;
    case "5/12" :
      $column_class = "col-sm-5";
      break;
    case "1/2" :
      $column_class = "col-sm-6";
      break;
    case "7/12" :
      $column_class = "col-sm-7";
      break;
    case "2/3" :
      $column_class = "col-sm-8";
      break;
    case "3/4" :
      $column_class = "col-sm-9";
      break;
    case "5/6" :
      $column_class = "col-sm-10";
      break;
    case "11/12" :
      $column_class = "col-sm-11";
      break;
    case "1/1" :
      $column_class = "col-sm-12";
      break;
    default :
      $column_class = "col-sm-12";
    }
    return $column_class;
}


/**
 * Get url for the color directory with images
 */
function osetin_get_color_images_directory_uri($color = 'blue')
{
  return get_template_directory_uri() . "/assets/images/colors/" . $color;
}


/**
 * Get url for the color directory with images
 */
function osetin_get_images_directory_uri()
{
  return get_template_directory_uri() . "/assets/images";
}


function osetin_get_media_content($size = false, $forse_single = false)
{
  switch(get_post_format()):
    case "video": ?>
      <div class="post-video-box post-media-body">
        <?php
        global $wp_embed;
        echo $wp_embed->run_shortcode('[embed]'.get_field('video_url').'[/embed]');
        ?>
      </div>
      <?php
    break;
    case "gallery": ?>
      <?php
        $images = get_field('gallery_of_images');
        if( $images ): ?>
          <div class="post-gallery-box post-media-body">
            <div id="slider-<?php the_ID(); ?>" class="flexslider">
              <ul class="slides">
                <?php foreach( $images as $image ):
                  if($size != false){
                    $img_src = $image['sizes']["{$size}"];
                  }else{
                    if(is_single()){
                      $img_src = $image['sizes']['large'];
                    }else{
                      $img_src = (os_get_use_fixed_height_index_posts() == true) ? $image['sizes']['pluto-fixed-height'] : $image['sizes']['pluto-index-width'];
                    }
                  } ?>
                  <li><img src="<?php echo $img_src; ?>" alt="<?php echo $image['alt']; ?>" /></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div><?php
        else:
          os_output_post_thumbnail($size, $forse_single);
        endif; ?>
      <?php
    break;
    case "image":
      os_output_post_thumbnail($size, $forse_single);
    break;
    default:
      os_output_post_thumbnail($size, $forse_single);
    break;
  endswitch;
}


function os_ad_between_posts(){
  global $os_ad_block_counter;
  global $os_current_box_counter;
  if(get_field('enable_ads_between_posts', 'option') === true){
    // remove anything except commas and numbers from a position list
    $clean_positions = preg_replace( array('/[^\d,]/', '/(?<=,),+/', '/^,+/', '/,+$/'), '', get_field('ad_positions', 'option'));
    $os_positions = explode(",", $clean_positions);

    if(in_array($os_current_box_counter, $os_positions)){
      $ad_blocks = get_field('ad_blocks', 'option');
      if(isset($ad_blocks[$os_ad_block_counter])){
        $current_ad_block = $ad_blocks[$os_ad_block_counter];
        switch( $current_ad_block['ad_type'] ){
          case 'image':
            echo '<div class="item-isotope"><article class="pluto-post-box"><div class="post-body"><div class="post-media-body"><a href="'.$current_ad_block['ad_link'].'"><figure><img src="'.$current_ad_block['ad_image'].'" alt="pluto"/></figure></a></div></div></article></div>';
            $os_ad_block_counter++;
          break;
          case 'html':
            echo '<div class="item-isotope"><article class="pluto-post-box"><div class="post-body"><div class="post-media-body">'.$current_ad_block['ad_html'].'</div></div></article></div>';
            $os_ad_block_counter++;
          break;
        }
      }
    }
  }
  $os_current_box_counter++;
}


function os_output_post_thumbnail($size = false, $forse_single = false)
{
  if(has_post_thumbnail()):
    if(is_single() || $forse_single): ?>
      <div class="post-media-body">
        <div class="figure-link-w">
          <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="figure-link os-lightbox-activator">
            <figure>
            <?php
            if($size != false){
              $thumb_size = $size;
            }else{
              $thumb_size = 'full';
            } ?>
            <?php the_post_thumbnail($thumb_size); ?>
            <?php if(get_field('disable_image_hover_effect', 'option') != true): ?>
              <div class="figure-shade"></div><i class="figure-icon os-icon-thin-098_zoom_in_magnify_plus"></i>
            <?php endif ?>
            </figure>
          </a>
        </div>
      </div> <?php
    else:
      if($size != false){
        $img_html = get_the_post_thumbnail(get_the_ID(), $size);
      }else{
        if ( basename(get_page_template()) == 'page-blog.php' ) {
          $img_html =  get_the_post_thumbnail(get_the_ID(), 'full');
        }else{
          $img_html = (os_get_use_fixed_height_index_posts() == true) ? get_the_post_thumbnail(get_the_ID(), 'pluto-fixed-height') : get_the_post_thumbnail(get_the_ID(), 'pluto-index-width');
        }
      }
      $shade_html = (get_field('disable_image_hover_effect', 'option') == true) ? "" : '<div class="figure-shade"></div><i class="figure-icon os-icon-thin-044_visability_view_watch_eye"></i>';
      $os_link = get_post_format() == 'link' ? get_field('external_link') : get_permalink(); ?>
      <?php $new_window = (get_post_format() == 'link') ? 'target="_blank"' : ""; ?>
      <div class="post-media-body"><div class="figure-link-w"><a href="<?php echo $os_link; ?>" <?php echo $new_window ?> class="figure-link"><figure><?php echo $img_html; ?><?php echo $shade_html; ?></figure></a></div></div>
      <?php
    endif;
  endif;
}



if ( ! function_exists( 'osetin_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Pluto 1.0
 *
 * @return void
 */
function osetin_the_attached_image() {
  $post                = get_post();
  /**
   * Filter the default Pluto attachment size.
   *
   * @since Pluto 1.0
   *
   * @param array $dimensions {
   *     An array of height and width dimensions.
   *
   *     @type int $height Height of the image in pixels. Default 810.
   *     @type int $width  Width of the image in pixels. Default 810.
   * }
   */
  $attachment_size     = apply_filters( 'osetin_attachment_size', array( 810, 810 ) );
  $next_attachment_url = wp_get_attachment_url();

  /*
   * Grab the IDs of all the image attachments in a gallery so we can get the URL
   * of the next adjacent image in a gallery, or the first image (if we're
   * looking at the last image in a gallery), or, in a gallery of one, just the
   * link to that image file.
   */
  $attachment_ids = get_posts( array(
    'post_parent'    => $post->post_parent,
    'fields'         => 'ids',
    'numberposts'    => -1,
    'post_status'    => 'inherit',
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'order'          => 'ASC',
    'orderby'        => 'menu_order ID',
  ) );

  // If there is more than 1 attachment in a gallery...
  if ( count( $attachment_ids ) > 1 ) {
    foreach ( $attachment_ids as $attachment_id ) {
      if ( $attachment_id == $post->ID ) {
        $next_id = current( $attachment_ids );
        break;
      }
    }

    // get the URL of the next image attachment...
    if ( $next_id ) {
      $next_attachment_url = get_attachment_link( $next_id );
    }

    // or get the URL of the first image attachment.
    else {
      $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
    }
  }

  printf( '<a href="%1$s" rel="attachment">%2$s</a>',
    esc_url( $next_attachment_url ),
    wp_get_attachment_image( $post->ID, $attachment_size )
  );
}
endif;