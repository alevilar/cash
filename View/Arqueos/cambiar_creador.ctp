<div class="content-white">
<h1>Cambiar creador del arqueo #<?php echo $id_arqueo;?></h1>
<?php echo $this->Form->create('cambiar_creador'); ?>
<?php 

$opciones = $nombre_usuario + $generic_users;

echo $this->Form->input('usuario', array('options' => $opciones, 'empty' => 'Lista de usuarios', 'class' => 'form-control', 'label' => ''));
?>
<?php echo $this->Form->submit('Actualizar', array('class' => 'btn btn-success'));?>
<?php echo $this->Form->end();?>
</div>