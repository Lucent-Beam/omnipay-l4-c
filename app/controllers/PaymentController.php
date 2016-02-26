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

  public function postPayment(){
        




  }

  public function rest(){

  $gateway = Omnipay::create('PayPal_Rest');

   // Initialise the gateway
   $gateway->initialize(array(
       'clientId' => 'AckrU5EX4bBfr4ZFJkXL54ff7Qont4o_-Tz3uHP0m2RqebHG_2C0OJE0Cxgk9xRYAZd-Lca6W9ofFnqp',
       'secret'   => 'EOZWVev9QTb6NrD1bgBlBbUCjfzf0UCBVoDBbkg5c4T4Sn654vh5Ez0nXJ07v1cFNUU0CNtxqLqWxKVO',
       'testMode' => true, // Or false when you are ready for live transactions
   ));


 #### Direct Credit Card Payment


   // Create a credit card object
   // DO NOT USE THESE CARD VALUES -- substitute your own
   // see the documentation in the class header.
   $card = new CreditCard(array(
               'firstName' => 'Example',
               'lastName' => 'User',
               'number' => '4111111111111111',
               'expiryMonth'           => '01',
               'expiryYear'            => '2020',
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
           'currency'      => 'AUD',
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
