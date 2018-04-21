<?php

class DB {
    
    private $DBH;
    
    function __construct() {
        global $e;
        
        define( 'DB_HOST', 'localhost' );
        define( 'DB_NAME', 'people' );
        define( 'DB_USER', 'people' );
        define( 'DB_PASS', 'people' );
        
        try {
            $this->DBH = new PDO( "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS );
            $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch( PDOException $err ) {
            $e->add( '001', __FILE__, __LINE__, $err->getMessage() );
        }
    }
    
    function __destruct() {
        $this->DBH = null;
    }
    
    public function query( $query ) {
        try {
            $STH = $this->DBH->prepare( $query );
            $STH->execute();
        } catch( PDOException $err ) {
            //$e->add( '', __FILE__, __LINE__, $err->getMessage() );
            return false;
        }
        
        return $STH;
    }
    
    public function insert( $to, $where, $data, $data_type = "array" ) {
        global $e;
        
        if( ! ( $data_type == "array" || $data_type == "object" ) ) {
            $e->add( '004', __FILE__, __LINE__ );
            return false;
        }
        
        switch( $data_type ) {
            case 'array':
                $coloumn = $this->_list_to_string( $this->_arrayKeys_to_list( $data ) );
                $placeholders = $this->_list_to_string( $this->_to_placeholders( $this->_arrayKeys_to_list( $data ) ) );
                $data = $this->_2_list_to_assoc_array( $this->_arrayKeys_to_list( $data ), array_values( $data ) );
                break;
                
            case 'object':
                
                break;
                
            default:
                $e->add( '004', __FILE__, __LINE__ );
                return false;
        }
        // "UPDATE xxx SET xxx = 'xxx' WHERE xx = 'xx'"
        $sql = 'INSERT INTO ' . $to . ' (' . $coloumn . ') VALUES (' . $placeholders . ')';
        
        try{
            $STH = $this->DBH->prepare( $sql );
            $STH->execute( $data );
        } catch( PDOException $err ) {
            //$e->add( '005', __FILE__, __LINE__, $err->getMessage() );
            return false;
        }
        
        return $this->DBH->lastInsertId();
    }
    
    public function update( $to, $data, $where, $data_type = "array" ) {
        global $e;
        
        if( ! ( $data_type == "array" || $data_type == "object" ) ) {
            $e->add( '004', __FILE__, __LINE__ );
            return false;
        }
        
        switch( $data_type ) {
            case 'array':
                $set = $this->_data_array_to_data_set( $data );
                break;
                
            case 'object':
                
                break;
                
            default:
                $e->add( '004', __FILE__, __LINE__ );
                return false;
        }
        // "UPDATE xxx SET xxx = 'xxx' WHERE xx = 'xx'"
        $sql = 'UPDATE ' . $to . ' SET ' . $set . ' WHERE ' . $where;
        
        try{
            $STH = $this->DBH->prepare( $sql );
            $STH->execute( $data );
        } catch( PDOException $err ) {
            //$e->add( '005', __FILE__, __LINE__, $err->getMessage() );
            return false;
        }
        
        return $this->DBH->lastInsertId();
    }
    
    public function select() {
        
    }
    
    public function delete() {
        
    }
    
    
    
    private function _arrayKeys_to_list( $irray ) {
        $orray = array_keys( $irray );
        
        return $orray;
    }
    
    private function _arrayValues_to_list( $irray ) {
        $orray = array_values( $irray );
        
        return $orray;
    }
    
    private function _to_placeholders( $irray, $type = 'list' ) {
        if( ! ( $type == 'list' || $type == 'assoc_array' ) ) {
            $e->add( '004', __FILE__, __LINE__ );
        }
        
        $orray = array();
        
        switch( $type ) {
            case 'list':
                for( $i=0; $i<count( $irray ); $i++ ) {
                    $orray[$i] = ':' . $irray[$i];
                }
                break;
                
            case 'assoc_array':
                $list = _arrayKeys_to_list( $irray );
                for( $i=0; $i<count( $irray ); $i++ ) {
                    $orray[$i] = ':' . $list[$i];
                }
                break;
                
            default:
                $e->add( '004', __FILE__, __LINE__ );
        }
        
        return $orray;
    }
    
    private function _list_to_string( $list, $separator = ',' ) {
        @$out = $list[0];
        
        for( $i=1; $i<count( $list ); $i++ ) {
            $out .= $separator . $list[$i];
        }
        
        return $out;
    }
    
    private function _2_list_to_assoc_array( $list1, $list2 ) {
        $out = array();
        
        for( $i=0; $i<count( $list1 ); $i++ ) {
            $out = array_merge( $out, array( $list1[$i] => $list2[$i] ) );
        }
        
        return $out;
    }
    
    private function _data_array_to_data_set( $data ) {
        $keys = $this->_arrayKeys_to_list( $data );
        $placehosders = $this->_to_placeholders( $keys );
        
        $out = "`" . $keys[0] . "`='" . $placeholders[0] . "'";
        
        for( $i = 1; $i < count( $keys ); $i++ ) {
            $out .= ", `" . $keys[0] . "`='" . $placeholders[0] . "'";
        }
        
        return $out;
    }
    
}

global $DB;
$DB = new DB;
