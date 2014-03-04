<?php if (!defined('BASEPATH')) die();
class Outbox extends CI_Controller {

    public function index()
	{
		$this->load->model('m_outbox');
		$data['q'] = $this->m_outbox->all();
        $this->load->view('v_outbox',$data);
        
        		
	}

   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
