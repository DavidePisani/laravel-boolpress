<template>
  <div class="container">
        <h1>Contattaci</h1>

        <form @submit.prevent="sendMessage">
            <div class="mb-3">
                <label for="user-name" class="form-label">Nome</label>
                <input v-model="userName" type="text" class="form-control" id="user-name">
            </div>

            <div class="mb-3">
                <label for="user-email" class="form-label">Email address</label>
                <input v-model="userEmail" type="email" class="form-control" id="user-email">
            </div>

            <div class="mb-3">
                <label for="user-message" class="form-label">Messaggio</label>
                <textarea v-model="userMessage" class="form-control" id="user-message" rows="10"></textarea>
            </div>

            <input type="submit" class="btn btn-primary">    
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
        };
    },

     methods: {
        sendMessage() {
            axios.post(`/api/leads?name=${this.userName}&email=${this.userEmail}&message=${this.userMessage}`).then((response)=>{
                console.log(response)
            });
                // name: this.userName,
                // email: this.userEmail,
                // message: this.userMessage
            
        }
    }
}
</script>

