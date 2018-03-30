<?php
	$width = $_GET['w'];
	$height = $_GET['h'];
	$src = $_GET['src'];
    $poster = $_GET['poster'];
	$ext = parse_url($src, PHP_URL_PATH);
	$ext = pathinfo($ext, PATHINFO_EXTENSION);
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />

  <!-- Include the VideoJS Library -->
    <link href="//vjs.zencdn.net/4.2.1/video-js.css" rel="stylesheet">
    <style>
        html, body{
            height: 100%;
            margin: 0;
            width: 100%;
        }
        video#example_video_1,
        div#example_video_1{
            height: 100% !important;
            width: 100% !important;
            overflow: hidden;
        }
    </style>
    <script src="//vjs.zencdn.net/4.2.1/video.js"></script>
</head>
<body>
<?php
if(strlen($poster)){
    $poster = 'poster="'.$poster.'"';
}
//	echo $width;
//	echo $height;
//	echo $src;
//	echo $ext;
//	print_r($_GET);
//	echo "Ssos";
?>
    <video id="example_video_1" class="video-js vjs-default-skin" <?php echo $poster; ?> controls preload="auto" width="<?php echo $width; ?>" height="<?php echo $height; ?>" data-setup="{}">
    <?php if($ext == 'mp4'): ?>
        <source src="<?php echo $src; ?>" type='video/mp4' />
    <?php elseif($ext == 'webm'): ?>
        <source src="<?php echo $src; ?>" type='video/webm' />
    <?php elseif($ext == 'ogv'): ?>
        <source src="<?php echo $src; ?>" type='video/ogg' />
    <?php endif; ?>
    </video>
</body>
</html>