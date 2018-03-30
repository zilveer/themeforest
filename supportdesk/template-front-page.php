<?php
/**
 * Template Name: Homepage
 */
 get_header(); ?>

<?php 
// get the id of the front page
$st_front_id = get_option('page_on_front ');
$st_hp_sidebar_position = of_get_option('st_hp_sidebar');
?>

<?php if (of_get_option('st_hp_headline') || ( of_get_option('st_hp_tagline') ) ||  (of_get_option('st_hp_search') == 1 ) ) { ?>
<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">

<?php if (of_get_option('st_hp_headline') ) { ?>
<h1><?php echo of_get_option('st_hp_headline'); ?></h1>
<?php } ?>
<?php if (of_get_option('st_hp_tagline') ) { ?>
<h2><?php echo of_get_option('st_hp_tagline'); ?></h2>
<?php } ?>

<?php if (of_get_option('st_hp_search') == 1 ) { ?>
<!-- #live-search -->
<div id="live-search">

      <form role="search" method="get" id="searchform" class="clearfix" action="<?php echo home_url( '/' ); ?>" autocomplete="off">
        <input type="text" onfocus="if (this.value == '<?php _e("Search the knowledge base...", "framework") ?>') {this.value = '';}" onblur="if (this.value == '')  {this.value = '<?php _e("Search the knowledge base...", "framework") ?>';}" value="<?php _e("Search the knowledge base...", "framework") ?>" name="s" id="s" />
        <input type="hidden" name="post_type[]" value="st_kb" />
      </form>

</div>
<!-- /#live-search -->
<?php } ?>

</div>
</div>
<!-- /#page-header -->
<?php } ?>


<?php	
if (of_get_option('st_hpblock') == '2col') { 
$st_hpblock_col = 'col-half';
} elseif (of_get_option('st_hpblock') == '3col') {
$st_hpblock_col = 'col-third';
} elseif (of_get_option('st_hpblock') == '4col') {
$st_hpblock_col = 'col-fourth';
} else {
$st_hpblock_col = 'col-third';
}

$args = array(
	 				'post_type' => 'st_hpblock',
					'posts_per_page' => '-1',
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
		$wp_query = new WP_Query($args);
		if($wp_query->have_posts()) : ?>
        
<!-- #features-list -->

<div id="features-list">
<div class="ht-container">
<div class="row stacked">
        
        <?php while($wp_query->have_posts()) : $wp_query->the_post(); ?>

      <div class="column <?php echo $st_hpblock_col ?>">
      
      <?php if ( get_post_meta( $post->ID, '_st_hpblock_link', true ) ) { ?><a href="<?php echo get_post_meta( $post->ID, '_st_hpblock_link', true ); ?>"><?php } ?>
      <?php if ( get_post_meta( $post->ID, '_st_hpblock_icon', true ) ) { ?>
        <div class="feature-icon"><img alt="" src="<?php echo get_post_meta( $post->ID, '_st_hpblock_icon', true ); ?>" /></div>
       <?php } ?>
        <h3><?php the_title(); ?></h3>
   		<?php if ( get_post_meta( $post->ID, '_st_hpblock_link', true ) ) { ?></a><?php } ?>
        <?php if ( get_post_meta( $post->ID, '_st_hpblock_text', true ) ) { ?>
        <p><?php echo get_post_meta( $post->ID, '_st_hpblock_text', true ); ?></p>
        <?php } ?>
      </div>
<?php endwhile; ?>
</div>
</div>
</div>
<!-- /#features-list -->
<?php endif; wp_reset_postdata(); ?>


<?php
// Show homepage content if it's present
$post = get_page($st_front_id);
$content = apply_filters('the_content', $post->post_content);
if ($content != '') { ?>
<!-- #homepage-content -->
<div id="homepage-content">
<div class="ht-container">
<?php echo $content; ?>
</div>
</div>
<!-- /#homepage-content -->
<?php } ?>

<!-- #primary -->
<div id="primary" class="sidebar-<?php echo $st_hp_sidebar_position; ?> clearfix"> 
<div class="ht-container">
  <!-- #content -->
  <section id="content" role="main">

    
<?php if ( is_active_sidebar( 'st_sidebar_homepage_widgets' ) ) { ?>
    <div id="homepage-widgets" class="row stacked">
    <?php dynamic_sidebar( 'st_sidebar_homepage_widgets' ); ?>
    </div>
<?php } ?>
    
</section>
<!-- /#content -->

<?php if ($st_hp_sidebar_position != 'off') {
  get_sidebar('homepage');
  } ?>

</div>
</div>
<!-- /#primary -->

<?php get_footer(); ?>