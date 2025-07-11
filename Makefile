SAIL_RUN = bin/sail

build:
	$(SAIL_RUN) build --no-cache

up:
	$(SAIL_RUN) up -d

down:
	$(SAIL_RUN) down

cc:
	$(SAIL_RUN) artisan cache:clear

crw:
	$(SAIL_RUN) composer require -W ${name}
cr:
	$(SAIL_RUN) composer require ${name}
cu:
	$(SAIL_RUN) composer update

cin:
	$(SAIL_RUN) composer install

crd:
	$(SAIL_RUN) composer require -W ${name} --dev

dump:
	$(SAIL_RUN) composer dump-autoload

a:
	$(SAIL_RUN) artisan ${name}

job:
	$(SAIL_RUN) artisan make:job ${name}

seed:
	$(SAIL_RUN) artisan db:seed

seeder:
	$(SAIL_RUN) artisan make:seeder ${name}

migrate:
	$(SAIL_RUN) artisan migrate

migration:
	$(SAIL_RUN) artisan make:migration ${name}

migrate-refresh:
	$(SAIL_RUN) artisan migrate:refresh

migrate-fresh:
	$(SAIL_RUN) artisan migrate:fresh

rmigrate:
	$(SAIL_RUN) artisan migrate:rollback

model:
	$(SAIL_RUN) artisan make:model ${name} -m

fm-resource:
	$(SAIL_RUN) artisan make:filament-resource ${name}

fm-resource-g:
	$(SAIL_RUN) artisan make:filament-resource ${name} --generate

fm-page:
	$(SAIL_RUN) artisan make:filament-page

fm-widget:
	$(SAIL_RUN) artisan make:filament-widget

fm-relation:
	$(SAIL_RUN) artisan make:filament-relation-manager

blueprint-new:
	$(SAIL_RUN) artisan blueprint:new

blueprint:
	$(SAIL_RUN) artisan blueprint:build

blueprint-stubs:
	$(SAIL_RUN) artisan blueprint:stubs

blueprint-erase:
	$(SAIL_RUN) artisan blueprint:erase

tinker:
	$(SAIL_RUN) artisan tinker

livewire:
	$(SAIL_RUN) artisan make:livewire ${name}


fpanel:
	$(SAIL_RUN) artisan filament:install --panels

fuser:
	$(SAIL_RUN) artisan make:filament-user


wire:
	$(SAIL_RUN) artisan make:livewire ${name}

wire-copy:
	$(SAIL_RUN) artisan livewire:copy ${name}

wire-delete:
	$(SAIL_RUN) artisan livewire:delete ${name}

wire-move:
	$(SAIL_RUN) artisan livewire:move ${name}

wire-make:
	$(SAIL_RUN) artisan livewire:make ${name}

wire-form:
	$(SAIL_RUN) artisan livewire:form ${name}

wire-layout:
	$(SAIL_RUN) artisan livewire:layout ${name}

queue-work:
	$(SAIL_RUN) artisan queue:work --timeout=0 --daemon


install-dashboard:
	$(SAIL_RUN) artisan app:install-report-dashboard


build-assets:
	node bin/build.js
	$(SAIL_RUN) artisan filament:assets