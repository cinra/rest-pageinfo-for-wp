<template>
  <img alt="Vue logo" src="./assets/logo.png">
  <HelloWorld msg="Welcome to Your Vue.js + TypeScript App"/>
</template>

<script lang="ts">
import { onMounted, defineComponent } from 'vue'
import HelloWorld from './components/HelloWorld.vue'
import apiClient from './libs/apiClient'

// You can import types.
// import { PageInfo } from 'pageinfo-docs'

export default defineComponent({
  name: 'App',
  components: {
    HelloWorld
  },
  setup (props, context) {
    onMounted(async () => {
      console.log(props, context)
      const res = await apiClient.page_info._uri('post/hello-world').$get({
        query: {
          preview: false,
          preview_revision_id: ''
        }
      })
      console.log(res)
    })
  }
})
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
