# Sistema base em Laravel
Contém já configurado uma API de usuarios com autenticação JWT. <br>

## Tecnologias

- Laravel 12 <br>
- PHP 8.4 <br>
- Laravel Passport (jwt) <br>
- MariaDB <br>
- Docker <br>

## Configurar

> Duplique o arquivo .env.example e renomeie para .env <br>
> Abra-o e coloque as credenciais de sua database <br> 
> Para utilizar a base do Docker utilize a configuração citada abaixo
> Se atente para deixar sem comentario somente a configuração do banco que ira utilizar

```php
## MariaDB
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=app-frc
DB_USERNAME=root
DB_PASSWORD=uexozYAJe6QvOlS1JP322541frac$

## PostGreSQL
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=app-frc
DB_USERNAME=frc_user
DB_PASSWORD=uexozYAJe6QvOlS1JP322541frac$
```

> neste arquivo .env defina também o APP_KEY, como no exemplo abaixo

```php
APP_KEY=base64:dY7hiPSZq5C1rxTk9+vlQKF7Wy6snxREMOUCjuZ0e7o=
```

## Baixar bibliotecas

> Atualize o NodeJS para a versão mais recente, ou dará problema ao rodar os comandos abaixo
> Após atualizar o NodeJS prosiga com os comandos abaixo

` $ sudo npm install ` <br>
` $ sudo npm run build ` <br>

> Para instalar as dependencias: 

`$ composer install` <br>

> Para atualizar as dependencias

`$ composer update` <br>

## Docker 

> Para subir a primeira vez o projeto, rode os comandos abaixo

` $ sudo docker-compose up --build`  <br>
` $ sudo docker-compose exec app php artisan key:generate` <br>
` $ sudo docker-compose exec app php artisan migrate` <br>

## No projeto

> Abra database/migrations
> monitore essa pasta e rode no terminal 

` $ sudo docker compose exec app php artisan passport:install `

> Note que na pasta migrations ira aparecer alguns arquivos, apague-os , somente os arquivos novos que irão aparecer
> Após apagar os arquivos, dẽ continuidade no terminal com o passo a passo do Passport, para rodar o Migrate e criar um usuario de Token

`sudo docker compose exec app php artisan db:seed` <br>

## Permissões de pasta

> Pelo terminal de a permissão abaixo 

` $ sudo chmod 600 storage/oauth-private.key `
` $ sudo chmod 600 storage/oauth-public.key  `


## Informações extras
> O banco de dados que esta configurado na docker esta apontando o armazenamento para docker_components/db/sql/ <br>
> A configuração do servidor HTTP Nginx e do dservidor PHP estão dentro do diretório docker_components, caso necessite de alguma configuração extra <br>
> A API esta configurada com autenticação por JWT Bearer<br>

## URLs 

### Criar usuario
> Tipo: POST <br>
> URL: http://localhost/api/v1/register  <br>

### Corpo

```JSON
{
    "name": "Nome Completo do Usuario",
    "email": "teste@exemplo.com.br",
    "password": "senha123",
    "password_confirmation": "senha123"
}
```

### Login
> Tipo: POST <br>
> URL: http://localhost/api/v1/login  <br>

### Corpo

```JSON
{
    "email": "email.do.usuario@teste.com.br",
    "password": "senha123"
}
```

### Trazer dados do usuario logado
> Tipo: GET <br>
> URL: http://localhost/api/v1/user  <br>
> Autenticação, colocar token do tipo Bearer, informado quando faz o login do usuario

### Listar usuarios
> Tipo: GET <br>
> URL: http://localhost/api/v1/users <br>
> Autenticação, colocar token do tipo Bearer, informado quando faz o login do usuario

### Logout
> Tipo: POST <br>
> URL: http://localhost/api/v1/logout <br>
> Autenticação, colocar token do tipo Bearer, informado quando faz o login do usuario