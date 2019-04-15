<template>
<<<<<<< HEAD
    <div class="container">
        <!-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component Post</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row justify-content-center">
            <div class="form-group col-md-12">
                <label for="inputAdresse">Adresse</label>
                <input class="form-control" id="inputAdresse" placeholder="Adresse">
            </div>
            <div class="form-group col-md-6">
                <label for="inputlatitude">Latitude</label>
                <input type="latitude" class="form-control" id="latitude" placeholder="Latitude">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLongitude">Longitude</label>
                <input type="longitude" class="form-control" id="inputLongitude" placeholder="Longitude">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLongitude">Longitude</label>
                <input type="date" class="form-control" id="inputLongitude" placeholder="Longitude">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }

    //     methods: {
    //         showpic (){
    //             axios.get('https://api.nasa.gov/planetary/earth/imagery?lon=100.75&lat=1.5&date=2014-02-01&cloud_score=True&api_key=E1aIhD19fZTNdDXovZqz8Hfpig4Y99J6yFYhgrpl')
    //                     .then(response => {
    //                         console.log(response.data);
    //                 })
    //         }
    //     },

    //     created(){
    //         document.getElementById("test").addEventListener('click', () => {
    //             this.showPic();
    //         });
    //     }
     }
</script>

