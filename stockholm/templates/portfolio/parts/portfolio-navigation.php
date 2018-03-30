<?php 
global $qode_options;

$enable_navigation = true;
if (isset($qode_options['portfolio_hide_pagination']) && $qode_options['portfolio_hide_pagination'] == "yes"){
	$enable_navigation = false;
}

$portfolio_navigation_reverse_order = false;
if (isset($qode_options['portfolio_navigation_reverse_order']) && $qode_options['portfolio_navigation_reverse_order'] == "yes"){
	$portfolio_navigation_reverse_order = true;
}

$navigation_through_category = false;
if (isset($qode_options['portfolio_navigation_through_same_category']) && $qode_options['portfolio_navigation_through_same_category'] == "yes")
	$navigation_through_category = true;
?>
<?php if($enable_navigation){ ?>
	<div class="portfolio_navigation">
		<div class="portfolio_navigation_inner">
			<?php if($portfolio_navigation_reverse_order){ ?>
				<?php if(get_next_post() != ""){ ?>
					<div class="portfolio_prev">
						<?php
							if($navigation_through_category){
								next_post_link('%link','<span class="arrow_carrot-left"></span>', true,'','portfolio_category');
							} else {
								next_post_link('%link','<span class="arrow_carrot-left"></span>');
							}
						?>
					</div> <!-- close div.portfolio_prev -->
				<?php } ?>	
				<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != "") { ?>
					<div class="portfolio_button">
						<a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"><span class="icon_grid-2x2"></span></a>
					</div> <!-- close div.portfolio_button -->
				<?php } ?>
				<?php if(get_previous_post() != ""){ ?>	
					<div class="portfolio_next">
						<?php
							if($navigation_through_category){
								previous_post_link('%link','<span class="arrow_carrot-right"></span>', true,'','portfolio_category');
							} else {
								previous_post_link('%link','<span class="arrow_carrot-right"></span>');
							}
						?>
					</div> <!-- close div.portfolio_next -->
				<?php } ?>	
			<?php } else { ?>
				<?php if(get_previous_post() != ""){ ?>
					<div class="portfolio_prev">
						<?php
							if($navigation_through_category){
								previous_post_link('%link','<span class="arrow_carrot-left"></span>', true,'','portfolio_category');
							} else {
								previous_post_link('%link','<span class="arrow_carrot-left"></span>');
							}
						?>
					</div> <!-- close div.portfolio_prev -->
				<?php } ?>	
				<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != "") { ?>
					<div class="portfolio_button">
						<a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"><span class="icon_grid-2x2"></span></a>
					</div> <!-- close div.portfolio_button -->
				<?php } ?>
				<?php if(get_next_post() != ""){ ?>	
					<div class="portfolio_next">
						<?php
							if($navigation_through_category){
								next_post_link('%link','<span class="arrow_carrot-right"></span>', true,'','portfolio_category');
							} else {
								next_post_link('%link','<span class="arrow_carrot-right"></span>');
							}
						?>
					</div> <!-- close div.portfolio_next -->
				<?php } ?>	
			<?php } ?>
		</div>
	</div> <!-- close div.portfolio_navigation -->
<?php } ?>	