<?php
/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */
get_header(); ?>
<section id="midsection" class="container">
<div class="row">
 
	<div class="span12" id="content">
		<div class="row-fluid">
        	 <div class="row-fluid">  
             <div class="breadcrumb">
        
        <a href="<?php echo home_url()?>"><?php echo __('Home', 'sellya' );?></a>
        &raquo; <a href="<?php the_permalink();?>"><?php echo __('The page you requested cannot be found.', 'sellya' );?></a>
      </div>
      <div class="row-fluid 404">
        <span class="span4 word">4</span>
        <span class="span4 word">0</span>
        <span class="span4 word">4</span>
      </div>
    
  <h1><?php echo __('The page you requested cannot be found!', 'sellya' );?></h1>
  <div class="content"<?php echo __('The page you requested cannot be found.', 'sellya' );?></div>
  <div class="buttons">
    <div class="right"><a class="button" href="<?php echo home_url()?>"><?php echo __('Continue', 'sellya' );?></a></div>
  </div>
  </div>
	</div>

</div>
</section>
<?php get_footer(); ?>