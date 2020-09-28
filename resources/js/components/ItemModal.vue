<template>
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="!isAdd">{{item.name}}</h5>
                    <h5 class="modal-title" v-else>Add new Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="custom-control custom-switch float-right" v-if="!isAdd">
                        <input type="checkbox" class="custom-control-input" id="editSwitch" v-model="isEdit" @change="isEditChanged">
                        <label class="custom-control-label no-select" for="editSwitch">Edit Item</label>
                    </div>
                    <component :is="activeComponent" :item="item"></component>
                </div>
            </div>
        </div>
    </div>    
</template>

<script>
import { EventBus } from "../event-bus";
import itemView from './ItemView.vue'
import itemEdit from './ItemEdit.vue'
import itemAdd from './ItemAdd.vue'
export default {
    components: {
        itemView,
        itemEdit,
        itemAdd
    },
    data() {
        return {
            item: {},
            components: {
                itemView,
                itemEdit,
                itemAdd,
            },
            isEdit: false,
            isAdd: false,
            activeComponent: null
        }
    },
    methods: {
        isEditChanged() {
            this.activeComponent = this.isAdd ?  this.components['itemAdd'] : this.isEdit ? this.components['itemEdit'] : this.components['itemView'];
        }
    },
    mounted() {
        EventBus.$on('showItemModal', (data) => {
            $('#itemModal').modal('show');
            this.item = data.item;
            this.isEdit = data.isEdit;
            this.isAdd = data.isAdd || false;
            this.isEditChanged();
        });
    }
}
</script>

<style scoped>
    .modal-body {
        min-height: 150px;
    }
    .no-select {
    -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
                user-select: none; /* Non-prefixed version, currently
                                    supported by Chrome, Edge, Opera and Firefox */
    }
</style>