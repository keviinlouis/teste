### Teste Backend

Comandos para configurar o projeto:

- `cd backend;`
- `composer install;`
- `php artisan key:generate;`
- `php artisan jwt:secret;`

- Configure o banco de dados no arquivo .env, nas keys, DB_DATABASE, DB_USERNAME, DB_PASSWORD;

- `php artisan migrate` (Caso queira gerar alguns usuarios e funcionarios para teste, rode o comando com a opção `--seed`)

- `php artisan serve` (Deve ser na porta `8000` pois o front end está apontando para esta porta)

- Acesse `http://localhost:8000` and good to go!

- Ao acessar dessa maneira, o vuejs estará dentro do backend, para uma melhor experiencia, inicie o servidor também no front-end

##### Caracteristicas
- Fiz multi linguagem para `en` e `pt-br`
- Fiz Factory e Seeds
- Utilizei `JWT`
- Utilizei `VueJS` com `Vuetify`, `Vuex`, `Axios`, `VeeValidate`, `i18n` e `VueRouter`
- Utilizei API-REST-FULL


##### FrontEnd
- O codigo do front end está na pasta frontend
Caso deseja rodar o servidor frontend siga os seguintes comandos
- Foi utilizado Multilinguagem também no front-end

- `cd frontend;`
- `npm i;`
- `npm run server;`




