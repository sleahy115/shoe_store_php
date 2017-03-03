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
            $this->store_name = $store_name;
        }
        function setStoreName($store_name)
        {
            return $this->store_name;
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
                $new_store = new Sore($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }
        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        function find($search_id)
        {
            $found_store = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            $query = $found_store->fetchAll(PDO::FETCH_ASSOC);
            $id = $query[0]['id'];
            $title = $query[0]['store_name'];
            $found_store = new Store($store_name, $id);
            return $found_store;
        }
        
        function update()
        {

        }
        function delete()
        {

        }
    }

 ?>
