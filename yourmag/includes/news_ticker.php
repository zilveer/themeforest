


<?php wp_enqueue_script('newsticker', BASE_URL . 'js/jquery.modern-ticker.min.js', false, '', true); ?>

<script type="text/javascript">
jQuery(document).ready(function($){  
$(".ticker1").modernTicker({
effect:"scroll",
scrollType:"continuous",
scrollStart:"inside",
scrollInterval:20,
transitionTime:500,
autoplay:true
});
});
</script>


<?php if (get_option('op_ticker_style')!== 'Default') { ?>
<?php $ticker_style = '_' . get_option("op_ticker_style"); ?> 
<?php } ?>
<div class="ticker_box<?php echo $ticker_style ?>">
<div class="inner_10">
	
	<div class="ticker1 modern-ticker mt-square">
	<div class="mt-body">
	<div class="mt-label"><?php echo (get_option('op_ticker_text')) ?></div>
	<div class="mt-news">
	<ul>
	
	<?php 
    $featucat = get_option('op_ticker_cat');
	$slides = get_option('op_ticker_slides');
    if (get_option('op_recent_news_ticker') == 'Recent posts') {
	$my_query = new WP_Query('showposts='. $slides .'');	
	} else {
    $my_query = new WP_Query('showposts='. $slides .'&category_name='. $featucat .'');	
	}
	
    if ($my_query->have_posts()) :
    ?>					
		
    <?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
	
	<li>
        <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>		
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
		<?php $image = aq_resize( $thumbnailSrc, 60, 30, false); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		</a>			
	<a class="ticker_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<div class="ticker_date">
	<?php $time_ago = (get_option('op_time_ago')) ?>
	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . $time_ago ; ?>
	</div>
	</li>
	
	<?php endwhile; wp_reset_query(); ?> 
    <?php endif; ?>   
	
	</ul>
	</div>
	<div class="mt-controls"><div class="mt-prev"></div><div class="mt-play"></div><div class="mt-next"></div></div>
	</div>
	</div>
	
</div>
</div>




	
