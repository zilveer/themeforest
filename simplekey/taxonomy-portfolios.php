<?php 
global $VAN;
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), 
get_query_var( 'taxonomy' ) );
?>

<div id="container">

    <!--Blog Archive-->
    <section id="content" class="page-area">
       <div class="wrapper">
           <header class="title">
              <h1><?php printf( __( '%s', 'SimpleKey' ), '<strong>' . $term->name . '</strong>' );?></h1>
              <p><?php printf( __( '%s', 'SimpleKey' ), '<strong>' . $term->description . '</strong>' );?></p>
           </header>
       
         <?php van_categories('portfolios','',true);?>
         <?php get_template_part('content','portfolios');?> 
       </div>
    </section>
    
    <?php get_template_part('content','contact');?>
</div>
<?php get_footer();?>