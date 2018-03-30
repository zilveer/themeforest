
(function($, undefined){

	"use strict";

	var l10n = ait.admin.l10n.backup; // shortcut



	function Backup($context)
	{
		this.$context = $context;
		this.$actionContainer = this.$context.find('.ait-backup-action');

		ait.admin.subscribe('ait.admin.backup.import', $.proxy(this.onImportEventCallback, this));
		ait.admin.subscribe('ait.admin.backup.export', $.proxy(this.onExportEventCallback, this));

		this.$context.find('.ait-backup-action-button').not('.button-disabled').on('click', $.proxy(this.backupAction, this));
	}



	Backup.prototype.backupAction = function(e)
	{
		e.preventDefault();

		var $action = $(e.currentTarget).parent();
		var $form;

		if($action.is('.import')){

			$form = this.$context.find('#ait-' + ait.admin.currentPage + '-import-form');
			this.import($form, false);

		}else if($action.is('.import-demo-content')){

			$form = this.$context.find('#ait-' + ait.admin.currentPage + '-import-demo-content-form');
			this.import($form, true);

		}else if($action.is('.export')){

			$form = this.$context.find('#ait-' + ait.admin.currentPage + '-export-form');
			this.export($form);

		}
	}



	Backup.prototype.export = function($form)
	{
		ait.admin.publish('ait.admin.backup.export', ['working']);
		this.doExport($form.serialize());
	}



	Backup.prototype.doExport = function(data)
	{
		$.fileDownload(ait.admin.ajax.url, {
			httpMethod: "POST",
			data: data + '&' + $.param({action: ait.admin.ajax.actions['exportAndDownload']}),

			successCallback: function(url){
				ait.admin.publish('ait.admin.backup.export', ['done']);
			},

			failCallback: function (html, url){
				ait.admin.publish('ait.admin.backup.export', ['error', html]);
			}
		});
	}



	Backup.prototype.import = function($form, isDemoContent)
	{
		var whatToImportInputs = $form.find('input[name="what-to-import"]');
		var $input = $form.find('input[name=import-file]');
		var checked;
		var hasFileInput = $input.length;
		var data;

		if(isDemoContent){
			checked = 'demo-content';
		}else{
			if(whatToImportInputs.length > 1){ // old UI
				checked = whatToImportInputs.filter(':checked').val();
			}else{
				checked = whatToImportInputs.eq(0).val();
			}
		}

		if(!isDemoContent && hasFileInput && !$input[0].files.length){
			ait.admin.publish('ait.admin.backup.import', ['error', {'whatToImport': checked, 'msg': l10n.info.noBackupFile}]);
			return;
		}else{
			data = new FormData($form[0]);
			data.append('action', ait.admin.ajax.actions['uploadAndImport']);

			data.append('what-to-import', checked);

			if(hasFileInput && $input[0].files.length){
				var file = $input[0].files[0];
				var mistake = false;

				// guess what to import from file name... something like mistake-proof

				if(!isDemoContent){
					if(file.name.match(/-all-/) && checked != 'all'){
						data.append('what-to-import', 'all');
						mistake = true;

					}else if(file.name.match(/-theme-options-/) && checked != 'theme-options'){
						data.append('what-to-import', 'theme-options');
						mistake = true;

					}else if(file.name.match(/-wp-options-/) && checked != 'wp-options'){
						data.append('what-to-import', 'wp-options');
						mistake = true;

					}else if(file.name.match(/-content-/) && checked != 'content'){
						data.append('what-to-import', 'content');
						mistake = true;
					}

					if(mistake) ait.admin.publish('ait.admin.backup.import', ['info', {whatToImport: checked, option: checked, filename: file.name}]);
				}


				data.append('import-file', file);
			}

			if(confirm(isDemoContent ? l10n.info.importDemoContent : l10n.info.importBackup)){
				ait.admin.publish('ait.admin.backup.import', ['working', {'whatToImport': checked}]);
				this.doImport(data, checked);
				$form[0].reset();
			}
		}
	}



	Backup.prototype.doImport = function(formData, whatToImport)
	{
		$.ajaxSetup({
			cache: false,
			processData: false,
			contentType: false
		});

		ait.admin.ajax.post('uploadAndImport', formData)
			.done(function(response, textStatus, jqXHR){
				if($.isPlainObject(response)){
					if(!response.success){
						ait.admin.publish('ait.admin.backup.import', ['error', response.data]);
					}else{
						ait.admin.publish('ait.admin.backup.import', ['done', response.data]);
					}
				}else{ // request was done ok, but response is some gibberish like PHP errors or something...
					ait.admin.publish('ait.admin.backup.import', ['error', {'whatToImport': whatToImport, 'fail': response}]);
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				ait.admin.publish('ait.admin.backup.import', ['error', {'whatToImport': whatToImport, 'fail': jqXHR.responseText ? jqXHR.responseText : jqXHR.statusText}]);
			});
	}



	Backup.prototype.onImportEventCallback = function(status, responseData)
	{
		var c = responseData.whatToImport != 'demo-content' ? '.import' : '.import-demo-content';
		var $c = this.$actionContainer.filter(c);
		var $indicator = $c.find('.action-indicator');
		var $report = $c.find('.action-report');
		var reportTpl = $c.find('.action-report-tpl').html();
		var $btn = $c.find('.ait-backup-action-button');

		$indicator.hide();
		$report.text('');
		$indicator.removeClass('action-working action-done action-error');
		$btn.removeClass('button-disabled');

		var tplSettings = {
			evaluate: /<#([\s\S]+?)#>/g,
			interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
			escape: /\{\{([^\}]+?)\}\}(?!\})/g
		};

		if(status == 'working'){

			$btn.addClass('button-disabled');
			$indicator.text(l10n.import.working);
			$indicator.addClass('action-working').show();

		}else if(status == 'info'){

			$indicator.text(l10n.info.selectedBadFileFix.supplant(responseData));
			$indicator.addClass('action-done').fadeIn().delay(4000).hide(300, function(){
				$btn.removeClass('button-disabled');
				$indicator.removeClass('action-working action-done action-error');
			});

		}else if(status == 'done'){

			$indicator.text(l10n.import.done);
			$indicator.addClass('action-done').fadeIn().delay(4000).hide(300, function(){
				$btn.removeClass('button-disabled');
				$indicator.removeClass('action-working action-done action-error');
			});

			var reportTemplate;

			if(_.VERSION == "1.6.0"){
				reportTemplate = _.template(reportTpl, {imports: responseData.imports, attachments: responseData.attachments}, tplSettings);
			}else{
				var __tmpl = _.template(reportTpl, tplSettings); // returns function
				if($.isPlainObject(responseData.imports)){
					reportTemplate = __tmpl({imports: responseData.imports, attachments: responseData.attachments});
				}else{
					reportTemplate = '';
				}
			}
			$report.html(reportTemplate);

		}else if(status == 'error'){

			if('msg' in responseData){
				$indicator.text(responseData.msg);
			}else{
				$indicator.text(l10n.import.error);
			}

			$indicator.addClass('action-error').fadeIn().delay(4000).hide(300, function(){
				$indicator.removeClass('action-working action-done action-error');
			});

			if('fail' in responseData){
				var reportTemplate;
				if(_.VERSION == "1.6.0"){
					_.template(reportTpl, {'failed': responseData.fail}, tplSettings);
				}else{
					var __tmpl = _.template(reportTpl, tplSettings); // returns function
					reportTemplate = __tmpl({'failed': responseData.fail});
				}
				$report.html(reportTemplate);
			}
		}
	}



	Backup.prototype.onExportEventCallback = function(status, data)
	{
		var $c = this.$actionContainer.filter('.export');
		var $i = $c.find('.action-indicator');
		var $btn = $c.find('.ait-backup-action-button');

		$i.hide();
		$i.removeClass('action-working action-done action-error');
		$btn.removeClass('button-disabled');

		if(status == 'working'){
			$btn.addClass('button-disabled');
			$i.html(l10n.export.working);
			$i.addClass('action-working').show();
		}else if(status == 'done'){
			$i.html(l10n.export.done);
			$i.addClass('action-done').fadeIn().delay(4000).hide(300, function(){
				$btn.removeClass('button-disabled');
				$i.removeClass('action-working action-done action-error');
			});
		}else if(status == 'error'){
			var msg = '';
			if(data) msg = data;
			$i.html(l10n.export.error + ' ' + msg);
			$i.addClass('action-error').fadeIn();
		}
	}



	// ===============================================
	// Start
	// -----------------------------------------------

	$(function(){
		new Backup($('#ait-backup-page'));
	});



})(jQuery);
