<?php get_header(); 

	//Extracting the values that user defined in OptionTree Plugin 
	$sectionImage1 = ot_get_option('section_image1');
	$sectionHeader1 = ot_get_option('section_header1');
	$sectionText1 =	ot_get_option('section_text1');
	$sectionImage2 = ot_get_option('section_image2');
	$sectionHeader2 = ot_get_option('section_header2');
	$sectionText2 =	ot_get_option('section_text2');
	$sectionImage3 = ot_get_option('section_image3');
	$sectionHeader3 = ot_get_option('section_header3');
	$sectionText3 =	ot_get_option('section_text3');
	$siteSection = ot_get_option('site_section','on');
	$fromBlog = ot_get_option('from_blog','on');
	$info = ot_get_option('info','on');
	$buyIt = ot_get_option('buy_it','on');
	$fromBlogCount = ot_get_option('from_blog_count');
	$buyItText = ot_get_option('buy_it_text');
	$buyItSubtext = ot_get_option('buy_it_subtext');
	$buyItButton = ot_get_option('buy_it_button_text');
	$buyItUrl = ot_get_option('buy_it_url');
	
	$clinicName = ot_get_option('clinic_name');
	$clinicAddress = ot_get_option('clinic_address');
	
	$clinicName = explode(";", $clinicName);
	$clinicAddress = explode(";", $clinicAddress);
	
?>
	<style type="text/css">
	.fone h2 {
		background:url(<?php echo get_template_directory_uri().'/'.$sectionImage1 ?>) no-repeat;
	}

	.ftwo h2 {
		background:url(<?php echo get_template_directory_uri().'/'.$sectionImage2 ?>) no-repeat;
	}

	.fthree h2 {
		background:url(<?php echo get_template_directory_uri().'/'.$sectionImage3 ?>) no-repeat;
	}
	</style>
	<!-- BEGIN MAIN SLIDER -->
	<div class="slider-wrapper theme-default">
		<div id="slider" class="nivoSlider">
			<?php 
				$number=1;
				query_posts( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'order' => 'ASC' ) ); 
				if ( have_posts() ): while ( have_posts() ) : the_post();
				if ( has_post_thumbnail() ) {
					if ( (get_post_meta($post->ID,"slide_link",true) != "") && (get_post_meta($post->ID,"title",true) == "No") ) {
						echo "<a href='".get_post_meta($post->ID,"slide_link",true)."'>";
					}
					if ( get_post_meta($post->ID,"title",true) == "No" ) {
						the_post_thumbnail( 'full', array('title' => '') );	
					} else {
						the_post_thumbnail( 'full', array('title'=>'#htmlcaption'.$number) );						
					}
					if ( get_post_meta($post->ID,"slide_link",true) != "" && (get_post_meta($post->ID,"title",true) == "No") ) {
						echo "</a>";
					}
				}
				$number++;
				endwhile;endif;	
			?>
		</div>
		<?php 
			$number=1;
			query_posts( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'order' => 'ASC' ) ); 
			if ( have_posts() ): while ( have_posts() ) : the_post();
		?>	
		<div id="htmlcaption<?php echo $number; ?>" class="nivo-html-caption">
			<div id="caption-text-wrap">
				<div class="header"><?php the_title(); ?></div>
				<?php if (get_the_content() != '') { ?><div class="text"><?php the_content(); ?></div><?php } ?>
			</div>
		</div>							
		<?php
			$number++;
			endwhile;endif;
		?>
	</div>
	<!-- END MAIN SLIDER -->
	<!-- BEGIN MAIN CONTENT -->
	<div class="container">
		<?php if ($siteSection[0] != "off") { ?>
		<div class="four columns features fone">
			<h2><?php echo $sectionHeader1; ?></h2>
			<?php echo $sectionText1; ?>
		</div>
		<div class="four columns features ftwo">
			<h2><?php echo $sectionHeader2; ?></h2>
			<?php echo $sectionText2; ?>
		</div>
		<div class="four columns features fthree clearfix">
			<h2><?php echo $sectionHeader3; ?></h2>
			<?php echo $sectionText3; ?>
		</div>
		<br class="clear" />
		<?php } if ($fromBlog[0] != "off") { ?>
		<div class="divider"></div>
		<div id="from-blog-wrap">
			<div class="sixteen columns" id="from-blog">
				<div id="from-blog-header"><div>Latest from blog</div> <div id="go-prev"></div> <div id="go-next"></div></div>
				<ul id="blog-slider">
					<?php 
						query_posts( array( 'post_type' => 'post', 'showposts' => $fromBlogCount ) );
						if ( have_posts() ): while ( have_posts() ) : the_post();
							if ( has_post_thumbnail() ) {
					?>
					<li>	
						<a href="<?php the_permalink();?>">
							<?php 
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'main-from-blog' );
							?>
							<img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
							<div class="main-blog-magnifier"></div>
						</a>
						<div class="blog-slider-text-wrap">
							<div class="slider-post-title"><?php the_title() ?></div>
							<div class="slider-post-text">by <?php the_author() ?></div>
						</div>
					</li>
					<?php
							}
							endwhile;endif;
					?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="divider-after"></div>
		<?php } if ($info[0] != "off") { ?>
		<div id="information-wrap">
			<div class="ten columns">
				<div class="information-header">
					<div><?php $obj=get_category_by_slug( 'news' );echo $obj->name; ?></div>
				</div>
				<?php 
					query_posts( array( 'category_name' => 'news', 'post_type' => 'post', 'showposts' => 10 ) );
					if ( have_posts() ): while ( have_posts() ) : the_post();
				?>
				<div class="news-text-wrap">
					<div class="news-wrap">
					<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'main-from-blog' );  ?>
						<a href="<?php echo the_permalink(); ?>">
							<img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
						</a>
						<div class="news-content-wrap">
							<a href="<?php the_permalink(); ?>"><div class="news-title"><?php the_title() ?></div></a>
							<ul class="news-after-title">
								<li id="news-author"><?php the_author() ?></li>
								<li id="news-date"><?php echo get_the_date('d M, Y') ?></li>
							</ul>
							<div class="news-text"><?php heal_excerpt(25); ?></div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<?php 
					endwhile;endif;
				?>
			</div>
			<div class="six columns findus-wrap">
				<div class="information-header">
					<div>Where to find us</div>
				</div>
				<div class="location-wrap">	
					<ul id="find-list">
						<?php for($i=0;$i<count($clinicName);$i++) { ?>
						<li>
							<p id="clinic-name"><?php echo $clinicName[$i]; ?></p>
							<p id="clinic-address"><?php echo $clinicAddress[$i]; ?></p>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div id="gmaps"></div>
			</div>
			<br class="clear" />
		</div>
		<div class="divider"></div>
		<?php } if ($buyIt[0] != "off") { ?>
		<div class="sixteen columns" id="buy-it">
			<div id="buy-it-text"><?php echo $buyItText; ?></div>
			<div id="buy-it-subtext"><?php echo $buyItSubtext; ?></div>
			<a href="<?php echo $buyItUrl; ?>">
				<div id="buy-it-button">
					<div id="buy-it-button-text"><?php echo $buyItButton; ?></div>
					<div id="buy-it-button-icon"></div>
				</div>
			</a>
			<div class="clear"></div>
		</div>
		<?php } ?>
	</div>
	<!-- END MAIN CONTENT -->
	<?php get_footer(); ?>
