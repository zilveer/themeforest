<div class="blog-post">
    <h1 class="page_title">
      <?php the_title(); ?>
    </h1>
    <hr />
     <hr />
     
    <?php the_content();?>
  </div>
  <?php

if(get_opt('_portfolio_comments')=='on'){  ?>
  <div id="comments">
    <?php 

comments_template();  ?>
  </div>
  <?php } ?>

</div>
