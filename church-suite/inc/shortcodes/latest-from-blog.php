<?php
 function webnus_latestfromblog( $attributes, $content = null ) {
extract(shortcode_atts(	array(
	'type'=>'one',
	'author'=>'',
	'category'=>''
), $attributes));
	ob_start();
?>
<div class="container latestposts-<?php echo $type ?>">
<?php
	if ($type=='one'){
			$query = new WP_Query('posts_per_page=2&category_name='.$category.'&author_name='.$author);
			while ($query -> have_posts()) : $query -> the_post();
?>
	<div class="col-md-6 col-sm-6"><article class="latest-b"><figure class="latest-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'latestfromblog' ) );   ?></figure><div class="latest-content"><h6 class="latest-b-cat"><?php the_category(', '); ?></h6><h3 class="latest-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p class="latest-author"><?php the_author_posts_link(); ?> / <?php the_time('F d, Y'); ?></p><p class="latest-excerpt"><?php echo webnus_excerpt(36); ?></p></div></article></div>
<?php
	endwhile;
	}elseif ($type=='two'){
			$i = 0;
			$query = new WP_Query('posts_per_page=5&category_name='.$category.'');
			while ($query -> have_posts()) : $query -> the_post();
      		if( $i == 0 ) {
      		?>
      		<div class="col-md-7">
				<article class="blog-post clearfix ">
					<figure class="pad-r20">
								<?php
								  $image = get_the_image( array( 'meta_key' => array( 'Thumbnail', 'Thumbnail' ), 'size' => 'latestfromblog' ,'echo'=>false) );
								  if( !empty($image) )
									echo $image;
								  else
									echo '<img src="'.get_template_directory_uri() . '/images/featured.jpg" />';
								?>
					</figure>
					<div class="entry-menta"><div class="blog-date-sec"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div><p class="blog-author"><strong><?php esc_html_e('By','webnus_framework'); ?></strong> <?php the_author_posts_link(); ?><strong> / </strong> <?php the_category('/ ') ?><br><span class="tline-date lfb2"><strong><?php echo get_the_date('d');?> </strong><?php echo get_the_date('M Y');?> </span></p></div><div class="entry-content"><h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><p class="blog-detail"><?php echo webnus_excerpt(36); ?></p></div>
				</article>
			</div>
		<?php  }else{ ?>
		<div class="col-md-5">
      	<article class="blog-line clearfix">
          	<a href="<?php the_permalink(); ?>" class="img-hover"><?php
				$image = get_the_image( array( 'meta_key' => array( 'Thumbnail', 'Thumbnail' ), 'size' => 'tabs_img' ,'echo'=>false, 'link_to_post' => false,) );
				if( !empty($image) )
					echo $image;
				else
					echo '<img src="'.get_template_directory_uri() . '/images/featured_140x110.jpg" />';
          	?></a>
			<p class="blog-cat"><?php the_category(', '); ?></p><h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4><p><?php echo get_the_time('F d, Y'); ?> 	/<strong><?php esc_html_e('by', 'webnus_framework') ?></strong> <?php echo get_the_author(); ?>
        </article>
		</div>
      <?php
		}
		$i++;
		endwhile;
	}elseif ($type=='three'){
	$query = new WP_Query('posts_per_page=3&category_name='.$category.'');
	while ($query -> have_posts()) : $query -> the_post();
?>
	<div class="col-md-4"><article class="latest-b2"><figure class="latest-b2-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'latestfromblog' ) );   ?></figure><div class="latest-b2-cont"><h6 class="latest-b2-cat"><?php the_category(', '); ?></h6><h3 class="latest-b2-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo webnus_excerpt(36); ?></p><div class="latest-b2-metad2"><i class="fa-comment-o"></i><span><?php echo get_comments_number() ?></span> / <span class="latest-b2-date"><?php the_author_posts_link(); ?> / <?php echo get_the_date('F d, Y');?></span></div></div></article></div>
<?php
	endwhile;
	}elseif ($type=='four'){
	$query = new WP_Query('posts_per_page=2&category_name='.$category.'');
	while ($query -> have_posts()) : $query -> the_post();
?>
	<div class="col-md-6"><article class="latest-b2"> <div class="col-md-3"> <h6 class="blog-date"><span><?php the_time('d') ?> </span><?php the_time('M Y') ?> </h6> <div class="au-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div> <h6 class="blog-author"><strong><?php esc_html_e('Written by','webnus_framework'); ?></strong><br> <?php the_author_posts_link(); ?> </h6> <h6 class="latest-b2-cat"><?php the_category(', '); ?></h6> </div><div class="col-md-9"> <figure class="latest-b2-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'latestfromblog' ) );   ?></figure> <div class="latest-b2-cont"><h3 class="latest-b2-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> </div> </div><hr class="vertical-space"></article></div>
<?php
	endwhile;
	}elseif ($type=='five'){
			$query = new WP_Query('posts_per_page=6&category_name='.$category.'');
			while ($query -> have_posts()) : $query -> the_post();
?>
	 <div class="col-md-6 col-lg-4"><article class="latest-b2">
	  <figure class="latest-b2-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb' ) );   ?></figure>
	  <div class="latest-b2-cont">
	  <h6 class="latest-b2-cat"><?php the_category(', '); ?></h6>
	  <h3 class="latest-b2-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	  <h5 class="latest-b2-date"><?php the_author_posts_link(); ?> / <?php echo get_the_date('F d, Y');?></h5>
	  </div></article></div>
<?php
	endwhile;
	} elseif ($type=='six') {
			$query = new WP_Query('posts_per_page=4&category_name='.$category.'');
			while ($query -> have_posts()) : $query -> the_post();
?>
	<div class="col-md-3 col-sm-6"><article class="latest-b">
	  <figure class="latest-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'latestfromblog' ) );   ?></figure>
		<div class="latest-content">
		<p class="latest-date"><?php the_time('F d, Y'); ?></p>
		<h3 class="latest-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="latest-author"><strong><?php esc_html_e('by','webnus_framework'); ?></strong> <?php the_author_posts_link(); ?> <strong>in</strong> <?php the_category(', '); ?></p>
		</div>
      </article></div>
<?php
	endwhile;
	} elseif ( $type == 'seven' ) {
		$wpbp = new WP_Query('posts_per_page=3&category_name='.$category.'');
		if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); ?>
		<div class="col-md-4 col-sm-4"><article class="latest-b">
		<figure class="latest-img"><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'latestfromblog' ) ); ?></figure>
		  	<div class="wrap-date-icons">
			    <h3 class="latest-date">
			    	<span class="latest-date-month"><?php the_time('M') ?></span>
			    	<span class="latest-date-day"><?php the_time('d') ?></span>
			    	<span class="latest-date-year"><?php the_time('Y') ?></span>
			    </h3>
			    <div class="latest-icons">
			    	<p>
			    		<span><i class="fa-eye"></i></span>
			    	</p>
			    	<p>
			            <span><?php echo webnus_getViews(get_the_ID()); ?></span>
				    </p>
			    </div>
			</div>
			<div class="latest-content">
				<h3 class="latest-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="latest-author"><?php esc_html_e('by','webnus_framework'); ?> <?php the_author(); ?> in <?php the_category(', '); ?></p>
			</div>
	    </article></div> <?php

		endwhile; endif;
	}
?>
</div>
<?php
	$out = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
	return $out;
 }
 add_shortcode('latestfromblog', 'webnus_latestfromblog');
?>