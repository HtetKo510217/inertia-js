<template>
  <div>
      <div class="container my-5">
          <div class="row justify-content-center">
            <div class="card col-6">
                <h1 class="my-4">Create User</h1>
                <div class="card-body">
                    <div class="row">
                        <UserForm :user="user" :errors="errors" @submit="submit"></UserForm>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
import UserForm from '../User/UserForm.vue'
export default {
    name:'Create',
    components:{
        Link,UserForm
    },
    props: ['user','errors'],

    methods: {
        submit(form) {
            this.$inertia.post('/user/store',form);
        }
    }
}
</script>

<style>

</style>
