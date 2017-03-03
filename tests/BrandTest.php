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
           $new_brand = new Brand($brand_name);
           $new_brand->save();

           $brand_name2 = 'Nike';
           $new_brand2 = new brand($brand_name2);
           $new_brand2->save();

           //Act
           $result = Brand::find($new_brand->getId());

           //Assert
           $this->assertEquals($new_brand, $result);
       }
       function test_updateBrand()
       {
           //Arrange
           $brand_name = 'Adidas';
           $new_name = "Nike";
           $new_brand = new Brand($brand_name);
           $new_brand->save();

           //Act
           $new_brand->updateBrand($new_name);
           $result = $new_brand->getBrandName();

           //Assert
           $this->assertEquals($new_name, $result);
       }

       function test_deleteBrand()
       {
           //Arrange
           $brand_name = 'Adidas';
           $test_brand = new Brand($brand_name);
           $test_brand->save();

           $brand_name2 = 'Nike';
           $test_brand2 = new Brand($brand_name2);
           $test_brand2->save();

           //Act
           $test_brand->deleteBrand();
           $result = Brand::getAll();

           //Assert
           $this->assertEquals([$test_brand2], $result);
       }
    }
