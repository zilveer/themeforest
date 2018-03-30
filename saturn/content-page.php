<article id="<?php the_ID();?>" <?php post_class();?>>
<?php 
if( has_post_thumbnail() ){
	?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink();?>"><?php print get_the_post_thumbnail( get_the_ID(), apply_filters( 'saturn_thumbnail_size' , 'full') );?></a>
		</div>
	<?php 
	}
?>
	<div class="post-header">
		<?php if( is_page() ):?>
			<h1 class="post-title"><?php the_title();?></h1>
		<?php else:?>
			<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<?php endif;?>
	</div><!-- end post header -->
	<div class="post-content">
		<?php the_content( __( 'Continue reading <span class="readmore">&rarr;</span>', 'saturn' ) );?>
	</div>
</article><!-- end page -->