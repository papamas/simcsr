<?php if (!defined('BASEPATH')) die();
class Ui extends CI_Controller {

   public function index()
	{
		  $this->load->view('includes/header');
		  $this->load->view('ui');
		  $this->load->view('includes/footer');
	}
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
