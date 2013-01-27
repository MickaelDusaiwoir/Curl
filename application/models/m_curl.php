<?php

class M_Curl extends CI_Model {

    public function ajouter($data) {

        $this->db->insert('curl', $data);

        redirect('curl/index');
    }

    public function lister() {

        $query = $this->db->get('curl');

        return $query->result();
    }

    public function supprimer($id) {

        $this->db->delete('curl', array('id' => $id));

        redirect('curl/index');
    }

    public function voir($id) {

        $query = $this->db->get_where('curl', array('id' => $id));

        return $query->row();
    }

    public function modifier($data) {
        
        $this->db->where('id', $data['id']);       
        
        //$this->db->update('curl', array('url' => $data['url'], 'titre' => $data['titre'], 'description' => $data['description'], 'image' => $data['image']));
     
        $this->db->update('curl', array('url' => $data['url'], 'titre' => $data['titre'], 'description' => $data['description']));
        
        redirect('curl/index');
    }

}