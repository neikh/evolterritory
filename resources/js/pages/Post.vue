<template>
    <div class="container">

        <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 50, right: 50 }">
            <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
            <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
        </image-compare>

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
            <button v-on:click="sub()" type="button" name="button">aaa</button>
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
                console.log(document.getElementById('inputLatitude').value);
                console.log(document.getElementById('inputLongitude').value);
                let latitude = document.getElementById('inputLatitude').value;
                let longitude = document.getElementById('inputLongitude').value;

                let date1 = document.getElementById('inputDate1').value;
                let img1 = await this.getImage(latitude, longitude, date1);
                let date2 = document.getElementById('inputDate2').value;
                let img2 = await this.getImage(latitude, longitude, date2);
                this.before = img1;
                this.after = img2;
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
            }
        }
        //https://api.nasa.gov/planetary/earth/imagery/?lon=5.7357819&lat=45.1875602&date=2019-02-01&cloud_score=True&api_key=f8Bf5QWZSK50tRZOZq7BCuHCpICDTqs62MPmG9xt
     }
</script>
