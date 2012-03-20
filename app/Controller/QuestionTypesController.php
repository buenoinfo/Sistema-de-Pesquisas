<?php
	class QuestionTypesController extends AppController {
		public $name = 'QuestionTypes';
		public $helpers = array('Html', 'Form');
				
		public function index() {
			$this->set('questionTypes', $this->QuestionType->find('all'));
		}
		
		public function add() {
			$this->set('motivos', $this->QuestionType->QuestionReason->find('list'));
			if($this->request->is('post')) {
				if($this->QuestionType->save($this->request->data)) {
					$this->Session->setFlash("Dados inseridos com sucesso!");
					$this->redirect(array('action' => 'add'));       
				}else{
					$this->Session->setFlash("Nгo foi possнvel inserir os dados, tente mais tarde!");            
				}
			}
		}
		
		public function edit($id = null) {
			$this->QuestionType->id = $id;
			$this->set('motivos', $this->QuestionType->QuestionReason->find('list'));
			if ($this->request->is('get')) {
				$this->request->data = $this->QuestionType->read();
			} else {
				if ($this->QuestionType->save($this->request->data)) {
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
			if ($this->QuestionType->delete($id)) {
				$this->Session->setFlash('Registro deletado com sucesso.');
				$this->redirect(array('action' => 'index'));
			}
		}

	}




?>