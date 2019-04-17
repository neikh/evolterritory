<template>
    <div class="container">
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
    export default {
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
        mounted() {
           this.apod();
           this.randomPic();
        }
    }
</script>
