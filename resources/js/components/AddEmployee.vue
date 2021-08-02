<template>
    <div>
        <h4 class="text-center">Add Employee</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addEmployee">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" v-model="employee.first_name">
                    </div>
                     <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" v-model="employee.last_name">
                    </div>
                     <div class="form-group">
                        <label>Company</label>
                        <input type="text" class="form-control" v-model="employee.company_id">
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="employee.email">
                    </div>
                     <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" v-model="employee.phone">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Employees</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            employee: {
                first_name: '',
                last_name: '',
                company_id: '',
                email: '',
                phone: ''
            }
        }
    },
    methods: {
        addEmployee() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/employees/create', this.employee)
                    .then(response => {
                        this.$router.push({name: 'employees'})
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