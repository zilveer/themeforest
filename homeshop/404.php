<?php
 // Template Name: 404
?>

<?php
get_header(); 

$tt = '404';
if(get_option('sense_text_top') && get_option('sense_text_top') != '') {
$tt = get_option('sense_text_top');
}
?>

<section class="main-content col-lg-12 col-md-12 col-sm-12">

 <div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php echo $tt;?></h4>
			</div>
			
			<div class="page-content">
  		   
		 
		  <?php echo stripslashes(get_option('sense_text_bottom'));?>
		 
   
			</div>
                            
		</div>
		  
	</div>

 </section>
	<!-- /Main Content -->



<?php get_footer(); ?>

