<?php
class SalesController extends AppController {

	var $name = 'Sales';
    var $components = array('RequestHandler','Session');
    var $helpers = array('Html', 'Form', 'Ajax', 'JavaScript', 'Js');
    var $uses = array("Clientes","Categorias","DatosClientes");
    
    function add($action)
    {
        $title = "Venta Productos";
        $this->set("title_for_layout",$title);
        $this->set("Categorias",$this->Categorias->find("list",array("fields"=>array("categoria_id","nombre"))));
        $Generos = array(""=>"","F"=>"F","M"=>"M");
        $this->set("Generos",$Generos);
        $this->set("ACTION",$title);
        $this->set("BUTTON","Registrar");
	}
    
    function search() {

	}
}