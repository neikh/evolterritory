<template>
    <div class="container-fluid">
        <div id="loading" class="fixed-top d-none">
            <vue-loader direction="top-right" image="https://loading.io/spinners/coolors/lg.palette-rotating-ring-loader.gif" text="Chargement..." text-color="#786fa6" :background="'#ea8685'" />
        </div>
        <div class="row ">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar ">
                <div class="row justify-content-center">
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

                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputDate1">Date 1</label>
                            <datetime v-model="date1" input-id="inputDate1"></datetime>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputDate2">Date 2</label>
                            <datetime v-model="date2" input-id="inputDate2"></datetime>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="formControlRange">Example Range input</label>
                        <input type="range" class="form-control-range" id="formControlRange">
                    </div>

                    <div class="row justify-content-center">
                        <button v-on:click="sub()" type="button" name="button" class="btn btn-dark">Chercher</button>
                    </div>

                </div>
                <br>
                <div class="row justify-content-center">
                    <button v-on:click="switchImages()" type="button" class="btn btn-dark">Switch images</button>
                </div>
            </nav>
            <div class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div id="date1" class="d-inline font-weight-bold"></div>
                <div id="date2" class="d-inline font-weight-bold float-right"></div>
                <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 50, right: 50 }">
                    <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
                    <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
                </image-compare>
            </div>
        </div>
    </div>
</template>

<script>
    import vueLoader from '@nulldreams/vue-loading/src/vue-loading';
    export default {
        components: {
            vueLoader
        },
        data () {
            return {
                before: '',
                after: ''
            }
        },
        mounted() {
            console.log("1");
        },

        methods:{
            async sub(){

                document.getElementById('loading').classList.remove("d-none");

                let latitude = document.getElementById('inputLatitude').value;
                let longitude = document.getElementById('inputLongitude').value;

                // if no latitude or longitude has been given, use those from the address
                if (!latitude || !longitude){
                    let street = document.getElementById('inputAdresse').value;
                    let city = document.getElementById('inputVille').value;
                    let postalCode = document.getElementById('inputCodePostal').value;

                    let coordinates = await this.geocoding(street, city, postalCode);

                    latitude = coordinates[0];
                    longitude = coordinates[1];
                }

                let date1 = document.getElementById('inputDate1').value;
                let date2 = document.getElementById('inputDate2').value;

                date1 = await this.dateRefactor(date1);
                date2 = await this.dateRefactor(date2);

                let img1 = this.getImage(latitude, longitude, date1);
                document.getElementById('date1').textContent = date1;

                let img2 = this.getImage(latitude, longitude, date2);
                document.getElementById('date2').textContent = date2;

                this.before = await img1;
                this.after = await img2;

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

                return response.data.url;
            },

            async storePic(picture){

                let question = await axios.post('/save' , {
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

            async geocoding(street = "", city = "", postalCode = ""){ // turns an address into coordinates
                let query = street+", "+city+", "+postalCode;
                let response = await axios.get('https://nominatim.openstreetmap.org/search' , {
                    params: {
                        format: "json",
                        q: query
                    }
                });

                let coordinates = [response.data[0].lat, response.data[0].lon];

                return coordinates;
            },

            dateRefactor(date){
                let months = ['janv.','févr.','mar.','avr.','mai','juin','juil.','août','sep.','oct.','nov.','dec.'];

                let organize = date.split(' ');
                let day = organize[0];
                let month = organize[1];
                let year = organize[2];

                day = (day < 10 ? '0'+day : day);

                for (let i = 0; i < months.length; i++){
                    if (month === months[i]){
                        month = i + 1;
                        month = (month < 10 ? '0'+month : month);
                    }
                }

                return year+"-"+month+"-"+day;
            }
        }
     }
</script>
