<template>
    <div>
        <h4 class="text-center">Add Company</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCompany" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="company.name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="company.email">
                    </div>
                     <div class="form-group">
                        
                   <input type="file" class="form-control" v-on:change="onFileChange" />
                    </div>
                    <button type="submit" class="btn btn-primary">Add Company</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            company: {
                name: '',
                email: '',
                file: ''
            }
        }
    },
    methods: {
         onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
        addCompany() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/companies/create', this.company)
                    .then(response => {
                        this.$router.push({name: 'companies'})
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