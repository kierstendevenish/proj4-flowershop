<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bid extends CI_Controller {

	function __construct()
 	{
		parent::__construct();
 	}

	function consume()
        {
            log_message('info','here');
            $this->load->model('request');
            $deliveryId = $this->input->post('deliveryId');
            $driverName = $this->input->post('driverName');
            $estDeliveryTime = $this->input->post('estDeliveryTime');
            $rate = $this->input->post('rate');

            $this->request->saveBid($deliveryId, $driverName, $estDeliveryTime, $rate);
        }

        function listAll()
        {
            $this->load->model('request');
        }

        function accept($deliveryId = '', $driverName = '')
        {
            $this->load->model('request');
            $this->request->markAccepted($deliveryId);
            $esl = $this->request->getGuildEsl();
            $fields_str = '_name=bid_awarded&_domain=rfq&driverName='.$driverName.'&deliveryId='.$deliveryId;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $esl);
            curl_setopt($ch, CURLOPT_POST, 4);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_str);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_exec($ch);
            curl_close($ch);
        }

        
}

?>