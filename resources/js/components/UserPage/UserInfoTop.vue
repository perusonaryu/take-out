<template>
<<<<<<< HEAD
  
=======
    <div>

    </div>
>>>>>>> 2f27c73a23cbaf80dc0cffd94c0910afba74623b
</template>

<script>
export default {
<<<<<<< HEAD

}
</script>

=======
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



>>>>>>> 2f27c73a23cbaf80dc0cffd94c0910afba74623b
<style>

</style>