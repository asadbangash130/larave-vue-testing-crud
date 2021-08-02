<template>
    <div>
        <h4 class="text-center">All Companies</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="company in companies" >
                <td>{{ company.id }}</td>
                <td>{{ company.name }}</td>
                <td>{{ company.email }}</td>
                <td>{{ company.logo }}</td>
                <td>{{ company.created_at }}</td>
                <td>{{ company.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editcompany', params: { id: company.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteCompany(company.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/companies/add')">Add Company</button>
     <pagination :data="companies" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
export default {
    data() {
        return {
            companies: []
        }
    },
    
    async created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/companies/index')
                .then(response => {
                    this.companies = response.data.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteCompany(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/companies/delete/${id}`)
                    .then(response => {
                        let i = this.companies.map(item => item.id).indexOf(id); // find index of your object
                        this.companies.splice(i, 1)
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>