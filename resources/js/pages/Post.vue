<template>
    <div class="container">

        <div class="row justify-content-center">
            <button v-on:click="switchImages()" type="button">Switch images</button>
        </div>

        <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 50, right: 50 }">
            <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
            <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
        </image-compare>

        <div class="row justify-content-center">
            <button v-on:click="switchImages()" type="button">Switch images</button>
        </div>

        <div class="row justify-content-center">
            <div class="form-group col-md-12">
                <label for="inputAdresse">Adresse</label>
                <input class="form-control" id="inputAdresse" placeholder="Adresse">
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
            <button v-on:click="sub()" type="button" name="button">Chercher</button>
        </div>
    </div>
</template>

<script>
    export default {
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

                let latitude = document.getElementById('inputLatitude').value;
                let longitude = document.getElementById('inputLongitude').value;

                let date1 = document.getElementById('inputDate1').value;
                let img1 = this.getImage(latitude, longitude, date1);
                let date2 = document.getElementById('inputDate2').value;
                let img2 = this.getImage(latitude, longitude, date2);
                this.before = await img1;
                this.after = await img2;
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

                console.log(response.data.url);
                return response.data.url;
            },

            switchImages(){
                let img = this.before;
                this.before = this.after;
                this.after = img;
            }
        }
     }
</script>
