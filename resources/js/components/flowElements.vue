<template>
<div class=" container d-flex">
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                {{ item.titre }}
            </div>
            <div class="card-body">
                <div class="col-md-8 col-lg-8 px-4">
                    <div id="date1" class="d-inline font-weight-bold"> {{ this.date1[0] }}</div>
                    <div id="date2" class="d-inline font-weight-bold"> {{ this.date2[0] }} </div>
                    <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 1, right: 1 }">
                        <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
                        <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
                    </image-compare>
                </div>
            </div>
            <div class="card-footer">
                {{ item.description }}
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
        console.log(date1[0]);
    }
  }
</script>
<style>
.container{
    min-width: 300px;
}
</style>
