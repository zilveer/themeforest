jQuery(document).ready(function($) {

   function upd_sort()
   {
      var tout_upd = false;
      $(".cont").sortable({
         activate: function () {
            if (tout_upd)
               clearTimeout(tout_upd);
         },
         start: function () {
            if (tout_upd)
               clearTimeout(tout_upd);
         },
         update: function(e, ui) {
            if (tout_upd)
               clearTimeout(tout_upd);
            tout_upd = setTimeout(function () {
            
            $("#saving_str").html("Saving...").show();
            var elem = $(ui.item).parent();
            var s = elem.sortable("serialize");
            $.ajax({
               url: ajaxurl,
               type: "POST",
               data: "action=gallery_plus_set_photos_order&album="+$("#post_ID").val()+"&"+s,
               success: function (v) {
                 $("#saving_str").html("Saved!").fadeOut(1000);
                 var n = 0;
                 $(".photo").each(function () {
                    n++;
                    $(this).attr("id", "photo-"+n);
                    $(this).attr("photo", n);
                 });
               }
            });
            
            }, 1000);
         }
      });
   }

   function gallery_plus_update()
   {
      $("#gallery_photos").html("Loading...");
      $.ajax({
         url: ajaxurl,
         type: "POST",
         data: {
            action: "gallery_plus_get_photos",
            album:  $("#post_ID").val()
         },
         success: function (v) {
            $("#gallery_photos").html(v);
            upd_sort();
         }
      });
   }

   upd_sort();
   
   $(".set_size").live('click', function () {
      var v = $(this).attr("value");
      var p = $(this).attr("forphoto");
      $("#saving_str").html("Saving...").show();
      $.ajax({
         url: ajaxurl,
         type: "POST",
         data: {
            action: "gallery_plus_set_size",
            album:  $("#post_ID").val(),
            photo: p,
            size: v
         },
         success: function (v) {
            //gallery_plus_update();
            $("#saving_str").html("Saved!").fadeOut(1000);
         }
      });
   });
   
   $("#gallery_plus_del_photos").live('click', function () {
      var photos = [];
      $(".g_del_photo").each(function () {
         if (!$(this).attr("checked"))
            return;
         photos[ photos.length ] = $(this).attr("value");
         $(this).parents(".photo").remove();
      });
      if (!$(".photo").length)
      {
         $("#g_cont").html("");
      }
      $("#saving_str").html("Saving...").show();
      $.ajax({
         url: ajaxurl,
         type: "POST",
         data: {
            action: "gallery_plus_delete_photo",
            album:  $("#post_ID").val(),
            photo: photos
         },
         success: function (v) {
            //gallery_plus_update();
            $("#saving_str").html("Saved!").fadeOut(1000);
         }
      });
   });
   
   $(".sel_all").live('click', function () {
      if ($(this).attr("checked"))
         $(".g_del_photo").attr("checked", "checked");
      else
         $(".g_del_photo").removeAttr("checked");
   });
   
   $(".photo .del").live('click', function () {
      if (!confirm("Are you sure you want to delete this photo?"))
         return false;
      var photo_id = $(this).parents(".photo").attr("photo");
      $("#saving_str").html("Saving...").show();
      $.ajax({
         url: ajaxurl,
         type: "POST",
         data: {
            action: "gallery_plus_delete_photo",
            album:  $("#post_ID").val(),
            photo: [photo_id]
         },
         success: function (v) {
            //gallery_plus_update();
            $("#saving_str").html("Saved!").fadeOut(1000);
         }
      });
      $(this).parents(".photo").remove();
      return false;
   });
   
   var save_tout = false;
   $(".photo textarea").live('keyup', function () {
      if (save_tout)
         clearTimeout(save_tout);
      save_tout = setTimeout(function () {
         var d = {
            action: "gallery_plus_save_photos",
            album:  $("#post_ID").val()
         };
         d.photos = [];
         $(".photo").each(function () {
            d.photos[ $(this).attr("photo") ] = {
              desc: $(this).find("textarea").val()
            };
         });
         $("#saving_str").html("Saving...").show();
         $.ajax({
            url: ajaxurl,
            type: "POST",
            data: d,
            success: function (v) {
               //gallery_plus_update();
               $("#saving_str").html("Saved!").fadeOut(1000);
            }
         });
      }, 1000);
   });

   //gallery_plus_update();
   
   if (!$(".upload_multiple").length) return;
   var e=$(".upload_multiple");
   var sc={ 'action': 'upload', 'file': e.attr('id'), 'type': 'image' };
   if (!e.attr("params")) e.attr("params", "");
   var s=e.attr("params").split('&');
   for (i=0; i<s.length; i++)
   {
      var a=s[i].split(/=/);
      sc[a[0]]=a[1];
   }
   sc['file'] = e.attr("id");
   sc.sessid="boo";
   $(".upload_multiple").uploadify({
      'uploader'       : '../wp-content/themes/dt-chocolate/js/upload/uploadify.swf',
      'script'         : "../wp-content/themes/dt-chocolate/uploadify.php",
      'cancelImg'      : '../wp-content/themes/dt-chocolate/js/upload/cancel.png',
      //'buttonImg'      : '../wp-content/themes/dt-chocolate/js/upload/button.png',
      'scriptData'     : sc,
      'method'         : 'GET',
      'fileDataName'   : "file",
      'fileExt'        : '*.jpg;*.JPG;*.gif;*.png',
      //'buttonText'     : unescape('Обзор...'),
      'buttonText'     : 'ADD PHOTOS',
      'width'          : 200,
      'fileDesc'       : 'Photos',
      'queueID'        : 'fileQueue',
      'auto'           : true,
      'multi'          : true,
      'onAllComplete'  : function (event, data) {
         var v=data.allBytesLoaded/1024/1024;
         var a=Math.floor(v);
         v-=a;
         v*=100;
         var b=Math.floor(v);
         $("#fileQueue").html('<i>Photos uploaded: '+data.filesUploaded+' (total &mdash; '+a+'.'+b+' MB)</i>');
         gallery_plus_update();
      },
      'onComplete'     : function (event, queueID, fileObj, response, data) {
         var js = jQuery.parseJSON(response);
         var n=e.attr('id').replace('qc_', '');
         var d= {
            action: 'gallery_plus_add_photo',
            photo:  js.filename,
            album:  $("#post_ID").val()
         };
         $.ajax({
            //url: "../wp-content/themes/dt-chocolate/uploadify.php",
            url: ajaxurl,
            type: "POST",
            data: d,
            //dataType: "json",
            success : function (v) {
               //alert(v);
               //$(".upload_multiple").uploadifyCancel(queueID);
               return false;
            },
            error : function () {
               alert("Error saving photos.");
            }
         });
         return false;
      }
   });
});

