<?php
/**
 * Template used for displaying single post information
 */

get_header();

the_post();
$features = rwmb_meta( 'portfolio_features' );
$images = rwmb_meta( 'portfolio_images', array('type' => 'image', 'size' => 'large' ) );
$videos = rwmb_meta( 'portfolio_videos' );
$hide_featured_image = rwmb_meta( 'portfolio_hide_featured_image' );
$disable_image_crop = rwmb_meta( 'portfolio_disable_image_crop' );
$website_url = rwmb_meta( 'portfolio_website' );
if ($website_url) $website_url_short = preg_replace('#^https?://#', '', $website_url);
$return_page = (isset($smof_data['portfolio_page'])) ? $smof_data['portfolio_page'] : '';
if ($return_page) {
	$return_page = get_permalink( get_page_by_path($return_page) );
}
if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
	$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
	if ($disable_image_crop)
		$thumb_image_url = $full_image_url;
	else
		$thumb_image_url = aq_resize( $full_image_url, 940, 480, true );
else :
	$thumb_image_url = get_template_directory_uri() . '/img/940x480.gif';
endif; ?>


</section>
	<div class="flat_pagetop">
		<section id="content" class="container">

		<div class="grid12 col">
<?php if (!empty($return_page)) : ?>
			<h1 class="page-title left"><?php the_title(); ?></h1>
			<div class="subtitle">
				<p class="navigation">
<?php
$prev_post = get_adjacent_post( false, '', true );
$next_post = get_adjacent_post( false, '', false );
if ($prev_post) : ?>
					<a href="<?php echo get_permalink($prev_post->ID); ?>" class="prev"><span></span>Previous</a>
<?php endif;
if ($next_post) : ?>
					<a href="<?php echo get_permalink($next_post->ID); ?>" class="next">Next<span></span></a>
<?php endif; ?>
					<a href="<?php echo $return_page; ?>" class="all"><?php _e( 'View All Items', 'flatbox' ); ?><span></span></a>
				</p>
			</div>
			<div class="clear"></div>
<?php else : ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
<?php endif; ?>
		</div>


</section>
	</div>
		<section id="content" class="container">
			<p></p>

		
		<div class="grid4 col">
			<h6 class="normal_title"><?php _e( 'Overview', 'flatbox' ); ?></h6>
			<p></p>
			<div class="small_text2"><?php the_content(); ?></div>
			<!-- <h6 class="bold_title"><?php _e( 'Date', 'flatbox' ); ?></h6> -->
			<!-- <p class="smaller"><span class="icon-date-gray"></span><?php echo the_time(get_option('date_format')); ?></p> -->
			
			<div class="clearfix"></div>
			<p></p>
<?php if ( $features && count($features)>0 ) : 
$enterf = 1;
if (count($features)==1){
	foreach ($features as $feature) : 
	if ($feature == "") {
		$enterf = 2;
	}
	endforeach;
}
if($enterf != 2){
?>
			<h6 class="normal_title">Features</h6>
			<p></p>
			<ul class="small_text2 square">
<?php 

foreach ($features as $feature) : ?>
				<li><?php echo $feature; ?></li>
<?php endforeach;  ?>
			</ul>
<?php } endif; ?>
<?php if ( $website_url ) : ?>

<!-- 		<h6 class="normal_title">Website</h6>			
			<div class="metablog">
					<p class="btitledate"><span class="firasdate"><span class="icon-link-gray"></span><a href="<?php echo $website_url; ?>" target="_blank"><?php echo $website_url_short; ?></a></span></p>

			</div> -->
			<div class="metablog">
					<p class="btitledate"><span class="firasdate"><span class="icon-date"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p>
				<?php if( function_exists('zilla_likes') ) {?>
				<span class="firasdate zlike">
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
				</span>
				<?php }?>

			</div>
			<div class="clearfix"></div>
			<p></p>
			<a class="button full-width" href="<?php echo $website_url; ?>">View Project</a>
			

			
			
			<div class="clearfix"></div>
			<!-- <p class="smaller"><span class="icon-link-gray"></span><a href="<?php echo $website_url; ?>" target="_blank"><?php echo $website_url_short; ?></a></p> -->
<?php endif; ?>
			<?php echo do_shortcode($smof_data['portfolio_item_extra']); ?>

		</div>




		<div class="grid8 col">
<?php
if (!$hide_featured_image) :
if (!empty($full_image_url)) : ?>
			<div class="thumb<?php echo $smof_data['css3_animation_class']; ?>">
				<a href="<?php echo $full_image_url; ?>" class="lightbox" data-fancybox-group="<?php echo $post->post_name; ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php echo $full_image_url; ?>" class="button-fullsize"></a>
				</div>
			</div>
<?php else :
		if ( !($images && count($images)>0) ) : ?>
			<div class="thumb">
				<a><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
			</div>
<?php 	endif;
endif; // !empty full_image-url
endif; // hide featured image ?>
<?php if ( $images && count($images)>0 ) :
		foreach ( $images as $image ) :
			if ($disable_image_crop)
				$thumb_url = $image['full_url'];
			else
				$thumb_url = aq_resize( $image['full_url'], 940, 480, true ); ?>
			<div class="thumb<?php echo $smof_data['css3_animation_class']; ?>">
				<a href="<?php echo $image['full_url']; ?>" class="lightbox" data-fancybox-group="<?php echo $post->post_name; ?>"><img src="<?php echo $thumb_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php echo $image['full_url']; ?>" class="button-fullsize"></a>
				</div>
			</div>
<?php 	endforeach; ?>
<?php endif; ?>
<?php if ( $videos && count($videos)>0 ) :
		foreach ( $videos as $video ) :
		  if (empty($video)) break; ?>
			<div class="video-container">
				<div class="video-wrapper">
					<?php echo $video; ?>
				</div>
			</div>
<?php 	endforeach; ?>
<?php endif; ?>
		</div>



















	<?php 
				$args = array(
					'post_type'   => array('portfolio','portfolio-items'),
					'post_status' => 'publish',
					'orderby' => 'menu_order date',
					 'meta_query' => array(
					 	array( // check if meta is emty (meaning it is featured by default)
							'key'     => 'portfolio_featured',
							'value'   => array(''),
							'compare' => 'NOT IN'
						),
					 	array( // check if meta is set to true
							'key'     => 'portfolio_featured',
							'value'   => 1,
							'compare' => '==',
							'type'    => 'NUMERIC'
						)
					),
				);
				$r = new WP_Query($args);
				if ($r->have_posts()) : ?>
<!--
<?php
	$j=0;
	while ($r->have_posts()) :
		$r->the_post();
		if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 480, 320, true );
		else :
			$full_image_url = get_template_directory_uri().'/img/940x480.gif';
			$thumb_image_url = get_template_directory_uri().'/img/480x320.gif';
		endif; ?>
			<div class="grid3 col<?php if ( $j%3==0 ) echo ' alpha'; else if ( $j%3==2 ) echo ' omega'; ?>">
				<div class="thumb<?php echo $smof_data['css3_animation_class']; ?>">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
					<div class="info pattern">
						<div class="text">
							<strong><?php the_title(); ?></strong>
							<em class="date"><span></span><?php echo get_the_date(); ?></em>
							<a href="<?php the_permalink(); ?>" class="link"></a>
							<a href="<?php echo $full_image_url; ?>" class="fullsize"></a>
						</div>
					</div>
				</div>
			</div>
<?php $j++;
	endwhile; ?>
		</div>
		<div class="clear"></div>


<?php endif;
?>
-->
	</section>
			<div class="flatcar_inside">
 					 <section id="content" class="container clearfix">
       <div class="grid12 col">
        







        <!-- begin latest posts -->  
            <h2><a class="car_title car_tinside fadeitin">Latest Projects | </a>
         <?php if (!empty($smof_data['General_link'])) : ?>						
            	<span class="more_in car_more_new fadeitin">
            	<a href="<?php echo $smof_data['work_link']; ?>">View All Projects &raquo;</a>
            </span>
            <?php endif; ?>
        </h2>
           
            <!-- begin post carousel -->
            <ul class="post-carousel fadeitin">
<?php
	$j=0;
	while ($r->have_posts()) :
		$r->the_post();
		if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 400, 300, true );
		else :
			$full_image_url = get_template_directory_uri().'/img/940x480.gif';
			$thumb_image_url = get_template_directory_uri().'/img/400x300.gif';
		endif; ?>
		
<li class="entry">
	            	<ul class="grid cs-style-3" id="firas">
					<li>				
						<figure>
							<img src="<?php echo $thumb_image_url; ?>" href="<?php echo $full_image_url; ?>" alt="img04">

							<figcaption>
								<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
								<span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span>
								<a href="<?php the_permalink(); ?>" class="car_more">More</a>
								<a href="<?php echo $full_image_url; ?>" class="fullsize car_full"></a>
								<?php if( function_exists('zilla_likes') ) {?>
							<div href="<?php the_permalink(); ?>" class="car_like2"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></div>				
								<?php }?>
							</figcaption>
						</figure>
					</li>
					</ul>
				</li>
<?php $j++;
	endwhile; ?>
		<div class="clear"></div>
     </ul>
            <!-- end post carousel --> 
        <!-- end latest posts -->
    <!-- end content -->      
</div>
</section>
			</div>
				<section id="content" class="container">














<?php get_footer(); ?>