<?php
/**
 * Mensagens do sistema
 */
//Cadastro Realizado
if ($this->session->flashdata('msg') == 'cadastro')
{
	cadastroRealizado();
}

//Falha no Cadastro 
if ($this->session->flashdata('msg') == 'falha-salvar')
{
	falhaSalvar();
}

//Falha - Registro já existe no banco 
if ($this->session->flashdata('msg') == 'falha-registro-exite')
{
	falhaRegistroExiste();
}

//Falha - Registro já existe no banco 
if ($this->session->flashdata('msg') == 'registro-nao-encontrado')
{
	falhaRegistroNaoExiste();
}

//Exclusao Realizada 
if ($this->session->flashdata('msg') == 'registro-excluido')
{
	registroExcluido();
}


//Falha na exclusao 
if ($this->session->flashdata('msg') == 'falha-exclusao-registro')
{
	falhaExclusaoRegistro();
}

//Alteração Realizada 
if ($this->session->flashdata('msg') == 'alteracao')
{
	alteracaoRealizada();
}

if ($this->session->flashdata('msg') == 'falha-importar') 
{
	falha_importar_dados();
}

if ($this->session->flashdata('msg') == 'importar-sucesso') 
{
	importar_dados_sucesso();
}