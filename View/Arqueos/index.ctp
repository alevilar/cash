<?php
echo $this->Html->css('/cash/css/style_cash');
$this->element("Risto.layout_modal_edit");

?>

<div class="content-white">


<h1>Listado de Arqueos</h1>


<div class="pull-right">
<?php 

// si no hay cajas creadas mostrar mensaje
if ( empty($cajas)) {
    ?>
    <div class="alert alert-danger"><?php echo __('Debe crear al menos 1 caja para poder hacer el arqueo') ?></div>
    <?php
    echo $this->Html->link(__('Crear Caja')
                        , array('controller'=>'cajas', 'action'=>'add')
                        , array('class'=>'btn btn-danger btn-block'));
}


// listar link de hacer arqueo para cada caja
 foreach ($cajas as $cId=>$cName) { ?>
    <?php 
        echo $this->Html->link('Hacer Arqueo de '.$cName, array('controller'=>'arqueos', 'action'=>'add', $cId), array('class'=>'btn btn-md  btn-primary'));
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      ?>
<?php } ?>

</div>

<br><br>


<table class="table table-hover">
    <thead>
        <tr>
            <th>Caja</th>
            <th>Fecha</th>
            <th>Saldo</th>
            <th>Importe Inicial</th>
            <th>Ventas</th>
            <th>Otros Cobros</th>
            <th>Pagos</th>
            <th>Otros Egresos</th>
            <th>Importe Final</th>
            <?php if ( $puedeVerTodo ){ ?>
                <th>Creador</th>
            <?php } ?>
            <th>Creado</th>
            <th>Modificado</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($arqueos as $arq) { ?>
            <?php
            $tdClass = '';
            if (isset($arq['Arqueo']['saldo'])) {
                if (abs($arq['Arqueo']['saldo']) == 0) {
                    $tdClass = 'success';
                } elseif (abs($arq['Arqueo']['saldo']) < 11) {
                    $tdClass = 'warning';
                } else {
                    $tdClass = 'danger';
                }
            }
            ?>
            <tr class="<?php echo $tdClass ?>">
                <td><?php echo $arq['Caja']['name'] ?></td>
                <td><?php echo $this->Time->format( $arq['Arqueo']['datetime'], '%a %d de %b %H:%M ') ?></td>


                <td><?php echo $this->Number->currency($arq['Arqueo']['saldo']) ?></td>

                <td><?php echo  $this->Number->currency($arq['Arqueo']['importe_inicial']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['ingreso']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['otros_ingresos']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['egreso']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['otros_egresos']) ?></td>
                <td><?php echo  $this->Number->currency($arq['Arqueo']['importe_final']) ?></td>

                <?php if ( $puedeVerTodo ){ ?>
                <td><?php 
                if ( !empty($arq['Creator']['username']) ) {
                    echo $arq['Creator']['username'];
                } else if ( !empty($arq['CreatorGeneric']['rol_id']) ) {
                    $rolId =  $arq['CreatorGeneric']['rol_id'];
                    $rolName = $roles[$rolId];                    
                    echo __("%s Genérico", $rolName);
                }
                ?></td>
                <?php } ?>

                <td><?php echo $this->Time->format($arq['Arqueo']['created'], '%a %d de %b %H:%M ') ?></td>
                <td><?php echo $this->Time->format($arq['Arqueo']['modified'], '%a %d de %b %H:%M ') ?></td>


                <td class="actions" style="min-width: 112px;">
                <!-- Split button -->
                <div class="btn-group">
                  <?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $arq['Arqueo']['id']), array('class'=>'btn btn-default  btn-sm btn-edit')); ?>

                  <button type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="">
                        <?php echo $this->Html->link('Ver cobros', array('action' => 'listar_cobros', $arq['Arqueo']['id'])); ?>
                    </li>
                    <li class="">
                        <?php echo $this->Html->link('Ver pagos', array('action' => 'listar_pagos', $arq['Arqueo']['id'])); ?>
                    </li>
                    <li class="">
                        <?php echo $this->Html->link('Ver mesas', array('action' => 'listar_mesas', $arq['Arqueo']['id'])); ?>
                    </li>
                    <li class="">
                        <?php 
                        if ( $esDuenio ) {
                        echo $this->Html->link('Cambiar creador', array('action' => 'cambiar_creador', $arq['Arqueo']['id']), array('class' => 'btn-defaultModal'));
                        } 
                        ?>
                    </li>
                  </ul>
                </div>
                
            </td>
            </tr>

        <?php } ?>
    </tbody>
</table>


<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Página {:page} de {:pages}, mostrando {:current} elementos de {:count}', true)
    ));
    ?>
</p>

<?php echo $this->element('Risto.pagination'); ?>
</div>