## Introduction
This guide outlines the steps to set up a modern WordPress development environment using Docker, with a focus on shared-host deployment. The setup includes tools for compiling assets, enforcing code style, and managing dependencies.

### Features
- Dockerized Development: Uses Apache or Nginx with Docker for a consistent local environment, mimicking shared-host deployments.
- Webpack Task Runner: Automates asset compilation (CSS, JS) for themes and plugins.
- Code Style Enforcement: Integrated with phpcs and phpcbf to maintain consistent coding standards.

### Initialize
- To create a stable version of the project, run:
```
composer create-project enpii/wp-site-enpii-boilerplate <folder-name>
```
  - To use the development version (branch **master**)
  ```
  composer create-project -s dev enpii/wp-site-enpii-boilerplate <folder-name>
  ```
  in case you want to specify the branch (e.g. branch **develop**)
  ```
  composer create-project -s dev enpii/wp-site-enpii-boilerplate:dev-develop <folder-name>
  ```
- Ensure both the **.env** and **.htaccess** files are present. If either file is missing, copy it from the example:
```
cp .env.example .env
cp .htaccess.example .htaccess
```
- Update the **.env** file with the correct environment variables, especially the **SALTS** section, for your working environment.
- Add the **.htaccess** file as needed to configure the web server for proper operation.

## Development Workflow
### Update Dependencies
```
XDEBUG_MODE=off composer update
```

### Deploy with Docker
- Start containers using Apache:
```
docker-compose up -d
```
Or start with Nginx:
```
docker-compose -f docker-compose.nginx.yml up -d
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
## Troubleshooting
- If you encounter the following PHP error message:
	```
	PHP Fatal error: Uncaught ReflectionException: Class "view" does not exist...
	```
	- This issue typically occurs because the application folders are not fully created during the setup process. To resolve this error, ensure that all necessary folders for the wp-app are properly set up by running the following command:
	```
	docker-compose exec --user=webuser wordpress wp enpii-base prepare
	```
