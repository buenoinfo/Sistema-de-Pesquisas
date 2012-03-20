<?php
	class QuestionsController extends AppController {
		public $name = 'Questions';
		public $helpers = array('Html', 'Form');
				
		public function index() {
			$this->set('questions', $this->Question->find('all'));
		}
		
		public function add() {
			$this->set('blocos', $this->Question->QuestionType->find('list'));
			$this->set('motivos', $this->Question->QuestionReason->find('list'));
			if($this->request->is('post')) {
				if($this->Question->save($this->request->data)) {
					$this->Session->setFlash("Dados inseridos com sucesso!");
					$this->Session->write('Question.id', $this->Question->id);
					$this->redirect(array('controller' => 'questionoptions', 'action' => 'add'));       
				}else{
					$this->Session->setFlash("Nгo foi possнvel inserir os dados, tente mais tarde!");            
				}
			}
		}
		public function edit($id = null) {
			$this->Question->id = $id;
			$this->set('blocos', $this->Question->QuestionType->find('list'));
			$this->set('motivos', $this->Question->QuestionReason->find('list'));
			
			if ($this->request->is('get')) {
				$this->request->data = $this->Question->read();
			} else {
				if ($this->Question->save($this->request->data)) {
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
			if ($this->Question->delete($id)) {
				$this->Session->setFlash('Registro deletado com sucesso.');
				$this->redirect(array('action' => 'index'));
			}
		}

	}
?>