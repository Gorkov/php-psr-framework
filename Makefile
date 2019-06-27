up: docker-up
init: docker-down-clear docker-pull docker-build docker-up framework-init

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

framework-init: framework-composer-install

framework-composer-test:
	docker-compose run --rm framework-php-cli composer test

framework-composer-install:
	docker-compose run --rm framework-php-cli composer install

cli:
	docker-compose run --rm framework-php-cli php bin/app.php