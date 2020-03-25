#!/usr/bin/bash
#This script is called during the CodeDeploy via the appspec.yml file

# check to see if docker is running, following returns 0 if OK, or 3 if not

systemctl is-active --quiet docker