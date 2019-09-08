<template>
  <div class="container">
    <p v-if="donation">
      Cheers for everything <strong>{{ donation.fullName }} </strong>
    </p>
  </div>
</template>
<script>
export default {
  props: {
    donationID: {
      default: null,
      type: Number,
    },
    donation: {
      default: null,
      type: Object,
    },
  },
}
</script>
