<?php

use Database\HumansStore;

class Test {
    public function __construct() {
        $humansStore = new HumansStore('Store');

        $humansStore->addUser(
            'Андрей',
            'Власов',
            time(),
            1,
            'Минск',
        );
    }
}