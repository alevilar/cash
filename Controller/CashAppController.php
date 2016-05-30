<?php

App::uses('AppController', 'Controller');


class CashAppController extends AppController
{
 
 	public $layout = 'Cash.default';
 	
	function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');
      
    }
}

