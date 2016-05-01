<?php

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class PaymentController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

  public function index(){

    return View::make('card');


  }
	public function type_of_payment(){

		return View::make('type_of_payment');
	}

  public function payform(){

    return View::make('credit');

  }

  public function rest(){
	//
	$option = Input::get('option');
	//
	// if ($option == 1) {
	// 	return echo "Paypal_express";
	// }
	// else {
	// 	# code...
	// }

	if ($option == 1) {

		$gateway = Omnipay::create('PayPal_Express');
			$gateway->setUsername('iluis.06_api1.outlook.com');
			$gateway->setPassword('E727P533LGTL57R6');
			$gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31AXjJgfspI5c76JPDRaLi7Wc0EQuo');

			$gateway->setTestMode(true);

			$params = array(
								'cancelUrl' 	=> 'http://localhost:8000/cancel_order',
								'returnUrl' 	=> 'http://localhost:8000/payment_success',
								'name'		=> 'Clothes negros',
								'description' 	=> 'Nadiiwis',
								'amount' 	=> '200.00',
								'currency' 	=> 'USD'
				);

				Session::put('params', $params);
				Session::save();

				$response = $gateway->purchase($params)->send();

							if ($response->isSuccessful()) {

									// payment was successful: update database
									print_r($response);

					} elseif ($response->isRedirect()) {

									// redirect to offsite payment gateway
									$response->redirect();

						} else {

								// payment failed: display message to customer
								echo $response->getMessage();

						}

	}
	else {
		$gateway = Omnipay::create('PayPal_Rest');
 // Initialise the gateway
 $gateway->initialize(array(
		 'clientId' => 'AckrU5EX4bBfr4ZFJkXL54ff7Qont4o_-Tz3uHP0m2RqebHG_2C0OJE0Cxgk9xRYAZd-Lca6W9ofFnqp',
		 'secret'   => 'EOZWVev9QTb6NrD1bgBlBbUCjfzf0UCBVoDBbkg5c4T4Sn654vh5Ez0nXJ07v1cFNUU0CNtxqLqWxKVO',
		 'testMode' => true, // Or false when you are ready for live transactions
 ));
#### Direct Credit Card Payment
//'number' => '4032037583199993',
//02
//2021
//123
 // Create a credit card object
 // DO NOT USE THESE CARD VALUES -- substitute your own
 // see the documentation in the class header.
 $card = new CreditCard(array(
						 'firstName' => 'Luis',
						 'lastName' => 'Charres',
						 'number' => '4032037583199993',
						 'expiryMonth'           => '02',
						 'expiryYear'            => '2021',
						 'cvv'                   => '123',
						'billingAddress1'       => '1 Scrubby Creek Road',
					 'billingCountry'        => 'AU',
						 'billingCity'           => 'Scrubby Creek',
						 'billingPostcode'       => '4999',
						 'billingState'          => 'QLD',
 ));
 // Do a purchase transaction on the gateway
 try {
		 $transaction = $gateway->purchase(array(
				 'amount'        => '10.00',
				 'currency'      => 'USD',
				 'description'   => 'This is a test purchase transaction.',
				 'card'          => $card,
	 ));
		 $response = $transaction->send();
		 $data = $response->getData();
		 echo "Gateway purchase response data == " . print_r($data, true) . "\n";
		 if ($response->isSuccessful()) {
				 echo "Purchase transaction was successful!\n";
		 }
 } catch (\Exception $e) {
		 echo "Exception caught while attempting authorize.\n";
		 echo "Exception type == " . get_class($e) . "\n";
		 echo "Message == " . $e->getMessage() . "\n";
	}

	}

  }


}
