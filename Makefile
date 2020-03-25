SHELL:=/bin/bash
.ONESHELL:

bash:
	@if [[ ! -f /.dockerenv ]] ; then
		echo 'Connecting to php_scaffolding docker instance...'
		docker exec -ti -u dev php_scaffolding bash
	else
		echo 'You are already inside the docker bash.'
	fi

csfix:
	@if [[ -f /.dockerenv ]]; then
		cd /srv/php-scaffolding && vendor/bin/php-cs-fixer fix
	else
		docker exec -ti -u dev php_scaffolding sh \
			-c "cd /srv/php-scaffolding && vendor/bin/php-cs-fixer fix"
	fi

.PHONY: bash csfix
