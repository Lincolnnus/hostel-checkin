#!/bin/bash
printf "Step 1:Enter Database Name for the New Hotel:\n"
read hotel
user="root"
mysql -u $user -p <<EOFMYSQL
CREATE DATABASE $hotel;
EOFMYSQL