<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$portfolio_type = yit_work_get( 'portfolio_type' );

$cats = yit_work_get('categories');
$projects = array();

if(!empty($cats)):

foreach($cats as $slug=>$name) {
	$projects[$slug] = array('name' => $name, 'items' => array());
}

while ( yit_have_works() ) {
	$item = yit_get_model('portfolio')->_current_item;
	$terms = isset($item['terms']) ? $item['terms'] : array();
	
	if(!empty($terms)) {
		foreach( $terms as $term ) {
			$projects[$term]['items'][] = $item;
		}
	}
}

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

<div id="portfolio" class="portfolio-<?php echo $portfolio_type ?>">
<?php foreach( $projects as $category=>$project ): ?>
	<?php if( !empty($project['items'])): ?>
	<h3><?php echo $project['name'] ?></h3>
	<div id="carousel_<?php echo $category ?>" class="es-carousel-wrapper">
		<div class="es-carousel  row">
			<ul>
				<?php foreach($project['items'] as $item): ?>
					<?php
						yit_get_model('portfolio')->_current_item = $item;
						
                        $video_url = yit_work_get( 'video_url' );
                        $image_url = yit_work_get( 'image_url' );
                        $image_id  = yit_work_get( 'item_id' );
                                
                        $post_permalink = yit_work_permalink( $image_id ); 
					?>
					<li class="span3">
                            <?php 
                            	$class = '';
                                if ( ! empty( $video_url ) ) {
                                	
									list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
						            if( $video_type == 'youtube' ) {
						                $video_url = 'http://www.youtube.com/embed/' . $video_id . '?width=640&height=480&iframe=true';
						            } else if( $video_type == 'vimeo') {
						                $video_url = 'http://player.vimeo.com/video/' . $video_id;
						            }
									
                                    $thumb = $video_url;
                                    //$class = 'video';
                                } else {
                                    $thumb = $image_url;
                                    //$class = 'img';
                                }
								
								
								$both = 0; $class = '';
								$lightbox = yit_work_get( 'event_lightbox' );
								$details  = yit_work_get( 'event_details' );
								$title    = yit_work_get( 'event_title' );
								if( $lightbox && $details ) {
									$both  = 1;
									$class = $video_url ? 'videos' : 'imgs';
								} elseif( $lightbox ) {
									$class = $video_url ? 'videos' : 'imgs';
								} elseif( $details ) {
									$class = 'project';
								} elseif( $title /* && yit_work_get( 'title' ) */) {
									$class = 'onlytitle';
								}

                            ?>
                            <?php if ( ! empty( $image_url ) ) : ?>
							  	<div class="picture_overlay">
							  		<?php yit_image( "id=$image_id&size=thumb_portfolio_4cols" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_4cols' ); ?>
							  	
							  		<?php if ( $lightbox || $details || $title ) : ?>   
							  		<div class="overlay">
							  			<div>
							  				<?php if( $lightbox || $details ): ?>
							  				<p>
												<?php if( $lightbox ): ?><a href="<?php echo $thumb ?>" rel="lightbox_<?php echo $category ?>" class="ch-info-lightbox<?php if($video_url): ?>-video<?php endif ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a><?php endif ?>
												<?php if( $details ): ?><a href="<?php echo $post_permalink ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/project.png' ?>" alt="" /></a><?php endif ?>
											</p>
							  				<?php endif ?>
											<?php if( $title ): ?> 
												<p class="title"><?php yit_work_the('title') ?></p>
												<p class="subtitle"><?php yit_work_the('subtitle') ?></p>
											<?php endif ?>
							  			</div>
							  		</div>
							  		<?php endif ?>
							    </div>  
                            <?php endif ?>  
					</li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>

<script>
jQuery(document).ready(function($){
	jQuery("#carousel_<?php echo $category ?> a.imgs, #carousel_<?php echo $category ?> a.overlay_imgs").colorbox({
		transition:'elastic',
		rel:'lightbox_<?php echo $category ?>',
		fixed:true,
		maxWidth: '80%',
		maxHeight: '80%',
		opacity : 0.7
	});
	
	jQuery("#carousel_<?php echo $category ?> a.videos, #carousel_<?php echo $category ?> a.overlay_videos").colorbox({
	    transition:'elastic',
	    rel:'lightbox_<?php echo $category ?>',
	    fixed:true,
		maxWidth: '60%',
		maxHeight: '80%',
	    innerWidth: '60%',
	    innerHeight: '80%',
		opacity : 0.7,
	    iframe: true,
	    onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
	});
})
</script>


	<?php endif ?>
<?php endforeach ?>

<script type="text/javascript">
jQuery(document).ready(function($){
    $('.es-carousel-wrapper').elastislide({
    	imageW 		: '100%',
    	border		: 0,
    	margin      : 0,
    	preventDefaultEvents: false
    });
});
</script>

</div>

<?php endif ?>