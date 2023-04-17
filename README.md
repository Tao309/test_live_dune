# Тестовое задание
#### Контроль изменения цены

## Запуск тестов
    ./vendor/bin/phpunit tests/

Необходимо создать класс на PHP (Laravel), который будет валидировать наценку/скидку между текущей ценой и предыдущей.

## Свойства

Класс должен иметь следующие приватные свойства:
1. Допустимое отклонение в % (число);
2. Результат отклонения в % (число);


## Интерфейс
Класс должен реализовать следующий интерфейс: 
```php
interface Diverge { 
    /** 
    * Отклонение цены не должно быть больше допустимого значения (%) 
    * 
    * @param float $new новая цена, которую будем проверять на отклонение. 
    * @param float $out текущая цена. 
    * @return bool 
    */ 
    public function diffPrice(float $new, float $out): bool; 
    /** 
    * Результат отклонения в % 
    * 
    * @return float 
    */ 
    public function getDeviation(): float; 
}
```

В случае, если результат будет больше, чем допустимое отклонение, то метод должен вернуть false. В любых других случаях должен вернуться true.

## Валидатор (нет)
Будет плюсом, если продемонстрируете как созданный класс будет подключен в виде Laravel валидатора diverg. Так же плюсом будет созданный тест для класса и заполненный док-блок.

   
## Примечание
Достаточно прислать только файлы классов и тестов (не весь фреймворк).