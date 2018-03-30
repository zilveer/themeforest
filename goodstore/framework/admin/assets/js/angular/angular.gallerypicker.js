/**
 * @license AngularJS v1.2.14-build.2275+sha.4f937bd
 * (c) 2010-2014 Google, Inc. http://angularjs.org
 * License: MIT
 */
(function(window, angular, undefined) {
    'use strict';

    /*
     * Angular module gallerypicker for wordpress gallery
     * 
     * @author jawtemplates
     * @version 1.2
     */


    /**
     * @ngdoc module
     * @name jaw.gallerypicker
     * 
     * #jaw_gallerypicker
     */
    var jaw_gallerypicker = angular.module('jaw.gallerypicker', []);

    /* global jaw_gallerypicker: false */

    /**
     * @ngdoc directive
     * @name gallerypicker
     * 
     * #Usage
     * add to your form this directive:
     * echo '<div gallerypicker ng-model="gallery"  ng-init="gallery = JSON.parse(\'' . addslashes(str_replace('"', '\'', $meta)) . '\');" name="name_of_input"></div>';          
     * 
     * You must have linked also mce-view.js (wordpress library).  
     * wp_enqueue_script('mce-view');
     * In post (custom post) editor is linked automatically by WP.
     */
    jaw_gallerypicker.directive('gallerypicker', function() {
        return {
            require: '?ngModel',
            replace: true,
            transclude: false,
            scope: {
                componentPicker: '=ngModel',
                inputName: '@name'
            },
            restrict: 'A',
            template: '<div class="jaw_gallerypicker" >' +
                    '<input type="hidden"  name="{{ inputName }}" ng-model="componentPicker" value="{{ componentPicker }}" />' +
                    '<div class="imgs"><span ng-repeat="(i, images) in componentPicker"><img ng-src="{{images.url}}" /></span></div>' +
                    '<div class="button jaw-insert-media add_media" ng-click="edit_gallery()"><i class="icon-plus"></i> Edit gallery</div>' +
                    '</div>',
            link: function(scope, element, attrs, ngModel) {

                if (!ngModel)
                    return;

                var media = media || new Array();
                var elementInput = angular.element(element.children()[0]);
                var galleryState = 'gallery-edit';

                wp.media.jaw_jaw_gallerypicker = {
                    select: function() {
                        var ids = '';
                        if (!(scope.componentPicker == undefined || scope.componentPicker == '')) {
                            jQuery.each(scope.componentPicker, function(key, val) {
                                ids += val.id + ', ';
                            });

                            var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + ids + '" ]'),
                                    attachments, selection;
                            
                            // Bail if we didn't match the shortcode or all of the content.
                            if (!shortcode)
                                return;

                            // Ignore the rest of the match object.
                            shortcode = shortcode.shortcode;

                            attachments = wp.media.gallery.attachments(shortcode); //vrací query
                            
                            selection = new wp.media.model.Selection(attachments.models, {
                                props: attachments.props.toJSON(),
                                multiple: true
                            });
                            selection.gallery = attachments.gallery;


                            // Fetch the query's attachments, and then break ties from the
                            // query to allow for sorting.
                            selection.more().done(function() {
                                // Break ties with the query.
                                selection.props.set({
                                    query: false
                                });
                                selection.unmirror();
                                selection.props.unset('orderby');
                            });
                        } else {
                            selection = null;
                        }
                        return selection;

                    },
                    frame: function() {
                        
                        //If is blank element - open ADD to gallery
                        if (scope.componentPicker == '') {
                            galleryState = 'gallery-library';
                        // If is element open second time - open edit gallery
                        }else if(this._frame && galleryState == 'gallery-library'){
                            galleryState = 'gallery-edit';
                        // If is element opened third times ane more - use the same _frame (with edit gallery)
                        }else if(this._frame){
                            return this._frame;
                        }

                        var selection = this.select();
                        //Attributes for open wordpress mediapicker
                        this._frame = wp.media({
                            id: 'jaw_jaw_gallerypicker',
                            frame: 'post',
                            state: galleryState,
                            title: wp.media.view.l10n.editGalleryTitle,
                            editing: true,
                            multiple: true,
                            selection: selection
                        });

                        //Save gallery into input tag
                        this._frame.on('update',
                                function() {

                                    var controller = wp.media.jaw_jaw_gallerypicker._frame.states.get('gallery-edit');
                                    var library = controller.get('library');
                                    var ids = library.pluck('id');
                                    var urls = library.pluck('url');
                                    var new_media = new Array;
                                    jQuery.each(ids, function(key, val) {
                                        //Format for input value is Object {'id': @value, 'url': @value}
                                        new_media.push({'id': val, 'url': urls[key]});
                                    });
                                    elementInput.val(JSON.stringify(new_media));
                                    scope.componentPicker = new_media;
                                    scope.$apply();
                                });


                        return this._frame;
                    },
                    init: function() {

                        //Click on edit gallery button
                        scope.edit_gallery = function() {
                            wp.media.jaw_jaw_gallerypicker.frame().open();
                        }
                    }
                };
                jQuery(wp.media.jaw_jaw_gallerypicker.init);

            }
        };
    })


})(window, window.angular);