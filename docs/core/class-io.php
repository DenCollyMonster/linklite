<?php

require_once('class-error.php');
require_once('class-db.php');

class IO {
    
    
    
    public function getPostsList( $data_out_type = DATA_OUT_TYPE ) {
        global $e, $Core, $DB;
        
        $result = $DB->getPostsList();
        
        switch( $data_out_type ) {
            case 0:
                print('<answer>');
                print('<status>1</status>');
                
                for( $i=0; $i<count( $result ); $i++ ) {
                    print('<post>');
                    print('<post_id>' . $result[$i]['id'] . '</post_id> ');
                    print('<post_name>' . $result[$i]['name'] . '</post_name> ');
                    print('<post_URI>' . $result[$i]['URI'] . '</post_URI> ');
                    print('<post_text>' . $result[$i]['text'] . '</post_text> ');
                    print('<post_date_create>' . $result[$i]['date_create'] . '</post_date_create> ');
                    print('</post>');
                }
                
                print('</answer>');
                break;
                
            case 1:
                print('{');
                print('"status": 1,');
                print('"postlist": [');
                
                for( $i=0; $i<count( $result ); $i++ ) {
                    print('{');
                    print('"id": ' . $result[$i]['id'] . ',');
                    print('"name": "' . $result[$i]['name'] . '",');
                    print('"URI": "' . $result[$i]['URI'] . '",');
                    print('"create_timestamp": "' . $result[$i]['date_create'] . '"');
                    if( ($i + 1) == count( $result ) ) { print('}'); }
                    else { print('},'); }
                }
                
                print(']}');
                break;
        }
    }
	
	public function getPost( $data_out_type = DATA_OUT_TYPE ) {
        global $e, $Core, $DB;
		
		if( ! ( isset( $Core->GET['action'] ) || isset( $Core->POST['action'] ) ) ) {
            $e->err( '03001', __FILE__, __LINE__ );
        }
		if( ! ( isset( $Core->GET['id'] ) || isset( $Core->POST['id'] ) ) ) {
            $e->err( '03002', __FILE__, __LINE__ );
        }
		
		@$id = $Core->GET['id'] or $Core->POST['id'];
        
		$result = $DB->getPost( $id );
        
        switch( $data_out_type ) {
            case 0:
                print('<answer>');
                print('<status>1</status>');
                print('<post_id>' . $result['id'] . '</post_id> ');
                print('<post_name>' . $result['name'] . '</post_name> ');
                print('<post_URI>' . $result['URI'] . '</post_URI> ');
                print('<post_text>' . $result['text'] . '</post_text> ');
                print('<post_date_create>' . $result['date_create'] . '</post_date_create> ');
                print('</answer>');
                break;
                
            case 1:
                
                break;
        }
    }
    
    public function getTemplate( $data_out_type = DATA_OUT_TYPE ) {
        global $e, $Core, $DB;
        
        if( ! ( isset( $Core->GET['action'] ) || isset( $Core->POST['action'] ) ) ) {
            $e->err( '03001', __FILE__, __LINE__ );
        }
		if( ! ( isset( $Core->GET['name'] ) || isset( $Core->POST['name'] ) ) ) {
            $e->err( '03002', __FILE__, __LINE__ );
        }
		
		@$name = $Core->GET['name'] or $Core->POST['name'];
        
		$result = $DB->getTemplate( $name );
        
        switch( $data_out_type ) {
            case 0:
                
                break;
                
            case 1:
                print('({ ');
                print('"status": 1, ');
                print('"template": { ');
                
                print('"id": ' . $result['id'] . ', ');
                print('"name": "' . $result['name'] . '", ');
                print('"text": "' . $result['text'] . '"');
                
                print('}})');
                break;
        }
    }
	
}

global $IO;
$IO = new IO;
