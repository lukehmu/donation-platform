<template>
  <div class="container">
    <div
      class="btn-group btn-group-toggle mb-3 col-sm-4"
    >
      <label
        class="btn btn-secondary btn-lg"
        :class="{ active: formFields.giftaid === '1' }"
        for="giftaid-yes"
      >
        <input
          id="giftaid-yes"
          v-model="formFields.giftaid"
          type="radio"
          name="giftaid"
          value="1"
        >
        Yes
      </label>
      <label
        class="btn btn-secondary btn-lg"
        :class="{ active: formFields.giftaid === '0' }"
        for="giftaid-no"
      >
        <input
          id="giftaid-no"
          v-model="formFields.giftaid"
          type="radio"
          name="giftaid"
          value="0"
        >
        No
      </label>
    </div>
    <p>Thanks for the moneyz</p>
    <button
      id="button-thanks"
      tag="button"
      class="btn btn-primary btn-lg"
      @click="updateDonation"
    >
      Give Gift Aid
    </button>
  </div>
</template>
<script>
import DonationAPI from '../services/api/Donations'

export default {
  name: 'Giftaid',
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
  data() {
    return {
      success: false,
      fullError: '',
      loading: false,
      errors: [],
      formFields: {
        giftaid: '1',
      },
    }
  },
  methods: {
    updateDonation() {
      this.success = false
      this.loading = true
      this.errors = []
      DonationAPI.updateDonation(this.donationID, { giftaid: this.formFields.giftaid })
        .then((response) => {
          this.success = true
          this.loading = false
          console.log(response)
          this.$router.push({ name: 'thankyou', params: { donationID: this.donationID, donation: this.donation } })
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
