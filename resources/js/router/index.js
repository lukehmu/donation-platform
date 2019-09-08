import Vue from 'vue'
import Router from 'vue-router'
import DonationType from '../components/DonationType.vue'
import GiftAid from '../components/GiftAid.vue'
import ThankYou from '../components/ThankYou.vue'
import AdminDonations from '../components/admin/AdminDonations.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: DonationType,
      props: true,
    },
    {
      path: '/giftaid',
      name: 'giftaid',
      component: GiftAid,
      props: true,
    },
    {
      path: '/thankyou',
      name: 'thankyou',
      component: ThankYou,
      props: true,
    },
    {
      path: '/admin/donations',
      name: 'adminDonations',
      component: AdminDonations,
      props: true,
    },
    {
      path: '*',
      name: '404',
      component: { template: '<div class="container">404 - Nothing here</div>' },
    },
  ],
})
