<?php 
global $lb_opc;
get_header();
the_post(); 
?>

 <div class="bg" style="text-align: left">
    <div class="container">
            <h2><span class="lines"><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></span></h2>
        		
	<?php if ( $lb_opc ['blog_fullwidth'] == "1") { ?>
		<div class="eleven columns blog-bg">
	<?php } else { ?>	
            <div class="sixteen columns blog-bg">	
	<?php } ?>

            <div class="single">
                  <?php the_content();?>
                  <?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','LB').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                  <div class="tags">
                     <?php the_tags(esc_attr('Tags: ', 'LB') . '<div class="button1">', '</div> <div class="button1">', '</div><br />'); ?> 
                  </div>
                  <?php 
                  edit_post_link(); 
                  comments_template('', true);?>
             </div>		 
        </div> <!-- end sixteen columns -->	

        <!-- start sidebar -->
	<?php if ( $lb_opc ['blog_fullwidth'] == "1") { ?>

		<div class="four columns sidebar blog-bg">
            <?php  
                dynamic_sidebar("Right sidebar");
            ?>
        </div>

	<?php } else { ?>		
	<?php } ?>
        <!-- end sidebar -->
            		 
    </div>
</div>
<?php get_footer();?>