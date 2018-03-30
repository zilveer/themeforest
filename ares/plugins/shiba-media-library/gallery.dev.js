jQuery(document).ready(function($) {
	var gallerySortable, gallerySortableInit, desc = false;

	gallerySortableInit = function() {
		gallerySortable = $('#the-list').sortable( {
			items: 'tr',
			placeholder: 'sorthelper',
			axis: 'y',
			distance: 2
		} );
	}

	 addNewArg = function(name, value) { 
		var newArg = document.createElement("input");
		newArg.type = "hidden";
		newArg.name = name;
		newArg.value = value;
		newArg.id = name;
		return newArg;
	},
	
	getGalleryMeta = function(gallerySet, galleryList) {
		var galleryListForm=document.getElementById(galleryList);
		var gallerySetForm=document.getElementById(gallerySet);
		
		var formElements = galleryListForm.elements;
		for (i = 0; i < formElements.length; i++) {
			if (formElements[i].name == "media[]") {
				gallerySetForm.appendChild(addNewArg("media[]", formElements[i].value));
			}		
		}
		
	}

	// initialize sortable
	gallerySortableInit();
	jQuery('#submitdiv #publish').click(function(e) {
		getGalleryMeta('post', 'gallery-list');
	});

});

