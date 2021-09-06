<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Receita;
use \Framework\DW3BancoDeDados;

class TesteReceita extends Teste
{

	public function testeInserir()
	{
		$receita = new Receita(1, 1, 'Teste título', 'Teste ingredientes', 'Teste modo de preparo');
		$receita->salvar();
		$query = DW3BancoDeDados::query("SELECT * FROM receitas WHERE titulo = 'Teste título'");
		$bdReceita = $query->fetch();
		$this->verificar($bdReceita !== false);
	}

	public function testebuscarUltimas()
	{
		$receita = Receita::buscarUltimas(5, 0);
		$this->verificar($receita !== false);
	}

	public function testeBuscarTodas()
	{
        $receita = Receita::buscarTodas($filtro = [], 5, 0);
        $this->verificar($receita !== false);
	}

	public function testeBuscarPorUsuario()
	{
		$receitas = Receita::buscarPorUsuario(1);
		$this->verificar(count($receitas) == 5);
	}

	public function testeBuscarId()
	{
		$receita = Receita::buscarId(1);
		$this->verificar($receita !== false);
	}

	public function testeContarTodas()
	{
		$receitas = Receita::contarTodas($filtro = []);
		$this->verificar($receitas == 19);
	}

	public function testeContarPorUsuario()
	{
		$receitas = Receita::contarPorUsuario(1);
		$this->verificar($receitas == 5);
	}

    public function testeDestruir()
    {
		$receita = new Receita(1, 1, 'Teste título', 'Teste ingredientes', 'Teste modo de preparo');
		$receita->salvar();
        Receita::destruir($receita->getId());
		$query = DW3BancoDeDados::query("SELECT * FROM receitas WHERE titulo = 'Teste título'");
		$bdReceita = $query->fetch();
		$this->verificar($bdReceita === false);
    }

    public function testeAtualizar()
    {
        $receita = new Receita(1, 1, 'Teste título', 'Teste ingredientes', 'Teste modo de preparo');
        $receita->salvar();
        $receita->setTitulo('Teste título alterado!');
        $receita->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM receitas');
        $bdReceita = $query->fetch();
        $this->verificar($bdReceita !== false);
    }
    
}
