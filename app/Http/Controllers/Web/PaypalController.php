<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

use Mail;
use App\Mail\AdminAlert;

class PaypalController extends Controller
{
    public function pay($id) {
		$o = \App\Order::find($id);

		$gateway = Omnipay::create('PayPal_Express');
		$gateway->setTestMode(param('paypal_testmode'));

		if (param('paypal_testmode')) { // entro nel sandbox
			$gateway->setUsername(param('paypal_api_user_test'));
			$gateway->setPassword(param('paypal_api_password_test'));
			$gateway->setSignature(param('paypal_api_signature_test'));
		}
		else{ // entro in produzione
			$gateway->setUsername(param('paypal_api_user'));
			$gateway->setPassword(param('paypal_api_password'));
			$gateway->setSignature(param('paypal_api_signature'));			
		}	

		$u = Auth::user();
		$b = $u->b;

		// dati acquirente
		$formInputData = array(
		    'firstName' => $u->name,
		    'lastName' => $u->lastname,
		    'billingAddress1' => $b->address,
		    'billingCity' => $b->city,
		    'billingPostcode' => $b->postal_code,
		    'email' => $u->email
		);
		$card = new CreditCard($formInputData);	

		// preparo l'array del pagamento 
		// servirà dopo per il controllo deifnitivo
		$arrPurchase = array(
		    'amount' => $o->total,
		    'currency' => 'EUR',
		    'description' => $o->label,
		    'transactionId' => $o->id.'-'.date('Ymd', strtotime($o->created_at)),
		    'card' => $card,
		    'returnUrl' => action('Web\PaypalController@check', array($o->id)),
		    'cancelUrl' => action('Web\CartController@error'),		
		);

		// redirect PayPal		
		$response = $gateway->purchase($arrPurchase)->send();
		$responsedata = $response->getData();

		// token
		$o->payment_token = @$responsedata['TOKEN'];
		$o->save();

		if ($response->isSuccessful()) {
			// non dovremmo mai entrare qua perchè reindirizzati su paypal
		} elseif ($response->isRedirect()) {
		    $response->redirect(); // caso comune in cui siamo reindirizzati sul portale di PayPal
		} else {
			// caso di errore salvo il log nella base di dati
			$o->payment_log	= trim($response->getMessage());
			$o->save();

	        // send alert
	        $message = $o->label."<br/>";
	        $message .= $responsedata['L_LONGMESSAGE0'];
	        $m = new \App\Mailmessage($message);
	        Mail::to(param('site_email_admin'))
	            ->queue(new AdminAlert($m));

			return redirect()->action('Web\CartController@error')->with('error', trans('labels.paypal_payment_error'));
		}		
    }

    public function check(Request $request, $id) {
    	$token = $request->get('token'); // arriva da paypal
		$o = \App\Order::where('id','=',$id)->where('payment_token','=',$token)->first();

		if (!$o) {

	        // send alert
	        $message = 'Mancata corrispondenza tra il carrello: '.$o->label.' e il token: '.$token;
	        $m = new \App\Mailmessage($message);
	        Mail::to(param('site_email_admin'))
	            ->queue(new AdminAlert($m));

			return redirect()->action('Web\CartController@error')->with('error', trans('labels.paypal_check_error'));
		}	

		$gateway = Omnipay::create('PayPal_Express');
		$gateway->setTestMode(param('paypal_testmode'));

		if (param('paypal_testmode')) { // entro nel sandbox
			$gateway->setUsername(param('paypal_api_user_test'));
			$gateway->setPassword(param('paypal_api_password_test'));
			$gateway->setSignature(param('paypal_api_signature_test'));
		}
		else{ // entro in produzione
			$gateway->setUsername(param('paypal_api_user'));
			$gateway->setPassword(param('paypal_api_password'));
			$gateway->setSignature(param('paypal_api_signature'));			
		}

		// ricostruisco l'array del pagamento per il controllo
		// con i dati pagati
		$arrPurchase = array(
		    'amount' => $o->total,
		    'currency' => 'EUR',
		    'description' => $o->label,
		    'transactionId' => $o->id.'-'.date('Ymd', strtotime($o->created_at)),
		    'returnUrl' => action('Web\PaypalController@check', array($o->id)),
		    'cancelUrl' => action('Web\CartController@error'),		
		);		

		$response = $gateway->completePurchase($arrPurchase)->send();
		$responsedata = $response->getData();

		// salvo il log della transazione 
		$o->payment_log = trim($o->payment_log.json_encode($responsedata)."\n\n");
		$o->save();

		// controllo un eventuale errore nella verifica
		if ($responsedata['ACK'] != 'Success') {

	        // send alert
	        $message = 'Fallito il pagamento del carrello: '.$o->label."\n";
	        $message .= '\nReason: PayPal non lo ha autorizzato per il seguente motivo' .$responsedata['L_LONGMESSAGE0'];
	        $m = new \App\Mailmessage($message);
	        Mail::to(param('site_email_admin'))
	            ->queue(new AdminAlert($m));			

			return redirect()->action('Web\CartController@error')->with('error', trans('labels.paypal_payment_error'));
		} 
		else {
			$o->paid = '1'; // ordine pagato
			$o->save();

			// send alert
	        $message = 'Pagato carrello: '.$o->label."\n";	        
	        $m = new \App\Mailmessage($message);
	        Mail::to(param('site_email_admin'))
	            ->queue(new AdminAlert($m));			

			return redirect()->action('Web\CartController@finish', ['id'=>$o->id]);
		}


    }
}
