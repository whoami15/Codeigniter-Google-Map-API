<?php

/*
*  Codeigniter Google Map API
* @ Developer: Daryl Ferrer Legion
* @ Email: whoamisnowden@gmail.com
* @ Github: github.com/whoami15
* @ Copyright (c) 2016-2017
* @ License GNU Public Release
*/

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

