jQuery(document).ready(function($) {

            // image uploader
            var custom_uploader;
            var wp_media_post_id = wp.media.model.settings.post.id;

            $('.uploader-image-button').on('click', function(event) {
              event.preventDefault();

              var uploader_button   = $(this);
              set_to_post_id = uploader_button.data('id')
              var target     = uploader_button.prev();
              
              // if media frame exists, reopen
              if(custom_uploader) {
                // set post id
                custom_uploader.uploader.uploader.param('post_id', set_to_post_id);
                custom_uploader.open();
                return;
              } else {
                // set the wp.media post id so the uploader grabs the id we want when initialised
                wp.media.model.settings.post.id = set_to_post_id;
              }

              // create media frame
              custom_uploader = wp.media.frames.custom_uploader = wp.media({
                title: uploader_button.data('title'),
                button: { text: uploader_button.data('text') },
                multiple: true
              });

              // when image selected, run callback
              custom_uploader.on('select', function(){
                var selection = custom_uploader.state().get('selection');
                var files     = [];
                selection.map( function( attachment ) {
                  attachment = attachment.toJSON();
                  files.push(attachment.url);
                  uploader_button.prev().val(files);
                });

                uploader_button.next().html('');

                for (var i=0; i<files.length; i++){
                  var ext = files[i].substr(files[i].lastIndexOf(".") + 1, files[i].length);
                  uploader_button.next().append('<div class="row-image"><img src="' + files[i] + '" alt="" /></div>');
                }
            
                // restore main post id
                wp.media.model.settings.post.id = wp_media_post_id;
              });

              // open our awesome media frame
              custom_uploader.open();
            });

            // restore main id when media button is pressed
            jQuery('a.add_media').on('click', function() {
              wp.media.model.settings.post.id = wp_media_post_id;
            });

          });  