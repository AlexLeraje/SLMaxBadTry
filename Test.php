<?php

use Database\HumansStore;

class Test {
    public function __construct() {

        //Инициализируем хранилище Store/Store.json
        //Структура БД по сути описывается в классе Database/HumanItem.php
        $humansStore = new HumansStore('Store');

        //Добавление человека
        $humansStore->add(
            'Андрей',
            'Власов',
            680572736, //1991 год
            0, // 0 - Мужской, 1 - Женский
            'Минск',
        );

        //Поиск по людям, количество where может быть бесконечным
        //При каждом вызове where ищет относительно предыдущего вызова where
        print_r($humansStore->search()->where('id', '<=', 2)->where('id', '>', 1)->get());

        //Получаем всех людей
        print_r($humansStore->search()->get());

        //Удаляем по списку всех людей с id > 5, условия могут быть любыми
        $humansStore->search()->where('id', '>=', 5)->delete();

        //Удаление пользователя по id
        $humansStore->delete(5);

        //Пример вывода данных
        $out = [];
        foreach($humansStore->search()->get() AS $value) {
            $out[] = [
                'id' => $value->id,
                'Имя' => $value->name,
                'Фамилия' => $value->surname,
                'Возраст' => $value->getAge(), //Получаем возраст
                'Пол' => $value->getSex(), //Получаем пол
                'Город' => $value->city,
            ];
        }

        print_r($out);
    }
}