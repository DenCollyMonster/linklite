<?php

require_once('class-error.php');

class DB {
    
    private $DBH;
    
    function __construct() {
        global $e;
        
        define( 'DB_PREFIX', '' );
        define( 'TBL_PREFIX', 'diary_' );
        
        define( 'DB_HOST', 'localhost' );
        define( 'DB_NAME', DB_PREFIX . 'diary' );
        define( 'DB_USER', 'root' );
        define( 'DB_PASS', '' );
        
        define( 'TBL_DATA_NAME', TBL_PREFIX . 'data' );
        define( 'TBL_USERS_NAME', TBL_PREFIX . 'users' );
        define( 'TBL_OPTIONS_NAME', TBL_PREFIX . 'options' );
        define( 'TBL_TEMPLATES_NAME', TBL_PREFIX . 'templates' );
        
		$DSN = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
		
		$OPTIONS = array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_LAZY
		);
		
        try {
            $this->DBH = new PDO( $DSN, DB_USER, DB_PASS, $OPTIONS );
        } catch( PDOException $err ) {
            $e->err( '02001', __FILE__, __LINE__, $err->getMessage() );
        }
    }
    
    function __destruct() {
        $this->DBH = null;
    }
    
    
    public function getPostsList() {
        global $e;
        
        $STH = $this->DBH->prepare( 'SELECT * FROM ' . TBL_DATA_NAME );
        $STH->execute();
        
        $return = array();
        
        while( $row = $STH->fetch() ) {
            $return = array_merge( $return, array(
                array(
                    'id'            => $row->id,
                    'name'          => $row->name,
                    'URI'           => $row->URI,
                    'text'          => $row->text,
                    'date_create'   => $row->date_create,
                )
            ) );
            
        }
        
        return $return;
    }
    
    public function getPost( $id ) {
        global $e;
        
        $STH = $this->DBH->prepare( 'SELECT * FROM ' . TBL_DATA_NAME . ' WHERE id=:id' );
        $data = array( ':id' => $id );
        $STH->execute( $data );
        
        $row = $STH->fetch();
        $result = array(
            'id'            => $row->id,
            'name'          => $row->name,
            'URI'           => $row->URI,
            'text'          => $row->text,
            'date_create'   => $row->date_create,
        );
								
        return $result;
    }
    
    public function getTemplate( $name ) {
        global $e;
        
        $STH = $this->DBH->prepare( 'SELECT * FROM ' . TBL_TEMPLATES_NAME . ' WHERE name=:name' );
        $data = array( ':name' => $name );
        $STH->execute( $data );
        
        $row = $STH->fetch();
        $result = array(
            'id'            => $row->id,
            'name'          => $row->name,
            'text'          => $row->text,
        );
								
        return $result;
    }
    
    
}

global $DB;
$DB = new DB;
