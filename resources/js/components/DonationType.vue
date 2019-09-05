<template>
  <div class="container">
    <div class="form-group">
      <div class="form-check form-check-inline">
        <input
          id="donationType-one-off"
          v-model="donationTypePicked"
          class="form-check-input"
          type="radio"
          name="donationType"
          value="one-off"
          checked
        >
        <label
          class="form-check-label"
          for="donationType-one-off"
        >
          One-off
        </label>
      </div>
      <div class="form-check form-check-inline">
        <input
          id="donationType-recurring"
          v-model="donationTypePicked"
          class="form-check-input"
          type="radio"
          name="donationType"
          value="recurring"
        >
        <label
          class="form-check-label"
          for="donationType-recurring"
        >
          Recurring
        </label>
      </div>
    </div>
    <div
      v-if="donationTypePicked == 'one-off'"
      class="container"
    >
      <h2>One-off</h2>
      <div class="form-group">
        <div
          v-for="donationValue in donationValues"
          :key="donationValue.value"
          class="form-check form-check-inline"
        >
          <input
            :id="donationAmount-$(donationValue.value)"
            v-model="donationAmount"
            class="form-check-input"
            type="radio"
            name="donationAmount"
            :value="donationValue.value"
          >
          <label
            class="form-check-label"
            :for="donationAmount-$(donationValue.value)"
          >
            £1
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input
            id="donationAmount-2"
            v-model="donationAmount"
            class="form-check-input"
            type="radio"
            name="donationAmount"
            value="10"
          >
          <label
            class="form-check-label"
            for="donationAmount-2"
          >
            £10
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input
            id="donationAmount-3"
            v-model="donationAmount"
            class="form-check-input"
            type="radio"
            name="donationAmount"
            value="20"
          >
          <label
            class="form-check-label"
            for="donationAmount-3"
          >
            £20
          </label>
        </div>
      </div>
    </div>
    <div
      v-if="donationTypePicked == 'recurring'"
      class="container"
    >
      <h2>Recurring</h2>
    </div>
    <div
      v-if="donationTypePicked"
      class="form-group"
    >
      <label for="donationAmountValue">Amount</label>
      <input
        id="donationAmountValue"
        v-model="donationAmount"
        type="text"
      >
    </div>
  </div>
</template>
<script>
export default {
  name: 'DonationType',
  data() {
    return {
      donationTypePicked: '',
      donationAmount: '1',
      donationValues: [
        { value: 1 },
        { value: 5 },
        { value: 10 },
      ],
    }
  },
}
</script>
