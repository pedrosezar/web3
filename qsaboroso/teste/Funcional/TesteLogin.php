<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{

    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeArmazenar()
    {
        (new Usuario('João', 'joao@teste.com', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'João',
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'João',
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $this->verificarContem($resposta, 'joao@teste.com');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('João', 'joao@teste.com', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'João',
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

}
