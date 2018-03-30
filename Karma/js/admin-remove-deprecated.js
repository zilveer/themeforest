/**
 *
 * Hides deprecated page templates and meta boxes
 * no longer required by Karma 4.0+
 *
 * @since Karma 4.0
 */

jQuery(document).ready(function(){

    //hide old page templates from dropdown-list
	jQuery("select[name='page_template'] option[value='template-homepage-3D.php']").remove();
	jQuery("select[name='page_template'] option[value='template-homepage-full-width.php']").remove();
	jQuery("select[name='page_template'] option[value='template-homepage-jquery.php']").remove();
	jQuery("select[name='page_template'] option[value='template-homepage-jquery-2.php']").remove();
 	jQuery("select[name='page_template'] option[value='template-portfolio-1-column.php']").remove();
	jQuery("select[name='page_template'] option[value='template-portfolio-1-column-portrait.php']").remove();
	jQuery("select[name='page_template'] option[value='template-portfolio-2-columns.php']").remove();   
	jQuery("select[name='page_template'] option[value='template-portfolio-3-columns.php']").remove();     	
	jQuery("select[name='page_template'] option[value='template-portfolio-3-columns-portrait.php']").remove(); 
	jQuery("select[name='page_template'] option[value='template-portfolio-3D.php']").remove();     	
	jQuery("select[name='page_template'] option[value='template-portfolio-4-columns.php']").remove();  
	
	//hide old meta box from 'Pages'
	jQuery(".cmb_id_truethemes_nonfilter_heading").css('display','none');
	jQuery(".cmb_id__multiple_portfolio_cat_id").css('display','none');
	jQuery(".cmb_id__sc_port_count_value").css('display','none');

    //hide old meta box from 'Posts'
    jQuery("#b_tabbed_meta_box_new-meta-boxes").css('display','none');

});