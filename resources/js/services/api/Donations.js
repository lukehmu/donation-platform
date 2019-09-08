import axios from 'axios'

export default {
  getDonations() {
    return axios.get('/donations')
      .then((response) => {
        console.log('get all donations')
        return response.data
      })
  },
  getDonation(id) {
    return axios.get(`/donations/${id}`)
      .then((response) => {
        console.log('get donation by ID')
        return response.data
      })
  },
  createDonation(payload) {
    return axios.post('/donations', this.getFormData(payload))
      .then((response) => {
        console.log(response)
        return response.data.id
      })
  },
  updateDonation(donationID, payload) {
    return axios.patch(`/donations/${donationID}`, payload)
      .then((response) => {
        // console.log(`update donation${response}`)
        console.log(response)
        return response.data.id
      })
  },
  getFormData(object) {
    const formData = new FormData()
    Object.keys(object).forEach((key) => formData.append(key, object[key]))
    return formData
  },
}
