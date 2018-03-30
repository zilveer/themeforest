jQuery(document).ready(function() {
	/* ---------------------------------------------------- */
	/*	Loan Calculator
	 /* ---------------------------------------------------- */

	var LOAN_CALCULATOR_OBJECT = function() {

		var self = {
			form: jQuery('#loan'),
			calculate: function() {
				var DownPayment = "0";
				self.get_amount();
				self.get_annual_rate();
				self.get_years();

				var MonthRate = AnnualRate / 12;
				var NumPayments = Years * 12;
				var Prin = LoanAmount - DownPayment;
				var MonthPayment = Math.floor((Prin * MonthRate) / (1 - Math.pow((1 + MonthRate), (-1 * NumPayments))) * 100) / 100;
				NumPayments=Math.ceil(NumPayments);
				self.update_number_payments(NumPayments);
				self.update_monthly_payment(MonthPayment);
			},
			init: function() {
				self.calculate();
				jQuery("[name=cal]", self.form).on("click", function(e) {
					self.calculate();
					e.preventDefault();
				});
			},
			get_amount: function() {
				return LoanAmount = parseFloat(self.normalize_data(jQuery('[name=LoanAmount]', self.form).val()));
			},
			get_annual_rate: function() {
				return AnnualRate = parseFloat(self.normalize_data(jQuery('[name=InterestRate]', self.form).val())) / 100;
			},
			get_years: function() {
				return Years = parseFloat(self.normalize_data(jQuery('[name=NumberOfYears]', self.form).val()));
			},
			update_number_payments: function(NumPayments) {
				return Math.ceil(parseFloat(self.form.find('[name=NumberOfPayments]').val(NumPayments)).toFixed(2));
			},
			update_monthly_payment: function(MonthPayment) {
				return parseFloat(self.form.find('[name=MonthlyPayment]').val(MonthPayment)).toFixed(2);
			},
			normalize_data: function(num) {
				return num.replace(',', '.');
			}
		};

		return self;

	};

	if (jQuery('.widget_loan_calculator').length) {
		var LOAN = new LOAN_CALCULATOR_OBJECT();
		LOAN.init();
	}

	/* end Loan Calculator */

});