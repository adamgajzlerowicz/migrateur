#Migrateur

##Purpouse:
To run migrations on multiple databases simultaneously, using command line.

##Installation:
Clone the repository and run composer install.
Rename `env-example.php` to `env.php`. Put your configuration into the config file.

##Configuration:
You will need one primary database, that contains usernames, passwords and database names for all databases you want to run migrations on.
Default configuration assumes that your "main" database name is `companydatabases` that has a `databasesettings` table, and it will read from `dbusername`, `dbpassword` and `dbname` fields.
                                                                                                                                            
You may change the name of your "main" database in the config file.
Example table structure will look like this (please notice the `company1`, `company2` and `company3` table)

![databases](/src/database.png)

##Usage:
In the root folder of the application execute `php console.php`. This will give you access to three commands: `migrate:check`, `migrate:create` and `migrate:migrate`.
The first run of `migrate:check` command will check if `migrations` table exist, and create it if it doesn't.

###Daily usage
- generate new migrations using the `migrate:create`
- check status of your migrations with `migrate:check` 
- run your migrations using `migrate:migrate`
- check if the migration run sucessfully `migrate:check`