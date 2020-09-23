<template>
    <div>

    </div>
</template>

<script>
export default {
    data: () => ({
        userData:'',
    }),
    mounted(){

    },

    methods:{
        getUserData(){
            axios.get('/user/payment')
            .then(response => {
                consol.log(response.data);
            })
            .catch(error => console.log(error));
        }
    },
}
</script>



<style>

</style>