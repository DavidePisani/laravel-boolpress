<template>
    <div class="container">
        <div v-if="post">
            <h1>{{post.title}}</h1>

                <div v-if="post.category">
                   Categoria: {{post.category.name}}
                </div>

                <div v-if="post.tags.length > 0">
                    Tag: <span v-for="tag in post.tags" :key="tag.id" class="badge bg-primary mr-1"> {{tag.name}}</span>
                </div>
                
            <p>{{post.content}}</p>
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
                this.post = response.data.results;
                console.log(this.post)
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