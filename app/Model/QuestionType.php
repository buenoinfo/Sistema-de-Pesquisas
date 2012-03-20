<?php
	class QuestionType extends AppModel {
		public $name = 'QuestionType';
		public $order = array('order');
		public $belongsTo = array('QuestionReason');
	}




?>