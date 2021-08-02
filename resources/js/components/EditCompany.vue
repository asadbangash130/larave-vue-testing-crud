<template>
    <div>
        <h4 class="text-center">Edit Company</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateCompany">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="company.name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="company.email">
                    </div>
                    <div class="form-group">
                        
                   <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Company</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            company: {name:'',email:'',logo:''}
        }
    },
    async created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/companies/edit/'+this.$route.params.id)

                .then(response => {
                    this.company = response.data.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    
    methods: {
      handleFileUpload(){
        this.file = this.$refs.file.files[0];
      },
         updateCompany() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/companies/update/'+this.$route.params.id)
                    .then(response => {
                        this.$router.push({name: 'companies'});
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