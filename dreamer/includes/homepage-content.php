<?php global $smof_data;
$dreamer_homepage_main_title = $smof_data['homepage_main_title'];
$dreamer_homepage_top_icon = $smof_data['homepage_top_icon'];
$dreamer_homepage_text_row_one = $smof_data['homepage_text_row_one'];
$dreamer_homepage_text_row_two = $smof_data['homepage_text_row_two'];
$dreamer_homepage_bottom_icon = $smof_data['homepage_bottom_icon'];
?>

<div class="homepage-text">
    <div class="top-icon">
        <img src="<?php echo $dreamer_homepage_top_icon ?>" alt="<?php echo $dreamer_homepage_main_title; ?>">
    </div>
    <div class="top-divider"></div>
    <h1><?php echo $dreamer_homepage_main_title; ?></h1>
   	<div class="bottom-divider"></div>
    <h2><?php echo $dreamer_homepage_text_row_one; ?></h2>
    <h3><?php echo $dreamer_homepage_text_row_two; ?></h3>
  	<div class="bottom-icon">
        <a href="#parallax-one">
        <img src="<?php echo $dreamer_homepage_bottom_icon; ?>" alt="<?php echo $dreamer_homepage_main_title; ?>"></a>
    </div>
</div>