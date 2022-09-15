<template>
    <div class="container">
        <div v-if="post">
            <h1>{{post.title}}</h1>

            <img class="w-50" v-if="post.cover" :src="post.cover" :alt="post.title">

                <div v-if="post.category">
                   Categoria: {{post.category.name}}
                </div>

                <div v-if="post.tags.length > 0">
                    Tag: <span v-for="tag in post.tags" :key="tag.id" class="badge bg-primary mr-1"> {{tag.name}}</span>
                </div>
                
            <p>{{post.content}}</p>
        </div>
        <div v-else>
            <div class="d-flex align-items-center">
                <strong>Loading...</strong>
                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>
        
        
    </div>
  
</template>

<script>
export default {
    name:'SinglePost',
    data(){
        return{
            post: null
        };
    },

    methods:{
        getSinglePosts(){
            axios.get('/api/posts/' + this.$route.params.slug).then((response) =>{
                if(response.data.success){
                    this.post = response.data.results;
                }else{
                    this.$router.push({name: 'notfound'})
                }
                
            });
        }
    },

    mounted(){
       this.getSinglePosts();
    }
}

</script>

<style>

</style>