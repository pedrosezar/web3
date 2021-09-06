<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use \Modelo\Receita;
use \Modelo\Comentario;
use \Modelo\Usuario;

class TesteReceita extends Teste
{

    public function testeIndex()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $query = DW3BancoDeDados::query('SELECT id, categoria_id, titulo FROM receitas ORDER BY id DESC');
        $bdReceitas = $query->fetchAll();
        $this->verificarContem($resposta, 'Últimas receitas');
        $this->verificar(count($bdReceitas) > 0);
    }

    public function testeMostrar()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas/1');
        $query = DW3BancoDeDados::query('SELECT id, categoria_id, usuario_id, titulo, ingredientes, modo_preparo FROM receitas WHERE id = 1');
        $bdReceitas = $query->fetchAll();
        $this->verificarContem($resposta, 'Modo de preparo');
        $this->verificar(count($bdReceitas) == 1);
    }

    public function testeCriar()
    {
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'receitas/criar');
        $this->verificarContem($resposta, 'Cadastrar nova receita');
    }

    public function testeArmazenar()
    {
        $this->logar();
        $receita = new Receita(
            1,
            $this->usuario->getId(),
            'Teste título',
            'Teste ingredientes',
            'Teste modo de preparo',
            null,
            null,
            null,
            null
        );
        $receita->salvar();
        $resposta = $this->get(URL_RAIZ . 'receitas/criar');
        $this->verificarContem($resposta, 'Cadastrar nova receita');
    }

    public function testeListar()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas/listar');
        $query = DW3BancoDeDados::query('SELECT r.id, r.usuario_id, r.titulo, u.nome FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id)');
        $bdReceitas = $query->fetchAll();
        $this->verificarContem($resposta, 'Digite o ingrediente');
        $this->verificar(count($bdReceitas) > 0);
    }

    public function testeRelatorio()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas/relatorio');
        $query = DW3BancoDeDados::query('SELECT COUNT(id) FROM usuarios');
        $bdUsuarios = $query->fetch();
        $query = DW3BancoDeDados::query('SELECT COUNT(id) FROM receitas');
        $bdReceitas = $query->fetch();
        $this->verificarContem($resposta, 'Usuários');
        $this->verificar((count($bdUsuarios) && count($bdReceitas)) > 0);
    }

    public function testeVisualizar()
    {
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'receitas/visualizar');
        $query = DW3BancoDeDados::query('SELECT r.id, r.usuario_id, r.titulo, u.nome FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id) WHERE r.usuario_id = 1 ORDER BY r.id');
        $bdReceitas = $query->fetchAll();
        $this->verificarContem($resposta, 'Ação');
        $this->verificar(count($bdReceitas) > 0);
    }

    public function testeEditar()
    {
        $this->logar();
        $query = DW3BancoDeDados::query('SELECT id, categoria_id, usuario_id, titulo, ingredientes, modo_preparo FROM receitas WHERE id = 1');
        $bdReceitas = $query->fetch();
        $resposta = $this->get(URL_RAIZ . 'receitas/1/editar');
        $this->verificarContem($resposta, 'Editar receita');
        $this->verificar(count($bdReceitas) > 0);
    }

    public function testeAtualizar()
    {
        $this->logar();
        $receita = Receita::buscarId(1);
        $receita->setTitulo('Título alterado');
        $receita->salvar();
        $this->patch(URL_RAIZ . 'receitas/' . $receita->getId());
        $resposta = $this->get(URL_RAIZ . 'receitas/visualizar');
        $this->verificarContem($resposta, 'Ação');
    }

    public function testeDestruir()
    {
        $this->logar();
        $receita = new Receita(
            1,
            $this->usuario->getId(),
            'Teste título',
            'Teste ingredientes',
            'Teste modo de preparo',
            null,
            null,
            null,
            null
        );
        $receita->salvar();
        $resposta = $this->delete(URL_RAIZ . 'receitas/' . $receita->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas/visualizar');
        $query = DW3BancoDeDados::query("SELECT * FROM receitas WHERE titulo = 'Teste título'");
        $bdReceitas = $query->fetch();
        $this->verificar($bdReceitas === false);
    }

}
