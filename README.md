# Descrição básica do projeto
O repositório contém uma API em PHP desenvolvida com ajuda da Slim Framework v3.\
Nesta aplicação, estão contidas rotas para cadastro, alteração, remoção e leitura de carros cadastrados, bem como a funcionalidade de alugar e devolver um carro cadastrado.

# Como executar o projeto?
  ## Requisitos básicos
  Para executar o projeto, é necessário possuir:\
  -> PHP 7.2 ou superior;\
  -> Composer;\
  -> MySQL;\
  -> Apache (ou algum outro servidor HTTP);\
  
  ## Como configurar
  ### Apache
  -> Quando utilizamos o Apache, é necessário criar um servidor virtual com o caminho do nosso projeto;\
  -> Para tal, é importante que o arquivo httpd-vhosts.conf tenha um trecho de servidor virtual similar ao seguinte:
```
  <VirtualHost *:80>
	ServerName testing.stg
	ServerAlias testing.stg
	DocumentRoot "C:\git\teste-tecnico-03\src\public"
	<Directory "C:\git\teste-tecnico-03\src\public">
        DirectoryIndex index.php
		Require all granted
        AllowOverride All
        Order allow,deny
        Allow from all
	</Directory>
</VirtualHost>
 ```
 
 ### Composer
 \
    -> O Composer será responsável por baixar as dependências do projeto e, para tal, é necessário executar o seguinte comando na raiz do projeto:
 ```
 composer install 
 ```
 
  ### Mysql
  \
    -> A aplicação utiliza acesso a um servidor Mysql e precisa que as credenciais configuradas sejam correspondentes e que o banco de dados especificado exista;\
    -> Para configurar o Mysql na aplicação, acesse o arquivo settings.php, disponível na raiz do projeto, e altere o seguinte trecho:
```  
   'connection' => [
        'dbname' => 'testing',
        'user' => 'root',
        'password' => 'admin',
        'host' => 'localhost:3306',
        'driver' => 'pdo_mysql',
    ]
```
  ### Doctrine
  \
    -> Após executar as etapas anteriores com sucesso, basta inicializar o banco de dados com o seguinte comando do doctrine feito a partir da raiz do projeto:
```  
vendor/bin/doctrine orm:schema-tool:create
```

# Quais são as rotas disponívies?
## Carro
### Cadastrar carro (POST)
-> Rota: /car \
-> Exemplo de request:
```  
{
	"carName": "Honda Civic",
	"carModel": "Sedan",
	"color": "black",
	"year": 2009,
	"licensePlate":"XAS2034",
	"pricePerDay": 40.99,
	"pricePerMonth": 679.97,
	"isAvailable": true
}
```

-> Exemplo de response (201):
```  
{
  "carName": "Honda Civic",
  "carModel": "Sedan",
  "color": "black",
  "year": 2009,
  "licensePlate": "AXY034",
  "pricePerDay": 40.99,
  "pricePerMonth": 679.97,
  "isAvailable": true,
  "updatedAt": "2021-01-17 22:22:31",
  "createdAt": "2021-01-17 22:22:31"
}
```
### Retornar carro (GET)
-> Rota: /car/{licensePlate} \
-> Exemplo de request:
```  
/car/AXY034
```

-> Exemplo de response (200):
```  
{
  "carName": "Honda Civic",
  "carModel": "Sedan",
  "color": "black",
  "year": 2009,
  "licensePlate": "AXY034",
  "pricePerDay": 40.99,
  "pricePerMonth": 679.97,
  "isAvailable": false,
  "updatedAt": "2021-01-17 22:58:21",
  "createdAt": "2021-01-17 22:42:03"
}
```
### Editar carro (PATCH)
-> Rota: /car \
-> Todos os atributos do carro podem ser alterados, com exceção do updatedAt e do createdAt.\
-> Exemplo de request:
```  
{
	"licensePlate": "AXY034",
	"carName":"Golf",
	"newLicensePlate": "ASD1234",
	"color": "yellow"
}
```

-> Exemplo de response (200):
```  
{
  "carName": "ASD1234",
  "carModel": "Sedan",
  "color": "yellow",
  "year": 2009,
  "licensePlate": "AXY034",
  "pricePerDay": 40.99,
  "pricePerMonth": 679.97,
  "isAvailable": false,
  "updatedAt": "2021-01-17 23:04:10",
  "createdAt": "2021-01-17 22:42:03"
}
```
### Remover Carro (DELETE)
-> Rota: /car \
-> Exemplo de request:
```  
{
	"licensePlate": "XAS2034"
}
```

-> Exemplo de response (200):
```  
Sem corpo de resposta
```

## Aluguel
### Alugar carro (POST)
-> Rota: /rent \
-> Exemplo de request:
```  
{
	"licensePlate": "AXY034",
	"client": {
		"fullName": "Jefferson Lopes",
		"email": "jeovaneml@live.com",
		"cpf": "226.676.810-70",
		"phone": "(31) 989770667"
	},
	"rentedTheCarAt": "01/12/2020 12:00:00",
	"paymentModality": "by-day"
}
```

-> Exemplo de response (201):
```  
{
  "rentId": 24,
  "client": {
    "cpf": "226.676.810-70",
    "fullName": "Jefferson Lopes",
    "phone": "Jefferson Lopes",
    "email": "jeovaneml@live.com",
    "updatedAt": "2021-01-17 20:46:08",
    "createdAt": "2021-01-17 20:38:49"
  },
  "car": {
    "carId": 1,
    "carName": "Honda Civic",
    "carModel": "Sedan",
    "color": "Sedan",
    "year": 2009,
    "licensePlate": "XAS2034",
    "pricePerDay": 40.99,
    "pricePerMonth": 679.97,
    "isAvailable": false,
    "updatedAt": "2021-01-17 22:32:42",
    "createdAt": "2021-01-17 20:27:30"
  },
  "rentedTheCarAt": "2020-12-01 12:00:00",
  "returnedTheCarAt": null,
  "paymentModality": "by-day",
  "updatedAt": "2021-01-17 22:32:42",
  "createdAt": "2021-01-17 22:32:42"
}
```

### Devolver carro (POST)
-> Rota: /return-car \
-> Exemplo de request:
```  
{
	"licensePlate": "XAS2034"
}
```
-> Exemplo de response (200):

```
{
  "rentId": 23,
  "client": {
    "cpf": "139.681.406.-05",
    "fullName": "Jefferson Lopes",
    "phone": "Jefferson Lopes",
    "email": "jeovaneml@live.com",
    "updatedAt": "2021-01-17 20:46:08",
    "createdAt": "2021-01-17 20:38:49"
  },
  "car": {
    "carId": 1,
    "carName": "Honda Civic",
    "carModel": "Sedan",
    "color": "Sedan",
    "year": 2009,
    "licensePlate": "XAS2034",
    "pricePerDay": 40.99,
    "pricePerMonth": 679.97,
    "isAvailable": true,
    "updatedAt": "2021-01-17 21:54:54",
    "createdAt": "2021-01-17 20:27:30"
  },
  "rentedTheCarAt": "2020-12-01 12:00:00",
  "returnedTheCarAt": "2021-01-17 21:54:54",
  "paymentModality": "by-day",
  "updatedAt": "2021-01-17 21:54:54",
  "createdAt": "2021-01-17 21:53:55"
}
```
