<?php defined('BASEPATH') OR exit('No direct script access allowed');
//http://imasters.com.br/artigo/24710/codeigniter/manipulacao-de-imagens-com-o-codeigniter/?trace=1519021197&source=single
//http://www.plasmadesign.com.br/codeigniter/user_guide-pt_BR/libraries/image_lib.html
//https://ellislab.com/codeigniter/user-guide/libraries/image_lib.html
//http://www.codeigniter.com/user_guide/libraries/image_lib.html?highlight=image
class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('image_lib');
        $this->load->model('zata/Upload_model');        }

        public function index()
        {

        }

        public function do_upload_img()
        {
            //token
            $token = $this->input->post('token');

            //Url para direcionamento depois que ocorrer o upload 
            $url_redirect = $this->input->post('url_redirect_aux');

            /***  MONTANDO PASTAS PARA ARMAZENAMENTO ***/
            // Pasta raiz - definimos o path onde o arquivo será gravado

            $path = 'files/uploads/images';
                // verificamos se o diretório existe se não existe criamos com permissão de leitura e escrita
            if (!is_dir($path)) {
                mkdir($path, 0777,TRUE);
            }

            /****************** DEFINIMOS AS CONFIGURAÇÕES PARA O UPLOAD ******************/
            // determinamos o path para gravar o arquivo
            $config['upload_path']          = $path;
            // definimos através da extensão os tipos de arquivos suportados
            $config['allowed_types']        = 'jpg|jpeg|png';
            // definimos que o nome do arquivo será alterado para um nome criptografado
            $config['encrypt_name']         = TRUE;
            // Carregando todas as configuracoes
            $this->load->library('upload', $config);
            /*******************************************************************************/

            // verificamos se o upload foi processado com sucesso
            if($this->upload->do_upload('picture'))
            {   

                //Inserindo Informações do arquivo no banco de dados                
                $dataPicture = $this->upload->data();

                //Montando sequancia de dados
                $dados = array(
                    "token"                 => $token,
                    "file_name"             => $dataPicture['file_name'],
                    "file_type"             => $dataPicture['file_type'],
                    "file_path"             => $dataPicture['file_path'],
                    "full_path"             => $dataPicture['full_path'],
                    "raw_name"              => $dataPicture['raw_name'],
                    "orig_name"             => $dataPicture['orig_name'],
                    "client_name"           => $dataPicture['client_name'],
                    "file_ext"              => $dataPicture['file_ext'],
                    "file_size"             => $dataPicture['file_size'],
                    "is_image"              => $dataPicture['is_image'],
                    "image_width"           => $dataPicture['image_width'],
                    "image_height"          => $dataPicture['image_height'],
                    "image_type"            => $dataPicture['image_type'],
                    "image_size_str"        => $dataPicture['image_size_str'],
                    "path"                  => $path,
                        //Default
                    "dth_criacao"           => date('Y-m-d H:i:s'),
                    "id_usuario_criacao"    => $this->session->userdata('id_usuario'),
                    "dth_atualizacao"       => date('Y-m-d H:i:s'),
                    "id_usuario_atualizacao"=> $this->session->userdata('id_usuario')
                    );

                    //Inserindo no banco
                    $this->Upload_model->do_upload_imgs($dados);

                    $data = array(
                            'file_name_miniature' => $dataPicture['file_name']
                    );

                    //Inserindo no banco
                    $this->Upload_model->update_upload_imgs(
                        $this->input->post('token_id'), 
                        $this->input->post('tabela_db'), 
                        $data);

                    //Setado a mensagem numa sessao        
                    $this->session->set_flashdata('msg', 'cadastro');

                    //Redireciona para a pagina de upload do patrimonio
                    redirect(base_url($url_redirect)); 
            }
            else
            {
                    //Mensagem de Erro quando ocorre o upload e a foto não bate com as configuracoes
             $msg = '
             <div class="alert alert-danger ">
               <button class="close" data-close="alert"></button>
               '. $this->upload->display_errors().'
           </div>
           ';
                    //Setado a mensagem numa sessao        
           $this->session->set_flashdata('error_upload', $msg);
                    //Redireciona para a pagina de upload do patrimonio
           redirect(base_url($url_redirect));

       }

   }

   public function do_upload_imgs()
   {
    //token
    $token          = $this->input->post('token');

        //Url para direcionamento depois que ocorrer o upload 
    $url_redirect   = $this->input->post('url_redirect_aux');


    $path           = 'files/uploads/images/';
        // verificamos se o diretório existe se não existe criamos com permissão de leitura e escrita
    if (!is_dir($path)) {
        mkdir($path, 0777,TRUE);
    }

    /****************** DEFINIMOS AS CONFIGURAÇÕES PARA O UPLOAD ******************/
                // determinamos o path para gravar o arquivo
    $config['upload_path']          = $path;
                // definimos através da extensão os tipos de arquivos suportados
    $config['allowed_types']        = 'jpg|jpeg|png';

    $config['max_size']            = '300000';
                // definimos que o nome do arquivo será alterado para um nome criptografado
    $config['encrypt_name']         = TRUE;
                // Carregando todas as configuracoes
    $this->load->library('upload', $config);
    /*******************************************************************************/

     // verificamos se o upload foi processado com sucesso
    if($this->upload->do_upload('picture'))
    {   
                    //Inserindo Informações do arquivo no banco de dados
        $dataPicture = $this->upload->data();
                    //Montando sequancia de dados

        $dados = array(
            "token"                 => $token,
            "file_name"             => $dataPicture['file_name'],
            "file_type"             => $dataPicture['file_type'],
            "file_path"             => $dataPicture['file_path'],
            "full_path"             => $dataPicture['full_path'],
            "raw_name"              => $dataPicture['raw_name'],
            "orig_name"             => $dataPicture['orig_name'],
            "client_name"           => $dataPicture['client_name'],
            "file_ext"              => $dataPicture['file_ext'],
            "file_size"             => $dataPicture['file_size'],
            "is_image"              => $dataPicture['is_image'],
            "image_width"           => $dataPicture['image_width'],
            "image_height"          => $dataPicture['image_height'],
            "image_type"            => $dataPicture['image_type'],
            "image_size_str"        => $dataPicture['image_size_str'],
            "path"                  => $path,
                        //Default
            "dth_criacao"            => date('Y-m-d H:i:s'),
            "id_usuario_criacao"      => $this->session->userdata('id_usuario'),
            "dth_atualizacao"        => date('Y-m-d H:i:s'),
            "id_usuario_atualizacao"  => $this->session->userdata('id_usuario')
            );

        $this->crop($dataPicture);

                    //Inserindo no banco
        $this->Upload_model->do_upload_imgs($dados);

                     //Setado a mensagem numa sessao        
        $this->session->set_flashdata('msg', 'cadastro');

                    //Redireciona para a pagina de upload do patrimonio
        redirect(base_url($url_redirect)); 
    }
    else
    {
                    //Mensagem de Erro quando ocorre o upload e a foto não bate com as configuracoes
     $msg = '
     <div class="alert alert-danger ">
       <button class="close" data-close="alert"></button>
       '. $this->upload->display_errors().'
   </div>
   ';
                    //Setado a mensagem numa sessao        
   $this->session->set_flashdata('error_upload', $msg);
                    //Redireciona para a pagina de upload do patrimonio
   redirect(base_url($url_redirect));

}

}

        // Resize Manipulation.
public function resize($image_data) {

    $path = 'files/uploads/thumbnails/';
    // verificamos se o diretório existe se não existe criamos com permissão de leitura e escrita
    if (!is_dir($path)) {
        mkdir($path, 0777,TRUE);
    }


    $img = $image_data['full_path'];
    $config['image_library'] = 'gd2';
    $config['source_image'] = $image_data['full_path'];   
    $config['new_image'] = substr($image_data['full_path'],0, -43).'thumbnails/' . $image_data['file_name'];
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['quality']      = 80;
    $config['width'] = 800;
    $config['height'] = 600;

    //send config array to image_lib's  initialize function
    $this->image_lib->initialize($config);

    $this->image_lib->resize();
    
    return ;


}

// Crop Manipulation.
public function crop($image_data) {
    $img = $image_data['full_path'];
    $config['image_library'] = 'gd2';
    $config['source_image'] = $image_data['full_path']; 
    $config['x_axis'] = 100;
    $config['y_axis'] = 50;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = 800;
    $config['height'] = 600;
    $config['new_image'] = substr($image_data['full_path'],0, -43).'thumbnails/' . $image_data['file_name'];

//send config array to image_lib's  initialize function
    $this->image_lib->initialize($config);

// Call crop function in image library.
    $this->image_lib->crop();
// Return new image contains above properties and also store in "upload" folder.
    return;
}


// Rotate Manipulation.
public function rotate($image_data) {
    $img = substr($image_data['full_path'], 51);
    $config['image_library'] = 'gd2';
    $config['source_image'] = $image_data['full_path'];
    $config['rotation_angle'] = $this->input->post('degree');
    $config['quality'] = "90%";
    $config['new_image'] = './uploads/rot_' . $img;

//send config array to image_lib's  initialize function
    $this->image_lib->initialize($config);
    $src = $config['new_image'];
    $data['rot_image'] = substr($src, 2);
    $data['rot_image'] = base_url() . $data['rot_image'];
// Call rotate function in image library.
    $this->image_lib->rotate();
// Return new image contains above properties and also store in "upload" folder.
    return $data;
}

// Water Mark Manipulation.
public function water_marking($image_data) {
    $img = substr($image_data['full_path'], 51);
    $config['image_library'] = 'gd2';
    $config['source_image'] = $image_data['full_path'];
    $config['wm_text'] = $this->input->post('text');
    $config['wm_type'] = 'text';
    $config['wm_font_path'] = './system/fonts/texb.ttf';
    $config['wm_font_size'] = '50';
    $config['wm_font_color'] = '#707A7C';
    $config['wm_hor_alignment'] = 'center';
    $config['new_image'] = './uploads/watermark_' . $img;

//send config array to image_lib's  initialize function
    $this->image_lib->initialize($config);
    $src = $config['new_image'];
    $data['watermark_image'] = substr($src, 2);
    $data['watermark_image'] = base_url() . $data['watermark_image'];
// Call watermark function in image library.
    $this->image_lib->watermark();
// Return new image contains above properties and also store in "upload" folder.
    return $data;
}



}
?>