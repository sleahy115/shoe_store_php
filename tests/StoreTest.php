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
        function test_update()
        {
            //Arrange
            $store_name = 'Macys';
            $new_name = "JC Pennys";
            $new_store = new Store($store_name);
            $new_store->save();

            //Act
            $new_store->update($new_name);
            $result = $new_store->getStoreName();

            //Assert
            $this->assertEquals($new_name, $result);
        }
       //
    //     function test_deleteStore()
    //     {
    //         //Arrange
    //         $store_name = 'Nordstrom';
    //         $test_store = new Store($store_name);
    //         $test_store->save();
       //
    //         $store_name2 = 'Macys';
    //         $test_store2 = new Store($store_name2);
    //         $test_store2->save();
       //
    //         //Act
    //         $test_store->deleteStore();
    //         $result = Store::getAll();
       //
    //         //Assert
    //         $this->assertEquals([$test_store2], $result);
    //     }
    }
