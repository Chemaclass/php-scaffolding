
set -u

echo 'Installing the PhpScaffolding ...'

projectName=${1:-NewProject}
containerName=$(echo $projectName \
| sed 's/\([^A-Z]\)\([A-Z0-9]\)/\1_\2/g' \
| sed 's/\([A-Z0-9]\)\([A-Z0-9]\)\([^A-Z]\)/\1_\2\3/g' \
| tr '[:upper:]' '[:lower:]')

git clone https://github.com/Chemaclass/PhpScaffolding $projectName
cd $projectName

# Remove all unrelated files
rm CNAME
rm _config.yml
rm LICENSE.md

# Replace project and container names
find . -type f -exec \
  sed -i '' -e "s/PhpScaffolding/$projectName/g" {} +
find . -type f -exec \
  sed -i '' -e "s/php_scaffolding/$containerName/g" {} +

# Setup git
rm -rf .git
git init
ln -s tools/scripts/git-hooks/pre-commit.sh .git/hooks/pre-commit
ln -s tools/scripts/git-hooks/pre-push.sh .git/hooks/pre-push
git add .
git commit -m 'Scaffolding ready'

# Build and install all dependencies
docker-compose up --build -d
docker-compose exec -u dev $containerName composer install
docker-compose exec -u dev $containerName composer test-all

echo 'Setup successfully. '
