<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{

	public function testeInserir()
	{
		$usuario = new Usuario('Teste', 'email-teste', 'senha');
		$usuario->salvar();
		$query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE email = 'email-teste'");
		$bdUsuairo = $query->fetch();
		$this->verificar($bdUsuairo !== false);
	}

	public function testeContarTodos()
	{
		$usuarios = Usuario::contarTodos();
		$this->verificar($usuarios == 7);
	}

	public function testeBuscarEmail()
	{
		$usuario = Usuario::buscarEmail('email-teste');
		$this->verificar($usuario !== false);
	}

	public function testeBuscarId()
	{
        $usuario = Usuario::buscarId(1);
        $this->verificar($usuario->getNome() == 'Pedro Sézar');
	}

}
