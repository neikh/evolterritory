<template>
    <div id="post-container" class="w-75 border mx-auto">
        <div id="single-left" class="border mx-auto col-5 custom-control-inline">
            left
        </div>
        <div id="single-right" class="border mx-auto col-5 custom-control-inline">
            right
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

