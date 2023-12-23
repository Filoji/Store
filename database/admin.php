<?php
namespace DataManager;
use \PDO;

class Admin 
{
    private $dsn;
    private $pdo;
    function __construct()
    {
        $this->dsn = 'sqlite:database/app.db';
        $this->pdo = new PDO($this->dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    }

    function create($name, $pass) : bool {
        $hash = password_hash($pass, PASSWORD_ARGON2I);
        if (!($request = $this->pdo->prepare("INSERT INTO admin (name, pass) VALUES (:name, :pass);")))
            return false;
        return ($request->execute([
                ':name'=>$name,
                ':pass'=>$hash
        ]));
    }

    function check($name, $pass) : bool {
        if (!($request = $this->pdo->prepare("SELECT (pass) FROM admin WHERE name = :name;")))
            return false;
        if (!($request->execute([
            ':name'=>$name
        ])))
            return false;
        if (!($value = $request->fetch(PDO::FETCH_ASSOC)))
            return false;
        return password_verify($pass, $value['pass']);
    }

    function delete($name) : bool {
        if (!($request = $this->pdo->prepare("DELETE FROM admin WHERE name = :name;")))
            return false;
        return $request->execute([
            ':name'=>$name
        ]);
    }
}
?>