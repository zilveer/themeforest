<?php if (!(isset($_POST["ishome"]) && $_POST["ishome"] == 1)) 
	$firmIsPage = true;


if ($firmIsPage) {
?>
	<?php get_header(); ?>

<?php }; ?>

<?php
$pagelist = get_pages('sort_column=menu_order&sort_order=asc');
$pages = array();
foreach ($pagelist as $page) {
   $pages[] += $page->ID;
}

$current = array_search($post->ID, $pages);
$prevID = $pages[$current-1];
$nextID = $pages[$current+1];
?>


<?php if ($firmIsPage) {
?>
	<?php if ($eet_option['eetcnt_blog'] == 'Navigation with Arrows' ) { ?>
		<div id="scrolltopblog"><img src="<?php echo get_template_directory_uri(); ?>/images/arrowt.png" alt="Previous" class="scrolltopb"/></div>
	
		<div id="blogarrowrap">
	<?php } ?>
<?php } else { ?>
	<?php if ($eet_option['eetcnt_blog'] == 'Navigation with Arrows' ) { ?>
		<div class="movemento">
	<?php } ?>
<?php } ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="postwrap">
		<?php if (has_post_thumbnail()) { ?>
		<?php $thumb = get_post_thumbnail_id(); $image = vt_resize( $thumb,'' , 240, 175, true ); ?>
			<div class="postimg">
				<img  class="imghBXinner" src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>" />
			</div>
			<div class="postcontentshort">
				<div class="postcontentwrap">
					<a href="<?php the_permalink(); ?>" style="text-decoration: none;"><h1><?php the_title(); ?></h1></a>
					<span><?php the_time('M j, Y') ?></span><span> &#124; <?php the_author(); ?></span><span> &#124; <?php the_category(', ') ?></span>
					<p><?php echo substr(get_the_excerpt(), 0, 250); ?></p>
				</div>
			</div>
			<div class="clearfix"></div>
		<?php } else { ?>
		<div class="postcontentwrap">
			<h1><?php the_title(); ?></h1>
			<span><?php the_time('M j, Y') ?></span><span> &#124; <?php the_author(); ?></span><span> &#124; <?php the_category(', ') ?></span>
			<p><?php echo substr(get_the_excerpt(), 0, 250); ?></p>
		</div>
		<?php }; ?>
		<a href="<?php the_permalink(); ?>"><div class="readmoreinner"><span><?php echo $eet_option['eetcnt_tr_rm'] ?></span></div></a>
	</div>
	<?php endwhile; else: ?>
	<?php endif; ?>

<p class="prevprev" style="display:none;"><?php previous_posts_link();  ?></p>	
<p class="nextprev" style="display:none;"><?php next_posts_link();  ?></p>
<?php
	$current_page = $wp_query->get( 'paged' );
	if ( ! $current_page ) {
	    $current_page = 1;
	}
	if ( $current_page == $wp_query->max_num_pages ) {
	    ?> <p class="checker" style="display:none">do</p> <?php
	}
	
?>
<?php if ($firmIsPage) {
?>
<?php if ($eet_option['eetcnt_blog'] == 'Navigation with Arrows' ) { ?>
	</div>

<div id="scrollbotblog"><img src="<?php echo get_template_directory_uri(); ?>/images/arrowb.png" alt="Next" class="scrollbotb" rel="<?php echo get_the_title($nextID); ?>"/></div>
<?php }; ?>
<?php } else {
?>
	<?php if ($eet_option['eetcnt_blog'] == 'Navigation with Arrows' ) { ?>
	</div>
	<?php }; ?>
<?php }; ?>
	
    <?php
    if (($eet_option['eetcnt_blog'] == 'Numbered Navigation') && $wp_query->max_num_pages > 1 ) { 
        elentech_pagination();
    };
    ?>
<?php if ($firmIsPage) { ?>

	<?php get_footer(); ?>
<?php }; ?>