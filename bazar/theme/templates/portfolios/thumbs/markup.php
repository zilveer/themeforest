<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$portfolio_type = yit_work_get( 'portfolio_type' );


$lightbox = yit_work_get( 'event_lightbox' );
$title    = yit_work_get( 'event_title' );  
$thumbs_title = yit_work_get( 'thumbs_title' );  
$project_description_title = yit_work_get( 'project_description_title' );  

?>

<script>
jQuery(document).ready(function($){
	$('.sidebar').remove();
	
	if( !$('#primary').hasClass('sidebar-no') ) {
		$('#primary').removeClass().addClass('sidebar-no');
		$('.content').removeClass('span9').addClass('span12');
	}
	
});
</script>
<div class="row">
	<div class="portfolio-<?php echo $portfolio_type ?> span12 margin-bottom">
		<div class="row">	
			<!-- portfolio image/slider -->
			<div class="span5">
            	<h2 class="work-title"></h2>
                <div class="work-thumbnail span5">
					<div class="work-loading"><img class="work-loading" src="<?php echo YIT_THEME_TEMPLATES_URL . '/portfolios/thumbs/images/loading.gif' ?>" alt="loading..." /></div>
                </div>
			</div>
			
			<!-- portfolio thumbnails -->
			<div class="work-projects span3">
				<div class="row">
                	<h2><?php echo $thumbs_title; ?></h2>
					<ul>
					<?php $works = array(); ?>
					<?php while ( yit_have_works() ) :  ?>
						<?php
							$image_id  = yit_work_get( 'item_id' );
							$works[$image_id] = yit_get_model('portfolio')->_current_item;
							$works[$image_id]['categories'] = yit_work_get('categories');
							$works[$image_id]['post_permalink'] = yit_work_permalink( $image_id );
							$works[$image_id]['thumbs_title'] = yit_work_get( 'thumbs_title' );
							$works[$image_id]['project_description_title'] = yit_work_get( 'project_description_title' );
						?>
						<li class="span1">
							<a href="<?php echo $works[$image_id]['post_permalink'] ?>" data-item="<?php echo $image_id ?>">
							<?php yit_image( "id=$image_id&size=thumb_small_portfolio_thumbs" );//echo wp_get_attachment_image( $image_id, 'thumb_small_portfolio_thumbs' ); ?>
							</a>
						</li>
					
					<?php endwhile ?>
					</ul>
				</div>
			</div>
			
			<!-- portfolio content -->
            <div class="work-content-wrapper span4">
            	<h2><?php echo $project_description_title; ?></h2>
				<div class="work-content"></div>
            </div>
			<div class="clear"></div>
			
			<!-- portfolio meta -->
			<div class="work-meta span12"></div>
		</div>
	</div>
</div>
<div class="clear"></div>


<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($){
	var works = '<?php echo addslashes(json_encode( $works )) ?>';
	$('.portfolio-thumbs').yit_portfolio_thumbs({
		json: works,
		url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
		overlay: <?php echo $lightbox ?>
	});
});
</script>