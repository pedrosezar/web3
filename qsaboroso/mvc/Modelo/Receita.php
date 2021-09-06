<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Receita extends Modelo
{

    const BUSCAR_ULTIMAS = 'SELECT id, categoria_id, titulo FROM receitas ORDER BY id DESC LIMIT ? OFFSET ?';
    const BUSCAR_TODAS = 'SELECT receitas.id, receitas.usuario_id, receitas.titulo, usuarios.nome FROM receitas JOIN usuarios ON (receitas.usuario_id = usuarios.id)';
    const BUSCAR_ID = 'SELECT id, categoria_id, usuario_id, titulo, ingredientes, modo_preparo FROM receitas WHERE id = ?';
    const BUSCAR_USUARIO = 'SELECT receitas.id, receitas.usuario_id, receitas.titulo, usuarios.nome FROM receitas JOIN usuarios ON (receitas.usuario_id = usuarios.id) WHERE receitas.usuario_id = ? ORDER BY receitas.id';
    const CONTAR_TODAS = 'SELECT COUNT(id) FROM receitas';
    const CONTAR_USUARIO = 'SELECT COUNT(usuario_id) FROM receitas WHERE usuario_id = ?';
    const INSERIR = 'INSERT INTO receitas (categoria_id, usuario_id, titulo, ingredientes, modo_preparo) VALUES (?, ?, ?, ?, ?)';
    const ATUALIZAR = 'UPDATE receitas SET categoria_id = ?, titulo = ?, ingredientes = ?, modo_preparo = ? WHERE id = ?';
    const DELETAR = 'DELETE FROM receitas WHERE id = ?';

    private $id;
    private $categoriaId;
    private $usuarioId;
    private $titulo;
    private $ingredientes;
    private $modoPreparo;
    private $dataCadastro;
    private $usuario;
    private $foto;

    public function __construct(
        $categoriaId,
        $usuarioId,
        $titulo,
        $ingredientes,
        $modoPreparo,
        $dataCadastro = null,
        $usuario = null,
        $foto = null,
        $id = null
    ) {
        $this->id = $id;
        $this->categoriaId = $categoriaId;
        $this->usuarioId = $usuarioId;
        $this->titulo = $titulo;
        $this->ingredientes = $ingredientes;
        $this->modoPreparo = $modoPreparo;
        $this->dataCadastro = $dataCadastro;
        $this->usuario = $usuario;
        $this->foto = $foto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $categoriaId;
    }

    public function getCategoria()
    {
        $categorias = [
            '1' => 'Salgado',
            '2' => 'Doce',
            '3' => 'Sobremesa',
            '4' => 'Bebida'
        ];
        return $categorias[$this->categoriaId];
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getIngredientes()
    {
        $result = explode('<br />', $this->ingredientes);
        return $result;
    }

    public function getIngredientesEditar()
    {
        $result = str_replace('<br />', '', $this->ingredientes);
        return $result;
    }

    public function setIngredientes($ingredientes)
    {
        $this->ingredientes = $ingredientes;
    }

    public function getModoPreparo()
    {
        $result = explode('<br />', $this->modoPreparo);
        return $result;
    }

    public function getModoPreparoEditar()
    {
        $result = str_replace('<br />', '', $this->modoPreparo);
        return $result;
    }

    public function setModoPreparo($modoPreparo)
    {
        $this->modoPreparo = $modoPreparo;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }

    public static function buscarUltimas($limit = 5, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ULTIMAS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Receita(
                $registro['categoria_id'],
                null,
                $registro['titulo'],
                null,
                null,
                null,
                null,
                null,
                $registro['id']
            );
        }
        return $objetos;
    }

    public static function buscarTodas($filtro = [], $limit, $offset)
    {
        $sqlWhere = '';
        $parametros = [];
        if (array_key_exists('ingrediente', $filtro) && $filtro['ingrediente'] != '') {
            $parametros[] = $filtro['ingrediente'];
            $parametros = array_replace($parametros, array(0 => "%$parametros[0]%"));
            $sqlWhere .= ' WHERE receitas.ingredientes LIKE ?';
        }
        if (array_key_exists('data', $filtro) && $filtro['data'] != '') {
            if ($filtro['data'] == 'asc') {
                $sqlWhere .= ' ORDER BY receitas.data_cadastro ASC';
            } else if ($filtro['data'] == 'desc') {
                $sqlWhere .= ' ORDER BY receitas.data_cadastro DESC';
            }
        } else {
            $sqlWhere .= ' ORDER BY receitas.titulo';
        }
        $parametros[] = $limit;
        $parametros[] = $offset;
        $sql = self::BUSCAR_TODAS . $sqlWhere . ' LIMIT ? OFFSET ?';
        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro) {
            $param = (is_int($parametro) ? PDO::PARAM_INT : PDO::PARAM_STR);
            $comando->bindValue($i+1, $parametro, $param);
        }
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['nome'],
                null,
                '',
                null
            );
            $objetos[] = new Receita(
                null,
                $registro['usuario_id'],
                $registro['titulo'],
                null,
                null,
                null,
                $usuario,
                null,
                $registro['id']
            );
        }
        return $objetos;
    }

    public static function buscarPorUsuario($usuarioId)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_USUARIO);
        $comando->bindValue(1, $usuarioId, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['nome'],
                null,
                '',
                null
            );
            $objetos[] = new Receita(
                null,
                $registro['usuario_id'],
                $registro['titulo'],
                null,
                null,
                null,
                $usuario,
                null,
                $registro['id']
            );
        }
        return $objetos;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        $objeto = null;
        if ($registro) {
            $objeto = new Receita(
                $registro['categoria_id'],
                $registro['usuario_id'],
                $registro['titulo'],
                $registro['ingredientes'],
                $registro['modo_preparo'],
                null,
                null,
                null,
                $registro['id']
            );
        }
        return $objeto;
    }

    public static function contarTodas($filtro = [])
    {
        $sqlWhere = '';
        $parametro = null;
        if (array_key_exists('ingrediente', $filtro) && $filtro['ingrediente'] != '') {
            $parametro = $filtro['ingrediente'];
            $sqlWhere .= ' WHERE receitas.ingredientes LIKE ?';
        }
        $sql = self::CONTAR_TODAS . $sqlWhere;
        $registros = DW3BancoDeDados::prepare($sql);
        $registros->bindValue(1, "%$parametro%", PDO::PARAM_STR);
        $registros->execute();
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function contarPorUsuario($usuarioId)
    {
        $registros = DW3BancoDeDados::prepare(self::CONTAR_USUARIO);
        $registros->bindValue(1, $usuarioId, PDO::PARAM_INT);
        $registros->execute();
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public function salvar()
    {
        if ($this->id == null) {
            $this->inserir();
        } else {
            $this->atualizar();
        }
        $this->salvarImagem();
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/upload/{$this->id}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->categoriaId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindValue(3, $this->titulo, PDO::PARAM_STR);
        $comando->bindValue(4, $this->ingredientes, PDO::PARAM_STR);
        $comando->bindValue(5, $this->modoPreparo, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->categoriaId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->titulo, PDO::PARAM_STR);
        $comando->bindValue(3, $this->ingredientes, PDO::PARAM_STR);
        $comando->bindValue(4, $this->modoPreparo, PDO::PARAM_STR);
        $comando->bindValue(5, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if ($this->categoriaId == null) {
            $this->setErroMensagem('categoriaId', 'Selecione uma categoria.');
        }
        if (strlen($this->titulo) < 5) {
            $this->setErroMensagem('titulo', 'Mínimo 5 caracteres.');
        }
        if (strlen($this->ingredientes) < 10) {
            $this->setErroMensagem('ingredientes', 'Mínimo 10 caracteres.');
        }
        if (strlen($this->modoPreparo) < 20) {
            $this->setErroMensagem('modoPreparo', 'Mínimo 20 caracteres.');
        }
        if (DW3ImagemUpload::existeUpload($this->foto) && !DW3ImagemUpload::isValida($this->foto)) {
            $this->setErroMensagem('foto', 'Deve ser de no máximo 500 KB.');
        }
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

}
