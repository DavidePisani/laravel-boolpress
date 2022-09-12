<template>
  <div>
    <div class="container">
        <a href="/admin"> Accedi</a>
        <Posts/>
    </div>
  </div>
</template>

<script>
import Posts from '../components/Posts.vue';

export default {
  name: 'App', 
  components:{
    Posts
  }

}
</script>

<style>

</style>