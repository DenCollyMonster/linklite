<?php

class Config {
    
    function __construct() {
        //$this->load_def();
    }
    
    public function load( $path ) {
        //if(  basename( $path ) )
    }
    
    public function load_def() {}
    
    public function reload() {}
    
    public function reload_def() {}
}

global $Config;
$Config = new Config;
