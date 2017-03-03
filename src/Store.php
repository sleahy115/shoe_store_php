<?php

    class Store
    {
        private $store_name;
        private $id;

        function __construct($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }

        function getStoreName()
        {
            return $this->store_name;
        }
        function setStoreName($store_name)
        {
            $this->store_name = $store_name;
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
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getStoreName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach ($returned_stores as $store) {
                $id = $store['id'];
                $store_name = $store['store_name'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function find($search_id)
        {
            $found_store = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            $query = $found_store->fetchAll(PDO::FETCH_ASSOC);
            $id = $query[0]['id'];
            $store_name = $query[0]['store_name'];
            $found_store = new Store($store_name, $id);
            return $found_store;
        }

        function updateStore($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setStoreName($new_name);
        }
        function deleteStore()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        function addBrands($brand)
        {
            $brand_id = $brand->getId();
            $store_id = $this->getId();
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand_id} , {$store_id});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query(
                "SELECT brands.*
                FROM stores
                JOIN brands_stores ON (brands_stores.store_id = stores.id)
                JOIN brands ON (brands.id = brands_stores.brand_id)
                WHERE stores.id = {$this->getId()};"
            );
            $brands = array();
            foreach ($returned_brands as $brand) {
                $id = $brand['id'];
                $brand_name = $brand['brand_name'];
                $new_brand = new brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
    }

 ?>
