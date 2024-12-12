import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import Register from './components/user/register.vue';  
import Homepage from './components/user/homepage.vue';  
import Login from './components/user/login.vue';  

import AdminLogin from './components/AdminLogin.vue';
import AdminRegister from './components/adminregister.vue';
import Dashboard from './components/dashboard.vue'; 
import AvailableBooks from './components/availablebooks.vue';
import AddBooks from './components/addbooks.vue';
import Receipt from './components/receipt.vue';
import ReceiptHistory from './components/receipthistory.vue';
import Reserve from './components/reserve.vue';
import StudentList from './components/studentlist.vue';


const routes = [
  { path: '/', component: Home },
  { path: '/register', component: Register },  
  { path: '/homepage', component: Homepage }, 
  { path: '/login', component: Login }, 

  { path: '/admin-login', component: AdminLogin },
  { path: '/admin-register', component: AdminRegister },
  { path: '/dashboard', component: Dashboard }, 
  { path: '/available-books', component: AvailableBooks }, 
  { path: '/add-book', component: AddBooks },
  { path: '/receipt', component: Receipt },
  { path: '/receipt-history', component: ReceiptHistory },
  { path: '/reserve', component: Reserve },
  { path: '/student-list', component: StudentList },
  {
    path: '/studentlist',
    name: 'StudentList',
    component: StudentList
  },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


export default router;
