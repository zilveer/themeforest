<?php
	global $smof_data;
?>
<div class="related related_post">
	<div class="wd_title_related">
		<h3 class="heading-title"><?php echo stripslashes(esc_attr($smof_data['wd_blog_details_relatedlabel'])); ?></h3>
	</div>
	<?php $_random_id = "related_post_slider_".rand(); ?>
	<div class="related_post_slider loading" id="<?php echo $_random_id; ?>">
		<div class="slides">
		<?php
			$_cat_list = get_the_category($post->ID);
			$_cat_list_arr = array();
			foreach($_cat_list as $_cat_item){
				array_push($_cat_list_arr,$_cat_item->term_id);
			}
			$_list_cat_id = implode($_cat_list_arr,",");
			if( !empty( $_cat_list  ))
				$arg=array(
					'post_type' => $post->post_type,
					'cat' => $_list_cat_id,
					'post__not_in' => array($post->ID),
					'posts_per_page' => 4
				);
			else
				$arg=array(
				'post_type' => $post->post_type,
				'post__not_in' => array($post->ID),
				'posts_per_page' => 4
			);
			wp_reset_query();
			$related = new wp_query($arg);$cout = 0;
			if($related->have_posts()) : while($related->have_posts()) : $related->the_post();global $post;$cout++;
				$thumb=get_post_thumbnail_id($post->ID);
				$thumburl=wp_get_attachment_image_src($thumb,'full');
				?>
					<div class="related-item <?php if($cout==1) echo " first";if($cout==$related->post_count) echo " last";?>">
						<div>
							<a class="thumbnail" href="<?php the_permalink(); ?>">
								<?php 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-blog'));
									} 							
								?>
								<div class="thumbnail-effect"></div>
							</a>
							
							<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<p class="date-time"><?php the_time(get_option('date_format')); ?></p>
						</div>
					</div>
				<?php
			endwhile;
			else:
				echo "<li class=\"span12 related-404\"><div class=\"alert alert-warning\">". __("Sorry,no post found!","wpdance") ."</div></li>";
			endif;
			
			wp_reset_query();
		?>
		</div>
		<div class="slider_control">
			<a title="prev" class="prev" href="#">&lt;</a>
			<a title="next" class="next" href="#">&gt;</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	jQuery(document).ready(function() {
		var $_this = jQuery('#<?php echo $_random_id; ?>');
		var slide_speed = <?php echo (wp_is_mobile())?200:800; ?>;
		if( navigator.platform === 'iPod' ){
			slide_speed = 0;
		}
		
		var owl = $_this.find('.slides').owlCarousel({
					loop : true
					,nav : false
					,dots : false
					,navSpeed : slide_speed
					,slideBy: 1
					,rtl:jQuery('body').hasClass('rtl')
					,margin:10
					,navRewind: false
					,autoplay: false
					,autoplayTimeout: 5000
					,autoplayHoverPause: true
					,autoplaySpeed: false
					,mouseDrag: true
					,touchDrag: true
					,responsiveBaseElement: $_this
					,responsiveRefreshRate: 1000
					,responsive:{
						0:{
							items : 1
						},
						361:{
							items : 2
						},
						579:{
							items : 3
						},
						767:{
							items : 4
						},
						1200:{
							items : 5
						}
					}
					,onInitialized: function(){
						$_this.addClass('loaded').removeClass('loading');
					}
				});
				$_this.on('click', '.next', function(e){
					e.preventDefault();
					owl.trigger('next.owl.carousel');
				});

				$_this.on('click', '.prev', function(e){
					e.preventDefault();
					owl.trigger('prev.owl.carousel');
				});										
		
	});	
</script>