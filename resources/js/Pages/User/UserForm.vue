<template>
  <div>
    <form class="col-12" @submit.prevent="submit">
      <div class="form-group">
        <label for="">Name</label>
        <input
          :class="{ 'is-invalid': errors.name }"
          v-model="form.name"
          class="form-control"
          type="text"
        />
        <p class="invalid-feedback">{{ errors.name }}</p>
      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input
          :class="{ 'is-invalid': errors.email }"
          v-model="form.email"
          class="form-control"
          type="email"
        />
        <p class="invalid-feedback">{{ errors.email }}</p>
      </div>
      <div class="form-group">
        <label for="">Password</label>
        <input
          :class="{ 'is-invalid': errors.password }"
          v-model="form.password"
          class="form-control"
          type="password"
        />
        <p class="invalid-feedback">{{ errors.password }}</p>
      </div>
      <Link class="btn btn-outline-info mr-3" href="/user">Back</Link>
      <button type="submit" class="btn btn-outline-info">Update</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "UserForm",
  props:['user','errors'],
   data() {
        return {
            form: {
                name:this.user.name,
                email:this.user.email,
            }
        }
    },
    methods:{
        submit() {
            this.$emit('submit',this.form);
        }
    }
};
</script>

<style>
</style>
