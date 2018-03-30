<?php get_header(); ?>

<div id="content">

   <div class="title-head"><h1><?php the_title(); ?></h1></div>
   <div class="atsng-col clearfix">					
      <div class="atsng-left">
<?php
$custom         = get_post_custom($post->ID);
$image_id       = get_post_thumbnail_id();
$cover          = wp_get_attachment_image_src($image_id, 'artist-single');
$cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
$name           = get_post_meta($post->ID, 'at_name', true);
$born           = get_post_meta($post->ID, 'at_born', true);
$place          = get_post_meta($post->ID, 'at_place', true);
$genres         = get_post_meta($post->ID, 'at_genres', true);
$active         = get_post_meta($post->ID, 'at_active', true);
$website        = get_post_meta($post->ID, 'at_website', true);
$time           = strtotime($born);
$pretty_date_yy = date('Y', $time);
$pretty_date_M  = date('F', $time);
$pretty_date_d  = date('d', $time);
$no_cover       = get_template_directory_uri();
echo '
         <div class="atsng-cover">
            <div class="wz-wrap wz-hover">';
if ($image_id) {
    echo '
               <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
} else {
    echo '
               <img src="' . $no_cover . '/images/no-cover/artist-sng.png" alt="no image" />';
}
echo '	
               <div class="he-view">
                  <div class="bg a1" data-animate="fadeIn">	
                     <a href="' . get_permalink() . '" class="atsng-link a2" data-animate="zoomIn"></a>
                     <a href="' . $cover_large[0] . '" class="atsng-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
                  </div>
               </div>	
            </div>			
         </div><!-- end .atsng-cover --> ';
echo '
         <div class="adsng-info"> ';
if ($name != null) {
    echo '	  
            <div class="evsng-info-in">
               <div class="atsng-cell">' . __('Birth name', 'wizedesign') . '</div>
               <div class="atsng-cell-info">' . $name . '</div>					  
            </div>';
}
if ($born != null) {
    echo '	 
            <div class="evsng-info-in">                                     
               <div class="atsng-cell">' . __('Born', 'wizedesign') . '</div>
               <div class="atsng-cell-info">' . $pretty_date_d . ' ' . $pretty_date_M . '  ' . $pretty_date_yy . '</div>                                    
            </div>';
}
if ($place != null) {
    echo '
            <div class="evsng-info-in">                                     
               <div class="atsng-cell">' . __('Birthplace', 'wizedesign') . '</div>
               <div class="atsng-cell-info">' . $place . '</div>                                    
            </div>';
}
if ($genres != null) {
    echo '
            <div class="evsng-info-in">                                     
               <div class="atsng-cell">' . __('Genres', 'wizedesign') . '</div>
               <div class="atsng-cell-info">' . $genres . '</div>                                    
            </div>';
}
if ($active != null) {
    echo '
            <div class="evsng-info-in">                                     
               <div class="atsng-cell">' . __('Years active', 'wizedesign') . '</div>
               <div class="atsng-cell-info">' . $active . '</div>                                    
            </div>';
}
if ($website != null) {
    echo '
            <div class="evsng-info-in">                                     
               <div class="atsng-cell">' . __('Website', 'wizedesign') . '</div>
               <div class="atsng-cell-info"><a href="' . $website . '" rel="nofollow" target="_blank">' . $website . '</a></div>                                    
            </div>';
}
echo '
         </div>';
?>

      </div><!-- end .atsng-left -->
      <div class="atsng-text">
         <div class="artist-post">
<?php
if (have_posts())
    while (have_posts()):
        the_post();
    endwhile;
?>

<?php the_content(); ?>

         </div><!-- end .artist-post -->
      </div><!-- end .atsng-text -->    
   </div><!-- end .atsng-col clearfix -->

</div><!-- end #content -->

<?php get_footer(); ?>