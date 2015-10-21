<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Zend/Controller/Action.php';
/***** Start of IndexController class*****/

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
    }
    
    public function indexAction()
    {

    }
    
    /**
     * IndexController loginAction
     * To authenticate the login credentials & to return the logged in user data
     * @modified Santhy K <incubator219@hotmail.com>
     * @date     28-SEP-2015
     */
    public function loginAction()
    {
        $postdata = file_get_contents("php://input");
        $request  = json_decode($postdata);
        $vars['userEmail'] = $request->userEmail;
        $vars['password']  = $request->password;
        $model   = new Application_Model_Mapper_Server($vars);
        $result  = $model->login();
        if ($result) {
            $output = array('status' => 'success', 'userData' => $result[0]);
            //echo "{'status' : 'success', 'userData' :  '{$userData}'}";
        } else {
            $output = array('status' => 'error', 'message' => 'Username or password is incorrect') ;
            
        }
        if (!empty($output)) {
            $userData = json_encode($output, JSON_FORCE_OBJECT);
            echo $userData;
        }
    }
    
    
}