var t = 0;
var IE = navigator.appName;
var OP = navigator.userAgent.indexOf('Opera');
var tmp = '';

function operaFix() {

   if (OP != -1) {
      document.getElementById('browser').style.left = -120 + 'px';
   }

}


function startBrowse() {

   tmp = document.getElementById('dummy_path').value;
   getFile();

}

function getFile() {

   // IF Netscape or Opera is used...
   //////////////////////////////////////////////////////////////////////////////////////////////
   if (OP != -1) {

   displayPath();

      if (tmp != document.getElementById('dummy_path').value && document.getElementById('dummy_path').value 

!= '') {

         clearTimeout(0);
         return;

      }

   setTimeout("getFile()", 20);

   // If IE is used...
   //////////////////////////////////////////////////////////////////////////////////////////////
   } else if (IE == "Microsoft Internet Explorer") {

      if (t == 3) {

         displayPath();

         clearTimeout(0);
         t = 0;
         return;

      }

   t++;
   setTimeout("getFile()", 20);


   // Or if some other, better browser is used... like Firefox for example :)
   //////////////////////////////////////////////////////////////////////////////////////////////
   } else {

      displayPath();

   }

}


function displayPath() {

   document.getElementById('dummy_path').value = document.getElementById('browser').value;
   
}


