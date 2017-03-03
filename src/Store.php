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
            $GLOBALS['DB']->exec("INSERT INTO books (store_name) VALUES ('{$this->getStoreName()}');");
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
        static function deleteAll()
        {

        }
        function find()
        {

        }
        function update()
        {

        }
        function delete()
        {

        }
    }

 ?>
