;( function( $, window, document, undefined ) {

	var defaults = {
	};

	function product_control( element, options ) {

		element.config = $.extend( {}, defaults, options );
		element.pagination_links = element.find( '.product-page-pagination span.page-link' );
		element.sortables = element.find( '.sortable' );
		element.pages = element.find( '.page' );
		element.add = element.find( '.add' );
		element.data = element.find( '.category-data' );
		element.structure = element.find( '.structure' );
		element.add_page = element.find( '.add_page' );
		element.delete_page = element.find( '.delete-page' );
		element.new_category = element.find( '.new-category' );
		element.find('.new-category-container').hide();
		element.category_select = element.new_category.find('select');

	}

	$.fn.product_control = function( options ) {

		new product_control( this, options );
		var element = this;
		manage_empties();
		manage_delete_links();

        element.sortables.sortable({
            connectWith: ".sortable",
            placeholder: "placeholder",
            tolerance: 'intersect'
        });
        element.sortables.disableSelection()


        // Pagination

        element.pagination_links.live( 'click', function() {
	        index = $(this).index();
	        element.pagination_links.removeClass('current');
	        $(this).addClass('current');
	        element.pages.eq( index ).show();
	        element.pages.not(':eq('+index+')').hide();
        })



        // Remove Categories
        element.find( 'span.remove' ).live( 'click', function() {
	        $( this ).parents('.category').fadeOut( function() {
		        $( this ).remove();
		        update_structure();
	        });
        })

        // Add Category
        	// Displaying the choser
	        element.add.live( 'click', function(){
		        $(this).before( element.new_category );
	        })

	        // Selecting and inserting a category
	        element.category_select.live( 'change', function() {
		    	category_id = $( this ).val();
		    	category_box = element.data.find( '.category[data-id="' + category_id + '"]' ).clone();
		    	$( this ).parents( '.page-side' ).find( '.sortable' ).append( category_box )

		    	update_structure();

		    	$(this).find( 'option' ).removeAttr('selected')
		    	$(this).trigger('liszt:updated');
		    	element.find( '.new-category-container' ).append( element.new_category )
	        })


	    // Add a page
	    element.add_page.live('click', function() {
		    var pages = element.pagination_links.length;
		    var new_page_link = element.pagination_links.last().clone().removeClass('current');
		    new_page_link.html( pages + 1 );
		    new_page_link.insertAfter( element.pagination_links.last() );

		    var new_page = $( '<div class="page"><div class="delete-page-container"><span class="delete-page">delete page</span></div><div class="page-side left"><div class="sortable"></div><span class="button-primary add">+ add category</span></div><div class="page-side right"><div class="sortable"></div><span class="button-primary add">+ add category</span></div><div class="clear"></div></div>' );
		    $( '.product-page-content' ).append( new_page )
		    new_page.hide();

		    update_pagination_links();
		    update_pages();

		    update_structure()
	    })

	    // Delete a page
	    element.delete_page.live( 'click', function() {
		    var page = $( this ).parents( '.page' )
		    var index = page.index();
		    element.pagination_links.eq( index ).remove();
	        element.pages.eq( index ).remove();

	        toShow = ( index - 1 );
	        if( index == 0 ) {
	        	toShow = 0;
	        }

		    update_pagination_links();
		    update_pages();

	        element.pages.eq( toShow ).show()
	        element.pagination_links.eq( toShow ).addClass('current')


		    manage_delete_links();
		    update_structure();
	    })

        // Updating the structure

        function update_structure() {
        	structure = get_structure();
	        element.structure.val( serialize( structure ) )
	        manage_empties();
        }

        // Only show delete links if there is more than one page
        function manage_delete_links() {
	    	if( element.pages.length > 1 ) {
	    		element.find( '.delete-page' ).show();
	    	}
	    	else {
	    		element.find( '.delete-page' ).hide();
	    	}
        }

        // Add empty notices

        function manage_empties() {
	        $.each( $('.page-side .sortable'), function() {
	        	if( $( this ).find( '.category' ).length == 0 && $( this ).find( '.no-products' ).length == 0 ) {
	        		$( this ).prepend( '<div class="no-products">click on the button below to add a category box</div>' );
	        	}
	        	else if( $( this ).find( '.category' ).length > 0 ) {
	        		$(this).find('.no-products').remove();
	        	}
	        })
        }


        function get_structure() {
        	var structure = [];
        	$.each( element.pages, function( i ) {
        		structure[i] = [];
	        	structure[i]['left'] = [];
	        	structure[i]['right'] = [];
	        	$.each( $( this ).find( '.left .category' ), function(){
		        	structure[i]['left'].push( $(this).attr('data-id') );
	        	})
	        	$.each( $( this ).find( '.right .category' ), function(){
		        	structure[i]['right'].push( $(this).attr('data-id') );
	        	})
        	})
        	return structure;
        }


        function update_pagination_links() {
        	$.each( element.pagination_links, function( index ) {
	        	$(this).html( ( $(this).index() + 1 ) )
        	})
	        element.pagination_links = element.find( '.product-page-pagination span.page-link' )
        }

        function update_pages() {
        	element.pages = element.find( '.page' );
        }

	};

})( jQuery, window, document );


function serialize (mixed_value) {
  // http://kevin.vanzonneveld.net
  // +   original by: Arpad Ray (mailto:arpad@php.net)
  // +   improved by: Dino
  // +   bugfixed by: Andrej Pavlovic
  // +   bugfixed by: Garagoth
  // +      input by: DtTvB (http://dt.in.th/2008-09-16.string-length-in-bytes.html)
  // +   bugfixed by: Russell Walker (http://www.nbill.co.uk/)
  // +   bugfixed by: Jamie Beck (http://www.terabit.ca/)
  // +      input by: Martin (http://www.erlenwiese.de/)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net/)
  // +   improved by: Le Torbi (http://www.letorbi.de/)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net/)
  // +   bugfixed by: Ben (http://benblume.co.uk/)
  // %          note: We feel the main purpose of this function should be to ease the transport of data between php & js
  // %          note: Aiming for PHP-compatibility, we have to translate objects to arrays
  // *     example 1: serialize(['Kevin', 'van', 'Zonneveld']);
  // *     returns 1: 'a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}'
  // *     example 2: serialize({firstName: 'Kevin', midName: 'van', surName: 'Zonneveld'});
  // *     returns 2: 'a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}'
  var val, key, okey,
    ktype = '', vals = '', count = 0,
    _utf8Size = function (str) {
      var size = 0,
        i = 0,
        l = str.length,
        code = '';
      for (i = 0; i < l; i++) {
        code = str.charCodeAt(i);
        if (code < 0x0080) {
          size += 1;
        }
        else if (code < 0x0800) {
          size += 2;
        }
        else {
          size += 3;
        }
      }
      return size;
    },
    _getType = function (inp) {
      var match, key, cons, types, type = typeof inp;

      if (type === 'object' && !inp) {
        return 'null';
      }
      if (type === 'object') {
        if (!inp.constructor) {
          return 'object';
        }
        cons = inp.constructor.toString();
        match = cons.match(/(\w+)\(/);
        if (match) {
          cons = match[1].toLowerCase();
        }
        types = ['boolean', 'number', 'string', 'array'];
        for (key in types) {
          if (cons == types[key]) {
            type = types[key];
            break;
          }
        }
      }
      return type;
    },
    type = _getType(mixed_value)
  ;

  switch (type) {
    case 'function':
      val = '';
      break;
    case 'boolean':
      val = 'b:' + (mixed_value ? '1' : '0');
      break;
    case 'number':
      val = (Math.round(mixed_value) == mixed_value ? 'i' : 'd') + ':' + mixed_value;
      break;
    case 'string':
      val = 's:' + _utf8Size(mixed_value) + ':"' + mixed_value + '"';
      break;
    case 'array': case 'object':
      val = 'a';
  /*
        if (type == 'object') {
          var objname = mixed_value.constructor.toString().match(/(\w+)\(\)/);
          if (objname == undefined) {
            return;
          }
          objname[1] = this.serialize(objname[1]);
          val = 'O' + objname[1].substring(1, objname[1].length - 1);
        }
        */

      for (key in mixed_value) {
        if (mixed_value.hasOwnProperty(key)) {
          ktype = _getType(mixed_value[key]);
          if (ktype === 'function') {
            continue;
          }

          okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
          vals += this.serialize(okey) + this.serialize(mixed_value[key]);
          count++;
        }
      }
      val += ':' + count + ':{' + vals + '}';
      break;
    case 'undefined':
      // Fall-through
    default:
      // if the JS object has a property which contains a null value, the string cannot be unserialized by PHP
      val = 'N';
      break;
  }
  if (type !== 'object' && type !== 'array') {
    val += ';';
  }
  return val;
}
