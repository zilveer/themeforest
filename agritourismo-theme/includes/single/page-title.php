<?php
	//single page titile
	$titleShow = get_post_meta ( OT_page_id(), THEME_NAME."_title_show", true );
	$subTitle = get_post_meta ( OT_page_id(), THEME_NAME."_subtitle", true ); 
?>

<?php if($titleShow!="no") { ?>
	<div class="main-title">
		<h2><?php echo ot_page_title(); ?></h2>
		<?php if($subTitle) { ?>
			<span><?php echo $subTitle;?></span>
		<?php } ?>
	</div>
<?php } ?>
