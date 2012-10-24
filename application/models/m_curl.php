<?php

class M_Curl extends CI_Model{
    
    public function ajouter ($data){
        
        $this->db->insert('curl', $data); 
        
        redirect('curl/index');
        
    }
    
    public function lister(){
        
        $query = $this->db->get('curl');
        
        return $query->result();
    }
    
    public function supprimer($id){
        
        $this->db->delete('curl', array('id' => $id)); 
        
        redirect('curl/index');
        
    }
    
    public function voir($id){
        
        $query = $this->db->get_where('mytable', array('id' => $id));
        
        return $query->row();
    }

    public function modifier(){
        
    }
    
}