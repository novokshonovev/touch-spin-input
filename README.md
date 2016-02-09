# touch-spin-input

TouchSpinInput - виджет для отображения числовых полей

## Установка

1. Загрузить через git: https://github.com/novokshonovev/touch-spin-input.git
или 
2. Установка через composer 

2.1 Добавить в composer.json проекта:

* репозиторий 
```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/novokshonovev/touch-spin-input"
        }
    ],
```
* и зависимость
```json
    "require": {
        "dowlatow/touch-spin-input": "dev-master"
    },
```
2.2 Выполнить установку: ``composer install``

## Пример использования

```php
    <?= $form->field($model, 'duration')->widget(TouchSpinInput::className(), ['min' => BasePoll::MIN_DURATION, 'max' => BasePoll::MAX_DURATION, 'default' => BasePoll::DEFAULT_DURATION]) ?>
```