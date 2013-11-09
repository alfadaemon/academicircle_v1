<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::import('Sanitize');

class ContactsController extends AppController {

	var $name = 'Contacts';
    var $uses = array('Contact');//, 'Gradebook');
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
	var $layout = 'default';
    var $components = array('Email', 'MathCaptcha', 'RequestHandler');

    function beforeFilter() {
        $this->Auth->allow('index', 'add');
    }

    function index(){
        if ($this->RequestHandler->isPost()) {
            $this->Contact->set($this->data);
            if ($this->MathCaptcha->validates($this->data['Contact']['security_code'])) {
                if ($this->Contact->validates()) {
                    $this->set('contact', $this->data);
                    //send email using the Email component
                    $this->Email->reset();
                    $this->Email->sendAs = 'both'; // both = html + plain text
                    $this->Email->to = array('info@academicircle.com', 'luis.araya@tipymehn.com', 'alejandra.banegas@tipymehn.com');
                    $this->Email->subject = 'Contact message from ' . $this->data['Contact']['name'];
                    $this->Email->from = $this->data['Contact']['email'];

                    $this->Email->template = 'contact';
                    $this->Email->layout = 'default';

                    $this->Email->delivery = 'mail';// 'smtp';
                    //$this->Email->send($this->data['Contact']['details']);
                    if( !$this->Email->send() ){
                        //echo print_r($this->Email);
                        $this->Session->setFlash(__('The email could not be sent.', true));
                    }
                    else{
                        $this->Contact->save();
                        $this->Session->setFlash(__('Thank you',true).' '.$this->data['Contact']['name'].'. '.__('One of our agents will contact you soon!', true));
                    }
                }
            }
            else {
                $this->Session->setFlash(__('Please enter the correct answer to the math question.', true));
            }
        }
        $this->set('mathCaptcha', $this->MathCaptcha->generateEquation());
    }
}

?>
