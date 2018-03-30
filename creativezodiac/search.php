<?php /*
Template Name: search
*/ ?>
 <?php 
   global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =get_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    } 
 ?>
<?php
//$bloginfo = get_bloginfo('url');
$post_link = $_POST['post_link'];

  $post_id_parsing = strpos($post_link,"-");
    $blog_id = substr($post_link, 0, $post_id_parsing);
    $blog_category_id = get_post_meta( $blog_id , 'category_id', true );
 //   echo $blog_id."ddd";
$wpurl = get_bloginfo('url');
 query_posts($query_string."&posts_per_page=-1&cat=". $blog_category_id );
   if ( have_posts() ) : while ( have_posts() ) : the_post();
//   echo in_category(6)."kokot";
//   if(in_category($blog_category_id))
   {
    $permalink = get_permalink($post->id);
    $permalink = str_replace($wpurl."/", $wpurl."/#/".$post_link."/?link=".$post->id, $permalink);
    
  

//     echo $permalink."perm";
    $cat = "";
    foreach((get_the_category()) as $category) { 
                $cat = $category->cat_name; 
                //echo $cat."kokot";
                }
    $mydate =  strtotime($post->post_date);
    $mydate2 = date($cz_blog_search, $mydate);
    $image;
    
    
    if(get_post_meta($post->ID, 'portfolio_image_medium', true) == "")
    {
       $image = get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_large', true)."&h=54&w=54&zc=1";
    
    }
    else
    {
       $image = get_post_meta($post->ID, 'portfolio_image_medium', true);
      
    }

?>
      <div class="blog_search_result">
       <div class="blog_search_big_thumb">
       <a class="blog_search_link cboxElement" href="<?php echo $permalink?>" class="search_result_img">
          <img src="<?php echo $image ?>" class="blog_search_big_thumb_image" alt="thumb">
          <div class="blog_search_big_thumb_border"></div><!-- END "blog_gallery_big_thumb_border" -->
          <div class="blog_search_big_thumb_shine"></div><!-- END "blog_gallery_big_thumb_shine" -->
          </a><!-- END "blog_search_link" -->
      </div><!-- END "blog_search_big_thumb" -->
      <div class="blog_search_result_desc_wrapper">
          <div class="blog_search_result_meta_data">
              <p class="categories"><?php echo $cat; ?></p>
              <p class="date"><?php echo $mydate2 ?></p>
          </div><!-- END "blog_search_result_meta_data" -->
          <a href="<?php echo $permalink?>" class="search_result_h1"><h1><?php echo $post->post_title; ?>  </h1></a>
      </div><!-- END "blog_search_result_wrapper" -->
      <div class="clear_both"></div>
  </div><!-- END "blog_search_result" -->
<?php 
}  
   endwhile; else: 
   echo "<h1>".$cz_blogdesc_searchfail."</h1>"; 
endif; 

?>
