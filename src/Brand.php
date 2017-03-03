<?php
class Brand
{
    private $brand_name;
    private $id;

    function __construct($brand_name, $id= null)
    {
        $this->brand_name = $brand_name;
        $this->id = $id;
    }

    function getBrandName()
    {
        $this->brand_name = $brand_name;
    }
    function setBrandName($brand_name)
    {
        return $this->brand_name;
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
