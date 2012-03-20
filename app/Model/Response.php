<?php
	class Response extends AppModel {
		public $name = 'Response';
		public $belongsTo = array('Question','QuestionOption','QuestionReason');
	}




?>