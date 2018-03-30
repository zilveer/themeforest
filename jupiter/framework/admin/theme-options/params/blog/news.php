<?php
$blog_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_news_single",
    "name" => __("Blog & News / News", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("News Slug", "mk_framework") ,
            "desc" => __("News Slug is the text that is displyed in the URL (e.g. www.domain.com/<strong>news-posts</strong>/morbi-et-diam-massa/). As shown in the example, it is set to 'news-posts' by default but you can change it to anything to suite your preference. However you should not have the same slug in any page or other post slug and if so the pagination will return 404 error naturally due to the internal conflicts.", "mk_framework") ,
            "id" => "news_slug",
            "default" => 'news-posts',
            "type" => "text"
        ) ,
        array(
            "name" => __("News Single Featured Image", "mk_framework") ,
            "desc" => __("If you do not want to dispaly featured image, Kindly disable it here.", "mk_framework") ,
            "id" => "news_disable_featured_image",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("News Single Post Featured Image Height", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "news_featured_image_height",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "default" => "340",
            "unit" => 'px',
            "type" => "range"
        ) ,
        
    ) ,
);
