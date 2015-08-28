<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoestore_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();

        }

        function test_getName()
        {
            //Arrange
            $name = "Clogs-N-More";
            $id = 1;
            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Shoe Depot";
            $id = 1;
            $test_store = new Store($name, $id);

            //Act
            $test_store->setName("Clogs-N-More");
            $result = $test_store->getName();

            //Assert
            $this->assertEquals("Clogs-N-More", $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Clogs-N-More";
            $id = 1;
            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_Save()
        {
            //Arrange
            $name = "Clogs-N-More";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }




    }
?>
