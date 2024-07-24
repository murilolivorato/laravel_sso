# INSTALATION
- docker-compose up -d --build
- docker-compose run --rm composer install
- docker-compose run  --rm  artisan key:generate

## CLEAR CACHE
- docker-compose run  --rm artisan config:cache

## MIGRATE DB
- docker-compose run  --rm artisan migrate
## SEED
- docker-compose run  --rm db:seed

## CREATE THE PASSPORT CLIENT PERSONAL
- docker-compose run --rm  artisan passport:client 

Which user ID should the client be assigned to?:
> 1

What should we name the client?:
> Auth

```
New client created successfully.
Client ID: 9c93bc86-7f11-4c1c-83ee-9ceb590b4e6f
Client secret: GLaFWG6NUFnx9f8w4JIeT1eXK7Y54LESrKlCsPbe

```
## ADD THOSE INFORMATION IN .ENV
```
PASSPORT_CLIENT_ID="9c93bc86-7f11-4c1c-83ee-9ceb590b4e6f"
PASSPORT_CLIENT_SECRET="GLaFWG6NUFnx9f8w4JIeT1eXK7Y54LESrKlCsPbe"
```
## CREATE PASSPORT -- PASSWORD
docker-compose run --rm  artisan passport:client --password --name=UserAdmin --provider=users


Where should we redirect the request after authorization? [http://localhost:8081/auth/callback]:
> http://localhost:9000/call-back

```
Password grant client created successfully.
Client ID: 9c93adeb-7317-45e3-ba46-c4e0ef9c0b41
Client secret: W7bv7rfXwatGz0AacMvidHf8TMqb19L56FgXtwpm

```

## ADD THOSE INFORMATION IN .ENV
```
PASSPORT_LOGIN_ENDPOINT="http://localhost:8081/oauth/token"
PASSPORT_CLIENT_ID="9c93adeb-7317-45e3-ba46-c4e0ef9c0b41" (Client ID)
PASSPORT_CLIENT_SECRET="W7bv7rfXwatGz0AacMvidHf8TMqb19L56FgXtwpm" (Client Secret )
FRONT_URL="http://localhost:8083"
BACKEND_SERVER="http://localhost:8081"
```
## GERE AS KEYS DO PASSPORT
- docker-compose run  --rm artisan passport:keys


## CLEAR THE CACHE
- docker-compose run  --rm artisan config:cache
- docker-compose run  --rm composer dump-autoload

## DB SEED
- docker-compose run  --rm artisan db:seed
