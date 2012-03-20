<?php
	class EmployeeReason extends AppModel {
		public $name = 'EmployeeReason';
		public $belongsTo = array('Employee');
	}
?>