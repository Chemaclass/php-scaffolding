
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
rm CNAME
rm _config.yml
rm LICENSE.md

find . -type f -exec \
  sed -i '' "s/PhpScaffolding/$projectName/g" {} +

find . -type f -exec \
  sed -i '' "s/php_scaffolding/$projectNameSnakeCase/g" {} +

docker-compose up --build -d --remove-orphans
docker-compose exec -u dev $projectNameSnakeCase composer install

echo 'Installation successfully. '
