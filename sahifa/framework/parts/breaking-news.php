<?php if( tie_get_option('breaking_news') && ( !tie_get_option('breaking_home') || ( tie_get_option('breaking_home') && is_home() ) || is_front_page()  ) ):
	global $post;
	$original_post = $post;

	$query 				= tie_get_option('breaking_type'  );
	$cat 				= tie_get_option('breaking_cat'   );
	$tag 				= tie_get_option('breaking_tag'   );
	$breaking_custom 	= tie_get_option('breaking_custom');
	$number 			= tie_get_option('breaking_number');
	$effect 			= tie_get_option('breaking_effect');
	$speed 				= tie_get_option('breaking_speed' );
	$timeout 			= tie_get_option('breaking_time'  );

	if( !$number || $number == ' ' || !is_numeric($number) ) $number = 5;
	if( !$effect )	$effect = 'fade';
	if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 750 ;
	if( !$timeout || $timeout == ' ' || !is_numeric($timeout))	$timeout = 3500; ?>
	
	<div class="clear"></div>
	<div id="breaking-news" class="breaking-news">
		<span class="breaking-news-title"><i class="fa fa-bolt"></i> <span><?php _eti( 'Breaking News' , 'tie') ; ?></span></span>
		
		<?php
		if( $query != 'custom' ):
			if( $query == 'tag' ){
				$sep  = '';
				$tags = explode (',' , $tag );
				foreach ($tags as $tag){
					$theTagId = get_term_by( 'name', $tag, 'post_tag' );
					if( !empty( $fea_tags ) ) $sep = ' , ';
					$fea_tags .=  $sep . $theTagId->slug;
				}
				$args = array('tag' => $fea_tags, 'posts_per_page'=> $number, 'no_found_rows' => 1 );
			}else{
				$args = array('category__in' => $cat, 'posts_per_page'=> $number, 'no_found_rows' => 1 );
			}

			$breaking_query = new wp_query( $args  );
			
			if( $breaking_query->have_posts() ) : $count=0; ?>
			<ul>
		<?php
		while( $breaking_query->have_posts() ) :
			$breaking_query->the_post();
			$count++;
		?>
			<li><a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
		<?php
			endwhile;
			$post = $original_post;
			wp_reset_query();
		?>
			</ul>
			<?php endif; ?>
		
		<?php else: ?>
			<?php if( is_array( $breaking_custom ) ){ ?>
			<ul>
				<?php foreach ($breaking_custom as $custom_text) {  ?>
				<li><a href="<?php echo $custom_text['link'] ?>" title="<?php echo $custom_text['text'] ?>"><?php echo $custom_text['text'] ?></a></li>				
			<?php } ?>
			</ul>
			<?php }	?>
		<?php endif; ?>

		<script type="text/javascript">
			jQuery(document).ready(function(){
				<?php if( $effect == 'ticker' ): ?>
				createTicker(); 
				<?php else: ?>
				jQuery('#breaking-news ul').innerFade({animationType: '<?php echo $effect ?>', speed: <?php echo $speed ?> , timeout: <?php echo $timeout ?>});
				<?php endif; ?>
			});
			<?php if( $effect == 'ticker' ): ?>                                                 
			function rotateTicker(){                                   
				if( i == tickerItems.length ){ i = 0; }                                                         
				tickerText = tickerItems[i];                              
				c = 0;                                                    
				typetext();                                               
				setTimeout( "rotateTicker()", <?php echo $timeout ?> );                     
				i++;                                                      
			}                                                           
			<?php endif; ?>
		</script>
	</div> <!-- .breaking-news -->
<?php endif; ?>