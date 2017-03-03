<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        function teardown()
        {
            Store:: deleteAll();
            Brand:: deleteAll();
        }
        function test_getAll()
        {
            $store_name = "Nordstrom";
            $store_test = new Store($store_name);
            $store_test->save();

            $store_name2 = "Macys";
            $store_test2 = new Store($store_name2);
            $store_test2->save();
            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($result[0],$store_test);
        }
        function test_save()
       {
           //Arrange
           $store_name = "Nordstrom";
           $store_test = new Store($store_name);
           $store_test->save();

           $store_name2 = "Macys";
           $store_test2 = new Store($store_name2);
           $store_test2->save();
           //Act
           $result = Store::getAll();
           //Assert
           $this->assertEquals($result[0],$store_test);
       }

       function test_deleteAll()
        {
            //Arrange
            $store_name = 'Macys';
            $new_store = new Store($store_name);
            $new_store->save();

            $store_name2 = 'Nordstrom';
            $new_store2 = new Store($store_name2);
            $new_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();
            //Assert
            $this->assertEquals([], $result);
        }
       //
        function test_find()
        {
            //Arrange
            $store_name = 'Macys';
            $new_store = new Store($store_name);
            $new_store->save();

            $store_name2 = 'Nordstrom';
            $new_store2 = new Store($store_name2);
            $new_store2->save();

            //Act
            $result = Store::find($new_store->getId());

            //Assert
            $this->assertEquals($new_store, $result);
        }
       //
        function test_updateStore()
        {
            //Arrange
            $store_name = 'Macys';
            $new_name = "JC Pennys";
            $new_store = new Store($store_name);
            $new_store->save();

            //Act
            $new_store->updateStore($new_name);
            $result = $new_store->getStoreName();

            //Assert
            $this->assertEquals($new_name, $result);
        }
       //
        function test_deleteStore()
        {
            //Arrange
            $store_name = 'Nordstrom';
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = 'Macys';
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $test_store->deleteStore();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2], $result);
        }

        function test_addBrands()
        {
            //Arrange
            $store_name = 'Nordstrom';
            $test_store = new Store($store_name);
            $test_store->save();

            $brand_name = 'Adidas';
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            //Act
            $test_store->addBrands($test_brand);
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand], $result);

        }

        function test_getBrands()
        {
            //Arrange

            $store_name = 'Nordstrom';
            $test_store = new Store($store_name);
            $test_store->save();

            $brand_name = 'Adidas';
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = 'Adidas';
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            $test_store->addBrands($test_brand);
            $test_store->addBrands($test_brand2);
            $result = $test_store->getBrands();
            var_dump("result");
            var_dump($result);
            var_dump("test");
            var_dump([$test_brand, $test_brand2]);

            $this->assertEquals([$test_brand, $test_brand2], $result);
        }
    }
