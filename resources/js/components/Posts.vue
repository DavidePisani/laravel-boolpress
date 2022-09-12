<template>
    <div>
        <h1>Lista dei post</h1>

        <div v-for="post in posts" :key="post.id" class="card">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
        </div>
</div>

    </div>
  
</template>

<script>
export default {
    name: 'Posts',  
    data(){
        return{
            posts: []
        };
    },

    methods:{
        getPosts(){
             axios.get('/api/posts').then((response)=>{
            this.posts = response.data.results;
            });
            
        }
    },

    mounted(){
       this.getPosts();
    }
}
</script>

