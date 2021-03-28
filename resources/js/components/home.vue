<template>
    <div>
        <div v-if="photos" class="md-layout md-gutter md-alignment-start">
            <div v-for="photo in photos" :key="photo.id" class="md-layout-item md-medium-size-25 md-small-size-100">
                <md-card>
                    <md-card-media>
                        <img :src="photo.url" alt="photo.title">
                    </md-card-media>

                    <md-card-header>
                        <div class="md-title">{{ photo.title }}</div>
                        <div class="md-subhead">Description</div>
                    </md-card-header>
                </md-card>
            </div>


        </div>


    </div>
</template>
<script>
import {mapGetters} from 'vuex'

export default {
    data: function () {
        return {
            photos: []
        }
    },

    computed: {
        ...mapGetters([
            'filters'
        ])
    },
    watch: {
        filters(newVal){
            this.getPhotos()
        },
    },
    methods: {
        getPhotos() {

            const filters = this.filters.length ? this.filters.join() : null;

            axios.get('/api/photos', {
                params: {
                    filters: filters
                }
            })
                .then(result => {
                    this.photos = result.data.data;
                }).catch(err => console.log(err))
        }
    },
    mounted: function () {
        this.getPhotos()
    }

};
</script>
<style lang="scss" scoped>

</style>
