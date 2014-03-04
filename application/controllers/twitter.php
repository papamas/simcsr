<?php
/**
 * Twitter OAuth library.
 * Sample controller.
 * Requirements: enabled Session library, enabled URL helper
 * Please note that this sample controller is just an example of how you can use the library.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/* Load OAuth lib. You can find it at http://oauth.net */
//require_once(APPPATH.'/libraries/twitteroauth/OAuth.php');

class Twitter extends CI_Controller
{
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	/**
	 * Controller constructor
	 */
	function __construct()
	{
		parent::__construct();	
		
	}
	
	public function index()
	{
	
	    $data['content'] = '<a href='.base_url().'twitter/redirect><img src='.base_url().'assets/img/lighter.png alt="Sign in with Twitter"/></a>';
		$this->load->view('v_twitter',$data); 
	}
	
	public function redirect()
	{
	    /* Set Parameter */
		$params = array('consumer_key'        => '3zrlsDUOxHKycBWGjs29Hg',
		                'consumer_secret'     => 'ftmz0LfGjvYLPA7agWy1tr5jxt0XLW2x2oDisaKkU',
						'oauth_token'         => NULL,
						'oauth_token_secret'  => NULL
		);
		
		/* Load Twitter Oauth Library */
		$this->load->library('twitteroauth',$params);
		
	    /* Build TwitterOAuth object with client credentials. */
		$connection = $this->twitteroauth; 
		
		/* Get temporary credentials. */
		$request_token = $connection->getRequestToken(base_url('twitter/callback'));
	
        /* Save temporary credentials to session. */
		$oauthdata = array(
                   'oauth_token'              => $request_token['oauth_token'],
                   'oauth_token_secret'       => $request_token['oauth_token_secret'],
                   'oauth_callback_confirmed' => $request_token['oauth_callback_confirmed']
        );

        $this->session->set_userdata($oauthdata);
		
		/* If last connection failed don't display authorization link. */
		switch ($connection->http_code) {
		  case 200: 
			/* Build authorize URL and redirect user to Twitter. */
			$url = $connection->getAuthorizeURL($oauthdata);
			redirect($url);
			break;
		  default: 
			/* Show notification if something went wrong. */
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
   
	}
	
	public function clear_sessions()
	{
	    $this->session->sess_destroy();
        $data['content'] = '<a href='.base_url().'twitter/redirect><img src='.base_url().'assets/img/lighter.png alt="Sign in with Twitter"/></a>';
		$this->load->view('v_twitter',$data);  		
	
	}
	
	public function sess()
	{
	    print_r($this->session->all_userdata());  
	}
	
	public function callback()
	{
	    /* If the oauth_token is old redirect to the connect page. */
		if (isset($_REQUEST['oauth_token']) && $this->session->userdata('oauth_token') !== $_REQUEST['oauth_token']) {
		   $this->session->set_userdata('oauth_status','oldtoken');
		   redirect('twitter/clear_sessions');
		} 
		/* Set parameter after request token */
		$params = array('consumer_key'        => '3zrlsDUOxHKycBWGjs29Hg',
		                'consumer_secret'     => 'ftmz0LfGjvYLPA7agWy1tr5jxt0XLW2x2oDisaKkU',
						'oauth_token'         => $this->session->userdata('oauth_token'),
						'oauth_token_secret'  => $this->session->userdata('oauth_token_secret')
		);
		
		/* Load Library Twitter Oauth*/
		$this->load->library('twitteroauth',$params);
		
	    /* Build TwitterOAuth object with client credentials. */
		$connection = $this->twitteroauth;
		
		/* Request access tokens from twitter */
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		
		/* Save the access tokens. Normally these would be saved in a database for future use. */
        $this->session->set_userdata('access_token',$access_token ) ;
		
		/* Remove no longer needed request tokens */
		$this->session->set_userdata('oauth_token','') ;
		$this->session->set_userdata('oauth_token_secret','') ;

		/* If HTTP response is 200 continue otherwise send to connect page to retry */
		if (200 == $connection->http_code) {
		/* The user has been verified and the access tokens can be saved for future use */
		    $this->session->set_userdata('status','verified') ;
		    redirect('twitter/verified');
		} else {
		/* Save HTTP status for error dialog on connnect page.*/
		    redirect('twitter');
		}
	
	}
	
	public function verified()
	
	{	    
		/* Get user access tokens out of the session. */
		$access_token = $this->session->userdata('access_token');

		/* Create a TwitterOauth object with consumer/user tokens. */
		$params = array('consumer_key'        => '3zrlsDUOxHKycBWGjs29Hg',
		                'consumer_secret'     => 'ftmz0LfGjvYLPA7agWy1tr5jxt0XLW2x2oDisaKkU',
						'oauth_token'         => $access_token['oauth_token'],
						'oauth_token_secret'  => $access_token['oauth_token_secret']
		);
		
		/* Load library Twitter Oauth */
		$this->load->library('twitteroauth',$params); 
		
	    /* Build TwitterOAuth object with client credentials. */
		$connection = $this->twitteroauth; 	
		
		/* If method is set change API call made. Test is called by default. */
		//$content = $connection->get('account/verify_credentials');
		$content = $connection->get('users/show.json?screen_name=papa_mas');
		/* Display informasi after verified */
        $data['content'] = $content;
		$this->load->view('v_twitter',$data);
	}
}

/* End of file twitter.php */
/* Location: ./application/controllers/twitter.php */