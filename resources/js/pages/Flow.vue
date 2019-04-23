<template>
    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 row">
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline">
                        <button class="btn btn-outline-success" type="button">Hot</button>
                        <button class="btn btn-outline-success" type="button">New</button>
                    </form>
                </nav>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="col-md-12">
                        <div class="card">
                            <img class="img-fluid" src="https://apod.nasa.gov/apod/image/1904/JupiterDolphin_JunoEichstadt_1080.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div>
        <b-tabs content-class="mt-3" justified>
            <b-tab title="First" active><p>I'm the first tab</p></b-tab>
            <b-tab title="Second"><p>I'm the second tab</p></b-tab>
        </b-tabs>
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
