<template>
  <div id="app">
      <div class="container">
          <div class="menu">
              <div class="title">MENU</div>
              <ul class="nav">
                  <li><router-link to="/">Index</router-link></li>
                  <li><router-link to="/news/create">New news</router-link></li>
              </ul>
          </div>
          <div class="row">
              <div class="col-md-12">

              </div>
          </div>
          <hr>
          <div class="row">
              <div class="col-md-12">
                  <router-view></router-view>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
    export default {
        data(){
            return {
            }
        }
    }
</script>

<style>

</style>
