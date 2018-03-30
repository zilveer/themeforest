<?php
  @require_once("../../../wp-config.php");
  @require_once(ABSPATH."/wp-admin/includes/file.php");
  @require_once(ABSPATH . 'wp-admin/includes/image.php');
  @require_once(ABSPATH . 'wp-admin/includes/media.php');

 abstract class Cosmo_Upload_Server_Attachment
	{
	  protected $sender;
	  protected $mime_types;
	  protected function return_success_to_sender($attach_id)
		{
		  if(!$thumbnail= wp_get_attachment_image_src( $attach_id, 'tsmall'))
			{
			  switch($_POST['type'])
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
		  $filename=explode("/",wp_get_attachment_url($attach_id));
		  $filename=array_pop($filename);
		  $js="params[\"fn_excerpt\"]=\"".substr($filename,0,8)."\";";
		  $js.="params[\"filename\"]=\"$filename\";";
		  $js.="params[\"url\"]=\"$thumbnail[0]\";";
		  $js.="params[\"w\"]=\"$thumbnail[1]\";";
		  $js.="params[\"h\"]=\"$thumbnail[2]\";";
		  $js.="params[\"attach_id\"]=\"$attach_id\";";
		  $js.="window.".$this->get_js_prefix()."Cosmo_Uploader.upload_finished(\"".$this->sender."\",params);";
		  return $js;
		}
	  
	  protected function return_error_to_sender($filename,$error)
		{
		  return "window.".$this->get_js_prefix()."Cosmo_Uploader.process_error(\"".$this->sender."\",\"$filename has not been uploaded. $error\");";
		}
	  
	  protected function insert_into_media_library($mime,$name,$new_file)
		{
		  $attachment = array(
			'post_mime_type' => $mime,
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($name)),
			'post_content' => '',
			'post_status' => 'inherit'
		  );
		  $attach_id = wp_insert_attachment( $attachment, $new_file);
		  $attach_data = wp_generate_attachment_metadata( $attach_id, $new_file);
		  wp_update_attachment_metadata( $attach_id, $attach_data );
		  return $attach_id;
		}

	  public function __construct($sender,$mimes)
		{
		  $this->mime_types=$mimes;
		  $this->sender=$sender;
		}

	  protected function check_mime_type($type)
		{
		  return in_array($type,$this->mime_types[1]);
		}

	  protected function get_mime_type_error()
		{
		  $s="Only ";
		  if(count($this->mime_types)>1)
			{
			  $last_type=array_pop($this->mime_types[0]);
			  $s.=implode($this->mime_types[0],", ");
			  $s.=" and $last_type are allowed";
			 }
		  else
			 {
				$s.=($this->mime_types[0]." is allowed");
			 }
		  return $s;
		}

	  protected abstract function get_js_prefix();//we need this because files uploaded by iframe and files uploaded by XHR provide feedback differently
	}

  class Cosmo_Upload_Server_File extends Cosmo_Upload_Server_Attachment//atachment to use with $_FILES, oldschool, bro
	{
	  protected function get_js_prefix()
		{
		  return "parent.";
		}
	  
	  public function __construct($sender,$mime_types,$file_to_upload)
		{
		  parent::__construct($sender,$mime_types);
		  $overrides=Array( "test_form" => false);
		  $response=wp_handle_upload($file_to_upload,$overrides);
		  if(isset($response["error"]))
			{
			  echo $this->return_error_to_sender($file_to_upload["name"],$response["error"]);
			}
		  else if(!$this->check_mime_type($response["type"]))
			{
			  echo $this->return_error_to_sender($file_to_upload["name"],$this->get_mime_type_error());
			}
		  else
			{
			  $attach_id=$this->insert_into_media_library($response["type"],$file_to_upload["name"],$response["file"]);
			  echo $this->return_success_to_sender($attach_id);
			}
		}
	}

  class Cosmo_Upload_Server_URL extends Cosmo_Upload_Server_Attachment
	{
	  protected function get_js_prefix()
		{
		  return "";
		}

	  public function __construct($sender,$url)
		{
		  $this->sender=$sender;
		  $tmp = download_url( $url );
		  if(!is_wp_error($tmp))
			{
			  // Set variables for storage
			  // fix file filename for query strings
			  if(isset($_POST['type']) && $_POST['type'] == 'audio'){
			  	preg_match('/[^\?]+\.(mp3|MP3)/', $url, $matches);
			  }else{
			    preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $url, $matches);
			  }
			  @$file_array['name'] = basename($matches[0]);
			  $file_array['tmp_name'] = $tmp;
			  // If error storing temporarily, unlink
   
			  // do the validation and storage stuff
			  $id = media_handle_sideload( $file_array, null);
			  // If error storing permanently, unlink
			  if ( is_wp_error($id) ) 
				{
				  @unlink($file_array['tmp_name']);
				  echo $this->return_error_to_sender($url,"Error saving file");
				}
			  else echo $this->return_success_to_sender($id);
			}
		  else
			{
			  @unlink($file_array['tmp_name']);
			  echo $this->return_error_to_sender($url,"Error downloading file");
			}
		}
	}

  class Cosmo_Upload_Server_Video extends Cosmo_Upload_Server_URL
	{
	  protected function return_video_to_sender($thumb_id,$video_url,$filename)
		{
		  if(!$thumbnail= wp_get_attachment_image_src( $thumb_id, 'tsmall'))
			{
			  $icon_url=get_template_directory_uri()."/images/attachment.video.png";
			  $thumbnail=array($icon_url,50,50);
			}
		  $js="params[\"fn_excerpt\"]=\"".substr($filename,0,8)."\";";
		  $js.="params[\"filename\"]=\"$filename\";";
		  $js.="params[\"url\"]=\"$thumbnail[0]\";";
		  $js.="params[\"w\"]=\"$thumbnail[1]\";";
		  $js.="params[\"h\"]=\"$thumbnail[2]\";";
		  $js.="params[\"attach_id\"]=\"$thumb_id\";";
		  $js.="params[\"video_url\"]=\"$video_url\";";
		  $js.="window.".$this->get_js_prefix()."Cosmo_Uploader.upload_finished(\"".$this->sender."\",params);";
		  return $js;
		}

	  public function __construct($sender,$url)
		{
		  $this->sender=$sender;
		  if(post::get_youtube_video_id($url)!='0')
			{
			  $video_id=post::get_youtube_video_id($url);
			  $service="youtube";
			}
		  else if(post::get_vimeo_video_id($url)!='0')
			{
			  $video_id=post::get_vimeo_video_id($url);
			  $service="vimeo";
			}
		  else
			{
			  echo $this->return_error_to_sender($url,"Currently only Youtube and Vimeo are supported.");
			  return;
			}
		  $video_image_url = post::get_video_thumbnail($video_id,$service);
		  $tmp = download_url( $video_image_url );
		  $id=null;
		  if(!is_wp_error($tmp))
			{
			  // Set variables for storage
			  // fix file filename for query strings
			  preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $video_image_url, $matches);
			  $file_array['name'] = basename($matches[0]);
			  $file_array['tmp_name'] = $tmp;
			  // If error storing temporarily, unlink
   
			  // do the validation and storage stuff
			  $id = media_handle_sideload( $file_array, null);
			  // If error storing permanently, unlink
			  if ( is_wp_error($id) ) 
				{
				  @unlink($file_array['tmp_name']);
				  echo $this->return_error_to_sender("Warning: video thumbnail","Could not download video thumbnail.");
				}
			}
		  else
			{
			  @unlink($file_array['tmp_name']);
			  echo $this->return_error_to_sender("Warning: video thumbnail","Could not download video thumbnail.");
			}
		  echo $this->return_video_to_sender($id,$url,$service);
		}
	}

  if(is_user_logged_in())
	{
	  if(isset($_POST['action']) && $_POST['action']=='delete' && isset($_POST['attach_id']) && is_numeric($_POST['attach_id']))
		{
		  $attach_id=$_POST['attach_id'];
		  if(wp_delete_attachment($attach_id))
			echo "Success";
		}
	  else if(isset($_POST['action']) && $_POST['action']=="upload")
		{
		  if(isset($_POST['type']))
			{
			  $type=$_POST['type'];
			}
		  
		  if($type=="image")
			{
			  $mime_types=array(array("GIF","JPEG","PNG"),array("image/gif","image/jpeg","image/png"));
			}
		  else if($type=="gallery")
			{
			  $mime_types=array(array("GIF","JPEG","PNG"),array("image/gif","image/jpeg","image/png"));
			}			
		  else if($type=="video")
			{
			  $mime_types=array(array("MP4","FLV","WEBM","OGV"),array("video/mp4","video/x-flv","video/webm","video/ogg" ) );
			}
		  else if($type=="audio")
			{
			  $mime_types=array(array("MP3"),array("audio/mpeg"));
			}
		  else if($type=="link")
			{
			   $mime_types=array(array("PDF", "DOC", "ZIP", "RAR"),array("application/pdf","application/msword","application/zip", "application/rar" , 'application/x-rar' , 'application/x-rar-compressed' ));
			}
		  else exit(0);

		  if(isset($_POST['action']) && $_POST['action']!="add_url")
			{
			  echo "<html><head><title>Upload</title></head><body><script type=\"text/javascript\">";
			  echo "var params=new Array();";
			  $files=$_FILES['files_to_upload'];
			  foreach($files['name'] as $key=>$value)
				{
				  $file = array(
					'name'     => $files['name'][$key],
					'type'     => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error'    => $files['error'][$key],
					'size'     => $files['size'][$key]
				  );
				  new Cosmo_Upload_Server_File($_POST['sender'],$mime_types,$file);
				}
			  echo "</script></body></html>";
			}
		}
	  else if(isset($_POST['action']) && $_POST['action']=="add_url" && isset($_POST['type']))
		{
		  echo "var params=new Array();";
		  if($_POST['type']=="image")
			new Cosmo_Upload_Server_URL($_POST['sender'],$_POST['url']);
		  if($_POST['type']=="gallery")
			new Cosmo_Upload_Server_URL($_POST['sender'],$_POST['url']);		
		  else if($_POST['type']=="video")
			new Cosmo_Upload_Server_Video($_POST['sender'],$_POST['url']);
		  else if($_POST['type']=="link")
			new Cosmo_Upload_Server_URL($_POST['sender'],$_POST['url']);
		  else if($_POST['type']=="audio")
			new Cosmo_Upload_Server_URL($_POST['sender'],$_POST['url']);
		}
	}
?>