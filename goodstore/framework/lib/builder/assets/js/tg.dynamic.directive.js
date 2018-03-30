angular.module('tg.dynamicDirective', [])
        .directive('tgDynamicDirective', ['$compile',
            function($compile) {
                'use strict';
                return {
                    restrict: 'E',
                    require: '^ngModel',
                    scope: true,
                    link: function(scope, element, attrs, ngModel) {
                        var ngModelItem = scope.$eval(attrs.ngModel);
                        scope.ngModelItem = ngModelItem;
                        scope.tgDynamicDirectiveLevel = scope.$eval(attrs.tgDynamicDirectiveLevel);
                        scope.tgDynamicDirectiveLevel++;
                        console.log(scope.tgDynamicDirectiveLevel);
                        scope.viewNextLevel = true;
                        if(scope.tgDynamicDirectiveLevel > 2){
                            scope.viewNextLevel = false;
                        }
                        var getView = scope.$eval(attrs.tgDynamicDirectiveView);
                        if (getView && typeof getView === 'function') {
                            var templateUrl = getView(ngModelItem);
                            if (templateUrl) {
                                element.html('<div ng-include src="\'' + templateUrl + '\'"></div>');
                            }

                            $compile(element.contents())(scope);
                        }
                    }
                };
            }
        ]);
