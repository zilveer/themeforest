<?php
    define( 'SHORT_PATH' , true );
	class deb{
		function e( $data ){
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller['file'] ) . " ][ Line : " . $caller['line'] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $data );
			print "</pre>";
		}
		
		function d( $data ){
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller['file'] ) . " ][ Line : " . $caller['line'] . " ]\n";
            print "--------------------------------------------------------------\n";
			var_dump( $data );
			print "</pre>";
		}
		
		function h( $data ){
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller['file'] ) . " ][ Line : " . $caller['line'] . " ]\n";
            print "--------------------------------------------------------------\n";
			print htmlspecialchars( $data );
			print "</pre>";
		}
		
		function p(){
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller['file'] ) . " ][ Line : " . $caller['line'] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $_POST ) ;
			print "</pre>";
		}
		
		function g(){
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller['file'] ) . " ][ Line : " . $caller['line'] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $_GET ) ;
			print "</pre>";
		}
		
		function r(){
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller['file'] ) . " ][ Line : " . $caller['line'] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $_REQUEST ) ;
			print "</pre>";
		}
		
		function sv(){
			print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            print "[ File : " . self::short( $caller['file'] ) . " ][ Line : " . $caller['line'] . " ]\n";
            print "--------------------------------------------------------------\n";
			print_r( $_SERVER ) ;
			print "</pre>";
		}

        function short( $str ){
            if( SHORT_PATH ){
                $str = str_replace( '/var/www/wp/wp-content/themes' , '' , str_replace('/var/www/wp.3.0/wp-content/themes' , '' , $str ) );
            }
            return $str;
        }

        function inc( $path = 'lib/php' ){
            print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
            $bt = debug_backtrace( );
            $caller = array_shift( $bt );
            print "[ File : " . self::short( $caller['file'] ) . " ][ Line : " . $caller['line'] . " ]\n";
            print "--------------------------------------------------------------\n";
			$files = scandir( get_template_directory() . '/' . $path );

            foreach( $files as $file ){
                if( ( (int) strlen( str_replace( '.class.php', '' , $file ) ) < (int) strlen( $file ) ) || ( (int) strlen( str_replace( '.register.php', '' , $file ) ) < (int)strlen( $file ) ) ){
                    print htmlspecialchars( "<?php include '" . get_template_directory() . '/' . $path . "/" . $file . "'; ?>" ) . "\n";
                }
            }
			print "</pre>";
        }
	}
?>