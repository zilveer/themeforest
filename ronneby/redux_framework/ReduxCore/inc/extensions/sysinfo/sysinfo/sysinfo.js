if(typeof dfd_systemcheck == 'undefined' || dfd_systemcheck === null){
	var dfd_systemcheck = {};
}

(function($, c){
	"use strict";
	c.last_mem = 8;
	c.max_success = 0;
	c.memory_errors = 5;
	c.absolute_max = 999;
	c.btnText = "";
	c.tmr = 60;
	c.tmr1 = 0;
	c.time_test = document.getElementById('time_test');
	c.time_test_cpu = document.getElementById('time_test_cpu');
	c.my_interval;
	c.init = function(){
		this.bind();
	};
	c.ajaxiconClass = "sysinfo_img_ajax";
	c.sysinfo_result = "sysinfo_result";
	c.buttonId = "send_system_check";
	c.phpinfobuttonId = "system_phpinfo";

	c.bind = function(){
		$("#send_system_check").on("click", function(){
			c.ajax();
			return false;
		});
		$(".system_phpinfo").live("click", function(){
			var xml = c.NewXML();
			var callback = function(a)
			{
				var php = JSON.parse(a);
				var html = "<table class='sysinfo_table phpinfo'>";
				html += "<tr class='header'>";
				html += "<td>" + "Global value (set in php.ini)" + "</td>";
				html += "<td>" + "Local value (perhaps set with ini_set() or .htaccess)" + "</td>";
				html += "<td>" + "Access: <br> 1: PHP_INI_USER: Entry can be set in user scripts (like with ini_set()) or in the Windows registry<br> 4: PHP_INI_SYSTEM: Entry can be set in php.ini or httpd.conf <br> 6: PHP_INI_PERDIR: Entry can be set in php.ini, .htaccess or httpd.conf<br>7: PHP_INI_ALL: Entry can be set anywhere" + "</td>";
				html += "</tr>";
				for(var ini_params in php) {
					html += "<tr>";
					html += "<td colspan='3' class='ini_param'>" + ini_params + "</td>";
					html += "</tr>";
					html += "<tr>";
					html += "<td>" + php[ini_params].global_value + "</td>";
					html += "<td>" + php[ini_params].local_value + "</td>";
					html += "<td>" + php[ini_params].access + "</td>";
					html += "</tr>";
				}

				html += "</table>";
				c.endTest();
				$(".sysinfo_result").html(html);
			};
			c.addAjaxIcon();
			c.AjaxSend(xml, ajaxurl + '?action=dfd_checksystem&sys_action=actionPhpInfo', callback);

			return false;
		});
	};
	c.addAjaxIcon = function(){
		$("." + this.ajaxiconClass).show();
		$("." + this.sysinfo_result).addClass("ajax");
		$("#" + this.buttonId).attr("disabled", "disabled");
		$("#" + this.phpinfobuttonId).attr("disabled", "disabled");
		c.btnText = $("#" + this.buttonId).attr("value");
		$("#" + this.buttonId).attr("value", "testing, please wait...");
	};
	c.removeAjaxIcon = function(){
		$("." + this.ajaxiconClass).hide();
		$("." + this.sysinfo_result).removeClass("ajax");
		$("#" + this.buttonId).removeAttr("disabled");
		$("#" + this.phpinfobuttonId).removeAttr("disabled");
		$("#" + this.buttonId).attr("value", c.btnText);
	};
	c.endTest = function(){
		this.removeAjaxIcon();
	};

	c.ajax = function(){
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: 'action=dfd_checksystem',
			beforeSend: function(xhr){
				c.addAjaxIcon();
			},
			success: function(results){
				var result = JSON.parse(results);
				var html = "";
//				c.removeAjaxIcon();
//				console.log(result);
				for(var info in result) {
//					console.log(result[info]);
					html += result[info];
					$(".sysinfo_result").html(html);

				}
				c.endTest();
				//c.start_test();
			}
		});
	};
	c.start_test = function(){
		c.time_test = document.getElementById('time_test');
		c.time_test_cpu = document.getElementById('time_test_cpu');
		clearInterval(c.my_interval);
		c.tmr = 60;
		c.tmr1 = 0;
//		c.timeTest();
//		c.cpuTest();
		//c.my_interval = setInterval(c.my_timer, 1000);
		//c.sessionTest();
//		c.memoryTest(c.last_mem);
	};
	c.my_timer = function(){
		c.tmr--;
		c.tmr1++;
		var res = "wait...";
		if(c.tmr < 1){
//			res = '<font color=red>No</font>';
			clearInterval(c.my_interval);
		}
		else {
			res = '<font color=gray>TESTING... (' + c.tmr + ')</font>';
		}
//		console.log(c.time_test);
		c.time_test.innerHTML = res;
	};
	c.cpuTest = function(){
		// time test with max cpu
		var xml = c.NewXML();
		var callback = function(a)
		{
			var res = "";
			if(a == 'SUCCESS')
				res = '<font color=green>YES</font>';
			else
				res = '<font color=red>NO</font> ';
			c.time_test_cpu.innerHTML = res;
		};
		c.AjaxSend(xml, ajaxurl + "?action=dfd_checksystem&sys_action=actionTimeTest&max_cpu=Y", callback);

	};
	c.sessionTest = function(){
		// session test
		var xml = c.NewXML();
		var callback = function(a)
		{
			var res;
			if(a == 'SUCCESS'){
				res = '<font color=green>YES</font>';
			}
			else {
				res = '<font color=red>NO</font>';
			}
			document.getElementById('session').innerHTML = res;
		};
		c.AjaxSend(xml, ajaxurl + '?action=dfd_checksystem&sys_action=actionSessionTest', callback);
	};

	c.timeTest = function(){
		// time test
		var xml = c.NewXML();
		var callback = function(a){
			var res;
//			console.log(a);
			if(a == "SUCCESS"){
				res = '<font color=green>YES</font>';
			}
			else {
				res = '<font color=red>No</font> (Limit ' + c.tmr1 + ")";
			}
			c.time_test.innerHTML = res;
			clearInterval(c.my_interval);
		};
		c.AjaxSend(xml, ajaxurl + "?action=dfd_checksystem&sys_action=actionTimeTest", callback);
	};
	c.memoryTest = function(max_mem){
		var xml = c.NewXML();
		var callback = function(a)
		{
			if(a == 'SUCCESS')
			{
				c.max_success = c.last_mem;
				c.last_mem *= 2;
				if(c.last_mem > c.absolute_max)
					c.last_mem = parseInt((c.max_success + c.absolute_max) / 2);

				if(c.max_success == c.last_mem)
				{
					c.memory_errors = 0;
					c.last_mem += 1;
				}

				if(c.max_success < 256)
				{
					document.getElementById('memory_limit').innerHTML = c.max_success + '...';
					c.memoryTest(c.last_mem - 1);
				}
				else {
					document.getElementById('memory_limit').innerHTML = '&gt;256';
					c.endTest();
				}

			}
			else if(c.memory_errors > 0)
			{
				c.absolute_max = c.last_mem;
				c.last_mem = parseInt((c.max_success + c.last_mem) / 2);
				c.memoryTest(c.last_mem - 1);
				c.memory_errors--;
			}
			else
			{
				var res;
				if(c.max_success == 0)
					res = '<font color=red>N/A</font>';
				else
					res = c.max_success;

				document.getElementById('memory_limit').innerHTML = res;
				c.endTest();

			}

		};
		c.AjaxSend(xml, ajaxurl + '?action=dfd_checksystem&sys_action=actionMemoryTest&max=' + max_mem, callback);
	};
	c.AjaxSend = function(xml, url, callback)
	{
		if(null != callback)
			xml.onreadystatechange = function()
			{
				if(xml.readyState == 4 || xml.readyState == "complete")
					callback(xml.responseText);
			}

		xml.open("GET", url, true);
		xml.send("");
	};
	c.NewXML = function()
	{
		var xml;
		if(window.XMLHttpRequest){
			try {
				xml = new XMLHttpRequest();
			} catch(e) {
			}
		} else if(window.ActiveXObject){
			try {
				xml = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				try {
					xml = new ActiveXObject("Microsoft.XMLHTTP");
				} catch(e) {
				}
			}
		}
		return xml;
	};
})(jQuery, dfd_systemcheck);
dfd_systemcheck.init();