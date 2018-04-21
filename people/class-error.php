<?php

class Error {
    
    private $pool, $messeges;
    
    function __construct() {
        global $pool, $messeges;
        
        define( 'ERROR_LOGGER', true );
        define( 'ERROR_PUBLIC_OUT', true );
        define( 'ERROR_OUT_TYPE', 'XML' );
        
        $pool = array();
        $messeges = array(
            '000' => 'Impossible error!',
            '001' => 'Failed connection to Data Base!',
            '002' => 'Don\'t exist param \'action\' in arrays _GET and _POST!',
            '003' => 'Don\'t exist param \'action\' in system!',
            '004' => 'Impossible data type in function!',
            '005' => 'Failed insert data!',
            '006' => 'Impossible file format from config file!',
            '007' => '',
            '008' => '',
            '009' => '',
            '010' => '',
            '011' => '',
            '012' => '',
            '013' => '',
            '014' => '',
            '015' => '',
            '016' => '',
            '017' => '',
            '018' => '',
            '019' => '',
            '020' => '',
            '021' => '',
            '022' => '',
            '023' => '',
        );
        
    }
    
    function __destruct() {
        if( true == ERROR_PUBLIC_OUT ) {
            $this->e_print();
        }
        if( true == ERROR_LOGGER ) {
            $this->e_logger();
        }
    }
    
    public function add( $id,
                         $file,
                         $line,
                         $description = ""
                       ) {
        global $pool, $messeges, $Core;
        
        $pool[] = array(
            'error_time'    => date("d.m.Y H:i:s"),
            'error_id'      => $id,
            'error_messege' => $messeges[$id],
            'error_file'    => $file,
            'error_line'    => $line,
            'error_description'    => $description,
        );
    }
    
    private function e_print(){
        global $pool;
        
        if( 'XML' == ERROR_OUT_TYPE && !empty( $pool ) ) {
            print("<answer>");
            for( $i=0; $i<count($pool); $i++ ) {
                print('<error_time>' . $pool[$i]['error_time'] . '</error_time>');
                print('<error_id>' . $pool[$i]['error_id'] . '</error_id>');
                print('<error_messege>' . $pool[$i]['error_messege'] . '</error_messege>');
                print('<error_file>' . $pool[$i]['error_file'] . '</error_file>');
                print('<error_line>' . $pool[$i]['error_line'] . '</error_line>');
            }
            print("</answer>");
        }
    }
    
    private function e_logger(){
        global $pool;
        
        $f = fopen( dirname(__FILE__) . "/error.log", "a+t" );
        for( $i=0; $i<count($pool); $i++ ) {
            $st = $pool[$i]['error_time'] . " |" . $pool[$i]['error_id'] . "| " . $pool[$i]['error_messege'] . " in " . $pool[$i]['error_file'] . " on line " . $pool[$i]['error_line'] . " (" . $pool[$i]['error_description'] . ")\r\n";
            fwrite( $f, $st );
        }
        fclose( $f );
    }
    
}

global $e;
$e = new Error;
