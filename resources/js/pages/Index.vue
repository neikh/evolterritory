<template>
    <div class="container">
        <h1>Bienvenue</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <survey-component :picture="'{!! json_decode($picture) !!}'"></survey-component>
                    <img class="img-fluid" src='{!! json_decode($picture) !!}'/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['picture'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
