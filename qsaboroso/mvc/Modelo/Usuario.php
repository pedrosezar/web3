<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{

    const CONTAR_TODOS = 'SELECT COUNT(id) FROM usuarios';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ?';
    const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
    const INSERIR = 'INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)';

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $senhaPlana;

    public function __construct(
        $nome,
        $email,
        $senha,
        $id = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senhaPlana = $senha;
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPrimeiroNome()
    {
        return strtok($this->nome, ' ');
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->email, PDO::PARAM_STR);
        $comando->bindValue(3, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    protected function verificarErros()
    {
        if (strlen($this->nome) < 5) {
            $this->setErroMensagem('nome', 'Deve ter no mínimo 5 caracteres.');
        }
        if (strlen($this->email) < 6) {
            $this->setErroMensagem('email', 'Deve ter no mínimo 6 caracteres.');
        }
        if (strlen($this->senhaPlana) < 3) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 3 caracteres.');
        }
    }

}
