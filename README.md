# Neo data Analysis
  
 This app is designed with an objective to do quantitative and qualitative analysis if asteroids.
 This is done by consuming REST APIs exposed by NASA to filter out requirement specific data and expose compatible APIs for the interfacing platforms.
 
 > Tools and technologies used are as follows.
 
 - Linux(Ubuntu 12.04)
 - Apache(2.4.25)
 - MYSQL(5.5.54)
 - PHP (5.6)
 - Symfony(2.8.17)
 - Doctrine(2.4.8)
 
 > Bundles Used.
 
 - Lexik Maintenance Bundle (Allow new feature deployment easily) 
 - FOS Rest Bundle (Smoothen API development process)
 - Doctrine Extensions (For utilising MySQL in Doctrine Queries)
 - Nelmio Api Doc (For auto generation of api documentation)
 - Guzzle Http (To fetch data from NASA APIs ) 
 - Doctrine Migration (To generate native MYSQL queries for schema change.Useful while doing changes in production db )
 
 -----------------------------------
 ## APIs available
 
 1. Route `/neo/hazardous`
 
    - Displays all DB entries which contain potentially hazardous asteroids
    - format JSON
 
 2. Route `/neo/fastest?hazardous=(true|false)` 
 
    - Returns all details associated with fastest asteroid which is not hazardous
    - Pass required hazardous value in query parameter to get the needed data
    - format JSON 
 
 3. Route `/neo/best-year?hazardous=(true|false)`
 
    - Calculates and return a year with most asteroids which is not hazardous
    - Pass required hazardous value in query parameter to get the needed data
    - format JSON
 
 4. Route `/neo/best-month?hazardous=(true|false)`
 
    - Calculates and return a month with most ateroids (not a month in a year)
    - Pass required hazardous value in query parameter to get the needed data
    - format JSON
    
    
 **NOTE:** This app uses the following command to fetch data from NASA apis and dump and it in specified database    
 
    `nasa:fetch-three`
    
    
 ## Application Installation
    
   - Create a database
   - Run composer install -o
   - Specify all parameters.
   - Clear cache and assign suitable permissions using following.
      
     - `php app/console cache:clear --env=prod `
     - `sudo chmod -R 777 app/cache app/logs` 
   - Dump data in your specified db using following command.
   
     - `php app/console nasa:fetch-three `
  
 ## Other Information
   
 - API documentation is available at `/api/doc`
 
   
 **NOTE:** This is an initial phase with minimal features. As or when requirements arises, more features shall be added.  