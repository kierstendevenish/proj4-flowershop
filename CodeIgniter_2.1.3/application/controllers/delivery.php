<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delivery extends CI_Controller {

	function __construct()
 	{
		parent::__construct();
 	}

	function index()
	{
	}

        function request()
        {
                $this->load->helper(array('form'));
                $this->load->view('templates/header');
		$this->load->view('delivery_request_form');
                $this->load->view('templates/footer');
        }
        
        function sendRequest()
        {
            //get post data
            $pickupTime = $this->input->post('pickupTime');
            $deliveryAddr = $this->input->post('deliveryAddr');
            $deliveryTime = $this->input->post('deliveryTime');

            //get persistent data
            $this->load->model('request');
            $shopName = $this->request->getShopName();
            $coords = $this->request->getShopCoordinates();
            $shopCoords = $coords['lat'] . "," . $coords['long'];
            $shopEsl = $this->request->getShopEsl();

            //save request to db
            $id = $this->request->create($pickupTime, $deliveryAddr, $deliveryTime);

            //get list of esl's
            $this->load->model('user');
            $esls = $this->user->getAllEsls();
            foreach ($esls as $e)
            {
                //make post request
                $fields_str = '_name=delivery_ready&_domain=rfq&id='.$id.'&shopName='.$shopName.'&shopCoords='.$shopCoords.'&pickupTime='.$pickupTime.'&deliveryAddr='.$deliveryAddr.'&deliveryTime='.$deliveryTime.'&shopEsl='.$shopEsl;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $e);
                curl_setopt($ch, CURLOPT_POST, 6);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_str);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_exec($ch);
                curl_close($ch);
            }
        }
        
        function viewall()
        {
            $this->load->model('request');
            $data['requests'] = $this->request->allOpen();
            
            $this->load->view('templates/header');
            $this->load->view('list_open_requests', $data);
            $this->load->view('templates/footer');
        }

        function viewBids($requestId = '')
        {
            $this->load->model('request');
            $data['bids'] = $this->request->getBidsForRequest($requestId);
            $data['requestId'] = $requestId;

            $this->load->view('templates/header');
            $this->load->view('view_bids', $data);
            $this->load->view('templates/footer');
        }
}

?>