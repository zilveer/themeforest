jQuery(document).ready(function($){
    "use strict";
    var cshero_css = cshero_row_object.css;
    var cshero_style = $('<style class="cshero_css_row_style"></style>').appendTo('head');
    cshero_style.html(cshero_css);
});