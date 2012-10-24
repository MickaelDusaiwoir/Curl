<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curl extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('form');

        $this->afficher();
    }

    public function afficher() {

        $this->load->model('M_Curl');

        $dataListe['donnees'] = $this->M_Curl->lister();

        $dataLayout['titre'] = 'Partage tes liens';
        $dataLayout['vue'] = $this->load->view('afficher', $dataListe, true);

        $this->load->view('layout', $dataLayout);
    }

    public function choisir() {
        $this->load->helper('form');
        $url = $this->input->post('url');
        
        $title = '';
        $description = '';
        $tabSrc = '';

        if ($url) {
            
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

            $html = curl_exec($ch);
            curl_close($ch);

            $dom = new DOMDocument();
            @$dom->loadHTML($html);

            $nodes = $dom->getElementsByTagName('title');
            $title = $nodes->item(0)->nodeValue;

            $metas = $dom->getElementsByTagName('meta');

            for ($i = 0; $i < $metas->length; $i++) {
                $meta = $metas->item($i);
                if (strtolower($meta->getAttribute('name')) == 'description') {
                    $description = $meta->getAttribute('content');
                }
            }

            $allImage = $dom->getElementsByTagName('img');
            
            foreach ($allImage as $image) {

                $tmp = $image->getAttribute('src');
                
                if ($tmp) {
                    $img = $this->rel2abs($tmp, $url);
                    $taille = getimagesize($img);
                    if ($taille[0] > 100) {
                      $tabSrc[] = $img;
                    }
                }
            }
        }

        $dataUrl['description'] = utf8_encode(utf8_decode($description));

        $dataUrl['url'] = $url;
        
        $dataUrl['title'] = $title;

        $dataUrl['tabSrc'] = $tabSrc;

        $dataLayout['titre'] = 'Choisir une vigniettes';

        $dataLayout['vue'] = $this->load->view('choisir', $dataUrl, true);

        $this->load->view('layout', $dataLayout);
    }

    private function rel2abs($tmp, $url) {
        if (parse_url($tmp, PHP_URL_SCHEME) != '')
            return $tmp;

        if ($tmp[0] == '#' || $tmp[0] == '?')
            return $url . $tmp;

        extract(parse_url($url));
 
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] : 'http'; 
        //$host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
        //$path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        
        $path = preg_replace('#/[^/]*$#', '', $path);

        if ($tmp[0] == '/')
            $path = '';
        
        $abs = "$host$path/$tmp";

        $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
        for ($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {
            
        }

        $img = $scheme . '://' . $abs;

        return $img;
    }

    public function ajouter() {

        $this->load->library('image_lib');
        $this->load->model('M_Curl');

        $titre = $this->input->post('titre');
        $description = $this->input->post('descri');
        $urlImage = $this->input->post('choix');
        $url = $this->input->post('url');        
        
        $extImage = explode('.', $urlImage);
        $nom = 'f' . time() . rand(0,1000) . '.' . $extImage[3];
            
        $image = file_get_contents($urlImage);
        file_put_contents('web/uploads/'.$nom, $image);

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'web/uploads/'.$nom;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 250;
        $config['height'] = 200;

        $this->image_lib->initialize($config);
        
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        
        $data = array('titre' => $titre, 'image' => $nom, 'description' => $description, 'url' => $url);
        
        $this->M_Curl->ajouter($data);
        
    }
    
    public function supprimer(){
        
        $this->load->model('M_Curl');
        
        $id = $this->uri->segment(3);
        
        $this->M_Curl->supprimer($id);
        
    }
    
    public function voir(){
        
        $this->load->model('M_Curl');
        
        $id = $this->uri->segment(3);
        
        $dataArticle['donnee'] = $this->M_Curl->voir($id);
        
        $dataLayout['vue'] = $this->load->view('modifier',$dataArticle,true);
        
        $dataLayout['titre'] = 'Modifier un article';
        
        $this->load->view('layout', $dataLayout);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */