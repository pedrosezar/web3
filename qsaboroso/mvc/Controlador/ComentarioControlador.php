<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Comentario;

class ComentarioControlador extends Controlador
{

    public function armazenar()
    {
        $this->verificarLogado();
        $comentario = new Comentario(
            $_POST['receitaId'],
            DW3Sessao::get('usuario'),
            $_POST['comentario']
        );
		$comentario->salvar();
		$this->redirecionar(URL_RAIZ . 'receitas/' . $_POST['receitaId']);
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $comentario = Comentario::buscarId($id);
        if ($comentario) {
            Comentario::destruir($id);
            $this->redirecionar(URL_RAIZ . 'receitas/' . $comentario->getReceitaId());
        }
    }

}
