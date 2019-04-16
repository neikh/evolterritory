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
                <input type="latitude" class="form-control" id="latitude" placeholder="Latitude">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLongitude">Longitude</label>
                <input type="longitude" class="form-control" id="inputLongitude" placeholder="Longitude">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDate1">Date 1</label>
                <input type="date" class="form-control" id="inputDate1">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDate2">Date 2</label>
                <input type="date" class="form-control" id="inputDate1">
            </div>
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

        }
     }
</script>
