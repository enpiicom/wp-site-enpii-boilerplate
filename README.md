
## Development
- Update the dependencies
```
XDEBUG_MODE=off composer update
```

### Initialize
- Create the project (stable version)
```
composer create-project enpii/wp-site-enpii-boilerplate <folder-name>
```
  - Use development version (branch **master**)
  ```
  composer create-project -s dev enpii/wp-site-enpii-boilerplate <folder-name>
  ```
  in case you want to specify the branch (e.g. branch **develop**)
  ```
  composer create-project -s dev enpii/wp-site-enpii-boilerplate:dev-develop <folder-name>
  ```
- Copy the example environment file to the .env one
```
cp .env.example .env
cp docker-compose.yml.example docker-compose.yml
```
- Then use the appropriate env variables for you working environment, remember to check the SALTS section to use correct ones.

### Deploy with Docker
- Start all containers
```
docker-compose compose up -d
```
then the website would be available at http://127.0.0.1:19080/
(the port 19080 can be edited in **.env** file)
- Update composer with Docker
```
docker-compose exec -e XDEBUG_MODE=off wordpress composer update
```
- Run phpcs
```
docker-compose exec wordpress ./vendor/bin/phpcs
```
- Run wp-app artisan
```
docker-compose exec --user=webuser wordpress ./wp-enpii-base-artisan wp-app:hello
```
or
```
docker-compose exec --user=webuser wordpress wp enpii-base artisan wp-app:hello
```

### Running wp-cli
- With Docker
```
docker compose exec --user=webuser wordpress wp enpii-base info
```

- On local machine, stay on the project root
```
wp enpii-base info
```

### Working with GIT
- You can put your own plugins, themes, mu-plugins to corresponding folders. Then if you use git, you can add these things to your repository by:
  - Update the `./wp-content/.gitignore` to allow your plugins, mu-plugins, themes
  - e.g. you have a plugin called `hello-world`, you need to add this
  ```
  !plugins/hello-world
  !plugins/hello-world/**
  ```
  - Then you can `git add <your-plugin-folder>` to the repo

### Compiling assets (CSS, JS)
- This repo consists of a sample plugin **Demoda** and a sample theme **Appeara Alpha**, it has the webpack configs to compile plugin and theme CSS and JS

To install dependencies
```
docker compose exec wordpress yarn install
```

Compile plugin assets
```
docker compose exec wordpress yarn build-plugin
```
or to watch and compile
```
docker compose exec wordpress yarn dev-plugin
```

Simila to the theme with
```
docker compose exec wordpress yarn build-theme
```
and watch
```
docker compose exec wordpress yarn dev-theme
```
