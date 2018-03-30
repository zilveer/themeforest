<?php
get_header(); 
?>

		<?php
		 $option1 = get_option("cc_slide1_images");
		 $file1 = $option1['file']; 
		 $option2 = get_option("cc_slide2_images");
		 $file2 = $option2['file']; 
		 $option3 = get_option("cc_slide3_images");
		 $file3 = $option3['file']; 
		 $option4 = get_option("cc_slide4_images");
		 $file4 = $option4['file']; 
		 
		 $optionslide1 = get_option("cc_slideshow1");
		 $fileslide1 = $optionslide1['file']; 
		 $optionslide2 = get_option("cc_slideshow2");
		 $fileslide2 = $optionslide2['file'];
		 $optionslide3 = get_option("cc_slideshow3");
		 $fileslide3 = $optionslide3['file'];
		 $optionslide4 = get_option("cc_slideshow4");
		 $fileslide4 = $optionslide4['file'];
		 
		 $optionicon1 = get_option("cc_box1_icon");
		 $filicon1 = $optionicon1['file']; 
		 $optionicon2 = get_option("cc_box2_icon");
		 $filicon2 = $optionicon2['file'];
		 $optionicon3 = get_option("cc_box3_icon");
		 $filicon3 = $optionicon3['file'];
		 
		$cc_slide1_title   		= convert_smart_quotes(get_option('cc_slide1_title'));
		$cc_slide1_content  	= convert_smart_quotes(get_option('cc_slide1_content'));
		$cc_slide2_title   		= convert_smart_quotes(get_option('cc_slide2_title'));
		$cc_slide2_content  	= convert_smart_quotes(get_option('cc_slide2_content'));
		$cc_slide3_title   		= convert_smart_quotes(get_option('cc_slide3_title'));
		$cc_slide3_contenttext  = convert_smart_quotes(get_option('cc_slide3_contenttext'));
		$cc_slide4_title   		= convert_smart_quotes(get_option('cc_slide4_title'));
		$cc_slide4_contenttext  = convert_smart_quotes(get_option('cc_slide4_contenttext'));
		if ( get_option('cc_slideshow_style') == 'Slideshow 1') : ?>
			<div id="placeslideshow">
				<ul id="menutabs" class="ui-tabs-nav">
					<li><a href="#panel1"><?php echo $cc_slide1_title ?></a></li>
					<li><a href="#panel2"><?php echo $cc_slide2_title ?></a></li>
					<li><a href="#panel3"><?php echo $cc_slide3_title ?></a></li>
					<li><a href="#panel4"><?php echo $cc_slide4_title ?></a></li>
				</ul>
				<div class="ui-tabs-panel" id="panel1">
					<div class="contenttabs <?php if ( $file1['url'] == '') : echo"full"; endif; ?>">
						<h1><?php echo $cc_slide1_title ?></h1>
						<?php echo $cc_slide1_content ?>
						<?php
						if ( get_option('cc_slide1_url') <> '') : ?>
							<a href="<?php echo get_option('cc_slide1_url') ?>" class="butmore">Read more</a>
						<?php endif; ?>
					</div>
					<?php
					if ( $file1['url'] <> '') : ?>
					<div class="framesslideshow">
						<img src="<?php echo $file1['url']; ?>" alt="<?php echo get_option('cc_slide1_title') ?>" />
					</div>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
				<div class="ui-tabs-panel" id="panel2">
					<div class="contenttabs <?php if ( $file2['url'] == '') : echo"full"; endif; ?>">
						<h1><?php echo $cc_slide2_title ?></h1>
						<?php echo $cc_slide2_content ?>
						<?php
						if ( $file2['url'] <> '') : ?>
							<a href="<?php echo get_option('cc_slide2_url') ?>" class="butmore">Read more</a>
						<?php endif; ?>
					</div>
					<?php
					if ( $file2['url'] <> '') : ?>
					<div class="framesslideshow">
						<img src="<?php echo $file2['url']; ?>" alt="<?php echo get_option('cc_slide2_title') ?>" />
					</div>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
				<div class="ui-tabs-panel" id="panel3">
					<?php
					if ( get_option('cc_slide3_content') == 'Testimonial') : ?>
						<h1><?php echo $cc_slide3_title ?></h1>
						<?php
						$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => '2'));
						$i=1;
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php
							$custom = get_post_custom($post->ID);
							$website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] : false;
							$company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;
							?>
							<div class="boxtestimonialslide <?php if ($i%2==0) echo "last"; ?>">
								<?php the_post_thumbnail('testimonial-thumb3'); ?>
								<div class="contenttesti">
								<?php the_excerpt() ?>
								<p class="testiname"><strong><?php the_title() ?></strong>, <a href="<?php echo $website_url_testimonial ?>"><?php echo $company_name ?></a></p>
							</div>
							<?php
							$i++;
							?>
						</div>
						<?php endwhile;?>
					<?php endif; ?>
					<?php
					if ( get_option('cc_slide3_content') == 'News') : ?>
						<h1><?php echo $cc_slide3_title ?></h1>
						<?php
						$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => '2'));
						$i=1;
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class="boxtestimonialslide <?php if ($i%2==0) echo "last"; ?>">
								<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
								<?php the_post_thumbnail('testimonial-thumb3'); ?>
								<div class="contentnewsslide">
								<?php the_excerpt() ?>
								
							</div>
							<?php
							$i++;
							?>
						</div>
						<?php endwhile;?>
					<?php endif; ?>
					<?php
					if ( get_option('cc_slide3_content') == 'Portfolio') : ?>
						<h1><?php echo $cc_slide3_title ?></h1>
						<?php
						$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => '4'));
						$i=1;
						?>
						<ul id="listportfolioslide">
						<?php
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<li><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('portfolio-thumb3'); ?></a></li>
						<?php endwhile;?>
						</ul>
					<?php endif; ?>
					<?php
					if ( get_option('cc_slide3_content') == 'Custom Text') : ?>
						<div class="contenttabs <?php if ($file3['url'] == '') : echo"full"; endif; ?>">
							<h1><?php echo $cc_slide3_title ?></h1>
							<?php echo $cc_slide3_contenttext ?>
							<?php
							if ( get_option('cc_slide3_url') <> '') : ?>
								<a href="<?php echo get_option('cc_slide3_url') ?>" class="butmore">Read more</a>
							<?php endif; ?>
						</div>
						<?php
						if ( $file3['url'] <> '') : ?>
						<div class="framesslideshow">
							<img src="<?php echo $file3['url'] ?>" alt="<?php echo get_option('cc_slide3_title') ?>" />
						</div>
						<?php endif; ?>
						<div class="clear"></div>
					<?php endif; ?>
				</div>
				<div class="ui-tabs-panel" id="panel4">
					<?php
					if ( get_option('cc_slide4_content') == 'Testimonial') : ?>
						<h1><?php echo $cc_slide4_title ?></h1>
						<?php
						$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => '2'));
						$i=1;
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php
							$custom = get_post_custom($post->ID);
							$website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] : false;
							$company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;
							?>
							<div class="boxtestimonialslide <?php if ($i%2==0) echo "last"; ?>">
								<?php the_post_thumbnail('testimonial-thumb3'); ?>
								<div class="contenttesti">
								<?php the_excerpt() ?>
								<p class="testiname"><strong><?php the_title() ?></strong>, <a href="<?php echo $website_url_testimonial ?>"><?php echo $company_name ?></a></p>
							</div>
							<?php
							$i++;
							?>
						</div>
						<?php endwhile;?>
					<?php endif; ?>
					<?php
					if ( get_option('cc_slide4_content') == 'News') : ?>
						<h1><?php echo $cc_slide4_title ?></h1>
						<?php
						$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => '2'));
						$i=1;
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class="boxtestimonialslide <?php if ($i%2==0) echo "last"; ?>">
								<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
								<?php the_post_thumbnail('testimonial-thumb3'); ?>
								<div class="contentnewsslide">
								<?php the_excerpt() ?>
								
							</div>
							<?php
							$i++;
							?>
						</div>
						<?php endwhile;?>
					<?php endif; ?>
					<?php
					if ( get_option('cc_slide4_content') == 'Portfolio') : ?>
						<h1><?php echo $cc_slide4_title ?></h1>
						<?php
						$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => '4'));
						$i=1;
						?>
						<ul id="listportfolioslide">
						<?php
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<li><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('portfolio-thumb3'); ?></a></li>
						<?php endwhile;?>
						</ul>
					<?php endif; ?>
					<?php
					if ( get_option('cc_slide4_content') == 'Custom Text') : ?>
						<div class="contenttabs <?php if ( $file4['url'] == '') : echo"full"; endif; ?>">
							<h1><?php echo $cc_slide4_title ?></h1>
							<?php echo $cc_slide4_contenttext ?>
							<?php
							if ( get_option('cc_slide4_url') <> '') : ?>
								<a href="<?php echo get_option('cc_slide4_url') ?>" class="butmore">Read more</a>
							<?php endif; ?>
						</div>
						<?php
						if ( $file4['url'] <> '') : ?>
						<div class="framesslideshow">
							<img src="<?php echo $file4['url'] ?>" alt="<?php echo get_option('cc_slide4_title') ?>" />
						</div>
						<?php endif; ?>
						<div class="clear"></div>
					<?php endif; ?>
				</div>
				
			</div>
		<?php endif; ?>
		<?php
		if ( get_option('cc_slideshow_style') == 'Slideshow 2') : ?>
			<div id="placeslideshow2">
				<?php if (( get_option('cc_rounded') == 'false') || ( get_option('cc_rounded') == '')) : ?>
					<div id="cornerslide"></div>
				<?php endif; ?>
				<div id="slideshow2">
					<?php
					$cc_slideshow1_title   	= convert_smart_quotes(get_option('cc_slideshow1_title'));
					$cc_slideshow2_title   	= convert_smart_quotes(get_option('cc_slideshow2_title'));
					$cc_slideshow3_title   	= convert_smart_quotes(get_option('cc_slideshow3_title'));
					$cc_slideshow4_title   	= convert_smart_quotes(get_option('cc_slideshow4_title'));
					if ( $fileslide1['url'] <> '') : ?>
						<img src="<?php echo $fileslide1['url']; ?>" alt="<?php echo $cc_slideshow1_title ?>" />
						<?php if (get_option('cc_slideshow1_url')<>'') : ?>
							<a href="<?php echo get_option('cc_slideshow1_url') ?>" alt="<?php echo $cc_slideshow1_title ?>"></a>
						<?php endif; ?>
					<?php endif; ?>
					<?php
					if ( $fileslide2['url'] <> '') : ?>
						<img src="<?php echo $fileslide2['url'] ?>" alt="<?php echo $cc_slideshow2_title ?>" />
						<?php if (get_option('cc_slideshow2_url')<>'') : ?>
							<a href="<?php echo get_option('cc_slideshow2_url') ?>" alt="<?php echo $cc_slideshow2_title ?>"></a>
						<?php endif; ?>
					<?php endif; ?>
					<?php
					if ( get_option('cc_slideshow3') <> '') : ?>
						<img src="<?php echo $fileslide3['url'] ?>" alt="<?php echo $cc_slideshow3_title ?>" />
						<?php if (get_option('cc_slideshow3_url')<>'') : ?>
							<a href="<?php echo get_option('cc_slideshow3_url') ?>" alt="<?php echo $cc_slideshow3_title ?>"></a>
						<?php endif; ?>
					<?php endif; ?>
					<?php
					if ( get_option('cc_slideshow4') <> '') : ?>
						<img src="<?php echo $fileslide4['url'] ?>" alt="<?php echo $cc_slideshow4_title ?>" />
						<?php if (get_option('cc_slideshow4_url')<>'') : ?>
							<a href="<?php echo get_option('cc_slideshow4_url') ?>" alt="<?php echo $cc_slideshow4_title ?>"></a>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<div id="contentfront">
			<div class="contentfront">
			<?php echo get_option('cc_slideshow1_url') ?>
				<?php
				$cc_box1_title   	= convert_smart_quotes(get_option('cc_box1_title'));
				$cc_box1_content   	= convert_smart_quotes(get_option('cc_box1_content'));
				$cc_box2_title   	= convert_smart_quotes(get_option('cc_box2_title'));
				$cc_box2_content   	= convert_smart_quotes(get_option('cc_box2_content'));
				$cc_box3_title   	= convert_smart_quotes(get_option('cc_box3_title'));
				$cc_box3_content   	= convert_smart_quotes(get_option('cc_box3_content'));
				?>
				<h2>
				<?php if ( $filicon1['url'] <> '') : ?>
					<img src="<?php echo $filicon1['url']; ?>" alt="<?php echo $cc_box1_title ?>" />
				<?php endif; ?>
				<?php echo $cc_box1_title ?></h2>
				<?php echo $cc_box1_content ?>
				<?php
				if ( get_option('cc_box1_url') <> '') : ?>
					<a href="<?php echo get_option('cc_box1_url') ?>" class="butmore">Read More</a>
				<?php endif; ?>
			</div>
			<div class="contentfront">
				<h2>
				<?php if ( $filicon2['url'] <> '') : ?>
					<img src="<?php echo $filicon2['url']; ?>" alt="<?php echo $cc_box2_title ?>" />
				<?php endif; ?>
				<?php echo $cc_box2_title ?></h2>
				<?php echo $cc_box2_content ?>
				<?php
				if ( get_option('cc_box2_url') <> '') : ?>
					<a href="<?php echo get_option('cc_box2_url') ?>" class="butmore">Read More</a>
				<?php endif; ?>
			</div>
			<div class="contentfront">
				<h2>
				<?php if ( $filicon3['url'] <> '') : ?>
					<img src="<?php echo $filicon3['url']; ?>" alt="<?php echo $cc_box3_title ?>" />
				<?php endif; ?>
				<?php echo $cc_box3_title ?></h2>
				<?php echo $cc_box3_content ?>
				<?php
				if ( get_option('cc_box3_url') <> '') : ?>
					<a href="<?php echo get_option('cc_box3_url') ?>" class="butmore">Read More</a>
				<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div id="contentfrontbottom"></div>
	</div>
<?php get_footer(); ?>