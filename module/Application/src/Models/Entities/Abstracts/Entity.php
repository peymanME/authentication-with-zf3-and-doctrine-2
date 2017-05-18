<?php

namespace Application\Models\Entities\Abstracts;

abstract class Entity {
	
    public function __construct() {
    }

    public function __get($property){
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    abstract protected function exchangeArray($data);

    abstract protected  function getArrayValue ();

    protected function getFieldName ($name){
        return (new \ReflectionClass($this))->getShortName() . '.'. $name;
    }

    public function mapFormToObject($data){
        foreach ($data as $key => $value){
            $oldkey = $key;
            $key = str_replace("_",".",$key,$count);
            if 	(! $count){
                    $key = $this->getFieldName($key);
            }				
            $data[$key] = $data[$oldkey];
            unset($data[$oldkey]);
        }
        $this->exchangeArray($data);
        return $this;
    }
   
    
    public function mapObjectToObject($object){
        $array = $object->getArrayValue();

        foreach ($array as $field=>$value){
            //if ($value !== null){
                if (strpos($field, '_'))
                    $this->haybrid($field, $value);
                else{
                    $func = 'set'. $field;
                    //$this->exceptionService->Invoke_Debuge($func);
                    $this->$func($value);
                }
            //}
        }
        return $this;
    }

    private function haybrid ($field, $value){
        $array = explode("_", $field );
        $func = 'get'.$array[0];
        $entity = $this->$func();
        $func = 'set'.$array[1];
        $entity->$func($value);
		
    }
	
}
