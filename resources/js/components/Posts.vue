<template>
    <div>
        <h4 class="mt-2">Lista dei post</h4>
    <div class="row row-cols-3">
        <div class="col mt-3" v-for="post in posts" :key="post.id">
            <SinglePostComponent :post="post"/>
        </div>
    </div>
    <nav>
        <ul class="pagination mt-5 d-flex justify-content-center">
            <li class="page-item" :class="{'disabled': currentPagination == 1 }">
            <a class="page-link" @click="getPosts(currentPagination - 1)" href="#">Previous</a>
            </li>

            <li v-for="pageNumber in lastPagination" :key="pageNumber"  class="page-item" :class="{'active' : pageNumber == currentPagination }">
                <a @click="getPosts(pageNumber)" class="page-link"  href="#">{{pageNumber}}</a>
            </li>
             
            <li class="page-item" :class="{'disabled': currentPagination == lastPagination }">
            <a class="page-link" @click="getPosts(currentPagination + 1)" href="#">Next</a>
            </li>
        </ul>
    </nav>
        

    </div>
  
</template>

<script>
import SinglePostComponent from './SinglePostComponent.vue';

export default {
    name: 'Posts', 
    components:{
        SinglePostComponent,
    },
   

    data(){
        return{
            posts: [],
            currentPagination: 1,
            lastPagination: null
        };
    },

    methods:{

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

