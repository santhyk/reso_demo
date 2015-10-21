<?php

/* 
 * General construct
 * Initilizes common object 
 * @author Rushda<incubator241@hotmail.com>
 */
require_once 'Zend/Controller/Action.php';
/***** Start of IndexController class*****/

class Rets_MlsController extends Zend_Controller_Action
{
    public function init() {
    }
    
    public function indexAction()
    {
       
    }
    
    /**
     * MlsController saveAction
     * Function used to save mls
     * @author Rushda<incubator241@hotmail.com>
     * @param type $data
     */
    public function saveAction()
    {
        $postdata = file_get_contents("php://input");
        $request  = json_decode($postdata);
        $details['id'] = $request->id;
        $details['name'] = $request->name;
        $details['website'] = $request->website;
        $details['phone'] = $request->phone;
        $details['email'] = $request->email;
        $details['sai_link'] = $request->sai_link;
        $details['street'] = $request->street;
        $details['city'] = $request->city;
        $details['state'] = $request->state;
        $details['zipcode'] = $request->zipcode;
        $details['login_url'] = $request->login_url;
        $details['username']  = $request->username;
        $details['password']  = $request->password;
        $details['useragent'] = $request->useragent;
        $details['useragent_password'] = $request->useragent_password;
        $details['rets_version']       = $request->rets_version;
        $details['payload']            = $request->payload;
        $details['date']            = $request->date;
        $details['action'] = $request->action;
        $model   = new Application_Model_Mapper_Server($vars);
        $result  = $model->mlsSave($details);
        $this->view->assign('result', $result);
        $this->_helper->viewRenderer('index');
    }
    
    /**
     * MlsController listAction
     * Function used to list mlsdetails
     * @author Naheeda<incubator189@hotmail.com>
     * @param type $data
     */
    public function listAction() 
    {
        $model   = new Application_Model_Mapper_Server($vars);
        $result  = $model->getMlsDetails();
        $data = array();
        $result = json_encode($result);
        $this->view->assign('result', $result);
        $this->_helper->viewRenderer('index');
    }
    
    /**
     * MlsController editAction
     * Function used to edit mls
     * @author Rushda<incubator241@hotmail.com>
     */
    public function editAction()
    {
        $postdata = file_get_contents("php://input");
        $request  = json_decode($postdata);
        $details['id'] = $request;
        $model   = new Application_Model_Mapper_Server($vars);
        $result  = $model->mlsEdit($details);
        $result = json_encode($result[0]);
        $this->view->assign('result', $result);
        $this->_helper->viewRenderer('index');
    }
    
    /**
     * MlsController deleteAction
     * Function used to delete mls
     * @author Rushda<incubator241@hotmail.com>
     */
    public function deleteAction()
    {
        $postdata = file_get_contents("php://input");
        $request  = json_decode($postdata);
        $details['id'] = $request;
        $model   = new Application_Model_Mapper_Server($vars);
        $result  = $model->mlsDelete($details);
        $this->view->assign('result', $result);
        $this->_helper->viewRenderer('index');
    }
    
    /*
     * DashboardController testlistAction
     * Function used to list mls test details
     * @author Naheeda<incubator189@hotmail.com>
     * @param type $data
     */
    public function testlistAction() 
    {
        $model   = new Application_Model_Mapper_Server($vars);
        $result  = $model->getTestDetails();
        $data = array();
        $result = json_encode($result);
        $this->view->assign('result', $result);
        $this->_helper->viewRenderer('index');
    }
    
}