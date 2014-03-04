<?php

class M_facebook extends CI_Model {

    public function __construct()
    {
        parent::__construct();
		
    }

    public function fql()
    {
        
		$q = "SELECT  * FROM `inbox` WHERE 1=1  AND UDH=' ' AND TextDecoded !=' '  AND RecipientID='8121069988' AND `ReceivingDateTime` BETWEEN '2013-12-12 00:00:00' AND '2013-12-12 23:59:59' ORDER BY  `ReceivingDateTime` DESC";  
		return $this->db->query($q);
    }
	
	
	

  
}
