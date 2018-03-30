<?php
    class afflinkcloaking_dbtable
    {
        public $table_version_option="afflc_tableversion";
        public $table_version = "1.3.2";
        public $link_table_name = "";
        public $track_table_name = "";
        public $statistics_monthly_table_name = "";
        public $statistics_daily_table_name = "";      
        
        public $name_nofollow_option="afflc_nofollow_option";
        public $name_metabox_option="afflc_metabox_option";

        function afflinkcloaking_dbtable()
        {
            global $wpdb;
            $this->link_table_name = $wpdb->prefix."afflctable_link";
            $this->track_table_name = $wpdb->prefix."afflctable_track";
            $this->statistics_daily_table_name = $wpdb->prefix."afflctable_statistics_daily";

            $installed_ver = get_option( $this->table_version_option );
            if ( $installed_ver != $this->table_version )
            {
                //create link table
                $sql_link = "CREATE TABLE " . $this->link_table_name . " ( id int NOT NULL AUTO_INCREMENT, linktitle text, cloaklink text, afflink text, autoshortlink tinyint DEFAULT 1, createdate DATETIME, UNIQUE KEY id (id));";
                $sql_track = "CREATE TABLE " . $this->track_table_name . " ( id int NOT NULL AUTO_INCREMENT, clientip text, visittime DATETIME, referrer text, useragent text, robot tinyint, visitorcookie text, linktableid int, UNIQUE KEY id (id));"; 

                $sql_statistics_daily= "CREATE TABLE " . $this->statistics_daily_table_name . " ( id int NOT NULL AUTO_INCREMENT, statistics_date DATE, hits int, uniquevisitors int, linktableid int, UNIQUE KEY id (id));";
 
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql_link);
                dbDelta($sql_track);
                dbDelta($sql_statistics_daily);

                $this->UpdateDB();
                $this->afflinkcloaking_option_init();

                //modify table version
                update_option($this->table_version_option, $this->table_version);
           
            }

        }

        function UpdateDB()
        {
            //1.1 to 1.2
            global $wpdb;
            $alllinks=$wpdb->get_results("SELECT * FROM ". $this->link_table_name );
            $coloumnames= $wpdb->get_col_info('name', -1);
            
            if ( !in_array("autoshortlink",$coloumnames) )
            {
                $result = $wpdb->query($wpdb->prepare("ALTER TABLE ". $this->link_table_name. " ADD autoshortlink tinyint DEFAULT 1 " ) );
            }

            //1.2 to 1.3 none
            //1.3 to 1.3.1 none
            //1.3.1 to 1.3.2 none
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        //for option
        function afflinkcloaking_option_init()
        {
            if ( FALSE === get_option( $this->name_nofollow_option ) ) update_option($this->name_nofollow_option, "yes");
            if ( FALSE === get_option( $this->name_metabox_option ) ) update_option($this->name_metabox_option, "yes");
        }
 
        function afflinkcloaking_option_set( $nofollow_flag, $metabox_flag )
        {
            update_option($this->name_nofollow_option, $nofollow_flag);
            update_option($this->name_metabox_option, $metabox_flag);
        }

        function afflinkcloaking_option_get()
        {
            $nofollow_flag = get_option( $this->name_nofollow_option );
            $metabox_flag = get_option( $this->name_metabox_option );
            if ( FALSE === $nofollow_flag ) $nofollow_flag="yes";
            if ( FALSE === $metabox_flag ) $metabox_flag="yes";
 
            $resultvalue=array("nofollow"=>$nofollow_flag, "metabox"=>$metabox_flag);
            return $resultvalue;
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        //for uimain
        function GetLinksAndHitsForMainUISortBy( $sdate , $sort_item, $sort_flag )
        {
            global $wpdb;       
             
            $alllinks=$wpdb->get_results("SELECT lt.* , SUM(sdt.hits) as monthhits ,  SUM(case when sdt.statistics_date='" . date('Y-m-d',$sdate) . "' then sdt.hits else 0 end ) as dayhits , SUM(sdt.uniquevisitors) as monthuvs ,  SUM(case when sdt.statistics_date='" . date('Y-m-d',$sdate) . "' then sdt.uniquevisitors else 0 end ) as dayuvs " . " FROM " . $this->link_table_name . " as lt LEFT JOIN  " . $this->statistics_daily_table_name . " as sdt " . " ON lt.id=sdt.linktableid AND YEAR(sdt.statistics_date)= '" . date('Y',$sdate) . "' AND MONTH(sdt.statistics_date)='" . date('m',$sdate) . "' GROUP BY lt.id ORDER BY " . $sort_item . " " . $sort_flag );

            return $alllinks;
        }
        //////////////////////////////////////////////////////////////////////////////////////
        //link table
        function GetAllLinks()
        {   
            global $wpdb;       
            $alllinks=$wpdb->get_results("SELECT * FROM ". $this->link_table_name . " ORDER BY createdate DESC");
            return $alllinks;
        }
         
        function GetLinkByID( $link_id )
        {
            global $wpdb;
            $thelink = $wpdb->get_row("SELECT * FROM ". $this->link_table_name . " WHERE id=".$link_id);
            return $thelink;
        }

        function GetLinkByCloakLink( $cloak_link )
        {
            global $wpdb;
            $thelink = $wpdb->get_row("SELECT * FROM ". $this->link_table_name . " WHERE cloaklink='".$cloak_link."'");

            if ( NULL === $thelink )
            {
                if ( substr( $cloak_link, strlen($cloak_link)-1,1 ) == '/' ) 
                {
                    $cloak_link= substr( $cloak_link, 0, strlen($cloak_link)-1 );
                }
                else
                {
                    $cloak_link = $cloak_link . '/';
                }

                $thelink = $wpdb->get_row("SELECT * FROM ". $this->link_table_name . " WHERE cloaklink='".$cloak_link."'");
            }

            return $thelink;
        }


        function AddLink( $link_cloak, $link_aff, $link_autoshortlink , $link_title )
        {
            global $wpdb;
        
            $result = $wpdb->insert(  $this->link_table_name, array( 'cloaklink' => $link_cloak, 'afflink' => $link_aff, 'autoshortlink' => $link_autoshortlink , 'linktitle' => $link_title, 'createdate' => date('Y-m-d H:i:s',time())  ) );              
            if ($result === FALSE )
            {
                return -1;
            }
            else
            {
                return 1;
            }
        }

        function DeleteLinkByID( $link_id )
        {
            global $wpdb;
            $result = $wpdb->query($wpdb->prepare("DELETE FROM ". $this->link_table_name. " WHERE id=%d",$link_id));
           
            if ($result === FALSE) return -1;
            if ($result === 0) return 0;
            
            return 1;
        }

        function UpdateLinkByID( $link_id, $new_cloaklink, $new_afflink, $new_autoshortlink , $new_title )
        {
            global $wpdb;
            $result = $wpdb->update( $this->link_table_name, array( 'cloaklink' => $new_cloaklink, 'afflink' => $new_afflink, 'autoshortlink' => $new_autoshortlink , 'linktitle' => $new_title ), array( 'id' => $link_id ), array( '%s', '%s' ,'%s' ), array( '%d' ) );

            if ($result === FALSE) return -1;
            if ($result === 0) return 0;
            
            return 1;
        }
        
        function UpdateLinkHitsByID( $link_id, $link_hits )
        {
            global $wpdb;
            $result = $wpdb->update( $this->link_table_name, array( 'hits' => $link_hits ), array( 'id' => $link_id ), array( '%d' ), array( '%d' ) );

            if ($result === FALSE) return -1;
            if ($result === 0) return 0;
            
            return 1;
        }
        ///////////////////////////////////////////////////////////////////////////////////
        //track table
        function GetAllTracks()
        {   
            global $wpdb;       
            $alltracks=$wpdb->get_results("SELECT * FROM ". $this->track_table_name . " ORDER BY visittime DESC");
            return $alltracks;
        }
         
        function GetTrackByLinkID( $link_id )
        {
            global $wpdb;
            $thesetracks = $wpdb->get_results("SELECT * FROM ". $this->track_table_name . " WHERE linktableid=".$link_id . " ORDER BY visittime DESC");
            return $thesetracks;
        }

        function GetTracksNumByMonth()
        {   
            global $wpdb;       
            $tnum=$wpdb->get_var("SELECT COUNT(*) FROM ". $this->track_table_name . " WHERE YEAR(visittime)=YEAR(current_timestamp()) AND MONTH(visittime)=MONTH(current_timestamp()) ");
            return $tnum;
        }

        function AddTrack( $track_ip, $track_refer, $track_useragent, $track_visitorcookie, $track_linktableid)
        {
            global $wpdb;

            $track_robot=0;
            if(preg_match("/(Bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla)/i",$track_useragent)) 
            {
                $track_robot=1;
            }
            
            $result = $wpdb->insert(  $this->track_table_name, array( 'clientip' => $track_ip, 'referrer' => $track_refer, 'useragent' => $track_useragent, 'robot' => $track_robot, 'visitorcookie' => $track_visitorcookie, 'visittime' => date('Y-m-d H:i:s',time()), 'linktableid' => $track_linktableid) );              
            if ($result === FALSE )
            {
                return -1;
            }
            else
            {
                return 1;
            }
        }

        function DeleteAllTracks()
        {
            global $wpdb;
            $result = $wpdb->query($wpdb->prepare("DELETE FROM ". $this->track_table_name));
           
            if ($result === FALSE) return -1;
            if ($result === 0) return 0;
            
            return 1;
        }

        function DeleteTracksByID( $link_id )
        {
            global $wpdb;
            $result = $wpdb->query($wpdb->prepare("DELETE FROM ". $this->track_table_name . " WHERE linktableid=". $link_id ));
           
            if ($result === FALSE) return -1;
            if ($result === 0) return 0;
            
            return 1;
        }
        
        function DeleteMonthTracks( $sdate )
        {
            global $wpdb;
            $result = $wpdb->query($wpdb->prepare("DELETE FROM ". $this->track_table_name . " WHERE YEAR(visittime)=". date('Y',$sdate) . " AND MONTH(visittime)=" . date('m',$sdate) ));

           
            if ($result === FALSE) return -1;
            if ($result === 0) return 0;
            
            return 1;
        }
        ///////////////////////////////////////////////////////////////////////////////////
        //statistics table
        function AnalyseStatisticsDaily( $sdate,$link_id )
        {
            global $wpdb;

            $dailyhits = $wpdb->get_var("SELECT COUNT(*) FROM ". $this->track_table_name . " WHERE DATE(visittime)= '".date('Y-m-d',$sdate) . "' AND linktableid= ". $link_id );
            $dailyvisitors = $wpdb->get_var("SELECT COUNT(DISTINCT visitorcookie) FROM ". $this->track_table_name . " WHERE DATE(visittime)= '".date('Y-m-d',$sdate) . "' AND linktableid= ". $link_id . " AND robot=0 " );
            

            if ( !$this->HasTheDayStatistics( $sdate,$link_id ) )
            {
                $wpdb->insert(  $this->statistics_daily_table_name, array( 'statistics_date' => date('Y-m-d',$sdate) , 'hits' => $dailyhits, 'uniquevisitors' => $dailyvisitors , 'linktableid' => $link_id ) ); 
            }
            else
            {
                $wpdb->update( $this->statistics_daily_table_name, array( 'hits' => $dailyhits, 'uniquevisitors' => $dailyvisitors ), array( 'linktableid' => $link_id, 'statistics_date' => date('Y-m-d',$sdate) ), array( '%d', '%d' ), array( '%d' , '%s' ) );

            }

        } 

        function HasTheDayStatistics( $sdate,$link_id )
        {
            global $wpdb;

            if ( 0 == $wpdb->get_var("SELECT COUNT(*) FROM ". $this->statistics_daily_table_name . " WHERE statistics_date= '".date('Y-m-d',$sdate) ."' AND linktableid= ". $link_id )  )
            {
                return false;
            } 
            else
            {
                return true;
            }
        }
       
        function GetDailyStatisticsByMonth( $sdate,$link_id )
        {
            global $wpdb;
 
            $daystatus=$wpdb->get_results("SELECT *,DAY(statistics_date) as sday FROM ". $this->statistics_daily_table_name . " WHERE YEAR(statistics_date)=".Date("Y",$sdate)." AND MONTH(statistics_date)=".Date("m",$sdate)." AND linktableid=".$link_id. " ORDER BY statistics_date ASC" );

            return $daystatus;
        }
      
        function GetMonthlyStatisticsByYear( $sdate,$link_id )
        {
            global $wpdb;
            $monthstatus=$wpdb->get_results("SELECT linktableid,MONTH(statistics_date) as smonth, SUM(hits) as sumhits,SUM(uniquevisitors) as sumuv FROM ". $this->statistics_daily_table_name . " WHERE YEAR(statistics_date)=".Date("Y",$sdate). " AND linktableid=".$link_id. " GROUP BY YEAR(statistics_date),MONTH(statistics_date) ORDER BY statistics_date ASC" );
            
            return $monthstatus;
        }

        function GetStatisticsRange()
        {
           global $wpdb;
           $starange=$wpdb->get_row("SELECT YEAR(MIN(statistics_date)),MONTH(MIN(statistics_date)) FROM ". $this->statistics_daily_table_name , ARRAY_N );

           return $starange;
        }

        function DeleteDailyStatisticsByID( $link_id )
        {
            global $wpdb;
            $result = $wpdb->query($wpdb->prepare("DELETE FROM ". $this->statistics_daily_table_name ." WHERE linktableid=". $link_id ));
           
            if ($result === FALSE) return -1;
            if ($result === 0) return 0;
            
            return 1;
        }

        //////////////////////////////////////////////
        function MaintainDate()
        {
            $trlinks = $this->GetAllLinks();
            $today_year = date('Y',time());
            $today_month = date('m',time());
            $today_day = date('d',time());

            if ( $today_day >= 2 )
            {
                $this->DeleteMonthTracks( mktime(1,1,1,$today_month-1,1,$today_year) ); 
            }

        }
        function ActivePlugin()
        {
            $activepluginhttp = new WP_Http;
            $activepluginhttp->request( 'http://clionpid.com/affiliatelinkcloakingstatus/active' ,array( 'timeout' => 3 ));
        }
        function DeactivePlugin()
        {
            $activepluginhttp = new WP_Http;
            $activepluginhttp->request( 'http://clionpid.com/affiliatelinkcloakingstatus/deactive' ,array( 'timeout' => 3 ));
            
        }

    }
   
?>