<template>
  <div class="container">
    <p>Thanks for the moneyz</p>
    <button
      id="button-thanks"
      tag="button"
      class="btn btn-primary btn-lg"
      @click="updateSingleDonation"
    >
      Give Gift Aid
    </button>
  </div>
</template>
<script>
export default {
  props: {
    donationID: {
      default: null,
      type: Number,
    },
  },
  data() {
    return {
      success: false,
      fullError: '',
      loading: false,
      errors: [],
    }
  },
  methods: {
    updateSingleDonation() {
      console.log('updateSingleDonation')
      this.success = false
      this.loading = true
      this.errors = []
      window.axios.patch(`/donations/${this.donationID}`, {
        giftaid: 1,
      })
        .then((response) => {
          this.success = true
          this.loading = false
          this.$router.push({ name: 'thankyou', params: { donationID: this.donationID } })
          console.log(response)
        })
        .catch((error) => {
          this.success = false
          this.loading = false
          this.fullError = error.response
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {}
          }
        })
    },
  },
}
</script>
