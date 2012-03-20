<?php
	class Employee extends AppModel {
		public $name = 'Employee';
		public $hasMany = array('EmployeeReason');
	}
?>