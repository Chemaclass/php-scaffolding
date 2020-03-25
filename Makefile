SHELL:=/bin/bash
.ONESHELL:

bash:
	@if [[ ! -f /.dockerenv ]] ; then
		echo 'Connecting to php_scaffolding docker instance...'
		docker exec -ti -u dev php_scaffolding bash
	else
		echo 'You are already inside the docker bash.'
	fi

.PHONY: bash
