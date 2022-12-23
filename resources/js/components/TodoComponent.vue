<template>
<div>
    <div class="card-header">
        <span class="text-warning" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></span>
        <form @submit.prevent="saveData">
            <div class="input-group mb-3">
                <input v-model="form.title" :class="{'is-invalid' : form.errors.has('title')}" type="text" class="form-control" value="sdsdsdsd" placeholder="Add List">
                <div class="input-group-append">
                    <button class="btn btn-warning" type="submit">Add</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body scroll-y">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="todo in todos" :key="todo.id">
                    <td>{{ todo.id }}</td>
                    <td>{{ todo.title }}</td>
                    <td>
                        <button v-on:click="onDelete(todo.id)" class="bg-danger text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                            </svg>
                        </button>
                    </td>
                    <td>
                        <Modal :visible="false" :variant="todo.id" @passData="getUpdate"></Modal>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
import Axios from 'axios';
import Form from '../form'
import Modal from './Modal.vue'
export default {
    data() {
        return {
            todos: '',
            form: new Form({
                title: ''
            }),
        }
    },
    components:{
        Modal,
    },
    methods: {
        getTodo() {
            Axios.get('/api/todo').then((res) => {
                this.todos = res.data
            }).catch((error) => {
                console.log(error)
            });
        },
        saveData() {
            let data = new FormData();
            data.append('title', this.form.title);
            let result = Axios.post('/api/todo', data).then((res) => {
                this.form.reset();
                this.getTodo();
            }).catch((error) => {
                this.form.errors.record(error.response.data.errors);
            });

        },
        onDelete(id) {
            Axios.delete('/api/todo/' + id).then((res) => {
                this.getTodo();
            })
        },
        getUpdate(value)
        {
            let data = value;
            Axios.put('/api/todo/'+data.id,data).then((res)=>{
                this.getTodo();
            });
            console.warn(data.id);
        }
    },
    mounted() {
        this.getTodo()
    }

}
</script>

<style>
.scroll-y {
    overflow-y: scroll;
    height: 70vh;
}
</style>
