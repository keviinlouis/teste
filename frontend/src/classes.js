import store from '@/store';
import router from '@/router';

export default class Response {
  constructor(response) {
    if (!response.data) {
      this.code = -1;
      return;
    }
    this.response = response;
    this.data = response.data.data;
    this.code = response.status;
    this.meta = response.data.meta;
    this.errors = response.data.errors;
    this.tokenUpdated = false;
    this.handleTypeOfResponse();
    this.handleToken();
  }

  isSuccess() {
    return this.getCode() < 400 && this.getCode() >= 200;
  }

  isFailed() {
    return !this.isSuccess();
  }

  isBadRequest() {
    return this.getCode() === 400;
  }

  isTokenUpdated() {
    return this.tokenUpdated;
  }

  hasInput(input) {
    if (this.isSuccess()) {
      return false;
    }
    return (input in this.errors);
  }

  async handleTypeOfResponse() {
    if (this.getCode() === 500) {
      console.log(this.response.data);
      store.dispatch('setToast', { text: 'Ocorreu um erro' });
    }

    if (this.getCode() === 401) {
      store.dispatch('setToast', { text: this.response.data.message });
      await store.dispatch('auth/logout');
      router.push({ name: 'login' });
      return;
    }
    if (this.getCode() === 404) {
      store.dispatch('setToast', { text: this.response.data.message });
    }
  }

  handleToken() {
    const newToken = this.response.headers.new_token;

    if (newToken) {
      this.tokenUpdated = true;

      store.dispatch('auth/setToken', newToken);
    }
  }

  getValidatorInput(input) {
    if (!this.hasInput(input)) {
      return '';
    }
    if (Array.isArray(this.errors[input])) {
      return this.errors[input][0];
    }
    return this.errors[input];
  }

  getData() {
    return this.data;
  }

  getErrors() {
    return this.errors;
  }

  getMessage() {
    return this.response.data.message ? this.response.data.message : '';
  }

  getCode() {
    return this.code;
  }

  getToken() {
    return this.response.data.token ? this.response.data.token : '';
  }

  getMeta() {
    if (this.meta) {
      return this.meta;
    }

    return {};
  }

  getLastPage() {
    if (!this.meta) {
      return 1;
    }

    return this.meta.last_page;
  }

  getTotalItens() {
    if (!this.meta) {
      return 0;
    }

    return this.meta.total;
  }

  getCurrentPage() {
    if (!this.meta) {
      return 0;
    }

    return this.meta.current_page;
  }
}
