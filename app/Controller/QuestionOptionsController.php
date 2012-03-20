<?php
	class QuestionOptionsController extends AppController {
		public $name = 'QuestionOptions';
		public $helpers = array('Html', 'Form');
				
		public function index() {
			$this->set('questionOptions', $this->QuestionOption->find('all'));
		}
		
		public function add() {
			$this->set('perguntas', $this->QuestionOption->Question->find('list'));
			if($this->request->is('post')) {
				if($this->QuestionOption->save($this->request->data)) {
					$this->Session->write('Question.id', $this->request->data['QuestionOption']['question_id']);
					$this->Session->setFlash("Dados inseridos com sucesso!");
					$this->redirect(array('action' => 'add'));       
				}else{
					$this->Session->setFlash("Nгo foi possнvel inserir os dados, tente mais tarde!");            
				}
			}else{
				if($this->Session->check('Question.id')){
					$this->set('selecionado', $this->Session->read('Question.id'));
				}
			}
		}
		
		public function edit($id = null) {
			$this->set('perguntas', $this->QuestionOption->Question->find('list'));
			$this->QuestionOption->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->QuestionOption->read();
			} else {
				if ($this->QuestionOption->save($this->request->data)) {
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
			if ($this->QuestionOption->delete($id)) {
				$this->Session->setFlash('Registro deletado com sucesso.');
				$this->redirect(array('action' => 'index'));
			}
		}

	}



?>