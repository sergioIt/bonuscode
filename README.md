Yii2 Test task for bonus manage
===============================

This app perform operations:

list,activate,deactivate, delete
and package codes creation.


CONFIGURATION
-------------

### Database

Database structure can be created by applying migration m160513_133104_create_table_bonus_code.
 
Filled data with demo codes is in init_dump.sql at the root of project.

Edit the file `config/db.php` with your real local data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=bonuscode',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```