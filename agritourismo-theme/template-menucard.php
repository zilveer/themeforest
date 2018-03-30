<?php
/*
Template Name: Menucard
*/	
?>
<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>
<?php

	//get all categories
	$categories = get_terms( 'product_cat', 'orderby=name&hide_empty=1' );
	if ( ot_is_woocommerce_activated() == true ) { 
		$menuArray = ot_menu_card_query($categories);
		global $OTpostContent;
		$OTpostContents = $menuArray['postContents'];
		$catCount = $menuArray['catCount'];
		$postInPage = $menuArray['postInPage'];
	}

	$counter = 1;
	$catCounter = 1;
	$catPostCounter = 1;
	$categoryOld = "";
?>
<?php get_template_part(THEME_LOOP."loop","start"); ?>
	<!-- BEGIN .content-main -->
	<div class="content-main alternate full-width">
		<?php get_template_part(THEME_SINGLE."page","title"); ?>
		<div class="paragraph-row">
			<?php if ( ot_is_woocommerce_activated() == true ) {  ?>
				<?php for($i=0; $i<$catCount; $i++) { ?>
					<?php if($OTpostContents) { ?>
						<?php if(!empty($OTpostContents[$i])) { ?>
							<?php foreach($OTpostContents[$i] as $OTpostContent) { ?>
									<?php
										$categoryNew = $OTpostContent['cat_name'];
									?>
									<?php if($counter==1) { ?>
										<div class="column6">
									<?php } ?>

									<?php if($catCounter==(ceil($catCount/2)) && ($counter!=1 && $catPostCounter==1)) { ?>
										</div>
										<div class="column6">
									<?php } ?>


									<?php if($categoryOld!=$categoryNew) { ?>
										<div class="menu-card-category">
											<a href="#top" class="right"><?php _e("Back to top", THEME_NAME);?></a>
											<h3><?php echo $categoryNew;?></h3>
										</div>
									<?php } ?>


									<?php get_template_part(THEME_LOOP."menu","item"); ?>


									<?php if($counter==$postInPage) { ?>
										</div>
									<?php } ?>
									<?php if($categoryOld!=$categoryNew) { ?>
										<?php if($counter>1) { $catCounter++; } ?>
									<?php } ?>
									<?php 
										$categoryOld = $categoryNew; 
										$counter++;
										if($catPostCounter==$OTpostContent['item_count']) {
											$catPostCounter=1;
										} else {
											$catPostCounter++;
										}

									?>
							<?php } ?>
						<?php } ?>
					<?php } else { ?>
						<?php if($i==1){ get_template_part(THEME_LOOP."no","post"); } ?>
					<?php } ?>
				<?php } ?>
			<?php } else { _e("Please activate woocommerce plugin!", THEME_NAME); } ?>
		</div>
	<!-- END .content-main -->
	</div>
<?php get_template_part(THEME_LOOP."loop","end"); ?>
<?php get_footer();?>