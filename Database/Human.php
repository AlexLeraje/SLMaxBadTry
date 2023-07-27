<?php

namespace Database;

class Human extends HumanItem {

    public function getAge() :int {
       return floor((time() - $this->birthday)/31556926);
    }

    public function getSex() :String {
        $outSex = [
            0 => 'Мужской',
            1 => 'Женский',
        ];

        return $outSex[$this->sex] ?? '';
    }
}