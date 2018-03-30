<?php

// -----------------------------------------------
// Cryptographp v1.4
// (c) 2006-2007 Sylvain BRISON 
//
// www.cryptographp.com 
// cryptographp@alphpa.com 
//
// Licence CeCILL modifiée
// => Voir fichier Licence_CeCILL_V2-fr.txt)
// -----------------------------------------------

 if(session_id() == "") session_start();
 
 //$_SESSION['cryptdir']= dirname($cryptinstall);
 
 
 /*function dsp_crypt($cfg=0,$reload=1) {
 // Affiche le cryptogramme
 echo "<img id='cryptogram' class='alignleft' src='".$_SESSION['cryptdir']."/cryptographp.php?cfg=".$cfg."&".SID."'>";
 if ($reload) echo "<a class='recaptcha alignleft' title='".($reload==1?'':$reload)."' style=\"cursor:pointer; margin:5px 0 0 5px\" onclick=\"javascript:document.images.cryptogram.src='".$_SESSION['cryptdir']."/cryptographp.php?cfg=".$cfg."&".SID."&'+Math.round(Math.random(0)*1000)+1\"><img src=\"".$_SESSION['cryptdir']."/images/reload.png\"></a>";
 }*/
 
 function dsp_crypt() {
 return "<img id='cryptogram' class='alignleft' src='".$_SESSION['cryptdir']."/cryptographp.php?cfg=".$cfg."&".SID."'><a class='recaptcha alignleft' title='".($reload==1?'':$reload)."' style=\"cursor:pointer; margin:5px 0 0 5px\" onclick=\"javascript:document.images.cryptogram.src='".$_SESSION['cryptdir']."/cryptographp.php?cfg=".$cfg."&".SID."&'+Math.round(Math.random(0)*1000)+1\"><img src=\"".$_SESSION['cryptdir']."/images/reload.png\" style=\"border:0!important\"></a>";
 }


 function chk_crypt($code) {
 // Vérifie si le code est correct
 include ($_SESSION['configfile']);
 $code = addslashes ($code);
 $code = str_replace(' ','',$code);  // supprime les espaces saisis par erreur.
 $code = ($difuplow?$code:strtoupper($code));
 switch (strtoupper($cryptsecure)) {    
        case "MD5"  : $code = md5($code); break;
        case "SHA1" : $code = sha1($code); break;
        }
 if ($_SESSION['cryptcode'] and ($_SESSION['cryptcode'] == $code))
    {
    unset($_SESSION['cryptreload']);
    if ($cryptoneuse) unset($_SESSION['cryptcode']);    
    return true;
    }
    else {
         $_SESSION['cryptreload']= true;
         return false;
         }
 }

?>
