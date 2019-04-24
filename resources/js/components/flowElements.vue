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
                    <a href=""><i class="fas fa-map"></i></a>
                    </div>
                    <div class="col">
                    <a href="mailto:test@test.com"><i class="fas fa-envelope"></i></a>
                    </div>
                    <div class="col">
                    <a href="tel:+123456789"><i class="fas fa-phone"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  export default {
    props: ['item'],
     data () {
        return {
            before: 'storage/'+this.item.id_pic_2,
            after: 'storage/'+this.item.id_pic_1,
            date1:'',
            date2:''
        }
    },
    mounted(){
        // date1 = this.item.date1
        this.date2 = this.item.date2.split('T')
        this.date1 = this.item.date1.split('T')
    }
  }
</script>
<style>
#my-card{
    height: 500px;
}
</style>

