<template>
  <div class="container-fluid mt-3">
      <form method="post" @submit.prevent="save()">
          <div class="form-group">
              <label for="item_name">Name</label>
              <input type="text" name="item_name" id="itemName" class="form-control" v-model="tempItem.name" required>
          </div>
            <div class="form-group">
              <label for="item_desc">Description</label>
              <textarea name="item_desc" id="itemDesc" rows="3" class="form-control" v-model="tempItem.description"></textarea>
          </div>
        <div class="form-group">
            <label for="item_categories">Categories</label>
            <v-select :options="options" :filterable="false" 
                :taggable="false" @search="search" :multiple="true"
                v-model="selectedCategories"
                >
                <template slot="no-options">
                    {{emptyMessage}}
                </template>
            </v-select>
        </div>
        <div class="form-group">
            <label for="item_price">Price</label>
            <input type="number" name="item_price" id="itemPrice" class="form-control" v-model="tempItem.price" required>
        </div>
        <div class="form-group">
            <label for="item_status">Status</label>
            <input type="text" name="item_status" id="itemStatus" class="form-control" v-model="tempItem.status" required>
        </div>
        <div class="text-right w-100">
            <button class="btn btn-md btn-danger d-inline mr-1" data-dismiss="modal">Cancel</button>
            <button class="btn btn-md btn-success d-inline mr-1" type="submit">Save</button>
        </div>
      </form>
  </div>
</template>

<script>
import axios from 'axios';
import { EventBus } from "../event-bus";

export default { 
    data() {
        return {
            options: [],
            emptyMessage:'Input atleast 3 characters to search.',
            selectedCategories: [],
            tempItem: {}
        }
    },
    created() {
        this.tempItem = {
            'id': null,
            'name': '',
            'description': '',
            'price': 0,
            'status': 'active',
            'categories': [],
        }
    },
    methods: {
        search(str, loading) {
            $('.vs__dropdown-toggle').removeClass('border-danger');
            if(str.length >= 3) {
                loading(true);
                axios.get('/api/categories/options', {
                    params: {'search_string': str}
                }).then(res => {
                    loading(false);
                    this.emptyMessage = 'No records found.';
                    this.options = res.data.data;
                }).catch(err => {
                    loading(false);
                    this.emptyMessage = 'No records found.';
                    this.options = []
                });
            } else {
                this.options = []
                this.emptyMessage = 'Input atleast 3 characters to search';
            }
        },
        save() {
            if(this.selectedCategories.length === 0) {
                $('.vs__dropdown-toggle').addClass('border-danger');
                return;
            }
            let selectedCategories = [];
            this.selectedCategories.forEach(el => {
                selectedCategories.push(el.id);
            })
            this.tempItem.categories = selectedCategories;
            axios.post('/api/items/create', this.tempItem).then(res => {
                EventBus.$emit("showAlert", {
                    class: 'alert-success',
                    message: 'Item created successfully'
                })
                EventBus.$emit("refresh");
            }).catch(err => {
                EventBus.$emit("showAlert", {
                    class: 'alert-danger',
                    message: 'Error creating Item please try again later.'                    
                })
            }).finally(() => {
                $('#itemModal').modal('hide');
            });
        }
    }
}
</script>