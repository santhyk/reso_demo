<?php

/* 
 * 
 */
require_once 'Zend/Controller/Action.php';

/***** Start of IndexController class*****/
class Rets_IndexController extends Zend_Controller_Action
{
    public function init() {
        //echo "rush";
    }
    
    public function indexAction()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->code_export($request);
    }
    
    /*
     * Function code_export
     * Function to download the metadata in an xml format
     */
    public function code_export($request) 
    {
        $serverName        = $request->serverName;
        $serverUrl         = $request->serverUrl;
        $userName          = $request->userName;
        $password          = $request->password;
        $userAgent         = $request->userAgent;
        $userAgentPassword = $request->userAgentPassword;
        $retsversion       = $request->retsversion;
        $resource          = $request->resource;
        $class             = $request->class;
        $fields_to_export = array('SystemName', 'StandardName', 'LongName', 'DBName',
                'ShortName', 'MaximumLength', 'DataType', 'Precision',
                'Searchable', 'Interpretation', 'Alignment',
                'UseSeparator', 'EditMaskID', 'LookupName',
                'MaxSelect', 'Units', 'Index', 'Minimum',
                'Maximum', 'Default', 'Required', 'SearchHelpID',
                'Unique', 'MetadataEntryID', 'ModTimeStamp',
                'ForeignKeyName', 'ForeignField', 'InKeyIndex'
        );
        $rets = new Rets_Phrets();
        // make first connection
        if ($userAgent) {
            $rets->AddHeader("User-Agent", $userAgent);
        } // end if
        if ($retsversion) {
            $rets->AddHeader("RETS-Version", $retsversion);
        } // end if
        $connect = $rets->Connect($serverUrl, $userName, $password, $userAgentPassword);
        error_reporting(E_ALL);
        if (!$connect) {
                echo "  + Not connected:<br>\n";
            print_r($rets->Error());
            exit;
        }
        $table = $rets->GetMetadataTable($resource, $class);
        function array_to_xml($array, &$xml_user_info) {
            foreach($array as $key => $value) {
                if(is_array($value)) {
                    if(!is_numeric($key)){
                        $subnode = $xml_user_info->addChild("$key");
                        array_to_xml($value, $subnode);
                    }else{
                        $subnode = $xml_user_info->addChild("item$key");
                        array_to_xml($value, $subnode);
                    }
                }else {
                    $xml_user_info->addChild("$key",htmlspecialchars("$value"));
                }
            }
        }
        //creating object of SimpleXMLElement
        $xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><user_info></user_info>");
        //function call to convert array to xml
        array_to_xml($table,$xml_user_info);
        //saving generated xml file
        $xml_file = $xml_user_info->asXML($serverName.'_'.$resource.'_'.$class.'.xml');
        //success and error message based on xml creation
        if($xml_file){
            echo 'XML file have been generated successfully And ';
        }else{
            echo 'XML file generation error.';
        }
        
        $url= realpath($serverName.'_'.$resource.'_'.$class.'.xml');
        $fileContents= file_get_contents($url);
        // Remove tabs, newline, whitespaces in the content array
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $myXml = simplexml_load_string($fileContents);
        $myjson = json_encode($myXml);
        $data = base64_encode($myjson);
        $model   = new Application_Model_Mapper_Server($vars);
        $result  = $model->saveMetadata($data);
        echo "Inserted into db";
    }
}