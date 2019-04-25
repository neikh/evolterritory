# evolterritory

# This project is an exercise done during our formation.

# It is a small site built using Laravel and Vuejs. It allows people to compare how a location change over time,
# using the satellite pictures given by the NASA API (see the page post). The user can give coordinates through the 
# latitude and longitude or by giving an address, in which case it is converted into latitudes and longitude
# through nominatim, a geocoding API.
# 
# It is important to note though that the NASA API doesn't have pictures for certain places (like the ocean) and times,
# and the site will give an error in case it can't get the two pictures to compare.
#
# It is also possible to save your comparison as a registered users, and the latest or most liked comparisons are displayed
# in the flow page. Registered users can then vote for these comparisons.

to install :

git pull

composer install

npm install
npm install vue-resource

php artisan key:generate

create a directory /public/storage/images
create a directory /storage/app/public/images

php artisan storage:link

php artisan migrate:fresh

php artisan serve
npm run watch
