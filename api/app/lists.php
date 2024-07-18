<?php 
require_once "./app/Database.php";

class Lists extends Database
{
    public function getLists()
    {
        return $this->select("SELECT * FROM lists");
    }

    public function getItems($list)
    {
        return $this->select("SELECT * FROM items WHERE list='$list'");
    }

    public function addList($name, $desc)
    {
        return $this->addOrRemove("INSERT INTO lists VALUE('$name', '$desc')");
    }

    public function deleteList($name)
    {
        return $this->addOrRemove("DELETE FROM lists WHERE name='$name'");
    }

    public function addItem($list, $item, $quantity)
    {
        return $this->addOrRemove("INSERT INTO items VALUE('$item', '$list', $quantity)");
    }

    public function deleteItem($list, $item)
    {
        return $this->addOrRemove("DELETE FROM items WHERE name='$item' and list='$list'");
    }
}