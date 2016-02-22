<?php
class Inventory
{
    private $item;
    private $id;
    // private $pic;

    function __construct($item, $id = null)
    {
        $this->item = $item;
        $this->id = $id;
    }

    function setItem($new_item)
    {
        $this->item = (string) $new_item;
    }

    function getItem()
    {
        return $this->item;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO inventory (item) VALUES ('{$this->getItem()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_inventory = $GLOBALS['DB']->query("SELECT * FROM inventory;");
        $lists = array();
        foreach($returned_inventory as $inventory) {
            $item = $inventory['item'];
            $id = $inventory['id'];
            $new_list = new Inventory($item, $id);
            array_push($lists, $new_list);
        }
        return $lists;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM inventory;");
    }

    static function find()
    {
        $found_list = null;
        $lists = Inventory::getAll();
        foreach ($lists as $list) {
            $list_id = $list->getID();
            if ($list_id == $search_id) {
                $found_list = $list;
            }
        }
        return $found_list;
    }
  }
?>
