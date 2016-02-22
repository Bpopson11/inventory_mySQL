<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Inventory.php";

    $server = 'mysql:host=localhost;dbname=my_inventory_test';
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

        function test_getAll()
        {
            //Arrange
            $item1 = "Newton the turtle";
            $item2 = "Boog the fat bear";
            $test_list1 = new Inventory($item1);
            $test_list1->save();
            $test_list2 = new Inventory($item2);
            $test_list2->save();

            //Act
            $result = Inventory::getAll();

            //Assert
            $this->assertEquals([$test_list1, $test_list2], $result);
        }

        function test_getId()
        {
          //Arrange
          $item = "Newton the turtle";
          $id = 1;
          $test_Inventory = new Inventory($item, $id);

          //Act
          $result = $test_Inventory->getId();

          //Assert
          $this->assertEquals(1, $result);
        }

        function test_find()
        {
            //Arrange
            $item = "Newton the turtle";
            $item2 = "Boog the fat bear";
            $test_list = new Inventory($item);
            $test_list->save();
            $test_list2 = new Inventory($item2);
            $test_list2->save();

            //Act
            $id = $test_list->getId();
            $result = Inventory::find($id);

            //Assert
            $this->assertEquals($test_list, $result);
        }
    }

?>
