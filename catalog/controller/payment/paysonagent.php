<?php
class ControllerPaymentPaysonagent extends Controller {
    	/**
	 * action to create and submit payson payment form
	 */
	protected function index() {

		$this->data['button_confirm'] = $this->language->get('button_confirm');
		$order_id = $this->session->data['order_id'];
		
		$this->load->model('checkout/order');
		
		$order= $this->model_checkout_order->getOrder($order_id);

	        	// set payson parameters 
	    	$AgentID=$this->config->get('paysonagent_agent_id');
	    	$Key=$this->config->get('paysonagent_md5_key');
	    	$SellerEmail =		$this->config->get('paysonagent_seller_email');
	    	$GuaranteeOffered = $this->config->get('paysonagent_guarantee_offered');
	    	$PaymentMethod  =  $this->config->get('paysonagent_payment_method');

	    	$OkUrl =	$this->url->link('payment/paysonagent/callback');
	    	$CancelUrl = $this->url->link('checkout/checkout');

	    	$RefNr = $this->encryption->encrypt($order_id); //Order number
	    	$Description =		$order['comment'];
	    	$BuyerEmail	=		$order['email'];
	    	
	    	$currency_code = $order['currency_code'];
		$amount = $this->currency->format($order['total'], $order['currency_code'], $order['currency_value'], false);
		// convert cost to SEK,  get round value. currency SEK must be installed
	    	$Cost = round($this->currency->convert($amount, $currency_code, 'SEK'));

	    	// $ExtraCost = $this->session->data['shipping_method']['cost'];
	    	$ExtraCost = 0;

	    	$MD5string = $SellerEmail . ":" . $Cost . ":" . $ExtraCost . ":" . $OkUrl . ":" . $GuaranteeOffered . $Key;
	    	$MD5Hash = md5($MD5string);
        
		$this->data['action'] = 'https://www.payson.se/merchant/default.aspx';
		$this->data['BuyerEmail'] = $BuyerEmail;
		$this->data['AgentID'] = $AgentID;
		$this->data['Description'] =$Description;
		$this->data['SellerEmail'] =$SellerEmail;
		$this->data['Cost'] =$Cost;
		$this->data['ExtraCost'] =$ExtraCost;
		$this->data['OkUrl'] =$OkUrl;
		$this->data['CancelUrl'] =$CancelUrl;
		$this->data['RefNr'] =$RefNr;
		$this->data['MD5Hash'] =$MD5Hash;
		$this->data['GuaranteeOffered'] =$GuaranteeOffered;
		$this->data['PaymentMethod'] =$PaymentMethod;
		// $this->log->write($this->data);
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/paysonagent.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/paysonagent.tpl';
		} else {
			$this->template = 'default/template/payment/paysonagent.tpl';
		}	
		
		$this->render(); 
	}
	
    	/**
	 * callback function initiated by payson when payment is successful
	 */	
	public function callback() {

    		$Key=$this->config->get('paysonagent_md5_key');
    		$strOkURL = isset($_REQUEST["OkURL"])?$_REQUEST["OkURL"]: '';
		$strRefNr = isset($_REQUEST["RefNr"])? $_REQUEST["RefNr"]: '';
		$strPaysonRef = isset($_REQUEST["Paysonref"])? $_REQUEST["Paysonref"] : '';
		
		$strTestMD5String = $strOkURL.$strPaysonRef.$Key;
		$MD5Hash = md5($strTestMD5String);

		$MD5String = isset($_REQUEST["MD5"])? $_REQUEST["MD5"] : '';

		if($MD5String === $MD5Hash)
		{
			$order_id = $this->encryption->decrypt($strRefNr);
			$this->load->model('checkout/order');
			$this->model_checkout_order->confirm($order_id, $this->config->get('paysonagent_order_status_id'));

			$this->redirect($this->url->link('checkout/success'));
		}
		else
		{
			$this->redirect($this->url->link('checkout/checkout'));
		}
	}	
}
?>