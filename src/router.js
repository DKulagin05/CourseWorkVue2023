import { createRouter, createWebHistory } from 'vue-router'
import MainPage from "@/pages/MainPage.vue"
import AdminPage from "@/pages/AdminPage.vue"
import Login from "@/pages/Login.vue"
import ProductPage from "@/pages/ProductPage.vue"
import Services from "@/pages/Services.vue"
import Registration from "@/pages/Registration.vue"
import Promo from "@/pages/Promo.vue"
import Contacts from "@/pages/Contacts.vue";
import PersonalPage from "@/pages/PersonalPage.vue";
import Logout from "@/pages/Logout.vue";
import Test from "@/pages/test.vue";
import ReviewsPage from "@/pages/ReviewsPage.vue"


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: MainPage
        },
        {
            path: '/admin',
            name: 'admin',
            component: AdminPage
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/product',
            name: 'product',
            component: ProductPage
        },
        {
            path: '/services',
            name: 'services',
            component: Services
        },
        {
            path: '/registration',
            name: 'registration',
            component: Registration
        },
        {
            path: '/promo',
            name: 'promo',
            component: Promo
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts
        },
        {
            path: '/personal',
            name: 'personal',
            component: PersonalPage
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout
        },
        {
            path: '/test',
            name: 'Test',
            component: Test
        },
        {
            path: '/reviews',
            name: 'reviews',
            component: ReviewsPage
        },
    ]
})

export default router