<?php if(!of_get_option('disable_newsticker')==1){?>
<div class="news_ticker_wrapper">
<div class="row">
<div class="twelve columns">
  <div id="ticker">
  <div class="tickerfloat_wrapper"><div class="tickerfloat"><?php echo esc_attr(of_get_option('news_ticker_title'));?></div></div>
   <div class="marquee" id="mycrawler">
       <?php
  $category_news_ticker_post="";
  $number_of_news_ticker= of_get_option('number_news_ticker');
  $category_news_ticker= of_get_option('news_ticker_category');
  
  if(!empty($category_news_ticker)) {
    
  foreach($category_news_ticker as $key=>$value) { if($value == 1) { $category_news_ticker_post[] = $key; } } 
  }
  
  
  $post_array = array(
            'showposts' => $number_of_news_ticker,
            'category__in' => $category_news_ticker_post,
      'ignore_sticky_posts' => 1
        );  
        $jellywp_widget = new WP_Query($post_array);
    $i=0;
     while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
      $i++;
      $post_id = get_the_ID();
      ?>    
       <div>
        <span class="ticker_dot"><i class="fa fa-chevron-right"></i></span><a class="ticker_title" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
      </div>

        <?php } wp_reset_query();?>
        
        </div>
        </div>
    
</div>

</div>
</div>
 <?php }?> 