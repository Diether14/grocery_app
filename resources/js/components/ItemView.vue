<template>
  <div class="container-fluid mt-3">
    <table class="w-100">
        <tr>
            <th>Name:</th>
            <td>{{item.name}}</td>
        </tr>
        <tr>
            <th>Categories:</th>
            <td>
                <span class="d-inline border border-success px-1 rounded mr-1" v-for="category in item.categories" :key="category.id">
                    {{category.name}}
                </span>
            </td>
        </tr>
        <tr>
            <th>Description:</th>
            <td>{{item.description}}</td>
        </tr>
        <tr>
            <th>Price:</th>
            <td>{{item.price}}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{item.status}}</td>
        </tr>
    </table>  
  </div>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            itemObj: this.item
        }
    }
}
</script>

<style scoped>
    th {
        width: 150px !important;
    }
</style>>
