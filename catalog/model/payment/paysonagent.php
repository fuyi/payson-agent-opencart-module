<?php 
class ModelPaymentPaysonagent extends Model {

  	public function getMethod($address=null, $total=null) {
  		// only valid when currency SEK is installed
  		if(!$this->currency->has('SEK')) return false;

		$this->load->language('payment/paysonagent');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('payson_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
	
		if ($this->config->get('paysonagent_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('paysonagent_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'paysonagent',
        		'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('paysonagent_sort_order')
      		);
  	  	}
   
    		return $method_data;
  	}
}
?>