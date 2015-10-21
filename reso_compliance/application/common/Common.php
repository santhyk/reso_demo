<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Common {
    /**
     * Common  logger
     * to write the content to a file. Helps to debug
     * @param   String  $content    content to write
     * @param   String  $logFileName    log file name
     * @author	Santhy <incubator219@hotmail.com>
     * @date	05-Oct-2015	
     */
    public static function logger($content, $logFileName = '')
    {
        $logFileName = $logFileName ? $logFileName: 'log/log.txt';
        $dirName = dirname($logFileName);
        if ($dirName && !file_exists($dirName)) {
            mkdir($dirName, '0777', true);
        }
        $fh = @fopen($logFileName, 'a+');
        fwrite($fh, "$content\r\n");
        fclose($fh);
    }
}
