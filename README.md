# Seeding ionAuth using Faker library
After successful completion of the installing the ion-auth in the your codeigniter applicatiion, Have you found yourself creating the users in your database? I've come up with a solution to simplify the process. Paste the application folder in the root folder of your application.

### Steps
    1. Paste vendor folder in main root of project.

    2. Enter the no.of.groups and no.of.users to be created in the Faker controller

    ```sh
    //Limits
    $this->groups_limit = 2;
    $this->users_limit = 10;
    ```
    3. Go to [application-url]/faker to generate the faker data for the users creation in ion-auth tables

### Development
Want to contribute? Great!

### Todos
 - Write MORE Tests
 - Make it as tool by creating interface to generates sql files.

License
----
MIT