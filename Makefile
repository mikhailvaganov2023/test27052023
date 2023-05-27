include .env

build:
	docker-compose build
	docker-compose up -d
	docker exec -it yii bash -c "/usr/local/bin/composer install"
	echo "build done!"

install:
	echo "install done!"
