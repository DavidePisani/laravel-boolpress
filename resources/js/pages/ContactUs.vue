<template>
  <div class="container">
        <h1>Contattaci</h1>

        <form @submit.prevent="sendMessage">
            <div class="mb-3">
                <label for="user-name" class="form-label">Nome</label>
                <input v-model="userName" type="text" class="form-control" id="user-name">
                <div v-if="errors.name">
                    <div v-for="error,index in errors.name" :key="index" class="alert alert-danger" >
                        {{error}}
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="user-email" class="form-label">Email address</label>
                <input v-model="userEmail" type="email" class="form-control" id="user-email">
                <div v-if="errors.email">
                    <div v-for="error,index in errors.email" :key="index" class="alert alert-danger" >
                        {{error}}
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="user-message" class="form-label">Messaggio</label>
                <textarea v-model="userMessage" class="form-control" id="user-message" rows="10"></textarea>
                <div v-if="errors.message">
                    <div v-for="error,index in errors.message" :key="index" class="alert alert-danger" >
                        {{error}}
                    </div>
                </div>
            </div>

            <input type="submit" class="btn btn-primary" :disabled="sending">    
        </form>     
  </div>
</template>

<script>
export default {
    name:'ContactUs',

    data(){
        return {
            userName:'',
            userEmail:'',
            userMessage:'',
            sending: false,
            sucsess: false,
            errors: {},
        };
    },

     methods: {
        sendMessage() {
            axios.post('/api/leads',{
                    name: this.userName,
                    email: this.userEmail,
                    message: this.userMessage,     
            })
            .then((response) => {
                if(response.data.success){
                    this.success = true
                    this.userName = '';
                    this.userEmail = '';
                    this.userMessage = '';
                    this.errors = {};
                    console.log(response.data)
                }else{
                    this.errors= response.data.errors
                    console.log(response.data)
                }
            });
            
        }
    }
}
</script>

