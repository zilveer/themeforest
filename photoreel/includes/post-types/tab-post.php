<div class="tab-post">

	  <?php if ( has_post_thumbnail()) : ?>
      
           <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" >
           
           		<?php the_post_thumbnail( 'w-featured',array('title' => "")); ?>
                
           </a>
           
      <?php endif; ?>
          
      <h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo tmnf_icon() ?> <?php echo short_title('...', 14); ?></a></h3>
      
      <p class="meta">
      
          <i class="icon-time"></i> <?php the_time('M j') ?> | 
          <i class="icon-comments-alt"></i> <?php comments_number('0 ', '1 ', '% '); ?>
      
      </p> 
        
</div>