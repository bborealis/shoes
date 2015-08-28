<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoestore_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Brand::deleteAll();

        }

        function test_getName()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);

            //Act
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Adidas";
            $id = 1;
            $test_brand = new Brand($name, $id);

            //Act
            $test_brand->setName("Nike");
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals("Nike", $result);
        }

        function testGetId()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            $name2 = "Adidas";
            $id2 = 1;
            $test_brand2 = new Brand($name2, $id2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            $new_name = "Adidas";

            //Act
            $test_brand->update($new_name);

            //Assert
            $this->assertEquals("Adidas", $test_brand->getName());
        }

        function testFind()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            $name2 = "Adidas";
            $id2 = 1;
            $test_brand2 = new Brand($name2, $id2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand2->getId());

            //Assert
            $this->assertEquals($test_brand2, $result);
        }




    }
?>
