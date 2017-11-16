<?php
/*
  Plugin Name: The Collatz Conjecture Simulator
  Plugin URI: http://www.greateck.com/
  Description: A plugin used to simulate The Numerical Collatz Conjecture 
  Version: 1.0.1
  Author: Mohammad Farhat
  Author URI: http://www.greateck.com
  License: GPLv2
 */
 
/* shortcode to display the simulator on front end */

add_shortcode('collatz_simulator', 'display_collatz_simulator' );

function display_collatz_simulator( $atts, $content = "" ) {
	?>
	<html>
		<head>
			<style>
				#error_notice{
					color:red;
					display: none;
				}
			</style>
			<script>
				jQuery(document).ready(function($){
					//hooking to the click event to initiate the simulation
					$('#calculate_btn').click(function(){
						//grab the value of the input
						var starting_number = $('#starting_number').val();
						//assume it's not a number first
						if ($.isNumeric(starting_number)){
							if (Math.floor(starting_number) == starting_number){
								$('#error_notice').hide();
								perform_collatz(starting_number);
								return;
							}
						}
						$('#error_notice').show();
					});
					/* function to handle performing calculations based on collatz approach */
					function perform_collatz(value){
						//add the number to the start of the display
						$('#number_progress').empty().text('Starting Number:'+value);
						//loop until we get to 1
						while(value>1){
							if (value%2==0){
								//if value is even, divide by 2
								value /= 2;
								// alert(value);
								$('#number_progress').append('<br/>&darr;'+value);
							}else{
								//if value is odd, multiply by 3 and add 1
								value = value * 3 + 1;
								$('#number_progress').append('<br/>&uarr;'+value);
							}
						}
					}
				});
			</script>
		</head>
		<body>
			<label for="starting_number">Starting Number</label><input type="text" id="starting_number">
			<span><i>Positive Integer (whole number) Only</i></span>
			<br/><br/><input type="button" value="Let's Go!" id="calculate_btn">
			<div id="error_notice">Number has to be a positive Integer - Please adjust</div>
			<br/><div id="number_progress"></div>
		</body>
	</html>
	
	<?php

}