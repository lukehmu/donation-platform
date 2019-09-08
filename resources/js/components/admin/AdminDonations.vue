<template>
  <div class="container">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-sm">
        <thead>
          <tr>
            <th scope="col">
              id
            </th>
            <th scope="col">
              created_at
            </th>
            <th scope="col">
              updated_at
            </th>
            <th scope="col">
              donationType
            </th>
            <th scope="col">
              emailAddress
            </th>
            <th scope="col">
              fullName
            </th>
            <th scope="col">
              paymentType
            </th>
            <th scope="col">
              donationAmount
            </th>
            <th scope="col">
              giftaid
            </th>
            <th scope="col">
              delete
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="entry in donations"
            :key="entry.id"
          >
            <th scope="row">
              <a :href="`/donations/${entry.id}`">{{ entry.id }}</a>
            </th>
            <td>{{ entry.created_at }}</td>
            <td>{{ entry.updated_at }}</td>
            <td>{{ entry.donationType }}</td>
            <td>{{ entry.emailAddress }}</td>
            <td>{{ entry.fullName }}</td>
            <td>{{ entry.paymentType }}</td>
            <td>£{{ entry.donationAmount }}</td>
            <td>
              {{ entry.giftaid | boolean('Yes', 'No') }}
            </td>
            <td>
              <button
                class="btn btn-primary"
                @click="deleteDonation(entry.id)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import DonationAPI from '../../services/api/Donations'

export default {
  name: 'AdminDonations',
  data() {
    return {
      donations: {},
    }
  },
  computed: {

  },
  mounted() {

  },
  created() {
    this.getDonations()
  },
  methods: {
    deleteDonation(id) {
      DonationAPI.deleteDonation(id)
        .then((response) => {
          console.log(response)
          this.getDonations()
        })
    },
    getDonations() {
      DonationAPI.getDonations()
        .then((response) => {
          this.donations = response
        })
    },
  },
}
</script>
