
set -u

echo 'Installing the PhpScaffolding ...'

projectName=${1:-${PWD##*/}}
projectNameSnakeCase=$(echo $projectName \
| sed 's/\([^A-Z]\)\([A-Z0-9]\)/\1_\2/g' \
| sed 's/\([A-Z0-9]\)\([A-Z0-9]\)\([^A-Z]\)/\1_\2\3/g' \
| tr '[:upper:]' '[:lower:]')

git clone https://github.com/Chemaclass/PhpScaffolding $projectName
cd $projectName/
rm -rf .git

find . -type f -exec \
  sed -i '' "s/PhpScaffolding/$projectName/g" {} +

find . -type f -exec \
  sed -i '' "s/php_scaffolding/$projectNameSnakeCase/g" {} +

git init
docker-compose up --build --remove-orphans -d
docker-compose exec -u dev $projectNameSnakeCase composer install

echo 'Installation successfully. '
