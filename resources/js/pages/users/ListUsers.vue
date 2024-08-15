<template>

    <div class="content-header">
        <div class="container-fluid">
            <button type="button" class="mb-2 btn btn-primary" data-toggle="modal" data-target="#createNewUser">Add new User</button>
            <!-- The Modal -->
            <div class="modal" id="createNewUser">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add New User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                        </div>

                        <form>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input v-model="form.name" type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input v-model="form.email" type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="pwd" class="form-label">Password:</label>
                                    <input v-model="form.password" type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button @click="createUser" type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="container mt-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered Date</th>
                        <th>Role</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="user.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>2021-07-04</td>
                            <td>Admin</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>
<script setup>
import {onMounted, reactive, ref} from "vue";

import axios from "axios";

const users = ref([]);

const form = reactive({
    name : '',
    email : '',
    password : '',
})

const getUsers = () => {
    axios.get('/api/users')
        .then((response) => {
            users.value = response.data;
        })
}

const createUser = () => {
    axios.post('/api/create/user', form)
        .then((response) => {
            users.value.unshift(response.data.data)
            form.name = '';
            form.email = '';
            form.password = '';
            $("#createNewUser").modal('hide');
        })
}

onMounted(() => {
    getUsers();
})
</script>
