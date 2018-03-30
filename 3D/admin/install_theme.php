<?php if(file_exists('../../../../wp-config.php')){include_once('../../../../wp-config.php');} ?>
<?php
global $wpdb;
$prefix = $wpdb->prefix;
mysql_query("CREATE TABLE ".$prefix."iam (id int(11) NOT NULL AUTO_INCREMENT, cat_id int(11), title varchar(255), value1 varchar(255), value2 varchar(255), value3 varchar(255), value4 text, value5 text, value6 text, func varchar(255), ord int(11), PRIMARY KEY (id))  ENGINE=MyISAM DEFAULT CHARSET=UTF8");
echo mysql_error();


// TEST
mysql_query("INSERT INTO ".$prefix."iam (title) VALUES ('TEST')");


include_once('func_wp_load.php');

update_option('im_theme_backgorund_color','7b2847');
update_option('im_theme_font_color','7b2847');
update_option('iam_theme_3D_logo', get_bloginfo('template_url').'/image/logo.png');
update_option('iam_theme_3D_slider_style','1');


// footer social buttons
update_option('im_footer_sb_facebook','true');
update_option('im_footer_sb_twitter','true');
update_option('im_footer_sb_google','true');
update_option('im_footer_sb_yahoo','true');
update_option('im_footer_sb_de','true');
update_option('im_footer_sb_in','true');
update_option('im_footer_sb_sb','true');
update_option('im_footer_sb_te','true');
update_option('im_footer_sb_rss','true');
// sidebar module	
update_option('im_theme_sidebar_cat','true');
update_option('im_theme_sidebar_tag','true');
update_option('im_theme_blog_archive','true');
update_option('im_theme_last_comment','true');
update_option('im_theme_single_detail','true');
update_option('im_theme_single_tag','true');
update_option('im_theme_single_related','true');
// favicon
update_option('im_theme_favicon', get_bloginfo('template_url').'/image/favicon.ico');

// contact page
update_option('im_theme_contact_name','John Doe');
update_option('im_theme_contact_telephone','+49 00 555 432 321');
update_option('im_theme_contact_fax','+49 00 555 432 321');
update_option('im_theme_contact_email','jhon@domain.com');
update_option('im_theme_contact_web','http://www.imtheme.com');
update_option('im_theme_contact_maps_iframe_code','<iframe width="733" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" class="googlemaps" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Istanbul,+Turkey&amp;sll=37.0625,-95.677068&amp;sspn=37.136668,86.044922&amp;ie=UTF8&amp;hq=&amp;hnear=Istanbul,+Turkey&amp;ll=41.068998,28.972321&amp;spn=0.362372,0.583649&amp;z=10&amp;iwloc=A&amp;output=embed"></iframe>');

update_option('im_theme_google_analytics','');

add_iam('','homepage_slider',get_bloginfo('template_url').'/images/large/1.jpg','Creative By','','Acidtronic','','','','');
add_iam('','homepage_slider',get_bloginfo('template_url').'/images/large/2.jpg','Friendly','','Devil','','','','');
add_iam('','homepage_slider',get_bloginfo('template_url').'/images/large/3.jpg','Tranquilent','','Compatriot','','','','');
add_iam('','homepage_slider',get_bloginfo('template_url').'/images/large/4.jpg','Insecure','','Hussler','','','','');
add_iam('','homepage_slider',get_bloginfo('template_url').'/images/large/5.jpg','Company','','Plustanbul','','','','');
add_iam('','homepage_slider',get_bloginfo('template_url').'/images/large/6.jpg','Photograph by','','Ilay Alpgiray','','','','');

add_iam('','homepage_tab',get_bloginfo('template_url').'/image/icon1.png','Main Stage','The only illustration that improwes with time','Find out how design idea can help you accomplish them all','1','','','1');
add_iam('','homepage_tab',get_bloginfo('template_url').'/image/icon2.png','My Working','Pellentesque egestas viverra augue eu pulvinar aenean','Find out how design idea can help you accomplish them all','2','','','2');
add_iam('','homepage_tab',get_bloginfo('template_url').'/image/icon3.png','Recent Articles','Mauris posuere ipsum ut eros sollicitudin massa mollis','Find out how design idea can help you accomplish them all','3','','','3');
add_iam('','homepage_tab',get_bloginfo('template_url').'/image/icon4.png','My Videos','Aliquam sollicitudin magna ut sapien cursus a fringilla','Find out how design idea can help you accomplish them all','4','','','4');
add_iam('','homepage_tab',get_bloginfo('template_url').'/image/icon5.png','Sales Charts','Curabitur magna tortor lacinia sit amet aliquam ac laoreet','Find out how design idea can help you accomplish them all','5','','','5');
add_iam('','homepage_tab',get_bloginfo('template_url').'/image/icon6.png','Download','Curabitur magna tortor lacinia sit amet aliquam ac laoreet','Find out how design idea can help you accomplish them all','6','','','6');


// logo company
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/1.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/2.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/3.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/4.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/5.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/6.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/7.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/8.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');
add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/9.png','','http://imtheme.net','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','','','','1');





add_iam('','hompage_3_column_area',get_bloginfo('template_url').'/image/bicon1.png','Perfect Conception','All','#', 'Proin sit amet magna metus, posuere tempus. Proin ligula tempus tempus. Morbi varius mauris consectetur porta. Proin, porta laoreet adipiscing nec, aliquam fringilla nunc.','1','','1');

add_iam('','hompage_3_column_area',get_bloginfo('template_url').'/image/bicon2.png','Magnitude World Cost','All','#', 'Vivamus suscipit, mauris sit amet ullamcorper lobortis, dolor enim elementum turpis, id tincidunt nibh mi ac urna. Duis urna nisi, fermentum ut laoreet ut, pharetra in nisl.','2','','2');

add_iam('','hompage_3_column_area',get_bloginfo('template_url').'/image/bicon3.png','Enterprise Mail Box','All','#', 'Nunc hendrerit dignissim erat sed tincidunt. Curabitur ac neque nulla. Duis et bibendum nisi. Aliquam quis pulvinar justo. Fusce ac ligula ac metus pulvinar molestie non ut dui.','3','','3');

// footer
update_option('footer_text_1','Copright © 2012 3D Idea imthemes.com. All rights reserved. W3C web valid xhtml and css');
update_option('footer_text_2','<a href="#">Terms Multimedia</a> | <a href="#">Privacy</a> | <a href="#">Contact</a>');

update_option('im_sidebar_lang_blog_categories','Blog Categories');
update_option('im_sidebar_lang_blog_populer_tags','Populer Tags');
update_option('im_sidebar_lang_blog_archive','Populer Archive');
update_option('im_sidebar_lang_blog_last_comment','Last Comments');

update_option('im_sidebar_lang_single_post_detail','Post Detail');
update_option('im_sidebar_lang_single_post_tags','Post Tags');
update_option('im_sidebar_lang_single_related_post','Related Post');
update_option('im_sidebar_lang_single_adress_detail','Adress Detail');

update_option('im_sidebar_lang_single_post_detail_author','Author');
update_option('im_sidebar_lang_single_post_detail_date','Date');
update_option('im_sidebar_lang_single_post_detail_categories','Categories');
update_option('im_sidebar_lang_single_post_detail_total','Total');
update_option('im_sidebar_lang_single_post_detail_comments','Comments');
update_option('im_sidebar_lang_single_post_detail_view_post_image','View Post Image');
update_option('im_sidebar_lang_single_post_detail_watch_post_video','Watch Post Video');
update_option('im_sidebar_lang_single_post_detail_look_post_iframe','Look Post Iframe');


update_option('im_lang_slide_read_more','Read More');
update_option('im_lang_blog_more','More');
update_option('im_lang_blog_author','Author');
update_option('im_lang_blog_date','Date');
update_option('im_lang_blog_attchment','Attchment');
update_option('im_lang_blog_categories','Categories');
update_option('im_lang_blog_tags','Tags');

update_option('im_lang_blog_post_comments','Post Comments');
update_option('im_lang_blog_post_comment_write', 'Post Comment Write');
update_option('im_lang_blog_message','Message');
update_option('im_lang_blog_send','Send');

update_option('im_lang_portfolio_all','All');

// DISPLAY SHOW
update_option('im_theme_show_tab_menu','true');
update_option('im_theme_show_3_column','true');

// PORTFOLIO
update_option('im_theme_portfolio_amount', '8');

if(mysql_affected_rows() > 0){echo '<script>window.location = "?page=iamadmin.php"</script>';}
?>