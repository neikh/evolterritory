<template>
    <div>
        <b-tabs content-class="mt-3" justified>
            <b-tab title="New" active>
                 <div class="container-fluid">
                    <div class="row flex-center">
                        <div class='item' v-for="item in items">
                            <flowItem :item="item" ></flowItem>
                        </div>
                    </div>
                </div>
            </b-tab>
            <b-tab title="Hot"><p>I'm the second tab</p></b-tab>
        </b-tabs>

    </div>
</template>

<script>
    import flowItem from '../components/flowElements';
    export default {
       items: null,
        components: {
           flowItem
        },

        data () {
            return {
               items: [],
               titre: '',
               description: '',
               response: ''
            }
        },

        async mounted() {
             this.response = await axios.get('flow/new/p=0')
             this.items = this.response.data;
        },

        methods: {
            refreshItems(){
                axios.get('flow/new/p='+this.items.length)
                .then(response => {
                   console.log(response.data);
                   this.items = this.items.concat(response.data);
                })
            }
        },

        created(){
        let isLoading = false;
        let countObject = this.items.length;
        window.onscroll = (ev) => {

            if (countObject != this.items.length){
                countObject = this.items.length;
                isLoading = false;
            }

            if (!isLoading){
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight -200) {
                    isLoading = true;
                    this.refreshItems();
                }
            }
        };
      }
    }
</script>
<style>
.item{
    width: 300px;
    margin-top: 10px;
}
.flex-center{
    align-items: center;
    justify-content: center;
}
</style>
