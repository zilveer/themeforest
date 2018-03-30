//This script is only enqueued into WordPress admin page editor, if Sterling 2.2 is activated from Site Option.
//this script removes a list of old homepage and old portfolio template names from WordPress page editor Page Attributes metabox, Template select dropdown.
//add or remove any template file name from the list below to show or hide page template from dropdown.
    jQuery(document).ready(function(){
    	jQuery("select[name='page_template'] option[value='page-template-gallery-2col.php']").remove();
    	jQuery("select[name='page_template'] option[value='page-template-gallery-3col.php']").remove();
    	jQuery("select[name='page_template'] option[value='page-template-gallery-3col-portraits.php']").remove();
    	jQuery("select[name='page_template'] option[value='page-template-gallery-4col.php']").remove();
     	jQuery("select[name='page_template'] option[value='page-template-gallery-4col-portraits.php']").remove();
    	jQuery("select[name='page_template'] option[value='page-template-home-jquery.php']").remove();   	    	   		
    });