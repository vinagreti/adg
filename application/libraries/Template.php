<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{

  function __construct()
  {
     $this->CI =& get_instance();
  }

  public function load( $template, $conteudo, $arquivos_js = array(), $arquivos_css = array() ){

    $template_data = new stdClass();

    $template_data->conteudo = $conteudo;

    $template_data->arquivos_css = $arquivos_css;

    $template_data->arquivos_js = $arquivos_js;

    $this->CI->load->view("templates/$template", $template_data);

  }

}