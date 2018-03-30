<?php class CosmoUploader
  {
    private static function add_thumbnail($id, $js_obj,$post_format=false,$video_url="")
      {
        if(!$thumbnail= wp_get_attachment_image_src( $id, 'tsmall'))
          {
            switch($post_format)
              {
                case 'audio':
                    $icon_url=get_template_directory_uri()."/images/attachment.audio.png";
                    break;
                 case 'video':
                    $icon_url=get_template_directory_uri()."/images/attachment.video.png";
                    break;
                case 'link':
                    $icon_url=get_template_directory_uri()."/images/attachment.file.png";
                  break;
              }
            $thumbnail=array($icon_url,50,50);
          }
        if($url=wp_get_attachment_url($id))
          {
            $filename=explode("/",$url);
            $filename=array_pop($filename);?>
            params["fn_excerpt"]="<?php echo substr($filename,0,8)?>";
            params["filename"]="<?php echo $filename?>";
            params["url"]="<?php echo $thumbnail[0]?>";
            params["w"]="<?php echo $thumbnail[1]?>";
            params["h"]="<?php echo $thumbnail[2]?>";
            params["attach_id"]="<?php echo $id?>";
            params["video_url"]="<?php echo $video_url?>";
            <?php echo $js_obj?>.upload_finished_with_success(params);
        <?php }
      }

    public static function init_for_floating_form()
        {?>
            <link rel='stylesheet' id='frontend-css'  href='<?php echo get_template_directory_uri()?>css/autoinclude/frontend.css?ver=3.4.2' type='text/css' media='all' />
            <iframe name="hidden_upload_iframe" class="hidden" style="height: 1px;overflow: hidden;"></iframe>
            <script type="text/javascript">
                Cosmo_Uploader.template_directory_uri="<?php echo get_template_directory_uri()?>";
                Cosmo_Uploader.init();
            </script>
            <div class="cosmo_uploader_interface cosmo_floating_uploader hidden" id="floating_uploader">
                <div class="cui_thumbnail_container">
                    <div class="cui_upload_button_container cui_add_button">
                        <img src="<?php echo get_template_directory_uri()?>/images/upload.png">
                        <form class="cui_form" action="<?php echo get_template_directory_uri()?>/upload-server.php" method="post" enctype="multipart/form-data" target="hidden_upload_iframe">
                            <input type="file" name="files_to_upload[]" class="cui_files_to_upload" tabindex="-1">
                            <input type="hidden" name="type" value="image">
                            <input type="hidden" name="action" value="upload">
                            <input type="hidden" name="sender">
                        </form>
                        <a href="javascript:void(0);">Upload</a>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                window.floating_uploader=Cosmo_Uploader.Basic_Functionality("floating_uploader");
                Cosmo_Uploader.Featured_Functionality(window.floating_uploader);
                Cosmo_Uploader.Degenerate_Into_Featured_Image_Uploader(window.floating_uploader);
            </script>
        <?php
        }

    public static function print_form($text,$type, $url, $feat, $first_columns = 'two', $second_columns= 'seven' ){?>
        <div class="field">
          <div class="cosmo_uploader_label" id="label_<?php echo $type?>_upload">
            <div class="row grid-view">
                <div class="columns <?php echo $first_columns;?>">
                    <label>
                        <h4><?php echo $text?></h4>
                    </label>
                </div>
                <div class="<?php echo $second_columns;?> columns">
                  <div class="cosmo_uploader_interface">
                    <div class="cui_thumbnail_container">
                      <div class="cui_upload_button_container cui_add_button">
                        <img src="<?php echo get_template_directory_uri()?>/images/upload.png">
                        <form class="cui_form" action="<?php echo get_template_directory_uri()?>/upload-server.php" method="post" enctype="multipart/form-data" target="hidden_upload_iframe">
                          <input type="file" name="files_to_upload[]" class="cui_files_to_upload" multiple="true" tabindex="-1">
                          <input type="hidden" name="type" value="<?php echo $type?>">
                          <input type="hidden" name="action" value="upload">
                          <input type="hidden" name="sender">
                        </form>
                        <a href="javascript:void(0);">Upload</a>
                      </div>
                      <?php if($url){ ?>
                      <div class="cui_add_url_button_container cui_add_button">
                        <a href="javascript:void(0);">
                          <img src="<?php echo get_template_directory_uri()?>/images/link.png">
                          Add URL
                        </a>
                      </div>
                      <?php } ?>
                  </div>
                  <div class="cui_spinner_container">
                    <div id="fountainG" style="display:block;">
                          <div id="fountainG_1" class="fountainG"></div>
                          <div id="fountainG_2" class="fountainG"></div>
                          <div id="fountainG_3" class="fountainG"></div>
                          <div id="fountainG_4" class="fountainG"></div>
                          <div id="fountainG_5" class="fountainG"></div>
                          <div id="fountainG_6" class="fountainG"></div>
                          <div id="fountainG_7" class="fountainG"></div>
                          <div id="fountainG_8" class="fountainG"></div>
                      </div> 
                    <p></p>
                  </div>
                </div>
                <p class="info">
                  <strong><?php _e('Upload a file.','cosmotheme'); ?></strong>
                  <?php 

                  
                  switch($type)
                          {
                            case 'image': _e('JPEG, GIF or PNG. ','cosmotheme');
                                if(!isset($_GET['isadmin'])){
                                          _e('Click on a thumbnail to make it featured. ','cosmotheme');
                                }
                                break;
                            case 'gallery': _e('JPEG, GIF or PNG. ','cosmotheme');
                                        if(!isset($_GET['isadmin'])){
                                          _e('Click on a thumbnail to make it featured. ','cosmotheme');
                                        }  
                                break;
                            case 'video': _e('MP4 only. ','cosmotheme');
                                        if(!isset($_GET['isadmin'])){
                                          _e('Click on a thumbnail to make it featured. ','cosmotheme');
                                        }  
                                break;
                            case 'audio': _e('MP3 only. ','cosmotheme');
                                break;
                            case 'link': _e('ZIP, RAR, PDF or DOC. ','cosmotheme');
                                break;
                          }
                  ?>
                  <?php  ?><br>
                  <span class="cui_error_container warning"></span>
                </p>
               </div>
            </div>
          </div>
         </div>
         <?php if($url){?>
         <div class="field" id="label_<?php echo $type?>_url">
          <div class="label_add_url">
            <div class="<?php echo $first_columns;?> columns">
                <label>
                    <h4><?php _e('Add URL','cosmotheme'); ?></h4>
                </label>
            </div>
            <div class="<?php echo $second_columns;?> columns">
                <input type="text" name="image_url" value="" class="generic-record front_post_input add_url"  />
                <p class="info">
                  <a class="post_link add_url_link" href="javascript:void(0);"><strong><?php _e('Add URL','cosmotheme'); ?></strong></a>
                </p>
            </div>
          </div>
        </div>
        <?php } ?>
        <script type="text/javascript">
          window.<?php echo $type?>_uploader=Cosmo_Uploader.Basic_Functionality("label_<?php echo $type?>_upload");
          <?php if($url) echo "Cosmo_Uploader.URL_Functionality(window.${type}_uploader,\"label_${type}_url\");"?>
          <?php if($feat) echo "Cosmo_Uploader.Featured_Functionality(window.${type}_uploader);"?>
          <?php if($type=="video") echo "Cosmo_Uploader.Video_Functionality(window.video_uploader);"?>
        </script>
    <?php }

    public static function print_feat_img_form($id, $first_columns = 'two' , $second_columns = 'seven' )
      {?>
        <div class="field">
          <div class="cosmo_uploader_label" id="label_<?php echo $id?>_feat_img_upload">
            <div class="<?php echo $first_columns;?>  columns">
                <label>
                    <h4>Featured image</h4>
                </label>
            </div>
            <div class="<?php echo $second_columns;?> columns">
                <div class="cosmo_uploader_interface">
                  <div class="cui_thumbnail_container">
                    <div class="cui_upload_button_container cui_add_button">
                      <img src="<?php echo get_template_directory_uri()?>/images/upload.png">
                        <form class="cui_form" action="<?php echo get_template_directory_uri()?>/upload-server.php" method="post" enctype="multipart/form-data" target="hidden_upload_iframe">
                          <input type="file" name="files_to_upload[]" class="cui_files_to_upload" tabindex="-1">
                          <input type="hidden" name="type" value="image">
                          <input type="hidden" name="action" value="upload">
                          <input type="hidden" name="sender">
                        </form>
                      <a href="javascript:void(0);">Upload</a>
                    </div>
                    <div class="cui_add_url_button_container cui_add_button">
                      <a href="javascript:void(0);">
                        <img src="<?php echo get_template_directory_uri()?>/images/upload.png">
                        Add URL
                      </a>
                    </div>
                </div>
                <div class="cui_spinner_container">
                  <div id="fountainG" style="display:block;">
                      <div id="fountainG_1" class="fountainG"></div>
                      <div id="fountainG_2" class="fountainG"></div>
                      <div id="fountainG_3" class="fountainG"></div>
                      <div id="fountainG_4" class="fountainG"></div>
                      <div id="fountainG_5" class="fountainG"></div>
                      <div id="fountainG_6" class="fountainG"></div>
                      <div id="fountainG_7" class="fountainG"></div>
                      <div id="fountainG_8" class="fountainG"></div>
                  </div> 
                  <p></p>
                </div>
              </div>
              <p class="info">
                <strong><?php _e('Upload a file.','cosmotheme'); ?></strong> <?php _e('JPEG, GIF or PNG.','cosmotheme'); ?><br>
                <span class="cui_error_container warning"></span>
              </p>
          </div>
        </div>
      </div>
      <div class="field" id="label_<?php echo $id?>_feat_img_url">
        <div class="label_add_url">
            <div class="<?php echo $first_columns;?>  columns">
                <label>
                    <h4><?php _e('Add URL','cosmotheme'); ?></h4>
                </label>
            </div>
            <div class="<?php echo $second_columns;?> columns">
              <input type="text" name="image_url" value="" class="generic-record front_post_input add_url"  />
              <p class="info">
                <a class="post_link add_url_link" href="javascript:void(0);"><strong><?php _e('Add URL','cosmotheme'); ?></strong></a>
              </p>
            </div>
        </div>
      </div>
      <script type="text/javascript">
        window.<?php echo $id?>_feat_img_uploader=Cosmo_Uploader.Basic_Functionality("label_<?php echo $id?>_feat_img_upload");
        Cosmo_Uploader.URL_Functionality(window.<?php echo $id?>_feat_img_uploader,"label_<?php echo $id?>_feat_img_url");
        Cosmo_Uploader.Featured_Functionality(window.<?php echo $id?>_feat_img_uploader);
        Cosmo_Uploader.Degenerate_Into_Featured_Image_Uploader(window.<?php echo $id?>_feat_img_uploader);
      </script>
    <?php }

    public static function init( $type = false ){
        echo '<iframe name="hidden_upload_iframe" class="hidden hidden_upload_iframe" style="overflow:hidden;"></iframe>';
        ?>
        <script type="text/javascript">
            Cosmo_Uploader.template_directory_uri="<?php echo get_template_directory_uri();?>";
            Cosmo_Uploader.init();
            jQuery( function(){
                var params = new Array();
        <?php
          if( isset( $_GET[ 'post' ] ) ){
              $post_id = $_GET['post'];
              if( !$type ){
                  $post_format = get_post_format( $post_id );
              }else{
                  $post_format = $type;
              }
              switch( $post_format ){
                  case "image":
                      $thumb_obj = "window.image_uploader";
                      $file_obj = "window.image_uploader";
                      if( $thumb_id = get_post_thumbnail_id( $post_id ) ){
                          if( !$type ){
                              self::add_thumbnail($thumb_id, $thumb_obj,$post_format);
                          }
                      }
                      if( $attached_imgs = meta::get_meta( $_GET['post'], 'format' ) ){
                          if( isset( $attached_imgs[ "images" ] ) && is_array( $attached_imgs[ "images" ] ) ){
                              foreach( $attached_imgs[ "images" ] as $img_id ){
                                  self::add_thumbnail( $img_id, $file_obj, $post_format );
                              }
                          }
                      }
                      break;

                  case "gallery":
                      $thumb_obj = "window.gallery_uploader";
                      $file_obj = "window.gallery_uploader";
                      if( $thumb_id = get_post_thumbnail_id( $post_id ) ){
                          if( !$type ){
                              self::add_thumbnail( $thumb_id, $thumb_obj, $post_format );
                          }
                      }

                      if( $attached_imgs = meta::get_meta( $_GET[ 'post' ], 'format' ) ){
                          if( isset( $attached_imgs[ "images" ] ) && is_array( $attached_imgs[ "images" ] ) ){
                              foreach( $attached_imgs[ "images" ] as $img_id ){
                                  self::add_thumbnail( $img_id, $file_obj, $post_format );
                              }
                          }
                      }
                      break;

                  case "video":
                      $thumb_obj = "window.video_uploader";
                      $file_obj = "window.video_uploader";
                      if( $video_format = meta::get_meta( $_GET[ 'post' ], 'format' ) ){
                          $feat_id = isset ($video_format[ "feat_id" ]) ? $video_format[ "feat_id" ] : '';
                          $feat_url = false;
                           $video_format[ "feat_url" ]  = isset ($video_format[ "feat_url" ]) ? $video_format[ "feat_url" ] : '';
                          if( strlen( $video_format[ "feat_url" ] ) > 1 ){
                              $feat_url = $video_format[ "feat_url" ];
                          }
                          self::add_thumbnail( $feat_id, $thumb_obj, $post_format, $feat_url );
                          if( isset( $video_format[ "video_ids" ] ) && is_array( $video_format[ "video_ids" ] ) ){
                              foreach( $video_format[ "video_ids" ] as $vid_id ){
                                  $video_url=false;
                                  if( isset( $video_format[ 'video_urls' ][ $vid_id ] ) && strlen( $video_format[ 'video_urls' ][ $vid_id ] ) > 1 ){
                                      $video_url=$video_format["video_urls"][$vid_id];
                                  }
                                  self::add_thumbnail( $vid_id, $thumb_obj, $post_format, $video_url );
                              }
                          }
                      }
                      break;

                  case "audio":
                      $thumb_obj = "window.audio_feat_img_uploader";
                      $file_obj = "window.audio_uploader";
                      if( $thumb_id = get_post_thumbnail_id( $post_id ) ){
                          if(!$type) self::add_thumbnail($thumb_id, $thumb_obj,$post_format);
                      }
                      if( $attached_audio = meta::get_meta( $_GET['post'], 'format' ) ){
                          if(isset($attached_audio["audio"]) && is_array($attached_audio["audio"])){
                              foreach($attached_audio["audio"] as $audio_id){
                                  self::add_thumbnail($audio_id, $file_obj,$post_format);
                              }
                          }
                      }
                      break;

                  case "link":
                      $thumb_obj = "window.link_feat_img_uploader";
                      $file_obj = "window.link_uploader";
                      if( $thumb_id = get_post_thumbnail_id( $post_id ) ){
                          if( !$type ){
                              self::add_thumbnail( $thumb_id, $thumb_obj, $post_format );
                          }
                      }
                      if( $attached_files = meta::get_meta( $_GET['post'], 'format' ) ){
                          if( isset( $attached_files[ "link_id" ] ) && is_array( $attached_files[ "link_id" ] ) ){
                              foreach( $attached_files[ "link_id" ] as $file_id ){
                                  self::add_thumbnail( $file_id, $file_obj, $post_format );
                              }
                          }
                      }
                      break;
              }
          }
        ?>
         });
         </script>
        <?php
      }
  }
?>