<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Sale{

    public function update($con, $ref, $fac, $ven, $uni, $fecha, $id){
        
        $Query="UPDATE venta SET 
            referencia = '$ref',
            factura = '$fac',
            vendido = '$ven',
            unidades = '$uni',
            fecha = '$fecha'
            WHERE
            id_sale='$id'";
        
        $Result = mysqli_query($con, $Query);
        $response = new stdClass();
        $response->status = "";
        $response->message = "";
        if (!mysqli_error()){
            $response->status = "success";
            $response->message = "ok";
            return json_encode($response);	
        }else {	
            $response->status = "fault";
            $response->message = mysqli_error();
            return json_encode($response);			   
        }
    }

    public function addSale($con,$ref,$fact,$saleTo,$unit,$date){
        $Query="INSERT INTO ventas(referencia,factura,vendido,unidades,fecha)
		VALUES('$ref','$fact','$saleTo','$unit','$date')";	
		mysqli_query($con, $Query);  		

        $QueryUpdate="UPDATE bodega SET cantidad = bodega.cantidad - $unit  
        WHERE bodega.referencia = '$ref'";
        mysqli_query($con, $QueryUpdate); 
        
        return "success";
    }

    public function getSalesByDate($con, $init, $end){
        $Query="SELECT * FROM sale WHERE
        sale.date BETWEEN '$init' AND '$end'";
        
        $Result = mysqli_query($con, $Query );
        $response = new stdClass();	
        $response->status = 'success';
        $response->producs = array();

        while ($row = mysql_fetch_object($Result)){
            array_push($response->producs, $row);
        }

        return json_encode($response);

    }

    public function delete($con, $id){
        $Query = "DELETE FROM sale WHERE id = $id ";
        $result = mysqli_query($con, $Query);
        return "success";
    }

}

?>