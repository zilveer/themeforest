<?php
$query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='hompage_3_column_area' ORDER BY ord ASC");
while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
{
	$im_ID = $list_homepage_slider['id'];
	$q_3_columun_image_url = $list_homepage_slider['value1'];
	$q_3_columun_title = $list_homepage_slider['value2'];
	$q_3_columun_button_title = $list_homepage_slider['value3'];
	$q_3_columun_url = $list_homepage_slider['value4'];
	$q_3_columun_description = $list_homepage_slider['value5'];
	$q_3_columun_no = $list_homepage_slider['value6'];
?>
	<!-- #1 -->
	<div class="bottom-list">
		<img src="<?php echo $q_3_columun_image_url; ?>" alt="<?php echo $q_3_columun_title; ?>" width="46" height="46" class="bottom-icon" />
		<h1><?php echo $q_3_columun_title; ?></h1>
		<p><?php echo $q_3_columun_description; ?></p>
		<a href="<?php echo $q_3_columun_url; ?>" class="More3d bottom-button"><?php echo $q_3_columun_button_title; ?></a>
	</div>
 <?php } ?>