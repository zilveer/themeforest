<?php
 function webnus_latestfromblog( $attributes, $content = null ) {
extract(shortcode_atts(	array(
	'type'=>'rose',
	'category'=>''
), $attributes));
	ob_start();		
?>
<div class="container latestposts-<?php echo $type ?>">
<?php
	if ($type=='rose'){
			$query = new WP_Query('posts_per_page=2&category_name='.$category.'');
			while ($query -> have_posts()) : $query -> the_post();
?>
	<div class="col-md-6 col-sm-6"><article class="latest-b"><figure class="latest-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'home_lfb' ) );   ?></figure><div class="latest-content"><h6 class="latest-b-cat"><?php the_category(', '); ?></h6><h3 class="latest-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p class="latest-author"><?php the_author(); ?> / <?php the_time('d M Y'); ?></p><p class="latest-excerpt"><?php echo get_the_excerpt(); ?></p></div></article></div>
<?php
	endwhile;
	}elseif ($type=='jasmine'){
			$i = 0;  
			$query = new WP_Query('posts_per_page=5&category_name='.$category.'');
			while ($query -> have_posts()) : $query -> the_post(); 
      		if( $i == 0 ) {
      		?>
      		<div class="col-md-7">
				<article class="blog-post clearfix ">
					<figure class="pad-r20">
								<?php
								  echo '<a href="'. get_permalink() .'">';
								  $image = get_the_image( array( 'meta_key' => array( 'Thumbnail', 'Thumbnail' ), 'size' => 'latestfromblog' ,'echo'=>false) );
								  if( !empty($image) ) 
									echo $image;
								  else 
									echo '<img src="'.get_template_directory_uri() . '/images/featured.jpg" />';
								  echo '</a>';
								?>
					</figure>
					<div class="entry-menta"><div class="blog-date-sec"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div><p class="blog-author"><strong><?php _e('Written By','WEBNUS_TEXT_DOMAIN'); ?></strong> <?php the_author(); ?><strong> / </strong> <?php the_category('/ ') ?><br><strong class="tline-date"><?php echo get_the_date('d M Y');?> </strong></p></div><div class="entry-content"><h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><p class="blog-detail"><?php echo get_the_excerpt(); ?></p></div>
				</article>
			</div>
		<?php  }else{ ?>
		<div class="col-md-5">
      	<article class="blog-line clearfix">
          	<a href="<?php the_permalink(); ?>" class="img-hover"><?php  
				$image = get_the_image( array( 'meta_key' => array( 'Thumbnail', 'Thumbnail' ), 'size' => 'lfb_thumb' ,'echo'=>false) ); 
				if( !empty($image) ) 
					echo $image;
				else 
					echo '<img src="'.get_template_directory_uri() . '/images/featured_140x110.jpg" />';	
          	?></a>
			<p class="blog-cat"><?php the_category(', '); ?></p><h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4><p><?php echo get_the_time('d M Y'); ?> 	/<strong><?php _e('by', 'WEBNUS_TEXT_DOMAIN') ?></strong> <?php echo get_the_author(); ?>
        </article>
		</div>
      <?php
		}
		$i++; 
		endwhile;
	}elseif ($type=='violet'){
	$query = new WP_Query('posts_per_page=3&category_name='.$category.'');
	while ($query -> have_posts()) : $query -> the_post();
?>
	<div class="col-md-4"><article class="latest-b2"><figure class="latest-b2-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'home_lfb' ) );   ?></figure><div class="latest-b2-cont"><h6 class="latest-b2-cat"><?php the_category(', '); ?></h6><h3 class="latest-b2-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo get_the_excerpt(); ?></p><div class="latest-b2-metad2"><i class="fa-comment-o"></i><span><?php echo get_comments_number() ?></span> / <span class="latest-b2-date"><?php the_author(); ?> / <?php echo get_the_date('M d, Y');?></span></div></div></article></div>
<?php
	endwhile;
	}elseif ($type=='orchid'){
	$query = new WP_Query('posts_per_page=2&category_name='.$category.'');
	while ($query -> have_posts()) : $query -> the_post();
?>	
	<div class="col-md-6"><article class="latest-b2"> <div class="col-md-3"> <h6 class="blog-date"><span><?php the_time('d') ?> </span><?php the_time('M Y') ?> </h6> <div class="au-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div> <h6 class="blog-author"><strong><?php _e('Written by','WEBNUS_TEXT_DOMAIN'); ?></strong><br> <?php the_author(); ?> </h6> <h6 class="latest-b2-cat"><?php the_category(', '); ?></h6> </div><div class="col-md-9"> <figure class="latest-b2-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'home_lfb' ) );   ?></figure> <div class="latest-b2-cont"><h3 class="latest-b2-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> </div> </div><hr class="vertical-space"></article></div>
<?php
	endwhile;
	}
?>	
</div>
<?php
	$out = ob_get_contents();
	ob_end_clean();	
	wp_reset_query();
	return $out;
 }
 add_shortcode('latestblog', 'webnus_latestfromblog');
?>