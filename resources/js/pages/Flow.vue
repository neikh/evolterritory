<template>
    <div>
        <b-tabs content-class="mt-3" justified>
            <b-tab title="Newest Comparison" v-bind:class="{'active': isNewActive }" v-on:click="loadItems('new')">
                 <div class="container-fluid">
                    <div class="row flex-center">
                        <div class='item' v-for="item in items">
                            <flowItem :item="item" ></flowItem>
                        </div>
                    </div>
                </div>
            </b-tab>
            <b-tab title="Most popular comparison" v-bind:class="{'active': isHotActive }" v-on:click="loadItems('hot')">
                <div class="container-fluid">
                    <div class="row flex-center">
                        <div class='item' v-for="item in items">
                            <flowItem :item="item" ></flowItem>
                        </div>
                    </div>
                </div>
            </b-tab>
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
               response: '',
               isNewActive: true,
               isHotActive: false,
               isLoading: false,
               stillMoreItems: true
            }
        },

        async mounted() {
             this.response = await axios.get('flow/new/p=0')
             this.items = this.response.data;
             console.log();
        },

        methods: {
            async loadItems(type){
                if ((type !== 'new' && this.isNewActive === true) || (type !== 'hot' && this.isHotActive === true)){
                    this.items = [];
                    this.stillMoreItems = true;
                }

                let response = await axios.get('flow/'+type+'/p='+this.items.length);

                console.log(response.data);
                if ((type === 'new' && this.isNewActive === true) || (type === 'hot' && this.isHotActive === true)){
                    this.items = this.items.concat(response.data);
                } else {
                    this.items = response.data;
                    this.isNewActive = !this.isNewActive;
                    this.isHotActive = !this.isHotActive;
                }

                if (response.data.length === 0){
                    this.stillMoreItems = false;
                } else {
                    this.isLoading = false;
                }

            }
        },

        created(){

        window.onscroll = (ev) => {

            if (!this.isLoading && this.stillMoreItems){
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight -200) {
                    this.isLoading = true;
                    if (this.isHotActive === true){
                        this.loadItems('hot');
                    } else {
                        this.loadItems('new');
                    }
                }
            }
        };
      }
    }
</script>
<style>
.item{
    box-sizing: border-box;
    width: 300px;
    margin-top: 10px;
}
.flex-center{
    align-items: center;
    justify-content: center;
}
.nav-tabs .nav-link.active {
    border-top: 1px solid black;
    border-left: 1px solid black;
    border-right: 1px solid black;
    color: #000000;
    background-color: transparent;
    font-weight: bold;
}
.nav-tabs .nav-link {
    border-bottom: 1px solid black;
}
.nav-tabs .nav-link:hover{
    border-bottom: 1px solid black;
    background-color: #dde5ec;
}
</style>
