<?php get_header(); ?> 
<?php setPostViews(get_the_ID()); ?>
<div class="container">
        <div id="homecontent">
               	<?php get_template_part('single-s-right' ); ?>
        </div><!-- #homecontent -->
</div>
<?php get_footer(); ?>