Hostel Checkin
==============
This is a Mobile Checkin System developed for Asplan Services Singapore.
The system intends to work in an SaaS(Software as a Service)model where different hotels run their own services in independent instances and the central system administrator can monitor and maintain these instances.
This system is built based on PHP,Javascript(jQuery Mobile),HTML5,CSS,MySQL. Users will need to use a HTML5 supported browser to access the system.
______________
The System Consists of four modules: 
1)The system administrator module
2)The hotel administrator module
3)The hotel staff module
4)The hotel guest module
______________
1.System Administrator Module
===============
The module consists of the backend, the frontend and a Shell script installation module.

Backend:
______________
Backend are written purely in PHP. The database management system utilizes MySQL and the mail service is based on the Pear MIME Mail Server.

The backend files are mantained in the api/ folder where the default database contants are editable in the api/includes/constants.php.
A database schema is included for your references

Frontend:
______________
The front end is written in HTML,CSS and Javascript. The CSS files are under the css/ folder, javascripts files are under js/ folder.
In the HTML files, there are a few codes which need to be reorganized into independent css/js files.

The front end communicates the backend via ajax call to the php files in the api/ folder.

Shell Script installation module
_______________
This module is intended to be used by system administrator to create new instance for newly registered hotels. Further functionalities can be explored to monitor and maitain these hotel instances

_______________
2.Hotel Administrator Module
===============
This module is intended to let the hotel administrator perform operations on importing booking histories, assigning staffs.

A very important function of this system is to let the admin upload the xls formated booking history and notify the guests to checkin

3.Hotel Staff Module
===============
This module is intended to allow the hotel staffs to help the guests to checkin. Staffs can update guests' information and let the guests sign signitures on mobile devices(ipad/android).

4.Hotel Guest Module
===============
This module is intended to engage the guests to use our system and view/update the hotel checkin history.
===============




Hotel checkin sytem for Asplan Services, SG
