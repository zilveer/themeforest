/**
 * Angular module simplemediapicker for wordpress media
 * 
 * @author jawtemplates
 * @version 1.1
 * @licence GNU-GPL
 */

(function(window, angular, undefined) {
    'use strict';

    /*
     * Angular module simplemediapicker for wordpress gallery
     * 
     * @author jawtemplates
     * @version 1.1
     */


    /**
     * @ngdoc module
     * @name jaw.simplemediapicker
     * 
     * #jaw_simplemediapicker
     */
    var jaw_simplemediapicker = angular.module('jaw.simplemediapicker', []);

    /* global jaw_simplemediapicker: false */

    /**
     * @ngdoc directive
     * @name simplemediapicker
     * 
     * #Usage
     * add to your form this directive:
     * echo '<div simplemediapicker ng-model="gallery"  ng-init="gallery = JSON.parse(\'' . addslashes(str_replace('"', '\'', $meta)) . '\');" name="name_of_input"></div>';          
     * 
     * You must have linked also mce-view.js (wordpress library).  
     * wp_enqueue_script('mce-view');
     * In post (custom post) editor is linked automatically by WP.
     */
    jaw_simplemediapicker.directive('simplemediapicker', function() {
        return {
            require: '?ngModel',
            replace: true,
            transclude: false,
            scope: {
                componentPicker: '=ngModel',
                inputName: '@name'
            },
            restrict: 'A',
            template: '<div class="simplemediapicker" >' +
                    '<input type="hidden"  name="{{ inputName }}" ng-model="componentPicker" value="{{ componentPicker }}" />' +
                    '<img  ng-repeat="(is,soubor) in componentPicker" ng-src="{{soubor.url}}" ng-show="mod" />' +
                    '<ul ng-show="!mod"><li ng-repeat="(is,soubor) in componentPicker">{{soubor.url}}</li></ul>' +
                    '<div class"clear"></div>' +
                    '<div id="{{ inputName }}-insert" ng-click="open_media()" class="button jaw-insert-simplemedia add_media"><i class="icon-image2 "></i> Choose Image</div>' +
                    '<div id="{{ inputName }}-remove" ng-click="close_media()" class="button jaw-remove-simplemedia remove_media"><i class="icon-close "></i> Remove</div>' +
                    '</div>',
            link: function(scope, element, attrs, ngModel) {
                var file_frame;
                var elementInput = angular.element(element.children()[0]);
                var media = media || new Array();

                if (attrs.multiple === undefined) {
                    attrs.multiple = false;
                }
                if (attrs.mod == 'list') {
                    attrs.mod = false;
                } else {
                    attrs.mod = true;
                }

                scope.mod = attrs.mod;

                scope.open_media = function() {

                    if (file_frame) {
                        file_frame.open();
                        return;
                    }

                    //TODO load files for editing
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: jQuery(this).data('Choose Image'),
                        button: {
                            text: jQuery(this).data('Insert'),
                        },
                        multiple: attrs.multiple
                    });


                    file_frame.on('select', function() {
                        var new_item;
                        new_item = new Array();
                        var collection = file_frame.state().get('selection').toJSON();
                        jQuery.each(collection, function(k, img) {
                            new_item.push({'id': img.id, 'url': img.url});
                        });
                        elementInput.val(JSON.stringify(new_item));
                        scope.componentPicker = new_item;
                        scope.$apply();


                    });

                    file_frame.open();
                };

                scope.close_media = function() {
                    var new_item = null;
                    elementInput.val(JSON.stringify(new_item));
                    scope.componentPicker = new_item;
                    scope.$apply();
                };
            }
        };
    })
})(window, window.angular);

