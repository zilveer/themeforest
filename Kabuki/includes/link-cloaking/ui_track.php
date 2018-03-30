<?php
    class afflinkcloaking_uitrack
    {
        public $m_linkid=-1;
        public $m_id2title=array();
        public $m_sdate=array();
        
        public $m_linkdailydata_hits;
        public $m_linkdailydata_uvs;
        public $m_linkmonthlydata_hits;
        public $m_linkmonthlydata_uvs;

        function afflinkcloaking_uitrack()
        {
            $this->m_linkdailydata_hits=array();
            $this->m_linkdailydata_uvs=array();
            $this->m_linkmonthlydata_hits=array();
            $this->m_linkmonthlydata_uvs=array();
            $this->m_id2title=array();

            $this->m_sdate=time();
            if ( isset($_REQUEST['inputyear']) && isset($_REQUEST['inputmonth']) )
            {
               $this->m_sdate=mktime(0,0,0,$_REQUEST['inputmonth'],1,$_REQUEST['inputyear']);
            }
            if ( isset($_GET['linkid']) ) $this->m_linkid=$_GET['linkid'];
   
            
            global $afflctable;
            $alllinks=$afflctable->GetAllLinks();    
            foreach( $alllinks as $linkitem)
            { 
                $this->m_id2title['title'.$linkitem->id]=$linkitem->linktitle;
                $this->m_id2title['shortlink'.$linkitem->id]=$linkitem->cloaklink;
            }
        }

        function ShowIcon()
        {
            echo '<img src="'.get_bloginfo('stylesheet_directory').'/includes/link-cloaking/img/AffIcon_16.png" />';
        }

        function ShowTopButton( $buttontitle, $pagetitle )
        {
            $pageurl=get_admin_url().'admin.php?page=affiliate-link-cloaking/'.$pagetitle;   
            echo '<a href="'.$pageurl.'" class="button add-new-h2" >'.$buttontitle.'</a>';
        }

        function ShowLinkList()
        {
            global $afflctable;

            $alllinks=$afflctable->GetAllLinks();
            foreach( $alllinks as $linkitem)
            {
                $pageurl=get_admin_url().'admin.php?page=affiliate-link-cloaking/ui_track.php&linkid='.$linkitem->id . '&inputyear=' . date('Y',$this->m_sdate) . '&inputmonth=' . date('m',$this->m_sdate); 
                echo ('<a href="'.$pageurl.'">'.$linkitem->linktitle.'</a> | ');
            }

            $pageurl=get_admin_url().'admin.php?page=affiliate-link-cloaking/ui_track.php&inputyear='. date('Y',$this->m_sdate) . '&inputmonth=' . date('m',$this->m_sdate);
            echo ('<a href="'.$pageurl.'">'.All.'</a>');
        }

        function CreateMonthSelector()
        {     
            global $afflctable; 
            
            $daterange=$afflctable->GetStatisticsRange();
            $minyear=$daterange[0];
            $minmonth=$daterange[1];    
            
            $selyear=date('Y',$this->m_sdate);
            $selmonth=date('m',$this->m_sdate);

            echo ('<form action="'.get_admin_url().'admin.php?page=affiliate-link-cloaking/ui_track.php&linkid='.$this->m_linkid.'" method="post" >');
            
                echo ('<div class="alignleft actions">');
                    echo ('<select name="inputyear">');
                        for ($showyear=$minyear; $showyear<=date('Y'); $showyear++ )
                        {
                            $isselect='';
                            if ( $selyear == $showyear) $isselect=' selected="selected" ';
                            echo ('<option value="'.$showyear.'"'. $isselect. ">". $showyear. '</option>');
                        }
                    echo ('</select>');
                echo ('</div>');

                echo ('<div class="alignleft actions">');
                    echo ('<select name="inputmonth">');
                        for ($showmonth=1; $showmonth<=12; $showmonth++)
                        {
                            $isselect='';
                            if ( $selmonth== $showmonth) $isselect=' selected="selected" ';
                            echo ('<option value="'.$showmonth.'"' .$isselect.'>'. date('m',mktime(0,0,0,$showmonth,1,1970)). '</option>');
                        }

                    echo ('</select>');
                echo ('</div>');

                echo ('<input name="" id="viewdate" class="button-secondary action" value="View" type="submit">');
            echo ('</form>');
        }


        function ShowDailyStatisticsTitle ()
        {
            echo 'Daily Status of '.date('M', $this->m_sdate);
        }

        function ShowDailyStatisticsByID( $link_id )
        {
            global $afflctable;     
            $dailystatus=$afflctable->GetDailyStatisticsByMonth( $this->m_sdate, $link_id  );    
        
            $numsofday=(mktime(0,0,0,date('m',$this->m_sdate)+1,1,date('Y',$this->m_sdate))- mktime(0,0,0,date('m',$this->m_sdate),1,date('Y',$this->m_sdate)))/(24*3600);
            $nextdata=0;
        
            $this->m_linkdailydata_hits[$link_id]=array();
            $this->m_linkdailydata_uvs[$link_id]=array();
            for ($iday=1; $iday<=$numsofday; $iday++)
            {
               $bkstyle='';
               if ( mktime(0,0,0,date('m',$this->m_sdate),$iday,date('Y',$this->m_sdate)) < time() )
                   $bkstyle='style="background-color:#F6F6F6;" ';

               if (  ( date('Y-m',$this->m_sdate) == date('Y-m', time()) ) && ( $iday == date('d', time()) )  )
                   $bkstyle='style="background-color:#EEEEEE; font-weight:bold "';

               if ( $dailystatus[$nextdata]->sday == $iday) 
               {
                   echo('<tr '.$bkstyle.' >');
                   echo '<td class="column-url">'.$this->m_id2title['title'. $link_id]. '</td>';
                   echo '<td class="column-url">'.$dailystatus[$nextdata]->statistics_date.'</td>';
                   echo '<td class="column-url" style="text-align:center" >'.$dailystatus[$nextdata]->hits.'</td>';
                   echo '<td class="column-url" style="text-align:center" >'.$dailystatus[$nextdata]->uniquevisitors.'</td>';
                   echo '<td class="column-url">'.get_bloginfo('url').'/'.$this->m_id2title['shortlink'. $link_id]. '</td>';
                   echo('</tr>');
                   

                   $this->m_linkdailydata_hits[$link_id][$iday]=$dailystatus[$nextdata]->hits;
                   $this->m_linkdailydata_uvs[$link_id][$iday]=$dailystatus[$nextdata]->uniquevisitors;

                   $nextdata++;
               }
               else
               {
                   echo('<tr '.$bkstyle.' >');
                   echo '<td class="column-url">'.$this->m_id2title['title'. $link_id]. '</td>';
                   echo '<td class="column-url">'.date('Y-m-d', mktime(0,0,0,date('m',$this->m_sdate) ,$iday, date('Y',$this->m_sdate))).'</td>';
                   echo '<td class="column-url" style="text-align:center" >0</td>';
                   echo '<td class="column-url" style="text-align:center" >0</td>';
                   echo '<td class="column-url">'.get_bloginfo('url').'/'.$this->m_id2title['shortlink'. $link_id]. '</td>';
                   echo('</tr>');

                   $this->m_linkdailydata_hits[$link_id][$iday]=0;
                   $this->m_linkdailydata_uvs[$link_id][$iday]=0;
               }
            }

            echo('<tr style="background-color:#EEEEEE; font-weight:bold; font-style:oblique; ">');
            echo '<td class="column-url">SUM</td>';
            echo '<td class="column-url">'.date('Y-m', mktime(0,0,0,date('m',$this->m_sdate) ,1, date('Y',$this->m_sdate))).'</td>';
            echo '<td class="column-url" style="text-align:center;" >' . array_sum( $this->m_linkdailydata_hits[$link_id]) . '</td>';
            echo '<td class="column-url" style="text-align:center;" >'. array_sum( $this->m_linkdailydata_uvs[$link_id]) .'</td>';
            echo '<td class="column-url">'.get_bloginfo('url').'/'.$this->m_id2title['shortlink'. $link_id]. '</td>';
            echo('</tr>');

        }

        function ShowDailyStatisticsAll()
        {
            global $afflctable;
            $alllinks=$afflctable->GetAllLinks();
            foreach( $alllinks as $linkitem)
            {
                $this->ShowDailyStatisticsByID( $linkitem->id );
                echo ('<tr style="background-color:#fff; height=50px;"><td></td><td></td><td></td><td></td><td></td></tr>');
            }          
        }

        function ShowDailyStatistics ()
        {
            if ( -1==$this->m_linkid )
            {
                $this->ShowDailyStatisticsAll();
            }
            else
            {
                $this->ShowDailyStatisticsByID( $this->m_linkid );
            }
        }

        function ShowMonthlyStatisticsTitle ()
        {
            echo 'Monthly Status of '.date('Y', $this->m_sdate);
        }

        function ShowMonthlyStatisticsByID( $link_id )
        {
            global $afflctable; 
            $monthstatus=$afflctable->GetMonthlyStatisticsByYear( $this->m_sdate, $link_id );  

            $this->m_linkmonthlydata_hits[$link_id]=array();
            $this->m_linkmonthlydata_uvs[$link_id]=array();
            $nextdata=0;
            for ($ishowmonth=1; $ishowmonth<=12; $ishowmonth++)
            {
                $bkstyle='';
                if ( mktime(0,0,0,$ishowmonth,1,date('Y',$this->m_sdate)) < time() )
                    $bkstyle='style="background-color:#F6F6F6;" ';

                if ( ( date('Y',$this->m_sdate) == date('Y', time()) ) &&  ( $ishowmonth == date('m', time()) )  )
                    $bkstyle='style="background-color:#EEEEEE; font-weight:bold "';

                
                if ( $ishowmonth == $monthstatus[$nextdata]->smonth )
                {
                    echo('<tr '.$bkstyle.' >');
               
                    echo '<td class="column-url">'.$this->m_id2title['title'.$link_id]. '</td>';
                    echo '<td class="column-url">'.date('Y-m',mktime(0,0,0,$ishowmonth,1,date("Y",$this->m_sdate))).'</td>';
                    echo '<td class="column-url" style="text-align:center" >'.$monthstatus[$nextdata]->sumhits.'</td>';
                    echo '<td class="column-url" style="text-align:center" >'.$monthstatus[$nextdata]->sumuv.'</td>';
                    echo '<td class="column-url">'.get_bloginfo('url').'/'.$this->m_id2title['shortlink'. $link_id]. '</td>';
            
                    echo('</tr>');

                    $this->m_linkmonthlydata_hits[$link_id][$ishowmonth]=$monthstatus[$nextdata]->sumhits;
                    $this->m_linkmonthlydata_uvs[$link_id][$ishowmonth]=$monthstatus[$nextdata]->sumuv;                    

                    $nextdata++;
                }
                else
                {
                    echo('<tr '.$bkstyle.' >');
               
                    echo '<td class="column-url">'.$this->m_id2title['title'.$link_id]. '</td>';
                    echo '<td class="column-url">'.date('Y-m',mktime(0,0,0,$ishowmonth,1,date("Y",$this->m_sdate))).'</td>';
                    echo '<td class="column-url" style="text-align:center" >0</td>';
                    echo '<td class="column-url" style="text-align:center" >0</td>';
                    echo '<td class="column-url">'.get_bloginfo('url').'/'.$this->m_id2title['shortlink'. $link_id]. '</td>';
            
                    echo('</tr>');

                    $this->m_linkmonthlydata_hits[$link_id][$ishowmonth]=0;
                    $this->m_linkmonthlydata_uvs[$link_id][$ishowmonth]=0;                    

                }

            }

            echo('<tr style="background-color:#EEEEEE; font-weight:bold; font-style:oblique; ">');   
            echo '<td class="column-url">SUM</td>';
            echo '<td class="column-url">'.date('Y',mktime(0,0,0,2,2,date("Y",$this->m_sdate))).'</td>';
            echo '<td class="column-url" style="text-align:center" >'. array_sum( $this->m_linkmonthlydata_hits[$link_id]) .'</td>';
            echo '<td class="column-url" style="text-align:center" >'. array_sum( $this->m_linkmonthlydata_uvs[$link_id]) .'</td>';
            echo '<td class="column-url">'.get_bloginfo('url').'/'.$this->m_id2title['shortlink'. $link_id]. '</td>';
            echo('</tr>');
    
  
        }

        function ShowMonthlyStatisticsAll()
        {
            global $afflctable;
            $alllinks=$afflctable->GetAllLinks();
            foreach( $alllinks as $linkitem)
            {
                $this->ShowMonthlyStatisticsByID( $linkitem->id );
                echo ('<tr style="background-color:#fff; height=50px;"><td></td><td></td><td></td><td></td><td></td></tr>');
            }          
  
        }
  
        function ShowMonthlyStatistics()
        {
            if ( -1==$this->m_linkid )
            {
                $this->ShowMonthlyStatisticsAll();
            }
            else
            {
                $this->ShowMonthlyStatisticsByID( $this->m_linkid );
            }
        }

        //////////////////////////////////////////////////////////////////////////
        function SetGrapDivHeight()
        {
            global $afflctable;
            $alllinks=$afflctable->GetAllLinks();

            if ( count($alllinks) > 8 )
            {
                echo (25*count($alllinks) . 'px');
            }
            else
            {
                echo '200px';
            }
        }
        function php2js_flotdate( $phparray )
        {
            $jsarray='[ ';
            for( $i=1; $i<=count($phparray); $i++ )
            {
                $jsarray=$jsarray. '['. $i. ', ' . $phparray[$i]. '],';
            }
            $jsarray=$jsarray.' ]';
            return $jsarray;
        }
        function createticksforjs( $phparray , $flag )
        {
            $jsticks='ticks : [ ';
            for( $i=1; $i<=count($phparray); $i++ )
            {
                if( $flag == "monthly" )
                {
                    $jsticks=$jsticks. '['. $i. ', "' . date('M',mktime(0,0,0,$i,1,date('Y', $this->m_sdate)) ) . '" ],';
                }
            }
            $jsticks=$jsticks.' ]';
            return $jsticks;
        }

        function CreateJSFlot()
        {
            $plotdatastr='[ ';

            foreach( $this->m_linkdailydata_hits as $linkid => $onelinkdailydata)
            {
                if ( date('Y-m', $this->m_sdate) == date('Y-m', time()) )
                {
                    $tmp_onedata= array_chunk( $onelinkdailydata, date('d',time()), true);
                    $onelinkdailydata =  $tmp_onedata[0];
                }

                echo ('var d_hits_' . $linkid . ' = '.$this->php2js_flotdate( $onelinkdailydata ).';');
            
                $linktitle = $this->m_id2title['title'. $linkid];
                $plotdatastr= $plotdatastr. '{ label: "' . $linktitle . '-hits", data: d_hits_' . $linkid . ', points: { show: true }, lines: { show: true }  }, ';
            }

            if ( count($this->m_linkdailydata_hits) == 1 )
            {
                foreach( $this->m_linkdailydata_uvs as $linkid => $onelinkdailydata)
                {
                    if ( date('Y-m', $this->m_sdate) == date('Y-m', time()) )
                    {
                        $tmp_onedata= array_chunk( $onelinkdailydata, date('d',time()), true);
                        $onelinkdailydata =  $tmp_onedata[0];
                    }

                    echo ('var d_uvs_' . $linkid . ' = '.$this->php2js_flotdate( $onelinkdailydata ).';');
            
                    $linktitle = $this->m_id2title['title'. $linkid];
                    $plotdatastr= $plotdatastr. '{ label: "' . $linktitle . '-uv", data: d_uvs_' . $linkid . ', points: { show: true }, lines: { show: true } }, ';
                }
            }
            $plotdatastr= $plotdatastr. ' ]';
            
            echo ( '$.plot($("#linkstatusview_daily"), ' . $plotdatastr. ' , { xaxis: { tickDecimals: 0, tickSize: 1 } , grid: { backgroundColor: { colors: ["#fff", "#eee"] },  hoverable: true } , legend : {position : "nw" , backgroundOpacity : 0 } } );'  );

            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            $plotdatastr='[ ';
            foreach( $this->m_linkmonthlydata_hits as $linkid => $onelinkmonthlydata)
            {
                if ( date('Y', $this->m_sdate) == date('Y', time()) )
                {
                    $tmp_onedata= array_chunk( $onelinkmonthlydata, date('m',time()), true);
                    $onelinkmonthlydata=  $tmp_onedata[0];
                }
                echo ('var m_hits_' . $linkid . ' = '.$this->php2js_flotdate( $onelinkmonthlydata).';');
            
                $linktitle = $this->m_id2title['title'. $linkid];
                $plotdatastr= $plotdatastr. '{ label: "' . $linktitle . '-hits", data: m_hits_' . $linkid . ', points: { show: true }, lines: { show: true } }, ';
            }

            if ( count($this->m_linkmonthlydata_hits) == 1 )
            {
                foreach( $this->m_linkmonthlydata_uvs as $linkid => $onelinkmonthlydata)
                {
                    if ( date('Y', $this->m_sdate) == date('Y', time()) )
                    {
                        $tmp_onedata= array_chunk( $onelinkmonthlydata, date('m',time()), true);
                        $onelinkmonthlydata=  $tmp_onedata[0];
                    }
                    echo ('var m_uvs_' . $linkid . ' = '.$this->php2js_flotdate( $onelinkmonthlydata).';');
            
                    $linktitle = $this->m_id2title['title'. $linkid];
                    $plotdatastr= $plotdatastr. '{ label: "' . $linktitle . '-uv", data: m_uvs_' . $linkid . ', points: { show: true }, lines: { show: true } }, ';
                }
            }
            $plotdatastr= $plotdatastr. ' ]';

            $xticks = $this->createticksforjs( $onelinkmonthlydata, "monthly");
            echo ( '$.plot($("#linkstatusview_monthly"), ' . $plotdatastr. ' , { xaxis: {'. $xticks .'} , grid: { backgroundColor: { colors: ["#fff", "#eee"] }, hoverable: true } , legend : {position : "nw" , backgroundOpacity : 0 }  } );'  );
    
        }
    
    }

    global $g_uitrack;
    $g_uitrack=new afflinkcloaking_uitrack();
?>

<div class="wrap">
    <h2><?php global $g_uitrack; $g_uitrack->ShowIcon(); ?> Affiliate link cloaking : Link Status <?php global $g_uitrack; $g_uitrack->ShowTopButton( 'View Links','affiliatelinkcloaking.php' ); ?> </h2>
</div>
<p></p>
<p><?php global $g_uitrack; $g_uitrack->ShowLinkList(); ?></p>
<?php global $g_uitrack; $g_uitrack->CreateMonthSelector(); ?>
<div class="wrap"><h4><?php global $g_uitrack; $g_uitrack->ShowDailyStatisticsTitle(); ?></h4></div>
<div id="linkstatusview_daily" style="width:90%; height:<?php global $g_uitrack; $g_uitrack->SetGrapDivHeight(); ?>; margin-top:20px;"></div>
<table class="widefat" cellspacing="0" id="afftracktable_daily">
    <thead>
        <tr>
            <th scope="col" id="headtracktitle_daily">Link Title</th>
            <th scope="col" id="headtrackday_daily">Day</th>
	    <th scope="col" id="headtrackhits_daily" style="text-align:center" >Hits</th>
	    <th scope="col" id="headtrackvisitors_daily" style="text-align:center" >Unique Visitors</th>
            <th scope="col" id="headtrackshortlink_daily">Short Link</th>
	</tr>
    <thead>
    
    <tfoot>
        <tr>
            <th scope="col" id="foottracktitle_daily">Link Title</th>
	    <th scope="col" id="foottrackday_daily">Day</th>
	    <th scope="col" id="foottrackhits_daily" style="text-align:center" >Hits</th>
	    <th scope="col" id="foottrackvisitors_daily" style="text-align:center" >Unique Visitors</th>
            <th scope="col" id="foottrackshortlink_daily">Short Link</th>
        </tr>
    </tfoot>
        
    <tbody>
        <?php global $g_uitrack; $g_uitrack->ShowDailyStatistics() ?>
    </tbody>

</table>

<div class="wrap" style="margin-top:50px;"><h4><?php global $g_uitrack; $g_uitrack->ShowMonthlyStatisticsTitle(); ?></h4></div>
<div id="linkstatusview_monthly" style="width:90%; height:<?php global $g_uitrack; $g_uitrack->SetGrapDivHeight(); ?>; margin-top:20px;"></div>
<table class="widefat" cellspacing="0" id="afftracktable_monthy">
    <thead>
        <tr>
            <th scope="col" id="headtracktitle_monthly">Link Title</a></th>
            <th scope="col" id="headtrackday_monthly">Month</a></th>
	    <th scope="col" id="headtrackhits_monthly" style="text-align:center">Hits</th>
	    <th scope="col" id="headtrackvisitors_monthly" style="text-align:center">Unique Visitors</th>
            <th scope="col" id="headtrackshortlink_monthly">Short Link</th>
	</tr>
    <thead>
    
    <tfoot>
        <tr>
            <th scope="col" id="foottracktitle_monthly">Link Title</a></th>
	    <th scope="col" id="foottrackday_monthly">Month</a></th>
	    <th scope="col" id="foottrackhits_monthly" style="text-align:center">Hits</th>
	    <th scope="col" id="foottrackvisitors_monthly" style="text-align:center">Unique Visitors</th>
            <th scope="col" id="foottrackshortlink_monthly">Short Link</th>
        </tr>
    </tfoot>
        
    <tbody>
        <?php global $g_uitrack; $g_uitrack->ShowMonthlyStatistics() ?>
    </tbody>
</table>

<script type="text/javascript" src="<?php echo( WP_PLUGIN_URL.'/affiliate-link-cloaking/flot/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo( WP_PLUGIN_URL.'/affiliate-link-cloaking/flot/jquery.flot.js'); ?>"></script>
<script type="text/javascript">
$(function () {
    <?php 
        global $g_uitrack;
        $g_uitrack->CreateJSFlot();
    ?> 

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#fee',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    $("#linkstatusview_daily").bind("plothover", function (event, pos, item) 
    { 
        if (item)
        {
            if ( $("#tooltip").length < 1 )
            {
                showTooltip(pos.pageX, pos.pageY, item.series.label + ' = ' + item.datapoint[1]);
            }
        }
        else
        {
            $("#tooltip").remove();
        }
    } );

    $("#linkstatusview_monthly").bind("plothover", function (event, pos, item) 
    { 
        if (item)
        {
            if ( $("#tooltip").length < 1 )
            {
                showTooltip(pos.pageX, pos.pageY, item.series.label + ' = ' + item.datapoint[1]);
            }
        }
        else
        {
            $("#tooltip").remove();
        }
    } );
   
});
</script>