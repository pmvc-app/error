<?php

namespace PMVC\App\error;

use PMVC\MappingBuilder;
use PMVC\Action;

$b = new MappingBuilder();
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\ErrorAction';
${_INIT_CONFIG}[_INIT_BUILDER] = $b;

$b->addAction('index');

$b->addForward('error', [ 
    _PATH=>'error'
    ,_TYPE=>'view'
]);

class ErrorAction extends Action
{
    static function index($m, $f){
        $dotenv = \PMVC\plug('dotenv');
        $defineds = $dotenv->getUnderscoreToArray(__DIR__.'/.env.errors');
        $errors = [];
        $hasLastError = false;
        if (isset($f['errors'])) {
            $errorIds = $f['errors'];
            $lastError = $f['lastError'];
            foreach ($errorIds as $id) {
                if (!empty($defineds[$id])) {
                    if (isset($defineds[$id]['http']))
                    {
                        \PMVC\option('set', 'httpResponseCode', $defineds[$id]['http']);
                    }
                    $errorObject = new Error($id, $defineds[$id]);
                    $errors[] = $errorObject;
                    if ($lastError === $id) {
                        $hasLastError = $errorObject; 
                    }
                }
            }
        }
        $go = $m['error'];
        $go->set('data',[
            'errors'   => $errors,
            'lastError'=> $hasLastError
        ]);
        return $go;
    }
}

class Error
{
    public $message;
    public $field; 
    public $id;

    function __construct($id, $data)
    {
        $this->id = $id;
        $this->message = \PMVC\get($data, 'message');
        $this->field = \PMVC\get($data, 'field');
    }
}

