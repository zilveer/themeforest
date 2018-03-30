<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         


$sidebar_layout = yit_get_sidebar_layout();

extract( $this->shortcode_atts );

$style = $this->shortcode_atts['style'];
if ( $style == 'accordion' ) : ?>
	<?php if( ! yit_is_accordion_empty() ): ?>
		<div class="accordion-container">
		<?php while( yit_have_accordion_item() ): ?>
			
			<div class="accordion-wrapper row">
				<div class="accordion-title span9">
					<div class="plus">+</div>
					<h4><?php yit_accordion_item_the('title'); ?></h4>
				</div>
				<div class="accordion-item span9">
					<div class="row">
						<div class="span2">
							<div class="accordion-item-thumb">
								<?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = yit_image( array( 'id' => yit_accordion_item_get('item_id'), 'size' => 'accordion_thumb', 'output' => 'array' ) ); ?>
								<img src="<?php echo $thumbnail_url ?>" alt="<?php yit_accordion_item_the('title'); ?>" />
							</div>
						</div><!-- end span3 -->
						<div class="span7">
							<div class="accordion-item-content">
								<?php echo yit_content(yit_accordion_item_get('content'), 1000); ?>
								<?php if (yit_accordion_item_get('subtitle') != '' || yit_accordion_item_get('website') != '' || yit_accordion_item_get('social') != '' ) : ?>
									<div class="meta">
										<?php if (yit_accordion_item_get('subtitle') != '') : ?><p><img class="icon" src="<?php echo YIT_THEME_ASSETS_URL ."/images/icons/role.png" ?>" alt="role_icon" /><?php _e('Role', 'yit') ?>: <?php yit_accordion_item_the('subtitle'); ?></p><?php endif ?>
										<?php if (yit_accordion_item_get('website') != '') : ?><p><img class="icon" src="<?php echo YIT_THEME_ASSETS_URL ."/images/icons/website.png" ?>" alt="website_icon" /><?php _e('Website', 'yit') ?>: <a href="<?php yit_accordion_item_the('website'); ?>"><?php yit_accordion_item_the('website'); ?></a></p><?php endif ?>
										<?php if (yit_accordion_item_get('social') != '') : ?>
											<div>
												<div class="social_title">
													<p><img class="icon" src="<?php echo YIT_THEME_ASSETS_URL ."/images/icons/social-meta.png" ?>" alt="social_icon" /><?php _e('Get in touch', 'yit') ?>:</p>
												</div>
												<?php echo yit_content(yit_accordion_item_get('social')); ?>
											</div>
										<?php endif ?>											
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile ?>
		</div>
		
		<script>
		jQuery(document).ready(function($){
			$('.accordion-title').click(function(){
				if( !$(this).hasClass('active') ) {
					$('.accordion-title').removeClass('active').find(':first-child').addClass('plus').text("+").removeClass('minus');
					$('.accordion-item').slideUp();
		
					$(this).toggleClass('active')
						   .find(':first-child').removeClass('plus').addClass('minus').text("-").parent().next().slideToggle();
				}
			}).filter(':first').click();
		});
		</script>
	<?php endif ?>
	
<?php elseif ($style == 'rounded') : 
	wp_enqueue_script( 'caroufredsel' );
	wp_enqueue_script( 'touch-swipe' );
	wp_enqueue_script( 'mousewheel' );
	wp_enqueue_script( 'black-and-white' ); ?>
	<?php if( ! yit_is_accordion_empty() ): ?>
		<div class="team-slider wrapper team-rounded margin-top margin-bottom">
			<div class="list_carousel"><ul class="team-slides">
		<?php while( yit_have_accordion_item() ): ?>		
			
			<li>
				<?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = yit_image( array( 'id' => yit_accordion_item_get('item_id'), 'size' => 'team_rounded_thumb', 'output' => 'array' ) ); ?>
				<div class="team-circle bwWrapper">
					<img src="<?php echo $thumbnail_url ?>" alt="<?php yit_accordion_item_the('title'); ?>" />
				</div>
				<h6><?php yit_accordion_item_the('title'); ?></h6>
				
				<?php echo yit_content(yit_accordion_item_get('content'), 1000); ?>
				
				<?php if (yit_accordion_item_get('subtitle') != '' || yit_accordion_item_get('website') != '' || yit_accordion_item_get('social') != '' ) : ?>
					<div class="meta">
						<?php if (yit_accordion_item_get('subtitle') != '') : ?><p><strong><?php yit_accordion_item_the('subtitle'); ?></strong></p><?php endif ?>
						<?php if (yit_accordion_item_get('website') != '') : ?><p><a href="<?php yit_accordion_item_the('website'); ?>"><?php yit_accordion_item_the('website'); ?></a></p><?php endif ?>
						<?php if (yit_accordion_item_get('social') != '') : ?>
							<div>
								<?php echo yit_content(yit_accordion_item_get('social')); ?>
							</div>
						<?php endif ?>							
					</div>
				<?php endif ?>					
			</li>
			
		<?php endwhile ?>
		</ul></div>
		<div class="clearfix"></div>
		<div class="nav">
			<a id="team-slider-prev" class="prev" href="#"></a>
			<a id="team-slider-next" class="next" href="#"></a>
		</div>
		</div>
		<script type="text/javascript">
			jQuery(function($){
				var maxHeight = 0;

				$('.team-slides li').each(function(){
				    if ($(this).height() > maxHeight) { 
				    	maxHeight = $(this).height(); 
				    }
				});
				
				$('.team-slides li').height(maxHeight + 20);
				
				$('.team-slides').imagesLoaded(function(){
					$('.team-slides').carouFredSel({
						auto: true,
						width: '100%',
						prev: '#team-slider-prev',
						next: '#team-slider-next',
						swipe: {
							onTouch: true
						},
						scroll : {
							items     : 1,
							duration  :	500
						} 
					});
				});
				
			    $('.bwWrapper').BlackAndWhite({
			        hoverEffect : true, // default true
			        // set the path to BnWWorker.js for a superfast implementation
			        webworkerPath : false,
			        // for the images with a fluid width and height 
			        responsive:true,
			        speed: { //this property could also be just speed: value for both fadeIn and fadeOut
			            fadeIn: 200, // 200ms for fadeIn animations
			            fadeOut: 300 // 800ms for fadeOut animations
			        }
			    });		    
			});
		</script>

	<?php endif ?>
    
<?php elseif ($style == 'professional') : ?>
	<?php if( ! yit_is_accordion_empty() ): ?>
		<div class="team-slider wrapper team-professional margin-top margin-bottom">
        	<ul<?php if(yit_accordion_has_featured_item()):?> class="with-featured"<?php else :?> class="without-featured"<?php endif ?>>
				<?php while( yit_have_accordion_item() ): ?>
                
                	<?php
						$li_span = 3;
						if (yit_accordion_item_get('featured') )
						{
							if ( $sidebar_layout == 'sidebar-no' ) $li_span = "12 featured";
							else $li_span = "9 featured";
						}
					?>
                	
                    <li class="span<?php echo $li_span; ?>">
                    	<div class="padding">
                        	
                            <?php if( yit_accordion_item_get('featured') ): ?>
                        	
								<?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = yit_image( array( 'id' => yit_accordion_item_get('item_id'), 'size' => 'team_professional_thumb', 'output' => 'array' ) ); ?>
                                <div class="thumb span3" style="position:absolute; bottom:1px; margin-bottom:0px;">
                                    <img src="<?php echo $thumbnail_url ?>" alt="<?php yit_accordion_item_the('title'); ?>" />
                                </div>
                                <div class="content">
                                    <h4><?php yit_accordion_item_the('title'); ?></h4>
                                    <?php if (yit_accordion_item_get('subtitle') != '') : ?><h5><?php yit_accordion_item_the('subtitle'); ?></h5><?php endif ?>
                                    <?php echo yit_content(yit_accordion_item_get('content'), 1000); ?>
                                    <?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = yit_image( array( 'id' => yit_accordion_item_get('item_id'), 'size' => 'team_professional_mini_thumb', 'output' => 'array' ) ); ?>
                                </div>
                                <div class="mobile_thumb span1">
                                	<img src="<?php echo $thumbnail_url ?>" alt="<?php yit_accordion_item_the('title'); ?>" />
                                </div>
                            
                            <?php else : ?>
                            
                            	<?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = yit_image( array( 'id' => yit_accordion_item_get('item_id'), 'size' => 'team_professional_mini_thumb', 'output' => 'array' ) );?>
                            	<h4><?php yit_accordion_item_the('title'); ?></h4>
                                <?php if (yit_accordion_item_get('subtitle') != '') : ?><h5><?php yit_accordion_item_the('subtitle'); ?></h5><?php endif ?>
                                <?php echo yit_content(yit_accordion_item_get('content'), 1000); ?>
                                <div class="thumb span1">
                                    <img src="<?php echo $thumbnail_url ?>" alt="<?php yit_accordion_item_the('title'); ?>" />
                                </div>
                                
                            <?php endif ?>	
                            
                            <?php if (yit_accordion_item_get('website') != '' || yit_accordion_item_get('social') != '' ) : ?>
                                <div class="meta">
                                    <h6><?php _e('Get in touch', 'yit'); ?></h6>
                                    <?php if (yit_accordion_item_get('website') != '') : ?><p><a href="<?php yit_accordion_item_the('website'); ?>"><?php yit_accordion_item_the('website'); ?></a></p><?php endif ?>
                                    <?php if (yit_accordion_item_get('social') != '') : ?>
                                        <div>
                                            <?php echo yit_content(yit_accordion_item_get('social')); ?>
                                        </div>
                                    <?php endif ?>							
                                </div>
                            <?php endif ?>	
                			<div class="clear"></div>
                    	</div>				
                    </li>
                    
                <?php endwhile ?>
                <div class="clear"></div>
			</ul>
		</div>
	<?php endif ?>
    
<?php elseif ($style == 'squared') : ?>
	<?php if( ! yit_is_accordion_empty() ): ?>
		<div class="team-slider wrapper team-squared margin-top margin-bottom">
        	<div class="row">
            	<ul id="team-squared-container">
					<?php $box_number = 1; while( yit_have_accordion_item() ): ?>	
                    	
                        <?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = yit_image( array( 'id' => yit_accordion_item_get('item_id'), 'output' => 'array' ) ); ?>
                        <li class="span3">
                        	<div class="box box<?php echo $box_number; ?>">
                            	<div class="image">
                                	<img src="<?php echo $thumbnail_url ?>" alt="<?php yit_accordion_item_the('title'); ?>" />
                                	<div class="content">
                                		<h6><?php yit_accordion_item_the('title'); ?></h6>
                                        <?php echo yit_content(yit_accordion_item_get('content'), 1000); ?>
                                	</div>
                                </div>
                            </div>			
                        </li>
                        
                    <?php $box_number++; endwhile ?>
				</ul>
            </div>
			<div class="clear"></div>
            
		</div>
        <?php
			$about_container = "team-squared-container";			// ID CONTAINER
			$about_cols = $this->shortcode_atts['sqrcols'];			// (default 7 for span12, 5 for span9)
			if($about_cols == "auto") $about_cols = $sidebar_layout != 'sidebar-no' ? '5' : '7';
			$about_option_size = $this->shortcode_atts['sqrsize'];	// (default 0.974)
			$about_option_xoom = $this->shortcode_atts['sqrxoom'];	// (default 1.5)
			$about_option_slow = $this->shortcode_atts['sqrslow'];	// (default 150)
		?>
		<script type="text/javascript">
			jQuery(function($){
				
				var about_container = "<?php echo $about_container; ?>	";
				var about_cols = <?php echo $about_cols; ?>;
				var about_option_size = <?php echo $about_option_size; ?>;
				var about_option_xoom = <?php echo $about_option_xoom; ?>;
				var about_option_slow = <?php echo $about_option_slow; ?>;
				var width,side,row,col,new_margin_top,numb;
				var about_items = $("#"+about_container+" > li").size();
				
				$(window).resize(function()
				{
					
					width = ( $(".span3").width() + 30 ) * about_option_size;
					cols = about_cols;
					
					if($(window).width() < 768)
					{
						width = ( $(".span3").width() + 30 ) / 2.5;
						cols = 3;
					}
					
					side = Math.sqrt( Math.pow(width,2) / 2 );
					$(".box").width(side);
					$(".box").height(side);	
					
					row = 1;
					col = 2;
					for(x=1; x<=about_items; x++)
					{
						margin_left = width * (col/2);
						margin_top = width * ( row - 1 ) / 2;
						
						$(".box"+x).css("margin-left",margin_left+"px");
						$(".box"+x).css("margin-top",margin_top+"px");
						$(".box"+x).attr("aboutop",margin_top);
						$(".box"+x).attr("row",row);
						$(".box"+x).attr("col",col);
						
						col += 2;
						
						if(col == cols + 1){ col = 1; row++; }
						else if(col == cols + 2){ col = 2; row++; }
					}
					
					$("#"+about_container).width( width * ( cols / 2) + width / 2 );
					$("#"+about_container).height( width * (row/2) ); // *****
				}).resize();
				
				$(".box").mouseenter(function()
				{
					$(this).css("z-index","9999");
					new_margin_top = parseInt( $(this).css("margin-top") ) - ( ( (width * about_option_xoom) - width ) / 2 );
					$(this).animate({
						width: (side * about_option_xoom),
						height: (side * about_option_xoom),
						marginTop: new_margin_top
					 },about_option_slow);
					 $("div.content",this).fadeIn('slow');
				});
				
				$(".box").mouseleave(function()
				{
					new_margin_top = $(this).attr("aboutop");
					numb =  $(this).attr("class") ;
					$(this).animate({
						width: (side),
						height: (side),
						marginTop: new_margin_top
					},about_option_slow);
					$(this).css("z-index","999");
					$("div.content",this).fadeOut('fast');
				});
			});
		</script>

	<?php endif ?>
<?php endif ?>