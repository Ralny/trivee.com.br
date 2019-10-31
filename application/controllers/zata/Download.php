<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
    /**
     * Construtor
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->helper('download');
    }


    /**
     * Como utilizar
     * 
     * @param $fileName é o arquivo que vai ser baixado 
     * 
     * exemplo:
     *  <a href="<?=base_url ()?>download_tpl_importacao/tpl_imp_Eventos_utilizacao_salas.csv"> Download do template de importação</a>
     */

    public function download_tpl_importacao($fileName = NULL)
    {
        if ($fileName) 
        {
            //path
            $file = 'files/downloads/tpl_importacao/'.$fileName;
            
            // Verifica se o arquivo existe    
            if (file_exists($file))
            {
                // get file content
                $data = file_get_contents($file);
                //force download
                force_download($fileName, $data);
            } 
        }
    }
}
