<?php

function arrayToObject($array)
{
	if (count($array) > 0) {
		foreach ($array as $key => $value) {
			if (is_array($value)) {
					$array[$key] = arrayToObject($value);
			}
		}
		return (object) $array;
	} else {
		return FALSE;
	}
}

function stripSlashesIfNeed($obj)
{
	//if (get_magic_quotes_gpc() == 0) return $obj;
	return stripslashes_deep($obj);
}