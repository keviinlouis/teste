export default {
    setEmployee(state, employee) {
        state.employee = employee;
    },
    unsetEmployee(state) {
        state.user = {
            id: 0,
            name: '',
            price: 0
        };
    },
    setEmployees(state, employees) {
        state.employees = employees;
    },
};
