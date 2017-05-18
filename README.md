# Authentication Application
To see the authentication application can do the following steps:


1) install composer from the web site:
    https://getcomposer.org/download/

2) Download the project on your computer 

3) At the command prompt, go to the project folder and type the following command:
 
 ```bash
 $ composer update
 ```
    
4) Run the Sql Script on your mysql database from the path data/Database folder

5) Create local.php in config/autoload folder and copy the following text into it 

```bash
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host'     => '127.0.0.1',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'mydb',
                    'charset'  => 'utf8',
                ]
            ],            
        ],        
    ],
];
```
Attention:
  Host, user, password, dbname parameters you should determine, based on the database installed on your computer

