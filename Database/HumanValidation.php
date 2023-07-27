<?php

namespace Database;

class HumanValidation extends Human {
    public function __construct(...$arguments) {
        parent::__construct(...$arguments);

        $this->onlyLetters($this->name);
        $this->onlyLetters($this->surname);
    }

    private function onlyLetters($string) {
       if(!preg_match("/^[a-zа-яё]+$/iu", $string)) {
           throw new \Exception('Only letters allowed!');
       }
    }
}