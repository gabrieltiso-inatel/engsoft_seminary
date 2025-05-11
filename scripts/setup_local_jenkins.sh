#!/bin/sh

docker build -t custom-jenkins -f ./local/Dockerfile.jenkins .
docker run --name jenkins-php --rm --detach \
  --network seminary_network \
  --publish 8888:8080 \
  --volume jenkins-data:/var/jenkins_home \
  custom-jenkins
echo "Jenkins is running at http://localhost:8888"