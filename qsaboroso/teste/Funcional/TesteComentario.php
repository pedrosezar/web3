<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Comentario;
use \Framework\DW3BancoDeDados;

class TesteComentario extends Teste
{

    public function testeArmazenar()
    {
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'comentarios', [
            'receitaId' => 1,
            'usuarioId' => $this->usuario->getId(),
            'comentario' => 'Comentário teste'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas/1');
        $resposta = $this->get(URL_RAIZ . 'receitas/1');
        $query = DW3BancoDeDados::query("SELECT * FROM comentarios WHERE comentario = 'Comentário teste'");
        $bdComentario = $query->fetchAll();
        $this->verificar(count($bdComentario) == 1);
    }

    public function testeDestruir()
    {
        $this->logar();
        $comentario = new Comentario(
            1,
            $this->usuario->getId(),
            'Comentário teste'
        );
        $comentario->salvar();
        $resposta = $this->delete(URL_RAIZ . 'comentarios/' . $comentario->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas/1');
        $query = DW3BancoDeDados::query("SELECT * FROM comentarios WHERE comentario = 'Comentário teste'");
        $bdComentario = $query->fetch();
        $this->verificar($bdComentario === false);
    }

}
