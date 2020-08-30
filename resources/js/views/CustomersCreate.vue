<template>
    <CustomersForm @submitted="create" :errors="errors"></CustomersForm>
</template>

<script>
import CustomersForm from './CustomersForm';

export default {
    name: "CustomersCreate",

    components: { CustomersForm },

    data: function() {
        return {
            errors: null,
        }
    },

    methods: {
        create(data) {
            axios.post('/api/customers', data)
            .then(result => {
                this.$router.push(result.data.data.url)
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    }

}
</script>