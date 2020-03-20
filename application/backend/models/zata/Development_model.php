<?php
/**
 * Usuarios do sistema
 * @author Ralny Andrade de Oliveira
 * @version 1.0 
 * @since 30/09/2015 - 28/02/2016
 */
class Development_model extends CI_Model {
    //Nome da tabela de Versão
    protected $_table_versao = "ello_versao";
    //Nome da tabela de Releases
    protected $_table = "ello_releases";
    //Chave primaria
    protected $_primary_key = "idRelease";
    /**
    * Retornando Nome da Tabela
    */
    public function name_table() {
        return $this->_table;
    }
    /**
    * Retornando versões
    */
    public function getVersoes(){
        //Ordenando pelo ID de forma decresente
        $this->db->order_by("idVersao", "desc");
        //Ordenando pelo ID de forma decresente
        $this->db->limit(1000000,0);
        //Pulando a versao corrente
        $this->db->offset(1);
        //get    
        $query = $this->db->get($this->_table_versao);
        //resultados
        return $query->result();
    }
    /**
    * Retornando releases
    */
    public function getReleases(){
        //Ordenando pelo ID de forma decresente
        $this->db->order_by("idRelease", "desc");
        //get
        $query = $this->db->get($this->_table);
        //resultados
        return $query->result();
    }
    /**
    * Inserindo nova Versao
    */
    public function insert_new_version($dados) {
        //inserindo
        return $this->db->insert($this->_table_versao, $dados);
    } 
    /**
    * Inserindo nova Note Release
    */
    public function insertRelease($dados) {
        //inserindo
        return $this->db->insert($this->_table, $dados);
    }
    /**
    * Retorna o ID da Versao Corrente
    */
    public function versao_corrente() {
 
        $sql = "
                SELECT  
                    * 
                FROM 
                    $this->_table_versao 
                ORDER BY 
                    idVersao 
                DESC LIMIT 1 
                ";   
        //execultando a consulta
        $query = $this->db->query($sql);
        //retornando dados da consulta para o controller
        return $query->row();
    }
    
   
    
}//Fim da classe
