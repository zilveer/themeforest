<?php
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_title = $of_option[$prefix.'tr_clients_title'];
}else{			
	$tr_title = __('Our Clients', 'spacing');	
}
$id = $of_option[$prefix.'recent_work_url'];
$url = get_permalink($id);
?>
    
    <!-- Clients List Begin-->
	<div class="divider title divider-homepage"><span><?php echo $tr_title ?></span></div>
	
	<div id="clients" class="container">
    
    	<div class="thumbnails-holder">
        <?php wp_reset_query(); query_posts('post_type=clients&orderby=menu_order&order=ASC&posts_per_page=6'); if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="columns one-sixth">    
    
            <a <?php portfolio_post_href(1); ?>>
            
                <div class="clients-logo-holder">
                <?php 
					$url = get_post_meta($post->ID, 'client_url', true); 
					if($url) echo '<a href="'.$url.'">';

				?>
                <?php the_post_thumbnail('one-half', array('title' => '')); ?>
                <?php if($url) echo '</a>'; ?>
                </div>
                
            </a>
                    
                    
        </div>
        <?php endwhile; endif; wp_reset_query(); ?>  
        </div>      
   	
    </div>
	<!-- Clients List End-->