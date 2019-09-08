<template>
  <router-view></router-view>
</template>
<script>
export default {
  name: 'App',
  props: {
    route: {
      default: '',
      type: String,
    },
  },
}
</script>
