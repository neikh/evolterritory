<template>
    <div>
        <div v-for="item in response.data">
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
/* .card{
    min-width: 300px;
} */
</style>
