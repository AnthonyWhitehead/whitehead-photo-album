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

                <!--                <md-list-item>-->
                <!--                    <md-icon>send</md-icon>-->
                <!--                    <span class="md-list-item-text">Sent Mail</span>-->
                <!--                </md-list-item>-->

                <!--                <md-list-item>-->
                <!--                    <md-icon>delete</md-icon>-->
                <!--                    <span class="md-list-item-text">Trash</span>-->
                <!--                </md-list-item>-->

                <!--                <md-list-item>-->
                <!--                    <md-icon>error</md-icon>-->
                <!--                    <span class="md-list-item-text">Spam</span>-->
                <!--                </md-list-item>-->
            </md-list>

            <md-toolbar class="md-transparent" md-elevation="0">
                <span class="md-title">Filter photos</span>
            </md-toolbar>
                    <md-list :md-expand-single="expandSingle" v-if="categories">
                        <md-list-item md-expand v-for="cat in categories" :key="cat.id">
                            <md-icon>users</md-icon>
                            <span class="md-list-item-text">{{cat.name}}</span>

                            <md-list slot="md-expand">
                                <md-list-item class="md-inset" v-for="tag in cat.tags" :key="tag.id">

                                    <md-checkbox v-model="tags" :value="tag.id">
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
        categories: [],
        tags: []
    }),
    methods: {
      handleFilters() {
          axios
              .get('/api/photos', {
                  params: {
                      filters: this.tags
                  }
              })
              .then(result => {
                  this.categories = result.data
              })
              .catch(err => console.log(err))
      }
    },
    mounted() {
        axios
            .get('/api/categories')
            .then(result => {
                this.categories = result.data
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
