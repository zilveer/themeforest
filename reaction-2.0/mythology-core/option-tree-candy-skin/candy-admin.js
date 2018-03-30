(function($){
$(document).ready(function() {


	// ===========================    
    // Meta-Boxes Switcher 
    // Set the page-template [select] field to toggle which meta-box shows up
    // ===========================	
	$('div#blog_template_options').hide();
    $('#page_template').change(function() {
        $('#blog_template_options').toggle($(this).val() == 'template-blog.php');
    }).change();


    // ===========================    
    // Meta-Boxes Switcher 
    // Set the page-template [select] field to toggle which meta-box shows up
    // ===========================  
    $('div#skeleton_grid_template_options').hide();
    $('#page_template').change(function() {
        $('#skeleton_grid_template_options').toggle($(this).val() == 'template-post-grid.php');
    }).change();

    		  
    // ===========================    
    // OptionTree Accordion Script
    // ===========================    

    // Hide all descriptions for OptionTree (setting)
    $('.format-setting .description').hide();
    
    // Show the main heading descriptions ONLY
    $('.appearance_page_ot-theme-options .type-textblock.titled .description').show();
    $('.list-sub-setting .description').show();
    $('.toplevel_page_ot-settings .description').show();
    $('.optiontree_page_ot-documentation .description').show();

    $('#setting_customscripts .description').show();
    $('#setting_customcss .description').show();
    
    // Now set the accordion script - when you click the option-module's heading, the description opens.
    $('.appearance_page_ot-theme-options .format-setting-label').each(function(){
	  var $content = $(this).closest('.format-settings').find('.format-setting .description');
	  $(this).click(function(e){
	    e.preventDefault();
	    $content.not(':animated').slideToggle(200);
	  });
	});

    $('.post-php .format-setting-label').each(function(){
      var $content = $(this).closest('.format-settings').find('.format-setting .description');
      $(this).click(function(e){
        e.preventDefault();
        $content.not(':animated').slideToggle(200);
      });
    });

    $('.post-new-php .format-setting-label').each(function(){
      var $content = $(this).closest('.format-settings').find('.format-setting .description');
      $(this).click(function(e){
        e.preventDefault();
        $content.not(':animated').slideToggle(200);
      });
    });
  
});
})(jQuery);