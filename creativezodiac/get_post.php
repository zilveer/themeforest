<?php /*
Template Name: get-post
*/ ?>
 <?php 
   global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =get_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    } 



if(!isset($_GET['post_link'])) $_GET['post_link'] = "1-ss";
else echo "actual-post-link:".$_GET['post_link'].";.;.;";
//echo $_GET['email'];
$post_link = $_GET['post_link'];
$post_id_parsing = strpos($post_link,"-");
$post_id = substr($post_link, 0, $post_id_parsing);
//echo $post_id;
$post_object = get_post($post_id);
//echo $post_object->post_title;
$template_name = get_post_meta( $post_id , '_wp_page_template', true );
//echo $template_name;
 $wpurl = get_bloginfo('url');

?>

<?php 
////////////////////////////////////////////////////////////       
// GALLERY TEMPLATE
////////////////////////////////////////////////////////////   
 if($template_name == "gallery.php")
 {
     echo "page-title:";bloginfo('name'); echo " | ".$post_object->post_title.";.;.;";
  $category_id = get_post_meta($post_id, 'category_id', true);   // exampe "1,2,3,50,49"
  $gallery_query = new WP_Query("cat=".$category_id."&posts_per_page=-1&order_by=id");
  echo "page-template:gallery-page;.;.;"; // javascript identification
  $post_counter = 0;
  
  while ($gallery_query->have_posts()) : $gallery_query->the_post();
 
    if(get_post_meta($post->ID, 'portfolio_image_video', true) == "true")
    echo "item-".$post_counter."-video:true;.;.;\n";
    else
    echo "item-".$post_counter."-video:false;.;.;\n";
    
    echo "item-".$post_counter."-title:".$post->post_title.";.;.;\n";
    echo "item-".$post_counter."-content:".$post->post_content.";.;.;\n";

     if(get_post_meta($post->ID, 'portfolio_image_large', true) == "")
    {
      if(get_post_meta($post->ID, 'portfolio_image_medium', true) !="")  
      echo "item-".$post_counter."-largeimg:".get_post_meta($post->ID, 'portfolio_image_medium', true).";.;.;\n";
      else
      echo "item-".$post_counter."-largeimg:".get_post_meta($post->ID, 'portfolio_image_small', true).";.;.;\n";

    }
    else
    {
     echo "item-".$post_counter."-largeimg:".get_post_meta($post->ID, 'portfolio_image_large', true).";.;.;\n";
      
    } 
        if(get_post_meta($post->ID, 'portfolio_image_medium', true) == "")
    {
      if(get_post_meta($post->ID, 'portfolio_image_large', true) !="")  
      echo "item-".$post_counter."-mediumimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_large', true)."&h=272&w=402&zc=1;.;.;\n";
      else
      echo "item-".$post_counter."-mediumimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_small', true)."&h=272&w=402&zc=1;.;.;\n";
                                                                                                                                               
      //echo "item-".$post_counter."-mediumimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_small', true)."&h=272&w=402&zc=1;.;.;\n";
      //echo "item-".$post_counter."-largeimg:".get_post_meta($post->ID, 'portfolio_image_small', true).";.;.;\n";
    }
    else
    {
     echo "item-".$post_counter."-mediumimg:".get_post_meta($post->ID, 'portfolio_image_medium', true).";.;.;\n";
      
    } 
    if(get_post_meta($post->ID, 'portfolio_image_small', true) == "")
    {
      if(get_post_meta($post->ID, 'portfolio_image_large', true) !="")  
      echo "item-".$post_counter."-smallimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_large', true)."&h=54&w=54&zc=1;.;.;\n";
      else
      echo "item-".$post_counter."-smallimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_medium', true)."&h=54&w=54&zc=1;.;.;\n";
                                                                                                                                               
      //echo "item-".$post_counter."-mediumimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_small', true)."&h=272&w=402&zc=1;.;.;\n";
      //echo "item-".$post_counter."-largeimg:".get_post_meta($post->ID, 'portfolio_image_small', true).";.;.;\n";
    } 
    else
    {
     echo "item-".$post_counter."-smallimg:".get_post_meta($post->ID, 'portfolio_image_small', true).";.;.;\n";
      
    }
    $post_counter++;
  endwhile;
    echo "item-count:".($post_counter-1).";.;.;";
  ?>
  

  <?php
 }
  else if($template_name == "contact.php")
  {
      echo "page-title:";bloginfo('name'); echo " | ".$post_object->post_title.";.;.;";
      echo "page-content:".$post_object->post_content.";.;.;";
      echo "page-template:contact-page;.;.;";
  }
////////////////////////////////////////////////////////////       
// BLOG TEMPLATE
////////////////////////////////////////////////////////////  
  else if($template_name == "blog.php")
  {
     echo "page-title:";bloginfo('name'); echo " | ".$post_object->post_title.";.;.;";
    echo "page-template:blog-page;.;.;"; // javascript identification
    $category_count = 0;
    $category_id;
    $blog_parent = $_GET['blog_parent'];    // blog parent link
    // najit prvni /, najit druhe /, najit treti /
    // najit posledni   /"
    // treti a posledni substr
    // wpurl + /#/ + blog_parent + / + post_id + post_permalink
    
    // najit wpurl
    $category_id = get_post_meta($post_id, 'category_id', true); // get category
    $catlist = wp_list_categories("echo=0&child_of=".$category_id."&title_li=");
    $catlist = ereg_replace("<li[^>]*>", "<li>", $catlist);
    $catlist = str_replace("title=","class=\"blog_menu_category_title\" title=", $catlist );
    $catlist = str_replace("<li>","<div class=\"blog_menu_divider\"></div><li>", $catlist );


    $going = true;
    $actual_pos = 0;
    while($going)
    {
    $start = strpos($catlist, "title=\"", $actual_pos) + 7;
      if($actual_pos > $start) $going = false;
      else
      {
        
        //echo $substr()
        $start = strpos($catlist, "\">", $start) + 2;
        $end = strpos($catlist, "<", $start); 
        $cat_name = substr($catlist, $start, $end - $start);
        $cat_id =  get_cat_ID($cat_name);
  
        $catlist = str_replace(">".$cat_name, " rel=\"".$cat_id."\">".$cat_name, $catlist);
      //  echo $cat_id;
        $actual_pos = $start;
        $categorys_id[$category_count] = $cat_id;
         //     echo  $categorys_id[$category_count]." ". $category_count;
        $category_count++;
      }
    }
    
    $going = true;
    $actual_pos = 0;
       
    while($going)
    {
      $start = strpos($catlist, "href=\"", $actual_pos) + 6;
      if($actual_pos > $start) $going = false;
      else
      {
        //echo $substr()
        
        $end = strpos($catlist, "\"", $start);
        $oldlink = (substr($catlist, $start, $end - $start));
        $newlink = $wpurl."/#/".$_GET['post_link']."/";
        $catlist = str_replace($oldlink, $newlink, $catlist);
        $actual_pos = $start;
      }
    }
    $blogpost = "";
      for($i = 0; $i < $category_count; $i++)
   { 
 //  echo "kokot";
       $blogpost = $blogpost.'<ul id="bloglist-'.$categorys_id[$i].'" class="blog_menu_posts blog-list-'.$categorys_id[$i].'" style="display:none; left:218px;"><div class="blog_menu_divider"></div>';
//  echo $category_id[$i];      
      $blog_query = new WP_Query("cat=".$categorys_id[$i]."&posts_per_page=-1&order_by=id");
    
      while ($blog_query->have_posts()) : $blog_query->the_post(); 
        
       $small ="";
        if(get_post_meta($post->ID, 'portfolio_image_small', true) == "")
        {
          if(get_post_meta($post->ID, 'portfolio_image_large', true) !="")  
          $small = get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_large', true)."&h=28&w=28&zc=1";
          else
          $small = get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_medium', true)."&h=28&w=28&zc=1";
                                                                                                                                                   
          //echo "item-".$post_counter."-mediumimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_small', true)."&h=272&w=402&zc=1;.;.;\n";
          //echo "item-".$post_counter."-largeimg:".get_post_meta($post->ID, 'portfolio_image_small', true).";.;.;\n";
        } 
        else
        {
        $small = get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_small', true)."&h=28&w=28&zc=1";
          
        }
       
      $permalink = get_permalink($post->id);
      $permalink = str_replace($wpurl."/", $wpurl."/#/".$post_link."/?link=".$post->id, $permalink);
      $blogpost = $blogpost.'<li>';
      if(get_post_meta($post->ID, 'blog_display_navigationimg', true)  == "true")
      {
        $blogpost = $blogpost.'<div class="blog_menu_thumb_wrapper">';
        $blogpost = $blogpost.'<img src="'.$small.'" alt="post" class="blog_menu_thumb" />';
        $blogpost = $blogpost.'<div class="blog_menu_thumb_border"></div><!-- END "blog_menu_thumb_border" -->';
        $blogpost = $blogpost.'<div class="blog_menu_thumb_shine"></div>';
        $blogpost = $blogpost.'</div><!-- END "blog_menu_thumb_wrapper" -->';
      }
      $blogpost = $blogpost.'<a href="'.$permalink.'" class="blog_menu_post_title">'.$post->post_title.'</a>';
      $blogpost = $blogpost.'<div class="clear_both"></div>';
      $blogpost = $blogpost.'</li>';
      $blogpost = $blogpost.'<div class="blog_menu_divider"></div>';
      //$blogpost = $blogpost.'<li>\n';
      echo $post->post_title ;

      endwhile;
      $blogpost = $blogpost.'</ul>';
      //echo "item-count:".($post_counter-1).";.;.;";
    }

     echo "category-content:<ul class=\"blog_menu_categories\">".$catlist."<div class=\"blog_menu_divider\"></div></ul>;.;.;";
     echo "bloglist-content:".$blogpost.";.;.;";
     $my_location = $wpurl."/#/".$post_link."/?link=".get__name(get_post_meta($post_id, 'actualpost_id', true))."/";
     if(get_post_meta($post_id, 'actualpost_id', true) != "") echo "start-page:".$my_location.";.;.;";
     else
     {
     
           $actualpost_query = new WP_Query("posts_per_page=1&cat=".get_post_meta($post_id, 'category_id', true));
             while ($actualpost_query->have_posts()) : $actualpost_query->the_post();
                  $my_location = $wpurl."/#/".$post_link."/?link=".get__name($post->ID)."/";
             
               echo "start-page:".$my_location.";.;.;";
            endwhile;   
     }
     //get__name(get_post_meta($post_id, 'actualpost_id', true))
  }
  
////////////////////////////////////////////////////////////       
// PAGE TEMPLATE
////////////////////////////////////////////////////////////  
 else if(!isset($_GET['blogpost']))
 {
  $content = $post_object->post_content;
 	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	// throw out trimmed: content to process, read more tag, post permalink, words length
	$content =  trim_the_content( $content, 'READ MORE...', "ss", 45 );

 
             echo "page-title:";bloginfo('name'); echo " | ".$post_object->post_title.";.;.;";
          //   global $more;
           //  $more =1;
 ?>
    
            <?php 
                echo "page-content:". $content .";.;.;"; 
            
            
            ?>
  
 <?php
 }
 else if($_GET['blogpost']==1)
 {
    echo "post-title:".$post_object->post_title.";.;.;";
        $small = "";
        if(get_post_meta($post_object->ID, 'portfolio_image_medium', true) == "")
        {
          if(get_post_meta($post_object->ID, 'portfolio_image_large', true) !="")  
          $small = get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post_object->ID, 'portfolio_image_large', true)."&h=54&w=54&zc=1";
          else
          $small = get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post_object->ID, 'portfolio_image_small', true)."&h=54&w=54&zc=1";
                                                                                                                                                   
          //echo "item-".$post_counter."-mediumimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_small', true)."&h=272&w=402&zc=1;.;.;\n";
          //echo "item-".$post_counter."-largeimg:".get_post_meta($post->ID, 'portfolio_image_small', true).";.;.;\n";
        } 
        else
        {
        $small = get_post_meta($post_object->ID, 'portfolio_image_medium', true);
          
        }
        
               $large = "";
        if(get_post_meta($post_object->ID, 'portfolio_image_large', true) == "")
        {
          if(get_post_meta($post_object->ID, 'portfolio_image_medium', true) !="")  
           $large =get_post_meta($post_object->ID, 'portfolio_image_medium', true);
         else
          $large =get_post_meta($post_object->ID, 'portfolio_image_small', true);
                                                                                                                                                  
          //echo "item-".$post_counter."-mediumimg:".get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'portfolio_image_small', true)."&h=272&w=402&zc=1;.;.;\n";
          //echo "item-".$post_counter."-largeimg:".get_post_meta($post->ID, 'portfolio_image_small', true).";.;.;\n";
        } 
        else
        {
        $large =get_post_meta($post_object->ID, 'portfolio_image_large', true);
          
        }
    
                                        

    echo "post-content:";  
    if(get_post_meta($post_object->ID, 'blog_display_mediumimg', true)  == "true") echo '<p><div class="blog_big_thumb"><a class="blog_thumb_colorbox" href="'.$large.'"><img alt="thumb" class="blog_big_thumb_image" src="'.$small.'">
    <div class="blog_big_thumb_border"></div><!-- END "blog_big_thumb_border" -->
    <div class="blog_big_thumb_shine"></div><!-- END "blog_big_thumb_shine" --></a>
</div><!-- END "blog_big_thumb" -->';
  $content = $post_object->post_content;
 	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	// throw out trimmed: content to process, read more tag, post permalink, words length
	$content =  trim_the_content( $content, 'READ MORE...', "ss", 45 );
  $content = str_replace("<p><p>", "<p>", $content);
  $content = str_replace("</p></p>", "</p>", $content);
  $content = str_replace("<p></p>", "", $content);
  echo $content.";.;.;";
    $post_date ="";
     if(get_post_meta($post_object->ID, 'blog_display_date', true)  == "true") $post_date = date($cz_blog_postdate,strtotime($post_object->post_date));
    echo "post-date:".$post_date.";.;.;";
    echo "post-category:";
     if(get_post_meta($post_object->ID, 'blog_display_category', true) == "true")
        foreach((get_the_category($post_id)) as $categoryss) { 
            echo $categoryss->cat_name; 
        } 
    
    echo ";.;.;";
    
    echo "meta-data:".get_post_meta($post_object->ID, 'blog_display_metabox', true).";.;.;";
    echo "comment-count:".$post_object->comment_count.";.;.;"; 
    echo "gallery-content:";
        $mykey_values = get_post_custom_values('gallery', $post_id);
        if($mykey_values == null) echo "<h1>".$cz_blogdesc_gallery."</h1>";
        else
        {
      foreach ( $mykey_values as $key => $value ) {
      
      ?>
    
     <div class="blog_gallery_big_thumb">
         <a href="<?php echo $value; ?>" class="blog_gallery_link">
    <img alt="thumb" class="blog_gallery_big_thumb_image" src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$value."&h=54&w=54&zc=1"; ?>">
    
    <div class="blog_gallery_big_thumb_border"></div><!-- END "blog_gallery_big_thumb_border" -->
    <div class="blog_gallery_big_thumb_shine"></div><!-- END "blog_gallery_big_thumb_shine" -->
    </a> 
</div><!-- END "blog_gallery_big_thumb" -->
      <?php
           }
           }   
    echo ";.;.;";
    echo "share-content:";
    
    
   // DIGG  ///////////////
    $li = get_bloginfo('url')."/#/".$_GET['blogpost_linkaa']."/?link=".get__name($post_object->ID)."/";
//    echo    $_GET['blogpost_linkaa']."/".$li;
    $link =  getLink("http://digg.com/submit",array( "url"=> $li, "title"=>$post_object->post_title));
    //echo $cz_sh_digg;
    if($cz_sh_digg =="true")  echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/digg.png" /></a>';
    
    $link =  getLink("http://delicious.com/post",array( "url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_delicious == true) echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="delicious" src="'.get_bloginfo('template_url').'/gfx/share_icons/delicious.png" /></a>';
    
    $link =  getLink("http://www.facebook.com/share.php",array( "u"=> $li, "t"=>$post_object->post_title));
    if($cz_sh_facebook =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="facebook" src="'.get_bloginfo('template_url').'/gfx/share_icons/facebook.png" /></a>';
    
    $link =  getLink("http://www.mixx.com/submit",array( "page_url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_mixx =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="mixx" src="'.get_bloginfo('template_url').'/gfx/share_icons/mixx.png" /></a>';
    
    $link =  getLink("http://www.google.com/bookmarks/mark",array( "op"=> "edit", "bkmk"=> $li, "title"=>$post_object->post_title,  "annotation"=>$post_object->post_content));
    if($cz_sh_google =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="google" src="'.get_bloginfo('template_url').'/gfx/share_icons/google.png" /></a>';
    
    $link =  getLink("http://www.designfloat.com/submit.php",array( "url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_designfloat =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="designfloat" src="'.get_bloginfo('template_url').'/gfx/share_icons/designfloat.png" /></a>'; 

    $link =  getLink("mailto:",array( "body"=> $li, "subject"=>$post_object->post_title));
    if($cz_sh_email =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="mailto" src="'.get_bloginfo('template_url').'/gfx/share_icons/email.png" /></a>'; 
    
    $link =  getLink("http://www.friendfeed.com/share",array( "link"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_friendfeed =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="friendfeed" src="'.get_bloginfo('template_url').'/gfx/share_icons/friendfeed.png" /></a>';   
    
    $link =  getLink("http://www.linkedin.com/shareArticle",array("mini"=> "true", "url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_linkedin =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="linkedin" src="'.get_bloginfo('template_url').'/gfx/share_icons/linkedin.png" /></a>';               
    
    $link =  getLink("https://favorites.live.com/quickadd.aspx",array("marklet"=> "1", "url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_microsoft =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="microsoft" src="'.get_bloginfo('template_url').'/gfx/share_icons/microsoft.png" /></a>';  
    
    $link =  getLink("http://reporter.nl.msn.com/",array("fn"=> "contribute", "URL"=> $li, "Title"=>$post_object->post_title));
    if($cz_sh_msn =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="msn" src="'.get_bloginfo('template_url').'/gfx/share_icons/msn.png" /></a>';     
    
    $link =  getLink("http://www.myspace.com/Modules/PostTo/Pages/",array("u"=> $li, "t"=>$post_object->post_title));
    if($cz_sh_myspace =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="myspace" src="'.get_bloginfo('template_url').'/gfx/share_icons/myspace.png" /></a>';  
    
    $link =  getLink("http://www.netvibes.com/share",array("url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_netvibes =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="netvibes" src="'.get_bloginfo('template_url').'/gfx/share_icons/netvibes.png" /></a>';
    
    $link =  getLink("http://www.newsvine.com/_tools/seed&amp;save",array("u"=> $li, "h"=>$post_object->post_title));
    if($cz_sh_newsvine =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="newsvine" src="'.get_bloginfo('template_url').'/gfx/share_icons/newsvine.png" /></a>';
    
    $link =  getLink("http://posterous.com/share",array("linkto"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_posterous =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="posterous" src="'.get_bloginfo('template_url').'/gfx/share_icons/posterous.png" /></a>';  

    $link =  getLink("http://reddit.com/submit",array("url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_reddit =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="reddit" src="'.get_bloginfo('template_url').'/gfx/share_icons/reddit.png" /></a>';    
    
    $link = get_bloginfo('url')."/feed/";
    if($cz_sh_rss =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="rss" src="'.get_bloginfo('template_url').'/gfx/share_icons/rss.png" /></a>';    
    
    $link =  getLink("http://slashdot.org/bookmark.pl",array("url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_slashdots =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="slashdot" src="'.get_bloginfo('template_url').'/gfx/share_icons/slashdot.png" /></a>';    
    
    $link =  getLink("http://www.stumbleupon.com/submit",array("url"=> $li, "title"=>$post_object->post_title));
    if($cz_sh_stumbleupon =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="stumbleupon" src="'.get_bloginfo('template_url').'/gfx/share_icons/stumbleupon.png" /></a>';  
    
    $link =  getLink("http://technorati.com/faves",array("add"=> $li));
    if($cz_sh_technorati =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="technorati" src="'.get_bloginfo('template_url').'/gfx/share_icons/technorati.png" /></a>'; 
    
    $link =  getLink("http://www.tumblr.com/share",array("u"=> $li, "t"=>$post_object->post_title));
    if($cz_sh_tumblr =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="tumblr" src="'.get_bloginfo('template_url').'/gfx/share_icons/tumblr.png" /></a>';
    
    $link =  getLink("http://twitter.com/home",array("status"=> $li));
    if($cz_sh_twitter =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="twitter" src="'.get_bloginfo('template_url').'/gfx/share_icons/twitter.png" /></a>';
    
    $link =  getLink("http://buzz.yahoo.com/submit/",array("submitUrl"=> $li, "submitHeadline"=>$post_object->post_title));
    if($cz_sh_yahoo =="true")echo '<a rel="nofollow" href="'.$link.'"><img class="share_icon" alt="yahoo" src="'.get_bloginfo('template_url').'/gfx/share_icons/yahoo-buzz.png" /></a>';        
    
                        
    echo ";.;.;";

 }
 
 else if($_GET['blogpost']=="comments")
 {

    $comment_query = new WP_Query("p=".$post_id);
     while ($comment_query->have_posts()) : $comment_query->the_post();
       comments_template();
    endwhile;   
    
    if ('open' == $post->comment_status){    ?>
           <div id="respond">
                            <h3><?php echo $cz_blogcom_leaveacom; ?></h3>
                            <form id="commentform" method="post">
                                <input type="hidden" value="<?php echo $post_id; ?>-something" class="text_input id_input" name="post_comment_id" id="post_comment_id">
                                <p>     
                                    <input type="text" tabindex="1" size="22" value="" id="author" class="text_input author_input" name="author">
                                    <label for="author"><small><?php echo $cz_blogcom_name ?>*</small></label>
                                </p>
                                <p>
                                    <input type="text" tabindex="2" size="22" value="" id="email" class="text_input email_input" name="email">
                                    <label for="email"><small><?php echo $cz_blogcom_email ?>*</small></label>
                                </p>
                                <p>
                                    <input type="text" tabindex="3" size="22" value="" id="url" class="text_input url_input" name="url">
                                    <label for="url"><small><?php echo $cz_blogcom_website ?></small></label>
                                </p>
                                <p>
                                    <textarea tabindex="4" class="text_area comment_input" rows="10" cols="100%" id="comment" name="comment"></textarea>
                                </p>
                                <p>
                                     <span id="submit" class="go_btn_wrapper">
                                         <span class="go_btn_left"></span>
                                        <span class="go_btn_right"><?php echo $cz_blogcom_submit ?></span>
                                    </span><!-- END "submit" -->
                                    
                                </p>
                            </form><!-- END "commentform" -->
            </div><!-- END "respond" -->
    <?php
     }    

 echo ";.;.;";

 }
else if($_GET['blogpost']=="comments-send")
 {
 // $address = $wpurl."/wp-comments-post.php";
  // <form action="http://demo.freshface.cz/file/lcp/wp/ylw/wp-comments-post.php" method="post" id="commentform">
  // author, email, url, comment, comment_post_ID
  $author = $_GET['autor'];
  $website = $_GET['website'];
  $comment = $_GET['comment'];
  $email = $_GET['email'];
     $content = 'author='.$author.'&email='.$email.'&url='.$website.'&comment='.$comment.'&comment_post_ID='.$post_id;

     $URL=$wpurl."/wp-comments-post.php";   
$ch = curl_init(); 

curl_setopt($ch, CURLOPT_URL,$URL); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
$htmls = curl_exec ($ch);    
curl_close ($ch);

  $comment_query = new WP_Query("p=".$post_id);
     while ($comment_query->have_posts()) : $comment_query->the_post();
       comments_template();
    endwhile;       ?>
           <div id="respond">
                            <h3><?php echo $cz_blogcom_leaveacom; ?></h3>
                            <form id="commentform" method="post" action="http://www.kriesi.at/demos/display/wp-comments-post.php">
                            <input type="hidden" value="<?php echo $post_id; ?>-something" class="text_input id_input" name="post_comment_id" id="post_comment_id">
                                <p>     
                                    <input type="text" tabindex="1" size="22" value="" id="author" class="text_input author_input" name="author">
                                    <label for="author"><small><?php echo $cz_blogcom_name ?>*</small></label>
                                </p>
                                <p>
                                    <input type="text" tabindex="2" size="22" value="" id="email" class="text_input email_input" name="email">
                                    <label for="email"><small><?php echo $cz_blogcom_email ?>*</small></label>
                                </p>
                                <p>
                                    <input type="text" tabindex="3" size="22" value="" id="url" class="text_input url_input" name="url">
                                    <label for="url"><small><?php echo $cz_blogcom_website ?></small></label>
                                </p>
                                <p>
                                    <textarea tabindex="4" class="text_area comment_input" rows="10" cols="100%" id="comment" name="comment"></textarea>
                                </p>
                                <p>
                                     <span id="submit" class="go_btn_wrapper">
                                         <span class="go_btn_left"></span>
                                        <span class="go_btn_right"><?php echo $cz_blogcom_submit ?>t</span>
                                    </span><!-- END "submit" -->
                                    
                                </p>
                            </form><!-- END "commentform" -->
                        </div><!-- END "respond" -->
    <?php
       

 echo ";.;.;";
 
   
//echo $content."    ".$htmls." nehehe";
  /*
      $server= $wpurl;
      $url = '/wp-comments-post.php';
      //$content = 'name1=value1&name2=value2';
      $content_length = strlen($content);
      $headers= "post $url HTTP/1.0\r\nContent-type: text/html\r\nHost: $server\r\nContent-length: $content_length\r\n\r\n";
      $fp = fsockopen($server, 80, $errno, $errstr);
      if (!$fp) return false;
      fputs($fp, $headers);
      fputs($fp, $content);
      $ret = "";
      while (!feof($fp)) {
      $ret.= fgets($fp, 1024);
      }
      fclose($fp);
      print $ret; 
      echo $ret."pica";*/
 }
 else if($_GET['blogpost']=="search")
 {
       $URL=$wpurl."/?s=".$_GET['searchthing']."&submit=Search";
          
        $ch = curl_init(); 
         if($_GET['searchthing'] != "")
         {
        curl_setopt($ch, CURLOPT_URL,$URL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "post_link=".$_GET['blog_link']);
        $htmls = curl_exec ($ch);    
        curl_close ($ch);
      //  echo $_GET['blog_link'];
        }
        echo $htmls;
 }
 if($_GET['email'] =="1")
 {
    echo "pica";
    $sender_email = $_GET['sender_mail'];
    $sender_name = $_GET['sender_name'];
    $sender_message = $_GET['sender_message'];
    
    include "class.phpmailer.php";
    $mail = new PHPMailer();
    $mail->IsMail();
    $mail->IsHTML(true);    
    $mail->CharSet  = "utf-8";
    $mail->From     = $sender_email;
    $mail->FromName = $sender_name;
    $mail->WordWrap = 50;    
    $mail->Subject  =  $cz_contact_subject;
    $mail->Body     =  $sender_message; //
    $mail->AddAddress($cz_contact_yourmail);
    $mail->AddReplyTo($cz_contact_yourmail);
    if(!$mail->Send()) {  // send e-mail
      $status = "ok";
    }
    else
    {
       $status = "wrong";
    }
    echo $status;
 }
 
 function getLink($url,$params=array(),$use_existing_arguments=false) {
    if($use_existing_arguments) $params = $params + $_GET;
    if(!$params) return $url;
    $link = $url;
    if(strpos($link,'?') === false) $link .= '?'; //If there is no '?' add one at the end
    elseif(!preg_match('/(\?|\&(amp;)?)$/',$link)) $link .= '&amp;'; //If there is no '&' at the END, add one.
    
    $params_arr = array();
    foreach($params as $key=>$value) {
        if(gettype($value) == 'array') { //Handle array data properly
            foreach($value as $val) {
                $params_arr[] = $key . '[]=' . urlencode($val);
            }
        } else {
            $params_arr[] = $key . '=' . urlencode($value);
        }
    }
    $link .= implode('&amp;',$params_arr);
    
    return $link;
} 
?>