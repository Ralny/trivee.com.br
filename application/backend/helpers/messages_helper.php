<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//TOASTR
function _init($tipo, $mensagem, $titulo, $class) {

    $toast = '      
                <script>
                        jQuery(document).ready(function() {     
                              toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "'.$class.'",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                              } 
                              toastr.'.$tipo.'("'.$mensagem.'", "'.$titulo.'")

                        });
                </script>
            ';

    echo $toast;
}
//MENSAGENS CRUD
function cadastroRealizado() {
    _init('success', 'CADASTRADO COM SUCESSO.', '', 'toast-top-center');
}

function falhaSalvar() {
    _init('error', 'DESCULPE MAS OCORREU UM ERRO.', '', 'toast-top-center');
}

function falhaRegistroExiste() {
    _init('error', 'ESSE REGISTRO NÃO PODE SER SALVO, ELE JÁ EXISTE.', '', 'toast-top-center');
}

function falhaRegistroNaoExiste() {
    _init('error', 'DESCULPE, MAS ESSE REGISTRO NÃO FOI ENCONTRADO.', '', 'toast-top-center');
}

function registroExcluido() {
    _init('success', 'EXCLUIDO COM SUCESSO.', '', 'toast-top-center');
}

function falhaExclusaoRegistro() {
    _init('error', 'O REGISTRO NÃO FOI EXCLUIDO. TENTE NOVAMENTE.', '', 'toast-top-center');
}

function alteracaoRealizada() {
    _init('success', 'ATUALIZADO COM SUCESSO.', '', 'toast-top-center');
}


/**
* USUARIO
*/
function  usuarioOusenhaNaoEncontrado()
{
    echo '<div class="alert alert-danger display-hide" style="display: block;">
            <button class="close" data-close="alert"></button>
            <span>O e-mail e a senha que você digitou não coincidem.</span>
          </div>
          ';
}

function  usuarioBloqueado()
{
    echo '<div class="alert alert-danger display-hide" style="display: block;">
            <button class="close" data-close="alert"></button>
            <span>Sua conta está bloqueada. Entre em contato com o seu supervisor.</span>
          </div>
          ';
}

function  usuarioSolcitacaoPendente()
{
    echo '<div class="alert alert-danger display-hide" style="display: block;">
            <button class="close" data-close="alert"></button>
            <span>Sua conta está pendente de aprovação. Em breve nossa equipe irá entrar em contato para finalizar o seu cadastro.</span>
          </div>
          ';
}

function  usuarioSolcitacaoAprovada()
{
    echo '<div class="alert alert-danger display-hide" style="display: block;">
            <button class="close" data-close="alert"></button>
            <span>Sua conta já foi autorizada!. Faça o login.</span>
          </div>
          ';
}

function  usuarioFalhaSuporteTecnico()
{
    echo '<div class="alert alert-danger display-hide" style="display: block;">
            <button class="close" data-close="alert"></button>
            <span>Falha na Aplicação. Entre em contato com o suporte!.</span>
          </div>
          ';
}

function  elloErroNaoIdentificado()
{
    echo '<div class="alert alert-danger display-hide" style="display: block;">
            <button class="close" data-close="alert"></button>
            <span>Erro não identificado! Entre em contato com o suporte.</span>
          </div>
          ';
}

function  usuarioFalhaSalvarSolicitacao()
{
    echo '<div class="alert alert-danger display-hide" style="display: block;">
            <button class="close" data-close="alert"></button>
            <span>Ocorreu um erro ao salvar sua solicitação! Tente novamente.</span>
          </div>
          ';
}

function  falha_importar_dados()
{
    
    _init('error', 'Falha na importação de dados', '', 'toast-top-center');      

}

function  importar_dados_sucesso()
{
    _init('success', 'Importação realizada com sucesso.', '', 'toast-top-center');
}