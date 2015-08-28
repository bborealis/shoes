<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoestore_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();

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

        function testAddBrand()
        {
            //Arrange
            $name = "Clogs-N-More";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store);

            //Assert
            $this->assertEquals($test_brand->getStores(),[$test_store]);
        }

        function testGetBrands()
        {
            //Arrange
            $name = "Clogs-N-More";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $name2 = "Shoe Depot";
            $id2 = 1;
            $test_store2 = new Store($name2, $id2);
            $test_store2->save();

            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }




    }
?>
