# visitor-management
Visitor Management System. Docs available on [VMSAlpha Docs](https://nikramakrishnan.github.io/visitor-management). Markdown Docs are available on the [Project Wiki](https://github.com/nikramakrishnan/visitor-management/wiki).

# Running on Local Server
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

Now, start Apache and MySQL, and create a database named `vms`, if not already exists.  

Now import the `vms.sql` file in the database to create the required table(s).  

The VMS is now ready to work!  

# Credentials
The default credentials used to login at `index.php` are -  

Username | admin
-------- | -----
**Password** | password

Session is maintained as a PHP session (uses cookies), and most requests will return data in `JSON` format (so that the app can understand it easily!)

# Contributing
Please note that all code must be readable and comments should be used wherever required.  
Database and table names must be generic easy to understand.

# Current Status
This branch is a snapshot of the latest stable functionality. visitor-management is **not complete** and **should not be deployed** yet. Please see the `development` branch for the latest information.

# Developers
This application is developed at Bennett University by:

* [Nikhil Ramakrishnan](https://github.com/nikramakrishnan)
* [R. Ramana](https://github.com/rr42)
* [Veeki Yadav](https://github.com/gevic)
