<?php
	class Question extends AppModel {
		public $name = 'Question';
		public $belongsTo = array('QuestionType','QuestionReason');
		public $hasMany = array('QuestionOption');
	}
?>