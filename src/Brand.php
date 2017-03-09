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

        function getBrandName()
        {
            return $this->brand_name;
        }
        function setBrandName($brand_name)
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
            $GLOBALS['DB']->exec("DELETE FROM brands_stores");
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
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE brand_id = {$this->getId()};");
        }

        function addStore($store)
        {
            $brand_id = $this->getId();
            $store_id = $store->getId();
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand_id} , {$store_id});");
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query(
                "SELECT stores.*
                FROM brands
                JOIN brands_stores ON (brands_stores.brand_id = brands.id)
                JOIN stores ON (stores.id = brands_stores.store_id)
                WHERE brands.id = {$this->getId()};"
            );
            $stores = array();
            foreach ($returned_stores as $store) {
                $id = $store['id'];
                $store_name = $store['store_name'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }
        static function DeleteStoreByBrand($store)
        {
            $id = $store->getId();
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$id};");
        }




    }
