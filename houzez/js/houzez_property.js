/**
 * Created by waqasriaz on 06/10/15.
 */
jQuery(document).ready( function($) {
    "use strict";

    if ( typeof houzezProperty !== "undefined" ) {

        var ajax_url = houzezProperty.ajaxURL;
        var uploadNonce = houzezProperty.uploadNonce;
        var fileTypeTitle = houzezProperty.fileTypeTitle;
        var msg_digits = houzezProperty.msg_digits;
        var max_prop_images = houzezProperty.max_prop_images;
        var image_max_file_size = houzezProperty.image_max_file_size;

        var plan_title_text = houzezProperty.plan_title_text;
        var plan_size_text = houzezProperty.plan_size_text;
        var plan_bedrooms_text = houzezProperty.plan_bedrooms_text;
        var plan_bathrooms_text = houzezProperty.plan_bathrooms_text;
        var plan_price_text = houzezProperty.plan_price_text;
        var plan_price_postfix_text = houzezProperty.plan_price_postfix_text;
        var plan_image_text = houzezProperty.plan_image_text;
        var plan_description_text = houzezProperty.plan_description_text;
        var plan_upload_text = houzezProperty.plan_upload_text;

        var mu_title_text = houzezProperty.mu_title_text;
        var mu_type_text = houzezProperty.mu_type_text;
        var mu_beds_text = houzezProperty.mu_beds_text;
        var mu_baths_text = houzezProperty.mu_baths_text;
        var mu_size_text = houzezProperty.mu_size_text;
        var mu_size_postfix_text = houzezProperty.mu_size_postfix_text;
        var mu_price_text = houzezProperty.mu_price_text;
        var mu_price_postfix_text = houzezProperty.mu_price_postfix_text;
        var mu_availability_text = houzezProperty.mu_availability_text;

        // For validation
        var prop_title = houzezProperty.prop_title;
        var prop_price = houzezProperty.prop_price;
        var prop_type = houzezProperty.prop_type;
        var prop_status = houzezProperty.prop_status;
        var prop_labels = houzezProperty.prop_labels;
        //var prop_description = houzezProperty.description;
        var price_label = houzezProperty.price_label;
        var prop_id = houzezProperty.prop_id;
        var bedrooms = houzezProperty.bedrooms;
        var bathrooms = houzezProperty.bathrooms;
        var area_size = houzezProperty.area_size;
        var land_area = houzezProperty.land_area;
        var garages = houzezProperty.garages;
        var year_built = houzezProperty.year_built;
        var property_map_address = houzezProperty.property_map_address;

        var houzez_validation = function( field_required ) {
            if( field_required != 0 ) {
                return true;
            }
            return false;
        }


        /* Validate Submit Property Form */
        if( jQuery().validate ){

            $('#submit_property_form').validate({
                rules: {
                    prop_title: {
                        required: houzez_validation(prop_title)
                    },
                    /*prop_des: {
                        required: houzez_validation(prop_description)
                    },*/
                    prop_price: {
                        required: houzez_validation(prop_price),
                    },
                    prop_type: {
                        required: houzez_validation(prop_type)
                    },
                    prop_status: {
                        required: houzez_validation(prop_status)
                    },
                    prop_labels: {
                        required: houzez_validation(prop_labels)
                    },
                    prop_label: {
                        required: houzez_validation(price_label)
                    },
                    property_id: {
                        required: houzez_validation(prop_id)
                    },
                    prop_size: {
                        required: houzez_validation(area_size),
                        number: true
                    },
                    prop_land_area: {
                        required: houzez_validation(land_area),
                    },
                    prop_beds: {
                        required: houzez_validation(bedrooms),
                    },
                    prop_baths: {
                        required: houzez_validation(bathrooms),
                    },
                    prop_garage: {
                        required: houzez_validation(garages),
                    },
                    prop_year_built: {
                        required: houzez_validation(year_built)
                    },
                    property_map_address: {
                        required: houzez_validation(property_map_address)
                    },
                },
                messages: {
                    prop_title: "",
                    prop_des: "",
                    prop_price: "",
                    prop_beds: msg_digits,
                    prop_baths: msg_digits,
                    prop_size: msg_digits,
                    property_map_address: "",
                    prop_type: "",
                    prop_status: "",
                    prop_labels: "",
                    prop_label: "",
                    prop_land_area: "",
                    property_id: "",
                    prop_garage: "",
                    prop_year_built: "",
                    /*username: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 2 characters"
                    },*/
                    /*password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },*/
                }
            });

            // The default value for $('#frm_editCategory').validate().settings.ignore
            // is ':hidden'.  Log this to the console to verify:
            console.log($('#submit_property_form').validate().settings.ignore);

            // Set validator to NOT ignore hidden selects
            $('#submit_property_form').validate().settings.ignore = ':not(select:hidden, input:visible, textarea:visible)';
        }

        /* ------------------------------------------------------------------------ */
        /*	Property additional Features
         /* ------------------------------------------------------------------------ */
        $( "#houzez_additional_details_main" ).sortable({
            revert: 100,
            placeholder: "detail-placeholder",
            handle: ".sort-additional-row",
            cursor: "move"
        });

        $( '.add-additional-row' ).click(function( e ){
            e.preventDefault();

            var numVal = $(this).data("increment") + 1;
            $(this).data('increment', numVal);
            $(this).attr({
                "data-increment" : numVal
            });

            var newAdditionalDetail = '<tr>'+
                '<td class="action-field">'+
                    '<span class="sort-additional-row"><i class="fa fa-navicon"></i></span>'+
                '</td>'+
                '<td class="field-title">'+
                '<input class="form-control" type="text" name="additional_features['+numVal+'][fave_additional_feature_title]" id="fave_additional_feature_title_'+numVal+'" value="">'+
                '</td>'+
                '<td>'+
                '<input class="form-control" type="text" name="additional_features['+numVal+'][fave_additional_feature_value]" id="fave_additional_feature_value_'+numVal+'" value="">'+
                '</td>'+
                 '<td class="action-field">'+
                    '<span data-remove="'+numVal+'" class="remove-additional-row"><i class="fa fa-remove"></i></span>'+
                '</td>'+
            '</tr>';

            $( '#houzez_additional_details_main').append( newAdditionalDetail );
            removeAdditionalDetails();
        });

        var removeAdditionalDetails = function (){

            $( '.remove-additional-row').click(function( event ){
                event.preventDefault();
                var $this = $( this );
                $this.closest( 'tr' ).remove();
            });
        }
        removeAdditionalDetails();

        /* ------------------------------------------------------------------------ */
        /*	Floor Plans
         /* ------------------------------------------------------------------------ */
        $( "#houzez_floor_plans_main" ).sortable({
            revert: 100,
            placeholder: "detail-placeholder",
            handle: ".sort-floorplan-row",
            cursor: "move"
        });

        $( '#add-floorplan-row' ).click(function( e ){
            e.preventDefault();

            var numVal = $(this).data("increment") + 1;
            $(this).data('increment', numVal);
            $(this).attr({
                "data-increment" : numVal
            });

            var newFloorPlan = '' +
                '<tr>'+
                '<td class="row-sort">'+
                '<span class="sort sort-floorplan-row"><i class="fa fa-navicon"></i></span>'+
                '</td>'+
                '<td class="sort-middle">'+
                '<div class="sort-inner-block">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="floor_plans['+numVal+'][fave_plan_title]">'+plan_title_text+'</label>'+
                '<input name="floor_plans['+numVal+'][fave_plan_title]" type="text" id="fave_plan_title_'+numVal+'" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="floor_plans['+numVal+'][fave_plan_rooms]">'+plan_bedrooms_text+'</label>'+
                '<input name="floor_plans['+numVal+'][fave_plan_rooms]" type="text" id="fave_plan_rooms_'+numVal+'" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="floor_plans['+numVal+'][fave_plan_bathrooms]">'+plan_bathrooms_text+'</label>'+
                '<input name="floor_plans['+numVal+'][fave_plan_bathrooms]" type="text" id="fave_plan_bathrooms_'+numVal+'" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="floor_plans['+numVal+'][fave_plan_price]">'+plan_price_text+'</label>'+
                '<input name="floor_plans['+numVal+'][fave_plan_price]" type="text" id="fave_plan_price_'+numVal+'" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="floor_plans['+numVal+'][fave_plan_price_postfix]">'+plan_price_postfix_text+'</label>'+
                '<input name="floor_plans['+numVal+'][fave_plan_price_postfix]" type="text" id="fave_plan_price_postfix_'+numVal+'" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="floor_plans['+numVal+'][fave_plan_size]">'+plan_size_text+'</label>'+
                '<input name="floor_plans['+numVal+'][fave_plan_size]" type="text" id="fave_plan_size_'+numVal+'" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="table-list">'+
                '<div class="form-group table-cell full-width" style="padding-right: 8px;">'+
                '<label for="floor_plans['+numVal+'][fave_plan_image]">'+plan_image_text+'</label>'+
                '<input name="floor_plans['+numVal+'][fave_plan_image]" type="text" id="fave_plan_image_'+numVal+'" class="fave_plan_image form-control">'+
                '</div>'+
                '<div class="table-cell v-align-bottom">'+
                '<button id="'+numVal+'" class="floorPlansImg btn btn-primary">'+plan_upload_text+'</button>'+
                '</div>'+
                '<div id="plupload-container"></div>'+
                '<div id="errors-log"></div>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="floor_plans['+numVal+'][fave_plan_description]">'+plan_description_text+'</label>'+
                '<textarea name="floor_plans['+numVal+'][fave_plan_description]" rows="4" id="fave_plan_description_'+numVal+'" class="form-control"></textarea>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</td>'+
                '<td class="row-remove">'+
                '<span data-remove="'+numVal+'" class="remove-floorplan-row remove"><i class="fa fa-remove"></i></span>'+
                '</td>'+
                '</tr>';

            $( '#houzez_floor_plans_main').append( newFloorPlan );
            removeFloorPlans();
            floorPlanImage();
        });

        var removeFloorPlans = function (){

            $( '.remove-floorplan-row').click(function( event ){
                event.preventDefault();
                var $this = $( this );
                $this.closest( 'tr' ).remove();
            });
        }
        removeFloorPlans();


        /* ------------------------------------------------------------------------ */
        /*	Multi Units
         /* ------------------------------------------------------------------------ */
        $( "#multi_units_main" ).sortable({
            revert: 100,
            placeholder: "detail-placeholder",
            handle: ".sort-subproperty-row",
            cursor: "move"
        });

        $( '#add-subproperty-row' ).click(function( e ){
            e.preventDefault();

            var numVal = $(this).data("increment") + 1;
            $(this).data('increment', numVal);
            $(this).attr({
                "data-increment" : numVal
            });

            var newSubProperty = '' +
                '<tr>'+
                '<td class="row-sort">'+
                '<span class="sort-subproperty-row sort"><i class="fa fa-navicon"></i></span>'+
                '</td>'+
                '<td class="sort-middle">'+
                '<div class="sort-inner-block">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_title]">'+mu_title_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_title]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_beds]">'+mu_beds_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_beds]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_baths]">'+mu_baths_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_baths]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_size]">'+mu_size_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_size]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_size_postfix]">'+mu_size_postfix_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_size_postfix]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_price]">'+mu_price_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_price]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_price_postfix]">'+mu_price_postfix_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_price_postfix]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<div class="form-group">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_type]">'+mu_type_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_type]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-xs-12">'+
                '<label for="fave_multi_units['+numVal+'][fave_mu_availability_date]">'+mu_availability_text+'</label>'+
                '<input name="fave_multi_units['+numVal+'][fave_mu_availability_date]" type="text" class="form-control">'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</td>'+
                '<td class="row-remove">'+
                '<span data-remove="'+numVal+'" class="remove-subproperty-row remove"><i class="fa fa-remove"></i></span>'+
            '</td>'+
            '</tr>';

            $( '#multi_units_main').append( newSubProperty );
            removeSubProperty();
        });

        var removeSubProperty = function (){

            $( '.remove-subproperty-row').click(function( event ){
                event.preventDefault();
                var $this = $( this );
                $this.closest( 'tr' ).remove();
            });
        }
        removeSubProperty();



        /* ------------------------------------------------------------------------ */
        /*	Property Thumbnails actions ( make features & delete )
         /* ------------------------------------------------------------------------ */
        var propertyThumbnailEvents = function() {

            // Set Featured Image
            $('.icon-featured').click(function(){

                var $this = jQuery(this);
                var thumb_id = $this.data('attachment-id');
                var icon = $this.find( 'i');

                $('.gallery-thumb .featured_image_id').remove();
                $('.gallery-thumb .icon-featured i').removeClass('fa-star').addClass('fa-star-o');

                $this.closest('.gallery-thumb').append('<input type="hidden" class="featured_image_id" name="featured_image_id" value="'+thumb_id+'">');
                icon.removeClass('fa-star-o').addClass('fa-star');
            });

            //Remove Image
            $('.icon-delete').click(function(){
                var $this = $(this);
                var thumbnail = $this.closest('.gallery-thumb');
                var loader = $this.siblings('.icon-loader');
                var prop_id = $this.data('property-id');
                var thumb_id = $this.data('attachment-id');

                loader.show();

                var ajax_request = $.ajax({
                    type: 'post',
                    url: ajax_url,
                    dataType: 'json',
                    data: {
                        'action': 'houzez_remove_property_thumbnail',
                        'property_id': prop_id,
                        'thumbnail_id': thumb_id,
                        'removeNonce': uploadNonce
                    }
                });

                ajax_request.done(function( response ) {
                    if ( response.attachment_remove ) {
                        thumbnail.remove();
                    } else {

                    }
                });

                ajax_request.fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });

            });

        }

        propertyThumbnailEvents();

        // Property Gallery images
        var property_gallery_images = function() {

            $( "#property-thumbs-container" ).sortable({
                placeholder: "sortable-placeholder"
            });

            /* initialize uploader */
            var uploader = new plupload.Uploader({
                browse_button: 'select-images',          // this can be an id of a DOM element or the DOM element itself
                file_data_name: 'property_upload_file',
                container: 'plupload-container',
                drop_element: 'drag-and-drop',
                url: ajax_url + "?action=houzez_property_img_upload&nonce=" + uploadNonce,
                filters: {
                    mime_types : [
                        { title : fileTypeTitle, extensions : "jpg,jpeg,gif,png" }
                    ],
                    max_file_size: image_max_file_size,
                    prevent_duplicates: true
                }
            });
            uploader.init();

            uploader.bind('FilesAdded', function(up, files) {
                var html = '';
                var propertyThumb = "";
                var maxfiles = max_prop_images;
                if(up.files.length > maxfiles ) {
                    up.splice(maxfiles);
                    alert('no more than '+maxfiles + ' file(s)');
                    return;
                }
                plupload.each(files, function(file) {
                    propertyThumb += '<div id="holder-' + file.id + '" class="property-thumb">' + '' + '</div>';
                });
                document.getElementById('property-thumbs-container').innerHTML += propertyThumb;
                up.refresh();
                uploader.start();
            });


            /* Run during upload */
            uploader.bind('UploadProgress', function(up, file) {
                document.getElementById( "holder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
            });

            /* In case of error */
            uploader.bind('Error', function( up, err ) {
                document.getElementById('errors-log').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
            });

            /* If files are uploaded successfully */
            uploader.bind('FileUploaded', function ( up, file, ajax_response ) {
                var response = $.parseJSON( ajax_response.response );

                if ( response.success ) {

                    var proppertyThumbHtml = '<div class="col-sm-2">' +
                        '<figure class="gallery-thumb">' +
                        '<img src="' + response.url + '" alt="" />' +
                        '<a class="icon icon-delete" data-property-id="' + 0 + '"  data-attachment-id="' + response.attachment_id + '" href="javascript:;" ><i class="fa fa-trash-o"></i></a>' +
                        '<a class="icon icon-fav icon-featured" data-property-id="' + 0 + '"  data-attachment-id="' + response.attachment_id + '" href="javascript:;" ><i class="fa fa-star-o"></i></a>' +
                        '<input type="hidden" class="propperty-image-id" name="propperty_image_ids[]" value="' + response.attachment_id + '"/>' +
                        '<span style="display: none;" class="icon icon-loader"><i class="fa fa-spinner fa-spin"></i></span>' +
                        '</figure>' +
                        '</div>';

                    document.getElementById( "holder-" + file.id ).innerHTML = proppertyThumbHtml;

                    propertyThumbnailEvents();  // bind click event with newly added gallery thumb

                } else {
                    // log response object
                    console.log ( response );
                    alert('error');
                }
            });

        }
        property_gallery_images();


        // Property Gallery images
        var floorPlanImage = function() {

            /* initialize uploader */
            var uploader_floor = new plupload.Uploader({
                browse_button: '0',          // this can be an id of a DOM element or the DOM element itself
                file_data_name: 'property_upload_file',
                container: 'plupload-container',
                drop_element: 'drag-and-drop',
                url: ajax_url + "?action=houzez_property_img_upload&nonce=" + uploadNonce,
                filters: {
                    mime_types : [
                        { title : fileTypeTitle, extensions : "jpg,jpeg,gif,png" }
                    ],
                    max_file_size: image_max_file_size,
                    prevent_duplicates: true
                }
            });
            uploader_floor.init();

            uploader_floor.bind('FilesAdded', function(up, files) {
                var html = '';
                var propertyThumb = "";
                var maxfiles = max_prop_images;
                if(up.files.length > maxfiles ) {
                    up.splice(maxfiles);
                    alert('no more than '+maxfiles + ' file(s)');
                    return;
                }
                plupload.each(files, function(file) {
                   // propertyThumb += '<div id="holder-' + file.id + '" class="property-thumb">' + '' + '</div>';
                });
               // document.getElementById('property-thumbs-container').innerHTML += propertyThumb;
                up.refresh();
                uploader_floor.start();
            });

            var current_button_id;

            /* Run during upload */
            uploader_floor.bind('UploadProgress', function(up, file) {
                //document.getElementById( "holder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
            });

            /* In case of error */
            uploader_floor.bind('Error', function( up, err ) {
                var herror = $('#'+current_button_id).parents('tr').find('#errors-log').html("Error #" + err.code + ": " + err.message);
            });

            /* If files are uploaded successfully */
            uploader_floor.bind('FileUploaded', function ( up, file, ajax_response ) {
                var response = $.parseJSON( ajax_response.response );

                if ( response.success ) {

                    $('#'+current_button_id).parents('tr').find('.fave_plan_image').val(response.full_image);

                   // document.getElementById( "holder-" + file.id ).innerHTML = proppertyThumbHtml;

                } else {
                    // log response object
                    console.log ( response );
                    alert('error');
                }
            });
            $('.floorPlansImg').mouseenter(function () {
                current_button_id = $(this).attr('id');
                uploader_floor.setOption("browse_button", $(this).attr('id')); //Assign the ID of the pickfiles button to pluploads browse_button
                uploader_floor.refresh();
            });

        }
        floorPlanImage();



    }

});