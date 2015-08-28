<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Shoe.php";

    $server = 'mysql:host=localhost;dbname=shoestore_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ShoeTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     Shoe::deleteAll();
        //
        // }

        function test_getName()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $test_author = new Shoe($name, $id);

            //Act
            $result = $test_author->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Keen";
            $id = 1;
            $test_author = new Shoe($name, $id);

            //Act
            $test_author->setName("Nike");
            $result = $test_author->getName();

            //Assert
            $this->assertEquals("Nike", $result);
        }
    }
?>
