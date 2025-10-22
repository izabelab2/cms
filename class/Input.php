<?php

class Input
{
   private $post;
   private $get;
   //private $_session;
   //private $_server;

   public function __construct()
   {
      $this->post = $_POST;
      $this->get = $_GET;
      //$this->_get = $_SESSION;
      //$this->_get = $_SERVER;
   }

   public function post($key = null, $default = null)
   {
       return $this->checkGlobal($this->post, $key, $default);
   }

   public function get($key = null, $default = null)
   {
       return $this->checkGlobal($this->get, $key, $default);
   }

   // other accessors

   private function checkGlobal($global, $key = null, $default = null)
   {
     if ($key) {
       if (isset($global[$key])) {
         return $global[$key];
       } else {
         return $default ?: null;
       }
     }
     return $global;
   }

   public function isNumber($value)
    {
      if (preg_match('/^\d+$/', $value)) { 
          return true; 
      } else { 
          return false; 
      }
    }

    public static function slugify($text, string $divider = '-')
    {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}