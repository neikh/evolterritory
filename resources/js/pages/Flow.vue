<template>
    <div>
        <b-tabs content-class="mt-3" justified>
            <b-tab title="New" active><p>I'm the first tab</p></b-tab>
            <b-tab title="Hot"><p>I'm the second tab</p></b-tab>
        </b-tabs>
        <ul id="example-1">
            <li v-for="item in response.data">
                {{ item }}
            </li>
        </ul>
    </div>
</template>

<script>
    import flowItem from '../components/flowElements';
    export default {
        components: {
           flowItem
        },

        data () {
            return {
               response: ''
            }
        },

        async mounted() {
             const response = await axios.get('flow/new')
             console.log(response.data);
        }
    }
</script>
