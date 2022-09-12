<template>
    <div>
        <h1>Lista dei post</h1>
    <div class="row row-cols-3">
        <div class="col mt-3" v-for="post in posts" :key="post.id">
            <div class="card">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text">{{cutText(post.content)}}</p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>
        </div>
    </div>
    <nav>
        <ul class="pagination mt-5 d-flex justify-content-center">
            <li class="page-item" :class="{'disable': currentPagination == 1 }">
            <a class="page-link" @click="getPosts(currentPagination - 1)" href="#">Previous</a>
            </li>

            <li v-for="pageNumber in lastPagination" :key="pageNumber"  class="page-item" :class="{'active' : pageNumber == currentPagination }">
                <a @click="getPosts(pageNumber)" class="page-link"  href="#">{{pageNumber}}</a>
            </li>
             
            <li class="page-item" :class="{'disable': currentPagination == lastPagination }">
            <a class="page-link" @click="getPosts(currentPagination + 1)" href="#">Next</a>
            </li>
        </ul>
    </nav>
        

    </div>
  
</template>

<script>
export default {
    name: 'Posts',  
    data(){
        return{
            posts: [],
            currentPagination: 1,
            lastPagination: null
        };
    },

    methods:{
        cutText(text){
            if(text.length > 75){
               return text.slice(0,75) + '...';
                
            }else{
                return text;
            }
        },

        getPosts(pageNumber){
             axios.get('/api/posts',{
                params:{
                    page:pageNumber,
                }
             })
             .then((response)=>{
                this.posts = response.data.results.data;
                this.currentPagination = response.data.results.current_page;
                this.lastPagination = response.data.results.last_page;
            });
            
        }
    },

    mounted(){
       this.getPosts(this.currentPagination);
    }
}
</script>

