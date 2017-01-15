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
        if (isset($f['errors'])) {
            $errorIds = $f['errors'];
            foreach ($errorIds as $id) {
                if (!empty($defineds[$id])) {
                    $errors[] = new Error($id, $defineds[$id]);
                }
            }
        }
        $go = $m['error'];
        $go->set('errors',$errors);
        return $go;
    }
}

class Error
{
    public $message;
    public $field; 
    public $forward;
    public $id;

    function __construct($id, $data)
    {
        $this->id = $id;
        $this->message = \PMVC\value($data,['message']);
        $this->field = \PMVC\value($data,['field']);
        $this->forward = \PMVC\value($data,['forward']);
    }
}





