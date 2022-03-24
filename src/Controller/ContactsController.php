<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contacts Controller
 */
class ContactsController extends AppController {

    /**
     * Index method
     *
     */
    public function index() {   
        $this->paginate['limit'] = 30;
        $this->paginate['fields'] = array('Contacts.id', 'Contacts.first_name', 'Contacts.last_name', 'Contacts.phone_number');
        $contacts = $this->paginate('Contacts');
        
        $this->set(compact('contacts'));
        $this->set('_serialize',['contacts']);

        $this->RequestHandler->renderAs($this, 'json');
    }

    public function indexExt(){

        $where = [
            'recursive'=>-1,
            'fields' => [
                'Contacts.id',
                'Contacts.first_name',
                'Contacts.last_name',
                'Contacts.phone_number',
                'company.company_name',
                'company.address'
             ],
            'join' => [
                'company' => [
                    'table' => 'companies',
                    'type' => 'LEFT',
                    'conditions' => [
                        'company.id = contacts.id'
                    ],
                ],
            ],
            'group' => 'contacts.id'
        ];

        $this->paginate = $where;

        $contacts = $this->paginate($this->Contacts);

        $this->set(compact('contacts'));
        $this->set('_serialize',['contacts']);

        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {

        $user = array();

        $contact = $this->Contacts->newEntity();

        if ($this->request->is('post')) {

            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            
            if (empty($contact->errors())) {

                if ($this->Contacts->save($contact)) {
                    $user['success'] = 1;
                    $user['message'] = 'The contact has been saved.';
                } else {
                    $user['success'] = 0;
                    $user['message'] = 'The contact could not be saved. Please, try again.';
                }  
            } else {
                $field_errors = array_keys($contact->errors());

                $user['success'] = 0;
                $user['message'] = 'Fields '.implode(',', $field_errors).' are not supplied.';
            }
            
        } else {
            $user['success'] = 0;
            $user['message'] = 'Invalid Request. Please, try again.';
        }

        $this->set(compact('user'));
        $this->set('_serialize',['user']);

        $this->RequestHandler->renderAs($this, 'json');
    }
}
