<?php
/**
 * Mensagens do sistema
 */
//Cadastro Realizado
if ($this->session->flashdata('msg') == 'Cadastro')
{
    cadastroRealizado();
}
