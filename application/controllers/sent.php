<?php if (!defined('BASEPATH')) die();
class Sent extends CI_Controller {

    public function index()
	{
		$this->load->model('m_sent');
		$data['q'] = $this->m_sent->all();
        $this->load->view('v_sent',$data);
                		
	}

   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
