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
            <b-tab title="Hot" active>
                <div class="container d-flex">


                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
aaaaaa
                        </div>
                        <div class="card-body">
aaaa
                        </div>
                        <div class="card-footer">
aaaaaaa
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
aaaaaa
                        </div>
                        <div class="card-body">
aaaa
                        </div>
                        <div class="card-footer">
aaaaaaa
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
aaaaaa
                        </div>
                        <div class="card-body">
aaaa
                        </div>
                        <div class="card-footer">
aaaaaaa
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
aaaaaa
                        </div>
                        <div class="card-body">
aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                        </div>
                        <div class="card-footer">
aaaaaaa
                        </div>
                    </div>

                </div>
                </div>
            </b-tab>
            <b-tab title="New">

            </b-tab>
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
<style>
.card{
    /* min-height: 200px; */
    min-width: 300px;
}
</style>
