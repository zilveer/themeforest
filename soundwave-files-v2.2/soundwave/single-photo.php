<?php get_header(); ?>


<div id="content">

   <div class="title-head"><h1><?php the_title(); ?></h1></div>
<?php generate_thumbnail_list(get_the_ID()); ?>  

</div><!-- end #content -->

	
<?php get_footer(); ?>
