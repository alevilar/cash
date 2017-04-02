<div class="content-white">
<h3>Cambiar creador del arqueo #<?php echo $this->request->data['Arqueo']['id'];?></h3>
<?php 
echo $this->Form->create('Arqueo');
echo $this->Form->input('id');
echo $this->Form->input('created_by', array(
							'empty' => 'Seleccione', 
							'options'=>$usuarios, 
							'label'=>''));
echo $this->Form->submit('Actualizar', array('class' => 'btn btn-success'));
echo $this->Form->end();
?>
</div>