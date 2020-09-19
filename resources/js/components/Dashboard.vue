<template>
    <div>
        Dashboard <br>
        <div v-if="user">
        Name: {{user.name}} <br>
        Email: {{user.email}}<br><br>
        </div>
        <button @click="logout">logout</button>
        

    </div>
</template>
<script>
export default {
    data(){
        return{
            user:''
        }
    },
    methods:{
        logout(){
            axios.post('/api/logout').then(()=>{
                this.$router.push({ name: "storeList"})
            })
        }
    },
    mounted(){
        // axios.get('/api/storeusers/user')
        axios.get('/api/user')
        .then(response=>this.user = response.data)
        .catch(error => console.log(error));
    }
}
</script>