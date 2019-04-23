<template>
    <div>
        <b-tabs content-class="mt-3" justified>
            <b-tab title="New" active><p>I'm the first tab</p></b-tab>
            <b-tab title="Hot"><p>I'm the second tab</p></b-tab>
        </b-tabs>
        <div class='item' v-for="item in response.data">
            <flowItem :titre="titre" :description="description" ></flowItem>
        </div>
    </div>
</template>

<script>
    import flowItem from '../components/flowElements';
    export default {
       item: null,
        components: {
           flowItem
        },

        data () {
            return {
               response: '',
               titre: '',
               description: ''
            }
        },

        async mounted() {
             this.response = await axios.get('flow/new')
             this.item = response.data;
        }
    }
</script>
<style>
.item{
    min-width: 300px;
}
</style>
