import { createRouter, createWebHistory } from 'vue-router' 
import HomeView from '../views/HomeView.vue'
import AuthorView  from '../views/AuthorView.vue'
import BookView from '../views/BookView.vue'
import MemberView  from '../views/MemberView.vue'


const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView
  },
  {
    path: '/author',
    name: 'Author',
    component: AuthorView
  },
  {
    path: '/book',
    name: 'Book',
    component: BookView
  },
  {
    path: '/member',
    name: 'Member',
    component: MemberView
  },
  
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
