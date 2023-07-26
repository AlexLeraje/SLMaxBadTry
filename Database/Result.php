<?php

namespace Database;

class Result {
    public function __construct(
        private array $data,
    ) {}

    public function get() :array {
        return $this->data;
    }

    public function delete() :bool {
        //delete users $this->data;

        return true;
    }
}