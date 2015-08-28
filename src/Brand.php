<?php

    class Brand {

        private $name;
        private $id;

        function __construct($name, $id=null) {

            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name) {
            $this->name = $new_name;
        }

        function getName() {
            return $this->name;
        }

        function getId() {
            return $this->id;
        }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        static function find($search_id)
        {
            $found_store = null;
            $brands = Brand::getAll();
            foreach($brands as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

    }
?>
