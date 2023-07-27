<?php

namespace Database;

Abstract class HumanItem {
    public function __construct(
        public int $id,
        public String $name,
        public String $surname,
        public int $birthday,
        public int $sex,
        public String $city,
    ) {}
}