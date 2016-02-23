<?php
class Inventory
{
    private $item;
    private $description;
    private $date_obtained;
    private $id;


    function __construct($item, $description, $date_obtained, $id = null)
    {
        $this->item = $item;
        $this->description = $description;
        $this->date_obtained = $date_obtained;
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

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function setDate($new_date)
    {
        $this->date_obtained =  $new_date;
    }

    function getDate()
    {
        return $this->date_obtained;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO inventory (item, description, date_obtained) VALUES ('{$this->getItem()}', '{$this->getDescription()}', '{$this->getDate()}');"); //remember this!!! this is for grabbing multiple columns at once.
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_inventory = $GLOBALS['DB']->query("SELECT * FROM inventory;");
        $lists = array();
        foreach($returned_inventory as $inventory) {
            $item = $inventory['item'];
            $description = $inventory['description'];
            $date_obtained = $inventory['date_obtained'];
            $id = $inventory['id'];
            $new_list = new Inventory($item, $description, $date_obtained, $id);
            array_push($lists, $new_list);
        }
        return $lists;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM inventory;");
    }

    static function find($search_id)
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
