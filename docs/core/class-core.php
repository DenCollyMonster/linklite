<?php

require_once('class-error.php');
require_once('class-config.php');
require_once('class-db.php');
require_once('class-io.php');

class Core {
    
	public $GET, $POST;
	
    function __construct() {
        define( 'DATA_OUT_TYPE_XML', '0' );
        define( 'DATA_OUT_TYPE_JSON', '1' );
    
        define( 'DATA_OUT_TYPE', DATA_OUT_TYPE_JSON );
    }
    
    public function start() {
		$this->nocache();
        
        //header("Content-type: application/json; charset=utf-8");
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
        
		$this->GET = $get;
		$this->POST = $post;
		
        if( ! ( isset( $this->GET['action'] ) || isset( $this->POST['action'] ) ) ) {
            $e->err( '01001', __FILE__, __LINE__ );
        }
        
        if( isset( $this->GET['action'] ) ) {
            $action = $this->GET['action'];
            
            switch( $action ) {
                
                case 'getPostsList':
                    $IO->getPostsList();
                    break;
                
                case '1':
                    echo md5(time()) . "<br>";
                    echo time() . "<br>";
                    break;
                
                case 'getPost':
                    $IO->getPost();
                    break;
                
                case 'getTemplate':
                    $IO->getTemplate();
                    break;
                
                case 'test':
                    echo '<pre>';
                    print_r($_GET);
                    break;
                
                default:
                    $e->err( '01002', __FILE__, __LINE__ );
            }
        } elseif( isset( $post['action'] ) ) {
            
        }
    }
    
}

global $Core;
$Core = new Core;
