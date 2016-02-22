<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Inventory.php";

    $server = 'mysql:host=localhost;dbname=my_inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class InventoryTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Inventory::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $item = "Newton the turtle";
            $test_list = new Inventory($item);

            //Act
            $test_list->save();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals($test_list, $result[0]);
        }
      }

?>
