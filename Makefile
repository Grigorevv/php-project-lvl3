start:
	php artisan serve

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