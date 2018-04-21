<?php

require_once('class-error.php');
require_once('class-config.php');
//require_once('class-io.php');

class Core {
    
    public function start() {
        
    }
    
    public function nocache() {
        header('Expires: Thu, 19 Feb 1998 13:24:18 GMT');
        header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        header('Cache-Control: no-cache, must-revalidate');
        header('Cache-Control: post-check=0,pre-check=0');
        header('Cache-Control: max-age=0');
        header('Pragma: no-cache');
    }
    
    public function dt() {
        return date("d.m.Y H:i:s");
    }
    
    public function qwerty1v( $get, $post ) {
        global $e, $IO;
        
        if( ! ( isset( $get['action'] ) || isset( $post['action'] ) ) ) {
            $e->add( '002', __FILE__, __LINE__ );
        }
        
        if( isset( $get['action'] ) ) {
            $action = $get['action'];
            
            switch( $action ) {
                
                case 'addNewPeople':
                    $IO->addNewPeople();
                    break;
                
                case '1':
                    echo md5(time()) . "<br>";
                    echo time() . "<br>";
                    break;
                
                case '':
                    
                    break;
                
                case '':
                    
                    break;
                
                case '':
                    
                    break;
                
                default:
                    $e->add( '003', __FILE__, __LINE__ );
            }
        } elseif( isset( $post['action'] ) ) {
            
        }
    }
    
}

global $Core;
$Core = new Core;
