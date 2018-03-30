var jaw_revo_editor_app = angular.module('jawEditor', ['ui.bootstrap', 'ui.sortable','tg.dynamicDirective', 'colorpicker.module', 'jaw.gallerypicker', 'jaw.simplemediapicker']);


actual_edit = {};


jaw_revo_editor_app.controller('jaw_revo_editor',['$scope', '$timeout', function($scope, $timeout) {

    $timeout(function() {
        multiselect();
    });
    $scope.radioModel = 'Middle';
    $scope.checkModel = {
        left: false,
        middle: true,
        right: false
    };
    $scope.edit = $scope.edit || {};
    $scope.options = $scope.options || {};
    //init_edit();

    $scope.add_edit = function(item) {
        if ($scope.edit[item] === undefined) {
            $scope.edit[item] = [];
        }
        if (debug) {
            console.log('add_edit -> $scope.edit[item]: ' + $scope.edit[item]);
        }
        $scope.edit[item].push(jQuery.extend({}, {}));        
    };

    //DELETE 
    $scope.del_edit = function(object, ide) {
        $scope.edit[object].splice(ide, 1);
    };

    //INIT object
    $scope.init_object = function(item) {
        if ($scope.edit[item] === undefined || ($scope.edit[item].length <= 0)) {
            $scope.add_edit(item);
        }
        if (debug) {
            console.log('init_object -> item: ' + item);
        }
    };

    $scope.getColor = function(color) {
        return {
            background: color
        };
    };

    $scope.init_edit = function(id, std) {
        if (debug) {
            console.log('init_edit -> id: ' + id);
            console.log('init_edit -> edit[id]: ' + $scope.edit[id]);
            console.log('init_edit -> std: ' + std);
        }
        if ($scope.edit[id] === undefined) {
            $scope.edit[id] = std;
        }

    };

    /*ADvanced list */
    $scope.listSortableOptions = {
         connectWith: ".list-li-container",
    };
    $scope.getView = function(item) {
        if (item) {
            return 'list_item.html';
        }
        return null;
    };
    $scope.badgeList = function(text, items) {
        angular.forEach(items, function(val, k) {
            val.bullet = text;
        });
    }

}]);


var wpautop = true;
var jaw_editor_open = false;
function init_wp_editor(elementId) {
    window.tinyMCE.settings.wpautop = false;
    //window.tinyMCE.execCommand("mceAddControl", false, elementId);
    window.tinyMCE.execCommand("mceAddEditor", false, elementId);
    tinyMCE.settings.wpautop = wpautop;
    wpActiveEditor = elementId;
    jaw_editor_open = true;
}
function cancel_wp_editor(elementId) {

    window.tinyMCE.settings.wpautop = false;
    window.tinyMCE.execCommand("mceRemoveEditor", true, elementId);
    //window.tinyMCE.execCommand("mceAddEditor", true, elementId);
    jaw_editor_open = false;
}

jQuery(window).scroll(function() {
    if (jaw_editor_open === true) {
        jQuery('.mce-container.mce-panel.mce-floatpanel').hide();
        jQuery('.mce-btn').removeClass('mce-active');
        jQuery('.mce-btn').attr('aria-expanded', false);
    }
});

function activateTinyMCETab(selectedTab, visualTab, htmlTab, elementId) {
    if (selectedTab == 'visual') {
        init_wp_editor(elementId);
        jQuery(visualTab).addClass('active');
        jQuery(htmlTab).removeClass('active');
        jQuery('.jaw_add_media').show();
    }
    if (selectedTab == 'html') {
        cancel_wp_editor(elementId);
        jQuery(visualTab).removeClass('active');
        jQuery(htmlTab).addClass('active');
        jQuery('.jaw_add_media').hide();
    }
}


