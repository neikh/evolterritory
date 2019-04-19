<template>
    <div class="container">
        <div id="loading" class="fixed-top d-none">
            <vue-loader direction="top-right" image="https://loading.io/spinners/coolors/lg.palette-rotating-ring-loader.gif" text="Loading..." text-color="#786fa6" :background="'#ea8685'" />
        </div>
        <h1 id="title"></h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="date1" class="d-inline font-weight-bold">2014-08-01</div>
                <div id="date2" class="d-inline font-weight-bold float-right">2016-08-01</div>
                <div class="card">
                    <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 0, right: 0 }">
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
                before: '',
                after: ''
            }
        },
        methods:{

            async randomName(){
                let city = ['Grenoble', 'Paris', 'Lyon', 'Bordeaux', 'Nice', 'Caen', 'Rouen', 'Lille', 'Lyon', 'Marseille', 'Nice', 'Toulouse', 'Evreux', 'Narbonne', 'Brest', 'Le Havre', 'Rennes', 'Lens', 'Dunkerque', 'Strasbourg', 'Mulhouse', 'Tarbes', 'Perpignan', 'Montpellier', 'Tokyo', 'Kawasaki', 'Nagoya', 'Kyoto', 'Nagano', 'Shizuoka', 'Fukushima', 'Sapporo', 'Fukuoka', 'Hiroshima', 'Nagasaki'];
                return city[Math.floor(Math.random() * Math.floor(city.length))];
            },

            async geocoding(location){ // turns an address into coordinates
                let response = await axios.get('https://nominatim.openstreetmap.org/search' , {
                    params: {
                        format: "json",
                        q: location
                    }
                });

               return [response.data[0].lat, response.data[0].lon];
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
                });

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
        },

        async mounted() {
            document.getElementById('loading').classList.remove("d-none");

            let city = await this.randomName();

            document.getElementById('title').textContent = 'Today, let\'s discover the city of '+city;

            let coordinates = await this.geocoding(city);

            let img1 = this.getImage(coordinates[0], coordinates[1], '2014-08-01');
            let img2 = this.getImage(coordinates[0], coordinates[1], '2016-08-01');

            this.before = await img1;
            this.after = await img2;

            let upload1 = this.storePic(this.before);
            let upload2 = this.storePic(this.after);

            await upload1;
            await upload2;

            document.getElementById('loading').classList.add("d-none");
        }
    }
</script>
