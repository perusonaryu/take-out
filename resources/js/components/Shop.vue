<template>
  <div>
      aaaaaaaaaaaaaaaa
      {{$route.params.id }}
  </div>
</template>

<script>
export default {
    data: () => ({
        shopData: ''
    }),

    mounted(){
        this.shopDataGet();
    },

    methods:{
        shopDataGet(){
            axios.get('/shopDataGet/' + this.$route.params.id)
            .then(response => {
                console.log(response.data);
            })
            .catch( error => console.log(error));
        }
    }
}
</script>

<style>

</style>