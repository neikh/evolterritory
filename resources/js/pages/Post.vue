<template>
    <div class="container-fluid">
        <div id="loading" class="fixed-top d-none">
            <vue-loader direction="top-right" image="https://loading.io/spinners/coolors/lg.palette-rotating-ring-loader.gif" text="Loading..." text-color="#786fa6" :background="'#ea8685'" />
        </div>
        <div id="save" class="fixed-top d-none">
            <vue-loader direction="top-right" image="https://loading.io/spinners/coolors/lg.palette-rotating-ring-loader.gif" text="Saving..." text-color="#786fa6" :background="'#ea8685'" />
        </div>
        <div id="success" class="alert alert-success position-fixed fixed-top d-none" role="alert">
            Your beautiful post made with awwesome pictures have been successfully created! Keep up the good work!
        </div>

        <div class="row">
            <nav class="col-md-3 col-sm-12 d-md-block bg-light sidebar m-2 border border-dark h-100">
                <div class="row justify-content-center pt-4">
                    <div class=" Adresse">
                        <div class="form-group col-md-12">
                            <label for="inputAdresse">Adresse</label>
                            <input class="form-control" id="inputAdresse" placeholder="Adresse">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputVille">Ville</label>
                            <input class="form-control" id="inputVille" placeholder="Ville">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputCodePostal">Code postal</label>
                            <input class="form-control" id="inputCodePostal" placeholder="Code postal">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputlatitude">Latitude</label>
                        <input type="latitude" class="form-control" id="inputLatitude" value="25">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputLongitude">Longitude</label>
                        <input type="longitude" class="form-control" id="inputLongitude" value="40">
                    </div>

                    <div class="row mx-auto">
                        <div class="form-group col-md-12">
                            <label for="inputDate1">Date 1</label>
                            <datetime v-model="date1" input-id="inputDate1" input-class="form-control"></datetime>
                            <!-- :format="{ year: 'numeric', month: 'numeric', day: 'numeric'}" -->
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputDate2">Date 2</label>
                            <datetime v-model="date2" input-id="inputDate2" input-class="form-control"></datetime>
                        </div>
                    </div>

                    <div class="justify-content-center">
                        <button v-on:click="sub()" type="button" name="button" class="btn btn-dark">Search</button>
                    </div>

                    <div class="justify-content-center pl-2">
                        <button v-on:click="saveThisVue()" type="button" name="button" class="btn btn-dark">Save</button>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <button v-on:click="switchImages()" type="submit" class="btn btn-dark">Switch images</button>
                </div>
                <br />
                <!-- affiche un choix si plusieurs résultats ont été trouvés -->
                <div id="select" class="row justify-content-center pl-4 pr-4 mb-3">
                </div>
            </nav>

            <div class="col-md-8 col-lg-8 px-4">
                <div id="date1" class="d-inline font-weight-bold"></div>
                <div id="date2" class="d-inline font-weight-bold float-right"></div>
                <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 0, right: 0 }">
                    <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
                    <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
                </image-compare>
            </div>
        </div>
    </div>
</template>

<script>
    import vueLoader from '@nulldreams/vue-loading/src/vue-loading';
    import { Datetime } from 'vue-datetime';
    import { Settings } from 'luxon';
    Settings.defaultLocale = 'en';
    export default {
        components: {
            vueLoader,
            Datetime
        },

        data () {
            return {
                before: '',
                after: '',
                date1: '2015-02-22T00:00:00.000Z',
                date2: '2017-02-22T00:00:00.000Z'
            }
        },

        mounted() {
            if(document.location.hash){
                this.imgCharge(this.GGET().lat, this.GGET().lon, this.GGET().date2, this.GGET().date1)
            }
        },

        methods:{
            async sub(latitude = "", longitude = ""){
                console.log('test');
                document.getElementById('loading').classList.remove("d-none");

                if (latitude == "" || longitude == ""){
                    latitude = document.getElementById('inputLatitude').value;
                    longitude = document.getElementById('inputLongitude').value;
                }

                // if no latitude or longitude has been given, use those from the address
                if (latitude == "" || longitude == ""){
                    let street = document.getElementById('inputAdresse').value;
                    let city = document.getElementById('inputVille').value;
                    let postalCode = document.getElementById('inputCodePostal').value;

                    let coordinates = await this.geocoding(street, city, postalCode);

                    console.log(coordinates);

                    latitude = coordinates[0];
                    longitude = coordinates[1];
                }


                let date1 = await this.dateRefactor(document.getElementById('inputDate1').value);
                let date2 = await this.dateRefactor(document.getElementById('inputDate2').value);

                this.imgCharge(latitude, longitude, date2, date1)
            },

            async imgCharge(latitude, longitude, date2, date1) {

                document.getElementById('loading').classList.remove("d-none");

                document.location.hash = 'lat='+latitude+'&lon='+longitude+'&date1='+date1+'&date2='+date2



                let img1 = await this.getImage(latitude, longitude, date1);
                let img2 = await this.getImage(latitude, longitude, date2);
                this.before = img1.url;
                this.after = img2.url;
                console.log(img1.date)
                document.getElementById('date1').textContent = img1.date;
                document.getElementById('date2').textContent = img2.date;
                let upload1 = this.storePic(this.before);
                let upload2 = this.storePic(this.after);

                await upload1;
                await upload2;
                document.getElementById('loading').classList.add("d-none");
            },

            async getImage(latitude, longitude, date){

                let response = await axios.get('https://api.nasa.gov/planetary/earth/imagery/' , {
                    params: {
                        lon: longitude,
                        lat: latitude,
                        date: date,
                        dim: 0.1,
                        cloud_score: 'True',
                        api_key: 'f8Bf5QWZSK50tRZOZq7BCuHCpICDTqs62MPmG9xt'
                    }

                });

                return response.data;
            },

            async storePic(picture){

                let question = await axios.post('/temp' , {
                    params: {
                        file: picture
                    }
                })
                return true;
            },

            switchImages(){
                let img = this.before;
                this.before = this.after;
                this.after = img;
            },
            GGET(param) {
            	var vars = {};
            	window.location.href.replace(
            		/[#&]+([^=&]+)=?([^&]*)?/gi, // regexp
            		function( m, key, value ) { // callback
            			vars[key] = value !== undefined ? value : '';
            		}
            	);

            	if ( param ) {
            		return vars[param] ? vars[param] : null;
            	}
            	return vars;
            },

            async geocoding(street = "", city = "", postalCode = ""){ // turns an address into coordinates
                let query = street+", "+city+", "+postalCode;
                let response = await axios.get('https://nominatim.openstreetmap.org/search' , {
                    params: {
                        format: "json",
                        q: query
                    }
                });

                let coordinates = this.selectOne(response.data);

                return coordinates;
            },

            dateRefactor(date){
                let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                let organize = date.split(' ');
                let day = organize[1];
                let month = organize[0];
                let year = organize[2];

                day = day.slice(0, -1);
                day = (day < 10 ? '0'+day : day);

                for (let i = 0; i < months.length; i++){
                    if (month === months[i]){
                        month = i + 1;
                        month = (month < 10 ? '0'+month : month);
                    }
                }

                return year+"-"+month+"-"+day;
            },

            //checks if more than one address has been retrieved by geocoding, and asks the user to choose one if so
            selectOne(addressList){
                let selectDiv = document.getElementById('select');
                selectDiv.innerHTML = "";

                if (addressList.length > 1){
                    selectDiv.removeEventListener("change", this.changeSelected);
                    selectDiv.addEventListener("change", this.changeSelected);

                    // add user instructions
                    let label = document.createElement("p");
                    let labelText = document.createTextNode("Several results have been found, select one to display :");
                    label.appendChild(labelText);
                    selectDiv.appendChild(label);

                    let select = document.createElement("select");
                    select.classList.add("form-control");

                    // add the different addresses
                    addressList.forEach(address => {

                        let option = document.createElement('option');
                        let placeName = document.createTextNode(address.display_name+" ("+address.type+")");

                        option.setAttribute('latitude', address.lat);
                        option.setAttribute('longitude', address.lon);
                        option.appendChild(placeName);

                        select.appendChild(option);
                    });

                    selectDiv.appendChild(select);
                }

                return [addressList[0].lat, addressList[0].lon];
            },

            changeSelected(event){

                let latitude = event.srcElement.selectedOptions[0].attributes.latitude.value;
                let longitude = event.srcElement.selectedOptions[0].attributes.longitude.value;

                if (latitude && longitude){
                    this.sub(latitude, longitude);
                }
            },

            async saveThisVue(){

                document.getElementById('save').classList.remove("d-none");
                if (this.before != '' && this.after != ''){
                    let question = await axios.post('/save' , {
                        params: {
                            file1: this.before,
                            file2: this.after,
                            titre: "Une comparaison de ouf 😱😱",
                            description: "Voici le top 10 des raisons pour lesquelles cette comparaison est incroyable, la n°3 va vous faire halluciner !"
                        }
                    })

                    document.getElementById('save').classList.add("d-none");
                    document.getElementById('success').classList.remove("d-none");
                    let temp = await this.sleep(4000);
                    document.getElementById('success').classList.add("d-none");
                    return true;
                }

            },
            sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }
        }
    }
</script>

<style>

</style>
