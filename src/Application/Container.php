<?php
namespace App\Application;


class Container {
   private array $container;

   public function __construct() {
       $this->container = [];
   }

   public function add($key, $obj) {
       $this->container[$key] = $obj;
   }

   public function get($key) {
       if(isset($this->container[$key])) {
           return $this->container[$key];
       } else {
           return false;
       }
   }
}