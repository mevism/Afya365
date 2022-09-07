<?php

namespace components;

trait TraitController {
	
    public function baseUrl()
    {
        return \yii\helpers\Url::base(true);
    }

    /**
     *
     *  @param  string $data
     *  @param  boolean $type [TRUE = var_dump | FALSE = print_r]
     *  @param  boolean $die
     */
    public function debugCode($data = null, $tipe = false, $die = true)
    {
        echo '<pre>';
        $tipe ? var_dump($data) : print_r($data);
        echo '</pre>';
        $die ? die() : '';
    }

    /**
     * Parsing data xml to JSON
     *
     * @param  xml $data
     * @return string JSON
     */
    public function xMlToJson($data)
    {
        $fileContents = file_get_contents($data);
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml    = simplexml_load_string($fileContents); // used to convert the xml string into an object
        return $simpleXml;
    }
}