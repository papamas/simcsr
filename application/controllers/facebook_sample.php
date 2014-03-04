<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook_sample extends CI_Controller {

	public function __construct(){
		parent::__construct();
		/* Set Parameter */
		$params = array(
            'appId' => '371935106280292',
            'secret' => '1aecc1de321db51386afbccff53232dd',
        );
		// load facebook library
		$this->load->library('facebook',$params);
		
		
	}
	
	public function index()
	{
	
	    $this->login();  
	}

	public function login(){

		// Retrieve User's Profile via the Graph API
		$user = $this->facebook->getUser();
		
		     
        if ($user)
		{
		   
            $this->session->set_userdata($user);
			
			try 
			{
                $data['user_profile'] = $this->facebook->api('/me','GET');
            } 
			catch (FacebookApiException $e) {
                $user = null;
            }
        }
		else 
		{
           $this->facebook->destroySession();
        }

        if ($user)
		{
            $data['logout_url'] = site_url('facebook_sample/logout'); // Logs off application
        } 
		else 
		{
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => 'http://local.papawow.com/simcsr/facebook_sample/',
                'scope' => array('email,read_mailbox,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown') // permissions here
            ));
        }
		
        $this->load->view('v_facebook',$data); 

	}

    public function logout(){

            
		$this->facebook->destroySession();
        redirect('facebook_sample/login');
    }
	
	public function get_pesan()
	
	{
	
	    //print_r($this->session->all_userdata());
		$pesan  = $this->facebook->api('/1756350373?fields=id,name,inbox.fields(from,comments)','GET');
		echo json_encode($pesan);
		
	}

}

