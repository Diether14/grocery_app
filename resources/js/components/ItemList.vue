<template>
  <div>
      <div class="row">
        <h3 class="col-6">Grocery Items</h3>
        <div class="col-6">
            <div class="form-group d-inline">
                <label>Search by:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="searchByRadioOptions" id="categoryRadio" value="1" v-model="searchBy">
                    <label class="form-check-label" for="categoryRadio">Category</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="searchByRadioOptions" id="itemRadio" value="0" v-model="searchBy">
                    <label class="form-check-label" for="itemRadio">Item</label>
                </div>
            </div>
            <div class="form-group d-inline">
                <label for="searchVal">Search:</label>
                <input type="text" name="searchVal" id="searchVal" v-model="queryString" v-on:input="showItems">
            </div>
        </div>
      </div>
      <table class="table">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Categories</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="item in items" :key="item.id">
                  <td>{{item.name}}</td>
                  <td>
                      <span class="d-inline border border-success px-1 rounded mr-1" v-for="category in item.categories" :key="category.id">
                          {{category.name}}
                      </span>
                  </td>
                  <td>{{item.description}}</td>
                  <td>{{item.price}}</td>
                  <td>{{item.status}}</td>
                  <td>
                      <button class="btn btn-sm btn-success d-inline mr-1">Open</button>
                      <button class="btn btn-sm btn-primary d-inline mr-1">Edit</button>
                      <button class="btn btn-sm btn-danger d-inline mr-1">Delete</button>
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            items: [],
            searchBy: 0,
            queryString: '',
        }
    },
    created() {
        this.showItems();
    },
    methods: {
        showItems() {
            axios.get('/api/items/show', {params: {'query_string': this.queryString, 'category_search': this.searchBy}})
            .then(res => {
                this.items = res.data.data;
            })
        }
    },
}
</script>

<style>

</style>