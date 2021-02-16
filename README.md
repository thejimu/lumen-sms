# Lumen Based API for Gammu SMS

I needed to create a web API to be able to send text messages via the Gammu library on a Raspberry Pi.

You can learn about Gammu and how to set that up on the project page:
https://docs.gammu.org/project/index.html

This Lumen instance will create all the necessary Postgres tables for your Gammu install so that you don't need to do it yourself.

You can set the following .env variables for the DB:

DB_CONNECTION=pgsql <br>
DB_HOST=127.0.0.1 <br>
DB_PORT=5432 <br>
DB_DATABASE=db <br>
DB_USERNAME=username <br>
DB_PASSWORD=password <br>

The security on this Lumen API is basic and involves creating a user via command line:

php artisan api:generate-user {user}

This will generate a user and an authentication key for the API. I would recommend you implement security to suit your needs. The API Key should be sent as a post parameter rather than in the request header. So all requests should be made with POST even if you are 'getting' data.

## Endpoints

Endpoints exist for sending and accessing all table data including outbox, received messages, and phone/modem information.

i.e.

POST /v1/sms/send <br>
Send a message with the following parameters: <br>
'text' => 'the text message content' <br>
'number' => '09012341234' - supports whatever format your sending device or network supports.

POST /v1/sms/get/inbox <br>
View messages in the inbox

POST /v1/sms/get/phones <br>
View phone data such as signal and battery level
