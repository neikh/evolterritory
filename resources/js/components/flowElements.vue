<template>
    <div class="ml-3">
        <div id="my-card" class="card text-center">
            <div>
                <div id="date1" class="d-inline font-weight-bold text-left pr-5"> {{ this.date1[0] }}</div>
                <div id="date2" class="d-inline font-weight-bold text-right"> {{ this.date2[0] }} </div>
                <image-compare :before="before" :after="after" :padding="{ left: 1, right: 1 }">
                    <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
                    <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
                </image-compare>
            </div>
            <div class="card-body" id="card">
            <h5 class="card-title"> {{ item.titre }} </h5>
            {{ item.description }}
            </div>
            <div class="card-footer text-muted">
                <div class="row">
                    <div class="col">
                        {{voteSun}}
                        <button type="radio" name="button" v-bind:class="{ vote: sunActive }" class="btn btn-outline-secondary" v-on:click="voteClick('sun')"><i class="far fa-sun"></i></button>

                        <button type="radio" name="button" v-bind:class="{ vote: cloudActive }" class="btn btn-outline-secondary" v-on:click="voteClick('cloud')"><i class="fas fa-cloud"></i></button>
                        {{voteCloud}}
                    </div>
                    <!-- <div class="col">
                    <a href="tel:+123456789"><i class="fas fa-phone"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { booleanLiteral } from '@babel/types';
  export default {
    props: ['item'],
     data () {
        return {
            before: 'storage/'+this.item.id_pic_1,
            after: 'storage/'+this.item.id_pic_2,
            date1: '',
            date2: '',
            voteSun: this.item.sun_vote,
            voteCloud: this.item.cloud_vote,
            sunActive: parseInt(this.item.sun),
            cloudActive: parseInt(this.item.cloud),
            id: this.item.id,
            isVoting: false
        }
    },
    mounted(){
        this.date2 = this.item.date2.split('T')
        this.date1 = this.item.date1.split('T')
    },
    methods: {
        async voteClick(vote){

            if (this.isVoting === false){
                let auth = document.head.querySelector('meta[name="login-status"]').content;

                if (auth === "") {
                    this.$swal.fire({
                        type: 'error',
                        title: 'You have to be logged to vote for a comparison.',
                    })
                } else {

                    if(vote === 'sun'){
                        if(this.cloudActive){
                            this.cloudActive = !this.cloudActive;
                        }
                        this.sunActive = !this.sunActive;

                    }

                    if(vote === 'cloud'){
                        if(this.sunActive){
                            this.sunActive = !this.sunActive;
                        }
                        this.cloudActive = !this.cloudActive;
                    }

                    this.isVoting = true;
                    let response = await axios.post('/flow/vote' , {
                        params: {
                            id: this.id,
                            sun: this.sunActive,
                            cloud: this.cloudActive
                        }
                    });

                    this.voteSun = response.data[0];
                    this.voteCloud = response.data[1];
                    this.isVoting = false;
                }

            }
        }
    }
  }
</script>
<style>
    .fa-sun{
        font-size: 20px;
    }
    .vote{
        color: orange;
    }
    #my-card{
        height: 500px;
    }
</style>
