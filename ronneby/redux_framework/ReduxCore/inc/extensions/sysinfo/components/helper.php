<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class SystemCheck_Helper {

	function __construct() {
		
	}

	public static function show($in_param, $value, $red = 'no') {
		$help = $param = $lvl = "";
		if (is_array($in_param)) {
			$param = $in_param[0];
			$help = $in_param[1];
			$lvl = @$in_param[2];
		} else {
			$param = $in_param;
		}
		if ($red == 1) {
			$color = 'red';
		} elseif (!$red) {
			$color = 'green';
		} else
			$color = '#808080';

		if ($value == '1') {
			$value = "YES";
		} elseif ($value == '0')
			$value = "NO";

		$bold = '';

		$result = "<table class='sysinfo_table' width=100% border=0 cellspacing=0 cellpadding=2>
		<tr class='sysinfo_tr'> 
			<td class='sysinfo_name' nowrap align=right valign=top width=30% class=tablebody3>
				<font class=tablefieldtext $bold>$param:</font>
			</td>
			<td  class='sysinfo_value' width=20% class=tablebody3 valign=top>
				<font class=tablebodytext style=\"color:$color\">
				$value
				</font>
			</td>
			<td class='tablebody3 sysinfo_help' valign=top><font class=smalltext>$help&nbsp;</font></td>
		</tr>
		</table>";
		return $result;
	}

	static function create_tmp_folder() {
		$name = self::check_file_name(dirname(__FILE__) . '/' . 'tmp_folder_test');
		mkdir($name);
		if (file_exists($name))
			return $name;
		else
			return false;
	}

	static function check_file_name($name) {
		if (file_exists($name))
			return self::check_file_name($name . "_tmp");
		else
			return $name;
	}

	static function dirinfo($dir) {
		$perm = substr(sprintf('%o', @fileperms($dir)), -3);
		if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
			$user = posix_getpwuid(fileowner($dir));
			$group = posix_getgrgid(filegroup($dir));
			return $perm . " " . $user['name'] . " " . $group['name'];
		} else {
			return $perm . " N/A";
		}
	}

	static function create_tmp_file() {
		$name = self::check_file_name(dirname(__FILE__) . '/' . 'tmp_file_test');
		$f = fopen($name, 'wb');
		if ($f)
			fclose($f);
		if (file_exists($name))
			return $name;
		else
			return false;
	}

	static function getHttpResponse($res, $strRequest) {
		fputs($res, $strRequest);

		$bChunked = False;
		while (($line = fgets($res, 4096)) && $line != "\r\n") {
			if (@preg_match("/Transfer-Encoding: +chunked/i", $line))
				$bChunked = True;
			elseif (@preg_match("/Content-Length: +([0-9]+)/i", $line, $regs))
				$length = $regs[1];
		}

		$strRes = "";
		if ($bChunked) {
			$maxReadSize = 4096;

			$length = 0;
			$line = FGets($res, $maxReadSize);
			$line = StrToLower($line);

			$strChunkSize = "";
			$i = 0;
			while ($i < StrLen($line) && in_array($line[$i], array ("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f"))) {
				$strChunkSize .= $line[$i];
				$i++;
			}

			$chunkSize = hexdec($strChunkSize);

			while ($chunkSize > 0) {
				$processedSize = 0;
				$readSize = (($chunkSize > $maxReadSize) ? $maxReadSize : $chunkSize);

				while ($readSize > 0 && $line = fread($res, $readSize)) {
					$strRes .= $line;
					$processedSize += StrLen($line);
					$newSize = $chunkSize - $processedSize;
					$readSize = (($newSize > $maxReadSize) ? $maxReadSize : $newSize);
				}
				$length += $chunkSize;

				$line = FGets($res, $maxReadSize);

				$line = FGets($res, $maxReadSize);
				$line = StrToLower($line);

				$strChunkSize = "";
				$i = 0;
				while ($i < StrLen($line) && in_array($line[$i], array ("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f"))) {
					$strChunkSize .= $line[$i];
					$i++;
				}
				$chunkSize = hexdec($strChunkSize);
			}
		} elseif ($length)
			$strRes = fread($res, $length);
		else
			while ($line = fread($res, 4096))
				$strRes .= $line;

		return $strRes;
	}

	static function create_tmp_table($innodb = false) {
		$name = 'temp_test_123456';
		while (true) {
			$name.='_tmp';
			$res = mysql_query("SHOW TABLES LIKE '" . $name . "'");

			if ($res) {
				if (!mysql_fetch_row($res)) {
					if ($innodb && mysql_query("CREATE TABLE " . $name . " (tst varchar(100), tst2 varchar(50), tst3 varchar(30), tst4 text) ENGINE=INNODB"))
						return $name;
					elseif (!$innodb && mysql_query("CREATE TABLE " . $name . " (tst varchar(100), tst2 varchar(50), tst3 varchar(30), tst4 text) ENGINE=MYISAM"))
						return $name;
					else
						return false;
				}
			} else
				return false;
		}
	}

	static function microtime_float() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float) $usec + (float) $sec);
	}

	static function clearDir($dir) {
		if ($dir == "") {
			return false;
		}
		if (file_exists($dir))
			foreach (glob($dir . '/*') as $file)
				unlink($file);
	}

	static function xmktime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float) $usec + (float) $sec);
	}

}
