<?php
/*
 Template Name: Featured page
 Displays the posts from a category that is set to be featured.
 */

get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		
		//get all the page meta data (settings) needed (function located in lib/functions/meta.php)
		$page_settings=pexeto_get_post_meta($post->ID, array('slider','layout','sidebar', 'show_title', 'featured_category','featured_post_number'));
		
		//create a data object that will be used globally by the other files that are included
		$pex_page=new stdClass();
		$pex_page->layout=$page_settings['layout'];
		$pex_page->slider=$page_settings['slider'];
		$pex_page->sidebar=$page_settings['sidebar'];
		$pex_page->hide_thumbnail=false;
		$pex_page->excerpt=true;

		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
		
		wp_reset_postdata();
	 
		if($post->post_content || $page_settings['show_title']=='on'){ ?>
		<div class="page-content-box">
			<?php if($page_settings['show_title']=='on'){?>
	    	<h1 class="page-heading posts-heading"><?php the_title(); ?></h1><div class="double-line"></div>	
	  		<?php } ?>
	  		
			
			<?php the_content(); ?>
		</div>
	<?php }
	}
}
?>
<div id="blog-latest" class="featured-posts">
<?php 
$paged = get_query_var('paged');
if(!$paged){
	$paged=get_query_var('page');
}
$args=array('posts_per_page' =>$page_settings['featured_post_number'], 'ignore_sticky_posts'=>true, 'paged' => $paged);
if(isset($page_settings['featured_category']) && $page_settings['featured_category'] && $page_settings['featured_category']!='-1'){
   $args['cat']=$page_settings['featured_category'];
}
query_posts($args);

$closed=true;
if(have_posts()){
	$i=0;
	while(have_posts()){
		the_post();
		global $more;
		$more = 0;
		
	if($i==0){
		?><div class="featured-post-big"><?php
		locate_template( array( 'includes/post-template.php'), true, false );
		?></div><?php
	}else{
	
	$right = $i%2==0?' latest-small-right':''; 
	
	if($right==''){
		$closed=false;
	?>

	<div class="columns-wrapper">
	<?php } ?>

	 <div class="latest-small<?php echo $right;?>">
    <div class="post-content">
<p>
    <?php 
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
    if(function_exists('has_post_thumbnail') && has_post_thumbnail() && !$hideThumbnail){ 
	?><a href="<?php the_permalink(); ?>"><?php 
	$img_id=$pex_page->layout=='full'?'featured_box_img_full':'featured_box_img';
	the_post_thumbnail($img_id, array('class'=>'img-frame')); 
	?></a>
	<?php 
    }
    ?><h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php
    $excerpt = substr(get_the_excerpt(), 0, 150);
    echo $excerpt.'[...]';
    ?>
    </p>
   <a href="<?php the_permalink(); ?>" class="read-more"><?php echo(pex_text('_read_more')); ?><span class="more-arrow">&raquo;</span></a>
    
    </div>
    </div>
    <?php if($right!=''){
    $closed=true;
    	?>
    	</div>
    	<?php }?>
	<?php
	} 
	
	$i++;
	}  
}   
if(!$closed){
?>
</div>
<?php } 

print_pagination(); ?>
</div>

<?php 
//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
