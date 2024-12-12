// resources/js/store.js

import { createStore } from 'vuex';

const store = createStore({
  state() {
    return {
      user: null,  // Store the logged-in user
    };
  },
  mutations: {
    setUser(state, user) {
      state.user = user; // Set user data in the state after login
    },
    clearUser(state) {
      state.user = null; // Clear user data (for logout)
    },
  },
  actions: {
    // You can add actions for async logic here, if needed
  },
});

export default store;
