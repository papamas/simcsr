<?php

class M_sent extends CI_Model {

    public function __construct()
    {
        parent::__construct();
		$this->load->database();
    }

    public function all()
    {
        
		$q = "SELECT  * FROM `sentitems` WHERE SenderID='8121069988'  AND `SendingDateTime` BETWEEN '2013-12-06 00:00:00' AND '2013-12-06 23:59:59'  ORDER BY  `SendingDateTime` DESC";  
		return $this->db->query($q);
    }
	
	
	

  
}
