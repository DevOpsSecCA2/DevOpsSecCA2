sudo apt update && sudo apt install nodejs npm

sudo npm install -g pm2

pm2 stop example_app

cd DevOpsSecCA1/SimpleApplication/

npm install
echo $PRIVATE_KEY > privatekey.pem
echo $SERVER > server.crt

pm2 start "php -S 0.0.0.0:8080 -t /DevOpsSecCA2/SimpleApplication" --name My_PHP_App
