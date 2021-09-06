<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Comentario;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteComentario extends Teste
{

	public function testeInserir()
	{
		$comentario = new Comentario(1, 2, 'Receita maravilhosa!!!');
		$comentario->salvar();
		$query = DW3BancoDeDados::query("SELECT * FROM comentarios WHERE comentario = 'Receita maravilhosa!!!'");
		$bdComentario = $query->fetch();
		$this->verificar($bdComentario !== false);
	}

	public function buscarId()
	{
		$comentario = Comentario::buscarId(4);
		$this->verificar($comentario->getComentario() == 'Maravilhoso esse pernil');
	}

	public function testeContarPorUsuario()
	{
		$comentarios = Comentario::contarPorUsuario(1);
		$this->verificar($comentarios == 1);
	}

	public function buscarPorReceita()
	{
        $comentario = Comentario::buscarPorReceita(1);
        $this->verificar($comentario->getComentario() == 'Maravilhoso esse pernil');
	}

    public function testeDestruir()
    {
        $comentario = new Comentario(1, 1, 'Receita maravilhosa!!!');
        $comentario->salvar();
        Comentario::destruir($comentario->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM comentarios WHERE id = ' . $comentario->getId());
        $bdComentario = $query->fetch();
        $this->verificar($bdComentario === false);
    }

    public function testeDestruirPorReceita()
    {
    	$comentario = new Comentario(1, 1, 'Receita maravilhosa!!!');
    	$comentario->salvar();
    	Comentario::destruirPorReceita($comentario->getReceitaId());
    	$query = DW3BancoDeDados::query('SELECT * FROM comentarios WHERE id = ' . $comentario->getId());
    	$bdComentario = $query->fetch();
    	$this->verificar($bdComentario === false);
    }

}
