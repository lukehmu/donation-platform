<template>
  <div class="container">
    <div
      class="btn-group btn-group-toggle mb-3 col-sm-4"
    >
      <label
        class="btn btn-secondary btn-lg"
        :class="{ active: formFields.donationType === 'one-off' }"
        for="donationType-one-off"
      >
        <input
          id="donationType-one-off"
          v-model="formFields.donationType"
          type="radio"
          name="donationType"
          value="one-off"
        >
        One-off
      </label>
      <label
        class="btn btn-secondary btn-lg"
        :class="{ active: formFields.donationType === 'recurring' }"
        for="donationType-recurring"
      >
        <input
          id="donationType-recurring"
          v-model="formFields.donationType"
          type="radio"
          name="donationType"
          value="recurring"
        >
        Recurring
      </label>
    </div>
    <div v-if="formFields.donationType == 'one-off'">
      <form @submit.prevent>
        <div>
          <h2>One-off</h2>
          <div
            class="btn-group btn-group-toggle mb-3 col-sm-5"
          >
            <label
              v-for="donationValue in donationValuesSingle"
              :key="donationValue.value"
              class="btn btn-info"
              :for="'donationAmount-' + donationValue.value"
              :class="{ active: donationValue.value === formFields.donationAmount }"
            >
              <input
                :id="'donationAmount-' + donationValue.value"
                v-model="formFields.donationAmount"
                type="radio"
                name="donationAmount"
                :value="donationValue.value"
              >

              £{{ donationValue.value }}
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="donationAmount">Donation amount</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">£</span>
            </div>
            <input
              id="donationAmountValue"
              v-model="formFields.donationAmount"
              v-model.trim="$v.formFields.donationAmount.$model"
              type="number"
              step="0.01"
              class="form-control col-sm-3"
              :class="{ 'is-invalid': $v.formFields.donationAmount.$error }"
            >
            <div
              v-if="errors && errors.donationAmount"
              class="invalid-feedback"
            >
              {{ errors.donationAmount[0] }}
            </div>
          </div>
        </div>
        <div
          class="form-group"
        >
          <label for="fullName">Full name</label>
          <input
            id="fullName"
            v-model="formFields.fullName"
            v-model.trim="$v.formFields.fullName.$model"
            type="text"
            class="form-control col-sm-5"
            :class="{ 'is-invalid': $v.formFields.fullName.$error }"
          >
          <div
            v-if="errors && errors.fullName"
            class="invalid-feedback"
          >
            {{ errors.fullName[0] }}
          </div>
        </div>
        <div class="form-group">
          <label for="emailAddress">Email address</label>
          <input
            id="emailAddress"
            v-model="formFields.emailAddress"
            v-model.trim="$v.formFields.emailAddress.$model"
            type="email"
            class="form-control col-sm-5"
            :class="{ 'is-invalid': $v.formFields.emailAddress.$error }"
          >
          <div
            v-if="errors && errors.emailAddress"
            class="invalid-feedback"
          >
            {{ errors.emailAddress[0] }}
          </div>
        </div>
        <div class="btn-group btn-group-toggle mb-3 col-sm-4">
          <label
            id="label-paymentType-card"
            class="btn btn-secondary btn-lg"
            :class="{ active: formFields.paymentType === 'card' }"
            for="paymentType-card"
          >
            <input
              id="paymentType-card"
              v-model="formFields.paymentType"
              type="radio"
              name="paymentType"
              value="card"
            >

            Card
          </label>

          <label
            class="btn btn-secondary btn-lg"
            :class="{ active: formFields.paymentType === 'paypal' }"
            for="paymentType-paypal"
          >
            <input
              id="paymentType-paypal"
              v-model="formFields.paymentType"
              type="radio"
              name="paymentType"
              value="paypal"
            >
            PayPal
          </label>
        </div>
        <div
          v-if="formFields.paymentType == 'card'"
        >
          <button
            id="button-payment-card"
            type="submit"
            class="btn btn-primary btn-lg"
            @click="createDonation"
          >
            Give by card
          </button>
        </div>
        <div
          v-if="formFields.paymentType == 'paypal'"
        >
          <button
            type="button"
            class="btn btn-primary btn-lg"
            @click="createDonation"
          >
            Give by PayPal
          </button>
        </div>
      </form>
      <!-- <div
        v-if="success"
        class="alert alert-success mt-3"
      >
        Donation made [do something else]
      </div> -->
      <div
        v-if="loading"
        class="alert alert-info mt-3"
      >
        [LOADING] Pretending the API is slow
      </div>
    </div>
    <div
      v-if="formFields.donationType == 'recurring'"
    >
      <h2>Recurring</h2>
    </div>
  </div>
</template>
<script>
import {
  required, minLength, decimal, minValue, email,
} from 'vuelidate/lib/validators'
import DonationAPI from '../services/api/Donations'

export default {
  name: 'DonationType',
  props: {
    route: {
      default: '',
      type: String,
    },
  },
  data() {
    return {
      formFields: {
        donationType: 'one-off',
        donationAmount: '1',
        emailAddress: '',
        fullName: '',
        paymentType: '',
      },
      donationValuesSingle: [
        { value: 1 },
        { value: 2 },
        { value: 10 },
      ],
      errors: [],
      success: false,
      fullError: '',
      loading: false,
      donationID: null,
    }
  },
  methods: {
    createDonation() {
      this.success = false
      this.loading = true
      this.errors = []
      // formFields is converted to FormData in the DonationAPI
      DonationAPI.createDonation(this.formFields)
        .then((id) => {
          console.log('Successfully created donation')
          this.donationID = id
          this.success = true
          this.loading = false
          this.$router.push({ name: 'giftaid', params: { donationID: this.donationID, donation: this.formFields } })
        })
        .catch((error) => {
          console.log(error)
          this.loading = false
          this.fullError = error.response
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {}
          }
        })
    },
  },
  validations: {
    formFields: {
      fullName: {
        required,
        minLength: minLength(3),
      },
      emailAddress: {
        required,
        email,
      },
      donationAmount: {
        required,
        decimal,
        minValue: minValue(0),
      },
    },
  },
}
</script>
<style scoped>
.invalid-feedback {
  display: block;
}
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
