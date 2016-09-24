
<ul class="nav nav-tabs  nav-justified">

	<?php $class = $this->request->controller == 'arqueos' ? 'active' : '';?>
	<li class="<?php echo $class?>"><?php echo $this->Html->link('Arqueos', array('plugin'=>'cash','controller'=>'arqueos','action'=>'index')); ?></li>
	
	<?php $class = $this->request->controller == 'zetas' ? 'active' : '';?>
	<li class="<?php echo $class?>"><?php echo $this->Html->link('Zetas', array('plugin'=>'cash','controller'=>'zetas','action'=>'index'));?></li>
	
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

</ul>