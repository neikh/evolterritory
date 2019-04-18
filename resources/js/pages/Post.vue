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
                    <div class="form-group col-md-6">
                        <label for="inputDate1">Date 1</label>
                        <input type="date" class="form-control" id="inputDate1" value="2016-02-01">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputDate2">Date 2</label>
                        <input type="date" class="form-control" id="inputDate2" value="2015-02-01">
                    </div>
                    <button v-on:click="sub()" type="button" name="button" class="btn btn-dark">Chercher</button>
                </div>
                <br>
                <div class="row justify-content-center">
                    <button v-on:click="switchImages()" type="button" class="btn btn-dark">Switch images</button>
                </div>
            </nav>
            <div class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 50, right: 50 }">
                    <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
                    <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
                </image-compare>
            </div>
        </div>
    </div>
</template>

<script>
    import vueLoader from '@nulldreams/vue-loading/src/vue-loading'
    export default {
        components: {
            vueLoader
        },
        data () {
            return {
                before: './img/before.jpg',
                after: './img/after.jpg'
            }
        },
        mounted() {

        },

        methods:{
            async sub(){

                document.getElementById('loading').classList.remove("d-none");

                let latitude = document.getElementById('inputLatitude').value;
                let longitude = document.getElementById('inputLongitude').value;

                let date1 = document.getElementById('inputDate1').value;
                let img1 = this.getImage(latitude, longitude, date1);

                let date2 = document.getElementById('inputDate2').value;
                let img2 = this.getImage(latitude, longitude, date2);

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
                })

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
            }
        }
     }
</script>
