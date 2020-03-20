<?php
/**
 * Upload de arquivos
 * @author Ralny Andrade de Oliveira
 * @version 1.0 
 * @since 26/05/2016
 */
class Upload_model extends CI_Model {
    
    /**
    * Insert UPLOAD de Imagem 
    */
    public function do_upload_imgs($dados) {
        return $this->db->insert('upload_imagens', $dados);
    }

    /**
    * update UPLOAD de Imagem 
    */
    public function update_upload_imgs($token_id, $table, $data) {

  		 $this->db->where( array( 'token_id' => $token_id ));

		 $this->db->update( $table , $data );
    }


    


    

    

    

    
    
}//Fim da classe
