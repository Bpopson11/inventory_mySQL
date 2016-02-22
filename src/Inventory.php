<?php
class Inventory
{
    private $item;
    private $id;
    private $pic;

    function __construct($item, $id = null, $pic)
    {
        $this->item = $item;
        $this->id = $id;
        $this->pic = $pic;
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

    function setPic($new_pic)
    {
        $this->pic = $new_pic;
    }

    function getPic()
    {
        return $this->pic;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO tasks (item) VALUES ('{$this->getItem()}');");
        $GLOBALS['DB']->exec("INSERT INTO taks (pic) VALUES ('{$this->getPic()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_lists = $GLOBAL['DB']->query("SELECT * FROM list;");
        $list = array();
        foreach ($returned_lists as $list) {
            $item = $list['item'];
            $id = $list['id'];
            $pic = $list['pic'];
            $new_list = new Inventory($item, $id, $pic);
            array_push($list, $new_list);
        }
        return $list;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM list;");
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
