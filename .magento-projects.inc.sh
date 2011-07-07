#!/bin/sh

### Define the following variables:
PATH_TO_MAGENTO_PROJECTS="$HOME/sites/"	# keep trailing slash


### Do not touch beyond this line:
##
# The current $PWD is transformed into "$PATH_TO_MAGENTO_PROJECTS/<project dir>".
#
MAGENTO_PROJECT_PATH="$(echo "$PWD" | sed -r "s;("$PATH_TO_MAGENTO_PROJECTS")([^/]+)(.*);\1\2;")"

##
# Go ahead and change into the project directory.
#
cd "$MAGENTO_PROJECT_PATH"
