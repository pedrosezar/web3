<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;
use \Modelo\Receita;
use \Modelo\Comentario;

class UsuarioControlador extends Controlador
{

	public function mostrar($id)
	{
		$this->verificarLogado();
		$this->visao('usuarios/perfil.php', [
			'usuario' => Usuario::buscarId($id),
            'contarReceitas' => Receita::contarPorUsuario($id),
            'contarComentarios' => Comentario::contarPorUsuario($id)
		]);
	}

	public function criar()
	{
		$this->visao('usuarios/criar.php', [
			'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
		]);
	}

    public function armazenar()
    {
        $usuario = new Usuario(
            $_POST['nome'],
            $_POST['email'],
            $_POST['senha']
        );
        if ($usuario->isValido()) {
            $usuario->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Usuário cadastrado.');
            $this->redirecionar(URL_RAIZ . 'usuarios/criar');
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php', [
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

}
