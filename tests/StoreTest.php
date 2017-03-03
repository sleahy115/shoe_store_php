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
        function test_getAll()
        {
            $store_name = "Nordstrom";
            $store_test = new Store($store_name);
            $store_test->save();

            $store_name = "Macys";
            $store_test = new Store($store_name);
            $store_test->save();
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

           $store_name = "Macys";
           $store_test = new Store($store_name);
           $store_test->save();
           //Act
           $result = Store::getAll();
           //Assert
           $this->assertEquals($result[0],$store_test);
       }
    }
