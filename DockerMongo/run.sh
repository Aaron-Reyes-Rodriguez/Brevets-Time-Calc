docker-compose down
docker rm $(docker ps -a -q)
docker rmi dockermongo-web:latest
docker-compose up
