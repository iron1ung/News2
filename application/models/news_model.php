<?php

class News_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    
    public function get_news($slug = FALSE){
        if($slug === FALSE){
            //get all news records
            $query = $this->db->get('news');
            return $query->result_array();
        }
        //get a news item by its slug
        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
        
        }
}
?>
