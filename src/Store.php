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

        function getstoreName()
        {
            $this->store_name = $store_name;
        }
        function setstoreName($store_name)
        {
            return $this->store_name;
        }
        function save()
        {

        }
        static function getAll()
        {

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
