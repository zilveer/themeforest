jQuery('.portfolio').isotope({
     // options
      itemSelector : '.item',
  });

  jQuery('.portfolio').isotope({ filter: "*" });

  //filtering
  jQuery('.filter a').click(function(){
    jQuery('.filter a').removeClass('selected');
      var selector = jQuery(this).attr('data-filter');
      jQuery(this).addClass('selected');
    jQuery('.portfolio').isotope({ filter: selector });
    return false;
  });