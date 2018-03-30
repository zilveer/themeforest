<?php 

$themename = "The Cause";
$pageoptions = array('file' => basename(__FILE__), 'name' => 'Home/Archive', 'child' => true);

$blogNumberWide = array();
$blogNumberWideMin = 3;
while ($blogNumberWideMin < 13) {
	$blogNumberWide[$blogNumberWideMin] = $blogNumberWideMin;
	$blogNumberWideMin++;
}


$blogNumber3C = array();
$blogNumber3cMin = 3;
while ($blogNumber3cMin < 16) {
	$blogNumber3C[$blogNumber3cMin] = $blogNumber3cMin;
	$blogNumber3cMin += 3;
}

$blogLayout = array(
	'wide' => 'Wide',
	'columns' => '3 Columns'
);

$homeLayout = array(
	'none' => 'Choose content of area',
	'latest' => 'Latest Posts',
	'videos' => 'Video Area',
	'content' => 'Page Content'
);

$gallerySlider = array();
$gallerySliderMin = 3;

while ($gallerySliderMin < 9) {
	$gallerySlider[$gallerySliderMin] = $gallerySliderMin;
	$gallerySliderMin++;
}

$galleryThumbnails = array();
$galleryThumbsMin = 3;

while ($galleryThumbsMin < 16) {
	$galleryThumbnails[$galleryThumbsMin] = $galleryThumbsMin;
	$galleryThumbsMin += 3;
}

$videoWideThumbnails = array();
$videoWideThumbsMin = 3;

while ($videoWideThumbsMin < 11) {
	$videoWideThumbnails[$videoWideThumbsMin] = $videoWideThumbsMin;
	$videoWideThumbsMin++;
}

$videoThumbnails = array();
$videoThumbsMin = 4;

while ($videoThumbsMin < 17) {
	$videoThumbnails[$videoThumbsMin] = $videoThumbsMin;
	$videoThumbsMin += 4;
}

$tbCategories = tb_get_categories('category');

$tbCategoriesArray = array();
$tbCategoriesArray[0] = 'Choose category...';
foreach ($tbCategories as $category) {
	$catID = $category->term_id;
	$catTitle = $category->name;

	$tbCategoriesArray[$catID] = $catTitle;
}

// Options
$options = array();
$options[] = array( "name" => "Archive Pages Settings", "type" => "title");

// HOME
$options[] = array( "name" => "Home page Settings", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Home page slogan.", "desc" => "", "id" => "tb_home_slogan", "type" => "text", "std" => '');
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Donate button text.", "desc" => "", "id" => "tb_donate_button", "type" => "text", "std" => DEFAULT_DONATE_BUTTON_TEXT);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Home page - Area 1.", "desc" => "Please choose content of home page area 1.", "id" => "tb_home_area_1", "type" => "select", "value" => $homeLayout, "std" => 'latest');
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Home page - Area 2.", "desc" => "Please choose content of home page area 2.", "id" => "tb_home_area_2", "type" => "select", "value" => $homeLayout, "std" => 'videos');
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Home page - Area 3.", "desc" => "Please choose content of home page area 3.", "id" => "tb_home_area_3", "type" => "select", "value" => $homeLayout, "std" => 'none');
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Number of latest posts.", "desc" => "Please choose number of latest posts for home page.", "id" => "tb_home_page_latest_posts_no", "type" => "select", "value" => $gallerySlider, "std" => '5');$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Number of videos.", "desc" => "Please choose number of videos for home page.", "id" => "tb_home_page_videos_no", "type" => "select", "value" => $gallerySlider, "std" => '4');
$options[] = array( "type" => "close2");

// BLOG
$options[] = array( "name" => "Blog Settings", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Blog page layout.", "desc" => "Please choose layout of blog pages.", "id" => "tb_blog_layout", "type" => "select", "value" => $blogLayout, "std" => DEFAULT_BLOG_LAYOUT);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Number of entries for blog page - wide style", "desc" => "Please, choose number of entries which will be showed on each blog page.", "id" => "tb_blog_number_wide", "type" => "select", "value" => $blogNumberWide, "std" => DEFAULT_BLOG_NUMBER_WIDE);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Number of entries for blog page - column style", "desc" => "Please, choose number of entries which will be showed on each blog page.", "id" => "tb_blog_number_3c", "type" => "select", "value" => $blogNumber3C, "std" => DEFAULT_BLOG_NUMBER_3C);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Exclude categories", "desc" => "Please, add comma separated category ids. (i.e. -1,-3,-5: minus sign is required)", "id" => "tb_exclude_categories", "type" => "text", "std" => '');
$options[] = array( "type" => "close2");

// GALLERY
$options[] = array( "name" => "Media Pages Settings", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Show featured slider", "desc" => "Do you want to show slider with featured photos on media pages (main media and gallery page)?", "id" => "tb_gallery_featured_slider", "type" => "radio", "value" => array('Yes' => 1, 'No' => 2), "std" => DEFAULT_SHOW_GALLERY_SLIDER);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Number of featured photos in slider", "desc" => "How many photos do you want to show in gallery page slider?", "id" => "tb_gallery_featured_slider_number", "type" => "select", "value" => $gallerySlider, "std" => DEFAULT_GALLERY_SLIDER_NUMBER);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Number of thumbnails", "desc" => "How many thumbnails do you want to show on gallery page?", "id" => "tb_gallery_thumbnail_number", "type" => "select", "value" => $galleryThumbnails, "std" => DEFAULT_GALLERY_THUMBNAIL_NUMBER);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Number of videos - wide page", "desc" => "How many videos do you want to show on wide video page?", "id" => "tb_video_wide_thumbs", "type" => "select", "value" => $videoWideThumbnails, "std" => DEFAULT_VIDEO_WIDE);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Number of videos - 4 columns page", "desc" => "How many videos do you want to show on 4 columns video page?", "id" => "tb_video_4c_thumbs", "type" => "select", "value" => $videoThumbnails, "std" => DEFAULT_VIDEO_4C);
$options[] = array( "type" => "close2");

$adminOptionsPage = new dashboardPages($options, $pageoptions);

?>