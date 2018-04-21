<?php
require_once('class-error.php');

class Config {
    
    function __construct() {
        $this->ini_load( './config.ini' );
    }
    
    public function ini_load( $filename, $use_section = false ) {
		
        $ini = $this->ini_parse( $filename, $use_section );
        
        $keys = array_keys( $ini );
        $values = array_values( $ini );
        
        for( $i = 0; $i < count( $ini ); $i++ ) {
            if( ! defined( $keys[$i] ) ) {
                define( $keys[$i], $values[$i] );
            }
        }
    }
    
    public function ini_parse( $filename, $use_section = false ) {
        global $e;
        
        $ini = parse_ini_file( $filename, $use_section );
        
        if( ! is_array( $ini ) ) {
            $e->err( '04001', __FILE__, __LINE__, $filename );
            exit;
        }
        
        return $ini;
    }
    
    
    
}

global $Config;
$Config = new Config;