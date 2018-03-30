<?php
/*
Template Name: 404
*/
?>
<?php get_header(); ?>

<div class="container">

   	<div id="homecontent">
    
        <h2 class="heading"><?php _e('Nothing found here','themnific');?></h2>
        
        <h4><?php _e('Perhaps You will find something interesting form these lists...','themnific');?></h4>
        
        <div class="entry">
        
        	<?php get_template_part('/includes/uni-404-content');?>
            
        </div>
            
    </div><!-- end #homecontent-->
        
</div>

<?php get_footer(); ?>
