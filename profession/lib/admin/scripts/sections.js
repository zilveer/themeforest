function AddBtn(){
    var $ = jQuery,
        itemCount = $('#post-type-archive-checklist li label:not(#post-type-archive-checklist li label[style*="display: none"])').length,
        controlsBtn = $('#post-type-archives .accordion-section-content .inside .button-controls');
    if(itemCount <= 0){
        controlsBtn.hide();
    }else{
        controlsBtn.show();
    }
}

function removeItem(){
	var $        = jQuery,
		index,
		sections = [
            "home",
			"Portfolio",
			"resume",
			"contact" ],
    customParts = $("#post-body-content #menu-to-edit .menu-item:not(#post-body-content #menu-to-edit li[class*=page])" +
        ":not(#post-body-content #menu-to-edit li[class*=contact]):not(#post-body-content #menu-to-edit li[class*=portfolio])" +
        ":not(#post-body-content #menu-to-edit li[class*=resume]):not(#post-body-content #menu-to-edit li[class*=custom-part])" +
        ":not(#post-body-content #menu-to-edit li[class*=home])"),
        i = 0,
        name = [];
    customParts.each(function(key,value){
        var temp;
        temp = $(this).find("span.menu-item-title").html();
        name[i] = temp ;
        i++;
    });

    // add custom part sections to sections
    var i=0;
    for(i=0; i<name.length;i++){
        sections[sections.length+i]=name[i];
    }

    $('#menu-to-edit .menu-item .menu-item-actions .item-delete').click(function(event) {
        //alert(event);
        var section = $(this).parent().parent().parent().find('span.menu-item-title').html();
        for (index = 0; index < sections.length; ++index) {
            if(section == sections[index]){
                $('#post-type-archive-checklist').append('<li><label><input type="checkbox" value ="'+sections[index]+'" /> '+sections[index]+' </label></li>');

                var additionalLi= $('#post-type-archive-checklist li label input[value="'+sections[index]+'"]' +
                    ':not(#post-type-archive-checklist li label input[value="'+sections[index]+'"]:first)').parents('li:first');
                additionalLi.remove();
            }

        }
        AddBtn();
    });
}

jQuery(document).ready(function ($) {

    $("#screen-options-wrap input:checkbox#post-type-archives-hide").prop("checked", true);
    $('#post-type-archives').css("display", "list-item");

    $("#screen-options-wrap input:checkbox#add-custom-part-hide").prop("checked", true);
    $('#add-custom-part').css("display", "list-item");
        
	removeItem();
    AddBtn();
    $('#submit-post-type-archives').click(function(event) {
        event.preventDefault();
 
        /* Get checked boxes */
        var postTypes = [],postId = [];
        $('#post-type-archive-checklist li :checked').each(function() {
            postTypes.push($(this).val());
            postId.push($(this).attr('item-title'));
        });
 
        /* Send checked post types with our action, and nonce */
        $.post( ajaxurl, {
                action: "my-add-post-type-archive-links",
                posttypearchive_nonce: MyPostTypeArchiveLinks.nonce,
                post_type : [postTypes,postId]


            },
 
            /* AJAX returns html to add to the menu */
            function( response ) {
                var  x = response;
                $('#menu-to-edit').append(response);
				$('#post-type-archive-checklist li :checked').each(function() {
					$(this).parent().remove();
				});
				removeItem();
                AddBtn();
            }
        );
    })
});