<?php
	class QuestionReasonsController extends AppController {
		public $name = 'QuestionReasons';
		public $helpers = array('Html', 'Form');
				
		public function index() {
			$this->set('questionsReasons', $this->QuestionReason->find('all'));
		}
		
		public function add() {
			if($this->request->is('post')) {
				if($this->QuestionReason->save($this->request->data)) {
					$this->Session->setFlash("Dados inseridos com sucesso!");
					$this->redirect(array('action' => 'index'));       
				}else{
					$this->Session->setFlash("Nгo foi possнvel inserir os dados, tente mais tarde!");            
				}
			}
		}
		public function edit($id = null) {
			$this->QuestionReason->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->QuestionReason->read();
			} else {
				if($this->request->data['QuestionReason']['status'] == true){
					$this->QuestionReason->query('UPDATE question_reasons SET status = 0');
				}
				if ($this->QuestionReason->save($this->request->data)) {
					$this->Session->setFlash('Ediзгo realizada com sucesso.');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Ediзгo nгo pode ser executada.');
				}
			}
		}
		public function delete($id) {
			if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			}
			if ($this->QuestionReason->delete($id)) {
				$this->Session->setFlash('Registro deletado com sucesso.');
				$this->redirect(array('action' => 'index'));
			}
		}

	}
?>