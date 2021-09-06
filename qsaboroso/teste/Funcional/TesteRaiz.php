<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteRaiz extends Teste
{
    public function testeIndex()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
    }
}
