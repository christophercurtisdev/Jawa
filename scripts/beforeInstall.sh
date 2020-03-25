#!/usr/bin/bash
#This script is called during the CodeDeploy via the appspec.yml file

cd /var/www
rm -rf jawa
mkdir jawa