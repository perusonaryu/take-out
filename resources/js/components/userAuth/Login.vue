<template>
<div class="d-flex justify-center">
    <div class="">
        <div class=""><h1>Login to your account</h1></div>
        <div class="">
            <label for="email">Your e-mail</label>
            <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Email" type="email" v-model="form.email">
        </div>
        <div class="p-2 w-full">
            <label for="password">Password</label>
            <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Password" type="password" v-model="form.password" name="password">
        </div>
        <div class="p-2 w-full mt-4">
            <button @click.prevent="loginUser" type="submit" class="flex border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Login</button>
        </div>
    </div> 
</div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                email: '',
                password: ''
            },
            errors: [],
            user:''
        }
    },
    methods:{
         loginUser(){
            //  axios.get('/sanctum/csrf-cookie').then(response => {
                // // ログイン処理…
            axios.post('/login', this.form)
            .then(() =>{
             response => console.log(response.data);
            this.$router.push({ name: "storeList"}); 
                // axios.get('/api/user')
                // .then(response=>{
                //     this.user = response.data;
                //     if(this.user.id == null){
                //         this.$router.push({ name: "storeadd"});
                //     }else{
                //         this.$router.push({ name: "dashboard"});
                //     }
                // })
                // .catch(error => console.log(error));
            })
            .catch((error) =>{
                console.log(error);
            this.errors = error.response.data.errors;
            })
                // console.log('ok');
            // });

             
         }
    }
}
</script>

<style>

</style>