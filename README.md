# webmaid_php
php sdk to interact with database smoothly and effortlessly

Step 1: copy the SDK to your project at root level, example koloyi/database/(the SDK)

Step 2: go to Connection.php, set Connection settings and add to the class constructor using array_push($this->consetting_array) 

Step 3: create a php folder to place your php file that will capture data and respond to query requests and also data requests. Optionally
> php/capture captures new data from js submitted data
> php/read reads data from the database from js xml requests
> php/delete deletes data from the database or rather moves data to another database or table simply your preference

Step 4: for data retrieval on website ui pages include("database/Database.php");
> use WebMain https://github.com/raynjack/WebMain to generate js code to retrieve js vars for database prodcedures
> user WebMain https://github.com/raynjack/WebMain to generate php code to check for required POST vars and to create their references  
