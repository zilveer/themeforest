<?php 
global $VAN;
get_header();

// Hack. Set $post so that the_date() works.
$post = $posts[0]; 

//Get the value of custom category field
$cat_ID = get_cat_ID(single_cat_title('', false)); 
$cat = get_category($cat_ID);
$cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id");
$cat_headTitle=esc_attr($cat_data['headtitle']);
?>

<div id="container">

    <!--Blog Archive-->
    <section id="content" class="page-area">
       <div class="wrapper">
         <?php if(is_category()):?>
           <header class="title">
              <h1><?php if(isset($cat_headTitle) && $cat_headTitle<>''){echo $cat_headTitle;}else{esc_html_e('Archive for','SimpleKey').' <strong>'.esc_attr($cat->cat_name.'</strong>');}?></h1>
              <p><?php echo category_description();?></p>
           </header>
         <?php elseif( is_tag()):?>
           <header class="title">
              <h1><?php esc_html_e('Tagged', 'SimpleKey');?> <strong><?php single_tag_title('', true);?></strong></h1>
              <p><?php esc_html_e('Browsing all posts tagged with', 'SimpleKey');?> <?php single_tag_title('', true); ?></p>
           </header>
         <?php elseif (is_day()):?>
           <header class="title">
              <h1><?php esc_html_e('On', 'SimpleKey');?> <strong><?php echo get_the_time(__('F jS, Y', 'SimpleKey')); ?></strong></h1>
              <p><?php esc_html_e('Browsing all posts on', 'SimpleKey');?> <strong><?php echo get_the_time(__('F jS, Y', 'SimpleKey')); ?></strong></p>
           </header>
         <?php elseif (is_month()):?>
           <header class="title">
              <h1><?php esc_html_e('On', 'SimpleKey');?> <strong><?php echo get_the_time(__('F, Y', 'SimpleKey')); ?></strong></h1>
               <p><?php esc_html_e('Browsing all posts on', 'SimpleKey');?> <strong><?php echo get_the_time(__('F, Y', 'SimpleKey')); ?></strong></p>
           </header>
          <?php elseif (is_year()):?>
           <header class="title">
              <h1><?php esc_html_e('On', 'SimpleKey');?> <strong><?php echo get_the_time(__('Y', 'SimpleKey')); ?></strong></h1>
               <p><?php esc_html_e('Browsing all posts on', 'SimpleKey');?> <strong><?php echo get_the_time(__('Y', 'SimpleKey')); ?></strong></p>
           </header>
         <?php endif;?>
         
         <div class="line"></div>
         <?php get_template_part('content','loop');?> 
       </div>
    </section>
    
    <?php get_template_part('content','contact');?>
</div>
<?php get_footer();?>