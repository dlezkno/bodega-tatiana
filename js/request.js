(function () {
    var app = angular.module('request', ['bussines']);
    app.factory('REQUEST', function (TRANSACTION) {

        var headers = {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            'Accept': 'application/json, text/javascript, */*; q=0.01'
        };

        var request = {
            
            getSalesByDate:function($init,$end,$func){
                TRANSACTION.ajax.request('POST', 'php/request.php',
                {
                    service: 2,
                    init: $init,
                    end: $end
                },
                headers,
                function(data){
                    $func(data);
                    swal.close();
                }, false);
            },
            addProductCellar($ref, $cant, $func){
                TRANSACTION.ajax.request('POST', 'php/request.php',
                {
                    service: 3,
                    referencia:$ref,
                    cantidad:$cant,
                },
                headers,
                function(data){
                    $func(data);
                    swal.close();
                }, false);
            },
            updateSale:function($ref, $fact, $vendido, $unidades, $fecha, $id, func){
                TRANSACTION.ajax.request('POST', 'php/request.php',
                {
                    service: 4,
                    referencia:$ref,
                    factura:$fact,
                    vendido:$vendido,
                    unidades:$unidades,
                    fecha:$fecha,
                    id:$id
                },
                headers,
                function(data){
                    func(data);
                }, false);

            },
            addSale:function($ref, $fact, $vendido, $unidades, $fecha, func){
                TRANSACTION.ajax.request('POST', 'php/request.php',
                {
                    service: 5,
                    referencia:$ref,
                    factura:$fact,
                    vendido:$vendido,
                    unidades:$unidades,
                    fecha:$fecha
                },
                headers,
                function(data){
                    func(data);
                }, false);
            },
            getProducts:function($func){
                TRANSACTION.ajax.request('POST', 'php/request.php',
                {
                    service: 7,
                },
                headers,
                function(data){
                    $func(data);
                    swal.close();
                }, false);
            },
            updateProductCellar:function($ref, $cant, $id, $func){
                TRANSACTION.ajax.request('POST', 'php/request.php',
                {
                    service: 8,
                    referencia:$ref,
                    cantidad:$cant,
                    id:$id
                },
                headers,
                function(data){
                    func(data);
                }, false);

            },
            deleteSale:function(){
                TRANSACTION.ajax.request('POST', 'php/request.php',
                {
                    service: 9,
                    id: $id
                },
                headers,
                function(data){
                    $func(data);
                    swal.close();
                }, false);
            },
            deleteProductCellar:function(){
                TRANSACTION.ajax.request('POST', 'php/request.php',
                {
                    service: 10,
                    id: $id
                },
                headers,
                function(data){
                    $func(data);
                    swal.close();
                }, false);
            },
            loadExcel:function($file){
                TRANSACTION.ajax.request('POST', 'php/utils/upload.php',
                $file,
                headers,
                function(data){
                    console.log(data);
                    swal.close();
                }, false);
            }
        }

        return request;
        
    });
})();
