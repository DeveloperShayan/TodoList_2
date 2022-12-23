<template>
<div>
    <div v-if="openClose" class="modal fade show" 
    tabindex="-1" 
    aria-labelledby="exampleModalLabel" 
    aria-modal="true"
    role="dialog" 
    style="display:block">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update the values this id: {{ todos.id }}</h5>
              <button type="button" @click="openCloseFuncrion()" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"> 
                <form>
                    <input type="text" v-model="update_title" class="form-control">
                    <button type="button" @click="updateData(update_id),openCloseFuncrion()" class="form-control btn btn-primary">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" @click="openCloseFuncrion()" class="btn btn-success">Close</button>
            </div>
          </div>
        </div>
      </div>
      <button type="button" @click="openCloseFuncrion()" class="btn btn-success">Open Modal</button>
</div>
</template>

<script>
import Axios from 'axios';
import Form from '../form'
export default {
    name: 'Modal',
    props: {
        visible: Boolean,
        variant: Number,
    },
    data() {
        return {
            openClose: this.visible,
            todos: '',
            update_title : this.title,
            update_id : this.variant,

        }
    },
    methods: {
        openCloseFuncrion() {
            this.openClose = !this.openClose;
            this.getTodo(this.update_id);
            
            
        },
        getTodo(id) {
            Axios.get('/api/todo/'+id+'/edit').then((res) => {
                this.todos = res.data
                this.update_title = res.data.title
            }).catch((error) => {
                console.log(error)
            });
        },
        updateData(id)
        {
            
            this.$emit("passData",{title : this.update_title , id: id});
        }
    },
    watch: {
        visible: function (newVal, oldVal) {
            this.openClose = newVal;
            console.log('New Value' + newVal + '==' + oldVal);
        }
    },

}
</script>
