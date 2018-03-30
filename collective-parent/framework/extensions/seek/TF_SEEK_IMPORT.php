<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_SEEK_IMPORT {

    private $seek           = NULL; // extentions instance
    private $sqlFileName    = NULL;
    private $fileInstance   = NULL;
    private $sql_imported   = false;

    function __construct($seek) {
        $this->seek =& $seek;

        $this->sqlFileName = $this->seek->get_db_table_name() . '.sql';

        add_action('tf_ext_import_start', array($this, 'import_sql'));
        add_action('tf_ext_import_end', array($this, 'action_tf_import_end'));
    }
    function __destruct(){
        $this->close_sql_file();
    }

    public function import_sql(){
        global $wpdb;

        if(!property_exists($this, 'install_dir')){
            // set $this->install_dir
            $this->install_dir      = get_template_directory() . '/install';
            $upload_folder          = 'uploads';
            if ( is_dir( get_template_directory() . '/install/' . $upload_folder ) )
                $this->install_dir .= '/' . $upload_folder;
        }

        if( !file_exists( $this->install_dir . '/' . $this->sqlFileName ) ){
            print( '<div>'.sprintf(
                __('Error importing seek index table: Cannot find "%s" file in "%s"', 'tfuse'),
                $this->sqlFileName,
                $this->install_dir . '/'
            ) . '</div>');

            return;
        }

        $tableExists = $wpdb->get_results( $wpdb->prepare("SHOW TABLES LIKE %s", TF_SEEK_HELPER::get_db_table_name()), ARRAY_A);
        if(sizeof($tableExists)){

            $rowExists = $wpdb->get_results( "SELECT post_id FROM " . TF_SEEK_HELPER::get_db_table_name() . " LIMIT 1", ARRAY_A);

            if(sizeof($rowExists)){
                print( '<div>'.sprintf(
                    __('Skipping seek index table import: Table "%s" already exists and is not empty', 'tfuse'),
                    TF_SEEK_HELPER::get_db_table_name()
                ) . '</div>');

                return;
            }
        }

        $this->open_sql_file();

        $counter = 0;

        while( ($sql = $this->readNexSql()) !== false ){
            $sql = rtrim($sql, ';');
            @$wpdb->query($sql);
            $counter++;
        }

        if(!$counter){
            print( '<div>'.sprintf(
                __('Error importing Seek index table: No sql read from file "%s" in "%s"', 'tfuse'),
                $this->sqlFileName,
                $this->install_dir . '/'
            ) . '</div>');
        }

        $this->sql_imported = true;

        $this->close_sql_file();
    }

    private function open_sql_file(){
        do{
            if($this->fileInstance !== NULL)
                break;

            $this->fileInstance = fopen( $this->install_dir . '/' . $this->sqlFileName, 'r' );
        }while(false);

        return $this->fileInstance;
    }

    private function close_sql_file(){
        if($this->fileInstance !== NULL) fclose($this->fileInstance);
        $this->fileInstance = NULL;
    }

    private function readNexSql(){
        do {
            $line = fgets($this->fileInstance);
            if($line === false)
                return false;
            $line = trim($line);
        } while( !mb_strlen($line, 'UTF-8') || mb_substr($line, 0, 2, 'UTF-8')=='--' || mb_substr($line, 0, 2, 'UTF-8')=='/*' );

        $sql = "";
        do{
            $sql .= ($sql ? "\n" : "").$line;

            $isEndQuery = mb_substr($line, (mb_strlen($line, 'UTF-8')-1), 1, 'UTF-8') == ';';
            if($isEndQuery){
                break;
            }

            $line = fgets($this->fileInstance);
            if($line === false)
                break;
            $line = trim($line);

            $isEndQuery = mb_substr($line, (mb_strlen($line, 'UTF-8')-1), 1, 'UTF-8') == ';';
            if($isEndQuery){
                $sql .= "\n".$line;
            }

        }while(mb_strlen($line, 'UTF-8') && !in_array(mb_substr($line, 0, 2, 'UTF-8'), array('--','/*')) && !$isEndQuery );

        return( $sql !== false && mb_strlen($sql, 'UTF-8') ? $sql : false );
    }

    function action_tf_import_end( $args ){
        global $wpdb;

        if(!$this->sql_imported){
            // Cancel if sql was not importerd, because it contains old data, and double import is not correct
            return;
        }

        if( !sizeof( $wpdb->get_results( $wpdb->prepare("SHOW TABLES LIKE %s", TF_SEEK_HELPER::get_db_table_name() ) ) )){
            return;
        }

        $table_structure    = NULL;

        $results = $wpdb->get_results("SELECT * FROM " . TF_SEEK_HELPER::get_db_table_name() . "");
        if(sizeof($results)){

            $sql_values = array();

            foreach($results as $result){

                if(is_null($table_structure)){
                    $table_structure = array_keys( get_object_vars($result) );
                }

                if( isset($args['processed_posts'][ intval($result->post_id) ]) ){
                    $result->post_id = $args['processed_posts'][ intval($result->post_id) ];
                } else {
                    // do not include not processed posts, because their ids can conflict with processed
                    continue;
                }


                $result->_terms     = explode($this->seek->index_table_terms_separator, trim($result->_terms, $this->seek->index_table_terms_separator));
                $new_terms          = array();
                if(sizeof($result->_terms)){
                    foreach($result->_terms as $term){
                        $term = intval($term);
                        if($term < 1) continue;

                        $new_terms[ ( isset($args['processed_terms'][$term]) ? $args['processed_terms'][$term] : $term ) . $this->seek->index_table_terms_separator ] = '~';
                    }
                }
                $result->_terms = implode('', array_keys($new_terms));

                $sql = array();
                foreach($result as $key=>$val){
                    $sql[] = $wpdb->prepare('%s', $val);
                }
                $sql = '(' . implode(', ', $sql) . ')';

                $sql_values[] = $sql;
            }
            unset($results);

            $sql = "INSERT INTO " . TF_SEEK_HELPER::get_db_table_name()
                . " (" . implode(', ', $table_structure) . ")"
                . " VALUES "
                . implode(', ', $sql_values);

            $wpdb->query("TRUNCATE TABLE ".TF_SEEK_HELPER::get_db_table_name());
            $wpdb->query($sql);
        }
    }
}