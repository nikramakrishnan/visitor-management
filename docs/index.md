**Visitor-Management** is a backend implementation in PHP for a Visitor Management System that can be used (On Desktop or to make an app) to record and track Visitors on a premises. VMS is being built ground-up with corporate-level security in mind, and with the latest and the fastest version of PHP. It implements token-based authentication and JSON to make it easy for apps to communicate with the back-end.

## Running on Local Server
Make sure you have xampp 7.1.4+ installed.  

### Instructions for xampp (Apache):  
Clone the repository in your htdocs folder -
```bash
git clone https://github.com/nikramakrishnan/visitor-management.git
```
**OR**  
if you have already cloned the repository, run -
```bash
git pull
```

Switch to the `development` branch (**Warning**: This is unstable!) -
```bash
git checkout development
```

Now, start Apache and MySQL, and create a database named `vms`, if not already exists.  

Now import the `vms(x.y).sql` file in the database to create the required table(s).  

The VMS is now ready to work!  

## Credentials
The default credentials used to login at `index.php` are -  

Username | admin
-------- | -----
**Password** | password

Session is maintained as a PHP session (uses cookies), and most requests will return data in `JSON` format (so that the app can understand it easily!)

## Contributing
Please note that all code must be readable and comments should be used wherever required.  
Database and table names must be generic easy to understand.