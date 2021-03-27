<template>
    <div v-if="photo">
        <img :src="photo.url" alt="">
    </div>
</template>

<script>
export default {
    name: "photo",
    data: function() {
        return {
          photo: {}
        }
    },
    mounted: function(){
        axios.get('/api/photos/1')
        .then(result => {

            this.photo = result.data.data;
        }).catch(err => console.log(err))
    }
}
</script>

<style scoped>

</style>
