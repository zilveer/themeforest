<h3 class="spd-heading"><?php _e('Project Details','smooththemes'); ?></h3>
<ul class="project-detail-list">
    <?php if($st_page_options['portfolio_date']):
       // if(preg_match('/^[]'))
       
         $p_date =  $st_page_options['portfolio_date'];
        
     ?>
    <li><strong><?php _e('Date','smooththemes'); ?></strong><?php  echo esc_html($p_date); ?></li>
    <?php endif; ?>
     <?php if($st_page_options['portfolio_client']): ?>
    <li><strong><?php _e('Client','smooththemes'); ?></strong><?php  echo esc_html($st_page_options['portfolio_client']); ?></li>
    <?php endif; ?>
    
     <?php if($st_page_options['portfolio_skills']): ?>
    <li><strong><?php _e('Skills','smooththemes'); ?></strong><?php  echo esc_html($st_page_options['portfolio_skills']); ?></li>
    <?php endif; ?>
   
   <?php echo get_the_term_list( $post->ID, 'portfolio_tag', '<li><strong>'.__('Tags','smooththemes').'</strong>', ', ', '</li>' ); ?> 
</ul>
<?php if($st_page_options['portfolio_website']):
    $url = parse_url($st_page_options['portfolio_website']);
    if($url['host']!=''){
        $link = $url['host'];
    }else{
        $link =esc_html($st_page_options['portfolio_website']);
    }
 ?>
<a class="btn small" href="<?php echo esc_attr($st_page_options['portfolio_website']); ?>"><?php echo __('Visit','smooththemes').' '.$link; ?></a>
<?php endif; ?>