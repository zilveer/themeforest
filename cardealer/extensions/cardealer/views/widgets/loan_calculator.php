<?php
if (!defined('ABSPATH')) die('No direct access allowed');

global $post;
$car_price = get_post_meta($post->ID, 'car_price', true);
$default_amount = !empty($car_price) ? $car_price : $instance['loan_amount'];
$dealer_rate = get_user_meta($post->post_author, 'cardealer_loan_rate', 1);
$default_rate = $dealer_rate !== '' ? $dealer_rate : $instance['interest_rate'];
?>

<div class="widget widget_loan_calculator">
	
	<div class="boxed-widget">

		<?php if (!empty($instance['title'])): ?>
		
			<div class="widget-head">
				<h3 class="widget-title icon-calculator"><?php _e($instance['title'], 'cardealer'); ?></h3>
			</div>
		
		<?php endif; ?>

		<div class="boxed-entry">

			<form action="/" method="POST" name="myform" id="loan">

				<table>
					<tr>
						<td><label for="LoanAmount"><?php _e('Car Loan Amount', 'cardealer') ?></label></td>
						<td><input  name="LoanAmount" id="LoanAmount" type="text" value="<?php echo $default_amount ?>" /></td>
						<td><?php echo TMM_Ext_Car_Dealer::$default_currency['symbol'] ?></td>
					</tr>
					<tr>
						<td><label for="InterestRate"><?php _e('Annual Interest Rate', 'cardealer') ?></label></td>
						<td><input  name="InterestRate" id="InterestRate" type="text" value="<?php echo $default_rate ?>" /></td>
						<td>%</td>
					</tr>
					<tr>
						<td><label for="NumberOfYears"><?php _e('Term of Car Loan', 'cardealer') ?></label></td>
						<td><input  name="NumberOfYears" id="NumberOfYears" type="text" value="<?php echo $instance['number_of_years'] ?>" /></td>
						<td><?php _e('Years', 'cardealer') ?></td>
					</tr>
					<tr>
						<td>
							<button name="cal" class="button orange"><?php _e('Calculate', 'cardealer') ?></button>
						</td>
					</tr>
					<tr>
						<td><label for="NumberOfPayments"><?php _e('Number of Payments', 'cardealer') ?></label></td>
						<td><input disabled="" readonly="readonly" type="text" id="NumberOfPayments" name="NumberOfPayments" /></td>
						<td></td>
					</tr>
					<tr>
						<td><label for="MonthlyPayment"><?php _e('Monthly Payment', 'cardealer') ?></label></td>
						<td><input disabled="" readonly="readonly" type="text" id="MonthlyPayment" name="MonthlyPayment" /></td>
						<td><?php echo TMM_Ext_Car_Dealer::$default_currency['symbol'] ?></td>
					</tr>
				</table>					

			</form>

		</div><!--/ .boxed-entry-->	
		
	</div><!--/ .boxed-widget-->

</div><!--/ .widget-->

