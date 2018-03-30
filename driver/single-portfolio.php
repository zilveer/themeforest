<?php
get_header();
?>

<?php
$archive_page = get_iron_option('page_for_portfolios');
$archive_page = ( empty($archive_page) ? false : post_permalink($archive_page) );

$template = get_field('single-portfolio-template');

/**
 * Setup Dynamic Sidebar
 */
list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( $post->ID );
?>

		<!-- container -->
		<div class="container">
		<div class="boxed">

		<?php
		$single_title = get_iron_option('single_portfolio_page_title');
		if(!empty($single_title)): 
		?>
		
		<?php
			if(is_page_title_uppercase() == true){
				echo '<div class="page-title uppercase">';
			} else {
				echo '<div class="page-title">';
			};
		?>
			<span class="heading-t"></span>
				<h1><?php echo esc_html($single_title); ?></h1>
			<?php
				iron_page_title_divider();
			?>
		</div>
		
		<?php else: ?>
			
			<div class="heading-space"></div>
			
		<?php endif; ?>

<?php
		if ( $has_sidebar ) :
?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
<?php
		endif;

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
?>
					<!-- single-post portfolio-post -->
					<div id="post-<?php the_ID(); ?>" <?php post_class('single-post portfolio-post'); ?>>
					
						<?php 
						$pagetemplate = get_field('single-portfolio-template', $post->ID);
						if($pagetemplate == 'default'){
						?>
					
						<!-- PHOTOS TOP OPTION -->
						<?php
						$displayorder = get_field('show_contents_below_images', $post->ID);
							if($displayorder){
								$featuredurl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
								$photodisplay = get_field('images-display', $post->ID);
								if($photodisplay == 'slider'){
									?>
									<div id="owlcarousel" class="owl-carousel">
									<?php
									$photos = get_field('project-images', $post->ID);
									//echo '<img class="item" src="'.$featuredurl.'" />';
									foreach($photos as $photo){
										$photourl = $photo['image_file']['url'];
										$photoalt = $photo['image_description'];
										echo '<img class="item" src="'.$photourl.'" alt="'.$photoalt.'" />';
									}
									?>
									</div>
									<?php
								}else{
									//the_post_thumbnail('full');
									$photos = get_field('project-images', $post->ID);
									//echo '<img class="item" src="'.$featuredurl.'" />';
									foreach($photos as $photo){
										$photourl = $photo['image_file']['url'];
										$photoalt = $photo['image_description'];
										echo '<img class="portfolio-pic" src="'.$photourl.'" alt="'.$photoalt.'" />';
									}
								}
							}
						?>
						
						<!-- CONTENT -->
						<div class="entry">
							<div class="portfolio-leftside">
								<h2><?php the_title(); ?></h2>
								<?php the_content(); ?>
							</div>
							<div class="portfolio-rightside">
								<!-- CLIENTS -->
								<?php
									$clients = get_field('project-clients', $post->ID);
									if(!empty($clients)){
										if(count($clients) > 1){
										?>
											<div class="portfolio-sidetitle"><?php _e("Clients")?></div>
										<?php
										}else{
										?>
											<div class="portfolio-sidetitle"><?php _e("Client")?></div>
										<?php
										}
										?>
										<div class="portfolio-sidesplit"></div>
										<?php
										echo '<div class="portfolio-sidelist">';
										foreach($clients as $client){
											$clientname = $client['client_name'];
											echo $clientname."<br>";
										}
										echo '</div>';
									}
								?>
								<!-- CATEGORIES -->
								<?php 
								$terms = wp_get_post_terms($post->ID,'portfolio-category',array("fields" => "names"));
								if(!empty($terms)){
								?>
								<div class="portfolio-sidetitle"><?php _e("Categories")?></div>
								<div class="portfolio-sidesplit"></div>
								<?php
									$first = 1;
									foreach($terms as $term){
										if($first == 1){
											echo '<a href="../../portfolio-category/'.$term.'">'.$term.'</a>';
											$first = 0;
										}else{
											echo ', '.'<a href="../../portfolio-category/'.$term.'">'.$term.'</a>';
										}
									}
								}
								?>
								
								<!-- EXTERNAL LINK -->
								<?php
									$externallabel = get_field('external_link_label', $post->ID);
									$externallink = get_field('external_link', $post->ID);
									$externaltarget = get_field('external_link_target', $post->ID);
									if(!empty($externallabel) && !empty($externallink)){
										echo '<a class="portfolio-button" href="'.$externallink.'" target="'.$externaltarget.'">'.$externallabel.'</a>';
									}
								?>  
							</div>
							<div class="clear"></div>
						</div>
						
						<!-- PHOTOS BOTTOM OPTION -->
						<?php
						$displayorder = get_field('show_contents_below_images', $post->ID);
							if(!$displayorder){
								$featuredurl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
								$photodisplay = get_field('images-display', $post->ID);
								if($photodisplay == 'slider'){
									?>
									<div id="owlcarousel" class="owl-carousel">
									<?php
									$photos = get_field('project-images', $post->ID);
									//echo '<img class="item" src="'.$featuredurl.'" />';
									foreach($photos as $photo){
										$photourl = $photo['image_file']['url'];
										$photoalt = $photo['image_description'];
										echo '<img class="item" src="'.$photourl.'" alt="'.$photoalt.'" />';
									}
									?>
									</div>
									<?php
								}else{
									//the_post_thumbnail('full');
									$photos = get_field('project-images', $post->ID);
									//echo '<img class="item" src="'.$featuredurl.'" />';
									foreach($photos as $photo){
										$photourl = $photo['image_file']['url'];
										$photoalt = $photo['image_description'];
										echo '<img class="item" src="'.$photourl.'" alt="'.$photoalt.'" />';
									}
								}
							}
						?>
						
						<!-- NAVIGATION -->
						<div class="portfolio-nav-wrap">
							<div class="portfolio-prev-wrap">
							<?php
							$prev_post = get_previous_post();
							if (!empty( $prev_post )): ?>
								<a href="<?php echo get_permalink($prev_post->ID); ?>" class="portfolio-prev">
									<i class="fa fa-long-arrow-left"></i>
									<div class="prev-text"><?php echo __("Previous project", IRON_TEXT_DOMAIN); ?></div>
									<div class="clear"></div>
								</a>
							<?php endif; ?>			
							</div>
							<div class="portfolio-mid-wrap">
								<?php 
								$link_back = get_iron_option('portfolio_archive_page');
								if(empty($link_back)){
									$link_back = get_post_type_archive_link(get_post_type());
								}else{
									$link_back = get_permalink($link_back);
								}
								?>
								<a href="<?php echo esc_url($link_back);?>"><i class="fa fa-th"></i></a>
							</div>
							<div class="portfolio-next-wrap">
							<?php
							$next_post = get_next_post();
							if (!empty( $next_post )): ?>
								<a href="<?php echo get_permalink($next_post->ID); ?>" class="portfolio-next">
									<i class="fa fa-long-arrow-right"></i>
									<div class="next-text"><?php echo __("Next project", IRON_TEXT_DOMAIN); ?></div>
									<div class="clear"></div>
								</a>
							<?php endif; ?>
							</div>
							<div class="clear"></div>
						</div>
						<?php 
						}else{
						?>
						<div class="entry">
							<?php the_content(); ?>
						</div>
						<?php
						}
						?>
					</div>
<?php
	endwhile;
endif;

if ( $has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-portfolio.php');

	dynamic_sidebar( $sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-portfolio.php');
?>
				</aside>
			</div>
<?php
endif;
?>
			</div>
		</div>
	
<?php get_footer(); ?>