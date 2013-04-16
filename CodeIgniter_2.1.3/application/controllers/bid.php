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
            $esl = $this->$request->getGuildEsl();
            var_dump($esl);
        }

        
}

?>