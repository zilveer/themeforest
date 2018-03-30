<?php


/**
 * Checks system requirements right after activating theme for the first time
 */
class AitRequirementsChecker
{
	private $requirements;
	private $previousTemplate;
	private $report;



	public function __construct($previousTemplate)
	{
		$this->addTests();

		$this->report = (object) null;
		$this->report->errors = false;
		$this->report->warnings = false;
		$this->previousTemplate = $previousTemplate;
	}



	private function addTests()
	{
		$url = get_template_directory_uri() . '/ait-theme/@framework/admin/assets/checker';

		global $wp_version;

		$this->requirements[] = array(
			'title'        => __('WordPress version', 'ait-admin'),
			'required'     => TRUE,
			'passed'       => version_compare("4.0", $wp_version, '<='),
			'message'      => $wp_version,
			'errorMessage' => $wp_version,
			'description'  => __('This AIT Theme requires WordPress 4.0 or newer.', 'ait-admin'),
		);


		$this->requirements[] = array(
			'title'        => __('PHP Version', 'ait-admin'),
			'required'     => TRUE,
			'passed'       => version_compare(PHP_VERSION, '5.3.1', '>='),
			'message'      => PHP_VERSION,
			'errorMessage' => PHP_VERSION,
			'description'  => __('PHP version must be at least 5.3.1. But we recommend you to switch to the most recent versions of PHP (5.6 or 7), because 5.3 branch reached end of life last year and is no longer maintained, and you are risking serious security issues and performance issues.', 'ait-admin'),
		);

		$limitPassed = (intval(ini_get('memory_limit')) == -1 or intval(ini_get('memory_limit')) >= 96);
		$mb = 96;

		$this->requirements[] = array(
			'title'        => __('Memory limit', 'ait-admin'),
			'required'     => FALSE,
			'passed'       => $limitPassed,
			'message'      => ini_get('memory_limit'),
			'errorMessage' => ini_get('memory_limit'),
			'description'  => sprintf(__('Memory limit is too low. At least <b>%sMB</b> are needed for AIT Theme to work properly.', 'ait-admin'), $mb),
		);

		$this->requirements[] = array(
			// translators: "wp-content/uploads" is exact path to folder
			'title'        => __('Read/Write permissions for wp-content/uploads folder', 'ait-admin'),
			'required'     => TRUE,
			'passed'       => $this->canWriteToUploadDir(),
			'message'      => __('Yes', 'ait-admin'),
			'errorMessage' => __('False', 'ait-admin'),
			'description'  => __('PHP is not allowed to write to "wp-content/uploads" directory', 'ait-admin'),
		);

		$this->requirements[] = array(
			'title'       => __('Function flock()', 'ait-admin'),
			'required'    => FALSE,
			'passed'      => flock(fopen(__FILE__, 'r'), LOCK_SH),
			'description' => __('Function <code>flock()</code> is not supported on this filesystem. AIT Theme requires this to process atomic file operations.', 'ait-admin'),
		);

		$this->requirements[] = array(
			'title'       => __('Function gzcompress()', 'ait-admin'),
			'required'    => FALSE,
			'passed'      => function_exists('gzcompress'),
			'description' => __('Function <code>gzcompress()</code> is not enabled. AIT Theme require it for data backuping process.', 'ait-admin'),
		);

		$this->requirements[] = array(
			'title'       => __('Function gzuncompress()', 'ait-admin'),
			'required'    => FALSE,
			'passed'      => function_exists('gzuncompress'),
			'description' => __('Function <code>gzuncompress()</code> is not enabled. AIT Theme require it for data backuping process.', 'ait-admin'),
		);

		$this->requirements[] = array(
			'title'        => 'register_globals',
			'required'     => FALSE,
			'passed'       => !$this->iniFlag('register_globals'),
			'message'      => __('Disabled', 'ait-admin'),
			'errorMessage' => __('Enabled', 'ait-admin'),
			'description'  => __('Configuration directive <code>register_globals</code> is enabled. We recommend this to be disabled for security reasons.', 'ait-admin'),
		);

		$this->requirements[] = array(
			// translators: "Reflection" is the name of the extension
			'title'       => __('Reflection extension', 'ait-admin'),
			'required'    => TRUE,
			'passed'      => class_exists('ReflectionFunction'),
			'description' => __('Reflection extension is required.', 'ait-admin'),
		);

		$this->requirements[] = array(
			// translators: "SPL" is the name of the extension
			'title'       => __('SPL extension', 'ait-admin'),
			'required'    => TRUE,
			'passed'      => extension_loaded('SPL'),
			'description' => __('SPL extension is required.', 'ait-admin'),
		);

		$this->requirements[] = array(
			// translators: "PCRE" is the name of the extension
			'title'        => __('PCRE extension', 'ait-admin'),
			'required'     => TRUE,
			'passed'       => extension_loaded('pcre') && @preg_match('/pcre/u', 'pcre'),
			'message'      => __('Enabled and works properly', 'ait-admin'),
			'errorMessage' => __('Disabled or without UTF-8 support', 'ait-admin'),
			'description'  => __('PCRE extension is required and must support UTF-8.', 'ait-admin'),
		);

		$this->requirements[] = array(
			// translators: "ICONV" is the name of the extension
			'title'        => __('ICONV extension', 'ait-admin'),
			'required'     => TRUE,
			'passed'       => extension_loaded('iconv') && (ICONV_IMPL !== 'unknown') && @iconv('UTF-16', 'UTF-8//IGNORE', iconv('UTF-8', 'UTF-16//IGNORE', 'test')) === 'test',
			'message'      => __('Enabled and works properly', 'ait-admin'),
			'errorMessage' => __('Disabled or does not work properly', 'ait-admin'),
			'description'  => __('ICONV extension is required and must work properly.', 'ait-admin'),
		);

		$this->requirements[] = array(
			'title'       => 'PHP tokenizer',
			'required'    => TRUE,
			'passed'      => extension_loaded('tokenizer'),
			'description' => __('PHP tokenizer is required.', 'ait-admin'),
		);

		$this->requirements[] = array(
			// translators: "Multibyte String" is the name of the extension
			'title'       => __('Multibyte String extension', 'ait-admin'),
			'required'    => FALSE,
			'passed'      => extension_loaded('mbstring'),
			'description' => __('Multibyte String extension is absent. Some internationalization components may not work properly.', 'ait-admin'),
		);

		$this->requirements[] = array(
			// translators: "Multibyte String" is the name of the extension
			'title'        => __('Multibyte String function overloading', 'ait-admin'),
			'required'     => FALSE,
			'passed'       => !extension_loaded('mbstring') || !(mb_get_info('func_overload') & 2),
			'message'      => __('Disabled', 'ait-admin'),
			'errorMessage' => __('Enabled', 'ait-admin'),
			'description'  => __('Multibyte String function overloading is enabled. AIT Theme requires this to be disabled. If it is enabled, some string function may not work properly.', 'ait-admin'),
		);

		$this->requirements[] = array(
			// translators: "Multibyte String" is the name of the extension
			'title'       => __('GD/ImageMagick extension', 'ait-admin'),
			'required'    => TRUE,
			'passed'      => extension_loaded('gd') || extension_loaded('imagick'),
			'description' => __('GD and ImageMagick extensions are absent. WordPress requires any of them for image resizing.', 'ait-admin'),
		);

		$this->requirements[] = array(
			'title'        => __('Max input variables', 'ait-admin'),
			'required'     => FALSE,
			'passed'       =>(intval(ini_get('max_input_vars')) >= 3000),
			'message'      => ini_get('max_input_vars'),
			'errorMessage' => ini_get('max_input_vars'),
			'description'  => __('Due to multilingual support in the theme, it is recommended that max_input_vars PHP option in php.ini config file is at least <b>3000</b>.', 'ait-admin'),
		);
	}



	public function check()
	{
		foreach(array('function_exists', 'version_compare', 'extension_loaded', 'ini_get') as $function){
			if(!function_exists($function)){
				trigger_error("Critical error: php function '$function' is not present.");
				switch_theme($this->previousTemplate);
				exit;
			}
		}

		foreach($this->requirements as $id => $requirement){
			$this->requirements[$id] = $requirement = (object) $requirement;
			if(isset($requirement->passed) && !$requirement->passed){
				if($requirement->required){
					$this->report->errors = TRUE;
				}else{
					$this->report->warnings = TRUE;
				}
			}
		}

		return $this->report;
	}



	public function displayReport()
	{
		$this->displayCheckerTemplate();
		exit;
	}


	private function canWriteToUploadDir()
	{
		$uploadDir = wp_upload_dir();
		return is_writable($uploadDir['basedir']);
	}



	/**
	 * Gets the boolean value of a configuration option.
	 * @param  string  configuration option name
	 * @return bool
	 */
	private function iniFlag($var)
	{
		$status = strtolower(ini_get($var));
		return $status === 'on' || $status === 'true' || $status === 'yes' || (int) $status;
	}



	protected function displayCheckerTemplate()
	{
		header('Content-Type: text/html; charset=utf-8');
		header('Cache-Control: s-maxage=0, max-age=0, must-revalidate');
		header('Expires: Mon, 23 Jan 1978 10:00:00 GMT');
	?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="noindex">

	<title>
	<?php
		// translators: "AIT Themes" is a name
		_e('AIT Themes Requirements Checker', 'ait-admin');
	 ?>
	</title>

	<style>
		@import url("<?php echo site_url('/wp-includes/css/buttons.min.css'); ?>");
		html {font: 13px/1.5 Verdana, sans-serif; }
		body {border-top: 1px solid #E4DED5; margin: 0; background: white; color: #333; }
		#wrapper {max-width: 780px; margin: 0 auto 30px auto; }
		#logo {width: 50px; height: 50px; }
		h1 {font: 2.3em/1.5 sans-serif; line-height: 90px; color: #4f8ba9; background: url('data:image/gif;base64,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') right center no-repeat; text-shadow: 1px 1px 0 white; }
		h2 {font-size: 2em; font-weight: normal; color: #7A7772; margin: .7em 0; }
		p {margin: 1.2em 0; }
		hr {border: 0; height: 1px; background: #333; background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc); background-image:    -moz-linear-gradient(left, #ccc, #333, #ccc); background-image:     -ms-linear-gradient(left, #ccc, #333, #ccc); background-image:      -o-linear-gradient(left, #ccc, #333, #ccc); }
		.result {margin: 1.5em 0; padding: 0 1em; border: 2px solid white; }
		.passed h2 {color: #1A7E1E; }
		.failed h2 {color: white; }
		table {padding: 0; margin: 0; border-collapse: collapse; width: 100%; }
		table td, table th {text-align: left; padding: 10px; vertical-align: top; border-style: solid; border-width: 1px 0 0; border-color: inherit; background: white none no-repeat 12px 8px; background-color: inherit; }
		table th {font-size: 105%; font-weight: bold; padding-left: 50px; }
		.passed, .info {background-color: #E4F9E3; border-color: #C6E5C4; }
		.passed th {background-image: url('data:image/gif;base64,R0lGODlhFwAXAOYAACONLkylVsrWzaXXqzKTPcXoyHu/hL7kwcHgxTqTQySDLlisYlGoW0ShTu/77d7w4jCDOZeymsPSxRuBIy+MOVynZFSqXkKgTG25d0mkU6LQp/b89O/77WezcLPauPv++9n02er66eb55VGkWix+Ne376+T54/n99+T54oTEiz2cSNbg1/P88GGxa/b79h13JjSXP7DdtS2QONHo0/T88iFqKhyIJt7237nivTGVO9fs2kiAT87tzzibQ+j653O5e0GdSz6YRzyPRZHLmNry2zmaRDuXROj55TybRiqTNkeiUT6fSU2nVy2UOPH77zyZRUCdSXW9fjaIPzeKQOr66OX55N713uf65kulVOX548jlzYnFkJ/QpbvLven0643Jlun16ypyM0+oWUmjUtju2E2kVrfcu+337sDMwd/14LHVtfT79dDe0FarYOT54z6eSCCDG3+ihTiQQaW3pny7hMrcy9Lx1NDm0crPyrbFuLfIub/HwIjHkKvAreT54////ywAAAAAFwAXAAAH/4B+goN+IiUlPiI+JRw+hI+CKCYOVTwFBwcFmiAOPiiQfihUJTwxXwZRP1EGKRoHVw6fhKIhOHwdC0xiTLwLHQYDRLGEVxwDGAsZbQvMzRkZLXxpw4IsOC0BTAttFt0WbW0MLUxtQ4iCJUQYGUzdDO/vbT1bHhe7ODSCGwNLAe9iAAEyaHDBxQEYTN5EuZLIQZQeASIykZgtiYc/XGAEaJChAAcHPAJceIZFyYUAWAIk+fHnj4YcWDL0GLDBSQGCSjIg6THmZI83YFpySaJESQ4+J2xmUNGgRw4EWppcAGCm5QwkSBo0SJIiaQElSIq80dGyAxyWf3TAaEIQSJIhJ+ZC3FiQAwmMi38Q5PDy54wKAA2gQFGRI8aGKjQMAAACw4aGPx8e/FlTBoBgFVByKAFRwg+NAzIIBCHguKWLETaCGHnyxIiNFBtMFNrwY0ICIwQmqPlQYYJqI0aCKABihUMkDlYYKJAThIKcCgoSyJkuRwGBAxtkhaJRpcILCHIgKJgyRYqUKS8oHPiQZZafDQ7oKHhBAgIEEiRevKhg58QR7X6YYMUdbKwQwQ5h1KBgDTvEIcAKdZDxSBVE1NFFHnjs0UcEHM6xBx5o6CHBDCbINogJIjB0BRUc0OCiEyFcUcUVMg4SCAA7'); }
		.info th {background-image: url('data:image/gif;base64,R0lGODlhFgAVAOYAAOT548HpvzGV1n284gFuu8Xl3SGGxbrsuLrc1aXU1SSJyfT54h6Dw////5jG1CyQ0DKa2+X04imOzSeLyur36YK61DCS0ubx3wBqtDaNw7PV1BqBvjSY1nS23JnM55S4tt/z3ozG4wZ4vQRbmRh+veP14tPy0lKdyRuFyQBksTSa2DmW0zWd3iiT1x6L0g96utro2tzt3BuIztz43Duf3ef55uT140ec0BV9u9DgzkSj4wJ4xJ7Q5M/k8yKKzeH04O30+gN0uzec2iSN0CSR1N7t2+P34zd5p/P5+yKJyM7zzRGE0zWW1RWBya7EsKrS6zye4i2IwyaP2ymP0lyl01yt3Vut61Cq6bnc4RN7t+L24eDv+Wat0t3s9zOV1M/hzqLxorDlrkCRwNTfwjuRxVyjwuXvzymRzu303k2q5xuK2BFyuT2c16LP4OXt0USn6E6m5Uql6iWLy9nr3haBx2y35oe/5Pz85fr56Ovw19n02Nzx2sbc11Cn6Lfg2eD44CH5BAAAAAAALAAAAAAWABUAAAf/gACCgyULNjFFRRGGg42NPz8BWDwhlTxYBz8ljoR7bR1WV3A6b2lWdR56m442Jh19OhAQLCyyEDpxHUqrgjYgXFCyNMMtxTS1UFUmNoM2FVIqLEJCKi0eSANE1BBSHX8gADZhcgIqHEwcRGxADT1EAhwcAmoJRgALFUvyAgJeAjIDgHRw4c8LhyVV7F044cKCQwFTXKxwsUOGF4cOhzBRYoPPmSEPQvpY8QRJAzsyQqqcIsMPBQ10JMiUMJJkgy0+FMyUMASFSwQoFEwYOkEBAQ/tUBggWrSJyzkZmihIkkQBAxRdGoQIoqBr16sFKCwos8OAWQM7bjRocEPEWbMiiW58w+OAAAMGBhgQ6NAAyBq3d/ESqFADwA8bYuxu2ECAytoeVEQs1htlhpZeBwgQ2EACR5ATDjpEeUFiQxAMYAoPekkgBY7OGFJgIE0CA4YEqgeBoFCAjGwRL7K8EBE7Q4E74BzBAIHmw5ER0KEf+ZBnAYwYjmLAyJHDzRgnH8I7GWPmS47rgwIBADs='); }
		.warning {background-color: #FEFAD4; border-color: #EEEE99; }
		.warning th {background-image: url('data:image/gif;base64,R0lGODlhGQAVAOYAAP+3M/z/9ezkwf+yJv/vuf+mIdvayv/GXv+5Of+uJfLuyv/Yif++R+W0Pop+ZsigS+OXL+Dm2P/EVLyRQf+2LP740vz10dXVxv/JOn5mNvz/7f/Na/3/5fz/8f+0KExTXv+/RP7+4f+qI/740//wwWNkXv+9P/3/6f/72uWVJv761/740tnYyP+jIv/AS//elv7zyv/dY/741P+9Qf/Oc//CKv/CRPWrJ//JYv/Ha/750v7/3uGTLOfqz+KXL//YXP761f771v+yIv/rsv/pr+maLf/Sc//YTv793vz62f/PXv/HLv/HJiw1UCI0cCUmOf+2Lv+5Of+8Pf782P+tJP/+6/+iH//KRP382v372//717mTSsyhSP/lpf/NSP+WJP740e22Sf+6LteiXP/CZf+1JqmRXf+yLP+SI//Td312Zfnzz96bQ9/fzKKOYdnk3v+8KuHfxP6zJf+7O9/ZxP+8Qv+7QdzPsf/mq9fXyP+1LcSXNf+yLURNWf750/761CwAAAAAGQAVAAAH/4B/goOEhYaHiImKhFM6JCRBWSOLhX46IUMLC0RIfpSEOhwkNAcHGwQnnoaqhUEnaSA4OCBGJ1OHfp6qQCsaQwwHMTEHDF0aFayVqjtJOC5KDw9KLgcqOxW4njo6HS8IP1xPT1w/UQsdiLm8HDAMM0dbTU0TRyAzJKnZfx1GfC5XYT70aeDFBZQNHYIgAuOLggkQNmyUKDHDBgg7Z/B0wGYoywkJA2ZImYPBgRoMJqSY8OAiBJZkf3QEeJEgik0ES8y4WYLAZhQqLwLo+APkj4wRSJLUEQKgKYAaDRrUcApgAAALHFbo8FShwwIRFKBQoCCmTIYMcuCEHSuChlBkfnvY6RHiYYAHD0z2OHEygcndu0KoEDkxKYiGHC0SJBDCeMANBw5ueFgsRHELMhpG+NFSJceXFgVCF7AiggqVAqBDt7CChkwAFEDWKKAzJgUPHhAg+IBQpMju3LlTsLnTQ4EFCwp6vGnDgoWBPBeaX4Cex7mBOBEiCFCwIhAAOw=='); }
		.failed {background-color: #F4D2D2; border-color: #D2B994; }
		div.failed {background-color: #CD1818; border-width: 1px; border-color: #333 } .failed th {background-image: url('data:image/gif;base64,R0lGODlhFwAXAOYAAOSchZwhAMs6A+/Kw9mUebszAdiHafbh4+akjeOObfDKxqF6cMxTJct6Wu26qfTRz8FGGrw8At2cg/fX2tJJF+u7sbSalfne4vbc4KoxAu7FvPDS0vrl6rYwAbQrANWAYvTU1d2dh8w3AL9UJsc/A7tBF70uAMVLHfbd3cY5Affj5dN7W9tcKaUxALgtAMY2AfbY2cMuAMAxAPfa3uTO0em4puXDubFmSe6/vLxEHaQjAPXU1sY/C+J0RsNDE8Y8Afnh4vff4fjZ3bY4AfLU1ObPz8UyAKslALU0C9GOePnd4ffa3cE8AaksAPrh5Pnh58E+BO/IwrkrAME6AL8rAJMgAPXW2PXZ3Prh5vLU0Prk579OH/PZ2dVPGKiHfvTT09ujkbQnAMm8vefCs+/Mx+rAsua3o+m2reHV2LxAEZUuD6iJgI4hAPni5czExe69s/je5Pjd48NBGcpAE6w2BdyYgqYvAPTW058qCvDHxPLOxPbd2/nj5tlhL/TR0fTS0iH5BAAAAAAALAAAAAAXABcAAAf/gH+Cg4JWVxiIV1aEjIR+VygKDggACA4KKFd+jYMgcW8JPSxdpCw9CW9wX5w7MwAsFAIisyICAl19AEogjF9ABrEvL0ZGAkYxswIUCUGrgn4XADy2MQwhFTgVCAwpJD9zAE6bfxN5cikpJh8oT0swHFknL94vJwoTf35tHzEkMQYqdvh5cMGcERIF5lFZ0cbPDiI+UhhhgGLHH4JR5MjgIYMBtxc+HliZUcMEExMEsAy8QEYjRwhEJFBhIsOBkDgATPww4WDJAzgK5JiAIgUCGQ4VTEwxgeCCEwJSluKAoYQMhKEmIETBAANHgSku6lyIU0cKkw5nOFjFqvXCgyVv0WREMBHiwgwzLiJ4kHAnh5QILkpEUeLHDxaoUzzUWGLlQZoCBUZs+RtYw4VNO/ZsKTAkjUh9KzxEgByhQwnLDxxqMSA6TAMgmyYMQMJ5SIctWThYEfIExQcPQwoguffs6ZEhtkeAKaNnTIgRR+gM0VEHNiEgDQJkoGPnyPYMOprQAf+60Y4gSfAEaMG+fYsAeJIEsdgIBB8bN9RU2V+FjZobNnDASyNfbFAEDWi4YYEXC6xhgRho0FDEBpz8QcSFG3BxwAEqHBAEFxsQAYIzggQCADs='); }
		.description td {border-top: none !important; padding: 0 10px 10px 50px; color: #555; }
		.passed.description {display: none; }
	</style>

	<script type="text/javascript">
		var displayResult = function(id, passed) {
			var tr = document.getElementById('res' + id);
			tr.className = passed ? 'passed' : 'warning';
			tr.getElementsByTagName('td').item(0).innerHTML = passed ? '<?php _e('Enabled', 'ait-admin') ?>' : '<?php _e('Disabled', 'ait-admin') ?>';
			if (tr = document.getElementById('desc' + id)) {
				if (passed) {
					tr.parentNode.removeChild(tr);
				} else {
					tr.className = 'warning description';
				}
			}
		}
	</script>
</head>

<body class="wp-core-ui">
<div id="wrapper">
	<h1><?php _e('AIT Themes Requirements Checker', 'ait-admin') ?></h1>
	<hr>
	<p><?php _e('AIT Themes Requirements Checker checks if your server and PHP configuration meets the requirements for running this AIT Theme. It checks version of PHP, if appropriate PHP extensions have been loaded, and if PHP directives are set correctly.', 'ait-admin') ?></p>

	<?php if($this->report->errors): ?>
		<div class="failed result">
			<h2><?php _e('Sorry, your server configuration does not match all requirements for this AIT Theme. <em>Your previous theme was reactivated.</em>', 'ait-admin') ?></h2>
		</div>
		<p><?php printf(__('Please fix the issues listed below and try again. You can go back to your <a href="%s" class="button button-primary" target="_blank">WordPress themes administration &raquo;</a>', 'ait-admin'), admin_url('themes.php')); ?></a></p>

	<?php elseif($this->report->warnings): ?>
		<div class="warning result">
			<h2><?php _e('Your server configuration does not fully match all requirements for this AIT Theme.', 'ait-admin') ?></h2>
		</div>
		<p><?php printf(__('We highly recommend to <a href="%s" class="button button-primary">reactivate your previous theme</a> until all of the listed issues are resolved. <a href="%s" class="button button-secondary">Continue</a> only if you know what you are doing.</p>', 'ait-admin'), admin_url('themes.php?ait-theme-revert'), admin_url('themes.php?ait-theme-continue')); ?></p>
	<?php endif ?>

	<h2><?php _e('Details', 'ait-admin') ?></h2>

	<table>
	<?php foreach ($this->requirements as $index => $requirement):?>
	<?php $class = isset($requirement->passed) ? ($requirement->passed ? 'passed' : ($requirement->required ? 'failed' : 'warning')) : 'info' ?>
	<tr index="res<?php echo($index) ?>" class="<?php echo($class) ?>">
		<th><?php echo htmlSpecialChars($requirement->title) ?></th>

		<?php if (empty($requirement->passed) && isset($requirement->errorMessage)): ?>

			<td><?php echo htmlSpecialChars($requirement->errorMessage) ?></td>

		<?php elseif (isset($requirement->message)): ?>

			<td><?php echo htmlSpecialChars($requirement->message) ?></td>

		<?php elseif (isset($requirement->passed)): ?>

			<td><?php echo ($requirement->passed ? __('Enabled', 'ait-admin') : __('Disabled', 'ait-admin')) ?></td>

		<?php else: ?>

			<td><?php _e('Not tested', 'ait-admin') ?></td>

		<?php endif ?>
	</tr>

	<?php if (isset($requirement->description)): ?>
	<tr id="desc<?php echo($index) ?>" class="<?php echo ( $class) ?> description">
		<td colspan="2"><?php echo( htmlSpecialChars(strip_tags($requirement->description))) ?></td>
	</tr>
	<?php endif ?>

	<?php if (isset($requirement->script)): ?>
		<?php echo $requirement->script ?>
	<?php endif ?>

	<?php endforeach ?>
	</table>

</div>
</body>
</html>
<?php
	}
}
