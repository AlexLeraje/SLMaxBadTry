<?php

use Database\HumansStore;

class Test {
    public function __construct() {
        $humansStore = new HumansStore('Store');

//        $humansStore->add(
//            'Андрей',
//            'Власов',
//            time(),
//            1,
//            'Минск',
//        );

        print_r($humansStore->search()->where('id', '<=', 2)->where('id', '>', 1)->execute());
        print_r($humansStore->search()->execute());
    }
}