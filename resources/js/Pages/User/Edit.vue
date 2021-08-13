<template>
  <div>
       <div class="container my-5">
          <div class="row justify-content-center">
            <div class="card col-6">
                <h1 class="my-4">Edit User</h1>
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
    name:'Edit',
    props:['user','errors'],
    components:{
        Link,UserForm,
    },
    methods: {
        submit(form) {
            this.$inertia.put(`/user/${this.user.id}/update`,form);
        }
    }


}
</script>

<style>

</style>
