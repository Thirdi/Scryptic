#!/bin/sh

# default port is 8181 if port wasn't specified as first arg to this script
port=8181
if [ $# -eq 1 ]
then
port=$1
fi

echo 'Starting bridge on port '$port

cd lib
$JAVA_HOME/bin/java -Xmx128m -jar JavaBridge.jar SERVLET_LOCAL:$port &
#cd ..
