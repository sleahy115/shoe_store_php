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

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        function test_getAll()
        {
            $brand_name = "Adidas";
            $brand_test = new Brand($brand_name);
            $brand_test->save();

            $brand_name = "Nike";
            $brand_test = new Brand($brand_name);
            $brand_test->save();
            //Act
            $result = Brand::getAll();
            //Assert
            $this->assertEquals($result[0],$brand_test);
        }
        function test_save()
       {
           //Arrange
           $brand_name = "Adidas";
           $brand_test = new Brand($brand_name);
           $brand_test->save();

           $brand_name = "Nike";
           $brand_test = new Brand($brand_name);
           $brand_test->save();
           //Act
           $result = Brand::getAll();
           //Assert
           $this->assertEquals($result[0],$brand_test);
       }
    }
