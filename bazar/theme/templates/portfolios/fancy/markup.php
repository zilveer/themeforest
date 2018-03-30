<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$portfolio_type = yit_work_get( 'portfolio_type' );

$portfolio_name = yit_work_get('name');
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
<div id="portfolio-<?php echo $portfolio_name ?>" class="portfolio-<?php echo $portfolio_type ?> row">
	<div class="tp-head span12">
		<span class="close back"></span>
		<h3 class="name"></h3>
	</div>
	<div class="clear"></div>
	<div class="span12">
		<ul class="tp-grid">
			<?php while ( yit_have_works() ) : 
					$image_id  = yit_work_get( 'item_id' );
					$image_url = yit_work_get( 'image_url' );
					
					$lightbox = yit_work_get('lightbox');
					
					$categories = yit_work_get('categories');
					$terms = yit_work_get('terms');
					$terms_plain = "";
					
					$post_permalink = yit_work_permalink( $image_id );
					
					
					if( $terms ) {
						foreach( $terms as $term ) {
							$terms_plain .= $categories[$term] . ',';
						}
						$terms_plain = substr($terms_plain, 0, strlen( $terms_plain ) - 1);
					}
			?>
			<li data-pile="<?php echo $terms_plain ?>">
				<a href="<?php if($lightbox): echo $image_url ?>" rel="fancy_lightbox"<?php else: echo $post_permalink; ?>" class="nolightbox"<?php endif ?> title="<?php echo yit_work_get('title') ?>">
					<span class="tp-info"><span><?php echo yit_work_get('title') ?></span></span>
					<?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fancy' ); ?>
				</a>			
			</li>
			<?php endwhile ?>
		</ul>
	</div>
</div>


<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($){
	var lightbox = <?php echo $lightbox ? 1 : 0; ?>;


    if( $( '#footer' ).length > 0 )
        { $( '#footer' ).stickyFooter(); }
    else
        { $( '#copyright' ).stickyFooter(); }


	var $grid = $( '#portfolio-<?php echo $portfolio_name ?> .tp-grid' ),
		$name = $( '#portfolio-<?php echo $portfolio_name ?> .name' ),
		$close = $( '#portfolio-<?php echo $portfolio_name ?> .tp-head' ),
		$loader = $( '<div class="loader"><i></i><i></i><i></i><i></i><i></i><i></i><span>Loading...</span></div>' ).insertBefore( $grid ),
		stapel = $grid.stapel( {
			randomAngle : true,
			delay : 50,
			gutter : 30,
			pileAngles : 5,
			onLoad : function() {
				$loader.remove();
			},
			onBeforeOpen : function( pileName ) {
				$name.html( pileName );
			},
			onAfterOpen : function( pileName ) {
				$grid.find('a').addClass('opened');

				if(lightbox) {
					var pile = $grid.data('stapel');
					pile = pile.piles[pileName].elements;
					
					$.each(pile, function(i,v){
						$(v.el).find('a').addClass('lightbox');
					});

					$('.lightbox').colorbox.remove();
					$('.lightbox').colorbox({
						transition:'elastic',
						rel:'fancy_lightbox',
						fixed:true,
						maxWidth: '100%',
						maxHeight: '100%',
						opacity : 0.7
					});
				}
				
				$close.css('visibility','visible');
			},
			onAfterClose : function( pileName, totalItems ) {
				$grid.find('a').removeClass('opened');
				$grid.find('a').removeClass('lightbox');
			}
		} );

		$close.on('click', function() {
			$close.css('visibility','hidden');
			$name.empty();
			stapel.closePile();
		});
		
		/*
		if( !YIT_Browser.isIE8() ) {
			$(window).resize(function(){
				//$close.click();
			});
		}
		*/

		$('#primary').resize(function(){
			$(window).trigger('sticky');
		});

});
</script>