<?php

   /**
    *
    * create CSS colors
    * for Frisieur WordPress Theme
    * 
    * @author: Martanian <hello@martanian.com>
    * 
    */

    # default colors array
    $colors = array(
        'main' => '#cb9254',
        'main-border' => '#b58048',
        'main-hover' => '#d0a06c',
        'important-background' => '#271c10',
        'input-helper-border-main' => '#a97a48',
        'input-helper-border-top' => '#d2a575',
        'slogan-header' => '#fff',
        'slogan-content' => '#888',
        'progress-bar-value' => '#d7af84',
        'header-menu' => '#bbb',
        'header-menu-hover' => '#fff',
        'scrollable-menu-links' => '#3b3b3b',
        'responsive-menu-background' => '#3b3b3b',
        'responsive-menu-header' => '#fff',
        'responsive-menu-element-border' => '#202020',
        'responsive-menu-element-background' => '#292929',
        'responsive-menu-element-color' => '#888',
        'responsive-menu-link' => '#ddd',
        'responsive-menu-link-hover' => '#fff'
    );
    
    # update default colors
    if( $user_colors != false ) {
        
        foreach( $colors as $key => $value ) {
        
            if( isset( $user_colors[$key] ) && $user_colors[$key] != '' ) $colors[$key] = $user_colors[$key];
        }
    }
            
?>                      
<style type="text/css">

   /**
    *
    * buttons
    * 
    */                
    
    .button-brown {
        border: 1px solid <?php echo $colors['main-border']; ?>;
        background: <?php echo $colors['main']; ?>;
    }
    
    .button-brown:hover {
        background: <?php echo $colors['main-hover']; ?>;
    }
    
   /**
    *
    * header default background
    * 
    */                
    
    header #header-background-images {
        background: <?php echo $colors['important-background']; ?>;
    }
    
   /**
    *
    * responsive menu
    * 
    */                
    
    #responsive-menu-window {
        background: <?php echo $colors['responsive-menu-background']; ?>;
    }
    
    #responsive-menu-window h3 {
        color: <?php echo $colors['responsive-menu-header']; ?>;
    }
    
    #responsive-menu-window ul li a {
        background: <?php echo $colors['responsive-menu-element-background']; ?>;
        border: 1px solid <?php echo $colors['responsive-menu-element-border']; ?>;
        color: <?php echo $colors['responsive-menu-element-color']; ?>;
    }
    
    #responsive-menu-window .close-responsive-menu {
        color: <?php echo $colors['main']; ?>;
    }
    
    header .top-header-box .responsive-menu {
        color: <?php echo $colors['responsive-menu-link']; ?>;
    }
    
    header .top-header-box .responsive-menu:hover {
        color: <?php echo $colors['responsive-menu-link-hover']; ?>;
    }
    
   /**
    *
    * top header menu
    *
    */               
    
    header .top-header-box ul.menu-left li a,
    header .top-header-box ul.menu-right li a {
        color: <?php echo $colors['header-menu']; ?>;
    } 
    
    header .top-header-box ul.menu-left li a:hover,
    header .top-header-box ul.menu-right li a:hover,
    header .top-header-box ul.menu-left li.active a,
    header .top-header-box ul.menu-right li.active a {
        color: <?php echo $colors['header-menu-hover']; ?>;
    }
    
   /**
    *
    * scrollable menu
    * 
    */

    #scrollable-menu-wrapper .scrollable-menu-list li a,
    #scrollable-menu-wrapper .scrollable-menu-responsive {
        color: <?php echo $colors['scrollable-menu-links']; ?>;
    }
    
    #scrollable-menu-wrapper .scrollable-menu-list li a:hover,
    #scrollable-menu-wrapper .scrollable-menu-list a,
    #scrollable-menu-wrapper .scrollable-menu-responsive:hover {
        color: <?php echo $colors['main']; ?>;
    }   
    
   /**
    *
    * html elements 
    * 
    */
    
    h2 span,
    h3 span,
    a {
        color: <?php echo $colors['main']; ?>;
    }   
    
    header ul.sub-menu li a:hover {
        color: <?php echo $colors['main']; ?> !important;
    } 
    
    .header-line .color-line {
        background: <?php echo $colors['main']; ?>;
    }   
    
    blockquote {
        border-left: 3px solid <?php echo $colors['main']; ?>;
    }
    
   /**
    *
    * slogan
    * 
    */
    
    #slogan h1 {
        color: <?php echo $colors['slogan-header']; ?>;
    }               
    
    #slogan p {
        color: <?php echo $colors['slogan-content']; ?>;
    }
    
   /**
    *
    * about us section
    * 
    */

    #about-us .team-box .skills .progress-bar .progress-value {
        background: <?php echo $colors['progress-bar-value']; ?>;   
        border-bottom: 1px solid <?php echo $colors['main']; ?>;
    }
    
    #about-us .team-box .persons-switch span.prev,
    #about-us .team-box .persons-switch span.next {
        color: <?php echo $colors['main']; ?>;
    }
    
   /**
    *
    * appointment popup section
    * 
    */
    
    #appointment-popup .appointment-popup-content .appointment-header .h3-box h3 span,
    #appointment-popup .appointment-popup-content .appointment-header #close-popup:hover,
    #appointment-popup .appointment-popup-content .appointment-form .input .approximate-time-box .element i:hover {
        color: <?php echo $colors['main']; ?>;
    } 

    #appointment-popup .appointment-popup-content .appointment-form input[type=text]:focus {
        border-top: 1px solid <?php echo $colors['main']; ?>;
        border-right: 1px solid <?php echo $colors['main']; ?>;
        border-bottom: 1px solid <?php echo $colors['main']; ?>;
    }
    
    #appointment-popup .appointment-popup-content .appointment-form textarea:focus,
    #appointment-popup .appointment-popup-content .appointment-form .input .approximate-time-box {
        border: 1px solid <?php echo $colors['main']; ?>;
    }   
    
    #appointment-popup .appointment-popup-content .appointment-form .input .input-helper {
        background: <?php echo $colors['main']; ?>;
        border-top: 1px solid <?php echo $colors['input-helper-border-top']; ?>;
        border-left: 1px solid <?php echo $colors['input-helper-border-main']; ?>;
        border-bottom: 1px solid <?php echo $colors['input-helper-border-main']; ?>;
        box-shadow: 0 -1px 0 <?php echo $colors['input-helper-border-main']; ?>;
    }            
    
    #appointment-popup .appointment-popup-content .appointment-form .input .input-helper i {
        color: <?php echo $colors['input-helper-border-main']; ?>;
    }
    
    #appointment-popup .appointment-popup-content .appointment-form .input .approximate-time-box .approximate-time-box-arrow {
        border-top: 1px solid <?php echo $colors['main']; ?>;
        border-left: 1px solid <?php echo $colors['main']; ?>;
    }
    
   /**
    *
    * blog section
    * 
    */
    
    #blog #content article.blog-post h2 a,
    #blog #content article.blog-post .blog-post-comments h2,
    #blog #content article.blog-post .blog-post-comments-reply h2,
    #blog #content article.blog-post .blog-post-comments ol.comments-list .bypostauthor .comment-author-avatar:before {
        color: <?php echo $colors['main']; ?>;
    }                
    
    #blog #content article.blog-post .blog-post-comments ol.comments-list .comment-author-info .comment-author-name a.comment-reply-link:hover,
    #cancel-comment-reply-link:hover {
        background: <?php echo $colors['main']; ?>;
    }
    
    #blog #content article.blog-post .blog-post-comments-reply input[type=text]:focus,
    #blog #content article.blog-post .blog-post-comments-reply textarea:focus,
    #searchform input#search-form:focus {
        border: 1px solid <?php echo $colors['main']; ?>;
    }
    
    #blog #content article.blog-post .blog-post-comments-reply .input .input-helper {
        background: <?php echo $colors['main']; ?>;
        border-top: 1px solid <?php echo $colors['input-helper-border-top']; ?>;
        border-left: 1px solid <?php echo $colors['input-helper-border-main']; ?>;
        border-bottom: 1px solid <?php echo $colors['input-helper-border-main']; ?>;
        box-shadow: 0 -1px 0 <?php echo $colors['input-helper-border-main']; ?>;
    }
    
    #blog #content article.blog-post .blog-post-comments-reply .input .input-helper i {
        color: <?php echo $colors['input-helper-border-main']; ?>;
    }
    
   /**
    *
    * contact form section
    * 
    */
    
    #contact-form .input.focus {
        border-top: 1px solid <?php echo $colors['main']; ?>;
        border-right: 1px solid <?php echo $colors['main']; ?>;
        border-bottom: 1px solid <?php echo $colors['main']; ?>;
    }
    
    #contact-form .textarea.focus {
        border: 1px solid <?php echo $colors['main']; ?>;
    }
    
    #contact-form .input .input-helper {
        background: <?php echo $colors['main']; ?>;
        border-top: 1px solid <?php echo $colors['input-helper-border-top']; ?>;
        border-left: 1px solid <?php echo $colors['input-helper-border-main']; ?>;
        border-bottom: 1px solid <?php echo $colors['input-helper-border-main']; ?>;
        box-shadow: 0 -1px 0 <?php echo $colors['input-helper-border-main']; ?>;
    }   
    
    #contact-form .input .input-helper i {
        color: <?php echo $colors['input-helper-border-main']; ?>;
    }    
    
   /**
    *
    * gallery section
    * 
    */
    
    #gallery h4 {
        color: <?php echo $colors['main']; ?>;
    }      
    
    #gallery .gallery-item .item-background {
        background: <?php echo $colors['important-background']; ?>;
    }                   
    
    #gallery .gallery-item .item-background .icon-box {
        border: 1px solid <?php echo $colors['main']; ?>;
    }
    
    #gallery .gallery-item .item-background .icon-box i {
        color: <?php echo $colors['main']; ?>;
    }
    
   /**
    *
    * presentation
    * 
    */
    
    .presentation-v1 .presentation-prev-button:hover,
    .presentation-v1 .presentation-next-button:hover {
        color: <?php echo $colors['main']; ?>;
    }   
    
   /**
    *
    * small appointment
    * 
    */
    
    #small-appointment .appointment-form .input .input-helper {
        background: <?php echo $colors['main']; ?>;
        border-top: 1px solid <?php echo $colors['input-helper-border-top']; ?>;
        border-left: 1px solid <?php echo $colors['input-helper-border-main']; ?>;
        border-bottom: 1px solid <?php echo $colors['input-helper-border-main']; ?>;
        box-shadow: 0 -1px 0 <?php echo $colors['input-helper-border-main']; ?>;
    }    
    
    #small-appointment .appointment-form .input .input-helper i {
        color: <?php echo $colors['input-helper-border-main']; ?>;
    }                  
    
    #small-appointment .appointment-form input[type=text]:focus,
    #small-appointment .appointment-form input.approximate-time-box-active {
        border-top: 1px solid <?php echo $colors['main']; ?> !important;
        border-right: 1px solid <?php echo $colors['main']; ?> !important;
        border-bottom: 1px solid <?php echo $colors['main']; ?> !important;
    }       
    
    #small-appointment .appointment-form .input .approximate-time-box {
        border: 1px solid <?php echo $colors['main']; ?>;
    }
    
    #small-appointment .appointment-form .input .approximate-time-box .approximate-time-box-arrow {
        border-top: 1px solid <?php echo $colors['main']; ?>;
        border-left: 1px solid <?php echo $colors['main']; ?>;
    }
    
    #small-appointment .appointment-form .input .approximate-time-box .element i:hover {
        color: <?php echo $colors['main']; ?>;
    }
    
   /**
    *
    * end of styles
    * 
    */                                                       

</style>