<?php
    $themename = "CreativeZodiac";  
 $shortname = "cz"; 
 

  $array_counter = 0;        
 

 //post_type=page;
   $options = array (  
     
   array( "name" => $themename." Options",  
       "type" => "title"),  
     
   array( "name" => "GENERAL",  
       "type" => "section"),  
   array( "type" => "open"),  
     
   array( "name" => "Logo Url",  
       "desc" => "Url of your logo",  
       "id" => $shortname."_logo_url",  
       "type" => "text",  
       "std" => get_bloginfo('template_url')."/gfx/logo.png"),  
     
   array( "name" => "Link of getpost page",  
       "desc" => "This page is very important and makes the preloading",  
       "id" => $shortname."_getpost_link",  
       "type" => "text",  
       "std" => get_bloginfo('url')."/getpost/"),
       
  array( "name" => "Exclude pages from Navigation",  
       "desc" => "Enter pages IDs, divided by ','",  
       "id" => $shortname."_exclude",  
       "type" => "text",  
       "std" => ""), 
       
  array( "name" => "Introbox 1 target URL",  
       "desc" => "Direct link to page which you want to show after you click on introbox 1",  
       "id" => $shortname."_introbox1_link",  
       "type" => "introbox",
       "options" => $introbox_page, 
       "std" => "http://www.yoursite.com/#/1-landingpage"),    
       
   array( "name" => "Introbox 2 target URL",  
       "desc" => "Direct link to page which you want to show after you click on introbox 2",  
       "id" => $shortname."_introbox2_link",  
       "type" => "introbox",
       "options" => $introbox_page, 
       "std" => "http://www.yoursite.com/#/2-landingpage"),    
       
   array( "name" => "Introbox 3 target URL",  
       "desc" => "Direct link to page which you want to show after you click on introbox 3",  
       "type" => "introbox",
            "id" => $shortname."_introbox3_link",  
       "options" => $introbox_page, 
       "std" => "http://www.yoursite.com/#/4-landingpage"),   
     
   array( "name" => "Display landing page instead of IntroBox page",  
       "desc" => "Directly redirect to the page instead of introboxes",  
       "id" => $shortname."_landing_check",  
       "type" => "checkbox",  
       "std" => ""),
       
   array( "name" => "Link to Landing Page",  
       "desc" => "Direct link to page which you want to show instead introboxes",  
       "id" => $shortname."_landing_link",  
       "type" => "text",  
       "std" => "http://www.yoursite.com/#/3-landingpage"),             
     
   array( "type" => "close"),
     
   array( "name" => "VCARD FUNCTION",  
       "type" => "section"),  
   array( "type" => "open"),  
     
   array( "name" => "Enable vcard function? (icon + tooltip)",  
       "desc" => "When checked, the icon and tooltip appears",  
       "id" => $shortname."_tooltip_vcardchb",  
      "type" => "checkbox",  
       "std" => ""),  
  
   array( "name" => "Icon url",  
       "desc" => "Leave this field blank if you want to display the defauld vcard icon. If not, use the absolute links, e.g. http://www.mysite.com/icon.png",  
       "id" => $shortname."_tooltip_iconlink",  
      "type" => "text",  
       "std" => ""), 
     
   array( "name" => "Tooltip text",  
       "desc" => "which appear in the tooltip",  
       "id" => $shortname."_tooltip_text",  
       "type" => "text",  
       "std" => "Download my V-Card"),
  
  array( "name" => "Tooltip link",  
       "desc" => "which leads directly to your vcard download",  
       "id" => $shortname."_tooltip_link",  
       "type" => "text",  
       "std" => "http://www.yourwebsite.com/vcard.rar"),  
     
   array( "type" => "close"),  
   array( "name" => "CONTACT FORM",  
       "type" => "section"),  
   array( "type" => "open"),  
     
   array( "name" => "Name label",  
       "desc" => "Label for name input field",  
       "id" => $shortname."_contact_name",  
       "type" => "text",  
       "std" => "Enter your name:"),  
     
   array( "name" => "Email label",  
       "desc" => "Label for email input field",  
       "id" => $shortname."_contact_email",  
       "type" => "text",  
       "std" => "Enter your email:"),      
     
   array( "name" => "Message label",  
       "desc" => "label for message input field",  
       "id" => $shortname."_contact_message",  
       "type" => "text",  
       "std" => "Enter your message:"),     
     
   array( "name" => "Next step button",  
       "desc" => "Next step button",  
       "id" => $shortname."_contact_next",  
       "type" => "text",  
       "std" => "Next Step"),
       
   array( "name" => "Send email button",  
       "desc" => "Sebnd email button",  
       "id" => $shortname."_contact_send",  
       "type" => "text",  
       "std" => "Send Email"),         
    
  array( "name" => "Send another button",  
       "desc" => "Send another",  
       "id" => $shortname."_contact_another",  
       "type" => "text",  
       "std" => "Send another?"), 
       
  array( "name" => "Subject of incoming emails",  
       "desc" => "Edit the subject of your incoming emails",  
       "id" => $shortname."_contact_subject",  
       "type" => "text",  
       "std" => "Creative Zodiac contact form"),
  
  array( "name" => "Your email",  
       "desc" => "Edit the subject of your incoming emails",  
       "id" => $shortname."_contact_yourmail",  
       "type" => "text",  
       "std" => "your@email.com"),  
       
  array( "name" => "Email was succesfully send message",  
       "desc" => "Message which appears after sending the email",  
       "id" => $shortname."_contact_ok",  
       "type" => "text",  
       "std" => "Email was succesfully send."),  
     
   array( "type" => "close"),
   
   array( "name" => "BLOG - LEFT ICON MENU",  
       "type" => "section"),  
   array( "type" => "open"), 
   
   array( "name" => "Article Icon text",  
       "desc" => "text description on the article icon",  
       "id" => $shortname."_blogleft_article",  
       "type" => "text",  
       "std" => "Article"),

   array( "name" => "Comments Icon text",  
       "desc" => "text description on the comments icon",  
       "id" => $shortname."_blogleft_comments",  
       "type" => "text",  
       "std" => "Comments"),

   array( "name" => "Gallery Icon text",  
       "desc" => "text description on the gallery icon",  
       "id" => $shortname."_blogleft_gallery",  
       "type" => "text",  
       "std" => "Gallery"),

   array( "name" => "Share Icon text",  
       "desc" => "text description on the share icon",  
       "id" => $shortname."_blogleft_share",  
       "type" => "text",  
       "std" => "Share"),

   array( "name" => "Search Icon text",  
       "desc" => "text description on the search icon",  
       "id" => $shortname."_blogleft_search",  
       "type" => "text",  
       "std" => "Search"),


       
       
   
   array( "type" => "close"),
   
        
   array( "name" => "BLOG - ARTICLE",  
       "type" => "section"),  
   array( "type" => "open"),
   
      array( "name" => "Date format in post metabox",  
       "desc" => "for more info google 'php date'",  
       "id" => $shortname."_blog_postdate",  
       "type" => "text",  
       "std" => "j F Y"),
   
   
  array( "type" => "close"),
     
   
   array( "name" => "BLOG - COMMENTS",  
       "type" => "section"),  
   array( "type" => "open"), 
   
   array( "name" => "Date Format",  
       "desc" => "for more info please see php function date",  
       "id" => $shortname."_blogcom_dateformat",  
       "type" => "text",  
       "std" => "n/j/Y"),

   array( "name" => "Display Date ?",  
       "desc" => "Display date in comments ?",  
       "id" => $shortname."_blogcom_displaydate",  
       "type" => "checkbox",  
       "std" => ""),  

   array( "name" => "Comments are not allowed text",  
       "desc" => "text description which appears when comments arent allowed",  
       "id" => $shortname."_blogcom_nocomments",  
       "type" => "text",  
       "std" => "Comments are not allowed"),
       
     array( "name" => "No comments yet",  
       "desc" => "text description which appears when no comment posted",  
       "id" => $shortname."_blogcom_nocommentsyet",  
       "type" => "text",  
       "std" => "No comments yet"),

   array( "name" => "Leave a reply text",  
       "desc" => "text description on leave a comment text",  
       "id" => $shortname."_blogcom_leaveacom",  
       "type" => "text",  
       "std" => "Leave a comment"),

   array( "name" => "Submit comment",  
       "desc" => "text description on submit button",  
       "id" => $shortname."_blogcom_submit",  
       "type" => "text",  
       "std" => "Submit comment"),

   array( "name" => "Name input",  
       "desc" => "text description on the name input field",  
       "id" => $shortname."_blogcom_name",  
       "type" => "text",  
       "std" => "Name"),
   
   array( "name" => "Email input",  
       "desc" => "text description on the email input field",  
       "id" => $shortname."_blogcom_email",  
       "type" => "text",  
       "std" => "E-mail"),
  
   array( "name" => "Website input",  
       "desc" => "text description on the website input field",  
       "id" => $shortname."_blogcom_website",  
       "type" => "text",  
       "std" => "Website"),
   
   array( "type" => "close"),
   
    array( "name" => "BLOG - GALLERY",  
       "type" => "section"),  
   array( "type" => "open"),
   
      array( "name" => "Gallery - No images text",  
       "desc" => "text description in the gallery if no images were found",  
       "id" => $shortname."_blogdesc_gallery",  
       "type" => "text",  
       "std" => "No Images"),
   
    array( "type" => "close"),
   

   
          array( "name" => "BLOG - SHARE",  
       "type" => "section"),  
   array( "type" => "open"), 
   
   array( "name" => "digg",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/digg.png" /></a>',  
       "id" => $shortname."_sh_digg",  
       "type" => "checkbox",  
       "std" => ""),
  
   array( "name" => "delicious",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/delicious.png" /></a>',  
       "id" => $shortname."_sh_delicious",  
       "type" => "checkbox",  
       "std" => ""),  

   array( "name" => "facebook",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/facebook.png" /></a>',  
       "id" => $shortname."_sh_facebook",  
       "type" => "checkbox",  
       "std" => ""),    
       
   array( "name" => "mixx",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/mixx.png" /></a>',  
       "id" => $shortname."_sh_mixx",  
       "type" => "checkbox",  
       "std" => ""),
       
   array( "name" => "google",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/google.png" /></a>',  
       "id" => $shortname."_sh_google",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "designfloat",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/designfloat.png" /></a>',  
       "id" => $shortname."_sh_designfloat",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "email",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/email.png" /></a>',  
       "id" => $shortname."_sh_email",  
       "type" => "checkbox",  
       "std" => ""),  
       
   array( "name" => "friendfeed",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/friendfeed.png" /></a>',  
       "id" => $shortname."_sh_friendfeed",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "linkedin",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/linkedin.png" /></a>',  
       "id" => $shortname."_sh_linkedin",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "favorites.live.com",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/microsoft.png" /></a>',  
       "id" => $shortname."_sh_microsoft",  
       "type" => "checkbox",  
       "std" => ""),                                          

    array( "name" => "mister-wong",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/mister-wong.png" /></a>',  
       "id" => $shortname."_sh_mister-wong",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "msn",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/msn.png" /></a>',  
       "id" => $shortname."_sh_msn",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "myspace",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/myspace.png" /></a>',  
       "id" => $shortname."_sh_myspace",  
       "type" => "checkbox",  
       "std" => ""), 
       
    array( "name" => "netvibes",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/netvibes.png" /></a>',  
       "id" => $shortname."_sh_netvibes",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "newsvine",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/newsvine.png" /></a>',  
       "id" => $shortname."_sh_newsvine",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "posterous",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/posterous.png" /></a>',  
       "id" => $shortname."_sh_posterous",  
       "type" => "checkbox",  
       "std" => ""),                                                  

   array( "name" => "reddit",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/reddit.png" /></a>',  
       "id" => $shortname."_sh_reddit",  
       "type" => "checkbox",  
       "std" => ""),  
    
   array( "name" => "rss",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/rss.png" /></a>',  
       "id" => $shortname."_sh_rss",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "slashdot",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/slashdot.png" /></a>',  
       "id" => $shortname."_sh_slashdots",  
       "type" => "checkbox",  
       "std" => ""),                                                  

   array( "name" => "stumbleupon",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/stumbleupon.png" /></a>',  
       "id" => $shortname."_sh_stumbleupon",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "technorati",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/technorati.png" /></a>',  
       "id" => $shortname."_sh_technorati",  
       "type" => "checkbox",  
       "std" => ""),  
    
   array( "name" => "tumblr",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/tumblr.png" /></a>',  
       "id" => $shortname."_sh_tumblr",  
       "type" => "checkbox",  
       "std" => ""),   
       
   array( "name" => "twitter",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/twitter.png" /></a>',  
       "id" => $shortname."_sh_twitter",  
       "type" => "checkbox",  
       "std" => ""),                                                  

   array( "name" => "yahoo-buzz",  
       "desc" => '<img class="share_icon" alt="digg" src="'.get_bloginfo('template_url').'/gfx/share_icons/yahoo-buzz.png" /></a>',  
       "id" => $shortname."_sh_yahoo",  
       "type" => "checkbox",  
       "std" => ""),          
  
   array( "type" => "close"),
   
   array( "name" => "BLOG - SEARCH",  
       "type" => "section"),  
   array( "type" => "open"), 
   
    array( "name" => "Date format in post metabox",  
       "desc" => "for more info google 'php date'",  
       "id" => $shortname."_blog_search",  
       "type" => "text",  
       "std" => "n/j/Y"),

   array( "name" => "Search - enter keywords",  
       "desc" => "text description in the search input field",  
       "id" => $shortname."_blogdesc_search",  
       "type" => "text",  
       "std" => "Enter keywords.."), 
       
   array( "name" => "Search - no posts matched your criteria",  
       "desc" => "text description in the search input field",  
       "id" => $shortname."_blogdesc_searchfail",  
       "type" => "text",  
       "std" => "No posts matched your criteria"),        
   
   array( "type" => "close"),  
   
   array( "name" => "GALLERY",  
       "type" => "section"),  
   array( "type" => "open"), 
   
   array( "name" => "Prev button",  
       "desc" => "Prev button label",  
       "id" => $shortname."_gallery_prev",  
       "type" => "text",  
       "std" => "Prev"),

   array( "name" => "Next button",  
       "desc" => "Next button label",  
       "id" => $shortname."_gallery_next",  
       "type" => "text",  
       "std" => "Next"),       
   
   array( "type" => "close"),        
   
   array( "name" => "FOOTER",  
       "type" => "section"),  
   array( "type" => "open"), 
   
   array( "name" => "Left text",  
       "desc" => "footer left text",  
       "id" => $shortname."_footer_left",  
       "type" => "textarea",  
       "std" => "Copyright 2010 by _freshface for Theme Forest"),

   array( "name" => "Right text",  
       "desc" => "footer right text",  
       "id" => $shortname."_footer_right",  
       "type" => "textarea",  
       "std" => ' <a href="#">Home</a>|
                    <a href="#">About</a>|
                    <a href="#">Works</a>|
                    <a href="#">Contact</a>'),       
   
   array( "type" => "close"), 
   
   array( "name" => "PERFORMANCE",  
       "type" => "section"),  
   array( "type" => "open"),

   array( "name" => "Disable SHINE EFFECT on Blogpost thumbnail ? (the Small one in the right blog navigation)",  
       "desc" => "Disable ?",  
       "id" => $shortname."_prf_blognavthumb",  
       "type" => "checkbox",  
       "std" => ""),
   
   array( "name" => "Disable SHINE EFFECT on Blogpost thumbnail ? - (the Medium one in Article and Gallery subsection)",  
       "desc" => "Disable ?",  
       "id" => $shortname."_prf_blogmedium",  
       "type" => "checkbox",  
       "std" => ""),
       
   array( "name" => "Disable SHINE EFFECT in Gallery/Portfolio ?",  
       "desc" => "Disable ?",  
       "id" => $shortname."_prf_galleryshine",  
       "type" => "checkbox",  
       "std" => ""),
       
   array( "name" => "Disable BUMP EFFECT in Gallery/Portfolio ?",  
       "desc" => "Disable ?",  
       "id" => $shortname."_prf_gallerybump",  
       "type" => "checkbox",  
       "std" => ""),
          
          
   array( "type" => "close")   
     
   );   
 
  function mytheme_add_admin() {  
     
   global $themename, $shortname, $options;  
     
   if ( $_GET['page'] == basename(__FILE__) ) {  
     
       if ( 'save' == $_REQUEST['action'] ) {  
     
           foreach ($options as $value) {  
           update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }  
     
   foreach ($options as $value) {  
       if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }  
     
       header("Location: admin.php?page=zodiacbox.php&saved=true");  
   die;  
     
   }  
   else if( 'reset' == $_REQUEST['action'] ) {  
     
       foreach ($options as $value) {  
           delete_option( $value['id'] ); }  
     
       header("Location: admin.php?page=zodiacbox.php&reset=true");  
   die;  
     
   }  
   }  
     
   add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');  
   }  
     
   function mytheme_add_init() {
        
      $file_dir=get_bloginfo('template_directory');  
      wp_enqueue_style("functions", $file_dir."/admin_style.css", false, "1.0", "all");
      wp_enqueue_script("rm_script", $file_dir."/admin_script.js", false, "1.0");     
   }
   
   function mytheme_admin() {  
     $introbox_page;
     $selectbox_query = new WP_Query("post_type=page");
     $array_counter = 0;
      while ($selectbox_query->have_posts()) : $selectbox_query->the_post();
        $id = url_to_postid(get_permalink());
        $original = get_permalink();
    
        $original = str_replace( get_bloginfo('url')."/", "", $original);
        $original = get_bloginfo('url')."/#/".$id."-".$original;
        $introbox_page[$array_counter] = $original;
        $array_counter++;
      endwhile; 
     
  
     
   global $themename, $shortname, $options; 
   $options[5]["options"] =  $introbox_page; 
   $i=0;  
     
   if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';  
   if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';  
     
   ?>  
   <div class="wrap rm_wrap">  
   <h2><?php echo $themename; ?> Settings</h2>  
     
   <div class="rm_opts">  
   <form method="post">
  <?php foreach ($options as $value) {  
   switch ( $value['type'] ) {  
     
   case "open":  
   ?>  
     
   <?php break;  
     
   case "close":  
   ?>  
     
   </div>  
   </div>  
   <br />  
     
   <?php break;  
     
   case "title":  
   ?>  
   <p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>  
     
   <?php break;  
     
   case 'text':  
   ?>  
     
   <div class="rm_input rm_text">  
       <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
       <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />  
    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
     
    </div>  
   <?php  
   break;  
     
   case 'textarea':  
   ?>  
     
   <div class="rm_input rm_textarea">  
       <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
       <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>  
    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
     
    </div>  
     
   <?php  
   break;  
   
     case 'introbox':  
   ?>  
     
   <div class="rm_input rm_select">  
       <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
     
   <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">  
   <?php foreach ($introbox_page as $option) { ?>  
           <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>  
   </select>  
     
       <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
   </div>  
  <?php  
   break;  
     
  case 'select':  
   ?>  
     
   <div class="rm_input rm_select">  
       <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
     
   <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">  
   <?php foreach ($value['options'] as $option) { ?>  
           <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>  
   </select>  
     
       <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
   </div>  
  <?php  
   break;  
     
   case "checkbox":  
   ?>  
     
   <div class="rm_input rm_checkbox">  
       <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>  
        
   <?php if(get_option($value['id']) ){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>  
   <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />  
     
       <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
   </div>  
   <?php break;
   
   case "section":  
     
   $i++;  
     
   ?>  
     
   <div class="rm_section">  
   <div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/gfx/plus_icon.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />  
   </span><div class="clearfix"></div></div>  
   <div class="rm_options">  
     
   <?php break;  
     
   }  
   }  
   ?>  
     
   <input type="hidden" name="action" value="save" />  
   </form>  
   <form method="post">  
   <p class="submit">  
   <input name="reset" type="submit" value="Reset" />  
   <input type="hidden" name="action" value="reset" />  
   </p>  
   </form>  
    </div>   
     
   <?php  
   }  
     
  add_action('admin_init', 'mytheme_add_init');  
   add_action('admin_menu', 'mytheme_add_admin');         
 
?>
