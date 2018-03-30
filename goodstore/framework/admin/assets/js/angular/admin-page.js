//Do budoucna sloučit tuto angular app s edit - v jawBuilderu
var admin_page = angular.module('adminPage', ['jaw.gallerypicker','ui.bootstrap', 'ui.sortable', 'colorpicker.module',   'jaw.simplemediapicker']);

admin_page.controller('adminPage',['$scope', function($scope) {
    
    $scope.edit = $scope.edit || new Object();

    $scope.init_edit = function(id,std){
        console.log('init', id, std);
        if($scope.edit[id] == undefined){
            $scope.edit[id] = std;
        }

    }
    
    $scope.json_decode = function(json_str){
        
        var decode = json_str.replace(/\'/ig, '\"');
        var ret = '';
        if(decode != ''){
            ret = JSON.parse(decode);
        }
        return(ret);
        
    }
    
}]);

jQuery(document).ready(function() {
 
    angular.bootstrap(jQuery('#jaw_metabox'), ['adminPage']);
  
});