/**
* Created by duongle on 5/31/14.
*/

(function(e){e(document).ready(function(){var t=false;e(".import-data").click(function(){if(t==true)alert("Import demo data is processing! Please wait!");t=true;e(".notice-content").html("");e("#save-alert").css({opacity:"1",display:"block"});var n={action:"awe_import_data",_wpnonce:e("input[name='_wpnonce']").val(),_wp_http_referer:e("input[name='_wp_http_referer']").val()};e.post(ajaxurl,n,function(n,r,i){e(".notice-content").html(n);e("#save-alert i").removeClass("dashicons-update").addClass("dashicons-yes");setTimeout(function(){e("#save-alert").css({opacity:"0",display:"none"});e("#save-alert i").removeClass("dashicons-yes").addClass("dashicons-update")},2e3);t=false;return false});return false})})})(jQuery)