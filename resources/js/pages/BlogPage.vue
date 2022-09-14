<template>
    <div class="container">
        <h1>Blog</h1>
         <Posts/>
    </div>
  
</template>

<script>

import Posts from '../components/Posts';

export default {
    name: 'BlogPage',
    components:{
    Posts
  }
}
</script>

<style>

</style>