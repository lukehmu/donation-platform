import axios from 'axios'

export default {
  getDonations() {
    return axios.get('/donations')
      .then((response) => {
        console.log('get all donations')
        // console.log(response)
        return response.data
      })
  },
  getDonation(id) {
    return axios.get(`/donations/${id}`)
      .then((response) => {
        console.log(`get donation: ${id}`)
        return response.data
      })
  },
  createDonation(payload) {
    return axios.post('/donations', this.getFormData(payload))
      .then((response) => {
        console.log(`create donation: ${response.data.id}`)
        return response.data.id
      })
  },
  updateDonation(donationID, payload) {
    return axios.patch(`/donations/${donationID}`, payload)
      .then((response) => {
        console.log(`update donation ${donationID}`)
        return response.data.id
      })
  },
  deleteDonation(donationID) {
    return axios.delete(`/donations/${donationID}`)
      .then((response) => {
        console.log(`delete donation ${donationID}`)
        return response
      })
  },
  getFormData(object) {
    const formData = new FormData()
    Object.keys(object).forEach((key) => formData.append(key, object[key]))
    return formData
  },
}
