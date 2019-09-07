<template>
  <router-view :route="route"></router-view>
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
