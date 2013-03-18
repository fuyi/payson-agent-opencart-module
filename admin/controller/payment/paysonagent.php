<?php 
class ControllerPaymentPaysonagent extends Controller {
	private $error = array(); 
	 
	public function index() {
		if(version_compare(VERSION, '1.5.5') >= 0) $this->language->load('payment/paysonagent');
		else $this->load->language('payment/paysonagent');
		
		$this->document->setTitle($this->language->get('heading_title'));
		 
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('paysonagent', $this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_guarantee'] = $this->language->get('text_guarantee');
		$this->data['text_payment_method'] = $this->language->get('text_payment_method');

		$this->data['text_payment_all'] = $this->language->get('text_payment_all');
		$this->data['text_payment_card'] = $this->language->get('text_payment_card');
		$this->data['text_payment_bank'] = $this->language->get('text_payment_bank');
		$this->data['text_payment_deposit'] = $this->language->get('text_payment_deposit');
				
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_total'] = $this->language->get('entry_total');	
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		  		$this->data['breadcrumbs'] = array();
		
		   		$this->data['breadcrumbs'][] = array(
		       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
		      		'separator' => false
		   		);
		
		   		$this->data['breadcrumbs'][] = array(
		       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
		      		'separator' => ' :: '
		   		);
		
		   		$this->data['breadcrumbs'][] = array(
		       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/paysonagent', 'token=' . $this->session->data['token'], 'SSL'),
		      		'separator' => ' :: '
		   		);
		
		$this->data['action'] = $this->url->link('payment/paysonagent', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');	
		
		//set payson parameters
		if (isset($this->request->post['paysonagent_agent_id'])) {
			$this->data['paysonagent_agent_id'] = $this->request->post['paysonagent_agent_id'];
		} else {
			$this->data['paysonagent_agent_id'] = $this->config->get('paysonagent_agent_id'); 
		}
		if (isset($this->request->post['paysonagent_md5_key'])) {
			$this->data['paysonagent_md5_key'] = $this->request->post['paysonagent_md5_key'];
		} else {
			$this->data['paysonagent_md5_key'] = $this->config->get('paysonagent_md5_key'); 
		}
		if (isset($this->request->post['paysonagent_seller_email'])) {
			$this->data['paysonagent_seller_email'] = $this->request->post['paysonagent_seller_email'];
		} else {
			$this->data['paysonagent_seller_email'] = $this->config->get('paysonagent_seller_email'); 
		}
		if (isset($this->request->post['paysonagent_guarantee_offered'])) {
			$this->data['paysonagent_guarantee_offered'] = $this->request->post['paysonagent_guarantee_offered'];
		} else {
			$this->data['paysonagent_guarantee_offered'] = $this->config->get('paysonagent_guarantee_offered'); 
		}
		if (isset($this->request->post['paysonagent_total'])) {
			$this->data['paysonagent_total'] = $this->request->post['paysonagent_total'];
		} else {
			$this->data['paysonagent_total'] = $this->config->get('paysonagent_total'); 
		}
				
		if (isset($this->request->post['paysonagent_order_status_id'])) {
			$this->data['paysonagent_order_status_id'] = $this->request->post['paysonagent_order_status_id'];
		} else {
			$this->data['paysonagent_order_status_id'] = $this->config->get('paysonagent_order_status_id'); 
		} 
		
		$this->data['paysonagent_guarantee_offered'] = $this->config->get('paysonagent_guarantee_offered'); 
		$this->data['paysonagent_payment_method'] = $this->config->get('paysonagent_payment_method'); 

		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['paysonagent_geo_zone_id'])) {
			$this->data['paysonagent_geo_zone_id'] = $this->request->post['paysonagent_geo_zone_id'];
		} else {
			$this->data['paysonagent_geo_zone_id'] = $this->config->get('paysonagent_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');						
		
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['payson_status'])) {
			$this->data['paysonagent_status'] = $this->request->post['paysonagent_status'];
		} else {
			$this->data['paysonagent_status'] = $this->config->get('paysonagent_status');
		}
		
		if (isset($this->request->post['paysonagent_sort_order'])) {
			$this->data['paysonagent_sort_order'] = $this->request->post['paysonagent_sort_order'];
		} else {
			$this->data['paysonagent_sort_order'] = $this->config->get('paysonagent_sort_order');
		}
		
		$this->template = 'payment/paysonagent.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/paysonagent')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>