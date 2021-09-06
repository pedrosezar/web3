<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Receita;
use \Modelo\Comentario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{

    public function testeMostrar()
    {
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'usuarios/' . $this->usuario->getId());
        $query = DW3BancoDeDados::query('SELECT COUNT(id) FROM receitas');
        $bdReceitas = $query->fetch();
        $query = DW3BancoDeDados::query('SELECT COUNT(usuario_id) FROM comentarios WHERE usuario_id = 1');
        $bdComentarios = $query->fetch();
        $this->verificarContem($resposta, 'Informações');
        $this->verificar((count($bdReceitas) && count($bdComentarios)) > 0);
    }

    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
        $this->verificarContem($resposta, 'Registre-se');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'usuarios', [
            'nome' => 'Teste',
            'email' => 'teste@teste.com',
            'senha' => '123'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuarios/criar');
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
        $this->verificarContem($resposta, 'Usuário cadastrado.');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE email = "teste@teste.com"');
        $bdUsuario = $query->fetchAll();
        $this->verificar(count($bdUsuario) == 1);
    }

}
