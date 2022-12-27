
## Development

### Initialize
- Create the project (development version)
```
composer create-project -s dev enpii/wp-site-enpii-boilerplate <folder-name>
```
- Copy the example environment file to the .env one
```
cp .env.example .env
```
- Then use the appropriate env variables for you working environment, remember to check the SALTS section to use correct ones.

### Running wp-cli
- With docker
```
docker compose exec wordpress wp help enpii-base
```

- On local machine, stay on the project root
```
wp help enpii-base
```

### Working with your project
- You can put your own plugins, themes, mu-plugins to corresponding folders. Then if you use git, you can add these things to your repository by:
  - Update the `html/wp-content/.gitignore` to allow your plugins, mu-plugins, themes
  - e.g. you have a plugin called `hello-world`, you need to add this
  ```
  !plugins/hello-world
  !plugins/hello-world/**
  ```
  - Then you can `git add <your-plugin-folder>` to the repo