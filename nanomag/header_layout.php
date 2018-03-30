<!-- Start header -->
<?php if(of_get_option('magazine_layout_design')=='magazine_personal'){?>
<header class="header-wraper-personal theme_header_style_5">
 <div class="header_main_wrapper"> 
        <div class="row">
    <div class="twelve columns personal_logo_position">
      <!-- begin logo -->
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php $logo = of_get_option('logo_uploader'); ?>
                                    <?php if (!empty($logo)): ?>   
                                        <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                    <?php else: ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo.png" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                    <?php endif; ?>
                                </a>
                            
                            <!-- end logo -->
    </div>  
</div>
</div>
                
<!-- end header, logo, top ads -->
              
<!-- Start Main menu -->
<div id="menu_wrapper" class="menu_wrapper <?php if(!of_get_option('disable_sticky_menu')==1){echo esc_attr("menu_sticky");}?>">

<div class="menu_border_top_full"></div>
<div class="row">
    <div class="main_menu twelve columns"> 
        <div class="menu_border_top"></div>
         <a class="open toggle-lef sb-toggle-left navbar-left" href="#nav">
        <div class="navicon-line"></div>
        <div class="navicon-line"></div>
        <div class="navicon-line"></div>
        </a>
                            <!-- main menu -->
                           
  <div class="menu-primary-container main-menu">
<?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => 'sf-menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
<?php if(!of_get_option('disable_random_post_link')==1){?>
<div class="random_post_link">
  <div class="share_icons_header">
<span class="share_btn_top"><i class="fa fa-share-alt"></i></span>
<div class="share_dropdown_content">
    

 <ul class="social-icons-list top-bar-social">
     <?php if(of_get_option('facebook')!=''){?> <li><a href="<?php echo esc_url(of_get_option('facebook'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/facebook.png" alt="<?php esc_attr_e('Facebook', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('google_plus')!=''){?><li><a href="<?php echo esc_url(of_get_option('google_plus'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/google-plus.png" alt="<?php esc_attr_e('Google Plus', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('behance')!=''){?><li><a href="<?php echo esc_url(of_get_option('behance'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/behance.png" alt="<?php esc_attr_e('Behance', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('vimeo')!=''){?><li><a href="<?php echo esc_url(of_get_option('vimeo'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/vimeo.png" alt="<?php esc_attr_e('Vimeo', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('youtube')!=''){?><li><a href="<?php echo esc_url(of_get_option('youtube'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/youtube.png" alt="<?php esc_attr_e('Youtube', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('instagram')!=''){?><li><a href="<?php echo esc_url(of_get_option('instagram'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/instagram.png" alt="<?php _e('Instagram', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('linkedin')!=''){?><li><a href="<?php echo esc_url(of_get_option('linkedin'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/link.png" alt="<?php esc_attr_e('linkedin', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('pinterest')!=''){?><li><a href="<?php echo esc_url(of_get_option('pinterest'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/pin.png" alt="<?php esc_attr_e('Pinterest', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('twitter')!=''){?><li><a href="<?php echo esc_url(of_get_option('twitter'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/twitter.png" alt="<?php esc_attr_e('Twitter', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('blogger')!=''){?> <li><a href="<?php echo esc_url(of_get_option('blogger'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/blogger.png" alt="<?php esc_attr_e('Blogger', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('deviantart')!=''){?> <li><a href="<?php echo esc_url(of_get_option('deviantart'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/d-art.png" alt="<?php esc_attr_e('Deviantart', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('dribble')!=''){?><li><a href="<?php echo esc_url(of_get_option('dribble'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dribble.png" alt="<?php esc_attr_e('Dribble', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('dropbox')!=''){?> <li><a href="<?php echo esc_url(of_get_option('dropbox'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dropbox.png" alt="<?php esc_attr_e('Dropbox', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('rss')!=''){?><li><a href="<?php echo esc_url(of_get_option('rss'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/rss.png" alt="<?php esc_attr_e('RSS', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('skype')!=''){?><li><a href="<?php echo esc_url(of_get_option('skype'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/skype.png" alt="<?php esc_attr_e('Skype', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('stumbleupon')!=''){?><li><a href="<?php echo esc_url(of_get_option('stumbleupon'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/stumbleupon.png" alt="<?php esc_attr_e('Stumbleupon', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('wordpress')!=''){?> <li><a href="<?php echo esc_url(of_get_option('wordpress'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/wordpress.png" alt="<?php esc_attr_e('WordPress', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('yahoo')!=''){?> <li><a href="<?php echo esc_url(of_get_option('yahoo'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/yahoo.png" alt="<?php esc_attr_e('Yahoo', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('flickr')!=''){?> <li><a href="<?php echo esc_url(of_get_option('flickr'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/flickr.png" alt="<?php esc_attr_e('flickr', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('tumblr')!=''){?> <li><a href="<?php echo esc_url(of_get_option('tumblr'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/tumblr.png" alt="<?php esc_attr_e('tumblr', 'nanomag'); ?>"></a></li><?php }?>
     </ul>  


  </div>
 </div> 
<?php $random_post_header_link = get_posts(array('orderby'=>'rand', 'posts_per_page'=>'1' ));
if( !empty( $random_post_header_link ) ){?>  
<a href="<?php echo get_permalink($random_post_header_link[0]->ID);?>"><i class="fa fa-random"></i></a>
<?php }?>
</div>
<?php }?>
<div class="clearfix"></div>
</div>                             
                            <!-- end main menu -->                                                                                   
                        </div>                                           
                    </div>   
                    </div>
            </header>
<?php }else{?>

<!-- Header6 layout --> 
<?php if(of_get_option('theme_header_style')=='theme_header_style_6'){?>
<header class="header-wraper<?php if(of_get_option('theme_header_style')!= 'theme_header_style_0'){ echo " ".of_get_option('theme_header_style');}?>">

<div class="header_top_wrapper">
<div class="row">
<div class="six columns header-top-left-bar">

<?php if(!of_get_option('disable_newsticker')==1){?>
              <?php get_template_part('news-ticker'); ?>
<?php }?>
  
</div>

<div class="six columns header-top-right-bar">

<a class="open toggle-lef sb-toggle-left navbar-left" href="#nav">
        <div class="navicon-line"></div>
        <div class="navicon-line"></div>
        <div class="navicon-line"></div>
        </a>
<?php if(!of_get_option('disable_top_search')==1){?>
      <div id="search_block_top">
    <form id="searchbox" action="<?php echo esc_url(home_url('/')); ?>" method="GET" role="search">
        <p>
            <input type="text" id="search_query_top" name="s" class="search_query ac_input" value="" placeholder="<?php esc_attr_e('Search here', 'nanomag'); ?>">
           <button type="submit"><i class="fa fa-search"></i></button>
    </p>
    </form>
    <span>Search</span>
    <div class="clearfix"></div>
</div>
<?php }?>


 <?php if(!of_get_option('disable_top_social_icons')==1){?> 
    <ul class="social-icons-list top-bar-social">
     <?php if(of_get_option('facebook')!=''){?> <li><a href="<?php echo esc_url(of_get_option('facebook'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/facebook.png" alt="<?php esc_attr_e('Facebook', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('google_plus')!=''){?><li><a href="<?php echo esc_url(of_get_option('google_plus'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/google-plus.png" alt="<?php esc_attr_e('Google Plus', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('behance')!=''){?><li><a href="<?php echo esc_url(of_get_option('behance'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/behance.png" alt="<?php esc_attr_e('Behance', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('vimeo')!=''){?><li><a href="<?php echo esc_url(of_get_option('vimeo'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/vimeo.png" alt="<?php esc_attr_e('Vimeo', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('youtube')!=''){?><li><a href="<?php echo esc_url(of_get_option('youtube'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/youtube.png" alt="<?php esc_attr_e('Youtube', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('instagram')!=''){?><li><a href="<?php echo esc_url(of_get_option('instagram'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/instagram.png" alt="<?php _e('Instagram', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('linkedin')!=''){?><li><a href="<?php echo esc_url(of_get_option('linkedin'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/link.png" alt="<?php esc_attr_e('linkedin', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('pinterest')!=''){?><li><a href="<?php echo esc_url(of_get_option('pinterest'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/pin.png" alt="<?php esc_attr_e('Pinterest', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('twitter')!=''){?><li><a href="<?php echo esc_url(of_get_option('twitter'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/twitter.png" alt="<?php esc_attr_e('Twitter', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('blogger')!=''){?> <li><a href="<?php echo esc_url(of_get_option('blogger'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/blogger.png" alt="<?php esc_attr_e('Blogger', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('deviantart')!=''){?> <li><a href="<?php echo esc_url(of_get_option('deviantart'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/d-art.png" alt="<?php esc_attr_e('Deviantart', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('dribble')!=''){?><li><a href="<?php echo esc_url(of_get_option('dribble'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dribble.png" alt="<?php esc_attr_e('Dribble', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('dropbox')!=''){?> <li><a href="<?php echo esc_url(of_get_option('dropbox'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dropbox.png" alt="<?php esc_attr_e('Dropbox', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('rss')!=''){?><li><a href="<?php echo esc_url(of_get_option('rss'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/rss.png" alt="<?php esc_attr_e('RSS', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('skype')!=''){?><li><a href="<?php echo esc_url(of_get_option('skype'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/skype.png" alt="<?php esc_attr_e('Skype', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('stumbleupon')!=''){?><li><a href="<?php echo esc_url(of_get_option('stumbleupon'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/stumbleupon.png" alt="<?php esc_attr_e('Stumbleupon', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('wordpress')!=''){?> <li><a href="<?php echo esc_url(of_get_option('wordpress'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/wordpress.png" alt="<?php esc_attr_e('WordPress', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('yahoo')!=''){?> <li><a href="<?php echo esc_url(of_get_option('yahoo'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/yahoo.png" alt="<?php esc_attr_e('Yahoo', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('flickr')!=''){?> <li><a href="<?php echo esc_url(of_get_option('flickr'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/flickr.png" alt="<?php esc_attr_e('flickr', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('tumblr')!=''){?> <li><a href="<?php echo esc_url(of_get_option('tumblr'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/tumblr.png" alt="<?php esc_attr_e('tumblr', 'nanomag'); ?>"></a></li><?php }?>
     </ul>  
      <?php }?>

<div class="clearfix"></div>
</div>

</div>
</div>

             
<!-- Start Main menu -->
<div id="menu_wrapper" class="menu_wrapper <?php if(!of_get_option('disable_sticky_menu')==1){echo esc_attr("menu_sticky");}?>">
<div class="menu_border_top_full"></div>
<div class="row">
    <div class="main_menu twelve columns"> 
        <div class="menu_border_top"></div>
                            <!-- main menu -->
                           
  <div class="menu-primary-container main-menu">
<?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => 'sf-menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
<?php if(!of_get_option('disable_random_post_link')==1){?>
<div class="random_post_link">
<?php $random_post_header_link = get_posts(array('orderby'=>'rand', 'posts_per_page'=>'1' ));
if( !empty( $random_post_header_link ) ){?>  
<a href="<?php echo get_permalink($random_post_header_link[0]->ID);?>"><i class="fa fa-random"></i></a>
<?php }?>
</div>
<?php }?>
<div class="clearfix"></div>
</div>                             
                            <!-- end main menu -->                                                                                   
                        </div>                                           
                    </div>   
                    </div>

 
        
 <div class="header_main_wrapper"> 
        <div class="row">
    <div class="<?php if (is_active_sidebar('banner-sidebar')) { echo esc_attr('four columns header-top-left'); } else { echo esc_attr('twelve columns logo-position');}?>">
    
      <!-- begin logo -->
                           
                           
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php $logo = of_get_option('logo_uploader'); ?>
                                    <?php if (!empty($logo)): ?>   
                                        <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                    <?php else: ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo.png" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                    <?php endif; ?>
                                </a>
                            
                            <!-- end logo -->
    </div>
    <?php if (is_active_sidebar('banner-sidebar')){ ?>
    <div class="eight columns header-top-right">  
  <?php dynamic_sidebar('banner-sidebar');?>
    </div>
    <?php }?>    
</div>

</div>

                
<!-- end header, logo, top ads -->

            </header>

<!-- Header7 layout --> 
<?php }elseif(of_get_option('theme_header_style')=='theme_header_style_7'){?>
<header class="header-wraper<?php if(of_get_option('theme_header_style')!= 'theme_header_style_0'){ echo " ".of_get_option('theme_header_style');}?>">

<div class="header_top_wrapper">
<div class="row">
<div class="six columns header-top-left-bar">

<?php if(!of_get_option('disable_newsticker')==1){?>
              <?php get_template_part('news-ticker'); ?>
<?php }?>
  
</div>

<div class="six columns header-top-right-bar">

<a class="open toggle-lef sb-toggle-left navbar-left" href="#nav">
        <div class="navicon-line"></div>
        <div class="navicon-line"></div>
        <div class="navicon-line"></div>
        </a>
<?php if(!of_get_option('disable_top_search')==1){?>
      <div id="search_block_top">
    <form id="searchbox" action="<?php echo esc_url(home_url('/')); ?>" method="GET" role="search">
        <p>
            <input type="text" id="search_query_top" name="s" class="search_query ac_input" value="" placeholder="<?php esc_attr_e('Search here', 'nanomag'); ?>">
           <button type="submit"><i class="fa fa-search"></i></button>
    </p>
    </form>
    <span>Search</span>
    <div class="clearfix"></div>
</div>
<?php }?>


 <?php if(!of_get_option('disable_top_social_icons')==1){?> 
    <ul class="social-icons-list top-bar-social">
     <?php if(of_get_option('facebook')!=''){?> <li><a href="<?php echo esc_url(of_get_option('facebook'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/facebook.png" alt="<?php esc_attr_e('Facebook', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('google_plus')!=''){?><li><a href="<?php echo esc_url(of_get_option('google_plus'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/google-plus.png" alt="<?php esc_attr_e('Google Plus', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('behance')!=''){?><li><a href="<?php echo esc_url(of_get_option('behance'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/behance.png" alt="<?php esc_attr_e('Behance', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('vimeo')!=''){?><li><a href="<?php echo esc_url(of_get_option('vimeo'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/vimeo.png" alt="<?php esc_attr_e('Vimeo', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('youtube')!=''){?><li><a href="<?php echo esc_url(of_get_option('youtube'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/youtube.png" alt="<?php esc_attr_e('Youtube', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('instagram')!=''){?><li><a href="<?php echo esc_url(of_get_option('instagram'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/instagram.png" alt="<?php _e('Instagram', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('linkedin')!=''){?><li><a href="<?php echo esc_url(of_get_option('linkedin'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/link.png" alt="<?php esc_attr_e('linkedin', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('pinterest')!=''){?><li><a href="<?php echo esc_url(of_get_option('pinterest'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/pin.png" alt="<?php esc_attr_e('Pinterest', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('twitter')!=''){?><li><a href="<?php echo esc_url(of_get_option('twitter'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/twitter.png" alt="<?php esc_attr_e('Twitter', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('blogger')!=''){?> <li><a href="<?php echo esc_url(of_get_option('blogger'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/blogger.png" alt="<?php esc_attr_e('Blogger', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('deviantart')!=''){?> <li><a href="<?php echo esc_url(of_get_option('deviantart'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/d-art.png" alt="<?php esc_attr_e('Deviantart', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('dribble')!=''){?><li><a href="<?php echo esc_url(of_get_option('dribble'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dribble.png" alt="<?php esc_attr_e('Dribble', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('dropbox')!=''){?> <li><a href="<?php echo esc_url(of_get_option('dropbox'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dropbox.png" alt="<?php esc_attr_e('Dropbox', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('rss')!=''){?><li><a href="<?php echo esc_url(of_get_option('rss'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/rss.png" alt="<?php esc_attr_e('RSS', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('skype')!=''){?><li><a href="<?php echo esc_url(of_get_option('skype'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/skype.png" alt="<?php esc_attr_e('Skype', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('stumbleupon')!=''){?><li><a href="<?php echo esc_url(of_get_option('stumbleupon'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/stumbleupon.png" alt="<?php esc_attr_e('Stumbleupon', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('wordpress')!=''){?> <li><a href="<?php echo esc_url(of_get_option('wordpress'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/wordpress.png" alt="<?php esc_attr_e('WordPress', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('yahoo')!=''){?> <li><a href="<?php echo esc_url(of_get_option('yahoo'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/yahoo.png" alt="<?php esc_attr_e('Yahoo', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('flickr')!=''){?> <li><a href="<?php echo esc_url(of_get_option('flickr'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/flickr.png" alt="<?php esc_attr_e('flickr', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('tumblr')!=''){?> <li><a href="<?php echo esc_url(of_get_option('tumblr'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/tumblr.png" alt="<?php esc_attr_e('tumblr', 'nanomag'); ?>"></a></li><?php }?>
     </ul>  
      <?php }?>

<div class="clearfix"></div>
</div>

</div>
</div>

<!-- Start Main menu -->
<div id="menu_wrapper" class="menu_wrapper <?php if(!of_get_option('disable_sticky_menu')==1){echo esc_attr("menu_sticky");}?>">
<div class="menu_border_top_full"></div>
<div class="row">
    <div class="main_menu twelve columns"> 
        <div class="menu_border_top"></div>
                            <!-- main menu -->
                           
  <div class="menu-primary-container main-menu">

    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo_link_small">
                                    <?php $logo = of_get_option('logo_uploader'); ?>
                                    <?php if (!empty($logo)): ?>   
                                        <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                    <?php else: ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo.png" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                    <?php endif; ?>
                                </a>


<?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => 'sf-menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
<?php if(!of_get_option('disable_random_post_link')==1){?>
<div class="random_post_link">
<?php $random_post_header_link = get_posts(array('orderby'=>'rand', 'posts_per_page'=>'1' ));
if( !empty( $random_post_header_link ) ){?>  
<a href="<?php echo get_permalink($random_post_header_link[0]->ID);?>"><i class="fa fa-random"></i></a>
<?php }?>
</div>
<?php }?>
<div class="clearfix"></div>
</div>                             
                            <!-- end main menu -->                                                                                   
                        </div>                                           
                    </div>   
                    </div>

        

                
<!-- end header, logo, top ads -->

            </header>
<?php }else{?>

<header class="header-wraper<?php if(of_get_option('theme_header_style')!= 'theme_header_style_0'){ echo " ".of_get_option('theme_header_style');}?>">

<div class="header_top_wrapper">
<div class="row">
<div class="six columns header-top-left-bar">

<?php if(!of_get_option('disable_newsticker')==1){?>
              <?php get_template_part('news-ticker'); ?>
<?php }?>
  
</div>

<div class="six columns header-top-right-bar">

<a class="open toggle-lef sb-toggle-left navbar-left" href="#nav">
        <div class="navicon-line"></div>
        <div class="navicon-line"></div>
        <div class="navicon-line"></div>
        </a>
<?php if(!of_get_option('disable_top_search')==1){?>
      <div id="search_block_top">
    <form id="searchbox" action="<?php echo esc_url(home_url('/')); ?>" method="GET" role="search">
        <p>
            <input type="text" id="search_query_top" name="s" class="search_query ac_input" value="" placeholder="<?php esc_attr_e('Search here', 'nanomag'); ?>">
           <button type="submit"><i class="fa fa-search"></i></button>
    </p>
    </form>
    <span>Search</span>
    <div class="clearfix"></div>
</div>
<?php }?>


 <?php if(!of_get_option('disable_top_social_icons')==1){?> 
    <ul class="social-icons-list top-bar-social">
     <?php if(of_get_option('facebook')!=''){?> <li><a href="<?php echo esc_url(of_get_option('facebook'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/facebook.png" alt="<?php esc_attr_e('Facebook', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('google_plus')!=''){?><li><a href="<?php echo esc_url(of_get_option('google_plus'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/google-plus.png" alt="<?php esc_attr_e('Google Plus', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('behance')!=''){?><li><a href="<?php echo esc_url(of_get_option('behance'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/behance.png" alt="<?php esc_attr_e('Behance', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('vimeo')!=''){?><li><a href="<?php echo esc_url(of_get_option('vimeo'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/vimeo.png" alt="<?php esc_attr_e('Vimeo', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('youtube')!=''){?><li><a href="<?php echo esc_url(of_get_option('youtube'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/youtube.png" alt="<?php esc_attr_e('Youtube', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('instagram')!=''){?><li><a href="<?php echo esc_url(of_get_option('instagram'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/instagram.png" alt="<?php _e('Instagram', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('linkedin')!=''){?><li><a href="<?php echo esc_url(of_get_option('linkedin'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/link.png" alt="<?php esc_attr_e('linkedin', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('pinterest')!=''){?><li><a href="<?php echo esc_url(of_get_option('pinterest'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/pin.png" alt="<?php esc_attr_e('Pinterest', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('twitter')!=''){?><li><a href="<?php echo esc_url(of_get_option('twitter'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/twitter.png" alt="<?php esc_attr_e('Twitter', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('blogger')!=''){?> <li><a href="<?php echo esc_url(of_get_option('blogger'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/blogger.png" alt="<?php esc_attr_e('Blogger', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('deviantart')!=''){?> <li><a href="<?php echo esc_url(of_get_option('deviantart'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/d-art.png" alt="<?php esc_attr_e('Deviantart', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('dribble')!=''){?><li><a href="<?php echo esc_url(of_get_option('dribble'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dribble.png" alt="<?php esc_attr_e('Dribble', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('dropbox')!=''){?> <li><a href="<?php echo esc_url(of_get_option('dropbox'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dropbox.png" alt="<?php esc_attr_e('Dropbox', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('rss')!=''){?><li><a href="<?php echo esc_url(of_get_option('rss'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/rss.png" alt="<?php esc_attr_e('RSS', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('skype')!=''){?><li><a href="<?php echo esc_url(of_get_option('skype'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/skype.png" alt="<?php esc_attr_e('Skype', 'nanomag'); ?>"></a></li><?php }?>
     <?php if(of_get_option('stumbleupon')!=''){?><li><a href="<?php echo esc_url(of_get_option('stumbleupon'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/stumbleupon.png" alt="<?php esc_attr_e('Stumbleupon', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('wordpress')!=''){?> <li><a href="<?php echo esc_url(of_get_option('wordpress'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/wordpress.png" alt="<?php esc_attr_e('WordPress', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('yahoo')!=''){?> <li><a href="<?php echo esc_url(of_get_option('yahoo'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/yahoo.png" alt="<?php esc_attr_e('Yahoo', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('flickr')!=''){?> <li><a href="<?php echo esc_url(of_get_option('flickr'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/flickr.png" alt="<?php esc_attr_e('flickr', 'nanomag'); ?>"></a></li><?php }?>
    <?php if(of_get_option('tumblr')!=''){?> <li><a href="<?php echo esc_url(of_get_option('tumblr'));?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/tumblr.png" alt="<?php esc_attr_e('tumblr', 'nanomag'); ?>"></a></li><?php }?>
     </ul>  
      <?php }?>

<div class="clearfix"></div>
</div>

</div>
</div>

 
        
 <div class="header_main_wrapper"> 
        <div class="row">
    <div class="<?php if (is_active_sidebar('banner-sidebar')) { echo esc_attr('four columns header-top-left'); } else { echo esc_attr('twelve columns logo-position');}?>">
    
      <!-- begin logo -->
                           
                           
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php $logo = of_get_option('logo_uploader'); ?>
                                    <?php if (!empty($logo)): ?>   
                                        <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                    <?php else: ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo.png" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                    <?php endif; ?>
                                </a>
                            
                            <!-- end logo -->
    </div>
    <?php if (is_active_sidebar('banner-sidebar')){ ?>
    <div class="eight columns header-top-right">  
  <?php dynamic_sidebar('banner-sidebar');?>
    </div>
    <?php }?>    
</div>

</div>

                
<!-- end header, logo, top ads -->

              
<!-- Start Main menu -->
<div id="menu_wrapper" class="menu_wrapper <?php if(!of_get_option('disable_sticky_menu')==1){echo esc_attr("menu_sticky");}?>">
<div class="menu_border_top_full"></div>
<div class="row">
    <div class="main_menu twelve columns"> 
        <div class="menu_border_top"></div>
                            <!-- main menu -->
                           
  <div class="menu-primary-container main-menu">
<?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => 'sf-menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
<?php if(!of_get_option('disable_random_post_link')==1){?>
<div class="random_post_link">
<?php $random_post_header_link = get_posts(array('orderby'=>'rand', 'posts_per_page'=>'1' ));
if( !empty( $random_post_header_link ) ){?>  
<a href="<?php echo get_permalink($random_post_header_link[0]->ID);?>"><i class="fa fa-random"></i></a>
<?php }?>
</div>
<?php }?>
<div class="clearfix"></div>
</div>                             
                            <!-- end main menu -->                                                                                   
                        </div>                                           
                    </div>   
                    </div>
            </header>
<?php }}?>



