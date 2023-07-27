<?php

namespace Database;

class HumansStore {

    public array $store = [];

    public function __construct(public String $storeName) {
        if(file_exists('Store/' . $this->storeName . '.json')) {
            $this->store = (array) json_decode(file_get_contents('Store/' . $this->storeName . '.json'));
        }
    }

    public function add(...$arguments) :int {
        $nexId = $this->getNextId();
        array_unshift($arguments, $nexId);
        $this->store[$nexId] = new HumanValidation(...$arguments);
        $this->saveStore();
        return $nexId;
    }

    public function delete($humanId) :bool {
        return $this->search()->where('id', '=', $humanId)->delete();
    }

    public function search() :SearchController {
        return new SearchController($this);
    }

    public function deleteByCondition($data) :bool {
        $deleteKeys = array_keys($data);

        $outvalue = [];
        foreach($this->store AS $key => $item) {
            if(!in_array($key, $deleteKeys)) {
                $outvalue[$key] = $item;
            }
        }
        $this->store = $outvalue;
        $this->saveStore();

        return true;
    }

    private function saveStore() {
        file_put_contents('Store/' . $this->storeName . '.json', json_encode($this->store));
    }

    private function getNextId() :int {
        if(!empty($this->store))
            $maxKey = max(array_keys($this->store));
        else
            $maxKey = 0;

        return ++$maxKey;
    }
}