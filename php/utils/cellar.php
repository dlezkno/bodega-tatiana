<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Cellar{
    
    public function getCellars($con){
    	$Query="SELECT * FROM bodega";
        
        $Result = mysqli_query($con, $Query); 
        $response = new stdClass();	
        $response->status = 'success';
        $response->products = array();

        while ($row = mysqli_fetch_object($Result)){
            array_push($response->products, $row);
        }

        return json_encode($response);
    }

    public function addProduct($con, $ref, $cant){
        $Query="INSERT INTO bodega(referencia,cantidad)
		VALUES('$ref','$cant')";	
        mysqli_query($con, $Query); 
        return "success";
    }

    public function updateProduct($con, $ref, $cant, $id){
        $Query = "UPDATE bodega SET cantidad = $cant, referencia = $ref  
        WHERE bodega.id = '$id'";

        mysqli_query($con, $Query);
        return "success";
    }

    public function deleteProduct($con, $id){
        $Query = "DELETE FROM bodega WHERE id = $id ";
        $result = mysqli_query($con, $Query);
        return "success";
    }
}



?>