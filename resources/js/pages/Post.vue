<template>
    <div class="container-fluid">
        <div id="loading" class="fixed-top" v-show="isLoading">
            <vue-loader
                direction="top-right"
                image="https://loading.io/spinners/cloudy/index.cloudy-sky-preloader.svg"
                v-bind:text="loadType"
                text-color="#786fa6"
                :background="'#ea8685'"
            />
        </div>

        <div class="row">
            <nav class="col-md-3 col-sm-12 d-md-block bg-light sidebar m-2 border border-dark h-100">
                <div class="row justify-content-center pt-4">
                    <div class=" Adresse">
                        <div class="form-group col-md-12">
                            <label for="inputAdresse">Address</label>
                            <input
                                class="form-control"
                                id="inputAdresse"
                                placeholder="Adresse"
                                v-model="street"
                                v-on:input="clearCoordinates()"
                            >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputVille">City</label>
                            <input
                                class="form-control"
                                id="inputVille"
                                placeholder="Ville"
                                value="grenoble"
                                v-model="city"
                                v-on:input="clearCoordinates()"
                            >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputCodePostal">Postal code</label>
                            <input
                                class="form-control"
                                id="inputCodePostal"
                                placeholder="Code postal"
                                v-model="postalCode"
                                v-on:input="clearCoordinates()"
                            >
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputlatitude">Latitude</label>
                        <input
                            type="latitude"
                            class="form-control"
                            id="inputLatitude"
                            v-model="latitude"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputLongitude">Longitude</label>
                        <input
                            type="longitude"
                            class="form-control"
                            id="inputLongitude"
                            v-model="longitude"
                        >
                    </div>

                    <div class="row mx-auto">
                        <div class="form-group col-md-12">
                            <label for="inputDate1">Date 1</label>
                            <datetime
                                v-model="date1"
                                input-id="inputDate1"
                                input-class="form-control"
                                min-datetime="2014-01-01T00:00:00.000Z"
                                max-datetime="2017-05-01T00:00:00.000Z"
                            ></datetime>
                            <!-- :format="{ year: 'numeric', month: 'numeric', day: 'numeric'}" -->
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputDate2">Date 2</label>
                            <datetime
                                v-model="date2"
                                input-id="inputDate2"
                                input-class="form-control"
                                min-datetime="2014-01-01T00:00:00.000Z"
                                max-datetime="2017-05-01T00:00:00.000Z"
                            ></datetime>
                        </div>
                    </div>

                    <div class="justify-content-center">
                        <button
                            v-on:click="sub()"
                            type="button"
                            name="button"
                            class="btn btn-dark"
                        >Search</button>
                    </div>

                    <div class="justify-content-center pl-2">
                        <button
                            v-on:click="saveThisVue()"
                            type="button"
                            name="button"
                            class="btn btn-dark"
                        >Save</button>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <button
                        v-on:click="switchImages()"
                        type="submit"
                        class="btn btn-dark"
                    >Switch images</button>
                </div>
                <br />
                <!-- affiche un choix si plusieurs résultats ont été trouvés -->
                <div
                    id="select"
                    class="row justify-content-center pl-4 pr-4 mb-3"
                    v-if="addressList[1]"
                >
                    <p>Several results have been found, select one to display :</p>
                    <select v-on:change="changeSelected($event)" class="form-control">
                        <option
                            v-for="address in addressList"
                            :latitude="address.lat"
                            :longitude="address.lon"
                        >{{ address.display_name }} ({{address.type}})</option>
                    </select>
                </div>
            </nav>

            <div class="col-md-8 col-lg-8 px-4" v-if="before">
                <div class="d-inline font-weight-bold">{{date1}}</div>
                <div class="d-inline font-weight-bold float-right">{{date2}}</div>
                <image-compare
                    class="img-fluid"
                    :before="before"
                    :after="after"
                    :padding="{ left: 1, right: 1 }"
                >
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
    import { helper } from '../imports/helper';

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
                date2: '2017-02-22T00:00:00.000Z',
                isLoading: false,
                helper,
                loadType: '',
                street: '',
                city: '',
                postalCode: '',
                addressList: [],
                latitude: '',
                longitude: '',
            }
        },

        mounted() {
            if(document.location.hash){
                this.latitude = this.GGET().lat;
                this.longitude = this.GGET().lon;
                this.date2 = this.GGET().date2;
                this.date1 = this.GGET().date1;

                this.imgCharge();
            }
        },

        methods:{
            async sub(){

                if(!this.isFormValid('search')){
                    this.$swal.fire({
                        type: 'error',
                        title: 'The form is not filled correctly.',
                    })
                } else {

                    this.isLoading = true;
                    this.loadType = "Loading...";

                    // if either the latitude or longitude is empty, search for the address
                    if (this.latitude == "" || this.longitude == ""){
                        this.addressList = [];
                        this.addressList.sort();
                        
                        await this.geocoding();
                    }

                    this.imgCharge();
                }
            },

            async imgCharge() {
                console.log(this.date1, this.date2, this.longitude, this.latitude);

                this.isLoading = true;
                this.loadType = "Loading...";

                let date1 = await this.helper.dateRefactor(this.date1);
                let date2 = await this.helper.dateRefactor(this.date2);

                document.location.hash = 'lat='+this.latitude+'&lon='+this.longitude+'&date1='+date1+'&date2='+date2;

                let img1 = await this.getImage(date1);
                let img2 = await this.getImage(date2);
                this.before = img2.url;
                this.after = img1.url;
                this.date1 = img1.date;
                this.date2 = img2.date;
                let upload1 = this.helper.storePic(this.before);
                let upload2 = this.helper.storePic(this.after);

                await upload1;
                await upload2;
                this.isLoading = false;
            },

            async getImage(date){

                try{
                    let response = await axios.get('https://api.nasa.gov/planetary/earth/imagery/' , {
                        params: {
                            lat: this.latitude,
                            lon: this.longitude,
                            date: date,
                            dim: 0.1,
                            cloud_score: 'True',
                            api_key: 'f8Bf5QWZSK50tRZOZq7BCuHCpICDTqs62MPmG9xt'
                        }

                    });

                    return response.data;
                } catch(e){
                     this.$swal.fire({
                        type: 'error',
                        title: 'Something went wrong with the NASA API.',
                        text: 'There may not be any picture for the location or one of the dates.',
                    })
                    this.isLoading = false;
                }

            },

            switchImages(){
                let img = this.before;
                this.before = this.after;
                this.after = img;

                let date = this.date1;
                this.date1 = this.date2;
                this.date2 = date;
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

            async geocoding(){ // turns an address into coordinates

                try {
                    let query = this.street+", "+this.city+", "+this.postalCode;
                    let response = await axios.get('https://nominatim.openstreetmap.org/search' , {
                        params: {
                            format: "json",
                            q: query
                        }
                    });

                    // put the address list sent by nominatim in addressList so that vuejs can display it
                    this.addressList = response.data;

                    // set latitude and longitude to that of the first address in the list
                    this.latitude = this.addressList[0].lat;
                    this.longitude = this.addressList[0].lon;
                } catch(e){
                    this.$swal.fire({
                        type: 'error',
                        title: 'Something went wrong with the OpenStreetMap API. The location may not exist.',
                    })
                    this.isLoading = false;
                }

            },

            changeSelected(event){

                this.latitude = event.srcElement.selectedOptions[0].attributes.latitude.value;
                this.longitude = event.srcElement.selectedOptions[0].attributes.longitude.value;

                this.sub();
            },

            async saveThisVue(){

                let auth = document.head.querySelector('meta[name="login-status"]').content;

                if(!this.isFormValid('save')){
                    this.$swal.fire({
                        type: 'error',
                        title: 'There is no pictures to save.',
                    })
                } else if (auth === "") {
                     this.$swal.fire({
                        type: 'error',
                        title: 'You have to be logged to save a comparison.',
                    })
                } else {

                    if (this.before != '' && this.after != ''){

                        try {
                            let form =  await this.$swal.mixin({
                                    input: 'text',
                                    confirmButtonText: 'Next &rarr;',
                                    showCancelButton: true,
                                    progressSteps: ['1', '2']
                                }).queue([
                                    {
                                        title: 'Give a title for the comparison',
                                    },
                                    'Give a description for the comparison'
                                ]).then( async (result) => {
                                if (result.value[0] != "" && result.value[1] != "") {
                                    this.isLoading = true;
                                    this.loadType = "Saving...";

                                    let question = await axios.post('/save' , {
                                        params: {
                                            file1: this.before,
                                            file2: this.after,
                                            titre: result.value[0],
                                            description: result.value[1],
                                            date1: this.GGET().date1,
                                            date2: this.GGET().date2
                                        }
                                    })

                                    this.isLoading = false;

                                    this.$swal.fire({
                                        position: 'top-end',
                                        type: 'success',
                                        title: 'Your comparison was successfully saved',
                                        showConfirmButton: false,
                                        timer: 2500
                                    })
                                } else {
                                     this.$swal.fire({
                                        type: 'error',
                                        title: 'You have to put a title and a description.',
                                    })
                                }
                            })

                            return true;

                        } catch(e){
                            this.isLoading = false;
                            this.$swal.fire({
                                position: 'top-end',
                                type: 'error',
                                title: 'Something went wrong',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    }
                }

            },

            isFormValid(mode){

                if (mode === "search"){
                    if ((this.latitude != '' && this.latitude >= -90 && this.latitude <= 90 && this.longitude != '' && this.longitude >= -180 && this.latitude <= 180) && (this.date1 != '' && this.date2 != '')){
                        return true;
                    }

                    if ((this.street != '' || this.city != '' || this.postalCode != '') && (this.date1 != '' && this.date2 != '')){
                        return true;
                    }
                }

                if (mode === "save"){
                    if(this.before != "" && this.after != ""){
                        return true;
                    }
                }

                return false;
            }            
        },
        
        computed: {
            clearCoordinates(){
                this.latitude = '';
                this.longitude = '';
            }
        }
    }
</script>

<style>

</style>
