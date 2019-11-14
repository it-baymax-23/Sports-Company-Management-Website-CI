<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('User_model');
		$this->load->model('Manage_model');
	}

	public function index()
	{
		$data['menu'] = 'index';
		$data['schedules'] = $this->Manage_model->get_all_schedule();
		$data['oldest_schedule'] = $this->Manage_model->get_oldest_schedule();
		$data['teams'] = $this->Manage_model->get_all_team();
		$data['sliders'] = $this->Manage_model->get_active_slider();
		$data['latest_result'] = $this->Manage_model->get_latest_result();
		$data['latest_news'] = $this->Manage_model->get_latest_news();
		$data['standings'] = $this->Manage_model->get_all_teampoints();
		$data['tournaments'] = $this->Manage_model->get_all_tournament();
		$data['trainings'] = $this->Manage_model->get_all_training();
		$data['products'] = $this->Manage_model->get_active_all_product();
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/index');
		$this->load->view('frontend/footer');
	}

	public function about()
	{
		$data['menu'] = 'about';
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/about');
		$this->load->view('frontend/footer');
	}

	public function sponsor()
	{
		$data['menu'] = 'sponsor';
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/sponsor');
		$this->load->view('frontend/footer');
	}

	public function academy()
	{
		$data['menu'] = 'academy';
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/academy');
		$this->load->view('frontend/footer');
	}

	public function donate()
	{
		$data['menu'] = 'donate';
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/donate');
		$this->load->view('frontend/footer');
	}

	public function shop($id = null)
	{
		$data['menu'] = 'shop';
		$data['products'] = $this->Manage_model->get_active_all_products($id);
		$data['categories'] = $this->Manage_model->get_all_categories();
		$data['colors'] = $this->Manage_model->get_all_colors();
		$data['sizes'] = $this->Manage_model->get_all_sizes();
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/shop',$data);
		$this->load->view('frontend/footer');
	}
	public function shop_attr($id = null)
	{
		$data['menu'] = 'shop';
		$data['products'] = $this->Manage_model->get_active_all_products_attr($id);
		$data['categories'] = $this->Manage_model->get_all_categories();
		$data['colors'] = $this->Manage_model->get_all_colors();
		$data['sizes'] = $this->Manage_model->get_all_sizes();
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/shop',$data);
		$this->load->view('frontend/footer');
	}
	public function shop_colour($id = null)
	{
		$data['menu'] = 'shop';
		$data['products'] = $this->Manage_model->get_active_all_products_colour($id);
		$data['categories'] = $this->Manage_model->get_all_categories();
		$data['colors'] = $this->Manage_model->get_all_colors();
		$data['sizes'] = $this->Manage_model->get_all_sizes();
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/shop',$data);
		$this->load->view('frontend/footer');
	}

	public function product_details($id = null)
	{
		$data['menu'] = 'product-details';
		$data['product'] = $this->Manage_model->get_product_by_id($id);
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/product-details', $data);
		$this->load->view('frontend/footer');
	}

	public function shopcart()
	{
		$data['menu'] = 'shopcart';
		$data['deliveries'] = $this->Manage_model->get_all_active_delivery();
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/shopcart');
		$this->load->view('frontend/footer');
	}

	public function contact()
	{
		$data['menu'] = 'contact';
		
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');

		if ($user_id && $user_name)
		{
			$data['user'] = $this->User_model->get_user_by_id($user_id);
			$data['user_id'] = $user_id;
			$data['user_name'] = $user_name;
		}
		else
		{
			$data['user'] = '';
			$data['user_id'] = '';
			$data['user_name'] = '';
		}

		$this->load->view('frontend/header', $data);
		$this->load->view('frontend/contact');
		$this->load->view('frontend/footer');
	}

	public function pay()
	{
        // Set variables for paypal form
        $returnURL = base_url().'shop/pay_success';
        $cancelURL = base_url().'shop/pay_cancel';
        $notifyURL = base_url().'shop/pay_ipn';
        
        // Get product data from the database
        // $product = $this->product->getRows($id);
        
        $product['id'] = $_GET["product_id"];
        $product['name'] = $_GET["product_name"];
        $product['price'] = $_GET["product_price"];
        
        // Get current user ID from the session
        $userID = $this->session->userdata('user_id');
        
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['name']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product['id']);
        $this->paypal_lib->add_field('amount',  $product['price']);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }

    function pay_success()
    {
        // Get the transaction data
        $paypalInfo = $this->input->get();

        $data['item_name']      = $paypalInfo['item_name'];
        $data['item_number']    = $paypalInfo['item_number'];
        $data['txn_id']         = $paypalInfo["tx"];
        $data['payment_amt']    = $paypalInfo["amt"];
        $data['currency_code']  = $paypalInfo["cc"];
        $data['status']         = $paypalInfo["st"];
        
        // Pass the transaction data to view
        $this->load->view('frontend/success', $data);
    }
     
    function pay_cancel()
    {
        // Load payment failed view
        $this->load->view('frontend/cancel');
     }
     
    function pay_ipn()
    {
        // Paypal posts the transaction data
        $paypalInfo = $this->input->post();
        
        if (!empty($paypalInfo))
        {
            // Validate and get the ipn response
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
            if ($ipnCheck)
            {
                // Insert the transaction data in the database
                $data['user_id']        = $paypalInfo["custom"];
                $data['product_id']     = $paypalInfo["item_number"];
                $data['txn_id']         = $paypalInfo["txn_id"];
                $data['payment_gross']  = $paypalInfo["mc_gross"];
                $data['currency_code']  = $paypalInfo["mc_currency"];
                $data['buyer_email']    = $paypalInfo["payer_email"];
                $data['payment_status'] = $paypalInfo["payment_status"];

                $this->Manage_model->insertTransactionProduct($data);
            }
        }
    }
}
