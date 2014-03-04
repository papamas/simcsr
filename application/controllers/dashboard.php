<?php if (!defined('BASEPATH')) die();
class Dashboard extends CI_Controller {

    public function index()
	{
		//$this->load->model('m_inbox');
		//$data['q'] = $this->m_inbox->all();
        $this->load->view('v_dashboard');
               		
	}

   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
