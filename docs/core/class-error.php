<?php

class Error {
    
    private $err_pool = array();
    private $msg_pool = array();
    private $f_err, $f_msg;
    
    private $err_desc_arr = array(
        '00000' => 'Невозможная ошибка!',
        '01001' => 'Отсутствует параметр \'action\'!',
        '01002' => 'Неверное значение параметра \'action\'!',
        '02001' => 'Не удалось подключиться к БД! Соединение разорвано.',
        '02002' => 'Невозможный тип данных!',
		'02003' => 'Неудалось вставить данные в БД!',
        '' => '',
        '03001' => 'Отсутствует параметр \'action\'!',
        '03002' => 'Неверное количество или значение входных параметров запроса!',
        '04001' => 'Невозможно загрузить файл конфигурации! Он пуст или отсутствует.',
        '04002' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
    );
    
    function __construct() {
        $this->f_err = fopen( "error.log", "a+t" );
        $this->f_msg = fopen( "messege.log", "a+t" );
    }
    
    function __destruct() {
        $this->err_log();
        $this->msg_log();
        fclose( $this->f_err );
        fclose( $this->f_msg );
		$this->err_view();
    }
    
    public function err( $err_id, $err_file, $err_line, $err_msg = "" ) {
        $err_time = date( "d.m.Y H:i:s" );
        $err_desc = $this->err_desc_arr[ $err_id ];
        
        $this->err_pool[] = array(
            'err_id'   => $err_id,
            'err_desc' => $err_desc,
            'err_time' => $err_time,
            'err_file' => $err_file,
            'err_line' => $err_line,
            'err_msg'  => $err_msg
        );
    }
    
    public function err_view() {
        if( !empty( $this->err_pool ) ) {
            print("<pre>");
			print("<answer>");
            for( $i=0; $i<count($this->err_pool); $i++ ) {
                print('<error_time>' . $this->err_pool[$i]['err_time'] . '</error_time> ');
                print('<error_id>' . $this->err_pool[$i]['err_id'] . '</error_id> ');
                print('<error_messege>' . $this->err_pool[$i]['err_desc'] . '</error_messege> in ');
                print('<error_file>' . $this->err_pool[$i]['err_file'] . '</error_file> on line ');
                print('<error_line>' . $this->err_pool[$i]['err_line'] . '</error_line> ');
				print('(' . $this->err_pool[$i]['err_msg'] . ')<br>');
            }
            print("</answer>");
        }
	}
    
    private function err_log() {
        for( $i=0; $i < count($this->err_pool); $i++ ) {
            $out = $this->err_pool[$i]['err_time'] . " " . $this->err_pool[$i]['err_id'] . " " . $this->err_pool[$i]['err_desc'] . " in " . $this->err_pool[$i]['err_file'] . " on line " . $this->err_pool[$i]['err_line'] . " (" . $this->err_pool[$i]['err_msg'] . ")\r\n";
            fwrite( $this->f_err, $out );
        }
    }
    
    public function msg( $msg_text, $msg_file, $msg_line ) {
        $msg_time = date( "d.m.Y H:i:s" );
        
        $this->msg_pool[] = array(
            'msg_time' => $msg_time,
            'msg_text' => $msg_text,
            'msg_file' => $msg_file,
            'msg_line' => $msg_line,
        );
    }
    
    private function msg_log() {
        for( $i=0; $i < count($this->msg_pool); $i++ ) {
            $out = $this->msg_pool[$i]['msg_time'] . " " . $this->msg_pool[$i]['msg_text'] . " in " . $this->msg_pool[$i]['msg_file'] . " on line " . $this->msg_pool[$i]['msg_line'] . "\r\n";
            fwrite( $this->f_msg, $out );
        }
    }
    
}

global $e;
$e = new Error;