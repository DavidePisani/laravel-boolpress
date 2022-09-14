<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin">Accedi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li v-for="link, index in menuLinks" :key="index" class="nav-item">
                        <router-link :to="{name: link.name}" class="nav-link">{{link.lable}}</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  </header>
</template>

<script>
export default {
    name:'PageHeader',
    data() {
        return{
            menuLinks: [
                {
                    name: 'home',
                    lable: 'Home'
                },

                {
                    name: 'about',
                    lable: 'About'
                },

                {
                    name: 'blog',
                    lable: 'Blog'
                },

            ],
        };    
    }
}
</script>

<style>

</style>