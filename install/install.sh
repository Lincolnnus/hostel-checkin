#!/bin/bash
MY_DIR=`dirname $0`
printf "To Build APP for the Hotel Instance, Follow the Following Five steps\n"
printf "Step 1: Create Database\n"
printf "Step 2: Create Empty Tables\n"
printf "Step 3: Add Admin Account and Hotel Information\n"
printf "Step 4: Create the Instance\n"
printf "Choose The Steps, Press q to quit:\n"
read text
while [ $text != "q" ]
do
case $text in
1)
chmod +x $MY_DIR/scripts/createDB.sh
$MY_DIR/scripts/createDB.sh
printf "Done!\n";;
2)
chmod +x $MY_DIR/scripts/createTables.sh
$MY_DIR/scripts/createTables.sh
printf "Done!\n";;
3)
chmod +x $MY_DIR/scripts/addAdmin.sh
$MY_DIR/scripts/addAdmin.sh
printf "Done!\n";;
4)
chmod +x $MY_DIR/scripts/createInstance.sh
$MY_DIR/scripts/createInstance.sh
printf "Done!\n";;
esac
printf "Choose The Steps, Press q to quit:\n"
read text
done
echo 'Bye'