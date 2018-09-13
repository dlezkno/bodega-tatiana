
var app = angular.module('app',['request']).controller('MainController', function ($scope, REQUEST) {
    $scope.products = [];
    $scope.product = {
        id:'',
        referencia:'',
        cantidad:0
    };
    $scope.sales = [];
    $scope.sale = {
        ref:{},
        tamano:{},
        fact:"",
        vendido:"",
        unidades:"",
        fecha:""
    };
      
    $scope.saleUpdate = {
        id:"",
        ref:{},
        tamano:{},
        fact:"",
        vendido:"",
        unidades:"",
        fecha:""
    };

    $scope.init = function(){
        $("#bodega-tab").click(function(){
            $("#bodega").css("display","block");
            $("#venta").css("display","none");
        });
        $("#venta-tab").click(function(){
            $("#venta").css("display","block");
            $("#bodega").css("display","none");
        });
        $("#file").change(function(){
            $scope.import();
        });
        $scope.getProducts();
        $scope.paintTable('tableVenta');
    }

    $scope.updateSale = function($id){
        console.log($id);
    }

    $scope.updateProduct = function($id){
        $scope.product.id = $id;
        $('#modalUpdateBodega').modal('toggle');
    }

    $scope.updateProductCellar = function(){
        $('#modalUpdateBodega').modal('toggle');
        REQUEST.getProducts(
            $scope.product.referencia,
            $scope.product.cantidad,
            $scope.product.id,
            function(data){
                sweetAlert("Exito!", "Se modifico el producto correctamente", "success");
            }
        );
    }

    $scope.getSalesByDate = function(){
        var init = document.getElementById('dateInit').value;
        var end = document.getElementById('dateEnd').value;
        if(init.length > 4 && end.length > 4){
            REQUEST.getSalesByDate(
                init,
                end,
                function($data){
                   $scope.sales = $data;
                   
                }
            );
        }else{
            sweetAlert("Ups!", "Debes seleccionar una fecha inicial y final", "error");
        }
        
    }

    $scope.getProducts = function(){        
        REQUEST.getProducts(function(data){
           $scope.products = data.products;
           $scope.paintTable('tableBodega');
           setTimeout(function(){
                $('#referencia_combo').selectize({
                    maxItems: 1,
                    valueField: 'id',
                    labelField: 'title',
                    searchField: 'title',
                    options: $scope.products,
                    create: false
                });
                $("#bodega-tab").click();
                swal.close();
            },1000)
        }); 
    }

    $scope.paintTable = function($id){
        setTimeout(function(){
            $('#'+$id).DataTable();
        },1000)
    };

    $scope.validRef = function($ref,$unidades){

        var centinela = false;
        for(var i = 0; i < $scope.products.length; i++){
            if($scope.products[i].referencia == $ref && $scope.products[i].cantidad >= $unidades){
                centinela = true;
            }
        }
        return centinela;
    }

    $scope.addSale = function(){
        var sale = $scope.sale;        
        var ref = document.getElementById('referencia_combo');
        if($scope.validRef(ref.textContent,sale.unidades)){
            //sale.ref.val, sale.tamano.val, sale.fact, sale.vendido, sale.unidades, sale.fecha
            
            REQUEST.addSale(ref.textContent, 
                sale.fact, 
                sale.vendido, 
                sale.unidades, 
                document.getElementById("fecha").value,
                function(data){
                    $('#modalVenta').modal('toggle');
                    var t = $('#tableVenta').DataTable();
                    //sale.ref.val, sale.tamano.val, sale.fact, sale.vendido, sale.unidades, sale.fecha
                    t.row.add([ref.textContent, sale.fact, sale.vendido, sale.unidades, document.getElementById("fecha").value]).draw( false );
                
                }
            );      
        }else{
            sweetAlert("Ups!", "No hay tantas unidades de esta referencia en bodega", "error");
        }
    }

    $scope.import = function(){
        var exl = document.getElementById('file');
        var file = exl.files[0];
        var data = new FormData();
		data.append('file', file);
        REQUEST.loadExcel(data);
    }

    $scope.init();
});