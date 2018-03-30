<?php
add_action( 'init', 'mom_autocomplete_init' );
function mom_autocomplete_init() {
	// add scripts
        wp_register_script( 'mom_ajax_search', get_template_directory_uri().'/framework/ajax/ajax-search.js',  array('jquery','jquery-ui-autocomplete'),'1.0',true);
	wp_localize_script( 'mom_ajax_search', 'MyAcSearch', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		'homeUrl' => home_url(),
		'viewAll' => __('View All Results', 'theme'),
		'noResults' => __('Sorry, no posts matched your criteria', 'theme'),
		)
	);
        wp_enqueue_script('mom_ajax_search');
	
        // ajax Action
        add_action( 'wp_ajax_mom_ajaxsearch', 'mom_ajax_search' );  
        add_action( 'wp_ajax_nopriv_mom_ajaxsearch', 'mom_ajax_search');
}

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