<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Receita;
use \Modelo\Usuario;
use \Modelo\Comentario;

class ReceitaControlador extends Controlador
{

    public function index()
    {
        $this->visao('receitas/index.php', [
            'receitas' => Receita::buscarUltimas()
        ]);
    }

    public function mostrar($id)
    {
        $this->visao('receitas/receita.php', [
            'receita' => Receita::buscarId($id),
            'comentarios' => Comentario::buscarPorReceita($id)
        ]);
    }

    public function criar()
    {
        $this->verificarLogado();
        $this->visao('receitas/criar.php', [
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $receita = new Receita(
            $_POST['categoriaId'],
            DW3Sessao::get('usuario'),
            $_POST['titulo'],
            nl2br($_POST['ingredientes']),
            nl2br($_POST['modoPreparo']),
            null,
            null,
            $foto
        );
        if ($receita->isValido()) {
            $receita->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Receita cadastrada.');
            $this->redirecionar(URL_RAIZ . 'receitas/criar');
        } else {
            $this->setErros($receita->getValidacaoErros());
            $this->visao('receitas/criar.php', [
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function listar()
    {
        $paginacao = $this->calcularPaginacao();
        $this->visao('receitas/listar.php', [
            'receitas' => $paginacao['receitas'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina']
        ]);
    }

    public function relatorio()
    {
        $this->visao('receitas/relatorio.php', [
            'contarUsuarios' => Usuario::contarTodos(),
            'contarReceitas' => Receita::contarTodas()
        ]);
    }

    public function visualizar()
    {
        $this->verificarLogado();
        $this->visao('receitas/visualizar.php', [
            'receitas' => Receita::buscarPorUsuario(DW3Sessao::get('usuario')),
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    public function editar($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);
        $this->visao('receitas/editar.php', [
            'receita' => $receita,
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    public function atualizar($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);
        if ($receita->getUsuarioId() == $this->getUsuario()) {
            $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
            $receita->setCategoriaId($_POST['categoriaId']);
            $receita->setTitulo($_POST['titulo']);
            $receita->setIngredientes(nl2br($_POST['ingredientes']));
            $receita->setModoPreparo(nl2br($_POST['modoPreparo']));
            $receita->setFoto($foto);
            if ($receita->isValido()) {
                $receita->salvar();
                DW3Sessao::setFlash('mensagemFlash', 'Receita alterada.');
                $this->redirecionar(URL_RAIZ . 'receitas/visualizar');
            }
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode alterar essa receita.');
            $this->redirecionar(URL_RAIZ . 'receitas/' . $id . '/editar');
        }
        
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);
        if ($receita->getUsuarioId() == $this->getUsuario()) {
            if (Comentario::buscarPorReceita($id)) {
                Comentario::destruirPorReceita($id);
            }
            Receita::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Receita deletada.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar essa receita.');
        }
        $this->redirecionar(URL_RAIZ . 'receitas/visualizar');
    }

    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 3;
        $offset = ($pagina - 1) * $limit;
        $receitas = Receita::buscarTodas($_GET, $limit, $offset);
        $ultimaPagina = ceil(Receita::contarTodas($_GET) / $limit);
        return compact('pagina', 'receitas', 'ultimaPagina');
    }

}
