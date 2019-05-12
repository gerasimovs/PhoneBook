# SPA приложение "Телефоный справочник"

## Fronend
* html5
* css
* js (VueJS, Buefy)

### Первая страница
Таблица с контактами и телефонами. Контакт может иметь несколько телефонов.
Над таблицей, кнопка Добавить контакт и Поиск по справочнику.
Возле Контакта кнопка Добавить телефон.

Колонка в таблице "Actions" и в ней отрисовать для каждого Контакта кнопку "Редактировать" и "Удалить".
- При нажатии "Редактировать" переходит к форме редактирования Контакта.
- При нажатии "Удалить" удаляет Контакт.

### Вторая страница
Форма создания (редактирования).
После заполнения полей и нажатия кнопки "Создать" ("Сохранить") создается новая запись (обновляется запись) в справочнике и перенаправляет к первой странице. В таблице должна отображаться новый Контакт (изменения Контакта).

## API
Для API использовать Backend сервер

## Backend
**Не использовать фреймворк**
Использовать: php + mysql (или любую БД).
Разделить архитектуру на Controller и Model.
Использовать Composer Autoloading

### Обязательно
Разместить рабочую версию в github.com, с readme.md файлом как развернуть. проект

### Не обязательно
Использовать docker контейнеры.

### Запуск приложения
* Перейти в каталог приложения (консоль)
* Установить внешние пакеты через Composer (composer install)
* Переименовать файл .env.example в файл .env и внести актуальные доступы к базе данных (cp .env.example .env && nano .env)
* Запустить файл install.php (php install.php) и дождаться завершения создания таблиц базы данных
* Запустить php сервер (php -S localhost:8000 -t public/ > /dev/null 2>&1)
* Открыть в браузере страницу приложения http://localhost:8000
