
<?php

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE FEATURED ITEMS							*
 * -------------------------------------------------------------------------*/
 
	function homepage_featured_products($blockType, $blockId,$blockInputType) {
		global $woocommerce, $product;
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$subTitle = get_option(THEME_NAME."_".$blockType."_subtitle_".$blockId);
		$count = get_option(THEME_NAME."_".$blockType."_count_".$blockId);
		if ( ot_is_woocommerce_activated() == true ) { 
			$query_args = array('posts_per_page' => $count, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

			$query_args['meta_query'] = $woocommerce->query->get_meta_query();
			$query_args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);

	    	$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	    	$query_args['meta_query']   = array_filter( $query_args['meta_query'] );
			$r = new WP_Query($query_args);
		}
?>
					<!-- BEGIN .main-block -->
					<div class="main-block grid-block">
						<div class="main-title">
							<h2><?php echo $title;?></h2>
							<?php if($subTitle) { ?>
								<span><?php echo $subTitle;?></span>
							<?php } ?>
						</div>
						<?php if ( ot_is_woocommerce_activated() == true ) { ?>
							<?php if ($r->have_posts()) : ?>
								<?php woocommerce_product_loop_start(); ?>
									<?php while ($r->have_posts()) : $r->the_post(); ?>
										<?php woocommerce_get_template_part( 'content', 'product' ); ?>
									<?php endwhile; ?>
								<?php woocommerce_product_loop_end(); ?>
							<?php endif; ?>
						<?php } else { _e("Please activate woocommerce plugin!", THEME_NAME); } ?>
					<!-- END .main-block -->
					</div>

<?php
	}
?>

<?php

/* -------------------------------------------------------------------------*
 * 									3 INFO BLOCKS							*
 * -------------------------------------------------------------------------*/
 
	function homepage_info_blocks($blockType, $blockId,$blockInputType) {
?>
					<!-- BEGIN .main-block -->
					<div class="main-block triple-icons">
						<div class="paragraph-row">
<?php
						for($i=1; $i<=3; $i++) {
							$title = get_option(THEME_NAME."_".$blockType."_title_".$i."_".$blockId);
							$icon = get_option(THEME_NAME."_".$blockType."_icon_".$i."_".$blockId);
							$text = get_option(THEME_NAME."_".$blockType."_text_".$i."_".$blockId);
							$link = get_option(THEME_NAME."_".$blockType."_link_".$i."_".$blockId);

?>
							<div class="column4">
								<span class="icon-text"><?php echo $icon;?></span>
								<?php if($title) { ?>
									<h3><?php echo $title;?></h3>
								<?php } ?>
								<?php if($text) { ?>
									<p><?php echo do_shortcode(nl2br(stripslashes($text)));?></p>
								<?php } ?>
								<?php if($link) { ?>
									<a href="<?php echo $link;?>" class="button-link invert"><?php _e("Read More", THEME_NAME);?><span class="icon-text">&#9656;</span></a>
								<?php } ?>
							</div>
<?php } ?>
							<div class="clear-float"></div>
						</div>
					<!-- END .main-block -->
					</div>
<?php
	}
?>
<?php

/* -------------------------------------------------------------------------*
 * 									INFO BOXES								*
 * -------------------------------------------------------------------------*/
 
	function homepage_info_boxes($blockType, $blockId,$blockInputType) {
?>
					<!-- BEGIN .paragraph-row -->
					<div class="paragraph-row">
<?php
						for($i=1; $i<=2; $i++) {
							$title = get_option(THEME_NAME."_".$blockType."_title_".$i."_".$blockId);
							$file = get_option(THEME_NAME."_".$blockType."_image_".$i."_".$blockId);
							$image = get_post_thumb(false, 223, 170, false, $file);
							$text = get_option(THEME_NAME."_".$blockType."_text_".$i."_".$blockId);
							$link = get_option(THEME_NAME."_".$blockType."_link_".$i."_".$blockId);

?>
							<div class="column6">
								<?php if($link) { ?>
									<a href="<?php echo $link;?>" class="coupon">
								<?php } ?>
									<span class="coupon-content">
										<?php if($title) { ?>
											<b><?php echo $title;?></b>
										<?php } ?>
										<?php if($text) { ?>
											<span><?php echo do_shortcode(stripslashes($text));?></span>
										<?php } ?>
									</span>
									<?php if($image['show']==true) { ?>
										<span class="background-image">
											<span class="coupon-overlay"></span>
											<img src="<?php echo $image['src'];?>" alt="<?php echo $title;?>" />
										</span>
									<?php } ?>
								<?php if($link) { ?>
									</a>
								<?php } ?>
							</div>
<?php } ?>
					<!-- END .paragraph-row -->
					</div>
<?php
	}
?>
<?php

/* -------------------------------------------------------------------------*
 * 									 INFO BOX								*
 * -------------------------------------------------------------------------*/
 
	function homepage_info_box($blockType, $blockId,$blockInputType) {
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$icon = get_option(THEME_NAME."_".$blockType."_icon_".$blockId);
		$text = get_option(THEME_NAME."_".$blockType."_text_".$blockId);
		$btnText = get_option(THEME_NAME."_".$blockType."_button_".$blockId);
		$link = get_option(THEME_NAME."_".$blockType."_link_".$blockId);
		$target = get_option(THEME_NAME."_".$blockType."_target_".$blockId);

?>

					<!-- BEGIN .main-block -->
					<div class="main-block quote-block">
						<?php if($link || $btnText) { ?>
							<div class="right">
								<a href="<?php echo $link;?>" target="<?php echo $target;?>" class="custom-button"><?php echo stripslashes($btnText);?></a>
							</div>
						<?php } ?>
						<div class="main">
							<?php if($title) { ?>
								<h2><?php echo $title;?></h2>
							<?php } ?>
							<?php if($text) { ?>
								<p><?php echo do_shortcode(nl2br(stripslashes($text)));?></p>
							<?php } ?>
						</div>
					<!-- END .main-block -->
					</div>

<?php
	}
?>

<?php

/* -------------------------------------------------------------------------*
 * 					HOMEPAGE LATEST ARTICLES & MENU CARD					*
 * -------------------------------------------------------------------------*/
 
	function homepage_latest_news_and_menu($blockType, $blockId,$blockInputType) {
		
		$count = get_option(THEME_NAME."_".$blockType."_count_".$blockId);
		$newsCat = get_option(THEME_NAME."_".$blockType."_news_cat_".$blockId);
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$subtitle = get_option(THEME_NAME."_".$blockType."_subtitle_".$blockId);
		$titleMenu = get_option(THEME_NAME."_".$blockType."_title_menu_".$blockId);
		$subtitleMenu = get_option(THEME_NAME."_".$blockType."_subtitle_menu_".$blockId);
		$categories = get_option(THEME_NAME."_".$blockType."_cat_".$blockId);
		$query = array(
			'post_type' => 'post', 
			'cat' => $newsCat, 
			'posts_per_page' => $count
		);
		$my_query = new WP_Query($query);

		if ( ot_is_woocommerce_activated() == true ) {
			$menuArray = ot_menu_card_query($categories);
			global $OTpostContent;
			$OTpostContents = $menuArray['postContents'];
			$catCount = $menuArray['catCount'];
			$categoryOld = null;
		}
?>
					<div class="paragraph-row">
						<!-- BEGIN .main-block -->
						<div class="column6 main-block">

							<div class="main-title">
								<h2><?php echo $title;?></h2>
								<?php if($subtitle) { ?>
									<span><?php echo $subtitle;?></span>
								<?php } ?>
							</div>
							<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
								<?php get_template_part(THEME_LOOP."post"); ?>
								<?php endwhile; ?>
							<?php endif; ?>
						<!-- END .main-block -->
						</div>

						<!-- BEGIN .main-block -->
						<div class="column6 main-block">
							<div class="main-title">
								<h2><?php echo $titleMenu;?></h2>
								<?php if($subtitleMenu) { ?>
									<span><?php echo $subtitleMenu;?></span>
								<?php } ?>
							</div>
							
							<div class="menu-card">
								<?php if ( ot_is_woocommerce_activated() == true ) { ?>
									<?php for($i=0; $i<$catCount; $i++) { ?>
										<?php if(!empty($OTpostContents[$i])) { ?>
											<?php foreach($OTpostContents[$i] as $OTpostContent) { ?>
												<?php $categoryNew = $OTpostContent['cat_name']; ?>
												<?php if($categoryOld!=$categoryNew) { ?>
													<div class="menu-card-category">
														<a href="#top" class="right"><?php _e("Back to top", THEME_NAME);?></a>
														<h3><?php echo $categoryNew;?></h3>
													</div>
												<?php } ?>
												<?php get_template_part(THEME_LOOP."menu","item"); ?>
												<?php 
													$categoryOld = $categoryNew; 
												?>
											<?php } ?>
										<?php } else { ?>
											<?php if($i==1){ get_template_part(THEME_LOOP."no","post"); } ?>
										<?php } ?>
									<?php } ?>
								<?php } else { _e("Please activate woocommerce plugin!", THEME_NAME); } ?>

							</div>

						<!-- END .main-block -->
						</div>
					</div>
<?php
	}
?>
<?php

/* -------------------------------------------------------------------------*
 * 						HOMEPAGE LATEST EVENTS & MENU CARD					*
 * -------------------------------------------------------------------------*/
 
	function homepage_latest_events_menu($blockType, $blockId,$blockInputType) {
		//menu query
		$titleMenu = get_option(THEME_NAME."_".$blockType."_title_menu_".$blockId);
		$subtitleMenu = get_option(THEME_NAME."_".$blockType."_subtitle_menu_".$blockId);
		$categories = get_option(THEME_NAME."_".$blockType."_cat_".$blockId);
		if ( ot_is_woocommerce_activated() == true ) {
			$menuArray = ot_menu_card_query($categories);
			global $OTpostContent;
			$OTpostContents = $menuArray['postContents'];
			$catCount = $menuArray['catCount'];
			$categoryOld = null;
		}
		//events query
		$count = get_option(THEME_NAME."_".$blockType."_count_".$blockId);
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$subtitle = get_option(THEME_NAME."_".$blockType."_subtitle_".$blockId);
		$postAge = get_option(THEME_NAME."_".$blockType."_post_age_".$blockId);
		$eventsID = get_events_page();
		$eventsID = $eventsID[0];
		
		$now = time();
		$compare = $now-($postAge*24*60*60);

		$query = array(
			'post_type' => 'events-item', 
			'posts_per_page' => $count,
			'order' => 'ASC',
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> THEME_NAME.'_datepicker',
			'meta_query' => array(
			    array(
			        'key' => THEME_NAME.'_datepicker',
			        'value'   => $compare,
			        'compare'   => '>='
			    )
			)
		);
		$my_query = new WP_Query($query);

?>
					<div class="paragraph-row">
						<!-- BEGIN .main-block -->
						<div class="column6 main-block">

							<div class="main-title">
								<h2><?php echo $title;?></h2>
								<?php if($subtitle) { ?>
									<span><?php echo $subtitle;?></span>
								<?php } ?>
							</div>
							<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
								<?php get_template_part(THEME_LOOP."event"); ?>
								<?php endwhile; ?>
							<?php endif; ?>
						<!-- END .main-block -->
						</div>

						<!-- BEGIN .main-block -->
						<div class="column6 main-block">
							<div class="main-title">
								<h2><?php echo $titleMenu;?></h2>
								<?php if($subtitleMenu) { ?>
									<span><?php echo $subtitleMenu;?></span>
								<?php } ?>
							</div>
							
							<div class="menu-card">
								<?php if ( ot_is_woocommerce_activated() == true ) { ?>
									<?php for($i=0; $i<$catCount; $i++) { ?>
										<?php if(!empty($OTpostContents[$i])) { ?>
											<?php foreach($OTpostContents[$i] as $OTpostContent) { ?>
												<?php $categoryNew = $OTpostContent['cat_name']; ?>
												<?php if($categoryOld!=$categoryNew) { ?>
													<div class="menu-card-category">
														<a href="#top" class="right"><?php _e("Back to top", THEME_NAME);?></a>
														<h3><?php echo $categoryNew;?></h3>
													</div>
												<?php } ?>
												<?php get_template_part(THEME_LOOP."menu","item"); ?>
												<?php 
													$categoryOld = $categoryNew; 
												?>
											<?php } ?>
										<?php } else { ?>
											<?php if($i==1){ get_template_part(THEME_LOOP."no","post"); } ?>
										<?php } ?>
									<?php } ?>
								<?php } else { _e("Please activate woocommerce plugin!", THEME_NAME); } ?>

							</div>

						<!-- END .main-block -->
						</div>
					</div>
<?php
	}
?>
<?php

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE MENU CARD & TEXT						*
 * -------------------------------------------------------------------------*/
 
	function homepage_menu_html($blockType, $blockId,$blockInputType) {
		//menu query
		$titleMenu = get_option(THEME_NAME."_".$blockType."_title_menu_".$blockId);
		$subtitleMenu = get_option(THEME_NAME."_".$blockType."_subtitle_menu_".$blockId);
		$categories = get_option(THEME_NAME."_".$blockType."_cat_".$blockId);
		if ( ot_is_woocommerce_activated() == true ) {
			$menuArray = ot_menu_card_query($categories);
			global $OTpostContent;
			$OTpostContents = $menuArray['postContents'];
			$catCount = $menuArray['catCount'];
			$categoryOld = null;
		}
		//events query
		$titleHTML = get_option(THEME_NAME."_".$blockType."_title_html_".$blockId);
		$subtitleHTML = get_option(THEME_NAME."_".$blockType."_subtitle_html_".$blockId);
		$text = get_option(THEME_NAME."_".$blockType."_text_".$blockId);
?>
					<div class="paragraph-row">

						<!-- BEGIN .main-block -->
						<div class="column6 main-block">
							<div class="main-title">
								<h2><?php echo $titleMenu;?></h2>
								<?php if($subtitleMenu) { ?>
									<span><?php echo $subtitleMenu;?></span>
								<?php } ?>
							</div>
							
							<div class="menu-card">
							<?php if ( ot_is_woocommerce_activated() == true ) { ?>
								<?php for($i=0; $i<$catCount; $i++) { ?>
									<?php if(!empty($OTpostContents[$i])) { ?>
										<?php foreach($OTpostContents[$i] as $OTpostContent) { ?>
											<?php $categoryNew = $OTpostContent['cat_name']; ?>
											<?php if($categoryOld!=$categoryNew) { ?>
												<div class="menu-card-category">
													<a href="#top" class="right"><?php _e("Back to top", THEME_NAME);?></a>
													<h3><?php echo $categoryNew;?></h3>
												</div>
											<?php } ?>
											<?php get_template_part(THEME_LOOP."menu","item"); ?>
											<?php 
												$categoryOld = $categoryNew; 
											?>
										<?php } ?>
									<?php } else { ?>
										<?php if($i==1){ get_template_part(THEME_LOOP."no","post"); } ?>
									<?php } ?>
								<?php } ?>
							<?php } else { _e("Please activate woocommerce plugin!", THEME_NAME); } ?>


							</div>

						<!-- END .main-block -->
						</div>

						<!-- BEGIN .main-block -->
						<div class="column6 main-block">
							<div class="main-title">
								<h2><?php echo $titleHTML;?></h2>
								<?php if($subtitleHTML) { ?>
									<span><?php echo $subtitleHTML;?></span>
								<?php } ?>
							</div>
							<div class="shortcode-block">
								<?php echo do_shortcode(stripslashes(wpautop($text)));?>
							</div>

						<!-- END .main-block -->
						</div>

					</div>
<?php
	}
?>
<?php

/* -------------------------------------------------------------------------*
 * 						HOMEPAGE LATEST EVENTS & TEXT						*
 * -------------------------------------------------------------------------*/
 
	function homepage_latest_events_and_html($blockType, $blockId,$blockInputType) {
		$count = get_option(THEME_NAME."_".$blockType."_count_".$blockId);
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$subtitle = get_option(THEME_NAME."_".$blockType."_subtitle_".$blockId);
		$titleHTML = get_option(THEME_NAME."_".$blockType."_title_html_".$blockId);
		$subtitleHTML = get_option(THEME_NAME."_".$blockType."_subtitle_html_".$blockId);
		$text = get_option(THEME_NAME."_".$blockType."_text_".$blockId);

		$eventsID = get_events_page();
		$eventsID = $eventsID[0];
		$postAge = get_option(THEME_NAME."_".$blockType."_post_age_".$blockId);
		$now = time();
		$compare = $now-($postAge*24*60*60);

		$query = array(
			'post_type' => 'events-item', 
			'posts_per_page' => $count,
			'order' => 'ASC',
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> THEME_NAME.'_datepicker',
			'meta_query' => array(
			    array(
			        'key' => THEME_NAME.'_datepicker',
			        'value'   => $compare,
			        'compare'   => '>='
			    )
			)
		);
		$my_query = new WP_Query($query);

?>
		<div class="paragraph-row">
			<!-- BEGIN .main-block -->
			<div class="column6 main-block">
				<div class="main-title">
					<h2><?php echo $title;?></h2>
					<?php if($subtitle) { ?>
						<span><?php echo $subtitle;?></span>
					<?php } ?>
				</div>
				<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
					<?php get_template_part(THEME_LOOP."event"); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			<!-- END .main-block -->
			</div>

			<!-- BEGIN .main-block -->
			<div class="column6 main-block">
				<div class="main-title">
					<h2><?php echo $titleHTML;?></h2>
					<?php if($subtitleHTML) { ?>
						<span><?php echo $subtitleHTML;?></span>
					<?php } ?>
				</div>
				<div class="shortcode-block">
					<?php echo do_shortcode(stripslashes(wpautop($text)));?>
				</div>

			<!-- END .main-block -->
			</div>
		</div>

<?php
	}
?>

<?php

/* -------------------------------------------------------------------------*
 * 						HOMEPAGE LATEST NEWS & EVENTS						*
 * -------------------------------------------------------------------------*/
 
	function homepage_latest_news_events($blockType, $blockId,$blockInputType) {
		$newsCat = get_option(THEME_NAME."_".$blockType."_news_cat_".$blockId);
		$count = get_option(THEME_NAME."_".$blockType."_count_".$blockId);
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$subtitle = get_option(THEME_NAME."_".$blockType."_subtitle_".$blockId);
		$titleEvent = get_option(THEME_NAME."_".$blockType."_title_2_".$blockId);
		$subtitleEvent = get_option(THEME_NAME."_".$blockType."_subtitle_2_".$blockId);
		$countEvent = get_option(THEME_NAME."_".$blockType."_count_2_".$blockId);
		$eventsID = get_events_page();
		$eventsID = $eventsID[0];
		$postAge = get_option(THEME_NAME."_".$blockType."_post_age_".$blockId);
		$now = time();
		$compare = $now-($postAge*24*60*60);

		$query_posts = array(
			'post_type' => 'post', 
			'posts_per_page' => $count,
			'cat' => $newsCat
		);

		

		$query_events = array(
			'post_type' => 'events-item', 
			'posts_per_page' => $countEvent,
			'order' => 'ASC',
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> THEME_NAME.'_datepicker',
			'meta_query' => array(
			    array(
			        'key' => THEME_NAME.'_datepicker',
			        'value'   => $compare,
			        'compare'   => '>='
			    )
			)
		);


		


?>
			<div class="paragraph-row">
				<!-- BEGIN .main-block -->
				<div class="column6 main-block">
					<div class="main-title">
						<h2><?php echo $title;?></h2>
						<?php if($subtitle) { ?>
							<span><?php echo $subtitle;?></span>
						<?php } ?>
					</div>
					<?php $my_query = new WP_Query($query_posts);?>
					<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<?php get_template_part(THEME_LOOP."post"); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				<!-- END .main-block -->
				</div>

				<!-- BEGIN .main-block -->
				<div class="column6 main-block">
					<div class="main-title">
						<h2><?php echo $titleEvent;?></h2>
						<?php if($subtitleEvent) { ?>
							<span><?php echo $subtitleEvent;?></span>
						<?php } ?>
					</div>
					<?php $my_query = new WP_Query($query_events);?>
					<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<?php get_template_part(THEME_LOOP."event"); ?>
						<?php endwhile; ?>
					<?php endif; ?>

				<!-- END .main-block -->
				</div>
			</div>


<?php
	}
?>

<?php

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE LATEST NEWS & TEXT						*
 * -------------------------------------------------------------------------*/
 
	function homepage_latest_news_html($blockType, $blockId,$blockInputType) {
		$newsCat = get_option(THEME_NAME."_".$blockType."_news_cat_".$blockId);
		$count = get_option(THEME_NAME."_".$blockType."_count_".$blockId);
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$subtitle = get_option(THEME_NAME."_".$blockType."_subtitle_".$blockId);
		$titleHTML = get_option(THEME_NAME."_".$blockType."_title_html_".$blockId);
		$subtitleHTML = get_option(THEME_NAME."_".$blockType."_subtitle_html_".$blockId);
		$text = get_option(THEME_NAME."_".$blockType."_text_".$blockId);

		$query_posts = array(
			'post_type' => 'post', 
			'posts_per_page' => $count,
			'cat' => $newsCat
		);

?>
	<div class="paragraph-row">
		<!-- BEGIN .main-block -->
		<div class="column6 main-block">
			<div class="main-title">
				<h2><?php echo $title;?></h2>
				<?php if($subtitle) { ?>
					<span><?php echo $subtitle;?></span>
				<?php } ?>
			</div>
			<?php $my_query = new WP_Query($query_posts);?>
			<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<?php get_template_part(THEME_LOOP."post"); ?>
				<?php endwhile; ?>
			<?php endif; ?>
		<!-- END .main-block -->
		</div>

		<!-- BEGIN .main-block -->
		<div class="column6 main-block">
			<div class="main-title">
				<h2><?php echo $titleHTML;?></h2>
				<?php if($subtitleHTML) { ?>
					<span><?php echo $subtitleHTML;?></span>
				<?php } ?>
			</div>
			<div class="shortcode-block">
				<?php echo do_shortcode(stripslashes(wpautop($text)));?>
			</div>

		<!-- END .main-block -->
		</div>
	</div>


<?php
	}
?>



<?php

/* -------------------------------------------------------------------------*
 * 									HTML CODE								*
 * -------------------------------------------------------------------------*/

	function homepage_html($blockType, $blockId,$blockInputType) {
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$subTitle = get_option(THEME_NAME."_".$blockType."_subtitle_".$blockId);
		$text = stripslashes(get_option(THEME_NAME."_".$blockType."_".$blockId));
	?>
		<!-- BEGIN .main-block -->
		<div class="main-block">
			<?php if($title||$subTitle) { ?>
				<div class="main-title">
					<h2><?php echo $title;?></h2>
					<?php if($subTitle) { ?>
						<span><?php echo $subTitle;?></span>
					<?php } ?>
				</div>
			<?php } ?>
			<div class="shortcode-block">
				<?php echo do_shortcode(wpautop($text));?>
			</div>

		<!-- END .main-block -->
		</div>
	<?php
	}
?>

