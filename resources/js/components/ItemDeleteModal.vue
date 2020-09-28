<template>
    <div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletion Confirmation</h5>
                </div>
                <div class="modal-body">
                    <span>Confirm deletion of item #{{item.id}} {{item.name}}?</span>
                    <div class="text-right w-100 mt-3">
                        <button class="btn btn-md btn-danger d-inline mr-1" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-md btn-success d-inline mr-1" @click="confirmDelete()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</template>

<script>
import { EventBus } from "../event-bus";
import axios from 'axios';

export default {
    data() {
        return {
            item: {}
        }
    },
    mounted() {
        EventBus.$on('showDeleteModal', (item) => {
            $('#deleteItemModal').modal('show');
            this.item = item;
        });
    },
    methods: {
        confirmDelete() {
            axios.post('/api/items/destroy/' + this.item.id).then(res => {
                EventBus.$emit("showAlert", {
                    class: 'alert-success',
                    message: this.item.name + ' deleted successfuly.'
                });
                EventBus.$emit("refresh");
            }).catch(err => {
                EventBus.$emit("showAlert", {
                    class: 'alert-danger',
                    message: 'Error deleting Item please try again later.'                    
                });
            }).finally(() => {
                $('#deleteItemModal').modal('hide');
            });
        }
    }
}
</script>

<style>

</style>