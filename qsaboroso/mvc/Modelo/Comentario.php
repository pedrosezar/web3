<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Comentario extends Modelo
{

    const BUSCAR_RECEITA = 'SELECT comentarios.id, comentarios.comentario, comentarios.receita_id, comentarios.usuario_id, usuarios.nome FROM comentarios JOIN usuarios ON (comentarios.usuario_id = usuarios.id) WHERE comentarios.receita_id = ?';
    const BUSCAR_ID = 'SELECT * FROM comentarios WHERE id = ?';
    const INSERIR = 'INSERT INTO comentarios (receita_id, usuario_id, comentario) VALUES (?, ?, ?)';
    const CONTAR_USUARIO = 'SELECT COUNT(usuario_id) FROM comentarios WHERE usuario_id = ?';
    const DELETAR = 'DELETE FROM comentarios WHERE id = ?';
    const DELETAR_RECEITA = 'DELETE FROM comentarios WHERE receita_id = ?';

    private $id;
    private $receitaId;
    private $usuarioId;
    private $comentario;
    private $dataComentario;
    private $usuario;

    public function __construct(
        $receitaId,
        $usuarioId,
        $comentario,
        $dataComentario = null,
        $usuario = null,
        $id = null
    ) {
        $this->id = $id;
        $this->receitaId = $receitaId;
        $this->usuarioId = $usuarioId;
        $this->comentario = $comentario;
        $this->dataComentario = $dataComentario;
        $this->usuario = $usuario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getReceitaId()
    {
        return $this->receitaId;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public static function buscarPorReceita($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_RECEITA);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
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
            $objetos[] = new Comentario(
                $registro['receita_id'],
                $registro['usuario_id'],
                $registro['comentario'],
                null,
                $usuario,
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
            $objeto = new Comentario(
                $registro['receita_id'],
                $registro['usuario_id'],
                $registro['comentario'],
                $registro['data_comentario'],
                null,
                $registro['id']
            );
        }
        return $objeto;
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
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->receitaId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindValue(3, $this->comentario, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function destruirPorReceita($receitaId)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR_RECEITA);
        $comando->bindValue(1, $receitaId, PDO::PARAM_INT);
        $comando->execute();
    }

}
