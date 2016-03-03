<?php namespace SGCrawler;

class CSVController
{
    function SaveToCSV($filename, $dataMap){
        try{
            $fp = fopen($filename.'.csv', 'w');
        } catch (Exception $e){
            DebugToPage("Error opening/creating ".$filename.'.csv');
        }
        foreach ($dataMap as $row) {
            fputcsv($fp, $fields);
        }
        try{
            fclose($fp);
        } catch (Exception $e){
            DebugToPage("Error closing ".$filename.'.csv');
        }
    }
}
