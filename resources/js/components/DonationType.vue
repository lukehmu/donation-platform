<template>
  <div class="container">
    <div
      class="btn-group btn-group-toggle mb-3 col-sm-4"
    >
      <label
        class="btn btn-secondary btn-lg"
        :class="{ active: donationTypePicked === 'one-off' }"
        for="donationType-one-off"
      >
        <input
          id="donationType-one-off"
          v-model="donationTypePicked"
          type="radio"
          name="donationType"
          value="one-off"
        >
        One-off
      </label>
      <label
        class="btn btn-secondary btn-lg"
        :class="{ active: donationTypePicked === 'recurring' }"
        for="donationType-recurring"
      >
        <input
          id="donationType-recurring"
          v-model="donationTypePicked"
          type="radio"
          name="donationType"
          value="recurring"
        >
        Recurring
      </label>
    </div>
    <div v-if="donationTypePicked == 'one-off'">
      <form @submit.prevent="submitSingleDonation">
        <div>
          <h2>One-off</h2>
          <div
            class="btn-group btn-group-toggle mb-3 col-sm-5"
          >
            <label
              v-for="donationValue in donationValuesSingle"
              :key="donationValue.value"
              class="btn btn-info"
              :for="'donationAmountSingle-' + donationValue.value"
              :class="{ active: donationValue.value === donationAmountSingle }"
            >
              <input
                :id="'donationAmountSingle-' + donationValue.value"
                v-model="donationAmountSingle"
                type="radio"
                name="donationAmountSingle"
                :value="donationValue.value"
              >

              £{{ donationValue.value }}
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="donationAmountSingle">Donation amount</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">£</span>
            </div>
            <input
              id="donationAmountValue"
              v-model="donationAmountSingle"
              v-model.trim="$v.donationAmountSingle.$model"
              type="number"
              step="0.01"
              class="form-control col-sm-3"
              :class="{ 'is-invalid': $v.donationAmountSingle.$error }"
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
            v-model="fullName"
            v-model.trim="$v.fullName.$model"
            type="text"
            class="form-control col-sm-5"
            :class="{ 'is-invalid': $v.fullName.$error }"
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
            v-model="emailAddress"
            v-model.trim="$v.emailAddress.$model"
            type="email"
            class="form-control col-sm-5"
            :class="{ 'is-invalid': $v.emailAddress.$error }"
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
            class="btn btn-secondary btn-lg"
            :class="{ active: paymentTypePicked === 'card' }"
            for="paymentType-card"
          >
            <input
              id="paymentType-card"
              v-model="paymentTypePicked"
              type="radio"
              name="paymentType"
              value="card"
            >

            Card
          </label>

          <label
            class="btn btn-secondary btn-lg"
            :class="{ active: paymentTypePicked === 'paypal' }"
            for="paymentType-paypal"
          >
            <input
              id="paymentType-paypal"
              v-model="paymentTypePicked"
              type="radio"
              name="paymentType"
              value="paypal"
            >
            PayPal
          </label>
        </div>
        <div
          v-if="paymentTypePicked == 'card'"
        >
          <button
            type="submit"
            class="btn btn-primary btn-lg"
          >
            Give by card
          </button>
        </div>
        <div
          v-if="paymentTypePicked == 'paypal'"
        >
          <button
            type="button"
            class="btn btn-primary btn-lg"
          >
            Give by PayPal
          </button>
        </div>
      </form>
      <div
        v-if="success"
        class="alert alert-success mt-3"
      >
        Donation made [do something else]
      </div>
      <div
        v-if="loading"
        class="alert alert-info mt-3"
      >
        Loading
      </div>
    </div>
    <div
      v-if="donationTypePicked == 'recurring'"
    >
      <h2>Recurring</h2>
    </div>
  </div>
</template>
<script>
import {
  required, minLength, decimal, minValue, email,
} from 'vuelidate/lib/validators'

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
      fields: {},
      donationTypePicked: 'one-off',
      donationAmountSingle: '1',
      donationValuesSingle: [
        { value: 1 },
        { value: 2 },
        { value: 10 },
      ],
      emailAddress: null,
      fullName: null,
      paymentTypePicked: '',
      errors: {},
      success: false,
      fullError: '',
      loading: false,
    }
  },
  methods: {
    submitSingleDonation() {
      this.success = false
      this.loading = true
      this.errors = []
      window.axios.post(this.route, {
        donationAmount: this.donationAmountSingle,
        donationType: this.donationTypePicked,
        emailAddress: this.emailAddress,
        fullName: this.fullName,
        paymentType: this.paymentTypePicked,
      })
        .then((response) => {
          this.success = true
          this.loading = false
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
  validations: {
    fullName: {
      required,
      minLength: minLength(3),
    },
    emailAddress: {
      required,
      email,
    },
    donationAmountSingle: {
      required,
      decimal,
      minValue: minValue(0),
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
