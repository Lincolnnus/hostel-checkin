#!/bin/bash
printf "Please Enter Database Name of the Hotel:\n"
read hotel
printf "Please Enter Administrator's Email Address:\n"
read email
printf "Please Enter a Password for the Administrator:\n"
read password
printf "Please Enter Name of the Administrator:\n"
read name
printf "Please Enter Hotel Name:\n"
read hotelName
mysql -u root -p <<EOFMYSQL
use $hotel;
INSERT INTO admin (uid, fname, email, password) VALUES (1, '$name', '$email', '$password');
INSERT INTO hotel (hid, hname) VALUES (1,'$hotelName');
EOFMYSQL