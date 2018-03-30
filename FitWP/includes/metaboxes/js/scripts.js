(function($){ 
    $.fn.extend({
		
		ddMetaCheckLength: function() {
			
			//check length of the string
			var stringLength = this.children('span.item-title').text().length;
			
			if(stringLength > 30) { 
			
				this.children('span.item-title').text(this.children('span.item-title').text().substr(0, 30	)+'...');
			
			}
			
		},
		
		ddMetaInit: function() {
			
			//main vars
			var mainContId = this.attr('id');
			var mainCont = jQuery('#'+mainContId+'_ul');
			var contentCont = jQuery('#'+mainContId+'_content');
			
			//let's break the content into an array
			var mainArr = new Array();
			var contentArr = contentCont.val().split('|||');
			
			//let's add them to the lis
			for(var thisItem in contentArr) {
				
				//this items array
				var thisArr = contentArr[thisItem].split('||');
				var thisTitle = thisArr[1].split('|');
				
				//hidden content
				var hiddenArr = '';
				for(var hiddenItem in thisArr) { if(hiddenItem > 0) { var hiddenArr = hiddenArr+thisArr[hiddenItem]; if(hiddenItem < (thisArr.length - 1)) { var hiddenArr = hiddenArr+'||'; } } }
				
				mainCont.append('<li id="'+mainContId+'_'+thisItem+'"><span class="item-title">'+thisTitle[1]+'</span> <a class="edit" href="#" onclick="jQuery(this).ddListEdit(\''+mainContId+'\');"></a><a class="remove" href="#" onclick="jQuery(this).ddListRemove(\''+mainContId+'\');"></a><span class="hidden">'+hiddenArr+'</span></li>');
				
				mainCont.children('li:last').ddMetaCheckLength();
				
			}
			
		},
		
		ddMetaReSort: function() {
			
			//main vars
			var mainContId = this.attr('id');
			var mainCont = jQuery('#'+mainContId+'_ul');
			var contentCont = jQuery('#'+mainContId+'_content');
			
			//our final array
			var newArray = '';
			
			var itemsArr = jQuery('#'+mainContId).ddMetaGetItems();
			
			//let's go through item by item and make up our new array
			var i = 0; var totalLis =  mainCont.children('li').length;
			mainCont.children('li').each(function() { 
			
				//sets the new ID of the li item
				jQuery(this).attr('id', mainContId+'_'+i);
				
				//adds the id to our new array
				var thisItemNewArr = 'itemId|'+i+'||';
				
				//adds the information
				var thisItemHiddenInfo = jQuery(this).children('span.hidden').text();
				var thisItemNewArr = thisItemNewArr+thisItemHiddenInfo;
				
				//puts that into our newArray
				var thisCurrentItemArray = thisItemNewArr;
				
				//if its not the last
				if((i+1) < totalLis) { var thisCurrentItemArray = thisCurrentItemArray+'|||'; }
				
				newArray = newArray+thisCurrentItemArray;
				
				//increases our id
				i++;
			
			});
			
			//update the content text
			contentCont.val(newArray);
			
			//checks to see iful is emty
			mainCont.ddListCheckEmpty();
			
			//check length
			mainCont.children('li').each(function() { jQuery(this).ddMetaCheckLength(); });
			
		},
		
		ddMetaGetItems: function() {
			
			//main vars
			var mainContId = this.attr('id');
			
			var newArray = jQuery('#'+mainContId+'_fields').text().split('|');
			
			//returns our items array
			return newArray;
			
		},
		
		ddMetaAdd: function() {
			
			//main vars
			var mainContId = this.attr('id');
			var mainCont = jQuery('#'+mainContId+'_ul');
			var contentCont = jQuery('#'+mainContId+'_content');
			
			//let's make sure all fields are filled
			var itemsArr = jQuery('#'+mainContId).ddMetaGetItems();
			
			//error variable
			var ddListError = '';
			
			//let's loop through them
			for(var i in itemsArr) {
				
				//igonre itemId
				if(i > 0) {
					
					//let's get the field and see if it's empty
					var checkThisField = jQuery('#'+mainContId+'_'+itemsArr[i]).val();
					
					//if it's empty
					jQuery('#'+mainContId+'_'+itemsArr[i]).removeClass('ddListErrorLi');
					if(checkThisField == '') { var ddListError = ddListError+'<li>Please fill out the field "'+itemsArr[i]+'"</li>'; jQuery('#'+mainContId+'_'+itemsArr[i]).addClass('ddListErrorLi'); }
					
				}
				
			}
			
			//if there are errors
			if(ddListError != '') {
				
				//cleans the error list & appends the list of errors
				jQuery('#'+mainContId+'_errors').remove();
				jQuery('#'+mainContId+'_ul').after('<ul id="'+mainContId+'_errors" class="ddListErrors">'+ddListError+'</ul>');
				
			} else {
				
				//cleans out errors
				jQuery('#'+mainContId+'_errors').remove();
				
				//item title
				var itemTitle = jQuery('#'+mainContId+'_title').val();
				
				//out hidden content
				//let's loop through them
				var hiddenContent = '';
				for(var i in itemsArr) {
					
					//igonre itemId
					if(i > 0) {
						
						//let's get the field and see if it's empty
						var hiddenContent = hiddenContent+itemsArr[i]+'|'+jQuery('#'+mainContId+'_'+itemsArr[i]).val();
						jQuery('#'+mainContId+'_'+itemsArr[i]).val('');
						
						//adds the field separator
						if(i < (itemsArr.length - 1)) { var hiddenContent = hiddenContent+'||'; }
						
					}
					
				}
				
				//adds the item to the list at the bottom
				var thisItemHtml = '<li style="display: none;"><span class="item-title">'+itemTitle+'</span> <a class="edit" href="#" onclick="jQuery(this).ddListEdit(\''+mainContId+'\');"></a><a class="remove" href="#" onclick="jQuery(this).ddListRemove(\''+mainContId+'\');"></a><span class="hidden">'+hiddenContent+'</span></li>';
				
					//before we append let's animate ir
					//count the amout of lis so we can calculate the height
					var liCount = mainCont.children('li:not(.ddListEmpty)').length; var mainContHeight = (liCount * (28+4)); var newMainContHeight = ((liCount + 1) * (28+4));
					if(liCount === 0) { var newMainContHeight = ((1) * (28+4)); }
			
					mainCont.animate({ height: newMainContHeight+'px' }, 200, function() {
				
						//appends to our ul
						mainCont.append(thisItemHtml);
						mainCont.children('li:last').fadeIn(200);
				
						//clear nay empty warnings
						mainCont.ddListCheckEmpty();
						
						//resorts everything
						jQuery('#'+mainContId).ddMetaReSort();
						
					});
				
			}
			
		},
		
		ddListCheckEmpty: function() {
			
			//check whether or not we have Lis
			var mainCont = this;
			if(mainCont.children('li:not(.ddListEmpty)').length > 0) {
				
				//we have li's so get rid of the empty warning
				mainCont.children('li.ddListEmpty').remove();
				
			} else {
				
				//we have no more li's so add it!
				mainCont.append('<li class="ddListEmpty" style="display: none;">Hey, You don\'t any content here!</li>');
				mainCont.children('li').fadeIn(300);
				
			}
			
		},
		
		ddListRemove: function(mainContId) {
			
			var clickedItem = this;
			var mainCont = this.parent().parent();
			var liCont = this.parent();
				
			//before we append let's animate ir
			//count the amout of lis so we can calculate the height
			var liCount = mainCont.children('li').length; var mainContHeight = (liCount * (28+4)); var newMainContHeight = ((liCount - 1) * (28+4));
			if(liCount <= 1) { var newMainContHeight = ((1) * (28+4)); }
				
			//removes the item and resorts
			mainCont.css({ height: mainContHeight+'px' });
			liCont.fadeOut(300, function() {
				
				jQuery(this).remove();
				jQuery('#'+mainContId).ddMetaReSort();
				
				//animates it
				mainCont.animate({ height: newMainContHeight+'px' }, 200);
				
			});
			
		},
		
		ddListEdit: function(mainContId) {
		
			var clickedItem = this;
			var liCont = this.parent();
			var mainCont = this.parent().parent();
			
			//hidden values to put on the fields
			var hiddenValues = liCont.children('.hidden').text().split('||');
			
			//for each value we put it in the field
			for(var eachItem in hiddenValues) {
				
				//get the value
				var thisItemValue = hiddenValues[eachItem].split('|');
				
				//puts in the field if it's not itemId
				if(thisItemValue[0] != 'itemId') {
					
					jQuery('#'+mainContId+'_'+thisItemValue[0]).val(thisItemValue[1]);
					
				}
				
			}
				
			//removes the editing item from the list
			var liCount = mainCont.children('li').length; var mainContHeight = (liCount * (28+4)); var newMainContHeight = ((liCount - 1) * (28+4));
			if(liCount <= 1) { var newMainContHeight = ((1) * (28+4)); }
			liCont.fadeOut(200, function() {
				
				//animates the ul container
				mainCont.css({ height: mainContHeight+'px' });
				mainCont.animate({ height: newMainContHeight+'px' }, 200);
				
				//remove it
				jQuery(this).remove();
				
				//resorts it
				jQuery('#'+mainContId).ddMetaReSort();
				
			});
			
		}
		
	})
	
})(jQuery);