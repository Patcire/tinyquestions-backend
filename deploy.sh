# cont deplyment
cd /root/tinyquestions-backend
docker stop $(docker ps -q)
docker start $(docker ps -a -q)



