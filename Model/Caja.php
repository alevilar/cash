<?php

App::uses('CashAppModel', 'Cash.Model');

class Caja extends CashAppModel {

	public $name = 'Caja';
	public $validate = array(
		'name' => array('isUnique', 'notBlank'),
		'computa_ventas' => array('boolean'),
                'computa_pagos' => array('boolean'),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array(
            'Cash.Arqueo',
	);

}
?>