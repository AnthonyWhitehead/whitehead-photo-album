<template>
    <div class="page-container md-layout-column">
        <md-toolbar class="md-primary">
            <md-button class="md-icon-button" @click="showNavigation = true">
                <md-icon>menu</md-icon>
            </md-button>
            <span class="md-title">Whitehead Family Photos</span>

            <div class="md-toolbar-section-end">
                <md-button @click="showSidepanel = true">Favorites</md-button>
            </div>
        </md-toolbar>

        <md-drawer :md-active.sync="showNavigation" md-swipeable>
            <md-toolbar class="md-transparent" md-elevation="0">
                <span class="md-title">Whitehead Family Photos</span>
            </md-toolbar>

            <md-list>
                <md-list-item>
                    <md-icon>upload</md-icon>
                    <span class="md-list-item-text">Upload</span>
                </md-list-item>

            </md-list>

            <md-toolbar class="md-transparent" md-elevation="0">
                <span class="md-title">Filter photos</span>
            </md-toolbar>
                    <md-list v-if="tags">
                        <md-list-item md-expand>
                            <md-icon>users</md-icon>
                            <span class="md-list-item-text">People</span>

                            <md-list slot="md-expand">
                                <md-list-item class="md-inset" v-for="tag in tags">

                                    <md-checkbox  v-model="filters" :value="tag.id">
                                        {{tag.name}}
                                    </md-checkbox>
                                </md-list-item>
                            </md-list>
                        </md-list-item>
                    </md-list>

            <md-button class="md-primary" @click="handleFilters">Apply Filters</md-button>


        </md-drawer>

        <md-content>
            <router-view></router-view>
        </md-content>
    </div>

</template>

<script>
export default {
    name: 'app',
    data: () => ({
        showNavigation: false,
        showSidepanel: false,
        expandSingle: false,
        expandNews: false,
        tags: [],
        filters: [],

    }),
    methods: {
      handleFilters() {
        this.$store.dispatch('addFilters', this.filters)
      }
    },
    mounted() {
        axios
            .get('/api/tags')
            .then(result => {
                this.tags = result.data
            })
            .catch(err => console.log(err))
    }
}
</script>

<style lang="scss" scoped>
.page-container {
    min-height: 100vh;
    overflow: hidden;
    position: relative;
}

// Demo purposes only
.md-drawer {
    width: 230px;
}

.md-content {
    padding: 2rem;
}
</style>
