
<ul class="nav nav-tabs  nav-justified">

	<?php $class = $this->request->controller == 'arqueos' ? 'active' : '';?>
	<li class="<?php echo $class?>"><?php echo $this->Html->link('Arqueos', array('plugin'=>'cash','controller'=>'arqueos','action'=>'index')); ?></li>
	
	<?php $class = $this->request->controller == 'zetas' ? 'active' : '';?>
	<li class="<?php echo $class?>"><?php echo $this->Html->link('Zetas', array('plugin'=>'cash','controller'=>'zetas','action'=>'index'));?></li>


<?php

 if ( (CakeSession::check("Auth.User.id")) && (CakeSession::read("Auth.User.is_admin") == 1 || CakeSession::read("Auth.User.rol_id") == ROL_ID_ENCARGADO || strlen(CakeSession::read("Auth.User.id")) >= 2) ) {
//Si se puede checkear la id y si el usuario es admin o si tiene rol y es encargado, o el largo del id es igual o mayor a 2 te dejara ver el resto de botones del menú. Los usuarios genericos no pueden tener un id de más de un digito. Ya que solo se pueden crear 4 usuarios genericos por comercio y va cada uno en la tabla generic_users de su tenant. Por lo tanto, su id de usuario sera de 1 a 4.
 ?>	

	<?php $class = $this->request->controller == 'pagos' ? 'active' : '';?>
	<li class="<?php echo $class?>"><?php echo $this->Html->link('Cobros', array('plugin'=>'mesa','controller'=>'pagos','action'=>'index'));?></li>


	<?php $class = $this->request->controller == 'egresos' ? 'active' : '';?>
	<li class="<?php echo $class?>"><?php echo $this->Html->link('Pagos', array('plugin'=>'account','controller'=>'egresos','action'=>'index'));?></li>
	

	<?php
	$class = '';
	if( $this->name == 'Mesas' && $this->action == 'index') {
	    $class = 'active';
	}
	?>
	
    <li class="<?php echo $class?>"><?php echo $this->Html->link('Listado de '.Inflector::pluralize( Configure::read('Mesa.tituloMesa') ), array('plugin'=>'mesa', 'controller'=>'mesas', 'action'=>'index'),array('class'=>'ventas'));?></li>

<?php
}

?>

</ul>
