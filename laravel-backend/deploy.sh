#!/bin/bash
# ------------------------------------------------------------------
# Dilanka
# ------------------------------------------------------------------


IGNORE=/var/tmp/ignore

echo "
.env
.git*
deploy-dev-server.sh
deploy-qa-server.sh
deploy-uat-server.sh
public/uploads/*
/vendor/*
public/storage/*
storage/*
report/*
mainreport/*
node_modules/*
" > $IGNORE

# update
rsync --rsync-path="sudo rsync" . gihandilanka:/var/www/html/newgihandilanka --exclude-from=$IGNORE --delete -rvczh

rm $IGNORE

#ssh gihandilanka "cd /home/ubuntu/projects/ && sudo chmod +777 -R newgihandilanka && cd newgihandilanka &&  sh post_deployment_commands.sh"
