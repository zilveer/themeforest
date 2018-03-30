jQuery(document).ready(function(){
    jQuery("#module_container").sortable( { items: "div.column", handle: ".handle" } );

    var Data = [
        { "Class" : "column_1" , "title" : "1/1" , "element" : ["column","contact","accordion","blog"] },
        { "Class" : "column_2" , "title" : "1/2" , "element" : ["column","contact","accordion","blog"] },
        { "Class" : "column_3" , "title" : "1/3" , "element" : ["column","contact","accordion","blog"] },
        { "Class" : "column_4" , "title" : "1/4" , "element" : ["column","contact","accordion","blog"] },
    ];

       //ADD Item
    jQuery("#add_module").live('click',function(e){
        e.preventDefault();
        var size,module,clone,itemID,elements;
        size = jQuery('#module_container .column').size();
        module = jQuery("#modules").val();
        clone = jQuery(".itemOne").clone();
        module_id = module+'_'+size;
        size = size + 1;
        jQuery(clone).removeClass('itemOne');
        jQuery(clone).attr("id","widget_"+size);
        jQuery(clone).find('.edit').attr('href',"#"+module_id)

        jQuery(clone).find('.modal').attr("id",module_id);
        jQuery(clone).attr("item",module);
        jQuery("#module_container").append(clone);
        for(i = 0; i <= Data.length; i++){
            for(c = 0; c <= Data[i].element.length; c++){
                if(Data[i].element[c] == module ){
                    jQuery(clone).addClass(Data[i].Class)
                    jQuery(clone).find('.widgetTitle').text(module);
                    jQuery(clone).find('.ClassTitle').text(Data[i].title);
                    jQuery(clone).find('.elementName').text(module); 
                    jQuery(clone).find('.item').val(Data[i].title);
                    jQuery(clone).find('.widgetName').val(module);
                    jQuery(clone).find('.widgetTitle').text(module);   
                    jQuery(clone).attr('data',i);
                    jQuery(clone).find('.columnClass').val(Data[i].Class)
                    jQuery(clone).attr('item',module);
                   
                    return false;
                }
            }

        }


    })

    jQuery('.increment').live('click',function(e){
        e.preventDefault();
        var parent,ColumnIndex,CurrentWidget,CurrentColumn,module;
        parent = jQuery(this).parent('.column .col-iner');
        CurrentColumn = parseInt(jQuery(parent).attr('data'));
        CurrentWidget = jQuery(parent).attr('widget');
        ColumnIndex = parseInt(jQuery(parent).attr('data'));
        module = jQuery(parent).attr('item').toString();
        for(i = ColumnIndex + 1; i < Data.length; i++){
            for(c = 0; c <= Data[i].element.length; c++){
                if(Data[i].element[c] == module ){
                    jQuery(parent).removeClass(Data[ColumnIndex].Class)
                    jQuery(parent).addClass(Data[i].Class)
                    jQuery(parent).find('.ClassTitle').text(Data[i].title);
                    jQuery(parent).find('.item').val(Data[i].title);
                    jQuery(parent).find('.columnClass').val(Data[i].Class)
                    jQuery(parent).attr('data',i);
                    return false;
                }
            }
        }
    });






    jQuery('.decrement').live('click',function(e){
        e.preventDefault();

        e.preventDefault();
        var parent,ColumnIndex,CurrentWidget,CurrentColumn,module;
        parent = jQuery(this).parent('.column');
        CurrentColumn = parseInt(jQuery(parent).attr('data'));
        CurrentWidget = jQuery(parent).attr('widget');
        ColumnIndex = parseInt(jQuery(parent).attr('data'));
        module = jQuery(parent).attr('item').toString();
        for(i = ColumnIndex - 1; i < Data.length; i--){
            for(c = 0; c <= Data[i].element.length; c++){
                if(Data[i].element[c] == module ){
                    jQuery(parent).removeClass(Data[ColumnIndex].Class)
                    jQuery(parent).addClass(Data[i].Class)
                    jQuery(parent).find('.ClassTitle').text(Data[i].title);
                    jQuery(parent).find('.item').val(Data[i].title);
                    jQuery(parent).attr('data',i);
                    return false;
                }
            }
        }

    });

    //Remove Item
    jQuery('.remove').live('click',function(e){
        e.preventDefault();
        jQuery(this).parent('.column').remove();
    });





    //Edit
    jQuery('.edit').live('click',function(e){
        e.preventDefault();
        var m = jQuery(this).attr('href');
        jQuery(m).modal('toggle')
    })

})