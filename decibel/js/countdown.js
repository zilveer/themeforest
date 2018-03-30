/*!
 * Plugin countdown
 *
 * %NAME% %VERSION% 
 */
/* jshint -W062 */

var WolfThemeCountdown =  WolfThemeCountdown || {},
	WolfThemeParams =  WolfThemeParams || {},
	console = console || {};

WolfThemeCountdown = function( $ ) {

	'use strict';

	return {

		/**
		 * Init UI
		 */
		init : function () {

			this.setLang();

			$( '.wolf-countdown' ).each( function() {
				var $this = $( this ),
					dataYear = $this.data( 'year' ),
					dataMonth = $this.data( 'month' ),
					dataDay = $this.data( 'day' ),
					dataHour = $this.data( 'hour' ),
					dataMin = $this.data( 'min' ),
					dataSec = $this.data( 'sec' ),
					dataOffset = $this.data( 'offset' );
				
				$this.countdown( {
					until: new Date( dataYear, dataMonth - 1, dataDay, dataHour, dataMin, dataSec ),
					format: 'DHMS',
					timezone: dataOffset,
					padZeroes: true
				} );
			} );
		},

		setLang : function () {

			var lang = WolfThemeParams.language;

			// fr
			if ( 'fr_FR' === lang || 'fr_BE' === lang || 'fr_CA' === lang ) {
				$.countdown.regionalOptions['fr'] = {
					labels: ['Années', 'Mois', 'Semaines', 'Jours', 'Heures', 'Minutes', 'Secondes'],
					labels1: ['Année', 'Mois', 'Semaine', 'Jour', 'Heure', 'Minute', 'Seconde'],
					compactLabels: ['a', 'm', 's', 'j'],
					whichLabels: function(amount) {
						return (amount > 1 ? 0 : 1);
				},
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
					$.countdown.setDefaults($.countdown.regionalOptions['fr']);
			
			// DE
			} else if( 'de_DE' == lang || 'de_CH' == lang ) {
				$.countdown.regionalOptions['de'] = {
					labels: ['Jahre', 'Monate', 'Wochen', 'Tage', 'Stunden', 'Minuten', 'Sekunden'],
					labels1: ['Jahr', 'Monat', 'Woche', 'Tag', 'Stunde', 'Minute', 'Sekunde'],
					compactLabels: ['J', 'M', 'W', 'T'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['de']);
			
			// IT
			} else if( 'it_IT' === lang ) {
				$.countdown.regionalOptions['it'] = {
					labels: ['Anni', 'Mesi', 'Settimane', 'Giorni', 'Ore', 'Minuti', 'Secondi'],
					labels1: ['Anno', 'Mese', 'Settimana', 'Giorno', 'Ora', 'Minuto', 'Secondo'],
					compactLabels: ['a', 'm', 's', 'g'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['it']);
			// ES
			} else if( 'es_ES' === lang || 'es_AR' === lang || 'es_CL' === lang || 'es_CO' === lang || 'es_GT' === lang || 'es_VE' === lang ) {
				$.countdown.regionalOptions['es'] = {
					labels: ['Años', 'Meses', 'Semanas', 'Días', 'Horas', 'Minutos', 'Segundos'],
					labels1: ['Año', 'Mes', 'Semana', 'Día', 'Hora', 'Minuto', 'Segundo'],
					compactLabels: ['a', 'm', 's', 'd'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['es']);
			// NL
			} else if( 'nl_NL' === lang || 'nl_BE' === lang ) {
				$.countdown.regionalOptions['nl'] = {
					labels: ['Jaren', 'Maanden', 'Weken', 'Dagen', 'Uren', 'Minuten', 'Seconden'],
					labels1: ['Jaar', 'Maand', 'Week', 'Dag', 'Uur', 'Minuut', 'Seconde'],
					compactLabels: ['j', 'm', 'w', 'd'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['nl']);
			// CZ
			} else if( 'cs_CZ' === lang ) {
				$.countdown.regionalOptions['cs'] = {
					labels: ['RokÅ¯', 'MÄ›sÃ­cÅ¯', 'TÃ½dnÅ¯', 'DnÃ­', 'Hodin', 'Minut', 'Sekund'],
					labels1: ['Rok', 'MÄ›sÃ­c', 'TÃ½den', 'Den', 'Hodina', 'Minuta', 'Sekunda'],
					labels2: ['Roky', 'MÄ›sÃ­ce', 'TÃ½dny', 'Dny', 'Hodiny', 'Minuty', 'Sekundy'],
					compactLabels: ['r', 'm', 't', 'd'],
					whichLabels: function(amount) {
						return (amount == 1 ? 1 : (amount >= 2 && amount <= 4 ? 2 : 0));
					},
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['cs']);
			// BR
			} else if( 'pt_BR' === lang ) {
				$.countdown.regionalOptions['pt-BR'] = {
					labels: ['Anos', 'Meses', 'Semanas', 'Dias', 'Horas', 'Minutos', 'Segundos'],
					labels1: ['Ano', 'Mês', 'Semana', 'Dia', 'Hora', 'Minuto', 'Segundo'],
					compactLabels: ['a', 'm', 's', 'd'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['pt-BR']);
			// RO
			} else if( 'ro_RO' === lang ) {
				$.countdown.regionalOptions['ro'] = {
					labels: ['Ani', 'Luni', 'Saptamani', 'Zile', 'Ore', 'Minute', 'Secunde'],
					labels1: ['An', 'Luna', 'Saptamana', 'Ziua', 'Ora', 'Minutul', 'Secunda'],
					compactLabels: ['A', 'L', 'S', 'Z'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['ro']);
			// RU
			} else if( 'ru_RU' === lang ) {
				$.countdown.regionalOptions['ru'] = {
					labels: ['Лет', 'Месяцев', 'Недель', 'Дней', 'Часов', 'Минут', 'Секунд'],
					labels1: ['Год', 'Месяц', 'Неделя', 'День', 'Час', 'Минута', 'Секунда'],
					labels2: ['Года', 'Месяца', 'Недели', 'Дня', 'Часа', 'Минуты', 'Секунды'],
					compactLabels: ['л', 'м', 'н', 'д'], compactLabels1: ['г', 'м', 'н', 'д'],
					whichLabels: function(amount) {
						var units = amount % 10;
						var tens = Math.floor((amount % 100) / 10);
						return (amount == 1 ? 1 : (units >= 2 && units <= 4 && tens != 1 ? 2 :
							(units == 1 && tens != 1 ? 1 : 0)));
					},
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['ru']);
			// SW
			} else if( 'sv_SE' === lang ) {
				$.countdown.regionalOptions['sv'] = {
					labels: ['År', 'Månader', 'Veckor', 'Dagar', 'Timmar', 'Minuter', 'Sekunder'],
					labels1: ['År', 'Månad', 'Vecka', 'Dag', 'Timme', 'Minut', 'Sekund'],
					compactLabels: ['Å', 'M', 'V', 'D'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['sv']);
			// NO
			} else if( 'nb_NO' === lang || 'nn_NO' === lang ) {
				$.countdown.regionalOptions['nb'] = {
					labels: ['År', 'Måneder', 'Uker', 'Dager', 'Timer', 'Minutter', 'Sekunder'],
					labels1: ['År', 'Måned', 'Uke', 'Dag', 'Time', 'Minutt', 'Sekund'],
					compactLabels: ['Å', 'M', 'U', 'D'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['nb']);
			// DK
			} else if( 'da_DK' === lang ) {
				$.countdown.regionalOptions['da'] = {
					labels: ['År', 'Måneder', 'Uger', 'Dage', 'Timer', 'Minutter', 'Sekunder'],
					labels1: ['År', 'Måned', 'Uge', 'Dag', 'Time', 'Minut', 'Sekund'],
					compactLabels: ['Å', 'M', 'U', 'D'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['da']);
			// FI
			} else if( 'fi' === lang ) {
				$.countdown.regionalOptions['fi'] = {
					labels: ['vuotta', 'kuukautta', 'viikkoa', 'päivää', 'tuntia', 'minuuttia', 'sekuntia'],
					labels1: ['vuosi', 'kuukausi', 'viikko', 'päivä', 'tunti', 'minuutti', 'sekunti'],
					compactLabels: ['v', 'kk', 'vk', 'pv'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['fi']);

			// JA
			} else if( 'ja' === lang ) {
				$.countdown.regionalOptions['ja'] = {
					labels: ['年', '月', '週', '日', '時', '分', '秒'],
					labels1: ['年', '月', '週', '日', '時', '分', '秒'],
					compactLabels: ['年', '月', '週', '日'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['ja']);

			// KO
			} else if( 'ko_KR' === lang ) {
				$.countdown.regionalOptions['ko'] = {
					labels: ['년', '월', '주', '일', '시', '분', '초'],
					labels1: ['년', '월', '주', '일', '시', '분', '초'],
					compactLabels: ['년', '월', '주', '일'],
					compactLabels1: ['년', '월', '주', '일'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['ko']);

			// GR
			} else if( 'el' === lang ) {
				$.countdown.regionalOptions['el'] = {
					labels: ['Χρόνια', 'Μήνες', 'Εβδομάδες', 'Μέρες', 'Ώρες', 'Λεπτά', 'Δευτερόλεπτα'],
					labels1: ['Χρόνος', 'Μήνας', 'Εβδομάδα', 'Ημέρα', 'Ώρα', 'Λεπτό', 'Δευτερόλεπτο'],
					compactLabels: ['Χρ.', 'Μην.', 'Εβδ.', 'Ημ.'],
					whichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regionalOptions['el']);
			}
		}
	};

}( jQuery );

( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfThemeCountdown.init();
	} );

} )( jQuery );