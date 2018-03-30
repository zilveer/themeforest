<?php

global $td_vc_templates;

/** Homepage template */
$data               = array();
$data['name']       = 'Homepage';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/newsmag.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="5"][td_block_big_grid sort="featured"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][td_block_1 limit="5" custom_title="FASHION WEEK" border_top="no_border_top"  td_filter_default_txt="All" ajax_pagination="next_prev" header_color="#e29c04"][td_block_15 limit="8" custom_title="GADGET WORLD" header_color="#0b8d5d" td_filter_default_txt="All" ajax_pagination="next_prev"][vc_row_inner][vc_column_inner width="1/2"][td_block_2 limit="1" custom_title="BEST Smartphones" header_color="#4db2ec" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column_inner][vc_column_inner width="1/2"][td_block_10 custom_title="DON\'T MISS" td_filter_default_txt="All" limit="3" sort="random_posts"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][td_block_ad_box spot_id="sidebar"][td_block_6 limit="2" custom_title="POPULAR VIDEO" td_filter_default_txt="All" header_color="#ed581c"][td_block_8 limit="3" custom_title="HOLIDAY RECIPES" header_color="#0152a9" td_filter_default_txt="All"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][td_block_14 limit="3" custom_title="EVEN MORE NEWS" td_filter_default_txt="All" ajax_pagination="next_prev" header_color="#288abf"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - loop template */
$data               = array();
$data['name']       = 'Homepage - loop';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/loop.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="3"][/vc_column][/vc_row][vc_row css=".td-top-border{border-top-width: 1px !important;}" el_class="td-ss-row"][vc_column width="2/3"][td_block_slide limit="1" td_filter_default_txt="All"][td_block_11 limit="3" offset="1" td_filter_default_txt="All" border_top="no_border_top"][td_block_ad_box spot_id="custom_ad_1"][td_block_slide limit="1" td_filter_default_txt="All"][td_block_11 limit="3" offset="1" td_filter_default_txt="All" border_top="no_border_top"][td_block_ad_box spot_id="custom_ad_1"][td_block_slide limit="1" td_filter_default_txt="All"][td_block_11 limit="3" offset="1" td_filter_default_txt="All" border_top="no_border_top"][/vc_column][vc_column width="1/3"][td_block_social_counter custom_title="STAY CONNECTED" facebook="themeforest" twitter="envato" youtube="Envato" open_in_new_window="y" border_top="no_border_top"][td_block_ad_box spot_id="sidebar"][td_block_9 limit="3" custom_title="FEATURED" td_filter_default_txt="All" ajax_pagination="next_prev"][td_block_2 limit="3" custom_title="MOST POPULAR" td_filter_default_txt="All" ajax_pagination="next_prev"][td_block_6 limit="2" custom_title="LATEST REVIEWS" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][/vc_row][vc_row css=".td-top-border{border-top-width: 1px !important;}"][vc_column width="1/1"][td_block_ad_box spot_id="custom_ad_2"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][td_block_3 limit="6" custom_title="LATEST ARTICLES" td_filter_default_txt="All" ajax_pagination="infinite"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - big slide template */
$data               = array();
$data['name']       = 'Homepage - big slide';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/big-slide.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="3"][td_block_slide limit="3" td_filter_default_txt="All"][/vc_column][/vc_row][vc_row el_class="td-ss-row"][vc_column width="2/3"][td_block_2 limit="6" custom_title="DON\'T MISS" header_color="#4db2ec" td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top"][/vc_column][vc_column width="1/3"][td_block_social_counter custom_title="STAY CONNECTED" facebook="themeforest" twitter="envato" youtube="UCqglgyk8g84CMLzPuZpzxhQ" open_in_new_window="y" border_top="no_border_top"][td_block_9 limit="2" custom_title="MOST POPULAR" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][td_block_16 limit="5" custom_title="LATEST VIDEOS" td_filter_default_txt="All" ajax_pagination="next_prev" color_preset="td-block-color-style-2" header_color="#ffffff" header_text_color="#000000"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][td_block_2 limit="2" custom_title="TRAVEL GUIDES" td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top" header_color="#c7272f"][td_block_2 limit="2" custom_title="MOBILE AND PHONES" td_filter_default_txt="All" ajax_pagination="next_prev" offset="1" header_color="#107a56"][td_block_ad_box spot_id="custom_ad_1"][td_block_2 limit="2" custom_title="NEW YORK 2014" td_filter_default_txt="All" ajax_pagination="next_prev" offset="1" header_color="#e83e9e"][/vc_column][vc_column width="1/3"][td_block_9 limit="3" custom_title="TECH" td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top"][td_block_15 limit="4" custom_title="FASHION" color_preset="td-block-color-style-2" td_filter_default_txt="All" ajax_pagination="next_prev"][td_block_2 limit="3" custom_title="LATEST REVIEWS" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][td_block_14 limit="3" custom_title="ENTERTAINMENT" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - random template */
$data               = array();
$data['name']       = 'Homepage - random';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/random.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="3"][td_block_big_grid][/vc_column][/vc_row][vc_row][vc_column width="2/3"][td_block_1 limit="5" custom_title="TRAVEL GUIDE"  td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top"][td_block_16 limit="6" custom_title="LATEST VIDEOS" td_filter_default_txt="All"][td_block_ad_box spot_id="custom_ad_1"][td_block_1 limit="5" custom_title="GADGETS WORLD" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][vc_column width="1/3"][td_block_social_counter custom_title="STAY CONNECTED" facebook="themeforest" twitter="envato" youtube="Envato" open_in_new_window="y" border_top="no_border_top"][td_block_9 limit="2" custom_title="LIFESTYLE" td_filter_default_txt="All"][td_block_2 limit="3" custom_title="NUTRITION" color_preset="td-block-color-style-2" td_filter_default_txt="All" header_text_color="#000000" header_color="#ffffff" ajax_pagination="next_prev"][td_block_9 limit="4" custom_title="FASHION WEEK" td_filter_default_txt="All"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - less images template */
$data               = array();
$data['name']       = 'Homepage - less images';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/less-images.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="3"][/vc_column][/vc_row][vc_row el_class="td-ss-row"][vc_column width="2/3"][td_block_2 limit="2" td_filter_default_txt="All" ajax_pagination="next_prev"][td_block_9 limit="6" custom_title="FASHION WEEK" td_filter_default_txt="All" ajax_pagination="next_prev"][td_block_9 limit="6" custom_title="DON\'T MISS" td_filter_default_txt="All" header_color="#4db2ec" color_preset="td-block-color-style-2"][td_block_ad_box spot_id="custom_ad_1"][td_block_1 limit="5" custom_title="GADGET WORLD" td_filter_default_txt="All"][vc_row_inner][vc_column_inner width="1/2"][td_block_10 limit="3" custom_title="LIFESTYLE" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column_inner][vc_column_inner width="1/2"][td_block_10 limit="3" custom_title="MOBILE AND PHONES" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][td_block_social_counter custom_title="STAY CONNECTED" facebook="themeforest" twitter="envato" youtube="Envato" open_in_new_window="y"][td_block_ad_box spot_id="sidebar"][vc_wp_recentcomments title="RECENT COMMENTS" number="3"][td_block_2 limit="1" custom_title="LATEST REVIEWS" td_filter_default_txt="All" ajax_pagination="next_prev"][vc_wp_posts show_date="1" title="RECENT POSTS" number="3"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - sport template */
$data               = array();
$data['name']       = 'Homepage - sport';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/sport.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now sort="random_posts" limit="5"][td_block_big_grid][/vc_column][/vc_row][vc_row el_class="td-ss-row"][vc_column width="2/3"][td_block_2 limit="6" custom_title="POPULAR NEWS" border_top="no_border_top" td_filter_default_txt="All" ajax_pagination="next_prev"][td_block_1 limit="5" custom_title="TRAVEL" td_filter_default_txt="All" offset="1" ajax_pagination="next_prev"][/vc_column][vc_column width="1/3"][td_block_social_counter facebook="themeforest" twitter="envato" youtube="UCqglgyk8g84CMLzPuZpzxhQ"][td_block_9 limit="3" custom_title="FOOD" td_filter_default_txt="All"][td_block_15 limit="3" custom_title="FASHION" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][td_block_video_youtube playlist_yt="PELlHslllk0, gWL-r72tGOE, aZJSMxsjimQ, ujfOyae1eww, _kC_kwWPTx4, BdEOq7XAyrA, -S9L38ZqHw8, FSMxYS6h2tw, w6nXDPEI768, 3jT_q7dt-cM" playlist_auto_play="0" playlist_title="Video playlist"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - tech template */
$data               = array();
$data['name']       = 'Homepage - tech';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/tech.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="5"][td_block_14 limit="3" custom_title="FEATURED" td_filter_default_txt="All"][/vc_column][/vc_row][vc_row el_class="td-ss-row"][vc_column width="2/3"][td_block_1 limit="5" custom_title="WHAT\'S NEW" td_filter_default_txt="All" border_top="no_border_top"][td_block_2 limit="6" custom_title="ACCESSORIES" header_color="#0a9e01" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][vc_column width="1/3"][td_block_ad_box spot_id="sidebar"][td_block_6 limit="1" custom_title="WINDOWS PHONE" td_filter_default_txt="All" header_color="#55a4ff"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][td_block_big_grid][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - full post featured template */
$data               = array();
$data['name']       = 'Homepage - full post featured';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/full-post.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_homepage_full_1][/vc_column][/vc_row][vc_row el_class="td-ss-row"][vc_column width="2/3"][td_block_2 limit="6" custom_title="DON\'T MISS" td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top"][td_block_15 limit="6" custom_title="Lifestyle" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][vc_column width="1/3"][td_block_ad_box spot_id="sidebar"][td_block_1 limit="3" custom_title="Food" td_filter_default_txt="All"][/vc_column][/vc_row][vc_row css=".td-top-border{border-top-width: 1px !important;}"][vc_column width="1/1"][td_block_ad_box spot_id="custom_ad_2"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;


/** Homepage - blog template */
$data               = array();
$data['name']       = 'Homepage - blog';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/blog.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="5"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - newspaper template */
$data               = array();
$data['name']       = 'Homepage - newspaper';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/newspaper.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="3"][td_block_big_grid][/vc_column][/vc_row][vc_row][vc_column width="2/3"][td_block_2 limit="6" custom_title="DON\'T MISS" header_color="#4db2ec" td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top"][td_block_1 limit="5" custom_title="GADGET WORLD" header_color="#0b8d5d" td_filter_default_txt="All"] [td_block_ad_box spot_id="custom_ad_1"][td_block_2 limit="6" custom_title="TRAVEL GUIDES" header_color="#f24b4b" td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][vc_column width="1/3"][td_block_social_counter custom_title="STAY CONNECTED" facebook="themeforest" twitter="envato" youtube="Envato" open_in_new_window="y" border_top="no_border_top"][td_block_ad_box spot_id="sidebar"][td_block_2 limit="3" custom_title="LATEST REVIEWS" td_filter_default_txt="All"][td_block_slide limit="3" custom_title="POPULAR VIDEO" td_filter_default_txt="All"][td_block_9 limit="3" custom_title="CHICAGO SHOW" td_filter_default_txt="All"][/vc_column][/vc_row][vc_row el_class="td-ss-row"][vc_column width="2/3"][td_block_2 limit="6" custom_title="FASHION AND TRENDS" header_color="#ff3e9f"  td_filter_default_txt="All"][/vc_column][vc_column width="1/3"][td_block_7 limit="1" custom_title="EDITOR PICKS" td_filter_default_txt="All"][td_block_ad_box spot_id="sidebar"][/vc_column][/vc_row][vc_row css=".td-top-border{border-top-width: 1px !important;}"][vc_column width="1/1"][td_block_ad_box spot_id="custom_ad_2"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - infinite scroll template */
$data               = array();
$data['name']       = 'Homepage - infinite scroll';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/infinite-scroll.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="3"][td_block_big_grid][/vc_column][/vc_row][vc_row][vc_column width="1/1"][td_block_2 limit="3" custom_title="DON\'T MISS"  td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top"][/vc_column][/vc_row][vc_row css=".td-top-border{border-top-width: 1px !important;}" el_class="td-ss-row"][vc_column width="2/3"][td_block_3 limit="6" custom_title="LATEST ARTICLES" td_filter_default_txt="All" ajax_pagination="infinite" border_top="no_border_top" ajax_pagination_infinite_stop="3"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="td-default"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - magazine template */
$data               = array();
$data['name']       = 'Homepage - magazine';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/magazine.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="3"][/vc_column][/vc_row][vc_row css=".td-top-border{border-top-width: 1px !important;}"][vc_column width="2/3"][td_block_slide limit="3" td_filter_default_txt="All"][td_block_2 limit="6" custom_title="DON\'T MISS" td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top"][td_block_1 limit="5" custom_title="GADGETS WORLD" td_filter_default_txt="All" border_top="no_border_top"][td_block_ad_box spot_id="custom_ad_1"][td_block_15 limit="8" custom_title="LIFESTYLE" td_filter_default_txt="All"][/vc_column][vc_column width="1/3"][td_block_social_counter facebook="themeforest" twitter="envato" youtube="Envato" custom_title="STAY CONNECTED" border_top="no_border_top"][td_block_9 limit="5" custom_title="LIFESTYLE" td_filter_default_txt="All" ajax_pagination="next_prev" border_top="no_border_top"][td_block_ad_box spot_id="sidebar"][vc_wp_posts show_date="1" title="RECENT POSTS" number="5"][td_block_2 limit="3" custom_title="LATEST REVIEWS" td_filter_default_txt="All"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - fashion template */
$data               = array();
$data['name']       = 'Homepage - fashion';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/fashion.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_homepage_full_1][td_block_2 limit="3" custom_title="MOST POPULAR" border_top="no_border_top"  td_filter_default_txt="All" ajax_pagination="next_prev"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Homepage - clean template */
$data               = array();
$data['name']       = 'Homepage - clean';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/clean.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][td_block_trending_now limit="3"][td_block_big_grid][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Contact Page template */
$data               = array();
$data['name']       = 'Contact Page';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/contact-temp.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="2/3"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse non nunc ac quam congue fermentum et vel massa. Proin imperdiet pulvinar rhoncus. Integer in elit accumsan, ullamcorper ante non, commodo velit. Nunc luctus scelerisque dui, vitae luctus est auctor eu.[/vc_column_text][vc_row_inner][vc_column_inner width="1/2"][td_block_text_with_title custom_title="Contact Details"]Newsmag Comunication Service
123 California St. Doargo

(650) 123-2558 (main number)
(650) 123-0247 (fax)

Email: contact@yoursite.com[/td_block_text_with_title][/vc_column_inner][vc_column_inner width="1/2" css=".td-no-left-border{border-left-width: 0px !important;}"][td_block_text_with_title custom_title="About us"]Newsmag is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.[/td_block_text_with_title][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="td-default"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Sidebar right template */
$data               = array();
$data['name']       = 'Sidebar right';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/right-sidebar.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="2/3"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="td-default"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;

/** Sidebar left template */
$data               = array();
$data['name']       = 'Sidebar left';
$data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/left-sidebar.png';
$data['custom_class'] = ''; // default is ''
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/3"][vc_widget_sidebar sidebar_id="td-default"][/vc_column][vc_column width="2/3"][/vc_column][/vc_row]
CONTENT;

$td_vc_templates[] = $data;
