<template>
    <CustomersForm @submitted="create"></CustomersForm>
</template>

<script>
import CustomersForm from './CustomersForm';

export default {
    name: "CustomersCreate",

    components: { CustomersForm },

    methods: {
        create(data) {
            axios.post('/api/customers', data)
            .then(result => {

            })
            .catch(response => {

            })
        }
    }

}
</script>