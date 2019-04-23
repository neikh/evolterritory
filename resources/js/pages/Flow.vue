<template>
    <div>
        <b-tabs content-class="mt-3" justified>
            <b-tab title="New" active><p>I'm the first tab</p></b-tab>
            <b-tab title="Hot"><p>I'm the second tab</p></b-tab>
        </b-tabs>
        <div class='item' v-for="item in items">
            <flowItem :item="item" ></flowItem>
        </div>
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
             this.response = await axios.get('flow/new')
             this.items = this.response.data;
             console.log(this.items);
        },
    }
</script>
<style>
.item{
    min-width: 300px;
}
</style>
