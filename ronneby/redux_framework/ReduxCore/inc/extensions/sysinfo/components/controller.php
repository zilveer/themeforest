<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class SystemCheck_Controller {

	/**
	 *
	 * @var SystemCheck_Controller $_instance 
	 */
	private static $_instance = null;
	private $result = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		
	}

	public function actionPhpInfo() {
		$php = @ini_get_all();
//		$result = "";
//		foreach ($php as $key => $value) {
//			$result[$key] = 
//		}
//		$matches = preg_match_all("/<div class=\"center\">(.*)</div>/i", $php);
//		$info = '<iframe> src="banner.html" width="468" height="60" align="left"' .  . "</iframe>";

		die(json_encode($php));
//		return "fdfgf";
	}

	public function actionMemoryTest() {
		$max = intval($_GET['max']);
		if (!
				  $max)
			$max = 255;
		for ($i = 1; $i <= $max; $i++)
			$a[] = str_repeat(chr($i), 1024 * 1024); // 1 Mb
		die(
				  "SUCCESS");
	}

	public function actionTimeTest() {
//		die("SUCCESS");
//		@set_time_limit(300);
//		@ini_set('max_execution_time', 300);
		$t = time();
		while (time() - $t < 60) {
			if (isset($_GET['max_cpu
			']))
				date('Y-m-d H:i:s');
			else
				sleep(1);
		}
		die(
				  "SUCCESS");
	}

	public function actionSessionTest() {
		session_start();
		$_SESSION['session_test'] = 'ok';
		if ($_SESSION['session_test'] ==
				  'ok')
			die('SUCCESS');
		else
			die(
					  'Fault');
	}

	public function addToResult($pr, $val, $color = null) {
		$this->result[] = SystemCheck_Helper ::show($pr, $val, $color);
	}

	public function addToResultHeader($val) {
		$this->result[] = $val;
	}

	public function separator($name) {
		$name = "<div class='sysinfo_header'><b>" . $name . "</b></div>";
		$this->addToResultHeader($name);
	}

	/**
	 * Web server test
	 */
	public function web_server() {
		$val = NULL;
		$strSERVER_SOFTWARE = $_SERVER["SERVER_SOFTWARE"];
		if (strlen($strSERVER_SOFTWARE) <= 0)
			$strSERVER_SOFTWARE = $_SERVER["SERVER_SIGNATURE"];

		$strSERVER_SOFTWARE = Trim($strSERVER_SOFTWARE);
		if (@preg_match("#^([a-zA-Z-]+).*?([\d]+\.[\d]+(\.[\d]+)?)#i", $strSERVER_SOFTWARE, $arSERVER_SOFTWARE)) {
			$strWebServer = $arSERVER_SOFTWARE[1];
			$strWebServerVersion = $arSERVER_SOFTWARE[2];

			$val = $strWebServer . " " . $strWebServerVersion;
		} else {
			$val = "Not determined";
		}
		$pr = array ("Web-server version", " Required: Apache 1.3.0 and higher or IIS 5.0 and higher", 1);
		$this->addToResult($pr, $val);
	}

	/**
	 * CGI or not
	 */
	public function php_interface() {
		$pr = array ("PHP interface", "It's recommended to run PHP as the Apache module. It's faster than CGI and allows more flexible settings.");
		$sapi = strtolower(php_sapi_name());
		$this->addToResult($pr, $sapi, $sapi == 'cgi');
	}

	/**
	 * php_version
	 */
	public function php_version() {
		$pr = array ("PHP version", 'Required version: 5.3 and higher', 1);
		$this->addToResult($pr, phpversion(), version_compare(phpversion(), '5.3.0', '<'));
	}

	/**
	 * safe_mode
	 */
	public function safe_mode() {
		$val = intval(@ini_get("safe_mode"));
		$pr = array ("Safe mode", "Safe Mode is not supported", 1);
		$this->addToResult($pr, $val, $val);
	}

	public function max_execution_time() {
		$val = intval(@ini_get("max_execution_time"));
		$pr = array ("max_execution_time", "Recommended min value 120 ", 1);
		$this->addToResult($pr, $val, $val < 120 ? 1 : 0);
	}

	public function max_input_vars() {
		$val = intval(@ini_get("max_input_vars"));
		$pr = array ("max_input_vars", "Recommended min value 3000 ", 1);
		$this->addToResult($pr, $val, $val < 3000 ? 1 : 0);
	}

	public function max_input_time() {
		$val = intval(@ini_get("max_input_time"));
		$pr = array ("max_input_time", "Recommended min value 60 ", 1);
		$this->addToResult($pr, $val, $val < 60 ? 1 : 0);
	}

	public function post_max_size() {
		$pr = array ("post_max_size value", 'Recommended min value 20M');
		$val = @ini_get("post_max_size");
		$check = intval($val);
		$this->addToResult($pr, $val, $check < 20 ? 1 : 0);
	}

	public function upload_max_filesize() {
		$val = @ini_get("upload_max_filesize");
		$pr = array ("upload_max_filesize", "Recommended min value 30M ", 1);
		$check = intval($val);
		$this->addToResult($pr, $val, $check < 30 ? 1 : 0);
	}

	public function allow_url_fopen() {
		$val = intval(@ini_get("allow_url_fopen"));
		$pr = array ("allow_url_fopen", "This option enables the URL-aware fopen wrappers that enable accessing URL object like files", 1);
		$this->addToResult($pr, $val, $val ? !$val : "rec");
	}

	/**
	 * short_open_tag
	 */
	public function short_open_tag() {
		$val = intval(@ini_get("short_open_tag"));
		$pr = array ("short_open_tag value", 'short_open_tag=off is not supported', 1);
		$this->addToResult($pr, $val, !$val);
	}

	/**
	 *  Memory limit
	 */
	public function memory_limit() {
//		$filename = ReduxFramework_extension_sysinfo::getInstance()->components_dir . "memory.php";
		$limit = $this->trueMemoryLimitTest();
//		die($limit);
		$min = 128;
		$class = "memmory_error";
		$local = intval(@ini_get('memory_limit'));
		$globbal = intval(get_cfg_var("memory_limit"));
		$pure = intval($limit);

		$local_css = $local < $min ? $class : "";
		$global_css = $globbal < $min ? $class : "";
		$pure_css = $pure < $min ? $class : "";


		$val = @ini_get('memory_limit') ? "<span class='" . $local_css . "'>System(local):  " . @ini_get('memory_limit') . "</span>"
				  . "<br> <span class='" . $global_css . "'>php.ini(Global):  " . get_cfg_var("memory_limit") . "</span>"
				  . "<br> <span class='" . $pure_css . "'>pure: " . $limit : get_cfg_var("memory_limit") . "</span>";
		$pr = array ("memory_limit value", 'Memory limit settings should be not less than '.$min.'M. It is recommended to disable unused PHP modules in php.ini file to increase the memory size available to applications.', 1);
		$this->addToResult($pr, $val);
	}

	public function trueMemoryLimitTest() {
		$host = $_SERVER['SERVER_NAME'] ? $_SERVER['SERVER_NAME'] : 'localhost';
		$port = $_SERVER['SERVER_PORT'] ? $_SERVER['SERVER_PORT'] : 80;
		$fn = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . "/bitrix_test_exec.php";
		$f = fopen($fn, "wb");
		$data = '<?php 
	echo @ini_get("memory_limit");
	?>';
		fputs($f, $data);
		fclose($f);

		$res = @fsockopen(($port == 443 ? 'ssl://' : '' ) . $host, $port, $errno, $errstr, 3);

		if ($res) {
			$strRequest = "GET " . dirname($_SERVER['PHP_SELF']) . "/bitrix_test_exec.php HTTP/1.1\r\n";
			$strRequest.= "Host: " . $host . "\r\n";
			$strRequest.= "\r\n";

			$strRes = SystemCheck_Helper::getHttpResponse($res, $strRequest);
			fclose($res);
		}
		unlink($fn);
		return $strRes;
	}

	/**
	 * Test memory limit
	 */
	public function test_memory_limit() {
		$pr = array ("Actual memory limit", 'Sometimes, actual memory limit differs from PHP settings', 1);
		$this->addToResult($pr, "<div id=memory_limit><font color=gray>" . "not tested" . "</font></div>");
	}

	/**
	 * Mail()
	 */
	public function mail() {
		$pr = array ("Email Sending", 'Attempt to call the mail() function', 1);
//		if ($bTest) {
		$t = time();
		$val = mail("some_test@some.com", "Server test", "This is test message. Delete it.");
		$tt = time() - $t;
		$this->addToResult($pr, ($val ? "YES" : "NO") . ($tt ? " (" . 'Time' . ": $tt " . 'sec.' . ")" : "" ), !$val || $tt > 3);
//		} else
//			$this->addToResult($pr, '<font color=gray>' . GM('NOT_TESTED') . '</font>');
	}

	public function mcrypt() {
		$val = function_exists('mcrypt_encrypt');
		$pr = array ('Mcrypt module', 'Required for secure cloud backup', 1);
		$this->addToResult($pr, $val, !
				  $val);
	}

	public function hash() {
		$val = function_exists('hash');
		$pr = array ('Hash module', 'Required for secure cloud backup', 1);
		$this->addToResult($pr, $val, !
				  $val);
	}

	public function socket() {
		$val = $socket = function_exists('fsockopen');
		$pr = array ('Functions to work with sockets', 'Required for work of SiteUpdate system', 1);
		$this->addToResult($pr, $val, !$val);
	}

	public function session_data() {
		$_SESSION['session_test'] = 'ok';
		$pr = array ("Sessions saving", 'Required for saving authorization', 1);
		$this->addToResult($pr, "<div id=session><font color=gray>" . 'not tested' . "</font></div>");
		session_write_close
		();
	}

	public function time_test() {
		$pr = array ("Execution time test", 'Attempt to execute the script for 60 seconds', 2);
		$this->addToResult($pr, "<div id=time_test><font color=gray>" . 'not tested' .
				  "</font></div>");
	}

	public function cpu_test() {
		$pr = array ("Execution time test with CPU load", 'In some cases, the scripts are disabled when the CPU load is exceeded', 2);
		$this->addToResult($pr, "<div id=time_test_cpu><font color=gray>" . 'TESTING...' .
				  "</font></div>");
	}

	public function test_accelerator() {
		$res = "";
		$pr = array ('PHP accelerator', 'PHP Accelerator is recommended (APC, XCache or any other except deprecated EAccelerator), it allows to greatly reduce the CPU load and PHP scripts execution time. It\'s desirable that the accelerator memory should be sufficient for commonly-used PHP pages.
	<br>If there is no PHP accelerator, analysis of phpinfo() is required', 2);
		if ($val = function_exists("eaccelerator_info")) {
			$res = "EAccelerator";
			$val = false;
		} elseif ($val = function_exists("apc_fetch")) {
			$res = "APC";
		} elseif ($val = function_exists("xcache_get")) {
			$res = "XCache";
		} elseif (($val = function_exists("opcache_reset") ) && @ini_get('opcache.enable')) {
			$res = "OPcache";
		}
		$this->addToResult($pr, $res ? "YES" . ' (' . $res . ')' : "not found", "acc");
	}

	public function free_space() {
		$pr = array ("Disk space", 'It is recommended to have not less than 500M', 1);
		$this->addToResult($pr, intval(@disk_free_space($_SERVER["DOCUMENT_ROOT"]) / 1024 / 1024) .
				  " Mb","space");
	}

	public function permToCss() {
		$path = "wp-content/themes/ronneby/css/";
		$file = ABSPATH . $path;
		$pr = array ("Permissions for the css dir <br> (" . $path . ")", '', 2);
		$this->addToResult($pr, SystemCheck_Helper::dirinfo($file));
	}

	public function permToUploads() {
		$path = "wp-content/uploads/";
		$file = ABSPATH . $path;
		$pr = array ("Permissions for the uploads folder<br> (" . $path . ")", '', 2);
		$this->addToResult($pr, SystemCheck_Helper::dirinfo($file));
	}

	public function permToMainDir() {
		$path = "/";
		$file = ABSPATH;
		$pr = array ("Permissions for the main directory (" . $path . ")", '', 2);
		$this->addToResult($pr, SystemCheck_Helper::dirinfo($file));
	}

	public function permToGeneratedLess() {
		$path = "wp-content/themes/ronneby/assets/less.lib/_generated";
		$file = ABSPATH . $path;
		$pr = array ("Permissions for the auto generated options <br>(" . $path . ")", '', 2);
		$this->addToResult($pr, SystemCheck_Helper::dirinfo($file));
	}

	public function dirinfo() {
		$pr = array ("Permissions for the current folder", '', 2);
		$this->addToResult($pr, SystemCheck_Helper::dirinfo("."));
	}

	public function folder_create() {
		$pr = array ('Folder creation', 'Attempt to create a test folder', 1);
		$dir = SystemCheck_Helper::create_tmp_folder();
		$this->dir = $dir;
//		$dir = "";
		$this->addToResult($pr, $dir == false ? 'Error' : 1, $dir == false);

		if ($dir) {
			// dirinfo
			$pr = array ("Permissions for the creation folder", '', 2);

			$this->addToResult($pr, SystemCheck_Helper::dirinfo($dir));

			// Folder delete
			$val = rmdir($dir);
			$this->addToResult(array ('Folder deletion', '', 1), $val == false ? 'Error' : 1, !$val);
		}
	}

	public function file_create() {
		$file = false;
		$pr = array ('File creation', 'Attempt to create a test file', 1);
		$file = SystemCheck_Helper::create_tmp_file();
		$this->file = $file;
		$this->addToResult($pr, $file == false ? 'Error' : 1, $file == false);
		if ($file) {
			// dirinfo
			$pr = array ('Permissions for the created file', '', 1);
			$this->addToResult($pr, SystemCheck_Helper::dirinfo($file));

			// File delete
			$del = unlink($file);
			$this->addToResult(array ("File deletion", '', 1), $del == false ? 'Error' : 1, !$del);
		}
	}

	public function filesystem_benchmark() {
		$pr = array ("Time to create 1000 files (sec)", 'Normal time - 2 seconds');
		if ($this->file && $this->dir) {

			$t = SystemCheck_Helper::xmktime();
			$path = dirname(__FILE__) . '/tmp_fs_test';
			if (is_dir($path)) {
				SystemCheck_Helper::clearDir($path);
				@rmdir($path);
			}

			mkdir($path);
			$res = true;

			for ($i = 0; $i < 1000; $i++) {
				if (!(($f = fopen($path . '/tmp_test_file_' . $i, 'wb')) && fwrite($f, '<?php #Hello, world! ?>') && fclose($f))) {
					$res = false;
					break;
				}
				include ( $path . '/tmp_test_file_' . $i);
			}

			if (
					  $res)
				for ($i = 0; $i < 1000; $i
						  ++)
					if (!unlink($path . '/tmp_test_file_' . $i)) {
						$res = false;
						break;
					}
			rmdir($path);
			$time = round(SystemCheck_Helper::xmktime() - $t, 2);
			$this->addToResult($pr, $res ? $time : 'Error', $time > 5);
		} else
			$this->addToResult($pr, 'not tested', 1);
	}

	public function file_upload_value() {
		$val = intval(@ini_get('file_uploads'));
		$this->addToResult(array ('file_uploads value', '', 1), $val, !$val);
	}

	public function regex_func() {
		$val = intval(function_exists("preg_match"));
		$pr = array ('PHP regular expressions', '', 1);
		$this->addToResult($pr, $val, !$val);
	}

	public function perl_regx() {
		$val = intval(function_exists("preg_match"));
		$pr = array ('Perl regular expressions', '', 1);
		$this->addToResult($pr, $val, !$val);
	}

	public function zlib() {
		try {
			$val = intval(extension_loaded('zlib') && function_exists("gzcompress"));
		} catch (Exception $ex) {
			
		}
		$pr = array ("Zlib extension", 'Required for correct Compression module work and fast updates loading', 1);
		$this->addToResult($pr, $val, !$val);
	}

	public function gd_lib() {
		$val = intval(function_exists("imagecreate"));
		$pr = array ("GD lib extension", 'Displaying graphs in the statistics and working with images', 1);
		$this->addToResult($pr, $val, !$val);
	}

	public function free_type() {
		$val = intval(function_exists("imagettftext"));
		$pr = array ("Free Type extension", 'Required for CAPTCHA functionality', 1);
		$this->addToResult($pr, $val, !$val);
	}

	public function ssl() {
		$pr = array ('SSL support', 'Required for correct  work with external payment systems plugins', 2);
		$f = @fsockopen("ssl://www.paypal.com", 443, $errno, $errstr, 10);
		$this->ssl = $f;
		$val = $f ? 1 : 0;
		$this->addToResult($pr, $val, !$val);
		@fclose($f);
	}

	public function mbstring() {
		$val = intval(function_exists("mb_substr"));
		$pr = array ('mbstring support', 'Required for correct product work with UTF-8', 1);
		$this->addToResult($pr, $val, !$val);
	}

	public function mysql_test() {
		$DBHost = DB_HOST;
		$DBLogin = DB_USER;
		$DBPassword = DB_PASSWORD;
		$DBName = DB_NAME;
		if ($link = @mysql_connect($DBHost, $DBLogin, $DBPassword)) {
			$this->addToResult(array ('Connection to MySQL server', '', 1), 1, 0);
			$res = mysql_query("SELECT version()");
			$f = @mysql_fetch_row($res);
			$pr = array ('MySQL server version', 'MySQL 5.0 and higher (No alpha or beta releases are allowed).', 1);
			$this->addToResult($pr, $f[0]);
			list($v1, $v2) = explode(".", $f[0]);

			$res = @mysql_query("SHOW VARIABLES LIKE 'sql_mode'");
			while ($f = mysql_fetch_row($res)) {
				$this->addToResult(array ($f[0], '`STRICT*` modes are not supported', 1), "&nbsp;" . $f[1], @preg_match("#strict#i", $f[1]));
			}
			$warn = '';
			$res = @mysql_query("SHOW VARIABLES LIKE 'character\_set\_%'");
			while ($f = mysql_fetch_row($res)) {
				$this->addToResult(array ($f[0], $warn), $f[1]);
			}

			if (@mysql_select_db($DBName, $link)) {
				$this->addToResult('Database selection', 1, 0);

				$name = SystemCheck_Helper::create_tmp_table(true); // InnoDB
				$res = @mysql_query("SHOW CREATE TABLE $name");
				$f = @mysql_fetch_row($res);
				$val = @preg_match("#ENGINE=InnoDB#", $f[1]);
				$this->addToResult(array ('InnoDB Support', '', 2), $val, !$val);
				if ($name) {
					mysql_query("DROP TABLE " . $name);
				}

// Temporary table
				$name = SystemCheck_Helper::create_tmp_table();
				if ($name) {
					$this->addToResult(array ('Creating a test table', '', 1), 1, 0);


					$t1 = SystemCheck_Helper::microtime_float();
					$good = true;
// Insert 1000 rows 
					for ($i = 0; $i < 1000; $i++) {
						if (!@mysql_query("INSERT INTO " . $name . " VALUES ('test1','test2','test3','test4')")) {
							$good = false;
							break;
						}
					}
					if ($good) {
						$t2 = SystemCheck_Helper::microtime_float();
						$pr = array ('Running Insert query', 'Queries per second: if lower than 2000, it might indicate low DB performance');
						$tmp = round(1000 / ($t2 - $t1));
						$this->addToResult($pr, $tmp . " q/" . "sec.", $tmp < 2000);
					} else {
						$pr = array ('Running Insert query', '', 1);
						$this->addToResult($pr, "error", 1);
					}
					$pr = array ('Deleting test table', '', 1);
					if (@mysql_query("DROP TABLE " . $name)) {
						$this->addToResult($pr, 1, 0);
					} else {

						$this->addToResult($pr, 0, 1);
					}
				} else {
					$this->addToResult('Creating a test table', "error", 1);
				}
			} else {
				$this->addToResult('Database selection', "error", 1);
			}
		} else {
			$this->addToResult('Connection to MySQL server', "error", 1);
		}
	}

	public function unmask() {
		$pr = array ("umask", '');
		$this->addToResult($pr, sprintf("%03o", umask()
		));
	}

	public function register_globals() {
		$val = intval(@ini_get('register_globals'));
		$pr = array ("Register globals", '');
		$this->addToResult($pr, $val);
	}

	public function display_errors() {
		$val = intval(@ini_get('display_errors'));
		$this->addToResult("Display errors", $val);
	}

	public function active_plugins() {
		$plugins = get_plugins();
		$active_plugins = get_option('active_plugins', array ());

		foreach ($plugins as $plugin_path => $plugin) {
			if (!in_array($plugin_path, $active_plugins)) {
				continue;
			}
//			$return .= $plugin['Name'] . ': ' . $plugin['Version'] . "\n";
			$this->addToResult($plugin['Name'], $plugin['Version']);
		}
	}

	public function worpress_version() {
		$ver = get_bloginfo('version');
		$this->addToResult("Wordpress version", $ver);
	}

	public function active_theme() {
		$is_child = is_child_theme() ? ' (child theme)' : '';
		$theme_data = wp_get_theme();
		$theme = $theme_data->Name . ' ' . $theme_data->Version . $is_child;
		$this->addToResult("Active Theme", $theme);
	}

	public function getResult() {
		return $this->result;
	}

}
