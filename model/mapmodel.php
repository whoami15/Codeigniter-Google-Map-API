<?php
class Mapmodel extends CI_Model {

    var $table = 'yourtablename'; // table name here.

    public function __construct() {
        parent::__construct();
        $this->load->database();
       
    }

    public function get_map() {

        $data = array();

        $this->db->select ('crimeLat,crimeLong,crimeDate,crimeLoc,crimeDesc,crimeIcon');
        $sql = $this->db->get($this->table);
            if ($sql->num_rows () >0) {
                foreach($sql->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    
    

}

