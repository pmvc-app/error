<?php
namespace PMVC\App\error;

$b = new \PMVC\MappingBuilder();
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\ErrorAction';
${_INIT_CONFIG}[_INIT_BUILDER] = $b;

$b->addAction('index', [${_INIT_CONFIG}[_CLASS],'index']);

$b->addForward('error', array(
    _PATH=>'error'
    ,_TYPE=>'view'
));

class ErrorAction extends \PMVC\Action
{
    static function index($m, $f){
        $defineds = \PMVC\fromJson(file_get_contents(__DIR__.'/errors.json'));
        $errors = array();
        if (isset($f['errors'])) {
            $errorIds = $f['errors'];
            foreach ($errorIds as $id) {
                if (!empty($defineds->{$id})) {
                    $errors[] = new Error($defineds->{$id});
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
    public $url;

    function __construct($data)
    {
        $this->message = $data->message;
        $this->field = $data->field;
        $this->url = $data->url;
    }
}





