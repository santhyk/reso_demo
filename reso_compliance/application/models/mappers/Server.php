<?php

//////////////////////////////////////////////////////////////////
//////  Server related operations
/////////////////////
class Application_Model_Mapper_Server 
{
   /**
    * variable for database object
    * @var object 
    */
   private $_db;
   
   /**
    * Id of the server in database
    * @var integer
    */
   public $username;
   
   /**
    * Identifies server name
    * @var string 
    */
   public $email;
   
   /**
    * Initializes the variables 
    */
   public function __construct($vars = '') 
   {
       $this->_db = Zend_Db_Table_Abstract::getDefaultAdapter();
       $this->userEmail     = $vars['userEmail'];
       $this->password     = $vars['password'];
   }
   
    /**
      * Application_Model_Mapper_Server isServerExists
      * Checks whether a server exists with the passed name or url
      * @author Rushda<incubator241@hotmail.com>
      * @date    26-JUN-2015
      */
    public function login()
    {
        $sql = "SELECT * 
                FROM `tbl_users` 
                WHERE `email` = '$this->userEmail'
                AND `password` = MD5('$this->password') LIMIT 1;";
        $result = $this->_db->fetchAll($sql);
        return $result;
    }
    
    /**
     * Server saveMetadata
     * Function used to save metadata
     * @author Rushda<incubator241@hotmail.com>
     * @param type $data
     */
    public function saveMetadata($data)
    {
        $sql = "INSERT INTO tbl_metadata(mls_id,metadata)
            VALUES('1', '$data')";
        $this->_db->query($sql);
    }
    
    /**
     * Server mlsSave
     * Function used to save mls details
     * @author Rushda<incubator241@hotmail.com>
     * @param type $details
     */
    public function mlsSave($details)
    { 
        $details['date'] = date_create($details['date']);
        $details['date'] = date_format($details['date'],"Y-m-d");
        if ($details['action'] == "update") {
            $sql = "UPDATE tbl_mls
                    SET name = '{$details['name']}' , website = '{$details['website']}',phone = '{$details['phone']}',email = '{$details['email']}', sai_link = '{$details['sai_link']}' , street = '{$details['street']}' , city = '{$details['city']}' ,state = '{$details['state']}', zipcode = '{$details['zipcode']}' ,login_url = '{$details['login_url']}' ,username = '{$details['username']}' ,password = '{$details['password']}',useragent = '{$details['useragent']}',useragent_password = '{$details['useragent_password']}',rets_version = '{$details['rets_version']}',payload = '{$details['payload']}',submitted_date = '{$details['date']}'
                    WHERE id = '{$details['id']}';";
            
        } else {
        $sql = "INSERT 
                INTO tbl_mls(name,website,phone,email,sai_link,street,city,state,zipcode,login_url,username,password,useragent,useragent_password,rets_version,payload,submitted_date)
                VALUES('{$details['name']}','{$details['website']}','{$details['phone']}','{$details['email']}','{$details['sai_link']}','{$details['street']}','{$details['city']}','{$details['state']}','{$details['zipcode']}','{$details['login_url']}','{$details['username']}','{$details['password']}','{$details['useragent']}','{$details['useragent_password']}','{$details['rets_version']}','{$details['payload']}','{$details['date']}');";          
        }
        $this->_db->query($sql);
    }
    
    /**
     * Server mlsEdit
     * Function used to edit mls details
     * @author Rushda<incubator241@hotmail.com>
     * @param type $details
     * @return type
     */
    public function mlsEdit($details)
    {
        $sql = "SELECT id,name,mls_name,website,phone,email,sai_link,street,city,state,zipcode,login_url,username,password,useragent,useragent_password,rets_version,payload,DATE_FORMAT(submitted_date,'%m/%d/%Y') AS date
                FROM `tbl_mls` 
                WHERE `id` = '{$details['id']}'";
        $result = array();
        $result = $this->_db->fetchAll($sql);
        return $result;
    }
    /**
     * Server getMlsDetails
     * Function used to fetch mls details
     * @author Naheeda<incubator189@hotmail.com>
     * @param type $details
     * @return type
     */
    public function getMlsDetails() 
    {
        $sql = "SELECT *
                FROM tbl_mls";
        $result = array();
        $result = $this->_db->fetchAll($sql);
        $array_length = sizeof($result);
        for($i=0; $i < $array_length;$i++) {
            $result[$i]['street']= ucfirst($result[$i]['street']);
            $result[$i]['city']= ucfirst($result[$i]['city']);
            $result[$i]['state']= strtoupper($result[$i]['state']);
            $result[$i]['name']= strtoupper($result[$i]['name']);
        }
        return $result;
    }
    
    /**
     * Server mlsDelete
     * Function used to delete mls details
     * @author Rushda<incubator241@hotmail.com>
     * @param type $details
     * @return type
     */
    public function mlsDelete($details)
    {
        $sql = "DELETE
                FROM `tbl_mls` 
                WHERE `id` = '{$details['id']}'";
        $this->_db->query($sql);
        return $result;
    }
    /**
     * Server getTestDetails
     * Function used to fetch mls testdetails
     * @author Naheeda<incubator189@hotmail.com>
     * @param type $details
     * @return type
     */
    public function getTestDetails() 
    {
        $selectFields = 't.application_uid, t.tbl_mls_id, t.tested_date, t.status, m.name AS mls_shortname, m.submitted_date,m.mls_name,
                         u.name AS tester_name, u.role';
         $sql = "SELECT $selectFields
                 FROM tbl_compliants_tests t
                 INNER JOIN tbl_mls m 
                 ON m.name = t.tbl_mls_id
                 INNER JOIN  `tbl_users` u 
                 ON u.id = t.tester_id
                 ORDER BY m.name";
                    
        $result = array();
        $result = $this->_db->fetchAll($sql);
        $array_length = sizeof($result);
        for($i=0; $i < $array_length; $i++) {
            $result[$i]['tester_name']= ucfirst($result[$i]['tester_name']);
            $result[$i]['status']= ucfirst($result[$i]['status']);
            $result[$i]['mls_shortname']= strtoupper($result[$i]['mls_shortname']);
        }
        return $result;
    }
    
}