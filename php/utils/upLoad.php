<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Excel/reader.php';

function upload($fileP){
    /*
    $this->response = new stdClass();
    $this->response->errores = array();
    $formP = json_decode(str_replace("\\", "", $formP));
    $this->form = $formP;
    $fileName = str_replace(".","_",uniqid()).".". pathinfo($fileP['name'],PATHINFO_EXTENSION);			
    $url = str_replace(" ","_",$fileName);			
    move_uploaded_file($fileP["tmp_name"],$url);
    
    $file = fopen($url, 'r');	

    var_dump($file);
          
    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding('CP1251');
    $data->read($fileP["tmp_name"]);
    echo $data;
    */
    //$data->read('jxlrwtest.xls');
    //echo $data->sheets[0]['cells'][1][1];

    /*
    $dataCSV = array();
    while(($line = fgetcsv($file)) !== FALSE){
        $data_line = $line;	
        if(count($line)>1){
            $data_line = array();
            array_push($data_line,join("",$line));
        }
        $data = str_replace(",","", array_map("utf8_encode", $data_line));	
        array_push($dataCSV,explode(";",$data[0]));	  
    }	
    fclose($file);			
    $header_doc = $dataCSV[0];
    array_shift($dataCSV);
    if(count($header_doc) === count($formP->fields_form)){
        $validate = true;
        for($i = 0; $i < count($formP->fields_form); $i++){
            $fields_doc = str_replace(" ","",$header_doc[$i]);
            $fields_form = str_replace(" ","",$formP->fields_form[$i]->name);
            if($fields_doc !== $fields_form){
                $validate = false;
            }
        }
        
        if($validate == true){						
            $this->csv = $dataCSV;
            $con=new Connector();
            $con->init();	
            
            if($cambio == "ADD"){
                $this->loadCSV();
            }else{
                $this->deleteRegs();
            }
        }else{
            
            $campos = array();
            for($i = 0; $i < count($formP->fields_form); $i++){
                array_push($campos,$formP->fields_form[$i]->name);
            }
            
            $this->response->status = "fault";
            $this->response->message = "El EXCEL no tiene los mismos campos que el formulario. deberia tener los campos : <h4>".join(",",$campos).
            "</h4><br><button style='margin-left:25%' onclick='importView.donwloadPlantilla();'>Descargar platilla</button>";
            echo json_encode($this->response);
        }				
    }else{
        $campos = array();
        for($i = 0; $i < count($formP->fields_form); $i++){
            array_push($campos,$formP->fields_form[$i]->name);
        }
        $this->response->status = "fault";
        $this->response->message = "El CSV no tiene los mismos campos que el formulario. deberia tener los campos : <h4>".join(",",$campos).
        "</h4><br><button style='margin-left:25%' onclick='importView.donwloadPlantilla();'>Descargar platilla</button>";
        echo json_encode($this->response);	
    }
    */
}


upload($_FILES['file'])

?>