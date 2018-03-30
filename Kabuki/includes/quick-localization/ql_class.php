<?php



// Quick Localisation - plugin core class
//
// Copyleft, 2012, by Name.ly
//
// The author, Name.ly team, can be addressed via plugins (at) name (dot) ly



// Possible improvements to implement in the future to boost the performance:
// (1)	Cache values per domain in separate arrays.
//	Then also handle the case for _ALL_ separately if none of the translations has been found ( in both ql_gettext_filter and $this -> find_id ).
// (2) Sort cached arrays and speed up the search by using 50%50 split and compare ( "<" | ">" ) recursive algorithm.



define ( 'QL_VERSION', '0.0.1' ); // db version

//	Plugin version	DB version
//	0.0.1			0.0.1
//	0.0.2			0.0.1
//	0.0.3			0.0.1
//	0.0.4			0.0.1
//	0.0.5			0.0.1
//	0.0.6			0.0.1



class QL {

	private $table; // table name

	private $collect_draft_translations_fe;
	private $collect_draft_translations_be;
	private $collect_draft_translations_white;
	private $collect_draft_translations_black;
	private $default_order_by;

	private $olds;
	private $news;
	private $domains;

	public function __construct () {
		$this -> olds = array ();
		$this -> news = array ();
		$this -> domains = array ();

		$this -> check ();

		if ( $this -> table ) {
			$result = $this -> preload_all ();
		} else {
			$result = false;
		}
		return $result;
	}

	private function check () {

		$ql_options = get_option ( 'ql_options' );

		// here, in the future, we can check for previous versions, and if such, upgrade the table accordingly

		if ( ! $ql_options || ! is_array ( $ql_options ) || ! isset ( $ql_options [ 'version' ] ) ) {
			$ql_options = array ();
			$ql_options [ "version" ] = QL_VERSION;
			$ql_options [ "warn_on_duplicates" ] = "yes";
			$ql_options [ "default_order_by" ] = "id";
			add_option ( "ql_options", $ql_options );
		}

		if ( isset ( $ql_options ['table'] ) && $ql_options ['table'] ) {
			$this -> table = $ql_options ['table'];
		} else {
			$this -> createtable ();
		}

		if(isset( $collect_draft_translations_fe ) && isset($collect_draft_translations_be)) {
		
		$this -> collect_draft_translations_fe = "yes" == $ql_options [ "collect_draft_translations_fe" ];
		$this -> collect_draft_translations_be = "yes" == $ql_options [ "collect_draft_translations_be" ];
		$this -> collect_draft_translations_white = get_option ( "ql_collect_draft_translations_white", array () );
		$this -> collect_draft_translations_black = get_option ( "ql_collect_draft_translations_black", array ( "default" ) );

		$this -> default_order_by = $ql_options [ "default_order_by" ];
		
		}
	}

	private function createtable () {
		global $wpdb;
		$this -> table = $wpdb -> prefix . "ql";

		if ( ! empty($wpdb -> charset) )
			$charset_collate = "DEFAULT CHARACTER SET " . $wpdb -> charset;
		if ( ! empty($wpdb -> collate) )
			$charset_collate .= " COLLATE " . $wpdb -> collate;

		$sql = "
CREATE TABLE IF NOT EXISTS {$this->table} (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `old` longtext NOT NULL,
  `new` longtext,
  `domain` varchar(255) NOT NULL default '',
  PRIMARY KEY (`id`)
) $charset_collate;
";

		$result = $wpdb -> query ( $wpdb -> prepare ( $sql ) );
		
		if ( $result ) {
			$ql_options = get_option ( 'ql_options' );
			$ql_options [ 'table' ] = $this -> table;
			update_option ( 'ql_options', $ql_options );
		}
		return $result;
	}

	public function reinstall () {
		$this -> uninstall ();
		$this -> __construct (); // check ();
	}

	public function uninstall () {
		global $wpdb;
		$ql_options = get_option ( 'ql_options' );
		$table = $ql_options ['table'];
		if ( $table ) {
			$wpdb -> query("DROP TABLE {$table} ");
		}
    		delete_option ( 'ql_options' );
    		delete_option ( 'ql_collect_draft_translations_white' );
    		delete_option ( 'ql_collect_draft_translations_black' );
		unset ( $this -> olds );
		unset ( $this -> news );
		unset ( $this -> domains );
	}

	public function get_from_db ( $domain = null, $order_by = null ) {
		global $wpdb;
		
		if(isset($order_by_field) && isset($order_by_fields)) {
		$order_by_fields = array ( "id" => "id", "old" => "old", "new" => "new", "domain" => "domain", );
		$order_by_field = null === $order_by ? $order_by_fields [ $this -> default_order_by ] : $order_by_fields [ $order_by ];
		$order_by_sql = $order_by_field ? " ORDER by`" . $order_by_field . "`": "";
		}
		if ( ! $this -> table ) { return false; }

		$suppress = $wpdb -> suppress_errors();
		$order_by_sql = null;
		$all_db = $wpdb -> get_results ( $wpdb -> prepare ( "SELECT * FROM " . $this -> table . ( null === $domain ? "" : " WHERE `domain` = %s" ) . $order_by_sql . ";", $domain ) ); // ORDER BY id
		$wpdb -> suppress_errors($suppress);

		return $all_db;
	}

	public function get_all_from_db ( $order_by = null ) {
		return $this -> get_from_db ( null, $order_by );
	}

	public function get_list_of_saved_domains () {
		global $wpdb;

		if ( ! $this -> table ) { return false; }

		$suppress = $wpdb -> suppress_errors();
		$all_db = $wpdb -> get_results ( "SELECT `domain`, COUNT(`id`) AS count FROM " . $this -> table . " GROUP BY (`domain`) ORDER BY `domain`;" );
		$wpdb -> suppress_errors($suppress);

		return $all_db;
	}

	public function delete_from_db ( $domain = null ) {
		global $wpdb;

		if ( ! $this -> table ) { return false; }

		$suppress = $wpdb -> suppress_errors();
		$all_db = $wpdb -> get_results ( $wpdb -> prepare ( "DELETE FROM " . $this -> table . ( null === $domain ? "" : " WHERE `domain` = %s" ) . ";", $domain ) );
		$wpdb -> suppress_errors($suppress);

		return $all_db;
	}

	private function preload_all () {
		global $wpdb;

		$all_db = $this -> get_all_from_db ();

		if ( $all_db && is_array ( $all_db ) ) {
			// work-around for PHP 5.2 not handling the "new" property correctly
			$newfield = "new";
			foreach ( $all_db as $row ) {
				$this -> olds [ $row -> id ] = $row -> old;
				$this -> news [ $row -> id ] = $row -> $newfield;
				$this -> domains [ $row -> id ] = $row -> domain;
			}
		} else {
			return false;
		}
	}

	public function is_draft_domain ( $domain ) {
		return preg_match ( '|^\-.+\-$|i', $domain );
	}

	public function undraft_domain ( $domain ) {
		return trim ( $domain, "-" );
	}

	public function find_id ( $old, $domain = null ) {
		$domain2match = null === $domain || "" == $domain || "default" == $domain ? "" : $domain;
		$id = false;
		$collect_draft_translations_white_count = count ( $this -> collect_draft_translations_white );
		foreach ( $this -> olds as $key => $value ) {
			if ( $value == $old && ( $domain == $this -> domains [ $key ] || $domain2match == $this -> domains [ $key ] || "_ALL_" == $this -> domains [ $key ] || "_" == $this -> domains [ $key ] ) ) {
				$id = $key;
				break;
			}
		}
		if ( ! $id && ( $this -> collect_draft_translations_fe && ! is_admin () || $this -> collect_draft_translations_be && is_admin () ) ) {
			if (	! $this -> is_draft_domain ( $domain )
				&& ( 0 == $collect_draft_translations_white_count || in_array ( $domain, $this -> collect_draft_translations_white ) )
				&& ! in_array ( $domain, $this -> collect_draft_translations_black ) )
			{
				// searched domain is not a draft (just minding the nasty eternal loops) && domain is white listed && domain is not blacklisted
				$did = $this -> find_id ( $old, "-" . $domain . "-" );
				if ( ! $did ) {
					// add but, notify the system not to search again to prevent it from looping eternally
					$this -> add ( $old, "", "-" . $domain . "-" );
				}
			}
		}
		return $id;
	}

	public function translate ( $old, $domain = null ) {
		$id = $this -> find_id ( $old, $domain );
		if ( $id ) {
			return $this -> news [ $id ];
		} else {
			return false;
		}
	}

	public function add ( $old, $new = '', $domain = '' ) {
		global $wpdb;

		if ( ! $old ) { return false; }
		if ( ! $this -> table ) { return false; }

		$id = $this -> find_id ( $old, $domain );

		if ( $id ) {
			$result = $this -> update ( $id, $old, $new, $domain );
		} else {
			$result = $wpdb -> query ( $wpdb -> prepare ( "INSERT INTO `$this->table` (`old`, `new`, `domain`) VALUES (%s, %s, %s)", $old, $new, $domain ) );
			if ( $result ) {
				$id = $wpdb -> get_var ( $wpdb -> prepare ( "SELECT `id` FROM `$this->table` WHERE `old` = %s AND `domain` = %s ;", $old, $domain ) );
				if ( $id ) {
					$this -> olds [ $id ] = $old;
					$this -> news [ $id ] = $new;
					$this -> domains [ $id ] = $domain;
				}
			}
		}

		return $result ? $id : false;
	}

	public function update ( $id, $old, $new, $domain ) {
		global $wpdb;

		if ( ! $this -> table ) { return false; }

		if ( $old ) {
			if ( isset ( $this -> olds [ $id ] ) ) {
				$this -> olds [ $id ] = $old;
				$this -> news [ $id ] = $new;
				$this -> domains [ $id ] = $domain;
				$result = $wpdb -> update( $this -> table, array ( 'old' => $old, 'new' => $new, 'domain' => $domain ), array( 'id' => $id ) );
			} else {
//				false;
				return $this -> add ( $old, $new, $domain );
			}
		} else {
			return $this -> delete ( $id );
		}

		return $result ? $id : false;
	}

	public function delete ( $id_or_old ) {
		global $wpdb;

		if ( ! $this -> table ) { return false; }

		$id = (int) $id_or_old;
		if ( $id < 1 ) {
			$id = $this -> find_id ( $id_or_old );
		}
		if ( isset ( $this -> olds [ $id ] ) ) {
			if ( isset ( $this -> olds [ $id ] ) ) {
				$result = $wpdb -> query ( $wpdb -> prepare ( "DELETE FROM `$this->table` WHERE `id` = %d", $id ) );
				if ( $result ) {
					unset ( $this -> olds [ $id ] );
					unset ( $this -> news [ $id ] );
					unset ( $this -> domains [ $id ] );
				}
			} else {
				return $this -> delete ( $id );
			}
		} else {
			return false;
		}

		return $result;
	}

	public function clear () {
		global $wpdb;

		if ( ! $this -> table ) { return false; }

		$result = $wpdb -> query ( $wpdb -> prepare ( "DELETE FROM `$this->table`;" ) );
		if ( $result ) {
			unset ( $this -> olds );
			unset ( $this -> news );
			unset ( $this -> domains );
			$this -> olds = array ();
			$this -> news = array ();
			$this -> domains = array ();
		} else {
			return false;
		}

		return $result;
	}



}



?>