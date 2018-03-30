<div class="sixcol first">
        
    <div class="sixcol first">
    
        <h3><?php _e('Pages','themnific');?></h3>
    
        <ul class="error"><?php wp_list_pages("title_li=&depth=2"); ?></ul>
    
    </div>
    
    <div class="sixcol">
    
        <h3><?php _e('Categories','themnific');?></h3>
        
        <ul class="error"><?php wp_list_categories("title_li=&depth=2"); ?></ul>
        
    </div>    
                
</div>            

<div class="sixcol">

    <h3><?php _e('All Blog Posts','themnific');?>:</h3>
    
    <ul style="list-style:decimal inside">
    
		<?php $archive_query = new WP_Query('showposts=1000'); while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
        
        <li style="margin-bottom:10px">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
        </li>
    
        <?php endwhile; ?>
        
    </ul>
</div>