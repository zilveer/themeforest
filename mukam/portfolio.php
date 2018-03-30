<?php 
/* Template Name: Portfolio Template */ 
?> 
<?php get_header();
      query_posts('post_type=portfolio&paged='.$paged);  
?>
	<?php
    $homeLink =  home_url(); 
    if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
    } 
	$header_style = get_option_tree('header_style',$theme_options);
          if ( $header_style == "header_style_1" || $header_style == ""): 
            $headertype = "header-1";
          elseif ( $header_style == "header_style_2"): 
            $headertype = "header-2";
          elseif ( $header_style == "header_style_3" ):
            $headertype = "header-4";
          elseif ( $header_style == "header_style_4" ):
            $headertype = "header-3";
          elseif ( $header_style == "header_style_5" ):
            $headertype = "header-5";
          elseif ( $header_style == "header_style_6" ):
            $headertype = "shopheader";
          elseif ( $header_style == "header_style_7" ):
            $headertype = "header-7";
          elseif ( $header_style == "header_style_8" ):
            $headertype = "header-6";
          endif;

    $animy2 = $animy3 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {
      
      $animy2 = ' fadein scaleInv anim_2';
      $animy3 = ' fadein scaleInv anim_3'; 
    } 
     
    ?>
  
<section class="mukam-waypoint" data-animate-down="mukam-header-small <?php echo $headertype; ?>" data-animate-up="mukam-header-large <?php echo $headertype; ?>">
	<div class="caption-out<?php echo $animy2;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-9 caption">
          <h3><?php print $portfolio_header = get_option_tree('portfolio_header',$theme_options);?></h3>
          <p><?php print $portfolio_caption = get_option_tree('portfolio_caption',$theme_options);?></p>
        </div>
        <div class="col-md-3 breadcrumb">
        <ul class="breadcrumb"><li><a href="<?php echo $homeLink; ?>"><?php echo __('Home', 'mukam');?></a></li><li><?php print $portfolio_header = get_option_tree('portfolio_header',$theme_options);?></li></ul>
        </div>
      </div>
    </div>
    </div>
	<!-- Portfolio Content Start -->	
	
    <div class="bg-color grey<?php echo $animy3;?>">
      <div class="container">
        <div class="row">
          <?php $portfolio_template = get_option_tree('portfolio_style',$theme_options);
          if ( $portfolio_template == "portfolio_classic" || $portfolio_template == ""): 
            get_template_part( 'includes/portfolio/portfolio', 'classic' ); 
          elseif ( $portfolio_template == "portfolio_grid"): 
            get_template_part( 'includes/portfolio/portfolio', 'grid' ); 
          elseif ( $portfolio_template == "portfolio_leftsidebar" ):
            get_template_part( 'includes/portfolio/portfolio', 'leftsidebar' );
          elseif ( $portfolio_template == "portfolio_rightsidebar" ):
            get_template_part( 'includes/portfolio/portfolio', 'rightsidebar' );
          elseif ( $portfolio_template == "portfolio_detail" ):
            get_template_part( 'includes/portfolio/portfolio', 'detail' );       
          endif;
          ?>
        </div>
      </div>
    </div>
	
</section>
<?php wp_reset_query();?>
<?php get_footer();?>