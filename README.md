## Introduction
This is the modern WordPress setup for shared-host development.
- It uses Apache for Docker to make your development simple and it would be consistent for deployment to shared-host (mostly use Apache)
- It includes task runner based on webpack to allow theme, plugins assets compiling
- It also includes phpcs and phpcbf to ensure the the codestyle of the project

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
- Ensure that you have tne **.env** file, if it doesn't exists, you can copy from the example file
```
cp .env.example .env
```
- Then use the appropriate env variables for you working environment, remember to check the SALTS section to use correct ones.

## Development
- Update the dependencies
```
XDEBUG_MODE=off composer update
```

### Deploy with Docker
- Start all containers
```
docker-compose up -d
```
then the website would be available at http://127.0.0.1:19080/
(the port 19080 can be edited in **.env** file but you need to down and up the containers again)

- Update composer with Docker
```
docker-compose exec -e XDEBUG_MODE=off wordpress composer update
```

- Run phpcs
```
docker compose exec wordpress yarn phpcs
```
or
```
docker compose exec wordpress yarn phpcbf
```
to fix the codestyle issue

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
- To ensure the Git hook runs automatically on the server at the post-commit stage—executing phpcbf to fix PHP CodeSniffer (PHPCS) errors, running phpstan for verification, and staging modified files—contributors need to clone the repository and set up the `core.hooksPath` configuration. If `core.hooksPath` isn’t already configured, make sure it is set up by running:
```
git config core.hooksPath .githooks
```

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

Similar to the theme with
```
docker compose exec wordpress yarn build-theme
```
and watch
```
docker compose exec wordpress yarn dev-theme
```
