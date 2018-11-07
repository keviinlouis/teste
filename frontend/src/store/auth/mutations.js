export default {
  setUser(state, user) {
    state.user = user;
    state.auth = true;
  },
  unsetUser(state) {
    state.user = {
      id: 0,
      nome: '',
    };

    state.auth = false;
  },
};
