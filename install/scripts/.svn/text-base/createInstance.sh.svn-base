#!/bin/bash
printf "Step 4:Enter Directoy Where Hotel Instances are Hosted:\n"
read hotelDir
sudo mkdir -p $hotelDir
sudo chmod 777 $hotelDir
printf "Please Enter Instance Name of the New Hotel:\n"
read instanceName
newDir=$hotelDir'/'$instanceName
sudo cp -r -f ../newInstance $newDir
sudo chmod 777 $newDir'/hotel.xml'
sudo chmod 777 $newDir'/admin/api/includes/pear.email.php'