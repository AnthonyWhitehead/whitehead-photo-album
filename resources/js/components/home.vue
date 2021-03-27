<template>
    <div>
        <div v-if="photos" class="md-layout md-gutter md-alignment-center">
            <div v-for="photo in photos" :key="photo.id" class="md-layout-item md-small-size-100">
                <md-card>
                    <md-card-media>
                        <img :src="photo.url" alt="photo.title">
                    </md-card-media>

                    <md-card-header>
                        <div class="md-title">{{photo.title}}</div>
                        <div class="md-subhead">Description</div>
                    </md-card-header>
                </md-card>
            </div>


        </div>


    </div>
</template>
<script>

export default {
    computed: {},
    data: function () {
        return {
            photos: []
        }
    },
    mounted: function () {
        axios.get('/api/photos')
            .then(result => {

                this.photos = result.data.data;
            }).catch(err => console.log(err))
    }

};
</script>
<style lang="scss" scoped>

</style>
