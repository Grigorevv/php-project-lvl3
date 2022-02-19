start:
	php artisan serve

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	#php artisan db:seed
	#npm ci

reset:
	rm db.sqlite || true

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test 

deploy:
	git push heroku

lint:
	composer exec phpcs -- --standard=PSR12 app routes tests

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

lint-fix:
	composer phpcbf

clear:
	php artisan cache:clear

