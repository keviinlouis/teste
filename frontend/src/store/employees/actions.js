import axios from 'axios';

export default {
  async loadEmployees({ commit }, params) {
    const response = await axios.get('employee', { params });

    if (response.isSuccess()) {
      commit('setEmployees', response.getData());
    }

    return response;
  },
  async loadEmployee({ commit }, id) {
    const response = await axios.get('employee/'+id);

    if (response.isSuccess()) {
      commit('setEmployee', response.getData());
    }

    return response;
  },

  async createEmployee({ commit }, employee) {
    const response = await axios.post('employee', employee);

    if (response.isSuccess()) {
      commit('setEmployee', response.getData());
    }

    return response;
  },

  async editEmployee({ commit }, employee) {
    const response = await axios.put('employee/'+employee.id, employee);

    if (response.isSuccess()) {
      commit('setEmployee', response.getData());
    }

    return response;
  },
};
