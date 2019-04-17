<template>
    <div class="container">
        <h1>Bienvenue</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    a{{randomPic}}a
                   <!-- <image-compare class="img-fluid" :before="before" :after="after" :padding="{ left: 50, right: 50 }">
                        <i class="fa fa-angle-left" aria-hidden="true" slot="icon-left"></i>
                        <i class="fa fa-angle-right" aria-hidden="true" slot="icon-right"></i>
                    </image-compare> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['randomPic'],
        mounted() {
            console.log(this)
        }
    }
</script>
