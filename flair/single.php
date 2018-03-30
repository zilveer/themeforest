<?php 
	get_header(); 
	the_post();
	
	$sidebar = get_option('single_show_sidebar', '1');
	$class = ( '1' == $sidebar ) ? 'col-md-8': 'col-md-12';
?>
		
<div id="home" class="pad90"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-lg-12">
		
			<?php get_template_part('inc/content', 'blogtitle'); ?>
	
			<div class="row">
				
				<div class="pad30"></div>
				
				<div class="<?php echo $class; ?>">
					
					<?php 
						get_template_part('postformats/format', get_post_format());
						the_title('<h1 class="blog-title">', '</h1>');
						get_template_part('loop/content', 'meta');
					?>
						
					<!-- post -->			
					<div class="post">
					
						<?php 
							the_content(); 
							wp_link_pages();
							
							if( get_option('blog_author','1') == 1 )
								get_template_part('inc/content', 'author');
	
							if( comments_open() )
								comments_template();
						?>  
					
					</div>
					<!--.post-->
				                
				</div>
				<!--/col-md-8-->
				
				<?php 
					if( '1' == $sidebar )
						get_sidebar(); 
				?>
			
			</div>
			<!--/row-->
			
			<div class="pad45"></div>
	
		</div>
	</div>
</div>
					
<?php get_footer();