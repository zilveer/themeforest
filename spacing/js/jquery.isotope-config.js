/*
 * ---------------------------------------------------------------- 
 *  
 *  Isotope Configuration
 *  
 * ----------------------------------------------------------------  
 */
 
jQuery(document).ready(function(){	

    jQuery(function(){
      
      var $container = jQuery('#portfolio-container');

	  
	  $container.isotope({
        itemSelector : '.portfolio-item',
        getSortData : {
          name : function ( $elem ) {
            return $elem.find('.name').text();
          }
        },
      });
      
      
      var $optionSets = jQuery('#portfolio-filters .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = jQuery(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options )
        } else {
          // otherwise, apply new options
          $container.isotope( options );
        }
        
        return false;
      });

      
    });
	
});
