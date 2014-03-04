<?php if (!defined('BASEPATH')) die();
class Inbox extends CI_Controller {

    public function index()
	{
		$this->load->model('m_inbox');
		$data['q'] = $this->m_inbox->all();
        $this->load->view('v_inbox',$data);
               		
	}

   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
