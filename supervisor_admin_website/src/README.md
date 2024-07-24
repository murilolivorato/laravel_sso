
# INSTALATIONS

- docker-compose up -d --build
- docker-compose run --rm composer install
- docker-compose run  --rm  artisan key:generate

## CLEAR THE CACHE
- docker-compose run  --rm artisan config:cache

## INSTALL PASSPORT
- docker-compose run --rm   artisan passport:client --personal

What should we name the personal access client? [Fornecedores Personal Access Client]:
> Supervisor

- Personal access client created successfully.
```
Client ID ................................................................................................... 9c93b7ad-ec97-485c-9b84-ebba2faebe5d  
Client secret ........................................................................................... PyO53Pwl079vtmLYCFQAXc0atzsPHaIsc9r7vFEF 
```
## INFORMAÇÕES DO LARAVEL PASSPORT
Insira as informações do Laravel Passport que irá conectar com o Auth Sigo
```
APP_FRONT_URL="http://localhost:8087"
SSO_CLIENT_ID="96ef11d3-4b50-49cd-bdea-8d74f0a4d36b"
SSO_CLIENT_SECRET="cMTL2aa61VshXAHGnTKViq2wViuNXAmaoXbX0yfX"
SSO_CALLBACK="http://localhost:8083/callback"
SSO_SCOPE="view-user"
SSO_HTTP_HOST="http://localhost:8081"
SSO_REQUEST_HOST="http://auth_sigo_server:80"
```
## LIMPE O CACHE
- docker-compose run  --rm artisan config:cache

## ACESSO
- URL - http://localhost:8083



## INSTALATION FOR THE FIRST TIME
- docker-compose run --rm  require laravel/passport
- docker-compose run --rm  artisan  passport:install --uuids
