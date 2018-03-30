<?php
/*
* Template Name: Product Categories
*
*/

global $smof_data;

get_header(); 

?>
<section id="midsection" class="container">
	<div class="row"> 
        <div id="content-home" class="span12">
        	<?php sellya_product_category_markup();?>
		</div><!--#content-home -->
	</div><!--.row -->
</section><!--#midsection -->
<?php get_footer(); ?>