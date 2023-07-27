<?php

use Database\HumansStore;

class Test {
    public function __construct() {
        $humansStore = new HumansStore('Store');

        $humansStore->add(
            'Андрей',
            'Власов',
            680572736, //1991 год
            0, // 0 - Мужской, 1 - Женский
            'Минск',
        );

        print_r($humansStore->search()->where('id', '<=', 2)->where('id', '>', 1)->get());
        print_r($humansStore->search()->get());

        $humansStore->search()->where('id', '=', 5)->delete();

        foreach($humansStore->search()->get() AS $value) {
            echo $value->getAge();
            echo $value->getSex();
            echo '<br/>';
        }
    }
}