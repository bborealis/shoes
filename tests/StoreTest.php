<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoestore_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();

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

        function testGetId()
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

        function testSave()
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

        function testDeleteAll()
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

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Clogs-N-More";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $new_name = "Shoe Depot";

            //Act
            $test_store->update($new_name);

            //Assert
            $this->assertEquals("Shoe Depot", $test_store->getName());
        }

        function testFind()
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

            //Act
            $result = Store::find($test_store2->getId());

            //Assert
            $this->assertEquals($test_store2, $result);
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
            $test_store->addBrand($test_brand);

            //Assert
            $this->assertEquals($test_store->getBrands(),[$test_brand]);
        }

        function testGetBrands()
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

            $name2 = "Adidas";
            $id2 = 1;
            $test_brand2 = new Brand($name2, $id2);
            $test_brand2->save();

            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);

            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function testDelete()
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
            $test_store->addBrand($test_brand);
            $test_store->delete();

            //Assert
            $this->assertEquals([], $test_brand->getStores());
        }





    }
?>
