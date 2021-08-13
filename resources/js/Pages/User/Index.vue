<template>
    <div>
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <h1>User List</h1>
                    <div
                        v-if="success"
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        <strong>{{ success }}</strong>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <Link
                        href="/user/create"
                        class="btn btn-outline-primary my-3"
                        >Create</Link
                    >
                </div>
                <div class="col-4">
                    <form @submit.prevent="submit()" class="d-flex">
                        <input
                            v-model="q"
                            class="form-control"
                            type="search"
                            placeholder="Search"
                            aria-label="Search"
                        />
                        <button
                            class="ml-3 btn btn-outline-success"
                            type="submit"
                        >
                            Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(user, index) in users.data"
                                :key="index"
                            >
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.created_at }}</td>
                                <td>
                                    <Link
                                        :href="`/user/${user.id}/edit`"
                                        class="btn btn-outline-info mr-3"
                                        >Edit</Link
                                    >
                                    <button
                                        @click="delete_user(user.id)"
                                        class="btn btn-outline-danger"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li
                            :class="['page-item',
                            link.url ===null ? 'disabled' : '',
                            link.active ? 'active' :'']"
                            v-for="(link,index) in users.links" :key="index">
                                <Link class="page-link" :href="link.url === null ? '#': link.url" v-html="link.label"></Link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
export default {
    name: "Index",
    props: ["users", "success", "search"],
    components: {
        Link
    },
    data() {
        return {
            q: this.search
        };
    },
    methods: {
        submit() {
            this.$inertia.get(`/user?search= ${this.q}`);
        },
        delete_user(id) {
            if (confirm("Are you sure you want to delete?")) {
                this.$inertia.delete(`/user/${id}`);
            }
        }
    }
};
</script>
