<template>
    <div class="card">
        <div class="card-body">
            <img v-if="post.cover" :src="post.cover" class="card-img-top" :alt="post.title">
            <h5 class="card-title">{{post.title}}</h5>
            <p class="card-text">{{cutText(post.content)}}</p>
            <router-link :to="{name: 'single-post', params: {slug: post.slug}  }" class="btn btn-primary">Vai ad Articolo</router-link>
        </div>
    </div>
  
</template>

<script>
export default {
    name: 'SinglePostComponent',

     props:{
        post: Object,
    },

    methods:{
        cutText(text){
            if(text.length > 75){
               return text.slice(0,75) + '...';
                
            }else{
                return text;
            }
        },
    }
}
</script>

<style>

</style>