<?php

    class Brand
    {
        private $brand_name;
        private $id;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        function getbrandName()
        {
            return $this->brand_name;
        }
        function setbrandName($brand_name)
        {
            $this->brand_name = $brand_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($id)
        {
            $this->id = $id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getbrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach ($returned_brands as $brand) {
                $id = $brand['id'];
                $brand_name = $brand['brand_name'];
                $new_brand = new brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        static function find($search_id)
        {
            $found_brand = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$search_id};");
            $query = $found_brand->fetchAll(PDO::FETCH_ASSOC);
            $id = $query[0]['id'];
            $brand_name = $query[0]['brand_name'];
            $found_brand = new brand($brand_name, $id);
            return $found_brand;
        }

        function updateBrand($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET brand_name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setbrandName($new_name);
        }
        function deleteBrand()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        }
    }
