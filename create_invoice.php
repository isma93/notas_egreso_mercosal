<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {	
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");	
}
?>
<title>Sistame notas de egreso</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container content-invoice">
<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate> 
<div class="load-animate animated fadeInUp">
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <h2 class="title">Nueva nota de egreso</h2>
    <?php include('menu.php');?>	
</div>		    		
</div>
<input id="currency" type="hidden" value="$">
<div class="row">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <h3>De,</h3>
    <?php echo $_SESSION['user']; ?><br>	
    <?php echo $_SESSION['address']; ?><br>	
    <?php echo $_SESSION['mobile']; ?><br>
    <?php echo $_SESSION['email']; ?><br>	
</div>      		
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
    <h3>Para,</h3>
    <div class="form-group">
        <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Nombre del cliente o tienda" autocomplete="off">
    </div>
    <div class="form-group">
        <textarea class="form-control" rows="3" name="address" id="address" placeholder="Dirección de entrega"></textarea>
    </div>

    <div class="form-group">
        
    
    <select name="listaClaseGerencia" class="form-control" autocomplete="off">


                    
<option value = "0">Mercadeo:</option>  


<?php
   include 'conexion.php';

    
        $query = $db->prepare ("Select id_entidad, categoria_mercadeo from entidad group by categoria_mercadeo");
        $query->execute();
        $data = $query->fetchAll();
        
        foreach($data as $valores):

            echo '<option value="'.$valores["id_entidad"].'">'.$valores["categoria_mercadeo"].'</option>';
        endforeach;

?>

</select>



    </div>

    
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table class="table table-bordered table-hover" id="invoiceItem">	
        <tr>
            <th width="2%"></th>
            <th width="38%">Descripción</th>

        


            <th width="30%">Marca

                                     

            </th>
            
            <th width="15%">Tipo de medida</th>
            							
            
        </tr>							
        <tr>
            <td><input class="itemRow" type="checkbox"></td>
            <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>

            <td><select name="listaMarcas[]" id="listaMarcas_" class="form-control" autocomplete="off">


                    
                    <option value = "0">Seleccione:</option>  
                    
                    
                    <?php
                       include 'conexion.php';

                        
                            $query = $db->prepare ("Select marca, CONCAT(marca,' , ',categoria, ' , ', categoria_mercadeo) as categoria from entidad");
                            $query->execute();
                            $data = $query->fetchAll();
                            
                            foreach($data as $valores):

                                echo '<option value="'.$valores["marca"].'">'.$valores["categoria"].'</option>';
                            endforeach;

                    ?>

                </select>
                                                        
                                                        
                                                        
                                                        
                                                        
            </td>
                                                                        

            <td>

            <select name="listaMedidas[]" id="listaMarcas_"class="form-control" autocomplete="off">


                                        
                    <option value = "0">Seleccione:</option>  


                    <?php
                            include 'conexion.php';

                        
                            $query = $db->prepare ("Select id_tipo_medida, tipo_medida from tipo_medida");
                            $query->execute();
                            $data = $query->fetchAll();
                            
                            foreach($data as $valores):

                                echo '<option value="'.$valores["id_tipo_medida"].'">'.$valores["tipo_medida"].'</option>';
                                
                            endforeach;

                            

                    ?>

                </select>





            </td>
        
        </tr>						
    </table>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
    <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
    <button class="btn btn-success" id="addRows" type="button">+ Agregar Más</button>
</div>
</div>
<div class="row">	
<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
    <h3>Notas: </h3>
    <div class="form-group">
        <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Notas"></textarea>
    </div>
    <br>
    <div class="form-group">
        <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
        <input data-loading-text="Guardando nota..." type="submit" name="invoice_btn" value="Guardar Nota" class="btn btn-success submit_btn invoice-save-btm">						
    </div>
    
</div>

</div>
<div class="clearfix"></div>		      	
</div>
</form>			
</div>
</div>	
<?php include('footer.php');?>