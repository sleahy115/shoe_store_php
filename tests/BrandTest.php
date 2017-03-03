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
        function teardown()
        {
            brand::deleteAll();
            Brand::deleteAll();
        }
        function test_getAll()
        {
            $brand_name = "Adidas";
            $brand_test = new Brand($brand_name);
            $brand_test->save();

            $brand_name2 = "Nike";
            $brand_test2 = new Brand($brand_name2);
            $brand_test2->save();
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

           $brand_name2 = "Nike";
           $brand_test2 = new Brand($brand_name2);
           $brand_test2->save();
           //Act
           $result = Brand::getAll();
           //Assert
           $this->assertEquals($result[0],$brand_test);
       }

       function test_find()
       {
           //Arrange
           $brand_name = 'Adidas';
           $new_brand = new brand($brand_name);
           $new_brand->save();

           $brand_name2 = 'Nike';
           $new_brand2 = new brand($brand_name2);
           $new_brand2->save();

           //Act
           $result = brand::find($new_brand->getId());

           //Assert
           $this->assertEquals($new_brand, $result);
       }
    }
