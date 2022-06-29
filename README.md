
# API Structure -- SLIM FRAME WORK

This is the basic API structure to start with and create a secure backend api's.


## Features

- Header Authorization --Bearer method
- Auth Token Generation
- Auth Token verification
- Cross platform


## Installation

1.Copy the sql table present database/sql.db 

```bash
  Create database
```

2.Connect the application to database present in config/DatabaseConnection.php

```bash
 $database_config =[
    "driver"=>"mysql",
    "host"=>"localhost",
    "database"=>"hrms_timesheet",
    "username"=>"root",
    "password"=>"root",
    "charset"=>"utf8",
    "collation"=>"utf8_general_ci",
    "prefix"=>""
  ];
  
```
3.Execute the following query in database to create developer account,Change the folliwing 

- [value 1]=developer Id
- [value 2]=developer email
- [value 3]=developer password
- [value 4]=developer status (enum datatype )


```bash
INSERT INTO `developer_auth`(`dev_id`, `dev_email`, `dev_password`, `dev_status`) VALUES ([value-1],[value-2],[value-3],[value-4]);
```

4.Now call following end point



#### Create Jwt token 

```http
  POST /public/Generatejwt
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. Developer account |
| `password` | `string` | **Required**. Developer account |
| `scope` | `array` | **Required**. Ex : ["get","delete","patch","put","post"] |

5.Now Create your own api functionalities
