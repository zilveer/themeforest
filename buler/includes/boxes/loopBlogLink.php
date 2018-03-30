<?php global $pmc_data, $sitepress; 
$postmeta = get_post_custom(get_the_id()); 
if(isset($postmeta["link_post_url"][0])){
	$link = $postmeta["link_post_url"][0];
} else {
	$link = "#";
}
?>

	<div class="entry">
		<div class = "meta">
			<div class="topLeftBlog">	
				<h2 class="title"><a href="<?php echo $link  ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class = "post-meta">
					<?php the_time('F j, Y') ?> <?php echo pmc_translation('translation_by','By: ') ?> <?php echo get_the_author_link() ?>
				</div>	
			</div>
			<div class="blogContent">
				<div class="blogcontent"><?php echo shortcontent('[', ']', '', $post->post_content ,300);?> ...</div>
				<a class="blogmore" href="<?php echo $link  ?>"><?php echo pmc_translation('translation_morelinkblog','Read more about this...'); ?> </a>
			</div>
		</div>		
	</div>	