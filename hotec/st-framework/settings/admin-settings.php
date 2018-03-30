<?php
global $wp_registered_sidebars, $predefined_colors;
$st_sidebars = $wp_registered_sidebars;
$general_tab = array();
$tpl_sidebars = array();
foreach($st_sidebars as $k=> $s){
    $tpl_sidebars[$s['id']] = $s['name'];
}

$general_tab_page = array(
        array(
            'name'        =>'page_full_boxed',
            'title'       =>__('Boxed of Full-Width Layout','smooththemes'),
            'type'        =>'select',
            'options'     => array(
                'f'           =>__('Full-Width','smooththemes'),
                'b'           =>__('Boxed','smooththemes')
            ),
            
            'default'     =>'f',
            'desc'        =>'',
            'desc_bottom' =>''
        ),
        
        array(
            'name'=>'layout',
            'title'=>__('Default Layout','smooththemes'),
            'type' =>'layout',
            'multiple'=> false,
            'options'=>array(
              //  '4'=> ST_ADMIN_URL.'/images/layout/3.png',
                '3'=> ST_ADMIN_URL.'/images/layout/2.png',
                '2'=> ST_ADMIN_URL.'/images/layout/1.png',
                '1'=> ST_ADMIN_URL.'/images/layout/0.png',
            ),
            'default'=>'2',
            'desc'=>'',
            'desc_bottom'=>''
         ),
         
        array(
            'name'=>'show_footer_widget',
            'title'=>__('Show Footer Widgets','smooththemes'),
            'type' =>'radio',
            'multiple'=> false,
            'options'=>array('y'=>__('Yes'), 'n'=>__('No')),
            'default'=>'y',
            'desc'=>'',
            'desc_bottom'=>''
         )
          
);


$general_tab_logo = array(
    array(
        'name'        =>'site_logo',
        'title'       =>'Upload logo',
        'type'        =>'upload',
        'default'     =>st_img('logo.png'),
        'desc'        =>'',
        'desc_bottom' =>'Upload your custom logo.'
    )
);
$general_tab_favicon = array(
        array(
            'name'        =>'site_favicon',
            'title'       =>'Upload Favicon',
            'type'        =>'upload',
            'desc'        =>'',
            'desc_bottom' =>'Upload your custom favicon.'
        )
    );

$oe_social = array(
    array(
        'name'        =>'facebook',
        'title'       =>__('Facebook URL','smooththemes'),
        'type'        =>'text',
        'default'     =>'#',
        'desc'        =>'',
        'desc_bottom' =>'Enter your Facebook link'
     ),
    array(
        'name'        =>'twitter',
        'title'       =>'Twitter URL',
        'type'        =>'text',
        'default'     =>'#',
        'desc'        =>'',
        'desc_bottom' =>'Enter your Twitter link'
     ),
     array(
        'name'        =>'google_plus',
        'title'       =>'Google+ URL',
        'type'        =>'text',
        'default'     =>'#',
        'desc'        =>'',
        'desc_bottom' =>'Enter your Google+ link'
     ),
     
     array(
        'name'        =>'youtube',
        'title'       =>'Youtube URL',
        'type'        =>'text',
        'default'     =>'#',
        'desc'        =>'',
        'desc_bottom' =>'Enter your Youtube link'
     ),
     
     array(
        'name'        =>'skype',
        'title'       =>__('Skype username','smooththemes'),
        'type'        =>'text',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
     )
     
);

$oe_single_post = array(
    
    array(
        'name'        =>'s_show_featured_img',
        'title'       =>__('Show Featured Image on single post','smooththemes'),
        'type'        =>'radio',
        'multiple'    => false,
        'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),
        'default'     =>'y',
        'desc'        =>'',
        'desc_bottom' =>''
     ),

    array(
        'name'        =>'s_show_post_meta',
        'title'       =>__('Show post meta (author, date, categrories) on single post','smooththemes'),
        'type'        =>'radio',
        'multiple'    => false,
        'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),
        'default'     =>'y',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     array(
        'name'        =>'s_show_post_tag',
        'title'       =>__('Show post tags on single post','smooththemes'),
        'type'        =>'radio',
        'multiple'    => false,
        'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),
        'default'     =>'y',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     array(
        'name'        =>'s_show_comments',
        'title'       =>__('Show comments on single post','smooththemes'),
        'type'        =>'radio',
        'multiple'    => false,
        'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),
        'default'     =>'y',
        'desc'        =>'',
        'desc_bottom' =>''
     )
);

$oe_footer_copyright = array(
    array(
        'name'        =>'footer_copyright',
        'title'       =>'Footer CopyRight Infomation',
        'type'        =>'textarea',
        'default'     =>'&copy; 2012. All Rights Reserved. Created with love by <a href="#">SmoothThemes.Com</a>',
        'desc'        =>'',
        'desc_bottom' =>''
    ), 
);


$global_skin_tab = array(
 
    
    array(
            'name'=>'predefined_colors',
            'title'=>__('Pre-Defined Skins','smooththemes'),
            'type' =>'layout',
            'multiple'=> false,
            'options'=>$predefined_colors,
            'size'=>30,
            'default'=>'80b500',
            'desc'=>'',
            'desc_bottom'=>''
         ),
    
    
    array(
        'name'=>'enable_custom_global_skin',
        'title'=>__('Enable Custom Skin','smooththemes'),
        'type' =>'radio',
        'multiple'=> false,
        'options'=>array('y'=>__('Yes'), 'n'=>__('No')),
        'default'=>'n',
        'desc'=>'Select global skin color below, it will overwrite predefined color.',
        'desc_bottom'=>''
    ),
    array(
        'name'        =>'custom_global_skin',
        'title'       =>__('Custom Global Skin'),
        'type'        =>'color',
        'default'     =>'CCCCCC',
        'desc'        =>'NOTE: It will overwrite predefined color.',
        'desc_bottom' =>''
    ),
       
);



$header_bg_tab = array(
    
     array(
        'name'        =>'disable_header_custom',
        'title'       =>__('Disable custom header','smooththemes'),
        'type'        =>'radio',
        'options' => array(
                'y'=>__('Yes','smooththemes'),
                'n'=>__('No','smooththemes'),
        ),
        'default'     =>'n',
        'desc'        =>'',
        'desc_bottom' =>''
    ),


   array(
        'title'       =>__('Custom header Links','smooththemes'),
        'type'        =>'heading',
    ),

    array(
        'name'        =>'header_link_color',
        'title'       =>__('Link color','smooththemes'),
        'type'        =>'color',
        'default'     =>'202020',
        'desc'        =>'',
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'header_link_hover_color',
        'title'       =>__('Link hover, active color','smooththemes'),
        'type'        =>'color',
        'default'     =>'80B500',
        'desc'        =>'',
        'desc_bottom' =>''
    ),


   array(
        'title'       =>__('Custom header Background','smooththemes'),
        'type'        =>'heading',
    ),
    
    array(
        'name'        =>'header_bg_color',
        'title'       =>__('Background color','smooththemes'),
        'type'        =>'color',
        'default'     =>'CCCCCC',
        'desc'        =>'NOTE: background style only apply when selected Boxed layout.',
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'header_bg_img',
        'title'       =>__('Background image','smooththemes'),
        'type'        =>'upload',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
    ),
    
     array(
        'name'        =>'header_bg_positon',
        'title'       =>__('Background positon'),
        'type'        =>'select',
        'options' => array(
                'tl'=>__('Top left','smooththemes'),
                'tc'=>__('Top center','smooththemes'),
                'tr'=>__('Top right','smooththemes'),
                'cc'=>__('Center','smooththemes'),
                'bl'=>__('Bottom left','smooththemes'),
                'br'=>__('Bottom right','smooththemes'),
                'bc'=>__('Bottom center','smooththemes'),
        ),
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'header_bg_repreat',
        'title'       =>__('Background repreat'),
        'type'        =>'select',
        'options' => array(
                'r'=>__('Repeat','smooththemes'),
                'n'=>__('No repeat','smooththemes'),
                'x'=>__('Repeat X','smooththemes'),
                'y'=>__('Repeat Y','smooththemes')
        ),
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
    )
    ,
    array(
        'name'        =>'header_bg_fixed',
        'title'       =>__('Background fixed'),
        'type'        =>'select',
        'options' => array(
                'n'=>__('No','smooththemes'),
                'y'=>__('Yes','smooththemes')
        ),
        'desc'        =>'',
        'desc_bottom' =>''
    ),

);



$bg_tab = array(

    array(
            'name'        =>'bg_type',
            'title'       =>__('Background Type'),
            'type'        =>'radio',
            'options' => array(
                    'd'=>__('Defined background image','smooththemes'),
                    'c'=>__('Defined background color','smooththemes'),
                    'custom'=>__('Custom','smooththemes'),
            ),
            'default'     =>'d',
            'desc'        =>'',
            'desc_bottom' =>''
        ),

     array(
            'name'=>'defined_bg',
            'title'=>__('Defined background Image','smooththemes'),
            'type' =>'layout',
            'multiple'=> false,
            'options'=>array(
                'background1.jpg'=> ST_THEME_URL.'assets/images/patterns/background1_thumb.jpg',
                'pattern1.png'=> ST_THEME_URL.'assets/images/patterns/pattern1.png',
                'pattern2.png'=> ST_THEME_URL.'assets/images/patterns/pattern2.png',
                'pattern3.png'=> ST_THEME_URL.'assets/images/patterns/pattern3.png',
                'pattern4.png'=> ST_THEME_URL.'assets/images/patterns/pattern4.png',
                'pattern5.png'=> ST_THEME_URL.'assets/images/patterns/pattern5.png',
                'pattern6.png'=> ST_THEME_URL.'assets/images/patterns/pattern6.png',
                'pattern7.png'=> ST_THEME_URL.'assets/images/patterns/pattern7.png',
            ),
            'size'=>30,
            'default'=>'background1.jpg',
            'desc'=>'',
            'desc_bottom'=>''
         ),
         
         
          array(
            'name'=>'defined_bg_color',
            'title'=>__('Defined background color','smooththemes'),
            'type' =>'layout',
            'multiple'=> false,
            'options'=>array(
                '37b6bd'=> ST_THEME_URL.'assets/images/colors/37b6bd.png',
                'c71c77'=> ST_THEME_URL.'assets/images/colors/c71c77.png',
                'f0f0f0'=> ST_THEME_URL.'assets/images/colors/f0f0f0.png',
                'ffb400'=> ST_THEME_URL.'assets/images/colors/ffb400.png'
            ),
            'size'=>30,
            'default'=>'background1.jpg',
            'desc'=>'',
            'desc_bottom'=>''
         ),


  array(
        'title'       =>__('Custom Background','smooththemes'),
        'type'        =>'heading',
    ),
    
    array(
        'name'        =>'bg_color',
        'title'       =>__('Background color','smooththemes'),
        'type'        =>'color',
        'default'     =>'CCCCCC',
        'desc'        =>'NOTE: background style only apply when selected Boxed layout.',
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'bg_img',
        'title'       =>__('Background image','smooththemes'),
        'type'        =>'upload',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
    ),
    
     array(
        'name'        =>'bg_positon',
        'title'       =>__('Background positon'),
        'type'        =>'select',
        'options' => array(
                'tl'=>__('Top left','smooththemes'),
                'tc'=>__('Top center','smooththemes'),
                'tr'=>__('Top right','smooththemes'),
                'cc'=>__('Center','smooththemes'),
                'bl'=>__('Bottom left','smooththemes'),
                'br'=>__('Bottom right','smooththemes'),
                'bc'=>__('Bottom center','smooththemes'),
        ),
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'bg_repreat',
        'title'       =>__('Background repreat'),
        'type'        =>'select',
        'options' => array(
                'r'=>__('Repeat','smooththemes'),
                'n'=>__('No repeat','smooththemes'),
                'x'=>__('Repeat X','smooththemes'),
                'y'=>__('Repeat Y','smooththemes')
        ),
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
    )
    ,
    array(
        'name'        =>'bg_fixed',
        'title'       =>__('Background fixed'),
        'type'        =>'select',
        'options' => array(
                'n'=>__('No','smooththemes'),
                'y'=>__('Yes','smooththemes')
        ),
        'desc'        =>'',
        'desc_bottom' =>''
    ),

);




$tab_flexslider = array(
  array(
        'type'=>'heading',
        'title'=>__('Flex Slider settings','smooththemes'),
     ),
//animation
    array(
        'name'=>'flex_animation',
        'type'=>'radio',
        'title'=>__('Animation','smooththemes'),
        'options'=>array('fade'=>__('fade'),'slide'=>__('slide')),
        'default'=>'fade'
     ),
     array(
            'name'=>'flex_directionNav',
            'type'=>'radio',
            'title'=>__('directionNav','smooththemes'),
            'options'=>array('y'=>__('Yes'),'n'=>__('No')),
            'default'=>'y',
            'desc'=>'Next & Prev navigation'
        ),
     array(
        'name'=>'flex_animationLoop',
        'type'=>'radio',
        'title'=>__('Should the animation loop?','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y'
     ),
      array(
        'name'=>'flex_slideshow',
        'type'=>'radio',
        'title'=>__('Animate slider automatically','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y'
     ),
     array(
        'name'=>'flex_slideshowSpeed',
        'type'=>'text',
        'title'=>__('Slideshow Speed','smooththemes'),
        'default'=>'7000',
        'desc_bottom'=>__('Set the speed of the slideshow cycling, in milliseconds, default: 7000','smooththemes')
     ),
     array(
        'name'=>'flex_animationDuration',
        'type'=>'text',
        'title'=>__('Animation Duration Speed','smooththemes'),
        'default'=>'500',
        'desc_bottom'=>__('Set the speed of the slideshow cycling, in milliseconds, default: 7000','smooththemes')
     ),
     array(
        'name'=>'flex_animationSpeed',
        'type'=>'text',
        'title'=>__('Animation Speed','smooththemes'),
        'default'=>'6000',
        'desc_bottom'=>__('Set the speed of animations, in milliseconds, default: 6000','smooththemes')
     ),
     array(
        'name'=>'flex_pauseOnAction',
        'type'=>'radio',
        'title'=>__('Pause On Action','smooththemes'),
        'options'=>array('true'=>__('Yes'),'false'=>__('No')),
        'default'=>'y'
     ),
     array(
        'name'=>'flex_pauseOnHover',
        'type'=>'radio',
        'title'=>__('Pause On Hover','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y'
     ),
     array(
        'name'=>'flex_controlNav',
        'type'=>'radio',
        'title'=>__('Create navigation for paging control of each clide','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y'
     ),
      array(
        'name'=>'flex_randomize',
        'type'=>'radio',
        'title'=>__('Randomize slide order','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'n'
     )
);



// Font Style Tabs

$font_body = array(

    array(
        'name'        =>'body_font',
        'title'       =>__('Body Font','smooththemes'),
        'type'        =>'style',
        'function'  =>'st_settings_fonts',
        'default'     =>'',
        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
                        sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker 
                        including versions of Lorem Ipsum.',
        'options'=>array(
                'font-family'=>'Droid Sans',
                'color'=>'000000',
                'font-weight' =>'normal',
                'font-style'=>'nomal',
                'line-height'=>'18', // unit px
                'line-height-unit'=>'px',
                'font-size'=>'12',
                'font-size-unit'=>'px',
                'letter-spacing'=>'0',
                'letter-spacing-uni'=>'px'
            ),
        'desc'        =>__('','smooththemes'),
        'desc_bottom' =>''
    ),
    
);

$font_heading = array(

    array(
        'name'        =>'headings_font',
        'title'       =>__('Heading Font','smooththemes'),
        'type'        =>'style',
        'function'  =>'st_settings_fonts',
        'default'     =>'',
        'previetxt'=>'<div style="font-size: 18px; line-height: 30px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged.</div>',
        'options'=>array(
                'font-family'=>'Droid Sans'
            ),
         'support'=>array('font_family'),
        'desc'        =>'',
        'desc_bottom' =>''
    ),

    array(
        'name'        =>'heading_1',
        'title'       =>__('H1','smooththemes'),
        'type'        =>'style',
        'function'  =>'st_settings_fonts',
        'default'     =>'',
        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        'support'=>array('font_size'),
        'options'=>array(
                'font-size'=>'34'
            ),
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'heading_2',
        'title'       =>__('H2','smooththemes'),
        'type'        =>'style',
        'function'  =>'st_settings_fonts',
        'default'     =>'',
        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        
         'support'=>array('font_size'),
        'options'=>array(
                'font-size'=>'34'
            ),
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'heading_3',
        'title'       =>__('H3','smooththemes'),
        'type'        =>'style',
        'function'  =>'st_settings_fonts',
        'default'     =>'',
        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        
         'support'=>array('font_size'),
         'options'=>array(
                'font-size'=>'34'
            ),
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'heading_4',
        'title'       =>__('H4','smooththemes'),
        'type'        =>'style',
        'function'  =>'st_settings_fonts',
        'default'     =>'',
        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
         'support'=>array('font_size'),
         'options'=>array(
                'font-size'=>'34'
            ),
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'heading_5',
        'title'       =>__('H5','smooththemes'),
        'type'        =>'style',
        'function'  =>'st_settings_fonts',
        'default'     =>'',
        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        
         'support'=>array('font_size'),
         'options'=>array(
                'font-size'=>'34'
            ),
        'desc_bottom' =>''
    ),
    
    array(
        'name'        =>'heading_6',
        'title'       =>__('H6','smooththemes'),
        'type'        =>'style',
        'function'  =>'st_settings_fonts',
        'default'     =>'',
        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
         'support'=>array('font_size'),
         'options'=>array(
                'font-size'=>'34'
            ),
        'desc_bottom' =>''
    ),

);


$subcribe_tab = array(
  array(
        'name'        =>'show_subcribe',
        'title'       =>__('Show subcribe form','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y',
        'type'=>'radio',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     array(
        'name'        =>'subcribe_form_type',
        'title'       =>__('subcribe form','smooththemes'),
        'options'=>array('f'=>'Feedburner (Default)','m'=>'Mailchimp'),
        'default'=>'f',
        'type'=>'radio',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     
    array(
        'name'        =>'feedburner_urli',
        'title'       =>'Feedburner urli',
        'type'        =>'text',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>'You can get Feedburner urli from http://feedburner.google.com/'
     ),
     
     array(
        'name'        =>'mailchimp_action',
        'title'       =>'Mailchimp form action',
        'type'        =>'text',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>'Example: <strong>http://smooththemes.us7.list-manage.com/subscribe/post?u=dc130fe66084d082c54779086&amp;id=736887358d</strong> <br/> You can get Mailchimp form action follow steps  <a href="'.ST_ADMIN_URL.'/images/mailchimp-form.png" target="_blank">Here</a> '     
        )
);


$posttype_tab = array(
  array(
        'name'        =>'post_room',
        'title'       =>__('Change room slug','smooththemes'),
        'default'=>'',
        'type'=>'text',
        'desc'        =>'Change/Rewrite the permalink when you use permalink as /%postname%/ ',
        'desc_bottom' =>''
     ),
    array(
        'name'        =>'post_event',
        'title'       =>__('Change event slug','smooththemes'),
        'default'=>'',
        'type'=>'text',
        'desc'        =>'Change/Rewrite the permalink when you use permalink as /%postname%/ ',
        'desc_bottom' =>''
     ),
     array(
        'name'        =>'post_portfolio',
        'title'       =>__('Change portfolio slug','smooththemes'),
        'default'=>'',
        'type'=>'text',
        'desc'        =>'Change/Rewrite the permalink when you use permalink as /%postname%/ ',
        'desc_bottom' =>''
     )
    
);



$sidebar_tab = array(
    array(
        'name'        =>'sidebars',
        'title'       =>'Sidebars',
        'type'        =>'ui',
        'default'     =>'',
        'support'    =>array('title','id'),
        'desc'        =>'',
        'desc_bottom' =>'Create custom sidebar.'
     )
);


global $st_hooks;

$ads_tab = array(
    array(
        'name'        =>'ads',
        'title'       =>'Site Ads Management',
        'type'        =>'ui',
        'default'     =>'',
        'support'    =>array('title','content','hook'),
        'hooks'=>$st_hooks,
        'desc'        =>'',
        'desc_bottom' =>''
     )
);



$tracking_code= array(
    array(
        'name'=>'headder_tracking_code',
        'type'=>'textarea',
        'title'=>__('Header tracking code','smooththemes'),
        'default'=>''
     ),
     array(
        'name'=>'footer_tracking_code',
        'type'=>'textarea',
        'title'=>__('Footer tracking code','smooththemes'),
        'default'=>''
     ),
);


$blog_tab = array(

    array(
        'name'        =>'show_blog_toptitle',
        'title'       =>__('Show Top title in Categories page and Single','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y',
        'type'=>'radio',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
    
    array(
        'name'        =>'blog_toptitle',
        'title'       =>__('Top title','smooththemes'),
        'type'        =>'text',
        'default'     =>__('','smooththemes'),
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     array(
        'name'        =>'show_blog_titlebar',
        'title'       =>__('Show titlebar in Categories page and Single','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y',
        'type'=>'radio',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
        
    array(
        'name'        =>'blog_titlebar',
        'title'       =>__('Titlebar title','smooththemes'),
        'type'        =>'text',
        'default'     =>__('Blog','smooththemes'),
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     array(
        'name'        =>'blog_titlebar_desc',
        'title'       =>__('Titlebar descriptions','smooththemes'),
        'type'        =>'text',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
      array(
        'name'        =>'blog_titlebar_img',
        'title'       =>__('Titlebar background','smooththemes'),
        'type'        =>'upload',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
     )
);


$reservation_head_tab = array(

    array(
        'name'        =>'show_head_reservation_btn',
        'title'       =>__('Show reservation button in header','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y',
        'type'=>'radio',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     
      array(
        'name'        =>'reservation_btn_link',
        'title'       =>__('Button URL','smooththemes'),
        'type'        =>'text',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     array(
        'name'        =>'reservation_btn_txt',
        'title'       =>__('Button text','smooththemes'),
        'type'        =>'text',
        'default'     =>'Reservation',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
      array(
            'name'=>'reservation_btn_skin',
            'title'=>__('Pre-Defined Skins','smooththemes'),
            'type' =>'layout',
            'multiple'=> false,
            'options'=>$predefined_colors,
            'size'=>30,
            'default'=>'80b500',
            'desc_bottom'        =>__('Select a color scheme for your reservation button.','smooththemes')
         ),

    
    
    array(
        'name'        =>'reservation_btn_custom_skin',
        'title'       =>__('Use custom color','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'n',
        'type'=>'radio',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
    
  
     array(
        'name'        =>'reservation_btn_color',
        'title'       =>__('Custom color for reservation','smooththemes'),
        'type'        =>'color',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     
);



$room_tab = array(

    array(
        'name'        =>'room_show_res_btn',
        'title'       =>__('Show reservation button in single room','smooththemes'),
        'options'=>array('y'=>__('Yes'),'n'=>__('No')),
        'default'=>'y',
        'type'=>'radio',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
      array(
        'name'        =>'room_res_btn_link',
        'title'       =>__('Button URL','smooththemes'),
        'type'        =>'text',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     array(
        'name'        =>'room_res_btn_txt',
        'title'       =>__('Button text','smooththemes'),
        'type'        =>'text',
        'default'     =>'Book this room',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
       
);


$titlebar_tab = array(
    
   array(
        'title'       =>__('Default Titlebar settings','smooththemes'),
        'type'        =>'heading',
     ),
        
    array(
        'name'        =>'titlebar_title',
        'title'       =>__('Titlebar title','smooththemes'),
        'type'        =>'text',
        'default'     =>__('Blog','smooththemes'),
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
     array(
        'name'        =>'titlebar_desc',
        'title'       =>__('Titlebar descriptions','smooththemes'),
        'type'        =>'text',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
     ),
     
      array(
        'name'        =>'titlebar_img',
        'title'       =>__('Titlebar background','smooththemes'),
        'type'        =>'upload',
        'default'     =>'',
        'desc'        =>'',
        'desc_bottom' =>''
     )
);

$envato = array(
    array(
        'name' => 'tf_username',
        'type' => 'text',
        'title' => __('Envato Username', 'smooththemes'),
        'default' => ''
    ),
    array(
        'name' => 'tf_api',
        'type' => 'text',
        'title' => __('Envato API Key', 'smooththemes'),
        'default' => ''
    ),
);




// ========================== Setup Load Panel ========================== \\

$tabs_settings =  new Smooththemes_tabs_settings();

// General Setting
$tabs_settings->add_tab('general',__('General Setings','smooththemes'),$general_tab,'icon-cog');
    $tabs_settings->add_tab('general_page',__('Page Settings','smooththemes'),$general_tab_page,'icon-caret-right','general');
    $tabs_settings->add_tab('general_logo',__('Logo','smooththemes'),$general_tab_logo,'icon-caret-right','general');
    $tabs_settings->add_tab('general_favicon',__('Favicon','smooththemes'),$general_tab_favicon,'icon-caret-right','general');
    $tabs_settings->add_tab('general_sidebar',__('Custom Sidebars','smooththemes'),$sidebar_tab,'icon-caret-right','general');

// Font Style Setting
$tabs_settings->add_tab('fonts',__('Font Style','smooththemes'),'','icon-font');
    $tabs_settings->add_tab('fonts_body',__('Body Font','smooththemes'),$font_body,'icon-caret-right','fonts');
    $tabs_settings->add_tab('fonts_heading',__('Heading Font','smooththemes'),$font_heading,'icon-caret-right','fonts');

// Color Setting
$tabs_settings->add_tab('elements_color',__('Elements Color','smooththemes'),'','icon-magic');
    $tabs_settings->add_tab('body_predefined_colors',__('Global Skin','smooththemes'),$global_skin_tab,'icon-caret-right','elements_color');
    $tabs_settings->add_tab('body_bg',__('Body Background','smooththemes'),$bg_tab,'icon-caret-right','elements_color');
    $tabs_settings->add_tab('head_bg',__('Header','smooththemes'),$header_bg_tab,'icon-caret-right','elements_color');



// Overall Elements
$tabs_settings->add_tab('overall_elements',__('Overall Elements','smooththemes'),'','icon-cogs');
     $tabs_settings->add_tab('titlebar',__('Titlebar','smooththemes'),$titlebar_tab,'icon-caret-right','overall_elements'); 
     
    $tabs_settings->add_tab('blog_post',__('Blog posts','smooththemes'),$blog_tab,'icon-caret-right','overall_elements'); 
    $tabs_settings->add_tab('single_setting',__('Single Post Elements','smooththemes'),$oe_single_post,'icon-caret-right','overall_elements');
    $tabs_settings->add_tab('social',__('Social','smooththemes'),$oe_social,'icon-caret-right','overall_elements');
    $tabs_settings->add_tab('footer_copyright',__('Footer Copyright','smooththemes'),$oe_footer_copyright,'icon-caret-right','overall_elements');
    
    $tabs_settings->add_tab('reservation_head_btn',__('Reservation Button','smooththemes'),$reservation_head_tab,'icon-caret-right','overall_elements');
    $tabs_settings->add_tab('room',__('Single Room','smooththemes'),$room_tab,'icon-caret-right','overall_elements');  
    $tabs_settings->add_tab('subcribe',__('Subcribe','smooththemes'),$subcribe_tab,'icon-caret-right','overall_elements');  
    $tabs_settings->add_tab('posttype_slug',__('Links Slug','smooththemes'),$posttype_tab,'icon-caret-right','overall_elements');  


// Slider Setting
$tabs_settings->add_tab('slider',__('Sliders','smooththemes'),array(),'icon-exchange');
    $tabs_settings->add_tab('flexslider',__('FlexSlider','smooththemes'),$tab_flexslider,'icon-caret-right','slider');
   

// Ads Management
//$tabs_settings->add_tab('ads',__('Ads Management','smooththemes'),array(),'icon-cogs');
  //  $tabs_settings->add_tab('ads_manage',__('Ads Management','smooththemes'),$ads_tab,'icon-caret-right','ads');
$tabs_settings->add_tab('st_envato', __('Auto update', 'smooththemes'), $envato, 'icon-cogs');

// for header and footer code
$tabs_settings->add_tab('tracking_code',__('Tracking code','smooththemes'),$tracking_code,'icon-cogs');




function st_build_google_font_options_url($font){
     if(empty($font['family']) || $font['family']=='' ){
                continue;
     }
     
     $variants = '';
     if(isset($font['variants']) && count($font['variants'])){
          $variants =  join(',',$font['variants']);
     }
     $subsets= '';
     if(isset($font['subsets'])&& count($font['subsets'])){
        $subsets = join(',',$font['subsets']);
     }
     
    $url = 'http://fonts.googleapis.com/css?family='.urlencode($font['family']); 
    if($variants!=''){
        $url.=':'.urlencode($variants);
    }
    if($subsets!=''){
          $url  .= '&subset='.urlencode($subsets);
    }

    return $url;
}



// Load Google Webfonts
function st_google_font_to_options(){
     if(!function_exists('st_get_google_fonts_array')){
        if(is_file(dirname(__FILE__).'/google-fonts.php')){
             include(dirname(__FILE__).'/google-fonts.php');
        } 
    }
    
     if(!function_exists('st_get_google_fonts_array')){ 
       
            return array();
      }
      $google_fonts = st_get_google_fonts_array();
      
     // echo count($google_fonts);
      $font_options = array();
      foreach($google_fonts as $k=> $font){
            if(empty($font['family']) || $font['family']=='' ){
                continue;
            }
            
            $font_options[$font['family']] = st_build_google_font_options_url($font);
      }
      return $font_options;
    
}





