<?php
namespace DataManager;
use \PDO;

class Product 
{
    private $dsn;
    private $pdo;
    function __construct()
    {
        $this->dsn = 'sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/database/app.db';
        $this->pdo = new PDO($this->dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    }

    function create($name, $description, $short_description, $price) : bool {
        if (!($request = $this->pdo->prepare("INSERT INTO product (name, description, short_description, price) VALUES (:name, :description, :short_description, :price);")))
            return false;
        return ($request->execute([
            ":name" => $name,
            ":description" => $description,
            ":short_description" => $short_description,
            ":price" => $price
        ]));
    }

    function get_by_id($id) : array|bool{
        if (!($request = $this->pdo->prepare("SELECT * FROM product WHERE id = :id;")))
            return false;
        if (!($request->execute([
            ':id' => $id
        ])))
            return false;
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    function get_from_id($id, $number = 10) : array|bool{
        if (!($request = $this->pdo->prepare("SELECT * FROM product WHERE id >= :id ORDER BY id LIMIT :number;")))
            return false;
        if (!($request->execute([
            ':id' => $id,
            ':number' => $number
        ])))
            return false;
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_from_rank($rank, $number = 10) : array|bool {
        if (!($request = $this->pdo->prepare("SELECT * FROM product ORDER BY id LIMIT :number OFFSET :rank;")))
            return false;
        if (!($request->execute([
            ':rank' => $rank,
            ':number' => $number
        ])))
            return false;
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_forwarded() : array|bool{
        if (!($query = $this->pdo->query("SELECT * FROM product WHERE forwarded = 1")))
            return false;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    private function set_changes($values) : string {
        $result = "";
        foreach (array_keys($values) as $key) {
            if (strlen($result))
                $result .= ', ' . $key . ' = :' . $key;
            else
                $result .= $key . ' = :' . $key;
        }
        return $result;
    }

    function update($id, $values) : bool {
        if (!($request = $this->pdo->prepare("UPDATE OR ABORT product SET " . $this->set_changes($values) . " WHERE id = :id;")))
            return false;
        return $request->execute(array_merge($values, ['id' => $id]));
    }

    function delete($id) : bool {
        if (!($request = $this->pdo->prepare("DELETE FROM product WHERE id = :id;")))
            return false;
        return $request->execute([
            ':id' => $id
        ]);
    }
}
?>