<template>
    <div>
        <template>
            <div>
                <form novalidate class="md-layout md-alignment-center" @submit.prevent="upload">
                    <md-card class="md-layout-item md-size-50 md-small-size-100">
                        <md-card-header>
                            <div class="md-title">Upload photo</div>
                        </md-card-header>

                        <md-card-content>
                            <div class="md-layout md-gutter">
                                <div class="md-layout-item md-small-size-100">
                                    <md-field>
                                        <label>Photo</label>
                                        <md-file placeholder="photo" v-model="photo.name"
                                                 @md-change="onFileUpload($event)"/>
                                    </md-field>
                                </div>


                            </div>

                            <div class="md-layout md-gutter">
                                <div class="md-layout-item md-small-size-100">
                                    <md-field>
                                        <label for="title">Title</label>
                                        <md-input name="title" id="title" v-model="title" :disabled="sending"/>
                                        <!--                                        <span class="md-error" v-if="!$v.form.lastName.required">The last name is required</span>-->
                                        <!--                                        <span class="md-error" v-else-if="!$v.form.lastName.minlength">Invalid last name</span>-->
                                    </md-field>
                                </div>
                            </div>
                            <div class="md-layout md-gutter">
                                <div class="md-layout-item md-small-size-100">
                                    <md-field>
                                        <label for="title">Description</label>
                                        <md-input name="description" id="description" v-model="description"
                                                  :disabled="sending"/>
                                        <!--                                        <span class="md-error" v-if="!$v.form.lastName.required">The last name is required</span>-->
                                        <!--                                        <span class="md-error" v-else-if="!$v.form.lastName.minlength">Invalid last name</span>-->
                                    </md-field>
                                </div>
                            </div>
                            <div class="md-layout md-gutter">

                                <div class="md-layout-item md-small-size-100">


                                    <md-checkbox v-for="tag in tags" :key="tag.id" v-model="selectedTags"
                                                 :value="tag.id">{{ tag.name }}
                                    </md-checkbox>
                                </div>
                            </div>

                            <!--&lt;!&ndash;                            <div class="md-layout md-gutter">&ndash;&gt;-->
                            <!--&lt;!&ndash;                                <div class="md-layout-item md-small-size-100">&ndash;&gt;-->
                            <!--&lt;!&ndash;                                    <md-field :class="getValidationClass('gender')">&ndash;&gt;-->
                            <!--&lt;!&ndash;                                        <label for="gender">Gender</label>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                        <md-select name="gender" id="gender" v-model="form.gender" md-dense :disabled="sending">&ndash;&gt;-->
                            <!--&lt;!&ndash;                                            <md-option></md-option>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                            <md-option value="M">M</md-option>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                            <md-option value="F">F</md-option>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                        </md-select>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                        <span class="md-error">The gender is required</span>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                    </md-field>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                </div>&ndash;&gt;-->

                            <!--&lt;!&ndash;                                <div class="md-layout-item md-small-size-100">&ndash;&gt;-->
                            <!--&lt;!&ndash;                                    <md-field :class="getValidationClass('age')">&ndash;&gt;-->
                            <!--&lt;!&ndash;                                        <label for="age">Age</label>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                        <md-input type="number" id="age" name="age" autocomplete="age" v-model="form.age" :disabled="sending" />&ndash;&gt;-->
                            <!--&lt;!&ndash;                                        <span class="md-error" v-if="!$v.form.age.required">The age is required</span>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                        <span class="md-error" v-else-if="!$v.form.age.maxlength">Invalid age</span>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                    </md-field>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                </div>&ndash;&gt;-->
                            <!--&lt;!&ndash;                            </div>&ndash;&gt;-->

                            <!--&lt;!&ndash;                            <md-field :class="getValidationClass('email')">&ndash;&gt;-->
                            <!--&lt;!&ndash;                                <label for="email">Email</label>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                <md-input type="email" name="email" id="email" autocomplete="email" v-model="form.email" :disabled="sending" />&ndash;&gt;-->
                            <!--&lt;!&ndash;                                <span class="md-error" v-if="!$v.form.email.required">The email is required</span>&ndash;&gt;-->
                            <!--&lt;!&ndash;                                <span class="md-error" v-else-if="!$v.form.email.email">Invalid email</span>&ndash;&gt;-->
                            <!--&lt;!&ndash;                            </md-field>&ndash;&gt;-->
                        </md-card-content>

                        <!--                        <md-progress-bar md-mode="indeterminate" v-if="sending" />-->

                        <md-card-actions>
                            <md-button type="submit" class="md-primary">Submit</md-button>
                        </md-card-actions>
                    </md-card>

                    <!--                    <md-snackbar :md-active.sync="userSaved">The user {{ lastUser }} was saved with success!</md-snackbar>-->
                </form>
            </div>
        </template>

    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "upload.vue",
    data: () => ({
        photo: {
            name: '',
            file: null
        },
        title: '',
        description: '',
        sending: false,
        selectedTags: []
    }),
    computed: {
        ...mapGetters([
            'tags'
        ]),
    },
    methods: {
        onFileUpload(e) {
            debugger
            this.photo.file = e[0];
        },
        updateSelectedTags(tag) {
            this.selectedTags[tag].selected = !this.selectedTags[tag].selected;
        },
        upload() {

            let formData = new FormData();
            formData.append('photo', this.photo.file);
            formData.append('title', this.title);
            formData.append('description', this.description);
            formData.append('tags', this.selectedTags);


            axios
                .post('/api/photos', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(result => {
                console.log(result)
            }).catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>

</style>
