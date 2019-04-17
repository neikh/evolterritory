<template>
    <div class="container">
        <div id="loading" class="fixed-top d-none">
            <vue-loader direction="top-right" image="https://loading.io/spinners/coolors/lg.palette-rotating-ring-loader.gif" text="Chargement..." text-color="#786fa6" :background="'#ea8685'" />
        </div>
        <h1>Bienvenue</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 50, right: 50 }">
                        <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
                        <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
                    </image-compare>
                </div>
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
        methods:{
            async apod(){

                let response = await axios.get('https://api.nasa.gov/planetary/apod' , {
                    params: {
                        api_key: 'f8Bf5QWZSK50tRZOZq7BCuHCpICDTqs62MPmG9xt'
                    }
                })

                this.after = await response.data.hdurl;
            },

            async randomPic(){
                let response = await axios.get('/grab');
                this.before = await response.data;
            }
        },
        async mounted() {
           document.getElementById('loading').classList.remove("d-none");

           this.apod();
           await this.randomPic();

           document.getElementById('loading').classList.add("d-none");
        }
    }
</script>
