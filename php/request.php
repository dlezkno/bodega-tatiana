<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
    include_once 'utils/SecurityUtils.php';
    include_once 'utils/sale.php';
    include_once 'utils/cellar.php';
    include_once 'utils/user.php';
    include_once 'utils/connect.php';

    switch ($_POST['service']){
        case '1':
        // logIn
            $user = new User();
            $user->getUser($_POST['pass'],$_POST['email']);
        break;
        case '2':
        // get sales by date
            $con =  new Connect();
            $r = $con->init();
            $sale = new sale();
            $response = $sale->getSalesByDate($r, $_POST['init'],$_POST['end']);
        break;
        case '3':
        // add product cellar
            $con = new Connect();
            $r = $con->init();
            $bodega = new Cellar();
            $response = $bodega->addProduct($r,$_POST['referencia'],$_POST['cantidad']);
            echo $response;        
        break;
        case '4':
        // update sale
            $con =  new Connect();
            $r = $con->init();
            $sale = new Sale();

            $sale->update(
            $r,
            $_POST['referencia'],
            $_POST['factura'],
            $_POST['vendido'],
            $_POST['unidades'],
            $_POST['fecha'],
            $_POST['id']);
            
        break;
        case '5':
        // add sale
            $con =  new Connect();
            $r = $con->init();
            $sale = new Sale();
            $response = $sale->addSale(
            $r,
            $_POST['referencia'],
            $_POST['factura'],
            $_POST['vendido'],
            $_POST['unidades'],
            $_POST['fecha']);

            echo $response;
        break;
        case '6':
        // generate pass
            $encrypter=new SecurityUtils($_POST['password'],30);
            $password=$encrypter->encode();
            $password=md5($password);
            echo $password;
        break;
        case '7':
        // get products cellars
            $con = new Connect();
            $r = $con->init();
            $bodega = new Cellar();
            $response = $bodega->getCellars($r);
            echo $response;
        break;
        case '8':
        // update product cellar 
            $con = new Connect();
            $r = $con->init();
            $bodega = new Cellar();
            $response = $bodega->updateProduct($r, $_POST['referencia'], $_POST['cantidad'], $_POST['id']);
            echo $response;   
        
        break;
        case '9':
        // delete sale
            $con =  new Connect();
            $r = $con->init();
            $sale = new Sale();
            $response = $sale->delete(
            $r,
            $_POST['id']);
        break;
        case '10':
        // delete product cellar
            $con =  new Connect();
            $r = $con->init();
            $sale = new Cellar();
            $response = $sale->deleteProduct(
            $r,
            $_POST['id']);
        break;
    }

?>