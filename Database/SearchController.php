<?php

namespace Database;

class SearchController {
    private array $searchResult;

    public function __construct(
        private HumansStore $humansStore
    ) {
        $this->searchResult = $humansStore->store;
    }

    public function where($field, $condition, $value) :SearchController {
        $this->checkField($field);
        $this->checkCondition($condition);

        $outValue = [];
        foreach($this->searchResult AS $key => $item) {
            if($condition == '=') {
                if($item->$field == $value)
                    $outValue[$key] = $item;
            } else if($condition == '<') {
                if(is_numeric($item->$field) AND is_numeric($value) AND $item->$field < $value)
                    $outValue[$key] = $item;
            } else if($condition == '>') {
                if(is_numeric($item->$field) AND is_numeric($value) AND $item->$field > $value)
                    $outValue[$key] = $item;
            } else if($condition == '>=') {
                if(is_numeric($item->$field) AND is_numeric($value) AND $item->$field >= $value)
                    $outValue[$key] = $item;
            } else if($condition == '<=') {
                if(is_numeric($item->$field) AND is_numeric($value) AND $item->$field <= $value)
                    $outValue[$key] = $item;
            } else if($condition == '!=') {
                if($item->$field != $value)
                    $outValue[$key] = $item;
            }
        }
        $this->searchResult = $outValue;

        return $this;
    }

    public function get() :array {
        $outdata = [];

        foreach($this->searchResult AS $key => $value) {
            $outdata[$key] = new Human(
                $value->id,
                $value->name,
                $value->surname,
                $value->birthday,
                $value->sex,
                $value->city,
            );
        }

        return $outdata;
    }

    public function delete() :bool {
        return $this->humansStore->delete($this->searchResult);
    }

    private function checkField($field) :void {
        $allowedFields = array_keys(get_class_vars('Database\HumanItem'));
        if(!in_array($field, $allowedFields))
            throw new \Exception('Field ' . $field . ' not found!');
    }

    private function checkCondition($condition) {
        if(!in_array($condition, ['>', '<', '=', '!=', '>=', '<='])) {
            throw new \Exception('Condition ' . $condition . ' not found!');
        }
    }
}