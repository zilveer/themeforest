
<div class="content clearfix">
 <?php
  if(have_posts()): while(have_posts()) : the_post(); ?>
             <?php  include(ST_TEMPLATE_DIR.'loop/loop-post.php');?>
 <?php endwhile; ?>
 
  <div class="pagination pagination-right text-right t40">
  <?php st_post_pagination(); ?>
  </div>
  <?php else : ?>
    <?php // not found ?>
 <?php endif  ?>
 
 
</div>