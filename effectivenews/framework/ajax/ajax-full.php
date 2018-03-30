<?php
/* ==========================================================================
 *                Momizat ajax init
   ========================================================================== */
add_action( 'init', 'mom_ajax_init' );
function mom_ajax_init() {
	// add scripts
        //wp_register_script( 'mom_ajax', get_template_directory_uri().'/framework/ajax/ajax-full-min.js',  array('jquery'),'1.0',true);
	/*wp_localize_script( 'mom_ajax', 'momAjaxL', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		'success' => __('check your email to complete subscription','theme'),
		'error' => __('Email invalid or already subscribed', 'theme'),
		'werror' => __('Enter a valid city name.', 'theme'),
		'nomore' => __('No More Posts', 'framework'),
		)
	);*/
        //wp_enqueue_script('mom_ajax'); // handle this with main.js file form more speed 
	
        // ajax Actions
        add_action( 'wp_ajax_nbsm', 'mom_nb_show_more' );  
        add_action( 'wp_ajax_nopriv_nbsm', 'mom_nb_show_more');
        
        add_action( 'wp_ajax_mom_loadMore', 'mom_load_more' );  
        add_action( 'wp_ajax_nopriv_mom_loadMore', 'mom_load_more');
        
        add_action( 'wp_ajax_mom_ajaxsearch', 'mom_ajax_search' );  
        add_action( 'wp_ajax_nopriv_mom_ajaxsearch', 'mom_ajax_search');

        add_action( 'wp_ajax_mom_mailchimp', 'mom_mailchimp_subscribe' );  
        add_action( 'wp_ajax_nopriv_mom_mailchimp', 'mom_mailchimp_subscribe');

        add_action( 'wp_ajax_mom_ajaxweather', 'momizat_weather' );  
        add_action( 'wp_ajax_nopriv_mom_ajaxweather', 'momizat_weather');

}

/* ==========================================================================
 *                Show more button
   ========================================================================== */
function mom_nb_show_more() {
    // stay away from bad guys 
    $nonce = $_POST['nonce'];
    $nbs = $_POST['nbs'];
    $count = $_POST['number_of_posts'];
    $display = $_POST['display'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
    $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
    $orderby = isset($_POST['orderby']) ? $_POST['orderby'] : '';
    $offset = $_POST['offset'];
    $offset_rest = $_POST['offset_all'];
    $format = $_POST['format'];
    $image_size = $_POST['image_size'];
    $excerpt_length = $_POST['excerpt_length'];
    $post_type = $_POST['post_type'];
    global $da;
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Nope!' );
?>
<?php if ($nbs == 2) { ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="recent-news">
<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
        <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
	  <div class="rn-title">
	     <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	     <div class="mom-post-meta nb-item-meta">
	  <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
	      <span class="category"><?php _e('in', 'theme'); ?>: <?php the_category(', '); ?></span>
	      <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
	      <?php mom_show_review_score(); ?>
	     </div> <!--meta-->
	  </div> <!--rn title-->
				<?php if (mom_post_image() != false) { ?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('news_box_big'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
	  <div class="news-summary">
	  <P>
		  <?php
			  $excerpt = get_the_excerpt();
			  if ($excerpt == false) {
			  $excerpt = get_the_content();
			  }
			  
			  echo wp_html_excerpt(strip_shortcodes($excerpt), 250, '...');
		  ?>
	     <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
	  </P>
	  </div>
      </article>
<?php endwhile;?>
</div> <!--recent news-->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
if ($display == 'category') {
  $args = array(
  'ignore_sticky_posts' => 1,
  'posts_per_page' => $count,
  'cat' => $category,
  'orderby' => $orderby,
  'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
  'offset' => $offset_rest,
  ); 
} elseif ($display == 'tag') {
  $args = array(
  'ignore_sticky_posts' => 1,
  'posts_per_page' => $count,
  'tag_id' => $tag,
  'orderby' => $orderby,
  'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
  'offset' => $offset_rest,
  ); 
} else {
  $args = array(
	  'ignore_sticky_posts' => 1,
	  'posts_per_page' => $count,
	  'orderby' => $orderby,
	  'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
	  'offset' => $offset_rest,
  ); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="older-articles">
<ul class="two-cols">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<?php
				$is_img = '';
				if (mom_post_image() != false) {
					$is_img = 'has-feature-image';
				?>
                 <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
		 <?php } ?>
                                        <div class="details <?php echo $is_img; ?>">
	  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	  <div class="mom-post-meta nb-item-meta">
	  <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
	      <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
	     </div> <!--meta-->
		  <?php mom_show_review_score(); ?>				   
	     </div>
	      </li>
<?php endwhile; ?>
	  </ul>
      </div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php } elseif ($nbs == 3) { ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="recent-news">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<article <?php post_class(); ?>>
<?php if (mom_post_image() != false) { ?>
<div class="news-image">
<a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('news_box3'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
</div>
<?php } ?>
<div class="news-summary">
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<div class="mom-post-meta nb-item-meta">
<span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
<a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
<?php mom_show_review_score(); ?>
</div> <!--meta-->
<P>
<?php
	$excerpt = get_the_excerpt();
	if ($excerpt == false) {
	$excerpt = get_the_content();
	}
	
	echo wp_html_excerpt(strip_shortcodes($excerpt), 100, '...');
?>
<a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
</P>
</div>
</article>
<?php endwhile;?>
</div> <!--recent news-->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
  'offset' => $offset_rest,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
  'offset' => $offset_rest,
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
  'offset' => $offset_rest,
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="older-articles">
<ul>
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<?php
$is_img = '';
if (mom_post_image() != false) {
$is_img = 'has-feature-image';
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
<?php } ?>
<div class="details <?php echo $is_img; ?>">
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
<div class="mom-post-meta nb-item-meta">
<span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
<a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
</div> <!--meta-->
<?php mom_show_review_score(); ?>				   
</div>
</li>
<?php endwhile; ?>
</ul>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php } elseif ($nbs == 4) { ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="recent-news">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<?php if (mom_post_image() != false) { ?>
<div class="news-image">
<a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('news_box3'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
</div>
<?php } ?>
<div class="news-summary">
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<div class="mom-post-meta nb-item-meta">
<span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
<a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
<?php mom_show_review_score(); ?>
</div> <!--meta-->
<P>
<?php
	$excerpt = get_the_excerpt();
	if ($excerpt == false) {
	$excerpt = get_the_content();
	}
	
	echo wp_html_excerpt(strip_shortcodes($excerpt), 100, '...');
?>
<a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
</P>
</div>
</article>
<?php endwhile;?>
</div> <!--recent news-->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
  'offset' => $offset_rest,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
  'offset' => $offset_rest,
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
  'offset' => $offset_rest,
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="older-articles">
<ul>
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
<div class="mom-post-meta nb-item-meta">
<span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
<a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
<?php mom_show_review_score(); ?>				   
</div> <!--meta-->
</li>
<?php endwhile; ?>
</ul>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php } elseif ($nbs == 'two_cols') { ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="recent-news">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<?php if (mom_post_image() != false) { ?>
<div class="news-image">
<a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('news_box_big'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
</div>
<?php } ?>
<div class="news-summary">
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<div class="mom-post-meta nb-item-meta">
<span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
<a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
<?php mom_show_review_score(); ?>
</div> <!--meta-->
<P>
<?php
$excerpt = get_the_excerpt();
if ($excerpt == false) {
$excerpt = get_the_content();
}

echo wp_html_excerpt(strip_shortcodes($excerpt), 100, '...');
?>
<a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
</P>
</div>
</article>
<?php endwhile;?>
</div> <!--recent news-->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="older-articles">
<ul>
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<?php
$is_img = '';
if (mom_post_image() != false) {
	$is_img = 'has-feature-image';
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
<?php } ?>

<div class="details <?php echo $is_img; ?>">
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
<div class="mom-post-meta nb-item-meta">
<span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
<a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
</div> <!--meta-->
<?php mom_show_review_score(); ?>				   
</div>
</li>
<?php endwhile; ?>
</ul>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php } elseif ($nbs == 'npic1') { ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'offset' => $offset,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset,
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset,
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="nip-grid">
<ul class="clearfix">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<?php if (mom_post_image() != false) { ?>
<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<a href="<?php the_permalink(); ?>" data-tooltip="<?php the_title(); ?>" class="simptip-position-top simptip-movable"><img src="<?php echo mom_post_image('news_in_pics'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
</li>
<?php } ?>
<?php endwhile; ?>
</ul>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php } elseif ($nbs == 'npic2') { ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class='nip-recent' itemscope itemtype="http://schema.org/Article">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<?php if (mom_post_image() != false) { ?>
<a href="<?php the_permalink(); ?>" data-tooltip="<?php the_title(); ?>" class="simptip-position-top simptip-movable"><img src="<?php echo mom_post_image('news_in_pics_big'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
<?php } ?>
<?php endwhile; ?>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
);
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
);
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
);
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="nip-grid">
<ul class="clearfix">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<?php if (mom_post_image() != false) { ?>
<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<a href="<?php the_permalink(); ?>" data-tooltip="<?php the_title(); ?>" class="simptip-position-top simptip-movable"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
</li>
<?php } ?>
<?php endwhile;?>
</ul>
</div>
<div class="clear"></div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php } elseif ($nbs == 'news_list') { ?>
<?php
$nl_class = '';
// image size
if ($image_size == 'scrolling-box') {
$nl_class = 'nl-big';
}
//orderby 
if ($orderby == 'popular') {
$orderby = 'comment_count';	
} elseif ($orderby == 'random') {
$orderby = 'rand';
}
//post format
if ($format != '') {
$format = explode(',',$format);
$formats = array ();
foreach ($format as $f) {
$formats[] = 'post-format-'.$f;
}
$format = array(
array(
'taxonomy' => 'post_format',
'field' => 'slug',
'terms' => $formats,
'operator' => 'IN'
)
);
}
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'offset' => $offset,
'post_status' => 'publish', 'post_type' => $post_type,
'tax_query' => $format,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'offset' => $offset,
'post_status' => 'publish', 'post_type' => $post_type,
'tax_query' => $format
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'orderby' => $orderby,
'order' => $sort,
'offset' => $offset,
'post_status' => 'publish', 'post_type' => $post_type,
'tax_query' => $format
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="news-list <?php echo $nl_class; ?>">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
  <article <?php post_class('nl-item'); ?> itemscope itemtype="http://schema.org/Article">
      <div class="base-box">
	  <?php
	  $is_img = '';
	  if (mom_post_image() != false) {
		  $is_img = 'has-feature-image';
	  ?>
	  <div class="news-image">
		  <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image($image_size); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
	  </div>
	  <?php } ?>
	  <div class="news-summary <?php echo $is_img; ?>">
	     <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	     <div class="mom-post-meta nb-item-meta">
	      <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
	      <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
		  <?php mom_show_review_score(); ?>				   
	     </div> <!--meta-->
	  <P>
		  <?php
			  $excerpt = get_the_excerpt();
			  if ($excerpt == false) {
			  $excerpt = get_the_content();
			  }
			  
			  echo wp_html_excerpt(strip_shortcodes($excerpt), $excerpt_length, '...');
		  ?>
	     <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
	  </P>
	  </div>
      </div>
  </article>
<?php endwhile; ?>
</div> <!--news list-->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php } else { //news box 1 ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => 1,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="recent-news">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<div class="rn-title">
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<div class="mom-post-meta nb-item-meta">
<span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
<span class="category"><?php _e('in', 'theme'); ?>: <?php the_category(', '); ?></span>
<a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
<?php mom_show_review_score(); ?>
</div> <!--meta-->
</div> <!--rn title-->
<div class="news-image">
<a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide-hd'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
</div>
<div class="news-summary">
<P>
<?php
$excerpt = get_the_excerpt();
if ($excerpt == false) {
$excerpt = get_the_content();
}
echo wp_html_excerpt(strip_shortcodes($excerpt), 270, '...');
?>
<a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
</P>
</div>
</article>
<?php endwhile; ?>
</div> <!--recent news-->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $count,
'orderby' => $orderby,
'order' => $sort,
'post_status' => 'publish', 'post_type' => $post_type,
'offset' => $offset_rest,
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
<div class="nb1-older-articles">
<ul class="two-cols">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article"><?php echo $da; ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php } ?>
<?php 
exit();
}

/* ==========================================================================
 *                Load More Posts
   ========================================================================== */
function mom_load_more () {
    $style = $_POST['style'];
    $share = $_POST['share'];
    $count = $_POST['number_of_posts'];
    $display = $_POST['display'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
    $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
    $orderby = isset($_POST['orderby']) ? $_POST['orderby'] : '';
    $offset = $_POST['offset'];
    $format = $_POST['format'];
    $excerpt_length = $_POST['excerpt_length'];
    $load_more_count = $_POST['load_more_count'];
    

// stay away from bad guys 
    $nonce = $_POST['nonce'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) { die ( 'Nope!' ); }
//post format
if ($format != '') {
$format = explode(',',$format);
$formats = array ();
foreach ($format as $f) {
$formats[] = 'post-format-'.$f;
}
$format = array(
array(
'taxonomy' => 'post_format',
'field' => 'slug',
'terms' => $formats,
'operator' => 'IN'
)
);
}
?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $format,
'post_status' => 'publish',
'offset' => $offset,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $format,
'post_status' => 'publish',
'offset' => $offset,
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $format,
'post_status' => 'publish',
'offset' => $offset,
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    mom_blog_post($style, $share, $excerpt_length);
endwhile; else: ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
exit();
}


/* ==========================================================================
 *                Ajax Search
   ========================================================================== */
function mom_ajax_search () {
// stay away from bad guys 
$nonce = $_POST['nonce'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
die ( 'Nope!' );
?>
<?php
$posts_query = new WP_Query( array('s' =>$_POST['term'], 'post_type' => 'post', 'posts_per_page' => 5) );
if ( $posts_query->have_posts() ) {
?>
<h3 class="search-results-title"><?php _e('Posts', 'theme'); ?></h3>
<ul class="s-results">
<?php
// The Loop
while ( $posts_query ->have_posts() ) {
$posts_query ->the_post();
?>
<li <?php post_class(); ?>>
<div class="s-img"><a href="<?php the_permalink(); ?>">
<?php if (mom_post_image() != false) { ?>
<img src="<?php echo mom_post_image('ajax-search-small'); ?>" alt="">
<?php } else { ?>
<span class="post_format"></span>
<?php } ?>
</a></div>
<div class="s-details">
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
<div class="mom-post-meta nb-item-meta">
<span datetime="<?php echo the_time('c') ?>" class="entry-date"><?php echo mom_date_format(); ?></span>
<span class="comment_number"><?php echo comments_number(__('No Comments', 'theme'), __('1 Comment', 'theme'), __('% Comments', 'theme')); ?></span>
</div> <!--meta-->
</div>
</li>
<?php } //end while  ?>
</ul>
<?php } ?>
<?php wp_reset_postdata();
?>
<?php
$pages_query = new WP_Query( array('s' =>$_POST['term'], 'post_type' => 'page', 'posts_per_page' => 5) );
if ( $pages_query->have_posts() ) {
?>
<h3 class="search-results-title"><?php _e('Pages', 'theme'); ?></h3>
<ul class="s-results">
<?php
// The Loop
while ( $pages_query ->have_posts() ) {
$pages_query ->the_post();
?>
<li <?php post_class(); ?>>
<div class="s-img"><a href="<?php the_permalink(); ?>">
<span class="post_format"></span>
</a></div>
<div class="s-details">
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
</div>
</li><?php } //end while  ?>
</ul>
<?php } ?>
<?php wp_reset_postdata();
exit();
}


/* ==========================================================================
 *                MailChimp
   ========================================================================== */
function mom_mailchimp_subscribe () {
// stay away from bad guys 
$nonce = $_POST['nonce'];
$list_id = $_POST['list_id'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
die ( 'Nope!' );
$api_key = mom_option('mailchimp_api_key');
if ($api_key != '') {
require(MOM_FW . '/inc/mailchimp/Mailchimp.php');
$Mailchimp = new Mom_Mailchimp( $api_key );
$Mailchimp_Lists = new Mailchimp_Lists( $Mailchimp );
if (isset($_POST['email'])) {
    $meminfo = $Mailchimp_Lists->memberInfo( $list_id, array ( array( 'email' => htmlentities($_POST['email']) ) ));
    if ($meminfo['success_count'] == 1) {
        echo 'already';
    } else {
        $subscriber = $Mailchimp_Lists->subscribe( $list_id, array( 'email' => htmlentities($_POST['email']) ) );
        if ( ! empty( $subscriber['leid'] ) ) {
        echo "success";
        }
        else
        {
        echo "fail";
        }
        }        
    }

} else {
    echo 'auth';
}
exit();
}